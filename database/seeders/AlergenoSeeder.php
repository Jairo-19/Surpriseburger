<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alergeno;

class AlergenoSeeder extends Seeder
{
    
    public function run()
    {
        Alergeno::create([
            'nombre' => 'Gluten',
        ]);

        Alergeno::create([
            'nombre' => 'Lactosa',
        ]);

        Alergeno::create([
            'nombre' => 'Soja',
        ]);

        Alergeno::create([
            'nombre' => 'Frutos secos',
        ]);

        Alergeno::create([
            'nombre' => 'Huevo',
        ]);

        Alergeno::create([
            'nombre' => 'Pescado',
        ]);
    }
}