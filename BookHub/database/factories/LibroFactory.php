<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Libro>
 */
class LibroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'autor' => $this->faker->name(),
            'precio' => $this->faker->randomFloat(2, 5, 150),
            'descripcion' => $this->faker->paragraph(2),
            'imagen' => $this->faker->imageUrl(400, 300, 'books', true),
            'categoria' => $this->faker->randomElement(['Ficción', 'No Ficción', 'Tecnología', 'Historia', 'Ciencia']),
        ];
    }
}
