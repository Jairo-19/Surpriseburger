@extends('pagina.layouts.plantilla')

@section('title', 'Inicio | Surprise Burger')

@section('content')
   <main>
      <!-- ===== SECCIÓN PORTADA / HERO ===== -->
      <section class="relative min-h-screen flex flex-col items-center justify-center py-12 md:py-20 bg-[#e7f0f8]">
         <!-- Imagen de fondo con opacidad reducida -->
         <img
            src="./imagenes/hamburguesa.webp"
            class="absolute inset-0 w-full h-full object-cover opacity-20"
            alt="Hamburguesa de fondo"
         />

         <div class="relative z-10 text-center px-4 w-full max-w-7xl">
            <!-- Título principal del restaurante -->
            <h1 class="text-5xl sm:text-7xl md:text-8xl lg:text-9xl font-black text-[#2d4a77] leading-none uppercase tracking-tighter">
               Surprise<br />
               Burger
            </h1>
            
            <!-- Slogan -->
            <p class="mt-4 md:mt-6 text-xl sm:text-2xl md:text-3xl text-[#2d4a77] font-bold tracking-tight">
               Las mejores hamburguesas
            </p>

            <!-- Botones de acción principales: Ver menú y Reservar -->
            <div class="mt-8 md:mt-12 flex flex-col sm:flex-row gap-4 md:gap-6 justify-center">
               <button class="px-8 md:px-12 py-4 md:py-5 bg-orange-400 text-white rounded-full text-xl md:text-2xl font-bold shadow-2xl hover:bg-orange-500 transform hover:scale-105 transition duration-300">
                  <a href={{ asset('/menu') }}>Ver menú</a>
               </button>
               <button class="px-8 md:px-12 py-4 md:py-5 bg-orange-400 text-white rounded-full text-xl md:text-2xl font-bold shadow-2xl hover:bg-orange-500 transform hover:scale-105 transition duration-300">
                  <a href={{ asset('/reserva') }}>Reservar</a>
               </button>
            </div>

            <!-- Cuadrícula de características del restaurante -->
            <div class="mt-12 md:mt-24 grid grid-cols-1 sm:grid-cols-3 gap-8 md:gap-12 text-[#2d4a77]">
               <!-- Característica: Entrega rápida -->
               <div class="flex flex-col items-center gap-3 md:gap-4 group">
                  <img 
                     src="./imagenes/entrega.webp" 
                     alt="Entrega rápida"
                     class="h-16 md:h-24 w-auto transform group-hover:scale-110 transition duration-300 ease-in-out" 
                  />
                  <p class="text-lg md:text-2xl font-black uppercase tracking-tighter">Entrega rápida</p>
               </div>

               <!-- Característica: Calidad premium -->
               <div class="flex flex-col items-center gap-3 md:gap-4 group">
                  <img 
                     src="./imagenes/calidad.webp" 
                     alt="Calidad premium"
                     class="h-16 md:h-24 w-auto transform group-hover:scale-110 transition duration-300 ease-in-out" 
                  />
                  <p class="text-lg md:text-2xl font-black uppercase tracking-tighter">Calidad premium</p>
               </div>

               <!-- Característica: Ingredientes naturales -->
               <div class="flex flex-col items-center gap-3 md:gap-4 group">
                  <img 
                     src="./imagenes/natural.webp" 
                     alt="Ingredientes naturales"
                     class="h-16 md:h-24 w-auto transform group-hover:scale-110 transition duration-300 ease-in-out" 
                  />
                  <p class="text-lg md:text-2xl font-black uppercase tracking-tighter">Ingredientes naturales</p>
               </div>
            </div>
         </div>
      </section>

      <!-- ===== SECCIÓN: LAS HAMBURGUESAS MÁS PEDIDAS ===== -->
      <section class="bg-[#e7f0f8] py-16 md:py-32 lg:py-40 min-h-screen flex flex-col justify-center">
         <!-- Título de la sección -->
         <h2 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-[#2d4a77] text-center mb-16 md:mb-24 lg:mb-32 uppercase tracking-tighter px-4">
            Lo más pedido
         </h2>

         <!-- Contenedor de la cuadrícula de platos más pedidos -->
         <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12 lg:gap-16 px-6">
            @foreach($platosMasPedidos as $plato)
               <!-- Tarjeta de plato individual -->
               <div class="bg-[#1e3a8a] p-6 md:p-8 rounded-3xl shadow-2xl transform hover:-translate-y-6 transition duration-300 group">
                  <div class="overflow-hidden rounded-2xl">
                     <!-- Imagen del plato con efecto hover de zoom -->
                     <img 
                        src="{{ $plato->imagenes->isNotEmpty() ? asset('storage/' . $plato->imagenes->first()->ruta) : asset('imagenes/hamburguesa_normal.webp') }}" 
                        alt="{{ $plato->nombre }}"
                        class="w-full h-64 md:h-80 lg:h-96 object-cover group-hover:scale-110 transition duration-500" 
                     />
                  </div>
                  <!-- Nombre del plato -->
                  <p class="mt-6 md:mt-8 text-center font-bold text-2xl md:text-3xl text-white uppercase tracking-tight">{{ $plato->nombre }}</p>
               </div>
            @endforeach
         </div>
      </section>
   </main>
@endsection