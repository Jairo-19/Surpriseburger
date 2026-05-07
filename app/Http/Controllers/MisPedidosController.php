<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MisPedidosController extends Controller
{
    public function index()
    {   
        Carbon::setLocale('es');
        $user = Auth::user();
        $pedidos = $user->pedidos()->with('platos')->orderBy('created_at', 'desc')->get();
        return view('pagina.mis.mis_pedidos', compact('pedidos'));
    }
}
