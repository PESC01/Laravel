@extends('adminlte::page')

@section('title', 'Lista de tipos de suministros')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>
                Listado de tipos de suministros
                <a href="{{ route('tiposuministros.create') }}">
                    <button class="btn btn-primary">
                        Agregar nuevo tipo de suministro
                    </button>
                </a>
                <a href="{{ route('tiposuministros.pdf') }}">
                    <button class="btn btn-success">
                        Generar Reporte de Tipos de Suministros
                    </button>
                </a>
            </h3>
            <!--se incluye la vista search, que es una barra de busqueda-->
            {{-- @include('personaas.personaa.search') --}}
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
                        <th>Opciones</th>
                    </thead>
                    <!--Bucle que recorre todas los ingresos-->
                    @foreach ($tipos as $tipo)
                        <tr>
                            <td><img src="{{ asset('images/boxes.png') }}" width="40px" alt=""></td>
                            <td>
                                {{ $tipo->nombre }}
                            </td>
                            <td>
                                {{ $tipo->descripcion }}
                            </td>

                            <td>

                                <a href="{{ route('tiposuministros.edit', ['tiposuministro' => $tipo]) }}"
                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                </a>
                                <a href="#"
                                    onclick="event.preventDefault();
                    document.getElementById('delete-tipo-{{ $tipo->id }}-form').submit();"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                </a>
                                <form id="delete-tipo-{{ $tipo->id }}-form"
                                    action="{{ route('tiposuministros.destroy', ['tiposuministro' => $tipo]) }}"
                                    method="POST" class="hidden">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        <!--modal de eliminar-->
                    @endforeach
                </table>
            </div>

        </div>
    </div>
@endsection
