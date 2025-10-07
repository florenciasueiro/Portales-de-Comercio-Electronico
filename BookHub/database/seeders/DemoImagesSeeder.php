<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Libro;
use App\Models\Noticia;

class DemoImagesSeeder extends Seeder
{
    public function run(): void
    {
        // Imágenes demo externas (rápidas y seguras)
        $bookUrls = [
            'https://placehold.co/600x900/111/fff?text=Book+Cover',
            'https://placehold.co/600x900/1f1f1f/fff?text=Manga',
            'https://placehold.co/600x900/222/fff?text=Libro',
        ];

        $newsUrls = [
            'https://placehold.co/1200x600/111/fff?text=News+Banner',
            'https://placehold.co/1200x600/1f1f1f/fff?text=Noticia',
            'https://placehold.co/1200x600/222/fff?text=Anime+News',
        ];

        // Asignar imágenes demo a TODOS para asegurar visualización inmediata
        Libro::query()->chunkById(100, function($chunk) use ($bookUrls) {
            foreach ($chunk as $libro) {
                $libro->imagen = $bookUrls[array_rand($bookUrls)];
                $libro->save();
            }
        });

        Noticia::query()->chunkById(100, function($chunk) use ($newsUrls) {
            foreach ($chunk as $noticia) {
                $noticia->imagen = $newsUrls[array_rand($newsUrls)];
                $noticia->save();
            }
        });
    }
}