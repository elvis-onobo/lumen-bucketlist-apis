-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 29, 2019 at 08:16 AM
-- Server version: 5.7.23
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
-- Database: `bucketlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `bucketlists`
--

DROP TABLE IF EXISTS `bucketlists`;
CREATE TABLE IF NOT EXISTS `bucketlists` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bucketlist` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bucketlists`
--

INSERT INTO `bucketlists` (`id`, `user_id`, `bucketlist`, `created_at`, `updated_at`) VALUES
(1, '2', 'Get Married', '2019-08-26 23:46:39', '2019-08-27 07:51:28'),
(2, '2', 'Buy a car', '2019-08-27 06:13:52', '2019-08-27 06:13:52'),
(3, '2', 'Build a house', '2019-08-27 06:23:44', '2019-08-27 06:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `list_items`
--

DROP TABLE IF EXISTS `list_items`;
CREATE TABLE IF NOT EXISTS `list_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bucketlist_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `list` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_items`
--

INSERT INTO `list_items` (`id`, `bucketlist_id`, `list`, `created_at`, `updated_at`) VALUES
(1, '1', 'Get a job to facilitate marriage ASAP', '2019-08-27 20:15:05', '2019-08-27 20:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_24_050406_create_users_table', 1),
(2, '2019_08_24_050721_create_bucketlists_table', 1),
(3, '2019_08_24_050743_create_lists_table', 1),
(4, '2019_08_27_194304_create_listitems_table', 2),
(5, '2019_08_27_200752_create_list_items_table', 3),
(6, '2019_08_27_201247_create_list_items_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Elvis Onobo', 'rapknowlogy@gmail.com', NULL, '$2y$10$Lsh/BNIe3NOB/M1NVRyBFOIzazIc.KrKMgs4xg1w9gj0WiLNkdwTO', '2019-08-24 13:23:16', '2019-08-24 13:23:16'),
(3, 'Theresa Ebhohon', 'theresa@gmail.com', NULL, '$2y$10$I7X8CjSYrh2tMViwzDIXNOLsOljYBq0W1KTch1R.Rr7vVESMQBCT2', '2019-08-25 16:59:33', '2019-08-25 16:59:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
