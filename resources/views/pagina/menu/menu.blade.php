@extends('pagina.layouts.plantilla')

@section('title', 'Menu | Surprise Burger')

@section('content')

<!-- ===== PÁGINA DEL MENÚ ===== -->
<main class="bg-[#e7f0f8] py-20 px-6">

    <!-- TÍTULO DE LA PÁGINA -->
    <div class="text-center mb-16 min-h-[40vh] flex items-center justify-center">
        <h1 class="text-[#2d4a77] text-4xl sm:text-5xl lg:text-6xl font-bold">
            Nuestro menú
        </h1>
    </div>

    <!-- BOTONES DE FILTRO POR CATEGORÍA -->
    <div class="flex flex-wrap justify-center gap-4 sm:gap-6 mb-12">
    @foreach ($categorias as $cat)
        <!-- Botón de categoría: al pulsarlo carga los platos de esa categoría vía AJAX -->
        <button
            data-id="{{ $cat->id }}"
            onclick="loadPlatos({{ $cat->id }}, this)"
            class="filtro-btn px-6 py-2 rounded-full font-semibold transition text-white
                {{ isset($categoriaActiva) && $categoriaActiva && $categoriaActiva->id == $cat->id
                    ? 'bg-orange-600 ring-2 ring-orange-300'
                    : 'bg-orange-400 hover:bg-orange-500' }}"
        >
            {{ $cat->nombre }}
        </button>
    @endforeach
    </div>
    
    <!-- CUADRÍCULA DE PLATOS -->
<div id="platos-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">

    @forelse ($platos as $plato)
        <!-- Tarjeta de plato: al hacer clic abre el modal con detalles -->
        <div onclick='openModal(@json($plato))' class="cursor-pointer card bg-blue-900 text-white p-4 flex flex-col rounded-2xl shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            @if($plato->imagenes->first())
                <!-- Imagen del plato -->
                <img src="{{ asset('storage/' . $plato->imagenes->first()->ruta) }}" alt="{{ $plato->nombre }}" class="w-full aspect-[4/3] object-cover mb-3 rounded-xl" />
            @else
                <!-- Placeholder cuando el plato no tiene imagen -->
                <div class="w-full aspect-[4/3] bg-gray-700 mb-3 rounded-xl flex items-center justify-center">
                    <i class="bi bi-image text-gray-500 text-4xl"></i>
                </div>
            @endif
            <h3 class="font-semibold mb-1 text-xl">{{ $plato->nombre }}</h3>
            <p class="text-sm mb-3 flex-grow text-gray-200 line-clamp-3">{{ $plato->descripcion }}</p>
            <div class="flex justify-between items-center font-semibold mt-auto">
                <!-- Precio del plato -->
                <span class="text-lg">{{ $plato->precio }}€</span>
                <!-- Botón para añadir directamente al carrito desde la tarjeta -->
                <button 
                    class="bg-white text-blue-900 w-10 h-10 rounded-full font-bold hover:bg-gray-200 transition flex items-center justify-center text-xl shadow"
                    onclick="event.stopPropagation(); openModal(@json($plato))"
                >
                    +
                </button>
            </div>
        </div>
    @empty
        <!-- Mensaje cuando no hay platos disponibles en la categoría seleccionada -->
        <p class="col-span-full text-center text-gray-500 text-xl mt-8">
            No hay platos disponibles en esta categoría.
        </p>
    @endforelse

</div>


