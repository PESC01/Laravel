@extends('adminlte::page')

@section('title', 'Lista de adopciones')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>
                Registro de adopciones
                <a href="{{ route('adopciones.create') }}">
                    <button class="btn btn-primary">
                        Agregar nuevo registro de adopción
                    </button>
                </a>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('adopciones.pdf') }}" target="_blank" class="btn btn-danger">
                Generar Reporte
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: rgb(85, 144, 199)">
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Adoptante</th>
                        <th>Paciente</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </thead>
                    @foreach ($adopciones as $adopcion)
                        <tr>
                            <td><img src="{{ asset('images/adopciones.png') }}" width="40px" alt=""></td>
                            <td>
                                {{ $adopcion->fecha }}
                            </td>
                            <td>
                                @foreach ($adoptantes as $adoptante)
                                    @if ($adoptante->id == $adopcion->adoptante)
                                        {{ $adoptante->nombres }} {{ $adoptante->apellidos }}
                                    @endif
                                @endforeach
                            </td>
                            @foreach ($personas as $persona)
                                @if ($persona->id == $adopcion->persona)
                                    <td>{{ $persona->nombres }} {{ $persona->apellidos }}</td>
                                @endif
                            @endforeach

                            <td>{{ $adopcion->estado }}</td>


                            <td>

                                <a class="btn btn-success btn-sm" href="{{ route('adopciones.show', $adopcion->id) }}"><i
                                        class="fa fa-eye"></i></a>
                                <a href="{{ route('adopciones.edit', ['adopcione' => $adopcion]) }}"
                                    class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                </a>

                                <a href="#"
                                    onclick="event.preventDefault();
                    document.getElementById('delete-adopcion-{{ $adopcion->id }}-form').submit();"
                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                </a>
                                <form id="delete-adopcion-{{ $adopcion->id }}-form"
                                    action="{{ route('adopciones.destroy', ['adopcione' => $adopcion]) }}" method="POST"
                                    class="hidden">
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
