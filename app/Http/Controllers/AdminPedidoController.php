<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Gestiona la creación y edición de pedidos manuales desde el panel de admin
class AdminPedidoController extends Controller
{
    // Redirige al listado de pedidos del panel de admin
    public function index()
    {
        return redirect()->route('admin_pedidos.index'); 
        return redirect()->route('admin.index');
    }

    // Muestra el formulario para crear un nuevo pedido manual con usuarios y platos activos
    public function create()
    {
        $usuarios = \App\Models\Usuario::all();
        $platos = \App\Models\Plato::where('activo', true)->get();
        return view('admin.pedidocreate', compact('usuarios', 'platos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'forma' => 'required|in:recogida,domicilio',
            'estado' => 'required|in:pendiente,realizado',
            // teléfono debe contener exactamente 9 dígitos (obligatorio solo si el envío es a domicilio)
            'telefono' => 'required_if:forma,domicilio|nullable|regex:/^[0-9]{9}$/',
            'direccion' => 'required_if:forma,domicilio|nullable|string|max:255',
            'poblacion' => 'required_if:forma,domicilio|nullable|string|max:255',
            'provincia' => 'required_if:forma,domicilio|nullable|string|max:255',
            'codigo_postal' => 'required_if:forma,domicilio|nullable|string|max:10',
            'productos' => 'required|array|min:1',
            'productos.*.plato_id' => 'required|exists:platos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        //buscar o crear usuario
        $usuario = \App\Models\Usuario::firstOrCreate(
            ['correo' => $request->correo],
            [
                'nombre' => $request->nombre,
                'primer_apellido' => $request->apellidos, 
                'telefono' => $request->telefono, // puede ser null
                'contrasena' => \Illuminate\Support\Facades\Hash::make('surprise123'),
            ]
        );
        
       //Actualizar el número de teléfono del usuario si se ha facilitado y no figura en el sistema
        if ($request->telefono && !$usuario->telefono) {
            $usuario->telefono = $request->telefono;
            $usuario->save();
        }

        // Obtener el método de pago predeterminado
        $pago = \App\Models\Pago::firstOrCreate(['nombre' => 'Efectivo']);

        $pedido = new \App\Models\Pedido();
        $pedido->usuario_id = $usuario->id;
        $pedido->forma = $request->forma;
        $pedido->estado = $request->estado;
        $pedido->pago_id = $pago->id;
        
        // logica para las direciones si son recogida o domicilio
        if ($request->forma === 'recogida') {
            $pedido->direccion = 'Recogida en local';
            $pedido->poblacion = 'Local';
            $pedido->provincia = 'Local';
            $pedido->codigo_postal = '00000';
        } else {
            $pedido->direccion = $request->direccion;
            $pedido->poblacion = $request->poblacion;
            $pedido->provincia = $request->provincia;
            $pedido->codigo_postal = $request->codigo_postal;
        }

        $pedido->importe = 0;
        $pedido->save();

        $total = 0;
        foreach ($request->productos as $prod) {
            $plato = \App\Models\Plato::find($prod['plato_id']);
            if ($plato) {
                $cantidad = $prod['cantidad'];
                $pedido->platos()->attach($plato->id, ['cantidad' => $cantidad]);
                $total += $plato->precio * $cantidad;
            }
        }

        $pedido->importe = $total;
        $pedido->save();

        return redirect()->route('admin.index')->with('success', 'Pedido creado correctamente.');
    }

    public function edit($id)
    {
        $pedido = \App\Models\Pedido::with(['platos', 'usuario'])->findOrFail($id);
        $platos = \App\Models\Plato::where('activo', true)->get();
        return view('admin.pedidocreate', compact('pedido', 'platos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'forma' => 'required|in:recogida,domicilio',
            'estado' => 'required|in:pendiente,realizado',
            // teléfono debe contener exactamente 9 dígitos (obligatorio solo si el envío es a domicilio)
            'telefono' => 'required_if:forma,domicilio|nullable|regex:/^[0-9]{9}$/',
            'direccion' => 'required_if:forma,domicilio|nullable|string|max:255',
            'poblacion' => 'required_if:forma,domicilio|nullable|string|max:255',
            'provincia' => 'required_if:forma,domicilio|nullable|string|max:255',
            'codigo_postal' => 'required_if:forma,domicilio|nullable|string|max:10',
            'productos' => 'required|array|min:1',
            'productos.*.plato_id' => 'required|exists:platos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // buscar o crear usario
        $usuario = \App\Models\Usuario::firstOrCreate(
            ['correo' => $request->correo],
            [
                'nombre' => $request->nombre,
                'primer_apellido' => $request->apellidos,
                'telefono' => $request->telefono,
                'contrasena' => \Illuminate\Support\Facades\Hash::make('surprise123'),
            ]
        );
        
        if ($request->telefono && !$usuario->telefono) {
            $usuario->telefono = $request->telefono;
            $usuario->save();
        }

        $pedido = \App\Models\Pedido::findOrFail($id);
        $pedido->usuario_id = $usuario->id;
        $pedido->forma = $request->forma;
        $pedido->estado = $request->estado;
        
        if ($request->forma === 'recogida') {
            $pedido->direccion = 'Recogida en local';
            $pedido->poblacion = 'Local';
            $pedido->provincia = 'Local';
            $pedido->codigo_postal = '00000';
        } else {
            $pedido->direccion = $request->direccion;
            $pedido->poblacion = $request->poblacion;
            $pedido->provincia = $request->provincia;
            $pedido->codigo_postal = $request->codigo_postal;
        }

        $pedido->save();

        // sisncronizar platos del pedido
        $pedido->platos()->detach();
        $total = 0;
        foreach ($request->productos as $prod) {
            $plato = \App\Models\Plato::find($prod['plato_id']);
            if ($plato) {
                $cantidad = $prod['cantidad'];
                $pedido->platos()->attach($plato->id, ['cantidad' => $cantidad]);
                $total += $plato->precio * $cantidad;
            }
        }

        $pedido->importe = $total;
        $pedido->save();

        return redirect()->route('admin.index')->with('success', 'Pedido actualizado correctamente.');
    }
}
