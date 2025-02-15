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

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/name.png')}}" width="15" alt=""> </span>
        </div>
        <input name="nombres" id="nombres" value="{{ old('nombres') ?? $adoptante->nombres }}" class="form-control"
            placeholder="Nombres completos dle adoptante" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/lastname.png')}}" width="15" alt=""></span>
        </div>
        <input name="apellidos" id="apellidos" value="{{ old('apellidos') ?? $adoptante->apellidos }}" class="form-control"
            placeholder="Apellidos completos del adoptante" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/whatsapp.png')}}" width="15" alt=""> </span>
        </div>
        <input name="celular" id="celular" value="{{ old('celular') ?? $adoptante->celular }}" class="form-control"
            placeholder="Nro de celular" type="phone">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/name.png')}}" width="15" alt=""> </span>
        </div>
        <input name="domicilio" id="domicilio" value="{{ old('domicilio') ?? $adoptante->domicilio }}" class="form-control"
            placeholder="Dirección de domicilio" type="text">
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