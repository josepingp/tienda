-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-06-2024 a las 21:43:35
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
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `category_name` varchar(70) NOT NULL,
  `category_description` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`, `photo`) VALUES
(1, 'Ropa', 'Las mejores prendas para la practica de tuas actividades favoritas', NULL),
(2, 'Zafus', 'Las mejores prendas para la practica de tuas actividades favoritas', NULL),
(3, 'Esterillas', 'Las mejores prendas para la practica de tuas actividades favoritas', NULL),
(4, 'Mantas', 'Las mejores prendas para la practica de tuas actividades favoritas', NULL),
(5, 'Accesorios', 'Las mejores prendas para la practica de tuas actividades favoritas', NULL),
(6, 'Meditacion', 'Las mejores prendas para la practica de tuas actividades favoritas', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `order_code` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `shipping_address_id` int(10) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_total_amount` decimal(10,2) NOT NULL,
  `payment_method_id` int(10) NOT NULL,
  `status_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `shipping_address_id`, `order_date`, `order_total_amount`, `payment_method_id`, `status_id`) VALUES
(1, '1', 71, 1, '2024-06-20 13:55:22', 105.00, 3, 1),
(2, '2', 71, 1, '2024-06-20 14:01:02', 105.00, 3, 1),
(3, '3', 71, 1, '2024-06-20 14:03:28', 105.00, 3, 1),
(4, '4', 71, 1, '2024-06-20 15:10:48', 105.00, 3, 1),
(5, '5', 71, 1, '2024-06-20 15:12:41', 105.00, 3, 1),
(6, '6', 71, 1, '2024-06-20 15:13:01', 105.00, 1, 1),
(7, '7', 70, 4, '2024-06-20 18:23:35', 34.00, 3, 1),
(8, '8', 70, 5, '2024-06-20 18:24:46', 34.00, 3, 1),
(9, '9', 70, 4, '2024-06-20 18:25:05', 34.00, 3, 1),
(10, '10', 70, 4, '2024-06-20 18:29:55', 34.00, 3, 1),
(11, '11', 70, 4, '2024-06-20 18:31:00', 34.00, 3, 1),
(12, '12', 91, 6, '2024-06-20 19:16:41', 57.00, 3, 1),
(13, '13', 93, 7, '2024-06-20 19:17:52', 57.00, 3, 1),
(14, '14', 97, 8, '2024-06-20 19:25:25', 57.00, 3, 1),
(15, '15', 99, 9, '2024-06-20 19:26:27', 57.00, 3, 1),
(16, '16', 101, 10, '2024-06-20 20:16:55', 57.00, 3, 1),
(17, '17', 102, 11, '2024-06-20 20:19:09', 57.00, 3, 1);

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

--
-- Volcado de datos para la tabla `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `total_price`) VALUES
(1, 3, 75, 1, 45.95, 45.95),
(2, 3, 76, 1, 60.50, 60.50),
(3, 4, 75, 1, 45.95, 45.95),
(4, 4, 76, 1, 60.50, 60.50),
(5, 5, 75, 1, 45.95, 45.95),
(6, 5, 76, 1, 60.50, 60.50),
(7, 6, 75, 1, 45.95, 45.95),
(8, 6, 76, 1, 60.50, 60.50),
(9, 7, 60, 1, 19.00, 19.00),
(10, 7, 65, 1, 15.00, 15.00),
(11, 8, 60, 1, 19.00, 19.00),
(12, 8, 65, 1, 15.00, 15.00),
(13, 9, 60, 1, 19.00, 19.00),
(14, 9, 65, 1, 15.00, 15.00),
(15, 10, 60, 1, 19.00, 19.00),
(16, 10, 65, 1, 15.00, 15.00),
(17, 11, 60, 1, 19.00, 19.00),
(18, 11, 65, 1, 15.00, 15.00),
(19, 12, 59, 1, 30.99, 30.99),
(20, 12, 64, 1, 12.90, 12.90),
(21, 12, 65, 1, 15.00, 15.00),
(22, 13, 59, 1, 30.99, 30.99),
(23, 13, 64, 1, 12.90, 12.90),
(24, 13, 65, 1, 15.00, 15.00),
(25, 14, 59, 1, 30.99, 30.99),
(26, 14, 64, 1, 12.90, 12.90),
(27, 14, 65, 1, 15.00, 15.00),
(28, 15, 59, 1, 30.99, 30.99),
(29, 15, 64, 1, 12.90, 12.90),
(30, 15, 65, 1, 15.00, 15.00),
(31, 16, 59, 1, 30.99, 30.99),
(32, 16, 64, 1, 12.90, 12.90),
(33, 16, 65, 1, 15.00, 15.00),
(34, 17, 59, 1, 30.99, 30.99),
(35, 17, 64, 1, 12.90, 12.90),
(36, 17, 65, 1, 15.00, 15.00);

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

