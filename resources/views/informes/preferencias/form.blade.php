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
        <input name="preferencias_alimenticias" id="preferencias_alimenticias"
            value="{{ old('preferencias_alimenticias') ?? $preferencia->preferencias_alimenticias }}" class="form-control"
            placeholder="Descripción de preferencias alimenticias" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/name.png')}}" width="15" alt=""> </span>
        </div>
        <input name="preferencias_habitacion" id="preferencias_habitacion"
            value="{{ old('preferencias_habitacion') ?? $preferencia->preferencias_habitacion }}" class="form-control"
            type="text" placeholder="Preferencias de habitación" >
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/name.png')}}" width="15" alt=""> </span>
        </div>
        <input name="necesidades_especiales" id="necesidades_especiales"
            value="{{ old('necesidades_especiales') ?? $preferencia->necesidades_especiales }}" class="form-control"
            type="text" placeholder="Necesidades especiales">
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
