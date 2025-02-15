<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Informe del Dormitorio: {{ $dormitorio->nombre }}</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>

<body>
    <div class="container">
        <h1>Informe del Dormitorio: {{ $dormitorio->nombre }}</h1>
        <p><strong>Capacidad:</strong> {{ $dormitorio->capacidad }}</p>
        <p>{{ $dormitorio->descripcion }}</p>

        <h2>Camas</h2>
        @if ($camas->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Identificador</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($camas as $cama)
                        <tr>
                            <td>{{ $cama->identificador }}</td>
                            <td>
                                @if ($ocupacion = $cama->ocupaciones->where('estado', 'ocupado')->first())
                                    Ocupada por: {{ $ocupacion->persona->nombres }}
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

        <div style="text-align: center; margin-top: 30px;">
            <p>QR del PDF:</p>
            <img src="{{ $qrCode }}" alt="QR Code">
        </div>
    </div>
</body>

</html>
