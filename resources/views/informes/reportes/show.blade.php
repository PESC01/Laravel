@extends('adminlte::page')

@section('title', 'Ver Informe')

@section('content')
    <div class="container">
        <h1>Detalles del Informe</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Título: {{ $informe->titulo }}</h5>
                <p class="card-text">Persona: {{ $informe->persona->nombres }} {{ $informe->persona->apellidos }}</p>
                <p class="card-text">Contenido: {!! $informe->contenido !!}</p>
                @if ($informe->pdf_path)
                    <a href="{{ route('informes.generatePdf', $informe->id) }}" class="btn btn-primary btn-sm">Ver PDF</a>
                @else
                    <p>No hay PDF disponible.</p>
                @endif
                @if (auth()->user()->hasRole('Administrador'))
                    <a href="{{ route('personas.index') }}" class="btn btn-secondary">Volver</a>
                @else
                    <a href="{{ route('informes.index') }}" class="btn btn-secondary">Volver</a>
                @endif
            </div>
        </div>
    </div>
@endsection
