-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Feb 2024 pada 01.11
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemesanan_makanan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `menu_makanan` varchar(255) NOT NULL,
  `menu_minuman` varchar(255) NOT NULL,
  `jumlah_makanan` int(11) NOT NULL,
  `jumlah_minuman` int(11) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `waktu_pesan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `menu_makanan`, `menu_minuman`, `jumlah_makanan`, `jumlah_minuman`, `nama_pengguna`, `nomor_telepon`, `alamat`, `waktu_pesan`, `status_pengiriman`) VALUES
(11, 'Nasi Goreng', 'Es Teh', 1, 1, '0', '8u2389218938912', 'djasjnasl', '2024-02-01 00:06:26', ''),
(12, 'Nasi Goreng', 'Es Teh', 1, 1, '0', '0982721', 'dharpah', '2024-02-01 00:09:37', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
