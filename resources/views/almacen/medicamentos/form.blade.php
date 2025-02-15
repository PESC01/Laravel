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
        <input name="nombre_medicamento" id="nombre_medicamento" value="{{ old('nombre_medicamento') ?? $medicamento->nombre_medicamento }}" class="form-control"
            placeholder="Nombre del medicamento" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/lastname.png')}}" width="15" alt=""></span>
        </div>
        <input name="descripcion" id="descripcion" value="{{ old('descripcion') ?? $medicamento->descripcion }}" class="form-control"
            placeholder="Descripción del medicamento" type="text">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <img src="{{asset('images/name.png')}}" width="15" alt=""> </span>
        </div>
        <input name="cantidad" id="cantidad" value="{{ old('cantidad') ?? $medicamento->cantidad }}" class="form-control"
            placeholder="Cantidad" type="number">
    </div>

    <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-book"></i></span>
        </div>
        <select name="tipo" id="tipo" class="form-control">
            <option selected=""> Tipo de medicamento</option>
            @foreach ($tipos as $tipo)
                <option
                    value="{{ $tipo->id }}"{{ old('tipo', $medicamento->tipo) == $tipo->id ? 'selected' : '' }}>
                    {{ $tipo->nombre_medicamento }} </option>
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
                    value="{{ $proveedor->id }}"{{ old('proveedor', $medicamento->proveedor) == $proveedor->id ? 'selected' : '' }}>
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