@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Crear Nueva Lista de Canasta Alimentaria</h1>
        <form action="{{ route('canasta.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="personas">Personas</label>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personas as $persona)
                            <tr>
                                <td>{{ $persona->nombres }} {{ $persona->apellidos }}</td>
                                <td>
                                    <select name="personas[{{ $persona->id }}][estado]" class="form-control" required>
                                        <option value="entregado">Entregado</option>
                                        <option value="no entregado">No Entregado</option>
                                    </select>
                                    <input type="hidden" name="personas[{{ $persona->id }}][id]"
                                        value="{{ $persona->id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Crear</button>
        </form>
    </div>
@endsection
