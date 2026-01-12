-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 01, 2026 at 08:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '$2y$12$VCLGl9XjBDLb1Z1RiXkeW.SRzSn44oJqUsbyMcuOM7x5tn/fWh2Ca');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_studio`
--

CREATE TABLE `jadwal_studio` (
  `id_jadwal` int NOT NULL,
  `id_admin` int NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal_studio`
--

INSERT INTO `jadwal_studio` (`id_jadwal`, `id_admin`, `tanggal`, `jam_mulai`, `jam_selesai`, `status`) VALUES
(1, 1, '2025-12-22', '10:00:00', '11:00:00', 'tersedia'),
(2, 1, '2025-12-22', '12:00:00', '13:00:00', 'tersedia'),
(3, 1, '2025-12-22', '14:00:00', '15:00:00', 'tersedia'),
(4, 1, '2025-12-22', '16:00:00', '17:00:00', 'tersedia'),
(5, 1, '2025-12-22', '18:00:00', '19:00:00', 'tersedia'),
(6, 1, '2025-12-23', '10:00:00', '11:00:00', 'tersedia'),
(7, 1, '2025-12-23', '12:00:00', '13:00:00', 'tersedia'),
(8, 1, '2025-12-23', '14:00:00', '15:00:00', 'tersedia'),
(9, 1, '2025-12-23', '16:00:00', '17:00:00', 'tersedia'),
(10, 1, '2025-12-23', '18:00:00', '19:00:00', 'tersedia'),
(11, 1, '2025-12-24', '10:00:00', '11:00:00', 'tersedia'),
(12, 1, '2025-12-24', '12:00:00', '13:00:00', 'tersedia'),
(13, 1, '2025-12-24', '14:00:00', '15:00:00', 'tersedia'),
(14, 1, '2025-12-24', '16:00:00', '17:00:00', 'tersedia'),
(15, 1, '2025-12-24', '18:00:00', '19:00:00', 'tersedia'),
(16, 1, '2025-12-25', '10:00:00', '11:00:00', 'tersedia'),
(17, 1, '2025-12-25', '12:00:00', '13:00:00', 'tersedia'),
(18, 1, '2025-12-25', '14:00:00', '15:00:00', 'tersedia'),
(19, 1, '2025-12-25', '16:00:00', '17:00:00', 'tersedia'),
(20, 1, '2025-12-25', '18:00:00', '19:00:00', 'tersedia'),
(21, 1, '2025-12-26', '10:00:00', '11:00:00', 'tersedia'),
(22, 1, '2025-12-26', '12:00:00', '13:00:00', 'tersedia'),
(23, 1, '2025-12-26', '14:00:00', '15:00:00', 'tersedia'),
(24, 1, '2025-12-26', '16:00:00', '17:00:00', 'tersedia'),
(25, 1, '2025-12-26', '18:00:00', '19:00:00', 'tersedia'),
(26, 1, '2025-12-27', '10:00:00', '11:00:00', 'tersedia'),
(27, 1, '2025-12-27', '12:00:00', '13:00:00', 'tersedia'),
(28, 1, '2025-12-27', '14:00:00', '15:00:00', 'tersedia'),
(29, 1, '2025-12-27', '16:00:00', '17:00:00', 'tersedia'),
(30, 1, '2025-12-27', '18:00:00', '19:00:00', 'tersedia'),
(31, 1, '2025-12-28', '10:00:00', '11:00:00', 'tersedia'),
(32, 1, '2025-12-28', '12:00:00', '13:00:00', 'tersedia'),
(33, 1, '2025-12-28', '14:00:00', '15:00:00', 'tersedia'),
(34, 1, '2025-12-28', '16:00:00', '17:00:00', 'tersedia'),
(35, 1, '2025-12-28', '18:00:00', '19:00:00', 'tersedia'),
(36, 1, '2025-12-29', '10:00:00', '11:00:00', 'tersedia'),
(37, 1, '2025-12-29', '12:00:00', '13:00:00', 'tersedia'),
(38, 1, '2025-12-29', '14:00:00', '15:00:00', 'tersedia'),
(39, 1, '2025-12-29', '16:00:00', '17:00:00', 'tersedia'),
(40, 1, '2025-12-29', '18:00:00', '19:00:00', 'tersedia'),
(41, 1, '2025-12-30', '10:00:00', '11:00:00', 'tersedia'),
(42, 1, '2025-12-30', '12:00:00', '13:00:00', 'tersedia'),
(43, 1, '2025-12-30', '14:00:00', '15:00:00', 'tersedia'),
(44, 1, '2025-12-30', '16:00:00', '17:00:00', 'tersedia'),
(45, 1, '2025-12-30', '18:00:00', '19:00:00', 'tersedia'),
(46, 1, '2025-12-31', '10:00:00', '11:00:00', 'tersedia'),
(47, 1, '2025-12-31', '12:00:00', '13:00:00', 'tersedia'),
(48, 1, '2025-12-31', '14:00:00', '15:00:00', 'tersedia'),
(49, 1, '2025-12-31', '16:00:00', '17:00:00', 'tersedia'),
(50, 1, '2025-12-31', '18:00:00', '19:00:00', 'tersedia'),
(51, 1, '2026-01-01', '10:00:00', '11:00:00', 'tersedia'),
(52, 1, '2026-01-01', '12:00:00', '13:00:00', 'tersedia'),
(53, 1, '2026-01-01', '14:00:00', '15:00:00', 'tersedia'),
(54, 1, '2026-01-01', '16:00:00', '17:00:00', 'tersedia'),
(55, 1, '2026-01-01', '18:00:00', '19:00:00', 'tersedia'),
(56, 1, '2026-01-02', '10:00:00', '11:00:00', 'tersedia'),
(57, 1, '2026-01-02', '12:00:00', '13:00:00', 'tersedia'),
(58, 1, '2026-01-02', '14:00:00', '15:00:00', 'tersedia'),
(59, 1, '2026-01-02', '16:00:00', '17:00:00', 'tersedia'),
(60, 1, '2026-01-02', '18:00:00', '19:00:00', 'tersedia'),
(61, 1, '2026-01-03', '10:00:00', '11:00:00', 'tersedia'),
(62, 1, '2026-01-03', '12:00:00', '13:00:00', 'tersedia'),
(63, 1, '2026-01-03', '14:00:00', '15:00:00', 'tersedia'),
(64, 1, '2026-01-03', '16:00:00', '17:00:00', 'tersedia'),
(65, 1, '2026-01-03', '18:00:00', '19:00:00', 'tersedia'),
(66, 1, '2026-01-04', '10:00:00', '11:00:00', 'tersedia'),
(67, 1, '2026-01-04', '12:00:00', '13:00:00', 'tersedia'),
(68, 1, '2026-01-04', '14:00:00', '15:00:00', 'tersedia'),
(69, 1, '2026-01-04', '16:00:00', '17:00:00', 'tersedia'),
(70, 1, '2026-01-04', '18:00:00', '19:00:00', 'tersedia'),
(71, 1, '2026-01-05', '10:00:00', '11:00:00', 'tersedia'),
(72, 1, '2026-01-05', '12:00:00', '13:00:00', 'tersedia'),
(73, 1, '2026-01-05', '14:00:00', '15:00:00', 'tersedia'),
(74, 1, '2026-01-05', '16:00:00', '17:00:00', 'tersedia'),
(75, 1, '2026-01-05', '18:00:00', '19:00:00', 'tersedia'),
(76, 1, '2026-01-06', '10:00:00', '11:00:00', 'tersedia'),
(77, 1, '2026-01-06', '12:00:00', '13:00:00', 'tersedia'),
(78, 1, '2026-01-06', '14:00:00', '15:00:00', 'tersedia'),
(79, 1, '2026-01-06', '16:00:00', '17:00:00', 'tersedia'),
(80, 1, '2026-01-06', '18:00:00', '19:00:00', 'tersedia'),
(81, 1, '2026-01-07', '10:00:00', '11:00:00', 'tersedia'),
(82, 1, '2026-01-07', '12:00:00', '13:00:00', 'tersedia'),
(83, 1, '2026-01-07', '14:00:00', '15:00:00', 'tersedia'),
(84, 1, '2026-01-07', '16:00:00', '17:00:00', 'tersedia'),
(85, 1, '2026-01-07', '18:00:00', '19:00:00', 'tersedia'),
(86, 1, '2026-01-08', '10:00:00', '11:00:00', 'tersedia'),
(87, 1, '2026-01-08', '12:00:00', '13:00:00', 'tersedia'),
(88, 1, '2026-01-08', '14:00:00', '15:00:00', 'tersedia'),
(89, 1, '2026-01-08', '16:00:00', '17:00:00', 'tersedia'),
(90, 1, '2026-01-08', '18:00:00', '19:00:00', 'tersedia'),
(91, 1, '2026-01-09', '10:00:00', '11:00:00', 'tersedia'),
(92, 1, '2026-01-09', '12:00:00', '13:00:00', 'tersedia'),
(93, 1, '2026-01-09', '14:00:00', '15:00:00', 'tersedia'),
(94, 1, '2026-01-09', '16:00:00', '17:00:00', 'tersedia'),
(95, 1, '2026-01-09', '18:00:00', '19:00:00', 'tersedia'),
(96, 1, '2026-01-10', '10:00:00', '11:00:00', 'tersedia'),
(97, 1, '2026-01-10', '12:00:00', '13:00:00', 'tersedia'),
(98, 1, '2026-01-10', '14:00:00', '15:00:00', 'tersedia'),
(99, 1, '2026-01-10', '16:00:00', '17:00:00', 'tersedia'),
(100, 1, '2026-01-10', '18:00:00', '19:00:00', 'tersedia'),
(101, 1, '2026-01-11', '10:00:00', '11:00:00', 'tersedia'),
(102, 1, '2026-01-11', '12:00:00', '13:00:00', 'tersedia'),
(103, 1, '2026-01-11', '14:00:00', '15:00:00', 'tersedia'),
(104, 1, '2026-01-11', '16:00:00', '17:00:00', 'tersedia'),
(105, 1, '2026-01-11', '18:00:00', '19:00:00', 'tersedia'),
(106, 1, '2026-01-12', '10:00:00', '11:00:00', 'tersedia'),
(107, 1, '2026-01-12', '12:00:00', '13:00:00', 'tersedia'),
(108, 1, '2026-01-12', '14:00:00', '15:00:00', 'tersedia'),
(109, 1, '2026-01-12', '16:00:00', '17:00:00', 'tersedia'),
(110, 1, '2026-01-12', '18:00:00', '19:00:00', 'tersedia'),
(111, 1, '2026-01-13', '10:00:00', '11:00:00', 'tersedia'),
(112, 1, '2026-01-13', '12:00:00', '13:00:00', 'tersedia'),
(113, 1, '2026-01-13', '14:00:00', '15:00:00', 'tersedia'),
(114, 1, '2026-01-13', '16:00:00', '17:00:00', 'tersedia'),
(115, 1, '2026-01-13', '18:00:00', '19:00:00', 'tersedia'),
(116, 1, '2026-01-14', '10:00:00', '11:00:00', 'tersedia'),
(117, 1, '2026-01-14', '12:00:00', '13:00:00', 'tersedia'),
(118, 1, '2026-01-14', '14:00:00', '15:00:00', 'tersedia'),
(119, 1, '2026-01-14', '16:00:00', '17:00:00', 'tersedia'),
(120, 1, '2026-01-14', '18:00:00', '19:00:00', 'tersedia'),
(121, 1, '2026-01-15', '10:00:00', '11:00:00', 'tersedia'),
(122, 1, '2026-01-15', '12:00:00', '13:00:00', 'tersedia'),
(123, 1, '2026-01-15', '14:00:00', '15:00:00', 'tersedia'),
(124, 1, '2026-01-15', '16:00:00', '17:00:00', 'tersedia'),
(125, 1, '2026-01-15', '18:00:00', '19:00:00', 'tersedia'),
(126, 1, '2026-01-16', '10:00:00', '11:00:00', 'tersedia'),
(127, 1, '2026-01-16', '12:00:00', '13:00:00', 'tersedia'),
(128, 1, '2026-01-16', '14:00:00', '15:00:00', 'tersedia'),
(129, 1, '2026-01-16', '16:00:00', '17:00:00', 'tersedia'),
(130, 1, '2026-01-16', '18:00:00', '19:00:00', 'tersedia'),
(131, 1, '2026-01-17', '10:00:00', '11:00:00', 'tersedia'),
(132, 1, '2026-01-17', '12:00:00', '13:00:00', 'tersedia'),
(133, 1, '2026-01-17', '14:00:00', '15:00:00', 'tersedia'),
(134, 1, '2026-01-17', '16:00:00', '17:00:00', 'tersedia'),
(135, 1, '2026-01-17', '18:00:00', '19:00:00', 'tersedia'),
(136, 1, '2026-01-18', '10:00:00', '11:00:00', 'tersedia'),
(137, 1, '2026-01-18', '12:00:00', '13:00:00', 'tersedia'),
(138, 1, '2026-01-18', '14:00:00', '15:00:00', 'tersedia'),
(139, 1, '2026-01-18', '16:00:00', '17:00:00', 'tersedia'),
(140, 1, '2026-01-18', '18:00:00', '19:00:00', 'tersedia'),
(141, 1, '2026-01-19', '10:00:00', '11:00:00', 'tersedia'),
(142, 1, '2026-01-19', '12:00:00', '13:00:00', 'tersedia'),
(143, 1, '2026-01-19', '14:00:00', '15:00:00', 'tersedia'),
(144, 1, '2026-01-19', '16:00:00', '17:00:00', 'tersedia'),
(145, 1, '2026-01-19', '18:00:00', '19:00:00', 'tersedia'),
(146, 1, '2026-01-20', '10:00:00', '11:00:00', 'tersedia'),
(147, 1, '2026-01-20', '12:00:00', '13:00:00', 'tersedia'),
(148, 1, '2026-01-20', '14:00:00', '15:00:00', 'tersedia'),
(149, 1, '2026-01-20', '16:00:00', '17:00:00', 'tersedia'),
(150, 1, '2026-01-20', '18:00:00', '19:00:00', 'tersedia'),
(151, 1, '2026-01-21', '10:00:00', '11:00:00', 'tersedia'),
(152, 1, '2026-01-21', '12:00:00', '13:00:00', 'tersedia'),
(153, 1, '2026-01-21', '14:00:00', '15:00:00', 'tersedia'),
(154, 1, '2026-01-21', '16:00:00', '17:00:00', 'tersedia'),
(155, 1, '2026-01-21', '18:00:00', '19:00:00', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int NOT NULL,
  `id_admin` int NOT NULL,
  `nama_layanan` varchar(150) NOT NULL,
  `harga` int NOT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL,
  `warna_btn` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `id_admin`, `nama_layanan`, `harga`, `deskripsi`, `gambar`, `warna_btn`) VALUES
