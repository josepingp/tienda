-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-05-2024 a las 21:23:49
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
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name1` varchar(255) NOT NULL,
  `last_name2` varchar(255) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `birth_date` date NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `date_registered` datetime NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `card_number` varchar(100) DEFAULT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name1`, `last_name2`, `email`, `birth_date`, `phone`, `date_registered`, `photo_url`, `password`, `card_number`, `role_id`) VALUES
(1, 'Juan', 'Pérez', 'García', 'juan.perez@example.com', '1990-01-15', '123456789', '2024-05-25 12:00:00', NULL, 'password123', NULL, 1),
(2, 'María', 'López', 'Martínez', 'maria.lopez@example.com', '1985-03-22', '234567890', '2024-05-25 12:01:00', NULL, 'password123', NULL, 2),
(3, 'Carlos', 'Sánchez', 'Rodríguez', 'carlos.sanchez@example.com', '1992-07-19', '345678901', '2024-05-25 12:02:00', NULL, 'password123', NULL, 1),
(4, 'Ana', 'González', 'Hernández', 'ana.gonzalez@example.com', '1988-11-30', '456789012', '2024-05-25 12:03:00', NULL, 'password123', NULL, 2),
(5, 'Luis', 'Ramírez', 'López', 'luis.ramirez@example.com', '1995-06-10', '567890123', '2024-05-25 12:04:00', NULL, 'password123', NULL, 1),
(6, 'Laura', 'Fernández', 'Sánchez', 'laura.fernandez@example.com', '1993-02-27', '678901234', '2024-05-25 12:05:00', NULL, 'password123', NULL, 2),
(7, 'David', 'Martínez', 'Ramírez', 'david.martinez@example.com', '1987-09-15', '789012345', '2024-05-25 12:06:00', NULL, 'password123', NULL, 1),
(8, 'Marta', 'Hernández', 'Pérez', 'marta.hernandez@example.com', '1991-04-05', '890123456', '2024-05-25 12:07:00', NULL, 'password123', NULL, 2),
(9, 'Jorge', 'García', 'Martínez', 'jorge.garcia@example.com', '1990-12-25', '901234567', '2024-05-25 12:08:00', NULL, 'password123', NULL, 1),
(10, 'Sara', 'López', 'Sánchez', 'sara.lopez@example.com', '1989-08-18', '012345678', '2024-05-25 12:09:00', NULL, 'password123', NULL, 2),
(11, 'Pablo', 'Rodríguez', 'González', 'pablo.rodriguez@example.com', '1994-03-13', '123456789', '2024-05-25 12:10:00', NULL, 'password123', NULL, 1),
(12, 'Elena', 'García', 'Fernández', 'elena.garcia@example.com', '1992-05-28', '234567890', '2024-05-25 12:11:00', NULL, 'password123', NULL, 2),
(13, 'Raúl', 'Martínez', 'López', 'raul.martinez@example.com', '1986-10-02', '345678901', '2024-05-25 12:12:00', NULL, 'password123', NULL, 1),
(14, 'Clara', 'Ramírez', 'Sánchez', 'clara.ramirez@example.com', '1993-07-17', '456789012', '2024-05-25 12:13:00', NULL, 'password123', NULL, 2),
(15, 'Víctor', 'Fernández', 'Rodríguez', 'victor.fernandez@example.com', '1991-01-09', '567890123', '2024-05-25 12:14:00', NULL, 'password123', NULL, 1),
(16, 'Paula', 'Sánchez', 'García', 'paula.sanchez@example.com', '1988-04-24', '678901234', '2024-05-25 12:15:00', NULL, 'password123', NULL, 2),
(17, 'Sergio', 'López', 'Martínez', 'sergio.lopez@example.com', '1995-09-13', '789012345', '2024-05-25 12:16:00', NULL, 'password123', NULL, 1),
(18, 'Natalia', 'Rodríguez', 'Hernández', 'natalia.rodriguez@example.com', '1990-06-19', '890123456', '2024-05-25 12:17:00', NULL, 'password123', NULL, 2),
(19, 'Andrés', 'González', 'López', 'andres.gonzalez@example.com', '1987-12-08', '901234567', '2024-05-25 12:18:00', NULL, 'password123', NULL, 1),
(20, 'Beatriz', 'Hernández', 'Fernández', 'beatriz.hernandez@example.com', '1992-08-23', '012345678', '2024-05-25 12:19:00', NULL, 'password123', NULL, 2),
(21, 'Ricardo', 'Ramírez', 'Martínez', 'ricardo.ramirez@example.com', '1993-11-05', '123456789', '2024-05-25 12:20:00', NULL, 'password123', NULL, 1),
(22, 'Silvia', 'López', 'García', 'silvia.lopez@example.com', '1989-02-13', '234567890', '2024-05-25 12:21:00', NULL, 'password123', NULL, 2),
(23, 'Fernando', 'Sánchez', 'Ramírez', 'fernando.sanchez@example.com', '1991-09-30', '345678901', '2024-05-25 12:22:00', NULL, 'password123', NULL, 1),
(24, 'Lucía', 'García', 'Hernández', 'lucia.garcia@example.com', '1994-04-27', '456789012', '2024-05-25 12:23:00', NULL, 'password123', NULL, 2),
(25, 'Manuel', 'Rodríguez', 'Fernández', 'manuel.rodriguez@example.com', '1986-07-22', '567890123', '2024-05-25 12:24:00', NULL, 'password123', NULL, 1),
(26, 'Rosa', 'Martínez', 'González', 'rosa.martinez@example.com', '1993-05-10', '678901234', '2024-05-25 12:25:00', NULL, 'password123', NULL, 2),
(27, 'Ángel', 'López', 'Rodríguez', 'angel.lopez@example.com', '1990-11-18', '789012345', '2024-05-25 12:26:00', NULL, 'password123', NULL, 1),
(28, 'Eva', 'Fernández', 'García', 'eva.fernandez@example.com', '1988-01-25', '890123456', '2024-05-25 12:27:00', NULL, 'password123', NULL, 2),
(29, 'Miguel', 'Sánchez', 'Martínez', 'miguel.sanchez@example.com', '1987-06-14', '901234567', '2024-05-25 12:28:00', NULL, 'password123', NULL, 1),
(30, 'Patricia', 'García', 'López', 'patricia.garcia@example.com', '1995-10-07', '012345678', '2024-05-25 12:29:00', NULL, 'password123', NULL, 2),
(31, 'Antonio', 'Ramírez', 'Fernández', 'antonio.ramirez@example.com', '1992-03-11', '123456789', '2024-05-25 12:30:00', NULL, 'password123', NULL, 1),
(32, 'Isabel', 'Martínez', 'Hernández', 'isabel.martinez@example.com', '1993-08-26', '234567890', '2024-05-25 12:31:00', NULL, 'password123', NULL, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_rol` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
