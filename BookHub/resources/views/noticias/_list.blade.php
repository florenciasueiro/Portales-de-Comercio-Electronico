@php
    $items = $noticias->items();
    $hero = count($items) ? $items[0] : null;
    $rest = count($items) > 1 ? array_slice($items, 1) : [];
@endphp

@if($hero)
  <div class="relative mb-10 rounded-2xl overflow-hidden border border-neutral-700">
    <div class="absolute inset-0 bg-black/50"></div>
    @if($hero->imagen)
      @php $src = preg_match('/^(https?:|data:)/', $hero->imagen) ? $hero->imagen : asset(ltrim($hero->imagen,'/')); @endphp
      <img src="{{ $src }}" alt="{{ $hero->titulo }}" class="w-full h-64 md:h-96 object-cover">
    @else
      <div class="w-full h-64 md:h-96 bg-neutral-900"></div>
    @endif
    <div class="absolute inset-0 p-6 md:p-10 flex flex-col justify-end">
      <div class="flex items-center gap-3 mb-3">
        @if($hero->categoria)
          <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-900/40 text-red-200 border border-red-600/40 text-xs md:text-sm">{{ $hero->categoria }}</span>
        @endif
        @if(\Carbon\Carbon::parse($hero->fecha)->isAfter(\Carbon\Carbon::now()->subDays(7)))
          <span class="inline-flex items-center px-2 py-1 rounded bg-green-700/40 text-green-200 text-xs">Nuevo</span>
        @endif
      </div>
      <h2 class="text-2xl md:text-3xl font-bold text-white drop-shadow-md">{{ $hero->titulo }}</h2>
      <p class="text-neutral-200 text-sm md:text-base mt-2 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($hero->contenido), 160) }}</p>
      <div class="mt-4">
        <a href="{{ route('noticias.show', $hero) }}" class="px-5 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-white font-semibold transition">Leer la nota completa</a>
      </div>
    </div>
  </div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
  @forelse($rest as $n)
    <article class="bg-neutral-800/80 border border-neutral-700 rounded-xl overflow-hidden shadow-md transition transform hover:scale-[1.01] hover:shadow-lg">
      @if($n->imagen)
        @php $src = preg_match('/^(https?:|data:)/', $n->imagen) ? $n->imagen : asset(ltrim($n->imagen,'/')); @endphp
        <img src="{{ $src }}" alt="{{ $n->titulo }}" class="w-full h-40 object-cover">
      @else
        <div class="w-full h-40 bg-neutral-900"></div>
      @endif
      <div class="p-4">
        <div class="flex items-center gap-2 mb-2">
          @if($n->categoria)
            <span class="inline-flex items-center px-2 py-1 rounded-full bg-red-900/40 text-red-200 border border-red-600/40 text-xs">{{ $n->categoria }}</span>
          @endif
          <span class="text-xs text-neutral-400">{{ \Carbon\Carbon::parse($n->fecha)->format('d/m/Y') }}</span>
          @if(\Carbon\Carbon::parse($n->fecha)->isAfter(\Carbon\Carbon::now()->subDays(7)))
            <span class="ml-auto inline-flex items-center px-2 py-1 rounded bg-green-700/40 text-green-200 text-xs">Nuevo</span>
          @endif
        </div>
        <h3 class="text-lg font-semibold text-red-300">{{ $n->titulo }}</h3>
        <p class="text-sm text-neutral-300 mt-1 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($n->contenido), 120) }}</p>
        <div class="mt-3 flex justify-between items-center">
          <a href="{{ route('noticias.show', $n) }}" class="text-red-400 hover:text-red-300 font-medium">Leer más →</a>
          @auth
            @if(auth()->user()->is_admin)
              <div class="flex gap-3 text-sm">
                <a href="{{ route('noticias.edit', $n) }}" class="text-neutral-300 hover:text-white">Editar</a>
              </div>
            @endif
          @endauth
        </div>
      </div>
    </article>
  @empty
    <div class="col-span-full text-center text-neutral-400 py-8">No hay noticias para esta búsqueda.</div>
  @endforelse
</div>

<div class="mt-8">{!! $noticias->withQueryString()->links() !!}</div>