--
-- Volcado de datos para la tabla `photos`
--

INSERT INTO `photos` (`id`, `url`, `is_main`, `product_id`) VALUES
(19, 'Bt40112024.06.14174035.jpeg', 1, 58),
(20, 'Bt40132024.06.14174035.jpeg', 0, 58),
(21, 'Bt40142024.06.14174035.jpeg', 0, 58),
(22, 'S50112024.06.14174232.png', 1, 59),
(23, 'S50132024.06.14174232.png', 0, 59),
(24, 'B60112024.06.14174735.jpeg', 1, 60),
(25, 'B60132024.06.14174735.jpeg', 0, 60),
(26, 'B60142024.06.14174735.jpeg', 0, 60),
(27, 'Z10312024.06.14175038.png', 1, 61),
(28, 'Z10322024.06.14175038.jpeg', 0, 61),
(29, 'Z10332024.06.14175038.jpeg', 0, 61),
(30, 'Z10342024.06.14175038.jpeg', 0, 61),
(31, 'E70112024.06.14175253.png', 1, 62),
(32, 'E70122024.06.14175253.png', 0, 62),
(33, 'E70132024.06.14175253.png', 0, 62),
(34, 'E70142024.06.14175253.png', 0, 62),
(35, 'E70212024.06.14175451.png', 1, 63),
(36, 'E70232024.06.14175451.jpeg', 0, 63),
(37, 'E70242024.06.14175451.png', 0, 63),
(38, 'Bl30212024.06.14175854.png', 1, 64),
(39, 'Bl30222024.06.14175854.png', 0, 64),
(40, 'Bl30232024.06.14175854.jpeg', 0, 64),
(41, 'BL30112024.06.14180001.png', 1, 65),
(42, 'BL30132024.06.14180001.png', 0, 65),
(43, 'B20112024.06.14180145.png', 1, 66),
(44, 'B20132024.06.14180145.png', 0, 66),
(45, 'B20142024.06.14180145.png', 0, 66),
(50, 'Z10232024.06.14182401.png', 0, 71),
(51, 'Z10112024.06.14182639.jpeg', 0, 72),
(52, 'Z10132024.06.14182639.jpeg', 1, 72),
(53, 'C80112024.06.14182834.jpeg', 1, 73),
(54, 'C80122024.06.14182834.jpeg', 0, 73),
(55, 'C80132024.06.14182834.jpeg', 0, 73),
(56, 'A80212024.06.14183100.jpeg', 1, 74),
(57, 'A80222024.06.14183100.jpeg', 0, 74),
(58, 'A80232024.06.14183100.jpeg', 0, 74),
(59, 'R90112024.06.14183323.jpeg', 1, 75),
(60, 'R90132024.06.14183323.jpeg', 0, 75),
(61, 'R90212024.06.14183500.jpeg', 1, 76),
(62, 'R90232024.06.14183500.jpeg', 0, 76);

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
  `supplier_id` int(11) NOT NULL,
  `is_outstanding` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `product_code`, `name`, `description`, `price`, `stock`, `category_id`, `supplier_id`, `is_outstanding`) VALUES
