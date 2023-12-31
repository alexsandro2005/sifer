-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-08-2023 a las 13:54:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sifer-app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carroceria`
--

CREATE TABLE `carroceria` (
  `id_carroceria` int(3) NOT NULL,
  `carroceria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carroceria`
--

INSERT INTO `carroceria` (`id_carroceria`, `carroceria`) VALUES
(3, 'No Aplica'),
(4, 'furgon'),
(5, 'Sedan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id_category` int(5) NOT NULL,
  `category` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cilindraje`
--

CREATE TABLE `cilindraje` (
  `id_cilindraje` int(3) NOT NULL,
  `cilindraje` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cilindraje`
--

INSERT INTO `cilindraje` (`id_cilindraje`, `cilindraje`) VALUES
(4, 250),
(6, 125),
(8, 200),
(9, 400),
(11, 600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores_moto`
--

CREATE TABLE `colores_moto` (
  `id_color` int(3) NOT NULL,
  `nombre_color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores_moto`
--

INSERT INTO `colores_moto` (`id_color`, `nombre_color`) VALUES
(2302, 'Rojo Fuego'),
(3003, 'Azul Rey'),
(3020, 'Azul Cielo'),
(10201, 'Verde marela'),
(12070, 'Blanco'),
(45030, 'Negro ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combustible`
--

CREATE TABLE `combustible` (
  `id_combustible` int(3) NOT NULL,
  `combustible` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `combustible`
--

INSERT INTO `combustible` (`id_combustible`, `combustible`) VALUES
(5, 'Gasolina'),
(6, 'Diesel'),
(7, 'ACPM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datetime_entry`
--

CREATE TABLE `datetime_entry` (
  `id_entry` int(10) NOT NULL,
  `date_entry` datetime NOT NULL,
  `document` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datetime_entry`
--

INSERT INTO `datetime_entry` (`id_entry`, `date_entry`, `document`) VALUES
(150, '2023-05-11 10:58:13', 1110460410),
(151, '2023-05-11 11:06:52', 1110460410),
(152, '2023-05-11 11:07:49', 1110460410),
(153, '2023-05-11 11:23:32', 1110460410),
(154, '2023-06-09 06:56:02', 1110460410),
(155, '2023-07-08 03:06:05', 1110460410),
(156, '2023-07-09 12:48:16', 1110460410),
(157, '2023-07-09 21:22:43', 1110460410),
(158, '2023-07-10 06:54:45', 1110460410),
(159, '2023-07-10 07:12:29', 1110460410),
(160, '2023-07-10 08:50:14', 1110460410),
(161, '2023-07-24 10:59:45', 1110460410),
(162, '2023-07-24 23:46:10', 1110460410),
(163, '2023-07-26 02:31:30', 1110460410),
(164, '2023-07-26 06:58:03', 1110460410),
(165, '2023-07-26 06:58:39', 1110460410),
(166, '2023-07-26 23:42:51', 1110460410),
(167, '2023-07-26 23:59:18', 1110460410),
(168, '2023-07-27 00:01:46', 1110460410),
(169, '2023-07-27 00:03:15', 1110460410),
(170, '2023-07-27 00:06:45', 1110460410),
(171, '2023-07-27 00:13:37', 1110460410),
(172, '2023-07-27 00:26:32', 1110460410),
(173, '2023-07-27 13:08:50', 1110460410),
(174, '2023-07-28 11:13:52', 1110460410),
(175, '2023-07-28 19:24:14', 1110460410),
(176, '2023-07-29 13:37:07', 1110460410),
(177, '2023-07-31 00:51:17', 1110460410),
(178, '2023-07-31 12:17:57', 1110460410),
(179, '2023-07-31 13:27:39', 1110460410),
(180, '2023-07-31 15:03:01', 1110460410),
(181, '2023-08-02 13:31:34', 1110460410),
(182, '2023-08-02 14:07:37', 1110460410),
(183, '2023-08-02 14:18:42', 1110460410),
(184, '2023-08-02 22:44:50', 1110460410),
(185, '2023-08-03 05:27:35', 1220202020);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datetime_out`
--

CREATE TABLE `datetime_out` (
  `id_out` int(10) NOT NULL,
  `date_out` datetime NOT NULL,
  `document_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(3) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `codigo`, `nombre`, `precio`, `fecha_registro`, `cantidad`) VALUES
(234, '12102020', 'SOAT', 230000.00, '2023-07-09 00:56:33', 1),
(238, '12020202', 'Accidente personales', 300000.00, '2023-08-03 02:45:34', 1),
(239, '33201010', 'contra todo riesgo', 320000.00, '2023-08-03 02:48:48', 1),
(240, '12302012', 'accidente carretera', 400000.00, '2023-08-03 02:49:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_vendidos`
--

CREATE TABLE `documentos_vendidos` (
  `id` int(11) NOT NULL,
  `id_documento` int(10) NOT NULL,
  `id_venta` int(10) NOT NULL,
  `existencia` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos_vendidos`
--

INSERT INTO `documentos_vendidos` (`id`, `id_documento`, `id_venta`, `existencia`) VALUES
(34, 238, 73, 1),
(35, 239, 73, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gender`
--

CREATE TABLE `gender` (
  `id_gender` int(2) NOT NULL,
  `gender` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gender`
--

INSERT INTO `gender` (`id_gender`, `gender`) VALUES
(1, 'masculino'),
(2, 'femenino'),
(3, 'otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intentos`
--

CREATE TABLE `intentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `document` int(10) UNSIGNED NOT NULL,
  `fecha_actual` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `intentos`
--

INSERT INTO `intentos` (`id`, `document`, `fecha_actual`) VALUES
(14, 1220202020, '2023-08-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(5) NOT NULL,
  `marca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `marca`) VALUES
(3, 'yamaha'),
(4, 'chevrolet'),
(5, 'Terpel'),
(6, 'alpinestars');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_motos`
--

CREATE TABLE `marcas_motos` (
  `id` int(5) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas_motos`
--

INSERT INTO `marcas_motos` (`id`, `nombre`) VALUES
(12020, 'Pulsar'),
(12232, 'kia'),
(12302, 'Suzuki'),
(13403, 'AKT'),
(32010, 'Yamaha ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id_modelo` int(3) NOT NULL,
  `modelo_año` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id_modelo`, `modelo_año`) VALUES
(2130, 2022),
(12010, 2014),
(12919, 1997),
(23020, 2011);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motorcycles`
--

CREATE TABLE `motorcycles` (
  `placa` varchar(6) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `km` int(10) NOT NULL,
  `id_modelo` int(3) NOT NULL,
  `id_marca` int(5) UNSIGNED NOT NULL,
  `id_color` int(3) NOT NULL,
  `id_carroceria` int(3) NOT NULL,
  `document` int(10) NOT NULL,
  `id_cilindraje` int(3) NOT NULL,
  `id_combustible` int(3) NOT NULL,
  `id_servicio_moto` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motorcycles`
--

INSERT INTO `motorcycles` (`placa`, `barcode`, `km`, `id_modelo`, `id_marca`, `id_color`, `id_carroceria`, `document`, `id_cilindraje`, `id_combustible`, `id_servicio_moto`) VALUES
('DDF23W', '2302020100', 32000, 12010, 12020, 3003, 4, 1201020100, 8, 5, 3),
('FRE23G', '1201010101', 2100, 12919, 12232, 10201, 3, 1201020100, 4, 5, 4),
('WWQ21P', '2301010100', 12000, 12919, 13403, 10201, 5, 1220202020, 6, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `name_pro` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_estado` int(2) NOT NULL,
  `id_marca` int(2) NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `name_pro`, `precio`, `id_estado`, `id_marca`, `cantidad`) VALUES
(15, '120303', 'llantas', 23000.00, 1, 4, 19),
(16, '1220202020', 'liquido de frenos', 12000.00, 1, 5, 29),
(17, '3302020200', 'luces LED', 21000.00, 1, 6, 31),
(18, '0203020202', 'parabrisas', 45000.00, 1, 4, 30),
(19, '2302201001', 'limpiador de cadena', 12000.00, 1, 6, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_vendidos`
--

CREATE TABLE `productos_vendidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `existencia` bigint(20) UNSIGNED NOT NULL,
  `id_venta` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos_vendidos`
--

INSERT INTO `productos_vendidos` (`id`, `id_producto`, `existencia`, `id_venta`) VALUES
(79, 16, 1, 73);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id_services` int(5) NOT NULL,
  `code_service` varchar(20) NOT NULL,
  `service` text NOT NULL,
  `costo_service` decimal(10,2) NOT NULL,
  `state` int(1) NOT NULL,
  `cantidad` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id_services`, `code_service`, `service`, `costo_service`, `state`, `cantidad`) VALUES
(32, '12230', 'cambio de aceite', 12000.00, 1, 1),
(33, '23230', 'transmision', 70000.00, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_vendidos`
--

CREATE TABLE `servicios_vendidos` (
  `id` int(11) NOT NULL,
  `id_servicio` int(10) NOT NULL,
  `id_venta` int(10) NOT NULL,
  `existencia` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios_vendidos`
--

INSERT INTO `servicios_vendidos` (`id`, `id_servicio`, `id_venta`, `existencia`) VALUES
(7, 12230, 73, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_moto`
--

CREATE TABLE `servicio_moto` (
  `id_servicio_moto` int(3) NOT NULL,
  `servicio_moto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio_moto`
--

INSERT INTO `servicio_moto` (`id_servicio_moto`, `servicio_moto`) VALUES
(1, 'carreras'),
(2, 'turismo'),
(3, 'Domiciliario'),
(4, 'Particular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shopping`
--

CREATE TABLE `shopping` (
  `id_shopping` int(8) NOT NULL,
  `document` int(10) NOT NULL,
  `document_trabajador` int(11) NOT NULL,
  `shop_datetime` datetime NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shop_detail`
--

CREATE TABLE `shop_detail` (
  `id_shop_detail` int(6) NOT NULL,
  `cant_product` int(5) NOT NULL,
  `id_shopping` int(8) NOT NULL,
  `id_product` int(10) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `state`
--

CREATE TABLE `state` (
  `id_state` int(2) NOT NULL,
  `state` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `state`
--

INSERT INTO `state` (`id_state`, `state`) VALUES
(1, 'activo'),
(2, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terminos`
--

CREATE TABLE `terminos` (
  `id_terminos` int(2) NOT NULL,
  `terminos` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `terminos`
--

INSERT INTO `terminos` (`id_terminos`, `terminos`) VALUES
(1, 'acepto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trigger_documents`
--

CREATE TABLE `trigger_documents` (
  `id` int(10) NOT NULL,
  `placa` varchar(6) NOT NULL,
  `codigo_documento` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trigger_documents`
--

INSERT INTO `trigger_documents` (`id`, `placa`, `codigo_documento`, `fecha_registro`, `fecha_fin`, `estado`) VALUES
(25, 'WWQ21P', '12020202', '2023-08-03 04:22:27', '2024-08-03 04:22:27', 1),
(26, 'WWQ21P', '33201010', '2023-08-03 04:22:27', '2024-08-03 04:22:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trigger_service`
--

CREATE TABLE `trigger_service` (
  `id` int(11) NOT NULL,
  `codigo_service` int(10) NOT NULL,
  `placa` varchar(6) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trigger_service`
--

INSERT INTO `trigger_service` (`id`, `codigo_service`, `placa`, `fecha`, `fecha_fin`, `nombre`, `estado`) VALUES
(7, 12230, 'WWQ21P', '2023-08-03 04:22:27', '2023-08-23 04:22:27', 'cambio de aceite', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trigger_user`
--

CREATE TABLE `trigger_user` (
  `id` int(10) NOT NULL,
  `document` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trigger_user`
--

INSERT INTO `trigger_user` (`id`, `document`, `password`, `fecha_registro`) VALUES
(12, 1201020100, '$2y$15$FvGV8omlVfgr4SX/v3SupOAY86pjpt49SYqQhgEPMMigERrRJM3I6', '2023-08-03 00:15:35'),
(13, 1202030202, '$2y$15$buVqU7RJdrmdAI/9EWauSeuSXn60Zvf9qL4XceUNJJ6SbTZ9d8aY2', '2023-08-03 00:16:12'),
(14, 1202030202, '$2y$15$buVqU7RJdrmdAI/9EWauSeuSXn60Zvf9qL4XceUNJJ6SbTZ9d8aY2', '2023-08-03 00:16:39'),
(15, 1220202020, '$2y$15$tAGJonNEUsP5kH.cdOJDQe9x2j0rRDaMkYfsh0LlLR7I.TUYXJ1Ae', '2023-08-03 00:18:52'),
(16, 1220202020, '$2y$15$tAGJonNEUsP5kH.cdOJDQe9x2j0rRDaMkYfsh0LlLR7I.TUYXJ1Ae', '2023-08-03 05:26:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_user`
--

CREATE TABLE `type_user` (
  `id_type_user` int(2) NOT NULL,
  `type_user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `type_user`
--

INSERT INTO `type_user` (`id_type_user`, `type_user`) VALUES
(1, 'admin'),
(2, 'trabajador'),
(3, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `document` int(10) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_user` date NOT NULL,
  `id_type_user` int(2) NOT NULL,
  `id_gender` int(2) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `id_state` int(2) NOT NULL,
  `datetime_reg` datetime NOT NULL,
  `confirmacion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`document`, `name`, `surname`, `telephone`, `email`, `date_user`, `id_type_user`, `id_gender`, `password`, `username`, `id_state`, `datetime_reg`, `confirmacion`) VALUES
(1202021, 'carlos', 'benitez', '3105678901', 'benitez12@misena.edu.co', '2005-05-07', 2, 1, '$2y$15$hqp8akQotlbHPvrwzlhcCekW.ohZXBEGxzcpRS77poKyThWQSzTvS', 'benitez212', 1, '2023-05-11 08:34:23', 1),
(1110460410, 'luis', 'garcia', '3213301955', 'lamunoz0140@misena.edu.co', '2005-12-17', 1, 1, '$2y$15$hrY7R.B/eaCrO91jIBsiEOUKad6X/yF1CrrKRupTjs0uagsq/PymK', 'siferapp20', 1, '2023-05-11 15:35:23', 1),
(1201020100, 'Juan', 'Garcia', '3201020102', 'ldlslsl@xn--gmai-jqa.com', '2023-07-20', 3, 1, '$2y$15$FvGV8omlVfgr4SX/v3SupOAY86pjpt49SYqQhgEPMMigERrRJM3I6', 'Juan23', 1, '0000-00-00 00:00:00', 1),
(1202030202, 'Daniel', 'Aristizabal', '3203020201', 'daniel@gmail.com', '2005-08-02', 3, 1, '$2y$15$buVqU7RJdrmdAI/9EWauSeuSXn60Zvf9qL4XceUNJJ6SbTZ9d8aY2', 'aristizaba', 1, '0000-00-00 00:00:00', 1),
(1220202020, 'Esteban ', 'Alvarez', '3222203020', 'esteban@gmail.com', '2005-07-31', 3, 1, '$2y$15$eAzb79Wr6YTyIgxMdYAzJe17vWah1koaTM62WjVR2jUJ6V5.lULfG', 'alvarez230', 1, '2023-08-02 13:06:07', 1);

--
-- Disparadores `user`
--
DELIMITER $$
CREATE TRIGGER `user_password` BEFORE UPDATE ON `user` FOR EACH ROW INSERT INTO trigger_user(document,password,fecha_registro)VALUES(OLD.document,OLD.password,NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document` int(10) NOT NULL,
  `placa` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `total` decimal(7,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `document`, `placa`, `fecha`, `fecha_fin`, `total`) VALUES
(73, 1202021, 'WWQ21P', '2023-08-03 04:22:27', '2024-08-03 04:22:27', 644000),
(74, 1202021, 'DDF23W', '2023-08-03 04:45:32', '2024-08-03 04:45:32', 12000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carroceria`
--
ALTER TABLE `carroceria`
  ADD PRIMARY KEY (`id_carroceria`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `cilindraje`
--
ALTER TABLE `cilindraje`
  ADD PRIMARY KEY (`id_cilindraje`);

--
-- Indices de la tabla `colores_moto`
--
ALTER TABLE `colores_moto`
  ADD PRIMARY KEY (`id_color`),
  ADD UNIQUE KEY `id_color` (`id_color`);

--
-- Indices de la tabla `combustible`
--
ALTER TABLE `combustible`
  ADD PRIMARY KEY (`id_combustible`);

--
-- Indices de la tabla `datetime_entry`
--
ALTER TABLE `datetime_entry`
  ADD PRIMARY KEY (`id_entry`),
  ADD KEY `datetime_entry_ibfk_1` (`document`);

--
-- Indices de la tabla `datetime_out`
--
ALTER TABLE `datetime_out`
  ADD PRIMARY KEY (`id_out`),
  ADD KEY `document_user` (`document_user`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`);

--
-- Indices de la tabla `documentos_vendidos`
--
ALTER TABLE `documentos_vendidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id_gender`);

--
-- Indices de la tabla `intentos`
--
ALTER TABLE `intentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `marcas_motos`
--
ALTER TABLE `marcas_motos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id_modelo`);

--
-- Indices de la tabla `motorcycles`
--
ALTER TABLE `motorcycles`
  ADD PRIMARY KEY (`placa`),
  ADD KEY `motorcycles_ibfk_1` (`document`),
  ADD KEY `motorcycles_ibfk_2` (`id_carroceria`),
  ADD KEY `id_color` (`id_color`),
  ADD KEY `id_combustible` (`id_combustible`),
  ADD KEY `motorcycles_ibfk_6` (`id_marca`),
  ADD KEY `motorcycles_ibfk_7` (`id_modelo`),
  ADD KEY `id_servicio_moto` (`id_servicio_moto`),
  ADD KEY `id_cilindraje` (`id_cilindraje`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_services`);

--
-- Indices de la tabla `servicios_vendidos`
--
ALTER TABLE `servicios_vendidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio_moto`
--
ALTER TABLE `servicio_moto`
  ADD PRIMARY KEY (`id_servicio_moto`);

--
-- Indices de la tabla `shopping`
--
ALTER TABLE `shopping`
  ADD PRIMARY KEY (`id_shopping`);

--
-- Indices de la tabla `shop_detail`
--
ALTER TABLE `shop_detail`
  ADD PRIMARY KEY (`id_shop_detail`);

--
-- Indices de la tabla `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id_state`);

--
-- Indices de la tabla `terminos`
--
ALTER TABLE `terminos`
  ADD PRIMARY KEY (`id_terminos`);

--
-- Indices de la tabla `trigger_documents`
--
ALTER TABLE `trigger_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trigger_service`
--
ALTER TABLE `trigger_service`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trigger_user`
--
ALTER TABLE `trigger_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `type_user`
--
ALTER TABLE `type_user`
  ADD PRIMARY KEY (`id_type_user`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`document`),
  ADD KEY `id_gender` (`id_gender`),
  ADD KEY `user_ibfk_3` (`id_state`),
  ADD KEY `user_ibfk_4` (`id_type_user`),
  ADD KEY `user_ibfk_6` (`confirmacion`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_ibfk_1` (`document`),
  ADD KEY `ventas_ibfk_2` (`placa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carroceria`
--
ALTER TABLE `carroceria`
  MODIFY `id_carroceria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cilindraje`
--
ALTER TABLE `cilindraje`
  MODIFY `id_cilindraje` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `combustible`
--
ALTER TABLE `combustible`
  MODIFY `id_combustible` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `datetime_entry`
--
ALTER TABLE `datetime_entry`
  MODIFY `id_entry` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT de la tabla `datetime_out`
--
ALTER TABLE `datetime_out`
  MODIFY `id_out` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT de la tabla `documentos_vendidos`
--
ALTER TABLE `documentos_vendidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `gender`
--
ALTER TABLE `gender`
  MODIFY `id_gender` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `intentos`
--
ALTER TABLE `intentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id_services` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `servicios_vendidos`
--
ALTER TABLE `servicios_vendidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicio_moto`
--
ALTER TABLE `servicio_moto`
  MODIFY `id_servicio_moto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `state`
--
ALTER TABLE `state`
  MODIFY `id_state` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `terminos`
--
ALTER TABLE `terminos`
  MODIFY `id_terminos` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `trigger_documents`
--
ALTER TABLE `trigger_documents`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `trigger_service`
--
ALTER TABLE `trigger_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `trigger_user`
--
ALTER TABLE `trigger_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `type_user`
--
ALTER TABLE `type_user`
  MODIFY `id_type_user` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datetime_entry`
--
ALTER TABLE `datetime_entry`
  ADD CONSTRAINT `datetime_entry_ibfk_1` FOREIGN KEY (`document`) REFERENCES `user` (`document`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `datetime_out`
--
ALTER TABLE `datetime_out`
  ADD CONSTRAINT `datetime_out_ibfk_1` FOREIGN KEY (`document_user`) REFERENCES `user` (`document`);

--
-- Filtros para la tabla `motorcycles`
--
ALTER TABLE `motorcycles`
  ADD CONSTRAINT `motorcycles_ibfk_1` FOREIGN KEY (`document`) REFERENCES `user` (`document`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motorcycles_ibfk_2` FOREIGN KEY (`id_carroceria`) REFERENCES `carroceria` (`id_carroceria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motorcycles_ibfk_4` FOREIGN KEY (`id_color`) REFERENCES `colores_moto` (`id_color`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motorcycles_ibfk_5` FOREIGN KEY (`id_combustible`) REFERENCES `combustible` (`id_combustible`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motorcycles_ibfk_6` FOREIGN KEY (`id_marca`) REFERENCES `marcas_motos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motorcycles_ibfk_7` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id_modelo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motorcycles_ibfk_8` FOREIGN KEY (`id_servicio_moto`) REFERENCES `servicio_moto` (`id_servicio_moto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motorcycles_ibfk_9` FOREIGN KEY (`id_cilindraje`) REFERENCES `cilindraje` (`id_cilindraje`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  ADD CONSTRAINT `productos_vendidos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_vendidos_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_gender`) REFERENCES `gender` (`id_gender`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`id_type_user`) REFERENCES `type_user` (`id_type_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_5` FOREIGN KEY (`id_state`) REFERENCES `state` (`id_state`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_6` FOREIGN KEY (`confirmacion`) REFERENCES `terminos` (`id_terminos`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`document`) REFERENCES `user` (`document`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`placa`) REFERENCES `motorcycles` (`placa`) ON UPDATE CASCADE;

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `actualizar_estado_seguro` ON SCHEDULE EVERY 1 DAY STARTS '2023-08-03 04:18:05' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE trigger_documents
    SET estado = 2
    WHERE fecha_fin < CURRENT_TIMESTAMP();
END$$

CREATE DEFINER=`root`@`localhost` EVENT `actualizar_estado_service` ON SCHEDULE EVERY 1 DAY STARTS '2023-08-03 04:21:36' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE trigger_service
    SET estado = 2
    WHERE fecha_fin < CURRENT_TIMESTAMP();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
