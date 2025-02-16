app/resources/views/userpdf.blade.php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe de la Persona</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        section {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h2 {
            margin-top: 0;
            border-bottom: 2px solid #eee;
            padding-bottom: 5px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
        }

        strong {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .firma-section {
            text-align: center;
        }

        .firma-img {
            max-width: 150px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Informe de la Persona</h1>

        <section>
            <h2>Información Básica</h2>
            <div class="row">
                <div class="row">
                    <div class="col-12" style="text-align: center;">
                        @if (file_exists(public_path('image/' . $persona->image)))
                            <img src="{{ public_path('image/' . $persona->image) }}" alt="Imagen de la persona"
                                style="width: 200px; height: auto;">
                        @else
                            <p>Imagen no encontrada</p>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <p><strong>Nombre:</strong> {{ $persona->nombrepersona }} {{ $persona->apellidos }}</p>
                    <p><strong>CI:</strong> {{ $persona->ci }}</p>
                    <p><strong>Género:</strong> {{ $persona->nombre_genero }}</p>
                    <p><strong>Nacionalidad:</strong> {{ $persona->nombre_nacionalidad }}</p>
                    <p><strong>Fecha de Nacimiento:</strong>
                        {{ \Carbon\Carbon::parse($persona->fech_nac)->format('d/m/Y') }}</p>
                    <p><strong>Estado Civil:</strong> {{ $persona->estado_civil }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p><strong>Documento:</strong></p>
                    @if (file_exists(public_path('firma/' . $persona->firma_consentimiento)))
                        @if (strtolower(pathinfo(public_path('firma/' . $persona->firma_consentimiento), PATHINFO_EXTENSION)) === 'pdf')
                            <a href="{{ public_path('firma/' . $persona->firma_consentimiento) }}">Ver Documento PDF</a>
                        @else
                            <img src="{{ public_path('firma/' . $persona->firma_consentimiento) }}"
                                alt="Documento de la persona" style="width: 200px; height: auto;">
                        @endif
                    @else
                        <p>Documento de la persona no encontrado</p>
                    @endif
                </div>
            </div>
        </section>
        @if (strtolower(pathinfo(public_path('firma/' . $persona->firma_consentimiento), PATHINFO_EXTENSION)) === 'pdf')
        @else
            <div style="page-break-before: always;"></div>
        @endif


        <section>
            <h2>Familiares</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>Celular</th>
                        <th>Tipo de Relación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($familiares as $familiar)
                        <tr>
                            <td>{{ $familiar->cnombres }}</td>
                            <td>{{ $familiar->capellidos }}</td>
                            <td>{{ $familiar->direccion_vivienda }}</td>
                            <td>{{ $familiar->celular }}</td>
                            <td>{{ $familiar->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section>
            <h2>Registro Diario de Atenciones</h2>
            <table>
                <thead>
                    <tr>
                        <th>Actividades</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diarios as $diario)
                        <tr>
                            <td>{{ $diario->actividades_paciente_descripcion }}</td>
                            <td>{{ $diario->rdfecha }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section>
            <h2>Preferencias del Paciente</h2>
            <table>
                <thead>
                    <tr>
                        <th>Preferencias Alimenticias</th>
                        <th>Preferencias de Habitación</th>
                        <th>Necesidades Especiales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preferencias as $preferencia)
                        <tr>
                            <td>{{ $preferencia->alimento }}</td>
                            <td>{{ $preferencia->habitacion }}</td>
                            <td>{{ $preferencia->necesidades }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section>
            <h2>Seguimientos Vitales del Paciente</h2>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Presión Arterial</th>
                        <th>Frecuencia Cardiaca</th>
                        <th>Temperatura</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seguimientos as $seguimiento)
                        <tr>
                            <td>{{ $seguimiento->fecha_seguimiento }}</td>
                            <td>{{ $seguimiento->presion }}</td>
                            <td>{{ $seguimiento->frecuencia }}</td>
                            <td>{{ $seguimiento->temperatura }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section>
            <h2>Incidentes Ocurridos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Fecha del Incidente</th>
                        <th>Descripción del Incidente</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($incidentes as $incidente)
                        <tr>
                            <td>{{ $incidente->incidente_fecha }}</td>
                            <td>{{ $incidente->incidente_descripcion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section>
            <h2>Pruebas Médicas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Fecha de la Prueba</th>
                        <th>Descripción de la Prueba</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pruebas as $prueba)
                        <tr>
                            <td>{{ $prueba->fecha_prueba_medica }}</td>
                            <td>{{ $prueba->descripcion_prueba_medica }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section>
            <h2>Antecedentes Médicos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Enfermedades Crónicas</th>
                        <th>Alergias a Medicamentos</th>
                        <th>Cirugías Previas</th>
                        <th>Historial de Enfermedades</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($antecedentes as $antecedente)
                        <tr>
                            <td>{{ $antecedente->enfermedades_cronicas }}</td>
                            <td>{{ $antecedente->alergias_medicamentos }}</td>
                            <td>{{ $antecedente->cirugias_previas }}</td>
                            <td>{{ $antecedente->historial_enfermedades }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section>
            <h2>Historial de Medicamentos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Medicamento</th>
                        <th>Medicamento Anterior Recetado</th>
                        <th>Dosis y Duración</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historiales as $historial)
                        <tr>
                            <td>{{ $historial->medicamentos }}</td>
                            <td>{{ $historial->medicamentos_anteriores_recetados }}</td>
                            <td>{{ $historial->dosis_duracion_medicacion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>




        <section class="firma-section">
            <h2>Qr del Documento</h2>
            <a
                href="http://127.0.0.1:8000/carnet/buscar?nombre={{ urlencode($persona->nombrepersona . ' ' . $persona->apellidos) }}">
                <img src="{{ $qrCode }}" alt="QR del Documento" class="firma-img">
            </a>
        </section>

        <!-- Agrega secciones similares para Medicamentos, Preferencias, Seguimientos, Incidentes, Pruebas, Antecedentes, Historiales -->
    </div>
</body>

</html>
