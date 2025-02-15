<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Documentos Legales</title>
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
    <h1>Reporte de Documentos Legales</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre del Documento</th>
                <th>Descripción</th>
                <th>Documento</th>
                <th>Nombre de la Persona</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $documento)
                <tr>
                    <td>{{ $documento->nombre_documento }}</td>
                    <td>{{ $documento->descripcion_documento }}</td>
                    <td>
                        <a href="{{ asset('images/' . $documento->imagen_documento) }}" target="_blank">Ver Documento</a>
                    </td>
                    <td>{{ $documento->persona->nombres }} {{ $documento->persona->apellidos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="qr">
        <p>Código QR del enlace del PDF:</p>
        @if ($qrData)
            <img src="{{ $qrData }}" alt="QR del PDF" width="200">
        @else
            <p>Código QR no disponible</p>
        @endif
    </div>
</body>

</html>
