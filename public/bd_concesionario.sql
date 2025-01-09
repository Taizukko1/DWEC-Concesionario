-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 12:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_concesionario`
--

-- --------------------------------------------------------

--
-- Table structure for table `coches`
--

CREATE TABLE `coches` (
  `id_coche` int(5) NOT NULL,
  `marca` varchar(40) DEFAULT NULL,
  `modelo` varchar(50) NOT NULL,
  `anio_fabricacion` int(4) NOT NULL,
  `extras` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coches`
--

INSERT INTO `coches` (`id_coche`, `marca`, `modelo`, `anio_fabricacion`, `extras`) VALUES
(1, 'Volkswagen', 'Golf 1.6 TDI', 2019, 'Sensores de aparcamiento traseros,');

-- --------------------------------------------------------

--
-- Table structure for table `imagenes`
--

CREATE TABLE `imagenes` (
  `id_img` int(5) NOT NULL,
  `matricula` varchar(7) NOT NULL,
  `src` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imagenes`
--

INSERT INTO `imagenes` (`id_img`, `matricula`, `src`) VALUES
(1, 'GTD4578', 'vw_p16_2029_madrid_1.PNG'),
(2, 'GTD4578', 'vw_p16_2029_madrid_2.PNG'),
(3, 'GTD4578', 'vw_p16_2029_madrid_3.PNG'),
(4, 'GTD4578', 'vw_p16_2029_madrid_4.PNG'),
(5, 'GTD4578', 'vw_p16_2029_madrid_5.PNG'),
(6, 'BTS1554', 'vw_p16_2029_malaga_1.PNG'),
(7, 'BTS1554', 'vw_p16_2029_malaga_2.PNG'),
(8, 'BTS1554', 'vw_p16_2029_malaga_3.PNG'),
(9, 'BTS1554', 'vw_p16_2029_malaga_4.PNG'),
(10, 'BTS1554', 'vw_p16_2029_malaga_5.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `unidades`
--

CREATE TABLE `unidades` (
  `matricula` varchar(7) NOT NULL,
  `id_coche` int(5) NOT NULL,
  `color` varchar(40) NOT NULL,
  `kilometraje` int(9) NOT NULL,
  `precio` float(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unidades`
--

INSERT INTO `unidades` (`matricula`, `id_coche`, `color`, `kilometraje`, `precio`) VALUES
('BTS1554', 1, 'Gris', 142989, 12990.00),
('GTD4578', 1, 'Blanco', 74, 14200.00);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `uid` int(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL DEFAULT '$2y$10$YcB0zkRL219y1Q074gKGu.TyrQLtS8yBEYRO4U5TEx.MqR2jDw.06',
  `tipo` varchar(10) NOT NULL DEFAULT 'cliente',
  `ventas` int(4) DEFAULT 0,
  `gastado` float DEFAULT 0,
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `ap1` varchar(75) NOT NULL,
  `ap2` varchar(75) NOT NULL,
  `telefono` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`uid`, `email`, `pass`, `tipo`, `ventas`, `gastado`, `dni`, `nombre`, `ap1`, `ap2`, `telefono`) VALUES
(1, 'admin@ccj.com', '$2y$10$zL7aCC.8WemiHZpHA1R3M.D1dbtlEPNSTeMazSMs9hMmJGHCAuFtO', 'admin', 0, 0, '58011368D', 'Andoni', 'Sanchez', 'Aceña', '684548698'),
(11, 'jane.doe@mail.com', '$2y$10$YcB0zkRL219y1Q074gKGu.TyrQLtS8yBEYRO4U5TEx.MqR2jDw.06', 'vendedor', 0, 0, '54879654F', 'Jane', 'Doe', 'Smith', '654789123'),
(15, 'test@test.com', '$2y$10$YcB0zkRL219y1Q074gKGu.TyrQLtS8yBEYRO4U5TEx.MqR2jDw.06', 'cliente', 0, 0, '00000000A', 'Test', 'de', 'Venta', '111222333');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(5) NOT NULL,
  `uid_cliente` varchar(9) NOT NULL,
  `uid_vendedor` varchar(9) DEFAULT NULL,
  `matricula` varchar(7) NOT NULL,
  `fecha_venta` date NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(20) NOT NULL DEFAULT 'en espera'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id_venta`, `uid_cliente`, `uid_vendedor`, `matricula`, `fecha_venta`, `estado`) VALUES
(1, '15', NULL, 'BTS1554', '2025-01-09', 'en espera');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coches`
--
ALTER TABLE `coches`
  ADD PRIMARY KEY (`id_coche`);

--
-- Indexes for table `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_img`),
  ADD KEY `matricula` (`matricula`);

--
-- Indexes for table `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `id_coche` (`id_coche`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `telefono` (`telefono`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `matricula` (`matricula`),
  ADD KEY `uid_cliente` (`uid_cliente`),
  ADD KEY `uid_vendedor` (`uid_vendedor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coches`
--
ALTER TABLE `coches`
  MODIFY `id_coche` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_img` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `uid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `unidades` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unidades`
--
ALTER TABLE `unidades`
  ADD CONSTRAINT `unidades_ibfk_1` FOREIGN KEY (`id_coche`) REFERENCES `coches` (`id_coche`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
