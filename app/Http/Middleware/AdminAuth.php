<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (!$user || !$user->empleado) {
            return redirect()->route('home')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}