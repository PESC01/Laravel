<?php

namespace App\Http\Controllers;

use App\Models\Abogado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AbogadoController extends Controller
{
    public function index()
    {
        $abogados = Abogado::all();
        return view('abogados.index', compact('abogados'));
    }

    public function create()
    {
        return view('abogados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:abogados',
            'password' => 'required|min:8',
            'documento' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if ($documento = $request->file('documento')) {
            $destinationPath = 'documentos/';
            $documentoImage = date('YmdHis') . "." . $documento->getClientOriginalExtension();
            $documento->move($destinationPath, $documentoImage);
            $input['documento'] = "$documentoImage";
        }

        Abogado::create($input);

        return redirect()->route('abogados.index');
    }

    public function edit(Abogado $abogado)
    {
        return view('abogados.edit', compact('abogado'));
    }

    public function update(Request $request, Abogado $abogado)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:abogados,email,' . $abogado->id,
            'password' => 'nullable|min:8',
            'documento' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        if ($request->filled('password')) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input['password'] = $abogado->password;
        }

        if ($documento = $request->file('documento')) {
            $destinationPath = 'documentos/';
            $documentoImage = date('YmdHis') . "." . $documento->getClientOriginalExtension();
            $documento->move($destinationPath, $documentoImage);
            $input['documento'] = "$documentoImage";
        } else {
            $input['documento'] = $abogado->documento;
        }

        $abogado->update($input);

        return redirect()->route('abogados.index');
    }

    public function destroy(Abogado $abogado)
    {
        $abogado->delete();
        return back();
    }
}
