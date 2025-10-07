@extends('layouts.app')
@section('title', 'Editar Libro - MangaHub')
@section('content')
    <h1>Editar Libro</h1>
    <a class="btn" href="{{ route('libros.index') }}">Volver al listado</a>

    <form action="{{ route('libros.update', $libro) }}" method="POST" enctype="multipart/form-data" style="max-width:640px; margin-top:12px;">
        @csrf
        @method('PUT')
        <label>Título <input type="text" name="titulo" value="{{ old('titulo', $libro->titulo) }}" required></label>
        <label>Autor <input type="text" name="autor" value="{{ old('autor', $libro->autor) }}" required></label>
        <label>Precio <input type="number" step="0.01" name="precio" value="{{ old('precio', $libro->precio) }}" required></label>
        <label>Categoría <input type="text" name="categoria" value="{{ old('categoria', $libro->categoria) }}"></label>
        <label>Portada (archivo) <input type="file" name="imagen_file" accept="image/*"></label>
        <label>Imagen (URL) <input type="text" name="imagen" value="{{ old('imagen', $libro->imagen) }}" placeholder="Opcional si subes archivo"></label>
        <label>Descripción <textarea name="descripcion" rows="4">{{ old('descripcion', $libro->descripcion) }}</textarea></label>
        <button class="btn" type="submit" style="margin-top:12px;">Actualizar</button>
    </form>
@endsection