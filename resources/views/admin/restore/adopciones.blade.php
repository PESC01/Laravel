@extends('adminlte::page')

@section('title', 'Restaurar Adopciones')

@section('content')
    <div class="container">
        <h1>Adopciones Eliminadas</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($adopciones->isEmpty())
            <p>No hay registros eliminados.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Adoptante</th>
                        <th>Persona</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Fecha de Eliminación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adopciones as $adopcion)
                        <tr>
                            <td>{{ $adopcion->id }}</td>
                            <td>{{ $adopcion->fecha }}</td>
                            <td>
                                @php
                                    $adoptante = App\Models\Adoptante::find($adopcion->adoptante);
                                    echo $adoptante ? $adoptante->nombres . ' ' . $adoptante->apellidos : 'N/A';
                                @endphp
                            </td>
                            <td>
                                @php
                                    $persona = App\Models\Persona::find($adopcion->persona);
                                    echo $persona ? $persona->nombres . ' ' . $persona->apellidos : 'N/A';
                                @endphp
                            </td>
                            <td>{{ $adopcion->motivo }}</td>
                            <td>{{ $adopcion->estado }}</td>
                            <td>{{ $adopcion->observaciones }}</td>
                            <td>{{ $adopcion->deleted_at }}</td>
                            <td>
                                <form action="{{ route('admin.restore.adopcion', $adopcion->id) }}" method="POST">
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
