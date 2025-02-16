@extends('adminlte::page')

@section('title', 'Restaurar Proveedores')

@section('content')
    <div class="container">
        <h1>Proveedores Eliminados</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($proveedores->isEmpty())
            <p>No hay proveedores eliminados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>CI</th>
                        <th>Celular</th>
                        <th>Fecha de Eliminación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <td>{{ $proveedor->id }}</td>
                            <td>{{ $proveedor->nombres }}</td>
                            <td>{{ $proveedor->apellidos }}</td>
                            <td>{{ $proveedor->ci }}</td>
                            <td>{{ $proveedor->celular }}</td>
                            <td>{{ $proveedor->deleted_at }}</td>
                            <td>
                                <form action="{{ route('admin.restore.proveedor', $proveedor->id) }}" method="POST">
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
