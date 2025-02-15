<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Informe;
use Illuminate\Http\Request;
use PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF2;
use Illuminate\Support\Facades\View;

class InformeController extends Controller
{
    public function index()
    {
        $informes = Informe::all();
        return view('informes.reportes.index', compact('informes'));
    }

    public function create()
    {
        $personas = Persona::all();
        return view('informes.reportes.create', compact('personas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'titulo' => 'required',
            'contenido' => 'required',
        ]);

        $informe = new Informe();
        $informe->persona_id = $request->persona_id;
        $informe->titulo = $request->titulo;
        $informe->contenido = $request->contenido;
        $informe->save();

        // Generar el PDF
        $pdf = PDF2::loadView('informes.reportes.pdf', compact('informe')); // Update PDF view path

        // Guardar el PDF en el sistema de archivos
        $pdfPath = 'informes/' . $informe->id . '.pdf';
        \Storage::disk('public')->put($pdfPath, $pdf->output());

        // Actualizar el informe con la ruta del PDF
        $informe->pdf_path = $pdfPath;
        $informe->save();

        return redirect()->route('informes.index')
            ->with('success', 'Informe creado y guardado en PDF exitosamente.');
    }

    public function show($id)
    {
        $informe = Informe::findOrFail($id);
        return view('informes.reportes.show', compact('informe')); // Update show view path
    }

    public function generatePdf($id)
    {
        $informe = Informe::findOrFail($id);
        $pdf = PDF2::loadView('informes.reportes.pdf', compact('informe')); // Update PDF view path

        return $pdf->download('informe-' . $informe->id . '.pdf');
    }
    public function destroy($id)
    {
        $informe = Informe::findOrFail($id);

        // Elimina el archivo PDF asociado si existe
        if ($informe->pdf_path && \Storage::disk('public')->exists($informe->pdf_path)) {
            \Storage::disk('public')->delete($informe->pdf_path);
        }

        $informe->delete();

        return redirect()->route('informes.index')
            ->with('success', 'Informe eliminado correctamente.');
    }
}
