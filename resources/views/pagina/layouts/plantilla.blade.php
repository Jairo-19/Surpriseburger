<!-- Plantilla base principal de la web pública -->
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

    <!-- Fuente de Google Fonts (Open Sans y Lobster) -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- Bootstrap Icons (librería de iconos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Configuración de fuentes: Open Sans para el cuerpo y Passero One para los títulos -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Lobster&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Passero+One&family=Sigmar&family=Unbounded:wght@200..900&display=swap');
        body { font-family: "Open Sans", sans-serif; }
        h1, h2, h3 { font-family: "Passero One", cursive; }
    </style>
</head>

<body>
    <!-- Cabecera y menú de navegación global -->
    @include('pagina.layouts.header')
    
    <main>
        <!-- Contenido específico de cada página (se inyecta aquí) -->
        @yield('content')
    </main>

    <!-- Pie de página global -->
    @include('pagina.layouts.footer')
</body>
</html>