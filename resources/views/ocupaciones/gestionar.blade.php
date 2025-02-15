@extends('adminlte::page')

@section('title', 'Gestionar Ocupante')

@section('content_header')
    <h1>Gestionar Ocupante para la Cama: {{ $cama->identificador }}</h1>
@stop

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h3>Ocupaciones Previas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Fecha de Ocupación</th>
                    <th>Fecha de Liberación</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cama->ocupaciones as $ocupacion)
                    <tr>
                        <td>{{ $ocupacion->persona->nombres }}</td>
                        <td>{{ $ocupacion->estado }}</td>
                        <td>{{ $ocupacion->fecha_ocupacion }}</td>
                        <td>{{ $ocupacion->fecha_liberacion ?? 'No especificada' }}</td>
                        <td>
                            @if ($ocupacion->estado === 'ocupado')
                                <form action="{{ route('ocupantes.liberar', $ocupacion) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Liberar</button>
                                </form>
                            @else
                                <form action="{{ route('ocupantes.ocupar', $ocupacion) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Ocupar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Agregar Ocupante</h3>
        <form action="{{ route('ocupantes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="cama_id" value="{{ $cama->id }}">
            <div class="mb-3">
                <label for="persona_id" class="form-label">Seleccionar Persona</label>
                <select name="persona_id" id="persona_id" class="form-control" required>
                    <option value="">Seleccione una persona</option>
                    @foreach ($personas as $persona)
                        @if (!$cama->ocupaciones->pluck('persona_id')->contains($persona->id))
                            <option value="{{ $persona->id }}">{{ $persona->nombres }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="fecha_ocupacion" class="form-label">Fecha de Ocupación</label>
                <input type="date" name="fecha_ocupacion" id="fecha_ocupacion" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <a href="{{ route('dormitorios.camas', $cama->dormitorio->id) }}" class="btn btn-secondary mt-3">Volver a camas</a>
    </div>
@endsection
