@extends('adminlte::page')

@section('title', 'Lista del personal')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>
                Listado de personal
                <a href="{{ route('administrativos.create') }}">
                    <button class="btn btn-primary">
                        Agregar nuevo personal
                    </button>
                </a>
                <a href="{{ route('administrativos.pdf') }}">
                    <button class="btn btn-success">
                        Generar Reporte de Personal
                    </button>
                </a>
            </h3>
        </div>
    </div>

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                @foreach ($empleados as $empleado)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill " style="border: 1px solid rgb(37, 79, 143);">
                            <div class="card-header text-muted border-bottom-0">
                                <b>Especialidad:
                                </b>{{ $empleado->calificaciones }}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{ $empleado->nombres }} {{ $empleado->apellidos }}</b></h2>

                                        <ul class="ml-4 mb-0 fa-ul text-muted">

                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span>
                                                Phone #: {{ $empleado->celular }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{ asset('images/empleado.png') }}" alt="user-avatar"
                                            class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">


                                    <a href="{{ route('administrativos.edit', ['administrativo' => $empleado]) }}"
                                        class="btn btn-info btn-sm bg-teal"><i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#"
                                        onclick="event.preventDefault();
                        document.getElementById('delete-empleado-{{ $empleado->id }}-form').submit();"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                    </a>
                                    <form id="delete-empleado-{{ $empleado->id }}-form"
                                        action="{{ route('administrativos.destroy', ['administrativo' => $empleado]) }}"
                                        method="POST" class="hidden">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
