-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2019 at 08:04 AM
-- Server version: 10.3.9-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporan-keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_04_10_094557_create_products_table', 2),
(4, '2019_04_10_095202_create_transactions_table', 3),
(5, '2019_04_11_014254_add_price_sale_to_product', 4),
(6, '2019_04_13_051626_create_permission_tables', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 3),
(2, 'App\\User', 4),
(3, 'App\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `price` decimal(13,2) NOT NULL DEFAULT 0.00,
  `price_sale` decimal(13,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `stock`, `price`, `price_sale`, `created_at`, `updated_at`) VALUES
(9, 'ASUS ZenBook Pro UX550', 'Deskripsi ASUS ZenBook Pro UX550', 5, '1000000.00', '1250000.00', '2019-04-11 04:20:51', '2019-04-11 04:57:28'),
(10, 'ASUS ROG GX700', 'Deskripsi ASUS ROG GX700', 10, '25000000.00', '27000000.00', '2019-04-11 06:18:19', '2019-04-11 06:18:19'),
(11, 'ASUS Transformer Book T100', 'Deskripsi ASUS Transformer Book T100', 30, '1000000.00', '1350000.00', '2019-04-11 06:37:09', '2019-04-11 06:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2019-04-12 21:20:34', '2019-04-12 21:20:34'),
(2, 'kasir', 'web', '2019-04-12 21:20:40', '2019-04-12 21:20:40'),
(3, 'keuangan', 'web', '2019-04-12 21:20:48', '2019-04-12 21:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_transaction` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(13,2) NOT NULL,
  `total_price` decimal(13,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type_transaction`, `product_id`, `qty`, `price`, `total_price`, `created_at`, `updated_at`) VALUES
(8, 'purchase', 9, 2, '1000000.00', '2000000.00', '2019-04-11 07:12:55', '2019-04-11 07:12:55'),
(9, 'purchase', 11, 30, '1000000.00', '30000000.00', '2019-04-11 07:13:26', '2019-04-11 07:13:26'),
(10, 'sale', 9, 6, '1250000.00', '7500000.00', '2019-04-11 07:15:46', '2019-04-11 07:24:04'),
(11, 'sale', 9, 6, '1250000.00', '7500000.00', '2019-04-11 08:21:45', '2019-04-11 08:21:45');

--
-- Triggers `transactions`
--
DROP TRIGGER IF EXISTS `hapus_stok`;
DELIMITER $$
CREATE TRIGGER `hapus_stok` BEFORE DELETE ON `transactions` FOR EACH ROW BEGIN
    IF(OLD.type_transaction = 'purchase') THEN
        UPDATE products SET stock=stock-OLD.qty
    	WHERE id = OLD.product_id;
    ELSE
       	UPDATE products SET stock=stock+OLD.qty
    	WHERE id = OLD.product_id;
    END IF;
	
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tambah_stok`;
DELIMITER $$
CREATE TRIGGER `tambah_stok` BEFORE INSERT ON `transactions` FOR EACH ROW BEGIN
    IF(NEW.type_transaction = 'purchase') THEN
        UPDATE products SET stock=stock+NEW.qty
    	WHERE id = NEW.product_id;
    ELSE
       	UPDATE products SET stock=stock-NEW.qty
    	WHERE id = NEW.product_id;
    END IF;
	
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_stok`;
DELIMITER $$
CREATE TRIGGER `update_stok` BEFORE UPDATE ON `transactions` FOR EACH ROW BEGIN
	IF(OLD.type_transaction = 'purchase') THEN
       UPDATE products SET stock=stock-OLD.qty+NEW.qty
    	WHERE id = OLD.product_id;
    ELSE
       	UPDATE products SET stock=stock+OLD.qty-NEW.qty
    	WHERE id = OLD.product_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Administrator', 'administrator', 'administrator@gmail.com', NULL, '$2y$10$NMkTBp7ixYDghz9pIOqPp.4qXdN4HaxR3asOZkCG6DHOFUvewBcaG', 'zyH4W4DtDxK64c3cnOALDX8z0P9vW29XVruDSyVPBFi13lDpCfnwvnSLhWRD', '2019-04-12 22:24:25', '2019-04-12 22:24:25'),
(4, 'Kasir', NULL, 'kasir@gmail.com', NULL, '$2y$10$QSBky8Z/p4DAb9BvGggfKeKTKk3x4EeKAeUTftdtXW14EtUoe3uf.', 'wWonRoE101XQjJ62tjpGRS0Odb9XX1ncU77ly9L1rvKqvCtVbf0JkvSAXP3q', '2019-04-12 22:25:18', '2019-04-12 22:25:18'),
(5, 'Keuangan', NULL, 'keuangan@gmail.com', NULL, '$2y$10$TZk/LFnrf5WqCcTcuSzqhe4eQC26AJRtUJk6aEY4cm0SnQy6EFK7S', 'd9SawhzNboFLCfaKBYvREFNk3iisAuGDbob2LOj6w8NVyTRbWretyIH7PIWz', '2019-04-12 22:25:53', '2019-04-12 22:25:53');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
