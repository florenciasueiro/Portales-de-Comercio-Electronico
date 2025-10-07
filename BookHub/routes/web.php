<?php

use Illuminate\Support\Facades\Route;
use App\Models\Libro;
use App\Models\Noticia;

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
