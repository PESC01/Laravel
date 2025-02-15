<!DOCTYPE html>
<html>

<head>
    <title>Informe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .info {
            margin-bottom: 20px;
        }

        .content {
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Informe</h1>
        <div class="info">
            <strong>Persona:</strong> {{ $informe->persona->nombres }} {{ $informe->persona->apellidos }}<br>
            <strong>Título:</strong> {{ $informe->titulo }}
        </div>
        <div class="content">
            {!! $informe->contenido !!}
        </div>
    </div>
</body>

</html>
