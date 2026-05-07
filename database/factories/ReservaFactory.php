<?php

namespace Database\Factories;

use App\Models\Reserva;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservaFactory extends Factory
{
    protected $model = Reserva::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'usuario_id' => Usuario::factory(),
            'fecha' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'hora' => $this->faker->time('H:i'),
            'numero_personas' => $this->faker->numberBetween(1, 10),
            'estado' => $this->faker->randomElement(['pendiente', 'realizado']),
            'notas' => $this->faker->optional()->sentence,
        ];
    }
}
