<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedico;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class HistorialMedicoController extends Controller
{
    
    public function buscar(Request $request)
{   
    //GRAFICOS PORCENTUALES
    $generoStats = [
        'Masculino' => Persona::where('genero', 'Masculino')->count(),
        'Femenino' => Persona::where('genero', 'Femenino')->count(),
    ];

    //BUSQUEDA FILTROS
    $query = Persona::query();

    // Filtro por nombre
    $nombre = $request->input('nombre');

    

    if ($nombre) {
        $query->where('nombres', 'like', "%$nombre%");
    }

    // Filtro por género
    $genero = $request->input('genero');
    if ($genero) {
        $query->where('genero', $genero);
    }

    // Filtro por ingreso
    $llegada = $request->input('llegada');
    if($llegada)
    {
        $query->orderBy('id', $llegada);
    }

    $fechaIngreso = $request->input('fecha_ingreso');

    if ($fechaIngreso) {
        
        if (strpos($fechaIngreso, 'to') !== false) {
            
            [$fechaInicio, $fechaFin] = explode('to', $fechaIngreso);
    
            // Utilizar las fechas en la consulta sin manipular el formato
            $query->whereBetween('fech_registro', [$fechaInicio, $fechaFin]);
        }
    }
    // Ordenar por fecha de ingreso de más reciente a más antiguo
    $query->orderBy('fech_registro', 'desc');

    $pacientesEncontrados = $query->get();

    // Devolver solo la vista de resultados si la solicitud es AJAX
    if ($request->ajax()) {
        return View::make('historial.resultados', [
            'resultados' => $pacientesEncontrados, 
            'generoStats'=> $generoStats,
            
        ]);
    }

    // Si no es una solicitud AJAX, cargar la vista completa
    return view('historial.show', [
        "resultados" => $pacientesEncontrados,
        "generoStats"=> $generoStats,
    ]);
}



    public function index()
    {
        $pacientes = Persona::orderBy('created_at', 'desc')->take(5)->get();
        return view('historial.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HistorialMedico $historialMedico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistorialMedico $historialMedico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistorialMedico $historialMedico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistorialMedico $historialMedico)
    {
        //
    }
}
