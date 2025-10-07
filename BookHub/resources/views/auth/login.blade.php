<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - BookHub</title>
    <style>
        body { font-family: system-ui, Arial; margin: 24px; }
        label { display:block; margin-top:8px; }
        .error { color: #b00020; }
    </style>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <a href="/">Volver al inicio</a>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login.perform') }}" method="POST" style="margin-top:12px;">
        @csrf
        <label>Email <input type="email" name="email" value="{{ old('email') }}" required></label>
        <label>Contraseña <input type="password" name="password" required></label>
        <button type="submit" style="margin-top:12px;">Entrar</button>
    </form>

    <p style="margin-top:16px;">Admin: admin@bookhub.test / secret123</p>
</body>
</html>