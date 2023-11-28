-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Okt 2023 pada 07.20
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

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
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_makanan` int(30) NOT NULL,
  `nama_makanan` varchar(30) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_makanan`, `nama_makanan`, `harga`) VALUES
(1, 'Nasi Goyeng', 10000),
(2, 'Nayi Peyel', 5000),
(3, 'pisang goreng', 7000),
(4, 'Ayam', 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderr`
--

CREATE TABLE `orderr` (
  `id_order` int(99) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `pelayan` varchar(30) NOT NULL,
  `no_meja` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orderr`
--

INSERT INTO `orderr` (`id_order`, `tanggal`, `jam`, `pelayan`, `no_meja`) VALUES
(1, '2023-10-25', '15:16:09', 'Adi', 4),
(2, '2023-10-19', '16:31:13', 'Adi', 3),
(3, '2023-10-25', '16:08:00', 'Sabil', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detil`
--

CREATE TABLE `order_detil` (
  `id_riwayat` int(99) NOT NULL,
  `id_makanan` int(99) NOT NULL,
  `id_order` int(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_detil`
--

INSERT INTO `order_detil` (`id_riwayat`, `id_makanan`, `id_order`) VALUES
(4, 1, 1),
(5, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_makanan`);

--
-- Indeks untuk tabel `orderr`
--
ALTER TABLE `orderr`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `order_detil`
--
ALTER TABLE `order_detil`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `fk_menu` (`id_makanan`),
  ADD KEY `fk_pesan` (`id_order`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_makanan` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `orderr`
--
ALTER TABLE `orderr`
  MODIFY `id_order` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `order_detil`
--
ALTER TABLE `order_detil`
  MODIFY `id_riwayat` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `order_detil`
--
ALTER TABLE `order_detil`
  ADD CONSTRAINT `fk_menu` FOREIGN KEY (`id_makanan`) REFERENCES `menu` (`id_makanan`),
  ADD CONSTRAINT `fk_pesan` FOREIGN KEY (`id_order`) REFERENCES `orderr` (`id_order`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
