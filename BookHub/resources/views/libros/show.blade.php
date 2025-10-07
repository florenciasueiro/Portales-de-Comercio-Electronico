@extends('layouts.app')
@section('title', 'Detalle Libro - MangaHub')
@section('content')
<section class="min-h-screen bg-gradient-to-b from-neutral-900 to-black text-gray-100 py-12 px-6">
  <div class="max-w-4xl mx-auto bg-neutral-800/80 p-8 rounded-2xl shadow-lg border border-red-600/30">

    <div class="flex justify-between items-center mb-6">
      <a href="{{ route('libros.index') }}"
         class="px-5 py-2 bg-transparent border border-red-500 text-red-400 rounded-lg hover:bg-red-500/20 transition">← Volver al listado</a>
      @if($libro->categoria)
        <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-900/40 text-red-200 border border-red-600/40 text-sm">{{ $libro->categoria }}</span>
      @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="md:col-span-1 flex justify-center">
        @if($libro->imagen)
          @php $src = preg_match('/^(https?:|data:)/', $libro->imagen) ? $libro->imagen : asset(ltrim($libro->imagen,'/')); @endphp
          <img src="{{ $src }}" alt="{{ $libro->titulo }}" class="w-full max-w-xs rounded-xl border border-neutral-700 shadow-md">
        @else
          <div class="w-full max-w-xs h-64 flex items-center justify-center bg-neutral-900 border border-neutral-700 rounded-xl text-neutral-400">Sin portada</div>
        @endif
      </div>

      <div class="md:col-span-2">
        <h1 class="text-3xl font-bold mb-4 text-red-400 drop-shadow-md">{{ $libro->titulo }}</h1>
        <div class="space-y-2 text-sm">
          <p><span class="text-neutral-400">Autor:</span> <span class="text-gray-100">{{ $libro->autor }}</span></p>
          <p><span class="text-neutral-400">Precio:</span> <span class="text-gray-100">${{ number_format($libro->precio,2,',','.') }}</span></p>
        </div>

        @if($libro->descripcion)
          <div class="mt-6">
            <h2 class="text-lg font-semibold text-red-300 mb-2">Descripción</h2>
            <p class="text-gray-200 leading-relaxed">{{ $libro->descripcion }}</p>
          </div>
        @endif
      </div>
    </div>

  </div>
</section>
@endsection