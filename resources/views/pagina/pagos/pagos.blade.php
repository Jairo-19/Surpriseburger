@extends('pagina.layouts.plantilla')
@section('title', 'Pago')
@section('content')

<!-- Contenedor principal con fondo personalizado -->
<main class="bg-[#E7F0F8] min-h-screen py-10">
    <div class="max-w-5xl mx-auto px-6">

        @include('components.alert')

    <h1 class="text-3xl font-bold mb-8">Finalizar pedido</h1>

    <form action="{{ route('pago.store') }}" method="POST" id="payment-form">
        @csrf
        <!-- Campo oculto para el tipo de pedido -->
        <input type="hidden" name="tipo_pedido" id="tipo_pedido_input" value="{{ old('tipo_pedido', 'recogida') }}">

        <!-- Sección de selección de tipo de pedido -->
        <h3 class="text-xl font-bold mb-4">Tipo de pedido</h3>
        <div class="flex gap-4 mb-8">
            <button type="button" id="btn-recoger" onclick="selectOrderType('recogida')"  
                class="flex-1 py-4 text-center font-bold text-lg border-2 rounded-lg transition-all duration-200">
                <i class="bi bi-shop mr-2"></i> A recoger
            </button>
            <button type="button" id="btn-domicilio" onclick="selectOrderType('domicilio')" 
                class="flex-1 py-4 text-center font-bold text-lg border-2 rounded-lg transition-all duration-200">
                <i class="bi bi-truck mr-2"></i> A domicilio
            </button>
        </div>

        <!-- Datos de contacto del usuario -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8 border border-gray-200 space-y-6">
            <h3 class="text-xl font-bold mb-4">Datos de contacto</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Campo Nombre -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="nombre" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition" 
                        value="{{ old('nombre', $nombre) }}" required>
                </div>
                <!-- Campo Apellidos -->
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700">Apellidos</label>
                    <input type="text" name="apellidos" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition" 
                        value="{{ old('apellidos', $apellidos) }}" required>
                </div>
            </div>

            <!-- Campo Correo Electrónico -->
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700">Correo Electrónico</label>
                <input type="email" name="correo" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition" 
                    value="{{ old('correo', $correo) }}" required>
            </div>

            <!-- Campos específicos para envío a domicilio -->
            <div id="domicilio-fields" class="hidden space-y-6">
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Campo Teléfono -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" id="input-telefono" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition" 
                            value="{{ old('telefono', $telefono) }}">
                    </div>
                    <!-- Campo Dirección -->
                     <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Dirección</label>
                        <input type="text" name="direccion" id="input-direccion" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition" 
                            value="{{ old('direccion', $direccion) }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Campo Población -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Población</label>
                        <input type="text" name="poblacion" id="input-poblacion" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition" 
                            value="{{ old('poblacion', $poblacion) }}">
                    </div>
                    <!-- Campo Provincia -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Provincia</label>
                        <input type="text" name="provincia" id="input-provincia" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition" 
                            value="{{ old('provincia', $provincia) }}">
                    </div>
                    <!-- Campo Código Postal -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Código Postal</label>
                        <input type="text" name="codigo_postal" id="input-cp" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition" 
                            value="{{ old('codigo_postal', $codigo_postal) }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Método de pago -->
        <h3 class="text-xl font-bold mb-4">Método de pago</h3>
        <div class="space-y-4 mb-8">
            <!-- Opción de pago: Efectivo -->
            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-black has-[:checked]:bg-gray-50">
                <input type="radio" name="metodo_pago" value="Efectivo" class="w-5 h-5 text-blue-600 focus:ring-blue-500" onchange="togglePaymentMethod('Efectivo')" {{ old('metodo_pago', 'Efectivo') == 'Efectivo' ? 'checked' : '' }}>
                <span class="ml-3 font-bold">Efectivo</span>
            </label>

            <!-- Opción de pago: Tarjeta -->
            <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:border-black has-[:checked]:bg-gray-50">
                <input type="radio" name="metodo_pago" value="Tarjeta" class="w-5 h-5 text-blue-600 focus:ring-blue-500" onchange="togglePaymentMethod('Tarjeta')" {{ old('metodo_pago') == 'Tarjeta' ? 'checked' : '' }}>
                <span class="ml-3 font-bold">Tarjeta</span>
            </label>

            <!-- Campos adicionales para pago con tarjeta -->
            <div id="card-fields" class="hidden mt-4 p-6 bg-gray-50 rounded-lg border border-gray-200">
                <h4 class="font-bold text-lg mb-4">Datos de la tarjeta</h4>
                <div class="space-y-4">
                    <!-- Titular de la tarjeta -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Titular</label>
                        <input type="text" name="card_holder" id="input-card-holder" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="Nombre en la tarjeta">
                    </div>
                    <!-- Número de tarjeta -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Número de tarjeta</label>
                        <input type="text" name="card_number" id="input-card-number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="0000 0000 0000 0000">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Fecha de expiración -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Expiración</label>
                            <input type="text" name="card_expiry" id="input-card-expiry" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="MM/YY">
                        </div>
                        <!-- CVC -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">CVC</label>
                            <input type="text" name="card_cvc" id="input-card-cvc" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition" placeholder="123">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen del pedido -->
        <div class="bg-gray-100 p-8 mb-8 rounded-xl border border-gray-200">
            <h3 class="text-xl font-bold mb-4">Resumen del pedido</h3>
            @if(isset($cart) && count($cart) > 0)
            <div class="space-y-3 mb-6 border-b border-gray-300 pb-4">
                @foreach($cart as $id => $details)
                    <div class="flex justify-between items-center text-gray-800">
                        @if(isset($details['is_coupon']) && $details['is_coupon'])
                            <!-- elemento especial de cupón canjeado -->
                            <div class="flex items-center">
                                @if(!empty($details['image']))
                                    <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-8 h-8 object-cover rounded mr-2">
                                @endif
                                <span class="font-medium text-orange-600">
                                    {{ $details['name'] }} <span class="text-sm text-gray-600">(canjeado {{ $details['points_cost'] }} pts)</span>
                                </span>
                            </div>
                            <span class="font-bold">0,00€</span>
                        @else
                            <span class="font-medium">{{ $details['name'] }} <span class="text-sm text-gray-600">x{{ $details['quantity'] }}</span></span>
                            <span class="font-bold">{{ number_format($details['price'] * $details['quantity'], 2) }}€</span>
                        @endif

                        <!-- botón para eliminar este item del carrito sin enviar el formulario padre -->
                        <button type="button" onclick="removeFromCart('{{ $id }}')" class="ml-4 text-red-500 hover:text-red-700" title="Eliminar del carrito">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </div>
                @endforeach
            </div>
            @endif
            <div class="flex justify-between mb-2 text-lg">
                <span class="text-gray-600">Subtotal</span>
                <span class="font-semibold">{{ number_format($total, 2) }}€</span>
            </div>
            <div class="flex justify-between mb-4 text-lg">
                <span class="text-gray-600">Puntos a ganar</span>
                <span class="text-green-600 font-bold">+ {{ $puntos }} puntos</span>
            </div>
            <div class="flex justify-between items-center font-bold text-3xl mt-6 pt-4 border-t border-gray-300">
                <span class="text-gray-800">Total</span>
                <span class="text-blue-900">{{ number_format($total, 2) }}€</span>
            </div>
        </div>

        <!-- Botones de acción: Cancelar y Confirmar -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('menu.index') }}" class="py-4 text-center font-bold text-lg border-2 border-black rounded hover:bg-gray-100 transition">
                Cancelar
            </a>
            <button type="submit" class="py-4 text-center font-bold text-lg bg-black text-white border-2 border-black rounded hover:bg-gray-800 transition">
                Confirmar pedido
            </button>
        </div>
    </form>
