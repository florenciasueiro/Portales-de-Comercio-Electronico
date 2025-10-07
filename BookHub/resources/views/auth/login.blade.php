@extends('layouts.app')
@section('title', 'Iniciar sesión - MangaHub')
@section('content')
    <h1>Iniciar sesión</h1>
    <a class="btn" href="/">Volver al inicio</a>

    @if($errors->any())
        <div class="card" style="border-color:#b00020;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login.perform') }}" method="POST" style="margin-top:12px; max-width:420px;">
        @csrf
        <label>Email <input type="email" name="email" value="{{ old('email') }}" required></label>
        <label>Contraseña <input type="password" name="password" required></label>
        <button class="btn" type="submit" style="margin-top:12px;">Entrar</button>
    </form>

    <p class="muted" style="margin-top:16px;">Admin: admin@bookhub.test / secret123</p>
@endsection