@extends('adminlte::page')

@section('title', 'Suministrar Medicamento')

@section('content')
    <div class="container mt-4">
        <h1>Suministrar: {{ $medicamento->nombre_medicamento }}</h1>
        <form action="{{ route('medicamentos.suministrarStore', ['medicamento' => $medicamento]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cantidad_suministro">Cantidad a suministrar:</label>
                <input type="number" name="cantidad_suministro" id="cantidad_suministro" min="1" class="form-control"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar suministro</button>
        </form>
    </div>
@endsection
