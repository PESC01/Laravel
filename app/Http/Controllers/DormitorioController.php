<?php

namespace App\Http\Controllers;

use App\Models\Dormitorio;
use Illuminate\Http\Request;

class DormitorioController extends Controller
{
    public function index()
    {
        $dormitorios = Dormitorio::all();
        return view('dormitorios.index', compact('dormitorios'));
    }

    public function create()
    {
        return view('dormitorios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1',
            'descripcion' => 'nullable|string',
        ]);

        Dormitorio::create($request->all());

        return redirect()->route('dormitorios.index')->with('success', 'Dormitorio creado correctamente.');
    }

    public function show(Dormitorio $dormitorio)
    {
        return view('dormitorios.show', compact('dormitorio'));
    }
    public function camas(Dormitorio $dormitorio)
    {
        $camas = $dormitorio->camas()->with('ocupaciones')->get();
        return view('dormitorios.camas', compact('dormitorio', 'camas'));
    }
    public function edit(Dormitorio $dormitorio)
    {
        return view('dormitorios.edit', compact('dormitorio'));
    }
    public function update(Request $request, Dormitorio $dormitorio)
    {
        // Validar los datos que se reciben del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:1',
        ]);

        // Actualizar los datos del dormitorio
        $dormitorio->update([
            'nombre' => $request->input('nombre'),
            'capacidad' => $request->input('capacidad'),
            'descripcion' => $request->input('descripcion'),
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('dormitorios.index')->with('success', 'Dormitorio actualizado correctamente.');
    }

    public function destroy(Dormitorio $dormitorio)
    {
        try {
            $dormitorio->delete();
            return redirect()->route('dormitorios.index')->with('success', 'Dormitorio eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('dormitorios.index')->with('error', 'Error al eliminar el dormitorio.');
        }
    }
    public function pdf(Dormitorio $dormitorio)
    {
        $camas = $dormitorio->camas()->with('ocupaciones')->get();
        $qrUrl = route('dormitorios.pdf', $dormitorio);

        // Genera el código QR usando Endroid\QrCode con PNG
        $result = \Endroid\QrCode\Builder\Builder::create()
            ->writer(new \Endroid\QrCode\Writer\PngWriter())
            ->data($qrUrl)
            ->size(200)
            ->build();

        $qrCodeString = base64_encode($result->getString());
        $qrCode = 'data:' . $result->getMimeType() . ';base64,' . $qrCodeString;

        $data = compact('dormitorio', 'camas', 'qrCode');
        $pdf = \PDF::loadView('pdf.dormitorio', $data);
        return $pdf->stream('dormitorio_' . $dormitorio->id . '.pdf');
    }
}
