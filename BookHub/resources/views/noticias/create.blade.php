@extends('layouts.app')
@section('title', 'Nueva Noticia - MangaHub')
@section('content')
    <h1>Nueva Noticia</h1>
    <a class="btn" href="{{ route('noticias.index') }}">Volver al listado</a>
    @auth
        @if(!auth()->user()->is_admin)
            <p>Acceso restringido a administradores.</p>
        @endif
    @endauth

    <form action="{{ route('noticias.store') }}" method="POST" style="max-width:640px; margin-top:12px;">
        @csrf
        <label>Título <input type="text" name="titulo" required></label>
        <label>Fecha <input type="date" name="fecha" required></label>
        <label>Imagen (URL) <input type="text" name="imagen"></label>
        <label>Contenido <textarea name="contenido" rows="5" required></textarea></label>
        <button class="btn" type="submit" style="margin-top:12px;">Guardar</button>
    </form>
@endsection