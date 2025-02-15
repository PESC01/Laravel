@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Registrar Ocupación</h1>
    <form action="{{ route('ocupaciones.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cama_id" class="form-label">Cama</label>
            <select name="cama_id" id="cama_id" class="form-select" required>
                <option value="">Seleccione una cama</option>
                @foreach ($camas as $cama)
                <option value="{{ $cama->id }}">{{ $cama->identificador }} - {{ $cama->dormitorio->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="persona_id" class="form-label">Persona</label>
            <select name="persona_id" id="persona_id" class="form-select" required>
                <option value="">Seleccione un ocupante</option>
                @foreach ($personas as $persona)
                <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_ocupacion" class="form-label">Fecha de Ocupación</label>
            <input type="date" name="fecha_ocupacion" id="fecha_ocupacion" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
        <a href="{{ route('ocupaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
