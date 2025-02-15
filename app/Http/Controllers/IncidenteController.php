<?php

namespace App\Http\Controllers;

use App\Models\Incidente;
use Illuminate\Http\Request;

class IncidenteController extends Controller
{
    public function index()
    {
        //
    }

    public function create($persona)
    {
        $update = null;
        $title = __("Agregar incidente");
        $textButton = __("Registrar incidente");
        $route =route('incidentes.store');
        $incidente = new Incidente();

        return view('informes.incidentes.create', compact('update','title','textButton', 'route', 'incidente','persona'));
    }

    public function store(Request $request)
    {
        $request->validate( [
            "incidente_fecha" =>"required",
            "incidente_descripcion"=>"required",
            "persona"=>"exists:personas,id",
        ]);
        Incidente::create($request->all());

        return redirect()->route('personas.index');
    }

    public function edit(Incidente $incidente)
    {
        $update =true;
        $title = __("Editar incidente");
        $textButton = __("Actualizar registro!");
        $route = route('incidentes.update', ["incidente"=>$incidente]);

        return view('informes.incidentes.edit', compact('update', 'title', 'textButton', 'route', 'incidente'));
    
    }

    public function update(Request $request, Incidente $incidente)
    {
        $this->validate($request, [
            "incidente_fecha" =>"required",
            "incidente_descripcion"=>"required",
            "persona"=>"exists:personas,id",
        ]);
        $incidente->fill($request->all())->update();

        return redirect()->route('personas.index');
    }

    public function destroy(Incidente $incidente)
    {
        $incidente->delete();
        return back();
    }
}
