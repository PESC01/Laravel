<?php

namespace App\Http\Controllers;

use App\Models\Cama;
use App\Models\Dormitorio;
use App\Models\Ocupacion;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CamaController extends Controller
{
    public function index()
    {
        $camas = Cama::with('dormitorio')->get();
        return view('camas.index', compact('camas'));
    }

    public function create()
    {
        $dormitorios = Dormitorio::all();
        return view('camas.create', compact('dormitorios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dormitorio_id' => 'required|exists:dormitorios,id',
            'identificador'  => 'required|string|max:255',
        ]);

        // Obtener el dormitorio y contar las camas asociadas
        $dormitorio = \App\Models\Dormitorio::findOrFail($request->dormitorio_id);
        $camasCreadas = $dormitorio->camas()->count();

        if ($camasCreadas >= $dormitorio->capacidad) {
            return redirect()->back()->with('error', 'Se ha alcanzado la capacidad máxima de camas para este dormitorio.');
        }

        \App\Models\Cama::create($request->all());
        return redirect()->route('camas.index')->with('success', 'Cama creada exitosamente.');
    }

    public function edit(Cama $cama)
    {
        $dormitorios = Dormitorio::all();
        return view('camas.edit', compact('cama', 'dormitorios'));
    }

    public function update(Request $request, Cama $cama)
    {
        $request->validate([
            'dormitorio_id' => 'required|exists:dormitorios,id',
            'identificador' => 'required|string|max:255',
        ]);

        $cama->update($request->all());
        return redirect()->route('camas.index')->with('success', 'Cama actualizada exitosamente.');
    }

    // CamaController.php


    public function gestionarOcupante($camaId)
    {
        $cama = Cama::with('ocupaciones.persona')->findOrFail($camaId);
        $personas = Persona::all();
        return view('ocupaciones.gestionar', compact('cama', 'personas'));
    }



    public function destroy(Cama $cama)
    {
        $cama->delete();
        return redirect()->route('camas.index')->with('success', 'Cama eliminada exitosamente.');
    }
    public function ocupante(Cama $cama)
    {
        $ocupacion = $cama->ocupaciones()->where('estado', 'ocupado')->latest()->first();

        if ($ocupacion) {
            return response()->json([
                'ocupante' => $ocupacion->persona,
                'estado' => $ocupacion->estado,
                'fecha_ocupacion' => $ocupacion->fecha_ocupacion,
                'fecha_liberacion' => $ocupacion->fecha_liberacion,
            ]);
        }

        return response()->json(['ocupante' => null]);
    }
    public function verOcupante($camaId)
    {
        $cama = Cama::with('dormitorio', 'ocupaciones.persona')->findOrFail($camaId);
        $ocupacion = $cama->ocupaciones->where('estado', 'ocupado')->first();

        return view('camas.ocupante', compact('cama', 'ocupacion'));
    }

    public function agregarOcupante(Request $request, $camaId)
    {
        $validated = $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'fecha_ocupacion' => 'required|date',
        ]);

        // Verificar si la cama ya tiene un ocupante activo
        if (Ocupacion::where('cama_id', $camaId)
            ->where('estado', 'ocupado')
            ->exists()
        ) {
            return response()->json(['error' => 'Esta cama ya tiene un ocupante activo.'], 422);
        }

        Ocupacion::create([
            'cama_id' => $camaId,
            'persona_id' => $validated['persona_id'],
            'fecha_ocupacion' => $validated['fecha_ocupacion'],
            'estado' => 'ocupado',
        ]);

        return response()->json(['message' => 'Ocupante agregado exitosamente.']);
    }
}
