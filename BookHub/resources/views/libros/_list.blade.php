@php
    $items = $libros->items();
    $hero = $items[0] ?? null;
    $cards = array_slice($items, 1);
@endphp

@if($hero)
  <article class="mb-8 bg-neutral-800/80 border border-neutral-700 rounded-xl overflow-hidden shadow-md">
    <div class="grid grid-cols-1 lg:grid-cols-2">
      <div class="relative">
        @if($hero->imagen)
          @php $src = preg_match('/^(https?:|data:)/', $hero->imagen) ? $hero->imagen : asset(ltrim($hero->imagen,'/')); @endphp
          <img src="{{ $src }}" alt="{{ $hero->titulo }}" class="w-full h-64 lg:h-full object-cover">
        @else
          <div class="w-full h-64 lg:h-full bg-neutral-900"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-neutral-900/70 via-transparent to-transparent"></div>
      </div>
      <div class="p-6 lg:p-8 flex flex-col justify-center">
        <div class="flex items-center gap-2 mb-3">
          @if($hero->categoria)
            <span class="inline-flex items-center px-2 py-1 rounded-full bg-red-900/40 text-red-200 border border-red-600/40 text-xs">{{ $hero->categoria }}</span>
          @endif
          @if(!is_null($hero->precio))
            <span class="ml-auto text-sm text-neutral-300">${{ number_format($hero->precio,2,',','.') }}</span>
          @endif
        </div>
        <h2 class="text-2xl lg:text-3xl font-bold text-red-300">{{ $hero->titulo }}</h2>
        <p class="text-sm text-neutral-400">por {{ $hero->autor }}</p>
        @if($hero->descripcion)
          <p class="text-sm lg:text-base text-neutral-200 mt-3">{{ \Illuminate\Support\Str::limit(strip_tags($hero->descripcion), 200) }}</p>
        @endif
        <div class="mt-5 flex items-center gap-4">
          <a href="{{ route('libros.show', $hero) }}" class="px-4 py-2 rounded-md bg-red-700 hover:bg-red-600 text-white font-medium">Ver detalles</a>
          @auth
            @if(auth()->user()->is_admin)
              <a href="{{ route('libros.edit', $hero) }}" class="text-neutral-300 hover:text-white">Editar</a>
              <form method="POST" action="{{ route('libros.destroy', $hero) }}" onsubmit="return confirm('¿Eliminar este libro?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-400 hover:text-red-300">Eliminar</button>
              </form>
            @endif
          @endauth
        </div>
      </div>
    </div>
  </article>
@endif

@if(count($cards))
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @foreach($cards as $b)
      <article class="bg-neutral-800/80 border border-neutral-700 rounded-xl overflow-hidden shadow-md transition transform hover:scale-[1.01] hover:shadow-lg">
        @if($b->imagen)
          @php $src = preg_match('/^(https?:|data:)/', $b->imagen) ? $b->imagen : asset(ltrim($b->imagen,'/')); @endphp
          <img src="{{ $src }}" alt="{{ $b->titulo }}" class="w-full h-48 object-cover">
        @else
          <div class="w-full h-48 bg-neutral-900"></div>
        @endif
        <div class="p-4">
          <div class="flex items-center gap-2 mb-2">
            @if($b->categoria)
              <span class="inline-flex items-center px-2 py-1 rounded-full bg-red-900/40 text-red-200 border border-red-600/40 text-xs">{{ $b->categoria }}</span>
            @endif
            @if(!is_null($b->precio))
              <span class="ml-auto text-sm text-neutral-300">${{ number_format($b->precio,2,',','.') }}</span>
            @endif
          </div>
          <h3 class="text-lg font-semibold text-red-300">{{ $b->titulo }}</h3>
          <p class="text-xs text-neutral-400">por {{ $b->autor }}</p>
          @if($b->descripcion)
            <p class="text-sm text-neutral-300 mt-1 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($b->descripcion), 120) }}</p>
          @endif
          <div class="mt-3 flex justify-between items-center">
            <a href="{{ route('libros.show', $b) }}" class="text-red-400 hover:text-red-300 font-medium">Ver detalles →</a>
            @auth
              @if(auth()->user()->is_admin)
                <div class="flex gap-3 text-sm items-center">
                  <a href="{{ route('libros.edit', $b) }}" class="text-neutral-300 hover:text-white">Editar</a>
                  <form method="POST" action="{{ route('libros.destroy', $b) }}" onsubmit="return confirm('¿Eliminar este libro?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400 hover:text-red-300">Eliminar</button>
                  </form>
                </div>
              @endif
            @endauth
          </div>
        </div>
      </article>
    @endforeach
  </div>
@elseif(!$hero)
  <div class="col-span-full text-center text-neutral-400 py-8">No hay libros para esta búsqueda.</div>
@endif

<div class="mt-8">{!! $libros->withQueryString()->links() !!}</div>