(1, 1, 'K – Cut Package', 50000, NULL, 'kcut.png', 'bg-[#cc0000] text-white'),
(2, 1, 'Basic Package', 75000, NULL, 'basic.png', 'bg-[#ffcc00] text-black'),
(3, 1, 'Self Pass Photo', 40000, NULL, 'self.png', 'bg-[#66cc66] text-white');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '2025_12_11_080754_create_sessions_table', 1),
(3, '2025_12_22_134842_create_bookings_table', 2),
(4, '2025_12_23_103437_add_warna_btn_to_layanan_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int NOT NULL,
  `id_pemesanan` int NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `waktu_kirim` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `whatsapp` varchar(30) NOT NULL,
  `email` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_pemesanan` int NOT NULL,
  `jumlah` int NOT NULL,
  `waktu_pembayaran` datetime DEFAULT NULL,
  `status_verifikasi` varchar(30) NOT NULL,
  `metode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_layanan` int NOT NULL,
  `id_jadwal` int NOT NULL,
  `jumlah_customer` int NOT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status_pemesanan` varchar(50) NOT NULL,
  `tanggal_pesan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('26uOECmMRXzrWauLQrjxClnvnA8itHAHlGSIg4Zb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicThSZFBWUno3c1BFelFYSU5IdnRKTFIzM3hYSkx2N052N3ZQZGRwdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ib29raW5nL2RldGFpbC84MS8xIjtzOjU6InJvdXRlIjtzOjE0OiJib29raW5nLmRldGFpbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767256920),
('r5MPf6EyfCM8BWdsqErcckPvyDZeYhOCEz00JYs9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamxnQUczNW1TNEdkZ1lpY3FpUDlCN0JGTm1seGpyeE1ZazZjU2RhMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ib29raW5nP3Bha2V0PTEiO3M6NToicm91dGUiO3M6NzoiYm9va2luZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767254088);

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id_testimoni` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_pemesanan` int DEFAULT NULL,
  `rating` tinyint DEFAULT NULL,
  `isi` text,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `jadwal_studio`
--
ALTER TABLE `jadwal_studio`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_layanan` (`id_layanan`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id_testimoni`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_studio`
--
ALTER TABLE `jadwal_studio`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id_testimoni` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_studio`
--
ALTER TABLE `jadwal_studio`
  ADD CONSTRAINT `jadwal_studio_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `layanan`
--
ALTER TABLE `layanan`
  ADD CONSTRAINT `layanan_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_2` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `pemesanan_ibfk_3` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`),
  ADD CONSTRAINT `pemesanan_ibfk_4` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_studio` (`id_jadwal`);

--
-- Constraints for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `testimoni_ibfk_2` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
