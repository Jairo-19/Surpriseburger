<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Usuario;


// Muestra las reservas del usuario divididas en activas (futuras) e historial (pasadas)
class MisReservasController extends Controller
{
    // Carga reservas activas (hoy en adelante) e historial (fechas pasadas) del usuario autenticado
    public function index()
    {
        Carbon::setLocale('es');
        /** @var Usuario $user */
        $user = Auth::user();
        
        // Reservas activas: fecha de hoy en adelante
        $activas = $user->reservas()
                        ->whereDate('fecha', '>=', now())
                        ->orderBy('fecha', 'asc')
                        ->orderBy('hora', 'asc')
                        ->get();
                        
        $historial = $user->reservas()
                          ->whereDate('fecha', '<', now())
                          ->orderBy('fecha', 'desc')
                          ->orderBy('hora', 'desc')
                          ->get();
        
        return view('pagina.mis.mis_reservas', compact('activas', 'historial'));
    }
}
