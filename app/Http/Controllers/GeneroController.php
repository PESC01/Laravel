<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generos = Genero::get();
        return view('personas.generos.index',compact('generos'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Genero $genero)
    {
        //
    }

    public function edit(Genero $genero)
    {
        //
    }

    public function update(Request $request, Genero $genero)
    {
        //
    }

    public function destroy(Genero $genero)
    {
        //
    }
}
