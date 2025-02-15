<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Informe;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $totalPersonas = Persona::count();
        $personas = Persona::orderBy('fech_registro', 'desc')->take(2)->get();
        $empleados = Empleado::get();
        $totalInformes = Informe::count();

        $users = Persona::select(
            DB::raw('COUNT(*) as count'),
            DB::raw('DATE(fech_registro) as date') // Cambiar a DATE para obtener la fecha completa
        )
            ->groupBy(DB::raw('DATE(fech_registro)')) // Agrupar por la fecha completa
            ->get();

        $days = $users->pluck('date'); // Obtener las fechas completas
        $counts = $users->pluck('count');

        $generos = DB::table('personas')
            ->whereNull('deleted_at')
            ->select('genero', DB::raw('count(*) as total'))
            ->groupBy('genero')
            ->get();

        $genero = $generos->pluck('genero');
        $total = $generos->pluck('total');

        // Obtener la cantidad de empleados por rol
        $rolesCount = [];
        foreach (Role::all() as $role) {
            $count = DB::table('users')
                ->join('empleados', 'users.id', '=', 'empleados.user_id')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->whereNull('empleados.deleted_at') // Excluir empleados softdeleted
                ->where('model_has_roles.role_id', $role->id)
                ->count();

            if ($count > 0) {
                $rolesCount[$role->name] = $count;
            }
        }
        $motivosIngreso = Persona::select('motivo_ingreso', DB::raw('count(*) as total'))
            ->groupBy('motivo_ingreso')
            ->get();

        $motivos = $motivosIngreso->pluck('motivo_ingreso');
        $totalesMotivos = $motivosIngreso->pluck('total');

        return view('home', compact('totalPersonas', 'personas', 'empleados', 'days', 'counts', 'genero', 'total', 'rolesCount', 'motivos', 'totalesMotivos', 'totalInformes'));
    }
}
