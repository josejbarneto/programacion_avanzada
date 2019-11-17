-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2019 a las 18:20:14
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
-- Base de datos: `p2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conexiones`
--

CREATE TABLE `conexiones` (
  `id_aerolinea` int(11) NOT NULL,
  `origen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `destino` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tiempo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `conexiones`
--

INSERT INTO `conexiones` (`id_aerolinea`, `origen`, `destino`, `tiempo`) VALUES
(1, 'Barcelona', 'Amsterdam', '08:00'),
(1, 'Barcelona', 'Sevilla', '09:00'),
(1, 'Amsterdam', 'Sevilla', '03:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conexiones`
--
ALTER TABLE `conexiones`
  ADD KEY `id_aerolinea` (`id_aerolinea`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conexiones`
--
ALTER TABLE `conexiones`
  ADD CONSTRAINT `conexiones_ibfk_1` FOREIGN KEY (`id_aerolinea`) REFERENCES `aerolineas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
