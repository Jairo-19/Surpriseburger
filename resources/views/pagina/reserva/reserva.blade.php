@extends('pagina.layouts.plantilla')

@section('title', 'Reservas | Surprise Burger')

@section('content')

<!-- ===== PÁGINA DE RESERVA DE MESA ===== -->
<main class="bg-[#e7f0f8] py-20 px-6">
  <div class="max-w-7xl mx-auto">

    {{-- Componente de alertas (mensajes de éxito o error) --}}
    @include('components.alert')

    <!-- TÍTULO DE LA SECCIÓN -->
    <div class="text-center mb-14">
      <h2 class="text-4xl md:text-6xl mb-4 text-[#2d4a77]">Reserva tu mesa</h2>
      <p class="max-w-2xl mx-auto text-lg text-gray-700">
        Asegura tu lugar en nuestra hamburguesería y disfruta de la mejor
        experiencia gastronómica
      </p>
    </div>

    <!-- CONTENIDO PRINCIPAL: FORMULARIO + INFORMACIÓN DEL LOCAL -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

      <!-- FORMULARIO DE RESERVA -->
      <form action="{{ route('reserva.store') }}" method="POST" class="lg:col-span-2 space-y-8">
          @csrf
          
          <!-- Campos de nombre y apellido -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block mb-2 text-sm font-semibold">Nombre</label>
              <input type="text" name="nombre" required placeholder="Juan" class="w-full border-4 border-black px-4 py-3 focus:outline-none focus:bg-yellow-50 @error('nombre') border-red-500 @enderror" value="{{ old('nombre', $user->nombre ?? '') }}" />
              @error('nombre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label class="block mb-2 text-sm font-semibold">Primer Apellido</label>
              <input type="text" name="primer_apellido" required placeholder="García" class="w-full border-4 border-black px-4 py-3 focus:outline-none focus:bg-yellow-50 @error('primer_apellido') border-red-500 @enderror" value="{{ old('primer_apellido', $user->primer_apellido ?? '') }}" />
              @error('primer_apellido')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <!-- Campos de email y teléfono de contacto -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block mb-2 text-sm font-semibold">Email</label>
              <input type="email" name="email" required placeholder="juan@ejemplo.com" class="w-full border-4 border-black px-4 py-3 focus:outline-none focus:bg-yellow-50 @error('email') border-red-500 @enderror" value="{{ old('email', $user->correo ?? '') }}" />
              @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label class="block mb-2 text-sm font-semibold">Teléfono</label>
              <input type="tel" name="telefono" required placeholder="+34 600 000 000" pattern="[0-9]+" inputmode="numeric" class="w-full border-4 border-black px-4 py-3 focus:outline-none focus:bg-yellow-50 @error('telefono') border-red-500 @enderror" value="{{ old('telefono', $user->telefono ?? '') }}" />
              @error('telefono')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <!-- Campos de fecha, hora y número de personas -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
              <label class="block mb-2 text-sm font-semibold">Fecha</label>
              <!-- id="fecha-reserva" usado por JS para bloquear domingos; min impide seleccionar fechas pasadas -->
              <input type="date" id="fecha-reserva" name="fecha" required
                min="{{ now()->addDay()->format('Y-m-d') }}"
                class="w-full border-4 border-black px-4 py-3 focus:outline-none focus:bg-yellow-50 @error('fecha') border-red-500 @enderror" value="{{ old('fecha') }}" />
              <!-- Aviso de domingo (oculto por defecto) -->
              <span id="aviso-domingo" class="hidden text-red-500 text-sm">El restaurante está cerrado los domingos. Elige otro día.</span>
              @error('fecha')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>
            
            <div>
              <label class="block mb-2 text-sm font-semibold">Hora</label>
              @php
                  // Franjas horarias permitidas: comida (12:00-17:00) y cena (20:00-00:00)
                  $franjaComida = ['12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00'];
                  $franjaCena  = ['20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','00:00'];
                  $horaVieja   = old('hora');
              @endphp
              <select name="hora" required class="w-full border-4 border-black px-4 py-3 focus:outline-none focus:bg-yellow-50 @error('hora') border-red-500 @enderror">
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
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>
            
            <div>
              <label class="block mb-2 text-sm font-semibold">Número de personas</label>
              <!-- Máximo 10 comensales por reserva. oninput impide escribir valores fuera del rango -->
              <input type="number" name="numero_personas" min="1" max="10" required
                oninput="if(this.value>10)this.value=10; if(this.value<1)this.value=1;"
                class="w-full border-4 border-black px-4 py-3 focus:outline-none focus:bg-yellow-50 @error('numero_personas') border-red-500 @enderror" value="{{ old('numero_personas') }}" />
              @error('numero_personas')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <!-- Campo de notas especiales (alergias, preferencias, etc.) -->
          <div>
            <label class="block mb-2 text-sm font-semibold">Notas especiales (opcional)</label>
            <textarea name="notas" rows="4" class="w-full border-4 border-black px-4 py-3 focus:outline-none focus:bg-yellow-50 @error('notas') border-red-500 @enderror" placeholder="Alergias, preferencias, etc.">{{ old('notas') }}</textarea>
            @error('notas')
              <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- Botón para confirmar la reserva -->
          <button type="submit" class="w-full border-4 border-black py-4 text-lg font-semibold hover:bg-black hover:text-white transition">
            Confirmar reserva
          </button>
      </form>

      <!-- PANEL LATERAL: INFORMACIÓN DEL LOCAL -->
      <aside class="bg-[#243f6b] text-white p-8 space-y-6 rounded-2xl">
        <h3 class="text-3xl mb-4">Información del local</h3>

        <!-- Datos de contacto y horario del restaurante -->
        <ul class="space-y-4 text-lg">
          <li>● Calle Larios nº 34</li>
          <li>● L–S · 11:00 – 22:00</li>
          <li>● Tel: +34 789 689 7698</li>
          <li>● No fumar</li>
        </ul>
      </aside>

    </div>
  </div>
</main>

<script>
    // Bloquear domingos en el selector de fecha (el restaurante cierra los domingos)
    document.getElementById('fecha-reserva').addEventListener('change', function () {
        const aviso = document.getElementById('aviso-domingo');
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

@endsection








