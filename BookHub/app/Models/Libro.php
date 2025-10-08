<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'precio',
        'descripcion',
        'imagen',
        'categoria',
    ];

    /**
     * Completa y persiste la imagen usando Jikan por título si falta.
     * Preferir manga y hacer fallback a anime ("lo que haya disponible").
     * Si la categoría está vacía, intentar completarla desde géneros/temas/demografías.
     */
    public function fetchJikanImage(): void
    {
        if (!empty($this->imagen)) {
            return;
        }

        $query = urlencode((string)$this->titulo);
        $endpoints = [
            "https://api.jikan.moe/v4/manga?q={$query}&limit=1",
            "https://api.jikan.moe/v4/anime?q={$query}&limit=1",
        ];

        foreach ($endpoints as $url) {
            try {
                $response = @file_get_contents($url);
                if ($response === false) {
                    continue;
                }
                $data = json_decode($response, true);
                $first = $data['data'][0] ?? null;
                if (!$first) {
                    continue;
                }
                $jpg = $first['images']['jpg'] ?? null;
                $image = $jpg['large_image_url'] ?? ($jpg['image_url'] ?? null);
                if (!empty($image)) {
                    $this->imagen = $image;
                    if (empty($this->categoria)) {
                        $category = null;
                        if (!empty($first['genres']) && isset($first['genres'][0]['name'])) {
                            $category = $first['genres'][0]['name'];
                        } elseif (!empty($first['themes']) && isset($first['themes'][0]['name'])) {
                            $category = $first['themes'][0]['name'];
                        } elseif (!empty($first['demographics']) && isset($first['demographics'][0]['name'])) {
                            $category = $first['demographics'][0]['name'];
                        }
                        if ($category) {
                            $this->categoria = $category;
                        }
                    }
                    $this->save();
                    break; // ya completado con lo disponible
                }
            } catch (\Throwable $e) {
                \Log::error("Error al obtener imagen Jikan para {$this->titulo}: " . $e->getMessage());
            }
        }
    }
}
