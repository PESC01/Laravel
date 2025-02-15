@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Editar Lista de Canasta Alimentaria para {{ $fecha }}</h1>
        <form action="{{ route('canasta.update', $fecha) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" class="form-control" value="{{ $fecha }}" disabled>
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
                            @php
                                $canasta = $canastas->firstWhere('persona_id', $persona->id);
                            @endphp
                            <tr>
                                <td>{{ $persona->nombres }} {{ $persona->apellidos }}</td>
                                <td>
                                    <select name="personas[{{ $persona->id }}][estado]" class="form-control" required>
                                        <option value="entregado"
                                            {{ $canasta && $canasta->estado == 'entregado' ? 'selected' : '' }}>Entregado
                                        </option>
                                        <option value="no entregado"
                                            {{ $canasta && $canasta->estado == 'no entregado' ? 'selected' : '' }}>No
                                            Entregado</option>
                                    </select>
                                    <input type="hidden" name="personas[{{ $persona->id }}][id]"
                                        value="{{ $persona->id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        </form>
        <a href="{{ route('canasta.index') }}" class="btn btn-secondary mt-3">Atrás</a>
    </div>
@endsection
