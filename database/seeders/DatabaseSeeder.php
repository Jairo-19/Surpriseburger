<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Categoria;
use App\Models\Alergeno;
use App\Models\Plato;
use App\Models\Imagen;
use App\Models\Pago;
use App\Models\Pedido;
use App\Models\Reserva;
use App\Models\Cupon;
use App\Models\Punto;
use App\Models\Resena;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Crear solo las 4 categorías una sola vez
        $this->call(CategoriaSeeder::class);

        // 2. Definir platos ÚNICOS por categoría
        $menu = [
            'Entrantes'   => ['Ensalada César', 'Nachos con Queso', 'Croquetas'],
            'Principales' => ['Hamburguesa de Ternera', 'Sushi Variado', 'Pechuga de Pollo'],
            'Postres'     => ['Tarta de Queso', 'Fruta de Temporada'],
            'Bebidas'     => ['Agua', 'Refresco de Cola', 'Cerveza'],
        ];

        foreach ($menu as $nombreCat => $platos) {
            $categoria = Categoria::where('nombre', $nombreCat)->first();

            if ($categoria) {
                foreach ($platos as $nombrePlato) {
                    if ($nombrePlato) { // Skip empty strings
                        Plato::factory()->create([
                            'nombre' => $nombrePlato,
                            'categoria_id' => $categoria->id,
                        ]);
                    }
                }
            }
        }

        // 3. El resto de Factories genéricos (Usuarios, Clientes, etc.)
        Usuario::factory(10)->create();
        Cliente::factory(5)->create();
        Empleado::factory(3)->create();
        Alergeno::factory(5)->create();
        Imagen::factory(10)->create();
        Pago::factory(2)->create();
        Pedido::factory(10)->create();
        Reserva::factory(5)->create();
        Cupon::factory(5)->create();
        Punto::factory(10)->create();
        Resena::factory(10)->create();
    }
}
