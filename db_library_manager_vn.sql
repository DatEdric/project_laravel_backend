-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2024 at 09:49 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_library_manager_vn`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int UNSIGNED NOT NULL,
  `at_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `at_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `at_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `at_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `at_gender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `at_birthday` date DEFAULT NULL,
  `at_status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `at_name`, `at_email`, `at_phone`, `at_address`, `at_gender`, `at_birthday`, `at_status`, `created_at`, `updated_at`) VALUES
(3, 'Lê Văn Hà', 'hale@gmail.com', '1659020898', 'thái bình', '1', '1970-01-01', 1, '2023-10-17 14:32:03', '2023-10-17 14:32:03'),
(4, 'Mai Văn Bính', 'support@gmail.com', '0359020888', 'Từ Liêm', '1', '1970-01-01', 1, '2023-10-17 14:32:03', '2023-10-17 14:32:03'),
(5, 'Phùng Thị Mỹ Hạnh', 'hanhnguyen@gmail.com', '038351534536', 'Hà Nội', '2', '2022-05-09', 1, '2023-10-17 14:32:03', '2023-10-17 14:32:03'),
(6, 'Hoàng Thanh Hương', 'thanhhuong@gmail.com', '09899434234', 'Tam Kỳ - Quảng Nam', '2', '2022-05-10', 1, '2023-10-17 14:32:03', '2023-10-17 14:32:03'),
(7, 'Lê Hữu Trác', 'huutrac@gmai.com', '0984535345', 'Hải Dương', '2', '2022-05-12', 1, '2023-10-17 14:32:03', '2023-10-17 14:32:03'),
(8, 'Hồ Xuân Hương', 'huong@gmail.com', '08938492324', 'Quảng Châu', '2', '2022-05-09', 1, '2023-10-17 14:32:03', '2023-10-17 14:32:03'),
(9, 'Nguyễn Khuyến', 'kuyen@gmail.com', NULL, 'Nam Định', '2', '2022-05-09', 1, '2023-10-17 14:32:03', '2023-10-17 14:32:03'),
(10, 'Nam Cao', 'cao@gmail.com', '0923423423', 'Hà Nam', '2', '2022-05-09', 1, '2023-10-17 14:32:03', '2023-10-17 14:32:03'),
(11, 'Nguyễn Công Trứ', 'congtru@gmail.com', NULL, NULL, '2', '2022-05-09', 1, '2023-10-17 14:32:03', '2023-10-17 14:32:03'),
(12, 'Mai Văn Mốt', 'hanhnguyen1@gmail.com', '038351534536', 'Hà Nội', '1', '1970-01-01', 1, '2023-10-17 14:32:03', '2023-10-17 14:32:03'),
(13, 'Nguyễn Văn B A', 'nguyenvanb@yahoo.com', '0359020898', 'Hà Nội', '1', '1991-03-04', 1, '2023-10-17 14:32:03', '2024-03-29 07:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `author_book`
--

CREATE TABLE `author_book` (
  `author_id` int UNSIGNED NOT NULL,
  `book_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `author_book`
--

