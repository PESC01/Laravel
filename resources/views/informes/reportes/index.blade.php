@extends('adminlte::page')

@section('title', 'Lista de Informes')

@section('content')
    <div class="container">
        <h1>Lista de Informes</h1>
        <a href="{{ route('informes.create') }}" class="btn btn-success mb-3">Crear Nuevo Informe</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Persona</th>
                    <th>Título</th>
                    <th>Contenido</th>

                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($informes as $informe)
                    <tr>
                        <td>{{ $informe->id }}</td>
                        <td>{{ $informe->persona->nombres }} {{ $informe->persona->apellidos }}</td>
                        <td>{{ $informe->titulo }}</td>
                        <td>{{ $informe->contenido }}</td>

                        <td>
                            <a href="{{ route('informes.show', $informe->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('informes.generatePdf', $informe->id) }}"
                                class="btn btn-primary btn-sm">Descargar PDF</a>
                            <form action="{{ route('informes.destroy', $informe->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar el informe?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
