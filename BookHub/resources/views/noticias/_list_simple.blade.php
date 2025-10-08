<div class="bg-neutral-800/80 border border-neutral-700 rounded-xl overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-neutral-900 text-neutral-300">
      <tr>
        <th class="p-3 text-left">Imagen</th>
        <th class="p-3 text-left">Título</th>
        <th class="p-3 text-left">Categoría</th>
        <th class="p-3 text-left">Fecha</th>
        <th class="p-3 text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
    @forelse($noticias as $n)
      @php $src = $n->imagen ? (preg_match('/^(https?:|data:)/', $n->imagen) ? $n->imagen : asset(ltrim($n->imagen,'/'))) : null; @endphp
      <tr class="border-t border-neutral-700 hover:bg-neutral-800/60">
        <td class="p-3">
          @if($src)
            <img src="{{ $src }}" alt="{{ $n->titulo }}" class="w-12 h-12 object-cover rounded border border-neutral-700">
          @else
            <div class="w-12 h-12 bg-neutral-900 rounded border border-neutral-700"></div>
          @endif
        </td>
        <td class="p-3 text-neutral-100">{{ $n->titulo }}</td>
        <td class="p-3 text-neutral-300">{{ $n->categoria }}</td>
        <td class="p-3 text-neutral-300">{{ $n->fecha }}</td>
        <td class="p-3 text-center">
          <div class="inline-flex items-center gap-3">
            <a href="{{ route('noticias.show', $n) }}" class="text-red-400 hover:text-red-300">Ver</a>
            @auth
              @if(auth()->user()->is_admin)
                <a href="{{ route('noticias.edit', $n) }}" class="text-neutral-300 hover:text-white">Editar</a>
                <form method="POST" action="{{ route('noticias.destroy', $n) }}" onsubmit="return confirm('¿Eliminar esta noticia?');" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-400 hover:text-red-300">Eliminar</button>
                </form>
              @endif
            @endauth
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5" class="p-4 text-center text-neutral-400">No hay noticias para esta búsqueda.</td>
      </tr>
    @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{!! $noticias->withQueryString()->links() !!}</div>