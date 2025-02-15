<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Adopciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ddd;
        }

        .qr {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Reporte de Adopciones</h1>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Adoptante</th>
                <th>Paciente</th>
                <th>Motivo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adopciones as $adopcion)
                <tr>
                    <td>{{ $adopcion->fecha }}</td>
                    <td>
                        @foreach ($adoptantes as $adoptante)
                            @if ($adoptante->id == $adopcion->adoptante)
                                {{ $adoptante->nombres }} {{ $adoptante->apellidos }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($personas as $persona)
                            @if ($persona->id == $adopcion->persona)
                                {{ $persona->nombres }} {{ $persona->apellidos }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $adopcion->motivo }}</td>
                    <td>{{ $adopcion->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="qr">
        <p>Código QR del enlace del PDF:</p>
        <img src="{{ $qrData }}" alt="QR del PDF" width="200">
    </div>
</body>

</html>
