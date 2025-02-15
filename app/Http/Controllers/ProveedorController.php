<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;
use PDF;

class ProveedorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:proveedor-list|proveedor-create|proveedor-edit|proveedor-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:proveedor-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:proveedor-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:proveedor-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $proveedores = Proveedor::get();

        return view('almacen.proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        $title = __("Agregar nuevo proveedor");
        $textButton = __("Registar proveedor");
        $proveedore = new Proveedor();
        $route = route('proveedores.store');

        return view('almacen.proveedores.create', compact('title', 'textButton', 'proveedore', 'route'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nombres" => "required",
            "apellidos" => "required",
            "ci"    =>  "required",
            "celular" => "required",
        ]);
        Proveedor::create($request->all());
        return redirect()->route('proveedores.index');
    }

    public function edit(Proveedor $proveedore)
    {
        $update = true;
        $title = __("Editar datos del proveedor");
        $textButton = __("Actualizar registro");
        $route =  route('proveedores.update', ["proveedore" => $proveedore]);

        return view('almacen.proveedores.edit', compact('update', 'title', 'textButton', 'route', 'proveedore'));
    }

    public function update(Request $request, Proveedor $proveedore)
    {
        $this->validate($request, [
            "nombres" => "required",
            "apellidos" => "required",
            "ci"    =>  "required",
            "celular" => "required",
        ]);
        $proveedore->fill($request->all())->update();
        return redirect()->route('proveedores.index');
    }

    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete();
        return back();
    }
    public function pdf()
    {
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

        $pdf = PDF::loadView('almacen.proveedores.pdf', compact('proveedores', 'qrData'));

        $fileName = "reporte_proveedores_" . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
}
