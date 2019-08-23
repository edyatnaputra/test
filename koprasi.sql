-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Agu 2019 pada 02.24
-- Versi server: 10.1.40-MariaDB
-- Versi PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koprasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_anggota`
--

CREATE TABLE `t_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `foto` varchar(50) NOT NULL,
  `id_kota` int(5) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kota`
--

CREATE TABLE `t_kota` (
  `id_kota` int(5) NOT NULL,
  `id_prov` int(5) NOT NULL,
  `kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_kota`
--

INSERT INTO `t_kota` (`id_kota`, `id_prov`, `kota`) VALUES
(1, 1, 'Jember'),
(2, 1, 'Surabaya'),
(3, 1, 'Malang'),
(4, 1, 'Banyuwangi'),
(5, 2, 'Solo'),
(6, 2, 'Klaten'),
(7, 2, 'Kudus'),
(8, 2, 'Jepara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_prov`
--

CREATE TABLE `t_prov` (
  `id_prov` int(5) NOT NULL,
  `prov` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_prov`
--

INSERT INTO `t_prov` (`id_prov`, `prov`) VALUES
(1, 'Jawa timur'),
(2, 'Jawa Tengah');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_anggota`
--
ALTER TABLE `t_anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `id_kota` (`id_kota`);

--
-- Indeks untuk tabel `t_kota`
--
ALTER TABLE `t_kota`
  ADD PRIMARY KEY (`id_kota`),
  ADD KEY `id_prov` (`id_prov`);

--
-- Indeks untuk tabel `t_prov`
--
ALTER TABLE `t_prov`
  ADD PRIMARY KEY (`id_prov`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_anggota`
--
ALTER TABLE `t_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `t_kota`
--
ALTER TABLE `t_kota`
  MODIFY `id_kota` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `t_prov`
--
ALTER TABLE `t_prov`
  MODIFY `id_prov` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_anggota`
--
ALTER TABLE `t_anggota`
  ADD CONSTRAINT `t_anggota_ibfk_1` FOREIGN KEY (`id_kota`) REFERENCES `t_kota` (`id_kota`);

--
-- Ketidakleluasaan untuk tabel `t_kota`
--
ALTER TABLE `t_kota`
  ADD CONSTRAINT `t_kota_ibfk_1` FOREIGN KEY (`id_prov`) REFERENCES `t_prov` (`id_prov`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
