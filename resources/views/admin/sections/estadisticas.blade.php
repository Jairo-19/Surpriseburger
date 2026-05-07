<div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8">
    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-4 lg:mb-6 flex items-center gap-3">
        <i class="bi bi-graph-up-arrow text-blue-800"></i>
        Estadísticas
    </h2>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8" 
         id="stats-data"
         data-top-platos-labels='@json($topPlatosLabels ?? [])'
         data-top-platos-data='@json($topPlatosData ?? [])'
         data-categorias-labels='@json($categoriasLabels ?? [])'
         data-categorias-data='@json($categoriasData ?? [])'>
         
        {{-- Gráfico 1: Top 5 Productos más vendidos --}}
        <div class="bg-gray-50 p-4 sm:p-6 rounded-xl border border-gray-100 shadow-sm">
            <h3 class="text-base sm:text-lg lg:text-xl font-bold mb-3 lg:mb-4 text-center text-gray-700 flex items-center justify-center gap-2">
                <i class="bi bi-trophy-fill text-yellow-600"></i>
                Top 5 Productos Más Vendidos
            </h3>
            <div class="h-48 sm:h-56 lg:h-auto">
                <canvas id="chartTopProductos"></canvas>
            </div>
        </div>

        {{-- Gráfico 2: Distribución de ventas por categoría --}}
        <div class="bg-gray-50 p-4 sm:p-6 rounded-xl border border-gray-100 shadow-sm">
            <h3 class="text-base sm:text-lg lg:text-xl font-bold mb-3 lg:mb-4 text-center text-gray-700 flex items-center justify-center gap-2">
                <i class="bi bi-pie-chart-fill text-blue-600"></i>
                Ventas por Categoría
            </h3>
            <div class="h-48 sm:h-56 lg:h-64 flex justify-center">
                <canvas id="chartCategorias"></canvas>
            </div>
        </div>
    </div>
</div>
