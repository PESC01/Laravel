<?php

namespace App\Http\Controllers;

use App\Models\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    public function index()
    {
        //
    }

    public function create($persona)
    {
        $update = null;
        $title = __("Agregar registros");
        $textButton = __("Registrar datos");
        $route = route('seguimientos.store');
        $seguimiento =new Seguimiento();

        return view('informes.seguimientos.create', compact('update', 'title', 'textButton', 'route', 'seguimiento', 'persona'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "presion_arterial" =>"required",
            "frecuencia_cardiaca" =>"required",
            "temperatura"=>"required",
            "fecha_seguimiento"=>"required",
            "persona"=> "exists:personas,id"
        ]);
        Seguimiento::create($request->all());
        return redirect()->route('personas.index');
    }

    public function edit(Seguimiento $seguimiento)
    {
        $update =true;
        $title = __("Editar registro de seguimiento");
        $textButton = __("Actualizar registro!");
        $route = route('seguimientos.update', ["seguimiento"=>$seguimiento]);
        
        return view('informes.seguimientos.edit', compact('update','title','textButton','route', 'seguimiento'));
    }

    public function update(Request $request, Seguimiento $seguimiento)
    {
        $this->validate($request, [
            "presion_arterial" =>"required",
            "frecuencia_cardiaca" =>"required",
            "temperatura"=>"required",
            "fecha_seguimiento"=>"required",
            "persona"=> "exists:personas,id"
        ]);
        $seguimiento->fill($request->all())->update();

        return redirect()->route('personas.index');
    }

    public function destroy(Seguimiento $seguimiento)
    {
        $seguimiento->delete();
        return back();
    }
}
