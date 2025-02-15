@extends('adminlte::page')  

@section('content')
<div class="container">
    <h1>Lista de Ocupaciones</h1>
    <a href="{{ route('ocupaciones.create') }}" class="btn btn-primary mb-3">Registrar Ocupación</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cama</th>
                <th>Dormitorio</th>
                <th>Fecha de Ocupación</th>
                <th>Fecha de Liberación</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ocupaciones as $ocupacion)
            <tr>
                <td>{{ $ocupacion->cama->identificador }}</td>
                <td>{{ $ocupacion->cama->dormitorio->nombre }}</td>
                <td>{{ $ocupacion->fecha_ocupacion }}</td>
                <td>{{ $ocupacion->fecha_liberacion ?? 'N/A' }}</td>
                <td>{{ ucfirst($ocupacion->estado) }}</td>
                <td>
                    <a href="{{ route('ocupaciones.edit', $ocupacion) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('ocupaciones.destroy', $ocupacion) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta ocupación?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
