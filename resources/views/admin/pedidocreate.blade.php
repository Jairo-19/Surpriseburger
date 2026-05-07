@extends('pagina.layouts.plantilla_admin')
@section('title', 'Creacion de platos| Surprise Burger')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-blue-100 p-4 sm:p-6 lg:p-8">

    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden">

        <!-- Alertas -->
        @include('components.alert')

        <!-- Header -->
        <div class="bg-[#1E3D9A] px-8 py-10 md:px-12 md:py-12">
            <h1 class="text-3xl md:text-4xl lg:text-5xl text-white text-center mb-2">
                @if(isset($pedido)) Editar Pedido @else Crear Nuevo Pedido @endif
            </h1>
            <p class="text-blue-100 text-center text-sm md:text-base">
                Gestiona los pedidos del restaurante
            </p>
        </div>

        <!-- FORMULARIO -->
        <form 
            action="{{ isset($pedido) ? route('admin_pedidos.update', $pedido->id) : route('admin_pedidos.store') }}" 
            method="POST" 
            class="px-8 py-10 md:px-12 md:py-12 space-y-8"
            id="pedidoForm"
        >
            @csrf
            @if(isset($pedido))
                @method('PUT')
            @endif

            <input type="hidden" name="forma" id="formaInput" value="{{ old('forma', $pedido->forma ?? 'recogida') }}">

            <!-- Tabs Navigation -->
            <div class="flex border-b-2 border-gray-200 mb-8">
                <button 
                    type="button" 
                    id="tab-recogida"
                    onclick="cambiarPestana('recogida')"
                    class="flex-1 py-4 text-center font-bold text-lg text-gray-500 hover:text-[#1E3D9A] focus:outline-none transition border-b-4 border-transparent"
                >
                    <i class="bi bi-shop mr-2"></i> Recoger en local
                </button>
                <button 
                    type="button" 
                    id="tab-domicilio"
                    onclick="cambiarPestana('domicilio')"
                    class="flex-1 py-4 text-center font-bold text-lg text-gray-500 hover:text-[#1E3D9A] focus:outline-none transition border-b-4 border-transparent"
                >
                    <i class="bi bi-truck mr-2"></i> A domicilio
                </button>
            </div>

            <!-- SECCION RECOGIDA -->
            <div id="recogida-section" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Nombre</label>
                        <input type="text" name="nombre" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('nombre', $pedido->usuario->nombre ?? '') }}" required>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Apellidos</label>
                        <input type="text" name="apellidos" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('apellidos', $pedido->usuario->primer_apellido ?? '') }}" required>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Correo Electrónico</label>
                    <input type="email" name="correo" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('correo', $pedido->usuario->correo ?? '') }}" required>
                </div>
            </div>

            <!-- SECCION DOMICILIO -->
            <div id="domicilio-section" class="hidden space-y-6">
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Nombre</label>
                        <input type="text" name="nombre" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('nombre', $pedido->usuario->nombre ?? '') }}" disabled>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Apellidos</label>
                        <input type="text" name="apellidos" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('apellidos', $pedido->usuario->primer_apellido ?? '') }}" disabled>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Correo Electrónico</label>
                    <input type="email" name="correo" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('correo', $pedido->usuario->correo ?? '') }}" disabled>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('telefono', $pedido->usuario->telefono ?? '') }}">
                    </div>
                     <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Dirección</label>
                        <input type="text" name="direccion" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('direccion', $pedido->direccion ?? '') }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Población</label>
                        <input type="text" name="poblacion" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('poblacion', $pedido->poblacion ?? '') }}">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Provincia</label>
                        <input type="text" name="provincia" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('provincia', $pedido->provincia ?? '') }}">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Código Postal</label>
                        <input type="text" name="codigo_postal" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ old('codigo_postal', $pedido->codigo_postal ?? '') }}">
                    </div>
                </div>
            </div>

            <!-- ESTADO Y PRODUCTOS (COMUN) -->
             <div class="space-y-6 pt-8 border-t border-gray-200">
                <h3 class="text-xl font-bold text-[#1E3D9A]">Detalles del Pedido</h3>
                
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Estado</label>
                    <select name="estado" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="pendiente" {{ (old('estado', $pedido->estado ?? '') == 'pendiente') ? 'selected' : '' }}>Pendiente</option>
                        <option value="realizado" {{ (old('estado', $pedido->estado ?? '') == 'realizado') ? 'selected' : '' }}>Realizado</option>
                    </select>
                </div>

                <!-- PRODUCTOS -->
                <div class="space-y-4">
                    <label class="text-sm font-semibold text-gray-700">Productos</label>
                    <div id="productos-container" class="space-y-3">
                         @if(isset($pedido) && $pedido->platos->count() > 0)
                            @foreach($pedido->platos as $index => $platoPedido)
                                <div class="producto-row flex items-center gap-4 bg-gray-50 p-4 rounded-lg">
                                    <select name="productos[{{ $index }}][plato_id]" class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition producto-select" onchange="calcularTotal()">
                                        @foreach($platos as $plato)
                                            <option value="{{ $plato->id }}" data-precio="{{ $plato->precio }}" {{ $plato->id == $platoPedido->id ? 'selected' : '' }}>
                                                {{ $plato->nombre }} - {{ number_format($plato->precio, 2) }}€
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="productos[{{ $index }}][cantidad]" value="{{ $platoPedido->pivot->cantidad }}" min="1" class="w-24 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition cantidad-input" placeholder="Cant." oninput="calcularTotal()">
                                    <button type="button" class="text-red-500 hover:text-red-700" onclick="eliminarProducto(this)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <!--  Fila vacía por defecto -->
                             <div class="producto-row flex items-center gap-4 bg-gray-50 p-4 rounded-lg">
                                <select name="productos[0][plato_id]" class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition producto-select" onchange="calcularTotal()">
                                    <option value="" data-precio="0">Seleccionar plato</option>
                                    @foreach($platos as $plato)
                                        <option value="{{ $plato->id }}" data-precio="{{ $plato->precio }}">
                                            {{ $plato->nombre }} - {{ number_format($plato->precio, 2) }}€
                                        </option>
                                    @endforeach
                                </select>
                                <input type="number" name="productos[0][cantidad]" value="1" min="1" class="w-24 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition cantidad-input" placeholder="Cant." oninput="calcularTotal()">
                                <button type="button" class="text-red-500 hover:text-red-700" onclick="eliminarProducto(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" onclick="agregarProducto()" class="mt-2 text-[#1E3D9A] font-semibold hover:underline">
                        + Añadir otro producto
                    </button>
                </div>

                <!-- RESUMEN -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Total (€)</label>
                        <input type="text" id="totalInput" class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-100 font-bold text-gray-800" value="0.00" readonly>
                    </div>
                    <div class="space-y-2">
                         <label class="text-sm font-semibold text-gray-700">Puntos Ganados (1€ = 10 pts)</label>
                        <input type="text" id="puntosInput" class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-100 font-bold text-[#1E3D9A]" value="0" readonly>
                    </div>
                </div>

            </div>

            <!-- BOTONES -->
            <div class="flex justify-end pt-8">
                <button type="submit" class="bg-[#1E3D9A] text-white px-8 py-3 rounded-full hover:bg-blue-800 transition shadow-lg transform hover:-translate-y-1">
                    @if(isset($pedido)) Actualizar Pedido @else Crear Pedido @endif
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function cambiarPestana(tipo) {
        const recogidaSection = document.getElementById('recogida-section');
        const domicilioSection = document.getElementById('domicilio-section');
        const tabRecogida = document.getElementById('tab-recogida');
        const tabDomicilio = document.getElementById('tab-domicilio');
        const formaInput = document.getElementById('formaInput');

        if (tipo === 'recogida') {
            recogidaSection.classList.remove('hidden');
            domicilioSection.classList.add('hidden');
            
            tabRecogida.classList.add('text-[#1E3D9A]', 'border-[#1E3D9A]');
            tabRecogida.classList.remove('text-gray-500', 'border-transparent');
            
            tabDomicilio.classList.add('text-gray-500', 'border-transparent');
            tabDomicilio.classList.remove('text-[#1E3D9A]', 'border-[#1E3D9A]');
            
            formaInput.value = 'recogida';

            enableInputs(recogidaSection);
            disableInputs(domicilioSection);

        } else {
            recogidaSection.classList.add('hidden');
            domicilioSection.classList.remove('hidden');

            tabDomicilio.classList.add('text-[#1E3D9A]', 'border-[#1E3D9A]');
            tabDomicilio.classList.remove('text-gray-500', 'border-transparent');
            
            tabRecogida.classList.add('text-gray-500', 'border-transparent');
            tabRecogida.classList.remove('text-[#1E3D9A]', 'border-[#1E3D9A]');

            formaInput.value = 'domicilio';

            enableInputs(domicilioSection);
            disableInputs(recogidaSection);
        }
    }

    function enableInputs(container) {
        const inputs = container.querySelectorAll('input, select, textarea');
        inputs.forEach(input => input.disabled = false);
    }

    function disableInputs(container) {
        const inputs = container.querySelectorAll('input, select, textarea');
        inputs.forEach(input => input.disabled = true);
    }

    let productIndex = {{ isset($pedido) ? $pedido->platos->count() : 1 }};

    function agregarProducto() {
        const container = document.getElementById('productos-container');
        const newRow = document.createElement('div');
        newRow.className = 'producto-row flex items-center gap-4 bg-gray-50 p-4 rounded-lg mt-3 transition-all duration-300 opacity-0 transform translate-y-4';
        newRow.innerHTML = `
            <select name="productos[${productIndex}][plato_id]" class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition producto-select" onchange="calcularTotal()">
                <option value="" data-precio="0">Seleccionar plato</option>
                @foreach($platos as $plato)
                    <option value="{{ $plato->id }}" data-precio="{{ $plato->precio }}">
                        {{ $plato->nombre }} - {{ number_format($plato->precio, 2) }}€
                    </option>
                @endforeach
            </select>
            <input type="number" name="productos[${productIndex}][cantidad]" value="1" min="1" class="w-24 px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition cantidad-input" placeholder="Cant." oninput="calcularTotal()">
            <button type="button" class="text-red-500 hover:text-red-700" onclick="eliminarProducto(this)">
                <i class="bi bi-trash"></i>
            </button>
        `;
        container.appendChild(newRow);
        
        requestAnimationFrame(() => {
            newRow.classList.remove('opacity-0', 'translate-y-4');
        });

        productIndex++;
    }

    function eliminarProducto(btn) {
        const row = btn.closest('.producto-row');
        row.style.opacity = '0';
        row.style.transform = 'translateY(10px)';
        setTimeout(() => {
            row.remove();
            calcularTotal();
        }, 300);
    }

    function calcularTotal() {
        let total = 0;
        const rows = document.querySelectorAll('.producto-row');
        
        rows.forEach(row => {
            const select = row.querySelector('.producto-select');
            const input = row.querySelector('.cantidad-input');
            
            if (select && input) {
                const precio = parseFloat(select.options[select.selectedIndex].getAttribute('data-precio')) || 0;
                const cantidad = parseInt(input.value) || 0;
                total += precio * cantidad;
            }
        });

        const puntos = Math.floor(total * 10);

        document.getElementById('totalInput').value = total.toFixed(2);
        document.getElementById('puntosInput').value = puntos;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const currentForma = document.getElementById('formaInput').value;
        cambiarPestana(currentForma);
        calcularTotal();
    });
</script>

@endsection