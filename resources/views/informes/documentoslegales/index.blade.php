@extends('adminlte::page')

@section('title', 'Lista de Documentos Legales')

@section('content')
    <div class="container">
        <h1>Lista de Documentos Legales</h1>
        <a class="btn btn-primary" href="{{ route('documentoslegales.create') }}">Agregar Documento Legal</a>
        <a href="{{ route('documentoslegales.pdf') }}" target="_blank" class="btn btn-danger">Generar Reporte General</a>

        <!-- Selector de Persona para Reporte Individual -->
        <form action="{{ route('documentoslegales.pdf') }}" method="GET" target="_blank">
            <div class="form-group">
                <label for="persona">Generar Reporte por Persona:</label>
                <select name="persona" id="persona" class="form-control">
                    <option value="">Todos</option>
                    @foreach ($personas as $persona)
                        <option value="{{ $persona->id }}">{{ $persona->nombres }} {{ $persona->apellidos }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-danger">Generar Reporte por Persona</button>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nombre del Documento</th>
                    <th>Descripción</th>
                    <th>Documento</th>
                    <th>Nombre de la Persona</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documentos as $documento)
                    <tr>
                        <td>{{ $documento->nombre_documento }}</td>
                        <td>{{ $documento->descripcion_documento }}</td>
                        <td>
                            @if (pathinfo($documento->imagen_documento, PATHINFO_EXTENSION) == 'pdf')
                                <a href="{{ asset('images/' . $documento->imagen_documento) }}" target="_blank">Ver PDF</a>
                            @else
                                <img src="{{ asset('images/' . $documento->imagen_documento) }}" width="100">
                            @endif
                        </td>
                        <td>{{ $documento->persona->nombres }} {{ $documento->persona->apellidos }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('documentoslegales.edit', $documento->id) }}">Editar</a>
                            <form action="{{ route('documentoslegales.destroy', $documento->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
