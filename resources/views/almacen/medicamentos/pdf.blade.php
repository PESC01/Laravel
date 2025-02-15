<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Medicamentos</title>
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
    <h1>Reporte de Medicamentos</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Tipo</th>
                <th>Proveedor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicamentos as $medicamento)
                <tr>
                    <td>{{ $medicamento->nombre_medicamento }}</td>
                    <td>{{ $medicamento->descripcion }}</td>
                    <td>{{ $medicamento->cantidad }}</td>
                    <td>
                        @foreach ($tipos as $tipo)
                            @if ($tipo->id == $medicamento->tipo)
                                {{ $tipo->nombre_medicamento }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($proveedores as $proveedor)
                            @if ($proveedor->id == $medicamento->proveedor)
                                {{ $proveedor->nombres }} {{ $proveedor->apellidos }}
                            @endif
                        @endforeach
                    </td>
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
