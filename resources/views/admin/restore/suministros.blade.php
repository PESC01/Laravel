@extends('adminlte::page')

@section('title', 'Restaurar Suministros')

@section('content')
    <div class="container">
        <h1>Suministros Eliminados</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($suministros->isEmpty())
            <p>No hay registros eliminados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Tipo</th>
                        <th>Proveedor</th>
                        <th>Fecha de Eliminación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suministros as $suministro)
                        <tr>
                            <td>{{ $suministro->id }}</td>
                            <td>{{ $suministro->nombre }}</td>
                            <td>{{ $suministro->descripcion }}</td>
                            <td>{{ $suministro->cantidad }}</td>
                            <td>{{ $suministro->tipo }}</td>
                            <td>{{ $suministro->proveedor }}</td>
                            <td>{{ $suministro->deleted_at }}</td>
                            <td>
                                <form action="{{ route('admin.restore.suministro', $suministro->id) }}" method="POST">
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
