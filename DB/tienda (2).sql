-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-05-2024 a las 21:25:32
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
CREATE DATABASE IF NOT EXISTS `tienda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tienda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `category_name` varchar(70) NOT NULL,
  `category_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `order_code` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_total_amount` decimal(10,2) NOT NULL,
  `payment_method_id` int(10) NOT NULL,
  `status_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int(10) NOT NULL,
  `status_name` varchar(70) NOT NULL,
  `status_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `status_name`, `status_description`) VALUES
(1, 'Pendiente', 'El pedido ha sido recibido, pero aún no se ha procesado.'),
(2, 'En proceso', 'El pedido está siendo procesado.'),
(3, 'Esperando envío', 'El pedido está esperando ser enviado.'),
(4, 'Enviado', 'El pedido ha sido enviado al cliente.'),
(5, 'Entregado', 'El pedido ha sido entregado al cliente.'),
(7, 'Esperando recogida', 'El pedido está listo para ser recogido por el cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) NOT NULL,
  `method_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_name`) VALUES
(1, 'Tarjeta de Crédito'),
(2, 'Contra Reembolso'),
(3, 'PayPal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photos`
--

CREATE TABLE `photos` (
  `id` int(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Customer'),
(3, 'Guest'),
(4, 'Manager');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` int(10) NOT NULL,
  `street` varchar(255) NOT NULL,
  `number` int(10) NOT NULL,
  `floor` int(10) DEFAULT NULL,
  `apartment` varchar(10) DEFAULT NULL,
  `postal_code` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `user_id` int(10) NOT NULL,
  `ia_main` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) NOT NULL,
  `supplier_name` varchar(70) NOT NULL,
  `supplier_logo` varchar(150) DEFAULT NULL,
  `supplier_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indices de la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code_name` (`product_code`,`name`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `supplier_product` (`supplier_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indices de la tabla `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_name` (`supplier_name`);

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
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `payment_method_orders` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `status_order` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`),
  ADD CONSTRAINT `user_orders` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_order_details` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `product_order` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `product_photo` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `supplier_product` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Filtros para la tabla `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD CONSTRAINT `user_address` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_rol` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
