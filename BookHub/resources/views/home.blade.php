@extends('layouts.app')
@section('title', 'MangaHub - Inicio')
@section('content')
  @auth
    @if(auth()->user()->is_admin)
      <p style="text-align:center; margin-top:12px;">
        <a class="btn" href="{{ route('admin.dashboard') }}">Ir al Panel de Administración</a>
      </p>
    @endif
  @endauth

  <main class="container" role="main">
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
                            <p>{{ \Illuminate\Support\Str::limit($libro->descripcion, 140) }}</p>
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
                        <p>{{ \Illuminate\Support\Str::limit($noticia->contenido, 160) }}</p>
                        <p><a class="btn" href="{{ route('noticias.show', $noticia) }}">Ver detalle</a></p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
  </main>
  <footer role="contentinfo" style="padding:20px; text-align:center; color:#aaa;">
    <small>&copy; {{ date('Y') }} MangaHub. Todos los derechos reservados.</small>
  </footer>
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