<?php

namespace App\Http\Controllers;

use App\Models\Canasta;
use App\Models\Persona;
use Illuminate\Http\Request;

use PDF;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;


class CanastaController extends Controller
{
    public function index()
    {
        $fechas = Canasta::select('fecha')->distinct()->get();
        return view('canasta.index', compact('fechas'));
    }

    public function create()
    {
        $personas = Persona::all();
        return view('canasta.create', compact('personas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'personas' => 'required|array',
            'personas.*.id' => 'required|exists:personas,id',
            'personas.*.estado' => 'required|string'
        ]);

        foreach ($request->personas as $persona) {
            Canasta::updateOrCreate(
                ['fecha' => $request->fecha, 'persona_id' => $persona['id']],
                ['estado' => $persona['estado']]
            );
        }

        return redirect()->route('canasta.index');
    }

    public function show($fecha)
    {
        $canastas = Canasta::with('persona')->where('fecha', $fecha)->get();
        return view('canasta.show', compact('canastas', 'fecha'));
    }

    public function edit($fecha)
    {
        $canastas = Canasta::with('persona')->where('fecha', $fecha)->get();
        $personas = Persona::all();
        return view('canasta.edit', compact('canastas', 'fecha', 'personas'));
    }

    public function update(Request $request, $fecha)
    {
        $request->validate([
            'personas' => 'required|array',
            'personas.*.id' => 'required|exists:personas,id',
            'personas.*.estado' => 'required|string'
        ]);

        foreach ($request->personas as $persona) {
            Canasta::updateOrCreate(
                ['fecha' => $fecha, 'persona_id' => $persona['id']],
                ['estado' => $persona['estado']]
            );
        }

        return redirect()->route('canasta.index');
    }

    public function destroy($fecha)
    {
        Canasta::where('fecha', $fecha)->delete();
        return redirect()->route('canasta.index');
    }
    public function pdf()
    {
        // Obtenemos todos los registros de canasta junto a la información de la persona
        $canastas = \App\Models\Canasta::with('persona')->orderBy('fecha', 'asc')->get();

        // Obtenemos la URL actual para el QR
        $link = URL::current();

        // Generamos el código QR
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($link)
            ->size(200)
            ->build();

        $qrCodeString = base64_encode($result->getString());
        $qrData = 'data:' . $result->getMimeType() . ';base64,' . $qrCodeString;

        // Cargamos la vista del PDF y le pasamos los datos
        $pdf = PDF::loadView('canasta.pdf', compact('canastas', 'qrData'));

        $fileName = "reporte_canasta_alimentaria_" . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
    public function pdfFecha($fecha)
    {
        // Obtenemos los registros de canasta para una fecha específica junto a la información de la persona
        $canastas = Canasta::with('persona')->where('fecha', $fecha)->get();

        // Obtenemos la URL actual para el QR
        $link = URL::current();

        // Generamos el código QR
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($link)
            ->size(200)
            ->build();

        $qrCodeString = base64_encode($result->getString());
        $qrData = 'data:' . $result->getMimeType() . ';base64,' . $qrCodeString;

        // Cargamos la vista del PDF y le pasamos los datos
        $pdf = PDF::loadView('canasta.pdf', compact('canastas', 'qrData', 'fecha'));

        $fileName = "reporte_canasta_alimentaria_" . $fecha . ".pdf";
        return $pdf->download($fileName);
    }
}
