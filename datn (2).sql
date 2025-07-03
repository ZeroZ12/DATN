-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 29, 2025 at 04:18 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.20

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
(6, 2, 'images/anh_phu/LTtg29VVjyvyK8kmLcgvxb9TgjlonJo35eMi3zfm.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(7, 2, 'images/anh_phu/0k1nLMKXv88rcXd9p47qO68NDNvp9cpzlZDKxjKs.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(8, 2, 'images/anh_phu/f4dVUMsU50ZhjjJbMi3uk5V7ww45Q9bCYjLhkrJJ.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(9, 2, 'images/anh_phu/9yYFOcNENPzFCn9Pc0YSt2kWHgJ64OwqHQmbs3bg.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(10, 2, 'images/anh_phu/vinTbeKr0gz7XmgWNYkBQeYpQlzikH6IGSEuDW4N.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(11, 3, 'images/uCs6qUdxuHUDkErOms0E8NWjnqeosy6kzDLtrNd6.png', '2025-06-26 11:04:04', '2025-06-26 11:04:04', NULL),
(12, 3, 'images/5J3mrP3pBzx74gZ240UT4CSRmlCAglmfTkx23VIM.png', '2025-06-26 11:04:04', '2025-06-26 11:04:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image_url`, `sale`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Qui et officia ut.', 'banners/fy4OjSj1P7zE5bcWEkQKVaUEHCtNbF37d4POTtpo.png', 25.16, 'Et pariatur temporibus at nobis culpa fuga. Nisi dolore iste quis dolores animi. Aliquid repudiandae consequatur corporis reprehenderit. Magni error nisi est et illum saepe. Ipsam cumque hic quod architecto assumenda.', '2025-06-27 10:35:05', '2025-06-28 17:49:56', NULL),
(2, 'Aut voluptas et quaerat accusamus amet quas.', 'banners/LckSMfajoY0nh0cRXfD40D3PPJN4d64BFOoD9eUl.png', 58.60, 'Labore aut iste minus et tenetur consequatur aut. Repudiandae ab impedit ea et. Sit iure aut ea libero et. Voluptatem enim voluptas sed ut. Pariatur blanditiis assumenda atque ex ut cum aut.', '2025-06-27 10:35:05', '2025-06-28 17:49:45', NULL),
(14, '1', 'banners/USgRXl5zyLFBJyiLzLirN4pUyK158Q9wUFJXfBDj.png', 15.00, '1', '2025-06-28 17:50:37', '2025-06-28 17:50:37', NULL);

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
(1, 1, 1, 1, 9990000.00, 10990000.00, 6, 'BT7594', NULL, 1, '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(2, 1, 1, 3, 15990000.00, 20990000.00, 5, 'BT8080', NULL, 1, '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(3, 1, 2, 1, 12990000.00, 20990000.00, 7, 'BT8396', NULL, 1, '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(4, 2, 1, 1, 9990000.00, 10990000.00, 6, 'BT6018', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(5, 2, 1, 3, 9990000.00, 10990000.00, 8, 'BT3266', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(6, 2, 2, 1, 9990000.00, 10990000.00, 9, 'BT0017', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(7, 2, 2, 3, 9990000.00, 10990000.00, 8, 'BT5952', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(8, 3, 1, 1, 12000000.00, 15000000.00, 5, 'BT3990', NULL, 1, '2025-06-23 07:03:32', '2025-06-23 07:03:32', NULL),
(9, 3, 8, 1, 14000000.00, 16000000.00, 5, 'BT6309', NULL, 1, '2025-06-23 07:03:32', '2025-06-23 07:03:32', NULL),
(10, 4, 2, 2, 13000000.00, 16000000.00, 5, 'BT9822', NULL, 1, '2025-06-23 07:05:48', '2025-06-23 07:05:48', NULL),
(11, 4, 2, 3, 14000000.00, 17000000.00, 5, 'BT3712', NULL, 1, '2025-06-23 07:05:48', '2025-06-23 07:05:48', NULL),
(12, 4, 9, 3, 15000000.00, 18000000.00, 5, 'BT0724', NULL, 1, '2025-06-23 07:05:48', '2025-06-23 07:05:48', NULL),
(13, 5, 2, 5, 12000000.00, 14000000.00, 5, 'BT4957', NULL, 1, '2025-06-23 07:06:49', '2025-06-23 07:06:49', NULL),
(14, 5, 10, 5, 12000000.00, 14000000.00, 5, 'BT6292', NULL, 1, '2025-06-23 07:06:49', '2025-06-23 07:06:49', NULL);

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

INSERT INTO `chi_tiet_don_hangs` (`id`, `id_don_hang`, `id_product`, `id_bien_the`, `ten_hien_thi`, `so_luong`, `don_gia`, `bao_hanh_thang`, `created_at`, `updated_at`) VALUES
(1, 14, 5, 13, 'Sản phẩm 5', 1, 12000000.00, 12, '2025-06-23 22:17:38', '2025-06-23 22:17:38'),
(2, 15, 5, 13, 'Sản phẩm 5', 1, 12000000.00, 12, '2025-06-25 07:07:14', '2025-06-25 07:07:14'),
(3, 15, 4, 10, 'Sản phẩm 2', 1, 13000000.00, 12, '2025-06-25 07:07:14', '2025-06-25 07:07:14'),
(4, 16, 5, 13, 'Sản phẩm 5', 1, 12000000.00, 12, '2025-06-25 07:08:44', '2025-06-25 07:08:44'),
(5, 17, 5, 13, 'Sản phẩm 5', 1, 12000000.00, 12, '2025-06-25 08:28:12', '2025-06-25 08:28:12'),
(6, 18, 5, 13, 'Sản phẩm 5', 1, 12000000.00, 12, '2025-06-26 11:38:12', '2025-06-26 11:38:12'),
(7, 19, 5, 13, 'Sản phẩm 5', 1, 12000000.00, 12, '2025-06-26 19:34:16', '2025-06-26 19:34:16'),
(8, 20, 3, 8, 'Sản phẩm 1', 1, 12000000.00, 12, '2025-06-28 12:40:03', '2025-06-28 12:40:03'),
(9, 21, 5, 13, 'Sản phẩm 5', 1, 12000000.00, 12, '2025-06-28 12:44:46', '2025-06-28 12:44:46'),
(10, 22, 4, 12, 'Sản phẩm 2', 5, 15000000.00, 12, '2025-06-28 13:16:19', '2025-06-28 13:16:19');

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
(12, 1, 1, 3, 1, 12990000.00, '2025-06-21 09:33:43', '2025-06-21 09:33:43'),
(46, 3, 4, 10, 5, 13000000.00, '2025-06-28 17:57:10', '2025-06-28 17:57:10');

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
(1, 1, 11, 4, 'Đẹp thật sự', '2025-06-20 21:25:18', '2025-06-21 07:30:06', 'da_duyet', NULL),
(2, 5, 13, 4, 'hay', '2025-06-25 08:40:43', '2025-06-26 11:06:15', 'da_duyet', NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dia_chi_nguoi_dungs`
--

INSERT INTO `dia_chi_nguoi_dungs` (`id`, `id_user`, `ten_nguoi_nhan`, `so_dien_thoai_nguoi_nhan`, `dia_chi_day_du`, `tinh_thanh_pho`, `quan_huyen`, `phuong_xa`, `mac_dinh`, `created_at`, `updated_at`) VALUES
(1, 11, 'Trần Pohng', '0325413923', 'ff', 'Hà Nội', 'Nam Từ Liêm', 'Hội', 1, '2025-06-21 08:54:22', '2025-06-21 08:54:34'),
(2, 12, 'Nguyễn Danh Dũng', '0376536987', '123 ABC', 'Phú Thọ', 'Cẩm Khê', 'Tuy Lộc', 0, '2025-06-23 07:08:36', '2025-06-23 07:44:45'),
(3, 12, 'Nguyễn Danh Dũng', '0123456789', 'ABC', 'Phú Thọ 1', 'Cẩm', 'Tuy Lộc', 1, '2025-06-23 07:44:40', '2025-06-23 07:44:45'),
(4, 13, 'Nguyen Văn A', '0353535355', 'Ha Noi', 'Ha Noi', 'Ha Noi', 'Ha Noi', 1, '2025-06-25 07:06:37', '2025-06-25 07:06:37');

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
  `trang_thai` enum('cho_xac_nhan','cho_thanh_toan','chuan_bi_hang','da_xac_nhan','da_huy','dang_giao_hang','giao_thanh_cong','giao_that_bai','hoan_thanh','da_hoan_tien') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cho_xac_nhan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_ma_giam_gia` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `ma_don`, `id_user`, `id_dia_chi_nguoi_dungs`, `id_phuong_thuc_thanh_toan`, `tong_tien`, `tong_tien_goc`, `giam_gia`, `trang_thai`, `created_at`, `updated_at`, `id_ma_giam_gia`, `deleted_at`) VALUES
(14, 'DH1750742258', 12, 3, 1, 10800000.00, 12000000.00, 1200000.00, 'hoan_thanh', '2025-06-23 22:17:38', '2025-06-23 22:32:17', 5, NULL),
(15, 'DH1750835234', 13, 4, 2, 22500000.00, 25000000.00, 2500000.00, 'da_huy', '2025-06-25 07:07:14', '2025-06-26 11:33:50', 5, NULL),
(16, 'DH1750835324', 13, 4, 2, 12000000.00, 12000000.00, 0.00, 'da_huy', '2025-06-25 07:08:44', '2025-06-25 07:24:12', NULL, NULL),
(17, 'DH1750840092', 13, 4, 2, 12000000.00, 12000000.00, 0.00, 'da_huy', '2025-06-25 08:28:12', '2025-06-26 11:33:50', NULL, NULL),
(18, 'DH1750937892', 13, 4, 2, 12000000.00, 12000000.00, 0.00, 'da_huy', '2025-06-26 11:38:12', '2025-06-26 11:44:16', NULL, NULL),
(19, 'DH1750966456', 13, 4, 1, 10200000.00, 12000000.00, 1800000.00, 'cho_xac_nhan', '2025-06-26 19:34:16', '2025-06-26 19:34:16', 5, NULL),
(20, 'DH1751114403', 13, 4, 2, 11940000.00, 12000000.00, 60000.00, 'da_huy', '2025-06-28 12:40:03', '2025-06-28 12:44:28', 5, NULL),
(21, 'DH1751114686', 13, 4, 1, 11940000.00, 12000000.00, 60000.00, 'cho_xac_nhan', '2025-06-28 12:44:46', '2025-06-28 12:44:46', 5, NULL),
(22, 'DH1751116579', 13, 4, 1, 74940000.00, 75000000.00, 60000.00, 'cho_xac_nhan', '2025-06-28 13:16:19', '2025-06-28 13:16:19', 5, NULL);

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
(2, 12, 'chinh', NULL, NULL, '2025-06-23 07:01:21', '2025-06-23 22:17:38'),
(3, 13, 'chinh', 5, NULL, '2025-06-25 07:05:28', '2025-06-28 17:57:15');

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
(5, 'Giam10%', 'phan_tram', 15.00, 60000.00, 0.00, '2025-06-20 17:00:00', '2025-07-20 17:00:00', 1, '2025-06-20 21:17:39', '2025-06-26 21:13:18', NULL),
(6, 'Hocsinh', 'phan_tram', 22.00, 222.00, 0.00, '2025-06-20 17:00:00', '2025-06-21 17:00:00', 1, '2025-06-21 08:41:56', '2025-06-27 01:47:52', NULL);

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
(30, '2025_06_27_002817_add_gia_tri_toi_da_to_ma_giam_gias_table', 8),
(31, '2025_06_27_172518_create_banners_table', 9),
(32, '2025_06_27_204605_add_deleted_at_to_banners_table', 10);

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
  `id_chip` bigint UNSIGNED NOT NULL,
  `id_mainboard` bigint UNSIGNED NOT NULL,
  `id_gpu` bigint UNSIGNED NOT NULL,
  `id_category` bigint UNSIGNED NOT NULL,
  `id_brand` bigint UNSIGNED NOT NULL,
  `bao_hanh_thang` int NOT NULL,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `anh_dai_dien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten`, `ma_san_pham`, `mo_ta`, `id_chip`, `id_mainboard`, `id_gpu`, `id_category`, `id_brand`, `bao_hanh_thang`, `hoat_dong`, `anh_dai_dien`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 'WD0754', '<div><strong>PC FASTER GAMING 10400F - RTX 3050 6GB</strong>&nbsp;l&agrave; bộ PC Gaming - PC Đồ Họa Hiệu năng cao, được x&acirc;y dựng để đ&aacute;p ứng nhu cầu chơi game, học tập, l&agrave;m việc với mức gi&aacute; v&ocirc; c&ugrave;ng hợp l&yacute; . C&oacute; thể c&acirc;n tốt c&aacute;c tựa game Moba, FPS : LOL, FIFA, DOTA, CSGO, GTA 5 , PUBG.... cũng như c&aacute;c t&aacute;c vụ văn ph&ograve;ng , chỉnh sửa ảnh , edit video cơ bản.</div>\r\n<h3><strong>1.&nbsp;CPU Intel Core i5-10400F (2.9GHz turbo up to 4.3Ghz, 6 nh&acirc;n 12 luồng, 12MB Cache, 65W) - Socket Intel LGA 1200</strong></h3>\r\n<p><strong>CPU Intel Core i5-10400F</strong>&nbsp;ch&iacute;nh l&agrave; sự lựa chọn ho&agrave;n mỹ cho những ai muốn trải nghiệm hiệu suất đa nhiệm tốt nhưng c&oacute; gi&aacute; th&agrave;nh rẻ. CPU Intel Core i5-10400F đ&atilde; cắt giảm đi iGPU t&iacute;ch hợp sẵn nhưng vẫn đem lại trải nghiệm l&agrave;m việc tốt tương tự như bộ xử l&yacute; Intel Core i5 10400 th&ocirc;ng thường. mẫu CPU n&agrave;y sở hữu 6 nh&acirc;n 12 luồng cho đ&aacute;p ứng tốt nhu cầu l&agrave;m việc v&agrave; giải tr&iacute; c&ugrave;ng l&uacute;c. C&oacute; thể n&oacute;i, với mức gi&aacute; ph&ugrave; hợp, đ&acirc;y chắc chắn l&agrave; lựa chọn số 1 cho người d&ugrave;ng phổ th&ocirc;ng.</p>\r\n<p>&nbsp;</p>\r\n<div>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/i5_10400f_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3>&nbsp;</h3>\r\n<h3><strong>3. RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp;</strong></h3>\r\n<p>RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp; l&agrave; d&ograve;ng sản phẩm RAM chất lượng , ổn định , &nbsp;c&oacute; hiệu suất cực cao , tốc độ truyền tải nhanh ch&oacute;ng, khả năng tương th&iacute;ch tốt cho ph&eacute;p tất cả c&aacute;c game thủ vượt giới hạn tốc độ v&agrave; tận hưởng thế giới game ấn tượng nhất . Được thiết kế cho c&aacute;c game thủ v&agrave; những người &nbsp;đam m&ecirc;. những người muốn n&acirc;ng cấp tiết kiệm chi ph&iacute; để chơi game nhanh hơn.Đ&acirc;y l&agrave; sự lựa chọn tuyệt vời cho bộ PC Gaming gi&aacute; rẻ m&agrave; c&aacute;c game thủ kh&ocirc;ng n&ecirc;n bỏ qua.</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/ram-geil-evo-spear-16gb-ddr4-bus-3200_pcm_2114afa10c95413db9ef7c74bf1f9d4d_grande.png\"></p>\r\n<p>&nbsp;</p>\r\n<h3>4.&nbsp;&nbsp;Ổ cứng SSD TeamGroup CX2 256GB 2.5 inch SATA III</h3>\r\n<p>SSD TeamGroup CX2 được trang bị c&ocirc;ng nghệ FLASH hiện đại, tiết kiệm năng lượng ti&ecirc;u thụ cũng như tốc độ truyền cao. Hiệu suất mang lại kh&aacute;c hẳn so với những chiếc ổ cứng truyền thống trước đ&acirc;y. SSD TeamGroup CX2 sử dụng c&ocirc;ng nghệ SLC Caching t&acirc;n tiến được nh&agrave; sản xuất đưa v&agrave;o nhằm tối ưu hiệu suất l&agrave;m việc tr&ecirc;n m&aacute;y t&iacute;nh cho người d&ugrave;ng. Sở hữu tốc độ đọc/ghi nhanh gấp 4 lần so với c&aacute;c ổ cứng truyền thống. Được trang bị khả năng chống sốc v&agrave; rơi 1500G/0.5mili gi&acirc;y mang đến ổ cứng TeamGroup bền bỉ hơn. Đồng thời SSD CX2 cũng được thiết kế với trải nghiệm kh&ocirc;ng g&acirc;y ra tiếng ồn cơ học kh&oacute; chịu tối ưu trải nghiệm người d&ugrave;ng hơn. Để k&eacute;o d&agrave;i tuổi thọ hơn cho ổ cứng SSD TeamGroup CX2 c&ograve;n được trang bị th&ecirc;m c&ocirc;ng nghệ Wear-Leveling v&agrave; chức năng ECC. Tất cả nhằm mang đến trải nghiệm sử dụng tốt hơn cho người d&ugrave;ng với tốc độ tin cậy trong qu&aacute; tr&igrave;nh truyền dữ liệu. C&ugrave;ng đ&oacute; l&agrave; mức độ bền bỉ khi tuổi thọ của SSD được đảm bảo tốt hơn.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/o_cung_ssd_teamgroup_cx2_256gb_2.5_inch_sata_iii_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>5. &nbsp;CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;</strong></h3>\r\n<p>CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;&nbsp; l&agrave; một sản phẩm đ&aacute;ng ch&uacute; &yacute; trong ph&acirc;n kh&uacute;c card đồ họa tầm trung.Với kiến tr&uacute;c NVIDI Ampere mới nhất sử dụng chip đồ họa NVIDIA GeForce RTX 3050, c&oacute; khả năng xử l&yacute; đồ họa 3D mượt m&agrave;, hỗ trợ c&ocirc;ng nghệ ray tracing v&agrave; DLSS., RTX 3050 DUAL OC 6GB kết hợp hiệu suất nhiệt tối ưu với khả năng tương th&iacute;ch cao. Đ&acirc;y l&agrave; sự lựa chọn ho&agrave;n hảo cho những game thủ muốn c&oacute; hiệu suất đồ họa mạnh trong một cấu h&igrave;nh nhỏ gọn.</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/zt-a30500h-10m-image01_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n</div>', 1, 2, 2, 2, 1, 36, 1, 'images/zNLVsTDHQdO9jgYmwxSBoKia784MVCHcGEh5SB2W.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(2, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 'WD0622', '<div><strong>PC FASTER GAMING 10400F - RTX 3050 6GB</strong>&nbsp;l&agrave; bộ PC Gaming - PC Đồ Họa Hiệu năng cao, được x&acirc;y dựng để đ&aacute;p ứng nhu cầu chơi game, học tập, l&agrave;m việc với mức gi&aacute; v&ocirc; c&ugrave;ng hợp l&yacute; . C&oacute; thể c&acirc;n tốt c&aacute;c tựa game Moba, FPS : LOL, FIFA, DOTA, CSGO, GTA 5 , PUBG.... cũng như c&aacute;c t&aacute;c vụ văn ph&ograve;ng , chỉnh sửa ảnh , edit video cơ bản.</div>\r\n<h3><strong>1.&nbsp;CPU Intel Core i5-10400F (2.9GHz turbo up to 4.3Ghz, 6 nh&acirc;n 12 luồng, 12MB Cache, 65W) - Socket Intel LGA 1200</strong></h3>\r\n<p><strong>CPU Intel Core i5-10400F</strong>&nbsp;ch&iacute;nh l&agrave; sự lựa chọn ho&agrave;n mỹ cho những ai muốn trải nghiệm hiệu suất đa nhiệm tốt nhưng c&oacute; gi&aacute; th&agrave;nh rẻ. CPU Intel Core i5-10400F đ&atilde; cắt giảm đi iGPU t&iacute;ch hợp sẵn nhưng vẫn đem lại trải nghiệm l&agrave;m việc tốt tương tự như bộ xử l&yacute; Intel Core i5 10400 th&ocirc;ng thường. mẫu CPU n&agrave;y sở hữu 6 nh&acirc;n 12 luồng cho đ&aacute;p ứng tốt nhu cầu l&agrave;m việc v&agrave; giải tr&iacute; c&ugrave;ng l&uacute;c. C&oacute; thể n&oacute;i, với mức gi&aacute; ph&ugrave; hợp, đ&acirc;y chắc chắn l&agrave; lựa chọn số 1 cho người d&ugrave;ng phổ th&ocirc;ng.</p>\r\n<p>&nbsp;</p>\r\n<div>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/i5_10400f_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3>&nbsp;</h3>\r\n<h3><strong>3. RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp;</strong></h3>\r\n<p>RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp; l&agrave; d&ograve;ng sản phẩm RAM chất lượng , ổn định , &nbsp;c&oacute; hiệu suất cực cao , tốc độ truyền tải nhanh ch&oacute;ng, khả năng tương th&iacute;ch tốt cho ph&eacute;p tất cả c&aacute;c game thủ vượt giới hạn tốc độ v&agrave; tận hưởng thế giới game ấn tượng nhất . Được thiết kế cho c&aacute;c game thủ v&agrave; những người &nbsp;đam m&ecirc;. những người muốn n&acirc;ng cấp tiết kiệm chi ph&iacute; để chơi game nhanh hơn.Đ&acirc;y l&agrave; sự lựa chọn tuyệt vời cho bộ PC Gaming gi&aacute; rẻ m&agrave; c&aacute;c game thủ kh&ocirc;ng n&ecirc;n bỏ qua.</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/ram-geil-evo-spear-16gb-ddr4-bus-3200_pcm_2114afa10c95413db9ef7c74bf1f9d4d_grande.png\"></p>\r\n<p>&nbsp;</p>\r\n<h3>4.&nbsp;&nbsp;Ổ cứng SSD TeamGroup CX2 256GB 2.5 inch SATA III</h3>\r\n<p>SSD TeamGroup CX2 được trang bị c&ocirc;ng nghệ FLASH hiện đại, tiết kiệm năng lượng ti&ecirc;u thụ cũng như tốc độ truyền cao. Hiệu suất mang lại kh&aacute;c hẳn so với những chiếc ổ cứng truyền thống trước đ&acirc;y. SSD TeamGroup CX2 sử dụng c&ocirc;ng nghệ SLC Caching t&acirc;n tiến được nh&agrave; sản xuất đưa v&agrave;o nhằm tối ưu hiệu suất l&agrave;m việc tr&ecirc;n m&aacute;y t&iacute;nh cho người d&ugrave;ng. Sở hữu tốc độ đọc/ghi nhanh gấp 4 lần so với c&aacute;c ổ cứng truyền thống. Được trang bị khả năng chống sốc v&agrave; rơi 1500G/0.5mili gi&acirc;y mang đến ổ cứng TeamGroup bền bỉ hơn. Đồng thời SSD CX2 cũng được thiết kế với trải nghiệm kh&ocirc;ng g&acirc;y ra tiếng ồn cơ học kh&oacute; chịu tối ưu trải nghiệm người d&ugrave;ng hơn. Để k&eacute;o d&agrave;i tuổi thọ hơn cho ổ cứng SSD TeamGroup CX2 c&ograve;n được trang bị th&ecirc;m c&ocirc;ng nghệ Wear-Leveling v&agrave; chức năng ECC. Tất cả nhằm mang đến trải nghiệm sử dụng tốt hơn cho người d&ugrave;ng với tốc độ tin cậy trong qu&aacute; tr&igrave;nh truyền dữ liệu. C&ugrave;ng đ&oacute; l&agrave; mức độ bền bỉ khi tuổi thọ của SSD được đảm bảo tốt hơn.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/o_cung_ssd_teamgroup_cx2_256gb_2.5_inch_sata_iii_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>5. &nbsp;CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;</strong></h3>\r\n<p>CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;&nbsp; l&agrave; một sản phẩm đ&aacute;ng ch&uacute; &yacute; trong ph&acirc;n kh&uacute;c card đồ họa tầm trung.Với kiến tr&uacute;c NVIDI Ampere mới nhất sử dụng chip đồ họa NVIDIA GeForce RTX 3050, c&oacute; khả năng xử l&yacute; đồ họa 3D mượt m&agrave;, hỗ trợ c&ocirc;ng nghệ ray tracing v&agrave; DLSS., RTX 3050 DUAL OC 6GB kết hợp hiệu suất nhiệt tối ưu với khả năng tương th&iacute;ch cao. Đ&acirc;y l&agrave; sự lựa chọn ho&agrave;n hảo cho những game thủ muốn c&oacute; hiệu suất đồ họa mạnh trong một cấu h&igrave;nh nhỏ gọn.</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/zt-a30500h-10m-image01_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n</div>', 1, 2, 2, 2, 1, 36, 1, 'images/j5JJvaNXnBRTIfgbrRmbWho0NxKqoKzIwe2adQHH.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(3, 'Sản phẩm 1', 'WD4125', '<p>Khong co</p>', 6, 7, 1, 1, 1, 12, 1, 'images/sl3jed9LnrwdVBDvoMU9LAvrMy9iWP6VarIomiNf.png', '2025-06-23 07:03:32', '2025-06-26 11:04:04', NULL),
(4, 'Sản phẩm 2', 'WD2989', '<p>Khong co</p>', 6, 7, 6, 1, 1, 12, 1, 'images/1HqEorwAq1O3GpoD6BMG4GgkKV8bTdjbCkDPnygV.jpg', '2025-06-23 07:05:48', '2025-06-23 07:05:48', NULL),
(5, 'Sản phẩm 5', 'WD2441', '<p>Khong coooo</p>', 9, 8, 6, 1, 4, 12, 1, 'images/UZN6zMQlRRqahpNmPIR7bHpZBsAUgIWLzRJ5TDe4.jpg', '2025-06-23 07:06:49', '2025-06-23 07:06:49', NULL);

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
('8GSPoRopXrTis1AP4V5MJ7m87bfOoo9ZxsLtHfYS', 13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiczNrOWJtYTBua0xYb21Ha3g3UTJFb1ZrTjRpYno3dmFXUUVjRmVOSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9kYXRuLnRlc3Q6ODA4MC9kYW5obXVjLzQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMyOiJodHRwOi8vZGF0bi50ZXN0OjgwODAvY2FydC9jb3VudCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEzO30=', 1751133454);

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
(12, 'Nguyễn Danh Dũng', 'nguyendanhdung479@gmail.com', NULL, '$2y$12$YOP.JeySQGm2Iq5JyCrKjO./3nsy5tVUo83J9sbPR4hLYPBee9DdG', 'Nguyễn Danh Dũng', '0376536999', 'quan_tri', 'hoat_dong', NULL, '2025-06-23 07:01:12', '2025-06-26 11:10:14', NULL),
(13, 'nguyen van b', 'bnv123@gmail.com', NULL, '$2y$12$j.qyRnI7SM7ESnLWDKZmceYIGmwWdKMPfDh1de9KaxImKAe8rSpdm', 'Nguyen Van A', '0353535355', 'quan_tri', 'hoat_dong', NULL, '2025-06-25 07:05:22', '2025-06-26 11:05:51', NULL);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `danh_gia_san_phams`
--
ALTER TABLE `danh_gia_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dia_chi_nguoi_dungs`
--
ALTER TABLE `dia_chi_nguoi_dungs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thuong_hieus`
--
ALTER TABLE `thuong_hieus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
