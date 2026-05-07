 <header class="w-full bg-[#e7f0f8] shadow-md z-50">
        <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-2">
            <!-- Logo del restaurante -->
            <div class="flex-shrink-0">
                <img class="h-12 md:h-14" src="{{ asset('imagenes/logo.webp') }}" alt="Logo"  />
            </div>

            <!-- Navegacion Desktop -->
            <div class="hidden md:flex flex-1 items-center justify-center px-8">
                <ul class="flex gap-8 font-bold text-base lg:text-lg text-[#2d4a77] tracking-tight"> 
                    <li class="cursor-pointer hover:text-blue-600 transition"><a href={{ asset('/') }}>Inicio</a></li>
                    <li class="cursor-pointer hover:text-blue-600 transition"><a href={{ asset('menu') }}>Menu</a></li>
                    <li class="cursor-pointer hover:text-blue-600 transition"><a href={{ asset('reserva') }}>Reservas</a></li>
                    <li class="cursor-pointer hover:text-blue-600 transition"><a href={{ asset('quienes_somos') }}>¿Quienes somos?</a></li>
                    <li class="cursor-pointer hover:text-blue-600 transition"><a href={{ asset('resenas') }}>Reseñas</a></li>
                </ul>
            </div>

            <div class="flex items-center gap-4 text-[#2d4a77] flex-shrink-0">
                <!-- Carrito -->
                <a href="{{ route('mis_pedidos.index') }}#carrito" class="hidden md:block">
                    <img class="h-6 w-6 object-contain" src="{{ asset('imagenes/carrito.webp') }}" alt="Carrito"  />
                </a>

                <!-- Menú Desktop (Auth) -->
                @auth
                    <div class="hidden md:block relative">
                        <button onclick="toggleDropdown()" class="flex items-center gap-2 text-[#2d4a77] font-bold focus:outline-none hover:text-blue-600 transition">
                            <span>{{ Auth::user()->nombre }}</span>
                            <i class="bi bi-chevron-down text-sm"></i>
                        </button>

                        <!-- Menu desplegable -->
                        <div id="userDropdown" class="hidden absolute right-0 mt-2 w-72 bg-gray-100 rounded-lg shadow-xl py-2 z-50 border border-gray-200">
                            <!-- Información del usuario -->
                            <div class="px-6 py-4 border-b border-gray-200 text-center">
                                <p class="text-lg font-bold text-gray-900 truncate">{{ Auth::user()->nombre }} {{ Auth::user()->primer_apellido }} {{ Auth::user()->segundo_apellido ?? '' }}</p>
                                <p class="text-sm text-gray-600 truncate">{{ Auth::user()->correo }}</p>
                            </div>

                            <!-- Botones -->
                            <div class="py-2">
                                <a href="{{ route('perfil') }}" class="px-6 py-3 text-base font-semibold text-gray-800 hover:bg-gray-200 transition-colors flex items-center gap-3">
                                    <i class="bi bi-person text-xl"></i> Mi perfil
                                </a>
                                <a href="{{ route('mis_pedidos.index') }}" class="px-6 py-3 text-base font-semibold text-gray-800 hover:bg-gray-200 transition-colors flex items-center gap-3">
                                    <i class="bi bi-cart text-xl"></i> Mis pedidos
                                </a>
                                <a href="{{ route('mis_recompensas.index') }}" class="px-6 py-3 text-base font-semibold text-gray-800 hover:bg-gray-200 transition-colors flex items-center gap-3">
                                    <i class="bi bi-gift text-xl"></i> Mis recompensas
                                </a>
                                <a href="{{ route('mis_reservas.index') }}" class="px-6 py-3 text-base font-semibold text-gray-800 hover:bg-gray-200 transition-colors flex items-center gap-3">
                                    <i class="bi bi-calendar-check text-xl"></i> Mis reservas
                                </a>
                                <a href="{{ route('mis_comentarios.index') }}" class="px-6 py-3 text-base font-semibold text-gray-800 hover:bg-gray-200 transition-colors flex items-center gap-3">
                                    <i class="bi bi-star text-xl text-yellow-500"></i> Mis reseñas
                                </a>
                            </div>

                            <!-- Cerrar sesión -->
                            <div class="border-t border-gray-200 mt-2 pt-2 pb-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full px-6 py-3 text-base font-bold text-red-600 hover:bg-red-50 transition-colors flex items-center justify-center gap-3">
                                        <i class="bi bi-box-arrow-right text-xl"></i> Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <button onclick="window.location.href='{{ route('login.index') }}'" class="hidden md:block text-sm md:text-base font-bold cursor-pointer hover:text-blue-600 transition">
                        Inicio de sesión
                    </button>
                @endauth

                <!-- Botón Hamburguesa Móvil -->
                <button id="mobileMenuBtn" class="md:hidden text-[#2d4a77] focus:outline-none" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- Menú Lateral Móvil (Sidebar a la derecha) -->
    <div id="mobileMenuOverlay" class="hidden md:hidden fixed inset-0 bg-black bg-opacity-50 z-40" onclick="toggleMobileMenu()"></div>
    
    <div id="mobileMenu" class="hidden md:hidden fixed top-0 right-0 h-screen w-80 bg-white shadow-xl z-50 transform transition-transform duration-300 ease-in-out overflow-y-auto">
        <!-- Botón cerrar en el menú móvil -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-[#2d4a77]">Menú</h2>
            <button onclick="toggleMobileMenu()" class="text-[#2d4a77] focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Enlaces de navegación -->
        <nav class="px-6 py-4 space-y-2">
            <a href="{{ asset('/') }}" class="block py-3 text-[#2d4a77] font-bold hover:text-blue-600 transition border-b border-gray-100" onclick="toggleMobileMenu()">Inicio</a>
            <a href="{{ asset('menu') }}" class="block py-3 text-[#2d4a77] font-bold hover:text-blue-600 transition border-b border-gray-100" onclick="toggleMobileMenu()">Menú</a>
            <a href="{{ asset('reserva') }}" class="block py-3 text-[#2d4a77] font-bold hover:text-blue-600 transition border-b border-gray-100" onclick="toggleMobileMenu()">Reservas</a>
            <a href="{{ asset('quienes_somos') }}" class="block py-3 text-[#2d4a77] font-bold hover:text-blue-600 transition border-b border-gray-100" onclick="toggleMobileMenu()">¿Quiénes somos?</a>
            <a href="{{ asset('resenas') }}" class="block py-3 text-[#2d4a77] font-bold hover:text-blue-600 transition border-b border-gray-100" onclick="toggleMobileMenu()">Reseñas</a>
            <a href="{{ route('mis_pedidos.index') }}#carrito" class="block py-3 text-[#2d4a77] font-bold hover:text-blue-600 transition border-b border-gray-100 flex items-center gap-3" onclick="toggleMobileMenu()">
                <i class="bi bi-cart text-xl"></i> Carrito
            </a>
        </nav>

        <!-- Sección de autenticación -->
        @auth
            <div class="border-t border-gray-200 mt-6 pt-6 px-6">
                <!-- Información del usuario -->
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <p class="text-lg font-bold text-gray-900 truncate">{{ Auth::user()->nombre }} {{ Auth::user()->primer_apellido }}</p>
                    <p class="text-sm text-gray-600 truncate">{{ Auth::user()->correo }}</p>
                </div>

                <!-- Opciones de usuario -->
                <div class="space-y-2 mb-6">
                    <a href="{{ route('perfil') }}" class="block py-3 text-base font-semibold text-gray-800 hover:bg-gray-100 transition-colors px-3 rounded" onclick="toggleMobileMenu()">
                        <i class="bi bi-person text-xl"></i> Mi perfil
                    </a>
                    <a href="{{ route('mis_pedidos.index') }}" class="block py-3 text-base font-semibold text-gray-800 hover:bg-gray-100 transition-colors px-3 rounded" onclick="toggleMobileMenu()">
                        <i class="bi bi-cart text-xl"></i> Mis pedidos
                    </a>
                    <a href="{{ route('mis_recompensas.index') }}" class="block py-3 text-base font-semibold text-gray-800 hover:bg-gray-100 transition-colors px-3 rounded" onclick="toggleMobileMenu()">
                        <i class="bi bi-gift text-xl"></i> Mis recompensas
                    </a>
                    <a href="{{ route('mis_reservas.index') }}" class="block py-3 text-base font-semibold text-gray-800 hover:bg-gray-100 transition-colors px-3 rounded" onclick="toggleMobileMenu()">
                        <i class="bi bi-calendar-check text-xl"></i> Mis reservas
                    </a>
                    <a href="{{ route('mis_comentarios.index') }}" class="block py-3 text-base font-semibold text-gray-800 hover:bg-gray-100 transition-colors px-3 rounded" onclick="toggleMobileMenu()">
                        <i class="bi bi-star text-xl text-yellow-500"></i> Mis reseñas
                    </a>
                </div>

                <!-- Cerrar sesión -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-3 text-base font-bold text-red-600 hover:bg-red-50 transition-colors px-3 rounded">
                        <i class="bi bi-box-arrow-right text-xl"></i> Cerrar sesión
                    </button>
                </form>
            </div>
        @else
            <div class="border-t border-gray-200 mt-6 pt-6 px-6">
                <button onclick="window.location.href='{{ route('login.index') }}'" class="w-full py-3 text-base font-bold text-white bg-blue-600 hover:bg-blue-700 transition-colors rounded">
                    Iniciar sesión
                </button>
            </div>
        @endauth
    </div>

    <script>
        // Función para alternar la visibilidad del menú móvil lateral
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileOverlay = document.getElementById('mobileMenuOverlay');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            
            if (mobileMenu && mobileOverlay) {
                const isHidden = mobileMenu.classList.contains('hidden');
                
                // Si está oculto, mostrarlo; si está visible, ocultarlo
                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    mobileOverlay.classList.remove('hidden');
                    mobileMenu.style.transform = 'translateX(0)';
                } else {
                    mobileMenu.classList.add('hidden');
                    mobileOverlay.classList.add('hidden');
                    mobileMenu.style.transform = 'translateX(100%)';
                }
            }
        }

        // Cerrar el menú desplegable al hacer clic fuera de él
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const button = document.querySelector('button[onclick="toggleDropdown()"]');
            
            if (dropdown && !dropdown.contains(event.target) && button && !button.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Función para mostrar/ocultar el desplegable del usuario autenticado
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }
    </script>

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            
            if (mobileMenu) {
                mobileMenu.classList.toggle('hidden');
                
                // Cambiar el icono del botón
                const svg = mobileMenuBtn.querySelector('svg');
                if (mobileMenu.classList.contains('hidden')) {
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
                } else {
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
                }
            }
        }

        // Cerrar menú móvil al hacer clic en un link
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileLinks = mobileMenu ? mobileMenu.querySelectorAll('a') : [];
            
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
                    const svg = mobileMenuBtn.querySelector('svg');
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
                });
            });
        });
    </script>
