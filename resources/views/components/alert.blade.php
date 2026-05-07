@if ($message = Session::get('success'))
    <!-- Alerta de éxito; se oculta automáticamente tras 4 segundos -->
    <div id="alerta-exito" class="max-w-7xl mx-auto mb-6">
        <div class="bg-green-100 border-4 border-green-500 text-green-700 px-6 py-4 rounded-lg" role="alert">
            <p class="font-semibold">✓ {{ $message }}</p>
        </div>
    </div>
@endif

<!-- En principio esta alerta nunca saldrá ya que todos los campos de los formularios están obligatorios -->
@if ($message = Session::get('error'))
    <!-- Alerta de error; se oculta automáticamente tras 4 segundos -->
    <div id="alerta-error" class="max-w-7xl mx-auto mb-6">
        <div class="bg-red-100 border-4 border-red-500 text-red-700 px-6 py-4 rounded-lg" role="alert">
            <p class="font-semibold">✗ {{ $message }}</p>
        </div>
    </div>
@endif

<script>
    // Ocultar las alertas de éxito y error automáticamente tras 4 segundos
    document.addEventListener('DOMContentLoaded', function () {
        ['alerta-exito', 'alerta-error'].forEach(function (id) {
            const el = document.getElementById(id);
            if (el) {
                setTimeout(function () {
                    el.style.transition = 'opacity 0.5s';
                    el.style.opacity = '0';
                    // Eliminar del flujo tras la transición
                    setTimeout(function () { el.remove(); }, 500);
                }, 4000);
            }
        });
    });
</script>
