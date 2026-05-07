<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\PedidoPlato;
use App\Models\Plato;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoPlatoFactory extends Factory
{
    protected $model = PedidoPlato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pedido_id' => Pedido::factory(),
            'plato_id' => optional(Plato::inRandomOrder()->first())->id ?? Plato::factory(),
            'cantidad' => $this->faker->numberBetween(1, 5),
        ];
    }
}
