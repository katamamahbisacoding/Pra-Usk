-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2025 at 07:54 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_usk`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_user` int NOT NULL,
  `nip` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_user`, `nip`, `username`, `email`, `password`, `created_at`) VALUES
(1, 11718, 'Kuro', 'kuronoru1@gmail.com', '$2y$10$wf4p9JifblC8nUy7ouVTNeOCK44hYep.D1XudYFti7WY0ix9vPSva', '2025-11-11 00:11:31'),
(8, 11723, 'Daffa Dwi Putra', 'dapaelsigma@1', '$2y$10$vie1DqNjAeX3M9kJcaXd6.VrQWBkt57l5w76rmgQqwOQGLUdE2tYS', '2025-11-11 00:27:02'),
(9, 11724, 'Yuda Aldiansyah', 'yuyud@9', '$2y$10$CYm/Y3RBrn6eCnXMoNFE1etb5nl71R6jsnB.7nceDqq8USNmg1KeW', '2025-11-11 00:27:32'),
(10, 11725, 'Billy Caesar Raja', 'billyjomok@gmail.com', '$2y$10$rS67Gr3ThDvZIgNlz6lVJ.kXGgT5YR4veBA1sb9yOfO23M6PvHTni', '2025-11-11 00:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id_kehadiran` int NOT NULL,
  `tanggal` date NOT NULL,
  `kehadiran` enum('Hadir','Sakit','Izin','Alpha','Terlambat') NOT NULL,
  `id_siswa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`id_kehadiran`, `tanggal`, `kehadiran`, `id_siswa`) VALUES
(2, '2025-11-10', 'Alpha', 7),
(5, '2025-11-09', 'Terlambat', 7),
(8, '2025-11-10', 'Sakit', 5),
(10, '2025-11-05', 'Izin', 7),
(12, '2025-11-01', 'Terlambat', 13);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama`, `kelas`, `gender`, `created_at`) VALUES
(5, 'Muhammad Arif Murdiansyah', 'XI TKJ', 'Laki-Laki', '2025-11-09 23:43:29'),
(7, 'Muhammad Hamman Desta', 'XI RPL', 'Laki-Laki', '2025-11-09 23:57:17'),
(12, 'Muhammad FadlanFadlan', 'XI RPL', 'Laki-Laki', '2025-11-10 18:00:12'),
(13, 'Muhammad Elsaba', 'XI RPL', 'Laki-Laki', '2025-11-10 18:00:49'),
(18, 'Harjinan Nurahma', 'XI AK', 'Perempuan', '2025-11-10 21:05:20'),
(19, 'Annaim Zakaria', 'XI RPL', 'Laki-Laki', '2025-11-10 22:06:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id_kehadiran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
