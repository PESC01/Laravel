<?php

namespace App\Http\Controllers;

use App\Models\RegistroDiarioAtencion;
use Illuminate\Http\Request;

class RegistroDiarioAtencionController extends Controller
{
    public function index()
    {
        //
    }

    public function create($persona)
    {
        $update = null;
        $title = __("Agregar informe diario");
        $textButton = __("Registrar informe");
        $route =route('diarios.store');
        $diario = new RegistroDiarioAtencion();

        return view('informes.diario.create', compact('update','title', 'textButton', 'route', 'diario','persona'));
    }

    public function store(Request $request)
    {
        $request->validate( [
            "actividades_paciente_descripcion" =>"required",
            "fecha"=>"required",
            "persona"=>"exists:personas,id",
        ]);
        RegistroDiarioAtencion::create($request->all());

        return redirect()->route('personas.index');
    }

    public function show(RegistroDiarioAtencion $registroDiarioAtencion)
    {
        //
    }

    public function edit(RegistroDiarioAtencion $diario)
    {
        $update =true;
        $title = __("Editar registro de atención diaria");
        $textButton = __("Actualizar registro!");
        $route = route('diarios.update', ["diario"=>$diario]);

        return view('informes.diario.edit', compact('update', 'title', 'textButton', 'route', 'diario'));
    }

    public function update(Request $request, RegistroDiarioAtencion $diario)
    {
        $this->validate($request, [
            "actividades_paciente_descripcion" =>"required",
            "fecha"=>"required",
            "persona"=>"exists:personas,id",
        ]);
        $diario->fill($request->all())->update();

        return redirect()->route('personas.index');
    }

    public function destroy(RegistroDiarioAtencion $diario)
    {
        $diario->delete();
        return back();
    }
}
