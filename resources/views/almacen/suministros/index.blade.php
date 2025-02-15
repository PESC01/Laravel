@extends('adminlte::page')

@section('title', 'Lista de proveedors de medicamentos')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>
                Listado de suministros
                <a href="{{ route('suministros.create') }}">
                    <button class="btn btn-primary">
                        Agregar nuevo suministro
                    </button>
                </a>
                <a href="{{ route('suministros.pdf') }}">
                    <button class="btn btn-success">
                        Generar Reporte de Suministros
                    </button>
                </a>
            </h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: rgb(85, 144, 199)">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Tipo de suministro</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </thead>
                    <!--Bucle que recorre todas los ingresos-->
                    @foreach ($suministros as $suministro)
                        <tr>
                            <td><img src="{{ asset('images/box.png') }}" width="40px" alt=""></td>
                            <td>
                                {{ $suministro->nombre }}
                            </td>
                            <td>
                                {{ $suministro->descripcion }}
                            </td>
                            <td>{{ $suministro->cantidad }}</td>
                            @foreach ($tipos as $tipo)
                                @if ($tipo->id == $suministro->tipo)
                                    <td>{{ $tipo->nombre }}</td>
                                @endif
                            @endforeach
                            @foreach ($proveedores as $proveedor)
                                @if ($proveedor->id == $suministro->proveedor)
                                    <td> {{ $proveedor->nombres }} {{ $proveedor->apellidos }}</td>
                                @endif
                            @endforeach
                            <td>
                                <a href="{{ route('suministros.edit', ['suministro' => $suministro]) }}"
                                    class="btn btn-info btn-xs"><i class="fa fa-edit"></i>
                                </a>
                                <a href="#"
                                    onclick="event.preventDefault();
                    document.getElementById('delete-suministro-{{ $suministro->id }}-form').submit();"
                                    class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                </a>
                                <form id="delete-suministro-{{ $suministro->id }}-form"
                                    action="{{ route('suministros.destroy', ['suministro' => $suministro]) }}"
                                    method="POST" class="hidden">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
@endsection
