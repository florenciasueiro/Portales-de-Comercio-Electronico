@extends('layouts.app')
@section('title', 'Iniciar sesión - MangaHub')
@section('content')
<section class="min-h-screen bg-gradient-to-b from-neutral-900 to-black text-gray-100 py-12 px-6">
  <div class="max-w-md mx-auto bg-neutral-800/80 p-8 rounded-2xl shadow-lg border border-red-600/30" data-aos="fade-in">
    <h1 class="text-3xl font-bold mb-6 text-center text-red-400 drop-shadow-md">🔒 Iniciar sesión</h1>

    <a href="/" class="inline-block mb-6 px-4 py-2 bg-transparent border border-red-500 text-red-400 rounded-lg hover:bg-red-500/20 transition">← Volver al inicio</a>

    @if($errors->any())
      <div class="mb-6 bg-red-900/30 border border-red-600/40 text-red-200 p-4 rounded-lg">
        <strong>Corrige los siguientes errores:</strong>
        <ul class="mt-2 list-disc list-inside">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('login.perform') }}" method="POST" class="space-y-5">
      @csrf
      <div>
        <label class="block text-sm font-semibold mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
               class="w-full p-3 bg-neutral-900 border border-neutral-700 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 transition" />
      </div>

      <div>
        <label class="block text-sm font-semibold mb-2">Contraseña</label>
        <input type="password" name="password" required
               class="w-full p-3 bg-neutral-900 border border-neutral-700 rounded-lg focus:border-red-500 focus:ring-1 focus:ring-red-500 transition" />
      </div>

      <button type="submit"
              class="w-full px-6 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-white font-semibold transition">Entrar</button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-400">Admin: admin@bookhub.test / secret123</p>
  </div>
</section>
@endsection
