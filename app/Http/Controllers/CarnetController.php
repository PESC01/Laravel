<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class CarnetController extends Controller
{
    public function formulario()
    {
        return view('carnet.index');
    }

    public function search(Request $request)
    {
        $dni = $request->input('carnet');

        // Se cambia "carnet" por "ci"
        $persona = Persona::where('ci', $dni)->first();

        if ($persona) {
            $message = "Esta persona pertenece al SRG de adulto mayor y este es su reporte";
            return view('carnet.resultado', compact('persona', 'message'));
        }

        return view('carnet.resultado', ['message' => 'No se encontró ningún paciente con ese carnet de identidad.']);
    }
}
