<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Proveedores</title>
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


        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1,
        h2 {
            color: #333;
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
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Reporte de Proveedores</h1>
    <table>
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>C.I.</th>
                <th>Celular</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->nombres }}</td>
                    <td>{{ $proveedor->apellidos }}</td>
                    <td>{{ $proveedor->ci }}</td>
                    <td>{{ $proveedor->celular }}</td>
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
