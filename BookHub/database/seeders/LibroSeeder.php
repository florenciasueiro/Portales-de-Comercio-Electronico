<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Libro;
use Illuminate\Support\Str;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mangas = [
            ['titulo' => 'One Piece', 'autor' => 'Eiichiro Oda', 'categoria' => 'Shonen', 'precio' => 12.99, 'descripcion' => 'Aventuras piratas en busca del One Piece.', 'imagen' => 'https://via.placeholder.com/400x300?text=One+Piece'],
            ['titulo' => 'Naruto', 'autor' => 'Masashi Kishimoto', 'categoria' => 'Shonen', 'precio' => 11.99, 'descripcion' => 'La historia del ninja Naruto Uzumaki.', 'imagen' => 'https://via.placeholder.com/400x300?text=Naruto'],
            ['titulo' => 'Bleach', 'autor' => 'Tite Kubo', 'categoria' => 'Shonen', 'precio' => 10.99, 'descripcion' => 'Shinigamis, hollows y batallas épicas.', 'imagen' => 'https://via.placeholder.com/400x300?text=Bleach'],
            ['titulo' => 'Attack on Titan', 'autor' => 'Hajime Isayama', 'categoria' => 'Seinen', 'precio' => 13.99, 'descripcion' => 'Humanidad vs titanes tras las murallas.', 'imagen' => 'https://via.placeholder.com/400x300?text=Attack+on+Titan'],
            ['titulo' => 'Fullmetal Alchemist', 'autor' => 'Hiromu Arakawa', 'categoria' => 'Shonen', 'precio' => 12.50, 'descripcion' => 'Los hermanos Elric y la alquimia.', 'imagen' => 'https://via.placeholder.com/400x300?text=Fullmetal+Alchemist'],
            ['titulo' => 'Death Note', 'autor' => 'Tsugumi Ohba / Takeshi Obata', 'categoria' => 'Seinen', 'precio' => 12.00, 'descripcion' => 'Un cuaderno que puede matar y un duelo intelectual.', 'imagen' => 'https://via.placeholder.com/400x300?text=Death+Note'],
            ['titulo' => 'Demon Slayer', 'autor' => 'Koyoharu Gotouge', 'categoria' => 'Shonen', 'precio' => 11.50, 'descripcion' => 'Cazadores de demonios en la era Taisho.', 'imagen' => 'https://via.placeholder.com/400x300?text=Demon+Slayer'],
            ['titulo' => 'Jujutsu Kaisen', 'autor' => 'Gege Akutami', 'categoria' => 'Shonen', 'precio' => 12.20, 'descripcion' => 'Hechicería y maldiciones modernas.', 'imagen' => 'https://via.placeholder.com/400x300?text=Jujutsu+Kaisen'],
            ['titulo' => 'Chainsaw Man', 'autor' => 'Tatsuki Fujimoto', 'categoria' => 'Seinen', 'precio' => 12.90, 'descripcion' => 'Denji y la brutalidad de los demonios.', 'imagen' => 'https://via.placeholder.com/400x300?text=Chainsaw+Man'],
            ['titulo' => 'My Hero Academia', 'autor' => 'Kohei Horikoshi', 'categoria' => 'Shonen', 'precio' => 11.75, 'descripcion' => 'Héroes y estudiantes con “quirks”.', 'imagen' => 'https://via.placeholder.com/400x300?text=My+Hero+Academia'],
            ['titulo' => 'Spy x Family', 'autor' => 'Tatsuya Endo', 'categoria' => 'Shonen', 'precio' => 10.90, 'descripcion' => 'Una familia peculiar: espía, asesina y telépata.', 'imagen' => 'https://via.placeholder.com/400x300?text=Spy+x+Family'],
            ['titulo' => 'Tokyo Ghoul', 'autor' => 'Sui Ishida', 'categoria' => 'Seinen', 'precio' => 12.40, 'descripcion' => 'Ghouls y dilemas entre humanos y monstruos.', 'imagen' => 'https://via.placeholder.com/400x300?text=Tokyo+Ghoul'],
            ['titulo' => 'Slam Dunk', 'autor' => 'Takehiko Inoue', 'categoria' => 'Deportes', 'precio' => 9.99, 'descripcion' => 'Baloncesto escolar con mucha pasión.', 'imagen' => 'https://via.placeholder.com/400x300?text=Slam+Dunk'],
            ['titulo' => 'Monster', 'autor' => 'Naoki Urasawa', 'categoria' => 'Seinen', 'precio' => 13.50, 'descripcion' => 'Thriller psicológico de altísimo nivel.', 'imagen' => 'https://via.placeholder.com/400x300?text=Monster'],
            ['titulo' => 'Vagabond', 'autor' => 'Takehiko Inoue', 'categoria' => 'Seinen', 'precio' => 14.50, 'descripcion' => 'Miyamoto Musashi en un arte visual magnífico.', 'imagen' => 'https://via.placeholder.com/400x300?text=Vagabond'],
        ];

        foreach ($mangas as $manga) {
            Libro::updateOrCreate(
                ['titulo' => $manga['titulo']],
                [
                    'autor' => $manga['autor'],
                    'precio' => $manga['precio'],
                    'descripcion' => $manga['descripcion'],
                    'imagen' => $manga['imagen'],
                    'categoria' => $manga['categoria'],
                ]
            );
        }
    }
}
