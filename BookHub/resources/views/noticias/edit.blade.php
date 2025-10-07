@extends('layouts.app')
@section('title', 'Editar Noticia - MangaHub')
@section('content')
    <h1>Editar Noticia</h1>
    <a class="btn" href="{{ route('noticias.index') }}">Volver al listado</a>

    <form action="{{ route('noticias.update', $noticia) }}" method="POST" style="max-width:640px; margin-top:12px;">
        @csrf
        @method('PUT')
        <label>Título <input type="text" name="titulo" value="{{ old('titulo', $noticia->titulo) }}" required></label>
        <label>Fecha <input type="date" name="fecha" value="{{ old('fecha', $noticia->fecha) }}" required></label>
        <label>Imagen (URL) <input type="text" name="imagen" value="{{ old('imagen', $noticia->imagen) }}"></label>
        <label>Contenido <textarea name="contenido" rows="5" required>{{ old('contenido', $noticia->contenido) }}</textarea></label>
        <button class="btn" type="submit" style="margin-top:12px;">Actualizar</button>
    </form>
@endsection