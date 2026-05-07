@extends('pagina.layouts.plantilla_admin')

@section('title', 'Inicio de Sesión - Surprise Burger')

@section('content')
<!-- ===== PÁGINA DE INICIO DE SESIÓN ===== -->
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    {{-- Formulario de inicio de sesión --}}
    <form class="relative w-[300px] p-6 bg-white rounded-2xl shadow-lg font-sans" action="{{ route('login.store') }}" method="POST">
        @csrf
        {{-- Título del formulario --}}
        <div class="text-[22px] font-semibold text-slate-800 mb-6 text-center tracking-tight">
            Iniciar sesión
        </div>

        {{-- Cuerpo del formulario con los campos de entrada --}}
        <div class="space-y-4">

            {{-- Campo de correo electrónico --}}
            <div class="relative flex items-center">
                {{-- Icono decorativo de email --}}
                <svg fill="none" viewBox="0 0 24 24" class="absolute left-3 w-4 h-4 text-slate-500 pointer-events-none peer-valid:text-emerald-500">
                    <path stroke-width="1.5" stroke="currentColor" d="M3 8L10.8906 13.2604C11.5624 13.7083 12.4376 13.7083 13.1094 13.2604L21 8M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z"></path>
                </svg>
                
                {{-- Input de correo electrónico --}}
                <input 
                    required 
                    placeholder="Correo electrónico" 
                    class="w-full h-10 px-9 text-sm border border-slate-200 rounded-lg bg-slate-50 text-slate-800 placeholder-slate-500 transition-all duration-200 hover:border-slate-300 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 valid:border-emerald-500 peer" 
                    type="email"
                    name="correo"
                    value="{{ old('correo') }}"
                />
            </div>
            {{-- Mensaje de error para el campo correo --}}
            @error('correo')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror

            {{-- Campo de contraseña --}}
            <div class="relative flex items-center">
                {{-- Icono decorativo de candado --}}
                <svg fill="none" viewBox="0 0 24 24" class="absolute left-3 w-4 h-4 text-slate-500 pointer-events-none">
                    <path stroke-width="1.5" stroke="currentColor" d="M12 10V14M8 6H16C17.1046 6 18 6.89543 18 8V16C18 17.1046 17.1046 18 16 18H8C6.89543 18 6 17.1046 6 16V8C6 6.89543 6.89543 6 8 6Z"></path>
                </svg>
                
                {{-- Input de contraseña --}}
                <input 
                    required 
                    placeholder="Contraseña" 
                    class="w-full h-10 px-9 text-sm border border-slate-200 rounded-lg bg-slate-50 text-slate-800 placeholder-slate-500 transition-all duration-200 hover:border-slate-300 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10" 
                    type="password"
                    name="contrasena"
                    id="password"
                />
                
                {{-- Botón para mostrar u ocultar la contraseña --}}
                <button 
                    class="absolute right-3 flex items-center p-1 bg-transparent border-none text-slate-500 cursor-pointer transition-all duration-200 hover:text-blue-500 hover:scale-110 active:scale-90" 
                    type="button"
                    onclick="togglePassword()"
                >
                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4">
                        <path stroke-width="1.5" stroke="currentColor" d="M2 12C2 12 5 5 12 5C19 5 22 12 22 12C22 12 19 19 12 19C5 19 2 12 2 12Z"></path>
                        <circle stroke-width="1.5" stroke="currentColor" r="3" cy="12" cx="12"></circle>
                    </svg>
                </button>
            </div>
            {{-- Mensaje de error para el campo contraseña --}}
            @error('contrasena')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botón de envío del formulario --}}
        <button 
            class="relative w-full h-10 mt-6 bg-blue-500 text-white border-none rounded-lg text-sm font-medium cursor-pointer overflow-hidden transition-all duration-200 hover:bg-blue-600 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/25 active:translate-y-0 active:shadow-none group" 
            type="submit"
        >
            <span class="relative z-10">Entrar</span>
            {{-- Efecto de brillo animado al pasar el ratón --}}
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-500"></div>
        </button>

        {{-- Enlace para ir a la página de registro --}}
        <div class="mt-4 text-center text-[13px]">
            <a href="{{ route('registro.index') }}" class="text-slate-500 no-underline transition-all duration-200 hover:text-slate-800">
                ¿No tienes cuenta? 
                <span class="text-blue-500 font-medium hover:text-blue-600">Regístrate</span>
            </a>
        </div>
    </form>
</div>

<script>
    // Alterna la visibilidad de la contraseña
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection