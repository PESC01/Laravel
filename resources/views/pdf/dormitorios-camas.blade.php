<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Informe de Dormitorios y Camas</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>

<body>
    <div class="container">
        <h1>Informe de Dormitorios y Camas</h1>
        @foreach ($dormitorios as $dormitorio)
            <h2>{{ $dormitorio->nombre }}</h2>
            <p><strong>Capacidad:</strong> {{ $dormitorio->capacidad }}</p>
            <p>{{ $dormitorio->descripcion }}</p>
            @if ($dormitorio->camas->isNotEmpty())
                <table>
                    <thead>
                        <tr>
                            <th>Identificador</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dormitorio->camas as $cama)
                            <tr>
                                <td>{{ $cama->identificador }}</td>
                                <td>
                                    @if ($ocupacion = $cama->ocupaciones->where('estado', 'ocupado')->first())
                                        Ocupada por: - {{ $ocupacion->persona->nombres }}
                                    @else
                                        Libre
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay camas asociadas.</p>
            @endif
            <hr>
        @endforeach
        <div style="text-align: center; margin-top: 30px;">
            <p>QR del PDF:</p>
            <img src="{{ $qrData }}" alt="QR del PDF" style="width: 200px; height: auto;">
        </div>
    </div>
</body>

</html>
