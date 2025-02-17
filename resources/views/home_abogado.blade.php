@extends('adminlte::page')

@section('title', 'Panel Abogado')

@section('content_header')
    <h1 class="fancy-title">Panel Abogado</h1>
@stop

@section('content')
    <!-- Importa el CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/tabla.css') }}">

    <!-- Cards -->
    <div class="row">
        <!-- Card Pacientes Registrados -->
        <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalPersonas }}</h3>
                    <p>Pacientes Registrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-injured"></i>
                </div>

            </div>
        </div>
        <!-- Card Documentos Legales -->
        <div class="col-lg-6 col-12">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $totalDocumentos }}</h3>
                    <p>Documentos Legales</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <a href="{{ route('documentoslegales.index') }}" class="small-box-footer">
                    Más info <i class="fas fa-arrow-circle-right"></i>
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

    <!-- Gráficas -->
    <div class="row">
        <!-- Gráfica de Barras para Pacientes Registrados -->
        <div class="chart-container col-md-6">
            <canvas id="myChart"></canvas>
            <button onclick="printChart('myChart', 'Registro de Pacientes')" class="btn btn-primary">
                Imprimir Gráfico
            </button>
        </div>

        <!-- Gráfica de Donut para Documentos Legales por Tipo -->
        <div class="chart-container col-md-6">
            <canvas id="legalDocsChart"></canvas>
            <button onclick="printChart('legalDocsChart', 'Documentos Legales por Tipo')" class="btn btn-primary">
                Imprimir Gráfico
            </button>
        </div>
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

        // Gráfica de Barras para Pacientes Registrados
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

        // Gráfica de Donut para Documentos Legales
        var ctxLegal = document.getElementById('legalDocsChart').getContext('2d');
        var legalDocTypes = {!! json_encode($legalDocTypes) !!}; // Ej.: ['Contrato', 'Testamento', 'Poder']
        var legalDocCounts = {!! json_encode($legalDocCounts) !!}; // Ej.: [12, 7, 5]
        var colors = ['#3498db', '#e74c3c', '#f1c40f', '#2ecc71'];

        var legalDocsChart = new Chart(ctxLegal, {
            type: 'doughnut',
            data: {
                labels: legalDocTypes,
                datasets: [{
                    data: legalDocCounts,
                    backgroundColor: colors.slice(0, legalDocTypes.length)
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
                        text: 'Documentos Legales por Tipo',
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
    </script>
@stop
