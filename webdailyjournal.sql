-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jan 2026 pada 05.04
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdailyjournal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `isi` text NOT NULL,
  `gambar` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(2, 'Candi Lempuyangan', 'Mayoritas masyarakat di Pulau Bali beragama Hindu. Maka, pura menjadi tempat ibadah yang tentu saja akan banyak ditemui. Di balik itu, ada salah satu pura yang paling indah dan bikin orang jatuh hati yaitu Pura Lempuyangan di Bunutan, Abang, Kabupaten Karangasem.', 'berita2.jpg', '2025-12-10 13:06:46', 'admin'),
(7, 'Tari Kecak', 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam.', '20251226190922.jpg', '2025-12-26 19:09:22', 'admin'),
(9, 'Rumah Adat', 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam.', '20251226191100.jpg', '2025-12-26 19:11:00', 'admin'),
(10, 'Tari Bali', 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua enim ad minim veniam.', '20251226191220.jpg', '2025-12-26 19:12:20', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `gambar`, `tanggal`, `username`) VALUES
(13, '20260111162028.jpg', '2026-01-11 16:20:28', 'admin'),
(14, '20260111162034.jpg', '2026-01-11 16:20:34', 'admin'),
(15, '20260111162039.jpg', '2026-01-11 16:20:39', 'admin'),
(16, '20260111162044.jpg', '2026-01-11 16:20:44', 'admin'),
(17, '20260111162049.jpg', '2026-01-11 16:20:49', 'admin'),
(18, '20260111162054.jpg', '2026-01-11 16:20:54', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `profile`) VALUES
(2, 'Faishal ', '$2y$12$3HQRbC50QEWlSqKeZdxAVO9S9NBrjA0aCK0K.EBluboYzoc9QG6..', 'user_1768121074.png'),
(4, 'Rangga', '$2y$12$WzQCtoC9ucIQxBf6HIVp7uLRN93BhPH7hHpUNbgF3lq3WXc/JlMrO', 'user_1768121131.jpeg'),
(5, 'sahal', '$2y$12$0udcstLU9I74xr1qqkoLsehU.paKeFiHT4vo57N6Um9hmLH.wBXIy', 'user_1768121169.jpeg'),
(6, 'Ardhi', '$2y$12$vpRr.9T.oXPqFio9tXaHDuHDxBTubf3Hvf2zCJyFdCU8fJKecIx02', 'user_1768121205.jpg'),
(7, 'danny', '$2y$12$OBffnT8eLpE5p7EpIUmMQOrtjah4xFII5gQCMjDLddMQfi8VMZIXC', 'user_1768121388.jpeg'),
(9, 'admin', '$2y$12$zrxnUrxu/drYs.vRTCCxKumnVV4HRCevuoCbYVl0K1PHRq6fBs46m', 'user_1768188903.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
