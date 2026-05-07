<div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8">
    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-4 lg:mb-6">Gestión de pedidos</h2>
    
    @if($pedidos->isEmpty())
        <div class="bg-yellow-100 border-4 border-yellow-500 text-yellow-700 px-4 sm:px-6 py-3 sm:py-4 rounded-lg">
            <p class="font-semibold text-sm sm:text-base">📦 No hay pedidos registrados</p>
        </div>
    @else
        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <table class="w-full min-w-[800px]">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">ID</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Cliente</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Tipo</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Estado</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Total</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Fecha</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="py-3 lg:py-4 px-3 lg:px-4 font-mono text-xs sm:text-sm">#{{ $pedido->id }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <div class="font-semibold text-sm lg:text-base">{{ $pedido->usuario->nombre }} {{ $pedido->usuario->primer_apellido }}</div>
                                <div class="text-xs sm:text-sm text-gray-500">{{ $pedido->usuario->correo }}</div>
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                @if($pedido->forma == 'recogida')
                                    <span class="bg-purple-100 text-purple-800 px-2 sm:px-3 py-1 rounded-full font-semibold flex items-center gap-1 sm:gap-2 w-max text-xs sm:text-sm">
                                        <i class="bi bi-shop"></i> Recogida
                                    </span>
                                @else
                                    <span class="bg-orange-100 text-orange-800 px-2 sm:px-3 py-1 rounded-full font-semibold flex items-center gap-1 sm:gap-2 w-max text-xs sm:text-sm">
                                        <i class="bi bi-truck"></i> Domicilio
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <span class="@if($pedido->estado == 'realizado') bg-green-100 text-green-800 @else bg-yellow-100 text-yellow-800 @endif px-2 sm:px-3 py-1 rounded-full font-semibold capitalize text-xs sm:text-sm">
                                    {{ $pedido->estado }}
                                </span>
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4 font-bold text-[#1E3D9A] text-sm lg:text-base">
                                {{ number_format($pedido->importe, 2) }}€
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4 text-gray-600 text-xs sm:text-sm">
                                {{ $pedido->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('admin_pedidos.edit', $pedido->id) }}" class="px-3 lg:px-4 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition flex items-center justify-center gap-1 sm:gap-2 text-xs sm:text-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                        <span class="hidden sm:inline">Editar</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
