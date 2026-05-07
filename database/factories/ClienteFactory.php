<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;
use App\Models\Usuario;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
            'usuario_id' => Usuario::factory(),
            'fecha_registro' => $this->faker->dateTime(),
        ];
    }
}