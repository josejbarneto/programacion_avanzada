-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2020 a las 05:13:38
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
(1, 'Informatica', 'Todo sobre Informatica'),
(2, 'Videojuegos', 'Todo sobre videojuegos'),
(3, 'Deportes', 'Todo lo relacionado con el deporte'),
(4, 'Actualidad', 'Lo Ãºltimo en este mundo'),
(5, 'Estudios', 'Todo acerca de los estudios');

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
(38, 34, 77, 'Me encanta este videojuego', '2020-01-30 04:44:58', '2020-01-30 04:44:58'),
(39, 33, 80, 'FAKE NEW!!!', '2020-01-30 04:56:45', '2020-01-30 04:56:45'),
(40, 34, 80, 'Es verdd, lo leÃ­ en forocoches', '2020-01-30 04:57:24', '2020-01-30 04:57:24'),
(41, 35, 81, 'Un virus muy peligroso', '2020-01-30 05:04:58', '2020-01-30 05:04:58'),
(42, 33, 86, 'Enhorabuena!!!', '2020-01-30 05:08:15', '2020-01-30 05:08:15'),
(43, 33, 78, 'Gracias!!!', '2020-01-30 05:10:30', '2020-01-30 05:10:30'),
(44, 34, 78, ':)', '2020-01-30 05:10:48', '2020-01-30 05:10:48'),
(45, 35, 78, 'Genial', '2020-01-30 05:11:47', '2020-01-30 05:11:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id` int(32) NOT NULL,
  `id_usuario` int(32) NOT NULL,
  `id_post` int(32) NOT NULL,
  `nombre_fichero` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `url` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `tipo` varchar(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`id`, `id_usuario`, `id_post`, `nombre_fichero`, `url`, `tipo`) VALUES
(29, 33, 77, '../../uploads/1580354890fifa.jpg', '', 'jpg'),
(30, 34, 79, '../../uploads/1580355974kobejpg.jpg', '', 'jpg'),
(31, 34, 84, '', 'https://www.youtube.com/embed/ZdP0KM49IVk', ''),
(32, 33, 87, '../../uploads/1580357378shaq.gif', '', 'gif');

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
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `id_usuario`, `id_categoria`, `titulo`, `texto`, `fecha_creacion`) VALUES
(77, 33, 2, 'Nuevo fifa 2020', 'Este aÃ±o sacaran de nuevo este videojuego que lleva triunfando aÃ±os', '2020-01-30 04:28:10'),
(78, 36, 1, 'Gran Proyecto', 'Muy buen proyecto', '2020-01-30 04:35:57'),
(79, 34, 3, 'RIP Kobe', 'Fuiste un grande, nunca te olvidaremos!!!', '2020-01-30 04:46:14'),
(80, 34, 1, 'Nueva tarjeta grÃ¡fica envidia', 'Va a salir dentro de poco', '2020-01-30 04:47:48'),
(81, 34, 4, 'Coronavirus Â¿QuÃ© es?', 'He escuchado algo en las noticias pero no se lo que es.', '2020-01-30 04:48:58'),
(82, 36, 5, 'Notas de php saldrÃ¡n en el 2021', 'Ya las tengo casi corregidas', '2020-01-30 04:53:28'),
(83, 33, 1, 'Tarjeta grÃ¡fica nvidia', 'Es una fake new. No estÃ¡ disponible', '2020-01-30 04:56:33'),
(84, 34, 1, 'Aprender php', 'Un video muy bueno!!', '2020-01-30 05:01:24'),
(85, 35, 3, 'Prox partido del betis', 'A ver si ganan, alguien sabe cuando es?', '2020-01-30 05:06:10'),
(86, 34, 5, 'He aprobado cÃ¡lculo', 'DespuÃ©s de tres aÃ±os aquÃ­ ya la he aprobado', '2020-01-30 05:07:48'),
(87, 33, 3, 'MaÃ±ana es dia de NBA', 'MaÃ±ana es dia de NBA y el cuerpo lo sabe.', '2020-01-30 05:09:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferencias`
--

CREATE TABLE `preferencias` (
  `id` int(32) NOT NULL,
  `id_usuario` int(32) NOT NULL,
  `modo_nocturno` tinyint(1) NOT NULL,
  `id_categoria_inicial` int(32) NOT NULL,
  `open_post_new_tab` tinyint(1) NOT NULL,
  `orden` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `preferencias`
--

INSERT INTO `preferencias` (`id`, `id_usuario`, `modo_nocturno`, `id_categoria_inicial`, `open_post_new_tab`, `orden`) VALUES
(30, 33, 0, 3, 0, 1),
(31, 34, 0, 1, 0, 1),
(32, 35, 0, 1, 1, 2),
(33, 36, 0, 2, 0, 1);

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
(42, 34, 77, 1),
(43, 36, 82, 1),
(44, 36, 77, 1),
(45, 36, 80, 1),
(46, 36, 81, 1),
(47, 33, 80, 0),
(48, 34, 80, 1),
(49, 34, 84, 1),
(53, 35, 81, 1),
(54, 33, 86, 1),
(55, 33, 78, 1),
(56, 34, 78, 1),
(57, 35, 78, 1);

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
(33, 0, 'carlos', 'Carlos Pumar', '$2y$10$k.MssM9kefJhaDTb/x7kU.vy98scGjOm.Dwgip3bMMgm6w1Pg7SG.', 'carlos@gmail.com'),
(34, 0, 'eugenio', 'Eugenio Menacho', '$2y$10$Ggg8ZnXdmd.s6hAKEi5riu3EohfTpuFwtJqT942UR/NzNUuWvmBCq', 'eugenio@gmail.com'),
(35, 0, 'barneto', 'Jose JoaquÃ­n Barneto', '$2y$10$IjEduLOOkMBGQG1Ci5nssOPGI6pbE0UQnzETxEk20vosPC0JYkZ0W', 'jose@gmail.com'),
(36, 1, 'barranco', 'Carlos Barranco', '$2y$10$k.MssM9kefJhaDTb/x7kU.vy98scGjOm.Dwgip3bMMgm6w1Pg7SG.', 'barranco@gmail.com');

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
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `preferencias`
--
ALTER TABLE `preferencias`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `reaccion`
--
ALTER TABLE `reaccion`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
