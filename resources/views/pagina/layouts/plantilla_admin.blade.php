<!-- Plantilla base para páginas de administración y formularios sin cabecera/pie -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Favicon del sitio -->
    <link rel="icon" href="{{ asset('imagenes/logo.webp') }}" type="image/xicon">
    <!-- Título dinámico de cada página -->
    <title>@yield('title')</title>

    <!-- Enlace a Tailwind CSS (framework de estilos) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fuente de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons (librería de iconos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
</head>

<body>
    
    <main>
        <!-- Contenido específico de cada página admin (se inyecta aquí) -->
        @yield('content')
    </main>

</body>
</html>