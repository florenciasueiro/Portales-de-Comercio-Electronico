<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MangaHub')</title>
    <style>
        :root {
            --bg: #0d0d0d;            /* negro profundo */
            --panel: #141414;        /* panel oscuro */
            --text: #f2f2f2;         /* texto claro */
            --muted: #cfcfcf;        /* texto secundario */
            --primary: #d32f2f;      /* rojo intenso */
            --accent: #ff5858;       /* rojo brillante */
            --border: #222;          /* bordes */
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: system-ui, Arial, sans-serif; background: var(--bg); color: var(--text); }
        a { color: var(--text); text-decoration: none; }
        a:hover { color: var(--accent); }
        .topbar { display:flex; align-items:center; justify-content:space-between; padding: 14px 20px; background: #000; border-bottom: 2px solid var(--primary); position: sticky; top:0; z-index: 10; }
        .brand { font-weight: 800; letter-spacing: 1px; }
        .nav a { margin-right: 14px; }
        .container { max-width: 1100px; margin: 24px auto; padding: 0 20px; }
        .section { margin-top: 24px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px; }
        .card { background: var(--panel); border: 1px solid var(--border); border-radius: 10px; padding: 14px; }
        .muted { color: var(--muted); }
        img { max-width: 100%; height: auto; border-radius: 6px; }
        .table { width: 100%; border-collapse: collapse; background: var(--panel); }
        .table th, .table td { border: 1px solid var(--border); padding: 10px; }
        .table th { background: #111; color: var(--text); }
        .actions a, .actions form { display:inline-block; margin-right:8px; }
        .btn { display:inline-block; padding:8px 12px; border-radius:6px; border:1px solid var(--primary); color: var(--text); background: transparent; cursor:pointer; }
        .btn:hover { background: var(--primary); }
        .status { color: #7ce37c; }
        .hero-title { font-size: 48px; font-weight: 900; letter-spacing: 2px; }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="brand">MangaHub</div>
        <div class="nav">
            <a href="/">Inicio</a>
            <a href="{{ route('libros.index') }}">Libros</a>
            <a href="{{ route('noticias.index') }}">Noticias</a>
        </div>
        <div class="nav">
            @auth
                <form action="{{ route('logout.perform') }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn" type="submit">Cerrar sesión</button>
                </form>
                @if(auth()->user()->is_admin)
                    <span class="muted" style="margin-left:8px;">Admin</span>
                @endif
            @else
                <a class="btn" href="{{ route('login.show') }}">Iniciar sesión</a>
            @endauth
        </div>
    </div>

    <div class="container">
        @if(session('status'))
            <p class="status">{{ session('status') }}</p>
        @endif
        @yield('content')
    </div>
</body>
</html>