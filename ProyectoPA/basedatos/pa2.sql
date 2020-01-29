-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-01-2020 a las 21:30:44
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
-- Base de datos: `pa2`
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
(1, 'Deportes', 'Todo sobre deportes'),
(2, 'Informatica', 'Todo sobre Informatica'),
(3, 'Videojuegos', 'Todo sobre videojuegos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(32) NOT NULL,
  `id_usuario` int(32) NOT NULL,
  `id_post` int(32) NOT NULL,
  `texto` text COLLATE latin1_spanish_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `id_usuario`, `id_post`, `texto`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(17, 23, 21, 'Hola tq bro pro dislike', '2020-01-29 03:51:12', '2020-01-29 03:51:12'),
(22, 25, 55, 'asdfghjklÃ±', '2020-01-29 20:48:15', '2020-01-29 20:48:15'),
(23, 25, 55, 'Bonita foto', '2020-01-29 20:48:25', '2020-01-29 20:48:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id` int(32) NOT NULL,
  `id_usuario` int(32) NOT NULL,
  `id_post` int(32) NOT NULL,
  `nombre_fichero` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `url` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `tipo` varchar(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`id`, `id_usuario`, `id_post`, `nombre_fichero`, `url`, `tipo`) VALUES
(1, 25, 37, '', '', 'PNG'),
(2, 25, 38, '../../uploads/1580301624Captura.', '', 'PNG'),
(3, 25, 39, '', 'https://d500.epimg.net/cincodias', 'jpg'),
(4, 25, 40, '', 'https://d500.epimg.net/cincodias', 'jpg'),
(5, 25, 49, '../../uploads/1580319255001.jpg', '', 'jpg'),
(6, 25, 50, '../../uploads/1580321289008.jpg', '', 'jpg'),
(7, 25, 51, '../../uploads/1580323552001.jpg', '', 'jpg'),
(8, 25, 52, '../../uploads/1580323810001.jpg', '', 'jpg'),
(9, 25, 53, '', 'https://ichef.bbci.co.uk/news/32', 'jpg'),
(10, 25, 54, '', 'https://previews.123rf.com/image', 'jpg'),
(11, 25, 55, '', 'https://i.ytimg.com/vi/MZD7RZmi8O8/maxresdefault.jpg', 'jpg'),
(12, 25, 56, '../../uploads/1580329446001.jpg', '', 'jpg'),
(13, 25, 57, '', 'https://i.ytimg.com/vi/MZD7RZmi8O8/maxresdefault.jpg', 'jpg'),
(14, 25, 58, '../../uploads/1580329669001.jpg', '', 'jpg'),
(15, 25, 59, '../../uploads/1580329669001.jpg', '', 'jpg'),
(16, 25, 60, '../../uploads/1580329670001.jpg', '', 'jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(32) NOT NULL,
  `id_usuario` int(32) NOT NULL,
  `id_categoria` int(32) NOT NULL,
  `titulo` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `texto` text COLLATE latin1_spanish_ci NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `id_usuario`, `id_categoria`, `titulo`, `texto`, `fecha_creacion`) VALUES
(20, 24, 3, 'sdfhgf', 'fghfghf', '2020-01-28'),
(21, 24, 2, 'sfghf', 'ghsfgg', '2020-01-28'),
(22, 24, 1, 'sfhfgh', 'sfhsfg', '2020-01-28'),
(23, 24, 3, 'fghg', 'fghfghs', '2020-01-28'),
(24, 23, 1, 'fdghf', 'iytu', '2020-01-29'),
(25, 25, 1, 'hola', 'asdasdadsad', '2020-01-29'),
(26, 25, 2, 'heyy', 'asdasdas', '2020-01-29'),
(27, 25, 1, 'sadasdasd', 'dfsfsdfdsfsd', '2020-01-29'),
(28, 25, 2, 'dsadsadasd', 'asdasdasds', '2020-01-29'),
(29, 25, 1, 'asdasdsadasd', 'dsfsdfasdafas', '2020-01-29'),
(30, 25, 3, 'dsfsdfsdfd', 'sadsadsadasdasd', '2020-01-29'),
(31, 25, 3, 'sdcsdcsdccs', 'asdasdasdasdasd', '2020-01-29'),
(32, 25, 3, 'sdfsdfsdfsdf', 'dfsdvdssdvd', '2020-01-29'),
(33, 25, 1, 'sdfghjkl', 'sdfghjklÃ±', '2020-01-29'),
(34, 25, 1, 'sdfghjkl', 'sdfghjklÃ±', '2020-01-29'),
(35, 25, 1, 'dfghjklÃ±', 'xcvbjklÃ±', '2020-01-29'),
(36, 25, 1, 'dfghjklÃ±', 'xcvbjklÃ±', '2020-01-29'),
(37, 25, 1, 'dfghjklÃ±', 'xcvbjklÃ±', '2020-01-29'),
(38, 25, 1, 'dfghjklÃ±', 'xcvbjklÃ±', '2020-01-29'),
(39, 25, 1, 'sdfghjklÃ±', 'sdfghjklÃ±', '2020-01-29'),
(40, 25, 1, 'adasdasdasd', 'adasdadasd', '2020-01-29'),
(41, 25, 2, 'El post flama', 'Tareitas de calculo que no voy a ver mas', '2020-01-29'),
(42, 25, 2, 'El post flama', 'Tareitas de calculo que no voy a ver mas', '2020-01-29'),
(43, 25, 2, 'El post flama', 'Tareitas de calculo que no voy a ver mas', '2020-01-29'),
(44, 25, 2, 'calc', 'aacasacacasc', '2020-01-29'),
(45, 25, 2, 'calc', 'aacasacacasc', '2020-01-29'),
(46, 25, 2, 'calc', 'aacasacacasc', '2020-01-29'),
(47, 25, 2, 'calc', 'aacasacacasc', '2020-01-29'),
(48, 25, 2, 'calculo', 'no quiero volver a verte', '2020-01-29'),
(49, 25, 2, 'calculo', 'no quiero volver a verte', '2020-01-29'),
(50, 25, 3, 'El post calculado', 'Calculoooooo', '2020-01-29'),
(51, 25, 1, 'definitivo', 'ghjklÃ±Â´Ã§+`poiuyt', '2020-01-29'),
(52, 25, 3, 'el post url', 'sdfgyuiop', '2020-01-29'),
(53, 25, 2, 'URL', 'yea', '2020-01-29'),
(54, 25, 1, 'URL 2.0', 'dfghjklÃ±', '2020-01-29'),
(55, 25, 1, 'URL 3.0', 'espero que funcione', '2020-01-29'),
(56, 25, 1, 'pumar', 'asdasdasdasd', '2020-01-29'),
(57, 25, 2, 'pumar 2.0', 'ASDFGHJKLÃ‘', '2020-01-29'),
(58, 25, 3, 'pumar 3.0', 'sdfghjklÃ±', '2020-01-29'),
(59, 25, 3, 'pumar 3.0', 'sdfghjklÃ±', '2020-01-29'),
(60, 25, 3, 'pumar 3.0', 'sdfghjklÃ±', '2020-01-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias`
--

CREATE TABLE `preferencias` (
  `id` int(32) NOT NULL,
  `id_usuario` int(32) NOT NULL,
  `modo_nocturno` tinyint(1) NOT NULL,
  `id_categoria_inicial` int(32) NOT NULL,
  `lenguaje_obsceno` tinyint(1) NOT NULL,
  `open_post_new_tab` tinyint(1) NOT NULL,
  `orden` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `preferencias`
--

INSERT INTO `preferencias` (`id`, `id_usuario`, `modo_nocturno`, `id_categoria_inicial`, `lenguaje_obsceno`, `open_post_new_tab`, `orden`) VALUES
(21, 23, 0, 1, 0, 0, 1),
(22, 24, 0, 1, 0, 0, 1),
(23, 25, 0, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reaccion`
--

CREATE TABLE `reaccion` (
  `id` int(32) NOT NULL,
  `id_usuario` int(32) NOT NULL,
  `id_post` int(32) NOT NULL,
  `tipo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `reaccion`
--

INSERT INTO `reaccion` (`id`, `id_usuario`, `id_post`, `tipo`) VALUES
(12, 24, 22, 0),
(15, 23, 23, 1),
(16, 23, 21, 0),
(17, 23, 22, 0),
(18, 24, 21, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(32) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `usuario` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `contrasenya` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `admin`, `usuario`, `nombre`, `contrasenya`, `email`) VALUES
(23, 0, 'carlos', 'Carlos Pumar', '$2y$10$F1ek6gXYmunpJxyNGR87Hee6RZzgk6fi7jE0kmKtYyc5bq2roAYAu', 'carlos@gmail.com'),
(24, 1, 'juanka', 'juanka', 'f', 'juanca@gmail.com'),
(25, 0, 'holaqase1', 'hola', '$2y$10$clORqgUCIanBG7mUXXeGZOLDMRaoFRYqKiFA5POy4VX061ckfdenK', 'hola@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_post` (`id_post`);

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_post` (`id_post`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria_inicial` (`id_categoria_inicial`);

--
-- Indices de la tabla `reaccion`
--
ALTER TABLE `reaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_post` (`id_post`);

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
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `reaccion`
--
ALTER TABLE `reaccion`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD CONSTRAINT `galeria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `galeria_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preferencias`
--
ALTER TABLE `preferencias`
  ADD CONSTRAINT `preferencias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preferencias_ibfk_2` FOREIGN KEY (`id_categoria_inicial`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reaccion`
--
ALTER TABLE `reaccion`
  ADD CONSTRAINT `reaccion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reaccion_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
