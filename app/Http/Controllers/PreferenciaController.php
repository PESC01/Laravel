<?php

namespace App\Http\Controllers;

use App\Models\Preferencia;
use Illuminate\Http\Request;

class PreferenciaController extends Controller
{
    public function index()
    {
        //
    }

    public function create($persona)
    {
        $update =null;
        $title = __("Agregar nueva preferencia");
        $textButton= __("Registrar preferencias");
        $preferencia = new Preferencia();
        $route = route('preferencias.store');

        return view('informes.preferencias.create', compact('update','title', 'textButton', 'preferencia', 'route','persona'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "persona" => "exists:personas,id",
            "preferencias_alimenticias"=> "required",
            "preferencias_habitacion"=>"required",
            "necesidades_especiales"=>"required",
        ]);
        Preferencia::create($request->all());

        return redirect()->route('personas.index');
    }

    public function edit(Preferencia $preferencia)
    {
        $update =true;
        $title = __("Editar registro de preferencias");
        $textButton = __("Actualizar registro");
        $route = route("preferencias.update", ["preferencia"=> $preferencia]);

        return view('informes.preferencias.edit', compact('update', 'title', 'textButton', 'route','preferencia'));
    }

    public function update(Request $request, Preferencia $preferencia)
    {
        $this->validate($request, [
            "persona" => "exists:personas,id",
            "preferencias_alimenticias"=> "required",
            "preferencias_habitacion"=>"required",
            "necesidades_especiales"=>"required",
        ]);
        $preferencia->fill($request->all())->update();

        return redirect()->route('personas.index');
    }

    public function destroy(Preferencia $preferencia)
    {
        $preferencia->delete();
        return back();
    }
}
