-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-08-2024 a las 23:02:07
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pqrs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `usuario`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id_archivo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo_archivo` varchar(255) DEFAULT NULL,
  `tamaño` int(11) DEFAULT NULL,
  `contenido` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `cargo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `cargo`) VALUES
(1, 'Estudiante'),
(2, 'Acudiente'),
(3, 'Docente'),
(4, 'Egresado'),
(5, 'Profesional de apoyo'),
(6, 'Auxiliar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`) VALUES
(1, 'Pendiente'),
(2, 'En proceso'),
(3, 'Respondido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqrss`
--

CREATE TABLE `pqrss` (
  `id_solicitud` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  `numero_doc` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cargo` int(11) NOT NULL,
  `tipo_pqrs` int(11) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `id_archivo` int(11) DEFAULT NULL,
  `fecha_cre` date NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_doc`
--

CREATE TABLE `tipos_doc` (
  `id_documento` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_doc`
--

INSERT INTO `tipos_doc` (`id_documento`, `tipo`) VALUES
(1, 'CC'),
(2, 'TI'),
(3, 'PPT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_pqrs`
--

CREATE TABLE `tipos_pqrs` (
  `id_tipopqrs` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_pqrs`
--

INSERT INTO `tipos_pqrs` (`id_tipopqrs`, `tipo`) VALUES
(1, 'Petición'),
(2, 'Queja'),
(3, 'Reclamo'),
(4, 'Sugerencia'),
(5, 'Felicitación');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `pqrss`
--
ALTER TABLE `pqrss`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `tipo_documento` (`tipo_documento`),
  ADD KEY `cargo` (`cargo`),
  ADD KEY `tipo_pqrs` (`tipo_pqrs`),
  ADD KEY `id_archivo` (`id_archivo`),
  ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `tipos_doc`
--
ALTER TABLE `tipos_doc`
  ADD PRIMARY KEY (`id_documento`);

--
-- Indices de la tabla `tipos_pqrs`
--
ALTER TABLE `tipos_pqrs`
  ADD PRIMARY KEY (`id_tipopqrs`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pqrss`
--
ALTER TABLE `pqrss`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pqrss`
--
ALTER TABLE `pqrss`
  ADD CONSTRAINT `pqrss_ibfk_1` FOREIGN KEY (`tipo_documento`) REFERENCES `tipos_doc` (`id_documento`),
  ADD CONSTRAINT `pqrss_ibfk_2` FOREIGN KEY (`cargo`) REFERENCES `cargos` (`id_cargo`),
  ADD CONSTRAINT `pqrss_ibfk_3` FOREIGN KEY (`tipo_pqrs`) REFERENCES `tipos_pqrs` (`id_tipopqrs`),
  ADD CONSTRAINT `pqrss_ibfk_4` FOREIGN KEY (`id_archivo`) REFERENCES `archivos` (`id_archivo`),
  ADD CONSTRAINT `pqrss_ibfk_5` FOREIGN KEY (`estado`) REFERENCES `estado` (`id_estado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
