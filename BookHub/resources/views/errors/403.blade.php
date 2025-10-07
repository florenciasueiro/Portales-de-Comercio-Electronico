@extends('layouts.app')
@section('title', 'Acceso Restringido')
@section('content')
<section class="min-h-screen bg-gradient-to-b from-neutral-900 to-black text-gray-100 py-12 px-6">
  <div class="max-w-2xl mx-auto bg-neutral-800/80 p-8 rounded-2xl shadow-lg border border-red-600/30 text-center">
    <h1 class="text-3xl font-bold text-red-500">Acceso restringido</h1>
    <p class="mt-4 text-neutral-300">No tienes permisos para acceder a esta página.</p>
    <div class="mt-6">
      <a href="{{ url('/') }}" class="px-5 py-2 bg-transparent border border-red-500 text-red-400 rounded-lg hover:bg-red-500/20 transition">Volver al inicio</a>
    </div>
  </div>
</section>
@endsection