<?php

namespace App\Http\Controllers;

use App\Models\DocumentoLegal;
use Illuminate\Http\Request;
use App\Models\Persona;
use PDF;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;

class DocumentosLegalesController extends Controller
{
    public function index()
    {
        $documentos = DocumentoLegal::with('persona')->get();
        $personas = Persona::all(); // Obtener todas las personas
        return view('informes.documentoslegales.index', compact('documentos', 'personas')); // Pasar las personas a la vista
    }

    public function create(Request $request)
    {
        $personaId = $request->query('persona');
        $persona = $personaId ? Persona::findOrFail($personaId) : null;
        $personas = Persona::all();
        return view('informes.documentoslegales.create', compact('persona', 'personas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_documento' => 'required|string|max:255',
            'descripcion_documento' => 'required|string',
            'imagen_documento' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'persona_id' => 'required|exists:personas,id', // Validar que persona_id sea requerido y exista en la tabla personas
        ]);

        $input = $request->all();

        if ($image = $request->file('imagen_documento')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['imagen_documento'] = "$profileImage";
        }

        DocumentoLegal::create($input);

        return redirect()->route('documentoslegales.index');
    }

    public function edit(DocumentoLegal $documentoslegale)
    {
        return view('informes.documentoslegales.edit', compact('documentoslegale'));
    }

    public function update(Request $request, DocumentoLegal $documentoslegale)
    {
        $request->validate([
            'nombre_documento' => 'required|string|max:255',
            'descripcion_documento' => 'required|string',
            'imagen_documento' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('imagen_documento')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['imagen_documento'] = "$profileImage";
        } else {
            unset($input['imagen_documento']);
        }

        $documentoslegale->update($input);

        return redirect()->route('documentoslegales.index');
    }

    public function destroy(DocumentoLegal $documentoslegale)
    {
        $documentoslegale->delete();
        return redirect()->route('documentoslegales.index');
    }


    public function pdf(Request $request)
    {
        $personaId = $request->query('persona');

        // Si se proporciona un ID de persona, filtrar los documentos por esa persona
        if ($personaId) {
            $documentos = DocumentoLegal::with('persona')->where('persona_id', $personaId)->get();
        } else {
            // Si no se proporciona un ID de persona, obtener todos los documentos
            $documentos = DocumentoLegal::with('persona')->get();
        }

        // Usamos la URL actual para el QR
        $link = URL::current();

        // Generamos el código QR
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($link)
            ->size(200)
            ->build();

        $qrCodeString = base64_encode($result->getString());
        $qrData = 'data:' . $result->getMimeType() . ';base64,' . $qrCodeString;

        $pdf = PDF::loadView('informes.documentoslegales.pdf', compact('documentos', 'qrData'));

        // Modificar el nombre del archivo para incluir el ID de la persona si está presente
        $fileName = "reporte_documentos_legales_" . ($personaId ? "persona_" . $personaId . "_" : "") . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
}
