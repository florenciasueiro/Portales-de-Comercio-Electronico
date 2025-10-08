@extends('layouts.app')
@section('title', 'Panel de Administración')
@section('content')
<section class="py-4">
  <h1 class="h3 mb-3">Panel de Administración</h1>
  <p class="text-muted mb-4">Accede a las secciones administrables del sitio.</p>

  <div class="row g-3">
    <div class="col-12 col-md-6">
      <div class="card h-100">
        <div class="card-body">
          <h2 class="h5">Blog / Noticias</h2>
          <p class="mb-3">Gestiona las entradas del blog: crear, editar y eliminar.</p>
          <a href="{{ route('noticias.index') }}" class="btn btn-primary btn-sm">Ir a Noticias</a>
          <a href="{{ route('noticias.create') }}" class="btn btn-outline-primary btn-sm">Crear noticia</a>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="card h-100">
        <div class="card-body">
          <h2 class="h5">Productos / Libros</h2>
          <p class="mb-3">Gestión de libros: alta, modificación y baja.</p>
          <a href="{{ route('libros.index') }}" class="btn btn-primary btn-sm">Ir a Libros</a>
          <a href="{{ route('libros.create') }}" class="btn btn-outline-primary btn-sm">Crear libro</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection