-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31 Jan 2017 pada 15.44
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rjf`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `jenis_id` int(5) NOT NULL,
  `jenis_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`jenis_id`, `jenis_nama`) VALUES
(1, 'Single'),
(2, 'Double');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasur`
--

CREATE TABLE `kasur` (
  `kasur_id` int(5) NOT NULL,
  `kasur_merk` varchar(100) NOT NULL,
  `kasur_harga` int(50) NOT NULL,
  `kasur_gambar` varchar(200) NOT NULL,
  `jenis_id` int(5) NOT NULL,
  `ukuran_id` int(5) NOT NULL,
  `kasur_waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kasur`
--

INSERT INTO `kasur` (`kasur_id`, `kasur_merk`, `kasur_harga`, `kasur_gambar`, `jenis_id`, `ukuran_id`, `kasur_waktu`) VALUES
(2, '2', 20000, '1485860876-2.jpg', 1, 2, '2017-01-31 17:40:33'),
(3, '1', 10000, '1485859355-1.jpg', 1, 1, '2017-01-31 17:42:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `pegawai_id` int(5) NOT NULL,
  `pegawai_nama` varchar(100) NOT NULL,
  `pegawai_jabatan` varchar(100) NOT NULL,
  `pegawai_username` varchar(100) NOT NULL,
  `pegawai_password` varchar(100) NOT NULL,
  `pegawai_level` enum('pegawai','pemilik') NOT NULL DEFAULT 'pegawai'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`pegawai_id`, `pegawai_nama`, `pegawai_jabatan`, `pegawai_username`, `pegawai_password`, `pegawai_level`) VALUES
(2, 'Ali Abdul Wahid', 'Manager', 'ali', '86318e52f5ed4801abe1d13d509443de', 'pegawai'),
(7, 'Nava Gia Ginasta', 'nava', 'nava', '533078acd91fffef2a525239de4a3dc9', 'pegawai'),
(8, 'agus', 'agus', 'agus', 'fdf169558242ee051cca1479770ebac3', 'pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(5) NOT NULL,
  `pelanggan_nama` varchar(100) NOT NULL,
  `pelanggan_username` varchar(100) NOT NULL,
  `pelanggan_password` varchar(100) NOT NULL,
  `pelanggan_alamat` text NOT NULL,
  `pelanggan_notlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('28e87090e7c6322fd63dd752fba06482', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.76 Safari/537.36', 1485872954, 'a:4:{s:12:"pegawai_nama";s:16:"Nava Gia Ginasta";s:16:"pegawai_username";s:4:"nava";s:13:"pegawai_level";s:7:"pegawai";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ukuran`
--

CREATE TABLE `ukuran` (
  `ukuran_id` int(5) NOT NULL,
  `ukuran_dimensi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ukuran`
--

INSERT INTO `ukuran` (`ukuran_id`, `ukuran_dimensi`) VALUES
(1, '190x120'),
(2, '100x70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`jenis_id`);

--
-- Indexes for table `kasur`
--
ALTER TABLE `kasur`
  ADD PRIMARY KEY (`kasur_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`pegawai_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`ukuran_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `jenis_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kasur`
--
ALTER TABLE `kasur`
  MODIFY `kasur_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `pegawai_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `ukuran_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
