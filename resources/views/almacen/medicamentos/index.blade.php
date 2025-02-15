@extends('adminlte::page')

@section('title', 'Lista de medicamentos')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>
                Listado de medicamentos
                <a href="{{ route('medicamentos.create') }}">
                    <button class="btn btn-primary">
                        Agregar nuevo medicamento
                    </button>
                </a>
                <a href="{{ route('medicamentos.pdf') }}">
                    <button class="btn btn-success">
                        Generar Reporte de Medicamentos
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
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Tipos de medicamento</th>
                        <th>Proveedor</th>
                        <th>Opciones</th>
                    </thead>
                    <!--Bucle que recorre todas los ingresos-->

                    @foreach ($medicamentos as $medicamento)
                        <tr>
                            <td><img src="{{ asset('images/medicine.png') }}" width="40px" alt=""></td>
                            <td>{{ $medicamento->nombre_medicamento }}</td>
                            <td>{{ $medicamento->descripcion }}</td>
                            <td>{{ $medicamento->cantidad }}</td>
                            @foreach ($tipos as $tipo)
                                @if ($tipo->id == $medicamento->tipo)
                                    <td>{{ $tipo->nombre_medicamento }}</td>
                                @endif
                            @endforeach
                            @foreach ($proveedores as $proveedor)
                                @if ($proveedor->id == $medicamento->proveedor)
                                    <td>{{ $proveedor->nombres }} {{ $proveedor->apellidos }}</td>
                                @endif
                            @endforeach
                            <td>
                                <a href="{{ route('medicamentos.edit', ['medicamento' => $medicamento]) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('delete-medicamento-{{ $medicamento->id }}-form').submit();"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <form id="delete-medicamento-{{ $medicamento->id }}-form"
                                    action="{{ route('medicamentos.destroy', ['medicamento' => $medicamento]) }}"
                                    method="POST" class="d-none">
                                    @method('DELETE')
                                    @csrf
                                </form>

                                <a href="{{ route('medicamentos.suministrarForm', ['medicamento' => $medicamento]) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Suministrar
                                </a>

                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#historialModal-{{ $medicamento->id }}">
                                    <i class="fa fa-history"></i> Historial
                                </button>
                            </td>
                        </tr>

                        <!-- Modal para historial -->
                        <div class="modal fade" id="historialModal-{{ $medicamento->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="historialModalLabel-{{ $medicamento->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="historialModalLabel-{{ $medicamento->id }}">Historial
                                            de {{ $medicamento->nombre_medicamento }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Fecha de creación:</strong> {{ $medicamento->created_at }}<strong>
                                                Cantidad: </strong>
                                            {{ $medicamento->cantidad - $medicamento->suministrosMedicamento->sum('cantidad') }}
                                        </p>
                                        <p>
                                            <strong>Fecha de última actualización:</strong> {{ $medicamento->updated_at }}
                                        </p>
                                        @php
                                            $lastSupply = $medicamento->suministrosMedicamento
                                                ->sortByDesc('created_at')
                                                ->first();
                                        @endphp
                                        @if ($lastSupply)
                                            <p>
                                                <strong>Cantidad de la última actualización:</strong>
                                                {{ $lastSupply->cantidad }}
                                            </p>
                                        @else
                                            <p>
                                                <strong>Cantidad de la última actualización:</strong> No hay
                                                actualizaciones.
                                            </p>
                                        @endif

                                        <p><strong>Cantidad Actual:</strong> {{ $medicamento->cantidad }}</p>
                                        <h5>Suministros realizados:</h5>
                                        <ul>
                                            @foreach ($medicamento->suministrosMedicamento as $suministro)
                                                <li>{{ $suministro->created_at }} - Cantidad: {{ $suministro->cantidad }}
                                                </li>
                                            @endforeach
                                            @if ($medicamento->suministrosMedicamento->isEmpty())
                                                <li>No hay suministros registrados.</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
@endsection
