<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;
use PDF;


class EmpleadoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:personal-list|personal-create|personal-edit|personal-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:personal-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:personal-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:personal-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $empleados =  Empleado::get();

        return view('administrativo.personal.index', compact('empleados'));
    }

    public function create()
    {
        $title = __("Agregar nuevo personal");
        $empleado = new Empleado(); // Cambiado de $administrativo a $empleado
        $route = route('administrativos.store');
        $textButton = __("Registrar");
        $roles = Role::pluck('name', 'name')->all();
        return view('administrativo.personal.create', compact('title', 'empleado', 'route', 'textButton', 'roles'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            "nombres" => ["required", "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/"],
            "apellidos" => ["required", "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/"],
            "celular"     => ["required", "regex:/^[0-9]+$/"],
            "email" => "required|email|unique:users,email|regex:/^(?!.*[A-Z]).*$/",
            "password" => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&^#(){}\[\]_\-+=|,.<>:;~]/',
            ],
            'roles' => 'required'
        ], [
            'nombres.required' => 'El campo de nombres completos es obligatorio.',
            'nombres.regex' => 'El campo de nombres solo debe contener letras y espacios.',
            'apellidos.required' => 'El campo de apellidos completos es obligatorio.',
            'apellidos.regex' => 'El campo de apellidos solo debe contener letras y espacios.',
            'name.required' => 'El campo de nombres completos es obligatorio.',
            'celular.required'   => 'El número de celular es obligatorio.',
            'celular.regex'      => 'El número de celular solo debe contener números.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo debe ser una dirección de correo válida.',
            'email.unique' => 'El correo ya está registrado.',
            'email.regex'        => 'El correo no debe contener letras mayúsculas.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.same' => 'Las contraseñas no coinciden.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.regex' => 'La contraseña debe contener al menos una letra minuscula, mayúscula, un número y un carácter especial.',
            'roles.required' => 'Es necesario seleccionar al menos un rol.'
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->nombres . ' ' . $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->input('roles')); // Asignar roles al usuario

        // Crear el empleado
        $empleado = Empleado::create(array_merge(
            $request->only('nombres', 'apellidos', 'celular', 'calificaciones', 'certificaciones', 'antecedentes'),
            ['user_id' => $user->id]
        ));

        return redirect()->route('administrativos.index');
    }


    public function show(Empleado $empleado)
    {
        //
    }


    public function edit($id)
    {
        $empleado = Empleado::find($id);
        $title = __("Editar personal");
        $route = route('administrativos.update', ['administrativo' => $empleado]);
        $textButton = __("Actualizar");
        $roles = Role::pluck('name', 'name')->all();
        $selectedRoles = $empleado->user->roles->pluck('name')->toArray();

        return view('administrativo.personal.edit', compact('title', 'empleado', 'route', 'textButton', 'roles', 'selectedRoles'))->with('update', true);
    }


    public function update(Request $request, Empleado $administrativo)
    {
        $this->validate($request, [
            "nombres" => ["required", "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/"],
            "apellidos" => ["required", "regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/"],
            "celular"       => ["required", "regex:/^[0-9]+$/"],
            "calificaciones" => "required",
            'celular.required'   => 'El número de celular es obligatorio.',
            'celular.regex'      => 'El número de celular solo debe contener números.',
            "antecedentes" => "required",
            "email" => "required|email|unique:users,email," . $administrativo->user_id . "|regex:/^(?!.*[A-Z]).*$/",
            "password" => [
                'nullable',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&^#(){}\[\]_\-+=|,.<>:;~]/',
            ],
            'roles' => 'required'
        ], [
            'nombres.required' => 'El campo de nombres completos es obligatorio.',
            'nombres.regex' => 'El campo de nombres solo debe contener letras y espacios.',
            'apellidos.required' => 'El campo de apellidos completos es obligatorio.',
            'apellidos.regex' => 'El campo de apellidos solo debe contener letras y espacios.',

            'name.required' => 'El campo de nombres completos es obligatorio.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo debe ser una dirección de correo válida.',
            'email.unique' => 'El correo ya está registrado.',
            'email.regex'        => 'El correo no debe contener letras mayúsculas.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.same' => 'Las contraseñas no coinciden.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.regex' => 'La contraseña debe contener al menos una letra minuscula, mayúscula, un número y un carácter especial.',
            'roles.required' => 'Es necesario seleccionar al menos un rol.'

        ]);

        // Actualizar el empleado
        $administrativo->fill($request->only('nombres', 'apellidos', 'celular', 'calificaciones', 'certificaciones', 'antecedentes'))->save();

        // Actualizar el usuario
        $user = User::find($administrativo->user_id);
        $user->name = $request->nombres . ' ' . $request->apellidos;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Actualizar roles del usuario
        $user->syncRoles($request->input('roles'));

        return redirect()->route('administrativos.index');
    }

    public function destroy(Empleado $administrativo)
    {
        // Eliminamos el usuario asociado, si existe
        if ($administrativo->user) {
            $administrativo->user->delete();
        }

        // Eliminamos el empleado
        $administrativo->delete();

        return back();
    }
    public function pdf()
    {
        $empleados = Empleado::all();

        // Usamos la URL actual para el QR
        $link = URL::current();

        // Generamos el código QR
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($link)
            ->size(200)
            ->build();

        $qrCodeString = base64_encode($result->getString());
        $qrData = 'data:' . $result->getMimeType() . ';base64,' . $qrCodeString;

        $pdf = PDF::loadView('administrativo.personal.pdf', compact('empleados', 'qrData'));

        $fileName = "reporte_personal_" . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
}
