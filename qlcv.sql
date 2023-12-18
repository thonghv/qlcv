-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 02:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlcv`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2017_03_10_111653_create_todo_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'Y5vQQr1LLgCb5bc44Q9dkTMvr1LdRhRUuWAaKpAk', 'http://localhost', 1, 0, 0, '2017-11-28 02:36:07', '2017-11-28 02:36:07'),
(2, NULL, 'Laravel Password Grant Client', 'GlVbX3zxNMDkOu9kSBrqq5SWvxIWZK8GVu84rHNN', 'http://localhost', 0, 1, 0, '2017-11-28 02:36:07', '2017-11-28 02:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-11-28 02:36:07', '2017-11-28 02:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hai.nguyen@benhvienbinhdinh.com.vn', '$2y$10$Xm3t5M7tTan0wylIs/JY4u5Sk14EY3yn7HKG6ZP0ef/XOQ.surW.K', '2017-11-29 23:38:18');

-- --------------------------------------------------------

--
-- Table structure for table `task_detail`
--

CREATE TABLE `task_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_todo` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content_task` varchar(5000) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `count_retask` int(11) DEFAULT 0,
  `deadline` date DEFAULT current_timestamp(),
  `id_user_create` int(11) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `late_deadline` tinyint(1) NOT NULL DEFAULT 0,
  `is_kpi` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_detail`
--

INSERT INTO `task_detail` (`id`, `id_todo`, `title`, `content_task`, `status`, `count_retask`, `deadline`, `id_user_create`, `date_create`, `is_read`, `late_deadline`, `is_kpi`, `created_at`, `updated_at`) VALUES
(51, 16, 'Đào tạo phần mềm', 'Đào tạo phần mềm cho khối chuyên môn và khối hành chính', 'REJECT', 1, '2023-12-10', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 18:33:04', '2017-11-29 18:33:04'),
(52, 16, 'Cấu hình phần cứng', 'Cấu hình cho hệ thống phần cứng của bệnh viện', 'DONE', 2, '2023-12-30', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 18:33:45', '2017-11-30 05:12:06'),
(55, 16, 'Cổng thông tin điện tử của bệnh viện', 'Giao phòng công nghệ thông tin làm đầu mối cho việc setup và vận hành cổng thông tin điện tử của bv', 'REPORT', 0, '2023-12-05', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 18:36:07', '2017-11-29 18:36:07'),
(56, 16, 'Kế hoạch bảo trì thiết bị', 'Lên kế hoạch bảo trì cho các thiết bị công nghệ thông tin', 'REJECT', 1, '2023-11-01', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 18:37:06', '2017-11-30 05:13:40'),
(57, 17, 'Rà soát hệ thống nhân sự', 'Rà soát lại toàn bộ hệ thống nhân sự của bệnh viện', 'CREATE', 0, '2023-12-10', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 18:42:16', '2017-11-29 18:42:16'),
(58, 17, 'Công tác lương thưởng cho CBCNV', 'Báo cáo kế hoạch lương thưởng cho giai đoạn vận hành bệnh viện', 'CREATE', 0, '2023-12-03', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 18:45:19', '2017-11-29 18:45:19'),
(59, 17, 'Mô tả chức năng nhiệm vụ của toàn bộ CBCNV', 'Mô tả chức năng nhiệm vụ CBNV bệnh viện', 'REJECT', 2, '2023-12-09', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 18:46:21', '2017-11-30 04:19:45'),
(60, 17, 'Kế hoạch công tác đào tạo', 'Đào tạo nguồn nhân lực của bệnh viện', 'REPORT', 6, '2023-12-01', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 18:47:04', '2023-12-18 05:50:54'),
(61, 16, 'xây dựng kế hoạch vận hành hệ thống cntt', 'Xây dựng kế hoạch vận hành chi tiết hệ thống CNTT', 'DONE', 1, '2023-12-01', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 19:04:23', '2017-11-30 02:54:32'),
(62, 16, 'Viết Phần mềm quản lý công việc cho TGĐ', 'Viết phần mềm quản lý giao việc phục vụ cho việc chỉ đạo công việc của Tổng giám đốc', 'REPORT', 0, '2023-12-02', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 19:05:42', '2017-11-29 21:53:27'),
(63, 16, 'Công việc của Tháng 12', 'Mô tả công việc của từng nhân viên trong tháng 12 về kế hoạch CNTT', 'REJECT', 2, '2023-12-15', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 19:08:09', '2023-12-03 02:05:17'),
(64, 16, 'Kế hoạch danh mục phần mềm', 'Lên kế hoạch danh mục phần mềm chuẩn bị cho giai đoạn vận hành', 'DONE', 0, '2023-11-09', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 19:09:17', '2017-11-30 04:23:07'),
(66, 16, 'Triển khai đào tạo phần mềm QLCV', 'Triển khai đào tạo phần mềm QLCV', 'DONE', 1, '2023-11-22', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 20:29:02', '2017-11-29 21:48:12'),
(67, 18, 'Lên danh mục tài sản', NULL, 'CREATE', 0, '2023-12-08', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 20:29:28', '2017-11-29 20:29:28'),
(68, 18, 'công việc thanh quyết toán BHYT', 'Các Hợp đồng về công tác thanh quyết toán BHYT', 'REPORT', 0, '2023-12-09', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 20:30:25', '2017-11-30 03:01:02'),
(69, 19, 'Danh mục dịch vụ, gói dịch vụ', 'các danh mục dịch vụ và giá dịch vụ cho giai doạn vận hành', 'CREATE', 0, '2023-12-02', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 20:30:50', '2017-11-29 20:30:50'),
(70, 20, 'Các khách hàng tiềm năng', 'Xây dựng các chương trình hỗ trợ, khuyến mãi cho khách hàng tiềm năng', 'CREATE', 0, '2023-12-08', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 20:31:54', '2017-11-29 20:31:54'),
(71, 21, 'Chiến lực mở rộng quảng cáo thương hiệu', 'Tìm các giải pháp chiến lược để mở quảng cáo thương hiệu BV', 'CREATE', 0, '2023-12-10', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 20:33:02', '2017-11-29 20:33:02'),
(72, 22, 'Kế hoạch chăm sóc khách hàng vip', 'Kế hoạch chi tiết cụ thể việc chăm sóc cho khách hàng VIP', 'CREATE', 0, '2023-12-06', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 20:33:34', '2017-11-29 20:33:34'),
(73, 23, 'Quy trình KHTH', 'Các Quy trình về lưu trữ HS, quy trình Kiểm hồ sơ', 'CREATE', 0, '2023-12-02', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 20:34:05', '2017-11-29 20:34:05'),
(74, 24, 'Hoàn tất các quy trình cho giai đoạn vận hành', 'Hoàn tất các quy trình đưa vào sử dụng', 'CREATE', 0, '2023-12-09', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 20:34:39', '2017-11-29 20:34:39'),
(75, 25, 'Kế hoạch hành chính quản trị tháng 12', 'Kế hoạch chi tiết cụ thể và dự toán kinh phí', 'CREATE', 0, '2023-12-07', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 20:35:15', '2017-11-29 20:35:15'),
(77, 16, 'công việc giao tháng 12', 'giao cho phòng CNTT tháng 12', 'REPORT', 0, '2023-12-09', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 21:49:46', '2017-11-29 21:53:05'),
(78, 16, 'giao công việc tiếp theo 12', 'giao tiếp theo 12', 'REPORT', 3, '2023-12-10', NULL, '2023-11-30', 0, 0, 1, '2017-11-29 21:50:05', '2017-11-30 01:20:59'),
(110, 17, 'Kế hoạch tuyển nhân sự tháng 1/2024', NULL, 'CREATE', 0, '2023-12-31', NULL, '2023-12-18', 0, 0, 1, '2023-12-18 05:36:46', '2023-12-18 05:36:46'),
(111, 18, 'Quyết toán thuế 2023', NULL, 'CREATE', 0, '2023-12-31', NULL, '2023-12-18', 0, 0, 1, '2023-12-18 05:37:12', '2023-12-18 05:37:12'),
(112, 21, 'Lập kế hoạch marketing năm 2024', NULL, 'CREATE', 0, '2023-12-31', NULL, '2023-12-18', 0, 0, 1, '2023-12-18 05:37:59', '2023-12-18 05:37:59'),
(113, 20, 'Xây dựng các chương trình hỗ trợ, khuyến mãi cho khách hàng 2024', NULL, 'CREATE', 0, '2023-12-18', NULL, '2023-12-18', 0, 0, 1, '2023-12-18 05:38:39', '2023-12-18 05:38:39'),
(114, 16, 'Đạo tạo , tập huấn PM', NULL, 'REPORT', 0, '2023-12-17', NULL, '2023-12-18', 0, 0, 1, '2023-12-18 05:39:58', '2023-12-18 05:40:19'),
(115, 17, 'Làm việc với cơ quan BHXH', NULL, 'CREATE', 0, '2023-12-30', NULL, '2023-12-18', 0, 0, 1, '2023-12-18 05:50:10', '2023-12-18 05:50:10'),
(116, 28, 'Nhận hàng cuối năm 2023', NULL, 'DONE', 0, '2023-12-31', NULL, '2023-12-18', 0, 0, 1, '2023-12-18 06:03:06', '2023-12-18 06:06:09'),
(117, 25, 'Chuẩn bị đón tiếp đoàn khách', NULL, 'DONE', 0, '2023-12-20', NULL, '2023-12-18', 0, 0, 1, '2023-12-18 06:03:43', '2023-12-18 06:04:51'),
(118, 26, 'Nhận hàng đợt 1', NULL, 'DONE', 0, '2023-12-18', NULL, '2023-12-18', 0, 0, 1, '2023-12-18 06:04:07', '2023-12-18 06:04:24'),
(119, 27, 'Cung cấp trang thiết bị VTYT', NULL, 'DONE', 0, '2023-12-31', NULL, '2023-12-18', 0, 0, 1, '2023-12-18 06:05:24', '2023-12-18 06:05:44');

-- --------------------------------------------------------

--
-- Table structure for table `task_detail_comment`
--

CREATE TABLE `task_detail_comment` (
  `id` int(11) NOT NULL,
  `id_task_detail` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `date_comment` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_detail_file`
