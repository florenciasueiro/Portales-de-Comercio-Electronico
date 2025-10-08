<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MangaHub')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playpen+Sans:wght@100..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-1P8rQn7bCjvQHxWqF3NQv1SYo5FZtXo9pCkEoRZfJmQY3mMZ2P4QjQeJYqT5tQZevWQmVh7W9mG5B1P2k1QqVg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --bg: #0d0d0d;            /* negro profundo */
            --panel: #141414;        /* panel oscuro */
            --text: #f2f2f2;         /* texto claro */
            --muted: #cfcfcf;        /* texto secundario */
            --primary: #d32f2f;      /* rojo intenso */
            --accent: #ff5858;       /* rojo brillante */
            --border: #222;          /* bordes */
            --display: 'Kanit', sans-serif; /* fuente de títulos */
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Inter', system-ui, Arial, sans-serif; background: var(--bg); color: var(--text); position: relative; }
        /* textura y viñeteado sutil en rojo */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                repeating-linear-gradient(45deg, rgba(211,47,47,0.06) 0 2px, transparent 2px 6px),
                radial-gradient(circle at 20% 10%, rgba(255,88,88,0.06), transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(211,47,47,0.08), transparent 35%);
            pointer-events: none;
            mix-blend-mode: multiply;
            opacity: 0.9;
            z-index: 0;
        }
        a { color: var(--text); text-decoration: none; }
        a:hover { color: var(--accent); }
        .topbar { display:flex; align-items:center; justify-content:space-between; padding: 14px 20px; background: rgba(0,0,0,0.6); backdrop-filter: blur(8px); border-bottom: 1px solid #7c1313; position: sticky; top:0; z-index: 10; }
        .brand { font-weight: 800; letter-spacing: 1px; font-family: var(--display); font-size: 22px; }
        .nav a { margin-right: 14px; }
        .theme-toggle { margin-left: 8px; }
        .container { max-width: 1100px; margin: 20px auto; padding: 0 20px; }
        .section { margin: 20px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px; }
        .card { background: var(--panel); border: 1px solid var(--border); border-radius: 10px; padding: 14px; }
        .muted { color: var(--muted); font-size: 1.2rem; text-align: center;}
        img { max-width: 100%; height: auto; border-radius: 6px; }
        .table { width: 100%; border-collapse: collapse; background: var(--panel); }
        .table th, .table td { border: 1px solid var(--border); padding: 10px; }
        .table th { background: #111; color: var(--text); }
        .actions a, .actions form { display:inline-block; margin-right:8px; }
        .btn { display:inline-block; padding:8px 12px; border-radius:6px; border:1px solid var(--primary); color: var(--text); background: transparent; cursor:pointer; letter-spacing: 0.5px; }
        .btn:hover { background: var(--primary); color: white; }
        .status { color: #7ce37c; }
        h1, h2, h3, .hero-title { font-family: var(--display); letter-spacing: 0.5px; }
        .hero-title { font-size: 56px; font-weight: 900; letter-spacing: 2px; }

        /* Badge */
        .badge { display:inline-block; padding: 2px 8px; font-size: 12px; border-radius: 999px; border: 1px solid #7c1313; background: rgba(211,47,47,0.15); color: var(--text); }

        .banner {
            position: relative;
            margin: auto;
            max-width: 1100px;
        }

        .banner img{
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .banner::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.9));
        }
        .banner h1{
            position: relative;
            margin: 20px auto;
            color: #b09eff;
            font-size: 200px;
            text-align: center;
            font-weight: 600;
            text-shadow: 0 0 10px #9f4dff, 0 0 20px #7c1313;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { text-shadow: 0 0 10px #9f4dff, 0 0 20px #7c1313; }
            50% { text-shadow: 0 0 20px #b09eff, 0 0 40px #7c1313; }
        }

        /* Responsive banner title */
        @media (max-width: 1024px) {
            .banner h1 { font-size: 120px; }
        }
        @media (max-width: 600px) {
            .banner h1 { font-size: 64px; }
        }

        /* Tarjetas de libros */
        .book-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .book-card:hover { transform: translateY(-8px); box-shadow: 0 0 20px rgba(255, 0, 90, 0.3); }
        .book-cover { border-radius: 10px; height: 250px; object-fit: cover; margin-bottom: 10px; }

        /* Footer */
        footer { text-align: center; padding: 20px; color: #ccc; border-top: 1px solid #7c1313; margin-top: 50px; }
        .socials a { color: #7c1313; margin: 0 8px; transition: color 0.3s; }
        .socials a:hover { color: #ff4d6d; }
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
            <button class="btn theme-toggle" id="themeToggle" title="Cambiar tema"><i id="themeIcon" class="fa-solid fa-moon"></i></button>
        </div>
    </div>

    <div class="banner">
        <img src="{{ asset('assets/banner.gif') }}" alt="Banner">
        <h1>MangaHub</h1>
    </div>

    <div class="container">
        @if(session('status'))
            <p class="status">{{ session('status') }}</p>
        @endif
        @yield('content')
    </div>
    <footer>
        <p>© 2025 MangaHub | Proyecto académico - Escuela Da Vinci</p>
        <div class="socials">
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="X/Twitter"><i class="fab fa-x-twitter"></i></a>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            if (window.AOS) {
                AOS.init({ duration: 800, once: true, offset: 60 });
            }
        });
    </script>
    <script>
        (function(){
            const root = document.documentElement;
            const key = 'theme';
            const saved = localStorage.getItem(key);
            const toggleBtn = document.getElementById('themeToggle');
            const icon = document.getElementById('themeIcon');
            function apply(theme){
                if(theme === 'light') {
                    root.setAttribute('data-theme','light');
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    root.setAttribute('data-theme','dark');
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            }
            apply(saved || 'dark');
            toggleBtn?.addEventListener('click', function(){
                const current = root.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
                const next = current === 'light' ? 'dark' : 'light';
                localStorage.setItem(key, next);
                apply(next);
            });
        })();
    </script>
</body>
</html>
