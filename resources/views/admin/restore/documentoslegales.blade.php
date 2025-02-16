@extends('adminlte::page')

@section('title', 'Restaurar Documentos Legales')

@section('content')
    <div class="container">
        <h1>Documentos Legales Eliminados</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($documentosLegales->isEmpty())
            <p>No hay documentos legales eliminados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Documento</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Persona</th>
                        <th>Fecha de Eliminación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentosLegales as $documentoLegal)
                        <tr>
                            <td>{{ $documentoLegal->id }}</td>
                            <td>{{ $documentoLegal->nombre_documento }}</td>
                            <td>{{ $documentoLegal->descripcion_documento }}</td>
                            <td>
                                @if ($documentoLegal->imagen_documento)
                                    <img src="{{ asset('images/' . $documentoLegal->imagen_documento) }}"
                                        alt="Imagen del documento" style="max-width: 100px; max-height: 100px;">
                                @else
                                    Sin imagen
                                @endif
                            </td>
                            <td>{{ $documentoLegal->persona->nombres }} {{ $documentoLegal->persona->apellidos }}</td>
                            <td>{{ $documentoLegal->deleted_at }}</td>
                            <td>
                                <form action="{{ route('admin.restore.documentoLegal', $documentoLegal->id) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Restaurar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
