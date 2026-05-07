<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plato;
use App\Models\Cupon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario; // para anotaciones de tipo

class CartController extends Controller
{
    // Añade un plato al carrito de sesión o incrementa su cantidad si ya existía; devuelve JSON con el total de artículos
    public function add(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'plato_id' => 'required|exists:platos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        // Buscar el plato en la base de datos junto con sus imágenes
        $plato = Plato::with('imagenes')->findOrFail($request->plato_id);
        
        // Obtener el carrito actual de la sesión
        $cart = session()->get('cart', []);
        
        // Obtener la ruta de la primera imagen del plato si existe
        $imagen = $plato->imagenes->first() ? 'storage/' . $plato->imagenes->first()->ruta : null;

        // Verificar si el plato ya está en el carrito
        if(isset($cart[$plato->id])) {
            // Si ya existe, incrementamos la cantidad
            $cart[$plato->id]['quantity'] += $request->cantidad;
        } else {
            // Si no existe, lo añadimos con sus detalles
            $cart[$plato->id] = [
                "name" => $plato->nombre,
                "quantity" => $request->cantidad,
                "price" => $plato->precio,
                "image" => $imagen
            ];
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);
        
        // Calcular el número total de artículos en el carrito
        $totalQuantity = 0;
        foreach($cart as $item) {
            $totalQuantity += $item['quantity'];
        }

        // Incluye el nuevo contador total del carrito
        return response()->json([
            'success' => true, 
            'message' => 'Producto añadido al carrito correctamente',
            'cartCount' => $totalQuantity
        ]); 
    }

    // Elimina un elemento del carrito por su clave de sesión; devuelve JSON con total y puntos actualizados o redirige
    public function remove(Request $request)
    {
        $request->validate([
            'key' => 'required|string'
        ]);

        $cart = session()->get('cart', []);
        if (isset($cart[$request->key])) {
            unset($cart[$request->key]);
            session()->put('cart', $cart);
        }

        if ($request->wantsJson()) {
            $total = 0;
            $count = 0;
            foreach ($cart as $details) {
                if (!isset($details['is_coupon']) || !$details['is_coupon']) {
                    $total += $details['price'] * $details['quantity'];
                }
                $count += $details['quantity'];
            }
            return response()->json([
                'success' => true,
                'total' => number_format($total, 2) . '€',
                'puntos' => floor($total * 10),
                'cartCount' => $count,
                'isEmpty' => count($cart) === 0
            ]);
        }

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    // Añade un cupón al carrito si el usuario tiene puntos suficientes; lo marca para no sumarlo al importe total
    public function addCoupon(Request $request)
    {
        // Validar ID de cupón y existencia en la base de datos
        $request->validate([
            'cupon_id' => 'required|exists:cupones,id'
        ]);

        // Debe haber usuario logueado para comprobar puntos
        /** @var \App\Models\Usuario|null $user */
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Debe iniciar sesión para usar puntos.'], 401);
        }
        // A partir de aquí $user está garantizado como no nulo
        /** @var \App\Models\Usuario $user */
        $cupon = Cupon::findOrFail($request->cupon_id);
        // calcular el total de puntos del usuario para comprobar si puede canjear
        $puntos = $user->puntos()->sum('cantidad_puntos');

        // Verificar saldo de puntos
        if ($puntos < $cupon->puntos_necesarios) {
            return response()->json(['success' => false, 'message' => 'No tienes suficientes puntos.']);
        }

        $cart = session()->get('cart', []);
        $key = 'coupon_' . $cupon->id;

        if (isset($cart[$key])) {
            return response()->json(['success' => false, 'message' => 'Este cupón ya está en el carrito.']);
        }

        // imagen específica del cupón; si está ausente generamos un placeholder único
        if ($cupon->imagenes) {
            $imagen = Str::startsWith($cupon->imagenes, 'http') ? $cupon->imagenes : 'storage/' . $cupon->imagenes;
        } else {
            $imagen = 'https://picsum.photos/seed/coupon' . $cupon->id . '/100/100';
        }

        // Construir el elemento del carrito con flag especial
        $cart[$key] = [
            'name' => $cupon->nombre,
            'quantity' => 1,
            'price' => 0,                    // no se paga en dinero
            'image' => $imagen,
            'is_coupon' => true,            // marca especial
            'points_cost' => $cupon->puntos_necesarios,
            'cupon_id' => $cupon->id,
        ];

        session()->put('cart', $cart);

        // contar artículos totales
        $totalQuantity = 0;
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'message' => 'Cupón añadido al carrito correctamente',
            'cartCount' => $totalQuantity
        ]);
    }
}
