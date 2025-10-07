@extends('layouts.app')
@section('title', 'MangaHub - Inicio')
@section('content')
    <p class="muted">En <b>MangaHub</b> te conectamos con todo lo que amás del mundo otaku.<br>
                    Encontrá una amplia selección de mangas para comprar, desde clásicos hasta los estrenos más esperados, y enterate de las últimas novedades del anime.<br>
                    ¡Tu próxima historia épica comienza acá!</p>

    <div class="section" data-aos="fade-up">
        <h2>Libros</h2>
        <div style="margin:12px 0;">
            <input id="book-search" type="text" placeholder="Buscar por título o autor" style="width:100%; max-width:420px; padding:10px; border-radius:8px; border:1px solid var(--border); background:#0f0f0f; color:var(--text);">
        </div>
        @if($libros->isEmpty())
            <p class="muted">No hay libros cargados todavía.</p>
        @else
            <div class="grid">
                @foreach($libros as $libro)
                    <div class="card book-card" data-title="{{ strtolower($libro->titulo) }}" data-autor="{{ strtolower($libro->autor) }}" data-aos="fade-up">
                        <h3>{{ $libro->titulo }}</h3>
                        <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                        @if($libro->imagen)
                            <img class="book-cover" src="{{ $libro->imagen }}" alt="{{ $libro->titulo }}">
                        @else
                            <div class="book-cover placeholder">Sin portada</div>
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

    <div class="section" data-aos="fade-up">
        <h2>Noticias Manga</h2>
        @if($noticias->isEmpty())
            <p class="muted">No hay noticias publicadas todavía.</p>
        @else
            <div class="grid">
                @foreach($noticias->take(6) as $noticia)
                    <div class="card" data-aos="fade-up">
                        <h3>{{ $noticia->titulo }}</h3>
                        @if($noticia->imagen)
                            <img class="book-cover" src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }}">
                        @else
                            <div class="book-cover placeholder">Sin imagen</div>
                        @endif
                        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</p>
                        <p>{{ $noticia->contenido }}</p>
                        <p><a class="btn" href="{{ route('noticias.show', $noticia) }}">Ver detalle</a></p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <script>
        (function(){
            const input = document.getElementById('book-search');
            if(!input) return;
            const cards = Array.from(document.querySelectorAll('.book-card'));
            input.addEventListener('input', function(){
                const q = this.value.trim().toLowerCase();
                cards.forEach(card => {
                    const title = card.getAttribute('data-title') || '';
                    const autor = card.getAttribute('data-autor') || '';
                    const match = !q || title.includes(q) || autor.includes(q);
                    card.style.display = match ? '' : 'none';
                });
            });
        })();
    </script>
@endsection