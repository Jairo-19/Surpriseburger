<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resena;
use Illuminate\Support\Facades\Auth;

// Gestiona la visualización y creación de reseñas del restaurante
class ResenasController extends Controller
{
    // Carga todas las reseñas con la relación cliente→usuario y calcula estadísticas (media, total, 5 estrellas)
    public function index()
    {
        // Cargar reseñas con la relación cliente→usuario para mostrar el nombre
        $resenas = Resena::with('cliente.usuario')->orderBy('fecha', 'desc')->get();
        $totalReviews = $resenas->count();
        $avgRating = $totalReviews > 0 ? number_format($resenas->avg('valoracion'), 1) : 0;
        $fiveStarReviews = $resenas->where('valoracion', 5)->count();

        return view('pagina.resenas.resenas', compact('resenas', 'totalReviews', 'avgRating', 'fiveStarReviews'));
    }

    // Guarda una nueva reseña; si la petición es AJAX devuelve JSON con la reseña creada y las estadísticas recalculadas
   public function store(Request $request) 
   {
        if (!Auth::check()) {
            // Si es AJAX, responder con JSON de error en lugar de redirigir
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Debes iniciar sesión para dejar una reseña.'], 401);
            }
            return redirect()->route('login.index')->with('error', 'Debes iniciar sesión para dejar una reseña.');
        }

        // Validación de los datos del formulario
        $request->validate([
            'texto'      => 'required|string|min:5',
            'valoracion' => 'required|integer|min:1|max:5',
        ]);

        // Guardar la nueva reseña en la base de datos
        $resena = Resena::create([
            'cliente_id' => Auth::id(),
            'texto'      => $request->texto,
            'valoracion' => $request->valoracion,
            'fecha'      => now(),
        ]);

        // Si es una petición AJAX, devolver JSON con los datos necesarios para actualizar el DOM
        if ($request->expectsJson() || $request->ajax()) {
            // Cargar la relación cliente→usuario para obtener el nombre
            $resena->load('cliente.usuario');

            // Recalcular estadísticas globales
            $todasResenas    = Resena::all();
            $totalReviews    = $todasResenas->count();
            $avgRating       = $totalReviews > 0 ? number_format($todasResenas->avg('valoracion'), 1) : 0;
            $fiveStarReviews = $todasResenas->where('valoracion', 5)->count();

            return response()->json([
                'success' => true,
                'resena'  => [
                    'nombre'    => optional($resena->cliente->usuario)->nombre ?? 'Usuario',
                    'fecha'     => $resena->fecha ? $resena->fecha->format('d/m/Y') : now()->format('d/m/Y'),
                    'texto'     => $resena->texto,
                    'valoracion'=> $resena->valoracion,
                ],
                'stats' => [
                    'avgRating'       => $avgRating,
                    'totalReviews'    => $totalReviews,
                    'fiveStarReviews' => $fiveStarReviews,
                ],
            ]);
        }

        // Fallback: redirigir si la petición es normal (sin AJAX)
        return redirect()->route('resenas.index')->with('success', '¡Gracias por tu reseña! 🍔');
   }
}
