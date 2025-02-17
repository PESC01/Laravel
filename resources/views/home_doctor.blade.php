@extends('adminlte::page')
@section('title', 'Panel Doctor')
@section('content_header')
    <h1>Panel de Doctor</h1>
@stop
@section('content')
    <link rel="stylesheet" href="{{ asset('css/tabla.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .fancy-title {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 48px;
            color: #000000;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

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
    <div class="row">
        <div class="col-lg-3 col-6">
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
        <div class="chart-container col-md-7">
            <canvas id="myChart"></canvas>
            <button onclick="printChart('myChart', 'Registro de Pacientes')" class="btn btn-primary">Imprimir
                Gráfico</button>
        </div>
        <div class="chart-container col-md-5 text-center">
            <h4>Géneros de Pacienes</h4>
            <canvas id="pieChart"></canvas>
            <button onclick="printChart('pieChart', 'Distribución de Géneros')" class="btn btn-primary">Imprimir
                Gráfico</button>
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
            let windowContent =
                '<!DOCTYPE html><html><head><title>Imprimir Gráfico</title></head><body><h1 style="text-align:center;">' +
                title + '</h1><div style="text-align:center;"><img src="' + dataUrl +
                '" style="width:80%;"/></div></body></html>';
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
        new Chart(ctxPie, {
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
        // Configuración de la Gráfica de Barras (Registro de Pacientes)
        var ctxBar = document.getElementById('myChart').getContext('2d');
        var days = {!! json_encode($days) !!};
        var counts = {!! json_encode($counts) !!};
        var gradient = ctxBar.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(75, 192, 192, 0.6)');
        gradient.addColorStop(1, 'rgba(75, 192, 192, 0.1)');
        new Chart(ctxBar, {
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
@endsection
