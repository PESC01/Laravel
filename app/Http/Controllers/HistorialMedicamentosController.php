<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedicamentos;
use App\Models\Medicamento;
use Illuminate\Http\Request;

class HistorialMedicamentosController extends Controller
{
    public function index()
    {
        //
    }

    public function create($persona)
    {
        $update = null;
        $title = __("Agregar historial médico");
        $textButton = __("Registrar historial");
        $medicamentos = Medicamento::get();
        $route = route('historial.store');
        $historial = new HistorialMedicamentos();

        return view('informes.historialmedicamentos.create', compact('medicamentos', 'update', 'title', 'textButton', 'route', 'historial', 'persona'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "persona" => "exists:personas,id",
            "medicamentos" => "required",
            "medicamentos_anteriores_recetados" => "required",
            "dosis_duracion_medicacion" => "required|numeric"
        ]);

        // Crear registro de historial
        $historial = HistorialMedicamentos::create($request->all());

        // Actualizar stock del medicamento seleccionado
        $medicamento = Medicamento::find($request->medicamentos);
        if ($medicamento) {
            $medicamento->cantidad = $medicamento->cantidad - $request->dosis_duracion_medicacion;
            $medicamento->save();
        }

        return redirect()->route('personas.index');
    }

    public function edit(HistorialMedicamentos $historial)
    {
        $update = true;
        $title = __("Editar datos de historial");
        $medicamentos = Medicamento::get();
        $textButton = __("Actualizar registros");
        $route = route('historial.update', ["historial" => $historial]);

        return view('informes.historialmedicamentos.edit', compact('medicamentos', 'update', 'title', 'textButton', 'route', 'historial'));
    }

    public function update(Request $request, HistorialMedicamentos $historial)
    {
        $request->validate([
            "persona" => "exists:personas,id",
            "medicamentos" => "required",
            "medicamentos_anteriores_recetados" => "required",
            "dosis_duracion_medicacion" => "required|numeric"
        ]);

        // Guardamos la dosis anterior y el medicamento anterior
        $oldDose = $historial->dosis_duracion_medicacion;
        $oldMedicamentoId = $historial->medicamentos;

        $newDose = $request->dosis_duracion_medicacion;
        $newMedicamentoId = $request->medicamentos;

        // Si el medicamento seleccionado es el mismo, se ajusta la diferencia de dosis
        if ($oldMedicamentoId == $newMedicamentoId) {
            $difference = $oldDose - $newDose;
            $medicamento = Medicamento::find($newMedicamentoId);
            if ($medicamento) {
                // Si la diferencia es positiva, se devuelve stock; si es negativa, se descuenta más stock
                $medicamento->cantidad += $difference;
                $medicamento->save();
            }
        } else {
            // Se devuelve la dosis anterior al stock del medicamento anterior
            $oldMedicamento = Medicamento::find($oldMedicamentoId);
            if ($oldMedicamento) {
                $oldMedicamento->cantidad += $oldDose;
                $oldMedicamento->save();
            }
            // Se descuenta la nueva dosis del empleado en el nuevo medicamento
            $newMedicamento = Medicamento::find($newMedicamentoId);
            if ($newMedicamento) {
                $newMedicamento->cantidad -= $newDose;
                $newMedicamento->save();
            }
        }

        $historial->fill($request->all())->update();

        return redirect()->route('personas.index');
    }

    public function destroy(HistorialMedicamentos $historial)
    {
        $historial->delete();
        return back();
    }
}
