<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plato;
use App\Models\Categoria;

// Controlador de la página de inicio
class HomeController extends Controller
{
    // Obtiene los 3 platos más pedidos de "Principales" y los pasa a la vista de inicio
     public function __invoke()
    {
        // Obtener los 3 platos más pedidos de la categoría "Principales"
        $platosMasPedidos = Plato::where('activo', true)
        ->whereHas('categoria', function ($query) {
            $query->where('nombre', 'Principales');
        })
        ->withCount('pedidos')             // Contar cuántos pedidos incluyen cada plato
        ->orderByDesc('pedidos_count')     // Ordenar de mayor a menor cantidad de pedidos
        ->take(3)                          // Tomar solo los 3 primeros
        ->get();

        return view("pagina.home.home", compact('platosMasPedidos'));
    }
}

