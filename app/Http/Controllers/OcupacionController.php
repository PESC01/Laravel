<?php


namespace App\Http\Controllers;

use App\Models\Cama;
use App\Models\Ocupacion;
use App\Models\Persona;
use Illuminate\Http\Request;

class OcupacionController extends Controller
{
    public function index($cama_id)
    {
        $cama = Cama::with('ocupaciones.persona')->findOrFail($cama_id);
        $personas = Persona::all();

        return view('camas.gestion_ocupante', [
            'cama' => $cama,
            'personas' => $personas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cama_id' => 'required|exists:camas,id',
            'persona_id' => 'required|exists:personas,id',
            'fecha_ocupacion' => 'required|date',
        ]);

        // Verificar si la cama ya tiene un ocupante activo
        if (Ocupacion::where('cama_id', $request->cama_id)
            ->where('estado', 'ocupado')
            ->exists()
        ) {
            return redirect()->back()->with('error', 'Esta cama ya tiene un ocupante activo.');
        }

        Ocupacion::create([
            'cama_id' => $request->cama_id,
            'persona_id' => $request->persona_id,
            'estado' => 'ocupado',
            'fecha_ocupacion' => $request->fecha_ocupacion,
            'fecha_liberacion' => null
        ]);

        return redirect()->back()->with('success', 'Ocupante asignado exitosamente');
    }

    public function liberar(Ocupacion $ocupacion)
    {
        $ocupacion->estado = 'libre';
        $ocupacion->fecha_liberacion = now();
        $ocupacion->save();

        return redirect()->back()->with('success', 'Cama liberada exitosamente');
    }

    public function ocupar(Ocupacion $ocupacion)
    {
        // Verificar que no exista otra ocupación activa para la cama, ignorando la ocupación actual
        $otraOcupacionActiva = Ocupacion::where('cama_id', $ocupacion->cama_id)
            ->where('estado', 'ocupado')
            ->where('id', '<>', $ocupacion->id)
            ->exists();

        if ($otraOcupacionActiva) {
            return redirect()->back()->with('error', 'Esta cama ya tiene un ocupante activo.');
        }

        $ocupacion->estado = 'ocupado';
        $ocupacion->save();

        return redirect()->back()->with('success', 'Cama ocupada nuevamente');
    }
}
