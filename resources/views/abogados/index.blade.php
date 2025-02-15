@extends('adminlte::page')

@section('title', 'Lista de Abogados')

@section('content')
    <div class="container">
        <h1>Lista de Abogados</h1>
        <a class="btn btn-primary" href="{{ route('abogados.create') }}">Agregar Abogado</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Documento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($abogados as $abogado)
                    <tr>
                        <td>{{ $abogado->nombre }}</td>
                        <td>{{ $abogado->email }}</td>
                        <td>
                            @if ($abogado->documento)
                                <img src="{{ asset('documentos/' . $abogado->documento) }}" width="100">
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('abogados.edit', $abogado->id) }}">Editar</a>
                            <form action="{{ route('abogados.destroy', $abogado->id) }}" method="POST"
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
