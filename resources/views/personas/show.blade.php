@extends('adminlte::page')

@section('title', 'Detalle')

@section('content')
    @role('Trabajador social')
        @include('personas.show2')
    @else
        <div class="container-fluid">
            <h1 class="text-center">Detalle: {{ $persona->nombres }} {{ $persona->apellidos }}</h1>

            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="resident">
                        <img src="{{ asset('image/' . $persona->image) }}" alt="{{ $persona->nombres }}" class="img-thumbnail">
                        <h2>{{ $persona->nombres }} {{ $persona->apellidos }}</h2>
                        <p><b>Cedula de identidad:</b> {{ $persona->ci }}</p>
                        <p><b>Nacionalidad:</b> {{ $persona->nombre_nacionalidad }}</p>
                        <p><b>Fecha de Nacimiento:</b> {{ $persona->fech_nac }}</p>
                        <p><b>Estado civil:</b> {{ $persona->estado_civil }}</p>
                        <p><b>Motivo de Ingreso:</b> {{ $persona->motivo_ingreso }}</p>
                        <p><b>Fecha y hora de registro:</b>
                            {{ \Carbon\Carbon::parse($persona->fech_registro)->format('d-m-Y') }}
                            {{ $persona->hora_registro }}</p>
                        <div class="firma-section">
                            <h3>Documento</h3>
                            @if ($persona->firma_consentimiento)
                                <a href="{{ asset('firma/' . $persona->firma_consentimiento) }}" target="_blank">
                                    @if (strtolower(pathinfo($persona->firma_consentimiento, PATHINFO_EXTENSION)) === 'pdf')
                                        <!-- Puedes usar un ícono para PDF -->
                                        <img src="{{ asset('images/pdf-icon.png') }}" alt="Documento PDF"
                                            style="max-width:100px;">
                                    @else
                                        <!-- Si es imagen se muestra la imagen -->
                                        <img src="{{ asset('firma/' . $persona->firma_consentimiento) }}"
                                            alt="Documento del paciente" class="firma-img">
                                    @endif
                                </a>
                            @else
                                <p>No se ha cargado documento.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center">
                        <button class="btn btn-info view-details-btn" data-toggle="modal" data-target="#detalleModal">Ver
                            Detalles</button>
                        <button class="btn btn-info view-medical-history-btn" data-toggle="modal" data-target="#diarioModal">Ver
                            Registros diarios de atención</button>
                        <button class="btn btn-info view-medical-history-btn" data-toggle="modal"
                            data-target="#preferenciaModal">Ver preferencias del paciente</button>
                        <button class="btn btn-info view-medical-history-btn" data-toggle="modal"
                            data-target="#seguimientoModal">Ver seguimientos vitales del paciente</button>
                        <button class="btn btn-info view-medical-history-btn" data-toggle="modal"
                            data-target="#incidenteModal">Ver incidentes ocurridos con el paciente</button>
                        <button class="btn btn-info view-medical-history-btn" data-toggle="modal"
                            data-target="#pruebamedicaeModal">Ver pruebas médicas</button>
                        <button class="btn btn-info view-medical-history-btn" data-toggle="modal"
                            data-target="#antecedentemedicoModal">Ver antecedentes médicos</button>
                        <button class="btn btn-info view-medical-history-btn" data-toggle="modal"
                            data-target="#historialmedicamentoModal">Ver historial de medicamentos</button>

                        <button class="btn btn-info view-medical-history-btn" data-toggle="modal"
                            data-target="#documentosLegalesModal">Ver documentos legales</button>

                    </div>
                </div>
            </div>


        @endrole

    </div>
    <!-- REGISTRO DE CONTACTOS -->
    <div class="modal
                        fade" id="detalleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Familiares de {{ $persona->nombres }}
                        {{ $persona->apellidos }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('contactos.create', ['persona' => $persona->id]) }}">
                            Agregar nuevo contacto</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: rgb(85, 144, 199)">
                                <th>Nombres y apellidos</th>
                                <th>Direccion </th>
                                <th>Celular</th>
                                <th>Tipo de relacion</th>
                                <th>Opciones</th>
                            </thead>
                            <!--Bucle que recorre todas los ingresos-->
                            @foreach ($familiares as $familiar)
                                <tr>
                                    <td>
                                        {{ $familiar->cnombres }} {{ $familiar->capellidos }}
                                    </td>
                                    <td>
                                        {{ $familiar->direccion_vivienda }}
                                    </td>
                                    <td>
                                        {{ $familiar->celular }}
                                    </td>
                                    <td>
                                        {{ $familiar->nombre }}
                                    </td>

                                    <td>
                                        <a href="{{ route('contactos.edit', $familiar->id) }}"
                                            class="btn btn-info btn-xs"><i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            onclick="event.preventDefault();
                            document.getElementById('delete-contacto-{{ $familiar->id }}-form').submit();"
                                            class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                        </a>
                                        <form id="delete-contacto-{{ $familiar->id }}-form"
                                            action="{{ route('contactos.destroy', $familiar->id) }}" method="POST"
                                            class="hidden">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </table>
                    </div>
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- REGISTROS DIARIOS DE ATENCION --}}
    <div class="modal fade" id="diarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro diario de {{ $persona->nombres }}
                        {{ $persona->apellidos }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('diarios.create', ['persona' => $persona->id]) }}">
                            Agregar nuevo registro</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: rgb(85, 144, 199)">
                                <th style="width: 25%">Fecha </th>
                                <th style="width: 40%">Descripción de actividades</th>
                                <th style="width: 35%">Opciones</th>
                            </thead>
                            @foreach ($diarios as $diario)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($diario->rdfecha)->format('d-m-Y') }}
                                    </td>
                                    <td>{{ $diario->actividades_paciente_descripcion }}</td>



                                    <td>
                                        <a href="{{ route('diarios.edit', $diario->id) }}" class="btn btn-info btn-sm"><i
                                                class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            onclick="event.preventDefault();
                     document.getElementById('delete-diario-{{ $diario->id }}-form').submit();"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form id="delete-diario-{{ $diario->id }}-form"
                                            action="{{ route('diarios.destroy', $diario->id) }}" method="POST"
                                            class="hidden">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </table>
                    </div>
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- PREFERENCIAS ESPECIALES DEL PACIENTE --}}
    <div class="modal fade" id="preferenciaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Preferencias de {{ $persona->nombres }}
                        {{ $persona->apellidos }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pull-right">
                        <a class="btn btn-primary"
                            href="{{ route('preferencias.create', ['persona' => $persona->id]) }}">
                            Agregar nueva preferencia</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: rgb(85, 144, 199)">
                                <th style="width: 25%">Preferencias alimenticias </th>
                                <th style="width: 25%">Preferencias de habitación</th>
                                <th style="width: 25%">Preferencias especiales</th>

                                <th style="width: 25%">Opciones</th>
                            </thead>
                            @foreach ($preferencias as $preferencia)
                                <tr>
                                    <td>
                                        {{ $preferencia->alimento }}
                                    </td>
                                    <td>{{ $preferencia->habitacion }}</td>
                                    <td>{{ $preferencia->necesidades }}</td>



                                    <td>
                                        <a href="{{ route('preferencias.edit', $preferencia->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            onclick="event.preventDefault();
                     document.getElementById('delete-preferencia-{{ $preferencia->id }}-form').submit();"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form id="delete-preferencia-{{ $preferencia->id }}-form"
                                            action="{{ route('preferencias.destroy', $preferencia->id) }}" method="POST"
                                            class="hidden">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </table>
                    </div>
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- SEGUIMIENTO DE PACIENTES --}}
    <div class="modal fade" id="seguimientoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seguimiento de signos vitales de:
                        {{ $persona->nombres }}
                        {{ $persona->apellidos }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pull-right">
                        <a class="btn btn-primary"
                            href="{{ route('seguimientos.create', ['persona' => $persona->id]) }}">
                            Agregar nuevo seguimiento</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: rgb(85, 144, 199)">
                                <th style="width: 30%">Fecha</th>
                                <th style="width: 20%">Presion </th>
                                <th style="width: 15%">Frecuencia cardiaca</th>
                                <th style="width: 15%">Temperatura</th>

                                <th style="width: 20%">Opciones</th>
                            </thead>
                            @foreach ($seguimientos as $seguimiento)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($seguimiento->fecha_seguimiento)->format('d-m-Y') }}
                                    </td>
                                    <td>{{ $seguimiento->presion }}</td>
                                    <td>{{ $seguimiento->frecuencia }}</td>
                                    <td>{{ $seguimiento->temperatura }}°</td>
                                    <td>
                                        <a href="{{ route('seguimientos.edit', $seguimiento->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            onclick="event.preventDefault();
                     document.getElementById('delete-seguimiento-{{ $seguimiento->id }}-form').submit();"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form id="delete-seguimiento-{{ $seguimiento->id }}-form"
                                            action="{{ route('seguimientos.destroy', $seguimiento->id) }}" method="POST"
                                            class="hidden">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </table>
                    </div>
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- INCIDENTES DEL PACIENTE --}}
    <div class="modal fade" id="incidenteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de incidentes de:
                        {{ $persona->nombres }}
                        {{ $persona->apellidos }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('incidentes.create', ['persona' => $persona->id]) }}">
                            Agregar nuevo incidente</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: rgb(85, 144, 199)">
                                <th style="width: 30%">Fecha</th>
                                <th style="width: 20%">Descripcion </th>

                                <th style="width: 10%">Opciones</th>
                            </thead>
                            @foreach ($incidentes as $incidente)
                                <tr>
                                    <td>{{ $incidente->incidente_fecha }}</td>
                                    <td>{{ $incidente->incidente_descripcion }}</td>
                                    <td>
                                        <a href="{{ route('incidentes.edit', $incidente->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            onclick="event.preventDefault();
                     document.getElementById('delete-incidente-{{ $incidente->id }}-form').submit();"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form id="delete-incidente-{{ $incidente->id }}-form"
                                            action="{{ route('incidentes.destroy', $incidente->id) }}" method="POST"
                                            class="hidden">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </table>
                    </div>
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- PRUEBAS MEDICAS --}}
    <div class="modal fade" id="antecedentemedicoModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de antecedentes médicos de:
                        {{ $persona->nombres }}
                        {{ $persona->apellidos }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pull-right">
                        <a class="btn btn-primary"
                            href="{{ route('antecedentes.create', ['persona' => $persona->id]) }}">
                            Agregar nuevo antecedente médico</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: rgb(85, 144, 199)">
                                <th style="width: 30%">Enfermedades crónicas</th>
                                <th style="width: 20%">Alergias a medicamentos </th>
                                <th style="width: 20%">Cirugias previas </th>
                                <th style="width: 20%">Historial de enfermedades </th>
                                <th style="width: 10%">Opciones</th>
                            </thead>
                            @foreach ($antecedentes as $antecedente)
                                <tr>
                                    <td>{{ $antecedente->enfermedades_cronicas }}</td>
                                    <td>{{ $antecedente->alergias_medicamentos }}</td>
                                    <td>{{ $antecedente->cirugias_previas }}</td>
                                    <td>{{ $antecedente->historial_enfermedades }}</td>
                                    <td>
                                        <a href="{{ route('antecedentes.edit', $antecedente->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            onclick="event.preventDefault();
                     document.getElementById('delete-antecedente-{{ $antecedente->id }}-form').submit();"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form id="delete-antecedente-{{ $antecedente->id }}-form"
                                            action="{{ route('antecedentes.destroy', $antecedente->id) }}" method="POST"
                                            class="hidden">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </table>
                    </div>
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ANTECEDENTES MEDICOS --}}
    <div class="modal fade" id="pruebamedicaeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de pruebas médicas de:
                        {{ $persona->nombres }}
                        {{ $persona->apellidos }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('pruebas.create', ['persona' => $persona->id]) }}">
                            Agregar nuevo incidente</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: rgb(85, 144, 199)">
                                <th style="width: 30%">Fecha</th>
                                <th style="width: 20%">Descripcion </th>

                                <th style="width: 10%">Opciones</th>
                            </thead>
                            @foreach ($pruebas as $prueba)
                                <tr>
                                    <td>{{ $prueba->fecha_prueba_medica }}</td>
                                    <td>{{ $prueba->descripcion_prueba_medica }}</td>
                                    <td>
                                        <a href="{{ route('pruebas.edit', $prueba->id) }}" class="btn btn-info btn-sm"><i
                                                class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            onclick="event.preventDefault();
                     document.getElementById('delete-prueba-{{ $prueba->id }}-form').submit();"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        </a>
                                        <form id="delete-prueba-{{ $prueba->id }}-form"
                                            action="{{ route('pruebas.destroy', $prueba->id) }}" method="POST"
                                            class="hidden">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </table>
                    </div>
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- HISTORIAL MEDICAMENTOS --}}
    <div class="modal fade" id="historialmedicamentoModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de medicamentos de:
                        {{ $persona->nombres }}
                        {{ $persona->apellidos }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('historial.create', ['persona' => $persona->id]) }}">
                            Agregar nuevo medicamento</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: rgb(85, 144, 199)">
                                <th style="width: 30%">Medicamento</th>
                                <th style="width: 20%">Medicamento anterior recetado </th>
                                <th style="width: 30%">Dosis y duración</th>
                                <th style="width: 10%">Opciones</th>
                            </thead>
                            @foreach ($historiales as $historial)
                                <tr>
                                    @foreach ($medicamentos as $medicamento)
                                        @if ($medicamento->id == $historial->medicamentos)
                                            <td>{{ $medicamento->nombre_medicamento }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $historial->medicamentos_anteriores_recetados }}</td>
                                    <td>{{ $historial->dosis_duracion_medicacion }}</td>
                                    <td>
                                        <a href="{{ route('historial.edit', $historial->id) }}"
                                            class="btn btn-info btn-xs"><i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            onclick="event.preventDefault();
                    document.getElementById('delete-historial-{{ $historial->id }}-form').submit();"
                                            class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                        </a>
                                        <form id="delete-historial-{{ $historial->id }}-form"
                                            action="{{ route('historial.destroy', $historial->id) }}" method="POST"
                                            class="hidden">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </table>
                    </div>
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
    </div>



    {{-- DOCUMENTOS LEGALES --}}
    <div class="modal fade" id="documentosLegalesModal" tabindex="-1" role="dialog"
        aria-labelledby="documentosLegalesLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentosLegalesLabel">Documentos Legales de:
                        {{ $persona->nombres }}
                        {{ $persona->apellidos }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="pull-right">
                        <a class="btn btn-primary"
                            href="{{ route('documentoslegales.create', ['persona' => $persona->id]) }}">Agregar
                            nuevo
                            documento
                            legal</a>
                        <a href="{{ route('documentoslegales.pdf', ['persona' => $persona->id]) }}" target="_blank"
                            class="btn btn-danger">Generar Reporte</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color: rgb(85, 144, 199)">
                                <th>Nombre del Documento</th>
                                <th>Descripción</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($documentos as $documento)
                                    <tr>
                                        <td>{{ $documento->nombre_documento }}</td>
                                        <td>{{ $documento->descripcion_documento }}</td>

                                        <td><img src="{{ asset('images/' . $documento->imagen_documento) }}"
                                                width="100"></td>
                                        <td>
                                            <a class="btn btn-info"
                                                href="{{ route('documentoslegales.edit', $documento->id) }}">Editar</a>
                                            <a class="btn btn-success"
                                                href="{{ asset('images/' . $documento->imagen_documento) }}"
                                                target="_blank">Ver</a>
                                            <form action="{{ route('documentoslegales.destroy', $documento->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .resident-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            /* Centra los elementos horizontalmente */
        }

        .resident {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            max-width: 300px;
        }

        img {
            max-width: 100%;
            height: auto;
            /* Mantiene la proporción de la imagen */
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            margin-top: 10px;
            cursor: pointer;
        }

        .firma-section {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .firma-img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
    </style>

    <script>
        $('.view-details-btn').click(function() {
            var modalContent = $('#modal-content');

            // Detectar si se hizo clic en el botón "Ver Contactos" o "Ver Historial Médico"
            if ($(this).hasClass('view-contact-btn')) {
                // Aquí puedes cargar los datos de contactos y mostrarlos en el modal
                modalContent.html('<h3>Contactos del residente</h3><p>Contenido de contactos aquí.</p>');
            } else if ($(this).hasClass('view-medical-history-btn')) {
                // Aquí puedes cargar el historial médico y mostrarlo en el modal
                modalContent.html(
                    '<h3>Historial Médico del residente</h3><p>Contenido del historial médico aquí.</p>');
            }
        });
    </script>
    </script>
@endsection
