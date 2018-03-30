-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-03-2018 a las 20:56:27
-- Versión del servidor: 5.5.58-0ubuntu0.14.04.1
-- Versión de PHP: 7.1.14-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `CLAP`
--
CREATE DATABASE IF NOT EXISTS `CLAP` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `CLAP`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas`
--

CREATE TABLE `entregas` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `recibio` tinyint(1) NOT NULL,
  `fecha` varchar(36) COLLATE utf8_spanish2_ci NOT NULL,
  `noreferencia` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `entregas`
--

INSERT INTO `entregas` (`id`, `id_persona`, `recibio`, `fecha`, `noreferencia`) VALUES
(1, 5, 1, 'Saturday 03 February 2018 19:22:38', '8127983712'),
(2, 3, 1, 'Sunday 04 February 2018 9:00:25', '1111111111'),
(3, 3, 1, 'Sunday 04 February 2018 9:05:41', '0000000000'),
(4, 5, 1, 'Monday 05 February 2018 1:58:22', '1101100001'),
(5, 4, 1, 'Monday 05 February 2018 2:21:59', '1313123123'),
(6, 7, 1, 'Monday 05 February 2018 19:15:45', '1011999191'),
(7, 7, 0, 'Wednesday 07 February 2018 12:23:09', '9183901830');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `cedula` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(11) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `cedula`, `telefono`, `direccion`) VALUES
(1, 'Jose Fernando', 'Lopez Ortiz', '25887282', '04243375169', 'calle oasis avenida los llanos'),
(2, 'Cesar Antonio', 'Padrino Navas', '25130266', '04243677015', 'el dique'),
(3, 'Julio', 'Yanez', '26026083', '', 'C/La Victoria'),
(4, 'Iraida Josefina', 'Loepz', '10669419', '', 'calle oasis'),
(5, 'Gibert', 'Carrera', '23795320', '04164376667', 'La haciendita - cagua aragua'),
(6, 'benito', 'Camelo', '15888888', '05555555555', 'AVENIDA EL DIQUE CALLE PRINCIPAL'),
(7, 'ajdasjdalskjdkalsdjsd', 'JosÃ©', '99999999', '99999999999', 'la ultima casa a la izquierda'),
(8, 'cinco', 'sinco', '55555555', '5555555555', 'cico'),
(9, 'jladsajdkjasd', 'jakjdalsdjalsdjalkj', '13123131', '91303809128', 'jdajdklajdljaskdjaklsdsadljasld');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `contenido` text COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` varchar(36) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `titulo`, `contenido`, `fecha`) VALUES
(1, 'No hay nada', 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'Saturday 03 February 2018 18:55:19'),
(2, 'verga mano', 'Esto fue mucho mas complejo de lo q parecia', 'Saturday 03 February 2018 18:55:42'),
(3, 'admin padrino', 'estoy publicando alho como segundo administrador', 'Saturday 03 February 2018 19:21:08'),
(4, 'esto es un apasdkas', 'aksdjklsdjlasdsadlsaldjsad', 'Wednesday 07 February 2018 12:21:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamos`
--

CREATE TABLE `reclamos` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `reclamo` text COLLATE utf8_spanish2_ci NOT NULL,
  `id_respuesta` int(11) DEFAULT NULL,
  `fecha` varchar(36) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reclamos`
--

INSERT INTO `reclamos` (`id`, `id_persona`, `reclamo`, `id_respuesta`, `fecha`) VALUES
(1, 5, 'mi nombre es gibert y estoy reclamando que este gobierno no sirve para un coÃ±o', NULL, 'Saturday 03 February 2018 19:21:49'),
(2, 7, 'esto es un reclamo por parte de jose jose (y)', 1, 'Saturday 03 February 2018 21:11:13'),
(3, 5, 'reclaaamooooooooooo', 2, 'Sunday 04 February 2018 23:42:10'),
(4, 5, '131312321313123', NULL, 'Monday 05 February 2018 1:59:07'),
(5, 7, 'paraq me lo espondan a la vbrevedad posible', 3, 'Monday 05 February 2018 2:18:09'),
(6, 7, 'esto es un reclamo por parte e joseito jaja', 4, 'Monday 05 February 2018 19:14:53'),
(7, 7, '131321321321313', 6, 'Monday 05 February 2018 19:19:47'),
(8, 7, 'sadjlaskdjsjdksajdaklsjd', 5, 'Wednesday 07 February 2018 12:22:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `respuesta` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` varchar(36) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `respuesta`, `fecha`) VALUES
(1, 'esta e una respiesta por parte de miiiiiii', 'Sunday 04 February 2018 22:50:17'),
(2, 'espuestaaaaaaaaaaaaa', 'Sunday 04 February 2018 23:42:22'),
(3, 'respondoendo a a vrevedad', 'Monday 05 February 2018 2:18:34'),
(4, 'y esta es ina respuesta por aprte de el administrador', 'Monday 05 February 2018 19:15:11'),
(5, 'mamaloooooooooooooo', 'Tuesday 20 February 2018 17:00:23'),
(6, 'tu tambienn, chinga tu ***a madreeeeee .l.', 'Tuesday 20 February 2018 17:00:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `clave` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_persona`, `clave`, `admin`) VALUES
(1, 1, 'jose', 1),
(3, 3, 'julio', 1),
(6, 5, 'gibert', 0),
(8, 4, 'iraida', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reclamos_ibfk_1` (`id_respuesta`),
  ADD KEY `reclamos_ibfk_2` (`id_persona`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_ibfk_1` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reclamos`
--
ALTER TABLE `reclamos`
  ADD CONSTRAINT `reclamos_ibfk_1` FOREIGN KEY (`id_respuesta`) REFERENCES `respuestas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reclamos_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
