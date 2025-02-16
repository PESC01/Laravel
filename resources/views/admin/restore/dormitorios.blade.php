@extends('adminlte::page')

@section('title', 'Restaurar Dormitorios')

@section('content')
    <div class="container">
        <h1>Dormitorios Eliminados</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($dormitorios->isEmpty())
            <p>No hay registros eliminados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha de Eliminación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dormitorios as $dormitorio)
                        <tr>
                            <td>{{ $dormitorio->id }}</td>
                            <td>{{ $dormitorio->nombre }}</td>
                            <td>{{ $dormitorio->deleted_at }}</td>
                            <td>
                                <form action="{{ route('admin.restore.dormitorio', $dormitorio->id) }}" method="POST">
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
