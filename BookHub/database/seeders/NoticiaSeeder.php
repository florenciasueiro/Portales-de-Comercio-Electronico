<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Noticia;
use Illuminate\Support\Carbon;

class NoticiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $noticias = [
            [
                'titulo' => 'Nueva temporada de Jujutsu Kaisen anunciada',
                'contenido' => 'Se confirma la producción de una nueva temporada con adaptación del arco siguiente.',
                'imagen' => 'https://via.placeholder.com/800x450?text=Jujutsu+Kaisen',
                'categoria' => 'Anime',
                'fecha' => Carbon::now()->subDays(5)->format('Y-m-d'),
            ],
            [
                'titulo' => 'Chainsaw Man revela artes del próximo volumen',
                'contenido' => 'Tatsuki Fujimoto comparte bocetos que muestran el tono del nuevo capítulo.',
                'imagen' => 'https://via.placeholder.com/800x450?text=Chainsaw+Man',
                'categoria' => 'Manga',
                'fecha' => Carbon::now()->subDays(10)->format('Y-m-d'),
            ],
            [
                'titulo' => 'One Piece alcanza un nuevo hito de ventas',
                'contenido' => 'La serie supera récords históricos en tiradas y lecturas globales.',
                'imagen' => 'https://via.placeholder.com/800x450?text=One+Piece',
                'categoria' => 'Industria',
                'fecha' => Carbon::now()->subDays(15)->format('Y-m-d'),
            ],
            [
                'titulo' => 'Anunciada película de Spy x Family',
                'contenido' => 'La familia Forger regresa a la gran pantalla con una historia original.',
                'imagen' => 'https://via.placeholder.com/800x450?text=Spy+x+Family',
                'categoria' => 'Anime',
                'fecha' => Carbon::now()->subDays(20)->format('Y-m-d'),
            ],
            [
                'titulo' => 'Demon Slayer muestra trailer del arco siguiente',
                'contenido' => 'El nuevo avance destaca la animación y el desarrollo de personajes.',
                'imagen' => 'https://via.placeholder.com/800x450?text=Demon+Slayer',
                'categoria' => 'Anime',
                'fecha' => Carbon::now()->subDays(25)->format('Y-m-d'),
            ],
            [
                'titulo' => 'Fullmetal Alchemist recibe nueva edición conmemorativa',
                'contenido' => 'Incluye arte adicional y comentarios de Hiromu Arakawa.',
                'imagen' => 'https://via.placeholder.com/800x450?text=Fullmetal+Alchemist',
                'categoria' => 'Manga',
                'fecha' => Carbon::now()->subDays(30)->format('Y-m-d'),
            ],
        ];

        foreach ($noticias as $n) {
            Noticia::updateOrCreate(
                ['titulo' => $n['titulo']],
                [
                    'contenido' => $n['contenido'],
                    'imagen' => $n['imagen'],
                    'categoria' => $n['categoria'] ?? null,
                    'fecha' => $n['fecha'],
                ]
            );
        }
    }
}
