-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.8.5-MariaDB - MariaDB Server
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pos_faizzz
CREATE DATABASE IF NOT EXISTS `pos_faizzz` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `pos_faizzz`;

-- Dumping structure for table pos_faizzz.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.cache: ~0 rows (approximately)

-- Dumping structure for table pos_faizzz.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.cache_locks: ~0 rows (approximately)

-- Dumping structure for table pos_faizzz.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table pos_faizzz.item_penjualan
CREATE TABLE IF NOT EXISTS `item_penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint(20) unsigned NOT NULL,
  `produk_id` bigint(20) unsigned NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_penjualan_penjualan_id_foreign` (`penjualan_id`),
  KEY `item_penjualan_produk_id_foreign` (`produk_id`),
  CONSTRAINT `item_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  CONSTRAINT `item_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.item_penjualan: ~0 rows (approximately)

-- Dumping structure for table pos_faizzz.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.jobs: ~0 rows (approximately)

-- Dumping structure for table pos_faizzz.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.job_batches: ~0 rows (approximately)

-- Dumping structure for table pos_faizzz.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.migrations: ~7 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '2026_01_19_014814_create_produk_table', 1),
	(6, '2026_01_19_015701_create_penjualan_table', 1),
	(7, '2026_01_19_020509_create_item_penjualan_table', 1);

