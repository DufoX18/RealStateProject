-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-09-2024 a las 18:27:49
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
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracionsitio`
--

CREATE TABLE `configuracionsitio` (
  `id` int(11) NOT NULL,
  `color_1` varchar(15) NOT NULL DEFAULT '#212529',
  `color_2` varchar(15) NOT NULL DEFAULT '#FFFFFF',
  `color_3` varchar(15) NOT NULL DEFAULT '#FFC107',
  `icono_principal_id` int(11) DEFAULT NULL,
  `imagen_banner_id` int(11) DEFAULT NULL,
  `mensaje_banner` varchar(255) DEFAULT NULL,
  `informacion_quienes_somos` varchar(800) DEFAULT NULL,
  `imagen_quienes_somos_id` int(11) DEFAULT NULL,
  `enlace_facebook` varchar(255) DEFAULT NULL,
  `enlace_youtube` varchar(255) DEFAULT NULL,
  `enlace_instagram` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracionsitio`
--

INSERT INTO `configuracionsitio` (`id`, `color_1`, `color_2`, `color_3`, `icono_principal_id`, `imagen_banner_id`, `mensaje_banner`, `informacion_quienes_somos`, `imagen_quienes_somos_id`, `enlace_facebook`, `enlace_youtube`, `enlace_instagram`, `direccion`, `telefono`, `email`, `fecha_actualizacion`) VALUES
(1, '#212529', '#ffffff', '#efb820', 1, 2, 'PERMITENOS AYUDARTE A CUMPLIR TUS SUEÑOS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare augue vitae orci rutrum vehicula. Phasellus malesuada ligula ac ipsum ullamcorper iaculis. Proin consectetur dui eu laoreet volutpat. Morbi vitae tortor eros. Proin mattis rutrum nibh, quis cursus metus malesuada sit amet. Etiam auctor lobortis magna vitae lacinia. Nulla tempor pulvinar leo id consequat. Suspendisse aliquet lectus at nisi pretium pulvinar.\r\n\r\nNunc nunc eros, sollicitudin ut quam ut, luctus luctus orci. Aenean arcu quam, vehicula vel ipsum at, fringilla sodales leo. Donec non diam eget magna finibus sodales. Nullam auctor velit ut odio accumsan, ac feugiat ipsum auctor. Nulla id ullamcorper enim. Sed eget mauris eu magna iaculis ultrices. Class aptent taciti sociosqu ad litora torquent per conubia nostra.', 3, 'https://www.youtube.com/watch?v=B1DoCrh7g_I', 'https://youtube.com/', 'https://www.instagram.com/', 'Tilarán, Guanacaste', '84327100', 'carodri323@gmail.com', '2024-08-26 18:00:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `nombre`, `direccion`, `fecha_subida`) VALUES
(1, 'Logo Principal', './assets/img/logoPrincipal.jpg', '2024-08-11 05:34:51'),
(2, 'Banner', './assets/img/RealStateImgPrincipal.webp', '2024-08-11 05:34:51'),
(3, 'Imagen Quiénes Somos', './assets/img/persona.jpeg', '2024-08-11 05:34:51'),
(8, 'property1.jpeg', './assets/img/property1.jpeg', '2024-08-14 18:59:12'),
(9, 'property1.jpeg', './assets/img/property1.jpeg', '2024-08-14 19:09:03'),
(10, 'property1.jpeg', './assets/img/property1.jpeg', '2024-08-14 19:13:22'),
(16, 'property1.jpeg', './assets/img/property1.jpeg', '2024-08-14 23:28:41'),
(17, 'logoReal.jpeg', './assets/img/logoReal.jpeg', '2024-08-20 17:57:09'),
(19, 'logoReal.jpeg', './assets/img/logoReal.jpeg', '2024-08-20 17:59:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajescontacto`
--

CREATE TABLE `mensajescontacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `mensaje` varchar(100) NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajescontacto`
--

INSERT INTO `mensajescontacto` (`id`, `nombre`, `correo`, `mensaje`, `fecha_envio`) VALUES
(1, '', '', '', '2024-08-22 20:19:44'),
(2, 'David Alessandro Pina Perez', 'carodri323@gmail.com', 'hola prueba', '2024-08-30 17:51:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL,
  `tipo` enum('alquiler','venta') NOT NULL,
  `destacada` tinyint(1) DEFAULT 0,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `agente_id` int(11) DEFAULT NULL,
  `imagen_id` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `tipo`, `destacada`, `titulo`, `descripcion`, `precio`, `agente_id`, `imagen_id`, `fecha_creacion`) VALUES
(3, 'venta', 1, 'Casa 3', 'Casa mediana, 4 cuartos', 40500.00, 2, 8, '2024-08-14 18:59:12'),
(4, 'alquiler', 1, 'Casa 4', 'Casa grande, 8 cuartos', 70000.00, 2, 9, '2024-08-14 19:09:03'),
(5, 'alquiler', 0, 'Casa 5', 'Casa pequeña, 3 cuartos', 24000.00, 2, 10, '2024-08-14 19:13:22'),
(6, 'venta', 1, 'Casa 2', 'Casa mediana', 30000.00, 2, 16, '2024-08-14 23:28:41'),
(7, 'alquiler', 0, 'Casa en Tilarán', 'Bella casa en Tilarán', 700.00, 4, 8, '2024-08-20 17:57:09'),
(9, 'venta', 0, 'Casa en Liberia', 'Bella casa en Liberia', 200000.00, 4, 8, '2024-08-20 17:59:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_fin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `privilegio` enum('administrador','agente_de_ventas','publico') DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `telefono`, `correo`, `usuario`, `contraseña`, `privilegio`, `fecha_creacion`) VALUES
(1, 'Administrador', '11223344', 'admin@gmail.com', 'Admin', '$2y$10$BymLjqSyiYTX10TEMNMdPetOv9E/EKWpkDpQLFPER4vbrWARQvchq', 'administrador', '2024-08-10 23:59:44'),
(2, 'Denzel Herrera García', '86536201', 'denzel@gmail.com', 'Denzel', '$2y$04$1k6RjoVQhHzg2c4gwgNikeYJaF7xif1b86XNgurRuSXWFa9igqCge', 'publico', '2024-08-11 04:15:38'),
(4, 'David Alessandro Piña Pérez', '84327100', 'carodri323@gmail.com', 'Dufo', '$2y$04$ME.X9gUI.uH6QkpXieQLeebNsqz6VBc5zXEbVJwmwie90Ec9A5hIW', 'agente_de_ventas', '2024-08-20 17:55:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracionsitio`
--
ALTER TABLE `configuracionsitio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `icono_principal_id` (`icono_principal_id`),
  ADD KEY `imagen_banner_id` (`imagen_banner_id`),
  ADD KEY `imagen_quienes_somos_id` (`imagen_quienes_somos_id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajescontacto`
--
ALTER TABLE `mensajescontacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agente_id` (`agente_id`),
  ADD KEY `imagen_id` (`imagen_id`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracionsitio`
--
ALTER TABLE `configuracionsitio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `mensajescontacto`
--
ALTER TABLE `mensajescontacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `configuracionsitio`
--
ALTER TABLE `configuracionsitio`
  ADD CONSTRAINT `configuracionsitio_ibfk_1` FOREIGN KEY (`icono_principal_id`) REFERENCES `imagenes` (`id`),
  ADD CONSTRAINT `configuracionsitio_ibfk_3` FOREIGN KEY (`imagen_banner_id`) REFERENCES `imagenes` (`id`),
  ADD CONSTRAINT `configuracionsitio_ibfk_4` FOREIGN KEY (`imagen_quienes_somos_id`) REFERENCES `imagenes` (`id`);

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`agente_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `propiedades_ibfk_2` FOREIGN KEY (`imagen_id`) REFERENCES `imagenes` (`id`);

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
