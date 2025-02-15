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
            <span class="input-group-text"> <img src="{{asset('images/name.png')}}" width="15" alt=""> </span>
        </div>
        <input name="enfermedades_cronicas" id="enfermedades_cronicas"
            value="{{ old('enfermedades_cronicas') ?? $antecedente->enfermedades_cronicas }}" class="form-control"
            type="text" placeholder="Descripción de enfermedades crónicas" >
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <input name="alergias_medicamentos" id="alergias_medicamentos"
            value="{{ old('alergias_medicamentos') ?? $antecedente->alergias_medicamentos }}" class="form-control"
            placeholder="Alergia a medicamentes" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <input name="cirugias_previas" id="cirugias_previas"
            value="{{ old('cirugias_previas') ?? $antecedente->cirugias_previas }}" class="form-control"
            placeholder="Cirugias previas realizadas" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <input name="historial_enfermedades" id="historial_enfermedades"
            value="{{ old('historial_enfermedades') ?? $antecedente->historial_enfermedades }}" class="form-control"
            placeholder="Historial de enfermedades" type="text">
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
