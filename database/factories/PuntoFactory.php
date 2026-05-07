<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Punto;
use App\Models\Cliente;
use App\Models\Cupon;

class PuntoFactory extends Factory
{
    protected $model = Punto::class;

    public function definition()
    {
        return [
            'cliente_id' => Cliente::factory(),
            'cupon_id' => optional(Cupon::inRandomOrder()->first())->id,
            'cantidad_puntos' => $this->faker->numberBetween(1, 50),
            'concepto' => $this->faker->word(),
        ];
    }
}