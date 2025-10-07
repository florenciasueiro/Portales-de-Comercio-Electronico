<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MangaHub - Inicio</title>
    <style>
        body { font-family: system-ui, Arial, sans-serif; margin: 24px; }
        h1 { margin-bottom: 8px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 12px; }
        .section { margin-top: 24px; }
        .muted { color: #666; }
        img { max-width: 100%; height: auto; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>MangaHub</h1>
    <p class="muted">Catálogo de Libros y Noticias</p>

    <div class="section">
        <h2>Libros</h2>
        @if($libros->isEmpty())
            <p class="muted">No hay libros cargados todavía.</p>
        @else
            <div class="grid">
                @foreach($libros as $libro)
                    <div class="card">
                        <h3>{{ $libro->titulo }}</h3>
                        <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                        @if($libro->imagen)
                            <img src="{{ $libro->imagen }}" alt="{{ $libro->titulo }}">
                        @endif
                        <p><strong>Precio:</strong> ${{ number_format($libro->precio, 2, ',', '.') }}</p>
                        @if($libro->categoria)
                            <p><strong>Categoría:</strong> {{ $libro->categoria }}</p>
                        @endif
                        @if($libro->descripcion)
                            <p>{{ $libro->descripcion }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="section">
        <h2>Noticias</h2>
        @if($noticias->isEmpty())
            <p class="muted">No hay noticias publicadas todavía.</p>
        @else
            <div class="grid">
                @foreach($noticias as $noticia)
                    <div class="card">
                        <h3>{{ $noticia->titulo }}</h3>
                        @if($noticia->imagen)
                            <img src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }}">
                        @endif
                        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</p>
                        <p>{{ $noticia->contenido }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>