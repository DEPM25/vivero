<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Navegación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Menú de Navegación</h1>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('labores.index') }}">Listado de Labores</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('productores.registro') }}">Registro de Productores</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('productor.index') }}">Listado de Productor</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('viveros.index') }}">Listado de Viveros</a>
        </li>
        <li class="list-group-item">
            <a href="{{ url('/') }}">Inicio</a>
        </li>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>