<?php

namespace Database\Factories;

use App\Models\Alergeno;
use App\Models\AlergenoPlato;
use App\Models\Plato;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlergenoPlatoFactory extends Factory
{
    protected $model = AlergenoPlato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plato_id' => optional(Plato::inRandomOrder()->first())->id ?? Plato::factory(),
            'alergeno_id' => optional(Alergeno::inRandomOrder()->first())->id ?? Alergeno::factory(),
        ];
    }
}
