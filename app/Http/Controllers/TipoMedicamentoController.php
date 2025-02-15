<?php

namespace App\Http\Controllers;

use App\Models\TipoMedicamento;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;
use PDF;

class TipoMedicamentoController extends Controller
{
    public function index()
    {
        $tipomedicamentos = TipoMedicamento::get();

        return view('almacen.tipo_medicamentos.index', compact('tipomedicamentos'));
    }

    public function create()
    {
        $title = __("Agregar nuevo tipo de medicamento");
        $textButton = __("Registrar!");
        $route = route('tipos.store');
        $tipo = new TipoMedicamento();

        return view('almacen.tipo_medicamentos.create', compact('title', 'textButton', 'route', 'tipo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nombre_medicamento" => "required",
            "descripcion" => "required",
        ]);

        TipoMedicamento::create($request->all());

        return redirect()->route('tipos.index');
    }



    public function edit(TipoMedicamento $tipo)
    {
        $update = true;
        $title = __("Editar registro");
        $textButton = __("Actualizar registro");
        $route = route('tipos.update', ["tipo" => $tipo]);

        return view('almacen.tipo_medicamentos.edit', compact('update', 'title', 'textButton', 'route', 'tipo'));
    }

    public function update(Request $request, TipoMedicamento $tipo)
    {
        $this->validate($request, [
            "nombre_medicamento" => "required",
            "descripcion" => "required",
        ]);
        $tipo->fill($request->all())->update();

        return redirect()->route('tipos.index');
    }

    public function destroy(TipoMedicamento $tipo)
    {
        $tipo->delete();
        return back();
    }
    public function pdf()
    {
        $tipomedicamentos = TipoMedicamento::all();

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

        $pdf = PDF::loadView('almacen.tipo_medicamentos.pdf', compact('tipomedicamentos', 'qrData'));

        $fileName = "reporte_tipos_medicamentos_" . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
}
