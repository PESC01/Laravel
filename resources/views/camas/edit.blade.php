@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Cama</h1>
    <form action="{{ route('camas.update', $cama) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="dormitorio_id" class="form-label">Dormitorio</label>
            <select name="dormitorio_id" id="dormitorio_id" class="form-select" required>
                @foreach ($dormitorios as $dormitorio)
                <option value="{{ $dormitorio->id }}" {{ $cama->dormitorio_id == $dormitorio->id ? 'selected' : '' }}>
                    {{ $dormitorio->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="identificador" class="form-label">Identificador</label>
            <input type="text" name="identificador" id="identificador" class="form-control" value="{{ $cama->identificador }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('dormitorios.camas', $cama->dormitorio_id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
