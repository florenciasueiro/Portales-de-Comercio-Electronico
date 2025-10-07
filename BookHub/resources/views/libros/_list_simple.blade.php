@php
    // Render listado simple tipo tabla para admins
@endphp
<div class="bg-neutral-800/80 border border-neutral-700 rounded-xl overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-neutral-900 text-neutral-300">
      <tr>
        <th class="p-3 text-left">Portada</th>
        <th class="p-3 text-left">Título</th>
        <th class="p-3 text-left">Autor</th>
        <th class="p-3 text-left">Categoría</th>
        <th class="p-3 text-right">Precio</th>
        <th class="p-3 text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
    @forelse($libros as $b)
      @php $src = $b->imagen ? (preg_match('/^(https?:|data:)/', $b->imagen) ? $b->imagen : asset(ltrim($b->imagen,'/'))) : null; @endphp
      <tr class="border-t border-neutral-700 hover:bg-neutral-800/60">
        <td class="p-3">
          @if($src)
            <img src="{{ $src }}" alt="{{ $b->titulo }}" class="w-12 h-16 object-cover rounded border border-neutral-700">
          @else
            <div class="w-12 h-16 bg-neutral-900 rounded border border-neutral-700"></div>
          @endif
        </td>
        <td class="p-3 text-neutral-100">{{ $b->titulo }}</td>
        <td class="p-3 text-neutral-300">{{ $b->autor }}</td>
        <td class="p-3 text-neutral-300">{{ $b->categoria }}</td>
        <td class="p-3 text-neutral-100 text-right">@if(!is_null($b->precio)) ${{ number_format($b->precio,2,',','.') }} @endif</td>
        <td class="p-3 text-center">
          <div class="inline-flex items-center gap-3">
            <a href="{{ route('libros.show', $b) }}" class="text-red-400 hover:text-red-300">Ver</a>
            @auth
              @if(auth()->user()->is_admin)
                <a href="{{ route('libros.edit', $b) }}" class="text-neutral-300 hover:text-white">Editar</a>
              @endif
            @endauth
          </div>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="6" class="p-4 text-center text-neutral-400">No hay libros para esta búsqueda.</td>
      </tr>
    @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{!! $libros->withQueryString()->links() !!}</div>