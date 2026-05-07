@extends('pagina.layouts.plantilla')
@section('title', 'Mis comentarios')
@section('content')
    
<div class="w-full min-h-screen bg-[#E7F0F8] py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Título -->
        <h1 class="text-5xl font-bold text-gray-900 mb-8">
            Mis comentarios
        </h1>

        <!-- Comentario -->
        @forelse ($comentarios as $comentario)
            <div class="bg-gray-200 rounded-md p-6 mb-6">

                <!-- Estrellas -->
                <div class="flex mb-4">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-8 h-8 {{ $i <= $comentario->valoracion ? 'text-yellow-400' : 'text-gray-400' }}"
                             fill="currentColor"
                             viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975
                                     4.184.012c.969.003 1.371 1.24.588 1.81l-3.39
                                     2.455 1.269 3.984c.285.894-.755 1.636-1.54
                                     1.1L10 13.348l-3.348 2.915c-.784.536-1.825-.206-1.54-1.1
                                     l1.27-3.984-3.39-2.455c-.784-.57-.38-1.807.588-1.81
                                     l4.184-.012 1.285-3.975z"/>
                        </svg>
                    @endfor
                </div>

                <!-- Título comentario -->
                <h2 class="text-xl font-bold text-black mb-2">
                    Reseña del {{ $comentario->fecha ? $comentario->fecha->translatedFormat('d \d\e F \d\e Y') : $comentario->created_at->translatedFormat('d \d\e F \d\e Y') }}
                </h2>

                <!-- Descripción -->
                <p class="text-gray-800 leading-relaxed">
                    {{ $comentario->texto }}
                </p>

            </div>
        @empty
            <div class="bg-gray-200 rounded-md p-6 mb-6 text-center">
                <p class="text-gray-800 text-lg">No has escrito ninguna reseña todavía.</p>
                <a href="{{ route('resenas.index') }}" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Escribir una reseña</a>
            </div>
        @endforelse

    </div>
</div>
    
@endsection