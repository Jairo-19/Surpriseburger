<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resena;
use App\Models\Cliente;

class ResenaFactory extends Factory
{
    protected $model = Resena::class;

    public function definition()
    {
        return [
            'cliente_id' => Cliente::factory(),
            'fecha' => $this->faker->date(),
            'texto' => $this->faker->paragraph(),
            'valoracion' => $this->faker->numberBetween(1, 5),
        ];
    }
}