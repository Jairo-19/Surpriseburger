@extends('pagina.layouts.plantilla')

@section('title', 'Quiénes Somos? | Surprise Burger')

@section('content')
<main>
    <!-- SECCIÓN PRINCIPAL -->
    <section class="bg-[#e7f0f8] py-12 sm:py-16 md:py-24 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto text-center">
            <!-- TÍTULO -->
            <h2 class="text-4xl sm:text-5xl md:text-7xl font-black tracking-tight text-[#2d4a77] mb-4 sm:mb-6">
                ¿Quiénes somos?
            </h2>

            <!-- SUBTÍTULO -->
            <p class="text-lg sm:text-xl md:text-2xl text-[#2d4a77] max-w-3xl mx-auto mb-12 sm:mb-16 font-bold px-4">
                Más que una hamburguesería somos una experiencia culinaria que sorprende cada bocado
            </p>

            <!-- NUESTRA HISTORIA -->
            <h3 class="text-2xl sm:text-3xl md:text-4xl font-black text-[#2d4a77] mb-4 sm:mb-6">
                Nuestra historia
            </h3>

            <p class="text-base sm:text-lg md:text-xl text-gray-800 max-w-4xl mx-auto leading-relaxed mb-16 sm:mb-20 md:mb-24 px-4">
                Surprise Burger transforma la hamburguesa en una experiencia deliberada. No vendemos solo sabores. Diseñamos momentos que generan recuerdo y recomendación.
                <br><br>
                Nacimos para romper la rutina del fast food. Nuestra propuesta de valor combina recetas de alta calidad, proveedores locales de Andalucía y una puesta en escena en sala. Al servir, activamos un efecto escénico sorpresa que convierte la llegada del plato en un acto de descubrimiento. El cliente pasa de espectador a protagonista.
            </p>

            <!-- MISIÓN Y VISIÓN -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 md:gap-12">
                <!-- MISIÓN -->
                <div class="bg-[#243f6b] text-white rounded-2xl p-6 sm:p-8 md:p-10 shadow-xl text-left">
                    <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                        <span class="w-5 h-5 sm:w-6 sm:h-6 bg-white rounded-full flex-shrink-0"></span>
                        <h4 class="text-2xl sm:text-3xl font-black">Nuestra misión</h4>
                    </div>
                    <p class="text-base sm:text-lg leading-relaxed opacity-95">
                        La misión de Surprise Burger es ofrecer hamburguesas de alta calidad combinadas con una experiencia gastronómica única. Buscamos sorprender al cliente a través de los sentidos, uniendo sabor, aroma, presentación y atención personalizada para crear momentos memorables.
                    </p>
                </div>

                <!-- VISIÓN -->
                <div class="bg-[#243f6b] text-white rounded-2xl p-6 sm:p-8 md:p-10 shadow-xl text-left">
                    <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                        <span class="w-5 h-5 sm:w-6 sm:h-6 bg-white rounded-full flex-shrink-0"></span>
                        <h4 class="text-2xl sm:text-3xl font-black">Nuestra visión</h4>
                    </div>
                    <p class="text-base sm:text-lg leading-relaxed opacity-95">
                        Nuestra visión es posicionar Surprise Burger como la hamburguesería de referencia en Andalucía por su innovación y calidad, con proyección de expansión a nivel nacional. Aspiramos a ser reconocidos como un espacio donde la comida se convierte en una experiencia divertida y diferenciadora, dirigida especialmente al público joven y adulto joven.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN VALORES -->
    <section class="bg-[#e7f0f8] py-12 sm:py-16 md:py-24 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto text-center">
            <!-- TÍTULO -->
            <h2 class="text-4xl sm:text-5xl md:text-7xl font-black tracking-tight text-[#2d4a77] mb-4 sm:mb-6">
                Nuestros valores
            </h2>

            <!-- SUBTÍTULO -->
            <p class="text-lg sm:text-xl md:text-2xl text-[#2d4a77] max-w-3xl mx-auto mb-12 sm:mb-16 md:mb-20 font-bold px-4">
                Los principios que guían cada decisión que tomamos
            </p>

            <!-- GRID VALORES -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 md:gap-10">
                <!-- PASIÓN -->
                <div class="bg-orange-400 rounded-2xl p-6 sm:p-8 md:p-10 flex flex-col items-center justify-center text-center min-h-[280px] sm:min-h-[320px] shadow-xl">
                    <img src="./imagenes/pasion.webp" alt="Pasión" class="h-12 sm:h-14 md:h-16 mb-4 sm:mb-6" />
                    <h3 class="text-2xl sm:text-3xl font-black mb-3 sm:mb-4">Pasión</h3>
                    <p class="text-base sm:text-lg leading-relaxed">
                        La pasión es el motor que convierte cada hamburguesa en una experiencia única y memorable.
                    </p>
                </div>

                <!-- CALIDAD -->
                <div class="bg-orange-400 rounded-2xl p-6 sm:p-8 md:p-10 flex flex-col items-center justify-center text-center min-h-[280px] sm:min-h-[320px] shadow-xl">
                    <img src="./imagenes/calidad2.webp" alt="Calidad" class="h-12 sm:h-14 md:h-16 mb-4 sm:mb-6" />
                    <h3 class="text-2xl sm:text-3xl font-black mb-3 sm:mb-4">Calidad</h3>
                    <p class="text-base sm:text-lg leading-relaxed">
                        Selección de ingredientes frescos y elaboración artesanal.
                    </p>
                </div>

                <!-- COMUNIDAD -->
                <div class="bg-orange-400 rounded-2xl p-6 sm:p-8 md:p-10 flex flex-col items-center justify-center text-center min-h-[280px] sm:min-h-[320px] shadow-xl">
                    <img src="./imagenes/usuariuo.webp" alt="Comunidad" class="h-12 sm:h-14 md:h-16 mb-4 sm:mb-6" />
                    <h3 class="text-2xl sm:text-3xl font-black mb-3 sm:mb-4">Comunidad</h3>
                    <p class="text-base sm:text-lg leading-relaxed">
                        La comunidad es el ingrediente que une a las personas en torno a la experiencia Surprise Burger.
                    </p>
                </div>

                <!-- INNOVACIÓN -->
                <div class="bg-orange-400 rounded-2xl p-6 sm:p-8 md:p-10 flex flex-col items-center justify-center text-center min-h-[280px] sm:min-h-[320px] shadow-xl">
                    <img src="./imagenes/idea.webp" alt="Innovación" class="h-12 sm:h-14 md:h-16 mb-4 sm:mb-6" />
                    <h3 class="text-2xl sm:text-3xl font-black mb-3 sm:mb-4">Innovación</h3>
                    <p class="text-base sm:text-lg leading-relaxed">
                        Incorporación de elementos sensoriales como humo aromático y presentaciones creativas.
                    </p>
                </div>

                <!-- COMPROMISO -->
                <div class="bg-orange-400 rounded-2xl p-6 sm:p-8 md:p-10 flex flex-col items-center justify-center text-center min-h-[280px] sm:min-h-[320px] shadow-xl">
                    <img src="./imagenes/pacto.webp" alt="Compromiso" class="h-12 sm:h-14 md:h-16 mb-4 sm:mb-6" />
                    <h3 class="text-2xl sm:text-3xl font-black mb-3 sm:mb-4">Compromiso</h3>
                    <p class="text-base sm:text-lg leading-relaxed">
                        Diseño moderno, ambiente dinámico y trato cercano.
                    </p>
                </div>

                <!-- SOSTENIBILIDAD -->
                <div class="bg-orange-400 rounded-2xl p-6 sm:p-8 md:p-10 flex flex-col items-center justify-center text-center min-h-[280px] sm:min-h-[320px] shadow-xl">
                    <img src="./imagenes/sostenibilidad.webp" alt="Sostenibilidad" class="h-12 sm:h-14 md:h-16 mb-4 sm:mb-6" />
                    <h3 class="text-2xl sm:text-3xl font-black mb-3 sm:mb-4">Sostenibilidad</h3>
                    <p class="text-base sm:text-lg leading-relaxed">
                        Uso responsable de recursos y proveedores locales.
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection