-app/resources/views/almacen/suministros/pdf.blade.php
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Suministros</title>
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
    <h1>Reporte de Suministros</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Tipo de Suministro</th>
                <th>Proveedor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suministros as $suministro)
                <tr>
                    <td>{{ $suministro->nombre }}</td>
                    <td>{{ $suministro->descripcion }}</td>
                    <td>{{ $suministro->cantidad }}</td>
                    <td>
                        @foreach ($tipos as $tipo)
                            @if ($tipo->id == $suministro->tipo)
                                {{ $tipo->nombre }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($proveedores as $proveedor)
                            @if ($proveedor->id == $suministro->proveedor)
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