(58, 'Bt401', 'Bolster de lino', 'Los Bolsters de lino organico de alta calida están diseñados específicamente para la práctica de yoga, ya que brindan un soporte estable. El Round Yoga Bolster se usa para apoyar la columna vertebral y la cabeza cuando se usa en algunas posturas de yoga y meditación.\r\nEstá lleno de cáscaras de trigo sarraceno orgánico que brindan un soporte firme que se amolda a la forma de su cuerpo y no se descompondrá con el tiempo. La funda del interior es 100% algodón, con cremallera, lavable a máquina y relleno de trigo sarraceno orgánico', 69.95, 7, 2, 5, 0),
(59, 'S501', 'Bolsa para esterilla Nana', 'Bolsa de esterilla de yoga de gran resistencia hecha de lona. (100% algodón). Es suficientemente grande para llevar casi cualquier esterilla.', 30.99, 12, 5, 6, 0),
(60, 'B601', 'Botella Om', 'Todas las botellas OmWater  son elaboradas íntegramente en España con vidrio 100% reciclado siguiendo métodos tradicionales que no contaminan el medio ambiente. Además, comprando la botella estás ayudando a financiar el proyecto OmWater. Diseñada usando proporciones basadas en geometría sagrada.', 19.00, 25, 5, 5, 1),
(61, 'Z103', 'Zafu Zen', 'El cojín para sentarse es ideal para la meditación zen. Se utiliza idealmente para posturas de meditación de loto o medio loto y es el tamaño de cojín más utilizable que soportará una variedad de posturas diferentes.\r\nHay una cremallera que le permite quitar la cubierta exterior de la almohadilla de relleno interior para permitir que el usuario agregue más relleno para ajustar el loft o la suavidad, lo que más le convenga.\r\nNuestro cojín es plegado para mayor durabilidad y está lleno de cascos orgánicos de trigo de pantano. El cojín tiene un mango útil para facilitar el transporte.', 60.90, 9, 2, 6, 0),
(62, 'E701', 'Esterilla Gaia', 'Nuestra esterilla de yoga Gaia tiene un grosor de 4 mm y cuenta con una superficie texturizada \"pegajosa\" para mantenerlo en su lugar durante las posturas más desafiantes. Hecha con cloruro de polivinilo .\r\nEs duradero, no tóxico y está hecho de PVC sin látex que no contiene los seis ftalatos más dañinos. Libre de ftalatos DEHP, DBP, BBP, DINP, DIDP y DNOP.', 50.99, 7, 3, 1, 1),
(63, 'E702', 'Esterilla eco', 'Elaborada con Yute y caucho 100% natural. El tejido de arpillera proporciona una superficie duradera, táctil y agradablemente natural para trabajar al mismo tiempo que proporciona ese AGARRE tan buscado.\r\nEl grosor de 6 mm brinda soporte y amortiguación adicionales al mismo tiempo que mantiene la firmeza para una buena práctica.', 65.00, 15, 3, 6, 0),
(64, 'Bl302', 'Bloque de yoga reciclado', 'Los bloques de yoga son la herramienta perfecta tanto para principiantes como para yoguis experimentados. Te ayudarán encontrar el equilibrio, mejorar, profundizar en tus posturas o explorar nuevas. Como ajuste o proporcionando altura adicional a tu asana, es el accesorio perfecto en tus sesiones de yoga y pilates.\r\nFabricado en Europa con un 85% de material EVA reciclado, que es uno de los porcentajes más altos de la industria del yoga. 100% reciclable a través de ContinuOM Collective', 12.90, 25, 5, 10, 0),
(65, 'BL301', 'Bloque de corcho elefante', 'Hecho de corcho sostenible con estampado de elefante, este bloque de yoga de alta calidad es muy firme, más denso y más pesado que los bloques de espuma. La densidad y el peso del bloque de corcho le permiten sentirse seguro y apoyado.\r\nDesde posturas de equilibrio hasta estiramientos y flexiones de espalda con apoyo, un bloque puede permitirte llegar más lejos, profundizar un poco más en tus posturas y apoyarte a lo largo de tu práctica.\r\nMaterial natural muy agradable de tacto. Se limpia fácilmente con un trapo húmedo.\r\nSe venden por unidad, aunque recomendamos tener un set de 2 unidades por persona, dado que en muchas posturas se necesitan dos.', 15.00, 12, 5, 5, 1),
(66, 'B201', 'Banco de meditación de diseño', 'Banco de meditación desmontable, elegante de diseño ergonómico que te ayuda a sentarte erguido y relajado durante tu meditación. Colócate de rodillas y las piernas se pasan a la derecha y la izquierda del banquito. Gracias a la forma ergonómica y al asiento curvo ligeramente inclinado hacia adelante, puedes colocar tu columna vertebral en su posición vertical natural. De esta forma, los órganos abdominales se alivian y la respiración puede fluir libremente. Además esta postura en el banquito protege las articulaciones de la rodilla y el empeine. El banco de meditación se puede desmontar y, por lo tanto, es perfecto para llevarlo en viajes, retiros de meditación y seminarios. Así que también puedes llevarlo contigo a retiros de meditación. Esta elaborado con madera de haya de calidad', 60.99, 5, 6, 5, 0),
(71, 'Z102', 'Zafu grande Nipon', 'El zafu, este cojín redondo tradicional, ofrece un asiento estable que permite mantenerse con las piernas cruzadas o la posición del loto con mayor facilidad', 80.00, 7, 2, 6, 0),
(72, 'Z101', 'Zafu negro nature', 'El zafu, este cojín redondo tradicional, ofrece un asiento estable que permite mantenerse con las piernas cruzadas o la posición del loto con mayor facilidad.\r\n\r\nEs de algodón negro y relleno con kapok, la fibra vegetal tradicionalmente utilizada en Asia para los zafus. Cultivada en el Lejano Oriente, la fibra ligera de Kapokier es resistente al agua y a la putrefacción. Consiste en fibras cercanas a la apariencia del algodón, finas y sedosas. Más firme y más denso que el algodón, el kapok le permite al zafu mantener su forma para sentarse mejor.', 70.90, 12, 2, 5, 0),
(73, 'C801', 'Tingshas tibetanas', 'Comúnmente se usa para marcar el inicio o el final de un período de meditación budista o práctica espiritual.\r\nEstán elaboradas con bronce y restos de cuencos antiguos y una correa de cuero sólida para conectar estos dos tingshas. \r\nSe entregan con una funda de algodón estampada.', 40.00, 15, 5, 3, 1),
(74, 'A802', 'Armonizador Zen', 'Con un ligero golpe de mazo, esta campana emite una nota única, potente y duradera que ayuda a focalizar y calmar la mente. Usada a menudo durante sesiones de meditación o de sanación.\r\nDispone de 3 varillas macizas de aluminio pulido de color plateado, y un mazo de color negro. Tienes tres notas musicales: Sol, Re y Fa.', 50.00, 3, 5, 6, 0),
(75, 'R901', 'Camiseta Banbú hombre', 'El tejido de bambú aterciopelado y sedoso ofrece un ajuste maravillosamente ligero y cómodo que es ideal para las actividades de yoga y de deporte, pero también para la vida diaria.\r\nLa fibra de viscosa de bambú, hecha de los tallos de bambú, que crece en un ambiente tropical sin fertilizante ni pesticidas, puede absorber la humedad a un alto grado sin darle la impresión de ser mojado, y trae una sensación de frescura en todas las situaciones, evitando olores.\r\n70% de viscosa de pulpa de bambú 25% de algodón  5 % elastano.\r\n Ecotex Standard 100', 45.95, 10, 1, 3, 1),
(76, 'R902', 'Pantalón Sutra negro', 'El pantalón Sutra está diseñado para un calce holgado de una mezcla de cáñamo y poliéster reciclado. Tejida con un refuerzo en la entrepierna y un toque de spandex para mayor movilidad. La tela es naturalmente de secado rápido y reduce el olor. Completo con un cordón en la cintura.\r\n 53 % cáñamo / 44 % poliéster reciclado / 3 % elastano', 60.50, 15, 1, 3, 0);

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
  `city` varchar(50) NOT NULL,
  `user_id` int(10) NOT NULL,
  `is_main` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `street`, `number`, `floor`, `apartment`, `city`, `user_id`, `is_main`) VALUES
