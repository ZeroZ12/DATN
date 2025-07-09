-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2025 at 04:30 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datn`
--

-- --------------------------------------------------------

--
-- Table structure for table `anh_san_phams`
--

CREATE TABLE `anh_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `duong_dan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anh_san_phams`
--

INSERT INTO `anh_san_phams` (`id`, `id_product`, `duong_dan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'images/anh_phu/o1xbT2xGlNRPymucBZ1vqlXlibBJZxYpQw3PFoyp.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(2, 1, 'images/anh_phu/MBvBV2EMCQINo95SUM4PpTXtZLfk2LU0lB9WZePW.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(3, 1, 'images/anh_phu/s4wiZmjh34UYliDHlDimv3rVeQoBTxhBHHRm6itd.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(4, 1, 'images/anh_phu/JUUjNPFLLc7ARFXCOUyVFjwAYdIwy7Lp2XH22wTA.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(5, 1, 'images/anh_phu/G6YkvFtdnSqQ3FNB6EbWodmPd7cnDRrCSHiJiNxX.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(6, 2, 'images/anh_phu/LTtg29VVjyvyK8kmLcgvxb9TgjlonJo35eMi3zfm.jpg', '2025-06-20 21:23:29', '2025-07-01 14:35:13', '2025-07-01 14:35:13'),
(7, 2, 'images/anh_phu/0k1nLMKXv88rcXd9p47qO68NDNvp9cpzlZDKxjKs.jpg', '2025-06-20 21:23:29', '2025-07-01 14:35:13', '2025-07-01 14:35:13'),
(8, 2, 'images/anh_phu/f4dVUMsU50ZhjjJbMi3uk5V7ww45Q9bCYjLhkrJJ.jpg', '2025-06-20 21:23:29', '2025-07-01 14:35:13', '2025-07-01 14:35:13'),
(9, 2, 'images/anh_phu/9yYFOcNENPzFCn9Pc0YSt2kWHgJ64OwqHQmbs3bg.jpg', '2025-06-20 21:23:29', '2025-07-01 14:35:13', '2025-07-01 14:35:13'),
(10, 2, 'images/anh_phu/vinTbeKr0gz7XmgWNYkBQeYpQlzikH6IGSEuDW4N.jpg', '2025-06-20 21:23:29', '2025-07-01 14:35:13', '2025-07-01 14:35:13'),
(11, 5, 'images/kTK5zeJnj9H4tkJudNK3C3iWXMdAYCq9f0kvWX3e.jpg', '2025-06-30 13:37:13', '2025-06-30 13:37:45', '2025-06-30 13:37:45'),
(12, 5, 'images/V322WYIt4X6aVIAstp4hRrkvdGNln1XxJGz2DkCK.png', '2025-06-30 13:37:13', '2025-06-30 13:37:45', '2025-06-30 13:37:45'),
(13, 5, 'images/FuzsJczKNt4RQ28YbgQSrIj7aoNcdcOaDEiVVHrP.png', '2025-06-30 13:37:13', '2025-06-30 13:37:45', '2025-06-30 13:37:45'),
(14, 5, 'images/itde5Fvk0OWqJwA3uyUDA1uzrYrMXZdhR37IK0yZ.jpg', '2025-06-30 13:37:13', '2025-06-30 13:37:45', '2025-06-30 13:37:45'),
(15, 6, 'images/anh_phu/atuCHIkGzFfTsCl4FKpZvK40cJyXCDsum5461WVc.jpg', '2025-06-30 14:04:50', '2025-06-30 14:13:58', '2025-06-30 14:13:58'),
(16, 6, 'images/anh_phu/eYmRLH8BoyUxwjlP7fYuXGG9r0an25N9wbrYQiC3.png', '2025-06-30 14:04:50', '2025-06-30 14:13:58', '2025-06-30 14:13:58'),
(17, 6, 'images/anh_phu/CQNN5hLXoQxu2AU9cf3oLsdOoCKk65eUQn2AxqCC.png', '2025-06-30 14:04:51', '2025-06-30 14:04:51', NULL),
(18, 6, 'images/anh_phu/3pYwOUzlk6DPNMZbNUNZZDEb2B7vXz0wtECyk9d2.jpg', '2025-06-30 14:04:51', '2025-06-30 14:04:51', NULL),
(19, 4, 'images/9V1xPbDi6VzuQRgsqahKvUa92SCus09xpFjgGvVN.jpg', '2025-07-01 14:34:30', '2025-07-01 14:34:30', NULL),
(20, 4, 'images/R1hy2sTArzJghNjKsC7cIwOgQQGNmbzFEQUjgHYw.jpg', '2025-07-01 14:34:30', '2025-07-01 14:34:30', NULL),
(21, 4, 'images/dyLTePvsoB2JQ4MCUpgmIv23gIM9hjlp7NJ59y3s.jpg', '2025-07-01 14:34:30', '2025-07-01 14:34:30', NULL),
(22, 4, 'images/1Lkq7hWysnfURjJWuaUHl7zSmn8Gm8MwdDpxbhMl.jpg', '2025-07-01 14:34:30', '2025-07-01 14:34:30', NULL),
(23, 3, 'images/uIbTs5HUd25bUZqvPRDi12pfW0dwb83G2wy6wbY0.jpg', '2025-07-01 14:34:52', '2025-07-01 14:34:52', NULL),
(24, 3, 'images/MBqB1YYV58T7f6H2SXIVIvRRl4TwN0RWSmVjamcF.jpg', '2025-07-01 14:34:52', '2025-07-01 14:34:52', NULL),
(25, 3, 'images/z2UWH7xb2srtfNa9Oy33jpHCBOHXfevlsLS22xmT.jpg', '2025-07-01 14:34:52', '2025-07-01 14:34:52', NULL),
(26, 2, 'images/VXtBcokb96M6rEcESTeorEryjf9NHJiok4wiz7LR.jpg', '2025-07-01 14:35:13', '2025-07-01 14:35:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image_url`, `sale`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'banners/wwYngGjy2CsmH9LnYFdkzMkLEQQrMpN9lLiQAeZG.jpg', '12.00', '123', '2025-07-01 14:37:06', '2025-07-01 14:37:06', NULL),
(2, 'asad', 'banners/kqDJuVjsb1mXEudehaLPOHpvrphvDe3NnyeYd65X.jpg', '14.00', '123', '2025-07-01 14:37:28', '2025-07-01 14:37:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bien_the_san_phams`
--

CREATE TABLE `bien_the_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `id_ram` bigint UNSIGNED NOT NULL,
  `id_o_cung` bigint UNSIGNED NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `gia_so_sanh` decimal(10,2) NOT NULL,
  `ton_kho` int NOT NULL,
  `ma_bien_the` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anh_dai_dien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bien_the_san_phams`
--

INSERT INTO `bien_the_san_phams` (`id`, `id_product`, `id_ram`, `id_o_cung`, `gia`, `gia_so_sanh`, `ton_kho`, `ma_bien_the`, `anh_dai_dien`, `hoat_dong`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, '9990000.00', '10990000.00', 6, 'BT7594', NULL, 1, '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(2, 1, 1, 3, '15990000.00', '20990000.00', 5, 'BT8080', NULL, 1, '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(3, 1, 2, 1, '12990000.00', '20990000.00', 7, 'BT8396', NULL, 1, '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(4, 2, 1, 1, '9990000.00', '10990000.00', 6, 'BT6018', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(5, 2, 1, 3, '9990000.00', '10990000.00', 8, 'BT3266', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(6, 2, 2, 1, '9990000.00', '10990000.00', 9, 'BT0017', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(7, 2, 2, 3, '9990000.00', '10990000.00', 8, 'BT5952', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(8, 3, 1, 1, '12000000.00', '15000000.00', 5, 'BT3990', NULL, 1, '2025-06-23 07:03:32', '2025-06-23 07:03:32', NULL),
(9, 3, 8, 1, '14000000.00', '16000000.00', 5, 'BT6309', NULL, 1, '2025-06-23 07:03:32', '2025-06-23 07:03:32', NULL),
(10, 4, 2, 2, '13000000.00', '16000000.00', 5, 'BT9822', NULL, 1, '2025-06-23 07:05:48', '2025-06-23 07:05:48', NULL),
(11, 4, 2, 3, '14000000.00', '17000000.00', 5, 'BT3712', NULL, 1, '2025-06-23 07:05:48', '2025-06-23 07:05:48', NULL),
(12, 4, 9, 3, '15000000.00', '18000000.00', 5, 'BT0724', NULL, 1, '2025-06-23 07:05:48', '2025-06-23 07:05:48', NULL),
(13, 5, 2, 5, '12000000.00', '14000000.00', 5, 'BT4957', NULL, 1, '2025-06-23 07:06:49', '2025-06-23 07:06:49', NULL),
(14, 5, 10, 5, '12000000.00', '14000000.00', 5, 'BT6292', NULL, 1, '2025-06-23 07:06:49', '2025-06-23 07:06:49', NULL),
(15, 6, 1, 4, '1000000.00', '1200000.00', 5, 'BT5858', NULL, 1, '2025-06-30 14:04:51', '2025-06-30 14:04:51', NULL),
(16, 6, 1, 5, '60000.00', '800000.00', 2, 'BT8730', NULL, 1, '2025-06-30 14:04:51', '2025-06-30 14:04:51', NULL);

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
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `gia_sale` decimal(10,2) DEFAULT NULL,
  `mo_ta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `ten`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'case bể cá', '700000.00', '500000.00', '<p>Case bể c&aacute; đẹp, to</p>', '2025-06-30 13:45:14', '2025-06-30 13:45:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chips`
--

CREATE TABLE `chips` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chips`
--

INSERT INTO `chips` (`id`, `ten`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Intel Core i7-6774', 'Sint fuga accusamus iure aliquam deserunt ea rerum autem.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'Intel Core i5-6558', 'Nihil culpa nemo perspiciatis molestiae.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'Intel Core i3-7007', 'Dignissimos delectus rem veniam amet.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'Intel Core i9-9669', 'Ratione eaque laborum ad.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(5, 'Intel Core i9-5580', 'Delectus sed quos aperiam qui ipsam.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(6, 'Intel Core i3-8139', 'Quos ea at voluptatem et perspiciatis assumenda voluptatibus.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(7, 'Intel Core i7-9824', 'Ipsa voluptatem delectus odit minima.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(8, 'Intel Core i3-6064', 'Nihil quasi quia doloremque voluptate omnis harum eligendi.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(9, 'Intel Core i9-2618', 'Molestiae et commodi vel nisi neque cum fugiat quos.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(10, 'Intel Core i9-5035', 'Nulla voluptas autem dolorem at et.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_don_hang` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `id_bien_the` bigint UNSIGNED DEFAULT NULL,
  `ten_san_pham_tai_thoi_diem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ten_hien_thi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int NOT NULL,
  `don_gia` decimal(10,2) NOT NULL,
  `bao_hanh_thang` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chi_tiet_don_hangs`
--

INSERT INTO `chi_tiet_don_hangs` (`id`, `id_don_hang`, `id_product`, `id_bien_the`, `ten_san_pham_tai_thoi_diem`, `ten_hien_thi`, `so_luong`, `don_gia`, `bao_hanh_thang`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 13, 'Sản phẩm 51111', 'Sản phẩm 51111', 1, '12000000.00', 12, '2025-07-08 13:44:37', '2025-07-08 13:44:37'),
(2, 2, 5, 13, 'Sản phẩm 51111', 'Sản phẩm 51111', 1, '12000000.00', 12, '2025-07-08 15:40:43', '2025-07-08 15:40:43'),
(3, 3, 5, 13, 'Sản phẩm 51111', 'Sản phẩm 51111', 1, '12000000.00', 12, '2025-07-08 15:43:25', '2025-07-08 15:43:25'),
(4, 4, 5, 13, 'Sản phẩm 51111', 'Sản phẩm 51111', 1, '12000000.00', 12, '2025-07-08 15:48:06', '2025-07-08 15:48:06'),
(5, 5, 5, 13, 'Sản phẩm 51111', 'Sản phẩm 51111', 1, '12000000.00', 12, '2025-07-08 16:05:44', '2025-07-08 16:05:44'),
(6, 6, 4, 10, 'Sản phẩm 2', 'Sản phẩm 2', 1, '13000000.00', 12, '2025-07-08 16:17:09', '2025-07-08 16:17:09'),
(7, 7, 3, 8, 'Sản phẩm 1', 'Sản phẩm 1', 1, '12000000.00', 12, '2025-07-08 16:17:25', '2025-07-08 16:17:25'),
(8, 8, 5, 13, 'Sản phẩm 51111', 'Sản phẩm 51111', 1, '12000000.00', 12, '2025-07-08 16:18:22', '2025-07-08 16:18:22'),
(9, 9, 5, 13, 'Sản phẩm 51111', 'Sản phẩm 51111', 1, '12000000.00', 12, '2025-07-08 16:19:11', '2025-07-08 16:19:11'),
(10, 10, 5, 13, 'Sản phẩm 51111', 'Sản phẩm 51111', 1, '12000000.00', 12, '2025-07-08 16:21:51', '2025-07-08 16:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hangs`
--

CREATE TABLE `chi_tiet_gio_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_gio_hang` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `id_bien_the` bigint UNSIGNED DEFAULT NULL,
  `so_luong` int NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chi_tiet_gio_hangs`
--

INSERT INTO `chi_tiet_gio_hangs` (`id`, `id_gio_hang`, `id_product`, `id_bien_the`, `so_luong`, `gia`, `created_at`, `updated_at`) VALUES
(12, 1, 1, 3, 1, '12990000.00', '2025-06-21 09:33:43', '2025-06-21 09:33:43'),
(33, 5, 5, 13, 1, '12000000.00', '2025-06-28 09:34:28', '2025-06-28 09:34:28'),
(42, 6, 4, 10, 1, '13000000.00', '2025-06-30 14:17:07', '2025-06-30 14:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `danh_gia_san_phams`
--

CREATE TABLE `danh_gia_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `so_sao` int NOT NULL,
  `binh_luan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trang_thai` enum('cho_duyet','da_duyet','tu_choi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cho_duyet',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danh_gia_san_phams`
--

INSERT INTO `danh_gia_san_phams` (`id`, `id_product`, `id_user`, `so_sao`, `binh_luan`, `created_at`, `updated_at`, `trang_thai`, `deleted_at`) VALUES
(1, 1, 11, 4, 'Đẹp thật sự', '2025-06-20 21:25:18', '2025-06-21 07:30:06', 'da_duyet', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Laptop', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'PC Gaming', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'Linh kiện', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'Màn hình', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(5, 'Phụ kiện', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(6, 'PC Bán Chạy', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dia_chi_nguoi_dungs`
--

CREATE TABLE `dia_chi_nguoi_dungs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `ten_nguoi_nhan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai_nguoi_nhan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi_day_du` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinh_thanh_pho` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quan_huyen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phuong_xa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mac_dinh` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tinh_thanh_pho_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quan_huyen_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phuong_xa_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dia_chi_nguoi_dungs`
--

INSERT INTO `dia_chi_nguoi_dungs` (`id`, `id_user`, `ten_nguoi_nhan`, `so_dien_thoai_nguoi_nhan`, `dia_chi_day_du`, `tinh_thanh_pho`, `quan_huyen`, `phuong_xa`, `mac_dinh`, `created_at`, `updated_at`, `tinh_thanh_pho_name`, `quan_huyen_name`, `phuong_xa_name`) VALUES
(1, 11, 'Trần Pohng', '0325413923', 'ff', 'Hà Nội', 'Nam Từ Liêm', 'Hội', 1, '2025-06-21 08:54:22', '2025-06-21 08:54:34', NULL, NULL, NULL),
(2, 12, 'Nguyễn Danh Dũng', '0376536987', '123 ABC', 'Phú Thọ', 'Cẩm Khê', 'Tuy Lộc', 0, '2025-06-23 07:08:36', '2025-06-23 07:44:45', NULL, NULL, NULL),
(3, 12, 'Nguyễn Danh Dũng', '0123456789', 'ABC', 'Phú Thọ 1', 'Cẩm', 'Tuy Lộc', 1, '2025-06-23 07:44:40', '2025-06-23 07:44:45', NULL, NULL, NULL),
(4, 13, 'phạm đình hải', '0971734530', 'sdfgh', '34', '343', '13141', 1, '2025-06-28 03:35:24', '2025-06-28 06:52:31', 'Tỉnh Thái Bình', 'Huyện Kiến Xương', 'Xã Vũ Quí'),
(5, 14, 'phạm đình hải', '0961605509', 'ghgjhg', 'adfdsg', 'àdsgf', 'ádgsf', 1, '2025-06-28 04:01:02', '2025-06-28 04:01:02', NULL, NULL, NULL),
(9, 13, 'phạm đình hải', '0987652312', 'tyuhigjf', '34', '343', '13135', 0, '2025-06-28 06:43:01', '2025-06-28 06:52:31', 'Tỉnh Thái Bình', 'Huyện Kiến Xương', 'Xã Hòa Bình'),
(10, 15, 'phạm đình hải', '0705120931', 'xóm9', '37', '373', '14506', 1, '2025-06-28 09:34:09', '2025-06-28 09:34:09', 'Tỉnh Ninh Bình', 'Huyện Gia Viễn', 'Xã Gia Thắng'),
(11, 17, 'Nguyen Van A', '0123123123', 'số 6 đường abc phố xyz', '01', '019', '00631', 1, '2025-06-30 09:23:45', '2025-06-30 09:23:45', 'Thành phố Hà Nội', 'Quận Nam Từ Liêm', 'Phường Mễ Trì'),
(12, 18, 'SaiDepChieu', '0123123123', 'So 123 Duong 456 Pho 789', '01', '019', '00631', 1, '2025-06-30 14:26:21', '2025-06-30 14:26:21', 'Thành phố Hà Nội', 'Quận Nam Từ Liêm', 'Phường Mễ Trì');

-- --------------------------------------------------------

--
-- Table structure for table `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `ma_don` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_dia_chi_nguoi_dungs` bigint UNSIGNED NOT NULL,
  `id_phuong_thuc_thanh_toan` bigint UNSIGNED NOT NULL,
  `tong_tien` decimal(12,2) NOT NULL,
  `tong_tien_goc` decimal(12,2) NOT NULL DEFAULT '0.00',
  `giam_gia` decimal(10,2) NOT NULL DEFAULT '0.00',
  `trang_thai` enum('cho_xac_nhan','cho_thanh_toan','chuan_bi_hang','da_xac_nhan','da_huy','dang_giao_hang','giao_thanh_cong','giao_that_bai','hoan_thanh') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `huy_boi` enum('admin','khach_hang','he_thong') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'he_thong',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_ma_giam_gia` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `ma_don`, `id_user`, `id_dia_chi_nguoi_dungs`, `id_phuong_thuc_thanh_toan`, `tong_tien`, `tong_tien_goc`, `giam_gia`, `trang_thai`, `huy_boi`, `created_at`, `updated_at`, `id_ma_giam_gia`, `deleted_at`) VALUES
(1, 'DH1751982277', 12, 3, 1, '12000000.00', '12000000.00', '0.00', 'giao_thanh_cong', 'he_thong', '2025-07-08 13:44:37', '2025-07-08 13:52:17', NULL, NULL),
(2, 'DH1751989243', 12, 3, 1, '12000000.00', '12000000.00', '0.00', 'giao_thanh_cong', 'he_thong', '2025-07-08 15:40:43', '2025-07-08 15:41:03', NULL, NULL),
(3, 'DH1751989405', 12, 3, 1, '12000000.00', '12000000.00', '0.00', 'giao_thanh_cong', 'he_thong', '2025-07-08 15:43:25', '2025-07-08 15:43:41', NULL, NULL),
(4, 'DH1751989686', 12, 3, 1, '12000000.00', '12000000.00', '0.00', 'giao_thanh_cong', 'he_thong', '2025-07-08 15:48:06', '2025-07-08 15:48:25', NULL, NULL),
(5, 'DH1751990744', 12, 3, 1, '12000000.00', '12000000.00', '0.00', 'da_huy', 'he_thong', '2025-07-08 16:05:44', '2025-07-08 16:08:41', NULL, NULL),
(6, 'DH1751991429', 12, 3, 1, '13000000.00', '13000000.00', '0.00', 'da_huy', 'admin', '2025-07-08 16:17:09', '2025-07-08 16:17:42', NULL, NULL),
(7, 'DH1751991445', 12, 3, 1, '12000000.00', '12000000.00', '0.00', 'da_huy', 'khach_hang', '2025-07-08 16:17:25', '2025-07-08 16:17:33', NULL, NULL),
(8, 'DH1751991502', 12, 3, 2, '12000000.00', '12000000.00', '0.00', 'da_huy', 'he_thong', '2025-07-08 16:18:22', '2025-07-08 16:18:34', NULL, NULL),
(9, 'DH1751991551', 12, 3, 2, '12000000.00', '12000000.00', '0.00', 'da_huy', 'he_thong', '2025-07-08 16:19:11', '2025-07-08 16:22:42', NULL, NULL),
(10, 'DH1751991711', 12, 3, 1, '12000000.00', '12000000.00', '0.00', 'giao_thanh_cong', 'he_thong', '2025-07-08 16:21:51', '2025-07-08 16:29:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `loai` enum('chinh','luu_sau','so_sanh') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'chinh',
  `id_giam_gia` bigint UNSIGNED DEFAULT NULL,
  `ghi_chu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gio_hangs`
--

INSERT INTO `gio_hangs` (`id`, `id_user`, `loai`, `id_giam_gia`, `ghi_chu`, `created_at`, `updated_at`) VALUES
(1, 11, 'chinh', 6, NULL, '2025-06-20 21:24:04', '2025-06-21 09:14:18'),
(2, 12, 'chinh', NULL, NULL, '2025-06-23 07:01:21', '2025-07-08 12:19:58'),
(3, 13, 'chinh', NULL, NULL, '2025-06-28 03:35:05', '2025-06-28 06:52:59'),
(4, 14, 'chinh', NULL, NULL, '2025-06-28 04:00:29', '2025-06-28 05:04:22'),
(5, 15, 'chinh', 5, NULL, '2025-06-28 09:34:28', '2025-06-28 09:34:32'),
(6, 17, 'chinh', 5, NULL, '2025-06-30 09:19:40', '2025-06-30 14:19:51'),
(7, 18, 'chinh', NULL, NULL, '2025-06-30 14:25:10', '2025-07-06 15:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `gpus`
--

CREATE TABLE `gpus` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gpus`
--

INSERT INTO `gpus` (`id`, `ten`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GPU GTX 3497', 'Deserunt ullam in sed ut facilis ut alias.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'GPU GTX 919', 'Voluptate fugiat perferendis qui aut inventore.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'GPU GTX 1239', 'Dicta veniam incidunt eos cumque voluptas quaerat.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'GPU GTX 4358', 'Distinctio ut ut consequuntur tempore minus.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(5, 'GPU GTX 5449', 'Maiores mollitia reprehenderit id praesentium non.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(6, 'GPU GTX 864', 'Non occaecati alias eveniet quasi sed.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(7, 'GPU GTX 836', 'Accusantium distinctio vero tempore et non.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(8, 'GPU GTX 6779', 'Reiciendis ipsa similique dolorem et.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(9, 'GPU GTX 2124', 'Non quisquam sint veniam aut.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(10, 'GPU GTX 949', 'Accusantium consequatur possimus beatae possimus similique ducimus.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lich_su_xems`
--

CREATE TABLE `lich_su_xems` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED DEFAULT NULL,
  `ma_phien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `thoi_gian_xem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mainboards`
--

CREATE TABLE `mainboards` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mainboards`
--

INSERT INTO `mainboards` (`id`, `ten`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mainboard UB-179', 'Ab qui voluptatum aut dolores consequuntur velit.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'Mainboard XV-928', 'Asperiores blanditiis sit ut quis.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'Mainboard EA-960', 'Molestias non explicabo ea sunt aut.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'Mainboard VV-438', 'Consequuntur reiciendis similique sed vel quidem.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(5, 'Mainboard VU-948', 'Totam ea deserunt sint amet.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(6, 'Mainboard HZ-032', 'Mollitia distinctio sit voluptas laborum dicta.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(7, 'Mainboard GI-970', 'Ipsam est nostrum eligendi occaecati sed velit quas.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(8, 'Mainboard JM-391', 'Debitis magni vitae tenetur assumenda fugit deserunt.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(9, 'Mainboard BQ-099', 'Quia corrupti est dolorem similique sit nesciunt.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(10, 'Mainboard ZY-441', 'Aut ut vero fugiat eligendi fuga.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ma_giam_gias`
--

CREATE TABLE `ma_giam_gias` (
  `id` bigint UNSIGNED NOT NULL,
  `ma` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `loai` enum('phan_tram','tien_mat') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia_tri` decimal(10,2) NOT NULL,
  `gia_tri_toi_da` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dieu_kien` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ngay_bat_dau` timestamp NULL DEFAULT NULL,
  `ngay_ket_thuc` timestamp NULL DEFAULT NULL,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_giam_gias`
--

INSERT INTO `ma_giam_gias` (`id`, `ma`, `loai`, `gia_tri`, `gia_tri_toi_da`, `dieu_kien`, `ngay_bat_dau`, `ngay_ket_thuc`, `hoat_dong`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Giam10%', 'phan_tram', '10.00', '1100000.00', '0.00', '2025-06-20 17:00:00', '2025-07-20 17:00:00', 1, '2025-06-20 21:17:39', '2025-06-30 14:19:22', NULL),
(6, 'Hocsinh', 'tien_mat', '1000000.00', '1000000.00', '0.00', '2025-06-20 17:00:00', '2025-06-21 17:00:00', 1, '2025-06-21 08:41:56', '2025-06-30 14:19:09', NULL);

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_06_073212_create_danh_mucs_table', 1),
(5, '2025_06_06_073224_create_chips_table', 1),
(6, '2025_06_06_073233_create_mainboards_table', 1),
(7, '2025_06_06_073238_create_gpus_table', 1),
(8, '2025_06_06_073243_create_rams_table', 1),
(9, '2025_06_06_073249_create_o_cungs_table', 1),
(10, '2025_06_06_073302_create_phuong_thuc_thanh_toans_table', 1),
(11, '2025_06_06_073324_create_thuong_hieus_table', 1),
(12, '2025_06_06_073409_create_ma_giam_gias_table', 1),
(13, '2025_06_06_073426_create_san_phams_table', 1),
(14, '2025_06_06_073432_create_bien_the_san_phams_table', 1),
(15, '2025_06_06_073544_create_dia_chi_nguoi_dungs_table', 1),
(16, '2025_06_06_073600_create_anh_san_phams_table', 1),
(17, '2025_06_06_073620_create_gio_hangs_table', 1),
(18, '2025_06_06_073627_create_don_hangs_table', 1),
(19, '2025_06_06_073652_create_chi_tiet_gio_hangs_table', 1),
(20, '2025_06_06_073657_create_chi_tiet_don_hangs_table', 1),
(21, '2025_06_06_073704_create_danh_gia_san_phams_table', 1),
(22, '2025_06_06_073710_create_lich_su_xems_table', 1),
(23, '2025_06_06_073715_create_nhat_ky_ton_khos_table', 1),
(24, '2025_06_21_043015_add_id_product_to_chi_tiet_gio_hangs_table', 2),
(25, '2025_06_21_153041_add_id_ma_giam_gia_to_don_hangs_table', 3),
(26, '2025_06_21_153649_add_dieu_kien_to_ma_giam_gias_table', 4),
(27, '2025_06_21_154719_add_tong_tien_goc_and_giam_gia_to_don_hangs_table', 5),
(28, '2025_06_21_155559_add_id_product_to_chi_tiet_don_hangs_table', 6),
(29, '2025_06_21_155741_add_deleted_at_to_don_hangs_table', 7),
(30, '2025_06_06_073250_create_nguons_table', 8),
(31, '2025_06_06_073251_create_cases_table', 8),
(32, '2025_06_06_073252_create_tan_nhiets_table', 8),
(33, '2025_06_27_002817_add_gia_tri_toi_da_to_ma_giam_gias_table', 8),
(34, '2025_06_28_132943_add_ten_dia_phuong_to_dia_chi_nguoi_dungs', 8),
(35, '2025_06_27_172518_create_banners_table', 9),
(36, '2025_06_27_204605_add_deleted_at_to_banners_table', 9),
(37, '2025_06_30_173843_add_case_tannhiet_nguon_to_san_phams_table', 10),
(38, '2025_07_02_095107_add_simple_product_fields_to_san_pham', 11),
(39, '2025_07_02_110813_add_gia_so_sanh_to_san_phams_table', 11),
(40, '2025_07_03_233543_add_ten_san_pham_tai_thoi_diem_to_chi_tiet_don_hangs_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `ngan_hangs`
--

CREATE TABLE `ngan_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `ten_viet_tat` varchar(50) NOT NULL,
  `ten_day_du` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nguons`
--

CREATE TABLE `nguons` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(12,2) NOT NULL,
  `gia_sale` decimal(12,2) DEFAULT NULL,
  `mo_ta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nguons`
--

INSERT INTO `nguons` (`id`, `ten`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '500W', '600000.00', '500000.00', '<p>&aacute;dadasda</p>', '2025-06-30 13:46:09', '2025-06-30 13:46:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nhat_ky_ton_khos`
--

CREATE TABLE `nhat_ky_ton_khos` (
  `id` bigint UNSIGNED NOT NULL,
  `id_bien_the` bigint UNSIGNED DEFAULT NULL,
  `so_luong` int NOT NULL,
  `loai` enum('nhap','xuat','dieu_chinh') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ly_do` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ngay_tao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o_cungs`
--

CREATE TABLE `o_cungs` (
  `id` bigint UNSIGNED NOT NULL,
  `loai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dung_luong` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `o_cungs`
--

INSERT INTO `o_cungs` (`id`, `loai`, `dung_luong`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'HDD', '512GB', 'Reiciendis aut maxime qui incidunt.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'SSD', '512GB', 'Amet veniam sint voluptatem harum animi rem expedita.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'HDD', '2TB', 'Ducimus dicta modi qui excepturi repudiandae reiciendis iusto.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'SSD', '2TB', 'Dolores et est quaerat et dolorem.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(5, 'SSD', '1TB', 'Cumque aut fugit ad numquam animi soluta debitis.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(6, 'SSD', '2TB', 'Voluptatum animi ipsa unde quos saepe quos qui.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(7, 'SSD', '256GB', 'Odit eum sed qui temporibus voluptatibus odit consequuntur alias.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(8, 'SSD', '1TB', 'Sit fugit iste quas aut.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(9, 'SSD', '1TB', 'Laborum consectetur ea voluptas molestias distinctio occaecati doloremque.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(10, 'HDD', '256GB', 'Accusamus nemo soluta saepe commodi distinctio voluptas consectetur vero.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phuong_thuc_thanh_toans`
--

CREATE TABLE `phuong_thuc_thanh_toans` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phuong_thuc_thanh_toans`
--

INSERT INTO `phuong_thuc_thanh_toans` (`id`, `ten`, `mo_ta`, `hoat_dong`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Thanh toán khi nhận hàng', 'Phương thức: Thanh toán khi nhận hàng', 1, '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'Chuyển khoản ngân hàng', 'Phương thức: Chuyển khoản ngân hàng', 1, '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'Ví điện tử Momo', 'Phương thức: Ví điện tử Momo', 1, '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'Thẻ tín dụng', 'Phương thức: Thẻ tín dụng', 1, '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rams`
--

CREATE TABLE `rams` (
  `id` bigint UNSIGNED NOT NULL,
  `dung_luong` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rams`
--

INSERT INTO `rams` (`id`, `dung_luong`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'RAM HK7799', 'Consequatur voluptas ratione eum qui expedita.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'RAM IP2821', 'Nihil necessitatibus deserunt consequatur repellendus et nam.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'RAM BX2457', 'Qui voluptate temporibus voluptates est dignissimos fuga.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'RAM JY1193', 'Ullam hic possimus culpa omnis adipisci neque aut.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(5, 'RAM JL1022', 'Qui voluptatem est aut optio.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(6, 'RAM RE5566', 'Fuga aliquid quidem quia porro.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(7, 'RAM EZ8373', 'Fugiat aut optio nemo harum.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(8, 'RAM WW8349', 'Nisi totam dolore officiis commodi exercitationem repellendus exercitationem.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(9, 'RAM VK9420', 'Atque amet rerum sequi qui.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(10, 'RAM XO6727', 'Occaecati veritatis non dignissimos sed aut.', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `san_phams`
--

CREATE TABLE `san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_san_pham` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gia` decimal(15,2) DEFAULT NULL,
  `gia_so_sanh` decimal(15,2) DEFAULT NULL,
  `so_luong` int DEFAULT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `co_bien_the` tinyint(1) NOT NULL DEFAULT '1',
  `id_chip` bigint UNSIGNED DEFAULT NULL,
  `id_mainboard` bigint UNSIGNED DEFAULT NULL,
  `id_gpu` bigint UNSIGNED DEFAULT NULL,
  `id_category` bigint UNSIGNED NOT NULL,
  `id_brand` bigint UNSIGNED NOT NULL,
  `bao_hanh_thang` int NOT NULL,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `anh_dai_dien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_case` bigint UNSIGNED DEFAULT NULL,
  `id_tannhiet` bigint UNSIGNED DEFAULT NULL,
  `id_nguon` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten`, `ma_san_pham`, `mo_ta`, `gia`, `gia_so_sanh`, `so_luong`, `sku`, `co_bien_the`, `id_chip`, `id_mainboard`, `id_gpu`, `id_category`, `id_brand`, `bao_hanh_thang`, `hoat_dong`, `anh_dai_dien`, `created_at`, `updated_at`, `deleted_at`, `id_case`, `id_tannhiet`, `id_nguon`) VALUES
(1, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 'WD0754', '<div><strong>PC FASTER GAMING 10400F - RTX 3050 6GB</strong>&nbsp;l&agrave; bộ PC Gaming - PC Đồ Họa Hiệu năng cao, được x&acirc;y dựng để đ&aacute;p ứng nhu cầu chơi game, học tập, l&agrave;m việc với mức gi&aacute; v&ocirc; c&ugrave;ng hợp l&yacute; . C&oacute; thể c&acirc;n tốt c&aacute;c tựa game Moba, FPS : LOL, FIFA, DOTA, CSGO, GTA 5 , PUBG.... cũng như c&aacute;c t&aacute;c vụ văn ph&ograve;ng , chỉnh sửa ảnh , edit video cơ bản.</div>\r\n<h3><strong>1.&nbsp;CPU Intel Core i5-10400F (2.9GHz turbo up to 4.3Ghz, 6 nh&acirc;n 12 luồng, 12MB Cache, 65W) - Socket Intel LGA 1200</strong></h3>\r\n<p><strong>CPU Intel Core i5-10400F</strong>&nbsp;ch&iacute;nh l&agrave; sự lựa chọn ho&agrave;n mỹ cho những ai muốn trải nghiệm hiệu suất đa nhiệm tốt nhưng c&oacute; gi&aacute; th&agrave;nh rẻ. CPU Intel Core i5-10400F đ&atilde; cắt giảm đi iGPU t&iacute;ch hợp sẵn nhưng vẫn đem lại trải nghiệm l&agrave;m việc tốt tương tự như bộ xử l&yacute; Intel Core i5 10400 th&ocirc;ng thường. mẫu CPU n&agrave;y sở hữu 6 nh&acirc;n 12 luồng cho đ&aacute;p ứng tốt nhu cầu l&agrave;m việc v&agrave; giải tr&iacute; c&ugrave;ng l&uacute;c. C&oacute; thể n&oacute;i, với mức gi&aacute; ph&ugrave; hợp, đ&acirc;y chắc chắn l&agrave; lựa chọn số 1 cho người d&ugrave;ng phổ th&ocirc;ng.</p>\r\n<p>&nbsp;</p>\r\n<div>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/i5_10400f_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3>&nbsp;</h3>\r\n<h3><strong>3. RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp;</strong></h3>\r\n<p>RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp; l&agrave; d&ograve;ng sản phẩm RAM chất lượng , ổn định , &nbsp;c&oacute; hiệu suất cực cao , tốc độ truyền tải nhanh ch&oacute;ng, khả năng tương th&iacute;ch tốt cho ph&eacute;p tất cả c&aacute;c game thủ vượt giới hạn tốc độ v&agrave; tận hưởng thế giới game ấn tượng nhất . Được thiết kế cho c&aacute;c game thủ v&agrave; những người &nbsp;đam m&ecirc;. những người muốn n&acirc;ng cấp tiết kiệm chi ph&iacute; để chơi game nhanh hơn.Đ&acirc;y l&agrave; sự lựa chọn tuyệt vời cho bộ PC Gaming gi&aacute; rẻ m&agrave; c&aacute;c game thủ kh&ocirc;ng n&ecirc;n bỏ qua.</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/ram-geil-evo-spear-16gb-ddr4-bus-3200_pcm_2114afa10c95413db9ef7c74bf1f9d4d_grande.png\"></p>\r\n<p>&nbsp;</p>\r\n<h3>4.&nbsp;&nbsp;Ổ cứng SSD TeamGroup CX2 256GB 2.5 inch SATA III</h3>\r\n<p>SSD TeamGroup CX2 được trang bị c&ocirc;ng nghệ FLASH hiện đại, tiết kiệm năng lượng ti&ecirc;u thụ cũng như tốc độ truyền cao. Hiệu suất mang lại kh&aacute;c hẳn so với những chiếc ổ cứng truyền thống trước đ&acirc;y. SSD TeamGroup CX2 sử dụng c&ocirc;ng nghệ SLC Caching t&acirc;n tiến được nh&agrave; sản xuất đưa v&agrave;o nhằm tối ưu hiệu suất l&agrave;m việc tr&ecirc;n m&aacute;y t&iacute;nh cho người d&ugrave;ng. Sở hữu tốc độ đọc/ghi nhanh gấp 4 lần so với c&aacute;c ổ cứng truyền thống. Được trang bị khả năng chống sốc v&agrave; rơi 1500G/0.5mili gi&acirc;y mang đến ổ cứng TeamGroup bền bỉ hơn. Đồng thời SSD CX2 cũng được thiết kế với trải nghiệm kh&ocirc;ng g&acirc;y ra tiếng ồn cơ học kh&oacute; chịu tối ưu trải nghiệm người d&ugrave;ng hơn. Để k&eacute;o d&agrave;i tuổi thọ hơn cho ổ cứng SSD TeamGroup CX2 c&ograve;n được trang bị th&ecirc;m c&ocirc;ng nghệ Wear-Leveling v&agrave; chức năng ECC. Tất cả nhằm mang đến trải nghiệm sử dụng tốt hơn cho người d&ugrave;ng với tốc độ tin cậy trong qu&aacute; tr&igrave;nh truyền dữ liệu. C&ugrave;ng đ&oacute; l&agrave; mức độ bền bỉ khi tuổi thọ của SSD được đảm bảo tốt hơn.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/o_cung_ssd_teamgroup_cx2_256gb_2.5_inch_sata_iii_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>5. &nbsp;CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;</strong></h3>\r\n<p>CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;&nbsp; l&agrave; một sản phẩm đ&aacute;ng ch&uacute; &yacute; trong ph&acirc;n kh&uacute;c card đồ họa tầm trung.Với kiến tr&uacute;c NVIDI Ampere mới nhất sử dụng chip đồ họa NVIDIA GeForce RTX 3050, c&oacute; khả năng xử l&yacute; đồ họa 3D mượt m&agrave;, hỗ trợ c&ocirc;ng nghệ ray tracing v&agrave; DLSS., RTX 3050 DUAL OC 6GB kết hợp hiệu suất nhiệt tối ưu với khả năng tương th&iacute;ch cao. Đ&acirc;y l&agrave; sự lựa chọn ho&agrave;n hảo cho những game thủ muốn c&oacute; hiệu suất đồ họa mạnh trong một cấu h&igrave;nh nhỏ gọn.</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/zt-a30500h-10m-image01_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n</div>', NULL, NULL, NULL, NULL, 1, 1, 2, 2, 2, 1, 36, 1, 'images/zNLVsTDHQdO9jgYmwxSBoKia784MVCHcGEh5SB2W.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL, NULL, NULL, NULL),
(2, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 'WD0622', '<div><strong>PC FASTER GAMING 10400F - RTX 3050 6GB</strong>&nbsp;l&agrave; bộ PC Gaming - PC Đồ Họa Hiệu năng cao, được x&acirc;y dựng để đ&aacute;p ứng nhu cầu chơi game, học tập, l&agrave;m việc với mức gi&aacute; v&ocirc; c&ugrave;ng hợp l&yacute; . C&oacute; thể c&acirc;n tốt c&aacute;c tựa game Moba, FPS : LOL, FIFA, DOTA, CSGO, GTA 5 , PUBG.... cũng như c&aacute;c t&aacute;c vụ văn ph&ograve;ng , chỉnh sửa ảnh , edit video cơ bản.</div>\r\n<h3><strong>1.&nbsp;CPU Intel Core i5-10400F (2.9GHz turbo up to 4.3Ghz, 6 nh&acirc;n 12 luồng, 12MB Cache, 65W) - Socket Intel LGA 1200</strong></h3>\r\n<p><strong>CPU Intel Core i5-10400F</strong>&nbsp;ch&iacute;nh l&agrave; sự lựa chọn ho&agrave;n mỹ cho những ai muốn trải nghiệm hiệu suất đa nhiệm tốt nhưng c&oacute; gi&aacute; th&agrave;nh rẻ. CPU Intel Core i5-10400F đ&atilde; cắt giảm đi iGPU t&iacute;ch hợp sẵn nhưng vẫn đem lại trải nghiệm l&agrave;m việc tốt tương tự như bộ xử l&yacute; Intel Core i5 10400 th&ocirc;ng thường. mẫu CPU n&agrave;y sở hữu 6 nh&acirc;n 12 luồng cho đ&aacute;p ứng tốt nhu cầu l&agrave;m việc v&agrave; giải tr&iacute; c&ugrave;ng l&uacute;c. C&oacute; thể n&oacute;i, với mức gi&aacute; ph&ugrave; hợp, đ&acirc;y chắc chắn l&agrave; lựa chọn số 1 cho người d&ugrave;ng phổ th&ocirc;ng.</p>\r\n<p>&nbsp;</p>\r\n<div>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/i5_10400f_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3>&nbsp;</h3>\r\n<h3><strong>3. RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp;</strong></h3>\r\n<p>RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp; l&agrave; d&ograve;ng sản phẩm RAM chất lượng , ổn định , &nbsp;c&oacute; hiệu suất cực cao , tốc độ truyền tải nhanh ch&oacute;ng, khả năng tương th&iacute;ch tốt cho ph&eacute;p tất cả c&aacute;c game thủ vượt giới hạn tốc độ v&agrave; tận hưởng thế giới game ấn tượng nhất . Được thiết kế cho c&aacute;c game thủ v&agrave; những người &nbsp;đam m&ecirc;. những người muốn n&acirc;ng cấp tiết kiệm chi ph&iacute; để chơi game nhanh hơn.Đ&acirc;y l&agrave; sự lựa chọn tuyệt vời cho bộ PC Gaming gi&aacute; rẻ m&agrave; c&aacute;c game thủ kh&ocirc;ng n&ecirc;n bỏ qua.</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/ram-geil-evo-spear-16gb-ddr4-bus-3200_pcm_2114afa10c95413db9ef7c74bf1f9d4d_grande.png\"></p>\r\n<p>&nbsp;</p>\r\n<h3>4.&nbsp;&nbsp;Ổ cứng SSD TeamGroup CX2 256GB 2.5 inch SATA III</h3>\r\n<p>SSD TeamGroup CX2 được trang bị c&ocirc;ng nghệ FLASH hiện đại, tiết kiệm năng lượng ti&ecirc;u thụ cũng như tốc độ truyền cao. Hiệu suất mang lại kh&aacute;c hẳn so với những chiếc ổ cứng truyền thống trước đ&acirc;y. SSD TeamGroup CX2 sử dụng c&ocirc;ng nghệ SLC Caching t&acirc;n tiến được nh&agrave; sản xuất đưa v&agrave;o nhằm tối ưu hiệu suất l&agrave;m việc tr&ecirc;n m&aacute;y t&iacute;nh cho người d&ugrave;ng. Sở hữu tốc độ đọc/ghi nhanh gấp 4 lần so với c&aacute;c ổ cứng truyền thống. Được trang bị khả năng chống sốc v&agrave; rơi 1500G/0.5mili gi&acirc;y mang đến ổ cứng TeamGroup bền bỉ hơn. Đồng thời SSD CX2 cũng được thiết kế với trải nghiệm kh&ocirc;ng g&acirc;y ra tiếng ồn cơ học kh&oacute; chịu tối ưu trải nghiệm người d&ugrave;ng hơn. Để k&eacute;o d&agrave;i tuổi thọ hơn cho ổ cứng SSD TeamGroup CX2 c&ograve;n được trang bị th&ecirc;m c&ocirc;ng nghệ Wear-Leveling v&agrave; chức năng ECC. Tất cả nhằm mang đến trải nghiệm sử dụng tốt hơn cho người d&ugrave;ng với tốc độ tin cậy trong qu&aacute; tr&igrave;nh truyền dữ liệu. C&ugrave;ng đ&oacute; l&agrave; mức độ bền bỉ khi tuổi thọ của SSD được đảm bảo tốt hơn.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/o_cung_ssd_teamgroup_cx2_256gb_2.5_inch_sata_iii_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>5. &nbsp;CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;</strong></h3>\r\n<p>CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;&nbsp; l&agrave; một sản phẩm đ&aacute;ng ch&uacute; &yacute; trong ph&acirc;n kh&uacute;c card đồ họa tầm trung.Với kiến tr&uacute;c NVIDI Ampere mới nhất sử dụng chip đồ họa NVIDIA GeForce RTX 3050, c&oacute; khả năng xử l&yacute; đồ họa 3D mượt m&agrave;, hỗ trợ c&ocirc;ng nghệ ray tracing v&agrave; DLSS., RTX 3050 DUAL OC 6GB kết hợp hiệu suất nhiệt tối ưu với khả năng tương th&iacute;ch cao. Đ&acirc;y l&agrave; sự lựa chọn ho&agrave;n hảo cho những game thủ muốn c&oacute; hiệu suất đồ họa mạnh trong một cấu h&igrave;nh nhỏ gọn.</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/zt-a30500h-10m-image01_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n</div>', NULL, NULL, NULL, NULL, 1, 1, 2, 2, 2, 1, 36, 1, 'images/xOji1TLxEOCKAWdUKPhdCORn7m06FqCXha3foGgS.jpg', '2025-06-20 21:23:29', '2025-07-01 14:35:13', NULL, 1, 1, 1),
(3, 'Sản phẩm 1', 'WD4125', '<p>Khong co</p>', NULL, NULL, NULL, NULL, 1, 6, 7, 1, 1, 1, 12, 1, 'images/ZNCLDGZ1BwZ7hAXdSHxCcuTt9N2zKyKd31ziYtV4.jpg', '2025-06-23 07:03:32', '2025-07-01 14:34:52', NULL, 1, 1, 1),
(4, 'Sản phẩm 2', 'WD2989', '<p>Khong co</p>', NULL, NULL, NULL, NULL, 1, 6, 7, 6, 1, 1, 12, 1, 'images/JNLcFPtAlwcBqzyz0SyOcAjbi5Qq8T12dC2dNQOu.jpg', '2025-06-23 07:05:48', '2025-07-01 14:34:30', NULL, 1, 1, 1),
(5, 'Sản phẩm 51111', 'WD2441', '<p>Khong coooo111111</p>', NULL, NULL, NULL, NULL, 1, 9, 8, 6, 1, 4, 12, 1, 'images/4kELEjQRGSbIeLC7b4vlBmjAHmEIiYJSfY3UNcNc.jpg', '2025-06-23 07:06:49', '2025-07-07 14:19:26', NULL, NULL, NULL, NULL),
(6, 'Test0001', 'WD6484', '<p>MO TA CUA TOI</p>\r\n<p><img src=\"https://theme.hstatic.net/1000288298/1001020793/14/categorybanner_1_img.jpg?v=1515\" alt=\"\" width=\"514\" height=\"222\"></p>\r\n<p><img src=\"https://theme.hstatic.net/1000288298/1001020793/14/slide_1_img.jpg?v=1515\" alt=\"\" width=\"455\" height=\"246\"></p>\r\n<p>cho chu 123</p>', NULL, NULL, NULL, NULL, 1, 1, 1, 1, 2, 1, 36, 1, 'images/38Yadw9w5fIwKUyjcv8J6jcNcTpzgaRPN9MEqZnh.png', '2025-06-30 14:04:50', '2025-06-30 14:13:58', NULL, 1, 1, 1),
(7, 'Màn hình 1', 'WD5098', '<p>M&agrave;n h&igrave;nh 1</p>', '123456.00', '1234567.00', 15, NULL, 0, NULL, NULL, NULL, 4, 1, 5, 1, 'images/nTAlVt1fuP4lryBwdt97JfzRWbUpuccBkvBSTUt0.jpg', '2025-07-07 14:45:02', '2025-07-07 14:45:02', NULL, NULL, NULL, NULL);

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
('6tXmT8hzkU821q0RrV3NkXxIL6L8N364kxNkAJBj', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieHlqcElKOURxZlhHUnNsbTNWNGpTcmlveklZNENqZ2hmcjhTMnl3RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kb24taGFuZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0L2NvdW50Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7fQ==', 1751992196);

-- --------------------------------------------------------

--
-- Table structure for table `tan_nhiets`
--

CREATE TABLE `tan_nhiets` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `gia_sale` decimal(10,2) DEFAULT NULL,
  `mo_ta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tan_nhiets`
--

INSERT INTO `tan_nhiets` (`id`, `ten`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tản nhiệt nước ống to', '13000000.00', '999999.00', '<p>Tản nhiệt cho m&aacute;y</p>', '2025-06-30 13:45:51', '2025-06-30 13:45:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thuong_hieus`
--

CREATE TABLE `thuong_hieus` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thuong_hieus`
--

INSERT INTO `thuong_hieus` (`id`, `ten`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ASUS', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'MSI', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'GIGABYTE', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'Intel', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(5, 'AMD', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(6, 'Samsung', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(7, 'Kingston', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `ten_dang_nhap` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ho_ten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vai_tro` enum('khach_hang','quan_tri') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'khach_hang',
  `trang_thai` enum('hoat_dong','vo_hieu','an') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hoat_dong',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ten_dang_nhap`, `email`, `email_verified_at`, `password`, `ho_ten`, `so_dien_thoai`, `vai_tro`, `trang_thai`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user1', 'user1@example.com', '2025-06-20 21:17:36', '$2y$12$M82WNCPP82hVgCtKngUf1uy/6HDw0pXgyL0aRku5dloCRDgGj0goK', 'Dr. Javon Heathcote IV', '531.766.4545', 'khach_hang', 'hoat_dong', 'TIbuK8PcpQ', '2025-06-20 21:17:37', '2025-06-20 21:17:37', NULL),
(2, 'user2', 'user2@example.com', '2025-06-20 21:17:37', '$2y$12$emEIcuv/a06Sh0DHAqD.gepPV18Cj3.CECXtHrO7rwOsAdTwazqTO', 'Noel Heller', '424-207-1098', 'quan_tri', 'vo_hieu', 'HTXCknuZvp', '2025-06-20 21:17:37', '2025-06-20 21:17:37', NULL),
(3, 'user3', 'user3@example.com', '2025-06-20 21:17:37', '$2y$12$hgEGUO92hMKynRPYkmgTWOnj9mi/GTejv6Pkl3w5qIn52jOp5YZjm', 'Kellie Cole', '(331) 643-8718', 'quan_tri', 'hoat_dong', '1urfPSXX9L', '2025-06-20 21:17:37', '2025-06-20 21:17:37', NULL),
(4, 'user4', 'user4@example.com', '2025-06-20 21:17:37', '$2y$12$V9XYKBokY2Vxket2GqDLPO1Q370baJxXkwyLHHivCs3mqC/Bs.m1q', 'Myron Jerde', '(480) 861-1938', 'khach_hang', 'hoat_dong', 'm09CR2rBj3', '2025-06-20 21:17:37', '2025-06-20 21:17:37', NULL),
(5, 'user5', 'user5@example.com', '2025-06-20 21:17:37', '$2y$12$q0s5pPoEIX/80M7Rw7x9V.mGesTI32ycAV65mTMZfl50J8xmYIXKi', 'Christelle Kessler', '+1-646-844-1928', 'khach_hang', 'hoat_dong', 'hkHUzBuPSR', '2025-06-20 21:17:37', '2025-06-20 21:17:37', NULL),
(6, 'user6', 'user6@example.com', '2025-06-20 21:17:37', '$2y$12$/f23bO9LjShISXS8P1z7YOPdfHTYARMTz0SGL9zBQ29Bkb5Zei.X6', 'Magdalena Jaskolski', '+1-641-433-5222', 'khach_hang', 'hoat_dong', '0XbsgQGexf', '2025-06-20 21:17:38', '2025-06-20 21:17:38', NULL),
(7, 'user7', 'user7@example.com', '2025-06-20 21:17:38', '$2y$12$GK7IMaqc7c8rAWEq.uuEK.QSR6YLydhgCar5IhOe8md42Oax.qYaS', 'Irving Volkman', '+18205056253', 'khach_hang', 'vo_hieu', 'davdqIOB9d', '2025-06-20 21:17:38', '2025-06-20 21:17:38', NULL),
(8, 'user8', 'user8@example.com', '2025-06-20 21:17:38', '$2y$12$LkXq7JKCinWQsnr2BTa.h.sXFu03vEtuBavYDouDNv6URupuapfqq', 'Hipolito Lakin', '202-327-6013', 'khach_hang', 'vo_hieu', 'rnZViImhFV', '2025-06-20 21:17:38', '2025-06-20 21:17:38', NULL),
(9, 'user9', 'user9@example.com', '2025-06-20 21:17:38', '$2y$12$sVupVSeLGiXHNeOl3KbIA.ijGQPE8nk6IpMvUevvFs2FEcS2UWa/G', 'Eldora Green', '+1-828-854-1952', 'khach_hang', 'vo_hieu', '8Y0jYUT0E4', '2025-06-20 21:17:38', '2025-06-20 21:17:38', NULL),
(10, 'user10', 'user10@example.com', '2025-06-20 21:17:38', '$2y$12$UIrTey5/nTcSPQXya/jt6ugXhn7nHKe7hOSCdMNIeKco16ji7IU.K', 'Alaina Cruickshank Jr.', '1-351-732-2295', 'quan_tri', 'vo_hieu', 'Dxh19IPWx9', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(11, 'phong', 'phongtvph52541@gmail.com', NULL, '$2y$12$Kd3PHV7mJm09tpZIx0izWOX6qD7OxrJOFd1x2ZpIWva6qq3nkRh6O', 'Trần Văn Phong', '0325413923', 'quan_tri', 'hoat_dong', NULL, '2025-06-20 21:18:23', '2025-06-20 21:18:23', NULL),
(12, 'Nguyễn Danh Dũng', 'nguyendanhdung479@gmail.com', NULL, '$2y$12$YOP.JeySQGm2Iq5JyCrKjO./3nsy5tVUo83J9sbPR4hLYPBee9DdG', 'Nguyễn Danh Dũng', '0376536999', 'quan_tri', 'hoat_dong', NULL, '2025-06-23 07:01:12', '2025-06-23 07:01:12', NULL),
(13, 'phamhai1', 'phamdinhhaigstt@gmail.com', NULL, '$2y$12$Ao3OGRvnadAatPJjHyxvFOkM7GD5k572pd2dmlre4.w.5nTkutqhO', 'Phạm Đình Hải1', '0971734530', 'quan_tri', 'hoat_dong', NULL, '2025-06-28 03:34:38', '2025-06-28 03:56:46', NULL),
(14, 'hai', 'haipdph53278@gmail.com', NULL, '$2y$12$45mbpEByYOcdKHitzPbm7Od/usPz9qy8h.dvSMzcFC62G06bs8.8y', 'Phạm Đình Hải', '0961605509', 'khach_hang', 'hoat_dong', NULL, '2025-06-28 04:00:19', '2025-06-28 04:00:19', NULL),
(15, 'hahai', 'haip00577@gmail.com', NULL, '$2y$12$GiIlXjF1WMGwFkDflxpHDeJJmlEVWy/EE5OAyOINlftY2C7YdarPS', 'Phạm Đình Hải', '0705120931', 'khach_hang', 'hoat_dong', NULL, '2025-06-28 09:33:08', '2025-06-28 09:33:08', NULL),
(17, 'nvpdevil', 'admin@gmail.com', NULL, '$2y$12$yy4HDO3SNwO91hYlyz32j.H8VxEVE8KTy3igRvMOhaAX5wbGy1GyW', 'NVP Devil', '0123123123', 'quan_tri', 'hoat_dong', NULL, '2025-06-29 10:00:16', '2025-06-29 10:00:16', NULL),
(18, 'ToiDepTrai', 'phinvph53102@gmail.com', NULL, '$2y$12$3cpFCt0ux50i9yLrWVp1Ue1tTmroR/Ud921/ob6xyLdPjU9wIwImq', 'DepTraiProVip', '0346380214', 'quan_tri', 'hoat_dong', NULL, '2025-06-30 14:25:03', '2025-06-30 14:25:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `yeu_cau_hoan_tra`
--

CREATE TABLE `yeu_cau_hoan_tra` (
  `id` bigint UNSIGNED NOT NULL,
  `id_don_hang` bigint UNSIGNED NOT NULL,
  `ma_hoan_tra` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt_lien_he` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phuong_thuc_hoan_tien` enum('momo','bank_transfer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_ngan_hang` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_tai_khoan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ten_chu_tai_khoan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ly_do` text COLLATE utf8mb4_unicode_ci,
  `trang_thai` enum('cho_phe_duyet','da_phe_duyet','tu_choi','dang_van_chuyen_tra_hang','da_nhan_hang','da_hoan_tien') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cho_phe_duyet',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yeu_cau_hoan_tra`
--

INSERT INTO `yeu_cau_hoan_tra` (`id`, `id_don_hang`, `ma_hoan_tra`, `sdt_lien_he`, `phuong_thuc_hoan_tien`, `ten_ngan_hang`, `so_tai_khoan`, `ten_chu_tai_khoan`, `ly_do`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 1, 'HTXCMCIMEY', '0376536936', 'momo', NULL, NULL, NULL, 'Sản phẩm ABCDEFGHJQK', 'cho_phe_duyet', '2025-07-08 15:33:41', '2025-07-08 15:33:41'),
(2, 2, 'HTKO05CECI', '0376536936', 'momo', NULL, NULL, NULL, 'Sản phẩm lỗi ABCDASDF', 'cho_phe_duyet', '2025-07-08 15:42:13', '2025-07-08 15:42:13'),
(3, 3, 'HT4SIVLX2O', '0376536936', 'bank_transfer', 'Vietcombank', '0376536935', 'Nguyen Danh Dung', 'ádfghjk', 'cho_phe_duyet', '2025-07-08 15:44:15', '2025-07-08 15:44:15'),
(4, 4, 'HTUSSI0NZA', '0376536936', 'momo', NULL, '0376536935', 'Nguyen Danh Dung', '123459876heeh', 'cho_phe_duyet', '2025-07-08 15:48:52', '2025-07-08 15:48:52'),
(5, 10, 'HTXXECOIUH', '0376536936', 'momo', NULL, '0376536935', 'Nguyen Danh Dung', 'Khoong thich nen tra', 'cho_phe_duyet', '2025-07-08 16:29:50', '2025-07-08 16:29:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anh_san_phams_id_product_foreign` (`id_product`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bien_the_san_phams_ma_bien_the_unique` (`ma_bien_the`),
  ADD KEY `bien_the_san_phams_id_product_foreign` (`id_product`),
  ADD KEY `bien_the_san_phams_id_ram_foreign` (`id_ram`),
  ADD KEY `bien_the_san_phams_id_o_cung_foreign` (`id_o_cung`);

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
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chips`
--
ALTER TABLE `chips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_don_hangs_id_don_hang_foreign` (`id_don_hang`),
  ADD KEY `chi_tiet_don_hangs_id_bien_the_foreign` (`id_bien_the`),
  ADD KEY `chi_tiet_don_hangs_id_product_foreign` (`id_product`);

--
-- Indexes for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_gio_hangs_id_gio_hang_foreign` (`id_gio_hang`),
  ADD KEY `chi_tiet_gio_hangs_id_bien_the_foreign` (`id_bien_the`),
  ADD KEY `chi_tiet_gio_hangs_id_product_foreign` (`id_product`);

--
-- Indexes for table `danh_gia_san_phams`
--
ALTER TABLE `danh_gia_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danh_gia_san_phams_id_product_foreign` (`id_product`),
  ADD KEY `danh_gia_san_phams_id_user_foreign` (`id_user`);

--
-- Indexes for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dia_chi_nguoi_dungs`
--
ALTER TABLE `dia_chi_nguoi_dungs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dia_chi_nguoi_dungs_id_user_foreign` (`id_user`);

--
-- Indexes for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `don_hangs_ma_don_unique` (`ma_don`),
  ADD KEY `don_hangs_id_user_foreign` (`id_user`),
  ADD KEY `don_hangs_id_dia_chi_nguoi_dungs_foreign` (`id_dia_chi_nguoi_dungs`),
  ADD KEY `don_hangs_id_phuong_thuc_thanh_toan_foreign` (`id_phuong_thuc_thanh_toan`),
  ADD KEY `don_hangs_id_ma_giam_gia_foreign` (`id_ma_giam_gia`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gio_hangs_id_user_foreign` (`id_user`),
  ADD KEY `gio_hangs_id_giam_gia_foreign` (`id_giam_gia`);

--
-- Indexes for table `gpus`
--
ALTER TABLE `gpus`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `lich_su_xems`
--
ALTER TABLE `lich_su_xems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lich_su_xems_id_user_foreign` (`id_user`),
  ADD KEY `lich_su_xems_id_product_foreign` (`id_product`);

--
-- Indexes for table `mainboards`
--
ALTER TABLE `mainboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_giam_gias`
--
ALTER TABLE `ma_giam_gias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_giam_gias_ma_unique` (`ma`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ngan_hangs`
--
ALTER TABLE `ngan_hangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_viet_tat` (`ten_viet_tat`);

--
-- Indexes for table `nguons`
--
ALTER TABLE `nguons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhat_ky_ton_khos`
--
ALTER TABLE `nhat_ky_ton_khos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhat_ky_ton_khos_id_bien_the_foreign` (`id_bien_the`);

--
-- Indexes for table `o_cungs`
--
ALTER TABLE `o_cungs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rams`
--
ALTER TABLE `rams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `san_phams_ma_san_pham_unique` (`ma_san_pham`),
  ADD KEY `san_phams_id_chip_foreign` (`id_chip`),
  ADD KEY `san_phams_id_mainboard_foreign` (`id_mainboard`),
  ADD KEY `san_phams_id_gpu_foreign` (`id_gpu`),
  ADD KEY `san_phams_id_category_foreign` (`id_category`),
  ADD KEY `san_phams_id_brand_foreign` (`id_brand`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tan_nhiets`
--
ALTER TABLE `tan_nhiets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thuong_hieus`
--
ALTER TABLE `thuong_hieus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_ten_dang_nhap_unique` (`ten_dang_nhap`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `yeu_cau_hoan_tra`
--
ALTER TABLE `yeu_cau_hoan_tra`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `don_hoan_tras_ma_hoan_tra_unique` (`ma_hoan_tra`),
  ADD KEY `don_hoan_tras_id_don_hang_foreign` (`id_don_hang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chips`
--
ALTER TABLE `chips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `danh_gia_san_phams`
--
ALTER TABLE `danh_gia_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dia_chi_nguoi_dungs`
--
ALTER TABLE `dia_chi_nguoi_dungs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gpus`
--
ALTER TABLE `gpus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lich_su_xems`
--
ALTER TABLE `lich_su_xems`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mainboards`
--
ALTER TABLE `mainboards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ma_giam_gias`
--
ALTER TABLE `ma_giam_gias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `ngan_hangs`
--
ALTER TABLE `ngan_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nguons`
--
ALTER TABLE `nguons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nhat_ky_ton_khos`
--
ALTER TABLE `nhat_ky_ton_khos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o_cungs`
--
ALTER TABLE `o_cungs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rams`
--
ALTER TABLE `rams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tan_nhiets`
--
ALTER TABLE `tan_nhiets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `thuong_hieus`
--
ALTER TABLE `thuong_hieus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `yeu_cau_hoan_tra`
--
ALTER TABLE `yeu_cau_hoan_tra`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  ADD CONSTRAINT `anh_san_phams_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`);

--
-- Constraints for table `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  ADD CONSTRAINT `bien_the_san_phams_id_o_cung_foreign` FOREIGN KEY (`id_o_cung`) REFERENCES `o_cungs` (`id`),
  ADD CONSTRAINT `bien_the_san_phams_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `bien_the_san_phams_id_ram_foreign` FOREIGN KEY (`id_ram`) REFERENCES `rams` (`id`);

--
-- Constraints for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD CONSTRAINT `chi_tiet_don_hangs_id_bien_the_foreign` FOREIGN KEY (`id_bien_the`) REFERENCES `bien_the_san_phams` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hangs_id_don_hang_foreign` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hangs` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hangs_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD CONSTRAINT `chi_tiet_gio_hangs_id_bien_the_foreign` FOREIGN KEY (`id_bien_the`) REFERENCES `bien_the_san_phams` (`id`),
  ADD CONSTRAINT `chi_tiet_gio_hangs_id_gio_hang_foreign` FOREIGN KEY (`id_gio_hang`) REFERENCES `gio_hangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_gio_hangs_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `danh_gia_san_phams`
--
ALTER TABLE `danh_gia_san_phams`
  ADD CONSTRAINT `danh_gia_san_phams_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `danh_gia_san_phams_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `dia_chi_nguoi_dungs`
--
ALTER TABLE `dia_chi_nguoi_dungs`
  ADD CONSTRAINT `dia_chi_nguoi_dungs_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD CONSTRAINT `don_hangs_id_dia_chi_nguoi_dungs_foreign` FOREIGN KEY (`id_dia_chi_nguoi_dungs`) REFERENCES `dia_chi_nguoi_dungs` (`id`),
  ADD CONSTRAINT `don_hangs_id_ma_giam_gia_foreign` FOREIGN KEY (`id_ma_giam_gia`) REFERENCES `ma_giam_gias` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `don_hangs_id_phuong_thuc_thanh_toan_foreign` FOREIGN KEY (`id_phuong_thuc_thanh_toan`) REFERENCES `phuong_thuc_thanh_toans` (`id`),
  ADD CONSTRAINT `don_hangs_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD CONSTRAINT `gio_hangs_id_giam_gia_foreign` FOREIGN KEY (`id_giam_gia`) REFERENCES `ma_giam_gias` (`id`),
  ADD CONSTRAINT `gio_hangs_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lich_su_xems`
--
ALTER TABLE `lich_su_xems`
  ADD CONSTRAINT `lich_su_xems_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `lich_su_xems_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `nhat_ky_ton_khos`
--
ALTER TABLE `nhat_ky_ton_khos`
  ADD CONSTRAINT `nhat_ky_ton_khos_id_bien_the_foreign` FOREIGN KEY (`id_bien_the`) REFERENCES `bien_the_san_phams` (`id`);

--
-- Constraints for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD CONSTRAINT `san_phams_id_brand_foreign` FOREIGN KEY (`id_brand`) REFERENCES `thuong_hieus` (`id`),
  ADD CONSTRAINT `san_phams_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `danh_mucs` (`id`),
  ADD CONSTRAINT `san_phams_id_chip_foreign` FOREIGN KEY (`id_chip`) REFERENCES `chips` (`id`),
  ADD CONSTRAINT `san_phams_id_gpu_foreign` FOREIGN KEY (`id_gpu`) REFERENCES `gpus` (`id`),
  ADD CONSTRAINT `san_phams_id_mainboard_foreign` FOREIGN KEY (`id_mainboard`) REFERENCES `mainboards` (`id`);

--
-- Constraints for table `yeu_cau_hoan_tra`
--
ALTER TABLE `yeu_cau_hoan_tra`
  ADD CONSTRAINT `don_hoan_tras_id_don_hang_foreign` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hangs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
