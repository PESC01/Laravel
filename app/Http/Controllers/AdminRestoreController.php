<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use App\Models\Dormitorio;
use App\Models\Persona;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Adopcion;
use App\Models\Canasta;
use App\Models\Suministro;
use App\Models\Proveedor;
use App\Models\Empleado;
use App\Models\DocumentoLegal;


class AdminRestoreController extends Controller
{
    // Muestra los registros eliminados (solo soft deleted)
    public function trashedMedicamentos()
    {
        $medicamentos = Medicamento::onlyTrashed()->get();
        return view('admin.restore.medicamentos', compact('medicamentos'));
    }

    // Restaura un registro dado su id
    public function restoreMedicamento($id)
    {
        $medicamento = Medicamento::onlyTrashed()->findOrFail($id);
        $medicamento->restore();

        return redirect()->back()->with('success', 'Registro restaurado exitosamente.');
    }

    // Muestra los registros eliminados (solo soft deleted) de dormitorios
    public function trashedDormitorios()
    {
        $dormitorios = Dormitorio::onlyTrashed()->get();
        return view('admin.restore.dormitorios', compact('dormitorios'));
    }

    // Restaura un registro de dormitorio dado su id
    public function restoreDormitorio($id)
    {
        $dormitorio = Dormitorio::onlyTrashed()->findOrFail($id);
        $dormitorio->restore();

        return redirect()->back()->with('success', 'Registro restaurado exitosamente.');
    }
    public function trashedPersonas()
    {
        $personas = Persona::onlyTrashed()->get();
        return view('admin.restore.personas', compact('personas'));
    }

    // Restaura un registro de persona dado su id
    public function restorePersona($id)
    {
        $persona = Persona::onlyTrashed()->findOrFail($id);
        $persona->restore();

        return redirect()->back()->with('success', 'Registro restaurado exitosamente.');
    }
    public function trashedUsers()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.restore.users', compact('users'));
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->back()->with('success', 'Registro restaurado exitosamente.');
    }
    public function trashedAdopciones()
    {
        $adopciones = Adopcion::onlyTrashed()->get();
        return view('admin.restore.adopciones', compact('adopciones'));
    }

    public function restoreAdopcion($id)
    {
        $adopcion = Adopcion::onlyTrashed()->findOrFail($id);
        $adopcion->restore();

        return redirect()->back()->with('success', 'Registro restaurado exitosamente.');
    }


    public function trashedCanastas()
    {
        $canastas = Canasta::onlyTrashed()->select('fecha')->distinct()->get();
        return view('admin.restore.canastas', compact('canastas'));
    }

    public function restoreCanasta($fecha)
    {
        Canasta::where('fecha', $fecha)->onlyTrashed()->restore();

        return redirect()->back()->with('success', 'Registro restaurado exitosamente.');
    }
    public function trashedSuministros()
    {
        $suministros = Suministro::onlyTrashed()->get();
        return view('admin.restore.suministros', compact('suministros'));
    }

    public function restoreSuministro($id)
    {
        $suministro = Suministro::onlyTrashed()->findOrFail($id);
        $suministro->restore();

        return redirect()->back()->with('success', 'Suministro restaurado exitosamente.');
    }
    public function trashedProveedores()
    {
        $proveedores = Proveedor::onlyTrashed()->get();
        return view('admin.restore.proveedores', compact('proveedores'));
    }

    public function restoreProveedor($id)
    {
        $proveedor = Proveedor::onlyTrashed()->findOrFail($id);
        $proveedor->restore();

        return redirect()->back()->with('success', 'Proveedor restaurado exitosamente.');
    }
    public function trashedEmpleados()
    {
        $empleados = Empleado::onlyTrashed()->get();
        return view('admin.restore.empleados', compact('empleados'));
    }

    public function restoreEmpleado($id)
    {
        $empleado = Empleado::onlyTrashed()->findOrFail($id);

        // Restaurar el usuario asociado si existe y no ha sido restaurado
        $user = User::withTrashed()->find($empleado->user_id);

        if ($user) {
            if ($user->trashed()) {
                $user->restore();
            }
        }

        $empleado->restore();

        return redirect()->back()->with('success', 'Empleado restaurado exitosamente.');
    }
    public function trashedDocumentosLegales()
    {
        $documentosLegales = DocumentoLegal::onlyTrashed()->get();
        return view('admin.restore.documentoslegales', compact('documentosLegales'));
    }

    public function restoreDocumentoLegal($id)
    {
        $documentoLegal = DocumentoLegal::onlyTrashed()->findOrFail($id);
        $documentoLegal->restore();

        return redirect()->back()->with('success', 'Documento Legal restaurado exitosamente.');
    }
}
