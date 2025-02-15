@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Ocupación</h1>
    <form action="{{ route('ocupaciones.update', $ocupacion) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="cama_id" class="form-label">Cama</label>
            <select name="cama_id" id="cama_id" class="form-select" required>
                @foreach ($camas as $cama)
                <option value="{{ $cama->id }}" {{ $ocupacion->cama_id == $cama->id ? 'selected' : '' }}>
                    {{ $cama->identificador }} - {{ $cama->dormitorio->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="persona_id" class="form-label">Persona</label>
            <select name="persona_id" id="persona_id" class="form-select" required>
                @foreach ($personas as $persona)
                <option value="{{ $persona->id }}" {{ $ocupacion->persona_id == $persona->id ? 'selected' : '' }}>
                    {{ $persona->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_ocupacion" class="form-label">Fecha de Ocupación</label>
            <input type="date" name="fecha_ocupacion" id="fecha_ocupacion" class="form-control" value="{{ $ocupacion->fecha_ocupacion }}" required>
        </div>
        <div class="mb-3">
            <label for="fecha_liberacion" class="form-label">Fecha de Liberación</label>
            <input type="date" name="fecha_liberacion" id="fecha_liberacion" class="form-control" value="{{ $ocupacion->fecha_liberacion }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('ocupaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
