-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2025 at 01:32 PM
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
-- Table structure for table `anh_minh_chungs`
--

CREATE TABLE `anh_minh_chungs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_yeu_cau_hoan_tra` bigint UNSIGNED NOT NULL,
  `loai` enum('nguoi_dung','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nguoi_dung',
  `duong_dan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anh_minh_chungs`
--

INSERT INTO `anh_minh_chungs` (`id`, `id_yeu_cau_hoan_tra`, `loai`, `duong_dan`, `created_at`, `updated_at`) VALUES
(1, 1, 'nguoi_dung', '/storage/minhchung/sqyloEORHWtF2UziSFJV3s4ZlILBUqzVA0GkKOJg.png', '2025-09-04 00:24:56', '2025-09-04 00:24:56'),
(2, 1, 'admin', 'minhchung/anh_hoan_tien/DEkPYbDBGtUmcq0wv1AMBMosbKVpaEWecU5hPr7l.jpg', '2025-09-04 00:25:59', '2025-09-04 00:25:59'),
(3, 2, 'nguoi_dung', '/storage/minhchung/Lc9sZGvWKSHlU3zVCqShOtk69ecs2glRV11bnO32.png', '2025-09-04 03:02:30', '2025-09-04 03:02:30'),
(4, 3, 'nguoi_dung', '/storage/minhchung/6VHuhQp5NKNSPia1Gwk7VL2B45nxLZf779XrS9IM.png', '2025-09-04 15:24:52', '2025-09-04 15:24:52'),
(5, 3, 'admin', 'minhchung/anh_hoan_tien/F6MkPDb7DVjqdvgkkdEFGhfTRNQ2rlHCHE0KpA3W.jpg', '2025-09-04 15:26:06', '2025-09-04 15:26:06'),
(6, 4, 'nguoi_dung', '/storage/minhchung/WBDa4SNB1hyawNwjyXJGBK59wzubSLMAMNraic04.jpg', '2025-09-05 04:23:36', '2025-09-05 04:23:36'),
(7, 4, 'admin', 'minhchung/anh_hoan_tien/8zJnwN1IfMUITnisZolNPlsL8wmcCtVkb6HBI6pY.jpg', '2025-09-05 04:25:12', '2025-09-05 04:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `anh_san_phams`
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
-- Dumping data for table `anh_san_phams`
--

INSERT INTO `anh_san_phams` (`id`, `id_product`, `duong_dan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'images/anh_phu/DcaB2lEVTtTYHuwDQwbMazrKxe4WXkCN6ncRuy0i.png', '2025-07-29 14:55:45', '2025-07-29 14:55:45', NULL),
(2, 2, 'images/anh_phu/3MGi8AHdagbZuiUhllkPg2CTria5vDZ1GSIc4tMO.png', '2025-07-29 14:55:45', '2025-07-29 14:55:45', NULL),
(3, 2, 'images/anh_phu/jFlmwQJTPoOGLvN7TlRDGJHb5SMXLdIck87AgUyN.png', '2025-07-29 14:55:45', '2025-07-29 14:55:45', NULL),
(4, 2, 'images/anh_phu/YuYfIERu72vqaY4NwkcmOcTRRODNm7iPmvMYatjr.png', '2025-07-29 14:55:45', '2025-07-29 14:55:45', NULL),
(5, 1, 'images/Wqmo1RXgxAze4im8ICn0qzB7D22ZbpmddoebB6k3.jpg', '2025-07-29 14:56:11', '2025-07-29 14:56:11', NULL),
(6, 1, 'images/U9qnVlRNaW52DErqtJFekfBRLLNUe8ObBcAkXtOY.jpg', '2025-07-29 14:56:11', '2025-07-29 14:56:11', NULL),
(7, 1, 'images/8XSvu7JaJMiR8fdUx57dPZYVsQTnmSCT8jwbiDr2.jpg', '2025-07-29 14:56:11', '2025-07-29 14:56:11', NULL),
(8, 1, 'images/AwylltlpByoBvrdT0ap7I7e4q9pE5yafEhOt81ef.jpg', '2025-07-29 14:56:11', '2025-07-29 14:56:11', NULL),
(9, 1, 'images/148RS7JkMRlmKo5ZbSz8mPRpXyUcC0yDtZ1cGLgS.jpg', '2025-07-29 14:56:11', '2025-07-29 14:56:11', NULL),
(10, 1, 'images/XGvkydEViEkoRU6YcD2Zv5u2Edej3CLP9To0dAAe.jpg', '2025-07-29 14:56:11', '2025-07-29 14:56:11', NULL),
(11, 1, 'images/yHqAdFbAiEl5zfR6iDTb1tlpZr9eHlbYVHTjcuV0.jpg', '2025-07-29 14:56:11', '2025-07-29 14:56:11', NULL),
(12, 1, 'images/DEMYJfQIIy6iJqxW7N4BQrHdkKjcDTDLNrz2Hzvw.jpg', '2025-07-29 14:56:11', '2025-07-29 14:56:11', NULL),
(13, 3, 'images/anh_phu/uLo1OwkaXwIC7PTuXkEwvbor86YCm4mAzSf4p4er.png', '2025-07-29 15:02:26', '2025-07-29 15:02:26', NULL),
(14, 3, 'images/anh_phu/PPqHTescnSqZTP4HDaXc7IQZgELODNPT7L8ZIgl2.png', '2025-07-29 15:02:26', '2025-07-29 15:02:26', NULL),
(15, 3, 'images/anh_phu/MEDD53zeXowx3VVpc72nYwP0gC1jgLFUqpaxrSOe.png', '2025-07-29 15:02:26', '2025-07-29 15:02:26', NULL),
(16, 3, 'images/anh_phu/r87jp2qz2qGSQus7Q7mV9IEqfKfxyz0hlh0KMAUp.png', '2025-07-29 15:02:26', '2025-07-29 15:02:26', NULL),
(17, 3, 'images/anh_phu/ptPKVVziLJUr6Lv2PoTNtro7BYq2xqjn4g217iAy.png', '2025-07-29 15:02:26', '2025-07-29 15:02:26', NULL),
(18, 3, 'images/anh_phu/6hQJZhGqsYb6PPTDfiJarnxaO8r4JyGPQGBeZseK.png', '2025-07-29 15:02:26', '2025-07-29 15:02:26', NULL),
(19, 3, 'images/anh_phu/VoT8iEbPcZ6M08QqN38ai8bTvi2z3x6H1p8wX87R.png', '2025-07-29 15:02:26', '2025-07-29 15:02:26', NULL),
(20, 3, 'images/anh_phu/aMUYluaBr8htTWGGPAJLm5E2YSSeQnpZDqpxEcnu.png', '2025-07-29 15:02:26', '2025-07-29 15:02:26', NULL),
(21, 4, 'images/anh_phu/QwTGtC9kHPpDKjT2cJ7JPpi4nUaYm9ZIStvfuPcS.png', '2025-07-29 15:13:02', '2025-07-29 15:13:02', NULL),
(22, 4, 'images/anh_phu/0bnXw3ArhhGQjGGIFpjkCuMUFCndKBkL1LufpIHp.png', '2025-07-29 15:13:02', '2025-07-29 15:13:02', NULL),
(23, 4, 'images/anh_phu/flvG3dDY0v7FVbBWcwoEmQuDuw68BQCgDI2rQhJY.png', '2025-07-29 15:13:02', '2025-07-29 15:13:02', NULL),
(24, 4, 'images/anh_phu/4eoMia4nKA6hymRgchYDLOgvqC8uYK6Ui4qSczwX.png', '2025-07-29 15:13:02', '2025-07-29 15:13:02', NULL),
(25, 5, 'images/anh_phu/JbdpUgFBoIzPSlPeCZ6RPdSE8CAHVeXX4vspPQJT.png', '2025-08-20 00:54:58', '2025-08-20 00:54:58', NULL),
(26, 5, 'images/anh_phu/KS23HkCjJJRVlZQngd6xZOUoXvMBlichTVge1zOd.jpg', '2025-08-20 00:54:58', '2025-08-20 00:54:58', NULL),
(27, 5, 'images/anh_phu/x0esFKo8Rw1lcirLXnxSEHhK84LgpFOICfabUzWb.jpg', '2025-08-20 00:54:58', '2025-08-20 00:54:58', NULL),
(28, 5, 'images/anh_phu/7ZVkOvPHVPWqbpWUtfgqSFhkaRv3mPkuxtj724yY.jpg', '2025-08-20 00:54:58', '2025-08-20 00:54:58', NULL),
(29, 6, 'images/anh_phu/sK8wvNfeLRm6ukOc21MtvjVjTTs2HBgy1mUqzNFx.jpg', '2025-08-20 08:19:24', '2025-08-20 08:19:24', NULL),
(30, 6, 'images/anh_phu/wMsvRCc4AXp3Jhx1s6XPcXUiNJ4QyYtCza75EImX.jpg', '2025-08-20 08:19:24', '2025-08-20 08:19:24', NULL),
(31, 6, 'images/anh_phu/TwX5wfokuuyG7d5cqJu1ASfrBOpGkwZirUpWe5QF.jpg', '2025-08-20 08:19:25', '2025-08-20 08:19:25', NULL),
(32, 7, 'images/anh_phu/xkrOI64rrNQSb6OaaRsqlm056O9w9bSULH16DTzT.png', '2025-08-21 02:44:11', '2025-08-21 02:44:11', NULL),
(33, 8, 'images/anh_phu/k7DJ3IWzaL45pr4aCn1Lv6M4eBOh836fsrEQVXS8.jpg', '2025-08-21 03:02:14', '2025-08-21 03:02:14', NULL),
(34, 8, 'images/anh_phu/QQtRPgOmLnFWx4lpJJ2O0T4amp7S14bPBMtC7WUg.jpg', '2025-08-21 03:02:14', '2025-08-21 03:02:14', NULL),
(35, 8, 'images/anh_phu/vzTPK96149N0T2t3IGiSwjMUJrOAuS32g5fKBf1X.jpg', '2025-08-21 03:02:14', '2025-08-21 03:02:14', NULL),
(36, 8, 'images/anh_phu/4fe18gItzwgMftKIFhpp4mPOrlHHJ6VJqeCzjjlB.jpg', '2025-08-21 03:02:14', '2025-08-21 03:02:14', NULL),
(37, 8, 'images/anh_phu/olP3EyDENpjUwGdzOMpfqs2wjE2maWTaXa15fb0o.jpg', '2025-08-21 03:02:14', '2025-08-21 03:02:14', NULL),
(38, 9, 'images/anh_phu/QwEdUjWw3wI0QZ2zGXPJxE3no5eFGF42W4eTrsAs.png', '2025-08-21 03:07:30', '2025-08-21 03:07:30', NULL),
(39, 9, 'images/anh_phu/WkaVDb3Q65E5PVFGCt65wrnCGzVZXgcDohQEJN0z.jpg', '2025-08-21 03:07:30', '2025-08-21 03:07:30', NULL),
(40, 9, 'images/anh_phu/ntIt5xrvnQVZ9jUE2qFScNElQOgSyPah278r3ZN1.jpg', '2025-08-21 03:07:30', '2025-08-21 03:07:30', NULL),
(41, 9, 'images/anh_phu/9nppFLMFbrHlLiX7dt4nCJXLMojzjDcX8xq57Yp4.jpg', '2025-08-21 03:07:30', '2025-08-21 03:07:30', NULL),
(42, 10, 'images/anh_phu/gUKj2QBsePqKI6KlIp5wizBaiLFANo4CxCQkuLlE.png', '2025-08-21 03:10:54', '2025-08-21 03:10:54', NULL),
(43, 10, 'images/anh_phu/xvtBwu4OoF69sNgZUMoAQFLOMXDeds9YCoT2HSoz.jpg', '2025-08-21 03:10:54', '2025-08-21 03:10:54', NULL),
(44, 10, 'images/anh_phu/UQXtKJCquQDxcu8v4XqiEzEdwXc3LC6AKPx1ZLST.jpg', '2025-08-21 03:10:54', '2025-08-21 03:10:54', NULL),
(45, 10, 'images/anh_phu/7BBnWEsqfYfhOnQb8u3oJC2d2iwbhJmsz2VTf9ku.jpg', '2025-08-21 03:10:54', '2025-08-21 03:10:54', NULL),
(46, 11, 'images/anh_phu/C1ZICYYnn9EyXTesGBuyGCvBSkhfEEv6RFdNodlZ.png', '2025-08-21 03:20:43', '2025-08-21 03:20:43', NULL),
(47, 11, 'images/anh_phu/Jj6Bf2gpvzK7lAmTv1UgzGsk5NeTmni1itncT2LC.png', '2025-08-21 03:20:43', '2025-08-21 03:20:43', NULL),
(48, 11, 'images/anh_phu/MRRvHeoFW0bo7FYRUzXyMqxE7TbreWU25OBUjPK5.png', '2025-08-21 03:20:43', '2025-08-21 03:20:43', NULL),
(49, 12, 'images/anh_phu/cObTP8LRDYIfeUQ1VXoVBuJGXTUTKR3ZyM8zWZAY.jpg', '2025-08-21 03:26:14', '2025-08-21 03:26:14', NULL),
(50, 12, 'images/anh_phu/dzv5ga4vC8xZqEWLSuBVewQdiTPoXtK8klbteyrm.jpg', '2025-08-21 03:26:14', '2025-08-21 03:26:14', NULL),
(51, 12, 'images/anh_phu/zaegsTYiMh6Tog4ZceUfuiuG4nAXuLUoeTdIosP2.jpg', '2025-08-21 03:26:14', '2025-08-21 03:26:14', NULL),
(52, 13, 'images/anh_phu/XNjoOxkwLxPU5WJXeNEtXx9x6c03EkaSFSLwQIx8.png', '2025-08-21 03:27:55', '2025-08-21 03:27:55', NULL),
(53, 13, 'images/anh_phu/VVzQVa7Mi9EPUC1dLZdvWai5s3q6TOicTnyVtzkl.png', '2025-08-21 03:27:55', '2025-08-21 03:27:55', NULL),
(54, 13, 'images/anh_phu/ALQFcN0Fu4xgi8QqWTbSOH70j9M1ZyRMxxgiXxUv.png', '2025-08-21 03:27:55', '2025-08-21 03:27:55', NULL),
(55, 14, 'images/anh_phu/J2fQ7cHT1QxFW8nWPg76YGesaARocgzWADOhSdhO.png', '2025-08-21 03:29:35', '2025-08-21 03:29:35', NULL),
(56, 14, 'images/anh_phu/YscZt4EIUMOcSW6GhVHWejTpMDsgHaRFr0s7MUkZ.png', '2025-08-21 03:29:35', '2025-08-21 03:29:35', NULL),
(57, 14, 'images/anh_phu/2mbXC9oEvfZbMKCxm7qvy985lpXpUg73vWnB3BQP.png', '2025-08-21 03:29:35', '2025-08-21 03:29:35', NULL),
(58, 14, 'images/anh_phu/lj7pXdEKvsQ1t99wiZPorL04R1YG4KC3fWztpfVx.jpg', '2025-08-21 03:29:35', '2025-08-21 03:29:35', NULL),
(59, 15, 'images/anh_phu/trDxOzIRc9zBhvTd9Vi8jy0SdRgXCPFiSTf1jDQL.png', '2025-08-21 03:30:45', '2025-08-21 03:30:45', NULL),
(60, 16, 'images/anh_phu/6cTISAXz9DO0il3Lyk2Ei611RS5d5vk7pZW1Zz6P.jpg', '2025-08-21 03:35:07', '2025-08-21 03:35:07', NULL),
(61, 16, 'images/anh_phu/ggkGn0xBjHtQEFlQzugMUDxI7rn1VhEU3Bpr6oAt.jpg', '2025-08-21 03:35:07', '2025-08-21 03:35:07', NULL),
(62, 16, 'images/anh_phu/GdcOl2QtHktvF8qHPmFaYjjQOWZZthDOZlBbKTZO.jpg', '2025-08-21 03:35:07', '2025-08-21 03:35:07', NULL),
(63, 16, 'images/anh_phu/Arz87dfmJhXdiSUkf2h0xvyVOm3CmeQqHViLz5YJ.jpg', '2025-08-21 03:35:07', '2025-08-21 03:35:07', NULL),
(64, 16, 'images/anh_phu/IvBKzNNYt5cvkioqQINhltvzYBDlGG8OjEcuCM8b.jpg', '2025-08-21 03:35:07', '2025-08-21 03:35:07', NULL),
(65, 17, 'images/anh_phu/XrkdjO3roTpYiEZ0vh2uc5QuvuHuL9DFWOYHe1Zz.jpg', '2025-08-21 03:36:40', '2025-08-21 03:36:40', NULL),
(66, 17, 'images/anh_phu/NYYEFLi8GPQH5IswgEIRhwhbpuFQ5tsv1hfuL20T.jpg', '2025-08-21 03:36:40', '2025-08-21 03:36:40', NULL),
(67, 17, 'images/anh_phu/2spmhhUhokMo6YHSIhNJCKB8AzJF7uayMCJPiAn0.jpg', '2025-08-21 03:36:40', '2025-08-21 03:36:40', NULL),
(68, 17, 'images/anh_phu/lrFP8xsaCK7ewNhjbBGSb9mubl0QI3FxqUgXABQj.jpg', '2025-08-21 03:36:40', '2025-08-21 03:36:40', NULL),
(69, 17, 'images/anh_phu/IFjDaecN09nFX70LAAHNG5RwDANCoWGhBGA41219.jpg', '2025-08-21 03:36:40', '2025-08-21 03:36:40', NULL),
(70, 17, 'images/anh_phu/Gl8WURh5q7Hrh6TsMRDLe7RUsslaW4NF5rRK4MRa.jpg', '2025-08-21 03:36:40', '2025-08-21 03:36:40', NULL),
(71, 18, 'images/PutBOzA0e0fNyWKKNi3Sh5hVOOT2jmGsNGLkh0Nh.jpg', '2025-08-21 03:38:42', '2025-08-21 03:38:42', NULL),
(72, 18, 'images/vrNxhQvDBuPqMvaPkhK9XRJ1pqHAloZVfbf4SlS7.jpg', '2025-08-21 03:38:42', '2025-08-21 03:38:42', NULL),
(73, 18, 'images/iA3G68OAjQsWkamxYc9klz4wriBR7jlloF0zO67b.jpg', '2025-08-21 03:38:42', '2025-08-21 03:38:42', NULL),
(74, 18, 'images/jwApUNKLHNKmYyoakYo34REGc0BB4n4TqgGyQFKc.jpg', '2025-08-21 03:38:42', '2025-08-21 03:38:42', NULL),
(75, 18, 'images/QqQmT6XT9izpU8ceZkDQ3M8LIIJk6M61wmHS92im.jpg', '2025-08-21 03:38:42', '2025-08-21 03:38:42', NULL),
(76, 19, 'images/anh_phu/0dosRn2BRRBSGD6VXgcZ8y9AloG16D3Zmq6w3kTA.jpg', '2025-08-21 03:40:50', '2025-08-21 03:40:50', NULL),
(77, 19, 'images/anh_phu/enB9BWIInP0pOYQ9HaOT5rw4O5vgXfPDPGjEgQWR.png', '2025-08-21 03:40:50', '2025-08-21 03:40:50', NULL),
(78, 19, 'images/anh_phu/IHmQ5t4248HsF7XprqaQjLyKHywC3ky3f8BfR30x.png', '2025-08-21 03:40:50', '2025-08-21 03:40:50', NULL),
(79, 22, 'images/anh_phu/W0TJsd9G2NMQsUTtaag16Phqdnejb9OmnX7yox4H.png', '2025-08-25 02:19:08', '2025-08-25 02:19:08', NULL),
(80, 22, 'images/anh_phu/C1tVnWaKG6yxofHef06xSUOokFjaY72ZuRsazAgS.png', '2025-08-25 02:19:08', '2025-08-25 02:19:08', NULL),
(81, 22, 'images/anh_phu/VHtaUseDSHVuNTssa5w41BaSDN3hXMGPlkjd2NcM.png', '2025-08-25 02:19:08', '2025-08-25 02:19:08', NULL),
(82, 22, 'images/anh_phu/WaLf2vX2TXWpyOu1U7VB4p7eDB5a8nVJch6hTZhA.png', '2025-08-25 02:19:08', '2025-08-25 02:19:08', NULL),
(83, 22, 'images/anh_phu/Bkajjj1V5oqrpb6HNqF2awjaFMtuIn2aFIMoXRAR.png', '2025-08-25 02:19:08', '2025-08-25 02:19:08', NULL),
(84, 22, 'images/anh_phu/hf7SSr9ioH8BGVCRNEawTtfDYY2CYl2UvOqeg67h.png', '2025-08-25 02:19:08', '2025-08-25 02:19:08', NULL),
(85, 22, 'images/anh_phu/JVs4GxOBOZOYG5CQZA7eijFQVeZvds1v32rdDIV8.jpg', '2025-08-25 02:19:08', '2025-08-25 02:19:08', NULL),
(86, 23, 'images/anh_phu/0tpWiOXK7Untb7lOCv01IcvCnpvFonVatOpxOp71.jpg', '2025-08-25 02:22:15', '2025-08-25 02:22:15', NULL),
(87, 23, 'images/anh_phu/DTnd2nAix9RJNIvWWauicVgX0wwsFSzBvSp3PIWy.jpg', '2025-08-25 02:22:15', '2025-08-25 02:22:15', NULL),
(88, 23, 'images/anh_phu/Hmq1Lg1P3TEZpSsUN4SQZGqTTw6sFE9rJPL9xai5.jpg', '2025-08-25 02:22:15', '2025-08-25 02:22:15', NULL),
(89, 23, 'images/anh_phu/nSF7trMZoShovaFlKUSnfVYlrwBSIYfNfFFvRjgl.jpg', '2025-08-25 02:22:15', '2025-08-25 02:22:15', NULL),
(90, 23, 'images/anh_phu/IR958drkgD7kl5vVX3VdUaSkDS2aXxGEICutJFie.jpg', '2025-08-25 02:22:15', '2025-08-25 02:22:15', NULL),
(91, 23, 'images/anh_phu/ttK9g4lmMyCyvedhUPDpeEIqRNCEIcINXXuKwven.jpg', '2025-08-25 02:22:15', '2025-08-25 02:22:15', NULL),
(92, 24, 'images/anh_phu/GKXzNy7NK1HcfHTKYZwruoodgHJoQAI3ZvsmTord.png', '2025-08-25 02:28:09', '2025-08-25 02:28:09', NULL),
(93, 24, 'images/anh_phu/U9aKFzYJ7eje3RDiRChMJlArvzonVGJocGe3Rj0V.png', '2025-08-25 02:28:09', '2025-08-25 02:28:09', NULL),
(94, 24, 'images/anh_phu/LjAlzgnp7Iqo9ecGQWIF2mTLf608CqLkDL7ITDOs.png', '2025-08-25 02:28:09', '2025-08-25 02:28:09', NULL),
(95, 24, 'images/anh_phu/S4GpBuw7koqIt5VL7R9fYtSk1UktoL8ggi3KiZkr.png', '2025-08-25 02:28:09', '2025-08-25 02:28:09', NULL),
(96, 27, 'images/anh_phu/jSNooPU46slORepfxByx60xAwVLoqtHNXpXouR0L.jpg', '2025-09-02 09:30:59', '2025-09-02 09:30:59', NULL),
(97, 27, 'images/anh_phu/o4W1DZ6oN9j4iQKfLJvZoCkdUvqqUAJgGJUC7OVz.jpg', '2025-09-02 09:30:59', '2025-09-02 09:30:59', NULL),
(98, 27, 'images/anh_phu/gp30dr2nNhYgRSMj7YoYQj5kCgB3UxyIVcj7zF6a.jpg', '2025-09-02 09:30:59', '2025-09-02 09:30:59', NULL),
(99, 27, 'images/anh_phu/nfOtzeuFggqEG4uuNBRMEQW9t9j8ZvX10ExKz4Rl.jpg', '2025-09-02 09:30:59', '2025-09-02 09:30:59', NULL),
(100, 28, 'images/anh_phu/QpfUcjTiu9jmh0blvXnCdtSBLe0uaWFpPVSZjSPv.jpg', '2025-09-02 09:33:12', '2025-09-02 09:33:12', NULL),
(101, 28, 'images/anh_phu/nMFYf8WZ6m0G7JoeUKFYr8WRQaMz8Tujr10Vh2Wv.jpg', '2025-09-02 09:33:12', '2025-09-02 09:33:12', NULL),
(102, 28, 'images/anh_phu/pfugvXiizlwlvdlOqR2Uq8gIhGlTnkCJ6LqtaAFz.png', '2025-09-02 09:33:12', '2025-09-02 09:33:12', NULL),
(103, 29, 'images/anh_phu/8w79zOYOQdQ0EnvBxQ5Zq1LESXtx7ipgWILFFtlU.png', '2025-09-02 09:37:40', '2025-09-02 09:37:40', NULL),
(104, 29, 'images/anh_phu/pus0VNdviup194g1lygNDHaYFhNunQhGyBCnpCpf.png', '2025-09-02 09:37:40', '2025-09-02 09:37:40', NULL),
(105, 29, 'images/anh_phu/qjTWq3NeaVYkZFIYZMvHvtsl9oe5BazeuWRTWaYH.png', '2025-09-02 09:37:40', '2025-09-02 09:37:40', NULL),
(106, 29, 'images/anh_phu/Yfhr2pJbhuuHcCIzZAKsDZkV0mYuVU9h1a5Q2rmR.png', '2025-09-02 09:37:40', '2025-09-02 09:37:40', NULL),
(107, 29, 'images/anh_phu/yyVjFVxh6fD5mRVGuGiwYTeYSGTqjPHKPBCMb8ry.png', '2025-09-02 09:37:40', '2025-09-02 09:37:40', NULL),
(108, 29, 'images/anh_phu/YSqvtZurDhtKI5ookjicVnyz28sS7r1NtObwUuwN.png', '2025-09-02 09:37:40', '2025-09-02 09:37:40', NULL),
(109, 29, 'images/anh_phu/E3oD8WnLo9cjlqlwkdq2m1eJPqQI1s7sS6beKxSo.png', '2025-09-02 09:37:40', '2025-09-02 09:37:40', NULL),
(110, 30, 'images/anh_phu/Qr27lfB1RTSTjBqJxgq5fejXN7dLHFaR4qDbdWMi.jpg', '2025-09-02 09:40:57', '2025-09-02 09:40:57', NULL),
(111, 30, 'images/anh_phu/9HC3MLJDXBLgn9LuefU1G2bHHQFrecdEPvQJNyHW.jpg', '2025-09-02 09:40:57', '2025-09-02 09:40:57', NULL),
(112, 31, 'images/anh_phu/WHXiGB9r6VOSww5ArGjTP4gif9bBCpgtLwON2ExD.jpg', '2025-09-02 09:45:38', '2025-09-02 09:45:38', NULL),
(113, 31, 'images/anh_phu/7YSNo8vd8UI0VGOmxfrhZIV3PRWtMSwZIH2pah5e.jpg', '2025-09-02 09:45:38', '2025-09-02 09:45:38', NULL),
(114, 31, 'images/anh_phu/oCTw5H8ls61O3JoU140HdeWBJjHDrO5OsxeveJZs.jpg', '2025-09-02 09:45:38', '2025-09-02 09:45:38', NULL),
(115, 31, 'images/anh_phu/1MKFTrAMbtsdaBycRpQRyyzab9EZQXhXx8HTl0TB.jpg', '2025-09-02 09:45:38', '2025-09-02 09:45:38', NULL),
(116, 32, 'images/anh_phu/XkdtxDOskr6LDe1jqP3VXrtBoq2p21O5w159HkSS.png', '2025-09-02 10:12:19', '2025-09-02 10:12:19', NULL),
(117, 32, 'images/anh_phu/lq4MZ0aboXN1Eo0WZ1vyzuhsaSCV8jojj1MHSUtH.png', '2025-09-02 10:12:19', '2025-09-02 10:12:19', NULL),
(118, 32, 'images/anh_phu/t8uUGL7Y4WLcFremlk7wG1x9dQNWHTuqIyaj8YVS.png', '2025-09-02 10:12:19', '2025-09-02 10:12:19', NULL),
(119, 32, 'images/anh_phu/4g5NboKpSccJfsZXNz2vIUFMJvUY5fhSQAw0OTqC.png', '2025-09-02 10:12:19', '2025-09-02 10:12:19', NULL),
(120, 32, 'images/anh_phu/kzsFIUxIYuBNS6kb4uE3Cj6M3ZnWCkxdNXoc0EL6.png', '2025-09-02 10:12:19', '2025-09-02 10:12:19', NULL),
(121, 33, 'images/anh_phu/a9m4Cc50AWEUEb7Ebq1yO9vvyHUpH56NrDIE8OQf.png', '2025-09-02 10:16:19', '2025-09-02 10:16:19', NULL),
(122, 33, 'images/anh_phu/FJcg4HB6ee6glBQGBBsVeq10CbTQFy5TRFRT4q0K.png', '2025-09-02 10:16:19', '2025-09-02 10:16:19', NULL),
(123, 33, 'images/anh_phu/dad1lc5O0FTzsIM4YrGicfGLog2ukQy2ofZcON1S.png', '2025-09-02 10:16:19', '2025-09-02 10:16:19', NULL),
(124, 33, 'images/anh_phu/KKdYUy2NE1MRubFUJGqBL47JPTFu6XtVfWDayfGu.png', '2025-09-02 10:16:19', '2025-09-02 10:16:19', NULL),
(125, 33, 'images/anh_phu/Opu640WaiFoROk4fthqcqaTsA8NAeFlukwwyNH4B.png', '2025-09-02 10:16:19', '2025-09-02 10:16:19', NULL),
(126, 33, 'images/anh_phu/iGQ4yQDfuYbC0vcoxMHKdeI0BaIQ5ud66mbVeVrq.png', '2025-09-02 10:16:19', '2025-09-02 10:16:19', NULL),
(127, 34, 'images/anh_phu/1m2yT7q6FHWZtPMknhtyHXeXiGB6vNvRIoRnFRju.png', '2025-09-02 10:21:25', '2025-09-02 10:21:25', NULL),
(128, 34, 'images/anh_phu/Qr8utS9yvVHDWltiL5fFkXzgROBxh1XTuB5a3mwl.png', '2025-09-02 10:21:25', '2025-09-02 10:21:25', NULL),
(129, 34, 'images/anh_phu/ouoa0XWoolrrMKPQeIDgC1Edd7hgqv5kbxFtWsMe.png', '2025-09-02 10:21:25', '2025-09-02 10:21:25', NULL),
(130, 34, 'images/anh_phu/oaYUtvY61cXOL89lxM0pVYkfhWCmtG1qEPy4dCoB.png', '2025-09-02 10:21:25', '2025-09-02 10:21:25', NULL),
(131, 34, 'images/anh_phu/He5yjNs2b8r1cOUFmIlBmn8jBlxTmkqdPS8KS2Dz.png', '2025-09-02 10:21:26', '2025-09-02 10:21:26', NULL),
(132, 34, 'images/anh_phu/XI7lEWALafgGzCzU1o9bjVerZ5BMjvX1UivNWwt6.png', '2025-09-02 10:21:26', '2025-09-02 10:21:26', NULL),
(133, 34, 'images/anh_phu/h3Lij8MRhR4C34rujxFcSaKDczYyCPiilhlPpyA0.png', '2025-09-02 10:21:26', '2025-09-02 10:21:26', NULL),
(134, 35, 'images/anh_phu/gmqsvRPHE5xOJcmI96LJHCk6YHzLHHU2Yal47iYl.png', '2025-09-02 10:24:08', '2025-09-02 10:24:08', NULL),
(135, 35, 'images/anh_phu/tx1JBTQ0YQYJXsJRKQyyy2J2nSvXZloFDdqOBclA.png', '2025-09-02 10:24:08', '2025-09-02 10:24:08', NULL),
(136, 35, 'images/anh_phu/Imyd9a2iVLNUmlwLLwD6MSeRD5ArVv2cBw4ipRdM.png', '2025-09-02 10:24:08', '2025-09-02 10:24:08', NULL),
(137, 35, 'images/anh_phu/4RRCI4uMWQyLea8HQqNSzEeV7zjJb2uyJ25FYvwX.png', '2025-09-02 10:24:08', '2025-09-02 10:24:08', NULL),
(138, 35, 'images/anh_phu/2hXjepL6ve34aNr57sK6Oow2DJSsd39zb2wDT5ga.png', '2025-09-02 10:24:08', '2025-09-02 10:24:08', NULL),
(139, 36, 'images/anh_phu/dG6Nl6dwcnKpDUXU6dTls2TDr50iJDUGGT7GYBtw.png', '2025-09-02 10:30:06', '2025-09-02 10:30:06', NULL),
(140, 36, 'images/anh_phu/5F04yYFysjM8Kyof1oUPKrnuKtwW7filrqhwlyCx.png', '2025-09-02 10:30:06', '2025-09-02 10:30:06', NULL),
(141, 36, 'images/anh_phu/YywCP7FDrl6PN1bXyHajKFmPH5ctnpbta4AujRoB.png', '2025-09-02 10:30:06', '2025-09-02 10:30:06', NULL),
(142, 36, 'images/anh_phu/5ijPjDXAbYMYVKzfraPjMEbwOeykOdyrzDjovqJe.png', '2025-09-02 10:30:06', '2025-09-02 10:30:06', NULL),
(143, 36, 'images/anh_phu/QC977GHeRfhwbKv79ECdJp3y7vXjEWaqivJVyBgL.png', '2025-09-02 10:30:06', '2025-09-02 10:30:06', NULL),
(144, 36, 'images/anh_phu/fy8I4vVoFvSoGble7mWOs2IcHxwtrLSbvlwCtRtG.png', '2025-09-02 10:30:06', '2025-09-02 10:30:06', NULL),
(145, 37, 'images/anh_phu/Eo6XMG0sMA7qyG1SMDMO1JNvCT3PGlQ9nBHf2xKd.jpg', '2025-09-02 10:35:33', '2025-09-02 10:35:33', NULL),
(146, 37, 'images/anh_phu/JICWioMBC5EZ8OGQSbO0tgLaYYDLkFSKuSP5B4lc.jpg', '2025-09-02 10:35:33', '2025-09-02 10:35:33', NULL),
(147, 37, 'images/anh_phu/5vjVjb0g8scOYzTsgpUy3IvQCfrRdVVx9Olk0TAx.jpg', '2025-09-02 10:35:33', '2025-09-02 10:35:33', NULL),
(148, 37, 'images/anh_phu/GTDnrkHWB46LYvYen2ePMBPz7tQtx01WlMBQFUnr.jpg', '2025-09-02 10:35:33', '2025-09-02 10:35:33', NULL),
(149, 37, 'images/anh_phu/BKqbx0OV3GNf7veZIkpoll3wWsWIJaeSnpvtnWdy.jpg', '2025-09-02 10:35:33', '2025-09-02 10:35:33', NULL),
(150, 39, 'images/anh_phu/oOHc7gN892lJshXr5O7QXdozhFAWVFykDBbZZUfp.jpg', '2025-09-02 10:56:58', '2025-09-02 10:56:58', NULL),
(151, 39, 'images/anh_phu/XHTMWOaXRfwMuUNbusaFMQl76OKF2i4k37rLawct.jpg', '2025-09-02 10:56:58', '2025-09-02 10:56:58', NULL),
(152, 39, 'images/anh_phu/u8hC6xOZNAZglBZ0dIJdm0zymOz0Kusxd715opoH.jpg', '2025-09-02 10:56:58', '2025-09-02 10:56:58', NULL),
(153, 39, 'images/anh_phu/85chLrteNd6vXrDs9DmqhozlbHRPSzfVEoDYveez.jpg', '2025-09-02 10:56:58', '2025-09-02 10:56:58', NULL),
(154, 42, 'images/anh_phu/yGvJd2hpqOBRQUisizsjhLegTu7ojKeXMgyHIzCP.png', '2025-09-02 12:22:28', '2025-09-02 12:22:28', NULL),
(155, 45, 'images/anh_phu/Wjr6pnBfoPU1kbkldA5P2MG1to7a5lm617aLL97e.png', '2025-09-02 13:05:48', '2025-09-02 13:05:48', NULL),
(156, 45, 'images/anh_phu/NwXp44eHjIgmEpIVCRgGOBz8i2m9guGiPT0I1uAH.png', '2025-09-02 13:05:48', '2025-09-02 13:05:48', NULL),
(157, 45, 'images/JlVSmdrguZMicSSVxHexIWYAkLlxOm6ZjMw5Fw3L.png', '2025-09-02 13:06:08', '2025-09-02 13:06:08', NULL),
(158, 45, 'images/YiqzrmvhKBfc3UMtUaNwCmvBPI4kXgeZBTVQIFod.png', '2025-09-02 13:06:08', '2025-09-02 13:06:08', NULL),
(159, 46, 'images/anh_phu/jv2OUAe3Zj911RyjashXlfpkzk2xB6AeDLwjUJRU.jpg', '2025-09-02 13:09:51', '2025-09-02 13:09:51', NULL),
(160, 46, 'images/anh_phu/wmKqxdVK0ZIQBNFL9z35eY3ZaA1E4PoYyqaBqV6G.jpg', '2025-09-02 13:09:51', '2025-09-02 13:09:51', NULL),
(161, 46, 'images/anh_phu/5fvGBw0W7LnAkxi0QvTHrPmF0BPd9GlTSW6ZNhRc.png', '2025-09-02 13:09:51', '2025-09-02 13:09:51', NULL),
(162, 48, 'images/anh_phu/zHo76pLEhujoMBfI6NvyayQduIcgfo7kFkYOqi89.jpg', '2025-09-02 13:15:10', '2025-09-02 13:15:10', NULL),
(163, 48, 'images/anh_phu/9Xc5nGA02ScebmInp6WI2KRXR0UXb1uuGUVQoeOH.jpg', '2025-09-02 13:15:10', '2025-09-02 13:15:10', NULL),
(164, 48, 'images/anh_phu/aOhMExFWQlzsrmDIgrx3TZ4tfmwwWdBG7OuObQX2.jpg', '2025-09-02 13:15:10', '2025-09-02 13:15:10', NULL),
(165, 48, 'images/anh_phu/kU88X1GBZ3MtMIG9Zxu8U5rdWcX38n1r3uIVSfxl.jpg', '2025-09-02 13:15:10', '2025-09-02 13:15:10', NULL),
(166, 48, 'images/anh_phu/9ISZv8vTF5701Jlrac0DdFuBukOyss1g0jrqoBwH.jpg', '2025-09-02 13:15:10', '2025-09-02 13:15:10', NULL),
(167, 48, 'images/anh_phu/0wV6oM7vucGIZgV9SIVtSgoNteHurjtew1ggKpzl.jpg', '2025-09-02 13:15:10', '2025-09-02 13:15:10', NULL),
(168, 49, 'images/anh_phu/rJyZ4qZ2sqWUWQZDvTuBu9Iv6Uaa4g2ztB02BVeG.png', '2025-09-02 13:17:05', '2025-09-02 13:17:05', NULL),
(169, 49, 'images/anh_phu/F0jFTDY3jf7vTM4MRbYEKMbnmNIair4kq3rlmUce.png', '2025-09-02 13:17:05', '2025-09-02 13:17:05', NULL),
(170, 49, 'images/anh_phu/47VSUQeAokxkMviniXzPEMW6hou4tfOw3Fz8cY71.png', '2025-09-02 13:17:05', '2025-09-02 13:17:05', NULL),
(171, 49, 'images/anh_phu/7Z6xS4dqm9u7wqqPLtEvEGEbcK7CHnJg3RWaAghL.png', '2025-09-02 13:17:05', '2025-09-02 13:17:05', NULL),
(172, 49, 'images/anh_phu/9oGT9NU1pjZf8EV3oCBQ0JeRH13yMIG9UWRyHeN6.png', '2025-09-02 13:17:05', '2025-09-02 13:17:05', NULL),
(173, 50, 'images/anh_phu/jdWgZlB2DHSZBmZZEvJavFnz0W53X9B6lhGV1utc.png', '2025-09-02 13:18:36', '2025-09-02 13:18:36', NULL),
(174, 50, 'images/anh_phu/OznMclP9IFFrPjTQ4zxR4PEXYf37rh3FGWIhjtu5.png', '2025-09-02 13:18:36', '2025-09-02 13:18:36', NULL),
(175, 50, 'images/anh_phu/nW2I6Lc5JkJizc5Xiv62DuN6equ0Qjm7RqLarchK.png', '2025-09-02 13:18:36', '2025-09-02 13:18:36', NULL),
(176, 50, 'images/anh_phu/Wa5aZEYFvhcX2I3X56kTvaBjYZuKIt3kyH3kjXCg.png', '2025-09-02 13:18:36', '2025-09-02 13:18:36', NULL),
(177, 51, 'images/anh_phu/E7i6Malbd74DA9SgRSIzGbnHFxUdFk3tKHqqILwj.png', '2025-09-02 13:20:48', '2025-09-02 13:20:48', NULL),
(178, 51, 'images/anh_phu/fUuqXRf2hu34RsoFYohjVf5FW9wSQdN2pN3OgPA6.png', '2025-09-02 13:20:48', '2025-09-02 13:20:48', NULL),
(179, 51, 'images/anh_phu/yhwd1p7iZhxSYQZAyYHA8qFZkkByVJvByCl6uJlQ.png', '2025-09-02 13:20:48', '2025-09-02 13:20:48', NULL),
(180, 52, 'images/anh_phu/yb9g130GsHUxzZLec2n0UlZ4SNDmCBThwn0vtG6B.png', '2025-09-03 03:09:06', '2025-09-03 03:09:06', NULL),
(181, 53, 'images/anh_phu/cE1VrWMyymeaxcRnEdEcqVCHS3WDkoaINu7KfQcT.png', '2025-09-03 03:16:16', '2025-09-03 03:16:16', NULL),
(182, 54, 'images/anh_phu/FelmaQcguFGHM25j7NUn84c03veCrc5bBgk8QjSV.png', '2025-09-03 03:26:59', '2025-09-03 03:26:59', NULL),
(183, 55, 'images/anh_phu/7SDLOw1uv2neeJhMkqGPIwehoRqO3RuwvwKizGc0.png', '2025-09-03 03:46:37', '2025-09-03 03:46:37', NULL),
(184, 56, 'images/anh_phu/TKbQVkAdMqaWuFRtOcjmloY9WCORC1c7WubGjc1f.png', '2025-09-04 00:48:45', '2025-09-04 00:48:45', NULL),
(185, 57, 'images/anh_phu/VKMDiEXs7foztKePP0BROFc2rVdilMUyJE1toYla.jpg', '2025-09-04 00:52:11', '2025-09-04 00:52:11', NULL),
(186, 58, 'images/anh_phu/3f43yknkWqCXbf5k9ipMYpbKNmXWMTRoxxjcTOYp.png', '2025-09-04 00:53:55', '2025-09-04 00:53:55', NULL),
(187, 58, 'images/anh_phu/43OT9gksXSv6y4qFKrqXqQPJY94iQA2R8HuwkOZG.png', '2025-09-04 00:53:55', '2025-09-04 00:53:55', NULL),
(188, 58, 'images/anh_phu/21AugZSIFJ1XW3bxrn7lXa1OLg0XnaUON8vGa3et.png', '2025-09-04 00:53:55', '2025-09-04 00:53:55', NULL),
(189, 59, 'images/anh_phu/orDjhS7oIprKdS6di3SMMgZfM4xGo1GNI8YNel1N.png', '2025-09-04 00:56:55', '2025-09-04 00:56:55', NULL),
(190, 59, 'images/anh_phu/gQnwGScJCyMG719MzpBamxqACg6CNaWD5AUYZQZd.png', '2025-09-04 00:56:55', '2025-09-04 00:56:55', NULL),
(191, 59, 'images/anh_phu/wVYFIWtdwqICN3VEPUZCL3vKUNPMELv7To6lhSry.png', '2025-09-04 00:56:55', '2025-09-04 00:56:55', NULL),
(192, 59, 'images/anh_phu/Ya7BsOzUGAyeXBgtvqAGcbO1YWqBkWtPCtRBspDy.png', '2025-09-04 00:56:55', '2025-09-04 00:56:55', NULL),
(193, 60, 'images/anh_phu/2PWqiPAATA99N5eVfS53MpHgLITRm2S4BOZp6wic.png', '2025-09-04 00:58:43', '2025-09-04 00:58:43', NULL),
(194, 60, 'images/anh_phu/hVOq50x0N5QVjxJUln4cDqeWMqlcN0LVlesOn8tc.png', '2025-09-04 00:58:43', '2025-09-04 00:58:43', NULL),
(195, 60, 'images/anh_phu/5N27N7kHocNjNxts16PKiX7c5Sqrh8IwXMstJh8C.png', '2025-09-04 00:58:43', '2025-09-04 00:58:43', NULL),
(196, 61, 'images/anh_phu/oVXE9NYPCkRweSnQBrLtQ3umCF0NF6qL7Xhs4Vc6.png', '2025-09-04 01:08:24', '2025-09-04 01:08:24', NULL),
(197, 61, 'images/anh_phu/mdihsXglmKkoPFCxajHUDk13YzL6U5hKAaNtCeDv.png', '2025-09-04 01:08:24', '2025-09-04 01:08:24', NULL),
(198, 61, 'images/anh_phu/yXVDSKKbfuPqYgdnOXwg5D5Ya9rt1bXE5ybU2Xfy.png', '2025-09-04 01:08:24', '2025-09-04 01:08:24', NULL),
(199, 62, 'images/anh_phu/7SSMilhNLt29Vexfsu5JHM7zblXWkJaIEn3BIVyW.png', '2025-09-04 01:09:51', '2025-09-04 01:09:51', NULL),
(200, 62, 'images/anh_phu/IyrEYwNVv5Ue9d3DgdQCrEMHYul6Oa98GYyeu55s.png', '2025-09-04 01:09:51', '2025-09-04 01:09:51', NULL),
(201, 62, 'images/anh_phu/1SENbji4j4o7SB8ViA2Lxp9U8ufitZcU7if9fl8J.png', '2025-09-04 01:09:51', '2025-09-04 01:09:51', NULL),
(202, 64, 'images/anh_phu/geddYw2sDYrvCG9KoQ2SizQ1HSiWvZLceEC1EtNx.jpg', '2025-09-04 01:16:48', '2025-09-04 01:16:48', NULL),
(203, 64, 'images/anh_phu/MY1LAdSHWfcjfPs7QDYsQ5aqpcxGN6xnlx2ZhEAi.jpg', '2025-09-04 01:16:48', '2025-09-04 01:16:48', NULL),
(204, 65, 'images/anh_phu/VeRU78CLMZdCRFw2Ni8Hr95RfcIx4VleU79zrjAI.png', '2025-09-04 01:18:08', '2025-09-04 01:18:08', NULL),
(205, 65, 'images/anh_phu/uhSly7ATn11zZgHjWUx9PGJFrZKmB77roaxvtLDA.png', '2025-09-04 01:18:08', '2025-09-04 01:18:08', NULL),
(206, 68, 'images/anh_phu/e0cObtCdf2rNQD2daAizgMYnvyLT44f1d033QKy5.png', '2025-09-04 02:37:00', '2025-09-04 02:37:00', NULL),
(207, 68, 'images/anh_phu/cQBldZgFXB9WdKWiahtX26TO7TV9c7jtKCyOcq2K.png', '2025-09-04 02:37:00', '2025-09-04 02:37:00', NULL),
(208, 68, 'images/anh_phu/pfebKuoc7GffUnghU1Nw6UR9O54vfXUqpetdKMNq.png', '2025-09-04 02:37:00', '2025-09-04 02:37:00', NULL),
(209, 69, 'images/anh_phu/5qXDb7VAocnKtYHnNmEMfaKo0EXwJHTmanSPpXmw.png', '2025-09-04 02:38:16', '2025-09-04 02:38:16', NULL),
(210, 69, 'images/anh_phu/UG45iQkPvAWoR7Aef01wRz2RiYjLhPBfuwFyXbwD.png', '2025-09-04 02:38:16', '2025-09-04 02:38:16', NULL),
(211, 70, 'images/anh_phu/xLJN3J9tUPHUbGXjvM9JcffD32YGQETSObmfUWeu.png', '2025-09-04 02:39:43', '2025-09-04 02:39:43', NULL),
(212, 70, 'images/anh_phu/NedJTy60owXNZewt0UbWBZjdI2j268ELap9L6BcH.png', '2025-09-04 02:39:43', '2025-09-04 02:39:43', NULL),
(213, 71, 'images/anh_phu/zekPWvtWb03TwNKh33BjAnTL04mCt7puCEqh4dNE.png', '2025-09-04 02:41:26', '2025-09-04 02:41:26', NULL),
(214, 71, 'images/anh_phu/MYP0jANyXPJirOxRL8wA84w00gdylN0Dtg2i9Se4.png', '2025-09-04 02:41:26', '2025-09-04 02:41:26', NULL),
(215, 72, 'images/anh_phu/PYP3Qd9FRkCfByllUKB1wKzyUX3SaIcd0elWizuy.png', '2025-09-04 02:42:47', '2025-09-04 02:42:47', NULL),
(216, 72, 'images/anh_phu/GTffQqduk5Fioor0cikk6CHk7nu8wQWEFtkOZCXH.png', '2025-09-04 02:42:47', '2025-09-04 02:42:47', NULL),
(217, 73, 'images/anh_phu/wHkximCXkdLKtJX6qvDLUbeQfIXJWtQs7pmJgisS.png', '2025-09-04 02:44:10', '2025-09-04 02:44:10', NULL),
(218, 73, 'images/anh_phu/aPWS7WM8gEH9ZBaiAVXSvVTNSon15HmbuXWeon3W.png', '2025-09-04 02:44:10', '2025-09-04 02:44:10', NULL),
(219, 74, 'images/anh_phu/2yVRC5RdIB3FyHdrvIwtQbHEkJYRWFfIUwBXvPxl.jpg', '2025-09-04 02:45:35', '2025-09-04 02:45:35', NULL),
(220, 75, 'images/anh_phu/mG3waPm67dxlz69vdqPzSjc6SCoIC81pjU420q1Y.jpg', '2025-09-04 02:48:25', '2025-09-04 02:48:25', NULL),
(221, 75, 'images/anh_phu/TKOv6eGtSpUyRxK9Duj8MTiK9QBbESYq2AnZMSJ8.jpg', '2025-09-04 02:48:25', '2025-09-04 02:48:25', NULL),
(222, 75, 'images/anh_phu/4CicV430bSL9FVANnx4aNkmYV7IEMEWifZ1pCSMc.jpg', '2025-09-04 02:48:25', '2025-09-04 02:48:25', NULL),
(223, 75, 'images/anh_phu/oaD2jF5cw6PFbO6bI9CppOu7RMYhdaPXu6XB9jPt.jpg', '2025-09-04 02:48:25', '2025-09-04 02:48:25', NULL),
(224, 77, 'images/anh_phu/uiEaij4QsZsbUFX0XdnLOCINM62siSwGQpclKNMo.jpg', '2025-09-04 14:12:01', '2025-09-04 14:12:01', NULL),
(225, 78, 'images/anh_phu/jkpKD2Zqb7xvtw3KhEIaPvFGM5daNLHZiJE6L5Ot.jpg', '2025-09-04 14:25:11', '2025-09-04 14:25:11', NULL),
(226, 79, 'images/UfFuvk83EkAHt1sNk4L6utN9tm8oLLAZthtkhIP2.jpg', '2025-09-04 14:46:36', '2025-09-04 14:46:36', NULL),
(227, 79, 'images/U3rkGvcCX6xyOL14CuIkFEcIzLaaQOI8rpGa7q2A.jpg', '2025-09-04 14:46:36', '2025-09-04 14:46:36', NULL),
(228, 79, 'images/wHqNNLLz3HbhARt7ijDRuQHmtGslfsfKjVuMBwFK.jpg', '2025-09-04 14:46:36', '2025-09-04 14:46:36', NULL),
(229, 79, 'images/TTPw7IqURgQ6XyMv8sOXvN1lhdggM9rkZnjWLLkR.jpg', '2025-09-04 14:46:36', '2025-09-04 14:46:36', NULL),
(230, 79, 'images/406ETRWnl0MwCe9qK9CKJSMdpLtyL6sHzpT6Aykl.jpg', '2025-09-04 14:46:36', '2025-09-04 14:46:36', NULL),
(231, 79, 'images/daC8JXyIEdM0ZH8BO4kDEkrqomAfXbHgO850fQea.jpg', '2025-09-04 14:46:36', '2025-09-04 14:46:36', NULL);

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
(1, 'ẢNH 1', 'banners/FXm4oZ3Z8J8UXWSSPuUvUDdOG0v7Kni5pJNPrAXz.png', '25.00', NULL, '2025-08-20 13:20:34', '2025-08-20 13:20:34', NULL),
(2, 'Ảnh 2', 'banners/SQhFVz6EwXxDXKxG45eCC2sYJek9egDFXGKatS30.jpg', '25.00', NULL, '2025-08-21 01:21:32', '2025-08-21 01:21:32', NULL),
(3, 'Ảnh 3', 'banners/G83rA8n0BNHPKz2vOb5PNNV1bHTRyShShzt7lxTP.jpg', '25.00', NULL, '2025-08-21 01:21:52', '2025-08-21 01:21:52', NULL),
(4, 'Ảnh 4', 'banners/MQ8rsKib4bhsjXgJpo5MQrNIl5Mtk7gYpkFdHfb8.jpg', '25.00', NULL, '2025-08-21 01:22:11', '2025-08-21 01:22:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bien_the_san_phams`
--

CREATE TABLE `bien_the_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `id_ram` bigint UNSIGNED NOT NULL,
  `id_o_cung` bigint UNSIGNED NOT NULL,
  `gia` decimal(15,2) NOT NULL,
  `gia_so_sanh` decimal(15,2) NOT NULL,
  `ton_kho` int NOT NULL DEFAULT '0',
  `ma_bien_the` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anh_dai_dien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bien_the_san_phams`
--

INSERT INTO `bien_the_san_phams` (`id`, `id_product`, `id_ram`, `id_o_cung`, `gia`, `gia_so_sanh`, `ton_kho`, `ma_bien_the`, `anh_dai_dien`, `hoat_dong`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 1, 1, '26120000.00', '35120000.00', 14, 'BT6749', NULL, 1, '2025-08-20 00:54:58', '2025-09-04 15:12:58', NULL),
(2, 5, 2, 1, '27020000.00', '37120000.00', 37, 'BT2216', NULL, 1, '2025-08-20 00:54:58', '2025-09-04 01:00:11', NULL),
(3, 6, 1, 1, '35430000.00', '45430000.00', 28, 'BT4883', NULL, 1, '2025-08-20 08:19:25', '2025-09-09 09:21:11', NULL),
(4, 6, 1, 2, '36920000.00', '47430000.00', 17, 'BT9026', NULL, 1, '2025-08-20 08:19:25', '2025-09-04 01:01:05', NULL),
(5, 7, 4, 1, '38530000.00', '40530000.00', 11, 'BT5762', NULL, 1, '2025-08-21 02:44:11', '2025-08-27 02:10:33', NULL),
(6, 8, 1, 1, '14730000.00', '16730000.00', 35, 'BT6740', NULL, 1, '2025-08-21 03:02:14', '2025-09-04 01:02:12', NULL),
(7, 9, 4, 1, '28330000.00', '30330000.00', 12, 'BT6994', NULL, 1, '2025-08-21 03:07:30', '2025-08-21 03:07:30', NULL),
(8, 10, 1, 1, '24220000.00', '26120000.00', 12, 'BT4086', NULL, 1, '2025-08-21 03:10:54', '2025-08-21 03:10:54', NULL),
(9, 10, 2, 1, '23220000.00', '25220000.00', 12, 'BT9576', NULL, 1, '2025-08-21 03:10:54', '2025-08-21 03:10:54', NULL),
(10, 11, 5, 1, '199720000.00', '209320000.00', 15, 'BT9992', NULL, 1, '2025-08-21 03:20:43', '2025-09-04 01:11:09', NULL),
(11, 11, 5, 4, '182990000.00', '211110000.00', 13, 'BT6250', NULL, 1, '2025-08-21 03:20:43', '2025-09-04 01:11:09', NULL),
(12, 20, 1, 1, '22120000.00', '26120000.00', 5, 'BT4314', NULL, 1, '2025-08-23 15:33:27', '2025-08-23 15:33:27', NULL),
(13, 21, 1, 1, '22610000.00', '26610000.00', 99, 'BT2848', NULL, 1, '2025-08-23 15:56:39', '2025-08-23 15:56:39', NULL),
(14, 21, 1, 2, '25610000.00', '27610000.00', 99, 'BT3673', NULL, 1, '2025-08-23 15:56:39', '2025-08-23 15:56:39', NULL),
(15, 52, 4, 1, '36930000.00', '38330000.00', 20, 'BT8956', NULL, 1, '2025-09-03 03:09:06', '2025-09-04 01:06:59', NULL),
(16, 53, 4, 1, '37630000.00', '38730000.00', 46, 'BT9452', NULL, 1, '2025-09-03 03:16:16', '2025-09-04 01:06:46', NULL),
(17, 54, 4, 1, '42730000.00', '44730000.00', 33, 'BT1511', NULL, 1, '2025-09-03 03:26:59', '2025-09-04 14:14:06', NULL),
(18, 55, 4, 4, '49230000.00', '53230000.00', 39, 'BT1523', NULL, 1, '2025-09-03 03:46:37', '2025-09-16 03:19:18', NULL),
(19, 76, 1, 1, '9508000.00', '10528000.00', 34, 'BT1777', NULL, 1, '2025-09-04 13:58:01', '2025-09-04 14:07:20', '2025-09-04 14:07:20'),
(20, 76, 2, 1, '6280000.00', '7990000.00', 23, 'BT8264', NULL, 1, '2025-09-04 13:58:01', '2025-09-04 14:07:20', '2025-09-04 14:07:20'),
(21, 76, 1, 1, '9818000.00', '11818000.00', 33, 'BT615456', NULL, 1, '2025-09-04 14:07:20', '2025-09-04 15:01:43', NULL),
(22, 76, 2, 1, '8818000.00', '10818000.00', 35, 'BT098455', NULL, 1, '2025-09-04 14:07:20', '2025-09-04 14:07:20', NULL),
(23, 77, 1, 1, '10658000.00', '12658000.00', 33, 'BT9534', NULL, 1, '2025-09-04 14:12:01', '2025-09-05 03:21:48', NULL),
(24, 77, 1, 5, '8658000.00', '11868000.00', 45, 'BT6409', NULL, 1, '2025-09-04 14:12:01', '2025-09-04 14:12:01', NULL),
(25, 77, 2, 1, '7658000.00', '10658000.00', 23, 'BT0802', NULL, 1, '2025-09-04 14:12:01', '2025-09-04 14:12:01', NULL),
(26, 77, 2, 5, '6658000.00', '8868000.00', 56, 'BT1923', NULL, 1, '2025-09-04 14:12:01', '2025-09-04 14:12:01', NULL),
(27, 78, 1, 1, '11700000.00', '15700000.00', 33, 'BT5903', NULL, 1, '2025-09-04 14:25:11', '2025-09-05 04:19:04', NULL),
(28, 78, 1, 5, '10700000.00', '13910000.00', 34, 'BT2574', NULL, 1, '2025-09-04 14:25:11', '2025-09-04 14:25:11', NULL),
(29, 78, 2, 1, '8700000.00', '10700000.00', 54, 'BT6973', NULL, 1, '2025-09-04 14:25:11', '2025-09-04 14:25:11', NULL),
(30, 78, 2, 5, '7700000.00', '12420000.00', 23, 'BT8123', NULL, 1, '2025-09-04 14:25:11', '2025-09-04 14:25:11', NULL),
(31, 79, 4, 3, '199530000.00', '233530000.00', 5, 'BT9689', NULL, 1, '2025-09-04 14:46:18', '2025-09-16 14:21:12', NULL),
(32, 80, 4, 3, '75990000.00', '105529000.00', 21, 'BT6592', NULL, 1, '2025-09-04 15:08:30', '2025-09-05 03:49:42', NULL),
(33, 80, 2, 3, '75990000.00', '105529000.00', 10, 'BT063940', NULL, 1, '2025-09-05 04:37:21', '2025-09-05 05:01:31', NULL);

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
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `gia_sale` decimal(10,2) DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `ten`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vỏ máy tính Xigmatek QUANTUM 3GF', '1190000.00', '990000.00', NULL, '2025-08-20 00:49:45', '2025-08-20 00:49:45', NULL),
(2, 'Vỏ máy tính Xigmatek QUANTUM ARCTIC 3GF', '1290000.00', '1090000.00', NULL, '2025-08-20 00:50:11', '2025-08-20 00:50:11', NULL),
(3, 'Vỏ máy tính MSI MAG PANO M100R PZ WHITE', '2990000.00', NULL, NULL, '2025-08-20 08:14:02', '2025-08-20 08:14:02', NULL),
(4, 'Vỏ máy tính Cooler Master CD600 Black', '1990000.00', '1390000.00', NULL, '2025-08-21 02:37:51', '2025-08-21 02:37:51', NULL),
(5, 'Vỏ máy tính MSI MEG MAESTRO 700L PZ', '11990000.00', NULL, NULL, '2025-08-21 03:15:01', '2025-08-21 03:15:01', NULL),
(6, 'Vỏ case XIGMATEK XA-22 (ATX) EN47567', '350000.00', '309000.00', NULL, '2025-09-04 13:49:21', '2025-09-04 13:49:21', NULL),
(7, 'Vỏ máy tính HYTE Y70 Touch Black/ White', '12290000.00', NULL, NULL, '2025-09-04 14:37:47', '2025-09-04 14:37:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_histories`
--

CREATE TABLE `chat_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bot_reply` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_histories`
--

INSERT INTO `chat_histories` (`id`, `user_id`, `user_message`, `bot_reply`, `created_at`, `updated_at`) VALUES
(1, 1, '1=1 là đúng ko', 'Không tìm thấy sản phẩm phù hợp. Bạn có muốn thử các yêu cầu khác không?', '2025-09-05 05:19:14', '2025-09-05 05:19:14'),
(2, 1, 'tôi muốn mua pc laptop', 'Không tìm thấy sản phẩm phù hợp. Bạn có muốn thử các yêu cầu khác không?', '2025-09-05 05:19:24', '2025-09-05 05:19:24'),
(3, 1, 'Tôi muốn mua PC mạnh', 'Không tìm thấy sản phẩm phù hợp. Bạn có muốn thử các yêu cầu khác không?', '2025-09-05 05:19:33', '2025-09-05 05:19:33'),
(4, 7, 'tôi muốn mua 1 PC gaming', 'Bạn đang tìm kiếm một chiếc PC gaming, đúng không?\n\nDựa trên yêu cầu của bạn, tôi đã tìm thấy các sản phẩm phù hợp sau:\n\n<div class=\"product-list\">\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://datn.com:8080/storage/images/kZVqAcWL4TS5r1f8D0zKVg0VGIwPEqq1Gb46PlLw.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 5060\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 5060\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/7\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://datn.com:8080/storage/images/GOBnK7AduwPHPDBdnybFuYVp85OqTClVbRigOfSI.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 4060\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 4060\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/53\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://datn.com:8080/storage/images/ArXHqauGpckej6Edu10Xuxb9YeZsNGe4OMoiTdJg.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 5060Ti\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 5060Ti\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/54\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://datn.com:8080/storage/images/84OcV3KVpKNWtkC7Y1giHPD2nyemndx50L7SqNzD.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 4070 Super\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 4070 Super\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/55\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://datn.com:8080/storage/images/Y8zoQqS7u8G5SDXxLToywOkU8SAHyZkitm9blyzM.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/79\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://datn.com:8080/storage/images/gN37reOnODSjBkhGZvKAVJHNW4q7iMiNFrNLVTSY.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/80\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n</div>\n\nHãy chọn sản phẩm phù hợp với nhu cầu của bạn bằng cách click vào nút \"Xem chi tiết\"!', '2025-09-16 14:38:24', '2025-09-16 14:38:24'),
(5, 7, 'tôi muốn mua 1 PC gaming', 'Để tìm các sản phẩm phù hợp với yêu cầu \"tôi muốn mua 1 PC gaming\" của bạn, tôi sẽ phân tích và hiển thị danh sách các sản phẩm thuộc danh mục \"PC GAMING\" từ dữ liệu đã cung cấp.\n\nDưới đây là danh sách sản phẩm mà bạn có thể quan tâm:\n\n<div class=\"product-list\">\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://localhost:8000/storage/app/public/images/kZVqAcWL4TS5r1f8D0zKVg0VGIwPEqq1Gb46PlLw.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 5060\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 5060\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/7\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://localhost:8000/storage/app/public/images/BSZybqznBaTcR4I6xYYePb6O0QUHmr1psGJ3ggJ5.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN INT x MSI Dragon GODLIKE (Intel Core Ultra 9 285K/ VGA RTX 5090) (Powered by MSI)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN INT x MSI Dragon GODLIKE (Intel Core Ultra 9 285K/ VGA RTX 5090) (Powered by MSI)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/11\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://localhost:8000/storage/app/public/images/GOBnK7AduwPHPDBdnybFuYVp85OqTClVbRigOfSI.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 4060\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 4060\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/53\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://localhost:8000/storage/app/public/images/ArXHqauGpckej6Edu10Xuxb9YeZsNGe4OMoiTdJg.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 5060Ti\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 5060Ti\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/54\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://localhost:8000/storage/app/public/images/84OcV3KVpKNWtkC7Y1giHPD2nyemndx50L7SqNzD.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 4070 Super\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 4070 Super\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/55\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://localhost:8000/storage/app/public/images/Y8zoQqS7u8G5SDXxLToywOkU8SAHyZkitm9blyzM.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/79\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://localhost:8000/storage/app/public/images/gN37reOnODSjBkhGZvKAVJHNW4q7iMiNFrNLVTSY.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/80\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n</div>\n\nHãy truy cập vào các liên kết trên để xem chi tiết và lựa chọn mẫu sản phẩm phù hợp cho bạn!', '2025-09-16 14:42:14', '2025-09-16 14:42:14'),
(6, 7, 'tôi muốn mua 1 PC gaming', 'Bạn muốn mua một PC gaming, đúng không? Dựa trên yêu cầu của bạn, tôi đã tìm thấy các sản phẩm PC gaming phù hợp dưới đây:\n\n<div class=\"product-list\">\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://127.0.0.1:8000/storage/app/public/images/WtjAM9GUY55RWILyxd7LTgaefndodHh52rQ6yH43.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/6\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://127.0.0.1:8000/storage/app/public/images/kZVqAcWL4TS5r1f8D0zKVg0VGIwPEqq1Gb46PlLw.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 5060\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 5060\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/7\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://127.0.0.1:8000/storage/app/public/images/BSZybqznBaTcR4I6xYYePb6O0QUHmr1psGJ3ggJ5.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN INT x MSI Dragon GODLIKE (Intel Core Ultra 9 285K/ VGA RTX 5090) (Powered by MSI)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN INT x MSI Dragon GODLIKE (Intel Core Ultra 9 285K/ VGA RTX 5090) (Powered by MSI)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/11\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://127.0.0.1:8000/storage/app/public/images/GOBnK7AduwPHPDBdnybFuYVp85OqTClVbRigOfSI.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 4060\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 4060\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/53\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://127.0.0.1:8000/storage/app/public/images/ArXHqauGpckej6Edu10Xuxb9YeZsNGe4OMoiTdJg.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 5060Ti\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 5060Ti\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/54\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://127.0.0.1:8000/storage/app/public/images/84OcV3KVpKNWtkC7Y1giHPD2nyemndx50L7SqNzD.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/ VGA RTX 4070 Super\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/ VGA RTX 4070 Super\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/55\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://127.0.0.1:8000/storage/app/public/images/Y8zoQqS7u8G5SDXxLToywOkU8SAHyZkitm9blyzM.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/79\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http://127.0.0.1:8000/storage/app/public/images/gN37reOnODSjBkhGZvKAVJHNW4q7iMiNFrNLVTSY.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/80\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n</div>\n\nHãy chọn sản phẩm phù hợp với nhu cầu của bạn và xem chi tiết trên liên kết mà tôi đã cung cấp. Nếu bạn cần thêm sự hỗ trợ, vui lòng cho tôi biết!', '2025-09-16 14:45:28', '2025-09-16 14:45:28'),
(7, 7, 'tôi muốn mua 1 PC gaming', 'Bạn muốn mua một PC gaming? Dưới đây là một số sản phẩm PC gaming mà chúng tôi có:\n\n<div class=\"product-list\">\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http:8000/storage/app/public/images/WtjAM9GUY55RWILyxd7LTgaefndodHh52rQ6yH43.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/VGA RTX 5060)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/VGA RTX 5060)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/6\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http:8000/storage/app/public/images/kZVqAcWL4TS5r1f8D0zKVg0VGIwPEqq1Gb46PlLw.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/VGA RTX 5060\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/VGA RTX 5060\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/7\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http:8000/storage/app/public/images/BSZybqznBaTcR4I6xYYePb6O0QUHmr1psGJ3ggJ5.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN INT x MSI Dragon GODLIKE (Intel Core Ultra 9 285K/VGA RTX 5090) (Powered by MSI)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN INT x MSI Dragon GODLIKE (Intel Core Ultra 9 285K/VGA RTX 5090) (Powered by MSI)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/11\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http:8000/storage/app/public/images/GOBnK7AduwPHPDBdnybFuYVp85OqTClVbRigOfSI.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/VGA RTX 4060\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/VGA RTX 4060\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/53\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http:8000/storage/app/public/images/ArXHqauGpckej6Edu10Xuxb9YeZsNGe4OMoiTdJg.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/VGA RTX 5060Ti\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/VGA RTX 5060Ti\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/54\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http:8000/storage/app/public/images/84OcV3KVpKNWtkC7Y1giHPD2nyemndx50L7SqNzD.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC GVN Intel i7-14700F/VGA RTX 4070 Super\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC GVN Intel i7-14700F/VGA RTX 4070 Super\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/55\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http:8000/storage/app/public/images/Y8zoQqS7u8G5SDXxLToywOkU8SAHyZkitm9blyzM.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/79\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n  <div class=\"product-card border rounded p-3 mb-3 shadow-sm bg-white\">\n    <div class=\"d-flex align-items-center\">\n      <!-- Ảnh sản phẩm -->\n      <div class=\"flex-shrink-0 me-3\">\n        <img src=\"http:8000/storage/app/public/images/gN37reOnODSjBkhGZvKAVJHNW4q7iMiNFrNLVTSY.jpg\" \n             class=\"rounded\" \n             style=\"width: 120px; height: auto; object-fit: cover;\" \n             alt=\"PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)\">\n      </div>\n      <!-- Nội dung -->\n      <div class=\"flex-grow-1\">\n        <p class=\"fw-semibold mb-2 text-dark\">\n          PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)\n        </p>\n        <!-- Nút -->\n        <a href=\"/sanpham/80\" class=\"btn btn-danger btn-sm rounded-pill px-3\">\n          Xem chi tiết\n        </a>\n      </div>\n    </div>\n  </div>\n</div>', '2025-09-16 14:49:15', '2025-09-16 14:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `chips`
--

CREATE TABLE `chips` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(12,2) DEFAULT NULL,
  `gia_sale` decimal(12,2) DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chips`
--

INSERT INTO `chips` (`id`, `ten`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bộ vi xử lý Intel Core i5 12400F', '5490000.00', '3190000.00', NULL, '2025-08-20 00:45:07', '2025-08-20 00:45:07', NULL),
(2, 'Bộ vi xử lý Intel Core i5 14400F', '6300000.00', '3890000.00', NULL, '2025-08-20 08:11:41', '2025-08-20 08:11:41', NULL),
(3, 'Bộ vi xử lý Intel Core i7 14700F', '11400000.00', '8490000.00', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Socket</strong></td>\r\n<td>FCLGA1700</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>D&ograve;ng CPU</strong></td>\r\n<td>Core i7</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>CPU</strong></td>\r\n<td>Intel&reg; Core&reg; i7-14700F (Raptor Lake)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Số nh&acirc;n</strong></td>\r\n<td>20 (8 Performance-cores/12 Efficient-cores)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Số luồng</strong></td>\r\n<td>28</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tần số Turbo tối đa</strong></td>\r\n<td>--</td>\r\n</tr>\r\n<tr>\r\n<td><strong>C&ocirc;ng nghệ Intel Turbo Boost Max Tần số 3.0</strong></td>\r\n<td>5.4GHz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tốc độ Turbo tối đa của P-core</strong></td>\r\n<td>5.3 GHz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tốc độ&nbsp;Turbo tối đa của E-core&nbsp;</strong></td>\r\n<td>4.2 GHz</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tốc độ cơ bản của P-core</strong></td>\r\n<td>2.1 GHz</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tốc độ cơ bản của E-core</strong></td>\r\n<td>1.5 GHz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Điện năng ti&ecirc;u thụ</strong></td>\r\n<td>65W - 219W</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bộ nhớ đệm</strong></td>\r\n<td>33MB Intel&reg; Smart Cache</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bo mạch chủ tương th&iacute;ch</strong></td>\r\n<td>600 v&agrave; 700 series</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bộ nhớ hỗ trợ tối đa</strong></td>\r\n<td>192GB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Loại bộ nhớ</strong></td>\r\n<td>DDR5, DDR4</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Nh&acirc;n đồ họa t&iacute;ch hợp</strong></td>\r\n<td>Kh&ocirc;ng</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Phi&ecirc;n bản&nbsp;PCI Express</strong></td>\r\n<td>5.0 and 4.0</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Số lượng PCIe lanes</strong></td>\r\n<td>20</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '2025-08-21 02:29:07', '2025-08-21 02:29:07', NULL),
(4, 'Bộ vi xử lý Intel Core i3 12100F', '2290000.00', '2090000.00', NULL, '2025-08-21 02:57:38', '2025-08-21 02:57:38', NULL),
(5, 'Bộ vi xử lý Intel Core Ultra 9 285K', '17490000.00', NULL, NULL, '2025-08-21 03:12:42', '2025-08-21 03:12:42', NULL),
(6, 'Bộ vi xử lý Intel Core i7 14700F T', NULL, '8490000.00', NULL, '2025-09-03 03:21:12', '2025-09-03 03:21:24', '2025-09-03 03:21:24'),
(7, 'CPU Intel Core i3 10105', '2699000.00', '3299000.00', NULL, '2025-09-04 13:46:51', '2025-09-04 13:46:51', NULL),
(8, 'CPU AMD Ryzen 9 9950X3D', '22990000.00', '20990000.00', NULL, '2025-09-04 14:26:42', '2025-09-04 14:26:42', NULL),
(9, 'CPU Intel Core Ultra 7 265KF', '11999000.00', '10390000.00', NULL, '2025-09-04 14:50:02', '2025-09-04 14:50:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_don_hang` bigint UNSIGNED NOT NULL,
  `id_product` bigint UNSIGNED NOT NULL,
  `ten_san_pham_tai_thoi_diem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_bien_the` bigint UNSIGNED DEFAULT NULL,
  `ten_hien_thi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int NOT NULL,
  `don_gia` decimal(15,2) NOT NULL,
  `bao_hanh_thang` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chi_tiet_don_hangs`
--

INSERT INTO `chi_tiet_don_hangs` (`id`, `id_don_hang`, `id_product`, `ten_san_pham_tai_thoi_diem`, `id_bien_the`, `ten_hien_thi`, `so_luong`, `don_gia`, `bao_hanh_thang`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', NULL, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', 1, '8880000.00', 12, '2025-08-14 09:21:54', '2025-08-14 09:21:54'),
(2, 1, 2, 'Tản nhiệt AIO GIGABYTE AORUS WATERFORCE II 360 ICE', NULL, 'Tản nhiệt AIO GIGABYTE AORUS WATERFORCE II 360 ICE', 1, '7990000.00', 24, '2025-08-14 09:21:54', '2025-08-14 09:21:54'),
(3, 2, 1, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', NULL, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', 1, '7770000.00', 12, '2025-08-15 10:33:13', '2025-08-15 10:33:13'),
(4, 3, 2, 'Tản nhiệt AIO GIGABYTE AORUS WATERFORCE II 360 ICE', NULL, 'Tản nhiệt AIO GIGABYTE AORUS WATERFORCE II 360 ICE', 2, '6990000.00', 24, '2025-08-17 01:52:56', '2025-08-17 01:52:56'),
(5, 4, 3, 'Tản nhiệt AIO ASUS ROG RYUJIN III 360 ARGB White Edition', NULL, 'Tản nhiệt AIO ASUS ROG RYUJIN III 360 ARGB White Edition', 1, '8880000.00', 24, '2025-08-19 14:56:49', '2025-08-19 14:56:49'),
(6, 5, 1, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', NULL, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', 1, '7770000.00', 12, '2025-08-20 08:49:17', '2025-08-20 08:49:17'),
(7, 5, 5, 'PC GVN Intel i5-12400F/ VGA RTX 5060 (Main H)', 1, 'PC GVN Intel i5-12400F/ VGA RTX 5060 (Main H)', 1, '26120000.00', 36, '2025-08-20 08:49:18', '2025-08-20 08:49:18'),
(8, 5, 6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 3, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 1, '32430000.00', 36, '2025-08-20 08:49:18', '2025-08-20 08:49:18'),
(9, 6, 6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 3, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 1, '32430000.00', 36, '2025-08-20 09:05:23', '2025-08-20 09:05:23'),
(10, 6, 4, 'Tản nhiệt AIO GIGABYTE AORUS WATERFORCE X II 360', NULL, 'Tản nhiệt AIO GIGABYTE AORUS WATERFORCE X II 360', 2, '7990000.00', 24, '2025-08-20 09:05:23', '2025-08-20 09:05:23'),
(11, 6, 1, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', NULL, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', 1, '7770000.00', 12, '2025-08-20 09:05:23', '2025-08-20 09:05:23'),
(12, 7, 7, 'PC GVN Intel i7-14700F/ VGA RTX 5060', 5, 'PC GVN Intel i7-14700F/ VGA RTX 5060', 1, '38530000.00', 36, '2025-08-27 02:14:43', '2025-08-27 02:14:43'),
(13, 8, 1, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', NULL, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', 1, '7770000.00', 12, '2025-08-27 03:07:30', '2025-08-27 03:07:30'),
(14, 9, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-03 15:13:12', '2025-09-03 15:13:12'),
(15, 9, 31, 'Chuột Razer Cobra', NULL, 'Chuột Razer Cobra', 1, '990000.00', 12, '2025-09-03 15:13:12', '2025-09-03 15:13:12'),
(16, 9, 26, 'Bàn phím AULA F81 TM (Tím/ Ice Soul switch) F8108', NULL, 'Bàn phím AULA F81 TM (Tím/ Ice Soul switch) F8108', 1, '1490000.00', 12, '2025-09-03 15:13:12', '2025-09-03 15:13:12'),
(17, 9, 27, 'Màn hình LG 24GS65F-B 24\" IPS 180Hz HDR10 Gsync chuyên game', NULL, 'Màn hình LG 24GS65F-B 24\" IPS 180Hz HDR10 Gsync chuyên game', 1, '3590000.00', 12, '2025-09-03 15:13:12', '2025-09-03 15:13:12'),
(18, 10, 53, 'PC GVN Intel i7-14700F/ VGA RTX 4060', 16, 'PC GVN Intel i7-14700F/ VGA RTX 4060', 1, '37630000.00', 36, '2025-09-03 15:25:22', '2025-09-03 15:25:22'),
(19, 10, 15, 'Chuột Razer DeathAdder Essential (RZ01-03850100-R3M1)', NULL, 'Chuột Razer DeathAdder Essential (RZ01-03850100-R3M1)', 1, '400000.00', 12, '2025-09-03 15:25:22', '2025-09-03 15:25:22'),
(20, 10, 25, 'Bàn phím AULA M75 TM (Xanh + trắng + cam/ Crescent switch) M7501', NULL, 'Bàn phím AULA M75 TM (Xanh + trắng + cam/ Crescent switch) M7501', 1, '1990000.00', 12, '2025-09-03 15:25:22', '2025-09-03 15:25:22'),
(21, 10, 18, 'Màn hình LG 27GR75Q-B UltraGear 27\" IPS 2K 165Hz Gsync chuyên game', NULL, 'Màn hình LG 27GR75Q-B UltraGear 27\" IPS 2K 165Hz Gsync chuyên game', 1, '6090000.00', 12, '2025-09-03 15:25:22', '2025-09-03 15:25:22'),
(22, 11, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-03 15:27:32', '2025-09-03 15:27:32'),
(23, 12, 3, 'Tản nhiệt AIO ASUS ROG RYUJIN III 360 ARGB White Edition', NULL, 'Tản nhiệt AIO ASUS ROG RYUJIN III 360 ARGB White Edition', 1, '8880000.00', 24, '2025-09-03 15:41:13', '2025-09-03 15:41:13'),
(24, 12, 6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 4, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 1, '33920000.00', 36, '2025-09-03 15:41:13', '2025-09-03 15:41:13'),
(25, 13, 11, 'PC GVN INT x MSI Dragon GODLIKE (Intel Core Ultra 9 285K/ VGA RTX 5090) (Powered by MSI)', 10, 'PC GVN INT x MSI Dragon GODLIKE (Intel Core Ultra 9 285K/ VGA RTX 5090) (Powered by MSI)', 1, '199720000.00', 36, '2025-09-04 00:22:35', '2025-09-04 00:22:35'),
(26, 13, 14, 'Chuột ASUS ROG Strix Impact III Wireless', NULL, 'Chuột ASUS ROG Strix Impact III Wireless', 1, '1090000.00', 12, '2025-09-04 00:22:35', '2025-09-04 00:22:35'),
(27, 13, 29, 'Bàn phím ASUS M704 ROG AZOTH X NX Storm V2 Switch', NULL, 'Bàn phím ASUS M704 ROG AZOTH X NX Storm V2 Switch', 1, '7200000.00', 12, '2025-09-04 00:22:35', '2025-09-04 00:22:35'),
(28, 13, 18, 'Màn hình LG 27GR75Q-B UltraGear 27\" IPS 2K 165Hz Gsync chuyên game', NULL, 'Màn hình LG 27GR75Q-B UltraGear 27\" IPS 2K 165Hz Gsync chuyên game', 1, '6090000.00', 12, '2025-09-04 00:22:35', '2025-09-04 00:22:35'),
(29, 14, 5, 'PC GVN Intel i5-12400F/ VGA RTX 5060 (Main H)', 1, 'PC GVN Intel i5-12400F/ VGA RTX 5060 (Main H)', 1, '23150000.00', 36, '2025-09-04 00:36:05', '2025-09-04 00:36:05'),
(30, 15, 6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 3, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 1, '32430000.00', 36, '2025-09-04 00:42:56', '2025-09-04 00:42:56'),
(31, 15, 30, 'Chuột ASUS ROG Strix Impact III', NULL, 'Chuột ASUS ROG Strix Impact III', 1, '990000.00', 12, '2025-09-04 00:42:56', '2025-09-04 00:42:56'),
(32, 15, 23, 'Bàn phím AKKO TAC87 3 MODE Matcha Red Bean Stellar Rose switch', NULL, 'Bàn phím AKKO TAC87 3 MODE Matcha Red Bean Stellar Rose switch', 1, '1100000.00', 12, '2025-09-04 00:42:56', '2025-09-04 00:42:56'),
(33, 15, 19, 'Màn hình Acer KG240Y-X1 24\" IPS 200Hz Gsync chuyên game', NULL, 'Màn hình Acer KG240Y-X1 24\" IPS 200Hz Gsync chuyên game', 1, '2790000.00', 12, '2025-09-04 00:42:56', '2025-09-04 00:42:56'),
(34, 16, 14, 'Chuột ASUS ROG Strix Impact III Wireless', NULL, 'Chuột ASUS ROG Strix Impact III Wireless', 1, '1090000.00', 12, '2025-09-04 00:45:00', '2025-09-04 00:45:00'),
(35, 16, 29, 'Bàn phím ASUS M704 ROG AZOTH X NX Storm V2 Switch', NULL, 'Bàn phím ASUS M704 ROG AZOTH X NX Storm V2 Switch', 1, '7200000.00', 12, '2025-09-04 00:45:00', '2025-09-04 00:45:00'),
(36, 16, 51, 'Nguồn máy tính Cooler Master MWE 650 - 80 Plus Bronze - V3 230V (650W)', NULL, 'Nguồn máy tính Cooler Master MWE 650 - 80 Plus Bronze - V3 230V (650W)', 1, '1390000.00', 12, '2025-09-04 00:45:00', '2025-09-04 00:45:00'),
(37, 16, 42, 'Bộ vi xử lý AMD Ryzen 7 9800X3D / 4.7GHz Boost 5.2GHz / 8 nhân 16 luồng / 104MB / AM5', NULL, 'Bộ vi xử lý AMD Ryzen 7 9800X3D / 4.7GHz Boost 5.2GHz / 8 nhân 16 luồng / 104MB / AM5', 1, '14990000.00', 12, '2025-09-04 00:45:00', '2025-09-04 00:45:00'),
(38, 16, 32, 'Card màn hình Gigabyte GeForce RTX 5060 Windforce OC 8GB', NULL, 'Card màn hình Gigabyte GeForce RTX 5060 Windforce OC 8GB', 1, '9990000.00', 36, '2025-09-04 00:45:00', '2025-09-04 00:45:00'),
(39, 17, 62, 'RAM TeamGroup T-Force XTreem 2x16GB 8000Mhz Black DDR5', NULL, 'RAM TeamGroup T-Force XTreem 2x16GB 8000Mhz Black DDR5', 1, '6390000.00', 16, '2025-09-04 02:58:27', '2025-09-04 02:58:27'),
(40, 17, 61, 'Ram Corsair Vengeance RGB 96GB (2x48GB) 5600 DDR5 Black (CMH96GX5M2B5600C40)', NULL, 'Ram Corsair Vengeance RGB 96GB (2x48GB) 5600 DDR5 Black (CMH96GX5M2B5600C40)', 1, '8790000.00', 17, '2025-09-04 02:58:27', '2025-09-04 02:58:27'),
(41, 17, 48, 'Nguồn máy tính Cooler Master MWE GOLD 1050W V2 ATX3.1 - 80 Plus Gold - Full Modular', NULL, 'Nguồn máy tính Cooler Master MWE GOLD 1050W V2 ATX3.1 - 80 Plus Gold - Full Modular', 1, '4490000.00', 12, '2025-09-04 02:58:27', '2025-09-04 02:58:27'),
(42, 18, 62, 'RAM TeamGroup T-Force XTreem 2x16GB 8000Mhz Black DDR5', NULL, 'RAM TeamGroup T-Force XTreem 2x16GB 8000Mhz Black DDR5', 1, '6390000.00', 16, '2025-09-04 02:58:33', '2025-09-04 02:58:33'),
(43, 18, 61, 'Ram Corsair Vengeance RGB 96GB (2x48GB) 5600 DDR5 Black (CMH96GX5M2B5600C40)', NULL, 'Ram Corsair Vengeance RGB 96GB (2x48GB) 5600 DDR5 Black (CMH96GX5M2B5600C40)', 1, '8790000.00', 17, '2025-09-04 02:58:33', '2025-09-04 02:58:33'),
(44, 18, 48, 'Nguồn máy tính Cooler Master MWE GOLD 1050W V2 ATX3.1 - 80 Plus Gold - Full Modular', NULL, 'Nguồn máy tính Cooler Master MWE GOLD 1050W V2 ATX3.1 - 80 Plus Gold - Full Modular', 1, '4490000.00', 12, '2025-09-04 02:58:33', '2025-09-04 02:58:33'),
(45, 19, 62, 'RAM TeamGroup T-Force XTreem 2x16GB 8000Mhz Black DDR5', NULL, 'RAM TeamGroup T-Force XTreem 2x16GB 8000Mhz Black DDR5', 1, '6390000.00', 16, '2025-09-04 02:58:38', '2025-09-04 02:58:38'),
(46, 19, 61, 'Ram Corsair Vengeance RGB 96GB (2x48GB) 5600 DDR5 Black (CMH96GX5M2B5600C40)', NULL, 'Ram Corsair Vengeance RGB 96GB (2x48GB) 5600 DDR5 Black (CMH96GX5M2B5600C40)', 1, '8790000.00', 17, '2025-09-04 02:58:38', '2025-09-04 02:58:38'),
(47, 19, 48, 'Nguồn máy tính Cooler Master MWE GOLD 1050W V2 ATX3.1 - 80 Plus Gold - Full Modular', NULL, 'Nguồn máy tính Cooler Master MWE GOLD 1050W V2 ATX3.1 - 80 Plus Gold - Full Modular', 1, '4490000.00', 12, '2025-09-04 02:58:38', '2025-09-04 02:58:38'),
(48, 20, 62, 'RAM TeamGroup T-Force XTreem 2x16GB 8000Mhz Black DDR5', NULL, 'RAM TeamGroup T-Force XTreem 2x16GB 8000Mhz Black DDR5', 1, '6390000.00', 16, '2025-09-04 02:59:41', '2025-09-04 02:59:41'),
(49, 20, 61, 'Ram Corsair Vengeance RGB 96GB (2x48GB) 5600 DDR5 Black (CMH96GX5M2B5600C40)', NULL, 'Ram Corsair Vengeance RGB 96GB (2x48GB) 5600 DDR5 Black (CMH96GX5M2B5600C40)', 1, '8790000.00', 17, '2025-09-04 02:59:41', '2025-09-04 02:59:41'),
(50, 20, 48, 'Nguồn máy tính Cooler Master MWE GOLD 1050W V2 ATX3.1 - 80 Plus Gold - Full Modular', NULL, 'Nguồn máy tính Cooler Master MWE GOLD 1050W V2 ATX3.1 - 80 Plus Gold - Full Modular', 1, '4490000.00', 12, '2025-09-04 02:59:41', '2025-09-04 02:59:41'),
(51, 20, 45, 'Vỏ máy tính Cooler Master MasterBox 520 Mesh ARGB Black', NULL, 'Vỏ máy tính Cooler Master MasterBox 520 Mesh ARGB Black', 1, '1390000.00', 12, '2025-09-04 02:59:41', '2025-09-04 02:59:41'),
(52, 20, 38, 'Bo mạch chủ GIGABYTE B760M GAMING WIFI PLUS DDR5', NULL, 'Bo mạch chủ GIGABYTE B760M GAMING WIFI PLUS DDR5', 1, '3690000.00', 36, '2025-09-04 02:59:41', '2025-09-04 02:59:41'),
(53, 20, 39, 'Bộ vi xử lý Intel Core Ultra 9 285K / Turbo up to 5.7GHz / 24 Nhân 24 Luồng / 36MB / LGA 1851', NULL, 'Bộ vi xử lý Intel Core Ultra 9 285K / Turbo up to 5.7GHz / 24 Nhân 24 Luồng / 36MB / LGA 1851', 1, '17490000.00', 36, '2025-09-04 02:59:41', '2025-09-04 02:59:41'),
(54, 21, 3, 'Tản nhiệt AIO ASUS ROG RYUJIN III 360 ARGB White Edition', NULL, 'Tản nhiệt AIO ASUS ROG RYUJIN III 360 ARGB White Edition', 1, '8880000.00', 24, '2025-09-04 03:05:32', '2025-09-04 03:05:32'),
(55, 21, 5, 'PC GVN Intel i5-12400F/ VGA RTX 5060 (Main H)', 1, 'PC GVN Intel i5-12400F/ VGA RTX 5060 (Main H)', 1, '23150000.00', 36, '2025-09-04 03:05:32', '2025-09-04 03:05:32'),
(56, 22, 54, 'PC GVN Intel i7-14700F/ VGA RTX 5060Ti', 17, 'PC GVN Intel i7-14700F/ VGA RTX 5060Ti', 1, '42730000.00', 36, '2025-09-04 14:57:32', '2025-09-04 14:57:32'),
(57, 22, 79, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 31, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 1, '199530000.00', 36, '2025-09-04 14:57:32', '2025-09-04 14:57:32'),
(58, 23, 79, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 31, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 1, '199530000.00', 36, '2025-09-04 14:59:05', '2025-09-04 14:59:05'),
(59, 24, 76, 'PC TTG HOME OFFICE Core i3 10105 - RAM 8GB- SSD 256GB', 21, 'PC TTG HOME OFFICE Core i3 10105 - RAM 8GB- SSD 256GB', 1, '9818000.00', 36, '2025-09-04 15:02:29', '2025-09-04 15:02:29'),
(60, 25, 5, 'PC GVN Intel i5-12400F/ VGA RTX 5060 (Main H)', 1, 'PC GVN Intel i5-12400F/ VGA RTX 5060 (Main H)', 1, '26120000.00', 36, '2025-09-04 15:13:14', '2025-09-04 15:13:14'),
(61, 26, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-05 03:17:49', '2025-09-05 03:17:49'),
(62, 27, 77, 'PC TTG HOME OFFICE Core i3 10105 - RAM 8GB- SSD 256GB- Kèm Màn Hình', 23, 'PC TTG HOME OFFICE Core i3 10105 - RAM 8GB- SSD 256GB- Kèm Màn Hình', 1, '10658000.00', 36, '2025-09-05 03:21:55', '2025-09-05 03:21:55'),
(63, 28, 80, 'PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)', 32, 'PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)', 1, '75990000.00', 36, '2025-09-05 03:26:23', '2025-09-05 03:26:23'),
(64, 29, 80, 'PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)', 32, 'PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)', 1, '75990000.00', 36, '2025-09-05 03:50:15', '2025-09-05 03:50:15'),
(65, 30, 78, 'PC TTG HOME OFFICE Core i5 12400 - RAM 16GB- SSD 256GB- Kèm Màn hình', 27, 'PC TTG HOME OFFICE Core i5 12400 - RAM 16GB- SSD 256GB- Kèm Màn hình', 1, '11700000.00', 35, '2025-09-05 04:20:06', '2025-09-05 04:20:06'),
(66, 31, 6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 3, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 1, '35430000.00', 36, '2025-09-13 13:38:54', '2025-09-13 13:38:54'),
(67, 31, 79, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 31, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 1, '199530000.00', 36, '2025-09-13 13:38:54', '2025-09-13 13:38:54'),
(68, 32, 6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 3, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 1, '35430000.00', 36, '2025-09-13 13:41:32', '2025-09-13 13:41:32'),
(69, 32, 79, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 31, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 1, '199530000.00', 36, '2025-09-13 13:41:32', '2025-09-13 13:41:32'),
(70, 33, 6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 3, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 1, '35430000.00', 36, '2025-09-13 13:41:57', '2025-09-13 13:41:57'),
(71, 33, 79, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 31, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 1, '199530000.00', 36, '2025-09-13 13:41:57', '2025-09-13 13:41:57'),
(72, 34, 6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 3, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 1, '35430000.00', 36, '2025-09-13 13:42:20', '2025-09-13 13:42:20'),
(73, 34, 79, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 31, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 1, '199530000.00', 36, '2025-09-13 13:42:20', '2025-09-13 13:42:20'),
(74, 35, 6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 3, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 1, '35430000.00', 36, '2025-09-13 13:42:32', '2025-09-13 13:42:32'),
(75, 35, 79, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 31, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 1, '199530000.00', 36, '2025-09-13 13:42:32', '2025-09-13 13:42:32'),
(76, 36, 6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 3, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 1, '35430000.00', 36, '2025-09-13 13:55:28', '2025-09-13 13:55:28'),
(77, 36, 79, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 31, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 1, '199530000.00', 36, '2025-09-13 13:55:28', '2025-09-13 13:55:28'),
(78, 37, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:31:26', '2025-09-15 02:31:26'),
(79, 38, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:31:30', '2025-09-15 02:31:30'),
(80, 39, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:31:34', '2025-09-15 02:31:34'),
(81, 40, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:31:35', '2025-09-15 02:31:35'),
(82, 41, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:31:36', '2025-09-15 02:31:36'),
(83, 42, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:32:00', '2025-09-15 02:32:00'),
(84, 43, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:32:04', '2025-09-15 02:32:04'),
(85, 44, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:32:47', '2025-09-15 02:32:47'),
(86, 45, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:32:52', '2025-09-15 02:32:52'),
(87, 46, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:34:11', '2025-09-15 02:34:11'),
(88, 47, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:34:12', '2025-09-15 02:34:12'),
(89, 48, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:34:13', '2025-09-15 02:34:13'),
(90, 50, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:34:14', '2025-09-15 02:34:14'),
(91, 52, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:34:18', '2025-09-15 02:34:18'),
(92, 53, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:34:24', '2025-09-15 02:34:24'),
(93, 54, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:36:38', '2025-09-15 02:36:38'),
(94, 56, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-15 02:36:39', '2025-09-15 02:36:39'),
(95, 57, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-16 03:14:55', '2025-09-16 03:14:55'),
(96, 58, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-16 03:15:54', '2025-09-16 03:15:54'),
(97, 59, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-16 03:15:58', '2025-09-16 03:15:58'),
(98, 60, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-16 03:16:12', '2025-09-16 03:16:12'),
(99, 61, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-16 03:18:07', '2025-09-16 03:18:07'),
(100, 62, 55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 18, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 1, '49230000.00', 36, '2025-09-16 03:19:27', '2025-09-16 03:19:27'),
(101, 63, 79, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 31, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 1, '199530000.00', 36, '2025-09-16 14:21:27', '2025-09-16 14:21:27');

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
  `gia` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chi_tiet_gio_hangs`
--

INSERT INTO `chi_tiet_gio_hangs` (`id`, `id_gio_hang`, `id_product`, `id_bien_the`, `so_luong`, `gia`, `created_at`, `updated_at`) VALUES
(79, 4, 55, 18, 1, '49230000.00', '2025-09-04 15:21:28', '2025-09-04 15:21:28'),
(85, 6, 1, NULL, 1, '8880000.00', '2025-09-05 04:40:58', '2025-09-05 04:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `danh_gia_san_phams`
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
-- Dumping data for table `danh_gia_san_phams`
--

INSERT INTO `danh_gia_san_phams` (`id`, `id_product`, `id_user`, `so_sao`, `binh_luan`, `created_at`, `updated_at`, `trang_thai`, `deleted_at`) VALUES
(1, 1, 1, 4, 'sản phẩm ok', '2025-08-25 02:42:39', '2025-08-25 02:42:56', 'da_duyet', NULL),
(2, 51, 3, 5, 'Dùng tốt', '2025-09-03 15:24:10', '2025-09-03 15:26:22', 'da_duyet', NULL),
(3, 55, 3, 5, 'Máy sử dụng tốt', '2025-09-03 15:26:51', '2025-09-03 15:27:46', 'da_duyet', NULL),
(4, 54, 3, 4, 'Máy sử dụng mạnh', '2025-09-03 15:27:12', '2025-09-03 15:27:45', 'da_duyet', NULL),
(5, 54, 4, 5, 'ok', '2025-09-04 14:35:38', '2025-09-04 14:36:16', 'da_duyet', NULL),
(6, 78, 6, 4, 'abc', '2025-09-05 04:19:22', '2025-09-15 02:28:10', 'da_duyet', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten`, `hinh_anh`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PC GAMING', 'images/1755739616_gearvn-build-pc-slider-right-t8.png', '2025-07-29 14:22:48', '2025-08-21 01:26:56', NULL),
(2, 'Gigabyte', 'images/1753801551_923801.jpg', '2025-07-29 15:05:51', '2025-07-29 15:08:40', '2025-07-29 15:08:40'),
(3, 'PC', 'images/1755701782_gearvn-pc-amd-sub-t8.png', '2025-08-20 00:52:08', '2025-08-20 14:56:22', NULL),
(4, 'Chuột', 'images/1755739178_gearvn-gaming-gear-sub-t8.png', '2025-08-21 01:19:39', '2025-08-21 01:19:39', NULL),
(5, 'Bàn Phím', 'images/1755739198_gearvn-ban-phim-slider-right-t8.png', '2025-08-21 01:19:58', '2025-08-21 01:19:58', NULL),
(6, 'Linh kiện PC', 'images/1755739490_gearvn-gaming-gear-deal-hoi-sub-banner-t8.png', '2025-08-21 01:24:50', '2025-08-21 01:24:50', NULL),
(7, 'Màn Hình', 'images/1755739833_gearvn-man-hinh-sub-t8.png', '2025-08-21 01:30:33', '2025-08-21 01:30:33', NULL),
(8, 'PC 3D', 'images/1756995507_banner_top_3_img_large.jpg', '2025-09-04 14:18:27', '2025-09-04 14:18:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dia_chi_nguoi_dungs`
--

CREATE TABLE `dia_chi_nguoi_dungs` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `ten_nguoi_nhan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai_nguoi_nhan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi_day_du` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinh_thanh_pho` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phuong_xa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mac_dinh` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tinh_thanh_pho_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phuong_xa_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dia_chi_nguoi_dungs`
--

INSERT INTO `dia_chi_nguoi_dungs` (`id`, `id_user`, `ten_nguoi_nhan`, `so_dien_thoai_nguoi_nhan`, `dia_chi_day_du`, `tinh_thanh_pho`, `phuong_xa`, `mac_dinh`, `created_at`, `updated_at`, `tinh_thanh_pho_name`, `phuong_xa_name`) VALUES
(1, 1, 'Trinh Hai Long', '0993546789', 'NHÀ 0 NGÕ 4 NGÁCH 5', '01', '00088', 1, '2025-08-14 02:28:13', '2025-08-14 02:28:13', 'Thành phố Hà Nội', 'Phường Hàng Bài'),
(2, 1, 'Trinh Hai Long', '0993547698', 'số ngõ 5 ngõ 78', '18', '40505044', 0, '2025-08-20 14:12:21', '2025-08-20 14:12:21', 'Tỉnh Hà Tĩnh', 'Xã Cổ Đạm'),
(3, 2, 'lol', '09935467899', 'JFJFF', '26', '60611119', 1, '2025-08-27 02:14:32', '2025-08-27 02:14:32', 'Tỉnh Lâm Đồng', 'Xã Nhân Cơ'),
(4, 3, 'Hải Phi Nguyễn', '0987653421', 'Nhà 12 Ngách 34', '24', '50707042', 1, '2025-09-03 15:25:17', '2025-09-03 15:25:17', 'Tỉnh Gia Lai', 'Xã Hoài Ân'),
(5, 4, 'Nguyễn Dũng Hải', '0976543321112', 'SỐ 79 ngõ 95', '24', '50707042', 1, '2025-09-04 00:42:52', '2025-09-04 00:42:52', 'Tỉnh Gia Lai', 'Xã Hoài Ân'),
(6, 5, 'Hải Phi Nguyễn', '098456758684', 'Thôn Hoàng Thành , Ngách Vĩ , ngõ 34, nhà 10', '04', '10311005', 1, '2025-09-04 03:05:25', '2025-09-04 03:05:25', 'Tp Hải Phòng', 'Phường Bạch Đằng'),
(7, 6, 'Hải Phi Nguyễn', '020832323113', 'Nhà 12', '26', '60611118', 1, '2025-09-05 03:17:41', '2025-09-05 03:17:41', 'Tỉnh Lâm Đồng', 'Xã Kiến Đức'),
(8, 7, 'Hải Hair Nguyễn', '097364638232', 'nha 11', '26', '60613096', 1, '2025-09-13 13:38:49', '2025-09-13 13:38:49', 'Tỉnh Lâm Đồng', 'Phường Bắc Gia Nghĩa');

-- --------------------------------------------------------

--
-- Table structure for table `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` bigint UNSIGNED NOT NULL,
  `ma_don` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_dia_chi_nguoi_dungs` bigint UNSIGNED NOT NULL,
  `id_phuong_thuc_thanh_toan` bigint UNSIGNED NOT NULL,
  `tong_tien` decimal(15,2) NOT NULL,
  `tong_tien_goc` decimal(15,2) NOT NULL DEFAULT '0.00',
  `giam_gia` decimal(12,2) NOT NULL DEFAULT '0.00',
  `trang_thai` enum('cho_xac_nhan','cho_thanh_toan','da_xac_nhan','chuan_bi_hang','dang_giao_hang','giao_thanh_cong','giao_that_bai','hoan_thanh','da_huy','yeu_cau_hoan_tra','da_hoan_tien') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cho_xac_nhan',
  `huy_boi` enum('admin','khach_hang','he_thong') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_ma_giam_gia` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `ma_don`, `id_user`, `id_dia_chi_nguoi_dungs`, `id_phuong_thuc_thanh_toan`, `tong_tien`, `tong_tien_goc`, `giam_gia`, `trang_thai`, `huy_boi`, `created_at`, `updated_at`, `id_ma_giam_gia`, `deleted_at`) VALUES
(1, 'DH1755163314', 1, 1, 1, '16870000.00', '16870000.00', '0.00', 'da_huy', 'admin', '2025-08-14 09:21:54', '2025-08-25 01:44:28', NULL, NULL),
(2, 'DH1755253993', 1, 1, 1, '7770000.00', '7770000.00', '0.00', 'hoan_thanh', 'he_thong', '2025-08-15 10:33:13', '2025-08-15 10:54:14', NULL, NULL),
(3, 'DH1755395576', 1, 1, 1, '13980000.00', '13980000.00', '0.00', 'hoan_thanh', 'he_thong', '2025-08-17 01:52:56', '2025-08-17 01:53:49', NULL, NULL),
(4, 'DH1755615409', 1, 1, 1, '8880000.00', '8880000.00', '0.00', 'da_huy', 'admin', '2025-08-19 14:56:49', '2025-08-25 01:44:15', NULL, NULL),
(5, 'DH1755679757', 1, 1, 1, '66320000.00', '66320000.00', '0.00', 'chuan_bi_hang', 'he_thong', '2025-08-20 08:49:17', '2025-09-03 15:14:36', NULL, NULL),
(6, 'DH1755680723', 1, 1, 1, '56180000.00', '56180000.00', '0.00', 'da_huy', 'admin', '2025-08-20 09:05:23', '2025-08-25 01:44:17', NULL, NULL),
(7, 'DH1756260883', 2, 3, 1, '37630000.00', '38530000.00', '900000.00', 'hoan_thanh', 'he_thong', '2025-08-27 02:14:43', '2025-08-27 02:20:27', 1, NULL),
(8, 'DH1756264050', 2, 3, 1, '7770000.00', '7770000.00', '0.00', 'hoan_thanh', 'he_thong', '2025-08-27 03:07:30', '2025-08-27 03:08:48', NULL, NULL),
(9, 'DH1756912392', 2, 3, 1, '54400000.00', '55300000.00', '900000.00', 'hoan_thanh', 'he_thong', '2025-09-03 15:13:12', '2025-09-03 15:15:04', 1, NULL),
(10, 'DH1756913122', 3, 4, 1, '45210000.00', '46110000.00', '900000.00', 'hoan_thanh', 'he_thong', '2025-09-03 15:25:22', '2025-09-03 15:26:01', 1, NULL),
(11, 'DH1756913252', 3, 4, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-03 15:27:32', '2025-09-03 15:41:40', NULL, NULL),
(12, 'DH1756914073', 3, 4, 1, '41900000.00', '42800000.00', '900000.00', 'hoan_thanh', 'he_thong', '2025-09-03 15:41:13', '2025-09-03 15:41:54', 1, NULL),
(13, 'DH1756945355', 3, 4, 1, '214100000.00', '214100000.00', '0.00', 'giao_thanh_cong', 'he_thong', '2025-09-04 00:22:35', '2025-09-04 00:23:58', NULL, NULL),
(14, 'DH1756946165', 3, 4, 1, '23150000.00', '23150000.00', '0.00', 'da_huy', 'khach_hang', '2025-09-04 00:36:05', '2025-09-04 00:36:31', NULL, NULL),
(15, 'DH1756946576', 4, 5, 1, '36410000.00', '37310000.00', '900000.00', 'hoan_thanh', 'he_thong', '2025-09-04 00:42:56', '2025-09-04 00:43:32', 1, NULL),
(16, 'DH1756946700', 4, 5, 1, '33760000.00', '34660000.00', '900000.00', 'da_huy', 'admin', '2025-09-04 00:45:00', '2025-09-04 03:00:53', 1, NULL),
(17, 'DH1756954707', 4, 5, 1, '42240000.00', '42240000.00', '0.00', 'giao_thanh_cong', 'he_thong', '2025-09-04 02:58:27', '2025-09-04 03:01:25', NULL, NULL),
(18, 'DH1756954713', 4, 5, 1, '42240000.00', '42240000.00', '0.00', 'da_huy', 'admin', '2025-09-04 02:58:33', '2025-09-04 03:01:11', NULL, NULL),
(19, 'DH1756954718', 4, 5, 1, '42240000.00', '42240000.00', '0.00', 'da_huy', 'admin', '2025-09-04 02:58:38', '2025-09-04 03:01:33', NULL, NULL),
(20, 'DH1756954781', 4, 5, 1, '42240000.00', '42240000.00', '0.00', 'hoan_thanh', 'he_thong', '2025-09-04 02:59:41', '2025-09-04 03:02:35', NULL, NULL),
(21, 'DH1756955132', 5, 6, 1, '32030000.00', '32030000.00', '0.00', 'hoan_thanh', 'he_thong', '2025-09-04 03:05:32', '2025-09-04 03:07:02', NULL, NULL),
(22, 'DH1756997852', 4, 5, 1, '241360000.00', '242260000.00', '900000.00', 'da_huy', 'khach_hang', '2025-09-04 14:57:32', '2025-09-04 14:58:11', 1, NULL),
(23, 'DH1756997945', 4, 5, 1, '198630000.00', '199530000.00', '900000.00', 'hoan_thanh', 'he_thong', '2025-09-04 14:59:05', '2025-09-04 15:00:03', 1, NULL),
(24, 'DH1756998149', 4, 5, 1, '9818000.00', '9818000.00', '0.00', 'da_huy', 'admin', '2025-09-04 15:02:29', '2025-09-04 15:03:08', NULL, NULL),
(25, 'DH1756998794', 4, 5, 1, '26120000.00', '26120000.00', '0.00', 'giao_thanh_cong', 'he_thong', '2025-09-01 17:00:00', '2025-09-02 15:24:19', NULL, NULL),
(26, 'DH1757042269', 6, 7, 1, '48330000.00', '49230000.00', '900000.00', 'hoan_thanh', 'he_thong', '2025-09-05 03:17:49', '2025-09-05 03:19:22', 1, NULL),
(27, 'DH1757042515', 6, 7, 1, '10658000.00', '10658000.00', '0.00', 'giao_thanh_cong', 'he_thong', '2025-09-05 03:21:55', '2025-09-05 04:53:54', NULL, NULL),
(28, 'DH1757042783', 6, 7, 1, '75990000.00', '75990000.00', '0.00', 'hoan_thanh', 'he_thong', '2025-09-05 03:26:23', '2025-09-05 03:27:25', NULL, NULL),
(29, 'DH1757044214', 6, 7, 2, '75090000.00', '75990000.00', '900000.00', 'da_huy', 'khach_hang', '2025-09-05 03:50:14', '2025-09-05 03:50:46', 1, NULL),
(30, 'DH1757046006', 6, 7, 2, '11700000.00', '11700000.00', '0.00', 'hoan_thanh', 'he_thong', '2025-09-05 04:20:06', '2025-09-05 04:22:41', NULL, NULL),
(31, 'DH1757770734', 7, 8, 1, '234960000.00', '234960000.00', '0.00', 'cho_xac_nhan', NULL, '2025-09-13 13:38:54', '2025-09-13 13:38:54', NULL, NULL),
(32, 'DH1757770892', 7, 8, 1, '234960000.00', '234960000.00', '0.00', 'cho_xac_nhan', NULL, '2025-09-13 13:41:32', '2025-09-13 13:41:32', NULL, NULL),
(33, 'DH1757770917', 7, 8, 1, '234960000.00', '234960000.00', '0.00', 'cho_xac_nhan', NULL, '2025-09-13 13:41:57', '2025-09-13 13:41:57', NULL, NULL),
(34, 'DH1757770940', 7, 8, 1, '234960000.00', '234960000.00', '0.00', 'cho_xac_nhan', NULL, '2025-09-13 13:42:20', '2025-09-13 13:42:20', NULL, NULL),
(35, 'DH1757770952', 7, 8, 1, '234960000.00', '234960000.00', '0.00', 'cho_xac_nhan', NULL, '2025-09-13 13:42:32', '2025-09-13 13:42:32', NULL, NULL),
(36, 'DH1757771728', 7, 8, 1, '222960000.00', '234960000.00', '12000000.00', 'hoan_thanh', NULL, '2025-09-13 13:55:28', '2025-09-13 13:56:05', 2, NULL),
(37, 'DH1757903486', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:31:26', '2025-09-15 02:37:31', NULL, NULL),
(38, 'DH1757903490', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:31:30', '2025-09-15 02:37:56', NULL, NULL),
(39, 'DH1757903494', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:31:34', '2025-09-15 02:38:06', NULL, NULL),
(40, 'DH1757903495', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:31:35', '2025-09-15 02:38:18', NULL, NULL),
(41, 'DH1757903496', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:31:36', '2025-09-15 02:37:50', NULL, NULL),
(42, 'DH1757903520', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:32:00', '2025-09-15 02:38:14', NULL, NULL),
(43, 'DH1757903524', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:32:04', '2025-09-15 02:38:00', NULL, NULL),
(44, 'DH1757903567', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:32:47', '2025-09-15 02:38:30', NULL, NULL),
(45, 'DH1757903572', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:32:52', '2025-09-15 02:38:34', NULL, NULL),
(46, 'DH1757903651', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:34:11', '2025-09-15 02:38:38', NULL, NULL),
(47, 'DH1757903652', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:34:12', '2025-09-15 02:38:41', NULL, NULL),
(48, 'DH1757903653', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:34:13', '2025-09-15 02:37:46', NULL, NULL),
(50, 'DH1757903654', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:34:14', '2025-09-15 02:38:09', NULL, NULL),
(52, 'DH1757903658', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'cho_xac_nhan', NULL, '2025-09-15 02:34:18', '2025-09-15 02:34:18', NULL, NULL),
(53, 'DH1757903664', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:34:24', '2025-09-15 02:37:41', NULL, NULL),
(54, 'DH1757903798', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:36:38', '2025-09-15 02:37:35', NULL, NULL),
(56, 'DH1757903799', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'admin', '2025-09-15 02:36:39', '2025-09-15 02:37:37', NULL, NULL),
(57, 'DH1757992495', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'da_huy', 'khach_hang', '2025-09-16 03:14:55', '2025-09-16 03:15:13', NULL, NULL),
(58, 'DH1757992554', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'cho_xac_nhan', NULL, '2025-09-16 03:15:54', '2025-09-16 03:15:54', NULL, NULL),
(59, 'DH1757992558', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'cho_xac_nhan', NULL, '2025-09-16 03:15:58', '2025-09-16 03:15:58', NULL, NULL),
(60, 'DH1757992572', 7, 8, 1, '49230000.00', '49230000.00', '0.00', 'cho_xac_nhan', NULL, '2025-09-16 03:16:12', '2025-09-16 03:16:12', NULL, NULL),
(61, 'DH1757992687', 7, 8, 1, '48330000.00', '49230000.00', '900000.00', 'cho_xac_nhan', NULL, '2025-09-16 03:18:07', '2025-09-16 03:18:07', 1, NULL),
(62, 'DH1757992767', 7, 8, 1, '48330000.00', '49230000.00', '900000.00', 'cho_xac_nhan', NULL, '2025-09-16 03:19:27', '2025-09-16 03:19:27', 1, NULL),
(63, 'DH1758032487', 7, 8, 1, '199530000.00', '199530000.00', '0.00', 'cho_xac_nhan', NULL, '2025-09-16 14:21:27', '2025-09-16 14:21:27', NULL, NULL);

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
-- Table structure for table `gio_hangs`
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
-- Dumping data for table `gio_hangs`
--

INSERT INTO `gio_hangs` (`id`, `id_user`, `loai`, `id_giam_gia`, `ghi_chu`, `created_at`, `updated_at`) VALUES
(1, 1, 'chinh', NULL, NULL, '2025-08-01 00:47:42', '2025-08-01 00:47:42'),
(2, 2, 'chinh', NULL, NULL, '2025-08-27 02:10:33', '2025-09-03 15:13:32'),
(3, 3, 'chinh', NULL, NULL, '2025-09-03 15:23:50', '2025-09-03 15:41:21'),
(4, 4, 'chinh', NULL, NULL, '2025-09-04 00:41:40', '2025-09-04 14:59:12'),
(5, 5, 'chinh', NULL, NULL, '2025-09-04 03:04:16', '2025-09-04 03:04:16'),
(6, 6, 'chinh', NULL, NULL, '2025-09-05 03:17:14', '2025-09-05 03:50:20'),
(7, 7, 'chinh', NULL, NULL, '2025-09-09 09:21:10', '2025-09-16 03:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `gpus`
--

CREATE TABLE `gpus` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(12,2) DEFAULT NULL,
  `gia_sale` decimal(12,2) DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gpus`
--

INSERT INTO `gpus` (`id`, `ten`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Card màn hình Asus GeForce RTX 5060 DUAL OC 8GB', '10990000.00', '9690000.00', NULL, '2025-08-20 00:46:05', '2025-08-20 00:46:05', NULL),
(2, 'Card màn hình MSI GeForce RTX 5060 Ventus 2X OC White 8GB', '11990000.00', '10490000.00', NULL, '2025-08-20 08:12:44', '2025-08-20 08:12:44', NULL),
(3, 'Card màn hình MSI GeForce RTX 5060 Ventus 2X OC 8GB', '10490000.00', '9990000.00', NULL, '2025-08-21 02:36:52', '2025-08-21 02:36:52', NULL),
(4, 'Card màn hình GIGABYTE GeForce RTX 3050 WINDFORCE OC 6G (GV-N3050WF2OCV2-6GD)', '5990000.00', '4790000.00', NULL, '2025-08-21 02:58:21', '2025-08-21 02:58:21', NULL),
(5, 'Card màn hình Gigabyte GeForce RTX 5060 Windforce OC 8GB', '10490000.00', '9990000.00', NULL, '2025-08-21 03:04:05', '2025-08-21 03:04:05', NULL),
(6, 'Card màn hình GIGABYTE GeForce RTX 4060 WINDFORCE OC 8G', '9490000.00', '9290000.00', NULL, '2025-08-21 03:08:52', '2025-08-21 03:08:52', NULL),
(7, 'Card màn hình MSI GeForce RTX 5090 32G SUPRIM SOC', '99990000.00', '94990000.00', NULL, '2025-08-21 03:13:38', '2025-08-21 03:13:38', NULL),
(8, 'Card màn hình Gigabyte GeForce RTX 5060 Ti Windforce OC 8GB', '14990000.00', '13490000.00', NULL, '2025-09-03 03:20:21', '2025-09-03 03:20:21', NULL),
(9, 'Card màn hình GIGABYTE GeForce RTX 4070 SUPER WINDFORCE OC 12G (GV-N407SWF3OC-12GD)', '20990000.00', '19490000.00', NULL, '2025-09-03 03:43:58', '2025-09-03 03:43:58', NULL),
(10, 'Card màn hình Inter Graphics', '10000.00', NULL, NULL, '2025-09-04 13:59:05', '2025-09-04 13:59:05', NULL),
(11, 'Card màn hình ASUS ROG Astral GeForce RTX 5090 32GB GDDR7 OC Edition', '159000000.00', '119000000.00', NULL, '2025-09-04 14:28:01', '2025-09-04 14:28:01', NULL),
(12, 'Card Màn Hình Colorful IGame GeForce RTX 5080 Ultra W OC 16GB GDDR7', '45990000.00', '40680000.00', NULL, '2025-09-04 15:05:50', '2025-09-04 15:05:50', NULL);

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
-- Table structure for table `lich_su_xems`
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
-- Table structure for table `mainboards`
--

CREATE TABLE `mainboards` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `gia_sale` decimal(10,2) DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mainboards`
--

INSERT INTO `mainboards` (`id`, `ten`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bo mạch chủ MSI PRO H610M-S WIFI DDR4', '2990000.00', '2390000.00', NULL, '2025-08-20 00:45:32', '2025-08-20 00:45:32', NULL),
(2, 'Bo mạch chủ MSI B760M PROJECT ZERO', '5990000.00', NULL, NULL, '2025-08-20 08:11:06', '2025-08-20 08:11:06', NULL),
(3, 'Bo mạch chủ MSI Z790 GAMING PLUS WIFI DDR5', '6990000.00', '5990000.00', NULL, '2025-08-21 02:29:36', '2025-08-21 02:29:36', NULL),
(4, 'Bo mạch chủ MSI PRO H610M-S WIFI DDR4', '2990000.00', '2390000.00', NULL, '2025-08-21 02:45:16', '2025-08-21 02:45:30', '2025-08-21 02:45:30'),
(5, 'Bo mạch chủ MSI MAG B760M MORTAR II WIFI DDR5', '4590000.00', '4290000.00', NULL, '2025-08-21 03:05:38', '2025-08-21 03:05:38', NULL),
(6, 'Bo mạch chủ ASUS PRIME B760M-A WIFI D4 CSM', '3790000.00', '3490000.00', NULL, '2025-08-21 03:08:26', '2025-08-21 03:08:26', NULL),
(7, 'Bo mạch chủ MSI MEG Z890 GODLIKE (DDR5)', '42890000.00', '36990000.00', NULL, '2025-08-21 03:12:19', '2025-08-21 03:12:19', NULL),
(8, 'Bo mạch chủ GIGABYTE Z790 AORUS XTREME X ICE', '59900000.00', '20990000.00', NULL, '2025-09-03 03:48:45', '2025-09-03 03:48:45', NULL),
(9, 'Mainboard MSI H510M-B II', '1899000.00', '1579000.00', NULL, '2025-09-04 13:48:17', '2025-09-04 13:48:17', NULL),
(10, 'Mainboard Asus ROG STRIX X870E-E Gaming Wifi DDR5', '16890000.00', NULL, NULL, '2025-09-04 14:27:10', '2025-09-04 14:27:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ma_giam_gias`
--

CREATE TABLE `ma_giam_gias` (
  `id` bigint UNSIGNED NOT NULL,
  `ma` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loai` enum('phan_tram','tien_mat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int UNSIGNED NOT NULL DEFAULT '0',
  `gia_tri` decimal(15,2) NOT NULL,
  `gia_tri_toi_da` decimal(15,2) NOT NULL DEFAULT '0.00',
  `dieu_kien` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ngay_bat_dau` timestamp NULL DEFAULT NULL,
  `ngay_ket_thuc` timestamp NULL DEFAULT NULL,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `gioi_han_moi_user` bigint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_giam_gias`
--

INSERT INTO `ma_giam_gias` (`id`, `ma`, `loai`, `so_luong`, `gia_tri`, `gia_tri_toi_da`, `dieu_kien`, `ngay_bat_dau`, `ngay_ket_thuc`, `hoat_dong`, `created_at`, `updated_at`, `deleted_at`, `gioi_han_moi_user`) VALUES
(1, 'MAX 99', 'tien_mat', 97, '900000.00', '900000.00', '30000000.00', '2025-09-15 17:00:00', '2025-09-29 17:00:00', 1, '2025-08-27 02:13:35', '2025-09-16 03:19:33', NULL, 2),
(2, 'PH43562', 'tien_mat', 7, '12000000.00', '12000000.00', '1000000.00', '2025-09-12 17:00:00', '2025-09-26 17:00:00', 1, '2025-09-05 04:42:48', '2025-09-13 13:55:34', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_giam_gia_users`
--

CREATE TABLE `ma_giam_gia_users` (
  `id` bigint UNSIGNED NOT NULL,
  `ma_giam_gia_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `so_lan_su_dung` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_giam_gia_users`
--

INSERT INTO `ma_giam_gia_users` (`id`, `ma_giam_gia_id`, `user_id`, `so_lan_su_dung`, `created_at`, `updated_at`) VALUES
(1, 2, 7, 1, '2025-09-13 13:55:34', '2025-09-13 13:55:34'),
(2, 1, 7, 2, '2025-09-16 03:18:13', '2025-09-16 03:19:33');

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
(42, '0001_01_01_000000_create_users_table', 1),
(43, '0001_01_01_000001_create_cache_table', 1),
(44, '0001_01_01_000002_create_jobs_table', 1),
(45, '2025_06_06_073212_create_danh_mucs_table', 1),
(46, '2025_06_06_073224_create_chips_table', 1),
(47, '2025_06_06_073233_create_mainboards_table', 1),
(48, '2025_06_06_073238_create_gpus_table', 1),
(49, '2025_06_06_073243_create_rams_table', 1),
(50, '2025_06_06_073249_create_o_cungs_table', 1),
(51, '2025_06_06_073250_create_nguons_table', 1),
(52, '2025_06_06_073251_create_cases_table', 1),
(53, '2025_06_06_073252_create_tan_nhiets_table', 1),
(54, '2025_06_06_073302_create_phuong_thuc_thanh_toans_table', 1),
(55, '2025_06_06_073324_create_thuong_hieus_table', 1),
(56, '2025_06_06_073409_create_ma_giam_gias_table', 1),
(57, '2025_06_06_073426_create_san_phams_table', 1),
(58, '2025_06_06_073432_create_bien_the_san_phams_table', 1),
(59, '2025_06_06_073544_create_dia_chi_nguoi_dungs_table', 1),
(60, '2025_06_06_073600_create_anh_san_phams_table', 1),
(61, '2025_06_06_073620_create_gio_hangs_table', 1),
(62, '2025_06_06_073627_create_don_hangs_table', 1),
(63, '2025_06_06_073652_create_chi_tiet_gio_hangs_table', 1),
(64, '2025_06_06_073657_create_chi_tiet_don_hangs_table', 1),
(65, '2025_06_06_073704_create_danh_gia_san_phams_table', 1),
(66, '2025_06_06_073710_create_lich_su_xems_table', 1),
(67, '2025_06_06_073715_create_nhat_ky_ton_khos_table', 1),
(68, '2025_06_21_043015_add_id_product_to_chi_tiet_gio_hangs_table', 1),
(69, '2025_06_21_153649_add_dieu_kien_to_ma_giam_gias_table', 1),
(70, '2025_06_21_155559_add_id_product_to_chi_tiet_don_hangs_table', 1),
(71, '2025_06_27_002817_add_gia_tri_toi_da_to_ma_giam_gias_table', 1),
(72, '2025_06_27_172518_create_banners_table', 1),
(73, '2025_06_27_204605_add_deleted_at_to_banners_table', 1),
(74, '2025_06_28_132943_add_ten_dia_phuong_to_dia_chi_nguoi_dungs', 1),
(75, '2025_07_02_095107_add_simple_product_fields_to_san_pham', 1),
(76, '2025_07_02_110813_add_gia_so_sanh_to_san_phams_table', 1),
(77, '2025_07_06_233024_update_don_hangs_trang_thai_enum', 1),
(78, '2025_07_08_170924_create_personal_access_tokens_table', 1),
(79, '2025_07_09_154937_create_yeu_cau_hoan_tra_table', 1),
(80, '2025_07_09_164915_create_ngan_hang_table', 1),
(81, '2025_07_16_020004_add_admin_hoan_tra_to_yeu_cau_hoan_tra_table', 1),
(82, '2025_07_18_213050_create_su_kiens_table', 1),
(83, '2025_07_19_174934_create_su_kien_san_phams_table', 2),
(84, '2025_07_21_193216_add_fields_to_yeu_cau_hoan_tra_table', 2),
(85, '2025_07_21_193912_create_anh_minh_chungs_table', 2),
(86, '2025_07_24_120426_add_hinh_anh_to_danh_mucs_table', 2),
(87, '2025_07_24_151037_add_loai_to_anh_minh_chungs_table', 2),
(88, '2025_07_24_174816_add_luot_mua_luot_xem_to_san_phams_table', 2),
(89, '2025_08_26_182106_add_so_luong_to_ma_giam_gias_table', 3),
(90, '2025_09_01_192013_chat_histories', 3),
(91, '2025_09_08_002050_add_gioi_han_moi_user_to_ma_giam_gias_table', 4),
(92, '2025_09_08_002429_create_ma_giam_gia_users_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `nguons`
--

CREATE TABLE `nguons` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(12,2) DEFAULT NULL,
  `gia_sale` decimal(12,2) DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nguons`
--

INSERT INTO `nguons` (`id`, `ten`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nguồn máy tính FSP HV PRO 650W - 80 Plus Bronze (650W)', '1190000.00', NULL, NULL, '2025-08-20 00:49:16', '2025-08-20 00:49:16', NULL),
(2, 'Nguồn máy tính MSI MAG A750BN PCIE5 - 80 Plus Bronze (750W)', '1690000.00', NULL, NULL, '2025-08-20 08:13:40', '2025-08-20 08:13:40', NULL),
(3, 'Nguồn máy tính Cooler Master MWE 750 - 80 Plus Bronze - V3 230V (750W)', '1990000.00', '1690000.00', NULL, '2025-08-21 02:37:22', '2025-08-21 02:37:22', NULL),
(4, 'Nguồn máy tính FSP HV PRO 550W - 80 Plus Bronze (550W)', '990000.00', NULL, NULL, '2025-08-21 02:58:45', '2025-08-21 02:58:45', NULL),
(5, 'Nguồn máy tính MSI MEG AI1600T PCIE5 - 80 Plus Titanium (1600W)', '13990000.00', NULL, NULL, '2025-08-21 03:14:42', '2025-08-21 03:14:42', NULL),
(6, 'Nguồn máy tính SuperFlower Leadex VII PRO 1200W ATX3.1 80 Plus Platinum SF-1200F14XP', '5990000.00', '5490000.00', NULL, '2025-09-04 14:30:34', '2025-09-04 14:30:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nhat_ky_ton_khos`
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
-- Table structure for table `o_cungs`
--

CREATE TABLE `o_cungs` (
  `id` bigint UNSIGNED NOT NULL,
  `loai` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dung_luong` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(12,2) DEFAULT NULL,
  `gia_sale` decimal(12,2) DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `o_cungs`
--

INSERT INTO `o_cungs` (`id`, `loai`, `dung_luong`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SSD', '500GB', '1790000.00', '1390000.00', NULL, '2025-08-20 00:47:53', '2025-08-20 00:47:53', NULL),
(2, 'HDD', '1TB', '1490000.00', NULL, NULL, '2025-08-20 00:48:52', '2025-08-20 00:48:52', NULL),
(3, 'SDD', '1TB', '2490000.00', '1890000.00', NULL, '2025-08-20 08:13:19', '2025-08-20 08:13:19', NULL),
(4, 'SSD NVMe M.2', '1TB', '3990000.00', '2990000.00', NULL, '2025-08-21 03:14:23', '2025-08-21 03:14:23', NULL),
(5, 'SSD', '256GB', '1290000.00', '790000.00', NULL, '2025-09-04 14:02:18', '2025-09-04 14:05:17', NULL),
(6, 'SSD', '120GB', '790000.00', '490000.00', NULL, '2025-09-04 14:03:34', '2025-09-04 14:05:04', NULL);

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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phuong_thuc_thanh_toans`
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
-- Dumping data for table `phuong_thuc_thanh_toans`
--

INSERT INTO `phuong_thuc_thanh_toans` (`id`, `ten`, `mo_ta`, `hoat_dong`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Thanh toán khi nhận hàng (COD)', 'Thanh toán khi nhận hàng', 1, '2025-08-14 09:20:12', '2025-08-14 09:20:12', NULL),
(2, 'Chuyển khoản ngân hàng', 'Chuyển khoản ngân hàng', 1, '2025-08-14 09:20:23', '2025-08-14 09:20:23', NULL),
(3, 'Ví MoMo', 'Ví MoMo', 1, '2025-08-14 09:20:32', '2025-09-04 15:01:34', '2025-09-04 15:01:34'),
(4, 'Thẻ tín dụng', 'Thẻ tín dụng', 1, '2025-08-14 09:20:41', '2025-09-04 15:01:29', '2025-09-04 15:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `rams`
--

CREATE TABLE `rams` (
  `id` bigint UNSIGNED NOT NULL,
  `dung_luong` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(12,2) DEFAULT NULL,
  `gia_sale` decimal(12,2) DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rams`
--

INSERT INTO `rams` (`id`, `dung_luong`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '16GB DDR4', '1490000.00', '1390000.00', NULL, '2025-08-20 00:46:36', '2025-08-21 02:36:12', NULL),
(2, '8 GB DDR4', '900000.00', '850000.00', NULL, '2025-08-20 00:47:28', '2025-08-21 02:35:59', NULL),
(3, '32GB DDR4', '4990000.00', '3390000.00', NULL, '2025-08-20 08:12:13', '2025-08-21 02:35:36', NULL),
(4, '32GB DDR5', '3990000.00', '3590000.00', NULL, '2025-08-21 02:30:30', '2025-08-21 02:30:30', NULL),
(5, '96GB DDR5', '13990000.00', '13290000.00', NULL, '2025-08-21 03:13:13', '2025-08-21 03:13:13', NULL),
(6, '96GB DDR5', '999.00', '99.00', NULL, '2025-08-23 15:43:03', '2025-09-03 02:54:04', '2025-09-03 02:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `san_phams`
--

CREATE TABLE `san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_san_pham` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `gia` decimal(15,2) DEFAULT NULL,
  `gia_so_sanh` decimal(15,2) DEFAULT NULL,
  `so_luong` int DEFAULT '0',
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `co_bien_the` tinyint(1) NOT NULL DEFAULT '1',
  `id_chip` bigint UNSIGNED DEFAULT NULL,
  `id_mainboard` bigint UNSIGNED DEFAULT NULL,
  `id_gpu` bigint UNSIGNED DEFAULT NULL,
  `id_tannhiet` bigint UNSIGNED DEFAULT NULL,
  `id_case` bigint UNSIGNED DEFAULT NULL,
  `id_nguon` bigint UNSIGNED DEFAULT NULL,
  `id_category` bigint UNSIGNED NOT NULL,
  `id_brand` bigint UNSIGNED NOT NULL,
  `bao_hanh_thang` int DEFAULT NULL,
  `hoat_dong` tinyint(1) NOT NULL DEFAULT '1',
  `anh_dai_dien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `luot_mua` int UNSIGNED NOT NULL DEFAULT '0',
  `luot_xem` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten`, `ma_san_pham`, `mo_ta`, `gia`, `gia_so_sanh`, `so_luong`, `sku`, `co_bien_the`, `id_chip`, `id_mainboard`, `id_gpu`, `id_tannhiet`, `id_case`, `id_nguon`, `id_category`, `id_brand`, `bao_hanh_thang`, `hoat_dong`, `anh_dai_dien`, `created_at`, `updated_at`, `deleted_at`, `luot_mua`, `luot_xem`) VALUES
(1, 'Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB', 'WD9161', '<h2><strong>Đ&aacute;nh gi&aacute; chi tiết tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB</strong></h2>\n<p>Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB l&agrave; một trong những sản phẩm&nbsp;<a href=\"https://gearvn.com/collections/tan-nhiet-nuoc\">tản nhiệt nước</a>&nbsp;cao cấp nổi bật tr&ecirc;n thị trường hiện nay, được thiết kế với hiệu suất tản nhiệt tối ưu v&agrave; nhiều t&iacute;nh năng độc đ&aacute;o, đ&aacute;p ứng nhu cầu của những game thủ v&agrave; người d&ugrave;ng m&aacute;y t&iacute;nh hiệu suất cao. B&agrave;i viết n&agrave;y sẽ cung cấp cho bạn c&aacute;i nh&igrave;n tổng quan v&agrave; chi tiết về sản phẩm&nbsp;<a href=\"https://gearvn.com/collections/tan-nhiet-may-tinh\">tản nhiệt m&aacute;y t&iacute;nh</a>&nbsp;n&agrave;y.</p>\n<p><img src=\"https://product.hstatic.net/200000722513/product/rog-ryuo-iv-slc-360-argb-01_dd9d8cce5aca436e9e3b0b10431b6e79_1024x1024.jpg\" alt=\"Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB\"></p>\n<h3><strong>Thiết kế ấn tượng với RGB đa sắc</strong></h3>\n<p>ASUS ROG Ryuo IV SLC 360 ARGB kh&ocirc;ng chỉ g&acirc;y ấn tượng với hiệu suất l&agrave;m m&aacute;t m&agrave; c&ograve;n với thiết kế đẹp mắt. Khung tản nhiệt được ho&agrave;n thiện tỉ mỉ, với t&ocirc;ng m&agrave;u đen tinh tế kết hợp với hệ thống LED RGB điều chỉnh đa sắc cho ph&eacute;p người d&ugrave;ng tạo ra những hiệu ứng &aacute;nh s&aacute;ng tuyệt đẹp. Với phần đầu bơm được thiết kế th&ocirc;ng minh, người d&ugrave;ng c&oacute; thể dễ d&agrave;ng thay đổi hướng lắp đặt.</p>\n<p><img src=\"https://product.hstatic.net/200000722513/product/rog-ryuo-iv-slc-360-argb-09_41476b0110cc40779737a239477f5fcc_1024x1024.jpg\" alt=\"Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB\"></p>\n<h3><strong>Hiệu suất tản nhiệt mạnh mẽ</strong></h3>\n<p>Với k&iacute;ch thước lớn, ROG Ryuo IV SLC 360 ARGB được trang bị ba quạt 120mm gi&uacute;p tối ưu h&oacute;a luồng kh&ocirc;ng kh&iacute; v&agrave; tăng khả năng tản nhiệt. Với c&ocirc;ng nghệ tản nhiệt ti&ecirc;n tiến, sản phẩm n&agrave;y c&oacute; thể l&agrave;m m&aacute;t c&aacute;c CPU hiệu suất cao, hỗ trợ việc &eacute;p xung m&agrave; kh&ocirc;ng gặp t&igrave;nh trạng qu&aacute; nhiệt. Bạn sẽ kh&ocirc;ng cần phải lo lắng về hiệu suất m&aacute;y t&iacute;nh của m&igrave;nh, ngay cả khi sử dụng trong những điều kiện khắc nghiệt nhất.</p>\n<h3><strong>Điều khiển th&ocirc;ng minh v&agrave; dễ d&agrave;ng</strong></h3>\n<p>ASUS ROG Ryuo IV SLC 360 ARGB được trang bị phần mềm ROG, cho ph&eacute;p người d&ugrave;ng kiểm so&aacute;t việc điều chỉnh tốc độ quạt v&agrave; &aacute;nh s&aacute;ng RGB một c&aacute;ch dễ d&agrave;ng. Chương tr&igrave;nh n&agrave;y gi&uacute;p theo d&otilde;i nhiệt độ CPU v&agrave; quạt, đồng thời cung cấp c&aacute;c t&ugrave;y chọn t&ugrave;y chỉnh cho những ai y&ecirc;u th&iacute;ch c&aacute; nh&acirc;n h&oacute;a hệ thống.</p>\n<p><img src=\"https://product.hstatic.net/200000722513/product/rog-ryuo-iv-slc-360-argb-14_8717fdc4428e44598246fa5f6da686ff_1024x1024.jpg\" alt=\"Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB\"></p>\n<h3><strong>Độ bền v&agrave; chất lượng vượt trội</strong></h3>\n<p>Sản phẩm được thiết kế với những vật liệu chất lượng cao, đảm bảo độ bền v&agrave; ổn định trong thời gian d&agrave;i sử dụng. C&aacute;c ống dẫn được l&agrave;m bằng cao su chống ăn m&ograve;n, gi&uacute;p bảo vệ hệ thống tản nhiệt khỏi c&aacute;c vấn đề r&ograve; rỉ. Với ROG Ryuo IV, bạn ho&agrave;n to&agrave;n c&oacute; thể y&ecirc;n t&acirc;m về t&iacute;nh an to&agrave;n v&agrave; hiệu quả của hệ thống l&agrave;m m&aacute;t trong qu&aacute; tr&igrave;nh sử dụng.</p>\n<h3><strong>Tương th&iacute;ch với nhiều nền tảng</strong></h3>\n<p>Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB tương th&iacute;ch với hầu hết c&aacute;c socket của Intel v&agrave; AMD, đảm bảo bạn c&oacute; thể sử dụng sản phẩm n&agrave;y với nhiều loại&nbsp;<a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">bo mạch chủ</a>&nbsp;kh&aacute;c nhau. Sự linh hoạt n&agrave;y gi&uacute;p người d&ugrave;ng dễ d&agrave;ng n&acirc;ng cấp v&agrave; lắp đặt m&agrave; kh&ocirc;ng cần phải lo lắng về t&iacute;nh tương th&iacute;ch.</p>\n<p><img src=\"https://product.hstatic.net/200000722513/product/rog-ryuo-iv-slc-360-argb-02_b6e855b2e31446b28117260acc275565_1024x1024.jpg\" alt=\"Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB\"></p>\n<p><strong>Tản nhiệt AIO ASUS ROG Ryuo IV SLC 360 ARGB</strong> kh&ocirc;ng chỉ l&agrave; một sản phẩm tản nhiệt hiệu suất cao m&agrave; c&ograve;n l&agrave; một m&oacute;n phụ kiện trang tr&iacute; cho hệ thống m&aacute;y t&iacute;nh của bạn. Với thiết kế tinh tế, hiệu suất tản nhiệt xuất sắc v&agrave; nhiều t&iacute;nh năng nổi bật, sản phẩm xứng đ&aacute;ng l&agrave; lựa chọn h&agrave;ng đầu cho những ai đang t&igrave;m kiếm giải ph&aacute;p l&agrave;m m&aacute;t tối ưu cho m&aacute;y t&iacute;nh của m&igrave;nh. H&atilde;y trải nghiệm ROG Ryuo IV SLC 360 ARGB v&agrave; cảm nhận sự kh&aacute;c biệt m&agrave; n&oacute; mang lại!</p>', '8880000.00', '9990000.00', 98, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 1, 12, 1, 'images/q0dKmBQm5xlgFQRQZvXJerinC2Vqg42CYX9oNZr0.jpg', '2025-07-29 14:52:42', '2025-09-13 03:14:10', NULL, 2, 48),
(2, 'Tản nhiệt AIO GIGABYTE AORUS WATERFORCE II 360 ICE', 'WD7981', '<h2><strong>Tản nhiệt nước GIGABYTE AORUS WATERFORCE II 360</strong></h2>\r\n<h3><strong>Th&ocirc;ng số kỹ thuật:</strong></h3>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" style=\"width: 100.92%;\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 35.3308%;\"><strong>Bộ tản nhiệt &amp; khối</strong></td>\r\n<td style=\"width: 64.6796%;\">K&iacute;ch thước : 394 x 119 x 27mm<br>K&iacute;ch thước bơm: 87,6 x 87,6 x 77,7mm<br>Chất liệu tản nhiệt: Nh&ocirc;m<br>Vật liệu khối: Đồng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 35.3308%;\"><strong>CPU Socket:</strong></td>\r\n<td style=\"width: 64.6796%;\">Intel 115x,1200,1700,1851<br>AMD AM5, AM4</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 35.3308%;\"><strong>Bơm</strong></td>\r\n<td style=\"width: 64.6796%;\">Tốc độ: 1600~3400 RPM +/-10%</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 35.3308%;\"><strong>Quạt:</strong></td>\r\n<td style=\"width: 64.6796%;\">Th&ocirc;ng số: Quạt ARGB 3 x 120mm<br>Tốc độ: 800 ~ 2300 RPM +/- 10%<br>Loại v&ograve;ng bi: HDB<br>Lưu lượng kh&iacute;: 64.95 CFM<br>&Aacute;p suất kh&ocirc;ng kh&iacute;: 2.93mmH20<br>Mức ồn: 12.8 ~ 36.9 dBA</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '7990000.00', '8990000.00', 98, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 2, 24, 1, 'images/XCIeAcwxVApzH8iopG9Q8kdyEcKFBrAY7ZdWJmiR.png', '2025-07-29 14:55:45', '2025-09-13 03:01:58', NULL, 2, 99),
(3, 'Tản nhiệt AIO ASUS ROG RYUJIN III 360 ARGB White Edition', 'WD0711', '<h2><strong>Th&ocirc;ng số kỹ thuật:&nbsp;</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" style=\"width: 101.162%;\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 32.4963%;\" colspan=\"1\"><strong>Tương th&iacute;ch</strong></td>\r\n<td style=\"width: 67.4622%;\">\r\n<ul>\r\n<li>Intel: LGA 1700, 1200, 115x, 20xx</li>\r\n<li>AMD: AM4, AM5</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 32.4963%;\" colspan=\"1\" rowspan=\"1\"><strong>Khối nước</strong></td>\r\n<td style=\"width: 67.4622%;\"><strong>K&iacute;ch thước:</strong>&nbsp;89 x 91 x 101 mm<br><strong>Chất liệu (mặt tiếp x&uacute;c CPU):</strong>&nbsp;Đồng<br><strong>Quạt t&iacute;ch hợp:</strong>&nbsp;C&oacute;\r\n<ul>\r\n<li>Tốc độ: 5100 RPM +/- 10%</li>\r\n</ul>\r\n<ul>\r\n<li>&Aacute;p suất kh&ocirc;ng kh&iacute;: 5.53 mmH2O</li>\r\n</ul>\r\n<ul>\r\n<li>Luồng kh&ocirc;ng kh&iacute;: 21.08 CFM</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 32.4963%;\" colspan=\"1\" rowspan=\"1\"><strong>Bơm</strong></td>\r\n<td style=\"width: 67.4622%;\"><strong>Giải ph&aacute;p:</strong>&nbsp;Bơm Asetek thế hệ thứ 8<br><strong>Tốc độ:</strong>&nbsp;800 - 3600 +/- 10% RPM</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 32.4963%;\"><strong>Bộ tản nhiệt v&agrave; ống</strong></td>\r\n<td style=\"width: 67.4622%;\"><strong>K&iacute;ch thước k&eacute;t tản nhiệt:</strong>&nbsp;399.5 x 120 x 30 mm<br><strong>Chất liệu k&eacute;t:</strong>&nbsp;Nh&ocirc;m<br><strong>Chất liệu ống:</strong>&nbsp;Ống dẫn được bọc cao su<br><strong>Chiều d&agrave;i ống:</strong>&nbsp;400mm</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 32.4963%;\"><strong>Th&ocirc;ng tin quạt</strong></td>\r\n<td style=\"width: 67.4622%;\">Quạt kết nối mở rộng bằng nam ch&acirc;m\r\n<ul>\r\n<li>K&iacute;ch thước: 3 x Chỗ Gắn Quạt (120mm)</li>\r\n<li>K&iacute;ch thước:&nbsp;120 x 120 x 25 mm</li>\r\n<li>Tốc độ: 600 - 2200 RPM +/- 10%</li>\r\n<li>&Aacute;p suất tĩnh: 3.88 mmH2O</li>\r\n<li>Luồng Kh&ocirc;ng Kh&iacute;: 70.07 CFM</li>\r\n<li>Độ ồn: 36.45 dB(A)</li>\r\n<li>Chế độ điều khiển: PWM/ DC</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 32.4963%;\"><strong>T&iacute;nh năng đặc biệt</strong></td>\r\n<td style=\"width: 67.4622%;\">M&agrave;n H&igrave;nh M&agrave;u LCD 3.5\"</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 32.4963%;\" colspan=\"1\" rowspan=\"1\"><strong>Khả năng tương th&iacute;ch</strong></td>\r\n<td style=\"width: 67.4622%;\">Intel: LGA 1700, 1200, 115x<br>AMD: AM5,AM4</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 32.4963%;\" colspan=\"1\"><strong>Sản phẩm gồm c&oacute;</strong></td>\r\n<td style=\"width: 67.4622%;\">\r\n<ul>\r\n<li>1 x Bộ tản nhiệt CPU bằng nước (dung dịch tản nhiệt nước c&oacute; sẵn)</li>\r\n<li>3 x Quạt tản nhiệt 120 mm ARGB</li>\r\n<li>1 x C&aacute;p Male d&agrave;nh cho quạt Daisy-chainable</li>\r\n<li>1 x C&aacute;p Female d&agrave;nh cho quạt Daisy-chainable</li>\r\n<li>1 x G&oacute;i phụ kiện ốc v&iacute;t v&agrave; bộ khung chuyển đổi ư</li>\r\n<li>1 x Hướng dẫn sử dụng nhanh</li>\r\n<li>1 x Sticker ROG</li>\r\n<li>1 x c&aacute;p ROG</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<h2><strong>Đ&aacute;nh gi&aacute; chi tiết sản phẩm tản nhiệt nước ASUS ROG RYUJIN III 360 ARGB White Edition</strong></h2>\r\n<p>&nbsp;</p>\r\n<p><a href=\"https://gearvn.com/collections/tan-nhiet-nuoc-240mm\">Tản nhiệt nước</a>&nbsp;ROG RYUJIN III 360 ARGB White Edition l&agrave; một trong những sản phẩm ti&ecirc;n tiến nhất trong lĩnh vực tản nhiệt cho m&aacute;y t&iacute;nh. Với thiết kế độc đ&aacute;o v&agrave; hiệu suất vượt trội, sản phẩm n&agrave;y kh&ocirc;ng chỉ đ&aacute;p ứng về nhu cầu Build PC đẹp gi&aacute; tốt m&agrave; c&ograve;n thỏa m&atilde;n nhu cầu về hiệu năng mạnh mẽ từ những th&ocirc;ng số ấn tượng.</p>\r\n<h3><strong>Đặc điểm nổi bật của d&ograve;ng sản phẩm tản nhiệt nước ROG RYUJIN III 360 ARGB White Edition</strong></h3>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/gearvn-tan-nhiet-nuoc-asus-rog-ryujin-iii-360-argb-white_edition-4_6b2b606da1594974971d8c60a74e44ce_large.png\"></p>\r\n<h4><strong>Hiệu suất l&agrave;m m&aacute;t tối ưu&nbsp;</strong></h4>\r\n<p>Với k&iacute;ch thước 89 x 91 x 101 mm cho khối nước v&agrave; 399.5 x 120 x 30 mm cho k&eacute;t tản nhiệt, sản phẩm n&agrave;y c&oacute; thiết kế nhỏ gọn, ph&ugrave; hợp với hầu hết c&aacute;c&nbsp;<a href=\"https://gearvn.com/collections/case-thung-may-tinh\">case m&aacute;y t&iacute;nh</a>&nbsp;m&agrave; vẫn tạo kh&ocirc;ng gian tho&aacute;ng kh&iacute; hiệu quả.</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/gearvn-tan-nhiet-nuoc-asus-rog-ryujin-iii-360-argb-white_edition-3_d3b70a8b339d454daedc015c9ebedf25_large.png\"></p>\r\n<p>&nbsp;</p>\r\n<p>Với k&iacute;ch thước k&eacute;t&nbsp;tản nhiệt c&oacute; k&iacute;ch thước tầm trung&nbsp;(&nbsp;399.5 x 120 x 30 mm), c&ugrave;ng với quạt t&iacute;ch hợp v&agrave; &aacute;p suất kh&ocirc;ng kh&iacute; 5.53 mmH2O, luồng kh&ocirc;ng kh&iacute; 21.08 CFM, sản phẩm đạt được hiệu suất l&agrave;m m&aacute;t ấn tượng. sản phẩm đảm bảo hiệu suất l&agrave;m m&aacute;t tối đa v&agrave; ổn định cho&nbsp;<a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a>&nbsp;khi hoạt động trong nhiều giờ v&agrave; đặc biệt với m&aacute;y thiết kế cũng hỗ trợ&nbsp;giảm nhiệt cho Card VGA trong m&aacute;y, hai bộ phận ch&iacute;nh n&agrave;y l&agrave; nguy&ecirc;n nh&acirc;n dẫn đến việc m&aacute;y t&iacute;nh đạt nhiệt độ cao n&ecirc;n việc gi&uacute;p l&agrave;m m&aacute;t hiệu quả l&agrave;m&nbsp;m&aacute;y t&iacute;nh của bạn được ổn định v&agrave; tối ưu hiệu suất l&agrave;m việc của bạn.</p>\r\n<h4><strong>M&agrave;n h&igrave;nh LCD 3.5\" độc đ&aacute;o</strong></h4>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/gearvn-tan-nhiet-nuoc-asus-rog-ryujin-iii-360-argb-white_edition-5_23f06d340a2346bab195409ee84f9e56_large.png\"></p>\r\n<p>&nbsp;</p>\r\n<p>Một điểm nhấn nổi bật của ROG RYUJIN III 360 ARGB White Edition l&agrave; m&agrave;n h&igrave;nh LCD 3.5\". Khả năng hiển thị th&ocirc;ng tin về nhiệt độ, tốc độ v&agrave; thậm ch&iacute; cả h&igrave;nh ảnh t&ugrave;y chỉnh l&agrave; một t&iacute;nh năng độc quyền chỉ c&oacute; trong sản phẩm n&agrave;y, với những&nbsp;th&ocirc;ng số hiển thị tr&ecirc;n m&agrave;n h&igrave;nh gi&uacute;p kiểm so&aacute;t được t&igrave;nh trạng của m&aacute;y t&iacute;nh ngo&agrave;i ra cũng tạo n&ecirc;n một chiếc&nbsp;<a href=\"https://gearvn.com/pages/pc-thiet-ke-do-hoa\">PC thiết kế</a>&nbsp;c&oacute; n&eacute;t độc đ&aacute;o&nbsp;thu h&uacute;t khi kết hợp với một chiếc vỏ case m&aacute;y t&iacute;nh c&oacute; k&iacute;nh cường lực trong suốt&nbsp;.</p>\r\n<h4><strong>Chất liệu đỉnh cao v&agrave; độ bền tốt</strong></h4>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/gearvn-tan-nhiet-nuoc-asus-rog-ryujin-iii-360-argb-white_edition-10_4ab5bc0dac3c40a1bce880b9bfe40ea6_large.png\"></p>\r\n<p>&nbsp;</p>\r\n<p>Với chất liệu l&agrave; đồng cho mặt tiếp x&uacute;c CPU, nh&ocirc;m cho k&eacute;t tản nhiệt v&agrave; ống dẫn được bọc cao su, ROG RYUJIN III 360 ARGB White Edition kh&ocirc;ng chỉ đảm bảo<strong>&nbsp;</strong>hiệu suất m&agrave; c&ograve;n mang đến độ bền vững chắc với những chất liệu cấu th&agrave;nh l&ecirc;n sản phẩm đều c&oacute; mức độ chịu nhiệt v&agrave;&nbsp;tạo ra một cấu&nbsp;tr&uacute;c chịu được &aacute;p suất cao khi hoạt động li&ecirc;n tục, nhờ đ&oacute; gi&uacute;p n&acirc;ng cao độ bền sản phẩm.</p>\r\n<h4><strong>Độ ồn thấp trong phạm vi hoạt&nbsp;</strong></h4>\r\n<p>Mặc d&ugrave; tốc độ quạt c&oacute; thể l&ecirc;n đến 5100 RPM, độ ồn chỉ ở mức 36.45 dB(A), việc thiết kế tốc độ cao gi&uacute;p l&agrave;m m&aacute;t thiết bị b&ecirc;n trong nhưng kh&ocirc;ng tạo ra tiếng ồn gi&uacute;p m&aacute;y t&iacute;nh của bạn tr&ocirc;ng c&oacute; n&eacute;t mượt m&agrave;, tạo ra trải nghiệm y&ecirc;n tĩnh hơn so với nhiều sản phẩm tương tự tr&ecirc;n thị trường.</p>\r\n<h3><strong>Tản nhiệt nước được thiết kế với c&aacute;c th&ocirc;ng số kỹ thuật v&agrave; cấu tr&uacute;c đặc biệt</strong></h3>\r\n<p>Bao gồm 3 quạt 120mm ARGB với tốc độ điều chỉnh từ 600 đến 2200 RPM, cung cấp luồng kh&ocirc;ng kh&iacute; lớn v&agrave; &aacute;p suất tĩnh cao. Bơm c&oacute; tốc độ điều chỉnh từ 800 đến 3600 RPM, gi&uacute;p duy tr&igrave; hiệu suất l&agrave;m m&aacute;t ổn định v&agrave; hiệu quả.</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/gearvn-tan-nhiet-nuoc-asus-rog-ryujin-iii-360-argb-white_edition-9_69bcb6d9463f43be9804a1c8447d90f5_large.png\"></p>\r\n<p>Kh&ocirc;ng chỉ d&agrave;nh cho&nbsp;<a href=\"https://gearvn.com/pages/pc-gvn\">PC gaming</a>, chiếc tản nhiệt nước n&agrave;y cũng mang lại sự ổn định v&agrave; tin cậy trong m&ocirc;i trường l&agrave;m việc văn ph&ograve;ng. Việc duy tr&igrave; CPU ở nhiệt độ ổn định gi&uacute;p m&aacute;y t&iacute;nh hoạt động mượt m&agrave; v&agrave; hiệu quả.&nbsp;Sản phẩm&nbsp;<a href=\"https://gearvn.com/products/tan-nhiet-nuoc-asus-rog-ryujin-iii-360-argb-white-edition\">ROG RYUJIN III 360 ARGB White Edition</a> n&agrave;y kh&ocirc;ng chỉ gi&uacute;p duy tr&igrave; m&aacute;y t&iacute;nh vận h&agrave;nh ổn định m&agrave; c&ograve;n phục vụ tốt cho c&aacute;c nhu cầu văn ph&ograve;ng th&ocirc;ng thường. Việc giữ m&aacute;y t&iacute;nh ở nhiệt độ ổn định gi&uacute;p tăng hiệu suất l&agrave;m việc v&agrave; đảm bảo sự trơn tru&nbsp;trong c&ocirc;ng việc h&agrave;ng ng&agrave;y.</p>', '8990000.00', '9990000.00', 96, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 1, 24, 1, 'images/T6K0dnHfIvvSZj4bq4sqHx3tR2QRaU6jIi465pMa.png', '2025-07-29 15:02:26', '2025-09-13 03:02:09', NULL, 2, 40),
(4, 'Tản nhiệt AIO GIGABYTE AORUS WATERFORCE X II 360', 'WD9156', '<h2><strong>Tản nhiệt nước GIGABYTE AORUS WATERFORCE X II 360</strong></h2>\r\n<h3><strong>Th&ocirc;ng số kỹ thuật:</strong></h3>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" style=\"width: 101.322%;\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 35.4221%;\"><strong>Bộ tản nhiệt &amp; khối</strong></td>\r\n<td style=\"width: 64.552%;\">K&iacute;ch thước : 394 x 119 x 27mm<br>K&iacute;ch thước bơm: 87,6 x 87,6 x 77,7mm<br>Chất liệu tản nhiệt: Nh&ocirc;m<br>Vật liệu khối: Đồng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 35.4221%;\"><strong>CPU Socket:</strong></td>\r\n<td style=\"width: 64.552%;\">Intel 115x,1200,1700<br>AMD TR4, AM5, AM4, sTR5</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 35.4221%;\"><strong>LCD Display:</strong></td>\r\n<td style=\"width: 64.552%;\">60 x 60mm Full Color LCD</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 35.4221%;\"><strong>Bơm:</strong></td>\r\n<td style=\"width: 64.552%;\">Tốc độ: 2500~3000 RPM +/-10%</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 35.4221%;\"><strong>Quạt:</strong></td>\r\n<td style=\"width: 64.552%;\">Th&ocirc;ng số: Quạt ARGB 3 x 120mm<br>Tốc độ: 800 ~ 2400 RPM +/- 10%<br>Loại v&ograve;ng bi: FDB<br>Lưu lượng kh&iacute;: 72 CFM<br>&Aacute;p suất kh&ocirc;ng kh&iacute;: 3,15mmH20<br>Mức ồn: 12 ~ 37,5 dBA</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 35.4221%;\"><strong>Phần mềm:</strong></td>\r\n<td style=\"width: 64.552%;\">GCC</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '7990000.00', '8990000.00', 96, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 2, 24, 1, 'images/xDXYcQKzr5j0XSP9G0ubZqHnklgcKOGFsicncYKn.png', '2025-07-29 15:13:02', '2025-09-13 03:02:19', NULL, 0, 10),
(5, 'PC GVN Intel i5-12400F/ VGA RTX 5060 (Main H)', 'WD5709', NULL, NULL, NULL, 0, NULL, 1, 1, 1, 1, 1, 1, 1, 3, 1, 36, 1, 'images/ak0bCtIMgpv0OymbwNUQRxJuzvPkA4XXhhW0ptBa.jpg', '2025-08-20 00:54:58', '2025-09-17 01:35:21', NULL, 1, 29),
(6, 'PC GVN x MSI PROJECT ZERO WHITE (Intel i5-14400F/ VGA RTX 5060)', 'WD1194', '<p><strong>Th&ocirc;ng số kỹ thuật:</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" style=\"width: 101.162%;\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.0695%;\"><strong>Mainboard&nbsp;</strong></td>\r\n<td style=\"width: 78.642%;\"><strong><a href=\"https://gearvn.com/products/bo-mach-chu-msi-b760m-project-zero/\">MSI B760M PROJECT ZERO</a></strong></td>\r\n<td style=\"width: 9.27442%;\">36 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.0695%;\"><strong>CPU</strong></td>\r\n<td style=\"width: 78.642%;\"><strong><a href=\"https://gearvn.com/products/bo-vi-xu-ly-intel-core-i5-14400f\">Intel Core i5 14400F / Turbo up to 4.7GHz / 10 Nh&acirc;n 16 Luồng / 20MB / LGA 1700</a></strong></td>\r\n<td style=\"width: 9.27442%;\">36 Th&aacute;ng</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 12.0695%;\"><strong>RAM</strong></td>\r\n<td style=\"width: 78.642%;\"><strong><a href=\"https://gearvn.com/products/ram-corsair-vengeance-rgb-32gb-2x16gb-5600-ddr5-cmh32gx5m2b5600c40k\">Ram Corsair Vengeance RGB (2x16GB) 32GB 5600 DDR5</a></strong></td>\r\n<td style=\"width: 9.27442%;\">36 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.0695%;\"><strong>VGA</strong></td>\r\n<td style=\"width: 78.642%;\"><strong><a href=\"https://gearvn.com/products/card-man-hinh-msi-geforce-rtx-5060-ventus-2x-oc-white-8gb\">Card m&agrave;n h&igrave;nh MSI GeForce RTX 5060 Ventus 2X OC White 8GB</a></strong></td>\r\n<td style=\"width: 9.27442%;\">36 Th&aacute;ng</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 12.0695%;\"><strong>SSD</strong></td>\r\n<td style=\"width: 78.642%;\"><strong><a href=\"https://gearvn.com/products/o-cung-ssd-kingston-nv3-1tb-m-2-pcie-nvme-gen4\">Ổ cứng SSD Kingston NV3 1TB M.2 PCIe NVMe Gen4</a></strong></td>\r\n<td style=\"width: 9.27442%;\">&nbsp;</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.0695%;\"><strong>HDD</strong></td>\r\n<td style=\"width: 78.642%;\"><strong>T&ugrave;y chọn&nbsp;<a href=\"https://gearvn.com/collections/hdd-o-cung-pc\">n&acirc;ng cấp</a></strong></td>\r\n<td style=\"width: 9.27442%;\">24 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.0695%;\"><strong>PSU&nbsp;</strong></td>\r\n<td style=\"width: 78.642%;\"><strong><a href=\"https://gearvn.com/products/nguon-may-tinh-msi-mag-a750bn-pcie5-80-plus-bronze-750w\">MSI MAG A750BN PCIE5 - 80 Plus Bronze (750W)</a></strong></td>\r\n<td style=\"width: 9.27442%;\">36&nbsp;Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.0695%;\"><strong>CASE</strong></td>\r\n<td style=\"width: 78.642%;\"><strong><a href=\"https://gearvn.com/products/vo-may-tinh-msi-mag-pano-m100r-pz-white/\">MSI MAG PANO M100R PZ WHITE</a></strong></td>\r\n<td style=\"width: 9.27442%;\">12 Th&aacute;ng</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 12.0695%;\"><strong>COOLING</strong></td>\r\n<td style=\"width: 78.642%;\"><strong><a href=\"https://gearvn.com/products/tan-nhiet-aio-msi-mag-coreliquid-i240-white\">Tản nhiệt AIO MSI MAG CORELIQUID I240 WHITE</a></strong></td>\r\n<td style=\"width: 9.27442%;\">36&nbsp;Th&aacute;ng</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<h2><strong>Đ&aacute;nh gi&aacute; chi tiết sản phẩm&nbsp;PC GVN x MSI PROJECT ZERO WHITE</strong></h2>\r\n<p>Để c&oacute; một d&agrave;n&nbsp;<a href=\"https://gearvn.com/pages/pc-gvn\">PC Gaming</a>&nbsp;chuẩn chỉnh v&agrave; c&oacute; một thiết kế cực đẹp&nbsp;PC GVN x MSI PROJECT ZERO WHITE được ưu ti&ecirc;n lựa chọn những linh kiện m&aacute;y t&iacute;nh tốt nhất trong&nbsp;tầm gi&aacute;&nbsp;được&nbsp;cung cấp bởi&nbsp;MSI n&ecirc;n cho ra&nbsp;trải nghiệm ấn tượng.&nbsp;Ngo&agrave;i ra, với sự đồng bộ trong<a href=\"https://gearvn.com/collections/linh-kien-may-tinh\">&nbsp;linh kiện m&aacute;y t&iacute;nh</a>&nbsp;như thế&nbsp;gi&uacute;p cho d&agrave;n m&aacute;y t&iacute;nh của bạn&nbsp;c&oacute;&nbsp;được hỗ trợ tốt từ hiệu suất&nbsp;phần cứng lẫn tối ưu h&oacute;a phần mềm. B&acirc;y giờ th&igrave; c&ugrave;ng t&igrave;m hiểu những n&eacute;t đặc trưng của PC GVN x MSI PROJECT ZERO WHITE n&agrave;y để xem n&oacute; đ&aacute;ng sở hữu như n&agrave;o.&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gearvn-pc-gvn-x-msi-project-zero-white-25_2a0aa63c7bcc43159e5eba129d774aa4_grande.png\" alt=\"PC GVN x MSI PROJECT ZERO WHITE (Intel i5-13400F/ VGA RTX 4060)\"></p>\r\n<h3><strong>Thiết kế&nbsp;ngoại h&igrave;nh tinh tế</strong></h3>\r\n<p>Trong c&aacute;c&nbsp;<a href=\"https://gearvn.com/collections/case-thung-may-tinh\">vỏ Case&nbsp;m&aacute;y t&iacute;nh</a>&nbsp;th&igrave;&nbsp;MSI MAG PANO M100R PZ WHITE c&oacute; một thiết kế để lại nhiều ấn tượng nhất trong tầm gi&aacute; b&aacute;n lẻ m&agrave;&nbsp;n&oacute; sở hữu với k&iacute;ch thước tầm trung&nbsp;Micro- ATX Tower (440 x 235 x 405 mm)&nbsp;cho g&oacute;c nh&igrave;n xuy&ecirc;n thấu l&ecirc;n đến 270 độ, với đặc t&iacute;nh&nbsp;rộng r&atilde;i v&agrave; th&ocirc;ng tho&aacute;ng n&ecirc;n cho ph&eacute;p lắp đặt linh kiện ở k&iacute;ch cỡ phổ biến như&nbsp;<a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a>&nbsp;MSI B760M PROJECT ZERO.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gearvn-pc-gvn-x-msi-project-zero-white-29_a6b8f5813f444dd1ac779cb9e9be7c51_grande.png\" alt=\"PC GVN x MSI PROJECT ZERO WHITE (Intel i5-13400F/ VGA RTX 4060)\"></p>\r\n<p>Về độ thẩm mỹ&nbsp;PC GVN x MSI PROJECT ZERO WHITE c&oacute;&nbsp;một thiết kế g&oacute;c cạnh cho&nbsp;từng chi tiết từ phần vỏ đến nội thất b&ecirc;n trong, với ưu ti&ecirc;n về sự gọn g&agrave;ng th&igrave; chiếc PC GVN x MSI PROJECT ZERO WHITE c&oacute; c&aacute;ch đi d&acirc;y rất tốt khi kh&ocirc;ng thể hiện phần d&acirc;y thừa ra mặt trước của nội thất.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gearvn-pc-gvn-x-msi-project-zero-white-30_1734de67b9dd4fdc9c052251a93ca66a_grande.png\" alt=\"PC GVN x MSI PROJECT ZERO WHITE (Intel i5-13400F/ VGA RTX 4060)\"></p>\r\n<p>Bằng c&aacute;ch di chuyển hầu hết c&aacute;c đầu nối c&aacute;p ra ph&iacute;a sau bo mạch chủ,&nbsp;PC GVN x MSI PROJECT ZERO WHITE giữ cho mặt trước tinh gọn hơn để trưng b&agrave;y&nbsp;<a href=\"https://gearvn.com/collections/tan-nhiet-nuoc-240mm\">tản nhiệt nước</a>&nbsp;v&agrave; card đồ họa m&agrave; kh&ocirc;ng cần d&acirc;y c&aacute;p phiền phức.</p>\r\n<h3><strong>Hiệu năng hoạt động</strong></h3>\r\n<p>B&ecirc;n cạnh n&eacute;t thẩm mỹ th&igrave;&nbsp;PC GVN x MSI PROJECT ZERO WHITE&nbsp;cũng cho một hiệu năng kh&aacute; y&ecirc;n t&acirc;m. ho&agrave;n to&agrave;n&nbsp;đ&aacute;p ứng tốt nhu cầu gaming, xử l&yacute; đồ họa v&agrave; render video với cấu tạo từ linh kiện c&oacute; th&ocirc;ng số kh&aacute; tốt.</p>\r\n<p>&nbsp;</p>\r\n<h4><strong>Bộ vi xử l&yacute; Intel Core i5 14400F / Turbo up to 4.7GHz / 10 Nh&acirc;n 16 Luồng / 20MB / LGA 1700</strong></h4>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/n22561-001-i5f-_univ_2e1135c9919d46ce97e95d2e19cb74f3_grande.png\"></p>\r\n<p>&nbsp;</p>\r\n<p>Chưa cần bận t&acirc;m qu&aacute; nhiều v&agrave;o&nbsp;card đồ họa v&agrave;&nbsp;<a href=\"https://gearvn.com/collections/ram-pc\">ram</a>&nbsp;m&aacute;y t&iacute;nh th&igrave; với&nbsp;<a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a>&nbsp;Intel Core i5 14400F&nbsp; đủ cho chiếc&nbsp;PC GVN x MSI PROJECT ZERO WHITE của&nbsp;bạn thao t&aacute;c những t&aacute;c vụ chơi game v&agrave; đồ họa ở mức kh&aacute; tốt. Với&nbsp;cấu tạo 10 nh&acirc;n 16 luồng cho ra&nbsp;tốc độ của l&otilde;i hiệu năng l&ecirc;n đến 4.7 GHz v&agrave; sở hữu tốc độ của l&otilde;i hiệu suất l&ecirc;n đến 3.3 GHz,&nbsp;hỗ trợ cho cả bộ nhớ loại&nbsp;<a href=\"https://gearvn.com/collections/ram-pc-ddr5\">DDR5</a> (4800 MT/s)&nbsp;V&agrave; DDR4 (3200 MT/s) n&ecirc;n hiệu năng cơ&nbsp;bản đ&atilde; đủ khiến bạn y&ecirc;n t&acirc;m sử dụng l&acirc;u d&agrave;i.</p>', NULL, NULL, 0, NULL, 1, 2, 2, 2, 2, 5, 4, 1, 1, 36, 1, 'images/WtjAM9GUY55RWILyxd7LTgaefndodHh52rQ6yH43.jpg', '2025-08-20 08:19:24', '2025-09-17 01:35:08', NULL, 3, 38),
(7, 'PC GVN Intel i7-14700F/ VGA RTX 5060', 'WD9261', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong><strong>:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" style=\"width: 101.001%;\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.7008%;\"><a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a></td>\r\n<td style=\"width: 78.0964%;\"><a href=\"https://gearvn.com/products/bo-mach-chu-msi-z790-gaming-plus-wifi-ddr5\">Bo mạch chủ MSI Z790 GAMING PLUS WIFI DDR5</a></td>\r\n<td style=\"width: 9.18781%;\">36 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.7008%;\"><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a></td>\r\n<td style=\"width: 78.0964%;\"><a href=\"https://gearvn.com/products/bo-vi-xu-ly-intel-core-i7-14700f\">Bộ vi xử l&yacute; Intel Core i7 14700F/Turbo up to 5.4GHz/20 Nh&acirc;n 28 Luồng</a></td>\r\n<td style=\"width: 9.18781%;\">36 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.7008%;\"><a href=\"https://gearvn.com/collections/ram-pc\">RAM</a></td>\r\n<td style=\"width: 78.0964%;\"><a href=\"https://gearvn.com/products/ram-corsair-vengeance-rgb-32gb-2x16gb-5600-ddr5-cmh32gx5m2b5600c40k\">Ram Corsair Vengeance RGB 32GB 5600 DDR5</a></td>\r\n<td style=\"width: 9.18781%;\">36 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.7008%;\"><a href=\"https://gearvn.com/collections/vga-card-man-hinh\">VGA</a>&nbsp;</td>\r\n<td style=\"width: 78.0964%;\"><a href=\"https://gearvn.com/products/card-man-hinh-msi-geforce-rtx-5060-ventus-2x-oc-8gb\">Card m&agrave;n h&igrave;nh MSI GeForce RTX 5060 Ventus 2X OC 8GB</a></td>\r\n<td style=\"width: 9.18781%;\">36 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.7008%;\">HDD</td>\r\n<td style=\"width: 78.0964%;\">C&oacute; thể t&ugrave;y chọn&nbsp;<a title=\"https://gearvn.com/collections/hdd-o-cung-pc\" href=\"https://gearvn.com/collections/hdd-o-cung-pc\">N&acirc;ng cấp</a></td>\r\n<td style=\"width: 9.18781%;\">24 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.7008%;\"><a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a></td>\r\n<td style=\"width: 78.0964%;\"><a href=\"https://gearvn.com/products/o-cung-ssd-kingston-nv3-500gb-m-2-pcie-nvme-gen4\">Ổ cứng SSD Kingston NV3 500GB M.2 PCIe NVMe Gen4 (Đọc/Ghi - 5000/3000)</a></td>\r\n<td style=\"width: 9.18781%;\">36 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.7008%;\"><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a></td>\r\n<td style=\"width: 78.0964%;\"><a href=\"https://gearvn.com/products/nguon-may-tinh-cooler-master-mwe-750-80-plus-bronze-v3-230v-750w\">Nguồn m&aacute;y t&iacute;nh Cooler Master MWE 750 - 80 Plus Bronze - V3 230V (750W)</a></td>\r\n<td style=\"width: 9.18781%;\">36 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 12.7008%;\"><a href=\"https://gearvn.com/collections/case-thung-may-tinh\">Case</a></td>\r\n<td style=\"width: 78.0964%;\"><a href=\"https://gearvn.com/products/vo-may-tinh-cooler-master-cd600-black\">Vỏ m&aacute;y t&iacute;nh Cooler Master CD600 Black</a></td>\r\n<td style=\"width: 9.18781%;\">12 Th&aacute;ng</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 12.7008%;\">Tản nhiệt</td>\r\n<td style=\"width: 78.0964%;\"><a href=\"https://gearvn.com/products/tan-nhiet-aio-cooler-master-masterliquid-360-core-si-argb\">Tản nhiệt AIO Cooler Master MasterLiquid 360 Core SI ARGB</a></td>\r\n<td style=\"width: 9.18781%;\">24 Th&aacute;ng</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 3, 3, 3, 2, 1, 2, 1, 1, 36, 1, 'images/kZVqAcWL4TS5r1f8D0zKVg0VGIwPEqq1Gb46PlLw.jpg', '2025-08-21 02:44:11', '2025-09-17 01:34:48', NULL, 1, 5),
(8, 'PC GVN Intel i3-12100F/ VGA RTX 3050', 'WD3852', NULL, NULL, NULL, 0, NULL, 1, 4, 1, 4, 1, 1, 4, 3, 1, 36, 1, 'images/f9ee4wv5TWWfVcBD0hvju2qYopOTfj6hebgrPpK4.jpg', '2025-08-21 03:02:14', '2025-09-17 01:34:31', NULL, 0, 1),
(9, 'PC GVN Intel i5-14400F/ VGA RTX 5060 (DDR5)', 'WD3110', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong><strong>:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" style=\"width: 100.599%;\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 15.7701%;\"><strong><a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a></strong></td>\r\n<td style=\"width: 72.7002%;\"><a href=\"https://gearvn.com/products/bo-mach-chu-msi-mag-b760m-mortar-ii-wifi-ddr5\">Bo mạch chủ MSI MAG B760M MORTAR II WIFI DDR5</a></td>\r\n<td style=\"width: 11.5122%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 15.7701%;\"><strong><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a></strong></td>\r\n<td style=\"width: 72.7002%;\"><a href=\"https://gearvn.com/products/bo-vi-xu-ly-intel-core-i5-14400f\">Bộ vi xử l&yacute; Intel Core i5-14400F</a></td>\r\n<td style=\"width: 11.5122%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 15.7701%;\"><strong><a href=\"https://gearvn.com/collections/ram-pc\">RAM</a></strong></td>\r\n<td style=\"width: 72.7002%;\"><a href=\"https://gearvn.com/products/ram-corsair-vengeance-rgb-32gb-2x16gb-5600-ddr5-cmh32gx5m2b5600c40k\">Ram Corsair Vengeance RGB 32GB 5600 DDR5</a></td>\r\n<td style=\"width: 11.5122%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 15.7701%;\"><strong><a href=\"https://gearvn.com/collections/vga-card-man-hinh\">VGA</a>&nbsp;</strong></td>\r\n<td style=\"width: 72.7002%;\"><a href=\"https://gearvn.com/products/card-man-hinh-gigabyte-geforce-rtx-5060-windforce-oc-8gb\">Card m&agrave;n h&igrave;nh Gigabyte GeForce RTX 5060 Windforce OC 8GB</a></td>\r\n<td style=\"width: 11.5122%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 15.7701%;\"><strong>HDD</strong></td>\r\n<td style=\"width: 72.7002%;\">C&oacute; thể t&ugrave;y chọn&nbsp;<a title=\"https://gearvn.com/collections/hdd-o-cung-pc\" href=\"https://gearvn.com/collections/hdd-o-cung-pc\">N&acirc;ng cấp</a></td>\r\n<td style=\"width: 11.5122%;\"><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 15.7701%;\"><strong><a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a></strong></td>\r\n<td style=\"width: 72.7002%;\"><a href=\"https://gearvn.com/products/o-cung-ssd-kingston-nv3-500gb-m-2-pcie-nvme-gen4\">Ổ cứng SSD Kingston NV3 500GB M.2 PCIe NVMe Gen4</a></td>\r\n<td style=\"width: 11.5122%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 15.7701%;\"><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a></strong></td>\r\n<td style=\"width: 72.7002%;\"><a href=\"https://gearvn.com/products/650w-nguon-fsp-hv-pro-650w-80-plus-bronze\">Nguồn FSP HV PRO 650W - 80 Plus Bronze</a></td>\r\n<td style=\"width: 11.5122%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 15.7701%;\"><strong><a href=\"https://gearvn.com/collections/case-thung-may-tinh\">Case</a></strong></td>\r\n<td style=\"width: 72.7002%;\"><a href=\"https://gearvn.com/products/vo-may-tinh-xigmatek-quantum-3gf\">Vỏ m&aacute;y t&iacute;nh Xigmatek QUANTUM 3GF</a></td>\r\n<td style=\"width: 11.5122%;\"><strong>12 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 15.7701%;\"><strong>Tản nhiệt</strong></td>\r\n<td style=\"width: 72.7002%;\"><a href=\"https://gearvn.com/products/tan-nhiet-cooler-master-hyper-212-spectrum-v3-argb/\" target=\"_blank\" rel=\"noopener\">Cooler Master Hyper 212 Spectrum V3 ARGB</a></td>\r\n<td style=\"width: 11.5122%;\"><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 2, 5, 5, 1, 1, 4, 3, 2, 36, 1, 'images/LdILHlNMjBm0ItNHBI56gI5QWN8WWmr1mt39KqEq.jpg', '2025-08-21 03:07:30', '2025-09-17 01:34:16', NULL, 0, 1),
(10, 'PC GVN Intel i5-12400F/ VGA RTX 4060', 'WD8129', '<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/mang-nhen-pc-28_5bc02abe60784e26bd16161af58dd8eb.png\"></p>\r\n<p>&nbsp;</p>\r\n<h2><strong>Th&ocirc;ng số kỹ thuật</strong><strong>:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" style=\"width: 101.162%;\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 11.6593%;\"><strong><a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a></strong></td>\r\n<td style=\"width: 79.8482%;\"><a href=\"https://gearvn.com/products/bo-mach-chu-asus-prime-b760m-a-wifi-d4-csm\">Mainboard ASUS PRIME B760M-A WIFI D4 CSM</a></td>\r\n<td style=\"width: 8.47946%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 11.6593%;\"><strong><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a></strong></td>\r\n<td style=\"width: 79.8482%;\"><a href=\"https://gearvn.com/products/intel-core-i5-12400f\">CPU Intel Core i5 12400F / 2.5GHz Turbo 4.4GHz / 6 Nh&acirc;n 12 Luồng&nbsp;<strong>(Ch&iacute;nh h&atilde;ng - Full Box)</strong></a></td>\r\n<td style=\"width: 8.47946%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 11.6593%;\"><strong><a href=\"https://gearvn.com/collections/ram-pc\">RAM</a></strong></td>\r\n<td style=\"width: 79.8482%;\"><a href=\"https://gearvn.com/products/ram-v-color-skywalker-plus-1x16gb-3600-rgb-black-ddr4-tl416g36s818cspkws\">RAM V-Color Skywalker Plus&nbsp;<strong>1x16GB 3600 RGB</strong>&nbsp;Black DDR4</a></td>\r\n<td style=\"width: 8.47946%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 11.6593%;\"><strong><a href=\"https://gearvn.com/collections/vga-card-man-hinh\">VGA</a>&nbsp;</strong></td>\r\n<td style=\"width: 79.8482%;\"><a href=\"https://gearvn.com/products/card-man-hinh-gigabyte-geforce-rtx-4060-windforce-oc-8g\">Card m&agrave;n h&igrave;nh GIGABYTE GeForce RTX 4060 WINDFORCE OC 8G</a></td>\r\n<td style=\"width: 8.47946%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 11.6593%;\"><strong>HDD</strong></td>\r\n<td style=\"width: 79.8482%;\">C&oacute; thể t&ugrave;y chọn&nbsp;<a title=\"https://gearvn.com/collections/hdd-o-cung-pc\" href=\"https://gearvn.com/collections/hdd-o-cung-pc\">N&acirc;ng cấp</a></td>\r\n<td style=\"width: 8.47946%;\"><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 11.6593%;\"><strong><a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a></strong></td>\r\n<td style=\"width: 79.8482%;\"><a title=\"Gigabyte 120GB 2.5\" href=\"https://gearvn.com/products/o-cung-ssd-kingston-nv3-500gb-m-2-pcie-nvme-gen4\" target=\"_blank\" rel=\"noopener noreferrer\">Kingston NV3 500GB M.2 PCIe NVMe&nbsp;Gen4 -&nbsp;<strong>Tốc độ (5000/3000)</strong></a></td>\r\n<td style=\"width: 8.47946%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 11.6593%;\"><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a></strong></td>\r\n<td style=\"width: 79.8482%;\"><a href=\"https://gearvn.com/products/550w-nguon-fsp-hv-pro-550w-80-plus-bronze\" target=\"_blank\" rel=\"noopener\">FSP HV PRO 550W - 80 Plus Bronze (550W)</a></td>\r\n<td style=\"width: 8.47946%;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 11.6593%;\"><strong><a href=\"https://gearvn.com/collections/case-thung-may-tinh\">Case</a></strong></td>\r\n<td style=\"width: 79.8482%;\"><a href=\"https://gearvn.com/products/vo-may-tinh-xigmatek-quantum-3gf\">Vỏ m&aacute;y t&iacute;nh Xigmatek QUANTUM 3GF</a></td>\r\n<td style=\"width: 8.47946%;\"><strong>12 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 11.6593%;\"><strong>Tản nhiệt</strong></td>\r\n<td style=\"width: 79.8482%;\"><a href=\"https://gearvn.com/products/tan-nhiet-cooler-master-hyper-212-spectrum-v3-argb/\" target=\"_blank\" rel=\"noopener\">Cooler Master Hyper 212 Spectrum V3 ARGB</a></td>\r\n<td style=\"width: 8.47946%;\"><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 1, 6, 6, 1, 1, 1, 3, 2, 36, 1, 'images/G74hMrBt92aSHxaGKJxe9wIvYUdRb7aBcF7aKy7B.jpg', '2025-08-21 03:10:54', '2025-09-17 00:55:01', NULL, 0, 3),
(11, 'PC GVN INT x MSI Dragon GODLIKE (Intel Core Ultra 9 285K/ VGA RTX 5090) (Powered by MSI)', 'WD3721', '<p><strong>Th&ocirc;ng số kỹ thuật:</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" style=\"width: 100.84%; border-collapse: collapse; border-width: 1px; border-spacing: 0px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 11.7558%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a>&nbsp;</strong></td>\r\n<td style=\"width: 79.9395%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/products/bo-mach-chu-msi-meg-z890-godlike-ddr5\">Bo mạch chủ MSI MEG Z890 GODLIKE</a></strong></td>\r\n<td style=\"width: 8.29094%; border-width: 1px; padding: 0px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 11.7558%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a>&nbsp;</strong></td>\r\n<td style=\"width: 79.9395%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/products/bo-vi-xu-ly-intel-core-ultra-9-285k\" target=\"_blank\" rel=\"noopener\">Intel Core Ultra 9 285K / Turbo up to 5.7GHz / 24 Nh&acirc;n 24 Luồng / 36MB / LGA 1851</a></strong></td>\r\n<td style=\"width: 8.29094%; border-width: 1px; padding: 0px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 11.7558%; border-width: 1px; padding: 0px;\"><strong>RAM</strong></td>\r\n<td style=\"width: 79.9395%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/products/ram-corsair-dominator-titanium-black-96gb-2x48gb-rgb-6600-ddr5-cmp96gx5m2b6600c32\" target=\"_blank\" rel=\"noopener\">Corsair Dominator Titanium Black 96GB (2x48GB) RGB 6600 DDR5</a></strong></td>\r\n<td style=\"width: 8.29094%; border-width: 1px; padding: 0px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 11.7558%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/collections/vga-card-man-hinh\">VGA</a>&nbsp;</strong></td>\r\n<td style=\"width: 79.9395%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/products/card-man-hinh-msi-geforce-rtx-5090-32g-suprim-soc\" target=\"_blank\" rel=\"noopener\">MSI GeForce RTX 5090 32G SUPRIM SOC</a></strong></td>\r\n<td style=\"width: 8.29094%; border-width: 1px; padding: 0px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 11.7558%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a></strong></td>\r\n<td style=\"width: 79.9395%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/products/o-cung-ssd-msi-spatium-m480-pro-pcie-4-0-nvme-m-2-1tb/\" target=\"_blank\" rel=\"noopener\">MSI SPATIUM M480 PRO PCIe 4.0 NVMe M.2 1TB</a></strong></td>\r\n<td style=\"width: 8.29094%; border-width: 1px; padding: 0px;\"><strong>60 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 11.7558%; border-width: 1px; padding: 0px;\"><strong>HDD</strong></td>\r\n<td style=\"width: 79.9395%; border-width: 1px; padding: 0px;\"><strong>T&ugrave;y chọn&nbsp;<a href=\"https://gearvn.com/collections/hdd-o-cung-pc\">n&acirc;ng cấp</a></strong></td>\r\n<td style=\"width: 8.29094%; border-width: 1px; padding: 0px;\"><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 11.7558%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a></strong></td>\r\n<td style=\"width: 79.9395%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/products/nguon-may-tinh-msi-meg-ai1600t-pcie5-80-plus-titanium-1600w\">Nguồn m&aacute;y t&iacute;nh MSI MEG AI1600T PCIE5 - 80 Plus Titanium (1600W)</a></strong></td>\r\n<td style=\"width: 8.29094%; border-width: 1px; padding: 0px;\"><strong>60 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 11.7558%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/collections/case-thung-may-tinh\">CASE</a></strong></td>\r\n<td style=\"width: 79.9395%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/products/vo-may-tinh-msi-meg-maestro-700l-pz\">Vỏ m&aacute;y t&iacute;nh MSI MEG MAESTRO 700L PZ</a></strong></td>\r\n<td style=\"width: 8.29094%; border-width: 1px; padding: 0px;\"><strong>12 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 11.7558%; border-width: 1px; padding: 0px;\"><strong>Tản nhiệt</strong></td>\r\n<td style=\"width: 79.9395%; border-width: 1px; padding: 0px;\"><strong><a href=\"https://gearvn.com/products/tan-nhiet-aio-msi-mag-coreliquid-i360-black\">Tản nhiệt AIO MSI MAG CORELIQUID I360 BLACK ch&iacute;nh h&atilde;ng&nbsp;</a></strong></td>\r\n<td style=\"width: 8.29094%; border-width: 1px; padding: 0px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 5, 7, 7, 4, 5, 5, 1, 3, 36, 1, 'images/BsZybqznBaTcR4I6xYYePb6O0QUHmr1psGJ3ggJ5.jpg', '2025-08-21 03:20:43', '2025-09-17 01:33:55', NULL, 0, 4);
INSERT INTO `san_phams` (`id`, `ten`, `ma_san_pham`, `mo_ta`, `gia`, `gia_so_sanh`, `so_luong`, `sku`, `co_bien_the`, `id_chip`, `id_mainboard`, `id_gpu`, `id_tannhiet`, `id_case`, `id_nguon`, `id_category`, `id_brand`, `bao_hanh_thang`, `hoat_dong`, `anh_dai_dien`, `created_at`, `updated_at`, `deleted_at`, `luot_mua`, `luot_xem`) VALUES
(12, 'Chuột Gaming Asus TUF M4 Wireless', 'WD7042', '<p><strong>Th&ocirc;ng số sản phẩm:</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" style=\"width: 101.242%;\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Thương hiệu</strong></td>\r\n<td style=\"width: 89.8263%;\">Asus</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Bảo h&agrave;nh</strong></td>\r\n<td style=\"width: 89.8263%;\">24 th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Model</strong></td>\r\n<td style=\"width: 89.8263%;\">Chuột gaming kh&ocirc;ng d&acirc;y TUF GAMING M4 Wireless 2.4, si&ecirc;u nhẹ, cảm biến 12.000 dpi, nắp vỏ bằng PBT, feet chuột 100% PTFE, Armoury Crate</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>M&agrave;u sắc</strong></td>\r\n<td style=\"width: 89.8263%;\">Đen</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Kiểu kết nối</strong></td>\r\n<td style=\"width: 89.8263%;\">Wireless<br>Bluetooth 5.1</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Thời lượng pin</strong></td>\r\n<td style=\"width: 89.8263%;\">\r\n<ul>\r\n<li>Pin AA&nbsp;\r\n<ul>\r\n<li>RF 2.4: 134 giờ</li>\r\n<li>BLE: 232 giờ</li>\r\n</ul>\r\n</li>\r\n<li>Pin AAA&nbsp;\r\n<ul>\r\n<li>RF 2.4: 53 giờ</li>\r\n<li>BLE: 100 giờ</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>LED</strong></td>\r\n<td style=\"width: 89.8263%;\">Kh&ocirc;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Kiểu thiết kế</strong></td>\r\n<td style=\"width: 89.8263%;\">C&ocirc;ng th&aacute;i học</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Cảm biến</strong></td>\r\n<td style=\"width: 89.8263%;\">Quang học</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Độ nhạy</strong></td>\r\n<td style=\"width: 89.8263%;\">12.000 DPI</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Số n&uacute;t bấm</strong></td>\r\n<td style=\"width: 89.8263%;\">6 n&uacute;t (phần mềm Armory Crate độc quyền để cấu h&igrave;nh dễ d&agrave;ng v&agrave; trực quan dễ d&ugrave;ng)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Tuổi thọ switch</strong></td>\r\n<td style=\"width: 89.8263%;\">60 triệu lần click</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>K&iacute;ch thước</strong></td>\r\n<td style=\"width: 89.8263%;\">126 x 63.5 x 39.6 mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Khối lượng</strong></td>\r\n<td style=\"width: 89.8263%;\">77g khi d&ugrave;ng pin AAA &amp; phụ kiện chuyển đổi<br>86g khi d&ugrave;ng pin AA</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td style=\"width: 10.1641%;\"><strong>Phụ kiện</strong></td>\r\n<td style=\"width: 89.8263%;\">1 x USB Wireless Dongle<br>1 x AA Battery<br>1 x AAA Battery<br>1 x AAA to AA Battery Converter Holder<br>1 x Hướng dẫn Nhanh<br>1 x Warranty Card</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<h2><strong>Đ&aacute;nh gi&aacute;&nbsp;Chuột gaming kh&ocirc;ng d&acirc;y TUF GAMING M4 Wireless 2.4, si&ecirc;u nhẹ, cảm biến 12.000 dpi, nắp vỏ bằng PBT, feet chuột 100% PTFE, Armoury Crate</strong></h2>\r\n<p><a href=\"https://gearvn.com/collections/chuot-asus\">Chuột gaming Asus</a>&nbsp;TUF Gaming M4 Wireless l&agrave; chuột chơi game kh&ocirc;ng d&acirc;y nhỏ gọn mang lại hiệu suất, độ tin cậy v&agrave; sự thoải m&aacute;i m&agrave; bạn t&igrave;m kiếm. Được thiết kế cho c&aacute;c phi&ecirc;n chơi game k&eacute;o d&agrave;i, với feet chuột được l&agrave;m bằng 100% PTFE v&agrave; cảm biến quang học 12.000 dpi c&oacute; độ ch&iacute;nh x&aacute;c cao, cung cấp khả năng kiểm so&aacute;t ch&iacute;nh x&aacute;c tăng lợi thế trong trận chiến.&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-chuot_gaming_asus_tuf_m4_wireless-1_d11bf277eabf421d8178093b0e863eb7.png\" alt=\"GEARVN - Chuột gaming Asus TUF Gaming M4 Wireless\"></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>Thiết kế tiện lợi</strong></h3>\r\n<p>Asus&nbsp;<a href=\"https://gearvn.com/collections/laptop-asus-tuf-gaming-series\">TUF Gaming</a>&nbsp;M4 Wireless c&oacute; h&igrave;nh dạng ph&ugrave; hợp thuận cả hai tay để mang lại cảm gi&aacute;c c&acirc;n bằng, chỉ nặng 62 gram. Nắp vỏ PBT của chuột được bảo vệ bằng c&aacute;ch xử l&yacute; lớp bảo vệ kh&aacute;ng khuẩn Antibacterial Guard của ASUS. Để thuận tiện hơn, M4 Wireless hoạt động với cả pin AAA v&agrave; AA.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-chuot_gaming_asus_tuf_m4_wireless-4_b0aa9167c693480f95c34d1f1aa017e8.png\" alt=\"GEARVN - Chuột gaming Asus TUF Gaming M4 Wireless\"></p>\r\n<p>&nbsp;</p>\r\n<p>TUF Gaming M4 Wireless c&oacute; c&aacute;c hai chế độ kết nối th&ocirc;ng qua chuẩn 2.4 Ghz v&agrave; Bluetooth mang lại độ ổn định tuyệt vời.&nbsp;<a href=\"https://gearvn.com/collections/chuot-wireless\">Chuột kh&ocirc;ng d&acirc;y</a>&nbsp;TUF Gaming M4 Wireless c&oacute; nắp vỏ bằng PBT v&agrave; c&aacute;c n&uacute;t b&ecirc;n cạnh được xử l&yacute; lớp ion bạc kh&aacute;ng khuẩn. Vật liệu PBT chống m&agrave;i m&ograve;n hoặc trở n&ecirc;n b&oacute;ng theo thời gian. Đồng thời n&oacute; c&ograve;n đảm bảo cảm gi&aacute;c cầm chắc chắn v&agrave; an to&agrave;n. Bề mặt an to&agrave;n với cồn cũng cho ph&eacute;p bạn l&agrave;m sạch bề mặt chuột m&agrave; kh&ocirc;ng cần lo lắng.</p>\r\n<h3><strong>Giữ vệ sinh&nbsp;cho&nbsp;chuột gaming</strong></h3>\r\n<p>Để giữ vệ sinh cho chuột TUF Gaming M4 Wireless của bạn, c&aacute;c bề mặt v&agrave; c&aacute;c n&uacute;t b&ecirc;n của n&oacute; được bảo vệ bằng phương ph&aacute;p xử l&yacute; lớp ion bạc kh&aacute;ng khuẩn ASUS Antibiotics Guard mới. C&aacute;c ion bạc (Ag+) t&iacute;ch điện dương li&ecirc;n kết với th&agrave;nh tế b&agrave;o của vi khuẩn v&agrave; vi tr&ugrave;ng t&iacute;ch điện &acirc;m, ph&aacute; vỡ c&aacute;c chức năng b&ecirc;n trong của ch&uacute;ng v&agrave; ngăn chặn sự ph&aacute;t triển th&ecirc;m.&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-chuot_gaming_asus_tuf_m4_wireless-3_a095a177b53042d283b430c9003de82a.png\" alt=\"GEARVN - Chuột gaming Asus TUF Gaming M4 Wireless\"></p>\r\n<p>&nbsp;</p>\r\n<p>Antibacteacteria Guard đ&atilde; được khoa học chứng minh l&agrave; c&oacute; thể ức chế sự ph&aacute;t triển của vi khuẩn hơn 99%&nbsp;trong khoảng thời gian 24 giờ. Bảo vệ kh&aacute;ng khuẩn Antibacterial Guard gi&uacute;p giữ cho bề mặt TUF Gaming M4 Wireless lu&ocirc;n&nbsp;sạch sẽ v&agrave; vệ sinh, c&oacute; khả năng l&agrave;m giảm sự l&acirc;y lan của vi khuẩn c&oacute; hại.</p>\r\n<h3><strong>Pin d&ugrave;ng cho&nbsp;TUF Gaming M4 Wireless</strong></h3>\r\n<p>Bộ phụ kiện chuyển đổi từ pin AAA sang AA đi k&egrave;m cho ph&eacute;p bạn cấp nguồn cho chuột kh&ocirc;ng d&acirc;y TUF Gaming M4 Wireless bằng pin AA hoặc AAA. Sử dụng bộ phụ kiện chuyển đổi cho pin AAA nhỏ hơn gi&uacute;p giảm 10% tổng trọng lượng của chuột khi d&ugrave;ng, gi&uacute;p bạn di chuột nhanh hơn.&nbsp;Feet chuột l&agrave;m bằng 100% polytetrafluoroethylene (PTFE)&nbsp;đảm bảo chuột lướt nhẹ nh&agrave;ng tr&ecirc;n mọi bề mặt b&agrave;n di chuột.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-chuot_gaming_asus_tuf_m4_wireless-1_d11bf277eabf421d8178093b0e863eb7.png\" alt=\"GEARVN - Chuột gaming Asus TUF Gaming M4 Wireless\"></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>N&uacute;t c&oacute; thể lập tr&igrave;nh</strong></h3>\r\n<p><a href=\"https://gearvn.com/pages/chuot-may-tinh\">Chuột gaming</a>&nbsp;TUF Gaming M4 Wireless c&oacute; s&aacute;u n&uacute;t tương t&aacute;c v&agrave; c&oacute; thể lập tr&igrave;nh, cho ph&eacute;p bạn điều chỉnh c&aacute;c điều khiển cho ph&ugrave; hợp với phong c&aacute;ch chơi của m&igrave;nh. C&aacute;c n&uacute;t tr&aacute;i v&agrave; phải được t&aacute;ch biệt khỏi nắp tr&ecirc;n, dẫn đến lực t&aacute;c động thấp hơn v&agrave; khoảng c&aacute;ch di chuyển tối ưu để click nhanh hơn v&agrave; cảm gi&aacute;c tốt hơn.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-chuot_gaming_asus_tuf_m4_wireless-2_a8e6f0f6bbaf4e319b5b72732c3f5f2f.png\" alt=\"GEARVN - Chuột gaming Asus TUF Gaming M4 Wireless\"></p>\r\n<p>&nbsp;</p>\r\n<p>Một c&ocirc;ng tắc v&agrave; chỉ b&aacute;o DPI cho ph&eacute;p bạn điều chỉnh độ nhạy khi đang di chuột, trong khi hai n&uacute;t b&ecirc;n tr&aacute;i được đặt ở vị tr&iacute; chiến lược khi cần d&ugrave;ng v&agrave; một con lăn c&oacute; thể click được, tất cả cung cấp c&aacute;c t&ugrave;y chọn điều khiển bổ sung cho bạn.</p>', '990000.00', '1190000.00', 13, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 4, 4, 12, 1, 'images/Yem1cdMVYRO4uK6YWHYBgn4vX30HFXvtlZfm2Qro.jpg', '2025-08-21 03:26:14', '2025-09-13 03:04:41', NULL, 0, 0),
(13, 'Chuột Pulsar có dây X2H Medium White', 'WD1560', '<p><em><a href=\"https://gearvn.com/collections/chuot-may-tinh\">Chuột gaming</a>&nbsp;đang trở th&agrave;nh một c&ocirc;ng cụ kh&ocirc;ng thể thiếu trong mỗi bộ thiết bị chơi game của game thủ. Trong số đ&oacute;, chuột Pulsar c&oacute; d&acirc;y X2H Medium White đ&atilde; để lại ấn tượng mạnh với thiết kế hiện đại c&ugrave;ng nhiều t&iacute;nh năng ưu việt. Dưới đ&acirc;y l&agrave; b&agrave;i đ&aacute;nh gi&aacute; chi tiết về sản phẩm n&agrave;y.</em></p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/pulsarx2hwiredgamingmouse_white_c5aec83f27b9408d871c6159d4f1634b_1024x1024.png\"></p>\r\n<ul>\r\n<li>\r\n<h3><strong>Thiết kế Ergonomic</strong></h3>\r\n</li>\r\n</ul>\r\n<p>Chuột Pulsar X2H Medium White được thiết kế với kiểu d&aacute;ng&nbsp;<a href=\"https://gearvn.com/collections/ghe-cong-thai-hoc\">ergonomic&nbsp;</a>tối ưu, gi&uacute;p tăng cường sự thoải m&aacute;i cho người d&ugrave;ng trong suốt thời gian d&agrave;i sử dụng. Với k&iacute;ch thước vừa phải, sản phẩm ph&ugrave; hợp với hầu hết c&aacute;c k&iacute;ch cỡ b&agrave;n tay, từ game thủ c&oacute; b&agrave;n tay nhỏ đến những người c&oacute; b&agrave;n tay lớn.</p>\r\n<ul>\r\n<li>\r\n<h3><strong>Cảm biến quang học ti&ecirc;n tiến</strong></h3>\r\n</li>\r\n</ul>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/pulsarx2hwiredgamingmouse_white__1__b454037f4f554c2a8ab278c510f0c98a_1024x1024.png\"></p>\r\n<p>Sản phẩm trang bị cảm biến quang học với độ ch&iacute;nh x&aacute;c cao, l&ecirc;n tới 16.000 DPI, gi&uacute;p người d&ugrave;ng dễ d&agrave;ng điều chỉnh độ nhạy theo nhu cầu sử dụng. C&ocirc;ng nghệ ti&ecirc;n tiến n&agrave;y đảm bảo bạn sẽ c&oacute; những&nbsp;<a href=\"https://gearvn.com/blogs/game-hay\">trải nghiệm chơi game mượt&nbsp;</a>m&agrave; v&agrave; ch&iacute;nh x&aacute;c, đặc biệt trong c&aacute;c tựa game cần sự nhạy b&eacute;n cao.</p>\r\n<ul>\r\n<li>\r\n<h3><strong>Tốc độ phản hồi nhanh</strong></h3>\r\n</li>\r\n</ul>\r\n<p>Chuột Pulsar X2H Medium White sở hữu tốc độ phản hồi tới 1000Hz, cho ph&eacute;p bạn thực hiện c&aacute;c h&agrave;nh động một c&aacute;ch nhanh ch&oacute;ng v&agrave; mượt m&agrave;. Điều n&agrave;y cực kỳ quan trọng trong c&aacute;c trận đấu cạnh tranh khốc liệt khi m&agrave; từng gi&acirc;y ph&uacute;t đều c&oacute; thể ảnh hưởng đến kết quả trận đấu.</p>\r\n<ul>\r\n<li>\r\n<h3><strong>Tuổi thọ cao v&agrave; độ bền vượt trội</strong></h3>\r\n</li>\r\n</ul>\r\n<p>Với chất liệu bền bỉ v&agrave; thiết kế chắc chắn, chuột X2H Medium White c&oacute; thể chịu được những c&uacute; nhấp chuột li&ecirc;n tục m&agrave; kh&ocirc;ng lo hỏng h&oacute;c. Tuổi thọ của c&aacute;c n&uacute;t bấm l&ecirc;n đến 80 triệu lần nhấp, gi&uacute;p game thủ y&ecirc;n t&acirc;m trong suốt qu&aacute; tr&igrave;nh sử dụng.</p>\r\n<ul>\r\n<li>\r\n<h3><strong>D&acirc;y c&aacute;p mềm dẻo</strong></h3>\r\n</li>\r\n</ul>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/pulsarx2hwiredgamingmouse_white__3__30950dcce5f541b8be529aa91b3234ae_1024x1024.png\"></p>\r\n<p>Một điểm cộng lớn cho&nbsp;<a href=\"https://gearvn.com/collections/chuot-pulsar\">chuột Pulsar</a>&nbsp;X2H l&agrave; d&acirc;y c&aacute;p mềm dẻo, gi&uacute;p giảm thiểu sự cản trở trong qu&aacute; tr&igrave;nh di chuyển. D&acirc;y c&aacute;p được thiết kế để kh&ocirc;ng tạo ra độ cản v&agrave; đảm bảo rằng bạn kh&ocirc;ng cảm thấy kh&oacute; chịu trong suốt buổi chơi game.</p>\r\n<ul>\r\n<li>\r\n<h3><strong>Phần mềm t&ugrave;y chỉnh</strong></h3>\r\n</li>\r\n</ul>\r\n<p>Chuột đi k&egrave;m với phần mềm Pulsar c&oacute; thể t&ugrave;y chỉnh, cho ph&eacute;p người d&ugrave;ng t&ugrave;y chỉnh c&aacute;c n&uacute;t bấm, điều chỉnh DPI v&agrave; thậm ch&iacute; l&agrave; thay đổi m&agrave;u sắc &aacute;nh s&aacute;ng. Điều n&agrave;y mang lại cho người d&ugrave;ng sự linh hoạt tối đa v&agrave; cải thiện trải nghiệm chơi game.</p>\r\n<p>Chuột Pulsar X2H Medium White kh&ocirc;ng chỉ c&oacute; thiết kế đẹp mắt m&agrave; c&ograve;n sở hữu nhiều t&iacute;nh năng ưu việt ph&ugrave; hợp với nhu cầu của game thủ chuy&ecirc;n nghiệp. Từ cảm biến quang học ch&iacute;nh x&aacute;c đến độ bền vượt trội, sản phẩm n&agrave;y thực sự l&agrave; một lựa chọn tuyệt vời cho những ai đang t&igrave;m kiếm một chuột gaming c&oacute; d&acirc;y chất lượng cao. Nếu bạn đang c&acirc;n nhắc việc n&acirc;ng cấp thiết bị chơi game của m&igrave;nh, Pulsar X2H Medium White chắc chắn sẽ l&agrave;m h&agrave;i l&ograve;ng bạn.</p>', '890000.00', '1390000.00', 10, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, 12, 1, 'images/HbW6gqDkm7vb26TbMDF99cJHiZT0MFoHWl85byyY.png', '2025-08-21 03:27:55', '2025-08-21 03:27:55', NULL, 0, 0),
(14, 'Chuột ASUS ROG Strix Impact III Wireless', 'WD2698', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Kết nối</strong></p>\r\n</td>\r\n<td>\r\n<p>Bluetooth 5.1</p>\r\n<p>RF 2.4GHz</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Loại pin</strong></td>\r\n<td>Pin AA /AAA</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Thời lượng pin</strong></td>\r\n<td>L&ecirc;n đến 450 tiếng (kh&ocirc;ng bật led)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Cảm biến</strong></p>\r\n</td>\r\n<td><br>ROG AimPoint</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Độ nhạy</strong></p>\r\n</td>\r\n<td>36000DPI</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Switch chuột</strong></p>\r\n</td>\r\n<td><br>ROG 70M Mechanical Switch</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Tần số gửi t&iacute;n hiệu chuột tới m&aacute;y t&iacute;nh</strong></p>\r\n</td>\r\n<td>\r\n<p>1000 Hz</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Kiểu chuột</strong></p>\r\n</td>\r\n<td>\r\n<p>Claw grip</p>\r\n<p>Fingertip grip</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>K&iacute;ch thước</strong></p>\r\n</td>\r\n<td>120(L)x62(w)x39(H) mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Trọng lượng kh&ocirc;ng c&aacute;p</strong></p>\r\n</td>\r\n<td>57g (Kh&ocirc;ng bao gồm USB Dongle v&agrave; pin)<br>68g (bao gồm pin AAA)<br>72g (bao gồm pin AA)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Sẵn trong hộp</strong></td>\r\n<td><br>1 x ROG Impact III Wireless gaming mouse<br>1 x Wireless receiver<br>1 x Quick start guide<br>1 x Warranty booklet<br>1 x AA battery<br>1 x AAA battery<br>1 x AAA to AA battery converter holder</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '1090000.00', '1990000.00', 8, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, 12, 1, 'images/yDglAFVY0gHfkPPPMGrnaP4saS2QNgR8JkLJBZUA.png', '2025-08-21 03:29:35', '2025-09-04 00:44:30', NULL, 0, 0),
(15, 'Chuột Razer DeathAdder Essential (RZ01-03850100-R3M1)', 'WD7795', NULL, '400000.00', '790000.00', 13, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 4, 5, 12, 1, 'images/uYfVvu4ZphMiiGhwoIzmswqz9AmrKPChuuwENa8a.jpg', '2025-08-21 03:30:45', '2025-09-03 15:25:53', NULL, 1, 0),
(16, 'Màn hình Asus TUF GAMING VG259Q3A 25\" Fast IPS 180Hz Gsync chuyên game', 'WD8644', '<h2><strong>Đ&aacute;nh gi&aacute; M&agrave;n h&igrave;nh Asus TUF GAMING VG259Q3A 25&ldquo; Fast IPS 180Hz Gsync chuy&ecirc;n game</strong></h2>\r\n<p>Bạn thất vọng về m&agrave;n h&igrave;nh của m&igrave;nh kh&ocirc;ng theo kịp tốc độ phản ứng của bạn trong game? Bạn đang muốn t&igrave;m cho m&igrave;nh một sản phẩm c&oacute; thể đ&aacute;p ứng được y&ecirc;u cầu chơi game đồ họa v&agrave; c&oacute; tốc độ phản hồi nhanh?&nbsp;<em><strong>M&agrave;n h&igrave;nh Asus TUF Gaming VG259Q3A 25&rdquo; Fast IPS 180Hz Gsync</strong></em>&nbsp;sẽ giải quyết triệt để vấn đề của bạn v&agrave; đ&aacute;p ứng tất cả c&aacute;c nhu cầu về chơi game của bạn. Với tần số qu&eacute;t 180Hz v&agrave; c&ocirc;ng nghệ Gsync mang lại trải nghiệm chơi game tuyệt vời d&agrave;nh cho bạn. C&ugrave;ng&nbsp;<a href=\"https://gearvn.com/\">GEARVN</a>&nbsp;kh&aacute;m ph&aacute; ngay!</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/asus_vg259q3a_gearvn_e76558abb18946d7b7d51dd16d915d89_1024x1024.jpg\" alt=\"GEARVN - M&agrave;n h&igrave;nh Asus TUF GAMING VG259Q3A 25&ldquo; Fast IPS 180Hz Gsync chuy&ecirc;n game\"></p>\r\n<h3><strong>Trải nghiệm chơi game mượt m&agrave;, kh&ocirc;ng giật lag</strong></h3>\r\n<p><a href=\"https://gearvn.com/pages/man-hinh\">M&agrave;n h&igrave;nh</a>&nbsp;sở hữu tần số qu&eacute;t 180Hz, thời gian phản hồi 1ms (GTG) cho h&igrave;nh ảnh cực kỳ mượt m&agrave;, loại bỏ hiện tượng b&oacute;ng mờ,&nbsp;<a href=\"https://gearvn.com/blogs/cong-nghe/lag-do-mang-hay-giat-hinh-do-may-yeu-day-la-cach-ban-phan-biet\">giật lag</a>&nbsp;khi sử dụng c&aacute;c t&aacute;c vụ hay ứng dụng y&ecirc;u cầu tốc độ hiển thị nhanh.&nbsp;</p>\r\n<p>C&ocirc;ng nghệ AMD FreeSync v&agrave; ASUS Extreme Low Motion Blur (ELMB) tối ưu h&oacute;a h&igrave;nh ảnh, loại bỏ hiện tượng&nbsp;<a href=\"https://gearvn.com/blogs/thu-thuat-giai-dap/xe-man-hinh-la-gi\">x&eacute; h&igrave;nh</a>&nbsp;gi&uacute;p bạn phản ứng nhanh ch&oacute;ng trong c&aacute;c tựa game y&ecirc;u cầu tốc độ cao như game FPS, đua xe. Ngo&agrave;i ra, m&agrave;n h&igrave;nh c&ograve;n sở hữu c&ocirc;ng nghệ Variable Overdrive điều chỉnh tự động overdrive tối ưu h&oacute;a hiệu suất h&igrave;nh ảnh cho mọi tựa game.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/untitled_design__2__f3ce99193b4f4344b8d3730215d20b49_1024x1024.jpg\" alt=\"GEARVN - M&agrave;n h&igrave;nh Asus TUF GAMING VG259Q3A 25&ldquo; Fast IPS 180Hz Gsync chuy&ecirc;n game\"></p>\r\n<h3><strong>H&igrave;nh ảnh chất lượng, sắc n&eacute;t</strong></h3>\r\n<p><a href=\"https://gearvn.com/blogs/thu-thuat-giai-dap/cong-nghe-man-hinh-ips-la-gi\">M&agrave;n h&igrave;nh IPS</a>&nbsp;24.5 inch&nbsp;<a href=\"https://gearvn.com/collections/do-phan-giai-full-hd-1080p\">Full HD</a>&nbsp;(1920x1080) với game m&agrave;u 99% sRGB mang đến m&agrave;u sắc ch&acirc;n thật, r&otilde; n&eacute;t, ch&iacute;nh x&aacute;c v&agrave; sinh động, c&ugrave;ng độ tương phản cao gi&uacute;p người d&ugrave;ng trải nghiệm h&igrave;nh ảnh một c&aacute;ch tốt nhất trong c&aacute;c trận chiến trong game hay xem video v&agrave; h&igrave;nh ảnh giải tr&iacute;.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/untitled_design__2__f3ce99193b4f4344b8d3730215d20b49_1024x1024.jpg\" alt=\"GEARVN - M&agrave;n h&igrave;nh Asus TUF GAMING VG259Q3A 25&ldquo; Fast IPS 180Hz Gsync chuy&ecirc;n game\"></p>\r\n<h3><strong>Thiết kế v&agrave; t&iacute;nh năng tiện lợi</strong></h3>\r\n<p>M&agrave;n h&igrave;nh được thiết kế tinh tế, gọn g&agrave;ng ph&ugrave; hợp với mọi kh&ocirc;ng gian chơi game, tạo sự thoải m&aacute;i cho người d&ugrave;ng khi sử dụng. M&agrave;n h&igrave;nh hỗ trợ nhiều t&ugrave;y chọn kết nối bao gồm 2 cổng kết nối HDMI 2.0, DisplayPort 1.2 ph&ugrave; hợp với nhiều thiết bị ngoại vi kh&aacute;c, dễ d&agrave;ng kết nối để hỗ trợ khi sử dụng.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/untitled_design__5__3c9174d77dd04403b10d739c762766e6_1024x1024.jpg\" alt=\"GEARVN - M&agrave;n h&igrave;nh Asus TUF GAMING VG259Q3A 25&ldquo; Fast IPS 180Hz Gsync chuy&ecirc;n game\"></p>\r\n<h3><strong>Tối ưu cho game thủ chuy&ecirc;n nghiệp</strong></h3>\r\n<p>M&agrave;n h&igrave;nh thiết kế đặc biệt d&agrave;nh cho game thủ chuy&ecirc;n nghiệp của nhiều tựa game nổi tiếng hiện nay, sở hữu nhiều t&iacute;nh năng mạnh mẽ để hỗ trợ cho qu&aacute; tr&igrave;nh chơi game v&agrave; mang lại lợi thế trong trận chiến cho game thủ.</p>\r\n<p>T&iacute;nh năng v&agrave; c&ocirc;ng nghệ ti&ecirc;n tiến gi&uacute;p n&acirc;ng cao hiệu suất chơi game, mang đến trải nghiệm mượt m&agrave;, ch&acirc;n thực.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/untitled_design__1__b43e3bea49a04cfda354680aaca6bbc3_1024x1024.jpg\" alt=\"GEARVN - M&agrave;n h&igrave;nh Asus TUF GAMING VG259Q3A 25&ldquo; Fast IPS 180Hz Gsync chuy&ecirc;n game\"></p>', '3090000.00', '3990000.00', 8, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 7, 1, 12, 1, 'images/LTWLdtCXU8DZlWZLFBuRHgAJRBzK9Ubku2wuqA4O.jpg', '2025-08-21 03:35:07', '2025-08-21 03:35:07', NULL, 0, 0),
(17, 'Màn hình ViewSonic VA2215-H 22\" 100Hz FHD', 'WD1683', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>H&atilde;ng sản xuất</strong></td>\r\n<td>ViewSonic&nbsp;</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Model</strong></td>\r\n<td>VA2215-H</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước m&agrave;n h&igrave;nh</strong></td>\r\n<td>22 inch</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ ph&acirc;n giải</strong></td>\r\n<td>FHD 1920 x 1080</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tỉ lệ</strong></td>\r\n<td>16:9</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tấm nền m&agrave;n h&igrave;nh</strong></td>\r\n<td>VA</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ tương phản</strong></td>\r\n<td>3,000:1 (typ)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>M&agrave;u sắc hiển thị</strong></td>\r\n<td>16.7 triệu m&agrave;u</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tần số qu&eacute;t</strong></td>\r\n<td>100Hz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Cổng kết nối</strong></td>\r\n<td>VGA:&nbsp;1<br>3.5mm Audio Out:&nbsp;1<br>HDMI 1.4:&nbsp;1<br>Power in:&nbsp;External power adapter</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Thời gian đ&aacute;p ứng</strong></td>\r\n<td>5ms</td>\r\n</tr>\r\n<tr>\r\n<td><strong>G&oacute;c nh&igrave;n</strong></td>\r\n<td>178&ordm; horizontal, 178&ordm; vertical</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điện năng ti&ecirc;u thụ</strong></td>\r\n<td>Eco Mode (Conserve):&nbsp;13W<br>Eco Mode (optimized):&nbsp;15W<br>Consumption (typical):&nbsp;20W<br>Consumption (max):&nbsp;21W<br>Voltage:&nbsp;AC 100-240V, 50/60 Hz<br>Stand-by:&nbsp;0.5W<br>Power Supply:&nbsp;External</td>\r\n</tr>\r\n<tr>\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>Packaging (in.):&nbsp;22.4 x 15.1 x 4.6<br>Physical (in.):&nbsp;19.4 x 14.8 x 7.4<br>Physical Without Stand (in.):&nbsp;19.4 x 11.1 x 1.5</td>\r\n</tr>\r\n<tr>\r\n<td><strong>C&acirc;n nặng</strong></td>\r\n<td>Net (kg):&nbsp;2.4<br>Net Without Stand (kg):&nbsp;2<br>Gross (kg):&nbsp;3.5</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Phụ kiện</strong></td>\r\n<td>HDMI Cable (v1.4; Male-Male) x1, AC/DC Adapter x1, Quick Start Guide x1</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tương Th&iacute;ch VESA</strong></td>\r\n<td><strong>&nbsp;</strong>75 x 75 mm</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '1590000.00', '3600000.00', 6, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 7, 6, 12, 1, 'images/zH700LBtNCGIKBmfuWSDr9mgyJss9Upr5dzICpNO.jpg', '2025-08-21 03:36:40', '2025-08-27 02:05:51', NULL, 0, 1),
(18, 'Màn hình LG 27GR75Q-B UltraGear 27\" IPS 2K 165Hz Gsync chuyên game', 'WD7200', '<h2><strong>Đ&aacute;nh gi&aacute; chi tiết&nbsp;m&agrave;n h&igrave;nh LG 27GR75Q-B UltraGear 27\" IPS 2K 165Hz Gsync chuy&ecirc;n game</strong></h2>\r\n<p>LG l&agrave; &ocirc;ng lớn c&ocirc;ng nghệ đến từ H&agrave;n Quốc. Những sản phẩm của LG mang vẻ ngo&agrave;i thanh lịch, hiện đại, được chau chuốt tỉ mỉ v&agrave; cẩn thận. B&ecirc;n cạnh đ&oacute; chất lượng l&agrave; điều kh&ocirc;ng thể b&agrave;n c&atilde;i với gi&aacute; th&agrave;nh n&oacute; mang lại.&nbsp;<a href=\"https://gearvn.com/collections/monitor-lg\" target=\"_blank\" rel=\"noopener\">M&agrave;n h&igrave;nh LG</a>&nbsp;LG 27GR75Q-B cũng kh&ocirc;ng ngoại lệ. M&agrave;n h&igrave;nh chuy&ecirc;n game sở hữu k&iacute;ch thước&nbsp;<a href=\"https://gearvn.com/collections/man-hinh-27-inch\" target=\"_blank\" rel=\"noopener\">27 inch</a>&nbsp;ti&ecirc;u chuẩn với tấm nền IPS ti&ecirc;u chuẩn mới gi&uacute;p game thủ đắm ch&igrave;m v&agrave;o mọi trận game đầy cam go.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gearvn-lg-32gr93u-b-4_94bc900e5d894be18d5663af22d912c6.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>M&agrave;n h&igrave;nh cao cấp d&agrave;nh cho game thủ</strong></h3>\r\n<p><a href=\"https://gearvn.com/pages/man-hinh\" target=\"_blank\" rel=\"noopener\">M&agrave;n h&igrave;nh m&aacute;y t&iacute;nh</a>&nbsp;sở hữu độ chuẩn m&agrave;u cũng rất cao đạt&nbsp;<a href=\"https://gearvn.com/blogs/thu-thuat-giai-dap/dci-p3-la-gi\" target=\"_blank\" rel=\"noopener\">DCI-P3</a>&nbsp;95% (CIE1976) mang đến khả năng t&aacute;i tạo m&agrave;u sắc đ&aacute;ng kinh ngạc. Bạn sẽ v&ocirc; c&ugrave;ng m&atilde;n nh&atilde;n với chất lượng đồ họa LG 27GR75Q-B UltraGear mang lại cho bạn. Độ ph&acirc;n giải m&agrave;n h&igrave;nh 2K l&agrave; một con số v&ocirc; c&ugrave;ng ấn tượng v&agrave; cao cấp cho ph&acirc;n kh&uacute;c m&agrave;n h&igrave;nh gaming.</p>\r\n<h3><strong>Tần số qu&eacute;t v&agrave; thời gian phản hồi chuẩn game</strong></h3>\r\n<p>L&agrave; một&nbsp;<a href=\"https://gearvn.com/collections/man-hinh-tu-5-den-10-trieu\" target=\"_blank\" rel=\"noopener\">m&agrave;n h&igrave;nh chuy&ecirc;n game</a>&nbsp;n&ecirc;n LG 27GR75Q-B UltraGear được đầu tư hẳn hoi về tần số qu&eacute;t v&agrave; thời gian phản hồi nhằm mang đến trải nghiệm chơi game tốt nhất cho người chơi. Tần số qu&eacute;t m&agrave;n h&igrave;nh 165Hz v&agrave; thời gian phản hồi 1ms GtG gi&uacute;p bạn đ&oacute;n đầu đối thủ v&agrave; d&agrave;nh chiến thắng trong mọi cuộc chơi.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/man-hinh-lg-27gr75q-b-1_0ad6a97354324be1800b278420cfe863.jpg\"></p>\r\n<p>&nbsp;</p>\r\n<h3><strong>C&ocirc;ng nghệ m&agrave;n h&igrave;nh hiện đại</strong></h3>\r\n<p>Tương th&iacute;ch với c&ocirc;ng nghệ chống&nbsp;<a href=\"https://gearvn.com/blogs/thu-thuat-giai-dap/xe-man-hinh-la-gi\" target=\"_blank\" rel=\"noopener\">x&eacute; m&agrave;n h&igrave;nh</a>&nbsp;từ Nvidia G-sync v&agrave; AMD FreeSync ho&agrave;n hảo đồng bộ c&ugrave;ng tần số qu&eacute;t cực cao. C&ocirc;ng nghệ AMD FreeSync&trade; Premium gi&uacute;p game r&otilde; r&agrave;ng hơn, mượt m&agrave; v&agrave; nhanh hơn. C&ograve;n đối với c&ocirc;ng nghệ FreeSync&trade; Premium, người chơi game c&oacute; thể trải nghiệm chuyển động liền mạch, tr&ocirc;i chảy trong những tr&ograve; chơi c&oacute; độ ph&acirc;n giải cao v&agrave; tốc độ nhanh. C&ocirc;ng nghệ n&agrave;y hầu như loại bỏ được hiện tượng trộn h&igrave;nh v&agrave; giật h&igrave;nh thường gặp phải ở những m&agrave;n h&igrave;nh m&aacute;y t&iacute;nh th&ocirc;ng thường.</p>\r\n<h3><strong>Thiết kế s&agrave;nh điệu, đậm chất gaming</strong></h3>\r\n<p>Trải nghiệm tuyệt vời hơn khi chơi game nhờ thiết kế bắt mắt v&agrave; viền m&agrave;n h&igrave;nh si&ecirc;u mỏng. Thiết kế ch&acirc;n đế m&agrave;n h&igrave;nh th&ocirc;ng minh để người chơi c&oacute; thể thay đổi độ nghi&ecirc;ng, độ cao v&agrave; độ xoay của m&agrave;n h&igrave;nh, gi&uacute;p bạn chơi game thoải m&aacute;i hơn.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/man-hinh-lg-27gr75q-b-w_571f231cd5d44150bfe9102dca269f0f.jpg\"></p>', '6090000.00', '7990000.00', 4, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 7, 7, 12, 1, 'images/3FkVAV0GuhBRwU3l213keqZo7MnZDXefjIjuQg7I.jpg', '2025-08-21 03:38:11', '2025-09-04 00:25:59', NULL, 1, 0),
(19, 'Màn hình Acer KG240Y-X1 24\" IPS 200Hz Gsync chuyên game', 'WD5543', '<div class=\"desc-content\">\r\n<h2><strong>Đ&aacute;nh gi&aacute; chi tiết sản phẩm&nbsp;m&agrave;n h&igrave;nh Acer KG240Y-X1 24\" IPS 200Hz Gsync chuy&ecirc;n game</strong></h2>\r\n<p>Acer KG240Y-X1 l&agrave; một m&agrave;n h&igrave;nh chơi game tầm trung đ&aacute;ng ch&uacute; &yacute;, được trang bị tấm nền IPS, tần số qu&eacute;t 200Hz v&agrave; c&ocirc;ng nghệ G-Sync. Với mức gi&aacute; phải chăng, chiếc m&agrave;n h&igrave;nh n&agrave;y hứa hẹn mang đến trải nghiệm chơi game mượt m&agrave;, h&igrave;nh ảnh sắc n&eacute;t v&agrave; m&agrave;u sắc sống động cho game thủ.</p>\r\n<h3><strong>Ngoại h&igrave;nh mạnh mẽ, thiết kế linh hoạt</strong></h3>\r\n<p><a href=\"https://gearvn.com/collections/man-hinh-acer\">M&agrave;n h&igrave;nh Acer</a>&nbsp;KG240Y-X1 được thiết kế với m&agrave;n h&igrave;nh mỏng nhẹ với m&agrave;u đen l&agrave;m chủ đạo, ch&acirc;n đế của m&agrave;n h&igrave;nh được thiết kế chữ V mang lại cảm gi&aacute;c vững chắc cho sản phẩm. Đặc biệt, với m&agrave;n h&igrave;nh Acer KG240Y-X1, người d&ugrave;ng c&oacute; thể điều chỉnh độ nghi&ecirc;ng linh hoạt để t&igrave;m g&oacute;c ph&ugrave; hợp với tư thế ngồi cũng như c&aacute;c nhu cầu sử dụng kh&aacute;c như chơi game, xem phim,... M&agrave;n h&igrave;nh sở hữu k&iacute;ch thước&nbsp;<a href=\"https://gearvn.com/collections/man-hinh-24-inch\">24 inch</a>&nbsp;nhưng trọng lượng chỉ khoảng 2.9kg, rất dễ d&agrave;ng để bạn c&oacute; thể di chuyển v&agrave; bố tr&iacute; ở c&aacute;c vị tr&iacute; kh&aacute;c nhau.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/acer_nitro_kg0_-_kg240y_x1_-_1_703b0169ed814b0598ea731baee2450b_1024x1024.png\" alt=\"M&agrave;n h&igrave;nh Acer KG240Y-X1 24\"></p>\r\n<h3><strong>Tần số qu&eacute;t l&ecirc;n đến 200Hz</strong></h3>\r\n<p><a href=\"https://gearvn.com/pages/man-hinh\">M&agrave;n h&igrave;nh</a>&nbsp;Acer Nitro KG240Y X1 được trang bị tần số qu&eacute;t 200Hz v&agrave; thời gian phản hồi 1ms (GtG), với sự kết hợp n&agrave;y, m&agrave;n h&igrave;nh sẽ cung cấp cho người chơi những trỉa nghiệm h&igrave;nh ảnh mượt m&agrave;, kh&ocirc;ng bị giật lag. Tốc độ l&agrave;m mới cực nhanh n&agrave;y cho ph&eacute;p bạn phản ứng ngay lập tức với mọi diễn biến trong game, gi&uacute;p bạn lu&ocirc;n dẫn đầu trong c&aacute;c trận chiến căng thẳng.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/acer_nitro_kg0_-_kg240y_x1_-_3_3a944853c4ed48e59d8ace2d49ccc7e5_1024x1024.png\" alt=\"M&agrave;n h&igrave;nh Acer KG240Y-X1 24\"></p>\r\n<h3><strong>Tấm nền IPS cho g&oacute;c rộng đến 178 độ</strong></h3>\r\n<p>Được trang bị tấm nền IPS ti&ecirc;n tiến, m&agrave;n h&igrave;nh n&agrave;y mang đến độ ph&acirc;n giải Full HD (1920x1080) ấn tượng, t&aacute;i hiện mọi chi tiết với độ r&otilde; n&eacute;t đ&aacute;ng kinh ngạc. Từ những d&ograve;ng chữ nhỏ nhất trong c&ocirc;ng việc h&agrave;ng ng&agrave;y đến những hiệu ứng đồ họa phức tạp trong game, tất cả đều được hiển thị một c&aacute;ch sắc n&eacute;t v&agrave; ch&acirc;n thực.&nbsp;</p>\r\n<p>Được trang bị tấm nền IPS ti&ecirc;n tiến, m&agrave;n h&igrave;nh n&agrave;y mang đến độ ph&acirc;n giải&nbsp;<a href=\"https://gearvn.com/collections/do-phan-giai-full-hd-1080p\">Full HD</a>&nbsp;(1920x1080) ấn tượng, t&aacute;i hiện mọi chi tiết với độ r&otilde; n&eacute;t đ&aacute;ng kinh ngạc. Từ những d&ograve;ng chữ nhỏ nhất trong c&ocirc;ng việc h&agrave;ng ng&agrave;y đến những hiệu ứng đồ họa phức tạp trong game, tất cả đều được hiển thị một c&aacute;ch sắc n&eacute;t v&agrave; ch&acirc;n thực.&nbsp;</p>\r\n<p>Song song đ&oacute; với độ phủ m&agrave;u sRGB l&ecirc;n đến 99%, m&agrave;n h&igrave;nh n&agrave;y mang đến dải m&agrave;u ch&acirc;n thực v&agrave; sống động, đ&aacute;p ứng mọi nhu cầu của những người d&ugrave;ng kh&oacute; t&iacute;nh nhất. Từ những gam m&agrave;u tươi tắn trong phim ảnh đến những sắc th&aacute;i tinh tế trong thiết kế đồ họa, tất cả đều được t&aacute;i hiện một c&aacute;ch ch&iacute;nh x&aacute;c v&agrave; tự nhi&ecirc;n.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/acer_nitro_kg0_-_kg240y_x1_-_4_531894a3fb4547ffb0d10a51383705ae_1024x1024.png\" alt=\"M&agrave;n h&igrave;nh Acer KG240Y-X1 24\"></p>\r\n<h3><strong>T&iacute;ch hợp c&ocirc;ng nghệ hiện đại th&acirc;n thiện với mắt</strong></h3>\r\n<p>B&ecirc;n cạnh cung cấp h&igrave;nh ảnh chất lượng, m&agrave;n h&igrave;nh Acer Nitro KG240Y X1 c&ograve;n đặc biệt quan t&acirc;m đến sức khỏe của người d&ugrave;ng, nhất l&agrave; đ&ocirc;i mắt. C&ocirc;ng nghệ Acer VisionCare được t&iacute;ch hợp trong m&agrave;n h&igrave;nh n&agrave;y l&agrave; minh chứng r&otilde; r&agrave;ng cho điều đ&oacute;.&nbsp;</p>\r\n<p>Hệ thống c&ocirc;ng nghệ Acer VisionCare bao gồm bốn c&ocirc;ng nghệ ch&iacute;nh l&agrave; Flicker-less - loại bỏ hiện tượng chống nhấp nh&aacute;y, BlueLightShield gi&uacute;p giảm thiểu lượng &aacute;nh s&aacute;ng xanh ph&aacute;t ra, ComfyView - gi&uacute;p giảm độ ch&oacute;i v&agrave; phản xạ &aacute;nh s&aacute;ng, gi&uacute;p h&igrave;nh ảnh hiển thị r&otilde; r&agrave;ng hơn v&agrave; giảm thiểu căng thẳng cho mắt v&agrave; cuối c&ugrave;ng l&agrave; Low Dimming tự động điều chỉnh mức độ &aacute;nh s&aacute;ng xuống mức thấp hơn b&igrave;nh thường gi&uacute;p giảm thiểu lượng &aacute;nh s&aacute;ng m&agrave; mắt bạn phải tiếp x&uacute;c, đặc biệt trong điều kiện &aacute;nh s&aacute;ng yếu.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/0._kg240y_x1_-_frame_9894e0f9aca046c286d03ffb35ad1277_1024x1024.png\" alt=\"M&agrave;n h&igrave;nh Acer KG240Y-X1 24\"></p>\r\n<h3><strong>Đa dạng c&aacute;c cổng kết nối</strong></h3>\r\n<p>M&agrave;n h&igrave;nh n&agrave;y được trang bị một loạt c&aacute;c cổng kết nối đa dạng, cho ph&eacute;p bạn dễ d&agrave;ng kết nối với nhiều loại thiết bị kh&aacute;c nhau, từ&nbsp;<a href=\"https://gearvn.com/pages/pc-gvn\">m&aacute;y t&iacute;nh</a>,&nbsp;<a href=\"https://gearvn.com/pages/laptop-gaming\">laptop</a>, console chơi game cho đến tai nghe. Cụ thể, m&agrave;n h&igrave;nh cung cấp c&aacute;c cổng kết nối như hai cổng HDMI, cổng DisplayPort v&agrave; cổng &acirc;m thanh 3.5mm.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/acer_nitro_kg0_-_kg240y_x1_-_7_978b1846844a4fc498ebda3b557841c4_1024x1024.png\" alt=\"M&agrave;n h&igrave;nh Acer KG240Y-X1 24\"></p>\r\n<p>Acer KG240Y-X1 l&agrave; một chiếc m&agrave;n h&igrave;nh chơi game tầm trung đ&aacute;ng gi&aacute;, mang đến nhiều ưu điểm vượt trội. Nếu bạn đang t&igrave;m kiếm một chiếc m&agrave;n h&igrave;nh gaming chất lượng th&igrave; chắc chắn kh&ocirc;ng thể bỏ lỡ sản phẩm n&agrave;y.&nbsp;H&atilde;y li&ecirc;n hệ với GearVN hoặc đến trực tiếp cửa h&agrave;ng để được nh&acirc;n vi&ecirc;n tư vấn chi tiết về sản phầm n&agrave;y.</p>\r\n</div>\r\n<div class=\"desc-btn\">&nbsp;</div>', '2790000.00', '3790000.00', 6, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 7, 8, 12, 1, 'images/DQlxW6XmCRpSGbL3itjoKlbtqVxu4gNxo4S4DGRh.png', '2025-08-21 03:40:50', '2025-09-04 00:43:27', NULL, 1, 0),
(20, 'dfdfdfsdf', 'WD6651', '<p>dfdfdf</p>', NULL, NULL, 0, NULL, 1, 1, 1, 1, NULL, NULL, NULL, 4, 1, 23, 1, 'images/AZhMnhQpYulHPXA66Rgcj4QUH1c5cTVIzxmgVv0l.jpg', '2025-08-23 15:33:27', '2025-08-23 15:53:16', '2025-08-23 15:53:16', 0, 0),
(21, 'ádfdsadsadsad', 'WD7714', '<p>fafdafdaf</p>', NULL, NULL, 0, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 23, 1, 'images/knjos9mp1Glw4dWenr3RMQBIZ49fxxyrqCmXBGHc.jpg', '2025-08-23 15:56:39', '2025-08-25 02:13:03', '2025-08-25 02:13:03', 0, 0),
(22, 'Bàn phím AKKO 5108B Plus Hatsune Miku Akko Piano Pro Switch', 'WD6576', '<div class=\"product-heading\">\r\n<h2>Th&ocirc;ng tin sản phẩm</h2>\r\n</div>\r\n<div class=\"product-wrap\">\r\n<div class=\"product-desc--content expandable-toggle opened expanded\">\r\n<div class=\"desc-content\">\r\n<p>&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/imgi_29_3-3_grande.png\"></p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/imgi_28_2-3_grande.png\"></p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/imgi_30_4-3_grande.png\"></p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/imgi_31_5-3_grande.png\"></p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/imgi_32_6-3_grande.png\"></p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/imgi_33_7-3_grande.png\"></p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/imgi_37_11-3_grande.png\"></p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/imgi_38_12-3_grande.png\"></p>\r\n</div>\r\n</div>\r\n</div>', '2490000.00', '2790000.00', 9, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 5, 9, 12, 1, 'images/UxnFFf3doqe3pOZWJA9OK3BeJWQb4cuQLA7ZnnJz.jpg', '2025-08-25 02:19:08', '2025-08-25 02:19:08', NULL, 0, 0),
(23, 'Bàn phím AKKO TAC87 3 MODE Matcha Red Bean Stellar Rose switch', 'WD1107', '<p><em>(Đang cập nhật ...)</em></p>', '1100000.00', '1390000.00', 11, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 5, 9, 12, 1, 'images/buBAceYZHvhFq7q8GyV0GcLXo0a96hAJaFGKwK8V.jpg', '2025-08-25 02:22:15', '2025-09-04 00:43:27', NULL, 1, 0),
(24, 'Bàn phím AULA HERO68HE có dây (Hồng gradient/ Black King magnetic switch) HERO6801', 'WD6783', NULL, '1650000.00', '2261000.00', 15, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 5, 11, 12, 1, 'images/24hymjIukffsS8mMegB1URcRDIx2gdPh1GziNngD.png', '2025-08-25 02:28:09', '2025-08-27 02:04:30', NULL, 0, 1),
(25, 'Bàn phím AULA M75 TM (Xanh + trắng + cam/ Crescent switch) M7501', 'WD2554', NULL, '1990000.00', '3010000.00', 20, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 5, 11, 12, 1, 'images/N8pMS82HlMepPFmKkFsos3QRKYUtgfQjaB2ifVBl.png', '2025-08-25 02:29:35', '2025-09-03 15:25:53', NULL, 1, 0),
(26, 'Bàn phím AULA F81 TM (Tím/ Ice Soul switch) F8108', 'WD1393', NULL, '1490000.00', '2310000.00', 11, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 5, 11, 12, 1, 'images/XggKJTzBXzzGnrZU0mRlOLOnGURRa4Ad9eRI1otB.png', '2025-08-25 02:30:43', '2025-09-03 15:14:41', NULL, 1, 0),
(27, 'Màn hình LG 24GS65F-B 24\" IPS 180Hz HDR10 Gsync chuyên game', 'WD9859', '<h2><strong>Đ&aacute;nh gi&aacute; m&agrave;n h&igrave;nh LG 24GS65F-B 24&ldquo; IPS 180Hz HDR10 Gsync chuy&ecirc;n game</strong></h2>\r\n<p>Bạn l&agrave; game thủ? Bạn muốn n&acirc;ng tầm trải nghiệm chơi game l&ecirc;n một tầm cao mới? Bạn muốn chiến thắng ngay từ vạch xuất ph&aacute;t v&agrave; lu&ocirc;n dẫn đầu? H&atilde;y c&ugrave;ng&nbsp;<a href=\"https://gearvn.com/\">GEARVN</a>&nbsp;kh&aacute;m ph&aacute; m&agrave;n h&igrave;nh LG 24GS65F-B, m&agrave;n h&igrave;nh chơi game 180Hz sẽ gi&uacute;p bạn chinh phục mọi con game phổ biến hiện nay.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/lg_24gs65f-b_gearvn_af476af1e4514a2684591304b3e4164a_1024x1024.jpg\" alt=\"GEARVN - M&agrave;n h&igrave;nh LG 24GS65F-B 24&ldquo; IPS 180Hz HDR10 Gsync chuy&ecirc;n game\"></p>\r\n<h3><strong>Tốc độ đỉnh cao, chiến thắng bất ngờ</strong></h3>\r\n<p>LG 24GS65F-B trang bị tần số qu&eacute;t 180Hz, một con số ấn tượng m&agrave; kh&ocirc;ng phải&nbsp;<a href=\"https://gearvn.com/pages/man-hinh\">m&agrave;n h&igrave;nh</a>&nbsp;n&agrave;o cũng c&oacute; thể đạt được. Tần số qu&eacute;t 180Hz gi&uacute;p bạn thưởng thức h&igrave;nh ảnh cực r&otilde; n&eacute;t v&agrave; mượt m&agrave; với tốc độ l&agrave;m mới 180 lần một gi&acirc;y, cho ph&eacute;p bạn nắm bắt mọi chuyển động nhanh ch&oacute;ng v&agrave; ch&iacute;nh x&aacute;c, đưa bạn đến gần hơn với chiến thắng.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/thum-1600x1062__1__efdfbbf3264d41b789615e3267cb887a_1024x1024.jpg\" alt=\"GEARVN - M&agrave;n h&igrave;nh LG 24GS65F-B 24&ldquo; IPS 180Hz HDR10 Gsync chuy&ecirc;n game\"></p>\r\n<h3><strong>H&igrave;nh ảnh sắc n&eacute;t, trải nghiệm tuyệt vời</strong></h3>\r\n<p>LG 24GS65F-B sử dụng&nbsp;<a href=\"https://gearvn.com/blogs/thu-thuat-giai-dap/cong-nghe-man-hinh-ips-la-gi\">tấm nền IPS</a>&nbsp;với thời gian phản hồi nhanh 1ms, gi&uacute;p giảm thiểu hiện tượng b&oacute;ng mờ v&agrave; độ trễ đầu v&agrave;o, mang đến h&igrave;nh ảnh sắc n&eacute;t, r&otilde; r&agrave;ng v&agrave; mượt m&agrave;. Bạn sẽ kh&ocirc;ng c&ograve;n bị ph&acirc;n t&acirc;m bởi những h&igrave;nh ảnh nh&ograve;e, mờ khi di chuyển nhanh, tạo ra trải nghiệm chơi game v&ocirc; c&ugrave;ng ấn tượng. G&oacute;c nh&igrave;n rộng 178&deg; cho ph&eacute;p bạn thưởng thức h&igrave;nh ảnh tuyệt đẹp từ mọi g&oacute;c độ.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/thum-1600x1062__3__451a8e7eb3e349b29d1fe563a5c19373_1024x1024.jpg\" alt=\"GEARVN - M&agrave;n h&igrave;nh LG 24GS65F-B 24&ldquo; IPS 180Hz HDR10 Gsync chuy&ecirc;n game\"></p>\r\n<h3><strong>C&ocirc;ng nghệ hỗ trợ đỉnh cao</strong></h3>\r\n<p>LG 24GS65F-B được trang bị c&ocirc;ng nghệ NVIDIA&reg; G-SYNC&reg; Compatible v&agrave; AMD FreeSync&trade;, gi&uacute;p đồng bộ h&oacute;a tốc độ khung h&igrave;nh giữa&nbsp;<a href=\"https://gearvn.com/collections/vga-card-man-hinh\">card đồ họa</a>&nbsp;v&agrave; m&agrave;n h&igrave;nh, loại bỏ hiện tượng xước, giật h&igrave;nh, mang đến trải nghiệm chơi game mượt m&agrave;, kh&ocirc;ng&nbsp;<a href=\"https://gearvn.com/blogs/cong-nghe/lag-do-mang-hay-giat-hinh-do-may-yeu-day-la-cach-ban-phan-biet\">giật lag</a>. Bạn sẽ c&oacute; được những pha h&agrave;nh động mượt m&agrave;, kh&ocirc;ng bị gi&aacute;n đoạn, tạo n&ecirc;n lợi thế cạnh tranh trong mọi trận đấu.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/thum-1600x1062__2__b47de60d68da487c8c2082d7e7cabba6_1024x1024.jpg\" alt=\"GEARVN - M&agrave;n h&igrave;nh LG 24GS65F-B 24&ldquo; IPS 180Hz HDR10 Gsync chuy&ecirc;n game\"></p>\r\n<h3><strong>Thiết kế tối ưu, ph&ugrave; hợp với mọi kh&ocirc;ng gian</strong></h3>\r\n<p>LG 24GS65F-B c&oacute; thiết kế viền 3 cạnh si&ecirc;u mỏng, mang đến trải nghiệm xem đắm ch&igrave;m. Ch&acirc;n đế c&oacute; thể điều chỉnh độ nghi&ecirc;ng, độ cao v&agrave; pivot, gi&uacute;p bạn t&igrave;m được tư thế chơi game thoải m&aacute;i nhất. Dynamic Action Sync, Black Stabilizer, Điểm ngắm, Bộ đếm FPS l&agrave; những t&iacute;nh năng hỗ trợ th&ecirc;m cho game thủ, gi&uacute;p bạn dễ d&agrave;ng chiến thắng.</p>', '3590000.00', '4390000.00', 20, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 7, 7, 12, 1, 'images/OsU5XIg2IxCl2rEOjWWLxn1fCbi4nMuMHfAdDwyh.jpg', '2025-09-02 09:30:59', '2025-09-16 15:51:21', NULL, 1, 1),
(28, 'Màn hình ViewSonic VX2479-HD-PRO 24\" IPS 180Hz chuyên game', 'WD3789', '<h2><strong>Đ&aacute;nh gi&aacute; chi tiết&nbsp;m&agrave;n h&igrave;nh ViewSonic VX2479-HD-PRO 24\" IPS 180Hz chuy&ecirc;n game</strong></h2>\r\n<p>Trong thế giới c&ocirc;ng nghệ hiện đại, việc lựa chọn c&aacute;c thiết bị ph&ugrave; hợp để n&acirc;ng cao trải nghiệm sử dụng l&agrave; điều v&ocirc; c&ugrave;ng quan trọng. Đặc biệt, đối với c&aacute;c game thủ, một chiếc m&agrave;n h&igrave;nh chất lượng cao với nhiều t&iacute;nh năng ti&ecirc;n tiến kh&ocirc;ng chỉ mang lại sự th&iacute;ch th&uacute; m&agrave; c&ograve;n l&agrave; yếu tố quyết định chiến thắng trong c&aacute;c trận đấu. H&atilde;y c&ugrave;ng&nbsp;<a href=\"https://gearvn.com/\">GEARVN</a>&nbsp;kh&aacute;m ph&aacute;&nbsp;<a href=\"https://gearvn.com/collections/man-hinh-viewsonic\">m&agrave;n h&igrave;nh&nbsp;ViewSonic</a>&nbsp;VX2479-HD-PRO 24\" IPS 180Hz chuy&ecirc;n game &ndash; một trong những lựa chọn h&agrave;ng đầu cho c&aacute;c game thủ đam m&ecirc; c&ocirc;ng nghệ.</p>\r\n<h3><strong>Bảo vệ đ&ocirc;i mắt bạn</strong></h3>\r\n<p>&Aacute;nh s&aacute;ng xanh từ&nbsp;<a href=\"https://gearvn.com/pages/man-hinh\">m&agrave;n h&igrave;nh</a>&nbsp;c&oacute; thể g&acirc;y hại cho mắt nếu sử dụng trong thời gian d&agrave;i. M&agrave;n h&igrave;nh ViewSonic t&iacute;ch hợp c&ocirc;ng nghệ Blue Light Filter gi&uacute;p lọc bớt &aacute;nh s&aacute;ng xanh c&oacute; hại, mang lại cảm gi&aacute;c thoải m&aacute;i cho mắt ngay cả khi bạn sử dụng l&acirc;u d&agrave;i. Đ&acirc;y l&agrave; một t&iacute;nh năng kh&ocirc;ng thể thiếu cho bất kỳ b&agrave;n l&agrave;m việc n&agrave;o, đặc biệt l&agrave; đối với những người thường xuy&ecirc;n l&agrave;m việc với&nbsp;<a href=\"https://gearvn.com/pages/laptop-van-phong\">m&aacute;y t&iacute;nh</a>.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gpg-23-mon-vx2479-hd-pro-prdp_f02_l_7c020232e2fb4021a643d4e70ecee183.jpg\"></p>\r\n<h3><strong>N&acirc;ng cao tầm nh&igrave;n trong game</strong></h3>\r\n<p>Với chế độ Black Stabilization, m&agrave;n h&igrave;nh ViewSonic l&agrave;m tối c&aacute;c khu vực tối trong game, gi&uacute;p bạn dễ d&agrave;ng nh&igrave;n thấy kẻ th&ugrave; ẩn nấp trong b&oacute;ng tối. Kh&ocirc;ng chỉ gi&uacute;p bạn c&oacute; lợi thế trong c&aacute;c trận đấu m&agrave; c&ograve;n n&acirc;ng cao khả năng phản xạ v&agrave; chiến thuật trong game. Chế độ Crosshair c&ograve;n th&ecirc;m t&acirc;m ngắm v&agrave;o m&agrave;n h&igrave;nh, gi&uacute;p bạn c&oacute; thể ngắm bắn ch&iacute;nh x&aacute;c hơn trong c&aacute;c tựa game FPS. Với t&iacute;nh năng n&agrave;y, bạn sẽ kh&ocirc;ng c&ograve;n gặp kh&oacute; khăn trong việc canh chỉnh t&acirc;m ngắm, từ đ&oacute; n&acirc;ng cao hiệu quả chiến đấu v&agrave; khả năng ti&ecirc;u diệt đối thủ.&nbsp;Đ&acirc;y đ&uacute;ng thật l&agrave; một c&ocirc;ng nghệ tuyệt vời cho bất kỳ game thủ n&agrave;o muốn n&acirc;ng cao kỹ năng chơi game của m&igrave;nh.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/man_hinh_viewsonic_vx2479-4_fc796c2b8a144617980836c1ead0e21d_grande.jpg\" alt=\"M&agrave;n h&igrave;nh ViewSonic VX2479-HD-PRO 24\"></p>\r\n<h3><strong>Phản ứng nhanh hơn</strong></h3>\r\n<p>M&agrave;n h&igrave;nh ViewSonic đi k&egrave;m với phần mềm ViewSonic Control Center, cho ph&eacute;p bạn dễ d&agrave;ng điều chỉnh c&aacute;c c&agrave;i đặt m&agrave;n h&igrave;nh như độ s&aacute;ng, độ tương phản, m&agrave;u sắc v&agrave; chế độ chơi game. Tất cả c&aacute;c thiết lập n&agrave;y đều c&oacute; thể được tinh chỉnh một c&aacute;ch nhanh ch&oacute;ng v&agrave; dễ d&agrave;ng, mang lại trải nghiệm sử dụng tối ưu nhất.&nbsp;Chức năng Low Input Lag của m&agrave;n h&igrave;nh ViewSonic giảm thiểu độ trễ đầu v&agrave;o, gi&uacute;p bạn c&oacute; thể phản ứng nhanh hơn trong game. Đối với c&aacute;c game đ&ograve;i hỏi tốc độ v&agrave; phản xạ nhanh như FPS, MOBA. Bạn sẽ kh&ocirc;ng c&ograve;n phải lo lắng về việc mất đi những khoảnh khắc quan trọng trong trận đấu.</p>\r\n<h3><img src=\"https://file.hstatic.net/200000722513/file/man_hinh_viewsonic_vx2479-3_3781a42818174580b6833ec6d0169669_grande.jpg\" alt=\"M&agrave;n h&igrave;nh ViewSonic VX2479-HD-PRO 24\"></h3>\r\n<h3><strong>Kết nối đa dạng</strong></h3>\r\n<p>Để mang đến sự tiện lợi tối đa, m&agrave;n h&igrave;nh ViewSonic được trang bị đầy đủ phụ kiện bao gồm c&aacute;p nguồn, c&aacute;p HDMI v&agrave; c&aacute;p DisplayPort. Việc kết nối với c&aacute;c thiết bị kh&aacute;c trở n&ecirc;n đơn giản v&agrave; nhanh ch&oacute;ng hơn bao giờ hết, gi&uacute;p bạn dễ d&agrave;ng lắp đặt v&agrave; sử dụng.</p>', '3000000.00', '3390000.00', 15, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 7, 6, 12, 1, 'images/A4osn1V6m0Pin0UFNuJt9itSq2ru3naoeEGlYOi2.png', '2025-09-02 09:33:12', '2025-09-02 09:33:12', NULL, 0, 0),
(29, 'Bàn phím ASUS M704 ROG AZOTH X NX Storm V2 Switch', 'WD5941', '<ul>\r\n<li class=\"4\">\r\n<div>Kết nối</div>\r\n<div>USB 2.0 (Type-C to Type-A) / Bluetooth 5.1 / RF 2.4GHz</div>\r\n</li>\r\n<li class=\"6\">\r\n<div>T&iacute;nh năng</div>\r\n<div>M&agrave;n h&igrave;nh OLED / Hot-swap / N Key Rollover / Macro</div>\r\n</li>\r\n<li class=\"7\">\r\n<div>Bảo h&agrave;nh</div>\r\n<div>24 th&aacute;ng</div>\r\n</li>\r\n<li class=\"8\">\r\n<div>Switch</div>\r\n<div>ROG NX Mechanical Switch Storm V2</div>\r\n</li>\r\n<li class=\"9\">\r\n<div>K&iacute;ch thước</div>\r\n<div>325.4 x 136.2 x 40 mm</div>\r\n</li>\r\n<li class=\"10\">\r\n<div>Trọng lượng</div>\r\n<div>1600g (đi k&egrave;m đệm tay)</div>\r\n</li>\r\n<li class=\"11\">\r\n<div>Keycap</div>\r\n<div>Stellar-themed ROG</div>\r\n</li>\r\n<li class=\"12\">\r\n<div>RGB</div>\r\n<div>RGB Per keys</div>\r\n</li>\r\n</ul>', '7200000.00', '7900000.00', 13, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, 12, 1, 'images/zwmEiPrmUS07ossOfiyPniD4bSA8t1FuOkWOyLKb.jpg', '2025-09-02 09:37:40', '2025-09-04 00:44:32', NULL, 0, 0);
INSERT INTO `san_phams` (`id`, `ten`, `ma_san_pham`, `mo_ta`, `gia`, `gia_so_sanh`, `so_luong`, `sku`, `co_bien_the`, `id_chip`, `id_mainboard`, `id_gpu`, `id_tannhiet`, `id_case`, `id_nguon`, `id_category`, `id_brand`, `bao_hanh_thang`, `hoat_dong`, `anh_dai_dien`, `created_at`, `updated_at`, `deleted_at`, `luot_mua`, `luot_xem`) VALUES
(30, 'Chuột ASUS ROG Strix Impact III', 'WD3764', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Kết nối</strong></p>\r\n</td>\r\n<td>\r\n<p>USB 2.0</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Cảm biến</strong></p>\r\n</td>\r\n<td>\r\n<p><br>Pixart3311</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Độ nhạy</strong></p>\r\n</td>\r\n<td>\r\n<p>12.000 DPI</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Switch chuột</strong></p>\r\n</td>\r\n<td>\r\n<p>70 Triệu lần nhấn</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Tần số gửi t&iacute;n hiệu chuột tới m&aacute;y t&iacute;nh</strong></p>\r\n</td>\r\n<td>\r\n<p>1000 Hz</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Kiểu chuột</strong></p>\r\n</td>\r\n<td>\r\n<p>Thuận hai tay</p>\r\n<p>C&aacute;ch cầm chuột Claw grip</p>\r\n<p>Kiểu cầm bằng đầu ng&oacute;n tay</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>K&iacute;ch thước</strong></p>\r\n</td>\r\n<td>\r\n<p><br>126x62x39mm</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Trọng lượng kh&ocirc;ng c&aacute;p</strong></p>\r\n</td>\r\n<td>\r\n<p>59g</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<h2><strong>Đ&aacute;nh gi&aacute; chi tiết chuột Asus ROG Strix Impact III</strong></h2>\r\n<p>Asus đ&atilde; hợp t&aacute;c với c&aacute;c game thủ chuy&ecirc;n nghiệp để c&oacute; thể mang đến một sản phẩm tốt nhất cho người d&ugrave;ng. Thiết kế&nbsp;<a href=\"https://gearvn.com/blogs/thu-thuat-giai-dap/chuot-cong-thai-hoc-la-gi\" target=\"_blank\" rel=\"noopener\">chuột&nbsp;c&ocirc;ng th&aacute;i học</a>&nbsp;thuận cả hai tay, nhẹ như b&ocirc;ng v&agrave; ph&ugrave; hợp với mọi đối tượng người d&ugrave;ng để chơi hiệu năng v&agrave; cảm gi&aacute;c cầm nắm thoải m&aacute;i.&nbsp;<strong><a href=\"https://gearvn.com/collections/chuot-asus\" target=\"_blank\" rel=\"noopener\">Chuột Asus ROG</a>&nbsp;Strix Impact III</strong>&nbsp;hứa hẹn l&agrave; một trong những item đ&aacute;ng mua nhất cho game thủ.&nbsp;</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gearvn-chuot-asus-rog-strix-impact-iii-5_b57a258075534f779f7d68fa199ee282_1024x1024.png\" alt=\"GEARVN - Chuột Asus ROG Strix Impact III\"></p>\r\n<h3><strong>Ch&iacute;nh x&aacute;c v&agrave; hiệu suất cao</strong></h3>\r\n<p>Cảm biến 12.000 DPI theo d&otilde;i ở tốc độ l&ecirc;n đến 300 IPS v&agrave; với polling rate 1.000Hz, v&igrave; vậy bạn được đảm bảo độ ch&iacute;nh x&aacute;c cao, phản hồi nhanh v&agrave; kiểm so&aacute;t ch&iacute;nh x&aacute;c - v&agrave; tất cả đều kh&ocirc;ng c&oacute; một ch&uacute;t độ trễ. Asus ROG Strix Impact III thậm ch&iacute; c&ograve;n bao gồm năm n&uacute;t c&oacute; thể lập tr&igrave;nh, cho ph&eacute;p bạn điều khiển t&ugrave;y chỉnh cho tr&ograve; chơi hoặc phong c&aacute;ch chơi của m&igrave;nh.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gearvn-chuot-asus-rog-strix-impact-iii-6_4ea1bde14e914f448d8f84041642ca9c_1024x1024.png\" alt=\"GEARVN - Chuột Asus ROG Strix Impact III\"></p>\r\n<h3><strong>Hệ thống n&uacute;t xoay v&ograve;ng</strong></h3>\r\n<p>Di chuyển ngắn hơn c&oacute; nghĩa l&agrave; nhấn chuột nhanh hơn, đ&oacute; l&agrave; l&yacute; do tại sao c&aacute;c kỹ sư của Asus trang bị cho ROG Strix Impact III c&aacute;c n&uacute;t xoay. Cơ chế sử dụng l&ograve; xo v&agrave; bản lề kim loại để c&acirc;n bằng c&aacute;c ph&iacute;m v&agrave; giảm thiểu khoảng c&aacute;ch giữa c&aacute;c n&uacute;t v&agrave; c&ocirc;ng tắc. Kết quả l&agrave; việc di chuyển tối thiểu v&agrave; quay trở lại nhanh ch&oacute;ng, đảm bảo tốc độ tuyệt vời, khả năng phản hồi v&agrave; t&iacute;nh nhất qu&aacute;n với mỗi lần nhấn.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gearvn-chuot-asus-rog-strix-impact-iii-7_71833ad271364f4aac166341ad4cece6_1024x1024.png\" alt=\"GEARVN - Chuột Asus ROG Strix Impact III\"></p>\r\n<h3><strong>N&uacute;t chỉnh DPI t&iacute;ch hợp</strong></h3>\r\n<p>Asus ROG Strix Impact III được trang bị n&uacute;t DPI nhanh ch&oacute;ng cho ph&eacute;p bạn chuyển nhanh giữa bốn c&agrave;i đặt độ trước hoặc sử dụng t&iacute;nh năng DPI-on-the-Scroll để thực hiện điều khiển nhanh ch&oacute;ng. Hệ thống chiếu s&aacute;ng&nbsp;<a href=\"https://gearvn.com/blogs/thu-thuat-giai-dap/meo-kich-hoat-den-aura-sync-rgb-cho-may-tinh-laptop-asus\" target=\"_blank\" rel=\"noopener\">Aura RGB</a>&nbsp;t&iacute;ch hợp thậm ch&iacute; c&ograve;n thay đổi m&agrave;u sắc để phản &aacute;nh lựa chọn của bạn, cung cấp cảnh b&aacute;o h&igrave;nh ảnh tức th&igrave; khi bạn đạt đến độ nhạy mong muốn.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gearvn-chuot-asus-rog-strix-impact-iii-10_007f3efedd224c988954aaa12c303c07_1024x1024.png\" alt=\"GEARVN - Chuột Asus ROG Strix Impact III\"></p>\r\n<h3><strong>Led RGB Aura Sync</strong></h3>\r\n<p>Asus ROG Strix Impact III tỏa s&aacute;ng từ đầu đến đu&ocirc;i, với &aacute;nh s&aacute;ng Aura RGB được t&iacute;ch hợp. &Aacute;nh s&aacute;ng c&oacute; thể được t&ugrave;y chỉnh bằng c&aacute;ch sử dụng phổ m&agrave;u gần như v&ocirc; tận v&agrave; một loạt c&aacute;c hiệu ứng động v&agrave; c&oacute; thể lưu trữ tối đa ba cấu h&igrave;nh tr&ecirc;n ph&iacute;m để mang theo sở th&iacute;ch của bạn đến bất cứ đ&acirc;u.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gearvn-chuot-asus-rog-strix-impact-iii-8_7daadd3c64394faab2ee829f03e45104_1024x1024.png\" alt=\"GEARVN - Chuột Asus ROG Strix Impact III\"></p>\r\n<h3><strong>Armoury III</strong></h3>\r\n<p>ASUS Armoury III l&agrave; một tiện &iacute;ch cấu h&igrave;nh thiết bị ngoại vi, dựa tr&ecirc;n tr&igrave;nh điều khiển n&acirc;ng cao cung cấp khả năng điều khiển mở rộng. Giao diện người d&ugrave;ng trực quan cho ph&eacute;p bạn dễ d&agrave;ng điều chỉnh ROG Strix Impact III cho ph&ugrave; hợp với lối chơi của m&igrave;nh - điều chỉnh c&agrave;i đặt hiệu chỉnh bề mặt v&agrave; hiệu suất, c&aacute;c n&uacute;t chương tr&igrave;nh v&agrave; bản đồ, t&ugrave;y chỉnh hiệu ứng &aacute;nh s&aacute;ng v&agrave; hơn thế nữa. Bạn thậm ch&iacute; c&oacute; thể theo d&otilde;i số liệu thống k&ecirc; phần cứng trong qu&aacute; tr&igrave;nh chơi tr&ograve; chơi để ph&acirc;n t&iacute;ch dữ liệu.</p>\r\n<p><img src=\"https://file.hstatic.net/200000722513/file/gearvn-chuot-asus-rog-strix-impact-iii-9_b3b8c821b09b498e8d67746e2ddf39b1_1024x1024.png\" alt=\"GEARVN - Chuột Asus ROG Strix Impact III\"></p>', '990000.00', '1990000.00', 13, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, 12, 1, 'images/2HMaN4u5sN38MtkLVlnKTJzcAxY28F3cwjBxvnRf.jpg', '2025-09-02 09:40:57', '2025-09-05 03:39:20', NULL, 1, 2),
(31, 'Chuột Razer Cobra', 'WD3820', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Kết nối</strong></p>\r\n</td>\r\n<td>\r\n<p>Bluetooth 5.1</p>\r\n<p>RF 2.4GHz</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Loại pin</strong></td>\r\n<td>Pin AA /AAA</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Thời lượng pin</strong></td>\r\n<td>L&ecirc;n đến 450 tiếng (kh&ocirc;ng bật led)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Cảm biến</strong></p>\r\n</td>\r\n<td><br>ROG AimPoint</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Độ nhạy</strong></p>\r\n</td>\r\n<td>36000DPI</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Switch chuột</strong></p>\r\n</td>\r\n<td><br>ROG 70M Mechanical Switch</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Tần số gửi t&iacute;n hiệu chuột tới m&aacute;y t&iacute;nh</strong></p>\r\n</td>\r\n<td>\r\n<p>1000 Hz</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Kiểu chuột</strong></p>\r\n</td>\r\n<td>\r\n<p>Claw grip</p>\r\n<p>Fingertip grip</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>K&iacute;ch thước</strong></p>\r\n</td>\r\n<td>120(L)x62(w)x39(H) mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Trọng lượng kh&ocirc;ng c&aacute;p</strong></p>\r\n</td>\r\n<td>57g (Kh&ocirc;ng bao gồm USB Dongle v&agrave; pin)<br>68g (bao gồm pin AAA)<br>72g (bao gồm pin AA)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Sẵn trong hộp</strong></td>\r\n<td><br>1 x ROG Impact III Wireless gaming mouse<br>1 x Wireless receiver<br>1 x Quick start guide<br>1 x Warranty booklet<br>1 x AA battery<br>1 x AAA battery<br>1 x AAA to AA battery converter holder</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '990000.00', '1049000.00', 16, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 4, 5, 12, 1, 'images/F4988qoN04BzDP5pBKQCAmuVdaish4T2drKOfteh.jpg', '2025-09-02 09:45:38', '2025-09-03 15:14:41', NULL, 1, 0),
(32, 'Card màn hình Gigabyte GeForce RTX 5060 Windforce OC 8GB', 'WD9715', '<h2><strong>Th&ocirc;ng số kỹ thuật:&nbsp;</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr>\r\n<td>Thương hiệu:</td>\r\n<td>GIGABYTE</td>\r\n</tr>\r\n<tr>\r\n<td>Bảo h&agrave;nh:</td>\r\n<td>36 th&aacute;ng</td>\r\n</tr>\r\n<tr>\r\n<td>Chipset</td>\r\n<td>GeForce RTX&trade; 5060</td>\r\n</tr>\r\n<tr>\r\n<td>Core Clock</td>\r\n<td>2512 MHz (Reference card : 2497MHz)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>CUDA&reg; Cores</td>\r\n<td>3840</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Memory Clock</td>\r\n<td>28 Gbps</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Memory Size</td>\r\n<td>8 GB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Memory Type</td>\r\n<td>GDDR7</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Memory Bus</td>\r\n<td>128 bit</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Card Bus</td>\r\n<td>PCI-E 5.0</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Digital max resolution</td>\r\n<td>7680x4320</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Multi-view</td>\r\n<td>4</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Card size</td>\r\n<td>L=199 W=116 H=40</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>PCB Form</td>\r\n<td>ATX</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>DirectX</td>\r\n<td>DirectX 12 API</td>\r\n</tr>\r\n<tr>\r\n<td>OpenGL</td>\r\n<td>4.6</td>\r\n</tr>\r\n<tr>\r\n<td>Bộ nguồn y&ecirc;u cầu</td>\r\n<td>450W</td>\r\n</tr>\r\n<tr>\r\n<td>Nguồn kết nối</td>\r\n<td>8 Pin*1</td>\r\n</tr>\r\n<tr>\r\n<td>Cổng</td>\r\n<td>DisplayPort 2.1b *3<br>HDMI 2.1b *1</td>\r\n</tr>\r\n<tr>\r\n<td>Phụ kiện</td>\r\n<td>S&aacute;ch hướng dẫn</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '9990000.00', '10490000.00', 12, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 2, 36, 1, 'images/LI6K8xUYH0hem7pjOLuD1wscY2gagLtkPMzAuluo.png', '2025-09-02 10:12:19', '2025-09-04 00:44:48', NULL, 0, 2),
(33, 'Card màn hình Gigabyte GeForce RTX 5060 Eagle Ice OC 8GB', 'WD8580', '<h2><strong>Th&ocirc;ng số kỹ thuật:&nbsp;</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr>\r\n<td>Thương hiệu:</td>\r\n<td>GIGABYTE</td>\r\n</tr>\r\n<tr>\r\n<td>Bảo h&agrave;nh:</td>\r\n<td>36 th&aacute;ng</td>\r\n</tr>\r\n<tr>\r\n<td>Chipset</td>\r\n<td>GeForce RTX&trade; 5060</td>\r\n</tr>\r\n<tr>\r\n<td>Core Clock</td>\r\n<td>2550 MHz (Reference card : 2497MHz)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>CUDA&reg; Cores</td>\r\n<td>3840</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Memory Clock</td>\r\n<td>28 Gbps</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Memory Size</td>\r\n<td>8 GB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Memory Type</td>\r\n<td>GDDR7</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Memory Bus</td>\r\n<td>128 bit</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Card Bus</td>\r\n<td>PCI-E 5.0</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Digital max resolution</td>\r\n<td>7680x4320</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Multi-view</td>\r\n<td>4</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Card size</td>\r\n<td>L=208 W=120 H=40</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>PCB Form</td>\r\n<td>ATX</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>DirectX</td>\r\n<td>DirectX 12 API</td>\r\n</tr>\r\n<tr>\r\n<td>OpenGL</td>\r\n<td>4.6</td>\r\n</tr>\r\n<tr>\r\n<td>Bộ nguồn y&ecirc;u cầu</td>\r\n<td>450W</td>\r\n</tr>\r\n<tr>\r\n<td>Nguồn kết nối</td>\r\n<td>8 Pin*1</td>\r\n</tr>\r\n<tr>\r\n<td>Cổng</td>\r\n<td>DisplayPort 2.1b *3<br>HDMI 2.1b *1</td>\r\n</tr>\r\n<tr>\r\n<td>Phụ kiện</td>\r\n<td>S&aacute;ch hướng dẫn</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '10490000.00', '11690000.00', 18, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 2, 36, 1, 'images/IKU9OuClG1XRrbfoMAN2qjBaWxA2PAASDzHxyPMi.png', '2025-09-02 10:16:19', '2025-09-02 10:16:19', NULL, 0, 0),
(34, 'Card màn hình GIGABYTE GeForce RTX 4070 SUPER WINDFORCE OC 12G (GV-N407SWF3OC-12GD)', 'WD8817', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Nh&acirc;n đồ họa&nbsp;</strong></td>\r\n<td>GeForce RTX&trade; 4070 SUPER</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bus ti&ecirc;u chuẩn</strong></td>\r\n<td>PCI-E 4.0</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Xung nhịp</strong></td>\r\n<td>2505 MHz (Reference card: 2475 MHz)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Nh&acirc;n CUDA</strong></td>\r\n<td>7168</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tốc độ bộ nhớ</strong></td>\r\n<td>21 Gbps</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>OpenGL</strong></td>\r\n<td>OpenGL&reg;4.6</td>\r\n</tr>\r\n<tr>\r\n<td><strong>DirectX</strong></td>\r\n<td>12 Ultimate</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bộ nhớ Video</strong></td>\r\n<td>12GB GDDR6X</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Giao thức bộ nhớ</strong></td>\r\n<td>192-bit</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ ph&acirc;n giải</strong></td>\r\n<td>Độ ph&acirc;n giải tối đa 7680 x 4320</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Số lượng m&agrave;n h&igrave;nh tối đa hỗ trợ</strong></td>\r\n<td>4</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Cổng xuất h&igrave;nh</strong></td>\r\n<td>\r\n<p class=\"ProductSpecSingle__productSpecListItem__2wof7\">HDMI 2.1&nbsp;x 1</p>\r\n<p>DisplayPort 1.4a x 3</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>L=261 W=126 H=50 mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a>&nbsp;kiến nghị</strong></td>\r\n<td>700W</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Kết nối nguồn</strong></td>\r\n<td>1 x 16 pin</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Phụ kiện</strong></td>\r\n<td>1 x Hướng dẫn nhanh<br>1 x C&aacute;p chuyển đổi (1 ra 2)</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '19490000.00', '20990000.00', 18, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 2, 36, 1, 'images/stQzI4s2CCI0U1UwFsGtKAIKJCUcKMHjxc82FCuj.png', '2025-09-02 10:21:25', '2025-09-02 10:21:25', NULL, 0, 0),
(35, 'Card màn hình ASUS Dual Radeon RX 6500 XT V2 OC Edition 4GB GDDR6 (DUAL-RX6500XT-O4G-V2)', 'WD2073', '<p><strong>Th&ocirc;ng số kỹ thuật:&nbsp;</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Thương hiệu:</strong></td>\r\n<td>ASUS</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảo h&agrave;nh:</strong></td>\r\n<td>36 th&aacute;ng</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Model:</strong></td>\r\n<td>DUAL-RX6500XT-O4G-V2</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Core Clock:</strong></td>\r\n<td>\r\n<ul>\r\n<li>OC mode: up to 2820 MHz(Boost Clock)/ up to 2670 MHz(Game Clock)</li>\r\n<li>Gaming mode: up to 2820 MHz(Boost Clock)/ up to 2650 MHz(Game Clock)</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chipset:</strong></td>\r\n<td>Radeon RX 6500 XT</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Giao thức kết nối:</strong></td>\r\n<td>PCI Express 4.0</td>\r\n</tr>\r\n<tr>\r\n<td><strong>OpenGL</strong></td>\r\n<td>OpenGL&reg;4.6</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Nh&acirc;n xử l&yacute;:</strong></td>\r\n<td>1024</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bộ nhớ:</strong></td>\r\n<td>\r\n<ul>\r\n<li>Dung lượng: 4GB</li>\r\n<li>Loại: GDDR6</li>\r\n<li>Tốc độ:&nbsp;18 Gbps</li>\r\n<li>Giao thức:&nbsp;64-bit</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ ph&acirc;n giải kỹ thuật số tối đa:</strong></td>\r\n<td>7680 x 4320</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Số m&agrave;n h&igrave;nh hỗ trợ xuất tối đa:</strong></td>\r\n<td>2</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Cổng xuất h&igrave;nh:</strong></td>\r\n<td>Yes x 1 (Native HDMI 2.1)<br>Yes x 1 (Native DisplayPort 1.4a)<br>HDCP Support Yes (2.3)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Hỗ trợ NVlink/ Crossfire:</strong></td>\r\n<td>Kh&ocirc;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước:</strong></td>\r\n<td>201 x 128 x 40 mm<br>7.9 x 5.03 x 1.57 inch</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\" target=\"_blank\" rel=\"noopener\">PSU</a>&nbsp;đề nghị:</strong></td>\r\n<td>500W</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Đầu cấp nguồn:</strong></td>\r\n<td>1 x 6-pin</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Khe cắm</strong></td>\r\n<td>2 Khe</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '3790000.00', '4990000.00', 16, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 1, 36, 1, 'images/mdXl4SC9L4ttmd4lj1e5ncO19rLtFfSaAvWvESgS.png', '2025-09-02 10:24:08', '2025-09-02 10:24:08', NULL, 0, 0),
(36, 'Bo mạch chủ ASUS H610M-F WIFI DDR4', 'WD2154', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\" target=\"_blank\" rel=\"noopener\"><strong>CPU</strong></a></td>\r\n<td>Intel&reg; Socket LGA1700 for Intel&reg; Core&trade; 14th &amp; 13th GenProcessors, Intel&reg; Core&trade; 12th Gen, Pentium&reg; Gold and Celeron&reg; Processors*<br>Supports up to Intel&reg; 65W CPU<br>Supports Intel&reg; Turbo Boost Technology 2.0and Intel&reg; Turbo Boost Max Technology 3.0**<br>* Refer to https://www.asus.com/support/download-center/ for CPU support list.<br>** Intel&reg; Turbo Boost Max Technology 3.0 support depends on the CPU types.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Chipset</strong></td>\r\n<td>Intel&reg;&nbsp;<a href=\"https://gearvn.com/collections/mainboard-intel-h610-alder-lake\" target=\"_blank\" rel=\"noopener\">H610</a>&nbsp;Chipset</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Memory</strong></td>\r\n<td>2 x DIMM slots, Max. 64GB,&nbsp;<a href=\"https://gearvn.com/collections/ram-ddr4\" target=\"_blank\" rel=\"noopener\">DDR4</a>&nbsp;3200/3000/2933/2800/2666/2400/2133 Non-ECC, Un-buffered Memory*<br>Dual channel memory architectureSupports Intel&reg; Extreme Memory Profile (XMP) memory module*<br>Supported memory types, data rate (speed), and number of DRAM modules vary depending on the CPU and memory configuration, for more information please refer to CPU/Memory Support list under the Support tab of product information site or visit https://www.asus.com/support/download-center/. Adjustments will be made based on the specifications of mass-produced memory products available on the market.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Graphics</strong></td>\r\n<td>2 x HDMITM port**<br>* Graphics specifications may vary between CPU types. Please refer to www.intel.com for any updates.<br>** Supports 4K@30Hz as specified in HDMI 1.4.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Expansion Slots</strong></td>\r\n<td><strong>Intel&reg; Core&trade; Processors (14th &amp; 13th &amp; 12th Gen)</strong><br>1 x PCIe 4.0 x16 slot<br><strong>Intel&reg; H610 Chipset1 x PCIe 3.0 x1 slot</strong><br>- To ensure compatibility of the device installed, please refer to https://www.asus.com/support/ for the list of supported peripherals.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Graphics</strong></td>\r\n<td><strong>Supports 1 x M.2 slot and 2 x SATA 6Gb/s ports<br>Intel&reg; H610 Chipset</strong><br>M.2 slot (Key M), type 2242/2260/2280 (supports PCIe 3.0 x4 mode)2 x SATA 6Gb/s ports</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Ethernet</strong></td>\r\n<td>1 x Realtek 1Gb Ethernet<br>Wireless &amp; BluetoothWi-Fi 6Wi-Fi 6 (802.11 a/b/g/n/ac/ax)Supports 2.4/5GHz frequency bandBluetooth&reg; v5.3**The Bluetooth version may vary, please refer to the Wi-Fi module manufacturer\'s website for the latest specifications.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Wireless &amp; Bluetooth</strong></td>\r\n<td>Wi-Fi 6<br>Wi-Fi 6 (802.11 a/b/g/n/ac/ax)<br>Supports 2.4/5GHz frequency band<br>Bluetooth&reg; v5.3*<br>*The Bluetooth version may vary, please refer to the Wi-Fi module manufacturer\'s website for the latest specifications.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>USB</strong></td>\r\n<td><strong>Rear USB (Total 5 ports)</strong><br>2 x USB 5Gbps ports (2 x Type-A)<br>3 x USB 2.0 ports (3 x Type-A)<br><strong>Front USB (Total 4 ports)</strong><br>1 x USB 5Gbps header supports 2 additional USB 5Gbps ports<br>1 x USB 2.0 header supports 2 additional USB 2.0 ports</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Audio</strong></td>\r\n<td>Realtek 7.1 Surround Sound High Definition Audio CODEC*<br>- Supports: Jack-detection, Multi-streaming, Front Panel Jack-retasking<br>- Supports up to 24-Bit/192 kHz playback\"<br>Audio Features<br>- Audio Shielding<br>- Premium audio capacitors<br>- Dedicated audio PCB layers<br>* A chassis with an HD audio module in the front panel is required to support 7.1 Surround Sound audio output.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Back Panel I/O Ports</strong></td>\r\n<td>2 x USB 5Gbps ports (2 x Type-A)<br>3 x USB 2.0 ports (3 x Type-A)<br>2 x HDMI port<br>1 x Wi-Fi module<br>1 x Realtek 1Gb Ethernet port<br>3 x Audio jacks</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Internal I/O Connectors</strong></td>\r\n<td><strong>Fan and Cooling Related</strong><br>1 x 4-pin CPU Fan header<br>1 x 4-pin Chassis Fan header<br><strong>Power Related</strong><br>1 x 24-pin Main Power connector<br>1 x 4-pin +12V Power connector<br><strong>Storage Related</strong><br>1 x M.2 slot (Key M)<br>2 x SATA 6Gb/s ports<br><strong>USB</strong><br>1 x USB 5Gbps header supports 2 additionalUSB 5Gbps ports<br>1 x USB 2.0 header supports 2 additionalUSB 2.0 ports<br><strong>Miscellaneous</strong><br>1 x Clear CMOS header<br>1 x Front Panel Audio header (F_AUDIO)<br>1 x Speaker header<br>1 x 10-1 pin Front Panel System header</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Special Features</strong></td>\r\n<td><strong>ASUS 5X PROTECTION III</strong><br>-&nbsp;DIGI+ VRM<br>- LANGuard<br>- Overvoltage protection<br>- SafeSlot Core<br>- Stainless-steel back I/O<br><strong>ASUS Q-Design</strong><br>- Q-DIMM<br>- Q-Slot<br>- Q-LED Core<br><strong>ASUS Thermal Solution</strong><br>- Aluminum heatsink design</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Software Features</strong></td>\r\n<td><strong>ASUS Exclusive Software</strong><br>Armoury Crate<br>- Power Saving<br>ASUS DriverHub<br>ASUS&nbsp;<a href=\"https://gearvn.com/blogs/thu-thuat-giai-dap/cach-tai-va-su-dung-cpu-z-de-kiem-tra-cau-hinh-may-tinh\" target=\"_blank\" rel=\"noopener\">CPU-Z</a><br>Norton 360 Deluxe (60 Days Free Trial)<br>WinRAR (40 Days Free Trial)<br><strong>UEFI BIOS</strong><br>ASUS EZ DIY<br>- ASUS CrashFree BIOS 3<br>- ASUS EZ Flash<br>- ASUS UEFI BIOS EZ Mode</td>\r\n</tr>\r\n<tr>\r\n<td><strong>BIOS</strong></td>\r\n<td>128 Mb Flash ROM, UEFI AMI BIOS</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Manageability</strong></td>\r\n<td>WOL by PME, PXE</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Accessories</strong></td>\r\n<td><strong>Cables</strong><br>2 x SATA 6Gb/s cables<br><strong>Miscellaneous</strong><br>1 x ASUS Wi-Fi moving antennas<br>1 x I/O shield<br>1 x M.2 anchor<br><strong>Documentation</strong><br>1 x Quick start guide</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Operating System</strong></td>\r\n<td>Windows&reg; 11 , Windows&reg; 10 64-bit</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Form Factor</strong></td>\r\n<td>micro-ATX Form Factor<br>8.9 inch x 7.4 inch (22.6 cm x 18.8 cm )</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '2290000.00', '2390000.00', 14, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 1, 36, 1, 'images/VPKUD9Nie7GVt7qpUMRV154LcFi0xrkmwerW3FT1.png', '2025-09-02 10:30:06', '2025-09-02 10:30:06', NULL, 0, 0),
(37, 'Bo mạch chủ ASUS ROG CROSSHAIR X870E EXTREME (DDR5)', 'WD7427', '<h2><strong>Bo mạch chủ ROG Crosshair X870E Hero &ndash; Sức mạnh tối thượng cho game thủ v&agrave; nh&agrave; s&aacute;ng tạo</strong></h2>\r\n<h3><strong>Hiệu năng vượt trội &ndash; Chuẩn mực mới cho AMD Ryzen</strong></h3>\r\n<p>ROG Crosshair X870E Hero l&agrave; bo mạch chủ cao cấp nhất của ASUS d&agrave;nh cho nền tảng AMD, sẵn s&agrave;ng đồng h&agrave;nh c&ugrave;ng c&aacute;c bộ vi xử l&yacute; AMD Ryzen&trade; 9000 Series mới nhất. Trang bị chipset X870E mạnh mẽ, sản phẩm mang đến hiệu suất b&ugrave;ng nổ v&agrave; khả năng &eacute;p xung vượt trội, ph&ugrave; hợp cho game thủ, overclocker v&agrave; người d&ugrave;ng chuy&ecirc;n nghiệp.</p>\r\n<hr>\r\n<h3><strong>Tối ưu kết nối &ndash; Hạ tầng hiện đại cho tương lai</strong></h3>\r\n<ul>\r\n<li>\r\n<p><strong>PCIe 5.0 k&eacute;p</strong>: Sẵn s&agrave;ng cho thế hệ GPU v&agrave; SSD tốc độ cao.</p>\r\n</li>\r\n<li>\r\n<p><strong>WiFi 7 v&agrave; Bluetooth&reg; v5.4</strong>: Kết nối kh&ocirc;ng d&acirc;y ổn định, tốc độ si&ecirc;u nhanh, giảm độ trễ tối đa.</p>\r\n</li>\r\n<li>\r\n<p><strong>LAN 2.5Gb Intel&reg;</strong>: Mạng c&oacute; d&acirc;y tốc độ cao, l&yacute; tưởng cho chơi game v&agrave; truyền dữ liệu lớn.</p>\r\n</li>\r\n</ul>\r\n<hr>\r\n<h3><strong>C&ocirc;ng nghệ l&agrave;m m&aacute;t v&agrave; thiết kế đẳng cấp</strong></h3>\r\n<ul>\r\n<li>\r\n<p><strong>Tản nhiệt VRM lớn với ống dẫn nhiệt</strong>: Giữ hệ thống m&aacute;t mẻ ngay cả khi hoạt động ở hiệu suất tối đa.</p>\r\n</li>\r\n<li>\r\n<p><strong>Khe M.2 tản nhiệt ri&ecirc;ng biệt</strong>: Bảo vệ v&agrave; tối ưu tốc độ SSD.</p>\r\n</li>\r\n<li>\r\n<p><strong>Thiết kế đen kim loại cao cấp</strong>: Sang trọng, mạnh mẽ, ph&ugrave; hợp mọi build PC cao cấp.</p>\r\n</li>\r\n</ul>\r\n<hr>\r\n<h3><strong>Tối ưu &eacute;p xung v&agrave; AI th&ocirc;ng minh</strong></h3>\r\n<ul>\r\n<li>\r\n<p><strong>AI Overclocking</strong>: Tự động tinh chỉnh hiệu suất CPU dựa tr&ecirc;n khả năng tản nhiệt v&agrave; nguồn điện thực tế.</p>\r\n</li>\r\n<li>\r\n<p><strong>AI Cooling II</strong>: Tự động kiểm so&aacute;t tốc độ quạt, tối ưu giữa hiệu suất v&agrave; độ ồn.</p>\r\n</li>\r\n</ul>\r\n<hr>\r\n<h3><strong>ROG GEN-Z.2 v&agrave; hỗ trợ to&agrave;n diện</strong></h3>\r\n<ul>\r\n<li>\r\n<p><strong>ROG GEN-Z.2</strong>: Hỗ trợ linh hoạt nhiều ổ SSD M.2, dễ d&agrave;ng th&aacute;o lắp v&agrave; n&acirc;ng cấp.</p>\r\n</li>\r\n<li>\r\n<p><strong>Hỗ trợ bộ nhớ DDR5 l&ecirc;n đến 192GB</strong>: Tốc độ si&ecirc;u nhanh, băng th&ocirc;ng lớn, tăng cường khả năng xử l&yacute; đa t&aacute;c vụ.</p>\r\n</li>\r\n</ul>\r\n<hr>\r\n<h3><strong>L&yacute; tưởng cho ai?</strong></h3>\r\n<p>ROG Crosshair X870E Hero l&agrave; lựa chọn ho&agrave;n hảo cho:</p>\r\n<ul>\r\n<li>\r\n<p>Game thủ cần hiệu năng cao v&agrave; kết nối tối ưu.</p>\r\n</li>\r\n<li>\r\n<p>Nh&agrave; s&aacute;ng tạo nội dung cần xử l&yacute; video, đồ họa nặng.</p>\r\n</li>\r\n<li>\r\n<p>Người chơi &eacute;p xung v&agrave; đam m&ecirc; build PC cao cấp.</p>\r\n</li>\r\n</ul>\r\n<hr>\r\n<h2><strong>Mua ngay ROG Crosshair X870E Hero &ndash; N&acirc;ng tầm trải nghiệm, khai ph&aacute; sức mạnh AMD Ryzen mới</strong></h2>', '31990000.00', '32990000.00', 15, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 1, 36, 1, 'images/lgFYNhbQ1sRhoo1AY3p8vvvn7mDCbNEJFFqjItbn.jpg', '2025-09-02 10:35:33', '2025-09-02 10:35:33', NULL, 0, 0),
(38, 'Bo mạch chủ GIGABYTE B760M GAMING WIFI PLUS DDR5', 'WD4184', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><strong>CPU</strong></td>\r\n<td>LGA1700 socket: Support for the 14th, 13th, and 12th Generation Intel&reg; Core&trade;, Pentium&reg; Gold and Celeron&reg; Processors(Go to GIGABYTE\'s website for the latest CPU support list.)<br>L3 cache varies with CPU</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Chipset</strong></td>\r\n<td>Intel&reg; B760 Express Chipset</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bộ nhớ</strong></td>\r\n<td>14th and 13th Generation Intel&reg; Core&trade; i9/i7 Processors:<br>- Support for DDR5 8000(O.C.) /7800(O.C.) /7600(O.C.) /7400(O.C.) /7200(O.C.) /7000(O.C.) /6800(O.C.) /6600(O.C.) / 6400(O.C.) / 6200(O.C.) / 6000(O.C.) / 5800(O.C.) / 5600 / 5400 / 5200/ 4800/4400 MT/s memory modules<br>13th Generation Intel&reg; Core&trade; i5/i3 and 12th Generation Intel&reg; Core&trade;, Pentium&reg; Gold and Celeron&reg; Processors:<br>- Support for DDR5 4800/4400 MT/s memory modules2 x DDR5 DIMM sockets supporting up to 128 GB (64 GB single DIMM capacity) of system memory<br>Dual channel memory architecture<br>Support for ECC Un-buffered DIMM 1Rx8/2Rx8 memory modules (operate in non-ECC mode)<br>Support for non-ECC Un-buffered DIMM 1Rx8/2Rx8/1Rx16 memory modules<br>Support for Extreme Memory Profile (XMP) memory modules<br>(The CPU and memory configuration may affect the supported memory types, data rate (speed), and number of DRAM modules, please refer to \"Memory Support List\" on GIGABYTE\'s website for more information.)<br>Card đồ họa t&iacute;ch hợpIntegrated Graphics Processor-Intel&reg; HD Graphics support:- 1 x D-Sub port, supporting a maximum resolution of 1920x1200@60 Hz- 1 x HDMI port, supporting a maximum resolution of 4096x2160@60 Hz* Support for HDMI 2.1 version and HDCP 2.3.** Support native HDMI 2.1 TMDS compatible ports.- 1 x DisplayPort, supporting a maximum resolution of 4096x2304@60 Hz* Support for DisplayPort 1.2 version and HDCP 2.3(Graphics specifications may vary depending on CPU support.)Support for up to triple-display at the same time</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Card đồ họa t&iacute;ch hợp</strong></td>\r\n<td>Integrated Graphics Processor-Intel&reg; HD Graphics support:<br>- 1 x D-Sub port, supporting a maximum resolution of 1920x1200@60 Hz<br>- 1 x HDMI port, supporting a maximum resolution of 4096x2160@60 Hz<br>* Support for HDMI 2.1 version and HDCP 2.3.<br>** Support native HDMI 2.1 TMDS compatible ports.<br>- 1 x DisplayPort, supporting a maximum resolution of 4096x2304@60 Hz<br>* Support for DisplayPort 1.2 version and HDCP 2.3<br>(Graphics specifications may vary depending on CPU support.)<br>Support for up to triple-display at the same time</td>\r\n</tr>\r\n<tr>\r\n<td><strong>&Acirc;m thanh</strong></td>\r\n<td>Realtek&reg; Audio CODEC<br>High Definition Audio2/4/5.1/7.1-channel<br>* You can change the functionality of an audio jack using the audio software. To configure 7.1-channel audio, access the audio software for audio settings.<br>Support for S/PDIF Out</td>\r\n</tr>\r\n<tr>\r\n<td><strong>LAN</strong></td>\r\n<td>Realtek&reg; 2.5GbE LAN chip (2.5 Gbps/1 Gbps/100 Mbps)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Wireless Communication module</strong></td>\r\n<td>Intel&reg; Wireless-AC 9560<br>- WIFI 802.11a, b, g, n, ac, supporting 2.4/5 GHz Dual-Band<br>- BLUETOOTH 5.1<br>- Support for 11ac 160MHz wireless standard<br>(Actual data rate may vary depending on environment and equipment.)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Khe cắm mở rộng</strong></td>\r\n<td>CPU:<br>- 1 x PCI Express x16 slot, supporting PCIe 4.0 and running at x16<br>* The PCIEX16 slot can only support a graphics card or an NVMe SSD.<br>Chipset:<br>-&nbsp;1 x PCI Express x1 slot, supporting PCIe 3.0 and running at x1</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Giao diện lưu trữ</strong></td>\r\n<td>CPU:<br>- 1 x M.2 connector (Socket 3, M key, type 2280 PCIe 4.0 x4/x2 SSD support) (M2A_CPU)<br>Chipset:<br>- 1 x M.2 connector (Socket 3, M key, type 2280 PCIe 4.0 x4/x2 SSD support) (M2P_SB)<br>- 4 x SATA 6Gb/s connectors<br>RAID 0, RAID 1, RAID 5, and RAID 10 support for SATA storage devices</td>\r\n</tr>\r\n<tr>\r\n<td><strong>USB</strong></td>\r\n<td>Chipset:<br>- 1 x USB Type-C&reg; port on the back panel, with USB 3.2 Gen 1 support<br>- 5 x USB 3.2 Gen 1 ports (3 ports on the back panel, 2 ports available through the internal USB header)<br>- 2 x USB 2.0/1.1 ports on the back panel<br>Chipset+USB 2.0 Hub:<br>- 4 x USB 2.0/1.1 ports available through the internal USB headers</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Kết nối I/O b&ecirc;n trong</strong></td>\r\n<td>1 x 24-pin ATX main power connector<br>1 x 8-pin ATX 12V power connector<br>1 x CPU fan header<br>3 x system fan headers<br>2 x addressable LED strip headers<br>1 x RGB LED strip header<br>2 x M.2 Socket 3 connectors<br>4 x SATA 6Gb/s connectors<br>1 x front panel header<br>1 x front panel audio header<br>1 x S/PDIF Out header<br>1 x USB 3.2 Gen 1 header<br>2 x USB 2.0/1.1 headers<br>1 x Trusted Platform Module header (For the GC-TPM2.0 SPI/GC-TPM2.0 SPI 2.0/GC-TPM2.0 SPI V2 module only)<br>1 x serial port header<br>1 x Q-Flash Plus button<br>1 x reset jumper<br>1 x Clear CMOS jumper</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Kết nối bảng ph&iacute;a sau</strong></td>\r\n<td>2 x USB 2.0/1.1 ports<br>1 x PS/2 keyboard/mouse port<br>2 x SMA antenna connectors (1T1R) / (2T2R)<br>1 x D-Sub port<br>1 x HDMI port<br>1 x DisplayPort<br>3 x USB 3.2 Gen 1 ports<br>1 x USB Type-C&reg; port, with USB 3.2 Gen 1 support<br>1 x RJ-45 port<br>3 x audio jacks</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điều khiển I/O</strong></td>\r\n<td>iTE&reg; I/O Controller Chip</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Theo d&otilde;i phần cứng</strong></td>\r\n<td>Voltage detection<br>Temperature detection<br>Fan speed detection<br>Water cooling flow rate detection<br>Fan fail warning<br>Fan speed control<br>* Whether the fan speed control function is supported will depend on the fan you install.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>BIOS</strong></td>\r\n<td>1 x 128 Mbit flash<br>Use of licensed AMI UEFI BIOS<br>PnP 1.0a, DMI 2.7, WfM 2.0, SM BIOS 2.7, ACPI 5.0</td>\r\n</tr>\r\n<tr>\r\n<td><strong>T&iacute;nh năng duy nhất</strong></td>\r\n<td>Support for GIGABYTE Control Center (GCC)<br>* Available applications in GCC may vary by motherboard model. Supported functions of each application may also vary depending on motherboard specifications.<br>Support for Q-Flash<br>Support for Q-Flash Plus</td>\r\n</tr>\r\n<tr>\r\n<td><strong>G&oacute;i phần mềm</strong></td>\r\n<td>Norton&reg; Internet Security (OEM version)<br>LAN bandwidth management software</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Hệ điều h&agrave;nh</strong></td>\r\n<td>Support for Windows 11 64-bit<br>Support for Windows 10 64-bit</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Hệ số khu&ocirc;n</strong></td>\r\n<td>Micro ATX Form Factor; 24.4cm x 22.5cm</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '3690000.00', '3790000.00', 15, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 2, 36, 1, 'images/lOXJkrG9jcQkRTmveUq0OfxgAM0o74qLSLKVO12A.jpg', '2025-09-02 10:51:18', '2025-09-04 03:01:05', NULL, 1, 0),
(39, 'Bộ vi xử lý Intel Core Ultra 9 285K / Turbo up to 5.7GHz / 24 Nhân 24 Luồng / 36MB / LGA 1851', 'WD5699', '<ul>\r\n<li class=\"5\">\r\n<div>Bộ nhớ v&agrave; tốc độ hỗ trợ (MT/s)</div>\r\n<div>DDR5 - 6400</div>\r\n</li>\r\n<li class=\"6\">\r\n<div>Tần số C&ocirc;ng nghệ Intel Turbo Boost Max 3.0</div>\r\n<div>L&ecirc;n tới 5.6 Ghz</div>\r\n</li>\r\n<li class=\"7\">\r\n<div>Bộ nhớ đệm Intel&reg; Smart (L3)</div>\r\n<div>36 MB</div>\r\n</li>\r\n<li class=\"8\">\r\n<div>Điện năng ti&ecirc;u thụ</div>\r\n<div>125W - 250W</div>\r\n</li>\r\n<li class=\"9\">\r\n<div>Tần số Turbo tối đa của P-core</div>\r\n<div>L&ecirc;n tới 5.5 Ghz</div>\r\n</li>\r\n<li class=\"10\">\r\n<div>Tần số Turbo tối đa của E-core</div>\r\n<div>L&ecirc;n tới 4.6 Ghz</div>\r\n</li>\r\n<li class=\"11\">\r\n<div>Tần số Intel Thermal Velocity Boost</div>\r\n<div>L&ecirc;n tới 5.7 Ghz</div>\r\n</li>\r\n<li class=\"12\">\r\n<div>Bộ nhớ hỗ trợ tối đa</div>\r\n<div>DDR5 / 2 k&ecirc;nh / tối đa 192GB</div>\r\n</li>\r\n<li class=\"13\">\r\n<div>Tần số cơ bản của E-core</div>\r\n<div>3.2 GHz</div>\r\n</li>\r\n<li class=\"14\">\r\n<div>Tần số cơ bản của P-core</div>\r\n<div>3.7 GHz</div>\r\n</li>\r\n<li class=\"15\">\r\n<div>Nh&acirc;n đồ họa</div>\r\n<div>Intel Graphic</div>\r\n</li>\r\n<li class=\"16\">\r\n<div>Bảo h&agrave;nh</div>\r\n<div>36 th&aacute;ng</div>\r\n</li>\r\n<li class=\"17\">\r\n<div>Số nh&acirc;n</div>\r\n<div>24 (8 Performance-cores/ 16 Efficient-cores)</div>\r\n</li>\r\n<li class=\"18\">\r\n<div>Số l&agrave;n CPU PCIe</div>\r\n<div>24</div>\r\n</li>\r\n<li class=\"19\">\r\n<div>Số luồng</div>\r\n<div>24</div>\r\n</li>\r\n<li class=\"20\">\r\n<div>Bộ nhớ đệm L2 tổng</div>\r\n<div>40 MB</div>\r\n</li>\r\n<li class=\"21\">\r\n<div>D&ograve;ng CPU</div>\r\n<div>Core Ultra 9</div>\r\n</li>\r\n<li class=\"22\">\r\n<div>Socket</div>\r\n<div>LGA 1851</div>\r\n</li>\r\n</ul>', '17490000.00', '18490000.00', 9, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 12, 36, 1, 'images/0Mfy11i6Xr2wtmuEhoewe2ESgHZOhxTwItrSGQvk.png', '2025-09-02 10:56:58', '2025-09-04 03:01:05', NULL, 1, 0),
(40, 'Bộ vi xử lý Intel Core Ultra 7 265K / Turbo up to 5.5GHz / 20 Nhân 20 Luồng / 30MB / LGA 1851', 'WD1291', NULL, '11790000.00', '12790000.00', 8, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 12, 12, 1, 'images/rH9nPVuyb9bGXWToQPAUqnNzADDOvCZsnpVNkOI5.png', '2025-09-02 12:16:45', '2025-09-02 12:16:45', NULL, 0, 0),
(41, 'Bộ vi xử lý Intel Core i3 12100F / 3.3GHz Turbo 4.3GHz / 4 Nhân 8 Luồng / 12MB / LGA 1700 (TRAY)', 'WD7742', '<h2><strong>Th&ocirc;ng số sản phẩm :</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Model</strong></td>\r\n<td>Bộ vi xử l&yacute; Intel Core i3 gen 12th</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Số hiệu xử l&iacute;</strong></td>\r\n<td>i3-12100F</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Số nh&acirc;n</strong></td>\r\n<td>4</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Số luồng</strong></td>\r\n<td>8</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tần số turbo tối đa</strong></td>\r\n<td>4.30 GHz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tần số turbo tối đa của l&otilde;i hiệu suất</strong></td>\r\n<td>4.30 GHz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tần số cơ bản của l&otilde;i hiệu suất</strong></td>\r\n<td>3.30 GHz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bộ nhớ đệm</strong></td>\r\n<td>12 MB Intel Smart Cache</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Total L2 cache</strong></td>\r\n<td>5 MB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>C&ocirc;ng suất cơ bản</strong></td>\r\n<td>58 W</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>C&ocirc;ng suất tối đa</strong></td>\r\n<td>89 W</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>C&aacute;c loại bộ nhớ</strong></td>\r\n<td>Up to&nbsp;<a href=\"https://gearvn.com/collections/ram-pc-ddr5\">DDR5</a>&nbsp;4800 MT/s<br>Up to&nbsp;<a href=\"https://gearvn.com/collections/ddr4-8gb\">DDR4</a>&nbsp;3200 MT/s</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Dung lượng tối đa</strong></td>\r\n<td>128 GB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bộ nhớ đa k&ecirc;nh</strong></td>\r\n<td>2</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Băng th&ocirc;ng tối đa</strong></td>\r\n<td>76.8 GB/s</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Phi&ecirc;n bản PCI Express</strong></td>\r\n<td>5.0 v&agrave; 4.0</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Cấu h&igrave;nh PCI Express</strong></td>\r\n<td>Up to 1x16+4, 2x8+4</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Số cổng PCI Express tối đa</strong></td>\r\n<td>20</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Hỗ trợ socket</strong></td>\r\n<td>FCLGA1700</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Cấu h&igrave;nh CPU tối đa</strong></td>\r\n<td>1</td>\r\n</tr>\r\n<tr>\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>45.0 mm x 37.5 mm</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '1790000.00', '2990000.00', 17, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 12, 12, 1, 'images/tWhPrt4CIHQopGVfMgDEA8AyAQGdf8sIff6cCytB.png', '2025-09-02 12:17:56', '2025-09-02 12:19:08', NULL, 0, 0),
(42, 'Bộ vi xử lý AMD Ryzen 7 9800X3D / 4.7GHz Boost 5.2GHz / 8 nhân 16 luồng / 104MB / AM5', 'WD3699', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Số nh&acirc;n (Cores)</strong></td>\r\n<td>8</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Số luồng (Threads)</strong></td>\r\n<td>16</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label\"><strong>Tốc độ xử l&yacute;</strong></p>\r\n</td>\r\n<td>Xung cơ bản 4.7GHz, xung tối đa 5.2GHz</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bộ nhớ đệm L1</strong></td>\r\n<td>640 KB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label\"><strong>Bộ nhớ đệm L2</strong></p>\r\n</td>\r\n<td>8 MB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label\"><strong>Bộ nhớ đệm L3</strong></p>\r\n</td>\r\n<td>96 MB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>C&ocirc;ng nghệ xử l&yacute; cho l&otilde;i CPU</strong></td>\r\n<td>TSMC 4nm FinFET</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Socket</strong></td>\r\n<td>AM5</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label data-spec-footnote-ROM-06a\"><strong>Phi&ecirc;n bản PCI Express&nbsp;</strong></p>\r\n</td>\r\n<td>PCIe&reg; 5.0</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label\"><strong>Giải ph&aacute;p tản nhiệt&nbsp;(PIB)</strong></p>\r\n</td>\r\n<td>\r\n<p class=\"field field--name-field-thermal-solution field--type-string field--label-inline\">&nbsp;</p>\r\n<p class=\"field__item\">Kh&ocirc;ng c&oacute; sẵn</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label data-spec-footnote-ROM-06a\"><strong>Điện năng ti&ecirc;u thụ&nbsp;mặc định</strong></p>\r\n</td>\r\n<td>120 W</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label data-spec-footnote-ROM-06a\"><strong>Bộ nhớ hỗ trợ</strong></p>\r\n</td>\r\n<td><strong>Loại:</strong>&nbsp;DDR5<br><strong>K&ecirc;nh:</strong>&nbsp;2<br><strong>Tốc độ bộ nhớ tối đa:&nbsp;</strong>\r\n<ul>\r\n<li>2x1R DDR5-5600</li>\r\n<li>2x2R DDR5-5600</li>\r\n<li>4x1R DDR5-3600</li>\r\n<li>4x2R DDR5-3600</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label\"><strong>T&iacute;nh năng đồ họa</strong></p>\r\n</td>\r\n<td><strong>Graphics Model:</strong>&nbsp;AMD Radeon&trade; Graphics<br><strong>Graphics Core Count:&nbsp;</strong>2<br><strong>Graphics Frequency:</strong>&nbsp;2200 MHz<br><strong>GPU Base:&nbsp;</strong>400 MHz</td>\r\n</tr>\r\n<tr>\r\n<td><strong>C&ocirc;ng nghệ hỗ trợ</strong></td>\r\n<td>AMD EXPO&trade; Technology<br>AMD Ryzen&trade; Technologies</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '14990000.00', '15990000.00', 8, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 13, 12, 1, 'images/OiIkl8OaEMpBxO12rA9t1sSodBz3E8ShipGbER8Y.jpg', '2025-09-02 12:22:28', '2025-09-04 00:44:42', NULL, 0, 0),
(43, 'Bộ vi xử lý AMD Ryzen 5 8400F / 4.2GHz Boost 4.7GHz / 6 nhân 12 luồng / 22MB / AM5 (TRAY)', 'WD2588', '<p>sgsgfs</p>', '4290000.00', '4990000.00', 15, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 13, NULL, 1, 'images/7zcHCFSVSebOlLBqxBlK9nRCIETZVbxC0P7hsBk8.png', '2025-09-02 13:00:15', '2025-09-02 13:01:26', NULL, 0, 0),
(44, 'Bộ vi xử lý AMD Ryzen 5 5500GT / 3.6GHz Boost 4.4GHz / 6 nhân 12 luồng / 19MB / AM4', 'WD9509', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Kiến tr&uacute;c</strong></td>\r\n<td>\"Zen 3\"</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Số nh&acirc;n (Cores)</strong></td>\r\n<td>6</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Số luồng (Threads)</strong></td>\r\n<td>12</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label\"><strong>Tốc độ xử l&yacute;</strong></p>\r\n</td>\r\n<td>3.6GHz Up to 4.4GHz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label\"><strong>Bộ nhớ đệm L2</strong></p>\r\n</td>\r\n<td>3MB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label\"><strong>Bộ nhớ đệm L3</strong></p>\r\n</td>\r\n<td>16MB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>C&ocirc;ng nghệ xử l&yacute; cho l&otilde;i CPU</strong></td>\r\n<td>TSMC 7nm FinFET</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Socket</strong></td>\r\n<td>AM4</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label data-spec-footnote-ROM-06a\"><strong>Phi&ecirc;n bản PCI Express&nbsp;</strong></p>\r\n</td>\r\n<td>PCIe&reg; 3.0</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label\"><strong>Giải ph&aacute;p tản nhiệt&nbsp;(PIB)</strong></p>\r\n</td>\r\n<td>AMD Wraith Stealth</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label data-spec-footnote-ROM-06a\"><strong>Điện năng ti&ecirc;u thụ&nbsp;mặc định</strong></p>\r\n</td>\r\n<td>65W</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p class=\"field__label data-spec-footnote-ROM-06a\"><strong>Bộ nhớ hỗ trợ</strong></p>\r\n</td>\r\n<td><strong>Loại:</strong>&nbsp;DDR4 - Tối đa 128GB<br><strong>K&ecirc;nh:</strong>&nbsp;2<br><strong>Tốc độ bộ nhớ tối đa:&nbsp;</strong>\r\n<ul>\r\n<li>2x1R DDR4-3200</li>\r\n<li>2x2R DDR4-3200</li>\r\n<li>4x1R DDR4-2933</li>\r\n<li>4x2R DDR4-2667</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>T&iacute;nh năng đồ họa</strong></td>\r\n<td><strong>Graphics Model:</strong>&nbsp;Radeon&trade; Graphics<br><strong>Graphics Core Count:</strong>&nbsp;7<br><strong>Graphics Frequency:</strong> 1900MHz</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '3090000.00', '4090000.00', 9, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 13, NULL, 1, 'images/X5uX9GwkJEUNk5DNCIo15LnefKyu42tos9QR06DG.png', '2025-09-02 13:02:52', '2025-09-02 13:02:52', NULL, 0, 0);
INSERT INTO `san_phams` (`id`, `ten`, `ma_san_pham`, `mo_ta`, `gia`, `gia_so_sanh`, `so_luong`, `sku`, `co_bien_the`, `id_chip`, `id_mainboard`, `id_gpu`, `id_tannhiet`, `id_case`, `id_nguon`, `id_category`, `id_brand`, `bao_hanh_thang`, `hoat_dong`, `anh_dai_dien`, `created_at`, `updated_at`, `deleted_at`, `luot_mua`, `luot_xem`) VALUES
(45, 'Vỏ máy tính Cooler Master MasterBox 520 Mesh ARGB Black', 'WD6940', '<h2><strong>Th&ocirc;ng số kỹ thuật :&nbsp;</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr>\r\n<td>Series</td>\r\n<td>MasterBox Series</td>\r\n</tr>\r\n<tr>\r\n<td>Size</td>\r\n<td>Mid Tower</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Số model</td>\r\n<td>MB520-KGNN-S00</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>M&agrave;u sắc</td>\r\n<td>Đen</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Chất liệu</td>\r\n<td>Th&eacute;p, nhựa, k&iacute;nh cường lực</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>K&iacute;ch thước&nbsp;(D X R X C)</td>\r\n<td>502 x 210 x 498 mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Bo mạch chủ hổ trợ</td>\r\n<td>Mini ITX, Micro ATX, ATX, SSI CEB, E-ATX*, (*up to 12\" x 10.7\" motherboards, may impact cable management feature)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Khe mở rộng</td>\r\n<td>7</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Ổ cứng 5.25\"</td>\r\n<td>N/A</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Ổ cứng 2.5\" / 3.5\" (combo)</td>\r\n<td>2 (Tối đa 2)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Ổ cứng 2.5\"</td>\r\n<td>3 (Tối đa.5)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Bảng điều khiển I/O</td>\r\n<td>1x USB 3.2 Gen 1 Type-A<br>1x USB 3.2 Gen 2 Type-C<br>1x 3.5mm Jack tai nghe (Audio+Mic)<br>1x Reset/ARGB button</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Quạt được lắp sẵn - trước</td>\r\n<td>3x CF120 ARGB&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Quạt được lắp sẵn - sau</td>\r\n<td>N/A</td>\r\n</tr>\r\n<tr>\r\n<td>Quạt hổ trợ - tr&ecirc;n</td>\r\n<td>3x 120mm, 2x 140mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Quạt hổ trợ - trước</td>\r\n<td>3x 120mm, 2x 140mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Quạt hổ trợ - sau</td>\r\n<td>1x 120mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>K&eacute;t nước hổ trợ - tr&ecirc;n</td>\r\n<td>120mm, 140mm, 240mm, 280mm, 360mm, (recommended maximum thickness -55mm)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>K&eacute;t nước hổ trợ - trước</td>\r\n<td>120mm, 140mm, 240mm, 280mm, 360mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>K&eacute;t nước hổ trợ - sau</td>\r\n<td>120mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Chiều d&agrave;i - Tản nhiệt kh&iacute; CPU</td>\r\n<td>165mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Chiều d&agrave;i - Nguồn m&aacute;y t&iacute;nh</td>\r\n<td>200mm, (Recommended up to 170mm)</td>\r\n</tr>\r\n<tr>\r\n<td>Kh&ocirc;ng gian lắp đặt GPU</td>\r\n<td>410mm/16.1\"</td>\r\n</tr>\r\n<tr>\r\n<td>Tấm lọc bụi</td>\r\n<td>Dưới, Trước, Tr&ecirc;n</td>\r\n</tr>\r\n<tr>\r\n<td>Nguồn m&aacute;y t&iacute;nh hổ trợ</td>\r\n<td>&nbsp;ATX</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '1390000.00', '2290000.00', 14, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 14, 12, 1, 'images/xKz74renPnsmsdlSWZqgGaJgbczDT09magvSX14l.png', '2025-09-02 13:05:48', '2025-09-10 13:33:59', NULL, 1, 1),
(46, 'Vỏ máy tính Cooler Master CD600 Black', 'WD5077', '<p><strong>Th&ocirc;ng số kỹ thuật:</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Chất liệu</strong></td>\r\n<td>Th&eacute;p, nhựa, k&iacute;nh cường lực</td>\r\n</tr>\r\n<tr>\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>Mid Tower</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>M&agrave;u sắc</strong></td>\r\n<td>Đen</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước&nbsp;</strong></td>\r\n<td>415mm(L) x 295mm(W) x 368mm(H)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Volume</strong></td>\r\n<td>45L</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Trọng lượng</strong></td>\r\n<td>11.3 kg</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Hỗ trợ mainboard</strong></td>\r\n<td>ITX/ M-ATX/ ATX(kh&ocirc;ng gắn k&eacute;t tản nhiệt ph&iacute;a dưới)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Khe mở rộng</strong></td>\r\n<td>6</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Khe ổ cứng 5.25\" ODD</strong></td>\r\n<td>N/A</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Khe ổ cứng 3.5\" HDD</strong></td>\r\n<td>2</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Khe ổ cứng 2,5\" SSD</strong></td>\r\n<td>2</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Cổng I / O</strong></td>\r\n<td>2 x USB 3.2 Gen1<br>1 x USB 3.2 Gen2<br>1 x Jack tai nghe 3,5mm (Audio + Mic)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Quạt được c&agrave;i đặt sẵn</strong></td>\r\n<td>Trước:&nbsp;N/A<br>Sau:&nbsp;Quạt&nbsp; ARGB 1 x 120mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Quạt hỗ trợ</strong></td>\r\n<td>B&ecirc;n cạnh bo mạch chủ:&nbsp;2 x 120mm<br>Tr&ecirc;n:&nbsp;3 x 120mm/ 2 x 140mm<br>Dưới:&nbsp;3 x 120mm/ 2 x 140mm<br>Sau:&nbsp;1 x 120mm/ 1 x 140mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>K&eacute;t nước hỗ trợ&nbsp;</strong></td>\r\n<td>B&ecirc;n cạnh bo mạch chủ:&nbsp;240mm<br>Tr&ecirc;n:&nbsp;240mm / 280mm / 360mm<br>Dưới:&nbsp;240mm / 280mm / 360mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Chiều cao - tản nhiệt kh&iacute; CPU</strong></td>\r\n<td>175mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Chiều d&agrave;i - PSU nguồn n&aacute;y t&iacute;nh</strong></td>\r\n<td>200mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Hỗ trợ GPU</strong></td>\r\n<td>400mm&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bộ lọc bụi</strong></td>\r\n<td>Tr&ecirc;n c&ugrave;ng, dưới c&ugrave;ng</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Nguồn m&aacute;y t&iacute;nh hỗ trợ</strong></td>\r\n<td>SFX / SFX-L / ATX</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '1390000.00', '1990000.00', 13, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 14, 12, 1, 'images/mjrAlHudxaQpKwp0wnOqPQbArbQ0W4EjVMifmgYx.png', '2025-09-02 13:09:51', '2025-09-02 13:09:51', NULL, 0, 0),
(47, 'Vỏ máy tính Corsair FRAME 4000D Modular Mid-Tower White (CC-9011291-WW)', 'WD5863', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Case Supported</strong></td>\r\n<td>Mini-ITX, Micro-ATX, ATX, E-ATX (305mm x 277mm)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Case Height</strong></td>\r\n<td>486</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Case Length</strong></td>\r\n<td>490</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Case Length</strong></td>\r\n<td>239</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Material</strong></td>\r\n<td>Steel, Tempered Glass, 3D-Y Airflow Steel, Plastic</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Case Width</strong></td>\r\n<td>Mini-ITX, Micro-ATX, ATX, E-ATX (305mm x 277mm)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Color</strong></td>\r\n<td>WHITE</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Material</strong></td>\r\n<td>Mid-Tower</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Radiator Compatibility</strong></td>\r\n<td>120mm, 140mm, 240mm, 280mm, 360mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Compatible Liquid Coolers</strong></td>\r\n<td>H60, H100, H115, H150, NAUTILUS, TITAN</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Motherboard Support</strong></td>\r\n<td>2 Year</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Internal 3.5\" Drive Bays</strong></td>\r\n<td>2</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Internal 2.5\" Drive Bays</strong></td>\r\n<td>4</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Maximum CPU Cooler Height</strong></td>\r\n<td>170mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Maximum PSU Length</strong></td>\r\n<td>220mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Case Front IO</strong></td>\r\n<td>(1x) USB 3.2 Gen 2 Type-C, (2x) USB 3.2 Gen 1 Type-A, (1x) Audio in/out</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Maximum GPU Length</strong></td>\r\n<td>430mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Weight</strong></td>\r\n<td>10.03kg</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Case Expansion Slots</strong></td>\r\n<td>7 Horizontal or 3 Vertical</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Case Power Supply</strong></td>\r\n<td>ATX</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Radiator Support - Top</strong></td>\r\n<td>360mm, 280mm, 240mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Radiator Support - Front</strong></td>\r\n<td>360mm, 280mm, 240mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Radiator Support - Bottom</strong></td>\r\n<td>None</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Radiator Support - Side</strong></td>\r\n<td>360mm, 280mm, 240mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Radiator Support - Rear</strong></td>\r\n<td>140mm, 120mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Fan Support - Top</strong></td>\r\n<td>3x 120mm, 2x 140mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Fan Support - Front</strong></td>\r\n<td>3x 120mm, 2x 140mm, 2x 200mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Fan Support - Bottom</strong></td>\r\n<td>2x 120mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Fan Support - Side</strong></td>\r\n<td>3x 120mm, 2x 140mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Fan Support - Rear</strong></td>\r\n<td>1x 120mm, 1x 140mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Front IO Motherboard Connections</strong></td>\r\n<td>1x HD Audio; 1x USB 3.2 Gen1; 1x USB-3.2 Gen2 Type-E; 1x F_PANEL</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Reverse Connector Motherboard Support</strong></td>\r\n<td>Yes</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Included Fans</strong></td>\r\n<td>No Fans Included</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Dust Filtration</strong></td>\r\n<td>Yes</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Cable Routing Space</strong></td>\r\n<td>37mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>RapidRoute Included</strong></td>\r\n<td>No</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Left Side Panel</strong></td>\r\n<td>Tempered Glass</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Right Side Panel</strong></td>\r\n<td>Supported (Riser Card Sold Separately)</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '1990000.00', '2250000.00', 15, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 14, NULL, 1, 'images/lCXG8YLInCn0HuZp1encRNWE24ezxuDNixhDrSqA.png', '2025-09-02 13:11:32', '2025-09-02 13:11:32', NULL, 0, 0),
(48, 'Nguồn máy tính Cooler Master MWE GOLD 1050W V2 ATX3.1 - 80 Plus Gold - Full Modular', 'WD7279', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>H&atilde;ng sản xuất</strong></td>\r\n<td>Cooler Master</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Model</strong></td>\r\n<td>MPE-A501-AFCAG-3</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Phi&ecirc;n bản</strong></td>\r\n<td>ATX Rev. 3.0</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Series</strong></td>\r\n<td>MWE Gold Series</td>\r\n</tr>\r\n<tr>\r\n<td><strong>PFC</strong></td>\r\n<td>Active PFC</td>\r\n</tr>\r\n<tr>\r\n<td><strong>C&ocirc;ng suất</strong></td>\r\n<td>1050W</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Điện &aacute;p đầu v&agrave;o</strong></td>\r\n<td>100-240V</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>D&ograve;ng điện đầu v&agrave;o</strong></td>\r\n<td>13-6A</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tần số đầu v&agrave;o</strong></td>\r\n<td>50-60Hz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước (D&nbsp;x R&nbsp;x C)</strong></td>\r\n<td>180 x 150 x 86 mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước quạt</strong></td>\r\n<td>140mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>V&ograve;ng bi quạt</strong></td>\r\n<td>FDB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chuẩn</strong></td>\r\n<td>90% @ Typical Load</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chuẩn 80 plus</strong></td>\r\n<td>80 PLUS Gold</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>ERP 2014 LOT 3</strong></td>\r\n<td>C&oacute;</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Nhiệt độ hoạt động</strong></td>\r\n<td>0-50&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td><strong>T&iacute;n hiệu tốt</strong></td>\r\n<td>100 - 150 ms</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Thời gian chờ</strong></td>\r\n<td>&ge;16ms at 100% Load</td>\r\n</tr>\r\n<tr>\r\n<td><strong>MTBF</strong></td>\r\n<td>&gt;100,000 giờ</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảo vệ</strong></td>\r\n<td>OVP, OPP, SCP, OCP, UVP, OTP, Inrush Protection</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Kết nối</strong></td>\r\n<td>Đầu kết nối ATX 24 Pin x1, Đầu nối 4 + 4 pin EPS x1, Đầu nối 8 pin EPS x1, Kết nối SATA x12, Đầu nối 4 Pin ngoại vi x4, Đầu kết nối PCI-e 6+2 Pin x3, 12VHPWR Connector x1,&nbsp;&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '4490000.00', '4990000.00', 17, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 14, 12, 1, 'images/oR6Hg85aRogSM9YYKV3p290aijRDkHEAbBi0t1sS.jpg', '2025-09-02 13:15:10', '2025-09-04 03:01:25', NULL, 2, 1),
(49, 'Nguồn máy tính Cooler Master MWE GOLD 1250W V2 ATX3.1 - 80 Plus Gold - Full Modular', 'WD6332', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>H&atilde;ng sản xuất</strong></td>\r\n<td>Cooler Master</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Model</strong></td>\r\n<td>MPE-C501-AFCAG-3</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Phi&ecirc;n bản</strong></td>\r\n<td>ATX 12V V3.0</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Series</strong></td>\r\n<td>MWE Gold Series</td>\r\n</tr>\r\n<tr>\r\n<td><strong>PFC</strong></td>\r\n<td>Active PFC</td>\r\n</tr>\r\n<tr>\r\n<td><strong>C&ocirc;ng suất</strong></td>\r\n<td>1250W</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Điện &aacute;p đầu v&agrave;o</strong></td>\r\n<td>100-2040V</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>D&ograve;ng điện đầu v&agrave;o</strong></td>\r\n<td>15-7A</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tần số đầu v&agrave;o</strong></td>\r\n<td>50-60Hz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước (D&nbsp;x R&nbsp;x C)</strong></td>\r\n<td>180 x 150 x 86 mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước quạt</strong></td>\r\n<td>140mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>V&ograve;ng bi quạt</strong></td>\r\n<td>FDB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tốc độ quạt</strong></td>\r\n<td>2200 RPM</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ ồn @ 20%</strong></td>\r\n<td>0 dBA</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ ồn @ 50%</strong></td>\r\n<td>15,8 dBA</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ ồn @ 100%</strong></td>\r\n<td>30,1 dBA</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chuẩn</strong></td>\r\n<td>90% @ Typical Load</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chuẩn 80 plus</strong></td>\r\n<td>80 PLUS Gold</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>ERP 2014 LOT 3</strong></td>\r\n<td>C&oacute;</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Nhiệt độ hoạt động</strong></td>\r\n<td>0-50&deg;C</td>\r\n</tr>\r\n<tr>\r\n<td><strong>T&iacute;n hiệu tốt</strong></td>\r\n<td>100 - 150 ms</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Thời gian chờ</strong></td>\r\n<td>&ge;16ms at 100% Load</td>\r\n</tr>\r\n<tr>\r\n<td><strong>MTBF</strong></td>\r\n<td>&gt;100,000 giờ</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảo vệ</strong></td>\r\n<td>OVP, OPP, SCP, OCP, UVP, OTP, Inrush Protection</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Kết nối</strong></td>\r\n<td>Fan 14cm, 1 đường 12v 104A, (4+4pin) x 1, 8pin x 1 CPU, 12 sata, 4 x ATA, 3x PCI Express&nbsp; 6+2 pin, 1x&nbsp; 12VHPWR Connector&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '5490000.00', '5990000.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 14, 12, 1, 'images/oJ0YaWq7pFTimf97VpqxbyKOzraN00u9XyWt6NDq.png', '2025-09-02 13:17:05', '2025-09-10 13:29:50', NULL, 0, 1),
(50, 'Nguồn máy tính MSI MEG AI1600T PCIE5 - 80 Plus Titanium (1600W)', 'WD8243', '<h2>Bộ nguồn MSI MEG Ai1600T PCIE5</h2>\r\n<p>Bộ nguồn MSI MEG Ai1600T PCIE5 được thiết kế để đ&aacute;p ứng nhu cầu của c&aacute;c hệ thống m&aacute;y t&iacute;nh hiệu suất cao, đặc biệt hỗ trợ c&aacute;c card đồ họa Nvidia&reg; GeForce RTX&trade; 50 Series. Với c&ocirc;ng suất mạnh mẽ v&agrave; c&aacute;c t&iacute;nh năng ti&ecirc;n tiến, sản phẩm n&agrave;y đảm bảo cung cấp năng lượng ổn định v&agrave; hiệu quả cho hệ thống của bạn.​</p>\r\n<h3>Th&ocirc;ng số kỹ thuật</h3>\r\n<div class=\"scroll-table\">\r\n<table border=\"2\">\r\n<thead>\r\n<tr>\r\n<th>Th&ocirc;ng số</th>\r\n<th>Chi tiết</th>\r\n</tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td><strong>C&ocirc;ng suất</strong></td>\r\n<td>1600W</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Hiệu suất</strong></td>\r\n<td>80 PLUS Titanium (l&ecirc;n đến 94%)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Thiết kế d&acirc;y c&aacute;p</strong></td>\r\n<td>Fully Modular</td>\r\n</tr>\r\n<tr>\r\n<td><strong>K&iacute;ch thước quạt</strong></td>\r\n<td>135 mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Loại v&ograve;ng bi quạt</strong></td>\r\n<td>Double Ball Bearing</td>\r\n</tr>\r\n<tr>\r\n<td><strong>K&iacute;ch thước (DxRxC)</strong></td>\r\n<td>190 x 150 x 86 mm</td>\r\n</tr>\r\n<tr>\r\n<td><strong>PFC Type</strong></td>\r\n<td>Interleaved PFC</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Dải điện &aacute;p đầu v&agrave;o</strong></td>\r\n<td>100-240V</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tần số đầu v&agrave;o</strong></td>\r\n<td>50~60 Hz</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảo vệ</strong></td>\r\n<td>OCP / OTP / OPP / SCP / OVP / UVP / SIP / NLO</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Đầu nối ATX (24 pin)</strong></td>\r\n<td>1</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Đầu nối EPS (4+4 pin)</strong></td>\r\n<td>2</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Đầu nối PCI-E 5.1 (16 pin)</strong></td>\r\n<td>2 (600W)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Đầu nối PCI-E (6+2 pin)</strong></td>\r\n<td>9</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Đầu nối SATA (15 pin)</strong></td>\r\n<td>8</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Đầu nối Peripheral (4 pin)</strong></td>\r\n<td>8</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<h3>T&iacute;nh năng nổi bật</h3>\r\n<ul>\r\n<li>\r\n<p><strong>Hỗ trợ card đồ họa Nvidia&reg; GeForce RTX&trade; 50 Series</strong>: Đảm bảo khả năng cung cấp điện năng ổn định cho c&aacute;c GPU thế hệ mới nhất.​</p>\r\n</li>\r\n<li>\r\n<p><strong>Đầu nối 12V-2x6 k&eacute;p</strong>: Cung cấp khả năng kết nối linh hoạt v&agrave; đ&aacute;p ứng nhu cầu năng lượng cao của hệ thống.​</p>\r\n</li>\r\n<li>\r\n<p><strong>Chứng nhận Titanium</strong>: Với hiệu suất l&ecirc;n đến 94%, gi&uacute;p giảm thiểu l&atilde;ng ph&iacute; năng lượng v&agrave; tối ưu h&oacute;a hiệu quả hoạt động.​</p>\r\n</li>\r\n<li>\r\n<p><strong>Thiết kế kỹ thuật số ho&agrave;n to&agrave;n</strong>: Sử dụng MCU để kiểm so&aacute;t PFC, LLC v&agrave; bảo vệ, tăng cường độ ch&iacute;nh x&aacute;c v&agrave; ổn định.​</p>\r\n</li>\r\n<li>\r\n<p><strong>Tụ điện Nhật Bản 105&deg;C</strong>: Đảm bảo chất lượng v&agrave; độ bền cao, cung cấp hiệu suất ổn định trong thời gian d&agrave;i.​</p>\r\n</li>\r\n<li>\r\n<p><strong>Hệ thống bảo vệ c&ocirc;ng nghiệp</strong>: Bao gồm OCP, OTP, OPP, SCP, OVP, UVP, SIP v&agrave; NLO, bảo vệ to&agrave;n diện cho hệ thống của bạn.​</p>\r\n</li>\r\n</ul>\r\n<p>Bộ nguồn MSI MEG Ai1600T PCIE5 l&agrave; lựa chọn l&yacute; tưởng cho những ai t&igrave;m kiếm một bộ nguồn mạnh mẽ, hiệu suất cao v&agrave; đ&aacute;ng tin cậy cho hệ thống m&aacute;y t&iacute;nh của m&igrave;nh.​</p>', '13990000.00', '14990000.00', 8, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 3, 12, 1, 'images/3W9dnfXA1gSjpsGdk7RT0a5sciGBHHj3CNQEhl2V.png', '2025-09-02 13:18:36', '2025-09-02 14:13:03', NULL, 0, 2),
(51, 'Nguồn máy tính Cooler Master MWE 650 - 80 Plus Bronze - V3 230V (650W)', 'WD2531', NULL, '1390000.00', '1400000.00', 18, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 14, 12, 1, 'images/X571xQexikJ1l4acefdJ40OjLbnFgVXIvYlDTwy4.png', '2025-09-02 13:20:48', '2025-09-15 02:28:41', NULL, 0, 3),
(52, 'PC GVN Intel i7-14700F/ VGA RTX 3050', 'WD4511', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong><strong>:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/bo-mach-chu-msi-z790-gaming-plus-wifi-ddr5\">Bo mạch chủ MSI Z790 GAMING PLUS WIFI DDR5</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/bo-vi-xu-ly-intel-core-i7-14700f\">Bộ vi xử l&yacute; Intel Core i7 14700F/Turbo up to 5.4GHz/20 Nh&acirc;n 28 Luồng</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/ram-pc\">RAM</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/ram-corsair-vengeance-rgb-32gb-2x16gb-5600-ddr5-cmh32gx5m2b5600c40k\">Ram Corsair Vengeance RGB 32GB 5600 DDR5</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/vga-card-man-hinh\">VGA</a>&nbsp;</strong></td>\r\n<td><a href=\"https://gearvn.com/products/card-man-hinh-gigabyte-geforce-rtx-3050-windforce-oc-6g\">Card m&agrave;n h&igrave;nh GIGABYTE GeForce RTX 3050 WINDFORCE OC 6G</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>HDD</strong></td>\r\n<td>C&oacute; thể t&ugrave;y chọn&nbsp;<a title=\"https://gearvn.com/collections/hdd-o-cung-pc\" href=\"https://gearvn.com/collections/hdd-o-cung-pc\">N&acirc;ng cấp</a></td>\r\n<td><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/o-cung-ssd-kingston-nv3-500gb-m-2-pcie-nvme-gen4\">Ổ cứng SSD Kingston NV3 500GB M.2 PCIe NVMe Gen4 (Đọc/Ghi - 5000/3000)</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/650w-nguon-fsp-hv-pro-650w-80-plus-bronze\">Nguồn FSP HV PRO 650W - 80 Plus Bronze ch&iacute;nh h&atilde;ng</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/case-thung-may-tinh\">Case</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/vo-may-tinh-cooler-master-cd600-black\">Vỏ m&aacute;y t&iacute;nh Cooler Master CD600 Black</a></td>\r\n<td><strong>12 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tản nhiệt</strong></td>\r\n<td><a href=\"https://gearvn.com/products/tan-nhiet-aio-cooler-master-masterliquid-360-core-si-argb\">Tản nhiệt AIO Cooler Master MasterLiquid 360 Core SI ARGB</a></td>\r\n<td><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 3, 3, 4, 4, 4, 1, 3, 2, 36, 1, 'images/nmT2xXfJpcuyGid8CN3HC4BqvAiRWzdQW0oIFphR.jpg', '2025-09-03 03:09:06', '2025-09-04 01:06:59', NULL, 0, 0),
(53, 'PC GVN Intel i7-14700F/ VGA RTX 4060', 'WD6443', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong><strong>:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/bo-mach-chu-msi-z790-gaming-plus-wifi-ddr5\">Bo mạch chủ MSI Z790 GAMING PLUS WIFI DDR5</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/bo-vi-xu-ly-intel-core-i7-14700f\">Bộ vi xử l&yacute; Intel Core i7 14700F/Turbo up to 5.4GHz/20 Nh&acirc;n 28 Luồng</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/ram-pc\">RAM</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/ram-corsair-vengeance-rgb-32gb-2x16gb-5600-ddr5-cmh32gx5m2b5600c40k\">Ram Corsair Vengeance RGB 32GB 5600 DDR5</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/vga-card-man-hinh\">VGA</a>&nbsp;</strong></td>\r\n<td><a href=\"https://gearvn.com/products/card-man-hinh-gigabyte-geforce-rtx-4060-windforce-oc-8g\">Card m&agrave;n h&igrave;nh GIGABYTE GeForce RTX 4060 WINDFORCE OC 8G</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>HDD</strong></td>\r\n<td>C&oacute; thể t&ugrave;y chọn&nbsp;<a title=\"https://gearvn.com/collections/hdd-o-cung-pc\" href=\"https://gearvn.com/collections/hdd-o-cung-pc\">N&acirc;ng cấp</a></td>\r\n<td><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/o-cung-ssd-kingston-nv3-500gb-m-2-pcie-nvme-gen4\">Ổ cứng SSD Kingston NV3 500GB M.2 PCIe NVMe Gen4 (Đọc/Ghi - 5000/3000)</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/650w-nguon-fsp-hv-pro-650w-80-plus-bronze\">Nguồn FSP HV PRO 650W - 80 Plus Bronze</a></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/case-thung-may-tinh\">Case</a></strong></td>\r\n<td><a href=\"https://gearvn.com/products/vo-may-tinh-cooler-master-cd600-black\">Vỏ m&aacute;y t&iacute;nh Cooler Master CD600 Black</a></td>\r\n<td><strong>12 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tản nhiệt</strong></td>\r\n<td><a href=\"https://gearvn.com/products/tan-nhiet-aio-cooler-master-masterliquid-360-core-si-argb\">Tản nhiệt AIO Cooler Master MasterLiquid 360 Core SI ARGB</a></td>\r\n<td><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 3, 3, 6, 3, 4, 1, 1, 2, 36, 1, 'images/GOBnK7AduwPHPDBdnybFuYVp85OqTClVbRigOfSI.jpg', '2025-09-03 03:16:15', '2025-09-17 01:33:07', NULL, 1, 1),
(54, 'PC GVN Intel i7-14700F/ VGA RTX 5060Ti', 'WD1918', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong><strong>:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/bo-mach-chu-msi-z790-gaming-plus-wifi-ddr5\">Bo mạch chủ MSI Z790 GAMING PLUS WIFI DDR5</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/bo-vi-xu-ly-intel-core-i7-14700f\">Bộ vi xử l&yacute; Intel Core i7 14700F/Turbo up to 5.4GHz/20 Nh&acirc;n 28 Luồng</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/ram-pc\">RAM</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/ram-corsair-vengeance-rgb-32gb-2x16gb-5600-ddr5-cmh32gx5m2b5600c40k\">Ram Corsair Vengeance RGB 32GB 5600 DDR5</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/vga-card-man-hinh\">VGA</a>&nbsp;</strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/card-man-hinh-gigabyte-geforce-rtx-5060-ti-windforce-oc-8gb\">Card m&agrave;n h&igrave;nh Gigabyte GeForce RTX 5060 Ti Windforce OC 8GB</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>HDD</strong></td>\r\n<td><strong>C&oacute; thể t&ugrave;y chọn&nbsp;<a title=\"https://gearvn.com/collections/hdd-o-cung-pc\" href=\"https://gearvn.com/collections/hdd-o-cung-pc\">N&acirc;ng cấp</a></strong></td>\r\n<td><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/o-cung-ssd-kingston-nv3-500gb-m-2-pcie-nvme-gen4\">Ổ cứng SSD Kingston NV3 500GB M.2 PCIe NVMe Gen4 (Đọc/Ghi - 5000/3000)</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/nguon-may-tinh-cooler-master-mwe-750-80-plus-bronze-v3-230v-750w\">Nguồn m&aacute;y t&iacute;nh Cooler Master MWE 750 - 80 Plus Bronze - V3 230V (750W)</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/case-thung-may-tinh\">Case</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/vo-may-tinh-cooler-master-cd600-black\">Vỏ m&aacute;y t&iacute;nh Cooler Master CD600 Black</a></strong></td>\r\n<td><strong>12 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tản nhiệt</strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/tan-nhiet-aio-cooler-master-masterliquid-360-core-si-argb\">Tản nhiệt AIO Cooler Master MasterLiquid 360 Core SI ARGB</a></strong></td>\r\n<td><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 3, 3, 8, 3, 4, 2, 1, 2, 36, 1, 'images/ArXHqauGpckej6Edu10Xuxb9YeZsNGe4OMoiTdJg.jpg', '2025-09-03 03:26:58', '2025-09-17 01:34:52', NULL, 0, 18),
(55, 'PC GVN Intel i7-14700F/ VGA RTX 4070 Super', 'WD2664', '<h2><strong>Th&ocirc;ng số kỹ thuật</strong><strong>:&nbsp;</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/bo-mach-chu-msi-z790-gaming-plus-wifi-ddr5\">Bo mạch chủ MSI Z790 GAMING PLUS WIFI DDR5</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/bo-vi-xu-ly-intel-core-i7-14700f\">Bộ vi xử l&yacute; Intel Core i7 14700F/Turbo up to 5.4GHz/20 Nh&acirc;n 28 Luồng</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/ram-pc\">RAM</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/ram-corsair-vengeance-rgb-32gb-2x16gb-5600-ddr5-cmh32gx5m2b5600c40k\">Ram Corsair Vengeance RGB 32GB 5600 DDR5</a>&nbsp;</strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/vga-card-man-hinh\">VGA</a>&nbsp;</strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/card-man-hinh-gigabyte-geforce-rtx-4070-super-windforce-oc-12g\">Card m&agrave;n h&igrave;nh GIGABYTE GeForce RTX 4070 SUPER WINDFORCE OC 12G</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>HDD</strong></td>\r\n<td><strong>C&oacute; thể t&ugrave;y chọn&nbsp;<a title=\"https://gearvn.com/collections/hdd-o-cung-pc\" href=\"https://gearvn.com/collections/hdd-o-cung-pc\">N&acirc;ng cấp</a></strong></td>\r\n<td><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/o-cung-ssd-kingston-nv3-1tb-m-2-pcie-nvme-gen4\">Ổ cứng SSD Kingston NV3 1TB M.2 PCIe NVMe Gen4</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/nguon-may-tinh-cooler-master-mwe-750-80-plus-bronze-v3-230v-750w\">Nguồn m&aacute;y t&iacute;nh Cooler Master MWE 750 - 80 Plus Bronze - V3 230V (750W)</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/case-thung-may-tinh\">Case</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/vo-may-tinh-cooler-master-cd600-black\">Vỏ m&aacute;y t&iacute;nh Cooler Master CD600 Black</a></strong></td>\r\n<td><strong>12 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tản nhiệt</strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/tan-nhiet-aio-cooler-master-masterliquid-360-core-si-argb\">Tản nhiệt AIO Cooler Master MasterLiquid 360 Core SI ARGB</a></strong></td>\r\n<td><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 3, 3, 9, 3, 4, 3, 1, 2, 36, 1, 'images/84OcV3KVpKNWtkC7Y1giHPD2nyemndx50L7SqNzD.jpg', '2025-09-03 03:46:37', '2025-09-17 01:32:39', NULL, 2, 17),
(56, 'Ram V-Color Skywalker Plus 1x16GB 3600 RGB Black DDR4 (TL416G36S818CSPKWS)', 'WD4428', '<h2><strong>Th&ocirc;ng số sản phẩm</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><strong>H&atilde;ng sản xuất</strong></td>\r\n<td>V-Color</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Dung lượng</strong></td>\r\n<td>16GB (1x16GB) 3600</td>\r\n</tr>\r\n<tr>\r\n<td><strong>K&ecirc;nh</strong></td>\r\n<td>Single Channel</td>\r\n</tr>\r\n<tr>\r\n<td><strong>K&ecirc;nh</strong></td>\r\n<td>SK Hynix</td>\r\n</tr>\r\n<tr>\r\n<td><strong>BUS</strong></td>\r\n<td>3600MHz (PC4-28800)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Chipset</strong></td>\r\n<td>CL18-22-22-42</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Hiệu điện thế</strong></td>\r\n<td>1.35V</td>\r\n</tr>\r\n<tr>\r\n<td><strong>BUS</strong></td>\r\n<td>Black, Silver</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Xuất xứ</strong></td>\r\n<td>Đ&agrave;i Loan</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '1390000.00', '1490000.00', 97, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 14, 12, 1, 'images/21CqtchvZyXGh4MdhktMOgsYTNLzLXBEe9lMcdjt.png', '2025-09-04 00:48:45', '2025-09-04 01:06:05', NULL, 0, 0),
(57, 'Ram V-Color Skywalker Plus 1x16GB 3600 RGB Silver DDR4 (TL416G36S818CSPSWS)', 'WD8299', NULL, '1190000.00', '1290000.00', 26, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 15, 12, 1, 'images/Q6fTKJAFBLdCH9y6shttjNUgtQ0uklyo7Y1CnFZZ.jpg', '2025-09-04 00:52:11', '2025-09-04 00:52:11', NULL, 0, 0),
(58, 'RAM V-Color MANTA XFinity RGB 32GB (2x16GB) 6000 DDR5 White (TMXFL1660836WWK)', 'WD9973', '<p><strong>TH&Ocirc;NG SỐ KĨ THUẬT:</strong></p>\r\n<div class=\"scroll-table\">\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Thương hiệu</strong></td>\r\n<td>V-Color</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Series</strong></td>\r\n<td>Manta XFinity RGB</td>\r\n</tr>\r\n<tr>\r\n<td><strong>M&agrave;u sắc</strong></td>\r\n<td>Trắng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Loại RAM</strong></td>\r\n<td>DDR5</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Dung lượng</strong></td>\r\n<td>32GB (2 x 16GB)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chuẩn Bus</strong></td>\r\n<td>6000MHz</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Kiểu d&aacute;ng</strong></td>\r\n<td>U-DIMM</td>\r\n</tr>\r\n<tr>\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>133mm (L) x 43mm (H) x 7.7mm (W)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Độ trễ</strong></td>\r\n<td>CL30-38-38-76</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Điện &aacute;p</strong></td>\r\n<td>1.35V</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>ECC</strong></td>\r\n<td>Kh&ocirc;ng</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Hỗ trợ</strong></td>\r\n<td>INTEL XMP + AMD EXPO</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '3590000.00', '4000000.00', 78, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 15, 12, 1, 'images/MPphcO6GhgMTnk3icB0fOC5uM07X55iQrLlLWos5.png', '2025-09-04 00:53:55', '2025-09-04 01:05:49', NULL, 0, 0),
(59, 'RAM G.Skill Trident Z5 ROYAL RGB 32GB (2x16GB) 6400 DDR5 Silver (F5-6400J3239G16GX2-TR5S)', 'WD8098', '<h2><strong>Th&ocirc;ng số sản phẩm :</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Dung lượng</strong></td>\r\n<td>32GB (16GBx2)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Loại bộ nhớ</strong></td>\r\n<td>DDR5</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bộ đa k&ecirc;nh</strong></td>\r\n<td>Bộ k&ecirc;nh đ&ocirc;i</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Hỗ trợ OC</strong></td>\r\n<td>Intel XMP 3.0</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ trễ kiểm chứng</strong></td>\r\n<td>32-39-39-102</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tốc độ kiểm chứng</strong></td>\r\n<td>6400MHz</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Hiệu điện thế kiểm chứng</strong></td>\r\n<td>1.40V</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bộ nhớ đệm/kh&ocirc;ng đệm</strong></td>\r\n<td>Kh&ocirc;ng đệm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Kiểm tra lỗi</strong></td>\r\n<td>Non-ECC</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tốc độ SPD</strong></td>\r\n<td>4800MHz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Hiệu điện thế SPD</strong></td>\r\n<td>1.10V</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Fan đi k&egrave;m</strong></td>\r\n<td>Kh&ocirc;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bảo h&agrave;nh</strong></td>\r\n<td>36 th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>T&iacute;nh năng</strong></td>\r\n<td>Intel XMP 3.0 (Extreme Memory Profile) Ready</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Lưu &yacute;</strong></td>\r\n<td>\r\n<ul>\r\n<li>Kh&ocirc;ng trộn lẫn c&aacute;c bộ nhớ. C&aacute;c bộ nhớ được b&aacute;n theo bộ ph&ugrave; hợp được thiết kế để chạy c&ugrave;ng nhau như một bộ. Việc trộn lẫn c&aacute;c bộ nhớ sẽ dẫn đến c&aacute;c vấn đề về độ ổn định hoặc lỗi hệ thống.</li>\r\n<li>C&aacute;c bộ nhớ \"Intel XMP 3.0 Ready\" / \"AMD EXPO Profile Ready\" bao gồm hỗ trợ cho cấu h&igrave;nh OC tương ứng.</li>\r\n<li>Trước khi bật XMP hoặc EXPO, c&aacute;c bộ nhớ sẽ khởi động ở c&agrave;i đặt BIOS mặc định với phần cứng tương th&iacute;ch.</li>\r\n<li>Đối với c&aacute;c bộ nhớ c&oacute; XMP hoặc EXPO, h&atilde;y bật cấu h&igrave;nh XMP/EXPO/DOCP/A-XMP trong BIOS để đạt tốc độ &eacute;p xung XMP hoặc EXPO tiềm năng định mức của bộ nhớ, t&ugrave;y thuộc v&agrave;o việc sử dụng phần cứng tương th&iacute;ch. Vui l&ograve;ng tham khảo hướng dẫn \"C&aacute;ch bật XMP/EXPO\".</li>\r\n<li>Việc đạt được tốc độ &eacute;p xung XMP/EXPO định mức v&agrave; độ ổn định của hệ thống sẽ phụ thuộc v&agrave;o khả năng tương th&iacute;ch v&agrave; khả năng của bo mạch chủ v&agrave; CPU được sử dụng.</li>\r\n<li>Việc sử dụng theo bất kỳ c&aacute;ch n&agrave;o kh&ocirc;ng nhất qu&aacute;n với th&ocirc;ng số kỹ thuật, cảnh b&aacute;o, thiết kế hoặc khuyến nghị của nh&agrave; sản xuất sẽ dẫn đến tốc độ thấp hơn, hệ thống kh&ocirc;ng ổn định hoặc l&agrave;m hỏng hệ thống hoặc c&aacute;c th&agrave;nh phần của hệ thống.</li>\r\n<li>Chiều cao của m&ocirc;-đun bộ nhớ c&oacute; thể được t&igrave;m thấy trong C&acirc;u hỏi thường gặp, b&ecirc;n dưới c&acirc;u hỏi \"C&aacute;c m&ocirc;-đun bộ nhớ cao bao nhi&ecirc;u?\".</li>\r\n<li>Để được hỗ trợ sản phẩm v&agrave; c&aacute;c c&acirc;u hỏi li&ecirc;n quan, vui l&ograve;ng li&ecirc;n hệ với nh&oacute;m hỗ trợ kỹ thuật của G.SKILL qua email.</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '4990000.00', '5990000.00', 67, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 16, 12, 1, 'images/jyNuB6UGDg5KLoyhdZyzqXtL3CJa6chfRbWN7dYc.png', '2025-09-04 00:56:55', '2025-09-04 01:05:18', NULL, 0, 0),
(60, 'RAM Corsair Dominator Titanium Black 96GB (2x48GB) RGB 6600 DDR5 (CMP96GX5M2B6600C32)', 'WD5395', '<p><strong>Th&ocirc;ng số sản phẩm:</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Bao gồm quạt</strong></td>\r\n<td>Kh&ocirc;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>M&agrave;u sắc</strong></td>\r\n<td>Black</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tương th&iacute;ch bộ nhớ</strong></td>\r\n<td>\r\n<div class=\"scroll-table\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>D&ograve;ng Intel 700 (CPU Intel Core thế hệ thứ 13)</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tương th&iacute;ch chi tiết bộ nhớ</strong></td>\r\n<td>D&ograve;ng Intel 700 (CPU Intel Core thế hệ thứ 13)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chất liệu</strong></td>\r\n<td>Nh&ocirc;m</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>M&agrave;u led</strong></td>\r\n<td>RGB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Series bộ nhớ</strong></td>\r\n<td>Dominator Titanium</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước bộ nhớ</strong></td>\r\n<td>96GB (2x48GB)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Loại bộ nhớ</strong></td>\r\n<td>DDR5</td>\r\n</tr>\r\n<tr>\r\n<td><strong>G&oacute;i bộ nhớ</strong></td>\r\n<td>DIMM</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Pin g&oacute;i bộ nhớ</strong></td>\r\n<td>288</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Đ&egrave;n LED</strong></td>\r\n<td>RGB&nbsp;Dynamic Multi-Zone</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Hiệu suất</strong></td>\r\n<td>\r\n<div class=\"scroll-table\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>XMP 3.0</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>SDP Latency</strong></td>\r\n<td>40-40-40-77</td>\r\n</tr>\r\n<tr>\r\n<td><strong>T&oacute;c độ SDP</strong></td>\r\n<td>4800MHz</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điện &aacute;p SPD</strong></td>\r\n<td>1.1V</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Độ trễ được kiểm tra</strong></td>\r\n<td>32-39-39-76</td>\r\n</tr>\r\n<tr>\r\n<td><strong>T&oacute;c độ kiểm tra</strong></td>\r\n<td>6600 MT/s</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điện &aacute;p kiểm tra</strong></td>\r\n<td>1.40V</td>\r\n</tr>\r\n<tr>\r\n<td><strong>C&acirc;n nặng</strong></td>\r\n<td>0.338</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảng điện</strong></td>\r\n<td>\r\n<div class=\"scroll-table\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>Overclock PMIC</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '13290000.00', '13990000.00', 49, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 17, 18, 1, 'images/POIVdxedV3GRZx61DQ7HoPGRwoec6bpb72aEZQOc.png', '2025-09-04 00:58:43', '2025-09-04 01:05:30', NULL, 0, 0),
(61, 'Ram Corsair Vengeance RGB 96GB (2x48GB) 5600 DDR5 Black (CMH96GX5M2B5600C40)', 'WD2050', '<p><strong>Th&ocirc;ng số sản phẩm:</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Chất liệu</strong></td>\r\n<td>Nh&ocirc;m</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>LED</strong></td>\r\n<td>RGB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước bộ nhớ</strong></td>\r\n<td>96GB (2x48GB)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Hồ sơ hiệu suất</strong></td>\r\n<td>XMP 3.0</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tốc độ SPD</strong></td>\r\n<td>4800MHz</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ trễ đ&atilde; kiểm tra</strong></td>\r\n<td>40-40-40-77</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tốc độ đ&atilde; thử nghiệm(L&ecirc;n tới)</strong></td>\r\n<td>5600</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bao gồm quạt</strong></td>\r\n<td>Kh&ocirc;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>M&agrave;u sắc</strong></td>\r\n<td>Đen</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tương th&iacute;ch</strong></td>\r\n<td>Intel 600 Series,Intel 700 Series</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Khả năng tương th&iacute;ch chi tiết bộ nhớ</strong></td>\r\n<td>Intel 600 Series,Intel 700 Series</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Loại ram</strong></td>\r\n<td>DDR5</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Dạng ram</strong></td>\r\n<td>DIMM</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>G&oacute;i bộ nhớ ram</strong></td>\r\n<td>288</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Độ trễ SDP</strong></td>\r\n<td>40-40-40-77</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điện &aacute;p SPD</strong></td>\r\n<td>1.1V</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Độ trễ được kiểm tra</strong></td>\r\n<td>32-39-39-76</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điện &aacute;p kiểm tra</strong></td>\r\n<td>1.25V</td>\r\n</tr>\r\n<tr>\r\n<td><strong>C&acirc;n nặng</strong></td>\r\n<td>0.15</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảng điện</strong></td>\r\n<td>\r\n<div class=\"scroll-table\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>Overclock PMIC</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '8790000.00', '9990000.00', 44, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 18, 17, 1, 'images/WcW12QppiwDJIC5c8BWbSyAietAJMLmQLq2NMRiB.png', '2025-09-04 01:08:24', '2025-09-04 03:01:25', NULL, 2, 0),
(62, 'RAM TeamGroup T-Force XTreem 2x16GB 8000Mhz Black DDR5', 'WD8636', '<h2><strong>Th&ocirc;ng số sản phẩm :</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Part number</strong></td>\r\n<td>FFXD532G8000HC38DDC01</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Dung lượng</strong></td>\r\n<td>32GB (16GBx2)&nbsp;</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Loại bộ nhớ</strong></td>\r\n<td>DDR5</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bộ đa k&ecirc;nh</strong></td>\r\n<td>Bộ k&ecirc;nh đ&ocirc;i</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ trễ kiểm chứng</strong></td>\r\n<td>CL38</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tốc độ bus</strong></td>\r\n<td>8000MHz</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Hiệu điện thế kiểm chứng</strong></td>\r\n<td>1.45V</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bảo h&agrave;nh</strong></td>\r\n<td>36 th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tương th&iacute;ch</strong></td>\r\n<td>Intel: 700 series</td>\r\n</tr>\r\n<tr>\r\n<td><strong>LED</strong></td>\r\n<td>Kh&ocirc;ng</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '6390000.00', '7990000.00', 34, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 19, 16, 1, 'images/UG3xrH51M0MxhbXSn6Sm6gHtNzZKJcozpPe8Cgn8.png', '2025-09-04 01:09:51', '2025-09-04 03:01:25', NULL, 2, 0),
(63, 'Ram V-Color Skywalker Plus 1x8GB 3600 RGB White DDR4', 'WD7756', NULL, '890000.00', '990000.00', 57, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 15, 12, 1, 'images/ChtTCXFoACXnoD1mWu1t0RPtEtQuNM4oaxkWI2bX.png', '2025-09-04 01:12:24', '2025-09-04 01:12:24', NULL, 0, 0);
INSERT INTO `san_phams` (`id`, `ten`, `ma_san_pham`, `mo_ta`, `gia`, `gia_so_sanh`, `so_luong`, `sku`, `co_bien_the`, `id_chip`, `id_mainboard`, `id_gpu`, `id_tannhiet`, `id_case`, `id_nguon`, `id_category`, `id_brand`, `bao_hanh_thang`, `hoat_dong`, `anh_dai_dien`, `created_at`, `updated_at`, `deleted_at`, `luot_mua`, `luot_xem`) VALUES
(64, 'Ổ cứng HDD SEAGATE IronWolf PRO 14TB', 'WD8261', '<p><strong>Th&ocirc;ng số kỹ thuật :</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td>Thương hiệu</td>\r\n<td>SeaGate</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>T&ecirc;n sản phẩm</td>\r\n<td>HDD Seagate Ironwolf PRO 14TB 7200rpm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Bảo h&agrave;nh</td>\r\n<td>60 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Giao thức kết nối</td>\r\n<td>SATA3 - 3.5\"</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Dung lượng</td>\r\n<td>14 TB</td>\r\n</tr>\r\n<tr>\r\n<td>Tốc độ quay</td>\r\n<td>7200 rpm</td>\r\n</tr>\r\n<tr>\r\n<td>Bộ nhớ cache</td>\r\n<td>256 Mb</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>K&iacute;ch thước</td>\r\n<td>101.6 x 25.4 x 146 mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Kiểu d&aacute;ng</td>\r\n<td>3.5\"</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Tốc độ đọc</td>\r\n<td>L&ecirc;n tới 255Mb/s</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Tốc độ ghi</td>\r\n<td>L&ecirc;n tới 255Mb/s</td>\r\n</tr>\r\n<tr>\r\n<td><br><br>T&iacute;nh năng nổi bật</td>\r\n<td>- Tối ưu h&oacute;a cho NAS với AgileArray&trade; v&agrave; khả năng phục hồi lỗi gi&uacute;p cải thiện chất lượng của ổ cứng hoạt động trong d&atilde;y RAID.<br>- Ổ cứng HDD Seagate IronWolf Pro với g&oacute;i phục hồi v&agrave; cứu hộ sẽ cho bạn sự an t&acirc;m tuyệt đối khi sử dụng.<br>- Trong ổ cứng HDD Seagate IronWolf Pro 4 TB trở l&ecirc;n được trang bị cảm biến RV để duy tr&igrave; hiệu suất trong c&aacute;c thiết bị NAS nhiều khoang. C&aacute;c ổ đĩa IronWolf Pro đạt ti&ecirc;u chuẩn với c&aacute;c cảm biến RV được t&iacute;ch hợp cho NAS.<br>- Ổ cứng HDD Seagate IronWolf Pro c&oacute; thể xử l&yacute; c&aacute;c rung động v&agrave; tốc độ tải c&ocirc;ng việc cao của mạng dữ liệu cao trong m&ocirc;i trường NAS.C&aacute;c ổ đĩa IronWolf Pro được kiểm tra v&agrave; ph&ecirc; duyệt bởi QNAP.<br>-D&ograve;ng ổ cứng đ&aacute;ng tin cậy IronWolf Pro của Seagate đ&atilde; được tin d&ugrave;ng khắp thế giới trong hơn 20 năm qua v&agrave; được c&ocirc;ng nhận chất lượng bởi kh&aacute;ch h&agrave;ng to&agrave;n cầu.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '15990000.00', '17990000.00', 16, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 21, 36, 1, 'images/j8S6b53B32mOIvYAm5qMeudLxTp7IEABhFFlaS5s.jpg', '2025-09-04 01:16:48', '2025-09-04 01:16:48', NULL, 0, 0),
(65, 'Ổ Cứng HDD Enterprise Western Digital Ultrastar DC HC330 10TB (WUS721010ALE6L4)', 'WD3157', '<p><strong>Th&ocirc;ng số kỹ thuật</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Nh&agrave; sản xuất&nbsp;&nbsp; &nbsp;</strong></td>\r\n<td>Western Digital</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảo h&agrave;nh</strong></td>\r\n<td>60 th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chuẩn giao tiếp&nbsp;&nbsp; &nbsp;</strong></td>\r\n<td>Sata III</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước&nbsp;&nbsp; &nbsp;</strong></td>\r\n<td>3.5 inch</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Giao diện</strong></td>\r\n<td>SATA 6 Gb/s</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Dung lượng&nbsp;&nbsp; &nbsp;</strong></td>\r\n<td>10 TB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Cache</strong></td>\r\n<td>256M</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>RPM</strong></td>\r\n<td>7200</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>MTBF (M hours)</strong></td>\r\n<td>2,000,000</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chu kỳ tải/dỡ tải&nbsp;</strong></td>\r\n<td>600,000</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '7590000.00', '7990000.00', 23, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 20, 36, 1, 'images/hMRCVyGyQKMX4HCE27CIYdtmNHxmtLrk0cizYMdi.png', '2025-09-04 01:18:08', '2025-09-04 01:18:08', NULL, 0, 0),
(66, 'Ổ Cứng HDD Enterprise Western Digital Ultrastar DC HC320 8TB (HUS728T8TALE6L4)', 'WD5908', '<p><strong>Th&ocirc;ng số kỹ thuật</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Nh&agrave; sản xuất&nbsp;&nbsp; &nbsp;</strong></td>\r\n<td>Western Digital</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảo h&agrave;nh</strong></td>\r\n<td>60 th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chuẩn giao tiếp&nbsp;&nbsp; &nbsp;</strong></td>\r\n<td>Sata III</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước&nbsp;&nbsp; &nbsp;</strong></td>\r\n<td>3.5 inch</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Giao diện</strong></td>\r\n<td>SATA 6 Gb/s</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Dung lượng&nbsp;&nbsp; &nbsp;</strong></td>\r\n<td>8 TB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Cache</strong></td>\r\n<td>256M</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>RPM</strong></td>\r\n<td>7200</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>MTBF (M hours)</strong></td>\r\n<td>2,000,000</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chu kỳ tải/dỡ tải&nbsp;</strong></td>\r\n<td>600,000</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '6490000.00', '7990000.00', 34, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 20, 36, 1, 'images/iGlNVx4mgnAD1SFzaWjd5JAYdYuVoG2bDZxlP4dX.png', '2025-09-04 01:19:07', '2025-09-04 01:19:07', NULL, 0, 0),
(67, 'Ổ Cứng HDD WD Red Plus 6TB 5400RPM', 'WD9958', '<h2><u><strong>Th&ocirc;ng số sản phẩm :</strong></u></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Nh&agrave; sản xuất</strong></td>\r\n<td>Western Digital</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bảo h&agrave;nh</strong></td>\r\n<td>24 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chuẩn giao tiếp</strong></td>\r\n<td>Sata III</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>3.5 Inch</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Dung lượng</strong></td>\r\n<td>6 TB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Cache</strong></td>\r\n<td>128M Cache</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>RPM</strong></td>\r\n<td>5400 rpm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>25.4 x147x101.6 mm (Cao x D&agrave;i x Rộng)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Trọng lượng</strong></td>\r\n<td>0.45 kg</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p class=\"MsoNormal\">&nbsp;</p>', '4690000.00', '5000000.00', 34, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 20, 36, 1, 'images/4JgnaGAh5GfV8budy8nEZ14Lzal4fQYyMPIhOq3D.png', '2025-09-04 01:20:16', '2025-09-04 01:20:37', NULL, 0, 0),
(68, 'Ổ cứng SSD Samsung 9100 PRO NVMe M.2 1TB Gen5', 'WD5190', '<div class=\"desc-content\">\r\n<h2><strong>Đ&aacute;nh gi&aacute; chi tiết Ổ cứng SSD Samsung 9100 PRO NVMe M.2 1TB Gen5</strong></h2>\r\n<p><a href=\"https://gearvn.com/collections/ssd-samsung\">Ổ cứng SSD Samsung</a>&nbsp;9100 PRO NVMe M.2 1TB Gen5 l&agrave; một trong những sản phẩm đột ph&aacute; trong lĩnh vực lưu trữ, mang đến trải nghiệm hiệu suất vượt trội cho người d&ugrave;ng cần tốc độ truy xuất dữ liệu nhanh ch&oacute;ng. Sản phẩm n&agrave;y hứa hẹn sẽ đ&aacute;p ứng nhu cầu lưu trữ cao từ game thủ, người s&aacute;ng tạo nội dung đến c&aacute;c chuy&ecirc;n gia IT.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/vn-9100-pro-nvme-m2-ssd-mz-vap1t0bw-545216275_db9c94155c8a411fa2879ead1b28cd0e_1024x1024.png\" alt=\"Ổ cứng SSD Samsung 9100 PRO NVMe M.2 1TB Gen5\"></p>\r\n<h3><strong>Tốc độ truyền dữ liệu cực nhanh</strong></h3>\r\n<p>Samsung 9100 PRO NVMe M.2 1TB Gen5 sử dụng giao thức NVMe PCIe Gen 5, cho ph&eacute;p tốc độ truyền dữ liệu l&ecirc;n đến 7.000 MB/s, vượt bậc so với c&aacute;c mẫu&nbsp;<a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a>&nbsp;hiện tại. Khả năng đọc v&agrave; ghi dữ liệu si&ecirc;u nhanh n&agrave;y gi&uacute;p r&uacute;t ngắn thời gian khởi động v&agrave; tối ưu h&oacute;a quy tr&igrave;nh l&agrave;m việc của bạn.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/vn-9100-pro-nvme-m2-ssd-mz-vap1t0bw-545216273_15c52dd5f45a465a81f99f0bf75577e2_1024x1024.png\"></p>\r\n<h3><strong>Thiết kế nhỏ gọn v&agrave; dễ lắp đặt</strong></h3>\r\n<p>Với k&iacute;ch thước M.2, Samsung 9100 PRO dễ d&agrave;ng lắp đặt v&agrave;o c&aacute;c&nbsp;<a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">bo mạch chủ</a>&nbsp;tương th&iacute;ch m&agrave; kh&ocirc;ng chiếm qu&aacute; nhiều kh&ocirc;ng gian. Thiết kế n&agrave;y kh&ocirc;ng chỉ gi&uacute;p tiết kiệm diện t&iacute;ch m&agrave; c&ograve;n mang đến vẻ ngo&agrave;i gọn g&agrave;ng cho hệ thống m&aacute;y t&iacute;nh của bạn.</p>\r\n<h3><strong>C&ocirc;ng nghệ V-NAND ti&ecirc;n tiến</strong></h3>\r\n<p>Sản phẩm được trang bị c&ocirc;ng nghệ V-NAND 3D gi&uacute;p tăng cường độ bền v&agrave; đ&aacute;ng tin cậy cho c&aacute;c hoạt động lưu trữ. C&ocirc;ng nghệ n&agrave;y cũng cho ph&eacute;p Samsung 9100 PRO đạt được hiệu suất cao hơn so với c&aacute;c ổ cứng SSD truyền thống, cải thiện hiệu suất đọc/ghi ngẫu nhi&ecirc;n.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/vn-9100-pro-nvme-m2-ssd-mz-vap1t0bw-545216276_b161c626dfdb461d90bfec391e9fc23a_1024x1024.png\" alt=\"Ổ cứng SSD Samsung 9100 PRO NVMe M.2 1TB Gen5\"></p>\r\n<h3><strong>Bảo mật tuyệt đối với m&atilde; h&oacute;a AES 256-bit</strong></h3>\r\n<p>Samsung 9100 PRO NVMe M.2 1TB Gen5 t&iacute;ch hợp m&atilde; h&oacute;a AES 256-bit, gi&uacute;p bảo vệ dữ liệu của bạn khỏi những rủi ro về bảo mật. T&iacute;nh năng n&agrave;y rất quan trọng cho những người sử dụng cần bảo mật th&ocirc;ng tin nhạy cảm, đặc biệt trong m&ocirc;i trường doanh nghiệp.</p>\r\n<h3><strong>Ti&ecirc;u thụ năng lượng hiệu quả</strong></h3>\r\n<p>Một điểm mạnh kh&aacute;c của Samsung 9100 PRO đ&oacute; l&agrave; hiệu suất ti&ecirc;u thụ năng lượng tối ưu. Với c&ocirc;ng nghệ mới, ổ cứng n&agrave;y kh&ocirc;ng chỉ mang lại tốc độ cao m&agrave; c&ograve;n tiết kiệm năng lượng, gi&uacute;p hệ thống&nbsp;<a href=\"https://gearvn.com/pages/pc-gvn\">m&aacute;y t&iacute;nh</a>&nbsp;của bạn hoạt động mượt m&agrave; m&agrave; kh&ocirc;ng lo lắng về việc ti&ecirc;u tốn qu&aacute; nhiều điện năng.</p>\r\n<p><img src=\"https://product.hstatic.net/200000722513/product/vn-9100-pro-nvme-m2-ssd-mz-vap1t0bw-545216278_a2874c88702a4395a8e62be54425c360_1024x1024.png\" alt=\"Ổ cứng SSD Samsung 9100 PRO NVMe M.2 1TB Gen5\"></p>\r\n<h3><strong>Quản l&yacute; hệ thống v&agrave; hiệu suất th&ocirc;ng minh</strong></h3>\r\n<p>Samsung 9100 PRO trang bị phần mềm Samsung Magician, cho ph&eacute;p người d&ugrave;ng quản l&yacute; ổ cứng dễ d&agrave;ng. Phần mềm n&agrave;y gi&uacute;p theo d&otilde;i sức khỏe ổ cứng, cập nhật firmware, tối ưu h&oacute;a hiệu suất v&agrave; bảm bảo rằng bạn lu&ocirc;n nhận được trải nghiệm lưu trữ tốt nhất.</p>\r\n<p>Với những t&iacute;nh năng nổi bật v&agrave; c&ocirc;ng nghệ ti&ecirc;n tiến,&nbsp;<strong>Ổ cứng SSD Samsung 9100 PRO NVMe M.2 1TB Gen5</strong>&nbsp;l&agrave; sự lựa chọn ho&agrave;n hảo cho những ai đang cần một giải ph&aacute;p lưu trữ mạnh mẽ, tốc độ nhanh v&agrave; bảo mật cao. Đầu tư v&agrave;o sản phẩm n&agrave;y kh&ocirc;ng chỉ gi&uacute;p n&acirc;ng cao trải nghiệm sử dụng m&aacute;y t&iacute;nh m&agrave; c&ograve;n tối ưu h&oacute;a hiệu suất c&ocirc;ng việc h&agrave;ng ng&agrave;y. H&atilde;y c&acirc;n nhắc lựa chọn Samsung 9100 PRO cho hệ thống của bạn ngay h&ocirc;m nay!</p>\r\n</div>\r\n<div class=\"desc-btn\">&nbsp;</div>', '5990000.00', '6390000.00', 24, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 22, 24, 1, 'images/B5wZLVOD7fMwnt3qNAFbiKWBQxB60XPkz0SzZ59d.png', '2025-09-04 02:37:00', '2025-09-04 02:37:00', NULL, 0, 0),
(69, 'Ổ Cứng SSD WD Blue SN5000 2TB M.2 NVMe PCIe Gen4 (WDS200T4B0E)', 'WD2843', '<p><strong>Th&ocirc;ng số sản phẩm:</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p><strong>Model</strong></p>\r\n</td>\r\n<td><a href=\"https://gearvn.com/collections/ssd-wd\">SSD WD</a>&nbsp;Blue SN5000 500GB M.2 NVMe PCIe Gen4</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Dung lượng</strong></p>\r\n</td>\r\n<td>500GB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Chuẩn giao tiếp</strong></p>\r\n</td>\r\n<td>\r\n<p>PCIe Gen4 x4</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>DRAM</strong></td>\r\n<td>HMB (Bộ đệm bộ nhớ m&aacute;y chủ)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>NAND</strong></td>\r\n<td>3D NAND TLC</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>K&iacute;ch thước</strong></p>\r\n</td>\r\n<td>\r\n<p>M.2 2280</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Tốc độ đọc</strong></p>\r\n</td>\r\n<td>5150MB/s</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Tốc độ ghi</strong></p>\r\n</td>\r\n<td>4850MB/s</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Đọc ngẫu nhi&ecirc;n</strong></p>\r\n</td>\r\n<td>650,000 IOPS</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Ghi ngẫu nhi&ecirc;n</strong></p>\r\n</td>\r\n<td>770,000 4KB IOPS</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Độ bền (TBW)</strong></td>\r\n<td>900</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Phần mềm</strong></p>\r\n</td>\r\n<td>\r\n<p>Acronis True Image for Western Digital</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '5290000.00', '5490000.00', 22, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 20, 24, 1, 'images/VV6AtvQ2CikPNqA3k8OHPoCpgfg2a6FQeKA5Uai3.png', '2025-09-04 02:38:16', '2025-09-04 02:38:16', NULL, 0, 0),
(70, 'Ổ Cứng SSD WD Blue SN5000 500GB M.2 NVMe PCIe Gen4 (WDS500G4B0E)', 'WD2381', '<p>&nbsp;</p>\r\n<p><strong>Th&ocirc;ng số sản phẩm:</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p><strong>Model</strong></p>\r\n</td>\r\n<td><a href=\"https://gearvn.com/collections/ssd-wd\">SSD WD</a>&nbsp;Blue SN5000 500GB M.2 NVMe PCIe Gen4</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Dung lượng</strong></p>\r\n</td>\r\n<td>500GB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Chuẩn giao tiếp</strong></p>\r\n</td>\r\n<td>\r\n<p>PCIe Gen4 x4</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>DRAM</strong></td>\r\n<td>HMB (Bộ đệm bộ nhớ m&aacute;y chủ)</td>\r\n</tr>\r\n<tr>\r\n<td><strong>NAND</strong></td>\r\n<td>3D NAND TLC</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>K&iacute;ch thước</strong></p>\r\n</td>\r\n<td>\r\n<p>M.2 2280</p>\r\n</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Tốc độ đọc</strong></p>\r\n</td>\r\n<td>5000MB/s</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>\r\n<p><strong>Tốc độ ghi</strong></p>\r\n</td>\r\n<td>4000MB/s</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Đọc ngẫu nhi&ecirc;n</strong></p>\r\n</td>\r\n<td>460,000 IOPS</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Ghi ngẫu nhi&ecirc;n</strong></p>\r\n</td>\r\n<td>770,000 4KB IOPS</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Độ bền (TBW)</strong></td>\r\n<td>300</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Phần mềm</strong></p>\r\n</td>\r\n<td>\r\n<p>Acronis True Image for Western Digital</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '1490000.00', '1890000.00', 34, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 20, 24, 1, 'images/yeAYaCfrjKxv2qy0YRiCs5PTk0JeIiw8k7yAwV6n.png', '2025-09-04 02:39:43', '2025-09-04 02:39:43', NULL, 0, 0),
(71, 'Ổ cứng SSD Kingston NV3 2TB M.2 PCIe NVMe Gen4', 'WD0544', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Thương hiệu</strong></td>\r\n<td>Kingston</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảo h&agrave;nh</strong></td>\r\n<td>36&nbsp;th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>M.2 2280</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Giao diện</strong></td>\r\n<td>\r\n<div class=\"scroll-table\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>PCIe 4.0 x4 NVMe</td>\r\n</tr>\r\n<tr></tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>NAND</strong></td>\r\n<td>3D</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Mức dung lượng</strong></td>\r\n<td>500GB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Đọc/ghi tuần tự</strong></td>\r\n<td>6.000/5.000 MB/gi&acirc;y</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Đ&ocirc;̣ b&ecirc;̀n</strong></td>\r\n<td>640TB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Nhiệt độ bảo quản</strong></td>\r\n<td>-40&deg;C~85&deg;C</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Nhiệt độ vận h&agrave;nh</strong></td>\r\n<td>0&deg;C~70&deg;C</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước chuẩn&nbsp;</strong></td>\r\n<td>22 mm x 80 mm x 2,1 mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Trọng lượng</strong></td>\r\n<td>7 g (Tất cả c&aacute;c mức dung lượng)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ rung khi hoạt động</strong></td>\r\n<td>10 G (10-1000 Hz)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tuổi thọ trung b&igrave;nh</strong></td>\r\n<td>2.000.000 giờ)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bảo h&agrave;nh/hỗ trợ</strong></td>\r\n<td>Bảo h&agrave;nh 3 năm c&oacute; giới hạn với hỗ trợ kỹ thuật miễn ph&iacute;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '3990000.00', '4190000.00', 21, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 23, 24, 1, 'images/zBQvMBqKrCtFmI7UYjnwMfydCXq9JDU8mSLyBbkP.png', '2025-09-04 02:41:26', '2025-09-04 02:41:26', NULL, 0, 0),
(72, 'Ổ cứng SSD Kingston NV3 1TB M.2 PCIe NVMe Gen4', 'WD5819', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Thương hiệu</strong></td>\r\n<td>Kingston</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảo h&agrave;nh</strong></td>\r\n<td>36&nbsp;th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>M.2 2280</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Giao diện</strong></td>\r\n<td>\r\n<div class=\"scroll-table\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>PCIe 4.0 x4 NVMe</td>\r\n</tr>\r\n<tr></tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>NAND</strong></td>\r\n<td>3D</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Mức dung lượng</strong></td>\r\n<td>1TB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Đọc/ghi tuần tự</strong></td>\r\n<td>6.000/4.000 MB/gi&acirc;y</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Đ&ocirc;̣ b&ecirc;̀n</strong></td>\r\n<td>320TB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Nhiệt độ bảo quản</strong></td>\r\n<td>-40&deg;C~85&deg;C</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Nhiệt độ vận h&agrave;nh</strong></td>\r\n<td>0&deg;C~70&deg;C</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước chuẩn&nbsp;</strong></td>\r\n<td>22 mm x 80 mm x 2,1 mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Trọng lượng</strong></td>\r\n<td>7 g (Tất cả c&aacute;c mức dung lượng)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ rung khi hoạt động</strong></td>\r\n<td>10 G (10-1000 Hz)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tuổi thọ trung b&igrave;nh</strong></td>\r\n<td>2.000.000 giờ)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bảo h&agrave;nh/hỗ trợ</strong></td>\r\n<td>Bảo h&agrave;nh 3 năm c&oacute; giới hạn với hỗ trợ kỹ thuật miễn ph&iacute;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '1890000.00', '2490000.00', 20, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 23, 36, 1, 'images/2roc95RlnFMEiSUVaJsXTFHeMeA2NOTEl9XKWvEw.png', '2025-09-04 02:42:47', '2025-09-04 02:42:47', NULL, 0, 0),
(73, 'Ổ cứng SSD Kingston NV3 500GB M.2 PCIe NVMe Gen4', 'WD1170', '<h2><strong>Th&ocirc;ng số kỹ thuật:</strong></h2>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Thương hiệu</strong></td>\r\n<td>Kingston</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Bảo h&agrave;nh</strong></td>\r\n<td>36&nbsp;th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>M.2 2280</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Giao diện</strong></td>\r\n<td>\r\n<div class=\"scroll-table\">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>PCIe 4.0 x4 NVMe</td>\r\n</tr>\r\n<tr></tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>NAND</strong></td>\r\n<td>3D</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Mức dung lượng</strong></td>\r\n<td>500GB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Đọc/ghi tuần tự</strong></td>\r\n<td>5.000/3.000 MB/gi&acirc;y</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Đ&ocirc;̣ b&ecirc;̀n</strong></td>\r\n<td>160TB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Nhiệt độ bảo quản</strong></td>\r\n<td>-40&deg;C~85&deg;C</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Nhiệt độ vận h&agrave;nh</strong></td>\r\n<td>0&deg;C~70&deg;C</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước chuẩn&nbsp;</strong></td>\r\n<td>22 mm x 80 mm x 2,1 mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Trọng lượng</strong></td>\r\n<td>7 g (Tất cả c&aacute;c mức dung lượng)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Độ rung khi hoạt động</strong></td>\r\n<td>10 G (10-1000 Hz)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tuổi thọ trung b&igrave;nh</strong></td>\r\n<td>2.000.000 giờ)</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Bảo h&agrave;nh/hỗ trợ</strong></td>\r\n<td>Bảo h&agrave;nh 3 năm c&oacute; giới hạn với hỗ trợ kỹ thuật miễn ph&iacute;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '99999999999.00', '9999999999999.00', 34, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 23, 36, 1, 'images/92uqMxdsrCCty7EEdCCuFCJ5hu8k00C8DBaooEtw.png', '2025-09-04 02:44:10', '2025-09-13 02:52:38', NULL, 0, 0),
(74, 'Ổ Cứng SSD SamSung 980 250GB M.2 PCIe NVMe', 'WD5750', '<p><strong>Th&ocirc;ng số kỹ thuật</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong>Thương hiệu</strong></td>\r\n<td>Samsung</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Model</strong></td>\r\n<td>MZ-V8V250BW</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Chuẩn giao tiếp</strong></td>\r\n<td>PCIe Gen3 x4 MVMe</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>K&iacute;ch thước</strong></td>\r\n<td>M.2 2280</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Dung lượng</strong></td>\r\n<td>250 GB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tốc độ đọc</strong></td>\r\n<td>3500 MB/s</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>Tốc độ ghi</strong></td>\r\n<td>3000 MB/s</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>NAND Flash</strong></td>\r\n<td>Samsung V-NAND TLC 128-Layers</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<h2><strong>Đ&aacute;nh gi&aacute; chi tiết SSD Samsung 980 M.2 PCIe NVMe 250GB</strong></h2>\r\n<p>&nbsp;</p>\r\n<h3><strong>Si&ecirc;u ổ cứng thế hệ mới</strong></h3>\r\n<p>SSD Samsung 980 M.2 PCIe NVMe 2280&nbsp;được trang bị&nbsp;chuẩn giao tiếp PCIe Gen3 x4 băng th&ocirc;ng rộng mang đến cho bạn một hiệu năng cực k&igrave; tuyệt vời. Với c&ocirc;ng nghệ Samsung V-NAND v&agrave; Dynamic Thermal Guard, ổ cứng SSD Samsung 980 M.2 PCIe NVMe 2280&nbsp;đảm bảo t&iacute;nh an to&agrave;n&nbsp;của dữ liệu. Giao diện NVMe v&agrave; Controller&nbsp;Phoenix l&agrave;m gia tăng tốc độ đọc/ghi l&ecirc;n mức tối đa. C&ocirc;ng nghệ TurboWrite gi&uacute;p gia tăng hiệu năng, đ&aacute;p ứng mọi nhu cầu của bạn như chỉnh sửa video, ph&acirc;n t&iacute;ch dữ liệu v&agrave; chơi Games. SSD Samsung 980 M.2 PCIe NVMe 2280&nbsp;đi k&egrave;m&nbsp;phần mềm Magician của Samsung, gi&uacute;p dễ d&agrave;ng quản l&yacute;, theo d&otilde;i v&agrave; tối ưu h&oacute;a hiệu năng của ổ đĩa.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-ssd-samsung-980-m2-pcie-nvme-250gb-1_0b68310b75e147c39aefd589524c8241_grande.jpg\"><img src=\"https://file.hstatic.net/1000026716/file/gearvn-ssd-samsung-980-m2-pcie-nvme-250gb-2_9ad1234acf844018a41f82de92ca3b7b_grande.jpg\"></p>\r\n<h3><strong>Sự kết hợp ho&agrave;n hảo</strong></h3>\r\n<p>Được thiết kế cho c&aacute;c game thủ chuy&ecirc;n nghiệp v&agrave; người d&ugrave;ng y&ecirc;u c&ocirc;ng nghệ, SSD Samsung 980 M.2 PCIe NVMe 2280 cung cấp băng th&ocirc;ng v&agrave; hiệu suất cao cho c&aacute;c ứng dụng nặng về chơi game, đồ họa, ph&acirc;n t&iacute;ch dữ liệu v&agrave; hơn thế nữa. Tốc độ tải tr&ograve; chơi nhanh n&ecirc;n bạn c&oacute; thể chơi nhiều hơn v&agrave; &iacute;t phải chờ đợi hơn.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-ssd-samsung-980-m2-pcie-nvme-250gb-3_fb60e697efbd44218b644fc04c0f1b6b_grande.jpg\"></p>\r\n<p><strong>SSD M.2 hiệu quả</strong></p>\r\n<p>SSD Samsung 980 c&oacute; dạng M.2 2280 nhỏ gọn, c&oacute; thể dễ d&agrave;ng cắm v&agrave;o m&aacute;y t&iacute;nh để b&agrave;n v&agrave;&nbsp;<a href=\"https://gearvn.com/collections/laptop\">laptop</a>. Do k&iacute;ch thước v&agrave; hiệu suất năng lượng được tối ưu h&oacute;a, n&oacute; l&agrave; l&yacute; tưởng để x&acirc;y dựng c&aacute;c hệ thống m&aacute;y t&iacute;nh hiệu suất cao.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-ssd-samsung-980-m2-pcie-nvme-250gb-4_89e3369bc4ca4b5b80bd18d083a33a32_grande.jpg\"></p>\r\n<p><strong>Kiểm so&aacute;t nhiệt đ&aacute;ng tin cậy</strong></p>\r\n<p>SSD Samsung 980 M.2 PCIe NVMe 2280 cung cấp khả năng kiểm so&aacute;t nhiệt hiệu suất cao cần thiết cho một ổ SSD hiệu suất cao. Để gi&uacute;p đảm bảo hiệu suất ổn định, n&oacute; sử dụng lớp phủ niken để gi&uacute;p quản l&yacute; mức nhiệt của bộ điều khiển v&agrave; nh&atilde;n bộ tản nhiệt để cung cấp khả năng kiểm so&aacute;t nhiệt hiệu quả của chip NAND.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-ssd-samsung-980-m2-pcie-nvme-250gb-5_4d26e7822ae34d4d959617d60ff9e5e5_grande.jpg\"></p>\r\n<p><strong>Phần mềm Samsung Magician</strong></p>\r\n<p>SSD Samsung 980 M.2 PCIe NVMe 2280 đi k&egrave;m với phần mềm Samsung Magician miễn ph&iacute; c&oacute; thể tải về tr&ecirc;n trang chủ, cho ph&eacute;p bạn dễ d&agrave;ng theo d&otilde;i, quản l&yacute; v&agrave; duy tr&igrave; hiệu năng&nbsp;<a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a>&nbsp;của bạn. Samsung magician gi&uacute;p đảm bảo rằng c&aacute;c Firmware mới nhất lu&ocirc;n được cập nhật v&agrave; cung cấp một loạt c&aacute;c chức năng bổ sung cho ph&eacute;p bạn điều chỉnh c&aacute;c thiết lập ph&ugrave; hợp nhất với c&aacute;ch sử dụng của bạn.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-ssd-samsung-980-m2-pcie-nvme-250gb-6_7d3c6c1b33e8434e892e942798c4a8a5_grande.jpg\"></p>\r\n<p><strong>Thương hiệu bộ nhớ Flash số 1 thế giới</strong></p>\r\n<p>Samsung l&agrave;&nbsp;thương hiệu số một thế giới về bộ nhớ flash từ năm 2003, tất cả c&aacute;c&nbsp;linh kiện, bao gồm cả DRAM v&agrave; NAND nổi tiếng thế giới của Samsung, đều được sản xuất nội bộ, cho ph&eacute;p t&iacute;ch hợp từ đầu đến cuối cho chất lượng m&agrave; bạn c&oacute; thể tin tưởng.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-ssd-samsung-980-m2-pcie-nvme-250gb-7_da4e8bf3e7a5449fb48130243a22facc_grande.jpg\"></p>', '1290000.00', '1590000.00', 19, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 22, 36, 1, 'images/f0d3LPo5KMFBhPrmnZGLVrkAiCdnltzFr69m4tFz.jpg', '2025-09-04 02:45:35', '2025-09-04 02:45:35', NULL, 0, 0),
(75, 'Ổ Cứng SSD SamSung 980 1TB M.2 PCIe NVMe', 'WD9090', '<p><strong>Th&ocirc;ng số kỹ thuật :</strong></p>\r\n<div class=\"scroll-table\">\r\n<table id=\"tblGeneralAttribute\" class=\"table table-bordered\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td>Thương hiệu</td>\r\n<td>Samsung</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>T&ecirc;n sản phẩm</td>\r\n<td>SSD Samsung 980 M.2 PCIe NVMe 1TB</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Bảo h&agrave;nh</td>\r\n<td>60 Th&aacute;ng</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Giao thức kết nối</td>\r\n<td>M.2 (22 x 80 mm)&nbsp;<br>PCIe 3.0 x4 NVMe 1.4</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Dung lượng</td>\r\n<td>1TB</td>\r\n</tr>\r\n<tr>\r\n<td>Độ bền</td>\r\n<td>600 TBW</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>K&iacute;ch thước</td>\r\n<td>22 x 80 x 1.5 mm</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Kiểu d&aacute;ng</td>\r\n<td>M.2 2280</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Tốc độ đọc</td>\r\n<td>L&ecirc;n tới 3500Mb/s</td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td>Tốc độ ghi</td>\r\n<td>L&ecirc;n tới 3000Mb/s</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<h2><strong>Đ&aacute;nh gi&aacute; chi tiết&nbsp;SSD Samsung 980 M.2 PCIe NVMe 1TB</strong></h2>\r\n<h3><strong>Hiệu năng vượt trội</strong></h3>\r\n<p>Với chất lượng vượt trội v&agrave; hiệu năng cao. SSD M.2 NVMe Intel&nbsp;l&agrave; một sự lựa chọn tối ưu khi bạn muốn n&acirc;ng cấp ổ cứng. Rất nhanh với tốc độ đọc ghi tuần tự c&oacute; thể l&ecirc;n đến 3500Mb/s v&agrave; 3000Mb/s. Giờ đ&acirc;y mọi thao t&aacute;c tr&ecirc;n m&aacute;y t&iacute;nh của bạn diễn ra một c&aacute;ch nhanh ch&oacute;ng v&agrave; mượt m&agrave; nhất c&oacute; thể. Tăng hiệu năng to&agrave;n bộ của m&aacute;y t&iacute;nh l&ecirc;n rất nhiều.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-nhan-ban-cua-ssd-samsung-980-m-2-pcie-nvme-1tb-01_60b70e4ceba5425d9e88113267de35df_1024x1024.png\"></p>\r\n<h3><strong>Tốc độ truy xuất cao l&ecirc;n&nbsp;đến 3500 Mb/s</strong></h3>\r\n<p>Tốc độ truy xuất nhanh hơn rất nhiều&nbsp;so với ổ cứng th&ocirc;ng thường. SSD&nbsp;hoạt động ở giao diện PCIe NVMe 3.0x4 với&nbsp;k&iacute;ch&nbsp;thước&nbsp;M.2 2280 đem lại&nbsp;tốc độ đọc v&agrave; ghi tuần tự l&ecirc;n đến 3500Mb/s v&agrave; 3000 Mb/s, l&agrave;m cho n&oacute; trở th&agrave;nh người bạn đồng h&agrave;nh ho&agrave;n hảo cho những game thủ muốn n&acirc;ng cấp ổ cứng mới của m&igrave;nh.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-nhan-ban-cua-ssd-samsung-980-m-2-pcie-nvme-1tb-02_36dbb481e3af47bc9f87543abda48957_1024x1024.png\"></p>\r\n<h3><strong>Tiết kiệm điện năng</strong></h3>\r\n<p>Hoạt động mượt m&agrave; với lượng điện năng ti&ecirc;u thụ rất &iacute;t nhằm đảm bảo hiệu suất sử dụng bền bỉ v&agrave; ổn định qua khoảng thời gian d&agrave;i.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-nhan-ban-cua-ssd-samsung-980-m-2-pcie-nvme-1tb-04_0e415aaa7b8f4364a018120ead9d7a23_1024x1024.png\"></p>\r\n<h3><strong>Lời kết :</strong></h3>\r\n<p>Một SSD cao cấp&nbsp;cho tốc độ đọc v&agrave; ghi tuần tự l&ecirc;n đến 3500Mb/s v&agrave; 3000Mb/s đảm bảo mọi hoạt động tr&ecirc;n m&aacute;y t&iacute;nh của bạn được mượt m&agrave; v&agrave; hiệu năng vượt trội đến kinh ngạc. Giờ đ&acirc;y bạn c&oacute; thể tận hưởng qu&aacute; tr&igrave;nh giải tr&iacute;, l&agrave;m việc hay s&aacute;ng tạo m&agrave; kh&ocirc;ng phải lo về thời gian hoạt động của m&aacute;y t&iacute;nh. Lựa chọn SSD n&agrave;y l&agrave; một lựa chọn chuẩn x&aacute;c nhất d&agrave;nh cho bạn.</p>\r\n<p><img src=\"https://file.hstatic.net/1000026716/file/gearvn-nhan-ban-cua-ssd-samsung-980-m-2-pcie-nvme-1tb-03_b58df21e1926421baacbeb7a9c31e16a_1024x1024.png\"></p>', '2690000.00', '2990000.00', 24, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 6, 22, 36, 1, 'images/aNXaiyHRY3ZRCSwrrELPppdcOmMVjWIsWmECTnq8.jpg', '2025-09-04 02:48:25', '2025-09-04 02:48:25', NULL, 0, 0),
(76, 'PC TTG HOME OFFICE Core i3 10105 - RAM 8GB- SSD 256GB', 'WD6045', '<p>&nbsp;</p>\r\n<hr>\r\n<h3>Th&ocirc;ng số kỹ thuật</h3>\r\n<div>\r\n<table style=\"border-collapse: collapse; width: 100.203%; height: 393.222px; border-width: 1px; border-spacing: 0px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"border-width: 1px; width: 3.40699%;\"><strong>STT</strong></td>\r\n<td style=\"border-width: 1px; width: 89.691%;\"><strong>M&ocirc; tả thiết bị</strong></td>\r\n<td style=\"border-width: 1px; width: 2.77313%; text-align: center;\"><strong>SL</strong></td>\r\n<td style=\"border-width: 1px; width: 4.12008%; text-align: center;\"><strong>BH</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"border-width: 1px; width: 3.40699%;\"><strong>1</strong></td>\r\n<td style=\"border-width: 1px; width: 89.691%;\"><strong>CPU Intel Core i3 10105 (Intel LGA1200 - 4 Core - 8 Thread - Base 3.7Ghz - Turbo 4.4Ghz - Cache 6MB)</strong></td>\r\n<td style=\"border-width: 1px; width: 2.77313%; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"border-width: 1px; width: 4.12008%; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"border-width: 1px; width: 3.40699%;\"><strong>2</strong></td>\r\n<td style=\"border-width: 1px; width: 89.691%;\"><strong>Mainboard MSI H510M-B PRO II</strong></td>\r\n<td style=\"border-width: 1px; width: 2.77313%; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"border-width: 1px; width: 4.12008%; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"border-width: 1px; width: 3.40699%;\"><strong>3</strong></td>\r\n<td style=\"border-width: 1px; width: 89.691%;\"><strong>Ram Team VulcanZ 8GB Bus 3200Mhz DDR4</strong></td>\r\n<td style=\"border-width: 1px; width: 2.77313%; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"border-width: 1px; width: 4.12008%; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"border-width: 1px; width: 3.40699%;\"><strong>4</strong></td>\r\n<td style=\"border-width: 1px; width: 89.691%;\"><strong>SSD TEAM CX2 256GB SATA</strong></td>\r\n<td style=\"border-width: 1px; width: 2.77313%; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"border-width: 1px; width: 4.12008%; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"border-width: 1px; width: 3.40699%;\"><strong>5</strong></td>\r\n<td style=\"border-width: 1px; width: 89.691%;\"><strong>Nguồn m&aacute;y t&iacute;nh AIGO VK550 - 500W</strong></td>\r\n<td style=\"border-width: 1px; width: 2.77313%; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"border-width: 1px; width: 4.12008%; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"border-width: 1px; width: 3.40699%;\"><strong>6</strong></td>\r\n<td style=\"border-width: 1px; width: 89.691%;\"><strong>Vỏ Case XIGMATEK XA_22</strong></td>\r\n<td style=\"border-width: 1px; width: 2.77313%; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"border-width: 1px; width: 4.12008%; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"border-width: 1px; width: 3.40699%;\"><strong>7</strong></td>\r\n<td style=\"border-width: 1px; width: 89.691%;\"><strong>Bộ b&agrave;n ph&iacute;m + Chuột Tomato S100</strong></td>\r\n<td style=\"border-width: 1px; width: 2.77313%; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"border-width: 1px; width: 4.12008%; text-align: center;\"><strong>12th</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"border-width: 1px; width: 3.40699%;\"><strong>8</strong></td>\r\n<td style=\"border-width: 1px; width: 89.691%;\"><strong>Tản nhiệt kh&iacute; Jonsbo CR-1200</strong></td>\r\n<td style=\"border-width: 1px; width: 2.77313%; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"border-width: 1px; width: 4.12008%; text-align: center;\"><strong>12th</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 7, 9, 10, 5, 6, 4, 3, 12, 36, 1, 'images/47JcClOTLFBh9CNfkziXSKuCuwdljSgjmgNtJ7IE.jpg', '2025-09-04 13:58:01', '2025-09-17 01:30:50', NULL, 0, 10),
(77, 'PC TTG HOME OFFICE Core i3 10105 - RAM 8GB- SSD 256GB', 'WD5550', '<h3>Th&ocirc;ng số kỹ thuật</h3>\r\n<div>\r\n<table style=\"width: 100.203%; border-collapse: collapse; height: 394.111px; border-width: 1px; border-spacing: 0px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"height: 43.7778px;\">\r\n<td style=\"width: 3.64469%; height: 43.7778px;\"><strong>STT</strong></td>\r\n<td style=\"width: 87.631%; height: 43.7778px;\"><strong>M&ocirc; tả thiết bị</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>SL</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>BH</strong></td>\r\n</tr>\r\n<tr style=\"height: 43.7778px;\">\r\n<td style=\"width: 3.64469%; height: 43.7778px;\"><strong>1</strong></td>\r\n<td style=\"width: 87.631%; height: 43.7778px;\"><strong>CPU Intel Core i3 10105 (Intel LGA1200 - 4 Core - 8 Thread - Base 3.7Ghz - Turbo 4.4Ghz - Cache 6MB)</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>1</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 43.7778px;\">\r\n<td style=\"width: 3.64469%; height: 43.7778px;\"><strong>2</strong></td>\r\n<td style=\"width: 87.631%; height: 43.7778px;\"><strong>Mainboard MSI H510M-B PRO II</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>1</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 43.7778px;\">\r\n<td style=\"width: 3.64469%; height: 43.7778px;\"><strong>3</strong></td>\r\n<td style=\"width: 87.631%; height: 43.7778px;\"><strong>Ram Team VulcanZ 8GB Bus 3200Mhz DDR4</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>1</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 43.7778px;\">\r\n<td style=\"width: 3.64469%; height: 43.7778px;\"><strong>4</strong></td>\r\n<td style=\"width: 87.631%; height: 43.7778px;\"><strong>SSD TEAM CX2 256GB SATA</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>1</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 43.7778px;\">\r\n<td style=\"width: 3.64469%; height: 43.7778px;\"><strong>5</strong></td>\r\n<td style=\"width: 87.631%; height: 43.7778px;\"><strong>Nguồn m&aacute;y t&iacute;nh AIGO VK550 - 500W</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>1</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 43.7778px;\">\r\n<td style=\"width: 3.64469%; height: 43.7778px;\"><strong>6</strong></td>\r\n<td style=\"width: 87.631%; height: 43.7778px;\"><strong>Vỏ Case XIGMATEK XA_22</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>1</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 43.7778px;\">\r\n<td style=\"width: 3.64469%; height: 43.7778px;\"><strong>7</strong></td>\r\n<td style=\"width: 87.631%; height: 43.7778px;\"><strong>Bộ b&agrave;n ph&iacute;m + Chuột Tomato S100</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>1</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.7778px;\"><strong>12th</strong></td>\r\n</tr>\r\n<tr style=\"height: 43.8889px;\">\r\n<td style=\"width: 3.64469%; height: 43.8889px;\"><strong>8</strong></td>\r\n<td style=\"width: 87.631%; height: 43.8889px;\"><strong>M&agrave;n h&igrave;nh Dark Flash G243FW (23.8 inch/FHD/IPS/100Hz/5ms)</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.8889px;\"><strong>1</strong></td>\r\n<td style=\"width: 4.35778%; text-align: center; height: 43.8889px;\"><strong>24th</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 7, 9, 10, 5, 1, 4, 3, 2, 36, 1, 'images/i8uZDt7GwKzObuNStGGIQhk3FjF6ZGvnWVvKlm7B.jpg', '2025-09-04 14:12:01', '2025-09-17 01:31:10', NULL, 1, 11),
(78, 'PC TTG HOME OFFICE Core i5 12400 - RAM 16GB- SSD 256GB- Kèm Màn hình', 'WD9531', '<h3>Th&ocirc;ng số kỹ thuật</h3>\r\n<div>\r\n<table style=\"border-collapse: collapse; border-width: 1px; border-spacing: 0px; width: 100.203%; height: 403px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"height: 22.3889px;\">\r\n<td style=\"width: 4.83234%; height: 22.3889px; border-width: 1px;\"><strong>STT</strong></td>\r\n<td style=\"width: 85.8887%; height: 22.3889px; border-width: 1px;\"><strong>M&ocirc; tả thiết bị</strong></td>\r\n<td style=\"width: 3.72392%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>SL</strong></td>\r\n<td style=\"width: 5.54626%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>BH</strong></td>\r\n</tr>\r\n<tr style=\"height: 44.7778px;\">\r\n<td style=\"width: 4.83234%; height: 44.7778px; border-width: 1px;\"><strong>1</strong></td>\r\n<td style=\"width: 85.8887%; height: 44.7778px; border-width: 1px;\"><strong>CPU Intel Core i5 12400 (Intel LGA1700 - 6 Core - 12 Thread - Base 2.5Ghz - Turbo 4.4Ghz - Cache 18MB)</strong></td>\r\n<td style=\"width: 3.72392%; height: 44.7778px; border-width: 1px; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"width: 5.54626%; height: 44.7778px; border-width: 1px; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 22.3889px;\">\r\n<td style=\"width: 4.83234%; height: 22.3889px; border-width: 1px;\"><strong>2</strong></td>\r\n<td style=\"width: 85.8887%; height: 22.3889px; border-width: 1px;\"><strong>Mainboard ASROCK H610M-H M.2 DDR4</strong></td>\r\n<td style=\"width: 3.72392%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"width: 5.54626%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 22.3889px;\">\r\n<td style=\"width: 4.83234%; height: 22.3889px; border-width: 1px;\"><strong>3</strong></td>\r\n<td style=\"width: 85.8887%; height: 22.3889px; border-width: 1px;\"><strong>Ram Geil Spear EVO 16GB Bus 3200Mhz DDR4</strong></td>\r\n<td style=\"width: 3.72392%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"width: 5.54626%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 22.3889px;\">\r\n<td style=\"width: 4.83234%; height: 22.3889px; border-width: 1px;\"><strong>4</strong></td>\r\n<td style=\"width: 85.8887%; height: 22.3889px; border-width: 1px;\"><strong>SSD TEAM CX2 256GB SATA</strong></td>\r\n<td style=\"width: 3.72392%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"width: 5.54626%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 22.3889px;\">\r\n<td style=\"width: 4.83234%; height: 22.3889px; border-width: 1px;\"><strong>5</strong></td>\r\n<td style=\"width: 85.8887%; height: 22.3889px; border-width: 1px;\"><strong>Nguồn m&aacute;y t&iacute;nh AIGO VK550 - 500W</strong></td>\r\n<td style=\"width: 3.72392%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"width: 5.54626%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 22.3889px;\">\r\n<td style=\"width: 4.83234%; height: 22.3889px; border-width: 1px;\"><strong>6</strong></td>\r\n<td style=\"width: 85.8887%; height: 22.3889px; border-width: 1px;\"><strong>Vỏ Case XIGMATEK XA_22</strong></td>\r\n<td style=\"width: 3.72392%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"width: 5.54626%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>36th</strong></td>\r\n</tr>\r\n<tr style=\"height: 22.3889px;\">\r\n<td style=\"width: 4.83234%; height: 22.3889px; border-width: 1px;\"><strong>7</strong></td>\r\n<td style=\"width: 85.8887%; height: 22.3889px; border-width: 1px;\"><strong>Bộ b&agrave;n ph&iacute;m + Chuột Tomato S100</strong></td>\r\n<td style=\"width: 3.72392%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"width: 5.54626%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>12th</strong></td>\r\n</tr>\r\n<tr style=\"height: 22.3889px;\">\r\n<td style=\"width: 4.83234%; height: 22.3889px; border-width: 1px;\"><strong>8</strong></td>\r\n<td style=\"width: 85.8887%; height: 22.3889px; border-width: 1px;\"><strong>Tản nhiệt kh&iacute; Jonsbo CR-1200</strong></td>\r\n<td style=\"width: 3.72392%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"width: 5.54626%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>12th</strong></td>\r\n</tr>\r\n<tr style=\"height: 22.3889px;\">\r\n<td style=\"width: 4.83234%; height: 22.3889px; border-width: 1px;\"><strong>9</strong></td>\r\n<td style=\"width: 85.8887%; height: 22.3889px; border-width: 1px;\"><strong>M&agrave;n h&igrave;nh Dark Flash G243FW (23.8 inch/FHD/IPS/100Hz/5ms)</strong></td>\r\n<td style=\"width: 3.72392%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>1</strong></td>\r\n<td style=\"width: 5.54626%; height: 22.3889px; border-width: 1px; text-align: center;\"><strong>24th</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n</div>', NULL, NULL, 0, NULL, 1, 1, 1, 10, 5, 6, 4, 3, 2, 35, 1, 'images/LbYCYpENGpdogpL9n1hGIZOAfwy7KxCbQUkwNgj3.jpg', '2025-09-04 14:25:11', '2025-09-17 01:26:49', NULL, 0, 10);
INSERT INTO `san_phams` (`id`, `ten`, `ma_san_pham`, `mo_ta`, `gia`, `gia_so_sanh`, `so_luong`, `sku`, `co_bien_the`, `id_chip`, `id_mainboard`, `id_gpu`, `id_tannhiet`, `id_case`, `id_nguon`, `id_category`, `id_brand`, `bao_hanh_thang`, `hoat_dong`, `anh_dai_dien`, `created_at`, `updated_at`, `deleted_at`, `luot_mua`, `luot_xem`) VALUES
(79, 'PC AMD GAMING SUPER LUXURY RYZEN 9 9950X3D - RTX 5090 32GB OC Edition (All NEW - Bảo hành 36 tháng)', 'WD9005', '<h3>Th&ocirc;ng số kỹ thuật</h3>\r\n<div>\r\n<table class=\"table table-bordered\" style=\"width: 100.044%; height: 495.778px;\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\" style=\"height: 44.7778px;\">\r\n<td style=\"width: 11.1541%; height: 44.7778px;\"><strong><a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a></strong></td>\r\n<td style=\"width: 80.7682%; height: 44.7778px;\"><strong>Mainboard Asus ROG STRIX X870E-E Gaming Wifi DDR5</strong></td>\r\n<td style=\"width: 8.06891%; height: 44.7778px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\" style=\"height: 44.7778px;\">\r\n<td style=\"width: 11.1541%; height: 44.7778px;\"><strong><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a></strong></td>\r\n<td style=\"width: 80.7682%; height: 44.7778px;\"><strong>CPU AMD Ryzen 9 9950X3D (16 nh&acirc;n 32 luồng , 4.3GHz up to 5.7GHz, 144MB Cache)</strong></td>\r\n<td style=\"width: 8.06891%; height: 44.7778px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\" style=\"height: 44.7778px;\">\r\n<td style=\"width: 11.1541%; height: 44.7778px;\"><strong><a href=\"https://gearvn.com/collections/ram-pc\">RAM</a></strong></td>\r\n<td style=\"width: 80.7682%; height: 44.7778px;\"><strong>Ram G.SKILL Trident Z5 RGB 64GB(32GBx2) BUS 6000MHz DDR5</strong></td>\r\n<td style=\"width: 8.06891%; height: 44.7778px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\" style=\"height: 44.7778px;\">\r\n<td style=\"width: 11.1541%; height: 44.7778px;\"><strong><a href=\"https://gearvn.com/collections/vga-card-man-hinh\">VGA</a>&nbsp;</strong></td>\r\n<td style=\"width: 80.7682%; height: 44.7778px;\"><strong>Card m&agrave;n h&igrave;nh ASUS ROG Astral GeForce RTX 5090 32GB GDDR7 OC Edition</strong></td>\r\n<td style=\"width: 8.06891%; height: 44.7778px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\" style=\"height: 44.7778px;\">\r\n<td style=\"width: 11.1541%; height: 44.7778px;\"><strong>HDD</strong></td>\r\n<td style=\"width: 80.7682%; height: 44.7778px;\"><strong>C&oacute; thể t&ugrave;y chọn&nbsp;<a title=\"https://gearvn.com/collections/hdd-o-cung-pc\" href=\"https://gearvn.com/collections/hdd-o-cung-pc\">N&acirc;ng cấp</a></strong></td>\r\n<td style=\"width: 8.06891%; height: 44.7778px;\"><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\" style=\"height: 44.7778px;\">\r\n<td style=\"width: 11.1541%; height: 44.7778px;\"><strong><a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a></strong></td>\r\n<td style=\"width: 80.7682%; height: 44.7778px;\"><strong><a href=\"https://gearvn.com/products/o-cung-ssd-kingston-nv3-500gb-m-2-pcie-nvme-gen4\">Ổ cứng SSD Samsung 990 PRO 2TB M.2 NVMe M.2 2280 PCIe Gen4.0 x4</a></strong></td>\r\n<td style=\"width: 8.06891%; height: 44.7778px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\" style=\"height: 44.7778px;\">\r\n<td style=\"width: 11.1541%; height: 44.7778px;\"><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a></strong></td>\r\n<td style=\"width: 80.7682%; height: 44.7778px;\"><strong>Nguồn m&aacute;y t&iacute;nh SuperFlower Leadex VII PRO 1200W ATX3.1 80 Plus Platinum SF-1200F14XP</strong></td>\r\n<td style=\"width: 8.06891%; height: 44.7778px;\"><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\" style=\"height: 44.7778px;\">\r\n<td style=\"width: 11.1541%; height: 44.7778px;\"><strong><a href=\"https://gearvn.com/collections/case-thung-may-tinh\">Case</a></strong></td>\r\n<td style=\"width: 80.7682%; height: 44.7778px;\"><strong>VỎ CASE HYTE Y70 - BLACK (ATX/MID TOWER/M&Agrave;U ĐEN)</strong></td>\r\n<td style=\"width: 8.06891%; height: 44.7778px;\"><strong>12 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr style=\"height: 92.7778px;\">\r\n<td style=\"width: 11.1541%; height: 92.7778px;\"><strong>&nbsp;</strong></td>\r\n<td style=\"width: 80.7682%; height: 92.7778px;\">\r\n<p><strong>Phụ kiện Fan Case JONSBO ZA-360 ARGB BLACK&nbsp;&nbsp;</strong></p>\r\n<p><strong>D&acirc;y nguồn nối d&agrave;i Lian Li Strimer Plus 24 Pin ARGB</strong></p>\r\n</td>\r\n<td style=\"width: 8.06891%; height: 92.7778px;\"><strong>12 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr style=\"height: 44.7778px;\">\r\n<td style=\"width: 11.1541%; height: 44.7778px;\"><strong>Tản nhiệt</strong></td>\r\n<td style=\"width: 80.7682%; height: 44.7778px;\"><strong>TẢN NHIỆT NƯỚC TRYX PANORAMA ARGB 360 (M&agrave;n AMOLED 6.5/Bơm ASETEK 8)</strong></td>\r\n<td style=\"width: 8.06891%; height: 44.7778px;\"><strong>24 Th&aacute;ng</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 8, 10, 11, 6, 7, 6, 1, 1, 36, 1, 'images/Y8zoQqS7u8G5SDXxLToywOkU8SAHyZkitm9blyzM.jpg', '2025-09-04 14:46:18', '2025-09-17 01:17:22', NULL, 2, 22),
(80, 'PC TTG SUPER LUXURY ULTRA 7 265KF - RTX 5080 16GB OC WHITE (ALL NEW - Bảo hành 36 tháng)', 'WD4320', '<h3><strong>TH&Ocirc;NG SỐ KỸ THUẬT</strong></h3>\r\n<div>\r\n<table class=\"table table-bordered\" border=\"1\" cellspacing=\"0\">\r\n<tbody>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/mainboard-bo-mach-chu\">Mainboard</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/bo-mach-chu-msi-z790-gaming-plus-wifi-ddr5\">Mainboard ASUS Z890-P PRIME CSM DDR5</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/cpu-bo-vi-xu-ly\">CPU</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/bo-vi-xu-ly-intel-core-i7-14700f\">CPU Intel Core Ultra 7 265KF (Up to 5.5GHz , 20 nh&acirc;n - 20 luồng ,30MB Cache, Arrow Lake -S) - TRAY</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/ram-pc\">RAM</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/ram-corsair-vengeance-rgb-32gb-2x16gb-5600-ddr5-cmh32gx5m2b5600c40k\">RAM GSKILL RIPJAWS M5 32GB/6000Mhz (2x16GB) DDR5</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/vga-card-man-hinh\">VGA</a>&nbsp;</strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/card-man-hinh-gigabyte-geforce-rtx-5060-ti-windforce-oc-8gb\">Card M&agrave;n H&igrave;nh Colorful IGame GeForce RTX 5080 Ultra W OC 16GB GDDR7</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong>HDD</strong></td>\r\n<td><strong>C&oacute; thể t&ugrave;y chọn&nbsp;<a title=\"https://gearvn.com/collections/hdd-o-cung-pc\" href=\"https://gearvn.com/collections/hdd-o-cung-pc\">N&acirc;ng cấp</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/ssd-o-cung-the-ran\">SSD</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/o-cung-ssd-kingston-nv3-500gb-m-2-pcie-nvme-gen4\">Ổ cứng KIOXIA PLUS G3 1TB NVME M2 PCIE GEn4</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/psu-nguon-may-tinh\">PSU</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/nguon-may-tinh-cooler-master-mwe-750-80-plus-bronze-v3-230v-750w\">Nguồn m&aacute;y t&iacute;nh Darkflash PMT850 850W ( ATX3.1 &amp; PCIe 5.1, 80 Plus Gold, Full Modular )</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr class=\"row-info\">\r\n<td><strong><a href=\"https://gearvn.com/collections/case-thung-may-tinh\">Case</a></strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/vo-may-tinh-cooler-master-cd600-black\">Vỏ Case ANTEC C8 WHITE - Case Bể c&aacute;</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Tản nhiệt</strong></td>\r\n<td><strong><a href=\"https://gearvn.com/products/tan-nhiet-aio-cooler-master-masterliquid-360-core-si-argb\">Tản nhiệt nước Thermalright HYPER VISION 360 WHITE ARGB</a></strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>&nbsp;</strong></td>\r\n<td><strong>Dựng VGA Cooler + D&acirc;y nguồn bọc lưới 24 PIN</strong></td>\r\n<td><strong>36 Th&aacute;ng</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', NULL, NULL, 0, NULL, 1, 9, 10, 12, 6, 7, 3, 1, 1, 36, 1, 'images/gN37reOnODSjBkhGZvKAVJHNW4q7iMiNFrNLVTSY.jpg', '2025-09-04 15:08:30', '2025-09-17 01:02:53', NULL, 1, 7),
(81, 'pdc4444', 'WD5164', '<p>yiikyyk</p>', '99999999999.00', '9999999999999.00', 9999999, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 4, 8, 12, 1, 'images/IOrnOtmfXbi1HNKtf1IlgFMYTYqGDHj1pSI9af24.jpg', '2025-09-16 15:47:44', '2025-09-16 15:48:19', '2025-09-16 15:48:19', 0, 0);

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
('CG06C2vUEwiEF9Vu2u7thtetopCnjuYlnstQ6tRZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib0RGVUM5UVlDUU1kSzhOMFpaMWtmSVpKRG92bHEwS2dJdVNGTEVaayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zYW5waGFtP3BhZ2U9MSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1758072932);

-- --------------------------------------------------------

--
-- Table structure for table `su_kiens`
--

CREATE TABLE `su_kiens` (
  `id` bigint UNSIGNED NOT NULL,
  `ten_su_kien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hien_thi` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Hiển thị, 0: Ẩn',
  `ngay_bat_dau` datetime NOT NULL,
  `ngay_ket_thuc` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `su_kiens`
--

INSERT INTO `su_kiens` (`id`, `ten_su_kien`, `hien_thi`, `ngay_bat_dau`, `ngay_ket_thuc`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Sale', 1, '2025-08-18 17:55:00', '2025-09-11 17:55:00', NULL, '2025-07-30 11:01:55', '2025-09-08 01:32:49'),
(4, 'test', 1, '2025-08-24 11:23:00', '2025-08-27 11:23:00', NULL, '2025-08-24 04:24:10', '2025-08-24 04:24:10'),
(5, 'Sale1', 1, '2025-09-05 11:29:00', '2025-09-10 11:29:00', NULL, '2025-09-05 04:30:33', '2025-09-05 04:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `su_kien_san_phams`
--

CREATE TABLE `su_kien_san_phams` (
  `id` bigint UNSIGNED NOT NULL,
  `id_su_kien` bigint UNSIGNED NOT NULL,
  `id_san_pham` bigint UNSIGNED DEFAULT NULL,
  `id_bien_the_san_pham` bigint UNSIGNED DEFAULT NULL,
  `gia_su_kien` decimal(12,2) NOT NULL,
  `gia_goc` decimal(12,2) DEFAULT NULL,
  `so_luong_gioi_han` int DEFAULT NULL,
  `hien_thi` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Hiển thị, 0: Ẩn',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gia_goc_khi_bat_dau` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `su_kien_san_phams`
--

INSERT INTO `su_kien_san_phams` (`id`, `id_su_kien`, `id_san_pham`, `id_bien_the_san_pham`, `gia_su_kien`, `gia_goc`, `so_luong_gioi_han`, `hien_thi`, `created_at`, `updated_at`, `gia_goc_khi_bat_dau`) VALUES
(64, 4, 2, NULL, '6990000.00', '7990000.00', 1, 1, '2025-08-26 09:28:43', '2025-08-26 09:28:43', '7990000.00'),
(65, 4, 3, NULL, '6990000.00', '8990000.00', 5, 1, '2025-08-26 09:28:43', '2025-08-26 09:28:43', '8990000.00'),
(66, 4, NULL, 3, '25430000.00', '35430000.00', 2, 1, '2025-08-26 09:28:43', '2025-08-26 09:28:43', '35430000.00'),
(79, 5, 2, NULL, '599999.00', '7990000.00', 5, 1, '2025-09-05 04:30:33', '2025-09-05 04:30:33', '7990000.00'),
(80, 5, 4, NULL, '6999999.00', '7990000.00', 7, 1, '2025-09-05 04:30:33', '2025-09-05 04:30:33', '7990000.00'),
(81, 5, NULL, 2, '1000000.00', '27020000.00', 9, 1, '2025-09-05 04:30:33', '2025-09-05 04:30:33', '27020000.00'),
(82, 5, NULL, 4, '2000000.00', '36920000.00', 5, 1, '2025-09-05 04:30:33', '2025-09-05 04:30:33', '36920000.00'),
(83, 3, 1, NULL, '7770000.00', '8880000.00', 3, 1, '2025-09-08 01:32:49', '2025-09-08 01:32:49', '8880000.00'),
(84, 3, 2, NULL, '6990000.00', '7990000.00', 3, 1, '2025-09-08 01:32:49', '2025-09-08 01:32:49', '7990000.00'),
(85, 3, 3, NULL, '8880000.00', '8990000.00', 3, 1, '2025-09-08 01:32:49', '2025-09-08 01:32:49', '8990000.00'),
(86, 3, NULL, 1, '23150000.00', '26120000.00', NULL, 1, '2025-09-08 01:32:49', '2025-09-08 01:32:49', '26120000.00'),
(87, 3, NULL, 3, '32430000.00', '35430000.00', NULL, 1, '2025-09-08 01:32:49', '2025-09-08 01:32:49', '35430000.00'),
(88, 3, NULL, 4, '33920000.00', '36920000.00', 2, 1, '2025-09-08 01:32:49', '2025-09-08 01:32:49', '36920000.00');

-- --------------------------------------------------------

--
-- Table structure for table `tan_nhiets`
--

CREATE TABLE `tan_nhiets` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `gia_sale` decimal(10,2) DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tan_nhiets`
--

INSERT INTO `tan_nhiets` (`id`, `ten`, `gia`, `gia_sale`, `mo_ta`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tản nhiệt Cooler Master Hyper 212 Spectrum V3 ARGB', '990000.00', '390000.00', NULL, '2025-08-20 00:50:36', '2025-08-20 00:50:36', NULL),
(2, 'Tản nhiệt AIO MSI MAG CORELIQUID I240 WHITE', '3190000.00', '2990000.00', NULL, '2025-08-20 08:14:36', '2025-08-20 08:14:36', NULL),
(3, 'Tản nhiệt AIO Cooler Master MasterLiquid 360 Core SI ARGB', '1890000.00', NULL, NULL, '2025-08-21 02:38:16', '2025-08-21 02:38:16', NULL),
(4, 'Tản nhiệt AIO MSI MAG CORELIQUID I360 BLACK', '4990000.00', '3990000.00', NULL, '2025-08-21 03:15:33', '2025-08-21 03:15:33', NULL),
(5, 'Tản nhiệt khí Jonsbo CR-1200', '400000.00', '299000.00', NULL, '2025-09-04 13:50:06', '2025-09-04 13:50:06', NULL),
(6, 'TẢN NHIỆT NƯỚC TRYX PANORAMA ARGB 360 (Màn AMOLED 6.5/Bơm ASETEK 8)', '9890000.00', '9790000.00', NULL, '2025-09-04 14:31:29', '2025-09-04 14:31:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thuong_hieus`
--

CREATE TABLE `thuong_hieus` (
  `id` bigint UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thuong_hieus`
--

INSERT INTO `thuong_hieus` (`id`, `ten`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ASUS', '2025-07-29 14:27:22', '2025-07-29 14:27:22', NULL),
(2, 'Gigabyte', '2025-07-29 15:08:54', '2025-07-29 15:08:54', NULL),
(3, 'MSI', '2025-08-21 03:16:04', '2025-08-21 03:16:04', NULL),
(4, 'TUF', '2025-08-21 03:23:34', '2025-08-21 03:23:34', NULL),
(5, 'RAZER', '2025-08-21 03:24:03', '2025-08-21 03:24:03', NULL),
(6, 'ViewSonic', '2025-08-21 03:31:24', '2025-08-21 03:31:24', NULL),
(7, 'LG', '2025-08-21 03:31:37', '2025-08-21 03:31:37', NULL),
(8, 'Acer', '2025-08-21 03:31:51', '2025-08-21 03:31:51', NULL),
(9, 'AKKO', '2025-08-25 02:14:12', '2025-08-25 02:14:12', NULL),
(10, 'Leobog', '2025-08-25 02:14:34', '2025-08-25 02:14:34', NULL),
(11, 'AULA', '2025-08-25 02:14:47', '2025-08-25 02:14:47', NULL),
(12, 'Intel', '2025-09-02 10:55:21', '2025-09-02 10:55:21', NULL),
(13, 'AMD Ryzen', '2025-09-02 12:22:51', '2025-09-02 12:22:51', NULL),
(14, 'Cooler Master', '2025-09-02 13:04:14', '2025-09-02 13:04:14', NULL),
(15, 'V-Color', '2025-09-04 00:49:02', '2025-09-04 00:49:02', NULL),
(16, 'G.Skill', '2025-09-04 00:49:19', '2025-09-04 00:49:19', NULL),
(17, 'Dominator Titanium', '2025-09-04 00:49:50', '2025-09-04 00:50:12', NULL),
(18, 'Vengeance', '2025-09-04 00:50:17', '2025-09-04 00:50:17', NULL),
(19, 'TeamGroup', '2025-09-04 00:50:46', '2025-09-04 00:50:46', NULL),
(20, 'Western Digital', '2025-09-04 01:13:44', '2025-09-04 01:13:44', NULL),
(21, 'Seagate', '2025-09-04 01:14:23', '2025-09-04 01:14:23', NULL),
(22, 'Samsung', '2025-09-04 02:34:43', '2025-09-04 02:34:43', NULL),
(23, 'Kingston', '2025-09-04 02:40:02', '2025-09-04 02:40:02', NULL),
(24, 'a', '2025-09-05 04:40:07', '2025-09-05 04:40:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ten_dang_nhap`, `email`, `email_verified_at`, `password`, `ho_ten`, `so_dien_thoai`, `vai_tro`, `trang_thai`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ADMIN', 'longthph53584@gmail.com', NULL, '$2y$12$W1rCU4fU1qfqnNO1cmpYyuA3gNKXDKaY5nvywlppQbF9nn9FMyzYe', 'H L', '0379354506', 'quan_tri', 'hoat_dong', NULL, '2025-07-28 15:02:24', '2025-07-28 15:02:24', NULL),
(2, 'Userrrr', 'longcfmlq1234@gmail.com', NULL, '$2y$12$dHwM4ufp7ilnbweHDmLLm.LyO2mugX1Xs7XE2th0H7A6NgU0TOQ7y', 'H L A', '08797867676', 'khach_hang', 'hoat_dong', NULL, '2025-08-27 02:10:14', '2025-08-27 02:10:14', NULL),
(3, 'XXVVZZ_H_V', 'longsdhg1234@gmail.com', NULL, '$2y$12$NW36cWNVHGxGAnZWDmhCheF0RfFD5ksbIfpOpoyLolusl7FLVjzxe', 'Hải Phi', '0987653421', 'khach_hang', 'hoat_dong', NULL, '2025-09-03 15:23:46', '2025-09-03 15:23:46', NULL),
(4, 'DDung', 'DanhdungHSG1923@gmail.com', NULL, '$2y$12$WAqpA4KwbnwTEgSIUrVOEe9pbt1kj99F2IRFylyN5fNKEWRw7GDd2', 'Dũng Hải', '09764424423', 'khach_hang', 'hoat_dong', NULL, '2025-09-04 00:41:30', '2025-09-04 00:41:30', NULL),
(5, 'Lucy03', 'HoangHSG1923@gmail.com', NULL, '$2y$12$vjJEIxuxFuV5V8rcM9yy4OThg0yP3WLrQEbG/hqWGTVq2CaMLmFKi', 'Nguyễn Hải Hoàng', '09765445678', 'khach_hang', 'hoat_dong', NULL, '2025-09-04 03:04:04', '2025-09-04 03:04:04', NULL),
(6, 'edmon', 'dungxnd479@gmail.com', NULL, '$2y$12$3i.1cxMJlOw2Jtl3SC91je.MwVft/gVmjpNluRTsrGpc.rgkMp2g6', 'Hải Phi', '09876534219', 'khach_hang', 'hoat_dong', NULL, '2025-09-05 03:17:01', '2025-09-05 03:17:01', NULL),
(7, 'uSER', 'DanhDdungHSG1923@gmail.com', NULL, '$2y$12$C3ihMK2o0MeigzxE3P9wuuZK5TEfGi4I4dftrRmfq8drsljyk3sLy', 'Dũng Hải p', '0123456743', 'khach_hang', 'hoat_dong', NULL, '2025-09-06 14:59:11', '2025-09-06 14:59:11', NULL);

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
  `thoi_gian_tra_hang` datetime DEFAULT NULL,
  `thoi_gian_nhan_hang` datetime DEFAULT NULL,
  `thoi_gian_hoan_tien` datetime DEFAULT NULL,
  `trang_thai` enum('cho_phe_duyet','da_phe_duyet','tu_choi','dang_van_chuyen_tra_hang','da_nhan_hang','da_hoan_tien') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cho_phe_duyet',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_hoan_tra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_nguoi_hoan_tien` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yeu_cau_hoan_tra`
--

INSERT INTO `yeu_cau_hoan_tra` (`id`, `id_don_hang`, `ma_hoan_tra`, `sdt_lien_he`, `phuong_thuc_hoan_tien`, `ten_ngan_hang`, `so_tai_khoan`, `ten_chu_tai_khoan`, `ly_do`, `thoi_gian_tra_hang`, `thoi_gian_nhan_hang`, `thoi_gian_hoan_tien`, `trang_thai`, `created_at`, `updated_at`, `admin_hoan_tra`, `id_nguoi_hoan_tien`) VALUES
(1, 13, 'HT077285', '0987653421', 'momo', NULL, '09654321356789', 'Hải Phi', 'Hàng bị lỗi', '2025-09-04 07:25:33', '2025-09-04 07:25:45', '2025-09-04 07:25:59', 'da_hoan_tien', '2025-09-04 00:24:54', '2025-09-04 00:25:59', 'ADMIN', 1),
(2, 17, 'HT462709', '0987653421', 'momo', NULL, '078776523456789', 'Dung Hai', 'sản phẩm không đc như mong muốn', NULL, NULL, NULL, 'cho_phe_duyet', '2025-09-04 03:02:30', '2025-09-04 03:02:30', NULL, NULL),
(3, 25, 'HT086711', '0987653421', 'momo', NULL, '078776523456789', 'Hải Phi', 'ôimooono', '2025-09-04 22:25:42', '2025-09-04 22:25:52', '2025-09-04 22:26:06', 'da_hoan_tien', '2025-09-04 15:24:52', '2025-09-04 15:26:06', 'ADMIN', 1),
(4, 30, 'HT302922', '123456789', 'momo', 'MB Bank', '123456789', 'nva', 'âbc', '2025-09-05 11:24:29', '2025-09-05 11:24:45', '2025-09-05 11:25:12', 'da_hoan_tien', '2025-09-05 04:23:35', '2025-09-05 04:25:12', 'ADMIN', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anh_minh_chungs`
--
ALTER TABLE `anh_minh_chungs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anh_minh_chungs_id_yeu_cau_hoan_tra_foreign` (`id_yeu_cau_hoan_tra`);

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
-- Indexes for table `chat_histories`
--
ALTER TABLE `chat_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_histories_user_id_foreign` (`user_id`);

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
  ADD KEY `chi_tiet_gio_hangs_id_product_foreign` (`id_product`),
  ADD KEY `chi_tiet_gio_hangs_id_bien_the_foreign` (`id_bien_the`);

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
ALTER TABLE `danh_mucs` ADD FULLTEXT KEY `ten` (`ten`);

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
  ADD KEY `don_hangs_id_phuong_thuc_thanh_toan_foreign` (`id_phuong_thuc_thanh_toan`);

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
-- Indexes for table `ma_giam_gia_users`
--
ALTER TABLE `ma_giam_gia_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_giam_gia_users_ma_giam_gia_id_user_id_unique` (`ma_giam_gia_id`,`user_id`),
  ADD KEY `ma_giam_gia_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
  ADD KEY `san_phams_id_tannhiet_foreign` (`id_tannhiet`),
  ADD KEY `san_phams_id_case_foreign` (`id_case`),
  ADD KEY `san_phams_id_nguon_foreign` (`id_nguon`),
  ADD KEY `san_phams_id_category_foreign` (`id_category`),
  ADD KEY `san_phams_id_brand_foreign` (`id_brand`);
ALTER TABLE `san_phams` ADD FULLTEXT KEY `ten` (`ten`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `su_kiens`
--
ALTER TABLE `su_kiens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `su_kien_san_phams`
--
ALTER TABLE `su_kien_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `su_kien_san_phams_id_su_kien_foreign` (`id_su_kien`),
  ADD KEY `su_kien_san_phams_id_san_pham_foreign` (`id_san_pham`),
  ADD KEY `su_kien_san_phams_id_bien_the_san_pham_foreign` (`id_bien_the_san_pham`);

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
  ADD KEY `yeu_cau_hoan_tra_admin_hoan_tra_foreign` (`admin_hoan_tra`),
  ADD KEY `yeu_cau_hoan_tra_id_nguoi_hoan_tien_foreign` (`id_nguoi_hoan_tien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anh_minh_chungs`
--
ALTER TABLE `anh_minh_chungs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `anh_san_phams`
--
ALTER TABLE `anh_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bien_the_san_phams`
--
ALTER TABLE `bien_the_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat_histories`
--
ALTER TABLE `chat_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chips`
--
ALTER TABLE `chips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `danh_gia_san_phams`
--
ALTER TABLE `danh_gia_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dia_chi_nguoi_dungs`
--
ALTER TABLE `dia_chi_nguoi_dungs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ma_giam_gia_users`
--
ALTER TABLE `ma_giam_gia_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `nguons`
--
ALTER TABLE `nguons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nhat_ky_ton_khos`
--
ALTER TABLE `nhat_ky_ton_khos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o_cungs`
--
ALTER TABLE `o_cungs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rams`
--
ALTER TABLE `rams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `su_kiens`
--
ALTER TABLE `su_kiens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `su_kien_san_phams`
--
ALTER TABLE `su_kien_san_phams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tan_nhiets`
--
ALTER TABLE `tan_nhiets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `thuong_hieus`
--
ALTER TABLE `thuong_hieus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `yeu_cau_hoan_tra`
--
ALTER TABLE `yeu_cau_hoan_tra`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anh_minh_chungs`
--
ALTER TABLE `anh_minh_chungs`
  ADD CONSTRAINT `anh_minh_chungs_id_yeu_cau_hoan_tra_foreign` FOREIGN KEY (`id_yeu_cau_hoan_tra`) REFERENCES `yeu_cau_hoan_tra` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `chat_histories`
--
ALTER TABLE `chat_histories`
  ADD CONSTRAINT `chat_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `danh_gia_san_phams_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `danh_gia_san_phams_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `ma_giam_gia_users`
--
ALTER TABLE `ma_giam_gia_users`
  ADD CONSTRAINT `ma_giam_gia_users_ma_giam_gia_id_foreign` FOREIGN KEY (`ma_giam_gia_id`) REFERENCES `ma_giam_gias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ma_giam_gia_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `san_phams_id_case_foreign` FOREIGN KEY (`id_case`) REFERENCES `cases` (`id`),
  ADD CONSTRAINT `san_phams_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `danh_mucs` (`id`),
  ADD CONSTRAINT `san_phams_id_chip_foreign` FOREIGN KEY (`id_chip`) REFERENCES `chips` (`id`),
  ADD CONSTRAINT `san_phams_id_gpu_foreign` FOREIGN KEY (`id_gpu`) REFERENCES `gpus` (`id`),
  ADD CONSTRAINT `san_phams_id_mainboard_foreign` FOREIGN KEY (`id_mainboard`) REFERENCES `mainboards` (`id`),
  ADD CONSTRAINT `san_phams_id_nguon_foreign` FOREIGN KEY (`id_nguon`) REFERENCES `nguons` (`id`),
  ADD CONSTRAINT `san_phams_id_tannhiet_foreign` FOREIGN KEY (`id_tannhiet`) REFERENCES `tan_nhiets` (`id`);

--
-- Constraints for table `su_kien_san_phams`
--
ALTER TABLE `su_kien_san_phams`
  ADD CONSTRAINT `su_kien_san_phams_id_bien_the_san_pham_foreign` FOREIGN KEY (`id_bien_the_san_pham`) REFERENCES `bien_the_san_phams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `su_kien_san_phams_id_san_pham_foreign` FOREIGN KEY (`id_san_pham`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `su_kien_san_phams_id_su_kien_foreign` FOREIGN KEY (`id_su_kien`) REFERENCES `su_kiens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `yeu_cau_hoan_tra`
--
ALTER TABLE `yeu_cau_hoan_tra`
  ADD CONSTRAINT `yeu_cau_hoan_tra_admin_hoan_tra_foreign` FOREIGN KEY (`admin_hoan_tra`) REFERENCES `users` (`ten_dang_nhap`) ON DELETE SET NULL,
  ADD CONSTRAINT `yeu_cau_hoan_tra_id_nguoi_hoan_tien_foreign` FOREIGN KEY (`id_nguoi_hoan_tien`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
