<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition()
    {
        $categorias = ['Entrantes', 'Principales', 'Postres', 'Bebidas'];
        return [
            'nombre' => $this->faker->randomElement($categorias), 
            'descripcion' => $this->faker->sentence(),
            'imagen' => $this->faker->imageUrl(),
        ];
    }
}