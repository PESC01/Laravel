@extends('adminlte::page')

@section('title', 'Camas del Dormitorio')

@section('content_header')
    <h1>Camas del Dormitorio: {{ $dormitorio->nombre }}</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{ route('camas.create', ['dormitorio_id' => $dormitorio->id]) }}" class="btn btn-primary mb-3">Agregar
            Cama</a>
        <a href="{{ route('dormitorios.pdf', $dormitorio) }}" target="_blank" class="btn btn-danger mb-3">Generar PDF</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Identificador</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($camas as $cama)
                    <tr>
                        <td>{{ $cama->identificador }}</td>
                        <td>{{ $cama->ocupaciones->where('estado', 'ocupado')->isNotEmpty() ? 'Ocupada' : 'Libre' }}</td>
                        <td>
                            <a href="{{ route('camas.edit', $cama) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('camas.destroy', $cama) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar esta cama?')">Eliminar</button>
                            </form>
                            <a href="{{ route('camas.gestionarOcupante', $cama) }}" class="btn btn-info btn-sm">
                                Gestionar Ocupante
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('dormitorios.index', $dormitorio->id) }}" class="btn btn-secondary mt-3">Volver a dormitorios</a>
    </div>
@endsection