</div>

<script>
    // Función AJAX para quitar un elemento del carrito sin enviar el formulario de pago
    function removeFromCart(key) {
        if (!confirm('¿Deseas eliminar este elemento del carrito?')) {
            return;
        }

        fetch('{{ route('cart.remove') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ key })
        }).then(res => {
            if (res.ok) {
                window.location.reload();
            } else {
                alert('Error al eliminar del carrito.');
            }
        }).catch(() => alert('Error de red al eliminar.'));
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Inicializar estado basado en los valores antiguos de PHP o por defecto
        const currentType = document.getElementById('tipo_pedido_input').value; 
        selectOrderType(currentType);

        // Verificar el radio seleccionado o predeterminado al primero marcado
        const selectedPayment = document.querySelector('input[name="metodo_pago"]:checked');
        if (selectedPayment) {
            togglePaymentMethod(selectedPayment.value);
        } else {
            togglePaymentMethod('Efectivo');
        }
    });

    // Función para manejar la selección del tipo de pedido (Recoger / Domicilio)
    function selectOrderType(type) {
        document.getElementById('tipo_pedido_input').value = type;

        const btnRecoger = document.getElementById('btn-recoger');
        const btnDomicilio = document.getElementById('btn-domicilio');
        const domicilioFields = document.getElementById('domicilio-fields');
        const domicilioInputs = ['input-telefono', 'input-direccion', 'input-poblacion', 'input-provincia', 'input-cp'];

        // Definición de estilos para estado activo e inactivo
        // Activo: Fondo azul (bg-blue-600), texto blanco, borde azul
        // Inactivo: Fondo blanco, texto gris, borde gris
        const activeClass = ['bg-blue-600', 'text-white', 'border-blue-600'];
        const inactiveClass = ['bg-white', 'text-gray-700', 'border-gray-300', 'hover:border-blue-600'];

        if (type === 'recogida') {
            // Activar botón de "A recoger"
            btnRecoger.classList.add(...activeClass);
            btnRecoger.classList.remove('bg-white', 'text-gray-700', 'border-gray-300', 'hover:border-blue-600');
            
            // Desactivar botón de "A domicilio"
            btnDomicilio.classList.add(...inactiveClass);
            btnDomicilio.classList.remove(...activeClass);

            // Ocultar campos de domicilio y quitar atributo required
            domicilioFields.classList.add('hidden');
            domicilioInputs.forEach(id => {
                const el = document.getElementById(id);
                if(el) el.removeAttribute('required');
            });
        } else {
            // Activar botón de "A domicilio"
            btnDomicilio.classList.add(...activeClass);
            btnDomicilio.classList.remove('bg-white', 'text-gray-700', 'border-gray-300', 'hover:border-blue-600');

            // Desactivar botón de "A recoger"
            btnRecoger.classList.add(...inactiveClass);
            btnRecoger.classList.remove(...activeClass);

            // Mostrar campos de domicilio y añadir atributo required
            domicilioFields.classList.remove('hidden');
            domicilioInputs.forEach(id => {
                const el = document.getElementById(id);
                if(el) el.setAttribute('required', 'true');
            });
        }
    }

    // Función para alternar la visibilidad de los campos de tarjeta según el método de pago
    function togglePaymentMethod(method) {
        const cardFields = document.getElementById('card-fields');
        const cardInputs = ['input-card-holder', 'input-card-number', 'input-card-expiry', 'input-card-cvc'];

        if (method === 'Tarjeta') {
            // Si el pago es con tarjeta, mostrar los campos y hacerlos obligatorios
            cardFields.classList.remove('hidden');
            cardInputs.forEach(id => {
                const el = document.getElementById(id);
                if(el) el.setAttribute('required', 'true');
            });
        } else {
            // Si el pago es efectivo, ocultar los campos y quitar la obligatoriedad
            cardFields.classList.add('hidden');
            cardInputs.forEach(id => {
                const el = document.getElementById(id);
                if(el) el.removeAttribute('required');
            });
        }
    }
</script>
</main>
@endsection
