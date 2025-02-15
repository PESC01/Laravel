@extends('adminlte::page')

@section('title', 'Editar Documento Legal')

@section('content')
    <div class="container">
        <h1>Editar Documento Legal</h1>
        <form action="{{ route('documentoslegales.update', $documentoslegale->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre_documento">Nombre del Documento:</label>
                <input type="text" name="nombre_documento" class="form-control"
                    value="{{ $documentoslegale->nombre_documento }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion_documento">Descripción del Documento:</label>
                <textarea name="descripcion_documento" class="form-control" required>{{ $documentoslegale->descripcion_documento }}</textarea>
            </div>
            <div class="form-group">
                <label for="imagen_documento">Documento:</label>
                <input type="file" name="imagen_documento" class="form-control">
                @if ($documentoslegale->imagen_documento)
                    <img src="{{ asset('images/' . $documentoslegale->imagen_documento) }}" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
        <a href="{{ route('documentoslegales.index') }}" class="btn btn-secondary mt-3">Atrás</a>
    </div>
@endsection
