-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2024 a las 02:02:22
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
-- Base de datos: `concesionario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distribuidor`
--

CREATE TABLE `distribuidor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `telefono` bigint(252) NOT NULL,
  `empresa` varchar(200) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `distribuidor`
--

INSERT INTO `distribuidor` (`id`, `nombre`, `telefono`, `empresa`, `img`) VALUES
(1, 'Jose Jose', 2494851356, '  Ford', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSoI4Hr435V0778ITFEKfa2MeQRgk2CIZmopA&s'),
(2, 'Rigoberto Flores', 2494533658, 'Chevrolet', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoeWxH84WRv7vwMb-kHMhn_8TmjHxVBX20uw&s'),
(3, 'Roberto Rodriguez', 2494555553, 'Mercedes Benz', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyvyvoiR7h1eDs79XJsr_USVUuUVNiTP8crg&s'),
(6, ' manzana', 1214234345, ' garo', ' https://www.mercedes-fans.de/thumbs/img/News/76/95/01/p/p_full/mercedes-benz-auf-der-ces-2023-der-stern-praesentiert-neuigkeiten-zur-elektrifizierungsstrategie-19576.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `contrasenia` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasenia`) VALUES
(1, 'webadmin', '$2y$10$N0cPJxPjD2kU8PBt1HtwGO4A4JGL635BbK4vE6XxqVlb5WZn46yGW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `marca` varchar(250) NOT NULL,
  `modelo` varchar(250) NOT NULL,
  `año` int(11) NOT NULL,
  `puertas` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `id_distribuidor` int(11) NOT NULL,
  `categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `marca`, `modelo`, `año`, `puertas`, `hp`, `precio`, `id_distribuidor`, `categoria`) VALUES
(30, 'Honda', 'Civic', 2020, 4, 158, 22000, 1, 'Sedán'),
(32, 'Chevrolet', 'Silverado', 2022, 4, 355, 40000, 2, 'Camioneta'),
(33, 'BMW', 'X5', 2021, 5, 335, 60000, 2, 'SUV'),
(34, 'Audi', 'A4', 2018, 4, 252, 28000, 2, 'Sedán'),
(35, 'Mercedes-Benz', 'C-Class', 2019, 4, 255, 32000, 3, 'Sedán'),
(38, 'Volkswagen', 'Golf', 2017, 4, 170, 20000, 1, 'Hatchback'),
(41, 'Chevrolet', 'Corsa', 1221, 2, 2, 2, 1, 'lujo'),
(42, 'Toyota', 'Corolla', 2021, 4, 130, 20000, 1, 'Sedán'),
(43, 'Honda', 'Civic', 2020, 4, 158, 22000, 1, 'Sedán'),
(44, 'Ford', 'Mustang', 2019, 2, 450, 35000, 1, 'Deportivo'),
(45, 'Chevrolet', 'Silverado', 2022, 4, 355, 40000, 2, 'Camioneta'),
(46, 'BMW', 'X5', 2021, 5, 335, 60000, 2, 'SUV'),
(47, 'Audi', 'A4', 2018, 4, 252, 28000, 2, 'Sedán'),
(49, 'Tesla', 'Model 3', 2022, 4, 283, 45000, 3, 'Eléctrico'),
(50, 'Nissan', 'Leaf', 2021, 5, 147, 30000, 3, 'Eléctrico');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `distribuidor`
--
ALTER TABLE `distribuidor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distribuidor` (`id_distribuidor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `distribuidor`
--
ALTER TABLE `distribuidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`id_distribuidor`) REFERENCES `distribuidor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
