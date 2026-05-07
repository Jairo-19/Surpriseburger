<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Plato;
use Illuminate\Http\Request;

// Controlador del panel de administración; carga estadísticas globales y secciones por AJAX
class AdminController extends Controller
{
    // Carga todas las estadísticas, gráficos, reservas, pedidos, platos y cupones para el panel de admin
    public function index()
    {
        // ---- Estadísticas numéricas para las tarjetas superiores ----
        $pedidosRealizados = \App\Models\Pedido::where('estado', 'realizado')->count();
        $pedidosPendientes = \App\Models\Pedido::where('estado', 'pendiente')->count();
        $ingresos = \App\Models\Pedido::where('estado', 'realizado')->sum('importe');
        $valoracionMedia = number_format(\App\Models\Resena::avg('valoracion') ?? 0, 1);

        // Gráfico 1: Top 5 Productos más vendidos
        $topProductos = \Illuminate\Support\Facades\DB::table('pedido_plato')
            ->join('platos', 'pedido_plato.plato_id', '=', 'platos.id')
            ->select('platos.nombre', \Illuminate\Support\Facades\DB::raw('sum(pedido_plato.cantidad) as total_vendido'))
            ->groupBy('plato_id', 'platos.nombre')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();
        
        $topPlatosLabels = $topProductos->pluck('nombre');
        $topPlatosData = $topProductos->pluck('total_vendido');

        // Gráfico 2: Ventas por Categoría
        $ventasCategoria = \Illuminate\Support\Facades\DB::table('pedido_plato')
            ->join('platos', 'pedido_plato.plato_id', '=', 'platos.id')
            ->join('categorias', 'platos.categoria_id', '=', 'categorias.id')
            ->select('categorias.nombre', \Illuminate\Support\Facades\DB::raw('sum(pedido_plato.cantidad) as total_vendido'))
            ->groupBy('categorias.id', 'categorias.nombre')
            ->get();

        $categoriasLabels = $ventasCategoria->pluck('nombre');
        $categoriasData = $ventasCategoria->pluck('total_vendido');

        // Obtener todas las reservas futuras ordenadas por fecha
        $reservas = Reserva::where('fecha', '>=', today())
            ->orderBy('fecha', 'asc')
            ->orderBy('hora', 'asc')
            ->with('usuario')
            ->get();

        // Obtener todos los pedidos ordenados por fecha (más recientes primero)
        $pedidos = \App\Models\Pedido::with('usuario')
            ->orderBy('created_at', 'desc')
            ->get();

        // Obtener todos los platos con su categoría
        $platos = Plato::with(['categoria', 'imagenes'])
            ->orderBy('nombre', 'asc')
            ->get();

        // También traer cupones para la pestaña correspondiente
        $cupones = \App\Models\Cupon::orderBy('nombre')->get();

        return view('admin.admin', compact(
            'reservas', 'platos', 'pedidos', 
            'pedidosRealizados', 'pedidosPendientes', 'ingresos', 'valoracionMedia',
            'topPlatosLabels', 'topPlatosData', 'categoriasLabels', 'categoriasData',
            'cupones'
        ));
    }

    // Renderiza y devuelve el HTML de la sección solicitada por AJAX (pedidos, reservas, platos, cupones, estadísticas)
    public function getSection($section)
    {
        switch ($section) {
            case 'pedidos':
                $pedidos = \App\Models\Pedido::with('usuario')->orderBy('created_at', 'desc')->get();
                return view('admin.sections.pedidos', compact('pedidos'))->render();
            case 'reservas':
                $reservas = Reserva::where('fecha', '>=', today())->orderBy('fecha', 'asc')->orderBy('hora', 'asc')->with('usuario')->get();
                return view('admin.sections.reservas', compact('reservas'))->render();
            case 'platos':
                $platos = Plato::with(['categoria', 'imagenes'])->orderBy('nombre', 'asc')->get();
                return view('admin.sections.platos', compact('platos'))->render();
            case 'cupones':
                $cupones = \App\Models\Cupon::orderBy('nombre')->get();
                return view('admin.sections.cupones', compact('cupones'))->render();
            case 'estadisticas':
                // Esto hace que se muestren las estadisticas
                $topProductos = \Illuminate\Support\Facades\DB::table('pedido_plato')
                    ->join('platos', 'pedido_plato.plato_id', '=', 'platos.id')
                    ->select('platos.nombre', \Illuminate\Support\Facades\DB::raw('sum(pedido_plato.cantidad) as total_vendido'))
                    ->groupBy('plato_id', 'platos.nombre')
                    ->orderByDesc('total_vendido')
                    ->limit(5)->get();
                $topPlatosLabels = $topProductos->pluck('nombre');
                $topPlatosData = $topProductos->pluck('total_vendido');
                $ventasCategoria = \Illuminate\Support\Facades\DB::table('pedido_plato')
                    ->join('platos', 'pedido_plato.plato_id', '=', 'platos.id')
                    ->join('categorias', 'platos.categoria_id', '=', 'categorias.id')
                    ->select('categorias.nombre', \Illuminate\Support\Facades\DB::raw('sum(pedido_plato.cantidad) as total_vendido'))
                    ->groupBy('categorias.id', 'categorias.nombre')->get();
                $categoriasLabels = $ventasCategoria->pluck('nombre');
                $categoriasData = $ventasCategoria->pluck('total_vendido');

                return view('admin.sections.estadisticas', compact('topPlatosLabels', 'topPlatosData', 'categoriasLabels', 'categoriasData'))->render();
            default:
                return response()->json(['error' => 'Section not found'], 404);
        }
    }
}
