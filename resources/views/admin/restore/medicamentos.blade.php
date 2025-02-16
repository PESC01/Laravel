@extends('adminlte::page')

@section('title', 'Restaurar Medicamentos')

@section('content')
    <div class="container">
        <h1>Medicamentos Eliminados</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($medicamentos->isEmpty())
            <p>No hay registros eliminados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Medicamento</th>
                        <th>Fecha de Eliminación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medicamentos as $medicamento)
                        <tr>
                            <td>{{ $medicamento->id }}</td>
                            <td>{{ $medicamento->nombre_medicamento }}</td>
                            <td>{{ $medicamento->deleted_at }}</td>
                            <td>
                                <form action="{{ route('admin.restore.medicamento', $medicamento->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Restaurar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
