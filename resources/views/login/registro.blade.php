@extends('pagina.layouts.plantilla_admin')

@section('title', 'Registro - Surprise Burger')

@section('content')
<!-- ===== PÁGINA DE REGISTRO DE NUEVO USUARIO ===== -->
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    
    {{-- Formulario de creación de cuenta --}}
    <form class="relative w-[400px] p-6 bg-white rounded-2xl shadow-lg font-sans" action="{{ route('registro.store') }}" method="POST">
        @csrf
        {{-- Título del formulario --}}
        <div class="text-[22px] font-semibold text-slate-800 mb-6 text-center tracking-tight">
            Crear cuenta
        </div>

        {{-- Cuerpo del formulario con todos los campos --}}
        <div class="space-y-4">

            {{-- Fila para Nombre y Primer Apellido --}}
            <div class="grid grid-cols-2 gap-4">
                {{-- Campo Nombre --}}
                <div class="relative flex items-center">
                    {{-- Icono decorativo de usuario --}}
                    <svg fill="none" viewBox="0 0 24 24" class="absolute left-3 w-4 h-4 text-slate-500 pointer-events-none">
                        <circle stroke-width="1.5" stroke="currentColor" r="4" cy="8" cx="12"></circle>
                        <path stroke-linecap="round" stroke-width="1.5" stroke="currentColor" d="M5 20C5 17.2386 8.13401 15 12 15C15.866 15 19 17.2386 19 20"></path>
                    </svg>
                    <input required placeholder="Nombre" 
                        class="w-full h-10 px-9 text-sm border border-slate-200 rounded-lg bg-slate-50 text-slate-800 placeholder-slate-500 transition-all duration-200 hover:border-slate-300 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10" 
                        type="text" name="nombre" value="{{ old('nombre') }}" />
                </div>
                {{-- Campo Primer Apellido --}}
                <div class="relative flex items-center">
                    <input required placeholder="Apellidos" 
                        class="w-full h-10 px-3 text-sm border border-slate-200 rounded-lg bg-slate-50 text-slate-800 placeholder-slate-500 transition-all duration-200 hover:border-slate-300 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10" 
                        type="text" name="primer_apellido" value="{{ old('primer_apellido') }}" />
                </div>
            </div>
            {{-- Errores de validación para nombre y apellido --}}
            @error('nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            @error('primer_apellido') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

            {{-- Campo de correo electrónico --}}
            <div class="relative flex items-center">
                <svg fill="none" viewBox="0 0 24 24" class="absolute left-3 w-4 h-4 text-slate-500 pointer-events-none peer-valid:text-emerald-500">
                    <path stroke-width="1.5" stroke="currentColor" d="M3 8L10.8906 13.2604C11.5624 13.7083 12.4376 13.7083 13.1094 13.2604L21 8M5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19Z"></path>
                </svg>
                <input required placeholder="Correo electrónico" 
                    class="w-full h-10 px-9 text-sm border border-slate-200 rounded-lg bg-slate-50 text-slate-800 placeholder-slate-500 transition-all duration-200 hover:border-slate-300 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 valid:border-emerald-500 peer" 
                    type="email" name="correo" value="{{ old('correo') }}" />
            </div>
            @error('correo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

            {{-- Campo de teléfono (opcional) --}}
            <div class="relative flex items-center">
                <svg fill="none" viewBox="0 0 24 24" class="absolute left-3 w-4 h-4 text-slate-500 pointer-events-none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <input placeholder="Teléfono (Opcional)" 
                    class="w-full h-10 px-9 text-sm border border-slate-200 rounded-lg bg-slate-50 text-slate-800 placeholder-slate-500 transition-all duration-200 hover:border-slate-300 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10" 
                    type="tel" name="telefono" value="{{ old('telefono') }}"
                    maxlength="9"
                    pattern="[0-9]{9}"
                    oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,9)" />
            </div>
            @error('telefono') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

            {{-- Campo de contraseña con opción de mostrar/ocultar --}}
            <div class="relative flex items-center">
                <svg fill="none" viewBox="0 0 24 24" class="absolute left-3 w-4 h-4 text-slate-500 pointer-events-none">
                    <path stroke-width="1.5" stroke="currentColor" d="M12 10V14M8 6H16C17.1046 6 18 6.89543 18 8V16C18 17.1046 17.1046 18 16 18H8C6.89543 18 6 17.1046 6 16V8C6 6.89543 6.89543 6 8 6Z"></path>
                </svg>
                <input required placeholder="Contraseña" 
                    class="w-full h-10 px-9 text-sm border border-slate-200 rounded-lg bg-slate-50 text-slate-800 placeholder-slate-500 transition-all duration-200 hover:border-slate-300 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10" 
                    type="password" name="contrasena" id="password" />
                {{-- Botón para alternar visibilidad de la contraseña --}}
                <button class="absolute right-3 flex items-center p-1 bg-transparent border-none text-slate-500 cursor-pointer transition-all duration-200 hover:text-blue-500 hover:scale-110 active:scale-90" 
                    type="button" onclick="togglePassword()">
                    <svg fill="none" viewBox="0 0 24 24" class="w-4 h-4">
                        <path stroke-width="1.5" stroke="currentColor" d="M2 12C2 12 5 5 12 5C19 5 22 12 22 12C22 12 19 19 12 19C5 19 2 12 2 12Z"></path>
                        <circle stroke-width="1.5" stroke="currentColor" r="3" cy="12" cx="12"></circle>
                    </svg>
                </button>
            </div>
            @error('contrasena') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

            {{-- Campo de confirmación de contraseña --}}
            <div class="relative flex items-center">
                <svg fill="none" viewBox="0 0 24 24" class="absolute left-3 w-4 h-4 text-slate-500 pointer-events-none">
                    <path stroke-width="1.5" stroke="currentColor" d="M5 13l4 4L19 7"></path>
                </svg>
                <input required placeholder="Confirmar contraseña" 
                    class="w-full h-10 px-9 text-sm border border-slate-200 rounded-lg bg-slate-50 text-slate-800 placeholder-slate-500 transition-all duration-200 hover:border-slate-300 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10" 
                    type="password" name="contrasena_confirmation" />
            </div>

        </div>

        {{-- Botón de envío del formulario --}}
        <button 
            class="relative w-full h-10 mt-6 bg-blue-500 text-white border-none rounded-lg text-sm font-medium cursor-pointer overflow-hidden transition-all duration-200 hover:bg-blue-600 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/25 active:translate-y-0 active:shadow-none group" 
            type="submit"
        >
            <span class="relative z-10">Crear cuenta</span>
            {{-- Efecto de brillo al pasar el ratón --}}
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-500"></div>
        </button>

        {{-- Enlace para ir a la página de inicio de sesión si ya tiene cuenta --}}
        <div class="mt-4 text-center text-[13px]">
            <a href="{{ route('login.index') }}" class="text-slate-500 no-underline transition-all duration-200 hover:text-slate-800">
                ¿Ya tienes una cuenta? 
                <span class="text-blue-500 font-medium hover:text-blue-600">Inicia sesión</span>
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
