-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2026 a las 18:04:14
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
-- Base de datos: `database_jose`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `documento` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`documento`, `nombre`, `correo`, `telefono`) VALUES
(1009890844, 'Maria Bermudez', 'Mafe@gmail.com', '3440955671'),
(1065581109, 'Jose Lopez', 'Joselopezpava0403@gmail.com', '3017880161'),
(1106234022, 'Samantha Lopez', 'Sammy@gmail.com', '3224445522'),
(1109226421, 'Yolima Pava', 'Yolima@gmail.com', '3505050505');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `documento` int(11) NOT NULL,
  `numero_vuelo` varchar(20) NOT NULL,
  `fecha_reserva` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `documento`, `numero_vuelo`, `fecha_reserva`) VALUES
(13, 1065581109, 'AV-777', '2026-08-25 10:45:19'),
(14, 1009890844, 'AV-444', '2026-08-25 10:45:30'),
(15, 1106234022, 'AV-308', '2026-08-25 10:45:35'),
(16, 1109226421, 'AV-307', '2026-08-25 10:45:40'),
(17, 1065581109, 'AV-308', '2026-08-25 10:56:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `numero_vuelo` varchar(20) NOT NULL,
  `aerolinea` varchar(80) NOT NULL,
  `origen` text NOT NULL,
  `destino` text NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `capacidad_maxima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`numero_vuelo`, `aerolinea`, `origen`, `destino`, `fecha_salida`, `precio`, `capacidad_maxima`) VALUES
('AV-307', 'Avianca', 'Bogota', 'Medellin', '2026-08-25 10:30:00', 145.50, 15),
('AV-308', 'Avianca', 'Medellin', 'Cancun', '2026-08-25 22:20:00', 100.00, 150),
('AV-444', 'Emirates', 'Miami', 'New York', '2026-08-27 07:30:00', 350.00, 50),
('AV-777', 'Airlines', 'Bora Bora', 'Dubai', '2026-08-31 10:45:00', 900.00, 200);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`documento`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `documento` (`documento`),
  ADD KEY `numero_vuelo` (`numero_vuelo`);

--
-- Indices de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`numero_vuelo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`documento`) REFERENCES `clientes` (`documento`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`numero_vuelo`) REFERENCES `vuelos` (`numero_vuelo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
