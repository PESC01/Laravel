@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Canasta Alimentaria</h1>
        <a href="{{ route('canasta.create') }}" class="btn btn-primary">Crear Nueva Lista</a>
        <a href="{{ route('canasta.pdf') }}" target="_blank" class="btn btn-danger ml-2">
            Generar Reporte
        </a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fechas as $fecha)
                    <tr>
                        <td>{{ $fecha->fecha }}</td>
                        <td>
                            <a href="{{ route('canasta.show', $fecha->fecha) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('canasta.edit', $fecha->fecha) }}" class="btn btn-warning">Editar</a>

                            <form action="{{ route('canasta.destroy', $fecha->fecha) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar esta lista?')">Eliminar</button>
                            </form>
                            <a href="{{ route('canasta.pdfFecha', $fecha->fecha) }}" target="_blank"
                                class="btn btn-danger ml-2">
                                Reporte por Fecha
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
