<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\ClienteCupon;
use App\Models\Cupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteCuponFactory extends Factory
{
    protected $model = ClienteCupon::class;

    public function definition()
    {
        $cliente = Cliente::inRandomOrder()->first();
        if (! $cliente) {
            $cliente = Cliente::factory()->create();
        }

        $cupon = Cupon::inRandomOrder()->first();
        if (! $cupon) {
            $cupon = Cupon::factory()->create();
        }

        return [
            'cliente_id' => $cliente->id,
            'cupon_id' => $cupon->id,
        ];
    }
}

