<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Libro - BookHub</title>
    <style> body { font-family: system-ui, Arial; margin: 24px; } label { display:block; margin-top:8px; } </style>
</head>
<body>
    <h1>Nuevo Libro</h1>
    <a href="{{ route('libros.index') }}">Volver al listado</a>

    <form action="{{ route('libros.store') }}" method="POST">
        @csrf
        <label>Título <input type="text" name="titulo" required></label>
        <label>Autor <input type="text" name="autor" required></label>
        <label>Precio <input type="number" step="0.01" name="precio" required></label>
        <label>Categoría <input type="text" name="categoria"></label>
        <label>Imagen (URL) <input type="text" name="imagen"></label>
        <label>Descripción <textarea name="descripcion" rows="4"></textarea></label>
        <button type="submit" style="margin-top:12px;">Guardar</button>
    </form>
</body>
</html>