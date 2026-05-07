<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cupon;
use App\Models\Punto;

class MisRecompensasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $puntos = $user->puntos()->sum('cantidad_puntos');
        $cupones = Cupon::all();
        
        return view('pagina.mis.mis_recompensas', compact('user', 'puntos', 'cupones'));
    }

 
}
