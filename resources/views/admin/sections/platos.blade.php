<div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8">
    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-4 lg:mb-6">Gestión de platos</h2>
    
    @if($platos->isEmpty())
        <div class="bg-yellow-100 border-4 border-yellow-500 text-yellow-700 px-4 sm:px-6 py-3 sm:py-4 rounded-lg">
            <p class="font-semibold text-sm sm:text-base">🍽️ No hay platos registrados</p>
        </div>
    @else
        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <table class="w-full min-w-[800px]">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Imagen</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Nombre</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Descripción</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Precio</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Categoría</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Estado</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($platos as $plato)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                @if($plato->imagenes->first())
                                    <img src="{{ asset('storage/' . $plato->imagenes->first()->ruta) }}" alt="{{ $plato->nombre }}" class="w-12 h-12 sm:w-16 sm:h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="bi bi-image text-gray-400 text-xl sm:text-2xl"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4 font-semibold text-sm lg:text-base">{{ $plato->nombre }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4 text-gray-600 text-xs sm:text-sm max-w-[150px] truncate">{{ Str::limit($plato->descripcion, 50) }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <span class="bg-green-100 text-green-800 px-2 sm:px-3 py-1 rounded-full font-semibold text-xs sm:text-sm">
                                    {{ number_format($plato->precio, 2) }}€
                                </span>
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <span class="bg-blue-100 text-blue-800 px-2 sm:px-3 py-1 rounded-full font-semibold text-xs sm:text-sm">
                                    {{ $plato->categoria->nombre ?? 'Sin categoría' }}
                                </span>
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <span class="@if($plato->activo) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif px-2 sm:px-3 py-1 rounded-full font-semibold text-xs sm:text-sm">
                                    {{ $plato->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('admin_platos.edit', $plato->id) }}" class="px-3 lg:px-4 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition flex items-center justify-center gap-1 sm:gap-2 text-xs sm:text-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                        <span class="hidden sm:inline">Editar</span>
                                    </a>
                                    
                                    <form action="{{ route('admin_platos.delete') }}" method="POST" class="inline delete-form" data-id="{{ $plato->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $plato->id }}">
                                        <button type="submit" class="px-3 lg:px-4 py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition flex items-center justify-center gap-1 sm:gap-2 text-xs sm:text-sm w-full">
                                            <i class="bi bi-trash-fill"></i>
                                            <span class="hidden sm:inline">Eliminar</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
