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
        <input name="nombres" id="nombres" value="{{ old('nombres') ?? $proveedore->nombres }}" class="form-control"
            placeholder="Nombres completos" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/lastname.png')}}" width="15" alt=""></span>
        </div>
        <input name="apellidos" id="apellidos" value="{{ old('apellidos') ?? $proveedore->apellidos }}" class="form-control"
            placeholder="Apellidos completos" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/name.png')}}" width="15" alt=""> </span>
        </div>
        <input name="ci" id="ci" value="{{ old('ci') ?? $proveedore->ci }}" class="form-control"
            placeholder="Numero de cedula de identidad" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
        </div>
        <input name="celular" id="celular" value="{{ old('celular') ?? $proveedore->celular }}" class="form-control"
            placeholder="Numero de celular" type="tel">
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