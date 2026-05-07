 <!-- Pie de página del sitio con logo, navegación y mapa de ubicación -->
 <footer class="bg-orange-400 text-white py-12"> <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-3 gap-10 items-start">
            
            <!-- Columna 1: Logo y redes sociales -->
            <div class="flex flex-col items-center md:items-start gap-4">
                <img class="h-40 w-auto object-contain drop-shadow-lg" src="{{ asset('imagenes/logo.webp') }}" alt="Logo" />
                <div class="space-y-2">
                    <h3 class="text-xl font-bold uppercase tracking-tight">Síguenos</h3>
                    <!-- Iconos de redes sociales -->
                    <div class="flex gap-4">
                        <img class="h-8 w-8 rounded-full hover:scale-110 transition cursor-pointer shadow-md" src="{{ asset('imagenes/facebook.webp') }}" alt="Facebook">
                        <img class="h-8 w-8 rounded-full hover:scale-110 transition cursor-pointer shadow-md" src="{{ asset('imagenes/snapchat.webp') }}" alt="Snapchat">
                        <img class="h-8 w-8 rounded-full hover:scale-110 transition cursor-pointer shadow-md" src="{{ asset('imagenes/twitter.webp') }}" alt= "twitter">
                    </div>
                </div>
            </div>

            <!-- Columna 2: Menú de navegación -->
            <div class="text-center">
                <h3 class="text-xl font-bold uppercase mb-4">Navegación</h3>
                <ul class="space-y-2 text-base font-semibold opacity-90">
                    <li class="cursor-pointer hover:text-[#2d4a77] transition"><a href={{ asset('/') }}>Inicio</a></li>
                    <li class="cursor-pointer hover:text-[#2d4a77] transition"><a href={{ asset('menu') }}>Menu</a></li>
                    <li class="cursor-pointer hover:text-[#2d4a77] transition"><a href={{ asset('reserva') }}>Reservas</a></li>
                    <li class="cursor-pointer hover:text-[#2d4a77] transition"><a href={{ asset('quienes_somos') }}>¿Quienes somos?</a></li>
                    <li class="cursor-pointer hover:text-[#2d4a77] transition"><a href={{ asset('resenas') }}>Reseñas</a></li>
                </ul>
            </div>

            <!-- Columna 3: Mapa de Google con ubicación del restaurante -->
            <div class="flex flex-col gap-4 items-center md:items-end">
                <h3 class="text-xl font-bold uppercase">Encuéntranos</h3>
                <div class="w-full h-48 rounded-2xl overflow-hidden shadow-lg border-4 border-white/20">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=..." 
                        class="w-full h-full" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
        <!-- Texto de copyright -->
        <div class="text-center mt-10 pt-4 border-t border-white/10 text-sm opacity-75">
            &copy; 2026 Surprise Burger - Todos los derechos reservados
        </div>
    </footer>