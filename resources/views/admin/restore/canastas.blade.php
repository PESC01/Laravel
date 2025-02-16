@extends('adminlte::page')

@section('title', 'Restaurar Canastas')

@section('content')
    <div class="container">
        <h1>Canastas Eliminadas</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($canastas->isEmpty())
            <p>No hay registros eliminados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($canastas as $canasta)
                        <tr>
                            <td>{{ $canasta->fecha }}</td>
                            <td>
                                <form action="{{ route('admin.restore.canasta', $canasta->fecha) }}" method="POST">
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
