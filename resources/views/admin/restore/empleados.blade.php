@extends('adminlte::page')

@section('title', 'Restaurar Empleados')

@section('content')
    <div class="container">
        <h1>Empleados Eliminados</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($empleados->isEmpty())
            <p>No hay empleados eliminados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Celular</th>
                        <th>Email</th>
                        <th>Fecha de Eliminación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->nombres }}</td>
                            <td>{{ $empleado->apellidos }}</td>
                            <td>{{ $empleado->celular }}</td>
                            <td>
                                @if ($empleado->user)
                                    {{ $empleado->user->email }}
                                @else
                                    Sin usuario asociado
                                @endif
                            </td>
                            <td>{{ $empleado->deleted_at }}</td>
                            <td>
                                <form action="{{ route('admin.restore.empleado', $empleado->id) }}" method="POST">
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
