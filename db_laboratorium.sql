-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220729.9c9ae5069e
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 01:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laboratorium`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) UNSIGNED NOT NULL,
  `id_peminjaman` int(11) UNSIGNED NOT NULL,
  `id_ruangan` int(11) UNSIGNED NOT NULL,
  `jam_mulai` varchar(100) NOT NULL,
  `jam_akhir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(15, '2022-08-03-013959', 'App\\Database\\Migrations\\Users', 'default', 'App', 1660990298, 1),
(16, '2022-08-12-025346', 'App\\Database\\Migrations\\Ruangan', 'default', 'App', 1660990298, 1),
(17, '2022-08-12-025354', 'App\\Database\\Migrations\\Status', 'default', 'App', 1660990298, 1),
(18, '2022-08-12-025401', 'App\\Database\\Migrations\\Peminjaman', 'default', 'App', 1660990298, 1),
(19, '2022-08-12-025409', 'App\\Database\\Migrations\\Jadwal', 'default', 'App', 1660990298, 1);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `status_peminjam` enum('dosen','mahasiswa') NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `asal_peminjam` enum('luar prodi','dalam prodi') NOT NULL,
  `surat_pengantar` varchar(255) DEFAULT NULL,
  `id_ruangan` int(11) UNSIGNED NOT NULL,
  `kapasitas` int(5) NOT NULL,
  `tgl_awal_pinjam` date NOT NULL,
  `tgl_akhir_pinjam` date NOT NULL,
  `kegiatan` text NOT NULL,
  `kode_status` varchar(255) DEFAULT NULL,
  `bukti_peminjaman` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) UNSIGNED NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`) VALUES
(1, 'Laboratorium 1'),
(2, 'Laboratorium 2'),
(3, 'Laboratorium 3'),
(4, 'Laboratorium 4'),
(5, 'Laboratorium 5');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `kode_status` varchar(255) NOT NULL,
  `id_peminjaman` int(11) UNSIGNED NOT NULL,
  `acc_laboran` enum('acc','tolak') DEFAULT NULL,
  `acc_kalab` enum('acc','tolak') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('kalab','laboran','peminjam') NOT NULL DEFAULT 'peminjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'kalab', '$2y$10$pIPUO5d/Y8Gkdtr4bi1r4uTaB6MEbIvcIXImRh1Ds0QaDu2MsbQE.', 'kalab'),
(2, 'laboran', '$2y$10$nHEWVkOP7Key/2pRC1lBPuF17QeVcZv5QMpepDylwPM0h1QuZ2KFa', 'laboran'),
(3, 'peminjam', '$2y$10$RYcWL8zvq02mglRkgPF3xOotOfkOA.AMGaHMSODTMD79Vm.CsTAXy', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`kode_status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
