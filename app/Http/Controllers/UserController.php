<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /* function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }*/

    public function index(Request $request): View
    {
        $data = User::latest()->paginate(5);

        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^(?!.*[A-Z]).*$/'
            ],
            'password' => [
                'required',
                'min:8',
                'same:confirm-password',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/', // al menos un número
                'regex:/[@$!%*?&^#(){}\[\]_\-+=|,.<>:;~]/', // al menos un carácter especial
            ],
            'roles' => 'required'
        ], [
            'name.required' => 'El campo de nombres completos es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo debe ser una dirección de correo válida.',
            'email.unique' => 'El correo ya está registrado.',
            'email.regex'        => 'El correo no debe contener letras mayúsculas.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.same' => 'Las contraseñas no coinciden.',
            'password.regex' => 'La contraseña debe contener al menos una letra minuscula, mayúscula, un número y un carácter especial.',
            'roles.required' => 'Es necesario seleccionar al menos un rol.'
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        // Obtener la contraseña sin hash
        $user->decrypted_password = $user->getAttributeValue('password');

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $id,
                'regex:/^(?!.*[A-Z]).*$/'
            ],
            'password' => [
                'required',
                'min:8',
                'same:confirm-password',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&^#(){}\[\]_\-+=|,.<>:;~]/',
            ],
            'roles' => 'required'
        ], [
            'name.required' => 'El campo de nombres completos es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo debe ser una dirección de correo válida.',
            'email.unique' => 'El correo ya está registrado.',
            'email.regex'        => 'El correo no debe contener letras mayúsculas.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.same' => 'Las contraseñas no coinciden.',
            'password.regex' => 'La contraseña debe contener al menos una letra minuscula, mayúscula, un número y un carácter especial.',
            'roles.required' => 'Es necesario seleccionar al menos un rol.'
        ]);

        $input = $request->all();

        // Comparar con la contraseña almacenada
        if ($input['password'] === $user->decrypted_password) {
            $input = Arr::except($input, ['password']);
        } else {
            $input['password'] = Hash::make($input['password']);
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index');
    }
}
