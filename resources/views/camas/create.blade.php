@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Agregar Cama</h1>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('camas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="dormitorio_id" class="form-label">Dormitorio</label>
                <select name="dormitorio_id" id="dormitorio_id" class="form-select" required>
                    <option value="">Seleccione un dormitorio</option>
                    @foreach ($dormitorios as $dormitorio)
                        <option value="{{ $dormitorio->id }}"
                            {{ request('dormitorio_id') == $dormitorio->id ? 'selected' : '' }}>
                            {{ $dormitorio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="identificador" class="form-label">Identificador</label>
                <input type="text" name="identificador" id="identificador" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('dormitorios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
