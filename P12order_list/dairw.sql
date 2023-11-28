-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 04:14 PM
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
(2, 'Nayi Peyel', 5000),
(3, 'pisang goreng', 7000),
(4, 'Geprek', 10000);

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
(4, '2023-10-31', '20:27:04', 'Sabil', 2);

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
(1, 1, 2, 2, 2000, 2000),
(2, 4, 3, 2, 7000, 14000),
(3, 4, 1, 3, 10000, 30000),
(4, 4, 1, 5, 10000, 50000);

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
  MODIFY `id_order` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_detil`
--
ALTER TABLE `order_detil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
