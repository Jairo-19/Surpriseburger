-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2026 a las 13:31:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `c20surpriseburger`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alergenos`
--

CREATE TABLE `alergenos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alergenos`
--

INSERT INTO `alergenos` (`id`, `nombre`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 'Pescado', 'https://via.placeholder.com/640x480.png/00ee55?text=similique', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(2, 'Soja', 'https://via.placeholder.com/640x480.png/007777?text=enim', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(3, 'Gluten', 'https://via.placeholder.com/640x480.png/00ddee?text=eum', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(4, 'Lactosa', 'https://via.placeholder.com/640x480.png/0022ee?text=beatae', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(5, 'Huevo', 'https://via.placeholder.com/640x480.png/00aa44?text=commodi', '2026-04-15 16:35:50', '2026-04-15 16:35:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alergeno_plato`
--

CREATE TABLE `alergeno_plato` (
  `plato_id` bigint(20) UNSIGNED NOT NULL,
  `alergeno_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alergeno_plato`
--

INSERT INTO `alergeno_plato` (`plato_id`, `alergeno_id`) VALUES
(4, 3),
(5, 1),
(7, 4),
(7, 5),
(8, 3),
(22, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 'Entrantes', 'Entrantes', NULL, '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(2, 'Principales', 'Principales', NULL, '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(3, 'Postres', 'Postres', NULL, '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(4, 'Bebidas', 'Bebidas', NULL, '2026-04-15 16:35:49', '2026-04-15 16:35:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`usuario_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(11, '2007-09-01 05:33:22', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(12, '1988-01-17 21:19:36', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(13, '2004-12-16 13:17:28', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(14, '2026-02-01 20:34:36', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(15, '2010-02-14 09:00:45', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(34, '2023-01-01 06:58:57', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(35, '1971-11-07 15:07:34', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(36, '1985-10-30 08:59:21', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(37, '1988-06-30 11:34:48', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(38, '2025-05-27 10:34:41', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(39, '2019-10-22 23:38:51', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(40, '2018-10-25 02:10:04', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(41, '1996-05-12 03:50:33', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(42, '1994-09-23 12:36:54', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(43, '1998-04-16 06:59:03', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(44, '2002-02-27 01:48:27', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(45, '2001-05-27 03:45:55', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(46, '2016-08-29 12:42:31', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(47, '2018-03-19 04:23:01', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(48, '1987-03-16 23:56:32', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(49, '2010-07-16 22:12:48', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(50, '1982-10-04 21:16:15', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(51, '2016-03-03 09:22:31', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(52, '2008-10-04 13:42:14', '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(53, '2021-08-18 20:25:22', '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(54, '2026-04-16 11:13:05', '2026-04-16 09:13:05', '2026-04-16 09:13:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_cupon`
--

CREATE TABLE `cliente_cupon` (
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `cupon_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones`
--

CREATE TABLE `cupones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagenes` varchar(255) DEFAULT NULL,
  `puntos_necesarios` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cupones`
--

INSERT INTO `cupones` (`id`, `nombre`, `imagenes`, `puntos_necesarios`, `created_at`, `updated_at`) VALUES
(2, 'Natilla', 'cupones/Te8NJ9JMHTjLE2gvpIuJjhEzIywbcgpOBoLNvXV6.jpg', 81, '2026-04-15 16:35:51', '2026-04-17 08:05:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `usuario_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`usuario_id`) VALUES
(16),
(17),
(18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `plato_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `ruta`, `plato_id`, `created_at`, `updated_at`) VALUES
(19, 'platos/aTH2HUY0SclrYzzDDdfByhskPnrsppaKiTaHllQI.jpg', 4, '2026-04-17 08:09:20', '2026-04-17 08:09:20'),
(20, 'platos/71il5UfjwirZhAr4WUOVKJE8WiGR5rdbhRMMVubZ.jpg', 8, '2026-04-17 08:44:31', '2026-04-17 08:44:31'),
(21, 'platos/UpYcIJxSDx82ZRUjwy4ubQZPD9PiWuYWvc8VDDUa.jpg', 22, '2026-04-17 09:02:30', '2026-04-17 09:02:30'),
(22, 'platos/CCkJaYJRhHDDJR9oAOgLIDmbcs2s2Kd0HJsxLs9u.jpg', 6, '2026-04-17 09:02:50', '2026-04-17 09:02:50'),
(23, 'platos/qwVi2FixaqUK5Y9D5ZGmhBbMCSpD1mRC36zSmb2D.jpg', 10, '2026-04-17 09:03:03', '2026-04-17 09:03:03'),
(24, 'platos/0TpIDMr1nYSkFrhOqajG92qgrOJgiNRxEo3gV8HZ.jpg', 7, '2026-04-17 09:03:19', '2026-04-17 09:03:19'),
(25, 'platos/HTrKhJpTqs4y10oY0BpW6Jar6PPfzHsfZ5EMFPGM.jpg', 5, '2026-04-17 09:03:36', '2026-04-17 09:03:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_01_19_000000_create_categorias_table', 1),
(6, '2026_01_19_164451_create_platos_table', 1),
(7, '2026_01_19_172211_create_imagenes_table', 1),
(8, '2026_01_20_000000_create_pagos_table', 1),
(9, '2026_01_20_164917_create_alergenos_table', 1),
(10, '2026_01_20_165105_create_alergeno_plato_table', 1),
(11, '2026_01_21_181700_create_usuarios_table', 1),
(12, '2026_01_21_181856_create_clientes_table', 1),
(13, '2026_01_21_181912_create_empleados_table', 1),
(14, '2026_01_21_181950_create_cupones__table', 1),
(15, '2026_01_21_182900_create_pedidos_table', 1),
(16, '2026_01_21_190000_create_puntos_table', 1),
(17, '2026_01_21_193543_create_pedido_plato_table', 1),
(18, '2026_01_23_170103_create_resenas_table', 1),
(19, '2026_01_29_180220_create_cliente_cupon_table', 1),
(20, '2026_01_29_184000_create_reservas_table', 1),
(21, '2026_02_02_000001_add_estado_to_pedidos_table', 1),
(22, '2026_02_02_000002_add_estado_to_reservas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'efectivo', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(2, 'tarjeta', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(3, 'efectivo', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(4, 'efectivo', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(5, 'tarjeta', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(6, 'tarjeta', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(7, 'tarjeta', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(8, 'efectivo', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(9, 'tarjeta', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(10, 'efectivo', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(11, 'tarjeta', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(12, 'tarjeta', '2026-04-15 16:35:50', '2026-04-15 16:35:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `poblacion` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `importe` decimal(10,2) NOT NULL,
  `forma` enum('recogida','domicilio') NOT NULL,
  `estado` enum('pendiente','realizado') NOT NULL DEFAULT 'pendiente',
  `fecha_entrega` datetime DEFAULT NULL,
  `pago_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `direccion`, `codigo_postal`, `poblacion`, `provincia`, `importe`, `forma`, `estado`, `fecha_entrega`, `pago_id`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, 'Ronda Cristian, 400, 7º A, 09782, Haro de Arriba', '52825', 'As Godínez', 'Lleida', 61.83, 'recogida', 'pendiente', '1980-11-12 01:09:50', 3, 19, '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(2, 'Ronda Pedro, 974, 65º F, 22819, As Tamez Medio', '68968', 'L\' Zelaya del Vallès', 'Málaga', 28.10, 'domicilio', 'realizado', '1999-11-12 14:39:05', 4, 20, '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(3, 'Ruela Naia, 31, 00º A, 59099, Cabán del Penedès', '89661', 'A Andreu del Bages', 'Asturias', 19.48, 'recogida', 'realizado', '1980-02-06 19:57:00', 5, 21, '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(4, 'Avinguda Canales, 56, 68º 9º, 34568, As Calvo', '56900', 'Alfonso de Ulla', 'Granada', 95.42, 'domicilio', 'pendiente', '1992-11-14 10:31:53', 6, 22, '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(5, 'Avinguda Pedro, 25, 5º, 16184, O Domenech del Penedès', '55854', 'Los Pulido', 'Vizcaya', 82.42, 'domicilio', 'realizado', '1970-02-03 10:12:10', 7, 23, '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(6, 'Paseo Contreras, 9, 39º E, 09969, As Padrón de la Sierra', '25190', 'El Gaytán del Mirador', 'Cantabria', 18.82, 'recogida', 'pendiente', '2015-08-18 03:34:40', 8, 24, '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(7, 'Camiño Candela, 2, 4º E, 13870, El Meléndez de Ulla', '82196', 'Os Valladares del Mirador', 'Las Palmas', 55.42, 'domicilio', 'realizado', '1984-07-27 08:24:45', 9, 25, '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(8, 'Avenida Prieto, 6, 47º 2º, 65752, La Villegas', '91118', 'San Santiago de Arriba', 'La Rioja', 74.48, 'recogida', 'realizado', '2018-10-31 06:27:18', 10, 26, '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(9, 'Passeig Ocasio, 98, 7º, 96592, Valenzuela de la Sierra', '73171', 'O Cordero de Ulla', 'Santa Cruz de Tenerife', 53.19, 'recogida', 'realizado', '1972-10-07 05:14:14', 11, 27, '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(10, 'Plaça Pantoja, 5, 82º 4º, 41006, Los Rosario', '34070', 'Cárdenas de las Torres', 'Palencia', 58.99, 'domicilio', 'pendiente', '1981-05-07 15:56:45', 12, 28, '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(11, 'Recogida en local', '46000', 'Valencia', 'Valencia', 7.70, 'recogida', 'pendiente', '2026-04-16 15:21:45', 1, 54, '2026-04-16 12:36:45', '2026-04-16 12:36:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_plato`
--

CREATE TABLE `pedido_plato` (
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `plato_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(8,2) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id`, `nombre`, `descripcion`, `precio`, `activo`, `created_at`, `updated_at`, `categoria_id`) VALUES
(4, 'Hamburguesa de Ternera', 'Propuesta gastronómica basada en carne de ternera seleccionada, jugosa y de alta calidad, elaborada a la plancha para preservar su sabor y textura. Se presenta en pan tierno ligeramente tostado, acompañada de ingredientes frescos como lechuga, tomate y cebolla, que aportan equilibrio y frescura.', 7.53, 1, '2026-04-15 16:35:49', '2026-04-16 11:45:24', 2),
(5, 'Sushi Variado', 'Et sunt aspernatur natus ipsum aut nesciunt aperiam ad nesciunt repudiandae atque adipisci.', 14.30, 0, '2026-04-15 16:35:49', '2026-04-16 13:04:44', 2),
(6, 'Pechuga de Pollo', 'Corte magro de pollo, seleccionado por su alto valor proteico y bajo contenido en grasa. Preparada a la plancha para conservar su jugosidad natural y potenciar un perfil de sabor suave y equilibrado.', 12.76, 1, '2026-04-15 16:35:49', '2026-04-16 11:48:44', 2),
(7, 'Tarta de Queso', 'Postre cremoso elaborado a base de queso suave y una base crujiente de galleta, que aporta contraste de texturas y equilibrio en cada bocado. Su perfil combina dulzor moderado con ligeras notas ácidas, generando una experiencia intensa pero armoniosa.', 12.10, 1, '2026-04-15 16:35:49', '2026-04-16 11:47:45', 3),
(8, 'Macedonia', 'Mezcla vibrante y equilibrada de frutas seleccionadas, cortadas en dados para potenciar textura y sabor en cada bocado. Incluye una combinación de frutas de temporada como fresas, plátano, kiwi, naranja y piña, que aportan dulzor natural, acidez ligera y un perfil refrescante.', 16.12, 1, '2026-04-15 16:35:49', '2026-04-16 11:42:51', 3),
(10, 'Refresco de Cola', 'Bebida refrescante carbonatada con un perfil de sabor único, equilibrando notas dulces y ligeramente ácidas. Su fórmula icónica ofrece una experiencia consistente y reconocible, ideal para acompañar comidas o disfrutar en cualquier momento del día.', 24.16, 1, '2026-04-15 16:35:49', '2026-04-16 11:46:16', 4),
(22, 'Nachos con Queso', 'Los nachos con queso son el epítome de la comida reconfortante (comfort food): un plato de origen mexicano (específicamente de Piedras Negras, Coahuila) que ha conquistado el mundo gracias a su irresistible combinación de texturas y sabores.', 12.99, 1, '2026-04-16 13:01:21', '2026-04-16 13:01:21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE `puntos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `cupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cantidad_puntos` int(11) NOT NULL,
  `concepto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `puntos`
--

INSERT INTO `puntos` (`id`, `cliente_id`, `cupon_id`, `cantidad_puntos`, `concepto`, `created_at`, `updated_at`) VALUES
(1, 34, NULL, 12, 'non', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(2, 35, NULL, 40, 'harum', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(3, 36, NULL, 23, 'non', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(4, 37, 2, 14, 'in', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(5, 38, NULL, 38, 'accusantium', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(6, 39, NULL, 2, 'blanditiis', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(7, 40, 2, 33, 'ut', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(8, 41, NULL, 10, 'et', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(9, 42, NULL, 9, 'est', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(10, 43, NULL, 37, 'veritatis', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(11, 54, NULL, 77, 'Pedido #11', '2026-04-16 12:36:45', '2026-04-16 12:36:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenas`
--

CREATE TABLE `resenas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `texto` text NOT NULL,
  `valoracion` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `resenas`
--

INSERT INTO `resenas` (`id`, `cliente_id`, `fecha`, `texto`, `valoracion`, `created_at`, `updated_at`) VALUES
(1, 44, '2025-09-04', 'Hic atque voluptate perspiciatis non fugit quis. Mollitia ut nihil et. Sunt eaque omnis incidunt libero dolorem eum voluptatibus. Ea quo esse sit aut cum debitis repudiandae velit.', 1, '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(2, 45, '1980-01-19', 'Dolores est neque corrupti repudiandae ex. Numquam ut occaecati quidem pariatur. Molestiae voluptas recusandae qui rerum.', 1, '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(3, 46, '2002-08-06', 'Sunt tempora officia impedit eius. Sint culpa et esse ipsam neque nihil beatae. Sunt voluptatem eum veniam delectus facere nihil a unde.', 5, '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(4, 47, '1996-11-27', 'Rem error rerum cupiditate. Sunt nihil error quia tempora hic voluptatem.', 3, '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(5, 48, '2004-10-14', 'Quis quis eius omnis. Minus deserunt exercitationem possimus nemo. Totam sed odit consequatur sapiente rerum adipisci qui qui. Consequatur rerum quo est dolores.', 1, '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(6, 49, '2003-03-01', 'Est sint fugit odit unde fugit qui. Fugit repellat magni voluptatum. Dolor enim id voluptatibus ut sit.', 1, '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(7, 50, '2001-12-11', 'Dicta voluptatum impedit praesentium tenetur. Consequatur quas tempore sed aut iure. Tenetur laboriosam et vel provident.', 1, '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(8, 51, '2017-06-26', 'Blanditiis natus fuga molestiae nesciunt sit sunt. Quia reprehenderit laborum eos consequatur. Ut nisi dignissimos necessitatibus perspiciatis est.', 1, '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(9, 52, '2018-01-16', 'Dicta quod velit perferendis nemo voluptas perspiciatis. Dolores esse tempora in consequatur. Perspiciatis quisquam beatae rerum doloremque nostrum vel sit. At et ea itaque nisi asperiores aspernatur rem.', 1, '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(10, 53, '1987-02-28', 'Officia natus unde ipsa consequatur quia tempore. Autem ea consequatur voluptatem dolor illo incidunt quas. Non corrupti voluptas at et nihil quas. Alias est est non fugiat autem recusandae. Qui natus ut aut temporibus qui.', 1, '2026-04-15 16:35:52', '2026-04-15 16:35:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `numero_personas` int(11) NOT NULL,
  `estado` enum('pendiente','realizado') NOT NULL DEFAULT 'pendiente',
  `notas` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `usuario_id`, `fecha`, `hora`, `numero_personas`, `estado`, `notas`, `created_at`, `updated_at`) VALUES
(1, 29, '2026-05-10', '22:49:00', 10, 'pendiente', NULL, '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(2, 30, '2026-04-16', '09:27:00', 5, 'realizado', 'Numquam aliquam animi autem commodi.', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(3, 31, '2026-04-25', '19:49:00', 5, 'realizado', 'Repudiandae veritatis doloremque non architecto laboriosam qui.', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(4, 32, '2026-05-04', '22:05:00', 10, 'pendiente', NULL, '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(5, 33, '2026-05-03', '05:11:00', 6, 'realizado', 'Neque reiciendis delectus blanditiis expedita officiis.', '2026-04-15 16:35:51', '2026-04-15 16:35:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `primer_apellido` varchar(255) NOT NULL,
  `segundo_apellido` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `primer_apellido`, `segundo_apellido`, `telefono`, `correo`, `contrasena`, `created_at`, `updated_at`) VALUES
(1, 'Ángela', 'Amador', 'De Jesús', '908 21 1560', 'corral.hector@example.com', '$2y$10$pN7gExu1aTOC9QdYsmYS6OOXxOpgMLZZVHhvHu3kciMPTFacsZChK', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(2, 'Arnau', 'Arenas', 'Tirado', '975135160', 'franco.isabel@example.com', '$2y$10$htxWRFLJ.euq.cplMpuI5uKDqZgX8uVBi1yb7SZBfJ4H/tL4zy.Im', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(3, 'Úrsula', 'Redondo', 'Prieto', '997 33 7788', 'trejo.aitor@example.com', '$2y$10$nshKw1IZn27GZ76vs2Ure.TLEgdCtwi6ag3x.pdc7W0GAKkxalpw2', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(4, 'Valeria', 'Pabón', 'Alvarado', '910-165071', 'ariadna.robles@example.org', '$2y$10$3ZqwqgOYrhHkhpY.x0pYP.485eR5NqDmxa11PMamHS2Izs7qkqQNW', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(5, 'Gael', 'Granados', 'Madrigal', '911545721', 'olga.gaona@example.net', '$2y$10$M8BRgsbkqbjPDAOk3S3dpuUZNUq6ZetLXDoLywmJIe8QCPeOi9r66', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(6, 'Biel', 'Gálvez', 'Miranda', '938 091412', 'caro.mateo@example.net', '$2y$10$eRej2InQDTisH0IlqfOF2urOWCXRgV35lC5twLQgp32hpUsMSLw66', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(7, 'Gabriel', 'Alonso', 'Betancourt', '+34 971-82-2181', 'mmendoza@example.com', '$2y$10$wkgkxeDVKiqRFyNCb1NG0ODbxEWgK2xDqoWZgBi1PycOuERBFB/uW', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(8, 'Adriana', 'Curiel', 'Véliz', '979-077508', 'salvador.diana@example.com', '$2y$10$BvTfC/QJFvdCQgrpVe4X.uMMrseoc3SY2C0HwkrxMG5lEgG3RZ6f.', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(9, 'Eduardo', 'Sandoval', 'Silva', '+34 920-152486', 'nmacias@example.com', '$2y$10$NjR8hiXA2HZvchUFRLVAAe4gYeLjuY9p5cGq1cSUayul78iZylUSO', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(10, 'José Manuel', 'Alemán', 'Flórez', '+34 933 23 0116', 'dcordero@example.com', '$2y$10$XtxmadkHitLPdEdFJl6B8OGrcGo3uP.gHFsD0X.yIN81h5qvP0CCS', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(11, 'Aleix', 'Gálvez', 'Mesa', '925 04 3467', 'jan51@example.org', '$2y$10$/VfncOA4VKVL/NGB.mpAUeHOQnf1.coil.OEFo1HjS9vppEInSs42', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(12, 'Asier', 'Aguilera', 'Robledo', '+34 910254674', 'naia75@example.net', '$2y$10$KbRYWHfnQKbjlJFzkZgC/uPAET94VRJ9k4.CVOSDY5sm5jZYyBgOG', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(13, 'Berta', 'Ledesma', 'Leyva', '+34 901-68-8175', 'santillan.mariapilar@example.org', '$2y$10$t049dpfhThjZnYSyUH4SE.Qz1O3kPseH6MHX00mTMg/vKJ8VMtpyu', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(14, 'Oliver', 'Lara', 'Nazario', '+34 989655008', 'pau.vela@example.com', '$2y$10$FI9qqIIcEGiQi8rRAYO.a.A0t2MfD9DvSMOnB1ZEkpqGIt5SrMQqC', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(15, 'Blanca', 'Valenzuela', 'Galarza', '938-41-2562', 'aaron33@example.net', '$2y$10$gkOdMFu6Mz7GGpOh4zyKVu.05COlnicm9ncgydF23YTcIBpBnO2/W', '2026-04-15 16:35:49', '2026-04-15 16:35:49'),
(16, 'Ariadna', 'Peña', 'Sauceda', '+34 999-886481', 'sandoval.arnau@example.net', '$2y$10$HkdFcNcrsqLoaissCdQRZeXputmqRmZKUHj/b38m5ZqM5FES762mm', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(17, 'Biel', 'Colón', 'Palomino', '+34 980559800', 'terrazas.malak@example.net', '$2y$10$fvWM4/ngbzny8Ba/waorg.iTMy7C2WesQGbf5o4npeLnsNUes8YLy', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(18, 'admin', 'dueño', 'Ramos', '925-278591', 'admin@gmail.com', '$2y$10$5bEZlR6sUfs2O5.sMT2zoeVX4rwS.hf56KdJQnu6fm70Xs4YpQP7a', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(19, 'Miguel Ángel', 'Arias', 'Preciado', '989-97-4649', 'altamirano.fernando@example.com', '$2y$10$vsIR38skfi4lDFm43ZZSmeQV3uWjlxzTORLahAfeLDppb/YYz.ZYy', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(20, 'Biel', 'Mata', 'Ávila', '956248392', 'jordi.morales@example.net', '$2y$10$lIjbB1cUw/.ALm55.WZdf.aWReIONWiIVAdRoKarmgNpE9Cyh95Za', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(21, 'José', 'Raya', 'Gurule', '946 22 8175', 'lanaya@example.net', '$2y$10$USHeGmv1HKCrdLY37WSX..uNcd328ogBSuqn1sOo9YsGuknmMKane', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(22, 'Pol', 'Pizarro', 'Más', '934-184536', 'ocotto@example.org', '$2y$10$/IFJ8tO5iZ7GI4L1Stq0z.COGad5SaXWjIdQ3eTooKhFEuif7S7PK', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(23, 'Claudia', 'Carrera', 'Reynoso', '+34 976416264', 'jordi54@example.com', '$2y$10$RPLYQrfAqAptZ4XUK4yjQOHVTciA0LgH4ebRzB2yJ.vaWesm3gzl6', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(24, 'Nil', 'Martínez', 'Cuesta', '931 17 0359', 'nayara.aguayo@example.org', '$2y$10$Qe26MkH6nPs8RiZMlXBjLubNqWaUhfZ5yZY6cqPKr/ywac.09gvgC', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(25, 'Ian', 'Montenegro', 'Madrid', '928 289860', 'andres54@example.org', '$2y$10$y9CbG6HNa3Lsm/5kSvAWwu9W9DdD5OG2I8G3oCEGQecWfiXhyOTjC', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(26, 'Naiara', 'Cuesta', 'Reséndez', '+34 956-071417', 'hector72@example.com', '$2y$10$ED43tp/5HnIVVrKxfInHXeAkOfX.CkPsx68ke3jY4AIyF.6heg6b6', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(27, 'Mar', 'Ruvalcaba', 'Urrutia', '945 31 6019', 'gmas@example.net', '$2y$10$CYeD1oTbyBmv0LdiQ28Qg.NkdftAEIMCzHAbMzPziFd9BqX.g9q2.', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(28, 'Lola', 'Bernal', 'Alcaráz', '964602024', 'kroybal@example.com', '$2y$10$VRncJyvBl7WMYI.zYVQkqe/XD9Rh3MP5Cw16Z73irTmXw5EugVfKm', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(29, 'Alba', 'Téllez', 'Riera', '+34 983 319619', 'nerea14@example.net', '$2y$10$mqFyu2J0wjioyknep2SxuuOzt4u0OPgVcahuGF1aq/2XlCrP0EruS', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(30, 'María Carmen', 'Caraballo', 'Collado', '+34 969-90-0993', 'smares@example.com', '$2y$10$f0ds1XM6HIMXnAHS5XK8luhntkUbDZmDD/aa.YLnHKS51UPWdrEUu', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(31, 'Gael', 'Laureano', 'Morales', '933 080025', 'pchavez@example.org', '$2y$10$7D/WcQheBhELIHvC.N/aWubZMdX1GmgeRJ707sPWgkQ0AirimXcmO', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(32, 'Oriol', 'Arellano', 'Carbonell', '+34 917-22-0117', 'escamilla.marco@example.org', '$2y$10$2gVi/F4I7OnC3KPVlWBwJO/iSqsuDfSKs4s8ABzBmvJeKf5reEM3O', '2026-04-15 16:35:50', '2026-04-15 16:35:50'),
(33, 'Ariadna', 'Meza', 'Becerra', '+34 990380002', 'cortes.silvia@example.org', '$2y$10$A4OunJXIpY./pfNufMAOauCvCzo1QqGWdkNUtELOJIneSaWyAcoYK', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(34, 'Gael', 'Calvillo', 'Bustamante', '+34 975-99-5194', 'jsantacruz@example.com', '$2y$10$P/V0yZlg8n91VupfUmwkzuie997Yizllm.uvTNtOuD2xPbL0beYrq', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(35, 'Nil', 'Armendáriz', 'Cervantes', '923 34 6763', 'julia05@example.net', '$2y$10$me7udbaf7A8UaU23tuILt.POvU8zCmAzyq7AfvFQHRDJohcUEBxWi', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(36, 'Carlos', 'Cardona', 'Leal', '+34 904 253724', 'vmelgar@example.org', '$2y$10$0T7t3ERANr9ujzV5ZQBnjunhABRx3WI4izJORc.N2v4jvkmYrW5A.', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(37, 'Malak', 'Heredia', 'Álvarez', '+34 928 44 9075', 'golivera@example.org', '$2y$10$s.c.rdWGvhrLCk3O23YDAufQiI0wR9HXFryQIYkJ//3TF9x3C.u0O', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(38, 'Gloria', 'Oquendo', 'Sanabria', '+34 963 96 4519', 'amparo15@example.com', '$2y$10$YZQLKGCOI2wbZrvQ3Xhweu8jTX6XWwPEKWj.W/VcWQ5z.4wNk9zBK', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(39, 'Iván', 'Deleón', 'Gámez', '+34 965-895914', 'ycasado@example.org', '$2y$10$znN6fG/Cvi9BoUvktoZRD.qnDzhyJS4ySPMmfPDRrA9EGUUj2L7me', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(40, 'Miguel Ángel', 'Rodríguez', 'Jaime', '+34 989 387027', 'esquivel.yago@example.com', '$2y$10$TC.H5Ug56LIEr8SMF93bTuR9nFSIXhwHADSCqgOtvkGCfofxrnHjm', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(41, 'Carmen', 'Escribano', 'Baca', '993 154336', 'abril89@example.net', '$2y$10$GHo7w.dencUGZfUzNFSZSuW7.HgL6W1KMD/kZcYDEgYTWEn2Apl8e', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(42, 'Candela', 'Campos', 'Treviño', '+34 976 29 1457', 'vazquez.naiara@example.com', '$2y$10$0DgX3ZLZ1vyIQa2RAWLo3.3H.jdRHur8CVTDZ.CH.FBkwPhDq9xh.', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(43, 'Eva', 'Quesada', 'Quesada', '+34 969 889310', 'sola.marcos@example.com', '$2y$10$JfIOOuOF.ImJEAtTKX1wA.wrnGQAyqY1pgFbX4QNT/P0le9/aJvFm', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(44, 'Juan José', 'Espino', 'Gómez', '942 12 2522', 'uperalta@example.com', '$2y$10$oWQXSAjfI1WkJRb1T6bJPeNZPP/IUyPFHUnzDb1R7GC2uvnomH1uy', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(45, 'Sandra', 'Quintero', 'Miramontes', '+34 953 806955', 'lnarvaez@example.com', '$2y$10$QCe5cejYjcNTU5USbV0I7uyDT3bseiQLsRr9s.JGxbHkx/CWhQ1ia', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(46, 'Gloria', 'Girón', 'Tejeda', '+34 966-74-6365', 'llorente@example.com', '$2y$10$xUe09a3kbejyrY3rTjiqeusO94uLXS1CAkiLMN.oxz8hmVWSMfwDG', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(47, 'Sofía', 'Palomo', 'Raya', '+34 986-77-8560', 'oriol.deleon@example.com', '$2y$10$4mEmwIyF05tAU5NyBE1h5.etPPKg1nFnwqeeZ3zTusn.DZ9jow7dm', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(48, 'María Ángeles', 'Flores', 'Cortés', '936-055991', 'bbonilla@example.com', '$2y$10$H9yfIUbdEGhRbIL/csd7Qu6Gqc9Vg6DDeSyDacsd7m7ftmygcwENq', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(49, 'Eva', 'Trujillo', 'Abreu', '+34 999 972998', 'olga32@example.com', '$2y$10$PD9yjrU7PJ8y58JgOvvqSe.kdYGSc9AGAsUTDgrcG9oEiqvH9j1KG', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(50, 'Verónica', 'Segura', 'Quiroz', '968 658395', 'santillan.gerard@example.com', '$2y$10$LI5c.mxikm13EmEHdyNiAO5DMFzl1DRPQ6V/aQAhQHpMm2lzXdc3.', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(51, 'Ángel', 'Marco', 'Morán', '994 181744', 'asensio.yolanda@example.org', '$2y$10$3/3rV8G7CDvPLR7D41HpG.Uf77yNz/JkXtDkVLcJOJaxW.VOYdDF2', '2026-04-15 16:35:51', '2026-04-15 16:35:51'),
(52, 'Manuela', 'Olivares', 'Tejeda', '959 57 7936', 'elsa.aguilera@example.net', '$2y$10$OCj8EHZrR.qOJnAas8b2EensRdkRnbCTyPKYCsVtmuBrxa7RQSabO', '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(53, 'Luna', 'Laureano', 'Alba', '969-44-3048', 'jsanchez@example.com', '$2y$10$9DeEabqCPKSFlrm6XAV5teMPzr3KBHC3eUkdZlJ/f4nv71Qs5qPZa', '2026-04-15 16:35:52', '2026-04-15 16:35:52'),
(54, 'pepe', 'grillo', 'perez', '8754684546', 'p@gmail.com', '$2y$10$om8ckxbt9DLeBTlaBXFMIehxe12aWILvYsMoWcmdvKFPd5yoqRWw.', '2026-04-16 09:13:05', '2026-04-16 09:13:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alergenos`
--
ALTER TABLE `alergenos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alergeno_plato`
--
ALTER TABLE `alergeno_plato`
  ADD PRIMARY KEY (`plato_id`,`alergeno_id`),
  ADD KEY `alergeno_plato_alergeno_id_foreign` (`alergeno_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Indices de la tabla `cliente_cupon`
--
ALTER TABLE `cliente_cupon`
  ADD PRIMARY KEY (`cliente_id`,`cupon_id`),
  ADD KEY `cliente_cupon_cupon_id_foreign` (`cupon_id`);

--
-- Indices de la tabla `cupones`
--
ALTER TABLE `cupones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD KEY `empleados_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagenes_plato_id_foreign` (`plato_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_pago_id_foreign` (`pago_id`),
  ADD KEY `pedidos_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `pedido_plato`
--
ALTER TABLE `pedido_plato`
  ADD KEY `pedido_plato_pedido_id_foreign` (`pedido_id`),
  ADD KEY `pedido_plato_plato_id_foreign` (`plato_id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `platos_categoria_id_foreign` (`categoria_id`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `puntos_cliente_id_foreign` (`cliente_id`),
  ADD KEY `puntos_cupon_id_foreign` (`cupon_id`);

--
-- Indices de la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resenas_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservas_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_correo_unique` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alergenos`
--
ALTER TABLE `alergenos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cupones`
--
ALTER TABLE `cupones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `resenas`
--
ALTER TABLE `resenas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alergeno_plato`
--
ALTER TABLE `alergeno_plato`
  ADD CONSTRAINT `alergeno_plato_alergeno_id_foreign` FOREIGN KEY (`alergeno_id`) REFERENCES `alergenos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alergeno_plato_plato_id_foreign` FOREIGN KEY (`plato_id`) REFERENCES `platos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cliente_cupon`
--
ALTER TABLE `cliente_cupon`
  ADD CONSTRAINT `cliente_cupon_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`usuario_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cliente_cupon_cupon_id_foreign` FOREIGN KEY (`cupon_id`) REFERENCES `cupones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_plato_id_foreign` FOREIGN KEY (`plato_id`) REFERENCES `platos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_pago_id_foreign` FOREIGN KEY (`pago_id`) REFERENCES `pagos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedidos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pedido_plato`
--
ALTER TABLE `pedido_plato`
  ADD CONSTRAINT `pedido_plato_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pedido_plato_plato_id_foreign` FOREIGN KEY (`plato_id`) REFERENCES `platos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `platos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD CONSTRAINT `puntos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`usuario_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `puntos_cupon_id_foreign` FOREIGN KEY (`cupon_id`) REFERENCES `cupones` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD CONSTRAINT `resenas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`usuario_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
