<?php

namespace App\Http\Controllers;

use App\Models\ResultadoPruebaMedica;
use Illuminate\Http\Request;

class ResultadoPruebaMedicaController extends Controller
{
    public function index()
    {
        //
    }

    public function create($persona)
    {
        $update= null;
        $title = __("Agregar registro");
        $textButton = __("Registrar prueba");
        $prueba = new ResultadoPruebaMedica();
        $route = route('pruebas.store');
        return view('informes.pruebasmedicas.create', compact('update','title', 'textButton', 'prueba','route','persona'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "descripcion_prueba_medica"=> "required",
            "fecha_prueba_medica"=> "required",
            "persona"=>"exists:personas,id",
        ]);
        ResultadoPruebaMedica::create($request->all());

        return redirect()->route('personas.index');
    }

    public function edit(ResultadoPruebaMedica $prueba)
    {
        $update = true;
        $title = __("Editar registro de prueba médica");
        $textButton= __("Actualizar registro");
        $route = route('pruebas.update', ["prueba"=>$prueba]);

        return view('informes.pruebasmedicas.edit', compact('update', 'title', 'textButton', 'route','prueba'));
    }

    public function update(Request $request, ResultadoPruebaMedica $prueba)
    {
        $this->validate($request, [
            "descripcion_prueba_medica"=> "required",
            "fecha_prueba_medica"=> "required",
            "persona"=>"exists:personas,id",
        ]);
        $prueba->fill($request->all())->update();

        return redirect()->route('personas.index');
    }

    public function destroy(ResultadoPruebaMedica $prueba)
    {
        $prueba->delete();
        return back();
    }
}
