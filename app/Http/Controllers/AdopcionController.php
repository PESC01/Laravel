<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Adoptante;
use App\Models\Persona;

use Illuminate\Http\Request;
use PDF; // Asegúrate de tener instalado barryvdh/laravel-dompdf
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;


class AdopcionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:adopcion-list|adopcion-create|adopcion-edit|adopcion-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:adopcion-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:adopcion-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:adopcion-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $adopciones = Adopcion::all();
        $adoptantes = Adoptante::all();
        $personas  = Persona::all();

        return view('adopciones.index', compact('adopciones', 'adoptantes', 'personas'));
    }

    public function create()
    {
        $title = __("Agregar registro de adopción");
        $textButton = __("Registrar!");
        $adopcione = new Adopcion;
        $adoptantes = Adoptante::get();
        $personas = Persona::get();
        $route = route('adopciones.store');

        return view('adopciones.create', compact('title', 'textButton', 'adoptantes', 'adopcione', 'personas', 'route'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "fecha"             =>      "required|date",
            "adoptante"         =>      "required",
            "persona"           =>      "required",
            "motivo"            =>      "required",
            "estado"            =>      "required",
            "observaciones"     =>      "required",
        ]);
        Adopcion::create($request->all());

        return redirect()->route('adopciones.index');
    }
    public function show($id)
    {
        $adopcione = Adopcion::findOrFail($id);
        $adoptantes = Adoptante::all();
        $personas = Persona::all();

        return view('adopciones.show', compact('adopcione', 'adoptantes', 'personas'));
    }

    public function edit(Adopcion $adopcione)
    {
        $update         =       true;
        $title          =       __("Editar registro de adopción");
        $textButton     =       __("Actualizar registro!");
        $route          =       route('adopciones.update', ["adopcione" => $adopcione]);
        $adoptantes     =       Adoptante::get();
        $personas       =       Persona::get();
        return view('adopciones.edit', compact('adoptantes', 'update', 'title', 'textButton', 'route', 'personas', 'adopcione'));
    }

    public function update(Request $request, Adopcion $adopcione)
    {
        $this->validate($request, [
            "fecha"             =>      "required",
            "adoptante"         =>      "required",
            "persona"           =>      "required",
            "motivo"            =>      "required",
            "estado"            =>      "required",
            "observaciones"     =>      "required",
        ]);
        $adopcione->fill($request->all())->update();

        return redirect()->route('adopciones.index');
    }

    public function destroy(Adopcion $adopcione)
    {
        $adopcione->delete();

        return back();
    }
    public function pdf()
    {
        $adopciones = Adopcion::all();
        $adoptantes = Adoptante::all();
        $personas   = Persona::all();

        // Utilizamos la URL actual como enlace para el QR
        $link = URL::current();

        // Generamos el código QR con endroid/qr-code
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($link)
            ->size(200)
            ->build();

        $qrCodeString = base64_encode($result->getString());
        $qrData = 'data:' . $result->getMimeType() . ';base64,' . $qrCodeString;

        // Se carga la vista PDF pasando los datos y el código QR
        $pdf = PDF::loadView('adopciones.pdf', compact('adopciones', 'adoptantes', 'personas', 'qrData'));

        $fileName = "reporte_adopciones_" . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
}
