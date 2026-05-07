<div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8">
    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-4 lg:mb-6">Gestión de reservas</h2>
    
    @if($reservas->isEmpty())
        <div class="bg-yellow-100 border-4 border-yellow-500 text-yellow-700 px-4 sm:px-6 py-3 sm:py-4 rounded-lg">
            <p class="font-semibold text-sm sm:text-base">📅 Ahora mismo no hay reservas pendientes</p>
        </div>
    @else
        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <table class="w-full min-w-[900px]">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Nombre</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Email</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Teléfono</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Fecha</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Hora</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Personas</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Estado</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Notas</th>
                        <th class="text-left py-3 lg:py-4 px-3 lg:px-4 font-bold text-gray-700 text-sm lg:text-base">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="py-3 lg:py-4 px-3 lg:px-4 text-sm lg:text-base">{{ $reserva->usuario->nombre }} {{ $reserva->usuario->primer_apellido }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4 text-xs sm:text-sm">{{ $reserva->usuario->correo }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4 text-sm lg:text-base">{{ $reserva->usuario->telefono }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4 text-sm lg:text-base">{{ $reserva->fecha->format('d/m/Y') }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4 text-sm lg:text-base">{{ $reserva->hora->format('H:i') }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <span class="bg-blue-100 text-blue-800 px-2 sm:px-3 py-1 rounded-full font-semibold text-xs sm:text-sm">
                                    {{ $reserva->numero_personas }}
                                </span>
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <span class="@if($reserva->estado === 'confirmada') bg-green-100 text-green-800 @elseif($reserva->estado === 'pendiente') bg-yellow-100 text-yellow-800 @else bg-red-100 text-red-800 @endif px-2 sm:px-3 py-1 rounded-full font-semibold capitalize text-xs sm:text-sm">
                                    {{ $reserva->estado }}
                                </span>
                            </td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4 text-gray-600 text-xs sm:text-sm max-w-[100px] truncate">{{ $reserva->notas ?? '-' }}</td>
                            <td class="py-3 lg:py-4 px-3 lg:px-4">
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('admin_reserva.edit', $reserva->id) }}" class="px-3 lg:px-4 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition flex items-center justify-center gap-1 sm:gap-2 text-xs sm:text-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                        <span class="hidden sm:inline">Editar</span>
                                    </a>
                                    
                                    <form action="{{ route('admin_reserva.delete') }}" method="POST" class="inline delete-form" data-id="{{ $reserva->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $reserva->id }}">
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
