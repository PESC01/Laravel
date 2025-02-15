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
            <span class="input-group-text"> <i class="fa fa-user"></i></span>
        </div>
        <input name="nombres" id="nombres" value="{{ old('nombres') ?? $contacto->nombres }}" class="form-control"
            placeholder="Nombres del familiar" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{ asset('images/lastname.png') }}" width="15"
                    alt=""></span>
        </div>
        <input name="apellidos" id="apellidos" value="{{ old('apellidos') ?? $contacto->apellidos }}"
            class="form-control" placeholder="Apellidos del familiar" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-map"></i></span>
        </div>
        <input name="direccion_vivienda" id="direccion_vivienda"
            value="{{ old('direccion_vivienda') ?? $contacto->direccion_vivienda }}" class="form-control"
            placeholder="Dirección de vivienda" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-phone"></i></span>
        </div>
        <input name="celular" id="celular" value="{{ old('celular') ?? $contacto->celular }}" class="form-control"
            placeholder="Dirección de vivienda" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{ asset('images/family.png') }}" width="15"
                    alt=""></span>
        </div>
        <select name="tipo_relacion" id="tipo_relacion" class="form-control">
            <option selected=""> Tipo de relacion con el paciente</option>
            @foreach ($tipos as $tipo)
                <option
                    value="{{ $tipo->id }}"{{ old('tipo_relacion', $contacto->tipo_relacion) == $tipo->id ? 'selected' : '' }}>
                    {{ $tipo->nombre }} </option>
            @endforeach
        </select>
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
