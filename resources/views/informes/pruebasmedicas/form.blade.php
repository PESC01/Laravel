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
            <span class="input-group-text"> <img src="{{asset('images/calendar.png')}}" width="15" alt=""> </span>
        </div>
        <input name="fecha_prueba_medica" id="fecha_prueba_medica"
            value="{{ old('fecha_prueba_medica') ?? $prueba->fecha_prueba_medica }}" class="form-control"
            type="date" >
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <input name="descripcion_prueba_medica" id="descripcion_prueba_medica"
            value="{{ old('descripcion_prueba_medica') ?? $prueba->descripcion_prueba_medica }}" class="form-control"
            placeholder="Descripción de preubas médicas" type="text">
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
