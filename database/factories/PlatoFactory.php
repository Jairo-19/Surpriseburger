<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Plato;
use App\Models\Categoria;

class PlatoFactory extends Factory
{
    protected $model = Plato::class;

    public function definition()
    {
        $categoria = Categoria::inRandomOrder()->first();

        if (! $categoria) {
            $categoria = Categoria::factory()->create();
        }

        return [
            'categoria_id' => $categoria->id,
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(10),
            'precio' => $this->faker->randomFloat(2, 5, 30),
            'activo' => true,
        ];
    }
}

