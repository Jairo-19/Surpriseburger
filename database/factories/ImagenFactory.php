<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Imagen;
use App\Models\Plato;

class ImagenFactory extends Factory
{
    protected $model = Imagen::class;

    public function definition()
    {
        return [
            'ruta' => $this->faker->imageUrl(),
            'plato_id' => Plato::factory(),
        ];
    }
}