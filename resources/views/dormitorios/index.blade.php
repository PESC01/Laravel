@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Lista de Dormitorios</h1>
        <a href="{{ route('dormitorios.create') }}" class="btn btn-primary mb-3">Agregar Dormitorio</a>
        <a href="{{ route('pdf.dormitorios_camas') }}" target="_blank" class="btn btn-danger mb-3">Descargar Informe PDF</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dormitorios as $dormitorio)
                    <tr>
                        <td>{{ $dormitorio->nombre }}</td>
                        <td>{{ $dormitorio->capacidad }}</td>
                        <td>{{ $dormitorio->descripcion }}</td>
                        <td>
                            <a href="{{ route('dormitorios.edit', $dormitorio) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('dormitorios.destroy', $dormitorio) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar este dormitorio?')">Eliminar</button>
                            </form>
                            <a href="{{ route('dormitorios.camas', $dormitorio) }}" class="btn btn-info btn-sm">Ver
                                Camas</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
