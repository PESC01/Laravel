<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\Proveedor;
use App\Models\TipoMedicamento;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;
use PDF;
use App\Models\SuministroMedicamento;


class MedicamentoController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::get();
        $tipos = TipoMedicamento::get();
        $proveedores = Proveedor::get();

        return view('almacen.medicamentos.index', compact('medicamentos', 'tipos', 'proveedores'));
    }

    public function create()
    {
        $title =  __("Agregar nuevo medicamento");
        $textButton = __("Registrar medicamento");
        $medicamento = new Medicamento;
        $tipos = TipoMedicamento::get();
        $proveedores = Proveedor::get();
        $route = route('medicamentos.store');
        return view('almacen.medicamentos.create', compact('title', 'textButton', 'medicamento', 'tipos', 'proveedores', 'route'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "nombre_medicamento" => "required",
            "descripcion" => "required",
            "cantidad" => "required|numeric",
            "tipo" => "required",
            "proveedor" => "required",
        ]);

        Medicamento::create($request->all());
        return redirect()->route('medicamentos.index');
    }


    public function edit(Medicamento $medicamento)
    {
        $update = true;
        $title =  __("Editar datos del medicamento");
        $textButton = __("Actualizar datos del medicamento");
        $tipos = TipoMedicamento::get();
        $proveedores = Proveedor::get();
        $route = route('medicamentos.update', ["medicamento" => $medicamento]);

        return view('almacen.medicamentos.edit', compact('update', 'tipos', 'proveedores', 'title', 'textButton', 'route', 'medicamento'));
    }

    public function update(Request $request, Medicamento $medicamento)
    {
        $this->validate($request, [
            "nombre_medicamento" => "required",
            "descripcion" => "required",
            "cantidad" => "required|numeric",
            "tipo" => "required",
            "proveedor" => "required",
        ]);

        $medicamento->fill($request->all())->update();
        return redirect()->route('medicamentos.index');
    }

    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();
        return back();
    }
    public function pdf()
    {
        $medicamentos = Medicamento::all();
        $tipos = TipoMedicamento::all();
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

        $pdf = PDF::loadView('almacen.medicamentos.pdf', compact('medicamentos', 'tipos', 'proveedores', 'qrData'));

        $fileName = "reporte_medicamentos_" . now()->format('Ymd_His') . ".pdf";
        return $pdf->download($fileName);
    }
    public function suministrarForm(Medicamento $medicamento)
    {
        return view('almacen.medicamentos.suministrar', compact('medicamento'));
    }

    public function suministrarStore(Request $request, Medicamento $medicamento)
    {
        $request->validate([
            'cantidad_suministro' => 'required|numeric|min:1'
        ]);

        // Crear registro de suministro para el medicamento
        SuministroMedicamento::create([
            'medicamento_id' => $medicamento->id,
            'cantidad'       => $request->cantidad_suministro,
        ]);

        // Actualizar la cantidad del medicamento
        $medicamento->cantidad += $request->cantidad_suministro;
        $medicamento->save();

        return redirect()->route('medicamentos.index')
            ->with('success', 'Suministro agregado correctamente.');
    }
}
