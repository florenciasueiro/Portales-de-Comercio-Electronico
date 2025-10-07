<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Noticia - BookHub</title>
    <style> body { font-family: system-ui, Arial; margin: 24px; } label { display:block; margin-top:8px; } </style>
</head>
<body>
    <h1>Nueva Noticia</h1>
    <a href="{{ route('noticias.index') }}">Volver al listado</a>
    @auth
        @if(!auth()->user()->is_admin)
            <p>Acceso restringido a administradores.</p>
        @endif
    @endauth

    <form action="{{ route('noticias.store') }}" method="POST">
        @csrf
        <label>Título <input type="text" name="titulo" required></label>
        <label>Fecha <input type="date" name="fecha" required></label>
        <label>Imagen (URL) <input type="text" name="imagen"></label>
        <label>Contenido <textarea name="contenido" rows="5" required></textarea></label>
        <button type="submit" style="margin-top:12px;">Guardar</button>
    </form>
</body>
</html>