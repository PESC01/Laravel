@extends('adminlte::page')


@section('content')
    <div class="container">
        <h1>Editar Abogado</h1>
        <form action="{{ route('abogados.update', $abogado->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ $abogado->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $abogado->email }}" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="documento">Documento:</label>
                <input type="file" name="documento" class="form-control">
                @if ($abogado->documento)
                    <img src="{{ asset('documentos/' . $abogado->documento) }}" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
