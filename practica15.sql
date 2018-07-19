-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 19, 2018 at 12:08 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practica15`
--

-- --------------------------------------------------------

--
-- Table structure for table `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`) VALUES
(2, 'Book'),
(3, 'PC'),
(4, 'Listening'),
(5, 'BOOK 2');

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
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
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`id`, `matricula`, `nombre`, `apellidos`, `id_carrera`, `id_grupo`, `imagen`) VALUES
(9, '1530039', 'Jose Antonio', 'Molina De la Fuente', 3, 2, 'model/uploads/4fd66ac4c49ae08c5d3afb06bed56a46.png'),
(11, '1530028', 'Sofia', 'Lopez', 3, 5, 'model/uploads/219f18ec5f7c05a1a8a919b15cabf54f.jpeg'),
(12, '1530061', 'Erick', 'Elizondo', 3, 2, 'model/uploads/e21ddca0341e25751cf21749635c62a7.png'),
(13, '1530073', 'Sergio Giovanny', 'Perez Picazo', 3, 5, 'model/uploads/85240d6c464a6550154472db5159f5b0.png');

-- --------------------------------------------------------

--
-- Table structure for table `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`) VALUES
(3, 'Ing. En Tecnologias de la Informacion'),
(4, 'Pymes'),
(5, 'Ing. En Mecatronica'),
(7, 'Ingenieria en Sistemas Automotrices'),
(8, 'Ing. En Manufactura');

-- --------------------------------------------------------

--
-- Table structure for table `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_maestro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `id_maestro`) VALUES
(2, 'INGLES II', 8),
(5, 'INGLES X', 9);

-- --------------------------------------------------------

--
-- Table structure for table `sesion_cai`
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
-- Dumping data for table `sesion_cai`
--

INSERT INTO `sesion_cai` (`id`, `hora`, `fecha`, `id_unidad`, `id_alumno`, `id_encargado`, `id_actividad`, `asistencia`) VALUES
(113, '00:14:16', '2018-07-19', 2, 9, 1, 2, 1),
(118, '02:03:57', '2018-07-19', 2, 11, 1, 2, 1),
(119, '02:04:30', '2018-07-19', 2, 12, 1, 2, 1),
(123, '03:02:12', '2018-07-19', 2, 11, 1, 2, 1),
(124, '03:07:30', '2018-07-19', 2, 9, 1, 2, 1),
(126, '04:00:05', '2018-07-19', 2, 9, 1, 2, 1),
(128, '05:00:07', '2018-07-19', 2, 12, 1, 2, 0),
(131, '05:05:15', '2018-07-19', 2, 9, 1, 2, 0),
(132, '05:05:45', '2018-07-19', 2, 11, 1, 2, 0),
(133, '05:06:44', '2018-07-19', 2, 13, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unidades`
--

INSERT INTO `unidades` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`) VALUES
(2, 'Unidad 1', '2018-07-09', '2018-07-31'),
(3, 'Unidad 3', '2018-07-31', '2018-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
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
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `codigo`, `nombre`, `apellidos`, `email`, `password`, `tipo`) VALUES
(1, 'admin', 'Mario', 'Rodriguez', 'mario@gmail.com', 'admin', 'superadmin'),
(8, 'urbiola123', 'Alfredo', 'Urbiola', 'alfredo@gmail.com', 'urbiola123', 'encargado'),
(9, 'yuri123', 'Yuridia', 'Montelongo', 'yuri@gmail.com', 'yuri123', 'teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indexes for table `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_maestro` (`id_maestro`);

--
-- Indexes for table `sesion_cai`
--
ALTER TABLE `sesion_cai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_unidad` (`id_unidad`),
  ADD KEY `id_encargado` (`id_encargado`),
  ADD KEY `id_actividad` (`id_actividad`);

--
-- Indexes for table `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sesion_cai`
--
ALTER TABLE `sesion_cai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`id_maestro`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sesion_cai`
--
ALTER TABLE `sesion_cai`
  ADD CONSTRAINT `sesion_cai_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sesion_cai_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `unidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sesion_cai_ibfk_3` FOREIGN KEY (`id_encargado`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sesion_cai_ibfk_4` FOREIGN KEY (`id_actividad`) REFERENCES `actividades` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
