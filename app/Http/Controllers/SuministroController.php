<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Suministro;
use App\Models\TipoSuministro;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;
use PDF;

class SuministroController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:suministro-list|suministro-create|suministro-edit|suministro-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:suministro-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:suministro-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:suministro-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $suministros = Suministro::get();
        $tipos = TipoSuministro::get();
        $proveedores = Proveedor::get();

        return view('almacen.suministros.index', compact('suministros', 'tipos', 'proveedores'));
    }

    public function create()
    {
        $title =  __("Agregar nuevo sumnistro");
        $textButton = __("Registrar sumnistro");
        $suministro = new Suministro;
        $tipos = TipoSuministro::get();
        $proveedores = Proveedor::get();
        $route = route('suministros.store');
        return view('almacen.suministros.create', compact('title', 'textButton', 'suministro', 'tipos', 'proveedores', 'route'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nombre" => "required",
            "descripcion" => "required",
            "cantidad" => "required|numeric",
            "tipo" => "required",
            "proveedor" => "required",
        ]);

        Suministro::create($request->all());
        return redirect()->route('suministros.index');
    }

    public function edit(Suministro $suministro)
    {
        $update = true;
        $title =  __("Editar datos del sumninistro");
        $textButton = __("Actualizar datos del suministro");
        $tipos = TipoSuministro::get();
        $proveedores = Proveedor::get();
        $route = route('suministros.update', ["suministro" => $suministro]);

        return view('almacen.suministros.edit', compact('update', 'tipos', 'proveedores', 'title', 'textButton', 'route', 'suministro'));
    }

    public function update(Request $request, Suministro $suministro)
    {
        $this->validate($request, [
            "nombre" => "required",
            "descripcion" => "required",
            "cantidad" => "required|numeric",
            "tipo" => "required",
            "proveedor" => "required",
        ]);
        $suministro->fill($request->all())->update();
        return redirect()->route('suministros.index');
    }

    public function destroy(Suministro $suministro)
    {
        $suministro->delete();
        return back();
    }
    public function pdf()
    {
        $suministros = Suministro::all();
        $tipos = TipoSuministro::all();
        $proveedores = Proveedor::all();

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

        $pdf = PDF::loadView('almacen.suministros.pdf', compact('suministros', 'tipos', 'proveedores', 'qrData'));

        $fileName = "reporte_suministros_" . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
}