<!-- ===== MODAL DE DETALLE DEL PLATO ===== -->
<div id="platoModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
      
        <!-- Fondo oscuro que cierra el modal al hacer clic -->
        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-75 backdrop-blur-sm" aria-hidden="true" onclick="closeModal()"></div>

        <!-- Truco para centrar el modal verticalmente en pantallas grandes -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Contenido principal del modal -->
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full border-4 border-gray-100 relative">
            
            <!-- Botón para cerrar el modal -->
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="flex flex-col md:flex-row h-full">
                <!-- Imagen del plato a pantalla completa (mitad izquierda) -->
                <div class="w-full md:w-1/2 relative bg-gray-100">
                     <img id="modalImage" src="" alt="Plato" class="w-full h-full object-cover min-h-[400px]">
                </div>

                <!-- Detalles del plato (mitad derecha) -->
                <div class="w-full md:w-1/2 p-8 flex flex-col justify-between">
                    <div>
                        <!-- Nombre y línea decorativa -->
                        <h2 class="text-4xl font-extrabold text-[#2d4a77] mb-2 tracking-tight" id="modalTitle">Hamburguesa clásica</h2>
                        <div class="w-20 h-1 bg-orange-400 mb-6"></div>
                        
                        <!-- Descripción del plato -->
                        <p class="text-gray-600 text-lg mb-8 leading-relaxed" id="modalDescription">
                            Esta hamburguesa es muy rica y nutritiva gracias a todos sus ingredientes super frescos.
                        </p>

                        <!-- Lista de alergenos del plato -->
                        <div class="mb-8">
                            <h3 class="font-bold text-xl mb-4 text-[#2d4a77]">Alergenos:</h3>
                            <div id="modalAlergenos" class="grid grid-cols-2 gap-4">
                                <!-- Los alergenos se insertan dinámicamente desde JavaScript -->
                            </div>
                        </div>
                    </div>

                    <!-- Sección de precio, cantidad y botón de añadir al carrito -->
                    <div class="border-t pt-6">
                        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                            <div>
                                <span class="block text-gray-500 text-sm font-bold uppercase tracking-wider">Precio:</span>
                                <span class="text-3xl font-black text-[#2d4a77]" id="modalPrice">9.95€</span>
                            </div>

                            <!-- Control de cantidad (+ / -) -->
                            <div class="flex items-center gap-3">
                                <span class="text-gray-500 font-bold uppercase text-sm">Cantidad:</span>
                                <div class="flex items-center space-x-3 bg-gray-100 rounded-lg p-1">
                                    <button onclick="updateQuantity(-1)" class="w-8 h-8 flex items-center justify-center font-bold text-gray-600 hover:bg-white hover:shadow rounded transition">-</button>
                                    <span id="modalQuantity" class="font-bold text-xl w-8 text-center">1</span>
                                    <button onclick="updateQuantity(1)" class="w-8 h-8 flex items-center justify-center font-bold text-gray-600 hover:bg-white hover:shadow rounded transition">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Botón para añadir el plato al carrito -->
                        <button onclick="addToCart()" class="w-full py-4 px-6 border-2 border-[#2d4a77] text-[#2d4a77] hover:bg-[#2d4a77] hover:text-white font-bold text-lg uppercase tracking-wider transition duration-300 rounded-xl flex items-center justify-center gap-2 group">
                            <span>Añadir al carrito</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // URL base del menú y de la carpeta de imágenes en storage
    const menuIndexUrl = "{{ route('menu.index') }}";
    const storageBaseUrl = "{{ asset('storage') }}";

    // Carga los platos de una categoría por AJAX y actualiza el grid
    function loadPlatos(categoriaId, btnEl) {
        // Actualizar estilo del botón activo
        document.querySelectorAll('.filtro-btn').forEach(b => {
            b.classList.remove('bg-orange-600', 'ring-2', 'ring-orange-300');
            b.classList.add('bg-orange-400', 'hover:bg-orange-500');
        });
        if (btnEl) {
            btnEl.classList.remove('bg-orange-400', 'hover:bg-orange-500');
            btnEl.classList.add('bg-orange-600', 'ring-2', 'ring-orange-300');
        }

        // Mostrar spinner de carga mientras se obtienen los datos
        const grid = document.getElementById('platos-grid');
        grid.innerHTML = '<div class="col-span-full flex justify-center py-12"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#2d4a77]"></div></div>';

        // Actualizar la URL del navegador sin recargar la página (historial)
        history.pushState(null, '', menuIndexUrl + '?categoria_id=' + categoriaId);

        // Petición AJAX al servidor para obtener los platos de la categoría
        fetch(menuIndexUrl + '?categoria_id=' + categoriaId, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => {
            if (!r.ok) throw new Error('Error ' + r.status);
            return r.json();
        })
        .then(platos => renderPlatos(platos))
        .catch(() => {
            grid.innerHTML = '<p class="col-span-full text-center text-gray-500 text-xl mt-8">Error al cargar los platos.</p>';
        });
    }

    // Genera y muestra las tarjetas de platos en el grid
    function renderPlatos(platos) {
        const grid = document.getElementById('platos-grid');

        // Si no hay platos, mostrar mensaje informativo
        if (!platos || platos.length === 0) {
            grid.innerHTML = '<p class="col-span-full text-center text-gray-500 text-xl mt-8">No hay platos disponibles en esta categoría.</p>';
            return;
        }

        // Generar el HTML de cada tarjeta de plato
        grid.innerHTML = platos.map(plato => {
            // Imagen o placeholder si no tiene imagen
            const imgHtml = plato.imagenes && plato.imagenes.length > 0
                ? `<img src="${storageBaseUrl}/${escAttr(plato.imagenes[0].ruta)}" alt="${escAttr(plato.nombre)}" class="w-full aspect-[4/3] object-cover mb-3 rounded-xl" />`
                : `<div class="w-full aspect-[4/3] bg-gray-700 mb-3 rounded-xl flex items-center justify-center"><i class="bi bi-image text-gray-500 text-4xl"></i></div>`;

            // Escapar los datos del plato para el atributo data-plato
            const dataAttr = escAttr(JSON.stringify(plato));

            return `
                <div data-plato="${dataAttr}"
                     onclick="openModal(getPlatoData(this))"
                     class="cursor-pointer card bg-blue-900 text-white p-4 flex flex-col rounded-2xl shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    ${imgHtml}
                    <h3 class="font-semibold mb-1 text-xl">${escHtml(plato.nombre)}</h3>
                    <p class="text-sm mb-3 flex-grow text-gray-200 line-clamp-3">${escHtml(plato.descripcion)}</p>
                    <div class="flex justify-between items-center font-semibold mt-auto">
                        <span class="text-lg">${parseFloat(plato.precio).toFixed(2)}€</span>
                        <button
                            class="bg-white text-blue-900 w-10 h-10 rounded-full font-bold hover:bg-gray-200 transition flex items-center justify-center text-xl shadow"
                            onclick="event.stopPropagation(); openModal(getPlatoData(this.closest('[data-plato]')))"
                        >+</button>
                    </div>
                </div>`;
        }).join('');
    }

    // Lee y parsea el objeto plato guardado en data-plato del elemento
    function getPlatoData(el) {
        return JSON.parse(el.dataset.plato);
    }

    // Escapa texto para insertarlo de forma segura como HTML (evita XSS)
    function escHtml(str) {
        if (!str) return '';
        const d = document.createElement('div');
        d.appendChild(document.createTextNode(str));
        return d.innerHTML;
    }

    // Escapa texto para usarlo de forma segura dentro de atributos HTML
    function escAttr(str) {
        if (!str) return '';
        return String(str).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    // Variables globales del modal: ID del plato actual y cantidad seleccionada
    let currentPlatoId = null;
    let currentQuantity = 1;

    // Rellena y muestra el modal con los detalles del plato seleccionado
    function openModal(plato) {
        currentPlatoId = plato.id;
        currentQuantity = 1;
        document.getElementById('modalQuantity').innerText = currentQuantity;

        // Rellenar los campos de texto del modal
        document.getElementById('modalTitle').innerText = plato.nombre;
        document.getElementById('modalDescription').innerText = plato.descripcion;
        document.getElementById('modalPrice').innerText = parseFloat(plato.precio).toFixed(2) + '€';

        // Establecer la imagen del plato o un placeholder si no tiene
        const imgEl = document.getElementById('modalImage');
        const storageUrl = "{{ asset('storage') }}";
        if (plato.imagenes && plato.imagenes.length > 0) {
            imgEl.src = storageUrl + '/' + plato.imagenes[0].ruta;
        } else {
            imgEl.src = 'https://via.placeholder.com/600x400?text=No+Image'; 
        }

        // Renderizar los alérgenos del plato en el contenedor correspondiente
        const alergenosContainer = document.getElementById('modalAlergenos');
        alergenosContainer.innerHTML = '';
        
        if (plato.alergenos && plato.alergenos.length > 0) {
            plato.alergenos.forEach(alergeno => {
                const badge = document.createElement('div');
                badge.className = 'border-2 border-dashed border-[#2d4a77] text-[#2d4a77] font-semibold p-3 rounded-lg text-center flex items-center justify-center gap-2';
                badge.innerText = alergeno.nombre;
                alergenosContainer.appendChild(badge);
            });
        } else {
            // Mensaje cuando el plato no tiene alérgenos declarados
            alergenosContainer.innerHTML = '<span class="text-gray-400 italic">No contiene alérgenos declarados.</span>';
        }

        // Mostrar el modal y bloquear el scroll de la página
        document.getElementById('platoModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden'; 
    }

    // Cierra el modal y restaura el scroll de la página
    function closeModal() {
        document.getElementById('platoModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Incrementa o decrementa la cantidad del modal (mínimo 1)
    function updateQuantity(change) {
        let newQty = currentQuantity + change;
        if (newQty < 1) newQty = 1; // No permitir cantidades menores a 1
        currentQuantity = newQty;
        document.getElementById('modalQuantity').innerText = currentQuantity;
    }

    // Añade el plato actual al carrito vía AJAX y muestra feedback en el botón
    function addToCart() {
        if (!currentPlatoId) return;

        // Deshabilitar el botón y mostrar estado de carga
        const btn = document.querySelector('button[onclick="addToCart()"]');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span>Añadiendo...</span>';
        btn.disabled = true;

        // Petición AJAX para añadir al carrito (sesión Laravel)
        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                plato_id: currentPlatoId,
                cantidad: currentQuantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Éxito: mostrar confirmación y cerrar el modal tras 1 segundo
                btn.innerHTML = '<span class="text-green-600">¡Añadido!</span>';
                setTimeout(() => {
                    closeModal();
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }, 1000);
            } else {
                alert('Error al añadir al carrito');
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        })
        .catch(error => {
            // Error de red o del servidor
            console.error('Error:', error);
            alert('Ocurrió un error');
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    }
</script>


</main>

@endsection
