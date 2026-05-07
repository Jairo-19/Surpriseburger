@extends('pagina.layouts.plantilla_admin')
@section('title', 'Panel de administracion| Surprise Burger')

@section('content')

<div class="min-h-screen p-4 sm:p-6 lg:p-8 bg-gray-100">

    {{-- ================= CABECERA ================= --}}
    <div class="mb-6 lg:mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-2">

            <div class="text-center lg:text-left">
                <h1 class="text-2xl sm:text-3xl lg:text-5xl font-bold text-gray-900 mb-2">
                    Panel de administración
                </h1>
                <p class="text-gray-600 text-base lg:text-lg">
                    Gestión completa del restaurante
                </p>
            </div>

            {{-- Contenedor de los botones de acción --}}
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">

                {{-- Botón nuevo pedido --}}
                <button
                onclick="window.location.href='{{ route('admin_pedidos.create') }}'"
                class="px-4 sm:px-6 py-2 sm:py-3 bg-white border-2 border-gray-800 text-gray-800 rounded-lg font-semibold transition hover:bg-[#1E3D9E] hover:text-white hover:border-[#1E3D9E] text-sm sm:text-base flex items-center justify-center gap-2">
                <i class="bi bi-cart-plus-fill"></i>
                + nuevo pedido
                </button>
                
                {{-- Botón nuevo plato --}}
                <button
                onclick="window.location.href='{{ route('admin_platos.create') }}'"
                class="px-4 sm:px-6 py-2 sm:py-3 bg-white border-2 border-gray-800 text-gray-800 rounded-lg font-semibold transition hover:bg-[#1E3D9E] hover:text-white hover:border-[#1E3D9E] text-sm sm:text-base flex items-center justify-center gap-2">
                <i class="bi bi-plus-circle-fill"></i>
                + nuevo plato
                </button>

                {{-- Botón nueva reserva --}}
                 <button
                onclick="window.location.href='{{ route('admin_reserva.create') }}'"
                class="px-4 sm:px-6 py-2 sm:py-3 bg-white border-2 border-gray-800 text-gray-800 rounded-lg font-semibold transition hover:bg-[#1E3D9E] hover:text-white hover:border-[#1E3D9E] text-sm sm:text-base flex items-center justify-center gap-2">
                <i class="bi bi-calendar-plus-fill"></i>
                + nueva reserva
                </button>
                
                {{-- Botón nuevo cupón para recompensas --}}
                <button
                onclick="window.location.href='{{ route('admin_cupones.create') }}'"
                class="px-4 sm:px-6 py-2 sm:py-3 bg-white border-2 border-gray-800 text-gray-800 rounded-lg font-semibold transition hover:bg-[#1E3D9E] hover:text-white hover:border-[#1E3D9E] text-sm sm:text-base flex items-center justify-center gap-2">
                <i class="bi bi-tags-fill"></i>
                + nuevo cupón
                </button>
            </div>
        </div>
    </div>

    {{-- ================= TARJETAS ESTADÍSTICAS ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6 lg:mb-8">

        {{-- Tarjeta: Pedidos realizados --}}
        <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-xl p-4 sm:p-6 text-white shadow-lg relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-20 group-hover:scale-110 transition-transform duration-500">
                <i class="bi bi-check2-circle text-8xl"></i>
            </div>
            <h3 class="text-xs sm:text-sm font-semibold mb-2 opacity-90 flex items-center gap-2">
                <i class="bi bi-cart-check"></i>
                Pedidos realizados
            </h3>
            <p class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                {{ $pedidosRealizados ?? 0 }}
            </p>
        </div>

        {{-- Tarjeta: Pedidos pendientes --}}
        <div class="bg-gradient-to-br from-blue-800 to-blue-700 rounded-xl p-4 sm:p-6 text-white shadow-lg relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-20 group-hover:scale-110 transition-transform duration-500">
                <i class="bi bi-clock-history text-8xl"></i>
            </div>
            <h3 class="text-xs sm:text-sm font-semibold mb-2 opacity-90 flex items-center gap-2">
                <i class="bi bi-hourglass-split"></i>
                Pedidos pendientes
            </h3>
            <p class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                {{ $pedidosPendientes ?? 0 }}
            </p>
        </div>

        {{-- Tarjeta: Ingresos totales --}}
        <div class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 rounded-xl p-4 sm:p-6 text-white shadow-lg relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-20 group-hover:scale-110 transition-transform duration-500">
                <i class="bi bi-currency-euro text-8xl"></i>
            </div>
            <h3 class="text-xs sm:text-sm font-semibold mb-2 opacity-90 flex items-center gap-2">
                <i class="bi bi-wallet2"></i>
                Ingresos
            </h3>
            <p class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                {{ number_format($ingresos ?? 0, 2) }}€
            </p>
        </div>

        {{-- Tarjeta: Valoración media --}}
        <div class="bg-gradient-to-br from-indigo-900 to-blue-900 rounded-xl p-4 sm:p-6 text-white shadow-lg relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 opacity-20 group-hover:scale-110 transition-transform duration-500">
                <i class="bi bi-star-half text-8xl"></i>
            </div>
            <h3 class="text-xs sm:text-sm font-semibold mb-2 opacity-90 flex items-center gap-2">
                <i class="bi bi-heart-fill"></i>
                Valoración media
            </h3>
            <p class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                {{ $valoracionMedia ?? 0 }}
            </p>
        </div>

    </div>

    {{-- ================= NAVEGACIÓN POR PESTAÑAS ================= --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 lg:gap-6 mb-6 lg:mb-8">

        {{-- Pestaña: Pedidos --}}
        <button onclick="showTab('pedidos')" id="tab-pedidos"
            class="bg-white border-4 border-black rounded-xl py-3 lg:py-4 font-bold text-base lg:text-xl tab-button whitespace-nowrap flex items-center justify-center gap-2">
            <i class="bi bi-receipt"></i>
            Pedidos
        </button>
        
        {{-- Pestaña: Reservas --}}
        <button onclick="showTab('reservas')" id="tab-reservas"
            class="bg-white border-2 border-gray-300 rounded-xl py-3 lg:py-4 font-semibold text-base lg:text-xl tab-button flex items-center justify-center gap-2">
            <i class="bi bi-calendar-event"></i>
            Reservas 
        </button>

        {{-- Pestaña: Platos --}}
        <button onclick="showTab('platos')" id="tab-platos"
            class="bg-white border-2 border-gray-300 rounded-xl py-3 lg:py-4 font-semibold text-base lg:text-xl tab-button flex items-center justify-center gap-2">
            <i class="bi bi-egg-fried"></i>
            Platos 
        </button>

        {{-- Pestaña: Cupones --}}
        <button onclick="showTab('cupones')" id="tab-cupones"
            class="bg-white border-2 border-gray-300 rounded-xl py-3 lg:py-4 font-semibold text-base lg:text-xl tab-button flex items-center justify-center gap-2">
            <i class="bi bi-ticket-perforated"></i>
            Cupones 
        </button>

        {{-- Pestaña: Estadísticas --}}
        <button onclick="showTab('estadisticas')" id="tab-estadisticas"
            class="bg-white border-2 border-gray-300 rounded-xl py-3 lg:py-4 font-semibold text-base lg:text-xl tab-button flex items-center justify-center gap-2">
            <i class="bi bi-bar-chart-line"></i>
            Estadisticas 
        </button>

    </div>

    {{-- ================= CONTENEDOR DE CONTENIDO ================= --}}
    <div id="admin-content-container">
        {{-- Aquí se cargará el contenido vía AJAX --}}
        <div id="loading-spinner" class="hidden flex justify-center items-center py-20">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#1E3D9A]"></div>
        </div>
        <div id="content-area"></div>
    </div>

    {{-- Carga de la librería Chart.js desde CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- ================= JAVASCRIPT ================= --}}
    <script>
        // Control de pestañas del panel con AJAX
        async function showTab(tabName) {
            const contentArea = document.getElementById('content-area');
            const spinner = document.getElementById('loading-spinner');

            // Actualizar estilos de pestañas inmediatamente
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-black', 'border-4');
                button.classList.add('border-gray-300', 'border-2');
            });
            const activeTab = document.getElementById('tab-' + tabName);
            if (activeTab) {
                activeTab.classList.remove('border-gray-300', 'border-2');
                activeTab.classList.add('border-black', 'border-4');
            }

            // Mostrar spinner y ocultar contenido anterior
            contentArea.classList.add('opacity-50');
            spinner.classList.remove('hidden');

            try {
                const response = await fetch(`{{ url('/admin/section') }}/${tabName}`);
                if (!response.ok) throw new Error('Error al cargar la sección');
                
                const html = await response.text();
                contentArea.innerHTML = html;
                
                // Si la pestaña es estadísticas, inicializar gráficos
                if (tabName === 'estadisticas') {
                    initCharts();
                }

                // Reinicializar manejadores de eventos para los nuevos elementos (como los formularios de borrado)
                initDeleteForms();

            } catch (error) {
                console.error(error);
                contentArea.innerHTML = `<div class="bg-red-100 border-4 border-red-500 text-red-700 px-6 py-4 rounded-lg">Error al cargar los datos.</div>`;
            } finally {
                spinner.classList.add('hidden');
                contentArea.classList.remove('opacity-50');
            }
        }

        // Inicialización de Gráficos (extraído para ser llamado tras carga AJAX)
        function initCharts() {
            const dataEl = document.getElementById('stats-data');
            if (!dataEl) return;

            const topPlatosLabels = JSON.parse(dataEl.dataset.topPlatosLabels || '[]');
            const topPlatosData = JSON.parse(dataEl.dataset.topPlatosData || '[]');
            const categoriasLabels = JSON.parse(dataEl.dataset.categoriasLabels || '[]');
            const categoriasData = JSON.parse(dataEl.dataset.categoriasData || '[]');

            // Gráfico 1: Top 5 Productos (Bar Chart)
            const ctx1 = document.getElementById('chartTopProductos');
            if (ctx1) {
                new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: topPlatosLabels,
                        datasets: [{
                            label: 'Cantidad Vendida',
                            data: topPlatosData,
                            backgroundColor: 'rgba(30, 61, 154, 0.7)',
                            borderColor: 'rgba(30, 61, 154, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1 }
                            }
                        }
                    }
                });
            }

            // Gráfico 2: Ventas por Categoría (Doughnut Chart)
            const ctx2 = document.getElementById('chartCategorias');
            if (ctx2) {
                new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: categoriasLabels,
                        datasets: [{
                            data: categoriasData,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 159, 64, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        }

        // Manejo de borrado por AJAX
        function initDeleteForms() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.onsubmit = async (e) => {
                    e.preventDefault();
                    if (!confirm('¿Estás seguro de que deseas eliminar este elemento?')) return;

                    const formData = new FormData(form);
                    const url = form.action;
                    
                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });


                        // Recargar la pestaña actual para reflejar cambios
                        const activeTabBtn = document.querySelector('.tab-button.border-black');
                        const tabName = activeTabBtn.id.replace('tab-', '');
                        showTab(tabName);

                    } catch (error) {
                        alert('Error al eliminar el elemento');
                        console.error(error);
                    }
                };
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            showTab('estadisticas');
        });
    </script>
</div>
@endsection