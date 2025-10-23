-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2025 at 09:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servicycle`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_services`
--

CREATE TABLE `booking_services` (
  `id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `workshop_id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `booking_date` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_03_135224_add_google_id_to_users_table', 2),
(5, '2025_09_17_152314_add_role_to_users_table', 3),
(6, '2025_09_17_152730_add_is_set_role_to_users_table', 4),
(7, '2025_09_29_103846_add_is_active_to_users_table', 5),
(8, '2025_10_14_214718_create_workshops_table', 6),
(9, '2025_10_15_134936_create_vehicles_table', 7),
(10, '2025_10_15_164133_add_image_to_vehicles_table', 8),
(11, '2025_10_19_212758_create_workshop_images_table', 9),
(12, '2025_10_19_213532_create_personal_access_tokens_table', 9),
(13, '2025_10_23_145019_create_booking_services_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('z2c1t67poBTfVIGVNOtreWDdZfWwCuN3x2EWyzXj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieDU1SDl5akR3a1g4VlozRm5KSHNlSjdMaklKMEJNbE1GVTFIMEJqZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC93b3Jrc2hvcC8yOCI7fX0=', 1761210416);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','vehicle_owner','workshop') COLLATE utf8mb4_unicode_ci DEFAULT 'vehicle_owner',
  `is_set_role` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `google_id`, `avatar`, `role`, `is_set_role`, `is_active`) VALUES
