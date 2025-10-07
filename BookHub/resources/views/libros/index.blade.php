@extends('layouts.app')
@section('title', 'Libros - MangaHub')
@section('content')
    <div class="section" style="display:flex; justify-content:space-between; align-items:center;">
        <h1>Libros</h1>
        <div>
            @auth
                @if(auth()->user()->is_admin)
                    <a class="btn" href="{{ route('libros.create') }}">Nuevo Libro</a>
                @endif
            @endauth
        </div>
    </div>

    <table class="table">
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
                    @auth
                        @if(auth()->user()->is_admin)
                            <a class="btn" href="{{ route('libros.edit', $libro) }}">Editar</a>
                            <form action="{{ route('libros.destroy', $libro) }}" method="POST" onsubmit="return confirm('¿Eliminar libro?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">Eliminar</button>
                            </form>
                        @endif
                    @endauth
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div style="margin-top:12px;">
        {{ $libros->links() }}
    </div>
@endsection