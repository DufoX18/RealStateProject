-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-08-2024 a las 02:01:51
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
  `color_tema` enum('azul','amarillo','gris','blanco_y_gris') NOT NULL DEFAULT 'azul',
  `icono_principal_id` int(11) DEFAULT NULL,
  `icono_blanco_id` int(11) DEFAULT NULL,
  `imagen_banner_id` int(11) DEFAULT NULL,
  `mensaje_banner` varchar(255) DEFAULT NULL,
  `informacion_quienes_somos` varchar(255) DEFAULT NULL,
  `imagen_quienes_somos_id` int(11) DEFAULT NULL,
  `enlace_facebook` varchar(255) DEFAULT NULL,
  `enlace_twitter` varchar(255) DEFAULT NULL,
  `enlace_instagram` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `privilegio` enum('administrador','agente_de_ventas') NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `telefono`, `correo`, `usuario`, `contraseña`, `privilegio`, `fecha_creacion`) VALUES
(1, 'Administrador', '11223344', 'admin@gmail.com', 'Admin', '$2y$10$BymLjqSyiYTX10TEMNMdPetOv9E/EKWpkDpQLFPER4vbrWARQvchq', 'administrador', '2024-08-10 23:59:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracionsitio`
--
ALTER TABLE `configuracionsitio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `icono_principal_id` (`icono_principal_id`),
  ADD KEY `icono_blanco_id` (`icono_blanco_id`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajescontacto`
--
ALTER TABLE `mensajescontacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `configuracionsitio`
--
ALTER TABLE `configuracionsitio`
  ADD CONSTRAINT `configuracionsitio_ibfk_1` FOREIGN KEY (`icono_principal_id`) REFERENCES `imagenes` (`id`),
  ADD CONSTRAINT `configuracionsitio_ibfk_2` FOREIGN KEY (`icono_blanco_id`) REFERENCES `imagenes` (`id`),
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
