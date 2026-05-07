<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Usuario;

// Lista las reseñas escritas por el usuario autenticado
class MisComentatiosController extends Controller
{
    // Carga las reseñas del usuario autenticado ordenadas de más reciente a más antigua
    public function index()
    {
        Carbon::setLocale('es');
        /** @var Usuario $user */
        $user = Auth::user();
        // Obtener comentarios del usuario ordenados del más reciente al más antiguo
        $comentarios = $user->resenas()->orderBy('created_at', 'desc')->get();
        
        return view('pagina.mis.mis_comentarios', compact('comentarios'));
    }
}
