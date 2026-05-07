@extends('pagina.layouts.plantilla')
@section('title', 'Mi perfil')
@section('content')
    
<div class="w-full min-h-screen bg-[#E7F0F8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Sección de encabezado -->
        <div class="mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $user->nombre }} {{ $user->primer_apellido }} {{ $user->segundo_apellido }}</h1>
            <p class="text-gray-600 text-lg">{{ $user->correo }}</p>
        </div>

        <!-- Cuadrícula de tarjetas de estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Card 1: Años con nosotros -->
            <div class="bg-white rounded-xl p-6 flex flex-col items-center justify-center min-h-[180px] shadow-sm border border-gray-100">
                <div class="bg-blue-100 p-4 rounded-full mb-4">
                    <i class="bi bi-clock-history text-3xl text-blue-800"></i>
                </div>
                <p class="text-xl font-semibold text-gray-900 text-center leading-tight">{{ $anosConNosotros }} años con<br>nosotros</p>
            </div>

            <!-- Card 2: Puntos acumulados -->
            <div class="bg-white rounded-xl p-6 flex flex-col items-center justify-center min-h-[180px] shadow-sm border border-gray-100">
                <div class="bg-yellow-100 p-4 rounded-full mb-4">
                    <i class="bi bi-piggy-bank text-3xl text-yellow-700"></i>
                </div>
                <p class="text-xl font-semibold text-gray-900 text-center leading-tight">{{ $puntosAcumulados }} puntos<br>acumulados</p>
            </div>

            <!-- Card 3: Reservas activas -->
            <div class="bg-white rounded-xl p-6 flex flex-col items-center justify-center min-h-[180px] shadow-sm border border-gray-100">
                <div class="bg-green-100 p-4 rounded-full mb-4">
                    <i class="bi bi-calendar-check text-3xl text-green-800"></i>
                </div>
                <p class="text-xl font-semibold text-gray-900 text-center leading-tight">{{ $reservasActivas }} Reservas<br>activas</p>
            </div>

            <!-- Card 4: Valoraciones -->
            <div class="bg-white rounded-xl p-6 flex flex-col items-center justify-center min-h-[180px] shadow-sm border border-gray-100">
                <div class="bg-purple-100 p-4 rounded-full mb-4">
                    <i class="bi bi-star-fill text-3xl text-purple-800"></i>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-gray-900 mb-1">{{ $totalResenas }}</p>
                    <p class="text-lg font-semibold text-gray-900">Valoraciones</p>
                </div>
            </div>
        </div>

        <!-- Sección de datos personales -->
        <div class="bg-white rounded-xl p-8 shadow-sm border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                <i class="bi bi-person-lines-fill text-blue-800"></i>
                Datos personales
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-8">
                <!-- Nombre -->
                <div class="flex flex-col">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1 flex items-center gap-2">
                        <i class="bi bi-person"></i> Nombre completo
                    </h3>
                    <p class="text-gray-900 text-xl font-medium">{{ $user->nombre }} {{ $user->primer_apellido }} {{ $user->segundo_apellido }}</p>
                </div>

                <!-- Correo -->
                <div class="flex flex-col">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1 flex items-center gap-2">
                        <i class="bi bi-envelope"></i> Correo electrónico
                    </h3>
                    <p class="text-gray-900 text-xl font-medium">{{ $user->correo }}</p>
                </div>

                <!-- Miembro desde -->
                <div class="md:col-span-2 flex flex-col">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1 flex items-center gap-2">
                        <i class="bi bi-calendar3"></i> Miembro desde
                    </h3>
                    <p class="text-gray-900 text-xl font-medium">{{ $miembroDesde }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection