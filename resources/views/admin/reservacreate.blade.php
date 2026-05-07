@extends('pagina.layouts.plantilla_admin')
@section('title', 'Creacion de reservas| Surprise Burger')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-blue-100 p-4 sm:p-6 lg:p-8">
    <!-- Contenedor centrado con recuadro azul -->
    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden">
        
        <!-- Alerta de éxito o error -->
        @include('components.alert')
        
        <!-- Header con fondo azul -->
        <div class="bg-[#1E3D9A] px-8 py-10 md:px-12 md:py-12">
            <h1 class="text-3xl md:text-4xl lg:text-5xl text-white text-center mb-2">@if(isset($reserva)) Editar Reserva @else Reserva tu Mesa @endif</h1>
            <p class="text-blue-100 text-center text-sm md:text-base">Completa el formulario para garantizar tu experiencia</p>
        </div>

        <!-- FORMULARIO -->
        <form action="{{ route('admin_reserva.store') }}" method="POST" class="px-8 py-10 md:px-12 md:py-12 space-y-8">
            @csrf
            
            @if(isset($reserva))
                <input type="hidden" name="reserva_id" value="{{ $reserva->id }}">
            @endif
            
            <!-- Nombre y Apellido -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-person-fill text-[#1E3D9A]"></i>
                    Nombre
                </label>
                <input 
                    type="text" 
                    name="nombre" 
                    required 
                    placeholder="Juan" 
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-gray-700 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 transition duration-200 @error('nombre') border-red-500 @enderror" 
                    value="{{ old('nombre', isset($reserva) ? $reserva->usuario->nombre : '') }}" 
                />
                @error('nombre')
                  <span class="text-red-500 text-sm mt-1 flex items-center gap-1">
                      <i class="bi bi-exclamation-circle-fill"></i>{{ $message }}
                  </span>
                @enderror
              </div>

              <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-person-fill text-[#1E3D9A]"></i>
                    Primer Apellido
                </label>
                <input 
                    type="text" 
                    name="primer_apellido" 
                    required 
                    placeholder="García" 
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-gray-700 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 transition duration-200 @error('primer_apellido') border-red-500 @enderror" 
                    value="{{ old('primer_apellido', isset($reserva) ? $reserva->usuario->primer_apellido : '') }}" 
                />
                @error('primer_apellido')
                  <span class="text-red-500 text-sm mt-1 flex items-center gap-1">
                      <i class="bi bi-exclamation-circle-fill"></i>{{ $message }}
                  </span>
                @enderror
              </div>
            </div>

            <!-- Email y Teléfono -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-envelope-fill text-[#1E3D9A]"></i>
                    Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    required 
                    placeholder="juan@ejemplo.com" 
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-gray-700 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 transition duration-200 @error('email') border-red-500 @enderror" 
                    value="{{ old('email', isset($reserva) ? $reserva->usuario->correo : '') }}" 
                />
                @error('email')
                  <span class="text-red-500 text-sm mt-1 flex items-center gap-1">
                      <i class="bi bi-exclamation-circle-fill"></i>{{ $message }}
                  </span>
                @enderror
              </div>

              <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-telephone-fill text-[#1E3D9A]"></i>
                    Teléfono
                </label>
                <input 
                    type="tel" 
                    name="telefono" pattern="[0-9]+" inputmode="numeric" 
                    required 
                    placeholder="+34 600 000 000" 
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-gray-700 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 transition duration-200 @error('telefono') border-red-500 @enderror" 
                    value="{{ old('telefono', isset($reserva) ? $reserva->usuario->telefono : '') }}" 
                />
                @error('telefono')
                  <span class="text-red-500 text-sm mt-1 flex items-center gap-1">
                      <i class="bi bi-exclamation-circle-fill"></i>{{ $message }}
                  </span>
                @enderror
              </div>
            </div>

            <!-- Fecha, Hora y Personas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-calendar-event-fill text-[#1E3D9A]"></i>
                    Fecha
                </label>
                <!-- id="fecha-reserva-admin" usado por JS para bloquear domingos; min impide seleccionar fechas pasadas -->
                <input 
                    type="date" 
                    id="fecha-reserva-admin"
                    name="fecha" 
                    required
                    min="{{ now()->addDay()->format('Y-m-d') }}"
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-gray-700 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 transition duration-200 @error('fecha') border-red-500 @enderror" 
                    value="{{ old('fecha', isset($reserva) ? $reserva->fecha->format('Y-m-d') : '') }}" 
                />
                <!-- Aviso de domingo (oculto por defecto) -->
                <span id="aviso-domingo-admin" class="hidden text-red-500 text-sm mt-1 flex items-center gap-1">
                    <i class="bi bi-exclamation-circle-fill"></i>El restaurante está cerrado los domingos. Elige otro día.
                </span>
                @error('fecha')
                  <span class="text-red-500 text-sm mt-1 flex items-center gap-1">
                      <i class="bi bi-exclamation-circle-fill"></i>{{ $message }}
                  </span>
                @enderror
              </div>
              
              <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-clock-fill text-[#1E3D9A]"></i>
                    Hora
                </label>
                @php
                    // Franjas horarias permitidas: comida (12:00-17:00) y cena (20:00-00:00)
                    $franjaComida = ['12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00'];
                    $franjaCena  = ['20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00'];
                    $horaVieja   = old('hora', isset($reserva) ? $reserva->hora->format('H:i') : '');
                @endphp
                <select
                    name="hora"
                    required
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-gray-700 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 transition duration-200 @error('hora') border-red-500 @enderror"
                >
                    <option value="">-- Selecciona una hora --</option>
                    <!-- Turno de comida -->
                    <optgroup label="Comida (12:00 - 17:00)">
                        @foreach($franjaComida as $slot)
                            <option value="{{ $slot }}" {{ $horaVieja == $slot ? 'selected' : '' }}>{{ $slot }}</option>
                        @endforeach
                    </optgroup>
                    <!-- Turno de cena -->
                    <optgroup label="Cena (20:00 - 00:00)">
                        @foreach($franjaCena as $slot)
                            <option value="{{ $slot }}" {{ $horaVieja == $slot ? 'selected' : '' }}>{{ $slot }}</option>
                        @endforeach
                    </optgroup>
                </select>
                @error('hora')
                  <span class="text-red-500 text-sm mt-1 flex items-center gap-1">
                      <i class="bi bi-exclamation-circle-fill"></i>{{ $message }}
                  </span>
                @enderror
              </div>
              
              <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-people-fill text-[#1E3D9A]"></i>
                    Personas
                </label>
                <!-- Máximo 10 comensales por reserva. oninput impide escribir valores fuera del rango -->
                <input 
                    type="number" 
                    name="numero_personas" 
                    min="1" 
                    max="10" 
                    required
                    oninput="if(this.value>10)this.value=10; if(this.value<1)this.value=1;" 
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-gray-700 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 transition duration-200 @error('numero_personas') border-red-500 @enderror" 
                    value="{{ old('numero_personas', isset($reserva) ? $reserva->numero_personas : '') }}" 
                />
                @error('numero_personas')
                  <span class="text-red-500 text-sm mt-1 flex items-center gap-1">
                      <i class="bi bi-exclamation-circle-fill"></i>{{ $message }}
                  </span>
                @enderror
              </div>
            </div>

            <!-- Notas especiales -->
            <div class="group">
              <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                  <i class="bi bi-chat-left-text-fill text-[#1E3D9A]"></i>
                  Notas especiales (opcional)
              </label>
              <textarea 
                  name="notas" 
                  rows="4" 
                  class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-gray-700 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 transition duration-200 resize-none @error('notas') border-red-500 @enderror" 
                  placeholder="Alergias, preferencias de mesa, ocasión especial...">{{ old('notas', isset($reserva) ? $reserva->notas : '') }}</textarea>
              @error('notas')
                <span class="text-red-500 text-sm mt-1 flex items-center gap-1">
                    <i class="bi bi-exclamation-circle-fill"></i>{{ $message }}
                </span>
              @enderror
            </div>

            <!-- Script: bloquear domingos en el selector de fecha del panel admin -->
            <script>
                document.getElementById('fecha-reserva-admin').addEventListener('change', function () {
                    const aviso = document.getElementById('aviso-domingo-admin');
                    if (!this.value) return;

                    // Parsear la fecha localmente para evitar desfases UTC
                    const partes = this.value.split('-');
                    const dia = new Date(partes[0], partes[1] - 1, partes[2]);

                    if (dia.getDay() === 0) {
                        // Es domingo: limpiar el campo y mostrar aviso
                        this.value = '';
                        aviso.classList.remove('hidden');
                    } else {
                        aviso.classList.add('hidden');
                    }
                });
            </script>

            <!-- Botón de envío -->
            <button 
                type="submit" 
                class="w-full bg-[#1E3D9A] text-white py-5 rounded-xl text-lg font-bold hover:bg-[#152d73] transform hover:scale-[1.02] transition duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                <i class="bi bi-check-circle-fill group-hover:scale-110 transition-transform"></i>
                @if(isset($reserva)) Actualizar reserva @else Confirmar reserva @endif
            </button>
        </form>
    </div>
</div>
@endsection