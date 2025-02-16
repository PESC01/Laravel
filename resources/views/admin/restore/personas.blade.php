<!-- filepath: /c:/xampp/htdocs/esther-app/resources/views/admin/restore/personas.blade.php -->
@extends('adminlte::page')

@section('title', 'Restaurar Personas')

@section('content')
    <div class="container">
        <h1>Pacientes Eliminados</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($personas->isEmpty())
            <p>No hay registros eliminados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Fecha de Eliminación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personas as $persona)
                        <tr>
                            <td>{{ $persona->id }}</td>
                            <td>{{ $persona->nombres }}</td>
                            <td>{{ $persona->apellidos }}</td>
                            <td>{{ $persona->deleted_at }}</td>
                            <td>
                                <form action="{{ route('admin.restore.persona', $persona->id) }}" method="POST">
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
