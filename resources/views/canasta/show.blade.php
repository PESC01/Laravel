@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Detalles de la Canasta Alimentaria para {{ $fecha }}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($canastas as $canasta)
                    <tr>
                        <td>{{ $canasta->persona->nombres }} {{ $canasta->persona->apellidos }}</td>
                        <td>{{ $canasta->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('canasta.index') }}" class="btn btn-secondary mt-3">Atrás</a>
    </div>
@endsection
