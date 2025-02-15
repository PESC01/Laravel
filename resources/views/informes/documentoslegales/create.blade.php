@extends('adminlte::page')

@section('title', 'Agregar Documento Legal')

@section('content')
    <div class="container">
        <h1>Agregar Documento Legal</h1>
        <form action="{{ route('documentoslegales.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre_documento">Nombre del Documento:</label>
                <input type="text" name="nombre_documento" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion_documento">Descripción del Documento:</label>
                <textarea name="descripcion_documento" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="imagen_documento">Documento:</label>
                <input type="file" name="imagen_documento" class="form-control" required>
            </div>
            @if ($persona)
                <input type="hidden" name="persona_id" value="{{ $persona->id }}">
            @else
                <div class="form-group">
                    <label for="persona_id">Seleccionar Paciente:</label>
                    <select name="persona_id" class="form-control" required>
                        <option value="">Seleccione un paciente</option>
                        @foreach ($personas as $persona)
                            <option value="{{ $persona->id }}">{{ $persona->nombres }} {{ $persona->apellidos }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <a href="{{ route('documentoslegales.index') }}" class="btn btn-secondary mt-3">Atrás</a>
    </div>
@endsection