--

CREATE TABLE `task_detail_file` (
  `id` int(11) NOT NULL,
  `id_task_detail` int(11) DEFAULT NULL,
  `id_detail_report` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comment` varchar(10000) DEFAULT NULL,
  `name_file` varchar(500) DEFAULT NULL,
  `file` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_detail_file`
--

INSERT INTO `task_detail_file` (`id`, `id_task_detail`, `id_detail_report`, `id_user`, `comment`, `name_file`, `file`, `created_at`, `updated_at`) VALUES
(20, 96, NULL, 1, NULL, NULL, '/Applications/XAMPP/xamppfiles/htdocs/qlcv/storage/uploads//private/var/folders/1l/lh0k7wkn5l1b8_3h2b6214dw0000gn/T/phpMPDSAN', '2017-11-30 06:48:50', '2017-11-30 06:48:50'),
(21, 96, NULL, 1, NULL, NULL, '/Applications/XAMPP/xamppfiles/htdocs/qlcv/storage/uploads//private/var/folders/1l/lh0k7wkn5l1b8_3h2b6214dw0000gn/T/phpPdlaNZ', '2017-11-30 06:48:50', '2017-11-30 06:48:50'),
(22, 96, NULL, 1, NULL, NULL, '/Applications/XAMPP/xamppfiles/htdocs/qlcv/storage/uploads//private/var/folders/1l/lh0k7wkn5l1b8_3h2b6214dw0000gn/T/phpZqie5c', '2017-11-30 06:48:50', '2017-11-30 06:48:50'),
(23, 97, NULL, 1, NULL, NULL, '/Applications/XAMPP/xamppfiles/htdocs/qlcv/storage//upload/exUT8G9CvkVxKXugcug6baeUTMh7AJdtVbilP2sp.jpeg', '2017-11-30 06:49:59', '2017-11-30 06:49:59'),
(24, 97, NULL, 1, NULL, NULL, '/Applications/XAMPP/xamppfiles/htdocs/qlcv/storage//upload/yOhpI6eMmHWGoeKWlonpNkw0fHmNlW68SHatXpzh.xls', '2017-11-30 06:49:59', '2017-11-30 06:49:59'),
(25, 97, NULL, 1, NULL, NULL, '/Applications/XAMPP/xamppfiles/htdocs/qlcv/storage//upload/o4C9fdm8sEI3cSsM8x8Pg9CjaZ5tWbdZIqAn7Rpn.jpeg', '2017-11-30 06:49:59', '2017-11-30 06:49:59'),
(26, 98, NULL, 1, NULL, '0-sa-d1-6d1f94d4128050c5b8f198e26401c770.jpg', 'upload/hWAfcexkgiJnezKCcYEff9j6tjcASROhAMqyCFhX.jpeg', '2017-11-30 08:30:57', '2017-11-30 08:30:57'),
(27, 98, NULL, 1, NULL, '23.7-báo-giá-linh-kiện.xls', 'upload/ySojqP8VrPHAdPFncAGhMiML1tpP7v9A7ndqtqq7.xls', '2017-11-30 08:30:57', '2017-11-30 08:30:57'),
(28, 98, NULL, 1, NULL, '11543FD0-73D6-4BAA-ACEA-BD4AB4D5B640.jpeg.jpg', 'upload/G9cGJdgS2f7VO299BScZOO0sya5Viajp2gUl6RuE.jpeg', '2017-11-30 08:30:57', '2017-11-30 08:30:57'),
(29, 99, NULL, 1, NULL, '0-sa-d1-6d1f94d4128050c5b8f198e26401c770.jpg', 'upload/X7GoJQLVZaPkldePobuIHWDLg9M6Ic9r0WhGecuf.jpeg', '2017-11-30 09:02:51', '2017-11-30 09:02:51'),
(30, 99, NULL, 1, NULL, '23.7-báo-giá-linh-kiện.xls', 'upload/IaliSKcnXhJBqPrUhn7BgxN0bgOOWwdx7bBcLnNq.xls', '2017-11-30 09:02:51', '2017-11-30 09:02:51'),
(31, 99, NULL, 1, NULL, '11543FD0-73D6-4BAA-ACEA-BD4AB4D5B640.jpeg.jpg', 'upload/VI5qL1VFwmucecZfo51BB4Z23tWURxWd1Pt2uUli.jpeg', '2017-11-30 09:02:51', '2017-11-30 09:02:51'),
(32, 100, NULL, 1, NULL, '23.7-báo-giá-linh-kiện.xls', 'o4dd5Pzwj85ZJA23D200cMdUm64jAQPwu6fLhi4D.xls', '2017-11-30 09:25:13', '2017-11-30 09:25:13'),
(33, 100, NULL, 1, NULL, '1504511221.png', 'WAStiwVTQTper4igU3E3V4gLV49njsgm4SZfQrMs.png', '2017-11-30 09:25:13', '2017-11-30 09:25:13'),
(34, 100, NULL, 1, NULL, '1508837265.png', 'e6GzRUgC3NBr4bBBlAZNqkillwNjlC7joX4gMbzQ.png', '2017-11-30 09:25:13', '2017-11-30 09:25:13'),
(35, 100, NULL, 1, NULL, 'app_banhang.sql', '6Rxtbdpw03aaavDseP32i6cHyA1dlpzjlSapGnxq.txt', '2017-11-30 09:25:13', '2017-11-30 09:25:13'),
(36, NULL, NULL, 1, NULL, '23.7-báo-giá-linh-kiện (1).xls', 'YobpZqwPwZ5ZQFjra3nd01GPYKJsVFeky8bbnU2A.xls', '2017-11-30 10:17:59', '2017-11-30 10:17:59'),
(37, NULL, NULL, 1, NULL, '23.7-báo-giá-linh-kiện.xls', 'qhKrumtoDLaAok576ufh0jyTBWi3JAlLc9KStbO1.xls', '2017-11-30 10:17:59', '2017-11-30 10:17:59'),
(38, NULL, NULL, 1, NULL, '23.7-báo-giá-linh-kiện (1).xls', 'Q80iUZqiV7Yabl00iB8NJGYnPnyxy9HnjOximVyZ.xls', '2017-11-30 10:18:37', '2017-11-30 10:18:37'),
(39, NULL, NULL, 1, NULL, '23.7-báo-giá-linh-kiện.xls', 'cq7P0H7aFAgMAERHPtYutNNzpOj5p92upezi4sZf.xls', '2017-11-30 10:18:37', '2017-11-30 10:18:37'),
(40, NULL, 34, 1, NULL, '23.7-báo-giá-linh-kiện (1).xls', '5JzHVpo2H66EwuP1nshBkzEWxsWRY3r1RAtbcQzX.xls', '2017-11-30 10:20:30', '2017-11-30 10:20:30'),
(41, NULL, 34, 1, NULL, '23.7-báo-giá-linh-kiện.xls', 'LB29M2qwX8Fq85srK36r8fRNFF8dkUUgj1Ektqtv.xls', '2017-11-30 10:20:30', '2017-11-30 10:20:30'),
(42, NULL, 35, 1, NULL, '23.7-báo-giá-linh-kiện.xls', 'EDvl6Vx8yjVl8Bk98LyziZKD7WYQdEok2UYbp31C.xls', '2017-11-30 10:22:12', '2017-11-30 10:22:12'),
(43, NULL, 36, 1, NULL, '23.7-báo-giá-linh-kiện (1).xls', 'h4hpROHlKE8qwTna0LGcDLvZ1TNIFSkwIBznSAKB.xls', '2017-11-30 10:24:22', '2017-11-30 10:24:22'),
(44, NULL, 36, 1, NULL, '23.7-báo-giá-linh-kiện.xls', '7hoiIV2yVdtrJJCd86wclo8HGVnm8uB4H3d3iBIP.xls', '2017-11-30 10:24:22', '2017-11-30 10:24:22'),
(45, NULL, 37, 1, NULL, '0-sa-d1-6d1f94d4128050c5b8f198e26401c770.jpg', 'X78Yi5LEj50wudwZKQKaTsrLZZci7Bx614xxLlXq.jpeg', '2017-11-30 10:26:46', '2017-11-30 10:26:46'),
(46, NULL, 37, 1, NULL, '23.7-báo-giá-linh-kiện (1).xls', 'DSo99jKK3Qun7xznE1Tm3NKMgbokxwSbWbGxpioq.xls', '2017-11-30 10:26:46', '2017-11-30 10:26:46'),
(47, NULL, 37, 1, NULL, '23.7-báo-giá-linh-kiện.xls', '06Nnq5keFNy1Q60utijeZEVgwGtFruKzBTmacZ52.xls', '2017-11-30 10:26:46', '2017-11-30 10:26:46'),
(48, NULL, 38, 1, NULL, 'pt.jpg', 'I7sSEncag5Q36RTask9ueUJMIJCyNYkv76lJKJa3.jpeg', '2023-12-01 02:21:04', '2023-12-01 02:21:04'),
(49, NULL, 39, 1, NULL, 'PCode-Crop.png', '3QUfPWEAZYTmkqh6dgi8yXw93fGph4rdKYEC6uKp.png', '2023-12-01 02:22:19', '2023-12-01 02:22:19'),
(50, 101, NULL, 12, NULL, '405204310_725434639622236_1510121935691640559_n.jpg', 'hdf9sl6NJf3sV90g0vHrMpju49SeNhGkVEQ6ix3u.jpeg', '2023-12-01 21:08:06', '2023-12-01 21:08:06'),
(51, 102, NULL, 12, NULL, '1-rq.png', '2ylctabbOm6qvc7e4PgCySv9LKLZXltQAKUdILK1.png', '2023-12-02 19:01:22', '2023-12-02 19:01:22'),
(52, NULL, 41, 12, NULL, 'company_logo-1536x499.png', 'P4vm778R8AvTjtA1MgVPtIMU8Eijs2koxoR3a6yi.png', '2023-12-02 19:07:49', '2023-12-02 19:07:49'),
(53, 103, NULL, 1, NULL, '1-rq.png', 'S4M16kb4dmPLGb5h1HhAEG4TiyHfUXk0c4t57Jzm.png', '2023-12-02 20:32:42', '2023-12-02 20:32:42'),
(54, NULL, 43, 1, NULL, 'ucpmaindev.onmicrosoft.com-B2C_1A_TRUSTFRAMEWORKBASE - 300ms.xml', 'x5bCcUJRWKlfWKB96v6lAOEQRcY36m28ywuQJuMg.txt', '2023-12-10 21:05:54', '2023-12-10 21:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `task_detail_log`
--

CREATE TABLE `task_detail_log` (
  `id` int(11) NOT NULL,
  `id_task_detail` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_detail_report`
--

CREATE TABLE `task_detail_report` (
  `id` int(11) NOT NULL,
  `id_task_detail` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment_report` mediumtext NOT NULL,
  `date_report` date DEFAULT NULL,
  `count_report` int(11) DEFAULT 1,
  `id_user_reject` int(11) DEFAULT NULL,
  `comment_reject` text DEFAULT NULL,
  `date_reject` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_detail_report`
--

INSERT INTO `task_detail_report` (`id`, `id_task_detail`, `id_user`, `comment_report`, `date_report`, `count_report`, `id_user_reject`, `comment_reject`, `date_reject`, `created_at`, `updated_at`) VALUES
(1, 76, 1, 'Kinh gửi TGD', '2023-11-30', 1, 1, 'Xem lai noi dung', '2023-11-30', '2023-12-18 12:48:05', '2017-11-29 21:43:29'),
(2, 76, 1, 'Kinh trinh tgd', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-29 21:39:43'),
(3, 60, 1, 'bao cáo lan 1', '2023-11-30', 1, 1, 'khong dat', '2023-11-30', '2023-12-18 12:48:05', '2017-11-30 04:15:24'),
(4, 66, 8, 'phòng CNTT Báo cáo', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-29 21:47:14'),
(5, 78, 1, 'guii bc', '2023-11-30', 1, 1, 'ko đạt', '2023-11-30', '2023-12-18 12:48:05', '2017-11-29 21:54:36'),
(6, 77, 1, 'bc', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-29 21:53:05'),
(7, 64, 1, 'báo cáo xong', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-29 21:53:15'),
(8, 62, 1, 'báo cáo sap xong', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-29 21:53:27'),
(9, 78, 1, 'gửi báo cáo', '2023-11-30', 4, 1, NULL, NULL, '2023-12-18 12:46:33', '2017-11-29 21:54:01'),
(10, 78, 1, 'báo cáo đạt', '2023-11-30', 1, 1, NULL, NULL, '2023-12-18 12:46:33', '2017-11-29 21:54:25'),
(11, 78, 1, 'đã sửa xong', '2023-11-30', 2, 1, NULL, NULL, '2023-12-18 12:46:33', '2017-11-29 21:55:07'),
(12, 63, 1, 'Kinh gửi TGĐ', '2023-11-30', 1, 1, 'kiểm tra lại', '2023-11-30', '2023-12-18 12:48:05', '2017-11-30 10:23:16'),
(13, 61, 8, 'Người báo cáo MR đăng', '2023-11-30', 4, 7, 'cần xem lại', '2023-11-30', '2023-12-18 12:48:05', '2017-11-30 02:52:31'),
(14, 61, 8, 'abc', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 02:53:59'),
(15, 68, 1, 'Kính trình TGD', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 03:01:02'),
(16, 60, 1, 'Trinh TGD', '2023-11-30', 2, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 04:09:52'),
(17, 60, 1, 'sdfsdfsdf', '2023-11-30', 3, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 04:14:46'),
(18, 60, 1, 'kinh gui', '2023-11-30', 2, 1, 'khong dat', '2023-11-30', '2023-12-18 12:48:05', '2017-11-30 04:16:40'),
(19, 59, 1, 'Gui bao cao lan 1', '2023-11-30', 1, 1, 'CAn kiem tra lai', '2023-11-30', '2023-12-18 12:48:05', '2017-11-30 04:19:02'),
(20, 59, 1, 'Gui bao cao lan 2', '2023-11-30', 2, 1, 'khong dat lan 2', '2023-11-30', '2023-12-18 12:48:05', '2017-11-30 04:19:45'),
(21, 52, 1, 'Gửi báo cáo', '2023-11-30', 1, 1, 'Kiem tra lai', '2023-11-30', '2023-12-18 12:48:05', '2017-11-30 05:11:44'),
(22, 52, 1, 'Trình TGD9', '2023-11-30', 2, 1, 'Đạt', '2023-11-30', '2023-12-18 12:48:05', '2017-11-30 05:12:06'),
(23, 100, 1, 'kinh gui', '2023-11-30', 1, 1, 'khong dat', '2023-11-30', '2023-12-18 12:48:05', '2017-11-30 09:33:52'),
(24, 100, 1, 'Báo cao 2', '2023-11-30', 2, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 09:36:54'),
(25, 99, 1, 'gui bao cao', '2023-11-30', 1, 1, NULL, '2029-12-18', '2023-12-18 12:48:05', '2023-12-18 05:06:10'),
(26, 98, 1, 'lan 1', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 10:11:59'),
(27, 90, 1, 'abcd', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 10:15:17'),
(28, 89, 1, 'abcd', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 10:15:49'),
(29, 88, 1, 'asfasfs', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 10:16:19'),
(30, 87, 1, 'asfasfa', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 10:17:44'),
(31, 87, 1, 'asfasfa', '2023-11-30', 2, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 10:17:59'),
(32, 86, 1, 'awfsf', '2023-11-30', 1, 1, 'Đạt', '2029-12-11', '2023-12-18 12:48:05', '2023-12-10 21:02:39'),
(33, 85, 1, 'fdvdsv', '2023-11-30', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2017-11-30 10:19:22'),
(34, 85, 1, 'fdvdsv', '2023-11-30', 2, 1, 'Đạt', '2029-12-11', '2023-12-18 12:48:05', '2023-12-10 21:02:22'),
(35, 84, 1, 'cvxvxcv', '2023-11-30', 1, 1, NULL, '2029-12-03', '2023-12-18 12:48:05', '2023-12-03 02:05:20'),
(36, 63, 1, 'trinh tdg', '2023-11-30', 2, 1, NULL, '2029-12-03', '2023-12-18 12:48:05', '2023-12-03 02:05:17'),
(37, 83, 1, 'Trinh tdg', '2023-11-30', 1, 1, 'Đạt', '2029-12-01', '2023-12-18 12:48:05', '2023-12-01 02:24:22'),
(38, 82, 1, 'fdfsfsrư', '2029-12-01', 1, 1, 'cccccc', '2029-12-01', '2023-12-18 12:48:05', '2023-12-01 02:21:36'),
(39, 82, 1, 'Gui Lan 2', '2029-12-01', 2, 1, 'Đạt', '2029-12-01', '2023-12-18 12:48:05', '2023-12-01 02:23:06'),
(40, 102, 12, 'Thực hiên cv1', '2029-12-03', 1, 1, 'CV 1 chưa đạt', '2029-12-03', '2023-12-18 12:48:05', '2023-12-02 19:04:11'),
(41, 102, 12, 'Làm lại cv 1', '2029-12-03', 2, 1, 'Đạt', '2029-12-03', '2023-12-18 12:48:05', '2023-12-02 19:08:47'),
(42, 101, 12, 'aaa', '2029-12-11', 1, 1, 'ko dat', '2029-12-11', '2023-12-18 12:48:05', '2023-12-10 21:05:35'),
(43, 101, 1, 'aaaa', '2029-12-11', 2, NULL, NULL, NULL, '2023-12-18 12:46:33', '2023-12-10 21:05:54'),
(44, 60, 1, 'lần 6', '2029-12-18', 4, 1, NULL, '2029-12-18', '2023-12-18 12:48:05', '2023-12-17 21:42:55'),
(45, 114, 1, 'Hoàn thành', '2029-12-18', 1, NULL, NULL, NULL, '2023-12-18 12:46:33', '2023-12-18 05:40:19'),
(46, 60, 1, 'đã xong', '2023-12-18', 5, NULL, NULL, NULL, '2023-12-18 05:50:54', '2023-12-18 05:50:54'),
(47, 118, 1, 'đã hoàn thành', '2023-12-18', 1, 1, 'Đạt', '2023-12-18', '2023-12-18 13:04:24', '2023-12-18 06:04:24'),
(48, 117, 1, 'đã hoàn thành', '2023-12-18', 1, 1, 'Đạt', '2023-12-18', '2023-12-18 13:04:51', '2023-12-18 06:04:51'),
(49, 119, 1, 'Đã xong', '2023-12-18', 1, 1, 'Đạt', '2023-12-18', '2023-12-18 13:05:45', '2023-12-18 06:05:45'),
(50, 116, 1, 'Hoàn thành', '2023-12-18', 1, 1, 'Đạt', '2023-12-18', '2023-12-18 13:06:09', '2023-12-18 06:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `task_permission`
--

CREATE TABLE `task_permission` (
  `id` int(11) NOT NULL,
  `id_todo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` int(10) UNSIGNED NOT NULL,
  `todo` varchar(191) NOT NULL,
  `viecdagiao` int(11) DEFAULT 0,
  `viectredeadline` int(11) DEFAULT 0,
  `vieckhongdat` int(11) DEFAULT 0,
  `chopheduyet` int(11) DEFAULT 0,
  `description` varchar(191) DEFAULT NULL,
  `category` varchar(191) DEFAULT NULL,
  `managers` varchar(1200) DEFAULT '[]',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `todo`, `viecdagiao`, `viectredeadline`, `vieckhongdat`, `chopheduyet`, `description`, `category`, `managers`, `user_id`, `created_at`, `updated_at`) VALUES
(16, 'P. CNTT', 11, 0, 0, 0, 'Phòng Công nghệ thông tin', NULL, '[\"12\",\"1\"]', 4, '2017-11-29 18:25:43', '2023-12-03 21:31:50'),
(17, 'P. TCNS', 4, 0, 0, 0, 'Phòng Tổ chức nhân sự', NULL, '[]', 4, '2017-11-29 18:26:25', '2017-11-29 18:47:04'),
(18, 'P. TCKT', 2, 0, 0, 0, 'Phòng Tài chính kế toán', NULL, '[]', 4, '2017-11-29 18:26:44', '2017-11-29 20:30:25'),
(19, 'P. KTĐT', 1, 0, 0, 0, 'Phòng Kinh tế đầu tư', NULL, '[]', 4, '2017-11-29 18:27:18', '2017-11-29 20:30:50'),
(20, 'P. KD', 1, 0, 0, 0, 'Phòng Kinh doanh', NULL, '[]', 4, '2017-11-29 18:27:31', '2017-11-29 20:31:54'),
(21, 'P. Marketing', 1, 0, 0, 0, 'Phòng Marketing', NULL, '[\"12\"]', 4, '2017-11-29 18:28:15', '2023-12-01 23:32:42'),
(22, 'P. CSKH', 1, 0, 0, 0, 'Phòng Chăm sóc khách hàng', NULL, '[]', 4, '2017-11-29 18:28:36', '2017-11-29 20:33:34'),
(23, 'P. KHTH', 1, 0, 0, 0, 'Phòng Kế hoạch tổng hợp', NULL, '[]', 4, '2017-11-29 18:28:54', '2017-11-29 20:34:05'),
(24, 'P. QLCL', 1, 0, 0, 0, 'Phòng Quản lý chất lượng', NULL, '[]', 4, '2017-11-29 18:29:24', '2017-11-29 20:34:39'),
(25, 'p. HCQT', 2, 0, 0, 0, 'Phòng HCQT', NULL, '[]', 4, '2017-11-29 18:29:43', '2017-11-29 20:35:15'),
(26, 'P.KTVH', 0, 0, 0, 0, 'Phòng Kỹ thuật vận hành', NULL, '[]', 4, '2017-11-29 18:30:00', '2017-11-29 18:30:00'),
(27, 'P. VTTBYT', 0, 0, 0, 0, 'Phòng Vật tư thiết bị y tế', NULL, '[\"1\",\"8\",\"12\"]', 4, '2017-11-29 18:30:28', '2023-12-10 21:31:18'),
(28, 'P. KTDT', 0, 0, 0, 0, NULL, NULL, '[]', 1, '2017-11-29 21:20:11', '2017-11-29 21:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userimage` varchar(191) NOT NULL,
  `permission` varchar(50) NOT NULL,
  `api_key` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `departments` varchar(1200) DEFAULT NULL,
  `add_user` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `userimage`, `permission`, `api_key`, `remember_token`, `departments`, `add_user`, `created_at`, `updated_at`) VALUES
(1, 'Lê Đình Vũ Lâm', 'lam.le@benhvienbinhdinh.com.vn', '$2y$10$iDzl6Wm9CiTZS8xCPIgSQu2JIbzBrq.JBGco7LDxSUMCfIvj0u1jW', 'userimages/KxAnt0bs72OHqR9elmIEvXbNqBbkeXlIIg3TPFay.jpeg', 'ADMIN', NULL, 'uHn9Lj5siPjxLDTqhNVXE7EtNd7Az23PKs5eam1N4UWYLLAgiVagCIgUoSgX', '[\"16\",\"21\",\"27\"]', 1, '2017-11-27 04:51:33', '2017-11-27 04:51:33'),
(4, 'Nguyễn Viết Hải', 'hai.nguyen@benhvienbinhdinh.com.vn', '$2y$10$GV/N//OVjI2geZMb1vGeoeYolVonkpnZ/LTodTgHuRxrMVq57bwdu', 'userimages/MAN6IjCmHuoaDLBdcKBcNmPptnS7ST085qXqbMFs.jpeg', 'ADMIN', NULL, 'P6PrsbfyvbbQ6mxjyvIf7aKmVT052O0VkIgrIamj2SwmSI7o3z4IiMOaIpl7', '[]', 1, '2017-11-29 00:49:39', '2017-11-29 00:49:39'),
(7, 'Đỗ Thị Xuân Khanh', 'khanh.do@benhvienbinhdinh.com.vn', '$2y$10$KeVyIb1CDej2hLZhor2SheiI.400QEicDmgmZhogK9a451IOCZLuO', 'userimages/H7yrE4REWqLjRTmdy5ATMdRmrykKqcPzD5wdrCsm.png', 'MANAGER', NULL, 'hO1mHNyYKx8ABthuwVbf5O0zI0c9aedrAW5j1k5w7EU4jGDxWUGYMFAy4Y7n', '[]', 1, '2017-11-29 18:22:44', '2017-11-29 18:22:44'),
(8, 'Võ Xuân Đăng', 'dang.vo@cotechealthcare.com.vn', '$2y$10$6Ht4pe9aP4yH2qI1AGiwWu4eJeATqvz/1ZxLFzy61uqT1nszJGafe', 'userimages/0bfFj7pxQScLvkXk30ixlB5QzXLxURTpT00VFOdK.png', 'USER', NULL, 'naJTaIUnhaAOdP7z1AcyRbtJowrYfBealjsNend21zobGu4tnNHYQtR2qgSy', '[\"27\"]', 1, '2017-11-29 18:40:10', '2023-12-10 21:30:57'),
(12, 'X_3', 'usertest@gmail.com', '$2y$10$iDzl6Wm9CiTZS8xCPIgSQu2JIbzBrq.JBGco7LDxSUMCfIvj0u1jW', 'userimages/2ja2JSD9Bf4QHQnZV2JlTdWAVMBjeBzM87bw6tND.png', 'USER', NULL, 'Y50jrFJsEpogldcbzx181OTyTBhbzK5kOsDL9DSXqf7rgPS3uFIhtiTsG7ou', '[\"16\",\"21\",\"27\"]', 0, '2023-12-01 06:44:28', '2023-12-10 21:31:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `task_detail`
--
ALTER TABLE `task_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_task` (`id_todo`),
  ADD KEY `id_task_2` (`id_todo`),
  ADD KEY `id_user_create` (`id_user_create`);

--
-- Indexes for table `task_detail_comment`
--
ALTER TABLE `task_detail_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_detail_file`
--
ALTER TABLE `task_detail_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_detail_log`
--
ALTER TABLE `task_detail_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_detail_report`
--
ALTER TABLE `task_detail_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_permission`
--
ALTER TABLE `task_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `todo_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_key_unique` (`api_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_detail`
--
ALTER TABLE `task_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `task_detail_comment`
--
ALTER TABLE `task_detail_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_detail_file`
--
ALTER TABLE `task_detail_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `task_detail_log`
--
ALTER TABLE `task_detail_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_detail_report`
--
ALTER TABLE `task_detail_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `task_permission`
--
ALTER TABLE `task_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `todo`
--
ALTER TABLE `todo`
  ADD CONSTRAINT `todo_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
