-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2025 at 09:30 AM
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
-- Cơ sở dữ liệu: `datn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `anh_san_phams`
--

CREATE TABLE `anh_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `duong_dan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `anh_san_phams`
--

INSERT INTO `anh_san_phams` (`id`, `id_product`, `duong_dan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 2, 'images/anh_phu/Ox5JB91zigBbVzXmbmyp01sePrBMMNuz93rX9AQL.jpg', '2025-06-14 20:59:27', '2025-06-15 03:31:01', '2025-06-15 03:31:01'),
(7, 2, 'images/anh_phu/lNfHwBk3zWMREh54NbEHomxYieeoDC0ZT7wIeWUB.jpg', '2025-06-14 20:59:27', '2025-06-15 03:31:01', '2025-06-15 03:31:01'),
(8, 2, 'uploads/sanpham/anh_phu/W2kbIoKAYkgepundA4lz5dZbBI9JGOG7LlSKxnzM.jpg', '2025-06-15 03:31:01', '2025-06-15 04:26:18', '2025-06-15 04:26:18'),
(9, 2, 'images/HDge1KDJnhy1xNKLCUL3cWB5CSIQ59FDXIeh7SOt.jpg', '2025-06-15 04:26:18', '2025-06-15 04:26:18', NULL),
(10, 3, 'images/anh_phu/CB7GNx5aXr8kgsEAMPHQYeahHape5fx410e4rS9f.jpg', '2025-06-15 09:09:30', '2025-06-15 09:09:30', NULL),
(11, 3, 'images/anh_phu/DJzWIku494iS3mxiuKBBTrOVXLnSpHkuiyhM1hmR.jpg', '2025-06-15 09:09:30', '2025-06-15 09:09:30', NULL),
(12, 3, 'images/anh_phu/ZBlE9j4l7jQrUwk8pSBcFLQ3MS3CWw7UZlCc9ZYf.jpg', '2025-06-15 09:09:30', '2025-06-15 09:09:30', NULL),
(13, 2, 'images/9lAdZiPdSnpVzi0c82eHUGrZypWWLzGGeDL52qYH.jpg', '2025-06-15 09:11:43', '2025-06-15 09:11:43', NULL),
(14, 4, 'images/anh_phu/qtqY89HqHAyGT8YcaX9CeJVkbCtvhVdJsNgPsNoC.jpg', '2025-06-15 09:21:27', '2025-06-15 09:21:27', NULL),
(15, 4, 'images/anh_phu/NrkjfmFiZBLz0c9KonFPDWI0TmvStzDM7k2SPsOl.jpg', '2025-06-15 09:21:27', '2025-06-15 09:21:27', NULL),
(16, 4, 'images/anh_phu/eQHeN1cpt1PBHy2AciRFzy7UQ4eQPwUqL40f6Z3X.jpg', '2025-06-15 09:21:27', '2025-06-15 09:21:27', NULL),
(17, 5, 'images/anh_phu/TbCzUs30tgAIPCNyXtLnXvviYjfuyZWMEewFU2aS.jpg', '2025-06-15 09:51:08', '2025-06-15 09:51:08', NULL),
(18, 5, 'images/anh_phu/9dv7qx64ohGs7XqarVF1AkBVyIS0XWuREypSkCKy.jpg', '2025-06-15 09:51:08', '2025-06-15 09:51:08', NULL),
(19, 5, 'images/anh_phu/G6jCLmWRANmaURym9P8mAY2K13USo1gJdwSPCYfe.jpg', '2025-06-15 09:51:08', '2025-06-15 09:51:08', NULL),
(20, 6, 'images/anh_phu/XFWOdp6TkDhkBzu0Dg3XXbLWOyZScX6n6LOFrwaJ.jpg', '2025-06-15 09:54:05', '2025-06-15 09:54:05', NULL),
(21, 6, 'images/anh_phu/yD5QzWG0sqEmZKchLHVB5aAz3OGlNCSN3FidD7z7.jpg', '2025-06-15 09:54:05', '2025-06-15 09:54:05', NULL),
(22, 6, 'images/anh_phu/xV8Idv090yGoMxvIOGomyfkD6dLVIU3W85YGF2CN.jpg', '2025-06-15 09:54:05', '2025-06-15 09:54:05', NULL),
(23, 7, 'images/anh_phu/XLmhz9hMyhPRl3iUBHXFnE0Bil2YcVWbX88HIe82.jpg', '2025-06-15 09:55:17', '2025-06-15 09:55:17', NULL),
(24, 7, 'images/anh_phu/l5RW9jXvizxeSXVJVyPzHrchJLuAZCDwyQtFA92S.jpg', '2025-06-15 09:55:17', '2025-06-15 09:55:17', NULL),
(25, 7, 'images/anh_phu/cCIktZmlDhwi3TjNP7a00tQqmd5Yv3HNOZh4eYWB.jpg', '2025-06-15 09:55:17', '2025-06-15 09:55:17', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bien_the_san_phams`
--

CREATE TABLE `bien_the_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `id_ram` bigint UNSIGNED NOT NULL,
  `id_o_cung` bigint UNSIGNED NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `gia_so_sanh` decimal(10,2) NOT NULL,
  `ton_kho` int NOT NULL,
  `ma_bien_the` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anh_dai_dien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bien_the_san_phams`
--

INSERT INTO `bien_the_san_phams` (`id`, `id_product`, `id_ram`, `id_o_cung`, `gia`, `gia_so_sanh`, `ton_kho`, `ma_bien_the`, `anh_dai_dien`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 2, 1, 1, 890000.00, 7890000.00, 6, 'BT0746', NULL, '2025-06-14 20:59:27', '2025-06-15 09:11:43', NULL),
(6, 2, 1, 3, 1890000.00, 2390000.00, 9, 'BT9477', NULL, '2025-06-14 20:59:27', '2025-06-15 09:11:43', NULL),
(7, 2, 2, 1, 7890000.00, 6790000.00, 5, 'BT1950', NULL, '2025-06-14 20:59:27', '2025-06-14 20:59:27', NULL),
(8, 2, 2, 3, 8890000.00, 7890000.00, 5, 'BT6433', NULL, '2025-06-14 20:59:27', '2025-06-14 20:59:27', NULL),
(9, 3, 1, 2, 13990000.00, 14990000.00, 4, 'BT1762', NULL, '2025-06-15 09:09:30', '2025-06-15 09:09:30', NULL),
(10, 3, 1, 6, 9990000.00, 11990000.00, 5, 'BT5104', NULL, '2025-06-15 09:09:30', '2025-06-15 09:09:30', NULL),
(11, 3, 2, 2, 14990000.00, 15980000.00, 3, 'BT8519', NULL, '2025-06-15 09:09:30', '2025-06-15 09:09:30', NULL),
(12, 3, 2, 6, 8990000.00, 10990000.00, 9, 'BT8374', NULL, '2025-06-15 09:09:30', '2025-06-15 09:09:30', NULL),
(13, 4, 2, 4, 35980000.00, 38990000.00, 8, 'BT0784', NULL, '2025-06-15 09:21:27', '2025-06-15 09:21:27', NULL),
(14, 4, 2, 6, 32980000.00, 35990000.00, 9, 'BT6158', NULL, '2025-06-15 09:21:27', '2025-06-15 09:21:27', NULL),
(15, 4, 7, 4, 37980000.00, 39990000.00, 7, 'BT6673', NULL, '2025-06-15 09:21:27', '2025-06-15 09:21:27', NULL),
(16, 4, 7, 6, 34980000.00, 36990000.00, 10, 'BT3530', NULL, '2025-06-15 09:21:27', '2025-06-15 09:21:27', NULL),
(17, 5, 9, 3, 19680000.00, 25990000.00, 6, 'BT9254', NULL, '2025-06-15 09:51:08', '2025-06-15 09:51:08', NULL),
(18, 5, 9, 4, 17680000.00, 23990000.00, 8, 'BT8699', NULL, '2025-06-15 09:51:08', '2025-06-15 09:51:08', NULL),
(19, 5, 10, 3, 16680000.00, 20990000.00, 9, 'BT2899', NULL, '2025-06-15 09:51:08', '2025-06-15 09:51:08', NULL),
(20, 5, 10, 4, 15680000.00, 19990000.00, 7, 'BT5033', NULL, '2025-06-15 09:51:08', '2025-06-15 09:51:08', NULL),
(21, 7, 8, 4, 16868000.00, 17599000.00, 5, 'BT8497', NULL, '2025-06-15 09:55:17', '2025-06-15 09:55:17', NULL),
(22, 7, 8, 6, 14868000.00, 15599000.00, 8, 'BT9015', NULL, '2025-06-15 09:55:17', '2025-06-15 09:55:17', NULL),
(23, 7, 9, 4, 12868000.00, 13599000.00, 9, 'BT0150', NULL, '2025-06-15 09:55:17', '2025-06-15 09:55:17', NULL),
(24, 7, 9, 6, 11868000.00, 12599000.00, 7, 'BT9492', NULL, '2025-06-15 09:55:17', '2025-06-15 09:55:17', NULL),
(25, 6, 1, 1, 16280000.00, 21990000.00, 6, 'BT390108', NULL, '2025-06-15 10:06:07', '2025-06-15 10:06:07', NULL),
(26, 6, 1, 2, 17280000.00, 22990000.00, 8, 'BT181529', NULL, '2025-06-15 10:06:07', '2025-06-15 10:06:07', NULL),
(27, 6, 2, 1, 18280000.00, 23990000.00, 9, 'BT615830', NULL, '2025-06-15 10:06:07', '2025-06-15 10:06:07', NULL),
(28, 6, 2, 2, 19280000.00, 26990000.00, 7, 'BT396759', NULL, '2025-06-15 10:06:07', '2025-06-15 10:06:07', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chips`
--

CREATE TABLE `chips` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chips`
--

INSERT INTO `chips` (`id`, `ten`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CPU Intel Core I5 14600KF', 'Quas sapiente soluta omnis et est.', '2025-06-13 19:33:02', '2025-06-15 08:31:58', NULL),
(2, 'CPU Intel Core Ultra 7 265KF', 'Minima assumenda nobis vero sed accusantium laboriosam doloribus.', '2025-06-13 19:33:02', '2025-06-15 08:31:37', NULL),
(3, 'CPU Intel Core i5 14700', 'Qui quam blanditiis molestias libero dolores rerum.', '2025-06-13 19:33:02', '2025-06-15 08:31:14', NULL),
(4, 'CPU AMD Ryzen 7 9700X', 'Sit unde ea aut molestias et.', '2025-06-13 19:33:02', '2025-06-15 08:30:28', NULL),
(5, 'CPU AMD Ryzen Ryzen 5 7500F', 'Error consequuntur reprehenderit incidunt omnis.', '2025-06-13 19:33:02', '2025-06-15 08:30:05', NULL),
(6, 'CPU Intel Core i5 14500', 'Omnis consectetur illum debitis eos tempore debitis.', '2025-06-13 19:33:02', '2025-06-15 08:29:41', NULL),
(7, 'CPU AMD Ryzen 7 7700', 'Ullam porro quo voluptatem quia vero dolor error minima.', '2025-06-13 19:33:02', '2025-06-15 08:29:18', NULL),
(8, 'CPU INTEL CORE I5 12600KF', 'Nostrum rerum qui ut autem.', '2025-06-13 19:33:02', '2025-06-15 08:29:12', NULL),
(9, 'CPU Intel Core i3 12100F', 'Quidem animi deleniti sed eligendi consectetur est.', '2025-06-13 19:33:02', '2025-06-15 08:28:36', NULL),
(10, 'CPU Intel Core i5-10400F', 'Perferendis ullam harum perspiciatis sit qui atque.', '2025-06-13 19:33:02', '2025-06-15 08:27:51', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_don_hang` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `id_bien_the` bigint UNSIGNED DEFAULT NULL,
  `ten_hien_thi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int NOT NULL,
  `don_gia` decimal(10,2) NOT NULL,
  `bao_hanh_thang` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_gio_hangs`
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gia_san_phams`
--

CREATE TABLE `danh_gia_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `so_sao` int NOT NULL,
  `binh_luan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PC - Máy tính chơi game', '2025-06-13 19:33:02', '2025-06-15 08:22:04', NULL),
(2, 'PC WORKSTATION 2D 3D', '2025-06-13 19:33:02', '2025-06-15 08:22:24', NULL),
(3, 'PC VĂN PHÒNG', '2025-06-13 19:33:02', '2025-06-15 08:22:43', NULL),
(4, 'PC AMD GAMING', '2025-06-13 19:33:02', '2025-06-15 08:23:04', NULL),
(5, 'PC Core Ultra', '2025-06-13 19:33:02', '2025-06-15 08:23:18', NULL),
(6, 'PC GAMING CAO CẤP', '2025-06-15 08:23:36', '2025-06-15 08:23:36', NULL),
(7, 'PC GIẢ LẬP ẢO HÓA', '2025-06-15 08:23:50', '2025-06-15 08:23:50', NULL),
(8, 'PC MINI', '2025-06-15 08:24:58', '2025-06-15 08:24:58', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dia_chi_nguoi_dungs`
--

CREATE TABLE `dia_chi_nguoi_dungs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `dia_chi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thanh_pho` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quan_huyen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phuong_xa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `la_mac_dinh` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `ma_don` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_dia_chi_nguoi_dungs` bigint UNSIGNED NOT NULL,
  `id_phuong_thuc_thanh_toan` bigint UNSIGNED NOT NULL,
  `tong_tien` decimal(10,2) NOT NULL,
  `trang_thai` enum('cho_xu_ly','dang_giao','hoan_thanh','huy') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `loai` enum('chinh','luu_sau','so_sanh') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'chinh',
  `id_giam_gia` bigint UNSIGNED DEFAULT NULL,
  `ghi_chu` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gpus`
--

CREATE TABLE `gpus` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gpus`
--

INSERT INTO `gpus` (`id`, `ten`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GPU GTX 5727', 'Temporibus ea facere velit aliquid impedit.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(2, 'GPU GTX 2413', 'Quasi est pariatur consequatur explicabo sunt voluptatem aliquam.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(3, 'GPU GTX 596', 'Fuga eligendi officia magnam.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(4, 'GPU GTX 314', 'Omnis consequuntur debitis debitis nostrum sequi aut.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(5, 'GPU GTX 1356', 'In numquam sed optio.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(6, 'GPU GTX 4756', 'Sit pariatur deleniti molestias quis.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(7, 'GPU GTX 499', 'Assumenda aspernatur aperiam nesciunt quod itaque.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(8, 'GPU GTX 142', 'Veritatis inventore aliquam non quibusdam ex minus laboriosam.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(9, 'GPU GTX 639', 'Harum optio quaerat saepe explicabo et explicabo.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(10, 'GPU GTX 9154', 'Ut odit veniam rerum ea aliquam.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
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
-- Cấu trúc bảng cho bảng `job_batches`
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
-- Cấu trúc bảng cho bảng `lich_su_xems`
--

CREATE TABLE `lich_su_xems` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED DEFAULT NULL,
  `ma_phien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `thoi_gian_xem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mainboards`
--

CREATE TABLE `mainboards` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mainboards`
--

INSERT INTO `mainboards` (`id`, `ten`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mainboard ASUS PRIME X870-P WIFI-CSM', 'Quod reprehenderit quaerat repudiandae perspiciatis explicabo alias.', '2025-06-13 19:33:02', '2025-06-15 08:35:01', NULL),
(2, 'Mainboard MSI MEG X870E GODLIKE', 'Earum qui sunt itaque voluptas eum.', '2025-06-13 19:33:02', '2025-06-15 08:34:40', NULL),
(3, 'Mainboard ASUS TUF GAMING B650M-PLUS WIFI DDR5', 'Amet nemo sint recusandae non aperiam dolores vel.', '2025-06-13 19:33:02', '2025-06-15 08:34:21', NULL),
(4, 'Mainboard ASUS TUF GAMING B650M-E DDR5', 'Dicta aliquid et aut voluptas mollitia id magnam beatae officia porro.', '2025-06-13 19:33:02', '2025-06-15 08:34:03', NULL),
(5, 'Mainboard Asrock X870 Pro RS DDR5', 'Velit est minus deserunt dolore voluptatem ut quae vel provident unde.', '2025-06-13 19:33:02', '2025-06-15 08:33:51', NULL),
(6, 'Mainboard Asrock H610M-H2/M.2', 'Similique optio id qui quibusdam eaque sed et nihil asperiores.', '2025-06-13 19:33:02', '2025-06-15 08:33:36', NULL),
(7, 'Mainboard Asus B760M-AYW WIFI DDR4', 'Voluptas qui adipisci ad eos odit est cum quia.', '2025-06-13 19:33:02', '2025-06-15 08:33:22', NULL),
(8, 'Mainboard Asus B760M-AYW WIFI DDR5', 'Qui eaque ab facilis est esse omnis eum sed cupiditate.', '2025-06-13 19:33:02', '2025-06-15 08:33:02', NULL),
(9, 'Mainboard ASUS A620M-K DDR5', 'Voluptatem non quam ea omnis provident.', '2025-06-13 19:33:02', '2025-06-15 08:32:49', NULL),
(10, 'Mainboard Asus Prime A620M-E DDR5', 'Nostrum quis non voluptatem eum consequatur.', '2025-06-13 19:33:02', '2025-06-15 08:32:30', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ma_giam_gias`
--

CREATE TABLE `ma_giam_gias` (
  `id` bigint UNSIGNED NOT NULL,
  `ma` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loai` enum('phan_tram','tien_mat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia_tri` decimal(10,2) NOT NULL,
  `ngay_bat_dau` timestamp NULL DEFAULT NULL,
  `ngay_ket_thuc` timestamp NULL DEFAULT NULL,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ma_giam_gias`
--

INSERT INTO `ma_giam_gias` (`id`, `ma`, `loai`, `gia_tri`, `ngay_bat_dau`, `ngay_ket_thuc`, `hoat_dong`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'eveniet', 'phan_tram', 6.43, '2025-06-13 19:33:02', '2025-07-13 19:33:02', 1, '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(2, 'dolores', 'phan_tram', 46.01, '2025-06-13 19:33:02', '2025-07-13 19:33:02', 1, '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(3, 'iusto', 'phan_tram', 43.17, '2025-06-13 19:33:02', '2025-07-13 19:33:02', 1, '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(4, 'similique', 'phan_tram', 10.31, '2025-06-13 19:33:02', '2025-07-13 19:33:02', 1, '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(5, 'iure', 'phan_tram', 40.98, '2025-06-13 19:33:02', '2025-07-13 19:33:02', 1, '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
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
(24, '2025_06_14_093456_add_deleted_at_to_anh_san_phams_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhat_ky_ton_khos`
--

CREATE TABLE `nhat_ky_ton_khos` (
  `id` bigint UNSIGNED NOT NULL,
  `id_bien_the` bigint UNSIGNED DEFAULT NULL,
  `so_luong` int NOT NULL,
  `loai` enum('nhap','xuat','dieu_chinh') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ly_do` text COLLATE utf8mb4_unicode_ci,
  `ngay_tao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `o_cungs`
--

CREATE TABLE `o_cungs` (
  `id` bigint UNSIGNED NOT NULL,
  `loai` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dung_luong` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `o_cungs`
--

INSERT INTO `o_cungs` (`id`, `loai`, `dung_luong`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'NVMe', '512GB', 'Sit error minus quis sint.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(2, 'HDD', '512GB', 'Cupiditate suscipit possimus corrupti fuga.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(3, 'NVMe', '1TB', 'Sequi magnam necessitatibus consequatur quidem ut.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(4, 'HDD', '512GB', 'Odio et reprehenderit sint dolore cupiditate ipsam quibusdam.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(5, 'SSD', '1TB', 'Culpa voluptas voluptates rerum ut dolores ut.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(6, 'HDD', '256GB', 'Laudantium aperiam deleniti illum iusto.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(7, 'NVMe', '2TB', 'Eum ea est facilis tempora rerum delectus rerum.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(8, 'SSD', '512GB', 'Omnis modi voluptate laudantium quae autem cupiditate harum.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(9, 'NVMe', '2TB', 'Omnis et quam cumque asperiores aut non.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(10, 'HDD', '512GB', 'Et dignissimos unde autem reiciendis eos et delectus eaque.', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuong_thuc_thanh_toans`
--

CREATE TABLE `phuong_thuc_thanh_toans` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phuong_thuc_thanh_toans`
--

INSERT INTO `phuong_thuc_thanh_toans` (`id`, `ten`, `mo_ta`, `hoat_dong`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Thanh toán khi nhận hàng', 'Phương thức: Thanh toán khi nhận hàng', 1, '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(2, 'Chuyển khoản ngân hàng', 'Phương thức: Chuyển khoản ngân hàng', 1, '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(3, 'Ví điện tử Momo', 'Phương thức: Ví điện tử Momo', 1, '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(4, 'Thẻ tín dụng', 'Phương thức: Thẻ tín dụng', 1, '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rams`
--

CREATE TABLE `rams` (
  `id` bigint UNSIGNED NOT NULL,
  `dung_luong` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rams`
--

INSERT INTO `rams` (`id`, `dung_luong`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'RAM 6GB', 'Itaque minus illum est aut.', '2025-06-13 19:33:02', '2025-06-15 09:17:39', NULL),
(2, 'RAM 8GB', 'Qui molestiae ex quia tenetur voluptatem.', '2025-06-13 19:33:02', '2025-06-15 09:17:30', NULL),
(7, 'RAM 128GB', 'Quo quisquam ut voluptatem ex.', '2025-06-13 19:33:02', '2025-06-15 09:16:21', NULL),
(8, 'RAM 64GB', 'Est beatae dignissimos autem in.', '2025-06-13 19:33:02', '2025-06-15 09:16:11', NULL),
(9, 'RAM 32GB', 'Ut pariatur ex tenetur occaecati.', '2025-06-13 19:33:02', '2025-06-15 09:16:02', NULL),
(10, 'RAM 16GB', 'Asperiores autem fugiat ut nesciunt expedita rem.', '2025-06-13 19:33:02', '2025-06-15 09:15:49', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_phams`
--

CREATE TABLE `san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_san_pham` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `id_chip` bigint UNSIGNED NOT NULL,
  `id_mainboard` bigint UNSIGNED NOT NULL,
  `id_gpu` bigint UNSIGNED NOT NULL,
  `id_category` bigint UNSIGNED NOT NULL,
  `id_brand` bigint UNSIGNED NOT NULL,
  `bao_hanh_thang` int NOT NULL,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `anh_dai_dien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten`, `ma_san_pham`, `mo_ta`, `id_chip`, `id_mainboard`, `id_gpu`, `id_category`, `id_brand`, `bao_hanh_thang`, `hoat_dong`, `anh_dai_dien`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'PC FASTER GAMING 10400F - RTX 3050 6GB ( ALL NEW- Bảo hành 36 Tháng)- 34 slots- 10 HN- 14 HCM', 'WD6014', 'MÔ TẢ SẢN PHẨM\r\nPC FASTER GAMING 10400F - RTX 3050 6GB là bộ PC Gaming - PC Đồ Họa Hiệu năng cao, được xây dựng để đáp ứng nhu cầu chơi game, học tập, làm việc với mức giá vô cùng hợp lý . Có thể cân tốt các tựa game Moba, FPS : LOL, FIFA, DOTA, CSGO, GTA 5 , PUBG.... cũng như các tác vụ văn phòng , chỉnh sửa ảnh , edit video cơ bản.\r\n1. CPU Intel Core i5-10400F (2.9GHz turbo up to 4.3Ghz, 6 nhân 12 luồng, 12MB Cache, 65W) - Socket Intel LGA 1200\r\nCPU Intel Core i5-10400F chính là sự lựa chọn hoàn mỹ cho những ai muốn trải nghiệm hiệu suất đa nhiệm tốt nhưng có giá thành rẻ. CPU Intel Core i5-10400F đã cắt giảm đi iGPU tích hợp sẵn nhưng vẫn đem lại trải nghiệm làm việc tốt tương tự như bộ xử lý Intel Core i5 10400 thông thường. mẫu CPU này sở hữu 6 nhân 12 luồng cho đáp ứng tốt nhu cầu làm việc và giải trí cùng lúc. Có thể nói, với mức giá phù hợp, đây chắc chắn là lựa chọn số 1 cho người dùng phổ thông.\r\n\r\n \r\n\r\n\r\n\r\n \r\n\r\n \r\n3. RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4 \r\nRAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4  là dòng sản phẩm RAM chất lượng , ổn định ,  có hiệu suất cực cao , tốc độ truyền tải nhanh chóng, khả năng tương thích tốt cho phép tất cả các game thủ vượt giới hạn tốc độ và tận hưởng thế giới game ấn tượng nhất . Được thiết kế cho các game thủ và những người  đam mê. những người muốn nâng cấp tiết kiệm chi phí để chơi game nhanh hơn.Đây là sự lựa chọn tuyệt vời cho bộ PC Gaming giá rẻ mà các game thủ không nên bỏ qua.\r\n\r\n \r\n\r\n\r\n\r\n \r\n\r\n4.  Ổ cứng SSD TeamGroup CX2 256GB 2.5 inch SATA III\r\nSSD TeamGroup CX2 được trang bị công nghệ FLASH hiện đại, tiết kiệm năng lượng tiêu thụ cũng như tốc độ truyền cao. Hiệu suất mang lại khác hẳn so với những chiếc ổ cứng truyền thống trước đây. SSD TeamGroup CX2 sử dụng công nghệ SLC Caching tân tiến được nhà sản xuất đưa vào nhằm tối ưu hiệu suất làm việc trên máy tính cho người dùng. Sở hữu tốc độ đọc/ghi nhanh gấp 4 lần so với các ổ cứng truyền thống. Được trang bị khả năng chống sốc và rơi 1500G/0.5mili giây mang đến ổ cứng TeamGroup bền bỉ hơn. Đồng thời SSD CX2 cũng được thiết kế với trải nghiệm không gây ra tiếng ồn cơ học khó chịu tối ưu trải nghiệm người dùng hơn. Để kéo dài tuổi thọ hơn cho ổ cứng SSD TeamGroup CX2 còn được trang bị thêm công nghệ Wear-Leveling và chức năng ECC. Tất cả nhằm mang đến trải nghiệm sử dụng tốt hơn cho người dùng với tốc độ tin cậy trong quá trình truyền dữ liệu. Cùng đó là mức độ bền bỉ khi tuổi thọ của SSD được đảm bảo tốt hơn. \r\n\r\n \r\n\r\n \r\n\r\n\r\n\r\n \r\n\r\n5.  CARD MÀN HÌNH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC \r\nCARD MÀN HÌNH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC   là một sản phẩm đáng chú ý trong phân khúc card đồ họa tầm trung.Với kiến trúc NVIDI Ampere mới nhất sử dụng chip đồ họa NVIDIA GeForce RTX 3050, có khả năng xử lý đồ họa 3D mượt mà, hỗ trợ công nghệ ray tracing và DLSS., RTX 3050 DUAL OC 6GB kết hợp hiệu suất nhiệt tối ưu với khả năng tương thích cao. Đây là sự lựa chọn hoàn hảo cho những game thủ muốn có hiệu suất đồ họa mạnh trong một cấu hình nhỏ gọn.', 4, 6, 4, 3, 3, 36, 1, 'images/T8W5T3GfHNKImoWmPExErQCa15Sm05Yl4UZjRkH8.jpg', '2025-06-14 20:59:27', '2025-06-15 04:26:18', NULL),
(3, 'PC BEST FOR GAMING i5 10400F- GTX 1660 Super 6GB(Tất cả linh kiện đều All New - bảo hành 36 tháng)', 'WD7831', 'MÔ TẢ SẢN PHẨM\r\n\r\nPC BEST FOR GAMING i5 10400F- GTX 1660 Super 6GB được xây dựng để đáp ứng nhu cầu chơi game, học tập, làm việc với mức giá vô cùng hợp lý . Có thể cân tốt các tựa game Moba, FPS : LOL, FIFA, DOTA, CSGO, GTA 5 , PUBG.... cũng như các tác vụ  văn phòng , chỉnh sửa ảnh , video cơ bản .\r\n\r\n1. CPU Intel Core i5-10400F (2.9GHz turbo up to 4.3Ghz, 6 nhân 12 luồng, 12MB Cache, 65W) - Socket Intel LGA 1200\r\nCPU Intel Core i5-10400F chính là sự lựa chọn hoàn mỹ cho những ai muốn trải nghiệm hiệu suất đa nhiệm tốt nhưng có giá thành rẻ. CPU Intel Core i5-10400F đã cắt giảm đi iGPU tích hợp sẵn nhưng vẫn đem lại trải nghiệm làm việc tốt tương tự như bộ xử lý Intel Core i5 10400 thông thường. mẫu CPU này sở hữu 6 nhân 12 luồng cho đáp ứng tốt nhu cầu làm việc và giải trí cùng lúc. Có thể nói, với mức giá phù hợp, đây chắc chắn là lựa chọn số 1 cho người dùng phổ thông.\r\n\r\n \r\n\r\n\r\n\r\n \r\n\r\n \r\n \r\n\r\n3.  RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4 \r\nRAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4  là dòng sản phẩm RAM chất lượng , ổn định ,  có hiệu suất cực cao , tốc độ truyền tải nhanh chóng, khả năng tương thích tốt cho phép tất cả các game thủ vượt giới hạn tốc độ và tận hưởng thế giới game ấn tượng nhất . Được thiết kế cho các game thủ và những người  đam mê. những người muốn nâng cấp tiết kiệm chi phí để chơi game nhanh hơn.Đây là sự lựa chọn tuyệt vời cho bộ PC Gaming giá rẻ mà các game thủ không nên bỏ qua.\r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n \r\n\r\n4.  Ổ cứng SSD TeamGroup CX2 256GB 2.5 inch SATA III\r\nSSD TeamGroup CX2 được trang bị công nghệ FLASH hiện đại, tiết kiệm năng lượng tiêu thụ cũng như tốc độ truyền cao. Hiệu suất mang lại khác hẳn so với những chiếc ổ cứng truyền thống trước đây. SSD TeamGroup CX2 sử dụng công nghệ SLC Caching tân tiến được nhà sản xuất đưa vào nhằm tối ưu hiệu suất làm việc trên máy tính cho người dùng. Sở hữu tốc độ đọc/ghi nhanh gấp 4 lần so với các ổ cứng truyền thống. Được trang bị khả năng chống sốc và rơi 1500G/0.5mili giây mang đến ổ cứng TeamGroup bền bỉ hơn. Đồng thời SSD CX2 cũng được thiết kế với trải nghiệm không gây ra tiếng ồn cơ học khó chịu tối ưu trải nghiệm người dùng hơn. Để kéo dài tuổi thọ hơn cho ổ cứng SSD TeamGroup CX2 còn được trang bị thêm công nghệ Wear-Leveling và chức năng ECC. Tất cả nhằm mang đến trải nghiệm sử dụng tốt hơn cho người dùng với tốc độ tin cậy trong quá trình truyền dữ liệu. Cùng đó là mức độ bền bỉ khi tuổi thọ của SSD được đảm bảo tốt hơn. \r\n\r\n \r\n\r\n \r\n\r\n\r\n\r\n \r\n\r\n5. Card Màn Hình OCPC GTX 1660 Super 6GB GDDR6\r\nCard màn hình OCPC GTX 1660 Super 6GB GDDR6 là một trong những lựa chọn đáng cân nhắc cho các game thủ và người dùng sáng tạo nội dung muốn nâng cấp hiệu suất đồ họa của họ. Với mức giá hợp lý và hiệu năng tốt, nó mang lại trải nghiệm tuyệt vời cho người dùng trong phân khúc tầm trung.Với việc sử dụng kiến ​​trúc Turing của NVIDIA , bộ nhớ GDDR6 6GB, card này có khả năng xử lý đồ họa mạnh mẽ và hiệu quả. Nó cung cấp tốc độ truyền dữ liệu cao hơn và khả năng xử lý đồ họa nhanh chóng hơn so với thế hệ trước ngoài ra còn được hỗ trợ công nghệ tối ưu hóa cho trò chơi, giúp tăng hiệu suất và đem lại hình ảnh sắc nét, mượt mà. Với hiệu suất này, người dùng có thể làm việc với các phần mềm đồ họa mượt mà hay  trải nghiệm các tựa game yêu thích ở độ phân giải Full HD mà không gặp vấn đề gì.', 10, 1, 5, 1, 1, 36, 1, 'images/nR1XcMyVRVpoe9pwIS9QpinNXmjRD8cLsrdWBRH4.jpg', '2025-06-15 09:09:30', '2025-06-15 09:09:30', NULL),
(4, 'PC TTG GAMING PRO i7 14700KF - RTX 5060 Ti 8GB (ALL NEW - Bảo hành 36 tháng)', 'WD2183', '- Tất cả linh kiện đều ALL NEW - Bảo hành 36 tháng\r\n\r\n- Bộ PC này đã áp dụng CTKM SHOCK nên sẽ không được Áp dụng CTKM Chung', 3, 1, 1, 1, 2, 36, 1, 'images/63zGrbZ97Qfyrkk0zoxTzUE7bU3LRePfQohrOcjt.jpg', '2025-06-15 09:21:27', '2025-06-15 09:21:27', NULL),
(5, 'PC MAXIMUM GAMING i5 12400F - RTX 3070 8GB ( All NEW - Bảo hành 36 tháng)', 'WD3610', 'PC MAXIMUM GAMING RTX 3070 -12400F  là cấu hình PC Gaming đã được TTG Shop  tối ưu phần cứng nhằm đáp ứng tốt các nhu cầu Streaming , chơi game giải trí chiến mượt mà hầu hết các tựa Game AAA Hot Hit hiện nay.\r\n\r\n1.CPU Intel Core i5-12400F (Upto 4.4Ghz, 6 nhân 12 luồng, 18MB Cache, 65W) - Socket Intel LGA 1700) - TRAY\r\nCPU Intel Core i5-12400F nhân tố khuất đảo thị trường PC Gaming khi sở hữu mức giá rẻ cùng hiệu năng xuất sắc. Với 6 nhân 12 luồng, xung nhịp 2.5GHz và turbo boost lên 4.4 GHz, quả là sự lựa chọn tuyệt vời từ khả năng chơi game cho tới stream game của thế hệ vi xử lý Intel Gen 12, chính là sự nâng cấp vượt bậc so với người tiền nhiệm i5-11400F.\r\n\r\n \r\n\r\ni5 12400f\r\n\r\n \r\n2. Mainboard ASUS PRIME B760M-K D4\r\nMainboard Asus PRIME B760M-K D4 được thiết kế chuyên nghiệp để giải phóng toàn bộ tiềm năng của Bộ xử lý Intel Core i5-12400F. Tự hào với thiết kế nguồn mạnh mẽ, giải pháp làm mát toàn diện và các tùy chọn điều chỉnh thông minh, PRIME B760M-K D4 cung cấp cho người dùng và các nhà chế tạo PC DIY một loạt các tối ưu hóa hiệu suất thông qua các tính năng chương trình cơ sở và phần mềm trực quan.\r\n\r\nMainboard Asus PRIME B760M-K DDR4\r\n\r\n \r\n3.RAM PNY XLR8 Gaming 16GB Bus 3200MHz DDR4\r\n\r\nRAM PNY XLR8 Gaming 16GB Bus 3200MHz DDR4 là dòng sản phẩm RAM chất lượng , ổn định ,  có hiệu suất cực cao , tốc độ truyền tải nhanh chóng, khả năng tương thích tốt cho phép tất cả các game thủ vượt giới hạn tốc độ và tận hưởng thế giới game ấn tượng nhất . Được thiết kế cho các game thủ và những người  đam mê. những người muốn nâng cấp tiết kiệm chi phí để chơi game nhanh hơn.Đây là sự lựa chọn tuyệt vời cho bộ PC Gaming giá rẻ mà các game thủ không nên bỏ qua.\r\n\r\n\r\n\r\n4. Ổ CỨNG SSD PNY CS1031 500GB M.2 2280 PCIE NVME GEN 3X4 (ĐỌC 2200MB/S - GHI 1200MB/S)\r\nỔ CỨNG SSD PNY CS1031 500GB M.2 2280 PCIE NVME GEN 3X4 (ĐỌC 2200MB/S - GHI 1200MB/S) là một lựa chọn tuyệt vời cho người dùng muốn nâng cấp hiệu suất lưu trữ. Với tốc độ đọc lên đến 2200 MB/s và tốc độ ghi tối đa 1200 MB/s, sản phẩm mang đến khả năng xử lý dữ liệu nhanh chóng, giúp tối ưu trải nghiệm sử dụng máy tính.  SSD này rất phù hợp cho các tác vụ đòi hỏi hiệu năng cao như gaming, xử lý đồ họa, và lập trình.\r\n\r\n\r\n\r\n \r\n\r\n5.VGA NEO FORZA RTX 3070 DUAL OC 8GB \r\nVGA NEO FORZA RTX 3070 DUAL OC 8GB  là một trong những sản phẩm cao cấp của  phục vụ cho nhu cầu gaming ở độ phân giải 4K với mức giá hợp lý.. Đây là card đồ họa được xây dựng trên nền tảng Ampere kiến trúc RTX thế hệ thứ 2 của NVIDIA. Mang cho mình Nhân dò tia cùng Nhân Tensor nâng cao, kèm theo đó là bộ đa xử lý phát trực tiếp mới có bộ nhớ G6 tốc độ cao. Không thể không nhắc đến 5888 nhân CUDA, 8GB GDDR6, chiếc card đồ họa này dư sức giúp bạn trải nghiệm những tựa game khủng với mức đồ họa cao nhất.\r\n\r\n6.   Ổ cứng SSD CRUCIAL P3 500GB NVME M.2 PCIE\r\nỔ Cứng SSD Crucial P3 500GB M.2 2280 NVMe  được trang bị chuẩn kết nối PCIe Gen 3x4 hiện đại kèm theo công nghệ bộ nhớ 3D-NAND tiên tiến đã làm cho tất cả người sử dụng cảm thấy hài lòng về hiệu quả làm việc của sản phẩm. Đây sẽ là lựa chọn hoàn hảo cho bất cứ khách hàng nào có nhu cầu làm việc, giải trí tốc độ cao.\r\n\r\n\r\n\r\n7. NGUỒN MÁY TÍNH AIGO VK750 - 750W (80 PLUS/ ACTIVE PFC/ SINGLE RAIL)\r\nNGUỒN MÁY TÍNH AIGO VK750 - 750W (80 PLUS/ ACTIVE PFC/ SINGLE RAIL)   là một nguồn máy tính giá rẻ nhưng vẫn mang lại hiệu suất ổn định và các tính năng bảo vệ cơ bản. Nó được thiết kế để phục vụ cho các hệ thống máy tính phổ thông và có khả năng đáp ứng được nhu cầu cung cấp nguồn điện cho các thành phần trong máy tính một cách đáng tin cậy.Với công suất thực 750W, tích hợp Active PFC và tụ chính Nhật Bản, AIGO VK650  cam kết đạt hiệu suất 80%.\r\n\r\n\r\n\r\n7. Tản nhiệt khí CPU RGB Jonsbo CR-1000\r\nTản nhiệt khí CPU Jonsbo CR-1000 RGBchính là lựa chọn hoàn hảo với mức giá vô cùng hợp lý giúp cho lưu thông gió của case trở nên dễ dàng hơn nhờ đó CPU được đảm bảo về hiệu năng. Ngoài ra với đèn LED RGB, Jonsbo CR-1000 chính là lựa chọn thẩm mỹ cho người dùng khi muốn bộ case của mình luôn mát mẻ và nổi bật. \r\n\r\n \r\n\r\n\r\n\r\n \r\n\r\n >>> Xem thêm các cấu hình PC Gaming  tại đây \r\n\r\nLiên hệ ngay với TTG Shop để được tư vấn và sở hữu bộ PC MAXIMUM GAMING RTX 3070 -12400F này với mức giá vô cùng hấp dẫn nha !', 8, 5, 4, 1, 7, 36, 1, 'images/mqmSUEy3Oxenv6MsxExKEQ9xUaK1ezCUKawUc4Cv.jpg', '2025-06-15 09:51:08', '2025-06-15 09:51:08', NULL),
(6, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 'WD7832', '- Tất cả linh kiện đều ALL NEW - Bảo hành 36 tháng\r\n\r\n- Bộ PC này đã áp dụng CTKM SHOCK nên sẽ không được Áp dụng CTKM Chung', 4, 2, 7, 1, 2, 36, 1, 'images/L4tMPQAhvsHQQvniSY9jgLjXkwR1j47U29bRXUpw.jpg', '2025-06-15 09:54:05', '2025-06-15 09:54:05', NULL),
(7, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 'WD4419', '- Tất cả linh kiện đều ALL NEW - Bảo hành 36 tháng\r\n\r\n- Bộ PC này đã áp dụng CTKM SHOCK nên sẽ không được Áp dụng CTKM Chung', 4, 2, 7, 1, 2, 36, 1, 'images/ki1344odcsYlr40twBlOvKJ8jnU0fg60dBV2rrgP.jpg', '2025-06-15 09:55:17', '2025-06-15 09:55:17', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
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
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('XxwdWk9yIjHY2YzEIae34fTuAKH71g0SIO1ktHsR', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYTBJUXBNcUtUd0hwTTNHaGVFcUhLQjhDTDlqMHpDUUJwZlZEWXY4aCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO30=', 1750007228);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuong_hieus`
--

CREATE TABLE `thuong_hieus` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuong_hieus`
--

INSERT INTO `thuong_hieus` (`id`, `ten`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ASUS', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(2, 'MSI', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(3, 'GIGABYTE', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(4, 'Intel', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(5, 'AMD', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(6, 'Samsung', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL),
(7, 'Kingston', '2025-06-13 19:33:02', '2025-06-13 19:33:02', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `ten_dang_nhap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ho_ten` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vai_tro` enum('khach_hang','quan_tri') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'khach_hang',
  `trang_thai` enum('hoat_dong','vo_hieu','an') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hoat_dong',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `ten_dang_nhap`, `email`, `email_verified_at`, `password`, `ho_ten`, `so_dien_thoai`, `vai_tro`, `ngay_tao`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Long', 'longthph53584@gmail.com', NULL, '$2y$12$cqqtxjbbiEcYObIltOmn5.uvn5OwuzOKlsvCY1VAKuSYYgjA95YRC', 'H lONG', '0379354506', 'quan_tri', '2025-06-09 07:12:43', NULL, '2025-06-10 20:25:01', '2025-06-10 20:25:01', NULL),
(2, 'CSFSCF', 'longcfmlq1234@gmail.com', NULL, '$2y$12$tU9VjDxDtGTBMpMqCEoMOez/haJ3k39X5XqJ/hzYiGAcv5St8HWXe', 'H lONG', '08797867676', 'khach_hang', '2025-06-09 07:12:43', NULL, '2025-06-14 21:03:12', '2025-06-14 21:03:12', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anh_san_phams_id_product_foreign` (`id_product`);

--
-- Chỉ mục cho bảng `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bien_the_san_phams_ma_bien_the_unique` (`ma_bien_the`),
  ADD KEY `bien_the_san_phams_id_product_foreign` (`id_product`),
  ADD KEY `bien_the_san_phams_id_ram_foreign` (`id_ram`),
  ADD KEY `bien_the_san_phams_id_o_cung_foreign` (`id_o_cung`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `chips`
--
ALTER TABLE `chips`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_don_hangs_id_don_hang_foreign` (`id_don_hang`),
  ADD KEY `chi_tiet_don_hangs_id_product_foreign` (`id_product`),
  ADD KEY `chi_tiet_don_hangs_id_bien_the_foreign` (`id_bien_the`);

--
-- Chỉ mục cho bảng `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_gio_hangs_id_gio_hang_foreign` (`id_gio_hang`),
  ADD KEY `chi_tiet_gio_hangs_id_product_foreign` (`id_product`),
  ADD KEY `chi_tiet_gio_hangs_id_bien_the_foreign` (`id_bien_the`);

--
-- Chỉ mục cho bảng `danh_gia_san_phams`
--
ALTER TABLE `danh_gia_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danh_gia_san_phams_id_product_foreign` (`id_product`),
  ADD KEY `danh_gia_san_phams_id_user_foreign` (`id_user`);

--
-- Chỉ mục cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dia_chi_nguoi_dungs`
--
ALTER TABLE `dia_chi_nguoi_dungs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dia_chi_nguoi_dungs_id_user_foreign` (`id_user`);

--
-- Chỉ mục cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `don_hangs_ma_don_unique` (`ma_don`),
  ADD KEY `don_hangs_id_user_foreign` (`id_user`),
  ADD KEY `don_hangs_id_dia_chi_nguoi_dungs_foreign` (`id_dia_chi_nguoi_dungs`),
  ADD KEY `don_hangs_id_phuong_thuc_thanh_toan_foreign` (`id_phuong_thuc_thanh_toan`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gio_hangs_id_user_foreign` (`id_user`),
  ADD KEY `gio_hangs_id_giam_gia_foreign` (`id_giam_gia`);

--
-- Chỉ mục cho bảng `gpus`
--
ALTER TABLE `gpus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lich_su_xems`
--
ALTER TABLE `lich_su_xems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lich_su_xems_id_user_foreign` (`id_user`),
  ADD KEY `lich_su_xems_id_product_foreign` (`id_product`);

--
-- Chỉ mục cho bảng `mainboards`
--
ALTER TABLE `mainboards`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ma_giam_gias`
--
ALTER TABLE `ma_giam_gias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_giam_gias_ma_unique` (`ma`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhat_ky_ton_khos`
--
ALTER TABLE `nhat_ky_ton_khos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nhat_ky_ton_khos_id_bien_the_foreign` (`id_bien_the`);

--
-- Chỉ mục cho bảng `o_cungs`
--
ALTER TABLE `o_cungs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `rams`
--
ALTER TABLE `rams`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `san_phams`
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
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `thuong_hieus`
--
ALTER TABLE `thuong_hieus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_ten_dang_nhap_unique` (`ten_dang_nhap`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `chips`
--
ALTER TABLE `chips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danh_gia_san_phams`
--
ALTER TABLE `danh_gia_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `dia_chi_nguoi_dungs`
--
ALTER TABLE `dia_chi_nguoi_dungs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gpus`
--
ALTER TABLE `gpus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lich_su_xems`
--
ALTER TABLE `lich_su_xems`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `mainboards`
--
ALTER TABLE `mainboards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `ma_giam_gias`
--
ALTER TABLE `ma_giam_gias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `nhat_ky_ton_khos`
--
ALTER TABLE `nhat_ky_ton_khos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `o_cungs`
--
ALTER TABLE `o_cungs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `rams`
--
ALTER TABLE `rams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `thuong_hieus`
--
ALTER TABLE `thuong_hieus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  ADD CONSTRAINT `anh_san_phams_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  ADD CONSTRAINT `bien_the_san_phams_id_o_cung_foreign` FOREIGN KEY (`id_o_cung`) REFERENCES `o_cungs` (`id`),
  ADD CONSTRAINT `bien_the_san_phams_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `bien_the_san_phams_id_ram_foreign` FOREIGN KEY (`id_ram`) REFERENCES `rams` (`id`);

--
-- Các ràng buộc cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD CONSTRAINT `chi_tiet_don_hangs_id_bien_the_foreign` FOREIGN KEY (`id_bien_the`) REFERENCES `bien_the_san_phams` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hangs_id_don_hang_foreign` FOREIGN KEY (`id_don_hang`) REFERENCES `don_hangs` (`id`),
  ADD CONSTRAINT `chi_tiet_don_hangs_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD CONSTRAINT `chi_tiet_gio_hangs_id_bien_the_foreign` FOREIGN KEY (`id_bien_the`) REFERENCES `bien_the_san_phams` (`id`),
  ADD CONSTRAINT `chi_tiet_gio_hangs_id_gio_hang_foreign` FOREIGN KEY (`id_gio_hang`) REFERENCES `gio_hangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_gio_hangs_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`);

--
-- Các ràng buộc cho bảng `danh_gia_san_phams`
--
ALTER TABLE `danh_gia_san_phams`
  ADD CONSTRAINT `danh_gia_san_phams_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `danh_gia_san_phams_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `dia_chi_nguoi_dungs`
--
ALTER TABLE `dia_chi_nguoi_dungs`
  ADD CONSTRAINT `dia_chi_nguoi_dungs_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD CONSTRAINT `don_hangs_id_dia_chi_nguoi_dungs_foreign` FOREIGN KEY (`id_dia_chi_nguoi_dungs`) REFERENCES `dia_chi_nguoi_dungs` (`id`),
  ADD CONSTRAINT `don_hangs_id_phuong_thuc_thanh_toan_foreign` FOREIGN KEY (`id_phuong_thuc_thanh_toan`) REFERENCES `phuong_thuc_thanh_toans` (`id`),
  ADD CONSTRAINT `don_hangs_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD CONSTRAINT `gio_hangs_id_giam_gia_foreign` FOREIGN KEY (`id_giam_gia`) REFERENCES `ma_giam_gias` (`id`),
  ADD CONSTRAINT `gio_hangs_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `lich_su_xems`
--
ALTER TABLE `lich_su_xems`
  ADD CONSTRAINT `lich_su_xems_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`),
  ADD CONSTRAINT `lich_su_xems_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `nhat_ky_ton_khos`
--
ALTER TABLE `nhat_ky_ton_khos`
  ADD CONSTRAINT `nhat_ky_ton_khos_id_bien_the_foreign` FOREIGN KEY (`id_bien_the`) REFERENCES `bien_the_san_phams` (`id`);

--
-- Các ràng buộc cho bảng `san_phams`
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
