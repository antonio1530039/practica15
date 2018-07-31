-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-07-2018 a las 16:13:38
-- Versión del servidor: 5.7.23-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica15`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`) VALUES
(2, 'Book'),
(3, 'PC'),
(4, 'Listening'),
(5, 'BOOK 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `matricula` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `imagen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `matricula`, `nombre`, `apellidos`, `id_carrera`, `id_grupo`, `imagen`) VALUES
(9, '1530039', 'Jose Antonio', 'Molina De la Fuente', 3, 2, 'model/uploads/4fd66ac4c49ae08c5d3afb06bed56a46.png'),
(11, '1530028', 'Sofia', 'Lopez', 3, 5, 'model/uploads/219f18ec5f7c05a1a8a919b15cabf54f.jpeg'),
(12, '1530061', 'Erick', 'Elizondo', 3, 2, 'model/uploads/e21ddca0341e25751cf21749635c62a7.png'),
(13, '1530073', 'Sergio Giovanny', 'Perez Picazo', 3, 5, 'model/uploads/85240d6c464a6550154472db5159f5b0.png'),
(14, '8281923', 'Alumno', 'De Prueba', 9, 6, 'model/uploads/14676e710d48ba88088cf68e3b667717.JPG'),
(15, '82828', 'OtroAlumno', 'Prueba', 4, 6, 'model/uploads/a9ea3f4dd1100916b7c79aa2b80f5e72.png'),
(16, '12300123', 'Pepe', 'Armendariz', 10, 5, 'model/uploads/e23c0297fb6d1b57db8a1229b644e3b9.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`) VALUES
(3, 'Ing. En Tecnologias de la Informacion'),
(4, 'Pymes'),
(5, 'Ing. En Mecatronica'),
(7, 'Ingenieria en Sistemas Automotrices'),
(8, 'Ing. En Manufactura'),
(9, 'Aduanas'),
(10, 'ISA 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_maestro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `id_maestro`) VALUES
(2, 'INGLES II', 8),
(5, 'INGLES X', 9),
(6, 'INGLEX V', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion_cai`
--

CREATE TABLE `sesion_cai` (
  `id` int(11) NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_encargado` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `asistencia` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sesion_cai`
--

INSERT INTO `sesion_cai` (`id`, `hora`, `fecha`, `id_unidad`, `id_alumno`, `id_encargado`, `id_actividad`, `asistencia`) VALUES
(113, '00:14:16', '2018-07-19', 2, 9, 1, 2, 1),
(118, '02:03:57', '2018-07-19', 2, 11, 1, 2, 1),
(119, '02:04:30', '2018-07-19', 2, 12, 1, 2, 1),
(123, '03:02:12', '2018-07-19', 2, 11, 1, 2, 1),
(124, '03:07:30', '2018-07-19', 2, 9, 1, 2, 1),
(126, '04:00:05', '2018-07-19', 2, 9, 1, 2, 1),
(134, '03:03:31', '2018-07-19', 2, 9, 1, 3, 1),
(135, '20:08:39', '2018-07-30', 2, 13, 1, 2, 0),
(136, '20:09:28', '2018-07-30', 2, 12, 1, 2, 0),
(137, '20:09:35', '2018-07-30', 2, 9, 1, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`) VALUES
(2, 'Unidad 1', '2018-07-09', '2018-07-31'),
(3, 'Unidad 3', '2018-07-31', '2018-08-08'),
(4, 'Unidad 2', '2018-07-20', '2018-07-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `codigo` varchar(300) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `codigo`, `nombre`, `apellidos`, `email`, `password`, `tipo`) VALUES
(1, 'admin', 'Mario', 'Rodriguez', 'mario@gmail.com', 'admin', 'superadmin'),
(8, 'urbiola123', 'Alfredo', 'Urbiola', 'alfredo@gmail.com', 'urbiola123', 'encargado'),
(9, 'yuri123', 'Yuridia', 'Montelongo', 'yuri@gmail.com', 'yuri123', 'teacher'),
(11, '123456789', 'Profesor', 'de prueba', 'profesor@gmail.com', '123456789', 'teacher');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_maestro` (`id_maestro`);

--
-- Indices de la tabla `sesion_cai`
--
ALTER TABLE `sesion_cai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_unidad` (`id_unidad`),
  ADD KEY `id_encargado` (`id_encargado`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `sesion_cai`
--
ALTER TABLE `sesion_cai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`id_maestro`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sesion_cai`
--
ALTER TABLE `sesion_cai`
  ADD CONSTRAINT `sesion_cai_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sesion_cai_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `unidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sesion_cai_ibfk_3` FOREIGN KEY (`id_encargado`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sesion_cai_ibfk_4` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
