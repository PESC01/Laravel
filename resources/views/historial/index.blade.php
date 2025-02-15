@extends('adminlte::page')

@section('title', 'Detalle de pacientes')
<link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
<script src="{{ asset('js/flatpickr.js') }}"></script>
<script src="{{ asset('js/chart.js') }}"></script>

@section('content')
    <br><br>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Buscar Paciente</h3>
                </div>
                <div class="card-body">
                    <form id="buscarForm" action="{{ route('buscar_paciente') }}" method="GET">

                        <div class="form-group">

                            <label>Nombre del Paciente</label>
                            <input type="text" id="nombre" name="nombre" class="form-control form-control-border"
                                placeholder="">

                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label>Género</label>
                                <select name="genero" class="custom-select form-control-border border-width-2">
                                    <option value="">Seleccione...</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Registro</label>
                                <select name="llegada" class="custom-select form-control-border border-width-2">
                                    <option value="">Seleccione...</option>
                                    <option value="ASC">Ascendente</option>
                                    <option value="DESC">Descendente</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <label>Fecha de Ingreso</label>
                                <input type="text" name="fecha_ingreso" id="fecha_ingreso"
                                    class="form-control form-control-border" placeholder="Formato: YYYY-MM-DD|YYYY-MM-DD">
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Buscar</button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6" id="resultadosContainer">
            <!-- Aquí se mostrarán los resultados dinámicamente -->
            <p>

            </p>
        </div>
    </div>

    <!-- Agregar scripts al final del archivo -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @stack('scripts')
    <script>
        //GRAFICOS PORCENTUALES


        // CONTROLADOR DE FECHAS CON RANGO
        flatpickr("#fecha_ingreso", {
            mode: "range",
            dateFormat: "Y-m-d"
        });

        //MOSTRAR EL FORMULARIO DE MANERA DINAMICA
        $(document).ready(function() {
            // Manejar el envío del formulario con AJAX
            $('#buscarForm').on('submit', function(e) {
                e.preventDefault(); // Evitar el envío normal del formulario

                // Realizar la solicitud AJAX
                $.ajax({
                    type: 'GET',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(data) {
                        // Actualizar la sección de resultados con la respuesta del servidor
                        $('#resultadosContainer').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr
                            .responseText); // Imprimir el mensaje de error en la consola
                    }
                });
            });
        });
    </script>


@endsection
