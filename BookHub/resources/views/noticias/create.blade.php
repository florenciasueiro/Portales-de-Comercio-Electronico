@extends('layouts.app')
@section('title', 'Nueva Noticia - MangaHub')
@section('content')
<section class="min-h-screen bg-gradient-to-b from-neutral-900 to-black text-gray-100 py-12 px-6">
  <div class="max-w-3xl mx-auto bg-neutral-800/80 p-8 rounded-2xl shadow-lg border border-red-600/30">

    <h1 class="text-3xl font-bold mb-8 text-center text-red-400 drop-shadow-md">📰 Nueva Noticia</h1>

    @auth
      @if(!auth()->user()->is_admin)
        <div class="mb-6 bg-yellow-900/30 border border-yellow-600/40 text-yellow-200 p-4 rounded-lg">Acceso restringido a administradores.</div>
      @endif
    @endauth

    @if ($errors->any())
      <div class="mb-6 bg-red-900/30 border border-red-600/40 text-red-200 p-4 rounded-lg">
        <strong>Corrige los siguientes errores:</strong>
        <ul class="mt-2 list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <div>
        <label class="block text-sm font-semibold mb-2">Título</label>
        <input type="text" name="titulo" value="{{ old('titulo') }}" required
               class="w-full p-3 bg-neutral-900 border border-neutral-700 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 transition">
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-semibold mb-2">Fecha</label>
          <input type="date" name="fecha" value="{{ old('fecha') }}" required
                 class="w-full p-3 bg-neutral-900 border border-neutral-700 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 transition">
        </div>
        <div>
          <label class="block text-sm font-semibold mb-2">Categoría</label>
          <input type="text" name="categoria" value="{{ old('categoria') }}" placeholder="Ej: Anime, Manga, Industria"
                 class="w-full p-3 bg-neutral-900 border border-neutral-700 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 transition">
        </div>
      </div>

      <div>
        <label class="block text-sm font-semibold mb-2">Imagen (archivo)</label>
        <input type="file" name="imagen_file" accept="image/*"
               class="w-full text-sm text-gray-400 bg-neutral-900 border border-neutral-700 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700 cursor-pointer">
      </div>

      <div>
        <label class="block text-sm font-semibold mb-2">Imagen (URL)</label>
        <div class="flex gap-2">
          <input id="imagen-url" type="text" name="imagen" value="{{ old('imagen') }}" placeholder="Opcional si subes archivo"
                 class="flex-1 p-3 bg-neutral-900 border border-neutral-700 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 transition">
        </div>
        <div class="mt-2 flex gap-2">
          <input id="fuente-url" type="text" placeholder="URL externa para extraer miniatura (og:image)"
                 class="flex-1 p-3 bg-neutral-900 border border-neutral-700 rounded-lg focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition">
          <button type="button" id="extraer-og" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg text-white font-semibold transition">Extraer miniatura</button>
        </div>
        <p class="text-xs text-gray-400 mt-1">Si la noticia proviene de otra web, ingresá la URL y extraeremos su og:image.</p>
        <div id="resultados-og" class="mt-3 grid grid-cols-2 md:grid-cols-3 gap-3"></div>
      </div>

      <div>
        <label class="block text-sm font-semibold mb-2">Contenido</label>
        <textarea name="contenido" rows="5" required
                  class="w-full p-3 bg-neutral-900 border border-neutral-700 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 transition">{{ old('contenido') }}</textarea>
      </div>

      <div class="flex justify-between pt-6">
        <a href="{{ route('noticias.index') }}"
           class="px-5 py-2 bg-transparent border border-red-500 text-red-400 rounded-lg hover:bg-red-500/20 transition">← Volver al listado</a>

        <button type="submit"
                class="px-6 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-white font-semibold transition">Guardar</button>
      </div>
    </form>
  </div>
</section>
<script>
  (function(){
    const btn = document.getElementById('extraer-og');
    const inputFuente = document.getElementById('fuente-url');
    const inputImagen = document.getElementById('imagen-url');
    const contenedor = document.getElementById('resultados-og');
    if(!btn) return;
    btn.addEventListener('click', async () => {
      const u = (inputFuente?.value || '').trim();
      if(!u){ alert('Ingresá la URL externa.'); return; }
      btn.disabled = true; btn.textContent = 'Buscando...';
      contenedor.innerHTML = '';
      try{
        const res = await fetch("{{ route('noticias.ogImage') }}" + `?url=${encodeURIComponent(u)}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        const data = await res.json();
        (data.data || []).slice(0,6).forEach(item => {
          const card = document.createElement('button');
          card.type = 'button';
          card.className = 'group relative rounded-lg overflow-hidden border border-neutral-700 hover:border-purple-500 transition';
          card.innerHTML = `<img src="${item.image}" alt="${item.title}" class="w-full h-32 object-cover">` +
                           `<span class='absolute bottom-0 left-0 right-0 bg-black/50 text-xs p-1 truncate'>${item.title}</span>`;
          card.onclick = () => { inputImagen.value = item.image; };
          contenedor.appendChild(card);
        });
        if(!contenedor.children.length){ contenedor.innerHTML = '<div class="text-sm text-gray-400">Sin resultados.</div>'; }
      }catch(e){
        contenedor.innerHTML = '<div class="text-sm text-red-400">Error al extraer imagen.</div>';
      }finally{
        btn.disabled = false; btn.textContent = 'Extraer miniatura';
      }
    });
  })();
</script>
@endsection