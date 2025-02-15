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
        <input name="nombre" id="nombre" value="{{ old('nombre') ?? $suministro->nombre }}" class="form-control"
            placeholder="Nombre del suministro" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/lastname.png')}}" width="15" alt=""></span>
        </div>
        <input name="descripcion" id="descripcion" value="{{ old('descripcion') ?? $suministro->descripcion }}" class="form-control"
            placeholder="Descripción del suministro" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/name.png')}}" width="15" alt=""> </span>
        </div>
        <input name="cantidad" id="cantidad" value="{{ old('cantidad') ?? $suministro->cantidad }}" class="form-control"
            placeholder="Cantidad" type="number">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <select name="tipo" id="tipo" class="form-control">
            <option selected=""> Tipo de suministro</option>
            @foreach ($tipos as $tipo)
                <option
                    value="{{ $tipo->id }}"{{ old('tipo', $suministro->tipo) == $tipo->id ? 'selected' : '' }}>
                    {{ $tipo->nombre }} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-user"></i></span>
        </div>
        <select name="proveedor" id="proveedor" class="form-control">
            <option selected=""> Lista de proveedores</option>
            @foreach ($proveedores as $proveedor)
                <option
                    value="{{ $proveedor->id }}"{{ old('proveedor', $suministro->proveedor) == $proveedor->id ? 'selected' : '' }}>
                    {{ $proveedor->nombres }} {{$proveedor->apellidos}}</option>
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