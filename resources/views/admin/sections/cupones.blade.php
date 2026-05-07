<div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8">
    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-4 lg:mb-6">Gestión de cupones</h2>

    @if($cupones->isEmpty())
        <div class="bg-yellow-100 border-4 border-yellow-500 text-yellow-700 px-4 sm:px-6 py-3 sm:py-4 rounded-lg">
            <p class="font-semibold text-sm sm:text-base">🎟️ No hay cupones registrados</p>
        </div>
    @else
        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <table class="w-full min-w-[700px]">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">ID</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Imagen</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Nombre</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Puntos</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cupones as $cupon)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="py-3 lg:py-4 px-3 lg:px-4 font-mono text-xs sm:text-sm">#{{ $cupon->id }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                @php
                                    $cuponImg = $cupon->imagenes
                                        ? (Str::startsWith($cupon->imagenes, 'http') ? $cupon->imagenes : asset('storage/'.$cupon->imagenes))
                                        : 'https://picsum.photos/seed/coupon'. $cupon->id .'/80/80';
                                @endphp
                                <img src="{{ $cuponImg }}" alt="{{ $cupon->nombre }}" class="w-12 h-12 object-cover rounded-full" onerror="this.src='https://via.placeholder.com/80'">
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4 font-semibold text-sm lg:text-base">{{ $cupon->nombre }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <span class="bg-green-100 text-green-800 px-2 sm:px-3 py-1 rounded-full font-semibold text-xs sm:text-sm">
                                    {{ $cupon->puntos_necesarios }} pts
                                </span>
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <div class="flex flex-wrap items-center gap-2">
                                    <a href="{{ route('admin_cupones.edit', $cupon->id) }}" class="px-2 lg:px-3 py-1 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition flex items-center justify-center gap-1 sm:gap-2 text-xs">
                                        <i class="bi bi-pencil-fill"></i>
                                        <span class="hidden sm:inline">Editar</span>
                                    </a>
                                    <form action="{{ route('admin_cupones.delete') }}" method="POST" class="inline delete-form" data-id="{{ $cupon->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $cupon->id }}">
                                        <button type="submit" class="px-2 lg:px-3 py-1 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition flex items-center justify-center gap-1 sm:gap-2 text-xs w-full">
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
