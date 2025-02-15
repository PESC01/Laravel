<?php

namespace App\Http\Controllers;

use App\Models\AntecedentesMedicos;
use Illuminate\Http\Request;

class AntecedentesMedicosController extends Controller
{
    public function index()
    {
        //
    }

    public function create($persona)
    {
        $update= null;
        $title = __("Agregar antecedentes");
        $textButton = __("Registrar antecedente");
        $antecedente = new AntecedentesMedicos();
        $route = route('antecedentes.store');

        return view('informes.antecedentesmedicos.create', compact('update','antecedente','title','textButton','route','persona'));
    }

    public function store(Request $request)
    {
        $this->validate($request ,[
            "persona"=>"exists:personas,id",
            "enfermedades_cronicas"=>"nullable",
            "alergias_medicamentos"=>"nullable",
            "cirugias_previas"=>"nullable",
            "historial_enfermedades"=>"nullable",
        ]);
        AntecedentesMedicos::create($request->all());

        return redirect()->route('personas.index');
    }

    public function show(AntecedentesMedicos $antecedentesMedicos)
    {
        //
    }

    public function edit(AntecedentesMedicos $antecedente)
    {
        $update = true;
        $title = __("Editar registro de antecedentes");
        $textButton = __("Actualizar registro");
        $route = route('antecedentes.update', ["antecedente"=>$antecedente]);

        return view('informes.antecedentesmedicos.edit', compact('update','title','textButton','route','antecedente'));
    }

    public function update(Request $request, AntecedentesMedicos $antecedente)
    {
        $this->validate($request, [
            "persona"=>"exists:personas,id",
            "enfermedades_cronicas"=>"nullable",
            "alergias_medicamentos"=>"nullable",
            "cirugias_previas"=>"nullable",
            "historial_enfermedades"=>"nullable",
        ]);
        $antecedente->fill($request->all())->update();

        return redirect()->route('personas.index');
    }

    public function destroy(AntecedentesMedicos $antecedente)
    {
        $antecedente->delete();
        return back();
    }
}
