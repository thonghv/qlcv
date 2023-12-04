-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.41-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for qlcv
CREATE DATABASE IF NOT EXISTS `qlcv` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `qlcv`;

-- Dumping structure for table qlcv.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlcv.migrations: ~8 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
	(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
	(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
	(6, '2016_06_01_000004_create_oauth_clients_table', 1),
	(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
	(8, '2017_03_10_111653_create_todo_table', 1);

-- Dumping structure for table qlcv.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlcv.oauth_access_tokens: ~0 rows (approximately)

-- Dumping structure for table qlcv.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlcv.oauth_auth_codes: ~0 rows (approximately)

-- Dumping structure for table qlcv.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlcv.oauth_clients: ~2 rows (approximately)
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'Y5vQQr1LLgCb5bc44Q9dkTMvr1LdRhRUuWAaKpAk', 'http://localhost', 1, 0, 0, '2017-11-28 02:36:07', '2017-11-28 02:36:07'),
	(2, NULL, 'Laravel Password Grant Client', 'GlVbX3zxNMDkOu9kSBrqq5SWvxIWZK8GVu84rHNN', 'http://localhost', 0, 1, 0, '2017-11-28 02:36:07', '2017-11-28 02:36:07');

-- Dumping structure for table qlcv.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlcv.oauth_personal_access_clients: ~0 rows (approximately)
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2017-11-28 02:36:07', '2017-11-28 02:36:07');

-- Dumping structure for table qlcv.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlcv.oauth_refresh_tokens: ~0 rows (approximately)

-- Dumping structure for table qlcv.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlcv.password_resets: ~1 rows (approximately)
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('hai.nguyen@benhvienbinhdinh.com.vn', '$2y$10$Xm3t5M7tTan0wylIs/JY4u5Sk14EY3yn7HKG6ZP0ef/XOQ.surW.K', '2017-11-29 23:38:18');

-- Dumping structure for table qlcv.task_detail
CREATE TABLE IF NOT EXISTS `task_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_todo` int(11) NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `content_task` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count_retask` int(11) DEFAULT '0',
  `deadline` date DEFAULT NULL,
  `id_user_create` int(11) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `late_deadline` tinyint(1) NOT NULL DEFAULT '0',
  `is_kpi` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_task` (`id_todo`),
  KEY `id_task_2` (`id_todo`),
  KEY `id_user_create` (`id_user_create`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table qlcv.task_detail: ~46 rows (approximately)
INSERT INTO `task_detail` (`id`, `id_todo`, `title`, `content_task`, `status`, `count_retask`, `deadline`, `id_user_create`, `date_create`, `is_read`, `late_deadline`, `is_kpi`, `created_at`, `updated_at`) VALUES
	(51, 16, 'Đào tạo phần mềm', 'Đào tạo phần mềm cho khối chuyên môn và khối hành chính', 'REJECT', 1, '2017-12-10', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 18:33:04', '2017-11-29 18:33:04'),
	(52, 16, 'Cấu hình phần cứng', 'Cấu hình cho hệ thống phần cứng của bệnh viện', 'DONE', 2, '2017-12-30', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 18:33:45', '2017-11-30 05:12:06'),
	(55, 16, 'Cổng thông tin điện tử của bệnh viện', 'Giao phòng công nghệ thông tin làm đầu mối cho việc setup và vận hành cổng thông tin điện tử của bv', 'REPORT', 0, '2017-12-05', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 18:36:07', '2017-11-29 18:36:07'),
	(56, 16, 'Kế hoạch bảo trì thiết bị', 'Lên kế hoạch bảo trì cho các thiết bị công nghệ thông tin', 'REJECT', 1, '2017-11-01', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 18:37:06', '2017-11-30 05:13:40'),
	(57, 17, 'Rà soát hệ thống nhân sự', 'Rà soát lại toàn bộ hệ thống nhân sự của bệnh viện', 'CREATE', 0, '2017-12-10', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 18:42:16', '2017-11-29 18:42:16'),
	(58, 17, 'Công tác lương thưởng cho CBCNV', 'Báo cáo kế hoạch lương thưởng cho giai đoạn vận hành bệnh viện', 'CREATE', 0, '2017-12-03', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 18:45:19', '2017-11-29 18:45:19'),
	(59, 17, 'Mô tả chức năng nhiệm vụ của toàn bộ CBCNV', 'Mô tả chức năng nhiệm vụ CBNV bệnh viện', 'REJECT', 2, '2017-12-09', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 18:46:21', '2017-11-30 04:19:45'),
	(60, 17, 'Kế hoạch công tác đào tạo', 'Đào tạo nguồn nhân lực của bệnh viện', 'REJECT', 5, '2017-12-01', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 18:47:04', '2017-11-30 04:16:40'),
	(61, 16, 'xây dựng kế hoạch vận hành hệ thống cntt', 'Xây dựng kế hoạch vận hành chi tiết hệ thống CNTT', 'DONE', 1, '2017-12-01', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 19:04:23', '2017-11-30 02:54:32'),
	(62, 16, 'Viết Phần mềm quản lý công việc cho TGĐ', 'Viết phần mềm quản lý giao việc phục vụ cho việc chỉ đạo công việc của Tổng giám đốc', 'REPORT', 0, '2017-12-02', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 19:05:42', '2017-11-29 21:53:27'),
	(63, 16, 'Công việc của Tháng 12', 'Mô tả công việc của từng nhân viên trong tháng 12 về kế hoạch CNTT', 'REJECT', 2, '2017-12-15', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 19:08:09', '2023-12-03 02:05:17'),
	(64, 16, 'Kế hoạch danh mục phần mềm', 'Lên kế hoạch danh mục phần mềm chuẩn bị cho giai đoạn vận hành', 'DONE', 0, '2017-11-09', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 19:09:17', '2017-11-30 04:23:07'),
	(65, 25, 'sfasd', 'asdasdasf', 'CREATE', 0, '2017-11-02', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:06:47', '2017-11-29 20:06:47'),
	(66, 16, 'Triển khai đào tạo phần mềm QLCV', 'Triển khai đào tạo phần mềm QLCV', 'DONE', 1, '2017-11-22', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:29:02', '2017-11-29 21:48:12'),
	(67, 18, 'Lên danh mục tài sản', NULL, 'CREATE', 0, '2017-12-08', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:29:28', '2017-11-29 20:29:28'),
	(68, 18, 'công việc thanh quyết toán BHYT', 'Các Hợp đồng về công tác thanh quyết toán BHYT', 'REPORT', 0, '2017-12-09', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:30:25', '2017-11-30 03:01:02'),
	(69, 19, 'Danh mục dịch vụ, gói dịch vụ', 'các danh mục dịch vụ và giá dịch vụ cho giai doạn vận hành', 'CREATE', 0, '2017-12-02', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:30:50', '2017-11-29 20:30:50'),
	(70, 20, 'Các khách hàng tiềm năng', 'Xây dựng các chương trình hỗ trợ, khuyến mãi cho khách hàng tiềm năng', 'CREATE', 0, '2017-12-08', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:31:54', '2017-11-29 20:31:54'),
	(71, 21, 'Chiến lực mở rộng quảng cáo thương hiệu', 'Tìm các giải pháp chiến lược để mở quảng cáo thương hiệu BV', 'CREATE', 0, '2017-12-10', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:33:02', '2017-11-29 20:33:02'),
	(72, 22, 'Kế hoạch chăm sóc khách hàng vip', 'Kế hoạch chi tiết cụ thể việc chăm sóc cho khách hàng VIP', 'CREATE', 0, '2017-12-06', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:33:34', '2017-11-29 20:33:34'),
	(73, 23, 'Quy trình KHTH', 'Các Quy trình về lưu trữ HS, quy trình Kiểm hồ sơ', 'CREATE', 0, '2017-12-02', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:34:05', '2017-11-29 20:34:05'),
	(74, 24, 'Hoàn tất các quy trình cho giai đoạn vận hành', 'Hoàn tất các quy trình đưa vào sử dụng', 'CREATE', 0, '2017-12-09', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:34:39', '2017-11-29 20:34:39'),
	(75, 25, 'Kế hoạch hành chính quản trị tháng 12', 'Kế hoạch chi tiết cụ thể và dự toán kinh phí', 'CREATE', 0, '2017-12-07', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 20:35:15', '2017-11-29 20:35:15'),
	(76, 28, 'cong viec 2', 'cong viec 2cong viec 2cong viec 2cong viec 2cong viec 2cong viec 2\r\n\r\ncong viec 2\r\ncong viec 2', 'REJECT', 2, '2017-11-30', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 21:26:59', '2017-11-29 21:43:29'),
	(77, 16, 'công việc giao tháng 12', 'giao cho phòng CNTT tháng 12', 'REPORT', 0, '2017-12-09', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 21:49:46', '2017-11-29 21:53:05'),
	(78, 16, 'giao công việc tiếp theo 12', 'giao tiếp theo 12', 'REPORT', 3, '2017-12-10', NULL, '2017-11-30', 0, 0, 1, '2017-11-29 21:50:05', '2017-11-30 01:20:59'),
	(79, 16, 'cong viec 15', 'cong veic', 'CREATE', 0, '2017-11-17', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:04:59', '2017-11-30 06:04:59'),
	(80, 16, 'cong viec 14', 'cong veic', 'CREATE', 0, '2017-11-17', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:06:00', '2017-11-30 06:06:00'),
	(81, 16, 'cong viec 13', 'cong veic', 'CREATE', 0, '2017-11-17', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:07:39', '2017-11-30 06:07:39'),
	(82, 16, 'cong viec 1B', 'cong veic', 'DONE', 1, '2023-12-01', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:08:16', '2023-12-01 02:23:06'),
	(83, 16, 'cong viec 1A', 'cong viec 1', 'DONE', 0, '2017-11-02', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:09:31', '2023-12-01 02:24:22'),
	(84, 16, 'cong viec 12', 'cong viec 1', 'REJECT', 1, '2017-11-02', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:12:30', '2023-12-03 02:05:20'),
	(85, 16, 'cong viec 11', 'cong viec 1', 'REPORT', 0, '2017-11-02', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:14:16', '2017-11-30 10:20:30'),
	(86, 16, 'fefe', 'fsfdsgdsg', 'REPORT', 0, '2017-11-08', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:23:34', '2017-11-30 10:18:37'),
	(87, 16, 'safasf', 'safasfa', 'REPORT', 0, '2017-11-01', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:32:57', '2017-11-30 10:17:59'),
	(88, 16, 'safasf', 'safasfa', 'REPORT', 0, '2017-11-01', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:33:30', '2017-11-30 10:16:19'),
	(89, 16, 'safasf', 'safasfa', 'REPORT', 0, '2017-11-01', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:34:10', '2017-11-30 10:15:49'),
	(90, 16, 'dsadsad', 'sds', 'REPORT', 0, '2017-11-16', NULL, '2017-11-30', 0, 0, 1, '2017-11-30 06:37:03', '2017-11-30 10:15:17'),
	(98, 16, 'dfdsgfsd 2', 'gdsgsdgds', 'REPORT', 0, NULL, NULL, '2017-11-30', 0, 0, 1, '2017-11-30 08:30:57', '2017-11-30 10:11:59'),
	(99, 16, 'dfdsgfsd 1', 'gdsgsdgds', 'REPORT', 0, NULL, NULL, '2017-11-30', 0, 0, 1, '2017-11-30 09:02:51', '2017-11-30 10:09:18'),
	(100, 17, 'cong viec', 'asdasva', 'REPORT', 1, NULL, NULL, '2017-11-30', 0, 0, 1, '2017-11-30 09:25:13', '2017-11-30 09:36:54'),
	(101, 21, 'CV 1', NULL, 'CREATE', 0, '2023-12-02', NULL, '2023-12-02', 0, 0, 1, '2023-12-01 21:08:05', '2023-12-01 21:08:05'),
	(102, 27, 'Công việc 1', 'Mô Tả Công việc 1', 'DONE', 1, '2023-12-04', NULL, '2023-12-03', 0, 0, 1, '2023-12-02 19:01:22', '2023-12-02 19:08:47'),
	(103, 16, 'Cong việc A', 'Cong việc A', 'CREATE', 0, '2023-12-10', NULL, '2023-12-03', 0, 0, 1, '2023-12-02 20:32:42', '2023-12-02 20:32:42'),
	(104, 16, 'Công việc 2', 'Công việc 2', 'CREATE', 0, '2023-12-09', NULL, '2023-12-03', 0, 0, 1, '2023-12-02 20:38:30', '2023-12-02 20:38:30'),
	(105, 16, 'Công việc 3', 'Công việc 3', 'CREATE', 0, '2023-12-09', NULL, '2023-12-03', 0, 0, 1, '2023-12-02 20:39:08', '2023-12-02 20:39:08');

-- Dumping structure for table qlcv.task_detail_comment
CREATE TABLE IF NOT EXISTS `task_detail_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_task_detail` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comment` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_comment` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table qlcv.task_detail_comment: ~0 rows (approximately)

-- Dumping structure for table qlcv.task_detail_file
CREATE TABLE IF NOT EXISTS `task_detail_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_task_detail` int(11) DEFAULT NULL,
  `id_detail_report` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comment` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_file` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table qlcv.task_detail_file: ~34 rows (approximately)
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
	(53, 103, NULL, 1, NULL, '1-rq.png', 'S4M16kb4dmPLGb5h1HhAEG4TiyHfUXk0c4t57Jzm.png', '2023-12-02 20:32:42', '2023-12-02 20:32:42');

-- Dumping structure for table qlcv.task_detail_log
CREATE TABLE IF NOT EXISTS `task_detail_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_task_detail` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table qlcv.task_detail_log: ~0 rows (approximately)

-- Dumping structure for table qlcv.task_detail_report
CREATE TABLE IF NOT EXISTS `task_detail_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_task_detail` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment_report` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `date_report` date DEFAULT NULL,
  `count_report` int(11) DEFAULT '1',
  `id_user_reject` int(11) DEFAULT NULL,
  `comment_reject` text COLLATE utf8_unicode_ci,
  `date_reject` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table qlcv.task_detail_report: ~41 rows (approximately)
INSERT INTO `task_detail_report` (`id`, `id_task_detail`, `id_user`, `comment_report`, `date_report`, `count_report`, `id_user_reject`, `comment_reject`, `date_reject`, `created_at`, `updated_at`) VALUES
	(1, 76, 1, 'Kinh gửi TGD', '2017-11-30', 1, 1, 'Xem lai noi dung', '2017-11-30', '2017-11-30 04:43:29', '2017-11-29 21:43:29'),
	(2, 76, 1, 'Kinh trinh tgd', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-29 21:39:43', '2017-11-29 21:39:43'),
	(3, 60, 1, 'bao cáo lan 1', '2017-11-30', 1, 1, 'khong dat', '2017-11-30', '2017-11-30 11:15:24', '2017-11-30 04:15:24'),
	(4, 66, 8, 'phòng CNTT Báo cáo', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-29 21:47:14', '2017-11-29 21:47:14'),
	(5, 78, 1, 'guii bc', '2017-11-30', 1, 1, 'ko đạt', '2017-11-30', '2017-11-30 04:54:36', '2017-11-29 21:54:36'),
	(6, 77, 1, 'bc', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-29 21:53:05', '2017-11-29 21:53:05'),
	(7, 64, 1, 'báo cáo xong', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-29 21:53:15', '2017-11-29 21:53:15'),
	(8, 62, 1, 'báo cáo sap xong', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-29 21:53:27', '2017-11-29 21:53:27'),
	(9, 78, 1, 'gửi báo cáo', '2017-11-30', 4, 1, NULL, NULL, '2017-11-30 07:50:52', '2017-11-29 21:54:01'),
	(10, 78, 1, 'báo cáo đạt', '2017-11-30', 1, 1, NULL, NULL, '2017-11-30 07:50:39', '2017-11-29 21:54:25'),
	(11, 78, 1, 'đã sửa xong', '2017-11-30', 2, 1, NULL, NULL, '2017-11-30 07:50:46', '2017-11-29 21:55:07'),
	(12, 63, 1, 'Kinh gửi TGĐ', '2017-11-30', 1, 1, 'kiểm tra lại', '2017-11-30', '2017-11-30 17:23:16', '2017-11-30 10:23:16'),
	(13, 61, 8, 'Người báo cáo MR đăng', '2017-11-30', 4, 7, 'cần xem lại', '2017-11-30', '2017-11-30 11:17:43', '2017-11-30 02:52:31'),
	(14, 61, 8, 'abc', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-30 02:53:59', '2017-11-30 02:53:59'),
	(15, 68, 1, 'Kính trình TGD', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-30 03:01:02', '2017-11-30 03:01:02'),
	(16, 60, 1, 'Trinh TGD', '2017-11-30', 2, NULL, NULL, NULL, '2017-11-30 11:17:35', '2017-11-30 04:09:52'),
	(17, 60, 1, 'sdfsdfsdf', '2017-11-30', 3, NULL, NULL, NULL, '2017-11-30 11:17:39', '2017-11-30 04:14:46'),
	(18, 60, 1, 'kinh gui', '2017-11-30', 2, 1, 'khong dat', '2017-11-30', '2017-11-30 11:16:40', '2017-11-30 04:16:40'),
	(19, 59, 1, 'Gui bao cao lan 1', '2017-11-30', 1, 1, 'CAn kiem tra lai', '2017-11-30', '2017-11-30 11:19:02', '2017-11-30 04:19:02'),
	(20, 59, 1, 'Gui bao cao lan 2', '2017-11-30', 2, 1, 'khong dat lan 2', '2017-11-30', '2017-11-30 11:19:45', '2017-11-30 04:19:45'),
	(21, 52, 1, 'Gửi báo cáo', '2017-11-30', 1, 1, 'Kiem tra lai', '2017-11-30', '2017-11-30 12:11:44', '2017-11-30 05:11:44'),
	(22, 52, 1, 'Trình TGD9', '2017-11-30', 2, 1, 'Đạt', '2017-11-30', '2017-11-30 12:12:06', '2017-11-30 05:12:06'),
	(23, 100, 1, 'kinh gui', '2017-11-30', 1, 1, 'khong dat', '2017-11-30', '2017-11-30 16:33:52', '2017-11-30 09:33:52'),
	(24, 100, 1, 'Báo cao 2', '2017-11-30', 2, NULL, NULL, NULL, '2017-11-30 09:36:54', '2017-11-30 09:36:54'),
	(25, 99, 1, 'gui bao cao', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-30 10:09:18', '2017-11-30 10:09:18'),
	(26, 98, 1, 'lan 1', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-30 10:11:59', '2017-11-30 10:11:59'),
	(27, 90, 1, 'abcd', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-30 10:15:17', '2017-11-30 10:15:17'),
	(28, 89, 1, 'abcd', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-30 10:15:49', '2017-11-30 10:15:49'),
	(29, 88, 1, 'asfasfs', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-30 10:16:19', '2017-11-30 10:16:19'),
	(30, 87, 1, 'asfasfa', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-30 10:17:44', '2017-11-30 10:17:44'),
	(31, 87, 1, 'asfasfa', '2017-11-30', 2, NULL, NULL, NULL, '2017-11-30 10:17:59', '2017-11-30 10:17:59'),
	(32, 86, 1, 'awfsf', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-30 10:18:37', '2017-11-30 10:18:37'),
	(33, 85, 1, 'fdvdsv', '2017-11-30', 1, NULL, NULL, NULL, '2017-11-30 10:19:22', '2017-11-30 10:19:22'),
	(34, 85, 1, 'fdvdsv', '2017-11-30', 2, NULL, NULL, NULL, '2017-11-30 10:20:30', '2017-11-30 10:20:30'),
	(35, 84, 1, 'cvxvxcv', '2017-11-30', 1, 1, NULL, '2023-12-03', '2023-12-03 09:05:20', '2023-12-03 02:05:20'),
	(36, 63, 1, 'trinh tdg', '2017-11-30', 2, 1, NULL, '2023-12-03', '2023-12-03 09:05:17', '2023-12-03 02:05:17'),
	(37, 83, 1, 'Trinh tdg', '2017-11-30', 1, 1, 'Đạt', '2023-12-01', '2023-12-01 09:24:22', '2023-12-01 02:24:22'),
	(38, 82, 1, 'fdfsfsrư', '2023-12-01', 1, 1, 'cccccc', '2023-12-01', '2023-12-01 09:21:36', '2023-12-01 02:21:36'),
	(39, 82, 1, 'Gui Lan 2', '2023-12-01', 2, 1, 'Đạt', '2023-12-01', '2023-12-01 09:23:06', '2023-12-01 02:23:06'),
	(40, 102, 12, 'Thực hiên cv1', '2023-12-03', 1, 1, 'CV 1 chưa đạt', '2023-12-03', '2023-12-03 02:04:11', '2023-12-02 19:04:11'),
	(41, 102, 12, 'Làm lại cv 1', '2023-12-03', 2, 1, 'Đạt', '2023-12-03', '2023-12-03 02:08:47', '2023-12-02 19:08:47');

-- Dumping structure for table qlcv.task_permission
CREATE TABLE IF NOT EXISTS `task_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_todo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `permission` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table qlcv.task_permission: ~0 rows (approximately)

-- Dumping structure for table qlcv.todo
CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `todo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viecdagiao` int(11) DEFAULT '0',
  `viectredeadline` int(11) DEFAULT '0',
  `vieckhongdat` int(11) DEFAULT '0',
  `chopheduyet` int(11) DEFAULT '0',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `managers` varchar(1200) COLLATE utf8mb4_unicode_ci DEFAULT '[]',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `todo_user_id_foreign` (`user_id`),
  CONSTRAINT `todo_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlcv.todo: ~13 rows (approximately)
INSERT INTO `todo` (`id`, `todo`, `viecdagiao`, `viectredeadline`, `vieckhongdat`, `chopheduyet`, `description`, `category`, `managers`, `user_id`, `created_at`, `updated_at`) VALUES
	(16, 'P. CNTT', 11, 0, 0, 0, 'Phòng Công nghệ thông tin', NULL, '["12","1"]', 4, '2017-11-29 18:25:43', '2023-12-03 02:02:59'),
	(17, 'P. TCNS', 4, 0, 0, 0, 'Phòng Tổ chức nhân sự', NULL, '[]', 4, '2017-11-29 18:26:25', '2017-11-29 18:47:04'),
	(18, 'P. TCKT', 2, 0, 0, 0, 'Phòng Tài chính kế toán', NULL, '[]', 4, '2017-11-29 18:26:44', '2017-11-29 20:30:25'),
	(19, 'P. KTĐT', 1, 0, 0, 0, 'Phòng Kinh tế đầu tư', NULL, '[]', 4, '2017-11-29 18:27:18', '2017-11-29 20:30:50'),
	(20, 'P. KD', 1, 0, 0, 0, 'Phòng Kinh doanh', NULL, '[]', 4, '2017-11-29 18:27:31', '2017-11-29 20:31:54'),
	(21, 'P. Marketing', 1, 0, 0, 0, 'Phòng Marketing', NULL, '["12"]', 4, '2017-11-29 18:28:15', '2023-12-01 23:32:42'),
	(22, 'P. CSKH', 1, 0, 0, 0, 'Phòng Chăm sóc khách hàng', NULL, '[]', 4, '2017-11-29 18:28:36', '2017-11-29 20:33:34'),
	(23, 'P. KHTH', 1, 0, 0, 0, 'Phòng Kế hoạch tổng hợp', NULL, '[]', 4, '2017-11-29 18:28:54', '2017-11-29 20:34:05'),
	(24, 'P. QLCL', 1, 0, 0, 0, 'Phòng Quản lý chất lượng', NULL, '[]', 4, '2017-11-29 18:29:24', '2017-11-29 20:34:39'),
	(25, 'p. HCQT', 2, 0, 0, 0, 'Phòng HCQT', NULL, '[]', 4, '2017-11-29 18:29:43', '2017-11-29 20:35:15'),
	(26, 'P.KTVH', 0, 0, 0, 0, 'Phòng Kỹ thuật vận hành', NULL, '[]', 4, '2017-11-29 18:30:00', '2017-11-29 18:30:00'),
	(27, 'P. VTTBYT', 0, 0, 0, 0, 'Phòng Vật tư thiết bị y tế', NULL, '["1"]', 4, '2017-11-29 18:30:28', '2023-12-01 23:32:49'),
	(28, 'P. KTDT', 0, 0, 0, 0, NULL, NULL, '[]', 1, '2017-11-29 21:20:11', '2017-11-29 21:20:11');

-- Dumping structure for table qlcv.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userimage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departments` varchar(1200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_user` int(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_key_unique` (`api_key`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlcv.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `userimage`, `permission`, `api_key`, `remember_token`, `departments`, `add_user`, `created_at`, `updated_at`) VALUES
	(1, 'Lê Đình Vũ Lâm', 'lam.le@benhvienbinhdinh.com.vn', '$2y$10$iDzl6Wm9CiTZS8xCPIgSQu2JIbzBrq.JBGco7LDxSUMCfIvj0u1jW', 'userimages/KxAnt0bs72OHqR9elmIEvXbNqBbkeXlIIg3TPFay.jpeg', 'ADMIN', NULL, 'myrgxLcDo8tf4rNnbw7S8PYtqCIUxaBhnwUXtiyl0ZUdt3rl7Q3adz53DcAX', '["16","17","18","19","20","21","22","23","24","25","26","27","28"]', 1, '2017-11-27 04:51:33', '2017-11-27 04:51:33'),
	(4, 'Nguyễn Viết Hải', 'hai.nguyen@benhvienbinhdinh.com.vn', '$2y$10$GV/N//OVjI2geZMb1vGeoeYolVonkpnZ/LTodTgHuRxrMVq57bwdu', 'userimages/MAN6IjCmHuoaDLBdcKBcNmPptnS7ST085qXqbMFs.jpeg', 'ADMIN', NULL, 'P6PrsbfyvbbQ6mxjyvIf7aKmVT052O0VkIgrIamj2SwmSI7o3z4IiMOaIpl7', '[]', 1, '2017-11-29 00:49:39', '2017-11-29 00:49:39'),
	(7, 'Đỗ Thị Xuân Khanh', 'khanh.do@benhvienbinhdinh.com.vn', '$2y$10$KeVyIb1CDej2hLZhor2SheiI.400QEicDmgmZhogK9a451IOCZLuO', 'userimages/H7yrE4REWqLjRTmdy5ATMdRmrykKqcPzD5wdrCsm.png', 'MANAGER', NULL, 'hO1mHNyYKx8ABthuwVbf5O0zI0c9aedrAW5j1k5w7EU4jGDxWUGYMFAy4Y7n', '[]', 1, '2017-11-29 18:22:44', '2017-11-29 18:22:44'),
	(8, 'Võ Xuân Đăng', 'dang.vo@cotechealthcare.com.vn', '$2y$10$6Ht4pe9aP4yH2qI1AGiwWu4eJeATqvz/1ZxLFzy61uqT1nszJGafe', 'userimages/0bfFj7pxQScLvkXk30ixlB5QzXLxURTpT00VFOdK.png', 'USER', NULL, 'jqleQXzGLZQooZIpR6j0XpE7dbOptSHzJtlgzihPfln8NHv82KFvuVA89t10', '[]', 1, '2017-11-29 18:40:10', '2017-11-29 18:40:10'),
	(12, 'X_3', 'x3@gmail.com', '$2y$10$AZt.f/LZ1zJQvNnr48TDh.FtTX7iwW0byciVyrQZkQkM7APXbgflG', 'userimages/2ja2JSD9Bf4QHQnZV2JlTdWAVMBjeBzM87bw6tND.png', 'USER', NULL, 'Vo2P20Wbv5V6yQieumTOFNkaZin9kcFs80ymMGbSR4sFi27wMpUp9BAhiuXO', '["16","21","27"]', 1, '2023-12-01 06:44:28', '2023-12-01 06:44:28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
