@extends('adminlte::page')

@section('title', 'Lista de adoptantes')

@section('content')
    <br><br>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>
                Listado de personas
                <a href="{{ route('adoptantes.create') }}">
                    <button class="btn btn-primary">
                        Agregar nuevo registro de persona
                    </button>
                </a>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('adoptantes.pdf') }}" target="_blank" class="btn btn-danger">
                Generar Reporte
            </a>
        </div>
    </div>

    <hr>
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                @foreach ($adoptantes as $adoptante)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill " style="border: 1px solid rgb(37, 79, 143);">
                            <div class="card-header text-muted border-bottom-0">

                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{ $adoptante->nombres }} {{ $adoptante->apellidos }}</b></h2>

                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span>
                                                Address: {{ $adoptante->domicilio }}</li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span>
                                                Celular #: {{ $adoptante->celular }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{ asset('images/kyc.png') }}" alt="user-avatar"
                                            class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">


                                    <a href="{{ route('adoptantes.edit', ['adoptante' => $adoptante]) }}"
                                        class="btn btn-info btn-sm bg-teal"><i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#"
                                        onclick="event.preventDefault();
                        document.getElementById('delete-adoptante-{{ $adoptante->id }}-form').submit();"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                    </a>
                                    <form id="delete-adoptante-{{ $adoptante->id }}-form"
                                        action="{{ route('adoptantes.destroy', ['adoptante' => $adoptante]) }}"
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
