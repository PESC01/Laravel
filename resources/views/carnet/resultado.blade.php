@extends('adminlte::page')

@section('title', 'Resultado de la búsqueda')

@section('content')
    <div class="container">
        <h1>Resultado</h1>
        @if (isset($persona))
            <p>{{ $message }}</p>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nombre:</strong> {{ $persona->nombres }} {{ $persona->apellidos }}</li>
                <li class="list-group-item"><strong>Carnet:</strong> {{ $persona->ci }}</li>
                <li class="list-group-item"><strong>Fecha de Registro:</strong>
                    {{ \Carbon\Carbon::parse($persona->fech_registro)->format('d/m/Y') }}</li>
            </ul>
        @else
            <p class="text-danger">{{ $message }}</p>
        @endif
        <div class="mt-3">
            <a href="{{ route('carnet.index') }}" class="btn btn-primary">Volver a buscar</a>
        </div>
    </div>
@endsection
