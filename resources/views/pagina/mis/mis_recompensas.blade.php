@extends('pagina.layouts.plantilla')
@section('title', 'Mis recompensas')
@section('content')
    
<div class="w-full min-h-screen bg-[#E7F0F8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Título de la página -->
        <div class="text-center mb-8">
            <h1 class="text-6xl font-bold text-gray-900 mb-3">Mis recompensas</h1>
            <p class="text-xl text-gray-700">Gana puntos para cada compra y canjéalos por deliciosas sorpresas</p>
            <p class="text-2xl font-bold text-blue-900 mt-4">Tienes {{ $puntos }} puntos</p>
        </div>

        <!-- Sección de pasos -->
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-lg p-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Paso 1: Compra -->
                <div class="text-center text-white">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">1. Compra</h3>
                </div>

                <!-- Paso 2: Acumula -->
                <div class="text-center text-white">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">2. Acumula</h3>
                </div>

                <!-- Paso 3: Canjea -->
                <div class="text-center text-white">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd"/>
                            <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-2">3. Canjea</h3>
                </div>
            </div>
        </div>

        <!-- Cuadrícula de productos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($cupones as $cupon)
            <!-- Tarjeta de producto -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-lg overflow-hidden shadow-lg">
                <div class="p-4">
                    @php
                        $url = $cupon->imagenes
                            ? (Str::startsWith($cupon->imagenes, 'http') ? $cupon->imagenes : asset('storage/'.$cupon->imagenes))
                            : 'https://picsum.photos/seed/coupon'. $cupon->id .'/400/300';
                    @endphp
                    <img src="{{ $url }}" 
                         alt="{{ $cupon->nombre }}" 
                         class="w-full h-64 object-cover rounded-lg mb-4"
                         onerror="this.src='https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=300&fit=crop'">
                    <h3 class="text-white text-2xl font-bold mb-2">{{ $cupon->nombre }}</h3>
                    <p class="text-white text-sm mb-4">{{ $cupon->descripcion ?? 'Canjea tus puntos por este delicioso producto.' }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-white text-2xl font-bold">{{ $cupon->puntos_necesarios }} puntos</span>
                        <button onclick="addCoupon({{ $cupon->id }})" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-gray-100 transition-colors"
                        @if($puntos < $cupon->puntos_necesarios) disabled title="No tienes puntos suficientes" @endif>
                        <span class="text-blue-900 text-2xl font-bold">+</span>
                    </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 text-center py-12">
                <p class="text-xl text-gray-700">No hay recompensas disponibles en este momento.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    // Añade un cupón al carrito vía AJAX y muestra feedback en el botón
    function addCoupon(cuponId) {
        // Guardar referencia al botón y deshabilitar mientras procesa
        const btn = event.currentTarget;
        const originalHtml = btn.innerHTML;
        btn.disabled = true;

        // Petición AJAX para añadir el cupón al carrito de la sesión
        fetch('{{ route("cart.addCoupon") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ cupon_id: cuponId })
        })
        .then(resp => resp.json())
        .then(data => {
            if (data.success) {
                // Éxito: mostrar confirmación y restaurar el botón tras 1 segundo
                btn.innerHTML = '<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                }, 1000);
            } else {
                // Error del servidor: mostrar mensaje y restaurar botón
                alert(data.message || 'Error al añadir cupón');
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            }
        })
        .catch(err => {
            // Error de red o fallo inesperado
            console.error(err);
            alert('Error de red');
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        });
    }
</script>

@endsection