INSERT INTO `author_book` (`author_id`, `book_id`) VALUES
(4, 1),
(3, 2),
(4, 2),
(5, 10),
(7, 10),
(3, 11),
(4, 11),
(5, 11),
(6, 11);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int UNSIGNED NOT NULL,
  `b_categories_id` int UNSIGNED NOT NULL,
  `b_publishing_company_id` int UNSIGNED NOT NULL,
  `b_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `b_code_book` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_amount_liquidated` int DEFAULT '0',
  `b_price` double DEFAULT NULL,
  `b_status` tinyint DEFAULT '1',
  `b_publishing_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ib_issue_number` int NOT NULL,
  `ib_amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `b_categories_id`, `b_publishing_company_id`, `b_name`, `b_image`, `b_description`, `b_code_book`, `b_amount_liquidated`, `b_price`, `b_status`, `b_publishing_year`, `created_at`, `updated_at`, `ib_issue_number`, `ib_amount`) VALUES
(1, 1, 1, 'Sách luyện giải đề', NULL, NULL, 'UIKrrjwobE', NULL, 45, 1, NULL, '2023-10-17 14:32:20', '2023-10-17 14:32:20', 0, 0),
(2, 1, 1, 'Sách giải', NULL, NULL, '69U2TWMCdx', NULL, 50, 1, NULL, '2023-10-17 14:32:20', '2023-10-17 14:32:20', 0, 0),
(10, 6, 2, 'Sách bồi dưỡng', NULL, NULL, 'z7xGCk4NPp', NULL, NULL, 1, '2023', '2023-10-17 14:32:20', '2024-03-29 07:07:28', 1, 1),
(11, 3, 3, 'Sách ôn luyện', NULL, NULL, 'S7RqzEZR20', 34, NULL, 1, '2022', '2023-10-17 14:32:20', '2024-03-29 07:07:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id` int UNSIGNED NOT NULL,
  `b_code_borrow` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_reader_id` int UNSIGNED NOT NULL,
  `b_note` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`id`, `b_code_borrow`, `b_reader_id`, `b_note`, `b_status`, `created_at`, `updated_at`) VALUES
(2, 'ZDV5A284GI', 1, 'Sách mới', 1, '2023-10-17 14:32:32', '2023-10-17 14:32:32'),
(3, 'ru6QeaaSvw', 1, NULL, 1, '2023-10-17 14:32:32', '2023-10-17 14:32:32'),
(4, 'vYzC5nlP4A', 3, NULL, 1, '2023-10-17 14:32:32', '2023-10-17 14:32:32'),
(5, 'nCh3E6vMl6', 1, NULL, 1, '2023-10-17 14:32:32', '2023-10-17 14:32:32'),
(6, '2imsauwp81', 5, NULL, 1, '2023-10-17 14:32:32', '2023-10-17 14:32:32'),
(7, '38tIEnx3ZD', 5, 'Đã làm mất 1 cuốn', 1, '2023-10-17 14:32:32', '2023-10-17 14:32:32'),
(8, 'oBP3mv4GeN', 3, NULL, 1, '2023-10-17 14:32:32', '2023-10-17 14:32:32'),
(9, 'bYRlQwAVgV', 10, 'mượn sách', 1, '2023-10-17 14:32:32', '2023-10-17 14:32:32'),
(10, 'bzV1d8pQjA', 2, 'ghi chú mượn sách', 1, '2024-03-29 07:08:57', '2024-03-29 07:08:57'),
(11, 'vbgI34Bske', 2, NULL, 1, '2024-04-28 02:31:35', '2024-04-28 02:31:35'),
(12, 'RodAZzDgtQ', 3, 'dssadasd', 1, '2024-04-28 02:32:21', '2024-04-28 02:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `c_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `c_name`, `created_at`, `updated_at`) VALUES
(1, 'Sách tham khảo văn 10', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(2, 'Sách tham khảo Anh 10', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(3, 'Sách tham khảo Toán 10', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(6, 'Sách luyện giải đề Toán 10', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(7, 'Sách luyện giải đề Anh Văn 12', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(8, 'Sách luyện giải đề Hóa 11', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(9, 'Sách luyện giải đề Anh Văn 11', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(10, 'Sách học tốt Ngữ Văn 10', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(11, 'Sách học tốt Lý 10', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(12, 'Luyện giải đề thi Toán Cấp trường', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(13, 'Sách Hạt giống tâm hồn', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(14, 'Sách học tốt Hóa 12', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(15, 'Sách học tốt Hóa 10', '2023-10-17 14:32:47', '2023-10-17 14:32:47'),
(16, 'Sách bồi dưỡng học sinh giỏi Văn', '2023-10-17 14:32:47', '2023-10-17 14:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int UNSIGNED NOT NULL,
  `c_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `c_name`, `created_at`, `updated_at`) VALUES
(1, 'Lớp 10A3', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(2, 'Lớp 10A2', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(3, 'Lớp 10A1', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(4, 'Lớp 11A1', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(5, 'Lớp 11A2', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(6, 'Lớp 11A3', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(7, 'Lớp 12A1', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(8, 'Lớp 12A2', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(9, 'Lớp 12A3', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(10, 'Lớp 10C2', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(11, 'Lớp 11A31', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(12, 'Lớp 10A2', '2023-10-17 14:33:04', '2023-10-17 14:33:04'),
(13, 'Lớp 10A6', '2024-03-29 06:58:21', '2024-03-29 06:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int UNSIGNED NOT NULL,
  `d_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `d_name`, `created_at`, `updated_at`) VALUES
(9, 'Khối 10 - Năm 2022', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(10, 'Khối 12 - Năm 2021', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(11, 'Khối 11 - Năm 2021', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(12, 'Khối 10 - Năm 2021', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(13, 'Khối 11- Năm 2022', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(14, 'Khối 12 - Năm 2022', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(15, 'Khối 10 - Năm 2020', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(16, 'Khối 11 - Năm 2020', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(17, 'Khối 12 - Năm 2020', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(18, 'Khối 10 - Năm 2019', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(19, 'Khối 11 - Năm 2019', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(20, 'Khối 12 - Năm 2019', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(21, 'Khối 10 - Năm 2018', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(22, 'Khối 11 - Năm 2018', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(23, 'Khối 12 - Năm 2018', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(24, 'Khối 10 - Năm 2017', '2023-10-17 14:33:21', '2023-10-17 14:33:21'),
(26, 'Khối lớp 9 năm 2023', '2023-10-17 14:33:21', '2023-10-17 14:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `group_permission`
--

CREATE TABLE `group_permission` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Quản lý ứng dụng', 'Quản lý ứng dụng', '2023-10-17 14:33:38', '2023-10-17 15:30:39'),
(2, 'Quản lý khối lớp', 'Quản lý khối lớp', '2023-10-17 14:33:38', '2023-10-17 15:30:14'),
(3, 'Quản lý lớp', 'Quản lý lớp', '2023-10-17 14:33:38', '2023-10-17 15:29:57'),
(4, 'Quản lý người đọc', 'Quản lý người đọc', '2023-10-17 14:33:38', '2023-10-17 15:29:47'),
(5, 'Quản lý tác giả', 'Quản lý tác giả', '2023-10-17 14:33:38', '2023-10-17 15:29:34'),
(6, 'Quản lý danh mục', 'Quản lý danh mục', '2023-10-17 14:33:38', '2023-10-17 15:29:23'),
(7, 'Quản lý nhà xuất bản', 'Quản lý nhà xuất bản', '2023-10-17 14:33:38', '2023-10-17 15:29:10'),
(8, 'Quản lý sách', 'Quản lý sách', '2023-10-17 14:33:38', '2023-10-17 15:28:44'),
(9, 'Thông tin mượn sách', 'Thông tin mượn sách', '2023-10-17 14:33:38', '2023-10-17 15:28:32'),
(10, 'Quản lý mượn sách', 'Quản lý mượn sách', '2023-10-17 14:33:38', '2023-10-17 15:27:48'),
(11, 'Quản lý người dùng', 'Quản lý người dùng', '2023-10-17 14:33:38', '2023-10-17 15:27:24'),
(12, 'Quản lý vai trò', 'Quản lý vai trò', '2023-10-17 14:33:38', '2023-10-17 15:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `import_books`
--

CREATE TABLE `import_books` (
  `id` int UNSIGNED NOT NULL,
  `ib_books_id` int UNSIGNED DEFAULT NULL,
  `ib_amount` int NOT NULL DEFAULT '0',
  `ib_issue_number` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `import_books`
--

INSERT INTO `import_books` (`id`, `ib_books_id`, `ib_amount`, `ib_issue_number`, `created_at`) VALUES
(1, 1, 50, 10, '2023-10-17 14:34:08'),
(3, 2, 100, 50, '2023-10-17 14:34:08'),
(4, 2, 20, NULL, '2023-10-17 14:34:08'),
(5, 1, 40, 45, '2023-10-17 14:34:08'),
(6, 2, 2, NULL, '2023-10-17 14:34:08'),
(7, 1, 2, NULL, '2023-10-17 14:34:08'),
(8, 11, 30, NULL, '2023-10-17 14:34:08'),
(9, 11, 40, NULL, '2023-10-17 14:34:08'),
(10, 11, 20, NULL, '2023-10-17 14:34:08'),
(11, 11, 30, 12, '2024-03-29 07:07:46'),
(12, 10, 100, 1, '2024-03-29 07:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_04_04_100000_create_password_resets_table', 1),
(2, '2020_04_04_164509_create_users_table', 1),
(3, '2020_04_04_191839_entrust_setup_tables', 1),
(4, '2020_04_22_164601_create_department_table', 1),
(5, '2020_04_22_164713_create_class_table', 1),
(6, '2020_04_22_164926_create_reader_table', 1),
(7, '2020_04_25_142339_create_authors_table', 2),
(8, '2020_04_25_143936_create_categories_table', 2),
(9, '2020_04_25_144038_create_publishing_company_table', 2),
(10, '2020_04_25_154350_create_books_table', 2),
(11, '2020_04_25_154817_create_authors_books_table', 2),
(12, '2020_04_25_160141_create_import_books_table', 3),
(21, '2020_05_03_003724_create_borrow_table', 4),
(22, '2020_05_03_003812_create_orders_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `d_borrow_id` int UNSIGNED NOT NULL,
  `d_book_id` int UNSIGNED NOT NULL,
  `d_reader_id` int UNSIGNED NOT NULL,
  `d_number` int NOT NULL DEFAULT '1',
  `d_expiry_date` date DEFAULT NULL,
  `d_note` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d_forfeit` double DEFAULT NULL,
  `d_status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `d_borrow_id`, `d_book_id`, `d_reader_id`, `d_number`, `d_expiry_date`, `d_note`, `d_forfeit`, `d_status`, `created_at`, `updated_at`) VALUES
(35, 3, 1, 1, 1, '2022-05-18', NULL, NULL, 1, '2023-10-17 14:34:21', '2023-10-17 14:34:21'),
(37, 5, 1, 1, 1, '2022-05-17', NULL, NULL, 1, '2023-10-17 14:34:21', '2023-10-17 14:34:21'),
(38, 2, 2, 1, 2, '2020-05-19', NULL, NULL, 1, '2023-10-17 14:34:21', '2023-10-17 14:34:21'),
(39, 2, 2, 1, 1, '2020-05-31', NULL, 10, 3, '2023-10-17 14:34:21', '2023-10-17 14:34:21'),
(45, 7, 2, 5, 2, '2022-05-31', NULL, 90, 3, '2023-10-17 14:34:21', '2023-10-17 14:34:21'),
(46, 4, 1, 3, 1, '2022-06-10', NULL, 90, 2, '2023-10-17 14:34:21', '2023-10-17 14:34:21'),
(47, 4, 1, 3, 5, NULL, NULL, 10, 4, '2023-10-17 14:34:21', '2023-10-17 14:34:21'),
(48, 8, 1, 3, 1, '2022-06-15', NULL, NULL, 1, '2023-10-17 14:34:21', '2023-10-17 14:34:21'),
(49, 9, 2, 10, 1, '2023-10-22', 'trả sách', NULL, 1, '2023-10-17 14:34:21', '2023-10-17 14:34:21'),
(50, 10, 1, 2, 1, '2024-04-05', 'ghi chú', NULL, 1, '2024-03-29 07:08:57', '2024-03-29 07:08:57'),
(51, 10, 10, 2, 1, '2024-04-05', NULL, NULL, 1, '2024-03-29 07:08:57', '2024-03-29 07:08:57'),
(52, 6, 1, 5, 2, '2022-05-26', NULL, 10000, 2, '2024-03-29 07:11:11', '2024-03-29 07:11:11'),
(53, 11, 11, 2, 10, '2024-05-30', 'mượn sách ôn luyện', NULL, 1, '2024-04-28 02:31:35', '2024-04-28 02:31:35'),
(54, 12, 11, 3, 7, '2024-05-01', 'dfgdfg', NULL, 1, '2024-04-28 02:32:21', '2024-04-28 02:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_permission_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `group_permission_id`, `created_at`, `updated_at`) VALUES
(1, 'toan-quyen-quan-ly', 'Toàn quyền quản lý', 'Toàn quyền quản lý', 1, '2023-10-17 14:34:43', '2023-10-17 15:47:45'),
(2, 'danh-sach-khoi-lop', 'Danh sách khối lớp', 'Danh sách khối lớp', 2, '2023-10-17 14:34:43', '2023-10-17 15:47:30'),
(3, 'tao-moi-khoi-lop', 'Tạo mới khối lớp', 'Tạo mới khối lớp', 2, '2023-10-17 14:34:43', '2023-10-17 15:47:16'),
(4, 'cap-nhat-khoi-lop', 'Cập nhật khối lớp', 'Cập nhật khối lớp', 2, '2023-10-17 14:34:43', '2023-10-17 15:46:59'),
(5, 'xoa-khoi-lop', 'Xóa khối lớp', 'Xóa khối lớp', 2, '2023-10-17 14:34:43', '2023-10-17 15:46:46'),
(6, 'danh-sach-lop', 'Danh sách lớp', 'Danh sách lớp', 3, '2023-10-17 14:34:43', '2023-10-17 15:46:34'),
(7, 'tao-moi-lop', 'Tạo mới lớp', 'Tạo mới lớp', 3, '2023-10-17 14:34:43', '2023-10-17 15:45:49'),
(8, 'cap-nhat-lop', 'Cập nhật lớp', 'Cập nhật lớp', 3, '2023-10-17 14:34:43', '2023-10-17 15:45:19'),
(9, 'xoa-lop', 'Xóa lớp', 'Xóa lớp', 3, '2023-10-17 14:34:43', '2023-10-17 15:45:06'),
(10, 'danh-sach-nguoi-doc', 'Danh sách người đọc', 'Danh sách người đọc', 4, '2023-10-17 14:34:43', '2023-10-17 15:44:41'),
(11, 'tao-moi-nguoi-doc', 'Tạo mới người đọc', 'Tạo mới người đọc', 4, '2023-10-17 14:34:43', '2023-10-17 15:41:06'),
(12, 'cap-nhat-nguoi-doc', 'Cập nhật người đọc', 'Cập nhật người đọc', 4, '2023-10-17 14:34:43', '2023-10-17 15:40:53'),
(13, 'xoa-nguoi-doc', 'Xóa người đọc', 'Xóa người đọc', 4, '2023-10-17 14:34:43', '2023-10-17 15:40:37'),
(14, 'quan-ly-danh-sach-muon-sach', 'Quản lý danh sách mượn sách', 'Quản lý danh sách mượn sách', 4, '2023-10-17 14:34:43', '2023-10-17 15:43:53'),
(15, 'danh-sach-tac-gia', 'Danh sách tác giả', 'Danh sách tác giả', 5, '2023-10-17 14:34:43', '2023-10-17 15:39:58'),
(16, 'tao-moi-tac-gia', 'Tạo mới tác giả', 'Tạo mới tác giả', 5, '2023-10-17 14:34:43', '2023-10-17 15:39:33'),
(17, 'cap-nhat-tac-gia', 'Cập nhật tác giả', 'Cập nhật tác giả', 5, '2023-10-17 14:34:43', '2023-10-17 15:39:15'),
(18, 'xoa-tac-gia', 'Xóa tác giả', 'Xóa tác giả', 5, '2023-10-17 14:34:43', '2023-10-17 15:38:59'),
(19, 'danh-sach-danh-muc', 'Danh sách danh mục', 'Danh sách danh mục', 6, '2023-10-17 14:34:43', '2023-10-17 15:38:46'),
(20, 'tao-moi-danh-muc', 'Tạo mới danh mục', 'Tạo mới danh mục', 6, '2023-10-17 14:34:43', '2023-10-17 15:38:33'),
(21, 'cap-nhat-danh-muc', 'Cập nhật danh mục', 'Cập nhật danh mục', 6, '2023-10-17 14:34:43', '2023-10-17 15:38:20'),
(22, 'xoa-danh-muc', 'Xóa danh mục', 'Xóa danh mục', 6, '2023-10-17 14:34:43', '2023-10-17 15:38:06'),
(23, 'danh-sach-nha-xuat-ban', 'Danh sách nhà xuất bản', 'Danh sách nhà xuất bản', 7, '2023-10-17 14:34:43', '2023-10-17 15:37:53'),
(24, 'tao-moi-nha-xuat-ban', 'Tạo mới nhà xuất bản', 'Tạo mới nhà xuất bản', 7, '2023-10-17 14:34:43', '2023-10-17 15:37:38'),
(25, 'cap-nhat-nha-xuat-ban', 'Cập nhật nhà xuất bản', 'Cập nhật nhà xuất bản', 7, '2023-10-17 14:34:43', '2023-10-17 15:37:20'),
(26, 'xoa-nha-xuat-ban', 'Xóa nhà xuất bản', 'Xóa nhà xuất bản', 7, '2023-10-17 14:34:43', '2023-10-17 15:36:23'),
(27, 'danh-sach-sach', 'Danh sách sách', 'Danh sách sách', 8, '2023-10-17 14:34:43', '2023-10-17 15:36:00'),
(28, 'tao-moi-sach', 'Tạo mới sách', 'Tạo mới sách', 8, '2023-10-17 14:34:43', '2023-10-17 15:35:45'),
(29, 'cap-nhat-sach', 'Cập nhật sách', 'Cập nhật sách', 8, '2023-10-17 14:34:43', '2023-10-17 15:35:31'),
(30, 'xoa-sach', 'Xóa sách', 'Xóa sách', 8, '2023-10-17 14:34:43', '2023-10-17 15:35:17'),
(31, 'nhap-sach', 'Nhập sách', 'Nhập sách', 8, '2023-10-17 14:34:43', '2023-10-17 15:34:59'),
(32, 'danh-sach-thong-tin-muon-sach', 'Danh sách thông tin mượn sách', 'Danh sách thông tin mượn sách', 9, '2023-10-17 14:34:43', '2023-10-17 15:34:40'),
(33, 'tao-moi-thong-tin-muon-sach', 'Tạo mới thông tin mượn sách', 'Tạo mới thông tin mượn sách', 9, '2023-10-17 14:34:43', '2023-10-17 15:34:11'),
(34, 'cap-nhat-muon-sach', 'Cập nhật mượn sách', 'Cập nhật mượn sách', 9, '2023-10-17 14:34:43', '2023-10-17 15:33:54'),
(35, 'xoa-muon-sach', 'Xóa mượn sách', 'Xóa mượn sách', 9, '2023-10-17 14:34:43', '2023-10-17 15:33:38'),
(36, 'danh-sach-muon-sach', 'Danh sách mượn sách', 'Danh sách mượn sách', 10, '2023-10-17 14:34:43', '2023-10-17 15:33:24'),
(37, 'xoa-lich-su-muon-sach', 'Xóa lịch sử mượn sách', 'Xóa lịch sử mượn sách', 10, '2023-10-17 14:34:43', '2023-10-17 15:33:10'),
(38, 'danh-sach-nguoi-dung', 'Danh sách người dùng', 'Danh sách người dùng', 11, '2023-10-17 14:34:43', '2023-10-17 15:32:52'),
(39, 'them-moi-nguoi-dung', 'Thêm mới người dùng', 'Thêm mới người dùng', 11, '2023-10-17 14:34:43', '2023-10-17 15:32:39'),
(40, 'cap-nhat-nguoi-dung', 'Cập nhật người dùng', 'Cập nhật người dùng', 11, '2023-10-17 14:34:43', '2023-10-17 15:32:28'),
(41, 'xoa-nguoi-dung', 'Xóa người dùng', 'Xóa người dùng', 11, '2023-10-17 14:34:43', '2023-10-17 15:32:16'),
(42, 'danh-sach-vai-tro', 'Danh sách vai trò', 'Danh sách vai trò', 12, '2023-10-17 14:34:43', '2023-10-17 15:32:03'),
(43, 'them-moi-vai-tro', 'Thêm mới vai trò', 'Thêm mới vai trò', 12, '2023-10-17 14:34:43', '2023-10-17 15:31:50'),
(44, 'cap-nhat-vai-tro', 'Cập nhật vai trò', 'Cập nhật vai trò', 12, '2023-10-17 14:34:43', '2023-10-17 15:31:37'),
(45, 'xoa-vai-tro', 'Xóa vai trò', 'Xóa vai trò', 12, '2023-10-17 14:34:43', '2023-10-17 15:31:25'),
(46, 'xoa-du-lieu-nhap-sach', 'Xóa dữ liệu nhập sách', 'Xóa dữ liệu nhập sách', 8, '2023-10-17 14:34:43', '2023-10-17 15:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(6, 2),
(10, 2),
(11, 2),
(15, 2),
(19, 2),
(27, 2),
(28, 2),
(29, 2),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3);

-- --------------------------------------------------------

--
-- Table structure for table `publishing_company`
--

CREATE TABLE `publishing_company` (
  `id` int UNSIGNED NOT NULL,
  `pc_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pc_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pc_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pc_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pc_status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishing_company`
--

INSERT INTO `publishing_company` (`id`, `pc_name`, `pc_email`, `pc_phone`, `pc_address`, `pc_status`, `created_at`, `updated_at`) VALUES
(1, 'Nhà xuất bản Kim Đồng', 'cskh_online@nxbkimdong.com.vn', '1659020898', 'Hai Bà Trưng - Hà Nội', 1, '2023-10-17 14:35:03', '2023-10-17 14:35:03'),
(2, 'Nhà Xuất Bản trẻ', 'diemhuong1642000@gmail.com', '0383514412', 'Quảng Nam', 1, '2023-10-17 14:35:03', '2023-10-17 14:35:03'),
(3, 'Nhà xuất bản tổng hợp TP Hồ Chí Minh', 'nstonghop@gmail.com', NULL, NULL, 1, '2023-10-17 14:35:03', '2023-10-17 14:35:03'),
(4, 'Nhà xuất bản chính trị quốc gia sự thật', 'suthat@nxbctqg.vn', '0999454525255', 'Hà Nội', 1, '2023-10-17 14:35:03', '2023-10-17 14:35:03'),
(5, 'Nhà xuất bản Giáo Dục', 'edu@gmail.com', NULL, NULL, 1, '2023-10-17 14:35:03', '2023-10-17 14:35:03'),
(6, 'Nhà xuất bản Hội Nhà văn', 'hoinhavvan@gmai.com', NULL, NULL, 1, '2023-10-17 14:35:03', '2023-10-17 14:35:03'),
(7, 'Nhà xuất bản Tư Pháp', 'nxbtp@moj.gov.vn', NULL, NULL, 1, '2023-10-17 14:35:03', '2023-10-17 14:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `reader`
--

CREATE TABLE `reader` (
  `id` int UNSIGNED NOT NULL,
  `r_department_id` int UNSIGNED DEFAULT NULL,
  `r_class_id` int UNSIGNED DEFAULT NULL,
  `r_code_card` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_gender` tinyint NOT NULL DEFAULT '0',
  `r_birthday` date DEFAULT NULL,
  `r_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_number_violations` int NOT NULL DEFAULT '0',
  `r_card_created_date` date DEFAULT NULL,
  `r_card_expiry_date` date DEFAULT NULL,
  `r_status` tinyint NOT NULL DEFAULT '1',
  `r_card_status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reader`
--

INSERT INTO `reader` (`id`, `r_department_id`, `r_class_id`, `r_code_card`, `r_name`, `r_gender`, `r_birthday`, `r_address`, `r_phone`, `r_avatar`, `r_number_violations`, `r_card_created_date`, `r_card_expiry_date`, `r_status`, `r_card_status`, `created_at`, `updated_at`) VALUES
(1, 9, 1, 'pXGG7yYvbK', 'Adelia', 1, '2006-07-14', 'Tòa nhà Sông Đà, Đường Phạm Hùng, Phường Mễ Trì, Quận Nam Từ Liêm, Hà Nội', '0359020898', '609a09649b5e6dd76d242d81fd0f6eb7.jpg', 0, '2020-04-01', '2020-04-30', 1, 1, '2023-10-17 14:35:18', '2023-10-17 14:35:18'),
(2, 19, 5, '65646533', 'Tố Yên', 1, '2022-05-02', 'Quảng Ngãi', '0392206634', NULL, 0, NULL, NULL, 1, 1, '2023-10-17 14:35:18', '2023-10-17 14:35:18'),
(3, 9, 1, NULL, 'Tom', 2, '1998-07-23', 'Tòa nhà Sông Đà, Đường Phạm Hùng, Phường Mễ Trì, Quận Nam Từ Liêm, Hà Nội', '0359020898', NULL, 0, NULL, NULL, 1, 2, '2023-10-17 14:35:18', '2023-10-17 14:35:18'),
(4, 10, 2, 'NAKF2plct5', 'Piter', 1, '2020-05-05', 'thái bình', '1659020898', '87cbdcc735858d2bd74f87a07c5d8142.jpg', 0, '2020-05-04', '2020-06-30', 1, 1, '2023-10-17 14:35:18', '2023-10-17 14:35:18'),
(5, 22, 4, '4252524542', 'Diễm Hương', 1, '2019-09-03', 'Quảng Nam', '0383514413', NULL, 0, NULL, NULL, 1, 1, '2023-10-17 14:35:18', '2023-10-17 14:35:18'),
(6, 9, 5, 'V2KlmogUA1', 'Duy', 1, '2022-06-10', 'sasdfsa', 'sadas', NULL, 0, '2022-06-22', '2022-06-28', 1, 1, '2023-10-17 14:35:18', '2023-10-17 14:35:18'),
(10, 12, 5, 'CTcwYJjvPJ', 'Tấn Vỹ', 1, '2022-07-09', 'Quang', '087576247', NULL, 0, NULL, NULL, 1, 2, '2023-10-17 14:35:18', '2023-10-17 14:35:18'),
(11, 10, 2, 'SkerAe8XGy', 'Nguyễn Thị Tường Vy', 2, '2007-06-15', 'Quang Nam', '0989564783', '5eb516dd0b0c0a88a237bc3cd50f1812.jpg', 0, '2022-06-10', '2022-06-16', 1, 1, '2023-10-17 14:35:18', '2023-10-17 14:42:04'),
(12, 9, 1, 'L2uXElYm7C', 'Nguyễn Văn A', 1, '1992-07-11', 'Hà Nội', '0359020888', '02cae9c88331b8dc15ac531d8e58b265.png', 0, '2024-03-29', '2025-05-15', 1, 2, '2024-03-29 06:59:59', '2024-04-28 02:22:32');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', NULL, '2023-10-17 14:35:35', '2023-10-17 14:35:35'),
(2, 'user', 'User', NULL, '2023-10-17 14:35:35', '2024-04-28 02:35:31'),
(3, 'vai-tro-quan-ly', 'vai trò quản lý', NULL, '2023-10-17 14:35:35', '2024-03-29 07:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(3, 2),
(4, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `phone`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$wkjMG/vGGEJ21wIARDJDiOZnBxO8p5eyDrc3gw.0E9.oKNKqp0QD.', 'Admin', '0928817228565', 1, '55rC85YHZjBd0ukMWfgPo7GZULQWMI9fYR4RwszIUqIVY7vD260uh7IxoSeM', '2023-10-17 14:35:50', '2023-10-17 14:35:50'),
(2, 'docgia@gmail.com', '$2y$10$wkjMG/vGGEJ21wIARDJDiOZnBxO8p5eyDrc3gw.0E9.oKNKqp0QD.', 'User', '432423432', 1, 'XSCuHkIqbm3mgCq7ubdkHIFxUl4ZqW85I3K9jJiZlY48evGlN4AEd1nAYcOv', '2023-10-17 14:35:50', '2023-10-17 14:35:50'),
(3, 'user1@gmail.com', '$2y$10$NFKdysoENH46TqBg271qX.twVTD/0nuJ7oZSmsym3hk0mUHcGOqyG', 'User1', '0383514415', 0, NULL, '2023-10-17 14:35:50', '2023-10-17 14:47:31'),
(4, 'nguyenvanb@gmail.com', '$2y$10$HqODdvQIf5QA5ZbQWJWFue/SjuuJmYay2O.UEbbVgIVwE6dU8B90m', 'nguyễn Văn B', '0928817225', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authors_at_birthday_index` (`at_birthday`);

--
-- Indexes for table `author_book`
--
ALTER TABLE `author_book`
  ADD PRIMARY KEY (`author_id`,`book_id`),
  ADD KEY `author_book_book_id_foreign` (`book_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_b_code_book_unique` (`b_code_book`),
  ADD KEY `books_b_categories_id_foreign` (`b_categories_id`),
  ADD KEY `books_b_publishing_company_id_foreign` (`b_publishing_company_id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `borrow_b_code_borrow_unique` (`b_code_borrow`),
  ADD KEY `borrow_b_reader_id_foreign` (`b_reader_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_permission_name_unique` (`name`);

--
-- Indexes for table `import_books`
--
ALTER TABLE `import_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_d_borrow_id_foreign` (`d_borrow_id`),
  ADD KEY `orders_d_book_id_foreign` (`d_book_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD KEY `permissions_group_permission_id_foreign` (`group_permission_id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `publishing_company`
--
ALTER TABLE `publishing_company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publishing_company_pc_email_unique` (`pc_email`);

--
-- Indexes for table `reader`
--
ALTER TABLE `reader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reader_r_department_id_foreign` (`r_department_id`),
  ADD KEY `reader_r_class_id_foreign` (`r_class_id`),
  ADD KEY `reader_r_code_card_index` (`r_code_card`),
  ADD KEY `reader_r_name_index` (`r_name`),
  ADD KEY `reader_r_birthday_index` (`r_birthday`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `group_permission`
--
ALTER TABLE `group_permission`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `import_books`
--
ALTER TABLE `import_books`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `publishing_company`
--
ALTER TABLE `publishing_company`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reader`
--
ALTER TABLE `reader`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author_book`
--
ALTER TABLE `author_book`
  ADD CONSTRAINT `author_book_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `author_book_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_b_categories_id_foreign` FOREIGN KEY (`b_categories_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_b_publishing_company_id_foreign` FOREIGN KEY (`b_publishing_company_id`) REFERENCES `publishing_company` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_b_reader_id_foreign` FOREIGN KEY (`b_reader_id`) REFERENCES `reader` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_d_book_id_foreign` FOREIGN KEY (`d_book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_d_borrow_id_foreign` FOREIGN KEY (`d_borrow_id`) REFERENCES `borrow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_group_permission_id_foreign` FOREIGN KEY (`group_permission_id`) REFERENCES `group_permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reader`
--
ALTER TABLE `reader`
  ADD CONSTRAINT `reader_r_class_id_foreign` FOREIGN KEY (`r_class_id`) REFERENCES `class` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reader_r_department_id_foreign` FOREIGN KEY (`r_department_id`) REFERENCES `department` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
