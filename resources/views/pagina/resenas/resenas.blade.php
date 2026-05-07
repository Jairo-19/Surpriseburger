@extends('pagina.layouts.plantilla')

@section('title', 'Reseñas | Surprise Burger')

@section('content')

  <main>
    <section class="bg-[#e7f0f8] py-20 px-6">
      <div class="max-w-7xl mx-auto">

        <!-- TÍTULO -->
        <h2 class="text-center text-4xl md:text-6xl mb-16 bg-[#e7f0f8] text-[#2d4a77]">
          Reseñas y valoraciones
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-16">

          <!-- VALORACIÓN MEDIA -->
          <div class="bg-[#243f6b] text-white p-8 flex flex-col items-center justify-center gap-6 rounded-2xl">
            <h3 class="text-xl text-center">Valoración media</h3>
            <div class="flex items-center gap-4">
              <i class="bi bi-star-fill text-yellow-400 text-2xl"></i>
              <!-- ID usado por AJAX para actualizar la media sin recargar -->
              <span class="text-4xl" id="stat-avg">{{ $avgRating }}</span>
            </div>
          </div>

          <!-- TOTAL RESEÑAS -->
          <div class="bg-[#243f6b] text-white p-8 flex flex-col items-center justify-center gap-6 rounded-2xl">
            <h3 class="text-xl text-center">Total reseñas</h3>
            <!-- ID usado por AJAX para actualizar el contador -->
            <span class="text-4xl" id="stat-total">{{ $totalReviews }}</span>
          </div>

          <!-- 5 ESTRELLAS -->
          <div class="bg-[#243f6b] text-white p-8 flex flex-col items-center justify-center gap-6 rounded-2xl">
            <h3 class="text-xl text-center">
              Valoraciones<br />5 estrellas
            </h3>
            <!-- ID usado por AJAX para actualizar el contador de 5 estrellas -->
            <span class="text-4xl" id="stat-five">{{ $fiveStarReviews }}</span>
          </div>
        </div>

        <!-- CONTENEDOR PRINCIPAL -->
        <div class="bg-[#243f6b] text-white p-10 space-y-10 rounded-2xl">

          <!-- DEJA TU RESEÑA -->
          <div>
             <h3 class="text-2xl mb-4">Deja tu reseña</h3>

             @auth
             <!-- Zona de notificaciones AJAX (oculta por defecto) -->
             <div id="notificacion-resena" class="hidden mb-4 px-4 py-3 rounded font-bold"></div>

             <!-- El formulario se envía por AJAX; id="form-resena" es usado por el script -->
             <form id="form-resena" action="{{ route('resenas.store') }}" method="POST">
                @csrf
                <!-- INPUT OCULTO PARA LA VALORACIÓN -->
                <input type="hidden" name="valoracion" id="valoracion-input" value="5">

                <!-- ESTRELLAS INTERACTIVAS -->
                <p class="mb-3">Tu valoración</p>
                <div class="flex gap-3 mb-6">
                  @for ($i = 1; $i <= 5; $i++)
                    <i class="bi bi-star-fill text-2xl cursor-pointer text-gray-400 hover:text-yellow-400 transition-colors star-icon"
                       data-value="{{ $i }}"
                       onclick="setRating({{ $i }})"></i>
                  @endfor
                </div>

                <label class="block mb-2">Tu comentario</label>
                <textarea
                  name="texto"
                  class="w-full h-24 border-4 border-black p-4 text-black focus:outline-none rounded-2xl mb-4"
                  placeholder="Escribe aquí tu opinión..."
                  required
                ></textarea>

                <button type="submit" class="px-8 py-3 bg-orange-400 text-white font-bold rounded-full hover:bg-orange-500 transition">
                  Enviar reseña
                </button>
             </form>
             @else
             <div class="bg-blue-800 p-6 rounded-lg text-center">
                 <p class="mb-4 text-lg">Debes iniciar sesión para escribir una reseña.</p>
                 <a href="{{ route('login.index') }}" class="px-6 py-2 bg-white text-blue-900 font-bold rounded-full hover:bg-gray-100 transition">Iniciar sesión</a>
             </div>
             @endauth
          </div>

          <!-- TODAS LAS RESEÑAS -->
          <div>
            <h3 class="text-xl mb-4">Todas las reseñas</h3>
            <!-- ID usado por AJAX para insertar nuevas reseñas al inicio de la lista -->
            <div id="lista-resenas" class="w-full min-h-[5rem] bg-white border-4 border-black rounded-2xl p-6 text-black space-y-6">
              @forelse($resenas as $resena)
                <div class="border-b border-gray-200 pb-6 last:border-0 last:pb-0">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-bold text-lg text-blue-900">{{ optional($resena->cliente->usuario)->nombre ?? 'Usuario' }}</p>
                            <p class="text-sm text-gray-500">{{ $resena->fecha ? \Carbon\Carbon::parse($resena->fecha)->format('d/m/Y') : $resena->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill {{ $i <= $resena->valoracion ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-800">{{ $resena->texto }}</p>
                </div>
              @empty
                <p class="text-center text-gray-500 py-4">No hay reseñas todavía. ¡Sé el primero en opinar!</p>
              @endforelse
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>

<script>
    // Inicializar estrellas al cargar la página (valoración por defecto: 5)
    document.addEventListener('DOMContentLoaded', function () {
        setRating(5);
        inicializarFormularioAjax();
    });

    // Actualiza el color de las estrellas y guarda la valoración seleccionada
    function setRating(rating) {
        // Guardar el valor en el campo oculto del formulario
        document.getElementById('valoracion-input').value = rating;

        // Actualizar visualmente el color de cada estrella
        const stars = document.querySelectorAll('.star-icon');
        stars.forEach(star => {
            const starValue = parseInt(star.getAttribute('data-value'));
            if (starValue <= rating) {
                // Estrella activa (seleccionada)
                star.classList.remove('text-gray-400');
                star.classList.add('text-yellow-400');
            } else {
                // Estrella inactiva
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-400');
            }
        });
    }

    // Engancha el submit del formulario para enviarlo por AJAX sin recargar la página
    function inicializarFormularioAjax() {
        const form = document.getElementById('form-resena');
        if (!form) return; // El formulario solo existe si el usuario está autenticado

        form.addEventListener('submit', async function (e) {
            // Evitar el envío tradicional del formulario
            e.preventDefault();

            const boton       = form.querySelector('button[type="submit"]');
            const notificacion = document.getElementById('notificacion-resena');

            // Deshabilitar el botón mientras se procesa la petición
            boton.disabled = true;
            boton.textContent = 'Enviando...';

            try {
                // Recoger los datos del formulario
                const datos = new FormData(form);

                // Enviar la petición POST al servidor indicando que esperamos JSON
                const respuesta = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: datos,
                });

                const json = await respuesta.json();

                if (respuesta.ok && json.success) {
                    // Actualizar estadísticas en el DOM
                    document.getElementById('stat-avg').textContent   = json.stats.avgRating;
                    document.getElementById('stat-total').textContent  = json.stats.totalReviews;
                    document.getElementById('stat-five').textContent   = json.stats.fiveStarReviews;

                    // Construir el HTML de la nueva reseña
                    const nuevaTarjeta = construirTarjeta(json.resena);

                    // Insertar la nueva reseña al inicio de la lista
                    const lista = document.getElementById('lista-resenas');
                    // Eliminar el mensaje de "no hay reseñas" si existe
                    const vacio = lista.querySelector('.text-gray-500');
                    if (vacio) vacio.remove();
                    lista.insertAdjacentHTML('afterbegin', nuevaTarjeta);

                    // Mostrar notificación de éxito
                    mostrarNotificacion(notificacion, '¡Gracias por tu reseña! Tu opinión ya está publicada.', 'exito');

                    // Limpiar el formulario y restablecer estrellas a 5
                    form.reset();
                    setRating(5);

                } else {
                    // Mostrar el mensaje de error devuelto por el servidor
                    const mensaje = json.errors
                        ? Object.values(json.errors).flat().join(' ')
                        : (json.message || 'Ocurrió un error al enviar la reseña.');
                    mostrarNotificacion(notificacion, mensaje, 'error');
                }

            } catch (err) {
                // Error de red u otro problema inesperado
                mostrarNotificacion(notificacion, 'Error de conexión. Inténtalo de nuevo.', 'error');
            } finally {
                // Rehabilitar el botón siempre
                boton.disabled = false;
                boton.textContent = 'Enviar reseña';
            }
        });
    }

    // Construye el HTML de una tarjeta de reseña con los datos del servidor
    function construirTarjeta(resena) {
        // Generar las estrellas llenas y vacías según la valoración
        let estrellas = '';
        for (let i = 1; i <= 5; i++) {
            const color = i <= resena.valoracion ? 'text-yellow-400' : 'text-gray-300';
            estrellas += `<i class="bi bi-star-fill ${color}"></i>`;
        }

        return `
            <div class="border-b border-gray-200 pb-6">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="font-bold text-lg text-blue-900">${resena.nombre}</p>
                        <p class="text-sm text-gray-500">${resena.fecha}</p>
                    </div>
                    <div class="flex">${estrellas}</div>
                </div>
                <p class="text-gray-800">${resena.texto}</p>
            </div>
        `;
    }

    // Muestra un aviso de éxito o error en el área del formulario; se oculta a los 5s
    function mostrarNotificacion(el, msg, tipo) {
        el.textContent = msg;
        el.className = tipo === 'exito'
            ? 'mb-4 px-4 py-3 rounded font-bold bg-green-100 text-green-800 border border-green-400'
            : 'mb-4 px-4 py-3 rounded font-bold bg-red-100 text-red-800 border border-red-400';

        // Ocultar automáticamente después de 5 segundos
        setTimeout(() => {
            el.className = 'hidden mb-4 px-4 py-3 rounded font-bold';
            el.textContent = '';
        }, 5000);
    }
</script>

@endsection