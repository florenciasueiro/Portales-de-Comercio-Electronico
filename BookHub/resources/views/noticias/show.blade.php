<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Noticia - BookHub</title>
    <style> body { font-family: system-ui, Arial; margin: 24px; } .card { border:1px solid #ddd; border-radius:8px; padding:12px; max-width:800px; } img { max-width:100%; height:auto; } </style>
</head>
<body>
    <a href="{{ route('noticias.index') }}">Volver al listado</a>
    <div class="card">
        <h1>{{ $noticia->titulo }}</h1>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</p>
        @if($noticia->imagen)
            <img src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }}">
        @endif
        <p>{{ $noticia->contenido }}</p>
    </div>
</body>
</html>