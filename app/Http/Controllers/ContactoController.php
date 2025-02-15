<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\TipoRelacion;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {
        $contactos = Contacto::get();

        return view('personas.contactos.index', compact('contactos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($persona)
    {
        $update = null;
        $title = __("Agregar nuevo contacto");
        $textButton = __("Registrar familiar");
        $contacto = new Contacto();
        $route = route('contactos.store');
        $tipos=  TipoRelacion::get();
        return view('personas.contactos.create', compact('title', 'update','textButton', 'contacto', 'route', 'tipos', 'persona'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'persona' => 'exists:personas,id',
            'nombres' => 'required',
            'apellidos'=> 'required',
            'tipo_relacion'=>'required',
            'celular'=>'required',
            'direccion_vivienda'=>'required',
        ]);

        Contacto::create($request->all());
        return redirect()->route('personas.index');
    }

    
    public function edit(Contacto $contacto)
    {
        $update =true;
        $tipos =TipoRelacion::get();
        $title = __("Editar registro de contacto");
        $textButton = __("Actualizar registro!");
        $route = route('contactos.update', ["contacto"=>$contacto]);
        return view('personas.contactos.edit', compact('tipos','contacto', 'update', 'title','textButton','route'));
    }

    public function update(Request $request, Contacto $contacto)
    {
        $this->validate($request, [
            'persona' => 'exists:personas,id',
            'nombres' => 'required',
            'apellidos'=> 'required',
            'tipo_relacion'=>'required',
            'celular'=>'required',
            'direccion_vivienda'=>'required',
        ]);
        $contacto->fill($request->all())->update();

        return redirect()->route('personas.index');
    }

    public function destroy(Contacto $contacto)
    {
        $contacto->delete();
        return back();
    }
}