(25, 'Mabrur Almutaqi', 'mabruralmutaqi@gmail.com', NULL, '$2y$12$quMCVhpOSSnF6dFk5xQBvupOlmJLFJ6iJkkL3738KrNom52dngJuu', 'EIaK9viB5M2ymHAPNmVDkpKYQxpcWJ5iCjv3fgoMZbFAEP4q5t04z5dcZFUU', '2025-09-30 04:47:29', '2025-10-23 04:39:55', '115306521754361552074', 'https://lh3.googleusercontent.com/a/ACg8ocLXVt_ohIcbr_8xWVQIq39i4FKTUn5e3xepI-QIAMe7D6tCXuk=s96-c', 'admin', 1, 1),
(51, 'mabrur al', 'mabrural814@gmail.com', NULL, '$2y$12$kft4bk3q2ER/Uu9/vtYjKOels.5pxHyxb6lhU1vThVeOKLc8g2ls6', NULL, '2025-10-21 07:19:32', '2025-10-21 07:19:35', '105054842331965065215', 'https://lh3.googleusercontent.com/a/ACg8ocLTu9usFzJN5El9iJbDtz4FPuQkkhbPIi7hERK2aZWRfDkpDyc=s96-c', 'workshop', 1, 1),
(52, 'almutaqi', 'almutaqi6@gmail.com', NULL, '$2y$12$cB0.q.YJAbTgsBssA0oVturL6Kt3VOiU6NvsVs39jZ6r5Kt7UdMFG', NULL, '2025-10-21 07:26:45', '2025-10-23 08:55:59', '112594718434082682550', 'https://lh3.googleusercontent.com/a/ACg8ocIN9lD0qiRMDtmO8_Vubtpbbnkdf6SzSHnKieFqwWsuBejeEg=s96-c', 'workshop', 1, 1),
(53, 'Global Petro Pasifik', 'globalpetropasifik1@gmail.com', NULL, '$2y$12$SjWF7WhaWVszMqUG4j32Ge6.P5QvmNdO57ZFzxDDcqdiVVbRLrEf2', NULL, '2025-10-21 07:44:49', '2025-10-22 04:19:29', '105364849534881686130', 'https://lh3.googleusercontent.com/a/ACg8ocLiM62KdP9OpHe0hbmspTF6wk3hHSJIutSlfISI5OU0GjBZxA=s96-c', 'workshop', 1, 1),
(54, 'Nautica Samudera Lines', 'nauticasamuderalines@gmail.com', NULL, '$2y$12$wc/u4O.sXqO7rUx5VcVxf.Syk8beS0YTqfpidTCV5B8RBQx3hlNyO', NULL, '2025-10-21 09:18:01', '2025-10-21 09:18:03', '117124094153845000228', 'https://lh3.googleusercontent.com/a/ACg8ocLwYMvHd2b_AC1LPhunjliLU2BHGe4xlTC8x7vkJTUApqvw=s96-c', 'workshop', 1, 1),
(55, 'bengkel poltek', 'bengkelcecesp@gmail.com', NULL, '$2y$12$U87lf2cmme3qFQi79Z5IOeMGzF0Kpfkkow5w5kELIQSfVwkT.cD2O', NULL, '2025-10-21 12:50:22', '2025-10-21 12:50:30', NULL, NULL, 'workshop', 1, 1),
(56, 'nando', 'nando@gmail.com', NULL, '$2y$12$fWrFAn4kaCoYPgrPnjv61OgVRLxGcpFnicEUALTT5yqU3Y9Y2oTYa', NULL, '2025-10-21 12:56:02', '2025-10-21 12:56:06', NULL, NULL, 'vehicle_owner', 1, 1),
(57, 'Bengkel Nongsa', 'abcd@gmail.com', NULL, '$2y$12$Erlh2b7UgC00HHa1/BCH/ekNocpLPNG8kWxGJc57QH9iNFymIzfo2', NULL, '2025-10-21 13:37:48', '2025-10-21 13:38:00', NULL, NULL, 'workshop', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_type` enum('motor','mobil') COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year NOT NULL,
  `license_plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Vehicle Identification Number',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine_capacity` int NOT NULL COMMENT 'Kapasitas mesin dalam CC',
  `transmission` enum('manual','matic','automatic') COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_type` enum('pertalite','pertamax','solar','listrik') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `types` json NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` json NOT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operating_hours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`id`, `name`, `types`, `address`, `province`, `city`, `district`, `village`, `postal_code`, `latitude`, `longitude`, `phone`, `email`, `services`, `specialization`, `operating_hours`, `description`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(24, 'Batam Jaya Motor', '[\"motor\"]', 'Ruko, Blk. L Jl. Golden Land No.7, Taman Baloi, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29432', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'BATAM KOTA', 'TAMAN BALOI', '29432', 1.109907, 104.041208, '0778468205', 'admin@bengkel', '[\"service_rutin\", \"ganti_oli\", \"tune_up\", \"perbaikan_mesin\", \"perbaikan_rem\", \"ganti_ban\", \"servis_ac\", \"kelistrikan\"]', 'Khusus Motor', '24jam', 'Menyediakan servis motor lengkap mulai dari ganti oli, spooring roda, tune up, hingga perbaikan mesin. Cocok untuk semua jenis motor, baik matic maupun manual.', 'pending', 51, '2025-10-21 07:25:13', '2025-10-21 07:25:13'),
(25, 'Sun Jaya Bengkel Motor', '[\"motor\"]', 'Ruko, Blk. L Jl. Golden Land No.8, Taman Baloi, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29432', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'BATAM KOTA', 'TAMAN BALOI', '29432', 1.110395, 104.041332, '08117033168', 'admin@bengkel', '[\"service_rutin\", \"ganti_oli\", \"tune_up\", \"perbaikan_mesin\", \"perbaikan_rem\", \"ganti_ban\", \"servis_ac\", \"kelistrikan\"]', 'All Tipe Khusus Motor', 'Senin-Sabtu 07:00-18:30, Minggu 07:30-17:30', 'Menyediakan servis motor lengkap mulai dari ganti oli, spooring roda, tune up, hingga perbaikan mesin. Cocok untuk semua jenis motor, baik matic maupun manual.', 'pending', 52, '2025-10-21 07:33:34', '2025-10-21 07:33:34'),
(26, 'Singkawang Motor', '[\"motor\"]', 'Ruko Jl. Legenda Malaka No.5 Blok C1, Baloi Permai, Batam Kota, Batam City, Riau Islands 29444', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'BATAM KOTA', 'BALOI PERMAI', '29444', 1.101934, 104.053380, '08127004106', NULL, '[\"service_rutin\", \"ganti_oli\", \"tune_up\", \"perbaikan_mesin\", \"perbaikan_rem\", \"ganti_ban\", \"servis_ac\", \"kelistrikan\"]', 'Powered by Zeneos', 'Buka Setiap Hari 08:00 - 18:00', 'Menyediakan servis motor lengkap mulai dari ganti oli, spooring roda, tune up, hingga perbaikan mesin. Cocok untuk semua jenis motor, baik matic maupun manual.', 'pending', 53, '2025-10-21 07:54:47', '2025-10-21 07:54:47'),
(27, 'Dewa Motor Indonesia, Batu Aji Baru Batam', '[\"motor\"]', '9 No. 10, Baru, Jl. Batu Aji Baru Blk. A, Sungai Langkai, Kec. Sagulung, Kota Batam, Kepulauan Riau', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'SAGULUNG', 'SUNGAI LANGKAI', NULL, 1.036671, 103.962733, '-', NULL, '[\"service_rutin\", \"ganti_oli\", \"tune_up\", \"perbaikan_mesin\", \"perbaikan_rem\", \"ganti_ban\", \"kelistrikan\"]', 'Ban & Sparepart Bergaransi', '08:00 - 20:00', 'Menyediakan servis motor lengkap mulai dari ganti oli, spooring roda, tune up, hingga perbaikan mesin. Cocok untuk semua jenis motor, baik matic maupun manual.', 'pending', 54, '2025-10-21 09:24:48', '2025-10-21 09:24:48'),
(28, 'Bengkel Poltek', '[\"motor\"]', 'Politeknik', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'BATAM KOTA', 'BELIAN', NULL, 1.118638, 104.047259, '0778468205', NULL, '[\"service_rutin\", \"ganti_oli\", \"tune_up\", \"perbaikan_mesin\", \"perbaikan_rem\"]', 'Semua brand', '08:00-17:00', 'Terpercaya di Batam', 'pending', 55, '2025-10-21 12:53:03', '2025-10-21 12:53:03'),
(29, 'Bengkel Nongsa', '[\"mobil\"]', 'Nongsa', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'NONGSA', 'SAMBAU', NULL, 1.110974, 104.133987, '082178192938', NULL, '[\"service_rutin\", \"ganti_oli\", \"tune_up\", \"perbaikan_mesin\", \"perbaikan_rem\", \"ganti_ban\", \"kelistrikan\"]', 'All Type', '09:00-18:00', 'Terpecaya, amanah, dan terbukti kualitas', 'pending', 57, '2025-10-21 13:40:03', '2025-10-21 13:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_images`
--

CREATE TABLE `workshop_images` (
  `id` bigint UNSIGNED NOT NULL,
  `workshop_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workshop_images`
--

INSERT INTO `workshop_images` (`id`, `workshop_id`, `image_path`, `image_name`, `order`, `is_primary`, `created_at`, `updated_at`) VALUES
(23, 24, 'workshop-images/iniWQOUpakkTmywjLvPIcTjEYBYSivn6aGEBoNFf.png', 'simpkara4.png', 0, 1, '2025-10-21 07:25:14', '2025-10-21 07:25:14'),
(24, 24, 'workshop-images/2Dq4VMTr9Fxo6ZtcJXpL9yqCW5K123hBMT7ktCtN.png', 'simpkara3.png', 1, 0, '2025-10-21 07:25:14', '2025-10-21 07:25:14'),
(25, 24, 'workshop-images/n8v3xdM67eYUxv9Q9htqb4yJPjy5ACN6HAcCRgIn.png', 'simpkara2.png', 2, 0, '2025-10-21 07:25:14', '2025-10-21 07:25:14'),
(26, 24, 'workshop-images/ObyX3zzaVFsWNYzYBJsrbWrUQ5q8UJ5T6wZr237h.png', 'simpkara.png', 3, 0, '2025-10-21 07:25:14', '2025-10-21 07:25:14'),
(27, 25, 'workshop-images/Y39gw3ieILlwWbdULgUQZBHuyrNnEIQhcgwMhvwP.png', 'sj1.png', 0, 1, '2025-10-21 07:33:34', '2025-10-21 07:33:34'),
(28, 25, 'workshop-images/OmwDYIr72sSEVaSRrjP2kcC1SnJxWVdAnluO8Vha.png', 'sj2.png', 1, 0, '2025-10-21 07:33:34', '2025-10-21 07:33:34'),
(29, 25, 'workshop-images/UYtXBS4rVPSDZc1iIxPCNey0x0z8GRYZooIqmM33.png', 'sj3.png', 2, 0, '2025-10-21 07:33:34', '2025-10-21 07:33:34'),
(30, 25, 'workshop-images/NrK1q7P4rPWsbtxUPvZQeS9nrsr5bPfautZPnLSk.png', 'sj4.png', 3, 0, '2025-10-21 07:33:34', '2025-10-21 07:33:34'),
(31, 26, 'workshop-images/6EidFykaDRsr0AzzSdeDjWVWq7x0zFZhKHSQkLdo.png', 'sw1.png', 0, 1, '2025-10-21 07:54:47', '2025-10-21 07:54:47'),
(32, 26, 'workshop-images/ZZz5DlkmEKNI0z7kvhlv9dB5TwPLLmYKZquPgNC5.png', 'sw3.png', 1, 0, '2025-10-21 07:54:47', '2025-10-21 07:54:47'),
(33, 26, 'workshop-images/Yw0ZeE14Q3JH5I5c6WM7myqRQzjnbSxYSv7lQ9b0.png', 'sw2.png', 2, 0, '2025-10-21 07:54:47', '2025-10-21 07:54:47'),
(34, 27, 'workshop-images/K37NqGqqFLrnrZ397oDhjQby3977sKOtGUvWV2GS.png', 'dm1.png', 0, 1, '2025-10-21 09:24:48', '2025-10-21 09:24:48'),
(35, 27, 'workshop-images/OzFillkU9XIjgC2dJH5MpU6NCqVGp9pQIZzM34aE.png', 'dm2.png', 1, 0, '2025-10-21 09:24:48', '2025-10-21 09:24:48'),
(36, 27, 'workshop-images/Rn5D5sgBEcVPged7c61PJVHmuk99JyT81qIyZ0nA.png', 'dm3.png', 2, 0, '2025-10-21 09:24:48', '2025-10-21 09:24:48'),
(37, 28, 'workshop-images/D6pgn3T7VsD1CLgHUlc92AzrhteHCMfgDnih0VSv.png', 'honda-btc.png', 0, 1, '2025-10-21 12:53:04', '2025-10-21 12:53:04'),
(38, 29, 'workshop-images/gacG67lAD7wzbSN15ezGFKFeZtPlSRjuUUk5aXbm.png', 'suzuki-baloi.png', 0, 1, '2025-10-21 13:40:03', '2025-10-21 13:40:03'),
(39, 29, 'workshop-images/ILemV2DcTLSpwNlh9ujinzQP1g2xFD2PHRv9YRHj.png', 'dm2.png', 1, 0, '2025-10-21 13:40:03', '2025-10-21 13:40:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_services`
--
ALTER TABLE `booking_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_services_created_by_foreign` (`created_by`),
  ADD KEY `booking_services_workshop_id_foreign` (`workshop_id`),
  ADD KEY `booking_services_vehicle_id_foreign` (`vehicle_id`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_license_plate_unique` (`license_plate`),
  ADD UNIQUE KEY `vehicles_vin_unique` (`vin`),
  ADD KEY `vehicles_created_by_foreign` (`created_by`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workshops_created_by_foreign` (`created_by`);

--
-- Indexes for table `workshop_images`
--
ALTER TABLE `workshop_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workshop_images_workshop_id_foreign` (`workshop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_services`
--
ALTER TABLE `booking_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `workshop_images`
--
ALTER TABLE `workshop_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_services`
--
ALTER TABLE `booking_services`
  ADD CONSTRAINT `booking_services_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_services_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_services_workshop_id_foreign` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workshop_images`
--
ALTER TABLE `workshop_images`
  ADD CONSTRAINT `workshop_images_workshop_id_foreign` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
