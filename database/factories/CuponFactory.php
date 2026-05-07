<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cupon;

class CuponFactory extends Factory
{
    protected $model = Cupon::class;

    public function definition()
    {
        $platos = ['Hamburguesa', 'Pizza', 'Ensalada', 'Taco', 'Sushi', 'Pasta'];
        return [
            'nombre' => $this->faker->randomElement($platos), 
            'imagenes' => $this->faker->imageUrl(),
            'puntos_necesarios' => $this->faker->numberBetween(10, 100),
        ];
    }
}