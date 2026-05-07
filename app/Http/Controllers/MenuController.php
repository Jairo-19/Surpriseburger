<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

// Gestiona el catálogo de platos del menú, filtrado por categoría
class MenuController extends Controller
{
    // Devuelve la vista del menú o un JSON de platos (AJAX); filtra por categoría o muestra "Entrantes" por defecto
    public function index(Request $request)
    {
        // Obtener todas las categorías para mostrar los botones de filtro
        $categorias = Categoria::all();

        // Closure para filtrar platos activos e incluir relaciones necesarias
        $platosFilter = function($query) {
            $query->where('activo', true)->with(['imagenes', 'alergenos']);
        };

        // Seleccionar categoría según parámetro o por defecto "Entrantes"
        if ($request->has('categoria_id')) {
            $categoria = Categoria::with(['platos' => $platosFilter])->find($request->categoria_id);
        } else {
            $categoria = Categoria::with(['platos' => $platosFilter])->where('nombre', 'Entrantes')->first();
        }

        // Si la categoría no existe, devolver colección vacía
        $platos = $categoria ? $categoria->platos : collect();

        // Si es petición AJAX (desde loadPlatos en JavaScript), devolver solo JSON
        if ($request->ajax()) {
            return response()->json($platos);
        }

        // Vista normal con todos los datos necesarios para renderizar la página
        return view('pagina.menu.menu', [
            'categorias'      => $categorias,
            'platos'          => $platos,
            'categoriaActiva' => $categoria,
        ]);
    }

    // Método de apoyo; devuelve el nombre de la categoría recibida
    public function show($categoria)
    {
         return $categoria;
    }
}
