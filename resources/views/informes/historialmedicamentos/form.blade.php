<div class="w-full max-w-lg">
    <div class="flex flex-wrap">
        <h1 class="mb-5">{{ $title }}</h1>
    </div>
</div>

<form class="w-full max-w-lg" method="POST" action="{{ $route }}" enctype="multipart/form-data">
    @csrf
    @isset($update)
        @method('PUT')
    @endisset

    @if ($update == null)
        <input type="hidden" name="persona" value="{{ $persona }}">
    @endif

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <select name="medicamentos" id="medicamentos" class="form-control"
            {{ isset($update) ? 'disabled' : 'required' }}>
            <option value="">Seleccione un medicamento</option>
            @foreach ($medicamentos as $medicamento)
                <option value="{{ $medicamento->id }}"
                    {{ old('medicamentos', $historial->medicamentos) == $medicamento->id ? 'selected' : '' }}>
                    {{ $medicamento->nombre_medicamento }}
                </option>
            @endforeach
        </select>
        @if (isset($update))
            <!-- En modo edición, enviamos el medicamento actual mediante un input hidden -->
            <input type="hidden" name="medicamentos" value="{{ old('medicamentos', $historial->medicamentos) }}">
        @endif
        @if (!isset($update))
            <small>
                ¿No encuentra el medicamento?
                <a href="{{ route('medicamentos.create') }}">Agregar</a> |
                <a href="{{ route('medicamentos.index') }}">Editar</a>
            </small>
        @endif
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{ asset('images/tipos.png') }}" width="15" alt="">
            </span>
        </div>
        <input name="medicamentos_anteriores_recetados" id="medicamentos_anteriores_recetados"
            value="{{ old('medicamentos_anteriores_recetados') ?? $historial->medicamentos_anteriores_recetados }}"
            class="form-control" type="text" placeholder="Descripción de la receta">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <input name="dosis_duracion_medicacion" id="dosis_duracion_medicacion"
            value="{{ old('dosis_duracion_medicacion') ?? $historial->dosis_duracion_medicacion }}"
            class="form-control" placeholder="Cantidad de dosis y duracion de medicacíon" type="text">
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block" type="submit">
            {{ $textButton }}
        </button>
    </div>
</form>

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

@stop
