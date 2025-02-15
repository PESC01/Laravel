<?php

namespace App\Http\Controllers;

use App\Models\Adoptante;
use Illuminate\Http\Request;
use PDF;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;

class AdoptanteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:adoptante-list|adoptante-create|adoptante-edit|adoptante-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:adoptante-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:adoptante-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:adoptante-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $adoptantes = Adoptante::all();

        return view('adoptantes.index', compact('adoptantes'));
    }

    public function create()
    {
        $title = __("Agregar registro de persona");
        $textButton = __("Registrar!");
        $adoptante = new Adoptante;
        $route = route('adoptantes.store');

        return view('adoptantes.create', compact('title', 'textButton', 'adoptante', 'route'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nombres"       =>      "required",
            "apellidos"     =>      "required",
            "domicilio"     =>      "required",
            "celular"       =>      "required",
        ]);

        Adoptante::create($request->all());

        return redirect()->route('adoptantes.index');
    }

    public function edit(Adoptante $adoptante)
    {
        $update = true;
        $title = __("Editar registro de persona");
        $textButton = __("Actualizar registro!");
        $route = route('adoptantes.update', ["adoptante" => $adoptante]);
        return view('adoptantes.edit', compact('adoptante', 'update', 'title', 'textButton', 'route'));
    }

    public function update(Request $request, Adoptante $adoptante)
    {
        $this->validate($request, [
            "nombres"       =>      "required",
            "apellidos"     =>      "required",
            "domicilio"     =>      "required",
            "celular"       =>      "required",
        ]);
        $adoptante->fill($request->all())->update();

        return redirect()->route('adoptantes.index');
    }

    public function destroy(Adoptante $adoptante)
    {
        $adoptante->delete();

        return back();
    }
    public function pdf()
    {
        $adoptantes = Adoptante::all();

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

        // Cargamos la vista PDF pasando los datos y el código QR
        $pdf = PDF::loadView('adoptantes.pdf', compact('adoptantes', 'qrData'));

        $fileName = "reporte_adoptantes_" . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
}
