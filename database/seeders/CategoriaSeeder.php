<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        Categoria::create([
            'nombre' => 'Entrantes',
            'descripcion' => 'Entrantes',
        ]);

        Categoria::create([
            'nombre' => 'Principales',
            'descripcion' => 'Principales',
        ]);

        Categoria::create([
            'nombre' => 'Postres',
            'descripcion' => 'Postres',
        ]);

        Categoria::create([
            'nombre' => 'Bebidas',
            'descripcion' => 'Bebidas',
        ]);
    }
}