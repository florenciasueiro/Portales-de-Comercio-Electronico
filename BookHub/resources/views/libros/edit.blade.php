<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Libro - BookHub</title>
    <style> body { font-family: system-ui, Arial; margin: 24px; } label { display:block; margin-top:8px; } </style>
</head>
<body>
    <h1>Editar Libro</h1>
    <a href="{{ route('libros.index') }}">Volver al listado</a>

    <form action="{{ route('libros.update', $libro) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Título <input type="text" name="titulo" value="{{ old('titulo', $libro->titulo) }}" required></label>
        <label>Autor <input type="text" name="autor" value="{{ old('autor', $libro->autor) }}" required></label>
        <label>Precio <input type="number" step="0.01" name="precio" value="{{ old('precio', $libro->precio) }}" required></label>
        <label>Categoría <input type="text" name="categoria" value="{{ old('categoria', $libro->categoria) }}"></label>
        <label>Imagen (URL) <input type="text" name="imagen" value="{{ old('imagen', $libro->imagen) }}"></label>
        <label>Descripción <textarea name="descripcion" rows="4">{{ old('descripcion', $libro->descripcion) }}</textarea></label>
        <button type="submit" style="margin-top:12px;">Actualizar</button>
    </form>
</body>
</html>