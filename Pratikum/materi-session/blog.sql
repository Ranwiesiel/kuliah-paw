-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Nov 2023 pada 17.33
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `articles`
--

CREATE TABLE `articles` (
  `id` int(16) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `articles`
--

INSERT INTO `articles` (`id`, `title`, `summary`, `content`, `category`) VALUES
(1, 'Mengapa disebut dengan Bug?	', 'Anda mungkin sering mendengar kata \"bug\" ketika sedang melakukan pembuatan sebuah program, kan? Saya telah melakukan riset tentang asal muasal dari kenapa kata \"bug\" digunakan.	', 'Pernahkan Anda berujar \"Oh ada bug!\" ketika sesuatu yang aneh terjadi ketika memainkan game atau menggunakan beberapa aplikasi? Saya jadi sangat penasaran perihal \"bug\" ini, jadi saya melakukan beberapa riset dan inilah yang kutemukan! Pertama-tama, kata ', 'all'),
(2, 'Apakah Anda tahu asal usul dari Cookies?	', 'Kita mungkin telah mengenal cookies sebagai sebuah makanan, tetapi tidak berhubungan sama sekali. Sangat penasaran dengan hal itu, sehingga saya mencarinya di internet dan hasilnya menarik sekali!	', 'Ketika pertama kali mendengar tentang Cookies dari Guru Domba, apakah Anda berfikir itu sejenis makanan yang bisa dimakan? Yaa, saya memang menyangka itu adalah sebuah makanan! Tetapi saya kecewa setelah mendengar penjelasan tentang Cookies sebab tidak ad', 'limited');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(16) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Ninja Ken', 'ken@progate.com', '3899dcbab79f92af727c2190bbd8abc5', 'admin'),
(2, 'Guru Domba', 'guru@progate.com', 'ff6689070cc19e99ce13842de087907c', 'admin'),
(3, 'test', 'test@paw.com', '123', 'user'),
(13, 'ada', 'admin@paw.com', '123', 'user'),
(22, 'alin', 'admin@paw.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(26, 'test2', 'admin@paw.com', '123', 'user'),
(27, 'kopikap', 'kop@mail.com', '202cb962ac59075b964b07152d234b70', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
