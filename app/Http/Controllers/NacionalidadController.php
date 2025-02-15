<?php

namespace App\Http\Controllers;

use App\Models\Nacionalidad;
use Illuminate\Http\Request;

class NacionalidadController extends Controller
{
    public function index()
    {
        $nacionalidades = Nacionalidad::get();

        return view('personas.nacionalidades.index', compact('nacionalidades'));
    }

    public function create()
    {   
        $title = __("Agregar nueva nacionalidad");
        $nacionalidade = new Nacionalidad;
        $route = route('nacionalidades.store');
        $textButton = __("Registrar");
        return view('personas.nacionalidades.create', compact('title', 'nacionalidade', 'route', 'textButton'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nombre_nacionalidad"=> "required",
        ]);
        Nacionalidad::create($request->all());

        return redirect()->route('nacionalidades.index');
    }

   

    public function edit(Nacionalidad $nacionalidade)
    {
        $update = true;
        $title = __("Editar registro");
        $textButton= __("Actualizar registro");
        $route = route('nacionalidades.update', ['nacionalidade'=>$nacionalidade]);
        return view('personas.nacionalidades.edit', compact('nacionalidade', 'title','route', 'update', 'textButton'));
    }

    public function update(Request $request, Nacionalidad $nacionalidade)
    {
        $this->validate($request, [
            "nombre_nacionalidad" => "required",
        ]);
        $nacionalidade->fill($request->all())->update();

        return redirect()->route('nacionalidades.index');
    }

    public function destroy(Nacionalidad $nacionalidade)
    {
        $nacionalidade->delete();
        return back();
        
    }
}
