@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/tabla.css') }}">
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
                <a href="{{ route('personas.index') }}" class="small-box-footer">
                    Más info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalInformes }}</h3>
                    <p>Informes Generados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <a href="{{ route('informes.index') }}" class="small-box-footer">
                    Ver Informes <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

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

    <div class="row">
        <!-- Gráfica de Barras para Pacientes Registrados -->
        <div class="chart-container col-md-7">
            <canvas id="myChart"></canvas>
            <button onclick="printChart('myChart', 'Registro de Pacientes')" class="btn btn-primary">
                Imprimir Gráfico
            </button>
        </div>

        <!-- Gráfica de Pastel para Géneros -->
        <div class="chart-container col-md-5 text-center">
            <h4>Géneros de Pacienes</h4>
            <canvas id="pieChart"></canvas>
            <button onclick="printChart('pieChart', 'Distribución de Géneros')" class="btn btn-primary">
                Imprimir Gráfico
            </button>
        </div>
    </div>

    <div class="chart-container col-md-7">
        <canvas id="motivosChart"></canvas>
        <button onclick="printChart('motivosChart', 'Motivos de Ingreso de Pacientes')" class="btn btn-primary">
            Imprimir Gráfico
        </button>
    </div>
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
            windowContent += '<html>';
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

        // Gráfica de Pastel (Géneros)
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

        // Gráfica de Barras (Pacientes Registrados)
        var ctxBar = document.getElementById('myChart').getContext('2d');
        var days = {!! json_encode($days) !!};
        var counts = {!! json_encode($counts) !!};

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

        // Gráfica de Barras (Motivos de Ingreso)
        var ctxMotivos = document.getElementById('motivosChart').getContext('2d');
        var motivos = {!! json_encode($motivos) !!};
        var totalesMotivos = {!! json_encode($totalesMotivos) !!};

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
@endsection
