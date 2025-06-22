-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 21, 2025 lúc 04:35 PM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.3.6

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
(1, 1, 'images/anh_phu/o1xbT2xGlNRPymucBZ1vqlXlibBJZxYpQw3PFoyp.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(2, 1, 'images/anh_phu/MBvBV2EMCQINo95SUM4PpTXtZLfk2LU0lB9WZePW.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(3, 1, 'images/anh_phu/s4wiZmjh34UYliDHlDimv3rVeQoBTxhBHHRm6itd.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(4, 1, 'images/anh_phu/JUUjNPFLLc7ARFXCOUyVFjwAYdIwy7Lp2XH22wTA.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(5, 1, 'images/anh_phu/G6YkvFtdnSqQ3FNB6EbWodmPd7cnDRrCSHiJiNxX.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(6, 2, 'images/anh_phu/LTtg29VVjyvyK8kmLcgvxb9TgjlonJo35eMi3zfm.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(7, 2, 'images/anh_phu/0k1nLMKXv88rcXd9p47qO68NDNvp9cpzlZDKxjKs.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(8, 2, 'images/anh_phu/f4dVUMsU50ZhjjJbMi3uk5V7ww45Q9bCYjLhkrJJ.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(9, 2, 'images/anh_phu/9yYFOcNENPzFCn9Pc0YSt2kWHgJ64OwqHQmbs3bg.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(10, 2, 'images/anh_phu/vinTbeKr0gz7XmgWNYkBQeYpQlzikH6IGSEuDW4N.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL);

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
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bien_the_san_phams`
--

INSERT INTO `bien_the_san_phams` (`id`, `id_product`, `id_ram`, `id_o_cung`, `gia`, `gia_so_sanh`, `ton_kho`, `ma_bien_the`, `anh_dai_dien`, `hoat_dong`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 9990000.00, 10990000.00, 6, 'BT7594', NULL, 1, '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(2, 1, 1, 3, 15990000.00, 20990000.00, 5, 'BT8080', NULL, 1, '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(3, 1, 2, 1, 12990000.00, 20990000.00, 7, 'BT8396', NULL, 1, '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(4, 2, 1, 1, 9990000.00, 10990000.00, 6, 'BT6018', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(5, 2, 1, 3, 9990000.00, 10990000.00, 8, 'BT3266', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(6, 2, 2, 1, 9990000.00, 10990000.00, 9, 'BT0017', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL),
(7, 2, 2, 3, 9990000.00, 10990000.00, 8, 'BT5952', NULL, 1, '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL);

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
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chips`
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

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_hangs`
--

INSERT INTO `chi_tiet_don_hangs` (`id`, `id_don_hang`, `id_product`, `id_bien_the`, `ten_hien_thi`, `so_luong`, `don_gia`, `bao_hanh_thang`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 2, 9990000.00, 36, '2025-06-21 08:57:07', '2025-06-21 08:57:07'),
(2, 5, 1, 1, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 1, 9990000.00, 36, '2025-06-21 09:03:31', '2025-06-21 09:03:31'),
(3, 6, 1, 1, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 1, 9990000.00, 36, '2025-06-21 09:05:20', '2025-06-21 09:05:20'),
(4, 7, 1, 1, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 1, 9990000.00, 36, '2025-06-21 09:07:49', '2025-06-21 09:07:49'),
(5, 8, 1, 1, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 1, 9990000.00, 36, '2025-06-21 09:13:05', '2025-06-21 09:13:05');

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

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_gio_hangs`
--

INSERT INTO `chi_tiet_gio_hangs` (`id`, `id_gio_hang`, `id_product`, `id_bien_the`, `so_luong`, `gia`, `created_at`, `updated_at`) VALUES
(12, 1, 1, 3, 1, 12990000.00, '2025-06-21 09:33:43', '2025-06-21 09:33:43');

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `trang_thai` enum('cho_duyet','da_duyet','tu_choi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cho_duyet',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_gia_san_phams`
--

INSERT INTO `danh_gia_san_phams` (`id`, `id_product`, `id_user`, `so_sao`, `binh_luan`, `created_at`, `updated_at`, `trang_thai`, `deleted_at`) VALUES
(1, 1, 11, 4, 'Đẹp thật sự', '2025-06-20 21:25:18', '2025-06-21 07:30:06', 'da_duyet', NULL);

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
(1, 'Laptop', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'PC Gaming', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'Linh kiện', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'Màn hình', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(5, 'Phụ kiện', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(6, 'PC Bán Chạy', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dia_chi_nguoi_dungs`
--

CREATE TABLE `dia_chi_nguoi_dungs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `ten_nguoi_nhan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai_nguoi_nhan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi_day_du` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinh_thanh_pho` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quan_huyen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phuong_xa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mac_dinh` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dia_chi_nguoi_dungs`
--

INSERT INTO `dia_chi_nguoi_dungs` (`id`, `id_user`, `ten_nguoi_nhan`, `so_dien_thoai_nguoi_nhan`, `dia_chi_day_du`, `tinh_thanh_pho`, `quan_huyen`, `phuong_xa`, `mac_dinh`, `created_at`, `updated_at`) VALUES
(1, 11, 'Trần Pohng', '0325413923', 'ff', 'Hà Nội', 'Nam Từ Liêm', 'Hội', 1, '2025-06-21 08:54:22', '2025-06-21 08:54:34');

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
  `tong_tien_goc` decimal(10,2) NOT NULL DEFAULT '0.00',
  `giam_gia` decimal(10,2) NOT NULL DEFAULT '0.00',
  `trang_thai` enum('cho_xu_ly','dang_giao','hoan_thanh','huy') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_ma_giam_gia` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `ma_don`, `id_user`, `id_dia_chi_nguoi_dungs`, `id_phuong_thuc_thanh_toan`, `tong_tien`, `tong_tien_goc`, `giam_gia`, `trang_thai`, `created_at`, `updated_at`, `id_ma_giam_gia`, `deleted_at`) VALUES
(1, 'DH1750521295', 11, 1, 1, 18980000.00, 19980000.00, 1000000.00, 'cho_xu_ly', '2025-06-21 08:54:55', '2025-06-21 08:54:55', 6, NULL),
(2, 'DH1750521301', 11, 1, 1, 18980000.00, 19980000.00, 1000000.00, 'cho_xu_ly', '2025-06-21 08:55:01', '2025-06-21 08:55:01', 6, NULL),
(3, 'DH1750521312', 11, 1, 1, 18980000.00, 19980000.00, 1000000.00, 'cho_xu_ly', '2025-06-21 08:55:12', '2025-06-21 08:55:12', 6, NULL),
(4, 'DH1750521427', 11, 1, 1, 18980000.00, 19980000.00, 1000000.00, 'cho_xu_ly', '2025-06-21 08:57:07', '2025-06-21 08:57:07', 6, NULL),
(5, 'DH1750521811', 11, 1, 1, 8991000.00, 9990000.00, 999000.00, 'cho_xu_ly', '2025-06-21 09:03:31', '2025-06-21 09:03:31', 5, NULL),
(6, 'DH1750521920', 11, 1, 2, 9990000.00, 9990000.00, 0.00, 'cho_xu_ly', '2025-06-21 09:05:20', '2025-06-21 09:05:20', NULL, NULL),
(7, 'DH1750522069', 11, 1, 1, 8991000.00, 9990000.00, 999000.00, 'cho_xu_ly', '2025-06-21 09:07:49', '2025-06-21 09:07:49', 5, NULL),
(8, 'DH1750522385', 11, 1, 1, 8991000.00, 9990000.00, 999000.00, 'cho_xu_ly', '2025-06-21 09:13:05', '2025-06-21 09:13:05', 5, NULL);

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

--
-- Đang đổ dữ liệu cho bảng `gio_hangs`
--

INSERT INTO `gio_hangs` (`id`, `id_user`, `loai`, `id_giam_gia`, `ghi_chu`, `created_at`, `updated_at`) VALUES
(1, 11, 'chinh', 6, NULL, '2025-06-20 21:24:04', '2025-06-21 09:14:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gpus`
--

CREATE TABLE `gpus` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `gpus`
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
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mainboards`
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
-- Cấu trúc bảng cho bảng `ma_giam_gias`
--

CREATE TABLE `ma_giam_gias` (
  `id` bigint UNSIGNED NOT NULL,
  `ma` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loai` enum('phan_tram','tien_mat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia_tri` decimal(10,2) NOT NULL,
  `dieu_kien` decimal(10,2) NOT NULL DEFAULT '0.00',
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

INSERT INTO `ma_giam_gias` (`id`, `ma`, `loai`, `gia_tri`, `dieu_kien`, `ngay_bat_dau`, `ngay_ket_thuc`, `hoat_dong`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Giam10%', 'phan_tram', 10.00, 0.00, '2025-06-20 17:00:00', '2025-07-20 17:00:00', 1, '2025-06-20 21:17:39', '2025-06-21 08:33:45', NULL),
(6, 'Hocsinh', 'tien_mat', 1000000.00, 0.00, '2025-06-20 17:00:00', '2025-06-21 17:00:00', 1, '2025-06-21 08:41:56', '2025-06-21 08:41:56', NULL);

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
(24, '2025_06_21_043015_add_id_product_to_chi_tiet_gio_hangs_table', 2),
(25, '2025_06_21_153041_add_id_ma_giam_gia_to_don_hangs_table', 3),
(26, '2025_06_21_153649_add_dieu_kien_to_ma_giam_gias_table', 4),
(27, '2025_06_21_154719_add_tong_tien_goc_and_giam_gia_to_don_hangs_table', 5),
(28, '2025_06_21_155559_add_id_product_to_chi_tiet_don_hangs_table', 6),
(29, '2025_06_21_155741_add_deleted_at_to_don_hangs_table', 7);

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
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `o_cungs`
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
(1, 'Thanh toán khi nhận hàng', 'Phương thức: Thanh toán khi nhận hàng', 1, '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'Chuyển khoản ngân hàng', 'Phương thức: Chuyển khoản ngân hàng', 1, '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'Ví điện tử Momo', 'Phương thức: Ví điện tử Momo', 1, '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'Thẻ tín dụng', 'Phương thức: Thẻ tín dụng', 1, '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rams`
--

CREATE TABLE `rams` (
  `id` bigint UNSIGNED NOT NULL,
  `dung_luong` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `rams`
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
(1, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 'WD0754', '<div><strong>PC FASTER GAMING 10400F - RTX 3050 6GB</strong>&nbsp;l&agrave; bộ PC Gaming - PC Đồ Họa Hiệu năng cao, được x&acirc;y dựng để đ&aacute;p ứng nhu cầu chơi game, học tập, l&agrave;m việc với mức gi&aacute; v&ocirc; c&ugrave;ng hợp l&yacute; . C&oacute; thể c&acirc;n tốt c&aacute;c tựa game Moba, FPS : LOL, FIFA, DOTA, CSGO, GTA 5 , PUBG.... cũng như c&aacute;c t&aacute;c vụ văn ph&ograve;ng , chỉnh sửa ảnh , edit video cơ bản.</div>\r\n<h3><strong>1.&nbsp;CPU Intel Core i5-10400F (2.9GHz turbo up to 4.3Ghz, 6 nh&acirc;n 12 luồng, 12MB Cache, 65W) - Socket Intel LGA 1200</strong></h3>\r\n<p><strong>CPU Intel Core i5-10400F</strong>&nbsp;ch&iacute;nh l&agrave; sự lựa chọn ho&agrave;n mỹ cho những ai muốn trải nghiệm hiệu suất đa nhiệm tốt nhưng c&oacute; gi&aacute; th&agrave;nh rẻ. CPU Intel Core i5-10400F đ&atilde; cắt giảm đi iGPU t&iacute;ch hợp sẵn nhưng vẫn đem lại trải nghiệm l&agrave;m việc tốt tương tự như bộ xử l&yacute; Intel Core i5 10400 th&ocirc;ng thường. mẫu CPU n&agrave;y sở hữu 6 nh&acirc;n 12 luồng cho đ&aacute;p ứng tốt nhu cầu l&agrave;m việc v&agrave; giải tr&iacute; c&ugrave;ng l&uacute;c. C&oacute; thể n&oacute;i, với mức gi&aacute; ph&ugrave; hợp, đ&acirc;y chắc chắn l&agrave; lựa chọn số 1 cho người d&ugrave;ng phổ th&ocirc;ng.</p>\r\n<p>&nbsp;</p>\r\n<div>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/i5_10400f_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3>&nbsp;</h3>\r\n<h3><strong>3. RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp;</strong></h3>\r\n<p>RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp; l&agrave; d&ograve;ng sản phẩm RAM chất lượng , ổn định , &nbsp;c&oacute; hiệu suất cực cao , tốc độ truyền tải nhanh ch&oacute;ng, khả năng tương th&iacute;ch tốt cho ph&eacute;p tất cả c&aacute;c game thủ vượt giới hạn tốc độ v&agrave; tận hưởng thế giới game ấn tượng nhất . Được thiết kế cho c&aacute;c game thủ v&agrave; những người &nbsp;đam m&ecirc;. những người muốn n&acirc;ng cấp tiết kiệm chi ph&iacute; để chơi game nhanh hơn.Đ&acirc;y l&agrave; sự lựa chọn tuyệt vời cho bộ PC Gaming gi&aacute; rẻ m&agrave; c&aacute;c game thủ kh&ocirc;ng n&ecirc;n bỏ qua.</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/ram-geil-evo-spear-16gb-ddr4-bus-3200_pcm_2114afa10c95413db9ef7c74bf1f9d4d_grande.png\"></p>\r\n<p>&nbsp;</p>\r\n<h3>4.&nbsp;&nbsp;Ổ cứng SSD TeamGroup CX2 256GB 2.5 inch SATA III</h3>\r\n<p>SSD TeamGroup CX2 được trang bị c&ocirc;ng nghệ FLASH hiện đại, tiết kiệm năng lượng ti&ecirc;u thụ cũng như tốc độ truyền cao. Hiệu suất mang lại kh&aacute;c hẳn so với những chiếc ổ cứng truyền thống trước đ&acirc;y. SSD TeamGroup CX2 sử dụng c&ocirc;ng nghệ SLC Caching t&acirc;n tiến được nh&agrave; sản xuất đưa v&agrave;o nhằm tối ưu hiệu suất l&agrave;m việc tr&ecirc;n m&aacute;y t&iacute;nh cho người d&ugrave;ng. Sở hữu tốc độ đọc/ghi nhanh gấp 4 lần so với c&aacute;c ổ cứng truyền thống. Được trang bị khả năng chống sốc v&agrave; rơi 1500G/0.5mili gi&acirc;y mang đến ổ cứng TeamGroup bền bỉ hơn. Đồng thời SSD CX2 cũng được thiết kế với trải nghiệm kh&ocirc;ng g&acirc;y ra tiếng ồn cơ học kh&oacute; chịu tối ưu trải nghiệm người d&ugrave;ng hơn. Để k&eacute;o d&agrave;i tuổi thọ hơn cho ổ cứng SSD TeamGroup CX2 c&ograve;n được trang bị th&ecirc;m c&ocirc;ng nghệ Wear-Leveling v&agrave; chức năng ECC. Tất cả nhằm mang đến trải nghiệm sử dụng tốt hơn cho người d&ugrave;ng với tốc độ tin cậy trong qu&aacute; tr&igrave;nh truyền dữ liệu. C&ugrave;ng đ&oacute; l&agrave; mức độ bền bỉ khi tuổi thọ của SSD được đảm bảo tốt hơn.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/o_cung_ssd_teamgroup_cx2_256gb_2.5_inch_sata_iii_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>5. &nbsp;CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;</strong></h3>\r\n<p>CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;&nbsp; l&agrave; một sản phẩm đ&aacute;ng ch&uacute; &yacute; trong ph&acirc;n kh&uacute;c card đồ họa tầm trung.Với kiến tr&uacute;c NVIDI Ampere mới nhất sử dụng chip đồ họa NVIDIA GeForce RTX 3050, c&oacute; khả năng xử l&yacute; đồ họa 3D mượt m&agrave;, hỗ trợ c&ocirc;ng nghệ ray tracing v&agrave; DLSS., RTX 3050 DUAL OC 6GB kết hợp hiệu suất nhiệt tối ưu với khả năng tương th&iacute;ch cao. Đ&acirc;y l&agrave; sự lựa chọn ho&agrave;n hảo cho những game thủ muốn c&oacute; hiệu suất đồ họa mạnh trong một cấu h&igrave;nh nhỏ gọn.</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/zt-a30500h-10m-image01_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n</div>', 1, 2, 2, 2, 1, 36, 1, 'images/zNLVsTDHQdO9jgYmwxSBoKia784MVCHcGEh5SB2W.jpg', '2025-06-20 21:23:00', '2025-06-20 21:23:00', NULL),
(2, 'PC AMD GAMING MAX PERFORMANCE Ryzen 7 7800X3D - RTX 5090 32GB OC', 'WD0622', '<div><strong>PC FASTER GAMING 10400F - RTX 3050 6GB</strong>&nbsp;l&agrave; bộ PC Gaming - PC Đồ Họa Hiệu năng cao, được x&acirc;y dựng để đ&aacute;p ứng nhu cầu chơi game, học tập, l&agrave;m việc với mức gi&aacute; v&ocirc; c&ugrave;ng hợp l&yacute; . C&oacute; thể c&acirc;n tốt c&aacute;c tựa game Moba, FPS : LOL, FIFA, DOTA, CSGO, GTA 5 , PUBG.... cũng như c&aacute;c t&aacute;c vụ văn ph&ograve;ng , chỉnh sửa ảnh , edit video cơ bản.</div>\r\n<h3><strong>1.&nbsp;CPU Intel Core i5-10400F (2.9GHz turbo up to 4.3Ghz, 6 nh&acirc;n 12 luồng, 12MB Cache, 65W) - Socket Intel LGA 1200</strong></h3>\r\n<p><strong>CPU Intel Core i5-10400F</strong>&nbsp;ch&iacute;nh l&agrave; sự lựa chọn ho&agrave;n mỹ cho những ai muốn trải nghiệm hiệu suất đa nhiệm tốt nhưng c&oacute; gi&aacute; th&agrave;nh rẻ. CPU Intel Core i5-10400F đ&atilde; cắt giảm đi iGPU t&iacute;ch hợp sẵn nhưng vẫn đem lại trải nghiệm l&agrave;m việc tốt tương tự như bộ xử l&yacute; Intel Core i5 10400 th&ocirc;ng thường. mẫu CPU n&agrave;y sở hữu 6 nh&acirc;n 12 luồng cho đ&aacute;p ứng tốt nhu cầu l&agrave;m việc v&agrave; giải tr&iacute; c&ugrave;ng l&uacute;c. C&oacute; thể n&oacute;i, với mức gi&aacute; ph&ugrave; hợp, đ&acirc;y chắc chắn l&agrave; lựa chọn số 1 cho người d&ugrave;ng phổ th&ocirc;ng.</p>\r\n<p>&nbsp;</p>\r\n<div>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/i5_10400f_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3>&nbsp;</h3>\r\n<h3><strong>3. RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp;</strong></h3>\r\n<p>RAM GEIL SPEAR EVO 16GB Bus 3200Mhz DDR4&nbsp; l&agrave; d&ograve;ng sản phẩm RAM chất lượng , ổn định , &nbsp;c&oacute; hiệu suất cực cao , tốc độ truyền tải nhanh ch&oacute;ng, khả năng tương th&iacute;ch tốt cho ph&eacute;p tất cả c&aacute;c game thủ vượt giới hạn tốc độ v&agrave; tận hưởng thế giới game ấn tượng nhất . Được thiết kế cho c&aacute;c game thủ v&agrave; những người &nbsp;đam m&ecirc;. những người muốn n&acirc;ng cấp tiết kiệm chi ph&iacute; để chơi game nhanh hơn.Đ&acirc;y l&agrave; sự lựa chọn tuyệt vời cho bộ PC Gaming gi&aacute; rẻ m&agrave; c&aacute;c game thủ kh&ocirc;ng n&ecirc;n bỏ qua.</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/ram-geil-evo-spear-16gb-ddr4-bus-3200_pcm_2114afa10c95413db9ef7c74bf1f9d4d_grande.png\"></p>\r\n<p>&nbsp;</p>\r\n<h3>4.&nbsp;&nbsp;Ổ cứng SSD TeamGroup CX2 256GB 2.5 inch SATA III</h3>\r\n<p>SSD TeamGroup CX2 được trang bị c&ocirc;ng nghệ FLASH hiện đại, tiết kiệm năng lượng ti&ecirc;u thụ cũng như tốc độ truyền cao. Hiệu suất mang lại kh&aacute;c hẳn so với những chiếc ổ cứng truyền thống trước đ&acirc;y. SSD TeamGroup CX2 sử dụng c&ocirc;ng nghệ SLC Caching t&acirc;n tiến được nh&agrave; sản xuất đưa v&agrave;o nhằm tối ưu hiệu suất l&agrave;m việc tr&ecirc;n m&aacute;y t&iacute;nh cho người d&ugrave;ng. Sở hữu tốc độ đọc/ghi nhanh gấp 4 lần so với c&aacute;c ổ cứng truyền thống. Được trang bị khả năng chống sốc v&agrave; rơi 1500G/0.5mili gi&acirc;y mang đến ổ cứng TeamGroup bền bỉ hơn. Đồng thời SSD CX2 cũng được thiết kế với trải nghiệm kh&ocirc;ng g&acirc;y ra tiếng ồn cơ học kh&oacute; chịu tối ưu trải nghiệm người d&ugrave;ng hơn. Để k&eacute;o d&agrave;i tuổi thọ hơn cho ổ cứng SSD TeamGroup CX2 c&ograve;n được trang bị th&ecirc;m c&ocirc;ng nghệ Wear-Leveling v&agrave; chức năng ECC. Tất cả nhằm mang đến trải nghiệm sử dụng tốt hơn cho người d&ugrave;ng với tốc độ tin cậy trong qu&aacute; tr&igrave;nh truyền dữ liệu. C&ugrave;ng đ&oacute; l&agrave; mức độ bền bỉ khi tuổi thọ của SSD được đảm bảo tốt hơn.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/o_cung_ssd_teamgroup_cx2_256gb_2.5_inch_sata_iii_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>5. &nbsp;CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;</strong></h3>\r\n<p>CARD M&Agrave;N H&Igrave;NH ZOTAC GAMING GeForce RTX 3050 Twin Edge OC&nbsp;&nbsp; l&agrave; một sản phẩm đ&aacute;ng ch&uacute; &yacute; trong ph&acirc;n kh&uacute;c card đồ họa tầm trung.Với kiến tr&uacute;c NVIDI Ampere mới nhất sử dụng chip đồ họa NVIDIA GeForce RTX 3050, c&oacute; khả năng xử l&yacute; đồ họa 3D mượt m&agrave;, hỗ trợ c&ocirc;ng nghệ ray tracing v&agrave; DLSS., RTX 3050 DUAL OC 6GB kết hợp hiệu suất nhiệt tối ưu với khả năng tương th&iacute;ch cao. Đ&acirc;y l&agrave; sự lựa chọn ho&agrave;n hảo cho những game thủ muốn c&oacute; hiệu suất đồ họa mạnh trong một cấu h&igrave;nh nhỏ gọn.</p>\r\n<p><img src=\"https://file.hstatic.net/1000288298/file/zt-a30500h-10m-image01_grande.jpg\"></p>\r\n<p>&nbsp;</p>\r\n</div>', 1, 2, 2, 2, 1, 36, 1, 'images/j5JJvaNXnBRTIfgbrRmbWho0NxKqoKzIwe2adQHH.jpg', '2025-06-20 21:23:29', '2025-06-20 21:23:29', NULL);

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
('ZXUc5OvReLMdikKoHQrGCkyvg0KOrMQ7EnYqBZT1', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ0tGQ3FNODNrU0ltaURpcVFMWGc1U3VXMXltMWpqQ1hYVmNHOWt5OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7fQ==', 1750523637);

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
(1, 'ASUS', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(2, 'MSI', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(3, 'GIGABYTE', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(4, 'Intel', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(5, 'AMD', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(6, 'Samsung', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL),
(7, 'Kingston', '2025-06-20 21:17:39', '2025-06-20 21:17:39', NULL);

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
(11, 'phong', 'phongtvph52541@gmail.com', NULL, '$2y$12$Kd3PHV7mJm09tpZIx0izWOX6qD7OxrJOFd1x2ZpIWva6qq3nkRh6O', 'Trần Văn Phong', '0325413923', 'quan_tri', 'hoat_dong', NULL, '2025-06-20 21:18:23', '2025-06-20 21:18:23', NULL);

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
  ADD KEY `chi_tiet_don_hangs_id_bien_the_foreign` (`id_bien_the`),
  ADD KEY `chi_tiet_don_hangs_id_product_foreign` (`id_product`);

--
-- Chỉ mục cho bảng `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chi_tiet_gio_hangs_id_gio_hang_foreign` (`id_gio_hang`),
  ADD KEY `chi_tiet_gio_hangs_id_bien_the_foreign` (`id_bien_the`),
  ADD KEY `chi_tiet_gio_hangs_id_product_foreign` (`id_product`);

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
  ADD KEY `don_hangs_id_phuong_thuc_thanh_toan_foreign` (`id_phuong_thuc_thanh_toan`),
  ADD KEY `don_hangs_id_ma_giam_gia_foreign` (`id_ma_giam_gia`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `chips`
--
ALTER TABLE `chips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `danh_gia_san_phams`
--
ALTER TABLE `danh_gia_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `dia_chi_nguoi_dungs`
--
ALTER TABLE `dia_chi_nguoi_dungs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `chi_tiet_don_hangs_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD CONSTRAINT `chi_tiet_gio_hangs_id_bien_the_foreign` FOREIGN KEY (`id_bien_the`) REFERENCES `bien_the_san_phams` (`id`),
  ADD CONSTRAINT `chi_tiet_gio_hangs_id_gio_hang_foreign` FOREIGN KEY (`id_gio_hang`) REFERENCES `gio_hangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_gio_hangs_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `don_hangs_id_ma_giam_gia_foreign` FOREIGN KEY (`id_ma_giam_gia`) REFERENCES `ma_giam_gias` (`id`) ON DELETE SET NULL,
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
