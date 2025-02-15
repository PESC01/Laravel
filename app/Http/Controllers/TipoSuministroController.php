<?php

namespace App\Http\Controllers;

use App\Models\TipoSuministro;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;
use PDF;

class TipoSuministroController extends Controller
{
    public function index()
    {
        $tipos = TipoSuministro::get();

        return view('almacen.tipo_suministros.index', compact('tipos'));
    }

    public function create()
    {
        $title = __("Agregar nuevo tipo de suministro");
        $textButton = __("Registrar!");
        $route = route('tiposuministros.store');
        $tiposuministro = new TipoSuministro();

        return view('almacen.tipo_suministros.create', compact('title', 'textButton', 'route', 'tiposuministro'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nombre" => "required",
            "descripcion" => "required",
        ]);

        TipoSuministro::create($request->all());

        return redirect()->route('tiposuministros.index');
    }



    public function edit(TipoSuministro $tiposuministro)
    {
        $update = true;
        $title = __("Editar registro");
        $textButton = __("Actualizar registro");
        $route = route('tiposuministros.update', ["tiposuministro" => $tiposuministro]);

        return view('almacen.tipo_suministros.edit', compact('update', 'title', 'textButton', 'route', 'tiposuministro'));
    }

    public function update(Request $request, TipoSuministro $tiposuministro)
    {
        $this->validate($request, [
            "nombre" => "required",
            "descripcion" => "required",
        ]);
        $tiposuministro->fill($request->all())->update();

        return redirect()->route('tiposuministros.index');
    }

    public function destroy(TipoSuministro $tiposuministro)
    {
        $tiposuministro->delete();
        return back();
    }
    public function pdf()
    {
        $tipos = TipoSuministro::all();

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

        $pdf = PDF::loadView('almacen.tipo_suministros.pdf', compact('tipos', 'qrData'));

        $fileName = "reporte_tipos_suministros_" . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
}
