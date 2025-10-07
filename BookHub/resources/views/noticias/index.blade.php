@extends('layouts.app')
@section('title', 'Noticias - MangaHub')
@section('content')
<section class="min-h-screen bg-gradient-to-b from-neutral-900 to-black text-gray-100 py-12 px-6">
  <div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-red-400 drop-shadow-md">Noticias</h1>
      @auth
        @if(auth()->user()->is_admin)
          <div class="flex items-center gap-3">
            <a class="px-5 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-white font-semibold transition" href="{{ route('noticias.create') }}">Nueva Noticia</a>
            <div class="inline-flex gap-2">
              <span class="text-sm text-neutral-300 self-center">Vista:</span>
              <button id="viewCards" class="px-3 py-1 rounded-lg border border-neutral-600 text-neutral-200 hover:bg-neutral-800 transition">Tarjetas</button>
              <button id="viewList" class="px-3 py-1 rounded-lg border border-neutral-600 text-neutral-200 hover:bg-neutral-800 transition">Lista</button>
            </div>
          </div>
        @endif
      @endauth
    </div>

    <!-- Filtros rápidos -->
    <div class="mb-6 flex flex-wrap gap-3 items-center">
      <button data-cat="" class="filter-chip px-3 py-1 rounded-full border border-red-500 text-red-400 hover:bg-red-500/20 transition {{ empty($categoria) ? 'bg-red-500/20' : '' }}">Todas</button>
      @foreach($categorias as $cat)
        <button data-cat="{{ $cat }}" class="filter-chip px-3 py-1 rounded-full border border-neutral-600 text-neutral-300 hover:bg-neutral-800 transition {{ ($categoria===$cat) ? 'bg-neutral-800' : '' }}">{{ $cat }}</button>
      @endforeach

      <div class="ml-auto flex items-center gap-2">
        <input id="searchInput" type="text" value="{{ $search }}" placeholder="Buscar noticias..."
               class="w-56 p-2 bg-neutral-900 border border-neutral-700 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 transition">
        <button id="searchBtn" class="px-4 py-2 bg-transparent border border-red-500 text-red-400 rounded-lg hover:bg-red-500/20 transition">Buscar</button>
      </div>
    </div>

    <div id="news-content">
      @include(($view==='simple') ? 'noticias._list_simple' : 'noticias._list', ['noticias' => $noticias])
    </div>
  </div>

  <script>
    (function(){
      const container = document.getElementById('news-content');
      const chips = document.querySelectorAll('.filter-chip');
      const searchInput = document.getElementById('searchInput');
      const searchBtn = document.getElementById('searchBtn');
      const viewCards = document.getElementById('viewCards');
      const viewList = document.getElementById('viewList');
      let currentCat = "{{ $categoria }}";
      let currentView = "{{ ($view==='simple') ? 'simple' : '' }}";

      async function updateContent(cat, search){
        const params = new URLSearchParams();
        if (cat) params.set('categoria', cat);
        if (search) params.set('search', search);
        params.set('ajax','1');
        if (currentView) params.set('view', currentView);
        const url = `{{ route('noticias.index') }}?${params.toString()}`;
        const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        const html = await res.text();
        container.innerHTML = html;
      }

      chips.forEach(btn => {
        btn.addEventListener('click', () => {
          currentCat = btn.dataset.cat || '';
          chips.forEach(b => b.classList.remove('bg-red-500/20', 'bg-neutral-800'));
          if (!currentCat) btn.classList.add('bg-red-500/20'); else btn.classList.add('bg-neutral-800');
          updateContent(currentCat, searchInput.value.trim());
        });
      });

      searchBtn.addEventListener('click', () => updateContent(currentCat, searchInput.value.trim()));
      searchInput.addEventListener('keydown', (e) => { if (e.key === 'Enter') updateContent(currentCat, searchInput.value.trim()); });

      if (viewCards && viewList) {
        viewCards.addEventListener('click', () => { currentView = ''; updateContent(currentCat, searchInput.value.trim()); });
        viewList.addEventListener('click', () => { currentView = 'simple'; updateContent(currentCat, searchInput.value.trim()); });
      }
    })();
  </script>
</section>
@endsection