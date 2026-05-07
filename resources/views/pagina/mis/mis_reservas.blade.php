@extends('pagina.layouts.plantilla')
@section('title', 'Mis reservas')
@section('content')
    
<div class="w-full min-h-screen bg-[#E7F0F8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Título de la página -->
        <h1 class="text-5xl font-bold text-gray-900 mb-8">Mis reservas</h1>

        <!-- Sección de reservas activas -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Reservas activas</h2>
            @forelse($activas as $reserva)
            <div class="bg-gray-300 border-2 border-dashed border-gray-400 rounded-lg p-8 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <span class="text-lg text-gray-900 font-bold">Fecha: {{ $reserva->fecha->translatedFormat('d \d\e F \d\e Y') }}</span>
                            <span class="ml-4 text-lg text-gray-900 font-bold">{{ $reserva->hora->format('H:i') }}</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <span class="text-lg text-gray-900">Comensales: {{ $reserva->numero_personas }}</span>
                        </div>
                        <div>
                            <span class="text-lg text-gray-900">Estado: {{ ucfirst($reserva->estado) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-gray-300 border-2 border-dashed border-gray-400 rounded-lg p-8 mb-8 min-h-[150px] flex items-center justify-center">
                <p class="text-xl text-gray-600">No tienes reservas activas.</p>
            </div>
            @endforelse
        </div>

        <!-- Sección de historial de reservas -->
        <div class="bg-gray-300 rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Historial de reservas</h2>
            
            <div class="space-y-6">
            @forelse($historial as $reserva)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 border-b border-gray-400 pb-4 last:border-0 last:pb-0">
                    <!-- Columna izquierda -->
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <span class="text-lg text-gray-900">Fecha: {{ $reserva->fecha->translatedFormat('d \d\e F \d\e Y') }}</span>
                            <span class="ml-4 text-lg text-gray-900">{{ $reserva->hora->format('H:i') }}</span>
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div class="space-y-4">
                        <div>
                            <span class="text-lg text-gray-900">Comensales: {{ $reserva->numero_personas }}</span>
                        </div>
                        <div>
                            <span class="text-lg text-gray-900">Duración estimada 2h</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-lg text-gray-600">No tienes reservas anteriores.</p>
            @endforelse
            </div>
        </div>
    </div>
</div>

@endsection