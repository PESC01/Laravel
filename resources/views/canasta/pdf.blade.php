<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Canasta Alimentaria</title>
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

        .group-title {
            margin: 30px 0 10px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Reporte de Canasta Alimentaria</h1>
    @php
        // Agrupamos los registros por fecha
        $groupedCanastas = $canastas->groupBy('fecha');
    @endphp

    @foreach ($groupedCanastas as $fecha => $registros)
        <div class="group-title">Fecha: {{ $fecha }}</div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $registro)
                    <tr>
                        <td>{{ $registro->persona->nombres ?? 'N/A' }}</td>
                        <td>{{ $registro->persona->apellidos ?? 'N/A' }}</td>
                        <td>{{ $registro->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <div class="qr">
        <p>Código QR del enlace del PDF:</p>
        <img src="{{ $qrData }}" alt="QR del PDF" width="200">
    </div>
</body>

</html>
