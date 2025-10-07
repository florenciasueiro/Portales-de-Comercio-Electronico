<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Libro - BookHub</title>
    <style> body { font-family: system-ui, Arial; margin: 24px; } .card { border:1px solid #ddd; border-radius:8px; padding:12px; max-width:640px; } img { max-width:100%; height:auto; } </style>
</head>
<body>
    <a href="{{ route('libros.index') }}">Volver al listado</a>
    <div class="card">
        <h1>{{ $libro->titulo }}</h1>
        <p><strong>Autor:</strong> {{ $libro->autor }}</p>
        <p><strong>Precio:</strong> ${{ number_format($libro->precio,2,',','.') }}</p>
        @if($libro->categoria)
            <p><strong>Categoría:</strong> {{ $libro->categoria }}</p>
        @endif
        @if($libro->imagen)
            <img src="{{ $libro->imagen }}" alt="{{ $libro->titulo }}">
        @endif
        @if($libro->descripcion)
            <p>{{ $libro->descripcion }}</p>
        @endif
    </div>
</body>
</html>