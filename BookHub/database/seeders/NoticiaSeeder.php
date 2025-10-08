<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Noticia;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class NoticiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Limpiar noticias existentes para evitar placeholders
        DB::table('noticias')->truncate();

        $items = [];
        try {
            // Top manga y anime para generar noticias con contenido real (sinopsis/imágenes)
            $topManga = Http::timeout(8)->get('https://api.jikan.moe/v4/top/manga', [
                'limit' => 10,
            ])->json()['data'] ?? [];
            $topAnime = Http::timeout(8)->get('https://api.jikan.moe/v4/top/anime', [
                'limit' => 10,
            ])->json()['data'] ?? [];

            $day = 0;
            foreach ($topManga as $m) {
                $img = $m['images']['jpg']['large_image_url'] ?? ($m['images']['jpg']['image_url'] ?? null);
                $items[] = [
                    'titulo' => $m['title'] ?? 'Manga destacado',
                    'contenido' => $m['synopsis'] ?? 'Sin sinopsis',
                    'imagen' => $img,
                    'categoria' => 'Manga',
                    'fecha' => Carbon::now()->subDays($day++)->format('Y-m-d'),
                ];
            }
            foreach ($topAnime as $a) {
                $img = $a['images']['jpg']['large_image_url'] ?? ($a['images']['jpg']['image_url'] ?? null);
                $items[] = [
                    'titulo' => $a['title'] ?? 'Anime destacado',
                    'contenido' => $a['synopsis'] ?? 'Sin sinopsis',
                    'imagen' => $img,
                    'categoria' => 'Anime',
                    'fecha' => Carbon::now()->subDays($day++)->format('Y-m-d'),
                ];
            }
        } catch (\Throwable $e) {
            // Si la API falla, se deja la tabla vacía (sin placeholders)
        }

        foreach ($items as $n) {
            Noticia::updateOrCreate(
                ['titulo' => $n['titulo']],
                $n
            );
        }
    }
}
