<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros - BookHub</title>
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
        <h1>Libros</h1>
        <div>
            <a href="/" style="margin-right:10px;">Inicio</a>
            <a href="{{ route('libros.create') }}">Nuevo Libro</a>
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
                <th>Autor</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($libros as $libro)
            <tr>
                <td>{{ $libro->id }}</td>
                <td><a href="{{ route('libros.show', $libro) }}">{{ $libro->titulo }}</a></td>
                <td>{{ $libro->autor }}</td>
                <td>${{ number_format($libro->precio,2,',','.') }}</td>
                <td>{{ $libro->categoria }}</td>
                <td class="actions">
                    <a href="{{ route('libros.edit', $libro) }}">Editar</a>
                    <form action="{{ route('libros.destroy', $libro) }}" method="POST" onsubmit="return confirm('¿Eliminar libro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div style="margin-top:12px;">
        {{ $libros->links() }}
    </div>
</body>
</html>