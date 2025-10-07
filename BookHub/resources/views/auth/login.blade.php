@extends('layouts.app')
@section('title', 'Iniciar sesión - MangaHub')
@section('content')
<div class="login-container">
    <div class="login-card">
        <h1>Iniciar sesión</h1>

        <a class="back-btn" href="/">← Volver al inicio</a>

        @if($errors->any())
            <div class="error-box">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.perform') }}" method="POST" class="login-form">
            @csrf
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Contraseña</label>
            <input type="password" name="password" required>

            <button class="btn-login" type="submit">Entrar</button>
        </form>

        <p class="muted">Admin: admin@bookhub.test / secret123</p>
    </div>
</div>
@endsection

<style>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    padding: 40px 0;
}

.login-card {
    background: #111;
    border: 2px solid #b00020;
    border-radius: 12px;
    padding: 40px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 10px 30px rgba(176, 0, 32, 0.4);
    text-align: center;
    animation: drop 0.6s ease;
}

@keyframes drop {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-card h1 {
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: #ff3344;
}

.back-btn {
    display: inline-block;
    margin-bottom: 20px;
    color: #ff3344;
    text-decoration: none;
    font-weight: 500;
    transition: 0.2s;
}

.back-btn:hover {
    color: #ff6677;
}

.error-box {
    background: rgba(176, 0, 32, 0.15);
    border: 1px solid #b00020;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 15px;
    text-align: left;
}

.error-box ul {
    margin: 0;
    padding-left: 18px;
}

.error-box li {
    color: #ff8080;
    font-size: 0.9rem;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.login-form label {
    text-align: left;
    font-weight: 600;
    color: #ccc;
}

.login-form input {
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #b00020;
    background-color: #1a1a1a;
    color: #fff;
    outline: none;
    transition: border-color 0.3s;
}

.login-form input:focus {
    border-color: #ff3344;
}

.btn-login {
    margin-top: 10px;
    background-color: #b00020;
    border: none;
    border-radius: 6px;
    color: #fff;
    padding: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-login:hover {
    background-color: #ff3344;
}
</style>
