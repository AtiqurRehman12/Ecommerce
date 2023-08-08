-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2023 at 01:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(191) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(191) DEFAULT NULL,
  `event` varchar(191) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `order`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ram', 'ram', NULL, NULL, 1, 1, 1, 1, '2023-07-10 21:27:52', '2023-07-10 21:28:31', '2023-07-10 21:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(6, 'Electronics', '/storage/photos/1/Category Images/64b1348e9e10a.jpg', '2023-07-11 08:09:14', '2023-07-14 12:42:17', NULL, 1, 1, NULL),
(7, 'Clothes', '/storage/photos/1/Category Images/64b13484cab75.avif', '2023-07-11 08:13:26', '2023-07-14 12:45:24', NULL, 1, 1, NULL),
(8, 'Eyewears', '/storage/photos/1/64ad02af4d5c0.jpg', '2023-07-11 08:20:24', '2023-07-11 08:20:24', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `commentable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `commentable_type` varchar(191) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `user_name` varchar(191) DEFAULT NULL,
  `order` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `moderated_by` int(10) UNSIGNED DEFAULT NULL,
  `moderated_at` datetime DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `mime_type` varchar(191) DEFAULT NULL,
  `disk` varchar(191) NOT NULL,
  `conversions_disk` varchar(191) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2018_03_11_062135_create_posts_table', 1),
(4, '2018_03_12_062135_create_categories_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2020_02_19_173641_create_settings_table', 1),
(8, '2020_02_19_173700_create_userprofiles_table', 1),
(9, '2020_02_19_173711_create_notifications_table', 1),
(10, '2020_02_22_115918_create_user_providers_table', 1),
(11, '2020_05_01_163442_create_tags_table', 1),
(12, '2020_05_01_163833_create_polymorphic_taggables_table', 1),
(13, '2020_05_04_151517_create_comments_table', 1),
(14, '2022_04_01_132914_create_media_table', 1),
(15, '2022_04_01_133918_create_permission_tables', 1),
(16, '2022_04_01_134140_create_activity_log_table', 1),
(17, '2022_04_01_134141_add_event_column_to_activity_log_table', 1),
(18, '2022_04_01_134142_add_batch_uuid_column_to_activity_log_table', 1),
(19, '2023_03_12_195541_add_expires_at_column_to_personal_access_tokens_table', 1),
(20, '2023_07_10_053103_create_types_table', 2),
(21, '2019_05_03_000001_create_customer_columns', 3),
(22, '2019_05_03_000002_create_subscriptions_table', 3),
(23, '2019_05_03_000003_create_subscription_items_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('2b84b88c-2f0e-4d68-a097-0b0fd1f3c846', 'App\\Notifications\\NewRegistration', 'App\\Models\\User', 13, '{\"title\":\"Registration Completed!\",\"module\":\"User\",\"type\":\"created\",\"icon\":\"fas fa-user\",\"text\":\"Registration Completed! | New registration completed for <strong>Zia Doe<\\/strong>\",\"url_backend\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\\/profile\\/13\",\"url_frontend\":\"http:\\/\\/127.0.0.1:8000\\/profile\\/13\"}', NULL, '2023-07-20 12:04:09', '2023-07-20 12:04:09'),
('31c1c360-5b36-4ba6-a0ef-2c5936c127a2', 'App\\Notifications\\NewRegistration', 'App\\Models\\User', 10, '{\"title\":\"Registration Completed!\",\"module\":\"User\",\"type\":\"created\",\"icon\":\"fas fa-user\",\"text\":\"Registration Completed! | New registration completed for <strong>Ahmad Khan<\\/strong>\",\"url_backend\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\\/profile\\/10\",\"url_frontend\":\"http:\\/\\/127.0.0.1:8000\\/profile\\/10\"}', NULL, '2023-07-19 21:45:42', '2023-07-19 21:45:42'),
('35159581-b03d-4188-a9ea-5587216a717b', 'App\\Notifications\\NewRegistration', 'App\\Models\\User', 9, '{\"title\":\"Registration Completed!\",\"module\":\"User\",\"type\":\"created\",\"icon\":\"fas fa-user\",\"text\":\"Registration Completed! | New registration completed for <strong>Ali Khan<\\/strong>\",\"url_backend\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\\/profile\\/9\",\"url_frontend\":\"http:\\/\\/127.0.0.1:8000\\/profile\\/9\"}', NULL, '2023-07-19 21:31:21', '2023-07-19 21:31:21'),
('60aa25f4-3b5e-421f-8978-036fc125be36', 'App\\Notifications\\NewRegistration', 'App\\Models\\User', 11, '{\"title\":\"Registration Completed!\",\"module\":\"User\",\"type\":\"created\",\"icon\":\"fas fa-user\",\"text\":\"Registration Completed! | New registration completed for <strong>Zia Ahmad<\\/strong>\",\"url_backend\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\\/profile\\/11\",\"url_frontend\":\"http:\\/\\/127.0.0.1:8000\\/profile\\/11\"}', NULL, '2023-07-19 22:12:32', '2023-07-19 22:12:32'),
('7cbebfbd-9534-4238-8db6-fdbfcbfc602d', 'App\\Notifications\\NewRegistration', 'App\\Models\\User', 14, '{\"title\":\"Registration Completed!\",\"module\":\"User\",\"type\":\"created\",\"icon\":\"fas fa-user\",\"text\":\"Registration Completed! | New registration completed for <strong>Sada Hussain<\\/strong>\",\"url_backend\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\\/profile\\/14\",\"url_frontend\":\"http:\\/\\/127.0.0.1:8000\\/profile\\/14\"}', NULL, '2023-07-26 20:47:23', '2023-07-26 20:47:23'),
('f98128d9-e22e-4f8c-b594-1c7bafbb0bc1', 'App\\Notifications\\NewRegistration', 'App\\Models\\User', 8, '{\"title\":\"Registration Completed!\",\"module\":\"User\",\"type\":\"created\",\"icon\":\"fas fa-user\",\"text\":\"Registration Completed! | New registration completed for <strong>Atiq Ur Rehman<\\/strong>\",\"url_backend\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\\/profile\\/8\",\"url_frontend\":\"http:\\/\\/127.0.0.1:8000\\/profile\\/8\"}', NULL, '2023-07-19 15:20:11', '2023-07-19 15:20:11'),
('fdcc7b7a-ca25-4e22-b6cb-5224bdad2528', 'App\\Notifications\\NewRegistration', 'App\\Models\\User', 12, '{\"title\":\"Registration Completed!\",\"module\":\"User\",\"type\":\"created\",\"icon\":\"fas fa-user\",\"text\":\"Registration Completed! | New registration completed for <strong>Ali Khan<\\/strong>\",\"url_backend\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\\/profile\\/12\",\"url_frontend\":\"http:\\/\\/127.0.0.1:8000\\/profile\\/12\"}', NULL, '2023-07-19 22:40:22', '2023-07-19 22:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` bigint(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(125) NOT NULL,
  `guard_name` varchar(125) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_backend', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(2, 'edit_settings', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(3, 'view_logs', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(4, 'view_users', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(5, 'add_users', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(6, 'edit_users', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(7, 'delete_users', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(8, 'restore_users', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(9, 'block_users', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(10, 'view_roles', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(11, 'add_roles', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(12, 'edit_roles', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(13, 'delete_roles', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(14, 'restore_roles', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(15, 'view_backups', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(16, 'add_backups', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(17, 'create_backups', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(18, 'download_backups', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(19, 'delete_backups', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(20, 'view_posts', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(21, 'add_posts', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(22, 'edit_posts', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(23, 'delete_posts', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(24, 'restore_posts', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(25, 'view_categories', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(26, 'add_categories', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(27, 'edit_categories', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(28, 'delete_categories', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(29, 'restore_categories', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(30, 'view_tags', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(31, 'add_tags', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(32, 'edit_tags', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(33, 'delete_tags', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(34, 'restore_tags', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(35, 'view_comments', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(36, 'add_comments', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(37, 'edit_comments', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(38, 'delete_comments', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43'),
(39, 'restore_comments', 'web', '2023-07-10 12:15:43', '2023-07-10 12:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `intro` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `type` varchar(191) DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `category_name` varchar(191) DEFAULT NULL,
  `is_featured` int(11) DEFAULT NULL,
  `featured_image` varchar(191) DEFAULT NULL,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_og_image` varchar(191) DEFAULT NULL,
  `meta_og_url` varchar(191) DEFAULT NULL,
  `hits` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `moderated_by` int(10) UNSIGNED DEFAULT NULL,
  `moderated_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_by_name` varchar(191) DEFAULT NULL,
  `created_by_alias` varchar(191) DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `short_desc` text DEFAULT NULL,
  `description` longtext NOT NULL,
  `image` text NOT NULL,
  `more_images` longtext DEFAULT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `short_desc`, `description`, `image`, `more_images`, `price`, `quantity`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `deleted_by`, `updated_by`) VALUES
(4, 'Core i5 4590', 6, 'Great Cpu', '<p>This is a great <span style=\"font-size: 36px;\"><u><b>Cpu</b></u></span></p>', '/storage/photos/1/Categories/Electronics/64b0006f43d64.jpg', '/storage/photos/1/Categories/Electronics/64b0006f43d64.jpg,/storage/photos/1/Categories/Electronics/64b0008d489b0.jpg,/storage/photos/1/Categories/Electronics/64b0008e204db.webp,/storage/photos/1/Categories/Electronics/64b00095ced6b.webp', 350, 92, '2023-07-11 10:26:15', '2023-07-29 08:01:37', NULL, 1, NULL, NULL),
(5, 'Mechanical Keyboard', 6, 'Short Description of Keyboard', '<p>Great Keyboard</p>', '/storage/photos/1/64ad3dab4173a.jpg', NULL, 75, 0, '2023-07-11 12:33:40', '2023-07-26 14:38:35', NULL, 1, NULL, NULL),
(6, 'Gaming Mouse', 6, 'Great Mouse', '<p>Great Mouse <span style=\"font-size: 18px;\"><b><u>to use</u></b></span></p>', '/storage/photos/1/64ad3e43e7596.jpeg', NULL, 120, 0, '2023-07-11 12:35:22', '2023-07-22 22:46:55', NULL, 1, NULL, 1),
(8, 'Mouse', 6, 'This is a great mouse', '<p>Two Mouse</p>', '/storage/photos/1/64ad3e43e7596.jpeg', '/storage/photos/1/64ad3e43e7596.jpeg,/storage/photos/1/64ad54ca45d52.jpg', 30, 93, '2023-07-11 14:26:34', '2023-07-26 20:34:35', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(125) NOT NULL,
  `guard_name` varchar(125) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(2, 'administrator', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(3, 'manager', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(4, 'executive', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42'),
(5, 'user', 'web', '2023-07-10 12:15:42', '2023-07-10 12:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `val` text DEFAULT NULL,
  `type` char(20) NOT NULL DEFAULT 'string',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `val`, `type`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'app_name', 'E-Commerce', 'string', 1, 1, NULL, '2023-07-11 09:59:21', '2023-07-11 09:59:21', NULL),
(2, 'footer_text', 'A Simple Ecommerce Website', 'string', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(3, 'show_copyright', '1', 'text', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(4, 'email', 'info@example.com', 'string', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(5, 'facebook_url', '#', 'string', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(6, 'twitter_url', '#', 'string', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(7, 'instagram_url', '#', 'string', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(8, 'linkedin_url', '#', 'string', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(9, 'youtube_url', '#', 'string', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(10, 'meta_site_name', 'Awesome Laravel | A Laravel Starter Project', 'text', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(11, 'meta_description', 'A CMS like modular starter application project built with Laravel 10.', 'text', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(12, 'meta_keyword', 'Web Application, Laravel,Laravel starter,Bootstrap,Admin,Template,Open,Source, nasir khan, nasirkhan', 'text', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(13, 'meta_image', 'img/default_banner.jpg', 'text', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(14, 'meta_fb_app_id', '569561286532601', 'text', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(15, 'meta_twitter_site', '@nasir8891', 'text', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(16, 'meta_twitter_creator', '@nasir8891', 'text', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(17, 'google_analytics', 'G-ABCDE12345', 'text', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL),
(18, 'custom_css_block', NULL, 'string', 1, 1, NULL, '2023-07-11 09:59:22', '2023-07-11 09:59:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slide_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`, `slide_text`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `deleted_by`, `updated_by`) VALUES
(3, '/storage/photos/1/64ad0cc6bda88.jpeg', NULL, '2023-07-11 09:18:25', '2023-07-14 14:47:59', NULL, 1, NULL, 1),
(4, '/storage/photos/1/64ad398c4ebcf.jpeg', '123', '2023-07-11 12:14:52', '2023-07-14 14:48:36', NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `facebook` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `youtube` text DEFAULT NULL,
  `shipping` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`, `address`, `email`, `contact`, `facebook`, `twitter`, `linkedin`, `instagram`, `youtube`, `shipping`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'this is about us', 'abcd', 'abc@gmail.com', '3634664', 'facebook.com', 'def', 'ghi', 'jkl', 'mno', 100, '2023-07-12 22:00:48', '2023-07-18 13:58:20', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `stripe_id` varchar(191) NOT NULL,
  `stripe_status` varchar(191) NOT NULL,
  `stripe_price` varchar(191) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(191) NOT NULL,
  `stripe_product` varchar(191) NOT NULL,
  `stripe_price` varchar(191) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `group_name` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userprofiles`
--

CREATE TABLE `userprofiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `username` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `url_website` varchar(191) DEFAULT NULL,
  `url_facebook` varchar(191) DEFAULT NULL,
  `url_twitter` varchar(191) DEFAULT NULL,
  `url_instagram` varchar(191) DEFAULT NULL,
  `url_linkedin` varchar(191) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `user_metadata` text DEFAULT NULL,
  `last_ip` varchar(191) DEFAULT NULL,
  `login_count` int(11) NOT NULL DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userprofiles`
--

INSERT INTO `userprofiles` (`id`, `user_id`, `name`, `first_name`, `last_name`, `username`, `email`, `mobile`, `gender`, `url_website`, `url_facebook`, `url_twitter`, `url_instagram`, `url_linkedin`, `date_of_birth`, `address`, `bio`, `avatar`, `user_metadata`, `last_ip`, `login_count`, `last_login`, `email_verified_at`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Super Admin', 'Super', 'Admin', '100001', 'super@admin.com', '(214) 806-2011', 'Female', NULL, NULL, NULL, NULL, NULL, '1997-02-21', NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 41, '2023-07-29 11:48:10', NULL, 1, NULL, 1, NULL, '2023-07-10 12:15:42', '2023-07-29 11:48:10', NULL),
(2, 2, 'Admin Istrator', 'Admin', 'Istrator', '100002', 'admin@admin.com', '+1-541-954-6110', 'Male', NULL, NULL, NULL, NULL, NULL, '2011-04-03', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-07-10 12:15:42', '2023-07-10 12:15:42', NULL),
(3, 3, 'Manager', 'Manager', 'User User', '100003', 'manager@manager.com', '747.294.4133', 'Male', NULL, NULL, NULL, NULL, NULL, '2021-06-09', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-07-10 12:15:42', '2023-07-10 12:15:42', NULL),
(4, 4, 'Executive User', 'Executive', 'User', '100004', 'executive@executive.com', '220-520-5019', 'Other', NULL, NULL, NULL, NULL, NULL, '1997-11-11', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-07-10 12:15:42', '2023-07-10 12:15:42', NULL),
(5, 5, 'General User', 'General', 'User', '100005', 'user@user.com', '442.361.7983', 'Female', NULL, NULL, NULL, NULL, NULL, '1992-03-04', NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-07-10 12:15:42', '2023-07-10 12:15:42', NULL),
(6, 6, 'Atiq Ur Rehman', 'Atiq', 'Ur Rehman', '100006', 'abc@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 1, '2023-07-13 13:32:06', NULL, 1, NULL, 6, NULL, '2023-07-10 12:17:13', '2023-07-13 13:32:06', NULL),
(7, 7, 'John Doe', 'John', 'Doe', '100007', 'atiqf92@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 3, '2023-07-19 21:21:05', NULL, 1, NULL, 7, NULL, '2023-07-19 13:13:21', '2023-07-19 21:21:05', NULL),
(8, 8, 'Atiq Ur Rehman', 'Atiq', 'Ur Rehman', '100008', 'abc@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 3, '2023-07-19 21:19:26', NULL, 1, NULL, 8, NULL, '2023-07-19 15:20:11', '2023-07-19 21:19:26', NULL),
(10, 10, 'Ahmad Khan', 'Ahmad', 'Khan', '100010', 'ahmad@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-07-19 21:45:42', '2023-07-19 21:45:42', NULL),
(12, 12, 'Ali Khan', 'Ali', 'Khan', '100012', 'ali@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-07-19 22:40:22', '2023-07-19 22:40:22', NULL),
(13, 13, 'Zia Doe', 'Zia', 'Doe', '100013', 'zia@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 30, '2023-07-27 11:48:54', NULL, 1, NULL, 13, NULL, '2023-07-20 12:04:09', '2023-07-27 11:48:54', NULL),
(14, 14, 'Sada Hussain', 'Sada', 'Hussain', '100014', 'sada1hussain2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, '2023-07-26 20:47:23', '2023-07-26 20:47:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `username` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT 'img/default-avatar.jpg',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(191) DEFAULT NULL,
  `pm_type` varchar(191) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `card_brand` varchar(255) DEFAULT NULL,
  `card_last_four` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `username`, `email`, `mobile`, `gender`, `date_of_birth`, `email_verified_at`, `password`, `avatar`, `status`, `remember_token`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`, `card_brand`, `card_last_four`) VALUES
(1, 'Super Admin', 'Super', 'Admin', '100001', 'super@admin.com', '(214) 806-2011', 'Female', '1997-02-21', '2023-07-10 12:15:42', '$2y$10$HZ6XYn96qMgaSS45e66I0OMNWCeXi4thy19mtNY.12V7ph/S4vrCa', 'img/default-avatar.jpg', 1, NULL, NULL, NULL, NULL, '2023-07-10 12:15:42', '2023-07-10 12:15:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Admin Istrator', 'Admin', 'Istrator', '100002', 'admin@admin.com', '+1-541-954-6110', 'Male', '2011-04-03', '2023-07-10 12:15:42', '$2y$10$LHec3Pix/7SH.VS3gxGvDOHl4vJmd/F0lvyXNOtAITwVYUZxbtr1O', 'img/default-avatar.jpg', 1, NULL, NULL, NULL, NULL, '2023-07-10 12:15:42', '2023-07-10 12:15:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Manager', 'Manager', 'User User', '100003', 'manager@manager.com', '747.294.4133', 'Male', '2021-06-09', '2023-07-10 12:15:42', '$2y$10$NlulX07Yxh8CEJL8x068..yt6K9umKnYXvYDSNE4YiXpfjWKQG4Q6', 'img/default-avatar.jpg', 1, NULL, NULL, NULL, NULL, '2023-07-10 12:15:42', '2023-07-10 12:15:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Executive User', 'Executive', 'User', '100004', 'executive@executive.com', '220-520-5019', 'Other', '1997-11-11', '2023-07-10 12:15:42', '$2y$10$6LYt0wSypTzTpkDi8/Gdq.uRUsyjHnZ9MBrLntCIVotgdEPvbRvzO', 'img/default-avatar.jpg', 1, NULL, NULL, NULL, NULL, '2023-07-10 12:15:42', '2023-07-10 12:15:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'General User', 'General', 'User', '100005', 'user@user.com', '442.361.7983', 'Female', '1992-03-04', '2023-07-10 12:15:42', '$2y$10$b.MWmvIj4d4Hnw6g87ALN./MObc.LcwYGCfGl29LvyeIq.uvYm.xS', 'img/default-avatar.jpg', 1, NULL, NULL, NULL, NULL, '2023-07-10 12:15:42', '2023-07-10 12:15:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_providers`
--

CREATE TABLE `user_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(191) NOT NULL,
  `provider_id` varchar(191) NOT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delete` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_subscription_id_stripe_price_unique` (`subscription_id`,`stripe_price`),
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userprofiles`
--
ALTER TABLE `userprofiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_providers`
--
ALTER TABLE `user_providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_providers_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taggables`
--
ALTER TABLE `taggables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofiles`
--
ALTER TABLE `userprofiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_providers`
--
ALTER TABLE `user_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD CONSTRAINT `ordered_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `delete` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_providers`
--
ALTER TABLE `user_providers`
  ADD CONSTRAINT `user_providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
