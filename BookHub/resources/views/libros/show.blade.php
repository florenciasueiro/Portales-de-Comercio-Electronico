@extends('layouts.app')
@section('title', 'Detalle Libro - MangaHub')
@section('content')
    <a class="btn" href="{{ route('libros.index') }}">Volver al listado</a>
    <div class="card" style="max-width:800px;">
        <h1>{{ $libro->titulo }}</h1>
        <p><strong>Autor:</strong> {{ $libro->autor }}</p>
        <p><strong>Precio:</strong> ${{ number_format($libro->precio,2,',','.') }}</p>
        @if($libro->categoria)
            <p><strong>Categoría:</strong> {{ $libro->categoria }}</p>
        @endif
        @if($libro->imagen)
            <img src="{{ $libro->imagen }}" alt="{{ $libro->titulo }}">
        @endif
        @if($libro->descripcion)
            <p>{{ $libro->descripcion }}</p>
        @endif
    </div>
@endsection