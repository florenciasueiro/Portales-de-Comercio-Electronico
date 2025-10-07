@extends('layouts.app')
@section('title', 'Nuevo Libro - MangaHub')
@section('content')
    <h1>Nuevo Libro</h1>
    <a class="btn" href="{{ route('libros.index') }}">Volver al listado</a>
    @auth
        @if(!auth()->user()->is_admin)
            <p>Acceso restringido a administradores.</p>
        @endif
    @endauth

    <form action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data" style="max-width:640px; margin-top:12px;">
        @csrf
        <label>Título <input type="text" name="titulo" required></label>
        <label>Autor <input type="text" name="autor" required></label>
        <label>Precio <input type="number" step="0.01" name="precio" required></label>
        <label>Categoría <input type="text" name="categoria"></label>
        <label>Portada (archivo) <input type="file" name="imagen_file" accept="image/*"></label>
        <label>Imagen (URL) <input type="text" name="imagen" placeholder="Opcional si subes archivo"></label>
        <label>Descripción <textarea name="descripcion" rows="4"></textarea></label>
        <button class="btn" type="submit" style="margin-top:12px;">Guardar</button>
    </form>
@endsection