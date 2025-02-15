@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2>Editar Dormitorio</h2>
        <a class="btn btn-primary mb-3" href="{{ route('dormitorios.index') }}">Volver</a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Error!</strong> Hay algunos problemas con los datos ingresados.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dormitorios.update', $dormitorio->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="{{ $dormitorio->nombre }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="capacidad">Capacidad:</label>
                <input type="number" name="capacidad" value="{{ $dormitorio->capacidad }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" class="form-control">{{ $dormitorio->descripcion }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Guardar cambios</button>
        </form>
    </div>
@endsection
