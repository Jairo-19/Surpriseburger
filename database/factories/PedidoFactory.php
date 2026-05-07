<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pedido;
use App\Models\Pago;
use App\Models\Usuario;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition()
    {
        return [
            'direccion' => $this->faker->address(),
            'codigo_postal' => $this->faker->numberBetween(10000, 99999),
            'poblacion' => $this->faker->city(),
            'provincia' => $this->faker->state(),
            'importe' => $this->faker->randomFloat(2, 10, 100),
            'estado' => $this->faker->randomElement(['pendiente', 'realizado']),
            'fecha_entrega' => $this->faker->dateTime(),
            'forma' => $this->faker->randomElement(['recogida', 'domicilio']),
            'pago_id' => Pago::factory(),
            'usuario_id' => Usuario::factory(),
        ];
    }
}
