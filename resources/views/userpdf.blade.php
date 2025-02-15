<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Informe de Persona</h1>

        <section>
            <h2>Información Básica</h2>
            <div class="row">
                @if (file_exists(public_path('firma/' . $persona->firma_consentimiento)))
                    <img src="{{ public_path('image/' . $persona->image) }}" alt="Imagen de la persona"
                        style="width: 200px; height: auto;">
                @else
                    <p>Imagen no encontrada</p>
                @endif





                <div class="row">
                    <p><strong>Nombre:</strong> {{ $persona->nombrepersona }} {{ $persona->apellidos }}</p>
                    <p><strong>CI:</strong> {{ $persona->ci }}</p>
                    <p><strong>Género:</strong> {{ $persona->nombre_genero }}</p>
                    <p><strong>Nacionalidad:</strong> {{ $persona->nombre_nacionalidad }}</p>
                    <p><strong>Fecha de Nacimiento:</strong>
                        {{ \Carbon\Carbon::parse($persona->fech_nac)->format('d/m/Y') }}</p>
                    <p><strong>Estado Civil:</strong> {{ $persona->estado_civil }}</p>
                    <p><strong>Documento:</strong></p>
                    @if (file_exists(public_path('firma/' . $persona->firma_consentimiento)))
                        <img src="{{ public_path('firma/' . $persona->firma_consentimiento) }}"
                            alt="Documento de la persona" style="width: 200px; height: auto;">
                    @else
                        <p>Documento de la persona no encontrado</p>
                    @endif

                </div>

            </div>


            <!-- Agrega más detalles según sea necesario -->
        </section>
        <!-- Familiares -->
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

        <!-- Diarios -->
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

        <div class="firma-section">
            <p><strong>Qr del Documento</strong></p>
            <h3>Qr del Documento</h3>
            <a href="http://127.0.0.1:8000/carnet/buscar">
                <img src="{{ $qrCode }}" alt="QR del Documento" class="img-thumbnail firma-img"
                    style="width: 200px; height: auto;">
            </a>
        </div>

        <!-- Agrega secciones similares para Medicamentos, Preferencias, Seguimientos, Incidentes, Pruebas, Antecedentes, Historiales -->
    </div>
</body>

</html>
