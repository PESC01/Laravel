@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Cama: {{ $cama->identificador }}</h1>
        <p><strong>Dormitorio:</strong> {{ $cama->dormitorio->nombre }}</p>

        @if ($ocupacion)
            <div class="alert alert-success">
                <h4>Ocupante actual</h4>
                <p><strong>Nombre:</strong> {{ $ocupacion->persona->nombres }}</p>
                <p><strong>Fecha de ocupación:</strong> {{ $ocupacion->fecha_ocupacion }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($ocupacion->estado) }}</p>
                <form action="{{ route('camas.liberar', $cama) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Liberar cama</button>
                </form>
            </div>
        @else
            <div class="alert alert-warning">
                <p>Esta cama está actualmente libre.</p>
                <a href="{{ route('camas.gestionarOcupante', $cama) }}" class="btn btn-primary">Asignar ocupante</a>
            </div>
        @endif

        <a href="{{ route('dormitorios.camas', $cama->dormitorio_id) }}" class="btn btn-secondary mt-3">Volver a las
            camas</a>
    </div>
@endsection
