@extends('layouts.app')
@section('title', 'MangaHub - Inicio')
@section('content')
    <p class="muted">En <b>MangaHub</b> te conectamos con todo lo que amás del mundo otaku.<br>
                    Encontrá una amplia selección de mangas para comprar, desde clásicos hasta los estrenos más esperados, y enterate de las últimas novedades del anime.<br>
                    ¡Tu próxima historia épica comienza acá!</p>

    <div class="section">
        <h2>Libros</h2>
        @if($libros->isEmpty())
            <p class="muted">No hay libros cargados todavía.</p>
        @else
            <div class="grid">
                @foreach($libros as $libro)
                    <div class="card">
                        <h3>{{ $libro->titulo }}</h3>
                        <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                        @if($libro->imagen)
                            <img src="{{ $libro->imagen }}" alt="{{ $libro->titulo }}">
                        @endif
                        <p><strong>Precio:</strong> ${{ number_format($libro->precio, 2, ',', '.') }}</p>
                        @if($libro->categoria)
                            <p><strong>Categoría:</strong> {{ $libro->categoria }}</p>
                        @endif
                        @if($libro->descripcion)
                            <p>{{ $libro->descripcion }}</p>
                        @endif
                        <p><a class="btn" href="{{ route('libros.show', $libro) }}">Ver detalle</a></p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="section">
        <h2>Noticias</h2>
        @if($noticias->isEmpty())
            <p class="muted">No hay noticias publicadas todavía.</p>
        @else
            <div class="grid">
                @foreach($noticias as $noticia)
                    <div class="card">
                        <h3>{{ $noticia->titulo }}</h3>
                        @if($noticia->imagen)
                            <img src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }}">
                        @endif
                        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</p>
                        <p>{{ $noticia->contenido }}</p>
                        <p><a class="btn" href="{{ route('noticias.show', $noticia) }}">Ver detalle</a></p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection