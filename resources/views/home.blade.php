@extends('adminlte::page')

@section('title', 'Panel Principal')

@section('content_header')
    <h1 class="fancy-title">Panel Principal</h1>
@stop

@section('content')
    <!-- Importa el CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/tabla.css') }}">

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Estilos Personalizados -->
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
        }

        /* Estilo personalizado para el título */
        .fancy-title {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 48px;
            color: #000000;
            /* text-align: center; */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        /* Cajas de información modernizadas */
        .info-box {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            transition: transform 0.2s ease-in-out;
        }

        .info-box:hover {
            transform: translateY(-5px);
        }

        .info-box-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
            background: linear-gradient(135deg, #517ed3, #2255b4);
        }

        .info-box-icon img {
            width: 40px;
            height: 40px;
        }

        .info-box-content {
            padding: 20px;
            background: linear-gradient(135deg, #3c8dbc, #2255b4);
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-box-text {
            font-size: 16px;
            color: #fff;
            text-transform: uppercase;
            margin: 0;
        }

        .info-box-number {
            font-size: 32px;
            font-weight: bold;
            color: #fff;
            margin: 5px 0 0;
        }

        /* Estilos para la tabla */
        .responstable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .responstable th,
        .responstable td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .responstable th {
            background-color: #f7f7f7;
            color: #333;
        }

        .responstable tr:nth-child(even) {
            background-color: #fdfdfd;
        }

        /* Contenedores de gráficos */
        .chart-container {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        #pieChart {
            max-width: 400px;
        }

        #myChart {
            max-width: 600px;
        }
    </style>
    @role('Administrador')
        <!-- Cajas de Información -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalPersonas }}</h3>

                        <p>Pacientes Registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <a href="{{ route('personas.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $empleados->count() }}</h3>

                        <p>Personal</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('administrativos.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ \App\Models\Dormitorio::count() }}</h3>

                        <p>Dormitorios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <a href="{{ route('dormitorios.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ \App\Models\Cama::count() }}</h3>

                        <p>Camas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <a href="{{ route('camas.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ \App\Models\Medicamento::count() }}</h3>

                        <p>Medicamentos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-capsules"></i>
                    </div>
                    <a href="{{ route('medicamentos.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ \App\Models\Suministro::count() }}</h3>

                        <p>Suministros</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="{{ route('suministros.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\Canasta::distinct('fecha')->count('fecha') }}</h3>

                        <p>Canastas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-apple-alt"></i>
                    </div>
                    <a href="{{ route('canasta.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-lightblue">
                    <div class="inner">
                        <h3>{{ \App\Models\AntecedentesMedicos::count() }}</h3>
                        <p>Antecedentes Médicos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <a href="{{ route('personas.index') }}" class="small-box-footer">Más info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Tabla de Pacientes Recientes -->
        <div class="box">
            <h3 class="box-title">Pacientes Recientes</h3>
            <table class="responstable">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Fecha de ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personas as $persona)
                        <tr>
                            <td>{{ $persona->nombres }}</td>
                            <td>{{ $persona->apellidos }}</td>
                            <td>{{ \Carbon\Carbon::parse($persona->fech_registro)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Gráficos -->
        {{-- filepath: /c:/xampp/htdocs/esther-app/resources/views/home.blade.php --}}
        <div class="row">
            <!-- Gráfica de Barras para Pacientes Registrados -->
            <div class="chart-container col-md-7">
                <canvas id="myChart"></canvas>
                <button onclick="printChart('myChart', 'Registro de Pacientes')" class="btn btn-primary">Imprimir
                    Gráfico</button>
            </div>

            <!-- Gráfica de Pastel para Géneros -->
            <div class="chart-container col-md-5 text-center">
                <h4>Géneros de Pacienes</h4>
                <canvas id="pieChart"></canvas>
                <button onclick="printChart('pieChart', 'Distribución de Géneros')" class="btn btn-primary">Imprimir
                    Gráfico</button>
            </div>
        </div>

        <div class="row">
            <!-- Gráfica de Pastel para Roles de Empleados -->
            <div class="chart-container col-md-5 text-center">
                <h4>Roles de Empleados</h4>
                <canvas id="rolesChart"></canvas>
                <button onclick="printChart('rolesChart', 'Distribución de Roles de Empleados')"
                    class="btn btn-primary">Imprimir
                    Gráfico</button>
            </div>
            <div class="chart-container col-md-7">
                <canvas id="motivosChart"></canvas>
                <button onclick="printChart('motivosChart', 'Motivos de Ingreso de Pacientes')" class="btn btn-primary">Imprimir
                    Gráfico</button>
            </div>
        </div>
    @endrole
    @role('Trabajador social')
        @include('home2')
    @endrole

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"
        integrity="sha512-Qlv6VSKh1ooCIyLglVnqTczKSUc39GARWDGLOk9rbcU4dQFEuGV/cViEoum361i4FmsXE4lnczDnJGTMoJyjyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function printChart(chartId, title) {
            let canvas = document.getElementById(chartId);
            let dataUrl = canvas.toDataURL('image/png');

            let windowContent = '<!DOCTYPE html>';
            windowContent += '<html>'
            windowContent += '<head><title>Imprimir Gráfico</title></head>';
            windowContent += '<body>';
            windowContent += '<h1 style="text-align:center;">' + title + '</h1>';
            windowContent += '<div style="text-align:center;"><img src="' + dataUrl + '" style="width:80%;"/></div>';
            windowContent += '</body>';
            windowContent += '</html>';

            let printWin = window.open('', '', 'width=900,height=600');
            printWin.document.open();
            printWin.document.write(windowContent);
            printWin.document.close();

            printWin.onload = function() {
                printWin.focus();
                printWin.print();
                printWin.close();
            };
        }

        // Configuración de la Gráfica de Pastel (Géneros)
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var generos = {!! json_encode($genero) !!};
        var totales = {!! json_encode($total) !!};
        var colores = ['#3498db', '#e74c3c'];

        var labels = generos.map(function(g) {
            return g === 1 ? 'Masculino' : 'Femenino';
        });


        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: totales,
                    backgroundColor: colores,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Distribución de Géneros',
                        font: {
                            size: 16
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
        var ctxBar = document.getElementById('myChart').getContext('2d');
        var days = {!! json_encode($days) !!};
        var counts = {!! json_encode($counts) !!};


        var ctxRoles = document.getElementById('rolesChart').getContext('2d');
        var rolesCount = {!! json_encode($rolesCount) !!};
        var roleLabels = Object.keys(rolesCount);
        var roleData = Object.values(rolesCount);
        var roleColors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#E63946', '#F1FAEE',
            '#A8DADC', '#457B9D', '#1D3557', '#6C5B7B', '#355C7D'
        ];


        var rolesChart = new Chart(ctxRoles, {
            type: 'pie',
            data: {
                labels: roleLabels,
                datasets: [{
                    data: roleData,
                    backgroundColor: roleColors.slice(0, roleLabels.length),
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Distribución de Roles de Empleados',
                        font: {
                            size: 16
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });


        var ctxBar = document.getElementById('myChart').getContext('2d');
        var days = {!! json_encode($days) !!};
        var counts = {!! json_encode($counts) !!};

        // Crear un degradado para las barras
        var gradient = ctxBar.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(75, 192, 192, 0.6)');
        gradient.addColorStop(1, 'rgba(75, 192, 192, 0.1)');
        var myChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: days,
                datasets: [{
                    label: 'Pacientes Registrados',
                    data: counts,
                    backgroundColor: gradient,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                    hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Registro de Pacientes',
                        font: {
                            size: 16
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Fecha',
                            font: {
                                size: 14
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutBounce'
                }
            }
        });
    </script>
    <script type="text/javascript">
        // Configuración de la Gráfica de Barras (Motivos de Ingreso)
        var ctxMotivos = document.getElementById('motivosChart').getContext('2d');
        var motivos = {!! json_encode($motivos) !!};
        var totalesMotivos = {!! json_encode($totalesMotivos) !!};

        // Crear un degradado para las barras
        var gradientMotivos = ctxMotivos.createLinearGradient(0, 0, 0, 400);
        gradientMotivos.addColorStop(0, 'rgba(255, 99, 132, 0.6)');
        gradientMotivos.addColorStop(1, 'rgba(255, 99, 132, 0.1)');

        var motivosChart = new Chart(ctxMotivos, {
            type: 'bar',
            data: {
                labels: motivos,
                datasets: [{
                    label: 'Pacientes por Motivo de Ingreso',
                    data: totalesMotivos,
                    backgroundColor: gradientMotivos,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                    hoverBackgroundColor: 'rgba(255, 99, 132, 0.8)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Motivos de Ingreso de Pacientes',
                        font: {
                            size: 16
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Motivo de Ingreso',
                            font: {
                                size: 14
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutBounce'
                }
            }
        });
    </script>
@stop
