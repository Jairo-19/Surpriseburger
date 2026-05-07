<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Alergeno;

class AlergenoFactory extends Factory
{
    protected $model = Alergeno::class;

    public function definition()
    {
        $alergenos = ['Gluten', 'Lactosa', 'Soja', 'Altramuces', 'Pescado', 'Marisco', 'Ajo', 'Albahaca', 'Anchoas', 'Menta'];
        return [
            'nombre' => $this->faker->randomElement($alergenos), 
            'imagen' => $this->faker->imageUrl(),
        ];
    }
}