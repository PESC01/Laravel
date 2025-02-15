{{--  POSIBLE A ELIMINAR --}}

@extends('adminlte::page')
@section('content')
    <div class="container">
        <h1>Lista de Camas</h1>
        <a href="{{ route('camas.create') }}" class="btn btn-primary mb-3">Agregar Cama</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Identificadora</th>
                    <th>Dormitorio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($camas as $cama)
                    <tr>
                        <td>{{ $cama->identificador }}</td>
                        <td>{{ $cama->dormitorio->nombre }}</td>
                        <td>
                            <a href="{{ route('camas.ocupante', $cama) }}" class="btn btn-info btn-sm">Ver ocupante</a>
                            <a href="{{ route('camas.edit', $cama) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('camas.destroy', $cama) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('dormitorios.index') }}" class="btn btn-secondary">Volver a dormitorios</a>
    @endsection
