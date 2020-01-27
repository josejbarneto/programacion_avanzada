-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2020 a las 10:59:04
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(32) NOT NULL,
  `nombre` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Deportes', 'Todo lo relacionado con el mundo del deporte: Fútbol, baloncesto, balomano, etc.'),
(2, 'Informatica', 'Todo lo relacionado con el mundo de la informática'),
(3, 'Videojuegos', 'Todo lo relacionado con el mundo de los videojuegos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--
-- Error leyendo la estructura de la tabla pa.comentario: #1932 - Table 'pa.comentario' doesn't exist in engine
-- Error leyendo datos de la tabla pa.comentario: #1064 - Algo está equivocado en su sintax cerca 'FROM `pa`.`comentario`' en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--
-- Error leyendo la estructura de la tabla pa.galeria: #1932 - Table 'pa.galeria' doesn't exist in engine
-- Error leyendo datos de la tabla pa.galeria: #1064 - Algo está equivocado en su sintax cerca 'FROM `pa`.`galeria`' en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--
-- Error leyendo la estructura de la tabla pa.mensaje: #1932 - Table 'pa.mensaje' doesn't exist in engine
-- Error leyendo datos de la tabla pa.mensaje: #1064 - Algo está equivocado en su sintax cerca 'FROM `pa`.`mensaje`' en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--
-- Error leyendo la estructura de la tabla pa.post: #1932 - Table 'pa.post' doesn't exist in engine
-- Error leyendo datos de la tabla pa.post: #1064 - Algo está equivocado en su sintax cerca 'FROM `pa`.`post`' en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias`
--

CREATE TABLE `preferencias` (
  `id` int(32) NOT NULL,
  `id_usuario` int(32) NOT NULL,
  `vista` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `modo_nocturno` tinyint(1) NOT NULL,
  `categoria_inicial` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `lenguaje_obsceno` tinyint(1) NOT NULL,
  `open_post_new_tab` tinyint(1) NOT NULL,
  `orden` varchar(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `preferencias`
--

INSERT INTO `preferencias` (`id`, `id_usuario`, `vista`, `modo_nocturno`, `categoria_inicial`, `lenguaje_obsceno`, `open_post_new_tab`, `orden`) VALUES
(2, 39, 'compacta', 0, 'Categoria1', 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reaccion`
--
-- Error leyendo la estructura de la tabla pa.reaccion: #1932 - Table 'pa.reaccion' doesn't exist in engine
-- Error leyendo datos de la tabla pa.reaccion: #1064 - Algo está equivocado en su sintax cerca 'FROM `pa`.`reaccion`' en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(32) NOT NULL,
  `usuario` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `contrasenya` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `nombre`, `contrasenya`, `email`) VALUES
(39, 'carlos', '', '$2y$10$y8464Tfy/2Z9nZBrJjj/A.aPlusF9mbTj.4wvxYABYSoKgRsqLHIy', 'carlos@gmail.com'),
(40, 'CArlitos156', '', '$2y$10$gvGWvJn1q0HWrParFDu8gOZBk1OOw07YhHqmhnwDB8xq96J0OAxE2', 'jq@gmail.com'),
(41, 'juanka', 'jank', '$2y$10$J.Zy0Ksxrz8mdwh4pDRjKuCk/phFlRtSBAHHE0Q7nAGB7a39Y58HO', 'juanca@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD CONSTRAINT `preferencias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
