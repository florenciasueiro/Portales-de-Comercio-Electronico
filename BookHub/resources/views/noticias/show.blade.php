@extends('layouts.app')
@section('title', 'Detalle Noticia - MangaHub')
@section('content')
<section class="min-h-screen bg-gradient-to-b from-neutral-900 to-black text-gray-100 py-12 px-6">
  <div class="max-w-4xl mx-auto bg-neutral-800/80 p-8 rounded-2xl shadow-lg border border-red-600/30">

    <div class="flex justify-between items-center mb-6">
      <a href="{{ route('noticias.index') }}"
         class="px-5 py-2 bg-transparent border border-red-500 text-red-400 rounded-lg hover:bg-red-500/20 transition">← Volver al listado</a>
      @if($noticia->categoria)
        <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-900/40 text-red-200 border border-red-600/40 text-sm">{{ $noticia->categoria }}</span>
      @endif
    </div>

    <div class="space-y-6">
      <h1 class="text-3xl font-bold text-red-400 drop-shadow-md">{{ $noticia->titulo }}</h1>
      <p class="text-sm text-neutral-400">Fecha: <span class="text-gray-100">{{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</span></p>

      @if($noticia->imagen)
        @php $src = preg_match('/^(https?:|data:)/', $noticia->imagen) ? $noticia->imagen : asset(ltrim($noticia->imagen,'/')); @endphp
        <div class="flex justify-center">
          <img src="{{ $src }}" alt="{{ $noticia->titulo }}" class="w-full max-w-xl rounded-xl border border-neutral-700 shadow-md">
        </div>
      @else
        <div class="w-full h-64 flex items-center justify-center bg-neutral-900 border border-neutral-700 rounded-xl text-neutral-400">Sin imagen</div>
      @endif

      <div>
        <h2 class="text-lg font-semibold text-red-300 mb-2">Contenido</h2>
        <p class="text-gray-200 leading-relaxed">{{ $noticia->contenido }}</p>
      </div>
    </div>

  </div>
</section>
@endsection