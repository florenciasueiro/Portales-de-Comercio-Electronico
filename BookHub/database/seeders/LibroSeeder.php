<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Libro;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Limpiar libros existentes para evitar mezclas con placeholders
        DB::table('libros')->truncate();

        $libros = [];
        try {
            // Top Manga y fallback Top Anime
            $topManga = Http::timeout(8)->get('https://api.jikan.moe/v4/top/manga', [
                'limit' => 20,
            ])->json()['data'] ?? [];

            $topAnime = Http::timeout(8)->get('https://api.jikan.moe/v4/top/anime', [
                'limit' => 20,
            ])->json()['data'] ?? [];

            // Mapear manga a libros
            foreach ($topManga as $m) {
                $img = $m['images']['jpg']['large_image_url'] ?? ($m['images']['jpg']['image_url'] ?? null);
                $author = null;
                if (!empty($m['authors']) && isset($m['authors'][0]['name'])) {
                    $author = $m['authors'][0]['name'];
                }
                $category = null;
                if (!empty($m['genres']) && isset($m['genres'][0]['name'])) {
                    $category = $m['genres'][0]['name'];
                } elseif (!empty($m['themes']) && isset($m['themes'][0]['name'])) {
                    $category = $m['themes'][0]['name'];
                } elseif (!empty($m['demographics']) && isset($m['demographics'][0]['name'])) {
                    $category = $m['demographics'][0]['name'];
                }
                $libros[] = [
                    'titulo' => $m['title'] ?? 'Título desconocido',
                    'autor' => $author ?? 'Autor desconocido',
                    'precio' => round(mt_rand(990, 1990) / 100, 2),
                    'descripcion' => $m['synopsis'] ?? null,
                    'imagen' => $img,
                    'categoria' => $category,
                ];
            }

            // Mapear anime a libros (sin autor real, se usa estudio o placeholder)
            foreach ($topAnime as $a) {
                $img = $a['images']['jpg']['large_image_url'] ?? ($a['images']['jpg']['image_url'] ?? null);
                $studio = null;
                if (!empty($a['studios']) && isset($a['studios'][0]['name'])) {
                    $studio = $a['studios'][0]['name'];
                }
                $category = null;
                if (!empty($a['genres']) && isset($a['genres'][0]['name'])) {
                    $category = $a['genres'][0]['name'];
                } elseif (!empty($a['themes']) && isset($a['themes'][0]['name'])) {
                    $category = $a['themes'][0]['name'];
                } elseif (!empty($a['demographics']) && isset($a['demographics'][0]['name'])) {
                    $category = $a['demographics'][0]['name'];
                }
                $libros[] = [
                    'titulo' => $a['title'] ?? 'Título desconocido',
                    'autor' => $studio ?? 'Estudio desconocido',
                    'precio' => round(mt_rand(990, 1990) / 100, 2),
                    'descripcion' => $a['synopsis'] ?? null,
                    'imagen' => $img,
                    'categoria' => $category,
                ];
            }
        } catch (\Throwable $e) {
            // Si la API falla, no interrumpir seeding
        }

        // Persistir
        foreach ($libros as $item) {
            Libro::updateOrCreate(
                ['titulo' => $item['titulo']],
                $item
            );
        }
    }
}
