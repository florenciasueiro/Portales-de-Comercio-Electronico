<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noticias - BookHub</title>
    <style>
        body { font-family: system-ui, Arial; margin: 24px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f5f5f5; }
        .actions a, .actions form { display: inline-block; margin-right: 6px; }
        .topbar { display:flex; justify-content: space-between; align-items:center; margin-bottom: 12px; }
        .status { color: green; }
    </style>
    </head>
<body>
    <div class="topbar">
        <h1>Noticias</h1>
        <div>
            <a href="/" style="margin-right:10px;">Inicio</a>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('noticias.create') }}">Nueva Noticia</a>
                @endif
            @endauth
        </div>
    </div>

    @if(session('status'))
        <p class="status">{{ session('status') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($noticias as $noticia)
            <tr>
                <td>{{ $noticia->id }}</td>
                <td><a href="{{ route('noticias.show', $noticia) }}">{{ $noticia->titulo }}</a></td>
                <td>{{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</td>
                <td class="actions">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('noticias.edit', $noticia) }}">Editar</a>
                            <form action="{{ route('noticias.destroy', $noticia) }}" method="POST" onsubmit="return confirm('¿Eliminar noticia?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        @endif
                    @endauth
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div style="margin-top:12px;">
        {{ $noticias->links() }}
    </div>
</body>
</html>