<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Noticia - BookHub</title>
    <style> body { font-family: system-ui, Arial; margin: 24px; } label { display:block; margin-top:8px; } </style>
</head>
<body>
    <h1>Editar Noticia</h1>
    <a href="{{ route('noticias.index') }}">Volver al listado</a>

    <form action="{{ route('noticias.update', $noticia) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Título <input type="text" name="titulo" value="{{ old('titulo', $noticia->titulo) }}" required></label>
        <label>Fecha <input type="date" name="fecha" value="{{ old('fecha', $noticia->fecha) }}" required></label>
        <label>Imagen (URL) <input type="text" name="imagen" value="{{ old('imagen', $noticia->imagen) }}"></label>
        <label>Contenido <textarea name="contenido" rows="5" required>{{ old('contenido', $noticia->contenido) }}</textarea></label>
        <button type="submit" style="margin-top:12px;">Actualizar</button>
    </form>
</body>
</html>