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
            <span class="input-group-text"> <img src="{{asset('images/tipos.png')}}" width="15" alt=""> </span>
        </div>
        <input name="nombre" id="nombre" value="{{ old('nombre') ?? $tiposuministro->nombre }}" class="form-control"
            placeholder="Nombre del tipo de suministro" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <input name="descripcion" id="descripcion" value="{{ old('descripcion') ?? $tiposuministro->descripcion }}" class="form-control"
            placeholder="Descripción del tipo de medicamento" type="text">
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