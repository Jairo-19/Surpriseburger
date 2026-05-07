<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pago;
use App\Models\Pedido;
use App\Models\Plato;
use App\Models\Punto;
use App\Models\Usuario; // utilizado para anotaciones de tipo
use Carbon\Carbon;

class PagoController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login.index');
        }

        // Obtener carrito de la sesión
        $cart = session()->get('cart', []);
        
        // Calcular total
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        
        // Calcular puntos (10 puntos por euro)
        $puntos = floor($total * 10);

        // Obtener usuario autenticado (puede ser null si no ha iniciado sesión)
        /** @var Usuario|null $user */
        $user = Auth::user();

        // Obtener último pedido del usuario para rellenar datos; puede ser null
        $ultimoPedido = $user ? $user->pedidos()->latest()->first() : null;

        // Datos del usuario con valores por defecto (usar el helper optional para evitar
        // advertencias en el editor si $user es null)
        $nombre = optional($user)->nombre ?? '';
        $apellidos = trim((optional($user)->primer_apellido ?? '') . ' ' . (optional($user)->segundo_apellido ?? ''));
        $correo = optional($user)->correo ?? '';

        
        // Dirección y demás: sólo si hay un pedido previo
        $direccion = $ultimoPedido->direccion ?? '';
        $poblacion = $ultimoPedido->poblacion ?? '';
        $provincia = $ultimoPedido->provincia ?? '';
        $codigo_postal = $ultimoPedido->codigo_postal ?? '';

        // Teléfono: preferimos el del usuario si está (login), si no tomamos el
        // del último pedido si existe; en ausencia de ambos dejamos cadena vacía.
        $telefono = optional($user)->telefono ??
                    ($ultimoPedido && $ultimoPedido->usuario ? $ultimoPedido->usuario->telefono : '');

        return view('pagina.pagos.pagos', compact(
            'cart', 'total', 'puntos', 
            'nombre', 'apellidos', 'correo', 'telefono', 
            'direccion', 'poblacion', 'provincia', 'codigo_postal'
        ));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_pedido' => 'required|string|in:domicilio,recogida',
            'metodo_pago' => 'required|string|in:Efectivo,Tarjeta',
            // si es a domicilio son obligatorios los siguientes campos
            'direccion' => 'required_if:tipo_pedido,domicilio',
            'poblacion' => 'required_if:tipo_pedido,domicilio',
            'codigo_postal' => 'required_if:tipo_pedido,domicilio',
            'provincia' => 'required_if:tipo_pedido,domicilio',
            'telefono' => 'required_if:tipo_pedido,domicilio',
            
            // si es con tarjeta son obligatorios los siguientes campos
            'card_holder' => 'required_if:metodo_pago,Tarjeta',
            'card_number' => 'required_if:metodo_pago,Tarjeta',
            'card_expiry' => 'required_if:metodo_pago,Tarjeta',
            'card_cvc' => 'required_if:metodo_pago,Tarjeta',
        ]);

        // Recuperar carrito de sesión. si no existe, redirigir al menú
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->route('menu.index')->with('error', 'El carrito está vacío.');
        }

        // Obtener o crear método de pago - primero intentar buscar por nombre, si no existe lo crea
        $pago = Pago::firstOrCreate(['nombre' => $request->metodo_pago]);

        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        // Determinar dirección
        $direccion = $request->tipo_pedido === 'domicilio' ? $request->direccion : 'Recogida en local';
        $poblacion = $request->tipo_pedido === 'domicilio' ? $request->poblacion : 'Valencia';
        $provincia = $request->tipo_pedido === 'domicilio' ? $request->provincia : 'Valencia';
        $cp = $request->tipo_pedido === 'domicilio' ? $request->codigo_postal : '46000';

        // Crear pedido (el importe solo considera platos normales)
        $pedido = Pedido::create([
            'usuario_id' => Auth::id(),
            'importe' => $total,
            'estado' => 'pendiente',
            'forma' => $request->tipo_pedido, // domicilio/recogida
            'pago_id' => $pago->id,
            'fecha_entrega' => Carbon::now()->addMinutes(45), // Estimado
            'direccion' => $direccion,
            'poblacion' => $poblacion,
            'provincia' => $provincia,
            'codigo_postal' => $cp,
        ]);

        // Asociar platos normales al pedido
        foreach ($cart as $id => $details) {
            if (isset($details['is_coupon']) && $details['is_coupon']) {
                continue; // no se guardan en la relación platos
            }
            $pedido->platos()->attach($id, ['cantidad' => $details['quantity']]);
        }

        // Gestionar puntos: ganar y gastar
        $user = Auth::user();

        // Ganar puntos por importe
        $puntosGanados = floor($total * 10);
        if ($puntosGanados > 0) {
            Punto::create([
                'cliente_id' => Auth::id(),
                'cantidad_puntos' => $puntosGanados,
                'concepto' => "Pedido #{$pedido->id}",
            ]);
        }

        // Gastar puntos por cada cupón en carrito
        foreach ($cart as $item) {
            if (isset($item['is_coupon']) && $item['is_coupon']) {
                Punto::create([
                    'cliente_id' => Auth::id(),
                    'cantidad_puntos' => -1 * $item['points_cost'],
                    'concepto' => "Canje cupón #{$item['cupon_id']} (Pedido #{$pedido->id})",
                    'cupon_id' => $item['cupon_id'],
                ]);

                // Guardar relación cliente-cupón si existe y aún no esté en la tabla pivote
                if ($user && $user->cliente) {
                    // usar syncWithoutDetaching evita el error de clave primaria duplicada
                    $user->cliente->cupones()->syncWithoutDetaching([$item['cupon_id']]);
                }
            }
        }

        // Vaciar carrito
        session()->forget('cart');

        return redirect()->route('mis_pedidos.index')->with('success', '¡Pedido realizado con éxito!');
    }
}
