<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Usuario;

// Muestra el perfil del usuario con sus estadísticas de actividad
class MiPerfilController extends Controller
{
    // Carga años registrado, puntos acumulados, reservas activas y total de reseñas del usuario autenticado
    public function index()
    {
        Carbon::setLocale('es');
        /** @var Usuario $user */
        $user = Auth::user();

        // Calcular años desde el registro del usuario en el restaurante
        $fechaRegistro = $user->cliente ? $user->cliente->fecha_registro : $user->created_at;
        $anosConNosotros = $fechaRegistro ? Carbon::parse($fechaRegistro)->diffInYears(now()) : 0;
        
        // Formatear fecha de miembro desde
        $miembroDesde = $fechaRegistro ? Carbon::parse($fechaRegistro)->translatedFormat('d \d\e F \d\e Y') : 'N/A';
        
        // Calcular puntos acumulados
        $puntosAcumulados = $user->puntos()->sum('cantidad_puntos');
        
        // Contar reservas activas (hoy o futuras)
        $reservasActivas = $user->reservas()->whereDate('fecha', '>=', now())->count();
        
        // Contar total de reseñas
        $totalResenas = $user->resenas()->count();

        return view('pagina.mis.mi_perfil', compact('user', 'anosConNosotros', 'miembroDesde', 'puntosAcumulados', 'reservasActivas', 'totalResenas'));
    }
}
