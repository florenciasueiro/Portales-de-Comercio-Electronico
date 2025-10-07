@extends('layouts.app')
@section('title', 'Noticias - MangaHub')
@section('content')
    <div class="section" style="display:flex; justify-content:space-between; align-items:center;">
        <h1>Noticias</h1>
        <div>
            @auth
                @if(auth()->user()->is_admin)
                    <a class="btn" href="{{ route('noticias.create') }}">Nueva Noticia</a>
                @endif
            @endauth
        </div>
    </div>

    <table class="table">
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
                            <a class="btn" href="{{ route('noticias.edit', $noticia) }}">Editar</a>
                            <form action="{{ route('noticias.destroy', $noticia) }}" method="POST" onsubmit="return confirm('¿Eliminar noticia?');">
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
        {{ $noticias->links() }}
    </div>
@endsection