-- Dumping structure for table pos_faizzz.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table pos_faizzz.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `status` enum('OPEN','COMPLETED') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.penjualan: ~50 rows (approximately)
INSERT INTO `penjualan` (`id`, `user_id`, `total_pembayaran`, `metode_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
	(1, 4, 9519260, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(2, 4, 4854001, 'TRANSFER', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(3, 3, 11563781, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(4, 3, 6104147, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(5, 4, 5469534, 'TRANSFER', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(6, 5, 3371730, 'TRANSFER', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(7, 4, 4460596, 'QRIS', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(8, 1, 3043188, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(9, 1, 6032120, 'CASH', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(10, 1, 4171930, 'TRANSFER', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(11, 1, 237192, 'CASH', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(12, 2, 2523276, 'QRIS', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(13, 2, 3322782, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(14, 3, 3573375, 'TRANSFER', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(15, 3, 2743048, 'QRIS', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(16, 1, 3772286, 'CASH', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(17, 3, 5136365, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(18, 3, 465573, 'TRANSFER', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(19, 5, 235854, 'CASH', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(20, 1, 1551664, 'CASH', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(21, 3, 8358180, 'QRIS', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(22, 2, 9356246, 'CASH', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(23, 2, 3309125, 'QRIS', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(24, 3, 3088454, 'CASH', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(25, 5, 7240663, 'TRANSFER', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(26, 5, 4655852, 'CASH', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(27, 5, 8478521, 'QRIS', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(28, 3, 8290967, 'CASH', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(29, 4, 3318890, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(30, 3, 4005392, 'CASH', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(31, 4, 6945776, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(32, 3, 6427819, 'CASH', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(33, 3, 4327208, 'TRANSFER', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(34, 3, 4724439, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(35, 2, 1201508, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(36, 3, 361964, 'QRIS', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(37, 2, 2472891, 'TRANSFER', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(38, 5, 853872, 'CASH', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(39, 5, 13362528, 'QRIS', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(40, 3, 2005020, 'QRIS', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(41, 2, 7817819, 'TRANSFER', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(42, 3, 7418357, 'QRIS', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(43, 2, 4039753, 'QRIS', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(44, 4, 7793817, 'CASH', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(45, 3, 1588830, 'CASH', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(46, 4, 8610634, 'TRANSFER', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(47, 4, 6232388, 'TRANSFER', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(48, 2, 3188317, 'CASH', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(49, 3, 5661404, 'TRANSFER', 'OPEN', '2026-09-10 19:53:10', '2026-09-10 19:53:10'),
	(50, 4, 8970375, 'TRANSFER', 'COMPLETED', '2026-09-10 19:53:10', '2026-09-10 19:53:10');

-- Dumping structure for table pos_faizzz.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_user_id_foreign` (`user_id`),
  KEY `produk_nama_index` (`nama`),
  CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.produk: ~0 rows (approximately)
INSERT INTO `produk` (`id`, `user_id`, `foto`, `nama`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
	(102, 3, 'products/HJykoNVnTzfju52D0300YJm8qWDfrpHLkpXQqieh.jpg', 'adidas balii', 300000, 500000, 5, '2026-09-10 21:02:40', '2026-09-10 21:02:40'),
	(103, 3, 'products/cWWd8DdUnLlQlIFkwxsIcc7RYBrNecz27IhXLgau.jpg', 'adidas samba', 1000000, 2000000, 6, '2026-09-10 21:04:31', '2026-09-10 21:04:45');

-- Dumping structure for table pos_faizzz.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.roles: ~0 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2026-09-10 19:53:05', '2026-09-10 19:53:05'),
	(2, 'kasir', '2026-09-10 19:53:05', '2026-09-10 19:53:05');

-- Dumping structure for table pos_faizzz.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('9aNDQauiLxWeixNzn3UaY8NJHAiINaWviCEgAAWx', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVDlsZGdRME96cWZQdGRzNjBBbGFaOFl5NTNvUkdFTXRCWUJlUE9LZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWsiO3M6NToicm91dGUiO3M6MTI6InByb2R1ay5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1789110083),
	('D2BIXNTEiL2baclSNQIGJxRIZPgEZALm2uTAPmrm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNFFDSm1RRkg2R09MdEZEMkwyTzNETk80ck5HRDl0aThoQjJBb1Q4SiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1789109870),
	('GCmncIGLQ0fYTryruPWesRcR3wWGHu8npqyhnM7r', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ3RUbWxjTnNsV1cxNURjNmpJT05IakxtdkZCUDcxRjZFTnJaclZ0ZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWsiO3M6NToicm91dGUiO3M6MTI6InByb2R1ay5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1789104800),
	('kMT4XGh3YTwHNvgARejPPiA3BSMpR1OifCWQYd8E', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVZ1YlpQY0xldnAwZzkyQkRsRVBta3Y1RlV4Y1lDVnpRb1dDYnp0NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1789095096);

-- Dumping structure for table pos_faizzz.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  FULLTEXT KEY `users_name_email_fulltext` (`name`,`email`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_faizzz.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Ms. Gladys Schaden III', 'maxwell19@example.org', '2026-09-10 19:53:07', '$2y$12$wPV8Wbfv5WKSuDKmfeQ1COTQDq5Mm2Ku/8skpR9usItSVZ1pacIB2', 'TnbndwN7le', '2026-09-10 19:53:08', '2026-09-10 19:53:08'),
	(2, 1, 'Pearlie Marquardt', 'ohara.clay@example.org', '2026-09-10 19:53:08', '$2y$12$wPV8Wbfv5WKSuDKmfeQ1COTQDq5Mm2Ku/8skpR9usItSVZ1pacIB2', 'IOh44TInHE', '2026-09-10 19:53:08', '2026-09-10 19:53:08'),
	(3, 1, 'Paris Kuhlman', 'bennett.beatty@example.org', '2026-09-10 19:53:08', '$2y$12$wPV8Wbfv5WKSuDKmfeQ1COTQDq5Mm2Ku/8skpR9usItSVZ1pacIB2', 'JSveCsrSVG', '2026-09-10 19:53:08', '2026-09-10 19:53:08'),
	(4, 2, 'Prof. Manuela Hammes', 'shanahan.marc@example.com', '2026-09-10 19:53:08', '$2y$12$wPV8Wbfv5WKSuDKmfeQ1COTQDq5Mm2Ku/8skpR9usItSVZ1pacIB2', 'xdCLcTXn1s', '2026-09-10 19:53:08', '2026-09-10 19:53:08'),
	(5, 2, 'Betsy Dickinson', 'delilah.yost@example.net', '2026-09-10 19:53:08', '$2y$12$wPV8Wbfv5WKSuDKmfeQ1COTQDq5Mm2Ku/8skpR9usItSVZ1pacIB2', 'yvzvZ6lIAh', '2026-09-10 19:53:08', '2026-09-10 19:53:08'),
	(6, 1, 'Test User', 'test@example.com', '2026-09-10 19:53:11', '$2y$12$wPV8Wbfv5WKSuDKmfeQ1COTQDq5Mm2Ku/8skpR9usItSVZ1pacIB2', 'QRAnbdPyfI', '2026-09-10 19:53:11', '2026-09-10 19:53:11');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
