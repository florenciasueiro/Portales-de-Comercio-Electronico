@extends('layouts.app')
@section('title', 'Detalle Noticia - MangaHub')
@section('content')
    <a class="btn" href="{{ route('noticias.index') }}">Volver al listado</a>
    <div class="card" style="max-width:800px;">
        <h1>{{ $noticia->titulo }}</h1>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</p>
        @if($noticia->imagen)
            <img src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }}">
        @endif
        <p>{{ $noticia->contenido }}</p>
    </div>
@endsection