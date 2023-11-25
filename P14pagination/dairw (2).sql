-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 12:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dairw`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_makanan` int(30) NOT NULL,
  `nama_makanan` varchar(30) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_makanan`, `nama_makanan`, `harga`) VALUES
(1, 'Nasi Goyeng', 10000),
(2, 'Nayi Peyel', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `orderr`
--

CREATE TABLE `orderr` (
  `id_order` int(99) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `pelayan` varchar(30) NOT NULL,
  `no_meja` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderr`
--

INSERT INTO `orderr` (`id_order`, `tanggal`, `jam`, `pelayan`, `no_meja`) VALUES
(1, '2023-10-25', '15:16:09', 'Adi', 4),
(2, '2023-10-19', '16:31:13', 'Adi', 3),
(3, '2023-10-25', '16:08:00', 'Sabil', 4),
(4, '2023-10-31', '20:27:04', 'Sabil', 2),
(5, '2023-11-08', '15:05:37', 'Sabil', 3),
(6, '2023-11-08', '15:07:19', 'Adi', 8),
(7, '2023-11-16', '14:39:55', 'Sabil', 3),
(8, '2023-11-16', '15:00:59', 'Sabil', 12),
(9, '2023-11-16', '00:00:00', 'Sabil', 1),
(10, '2023-11-16', '15:14:46', 'Sabil', 100),
(11, '2023-11-16', '21:23:31', 'Sabil', 100),
(12, '2023-11-16', '21:23:41', 'Sabil', 100),
(13, '2023-11-16', '21:33:05', 'Sabil', 10),
(14, '2023-11-16', '21:33:13', 'Sabil', 10),
(15, '2023-11-16', '21:33:15', 'Sabil', 10),
(16, '2023-11-16', '21:33:24', 'Sabil', 10),
(17, '2023-11-16', '21:33:50', 'Sabil', 10),
(18, '2023-11-16', '21:33:58', 'Sabil', 3),
(19, '2023-11-16', '21:34:06', 'Sabil', 3),
(20, '2023-11-16', '00:00:00', '', 5),
(21, '2023-11-16', '21:52:00', '', 5),
(22, '2023-11-16', '21:56:58', 'Sabil', 5),
(23, '2023-11-16', '21:57:12', 'Sabil', 5),
(24, '2023-11-16', '21:58:11', 'Sabil', 5),
(25, '2023-11-16', '21:58:19', 'Sabil', 5),
(26, '2023-11-16', '22:03:56', 'Sabil', 5),
(27, '2023-11-17', '20:34:13', 'Sabil', 1),
(28, '2023-11-17', '20:44:23', 'Sabil', 1),
(29, '2023-11-21', '18:58:53', 'Sabil', 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_detil`
--

CREATE TABLE `order_detil` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(20,0) NOT NULL,
  `subtotal` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detil`
--

INSERT INTO `order_detil` (`id`, `id_order`, `id_menu`, `jumlah`, `harga`, `subtotal`) VALUES
(13, 1, 1, 2, 10000, 20000),
(14, 1, 1, 2, 10000, 20000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_makanan`);

--
-- Indexes for table `orderr`
--
ALTER TABLE `orderr`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_detil`
--
ALTER TABLE `order_detil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order` (`id_order`),
  ADD KEY `fk_menu` (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_makanan` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orderr`
--
ALTER TABLE `orderr`
  MODIFY `id_order` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_detil`
--
ALTER TABLE `order_detil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detil`
--
ALTER TABLE `order_detil`
  ADD CONSTRAINT `fk_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_makanan`),
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`id_order`) REFERENCES `orderr` (`id_order`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
