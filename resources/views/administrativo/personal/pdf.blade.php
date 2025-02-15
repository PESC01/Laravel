<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Personal</title>
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
    <h1>Reporte de Personal</h1>
    <table>
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Celular</th>
                <th>Especialidad</th>

                <th>Antecedentes</th>
                <th>Correo Electrónico</th>
                <th>Rol</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombres }}</td>
                    <td>{{ $empleado->apellidos }}</td>
                    <td>{{ $empleado->celular }}</td>
                    <td>{{ $empleado->calificaciones }}</td>

                    <td>{{ $empleado->antecedentes }}</td>
                    <td>{{ $empleado->user->email }}</td>
                    <td>
                        @foreach ($empleado->user->roles as $role)
                            {{ $role->name }}
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
