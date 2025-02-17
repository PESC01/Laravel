@extends('adminlte::page')

@section('title', 'Lista de pacientes')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>
                Listado de pacientes
            </h3>
            <!--se incluye la vista search, que es una barra de busqueda-->
            {{-- @include('personaas.personaa.search') --}}
        </div>
    </div>

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                @foreach ($personas as $persona)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                <b>Fecha registro:
                                </b>{{ \Carbon\Carbon::parse($persona->fech_registro)->format('d-m-Y') }}
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{ $persona->nombres }} {{ $persona->apellidos }}</b></h2>
                                        <p class="text-muted text-sm"><b>Motivo ingreso: </b>
                                            {{ $persona->motivo_ingreso }} </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span>
                                                Address: Calle XYZ</li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span>
                                                Phone #: 448389394</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <strong>Informes:</strong>
                                        <ul>
                                            @foreach ($persona->informes as $informe)
                                                <li>
                                                    <a href="{{ route('informes.show', $informe->id) }}">
                                                        {{ $informe->titulo }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="{{ asset('image/' . $persona->image) }}" alt="user-avatar"
                                            class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a class="btn btn-sm bg-teal" href="{{ route('generatePDF', $persona->id) }}">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('personas.show_doctor', $persona->id) }}">
                                        <i class="fas fa-user"></i> Ver detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
