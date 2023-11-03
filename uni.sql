-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2023 a las 15:10:04
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
-- Base de datos: `uni`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `clases_registradas` varchar(150) NOT NULL,
  `apellidos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `clases_registradas`, `apellidos`) VALUES
(1, 'Juan', 'Matemáticas', 'poso segundo'),
(2, 'José', 'Lenguaje', 'Palomino'),
(3, 'Angel Gabriel', 'Matemáticas', 'Tenor'),
(11, 'Josias ', 'Inglés', 'maya'),
(12, 'Pepe', 'Programación', 'Lopez'),
(13, 'Esteban ', 'Matemáticas', 'Ramirez'),
(14, 'Meme', 'Computación', 'Neón');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_clases`
--

CREATE TABLE `alumnos_clases` (
  `id` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos_clases`
--

INSERT INTO `alumnos_clases` (`id`, `id_alumno`, `id_clase`) VALUES
(4, 3, 2),
(6, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_materias`
--

CREATE TABLE `alumnos_materias` (
  `am_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `mensaje` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos_materias`
--

INSERT INTO `alumnos_materias` (`am_id`, `alumno_id`, `materia_id`, `calificacion`, `mensaje`) VALUES
(3, 5, 1, NULL, NULL),
(4, 5, 3, NULL, NULL),
(5, 5, 4, NULL, NULL),
(6, 5, 5, NULL, NULL),
(7, 5, 3, NULL, NULL),
(13, 5, 3, NULL, NULL),
(14, 5, 2, NULL, NULL),
(3, 5, 1, NULL, NULL),
(4, 5, 3, NULL, NULL),
(5, 5, 4, NULL, NULL),
(6, 5, 5, NULL, NULL),
(7, 5, 3, NULL, NULL),
(13, 5, 3, NULL, NULL),
(14, 5, 2, NULL, NULL),
(0, 4, 2, NULL, NULL),
(0, 4, 12, NULL, NULL),
(0, 4, 4, NULL, NULL),
(0, 4, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `nombre`) VALUES
(1, 'Matematicas'),
(2, 'Lenguaje'),
(3, 'Ciencias'),
(4, 'Quimica'),
(5, 'Algebra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases_maestros`
--

CREATE TABLE `clases_maestros` (
  `id` int(11) NOT NULL,
  `clase_id` int(11) DEFAULT NULL,
  `maestro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros`
--

CREATE TABLE `maestros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `clases_asignadas` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros`
--

INSERT INTO `maestros` (`id`, `nombre`, `clases_asignadas`) VALUES
(1, 'Hernesto murillas', 'Matemáticas'),
(2, 'Juan segundo', 'Química III'),
(3, 'Jorge Reyes', 'Programacion'),
(4, 'Anderson Lumbreras', 'Geometria'),
(7, 'hernan contreras', 'programacion'),
(10, 'Ronaald Suares', 'Geografia'),
(11, 'Pool Casinagua', 'Geometria'),
(13, 'Rosa Flores', 'Religión ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros_alumnos`
--

CREATE TABLE `maestros_alumnos` (
  `id` int(11) NOT NULL,
  `maestro_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros_alumnos`
--

INSERT INTO `maestros_alumnos` (`id`, `maestro_id`, `alumno_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(6, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros_cursos`
--

CREATE TABLE `maestros_cursos` (
  `id` int(11) NOT NULL,
  `id_maestro` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros_cursos`
--

INSERT INTO `maestros_cursos` (`id`, `id_maestro`, `id_curso`) VALUES
(1, 1, 1),
(8, 1, 2),
(9, 2, 1),
(10, 2, 3),
(11, 2, 3),
(12, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestros_materias`
--

CREATE TABLE `maestros_materias` (
  `id` int(11) NOT NULL,
  `maestro_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maestros_materias`
--

INSERT INTO `maestros_materias` (`id`, `maestro_id`, `materia_id`) VALUES
(1, 4, 1),
(2, 3, 2),
(3, 1, 3),
(4, 2, 4),
(6, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `materia_id` int(11) NOT NULL,
  `materia_nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`materia_id`, `materia_nombre`) VALUES
(1, 'Matemáticas'),
(2, 'Lenguaje'),
(3, 'Astronomia ii'),
(4, 'Programación'),
(7, 'El nuevo testamento'),
(8, 'antiguo testamento'),
(10, 'The book of mormon'),
(12, 'Python 3'),
(14, 'Informática'),
(16, 'Estadística i'),
(17, 'Estadística 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`role_id`, `role_nombre`) VALUES
(3, 'admin'),
(4, 'maestro'),
(5, 'alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `rol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `role_id`, `correo`, `contrasena`, `rol`) VALUES
(3, 'Alberto rodriguez', 3, 'admin@admin', '$2y$10$TLQteAgfzLoobefhULmLpO/A95bdMB1ywXasSXU3s0YfnwybzF9IK', 'admin'),
(4, 'Mariano luna', 4, 'maestro@maestro', '$2y$10$viqJIPid/tu56aHPVLDtZue9PadC9meFGjIvOeBEwyKhkyTWuQlRm', 'maestro'),
(5, 'Rafael angel', 5, 'alumno@alumno', '$2y$10$Tbl.6BaJb29JK86sMyawBuPEAzeokPJhSVAC.XjHINZh5CMCRBwzC', 'alumno');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `alumnos_clases`
--
ALTER TABLE `alumnos_clases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_clase` (`id_clase`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clases_maestros`
--
ALTER TABLE `clases_maestros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clase_id` (`clase_id`),
  ADD KEY `maestro_id` (`maestro_id`);

--
-- Indices de la tabla `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maestros_alumnos`
--
ALTER TABLE `maestros_alumnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maestro_id` (`maestro_id`),
  ADD KEY `alumno_id` (`alumno_id`);

--
-- Indices de la tabla `maestros_cursos`
--
ALTER TABLE `maestros_cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_maestro` (`id_maestro`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `maestros_materias`
--
ALTER TABLE `maestros_materias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maestro_id` (`maestro_id`),
  ADD KEY `materia_id` (`materia_id`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`materia_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `alumnos_clases`
--
ALTER TABLE `alumnos_clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clases_maestros`
--
ALTER TABLE `clases_maestros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `maestros`
--
ALTER TABLE `maestros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `maestros_alumnos`
--
ALTER TABLE `maestros_alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `maestros_cursos`
--
ALTER TABLE `maestros_cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `maestros_materias`
--
ALTER TABLE `maestros_materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `materia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos_clases`
--
ALTER TABLE `alumnos_clases`
  ADD CONSTRAINT `alumnos_clases_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`),
  ADD CONSTRAINT `alumnos_clases_ibfk_2` FOREIGN KEY (`id_clase`) REFERENCES `materias` (`materia_id`);

--
-- Filtros para la tabla `clases_maestros`
--
ALTER TABLE `clases_maestros`
  ADD CONSTRAINT `clases_maestros_ibfk_1` FOREIGN KEY (`clase_id`) REFERENCES `clases` (`id`),
  ADD CONSTRAINT `clases_maestros_ibfk_2` FOREIGN KEY (`maestro_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `maestros_alumnos`
--
ALTER TABLE `maestros_alumnos`
  ADD CONSTRAINT `maestros_alumnos_ibfk_1` FOREIGN KEY (`maestro_id`) REFERENCES `maestros` (`id`),
  ADD CONSTRAINT `maestros_alumnos_ibfk_2` FOREIGN KEY (`alumno_id`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `maestros_cursos`
--
ALTER TABLE `maestros_cursos`
  ADD CONSTRAINT `maestros_cursos_ibfk_1` FOREIGN KEY (`id_maestro`) REFERENCES `maestros` (`id`),
  ADD CONSTRAINT `maestros_cursos_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `materias` (`materia_id`);

--
-- Filtros para la tabla `maestros_materias`
--
ALTER TABLE `maestros_materias`
  ADD CONSTRAINT `maestros_materias_ibfk_1` FOREIGN KEY (`maestro_id`) REFERENCES `maestros` (`id`),
  ADD CONSTRAINT `maestros_materias_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
