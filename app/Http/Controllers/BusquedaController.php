<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BusquedaController extends Controller
{

    public function searchByVoice(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos o en donde almacenes los pacientes
        $results = Persona::where('nombres', 'like', "%$query%")->get();

        return response()->json($results);
    }

    public function mostrarData()
    {

        $nombrePalabras = Persona::orderBy('id', 'DESC')->get();
        return response()->json($nombrePalabras);
    }

    public function url()
    {
        return view('palabras.addPalabra');
    }
    public function index()
    {
        return view('busqueda.busqueda');
    }
    public function buscarpalabra(Request $request)
    {

        if ($request->ajax()) {

            $palabra = $request->speechToText;
            $searchpalabra = Persona::query()
                ->where('id', 'LIKE', "%{$palabra}%")
                ->orWhere('speechToText', 'LIKE', "%{$palabra}%")
                ->get();

            return response()->json($searchpalabra);
        }
    }
    public function vozData(Request $request)
    {
        //$products=DB::table('products')->where('title','LIKE','%'.$request->search."%")->get();

        if ($request->ajax()) {
            $Palabra = new Persona();

            $Palabra->speechToText  = $request->speechToText;
            $Palabra->created_at  =  Carbon::now();

            $Palabra->save();

            /****CONSULTAR REGISTROS***/
            $nombrePalabras = Persona::orderBy('id', 'DESC')->get();
            return response()->json($nombrePalabras);
            //return response()->json($nombrePalabras->toArray());

            /*  $nombrePalabras = NombrePaises::all();
    return response()->json($nombrePalabras); */


            /* return response()->json([
        'totalpalabras'=> $nombrePalabras
    ]); */
        }
    }
}
