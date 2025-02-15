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
            <span class="input-group-text"> <img src="{{asset('images/calendar.png')}}" width="15" alt=""> </span>
        </div>
        <input name="fecha" id="fecha" value="{{ old('fecha') ?? $adopcione->fecha }}" class="form-control"
            placeholder="" type="date">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <select name="adoptante" id="adoptante" class="form-control">
            <option selected=""> Nombre del adoptante</option>
            @foreach ($adoptantes as $adoptante)
                <option
                    value="{{ $adoptante->id }}"{{ old('adoptante', $adopcione->adoptante) == $adoptante->id ? 'selected' : '' }}>
                    {{ $adoptante->nombres }} {{$adoptante->apellidos}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <select name="persona" id="persona" class="form-control">
            <option selected=""> Nombre del paciente</option>
            @foreach ($personas as $persona)
                <option
                    value="{{ $persona->id }}"{{ old('persona', $adopcione->persona) == $persona->id ? 'selected' : '' }}>
                    {{ $persona->nombres }} {{$persona->apellidos}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/description.png')}}" width="15" alt=""> </span>
        </div>
        <input name="motivo" id="motivo" value="{{ old('motivo') ?? $adopcione->motivo }}" class="form-control"
            placeholder="Motivo de adopción" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/kyc.png')}}" width="15" alt=""> </span>
        </div>
        <input name="observaciones" id="observaciones" value="{{ old('observaciones') ?? $adopcione->observaciones }}" class="form-control"
            placeholder="Observaciones y detalles" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <select name="estado" id="estado" class="form-control">
            <option value="Aprobada"{{ $adopcione->estado == 'Aprobada' ? 'selected' : '' }}>
                Aprobada</option>
            <option value="Pendiente"{{ $adopcione->estado == 'Pendiente' ? 'selected' : '' }}>
                Pendiente</option>
            <option value="Rechazada"{{ $adopcione->estado == 'Rechazada' ? 'selected' : '' }}>
                Rechazada</option>
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