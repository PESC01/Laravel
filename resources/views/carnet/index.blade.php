@extends('adminlte::page')

@section('title', 'Buscar por carnet de identidad')

@section('content')
    <div class="container">
        <h1>Buscar Paciente por Carnet de Identidad</h1>
        <form action="{{ route('carnet.search') }}" method="GET">
            <div class="form-group">
                <label for="carnet">Carnet de Identidad:</label>
                <input type="text" id="carnet" name="carnet" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
@endsection
