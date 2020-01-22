-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2020 a las 20:59:09
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
-- Base de datos: `programacionavanzada`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `id_usuario` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `id_post` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `texto` text COLLATE latin1_spanish_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_actualizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `id_usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `id_post` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_fichero` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `url` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `tipo` varchar(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `id_emisor` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `id_receptor` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_enviado` date NOT NULL,
  `fecha_recibido` date NOT NULL,
  `fecha_leido` date NOT NULL,
  `texto` text COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `id_categoria` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `texto` text COLLATE latin1_spanish_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_actualizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preferecias`
--

CREATE TABLE `preferecias` (
  `id_usuario` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `vista` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `modo_nocturno` tinyint(1) NOT NULL,
  `categoria_inicial` int(32) NOT NULL,
  `lenguaje_obsceno` tinyint(1) NOT NULL,
  `open_post_new_tab` tinyint(1) NOT NULL,
  `orden` varchar(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reaccion`
--

CREATE TABLE `reaccion` (
  `id` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `id_usuario` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `id_post` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `tipo` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre_usuario` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `contrasenya` varchar(32) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

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
  ADD UNIQUE KEY `id_post` (`id_post`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`),
  ADD UNIQUE KEY `id_post` (`id_post`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_emisor` (`id_emisor`),
  ADD UNIQUE KEY `id_receptor` (`id_receptor`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `preferecias`
--
ALTER TABLE `preferecias`
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `reaccion`
--
ALTER TABLE `reaccion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`),
  ADD UNIQUE KEY `id_post` (`id_post`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombre_usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`id`) REFERENCES `post` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD CONSTRAINT `galeria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `galeria_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preferecias`
--
ALTER TABLE `preferecias`
  ADD CONSTRAINT `preferecias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reaccion`
--
ALTER TABLE `reaccion`
  ADD CONSTRAINT `reaccion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reaccion_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`nombre_usuario`) REFERENCES `mensaje` (`id_emisor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
