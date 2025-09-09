-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2025 a las 09:58:17
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
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `especificaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `stock`, `imagen`, `especificaciones`) VALUES
(4, 'HP Pavilion 15', 2800000.00, 8, 'productos/Pavilion_15.png', 'Procesador AMD Ryzen 5 5500U, 8GB RAM DDR4, 512GB SSD, Pantalla 15.6\" FHD, Windows 11'),
(5, 'HP Envy x360', 3500000.00, 5, 'productos/HP_Envy_x360.png', 'Procesador Intel Core i5 12ª Gen, 16GB RAM, 512GB SSD, Pantalla táctil 14\" FHD convertible, Windows 11'),
(6, 'HP Omen 16', 5200000.00, 3, 'productos/HP_Omen_16.png', 'Procesador Intel Core i7 13ª Gen, 16GB RAM, 1TB SSD, Pantalla 16.1\" FHD 144Hz, NVIDIA RTX 4060, Windows 11'),
(7, 'Samsung Galaxy Book3', 4000000.00, 4, 'productos/Samsung_Galaxy_Book3.png', 'Procesador Intel Core i7 13ª Gen, 16GB RAM LPDDR5, 512GB SSD, Pantalla 15.6\" AMOLED, Windows 11'),
(8, 'Samsung Galaxy Book2 Pro', 1800000.00, 6, 'productos/Samsung_Galaxy_Book2_Pro.png', 'Procesador Intel Core i7 12ª Gen, 16GB RAM, 1TB SSD, Pantalla 15.6\" AMOLED, Windows 11, ultraligera'),
(9, 'Samsung Notebook Plus2', 2900000.00, 7, 'productos/Samsung_Notebook_Plus2.png', 'Procesador Intel Core i5 11ª Gen, 8GB RAM, 256GB SSD, Pantalla 15.6\" FHD, Windows 11, diseño ligero para estudiantes'),
(10, 'MacBook Air M1', 4800000.00, 5, 'productos/MacBook_Air_M1.png', 'Chip Apple M1, 8GB RAM unificada, 256GB SSD, Pantalla Retina 13.3\", macOS Ventura, hasta 18 horas de batería'),
(11, 'MacBook Pro 14', 4200000.00, 2, 'productos/MacBook_Pro_14.png', 'Chip Apple M1 Pro, 16GB RAM, 512GB SSD, Pantalla Liquid Retina XDR 14.2\", macOS Ventura, hasta 17 horas de batería'),
(12, 'MacBook Pro 16', 5300000.00, 1, 'productos/MacBook_Pro_16.png', 'Chip Apple M1 Max, 32GB RAM, 1TB SSD, Pantalla Liquid Retina XDR 16.2\", macOS Ventura, hasta 21 horas de batería'),
(13, 'HP Intel Core', 3200000.00, 0, 'productos/HP_Intel_Core.png', 'Procesador Intel Core i5 11ª Gen, 8GB RAM, 256GB SSD, Pantalla 15.6\" FHD, Gráficos Intel Iris Xe, Windows 11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `password`) VALUES
(1, 'Santiago', 'slouridorodriguez@gmail.com', '$2y$10$dbYBKUtgOhvBfh8F8i5sF.glKQdozhX3ZstPQGVJmLNb90ug5XPkC'),
(3, 'Julian', 'slouridorodriguezzz@gmail.com', '$2y$10$7cvF5/q7dgxxjV2T.5XJ0uTFs6ceJOdREw1akuEsy3zJaqBmLyvym'),
(5, 'Julianss', 'slouridorodriguezzzz@gmail.com', '$2y$10$eho869FASVu2c0MYJdRiy./idA0yWEBGTKmNNds7dcTZJehNfNVSa'),
(6, 'leandro', 'leandro@gmai.com', '$2y$10$KNY0DCTLkvfDJrW/RP9bf.zjd03C3kLA2cEWJR4d1Joilccd8hcku');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