(1, 'conde del real agrado ', 2, 3, 'b', 'Asturias', 71, 1),
(4, 'conde del real agrado 4', 2, 3, 'b', 'Asturias', 70, 1),
(5, 'conde del real agrado 4', 2, 3, 'b', 'Asturias', 70, 1),
(6, 'conde del real agrado 4', 2, 3, 'b', 'Asturias', 91, 0),
(7, 'conde del real agrado 4', 2, 3, 'b', 'Asturias', 93, 0),
(8, 'conde del real agrado 4', 2, 3, 'b', 'Asturias', 97, 0),
(9, 'conde del real agrado 4', 2, 3, 'b', 'Asturias', 99, 0),
(10, 'conde del real agrado 4', 2, 3, 'b', 'Asturias', 101, 0),
(11, 'conde del real agrado 4', 2, 3, 'b', 'Asturias', 102, 0);

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

--
-- Volcado de datos para la tabla `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_logo`, `supplier_description`) VALUES
(1, 'Corporación Acme', NULL, 'Proveedor líder de suministros y mobiliario de oficina.'),
(2, 'Comerciantes Northwind', NULL, 'Importador y distribuidor de alimentos especiales.'),
(3, 'Importaciones Exóticas', NULL, 'Proveedor de frutas, verduras y especias exóticas.'),
(4, 'TechMart', NULL, 'Proveedor de hardware y software informáticos.'),
(5, 'Gadget Gear', NULL, 'Minorista de la última electrónica de consumo.'),
(6, 'Fashion Central', NULL, 'Mayorista de ropa y accesorios de moda.'),
(7, 'Paper Plus', NULL, 'Proveedor de papel, material de impresión y equipo de oficina.'),
(8, 'Suministros para Constructores', NULL, 'Proveedor de materiales y herramientas de construcción.'),
(9, 'Medical Supplies Inc.', NULL, 'Proveedor de equipos y suministros médicos.'),
(10, 'Depósito de Repuestos para Automóviles', NULL, 'Mayorista de repuestos y accesorios para automóviles.');

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
  `birth_date` date DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `date_registered` datetime NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `card_number` varchar(100) DEFAULT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name1`, `last_name2`, `email`, `birth_date`, `phone`, `date_registered`, `photo_url`, `password`, `card_number`, `role_id`) VALUES
(1, 'Juanin', 'Pérez', 'García', 'juan.perez@example.com', '1990-01-15', '', '2024-05-30 16:40:27', '', '$2y$10$9WAiktQhAnSwW6ni0V94uu24uR2yhiNzEX1Qbu3r2s.WJHnKSlPay', '', 1),
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
(32, 'Isabel', 'Martínez', 'Hernández', 'isabel.martinez@example.com', '1993-08-26', '234567890', '2024-05-25 12:31:00', NULL, 'password123', NULL, 2),
(34, 'Dayana', 'Gonzalita', 'Aguilarita', 'yogi@hotmail.com', '1986-03-05', '', '2024-05-28 14:46:51', '', '$2y$10$p//br.xqimii5CbOsaticeEOEFkRxkrJ5YLDbgsroGJuLMIuU28X.', '', 3),
(35, 'prueba', 'apellido', 'apellido', 'Email@ejemplo.com', '2000-03-22', '', '2024-05-28 15:51:20', '', '$2y$10$zta9glXr5ORP/zAqpEqDfuOLDeWwUug8.UYFtQecPm6arT95tDMZS', '', 2),
(36, 'prueba', 'apellido', 'apellido', 'email1@ejemplo.com', '2000-11-11', '', '2024-05-28 15:53:09', '', '$2y$10$XvJznEe6FCHGS8cKUKmH8uikGUZkVUo7dNtpRqfwCcu3kWZkmZQ5a', '', 2),
(37, 'prueba', 'apellido', 'apellido', 'Email@ejemplo2.com', '2000-11-22', '', '2024-05-28 16:01:10', '', '$2y$10$NjtiK1NU9Ri/93hCtoQQP.Kkz71p.Amwm4VUixFV16UKhBOww4eKy', '', 2),
(38, 'pruebaJsongarcia', 'sfgsg', 'GARCIA PELAYO', 'josefsdpingp@hotmail.com', '2024-05-11', '', '2024-05-28 22:02:35', '', '$2y$10$kPWPvMgasnrLUIcOGoBoCOEzakTFuib1M2rY4vxGHF2cKMuwWIOhi', '', 2),
(39, 'pruebaJsongarcia', 'sfgsg', 'GARCIA PELAYO', 'josefsdpdingp@hotmail.com', '2024-05-11', '', '2024-05-28 22:02:48', '', '$2y$10$3blHzjMw3sg4cFvw74xjZOtabuUY2Ht2a68wazeN79PTsdlTYW8k2', '', 2),
(41, 'zigaRRITO', 'AÑLKSNALKN', 'KÑVNJÑNAKÑANS', 'jingp@hotmail.com', '2024-05-15', '', '2024-05-29 16:11:46', 'zigaRRITOAÑLKSNALKNKÑVNJÑNAKÑANS_2024.05.29_161146.jpeg', '$2y$10$RwaFNOWANa8PzIOKqacmOecDxETgX1Ibx.DERRFY6GJOCUnREF5De', '', 1),
(43, 'JOSE LUIS', 'apellido', 'GARCIA PELAYO', 'joselksdjabhfpingp@hotmail.com', '2024-05-10', '', '2024-05-29 16:16:04', 'JOSE LUISapellidoGARCIA PELAYO_2024.05.29_161604.png', '$2y$10$iAmgN.IFiKVFL7I23Qu75u0IIGpeyvtlskmkWsEIaFVwOCCWvkVQO', '', 1),
(44, 'JOSE LUIS', 'Gonzalita', 'GARCIA PELAYO', 'jdsfosepingp@hotmail.com', '2024-05-09', '', '2024-05-29 16:18:08', 'JOSE LUISGonzalitaGARCIA PELAYO_2024.05.29_161808.png', '$2y$10$.Z22RlebnhrdFo1VO5y0feONRX.Tkr5BDSqGqvemFAHIUcEUWaNQO', '', 2),
(45, 'JOSE LUIS', 'apellido', 'GARCIA PELAYO', 'josepinretgp@hotmail.com', '2024-05-08', '', '2024-05-29 16:19:10', 'JOSE LUISapellidoGARCIA PELAYO_2024.05.29_161910.png', '$2y$10$/fEbdZNHwvY04nm4v1c9ZuPr3WJC.VA896h35EyYKMWG5ZPpUqyLu', '', 2),
(46, 'JOSE LUIS', 'Garcia', 'GARCIA PELAYO', 'josrgssepingp@hotmail.com', '2024-05-17', '', '2024-05-29 16:19:59', 'JOSE LUISGarciaGARCIA PELAYO_2024.05.29_161959.png', '$2y$10$I34zp9CXcBd2Ikj.tZZd0uaepJQJwMT4g43oBUtxrWKzuE.XwBVua', '', 4),
(47, 'JOSE LUIS', 'Gonzalita', 'GARCIA PELAYO', 'josepingdsfp@hotmail.com', '2024-05-01', '', '2024-05-29 16:25:28', 'JOSE LUISGonzalitaGARCIA PELAYO_2024.05.29_162528.png', '$2y$10$ogYSSj1i8XoqcD7KH5vhXeWEYg2vgXi.JRlXb3rmFs6K7rzpAy81K', '', 1),
(48, 'pichimi', 'npaihu', 'ioxbzjuvsk', 'japon@japon.com', '2024-05-30', '', '2024-05-29 16:33:00', 'pichiminpaihuioxbzjuvsk_2024.05.29_163300.png', '$2y$10$IFcbr6TR3A.433PdJRtpw.FGn6VSVNyJbk6/.K9csrihRXUh3vkTW', '', 1),
(49, 'JOSE LUIS', 'dsFASFASF', 'GARCIA PELAYO', 'josesfspingp@hotmail.com', '2024-05-08', '', '2024-05-29 16:34:14', 'JOSE LUISdsFASFASFGARCIA PELAYO_2024.05.29_163415.png', '$2y$10$ACFZImYSDKHxg8.u.lk.M.xdAobCQB05kArjuumRspdkbpSNUw3Qi', '', 2),
(50, 'JOSE LUIS', 'cbvxcbcxb', 'GARCIA PELAYO', 'josepisdfsfngp@hotmail.com', '2024-05-09', '', '2024-05-29 16:35:11', 'JOSE LUIScbvxcbcxbGARCIA PELAYO_2024.05.29_163511.png', '$2y$10$X7q0ZSVvjolUaeFvLtVRiebluw2cSBEZQCPavaytbJjGESk3A42iy', '', 2),
(51, 'JOSE LUIS', 'asdasdasd', 'GARCIA PELAYO', 'josepasdasdingp@hotmail.com', '2024-05-11', '', '2024-05-29 16:37:32', 'JOSE LUISasdasdasdGARCIA PELAYO_2024.05.29_163733.png', '$2y$10$jnxNhXvMj1OPWCXma9N2Nu.y.2B/p/Dk1KZJzJOHZOB0HM2eIBI5q', '', 2),
(52, 'JOSE LUIS', 'AÑLKSNALKN', 'GARCIA PELAYO', 'josepinasdagp@hotmail.com', '2024-05-31', '', '2024-05-29 16:42:58', 'JOSE LUISAÑLKSNALKNGARCIA PELAYO_2024.05.29_164258.png', '$2y$10$YOu4q1VF4QiZh.hmXx7COuyflss6WXeEcLtyOvR5OiZhk9jEDot22', '', 4),
(53, 'JOSE LUIS', 'Gonzalita', 'GARCIA PELAYO', 'josesdfsfpingp@hotmail.com', '2024-05-30', '', '2024-05-29 16:44:54', 'JOSE LUISGonzalitaGARCIA PELAYO_2024.05.29_164454.png', '$2y$10$DaS2/JL9fXhWJ565O/4lAuJYMI1aKBpIVbj/QR9/m8BzLUjpGKt0.', '', 3),
(54, 'JOSE LUIS', 'Gonzalita', 'GARCIA PELAYO', 'josesdfsfasdasdpingp@hotmail.com', '2024-05-30', '', '2024-05-29 16:47:38', 'JOSE LUISGonzalitaGARCIA PELAYO_2024.05.29_164738.png', '$2y$10$ohAT.J0L./8684x3jCxKO.7Aeyh38syLwKZli5.QUa69qtz7bVQvS', '', 3),
(55, 'JOSE LUIS', 'Gonzalita', 'GARCIA PELAYO', 'josesdfsfasdfsfdsdasdpingp@hotmail.com', '2024-05-30', '', '2024-05-29 16:48:39', 'JOSE LUISGonzalitaGARCIA PELAYO_2024.05.29_164839.png', '$2y$10$Ht3M4m3pBdAdk32UVOf3BOJBdT2g29Bcc8k.72lR6ZxMwTeSmsJNe', '', 3),
(56, 'JOSE LUIS', 'Gonzalita', 'GARCIA PELAYO', 'joseasdfasdfpingp@hotmail.com', '2024-05-16', '', '2024-05-29 16:49:17', 'JOSE LUISGonzalitaGARCIA PELAYO_2024.05.29_164917.png', '$2y$10$vjodvs2rJCVdBE9j.qre8OEFp4//OrC/doA8CbNFoskqR6lxxjdv6', '', 1),
(58, 'JOSE LUIS', 'xzcvvzxvxz', 'GARCIA PELAYO', 'josezxcvxcvpingp@hotmail.com', '2024-05-07', '', '2024-05-29 17:12:37', '', '$2y$10$YGBTW0HgUqihu5rguFbE7udsTUuHzUJF3fl0GR2IvWSsYp3Nau4sS', '', 1),
(59, 'JOSE LUIS', 'xzcvvzxvxz', 'GARCIA PELAYO', 'josezxcvxcasdasdvpingp@hotmail.com', '2024-05-07', '', '2024-05-29 17:22:41', '', '$2y$10$9BcxtEGRSLE8TSE3GVZ4p.8wHfmPILO.ukLBakP4ovjxgRk15inWG', '', 1),
(61, 'JOSE LUIS', 'garcia', 'GARCIA PELAYO', 'jose133123pingp@hotmail.com', '1111-11-11', '', '2024-05-29 17:44:59', '', '$2y$10$nz/nzHpNdCxdcaDcwQagju8mZNKeH8otzlh63k5E9b8yq.wN6WAvS', '', 3),
(62, 'JOSE LUIS', 'garcia', 'GARCIA PELAYO', 'josepi123444ngp@hotmail.com', '1111-11-11', '', '2024-05-29 17:46:21', '', '$2y$10$.j5DE3wMboXxSYYDkjovmOLYiay3dqRcFrxO7zoHJ.HSkQAvGFvbW', '', 2),
(63, 'JOSE LUIS', 'apellido', 'GARCIA PELAYO', 'josepsdfgsdfgingp@hotmail.com', '2222-02-22', '', '2024-05-29 17:49:15', '', '$2y$10$BdKHGqCUrLoOJBQ1d38Mp.kMsGsAU9mEahIRHzOuISFvIPY/aGpmK', '', 1),
(64, 'JOSE LUIS', 'apellido', 'GARCIA PELAYO', 'asdajosepsdfgsdfgingp@hotmail.com', '2222-02-22', '', '2024-05-29 17:51:37', '', '$2y$10$d9ztpvBjmSdiABI.mWLAoO40FASHOOn6DStiGHN8P1hMCoyhrVAji', '', 1),
(65, 'JOSE LUIS', 'garcia', 'GARCIA PELAYO', 'josepin1231313gp@hotmail.com', '1111-11-11', '', '2024-05-29 18:30:41', 'JOSE LUISgarciaGARCIA PELAYO2024.05.29183041.png', '$2y$10$43YeBo6YuJbR/7NokA.kY.yzKznVzRV5.l8eTt.XktTwIGqFcadMe', '', 3),
(66, 'JOSE LUIS', 'garcia', 'GARCIA PELAYO', 'josep13in1231313gp@hotmail.com', '1111-11-11', '', '2024-05-29 18:37:45', 'JOSELUISgarciaGARCIAPELAYO2024.05.29183745.png', '$2y$10$fimVXUAC07JfTyuAw7g.8eXdIY8M0Te5/Oa03RAxMSDmKH/z4YS.e', '', 3),
(67, 'JOSE LUIS', 'Garcia', 'GARCIA PELAYO', 'josepi23442ngp@hotmail.com', '1111-11-11', '', '2024-05-30 16:11:13', '', '$2y$10$zShi2XnKhHKtZhb13YGRGetT8F4oH.lf/GuRvbZQHVRlY2/X3JYPG', '', 2),
(70, 'Jose Luis', 'Garcia', 'Pelayo', 'mimail@hotmail.com', '2024-06-08', '658780643', '2024-06-04 19:53:27', 'JoseLuisGarciaPelayo2024.06.04195327.png', '$2y$10$1V/EX4CJG8cVmlzW1h6Tt.8z28qW.Fd0Dwn/bk6WpB5uiINEb4Jsu', '', 1),
(71, 'JOSE LUIS', 'Garcia', 'PELAYO', 'josepingp@hotmail.com', '2024-05-28', '658780643', '2024-06-05 18:47:27', 'JOSELUISGarciaPELAYO2024.06.05184727.jpeg', '$2y$10$A04QKO96t72x3P.clgb3VeC21kghlLXCpquZOgpUZjv7IU9eUuqTC', '', 2),
(73, 'Jose Luis', 'Garcia', 'Pelayo', 'tumail@hotmail.com', '2024-03-19', NULL, '2024-06-16 20:55:22', '', '$2y$10$1E6DSw7bBv3Z1pliKlXHOuUHooIlQGvGpU1IO6N02zT6Y.ynKs22S', NULL, 2),
(77, 'JOSE LUIS', 'apellido', 'GARCIA PELAYO', 'jvosepingp@hotmail.com', '2024-06-06', NULL, '2024-06-16 21:09:46', 'JOSELUISapellidoGARCIAPELAYO2024.06.16210947.jpeg', '$2y$10$6ju8pfos6Z9TYLDOQzraoe1iyGsWWhS/9bgl27XAQccCkrfdNYkZC', NULL, 2),
(78, 'JOSE LUIS', 'apellido', 'GARCIA PELAYO', 'josepginggp@hotmail.com', '2024-06-05', NULL, '2024-06-16 21:12:11', 'JOSELUISapellidoGARCIAPELAYO2024.06.16211211.jpeg', '$2y$10$jJybTERLHoJ.3Kd.mU.4tOFaf84E5aRVkU8tzZo2SKNSek9wkPsE.', NULL, 2),
(79, 'JOSE LUIS', 'apellido', 'GARCIA PELAYO', 'josepincgp@hotmail.com', '2024-06-07', NULL, '2024-06-16 21:13:02', 'JOSELUISapellidoGARCIAPELAYO2024.06.16211302.jpeg', '$2y$10$DP05VKecszNTg0.XKVgV2.YQu/wH8I53RmLHwb/57oEmqtdejPNoq', NULL, 2),
(80, 'JOSE LUIS', 'apellido', 'GARCIA PELAYO', 'josepinvcgp@hotmail.com', '2024-06-06', NULL, '2024-06-16 21:16:27', 'JOSELUISapellidoGARCIAPELAYO2024.06.16211627.jpeg', '$2y$10$akXOBa0MKJP2oe1CaPSW4uJvMQhWFTXBkhJAqgFr5asxTXnTc0B46', NULL, 2),
(83, 'JOSE LUIS', 'GARCIA PELAYO', 'Pelayo', 'josepinhhgp@hotmail.com', NULL, NULL, '2024-06-20 19:05:26', NULL, NULL, NULL, 3),
(85, 'JOSE LUIS', 'GARCIA PELAYO', 'Pelayo', 'josephinhhgp@hotmail.com', NULL, NULL, '2024-06-20 19:07:21', NULL, NULL, NULL, 3),
(86, 'JOSE LUIS', 'GARCIA PELAYO', 'Pelayo', 'josephinihhgp@hotmail.com', NULL, NULL, '2024-06-20 19:09:16', NULL, NULL, NULL, 3),
(88, 'JOSE LUIS', 'GARCIA PELAYO', 'Pelayo', 'jllosephinihhgp@hotmail.com', '2024-06-07', NULL, '2024-06-20 19:10:44', NULL, NULL, NULL, 3),
(89, 'JOSE LUIS', 'GARCIA PELAYO', 'Pelayo', 'jllosepgghinihhgp@hotmail.com', '2024-06-07', '658780643', '2024-06-20 19:14:12', NULL, 'invitado', NULL, 3),
(91, 'JOSE LUIS', 'GARCIA PELAYO', 'Pelayo', 'jllosephdgfgghinihhgp@hotmail.com', '2024-06-07', '658780643', '2024-06-20 19:16:41', NULL, 'invitado', NULL, 3),
(93, 'JOSE LUIS', 'GARCIA PELAYO', 'Pelayo', 'lolerillo@hotmail.com', '2024-06-07', '658780643', '2024-06-20 19:17:52', NULL, 'invitado', NULL, 3),
(95, 'JOSE LUIS', 'GARCIA PELAYO', 'PELAYO', 'josepiadfngp@hotmail.com', '2024-06-11', '658780643', '2024-06-20 19:25:01', NULL, 'invitado', NULL, 3),
(97, 'JOSE LUIS', 'GARCIA PELAYO', 'PELAYO', 'joseafdpiadfngp@hotmail.com', '2024-06-11', '658780643', '2024-06-20 19:25:25', NULL, 'invitado', NULL, 3),
(99, 'JOSE LUIS', 'GARCIA PELAYO', 'PELAYO', 'josefngp@hotmail.com', '2024-06-11', '658780643', '2024-06-20 19:26:27', NULL, 'invitado', NULL, 3),
(101, 'JOSE LUIS', 'GARCIA PELAYO', 'PELAYO', 'josefdngp@hotmail.com', '2024-06-11', '658780643', '2024-06-20 20:16:55', NULL, 'invitado', NULL, 3),
(102, 'JOSE LUIS', 'GARCIA PELAYO', 'PELAYO', 'josefddsdngp@hotmail.com', '2024-06-11', '658780643', '2024-06-20 20:19:09', NULL, 'invitado', NULL, 3),
(103, 'JOSE LUIS', 'GARCIA PELAYO', 'fgfdgddf', 'josepdgdfgingp@hotmail.com', '2024-06-14', '658780643', '2024-06-20 20:19:55', NULL, 'invitado', NULL, 3),
(105, 'JOSE LUIS', 'GARCIA PELAYO', 'fgfdgddf', 'josdfgingp@hotmail.com', '2024-06-14', '658780643', '2024-06-20 20:28:44', NULL, 'invitado', NULL, 3),
(107, 'JOSE LUIS', 'GARCIA PELAYO', 'PELAYO', 'jongp@hotmail.com', '2024-06-08', '658780643', '2024-06-20 20:29:25', NULL, 'invitado', NULL, 3),
(109, 'JOSE LUIS', 'GARCIA PELAYO', 'PELAYO', 'joyungp@hotmail.com', '2024-06-08', '658780643', '2024-06-20 20:29:58', NULL, 'invitado', NULL, 3),
(110, 'JOSE LUIS', 'GARCIA PELAYO', 'PELAYO', 'josuiepingp@hotmail.com', '2024-06-06', '658780643', '2024-06-20 20:31:08', NULL, 'invitado', NULL, 3),
(111, 'JOSE LUIS', 'GARCIA PELAYO', 'GARCIA PELAYO', 'josesghpingp@hotmail.com', '2024-06-07', '658780643', '2024-06-20 20:32:53', NULL, 'invitado', NULL, 3),
(113, 'JOSE LUIS', 'GARCIA PELAYO', 'PELAYO', 'josuiegp@hotmail.com', '2024-06-06', '658780643', '2024-06-20 20:33:37', NULL, 'invitado', NULL, 3);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

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
