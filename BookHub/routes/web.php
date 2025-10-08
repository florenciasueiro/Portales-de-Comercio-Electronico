<?php

use Illuminate\Support\Facades\Route;
use App\Models\Libro;
use App\Models\Noticia;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $libros = Libro::latest()->get();
    $noticias = Noticia::latest()->get();
    return view('home', compact('libros', 'noticias'));
});

// Rutas de login/logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.perform');

// Definir create/store ANTES del recurso público para evitar colisión con '/{id}'
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/libros/create', [LibroController::class, 'create'])->name('libros.create');
    Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');
    Route::get('/noticias/create', [NoticiaController::class, 'create'])->name('noticias.create');
    Route::post('/noticias', [NoticiaController::class, 'store'])->name('noticias.store');
});

// Invitados: pueden ver listados y detalles
Route::resource('libros', LibroController::class)->only(['index', 'show']);
Route::resource('noticias', NoticiaController::class)->only(['index', 'show']);

// Admin: crear/editar/eliminar
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard principal de administración
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('libros', LibroController::class)->except(['index', 'show', 'create', 'store']);
    Route::resource('noticias', NoticiaController::class)->except(['index', 'show', 'create', 'store']);       

    // Utilidades de administración: búsqueda automática de imágenes
    Route::get('/libros/image-search', [LibroController::class, 'imageSearch'])->name('libros.imageSearch');   
    Route::get('/libros/image-by-id', [LibroController::class, 'imageById'])->name('libros.imageById');
    Route::get('/noticias/og-image', [NoticiaController::class, 'ogImage'])->name('noticias.ogImage');
});
