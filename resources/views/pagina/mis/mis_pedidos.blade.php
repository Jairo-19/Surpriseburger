@extends('pagina.layouts.plantilla')
@section('title', 'Mis pedidos')
@section('content')

<div class="w-full min-h-screen bg-[#E7F0F8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <h1 class="text-5xl font-bold text-gray-900 mb-8">Mis pedidos</h1>

        <div class="flex gap-4 mb-8">
            <button onclick="showTab('carrito')" id="btn-carrito" class="px-8 py-3 bg-white border-4 border-black text-gray-900 font-semibold text-lg hover:bg-gray-50 transition-colors">
                Carrito
            </button>
            <button onclick="showTab('historial')" id="btn-historial" class="px-8 py-3 bg-gray-200 border-4 border-black text-gray-900 font-semibold text-lg hover:bg-gray-50 transition-colors">
                Historial
            </button>
        </div>

        <!-- Carrito -->
        <div id="tab-carrito" class="bg-gray-300 rounded-lg p-16 mb-8 hidden">
            @php
                $cart = session('cart', []);
                $total = 0;
                foreach ($cart as $id => $details) {
                    if (!isset($details['is_coupon']) || !$details['is_coupon']) {
                        $total += $details['price'] * $details['quantity'];
                    }
                }
                $puntos = floor($total * 10);
            @endphp
            @if(count($cart) > 0)
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Tu carrito</h3>
                    <div class="space-y-3 mb-6">
                        @foreach($cart as $id => $details)
                            <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow">
                                @if(isset($details['is_coupon']) && $details['is_coupon'])
                                    <!-- elemento especial de cupón canjeado -->
                                    <span class="font-medium text-orange-600">{{ $details['name'] }}</span>
                                    <span class="font-bold">0,00€</span>
                                @else
                                    <span class="font-medium">{{ $details['name'] }} <span class="text-sm text-gray-600">x{{ $details['quantity'] }}</span></span>
                                    <span class="font-bold">{{ number_format($details['price'] * $details['quantity'], 2) }}€</span>
                                @endif

                                <button type="button" onclick="removeFromCart('{{ $id }}', this)" class="ml-4 text-red-500 hover:text-red-700" title="Eliminar del carrito">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between mb-2 text-lg">
                        <span class="text-gray-600">Subtotal</span>
                        <span id="cart-total" class="font-semibold">{{ number_format($total, 2) }}€</span>
                    </div>
                    <div class="flex justify-between mb-4 text-lg">
                        <span class="text-gray-600">Puntos a ganar</span>
                        <span class="text-green-600 font-bold">+ <span id="cart-puntos">{{ $puntos }}</span> puntos</span>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('pago.index') }}" class="px-12 py-4 bg-blue-600 text-white font-semibold text-lg rounded-lg hover:bg-blue-700 transition-colors inline-block">
                            Finalizar pedido
                        </a>
                    </div>
                </div>
            @else
                <div id="cart-empty-message" class="flex flex-col items-center justify-center text-center">
                    <svg class="w-24 h-24 mb-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1" fill="currentColor"/>
                        <circle cx="20" cy="21" r="1" fill="currentColor"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                    
                    <p class="text-2xl text-gray-900 mb-8">Tu carrito esta vacio</p>
                    
                    <a href="{{ route('menu.index') }}" class="px-12 py-4 bg-gray-300 border-4 border-black text-gray-900 font-semibold text-lg hover:bg-gray-400 transition-colors inline-block">
                        Ver menu
                    </a>
                </div>
            @endif
        </div>

        <!-- Historial  -->
        <div id="tab-historial" class="space-y-4">
            @forelse($pedidos as $pedido)
                <div class="bg-gray-300 rounded-lg p-8">
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-900">Pedido #{{ $pedido->id }}</h2>
                        
                        @foreach($pedido->platos as $plato)
                            <div class="flex justify-between items-start">
                                <p class="text-lg text-gray-900">{{ $plato->nombre }} x{{ $plato->pivot->cantidad }}</p>
                                <p class="text-lg font-semibold text-gray-900">{{ number_format($plato->precio * $plato->pivot->cantidad, 2) }}€</p>
                            </div>
                        @endforeach
                        
                        <!-- Total -->
                        <div class="flex justify-between items-center pt-4 border-t-2 border-gray-400">
                            <p class="text-xl font-semibold text-gray-900">Total:</p>
                            <p class="text-xl font-bold text-gray-900">{{ number_format($pedido->importe, 2) }}€</p>
                        </div>
                        
                        <!-- Puntos acumulados -->
                        <div class="flex justify-between items-center pt-2">
                             <p class="text-lg font-semibold text-blue-800">Puntos ganados:</p>
                             @php
                                 $puntosRegistro = auth()->user()->puntos()
                                     ->where('concepto', 'like', "Pedido #{$pedido->id}%")
                                     ->first();
                                 $puntosPedido = $puntosRegistro ? $puntosRegistro->cantidad_puntos : (int)($pedido->importe * 10);
                             @endphp
                             <p class="text-lg font-bold text-blue-800">+{{ $puntosPedido }}</p>
                        </div>
                        <!-- Cupones canjeados en este pedido -->
                        @php
                            $redenciones = auth()->user()->puntos()
                                ->where('concepto', 'like', "Canje cupón%Pedido #{$pedido->id}%")
                                ->get();
                        @endphp
                        @if($redenciones->count())
                            <div class="mt-2">
                                <p class="text-lg font-semibold text-orange-600">Cupones canjeados:</p>
                                @foreach($redenciones as $r)
                                    <p class="text-base text-orange-600">
                                        Cupón #{{ $r->cupon_id }} - {{ abs($r->cantidad_puntos) }} pts
                                    </p>
                                @endforeach
                            </div>
                        @endif
                        
                        <div class="flex gap-4 text-gray-700 pt-2">
                            <span class="text-lg">{{ $pedido->created_at->translatedFormat('d \d\e F \d\e Y') }}</span>
                            <span class="text-lg">{{ $pedido->created_at->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-gray-300 rounded-lg p-8 text-center">
                    <p class="text-xl text-gray-900">No tienes pedidos anteriores.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Scrit para cambiar entre las pestañas de carrito e historial -->
<script>
    // Muestra la pestaña indicada y oculta la otra, actualizando los estilos de los botones
    function showTab(tabName) {
        // Ocultar ambas pestañas
        document.getElementById('tab-carrito').classList.add('hidden');
        document.getElementById('tab-historial').classList.add('hidden');
        
        // Mostrar la pestaña seleccionada
        const contentTab = document.getElementById('tab-' + tabName);
        if(contentTab) contentTab.classList.remove('hidden');
        
        // Actualizar estilos de los botones de navegación
        const btnCarrito = document.getElementById('btn-carrito');
        const btnHistorial = document.getElementById('btn-historial');
        
        if (tabName === 'carrito') {
            btnCarrito.classList.replace('bg-white', 'bg-gray-200');
            btnHistorial.classList.replace('bg-gray-200', 'bg-white');
        } else {
            btnHistorial.classList.replace('bg-white', 'bg-gray-200');
            btnCarrito.classList.replace('bg-gray-200', 'bg-white');
        }
    }

    // Elimina un elemento del carrito vía AJAX y actualiza el total en el DOM
    async function removeFromCart(key, button) {
        if (!confirm('¿Deseas eliminar este elemento del carrito?')) {
            return;
        }

        // Obtener el contenedor del elemento a eliminar
        const divItem = button.closest('.flex');

        try {
            const response = await fetch('{{ route('cart.remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ key })
            });

            if(!response.ok) throw new Error('Error al conectar con el servidor');
            
            const data = await response.json();
            
            if (data.success) {
                // Eliminar el elemento del DOM visualmente
                divItem.remove();

                // Si el carrito quedó vacío, recargar la página para mostrar el estado vacío
                if (data.isEmpty) {
                    location.reload();
                } else {
                    // Actualizar el total y los puntos mostrados en el resumen
                    const totalEl = document.getElementById('cart-total');
                    const puntosEl = document.getElementById('cart-puntos');
                    
                    if(totalEl) totalEl.textContent = data.total;
                    if(puntosEl) puntosEl.textContent = data.puntos;
                }
            } else {
                alert('Hubo un problema al eliminar el artículo.');
            }
        } catch (error) {
            // Error de red o del servidor
            console.error(error);
            alert('Error al procesar la solicitud.');
        }
    }

    // Al cargar la página, si la URL tiene el hash #carrito, mostrar esa pestaña
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash === '#carrito') {
            showTab('carrito');
        }
    });
   
</script>

@endsection