-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 10:04 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamify`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('text','number','select','checkbox') COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`options`)),
  `applies_to` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `type`, `options`, `applies_to`, `created_at`, `updated_at`) VALUES
(1, 'Server', 'select', '[\"NA\",\"EU\",\"ASIA\"]', '1', '2025-03-17 05:06:09', '2025-03-17 05:06:09'),
(2, 'Rank', 'select', '[\"Bronze\",\"Silver\",\"Gold\",\"Platinum\",\"Diamond\"]', '1', '2025-03-17 05:06:09', '2025-03-17 05:06:09'),
(3, 'Level', 'select', '[\"1-10\",\"11-20\",\"21-30\",\"31-40\",\"41+\"]', '1', '2025-03-17 05:06:09', '2025-03-17 05:06:09'),
(4, 'Delivery Speed', 'select', '[\"Instant\",\"1-6 Hours\",\"6-12 Hours\",\"1-2 Days\"]', '2', '2025-03-17 05:06:09', '2025-03-17 05:06:09'),
(5, 'Warranty Period', 'select', '[\"No Warranty\",\"7 Days\",\"30 Days\",\"Lifetime\"]', '2', '2025-03-17 05:06:09', '2025-03-17 05:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_category`
--

CREATE TABLE `attribute_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_category`
--

INSERT INTO `attribute_category` (`id`, `attribute_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 2, 2, NULL, NULL),
(6, 2, 3, NULL, NULL),
(7, 3, 2, NULL, NULL),
(8, 3, 3, NULL, NULL),
(9, 3, 4, NULL, NULL),
(10, 4, 1, NULL, NULL),
(11, 4, 2, NULL, NULL),
(12, 4, 3, NULL, NULL),
(13, 4, 4, NULL, NULL),
(14, 5, 1, NULL, NULL),
(15, 5, 2, NULL, NULL),
(16, 5, 3, NULL, NULL),
(17, 5, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_game`
--

CREATE TABLE `attribute_game` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_game`
--

INSERT INTO `attribute_game` (`id`, `attribute_id`, `game_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 2, 1, NULL, NULL),
(7, 2, 2, NULL, NULL),
(8, 2, 3, NULL, NULL),
(9, 2, 4, NULL, NULL),
(10, 2, 5, NULL, NULL),
(11, 3, 1, NULL, NULL),
(12, 3, 2, NULL, NULL),
(13, 3, 3, NULL, NULL),
(14, 3, 4, NULL, NULL),
(15, 3, 5, NULL, NULL),
(16, 4, 1, NULL, NULL),
(17, 4, 2, NULL, NULL),
(18, 4, 3, NULL, NULL),
(19, 4, 4, NULL, NULL),
(20, 4, 5, NULL, NULL),
(21, 5, 1, NULL, NULL),
(22, 5, 2, NULL, NULL),
(23, 5, 3, NULL, NULL),
(24, 5, 4, NULL, NULL),
(25, 5, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gold', '2025-03-12 05:21:01', '2025-03-12 05:21:01'),
(2, 'Accounts', '2025-03-12 05:21:01', '2025-03-12 05:21:01'),
(3, 'Boosting', '2025-03-12 05:21:01', '2025-03-12 05:21:01'),
(4, 'Items', '2025-03-12 05:21:01', '2025-03-12 05:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `category_game`
--

CREATE TABLE `category_game` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_game`
--

INSERT INTO `category_game` (`id`, `category_id`, `game_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 1, 2, NULL, NULL),
(6, 4, 2, NULL, NULL),
(7, 2, 3, NULL, NULL),
(8, 3, 3, NULL, NULL),
(9, 2, 4, NULL, NULL),
(10, 3, 4, NULL, NULL),
(11, 4, 4, NULL, NULL),
(12, 2, 5, NULL, NULL),
(13, 3, 5, NULL, NULL),
(14, 4, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'World of Warcraft', 'uploads/games/1.webp', '2025-03-12 05:21:06', '2025-03-12 05:21:06'),
(2, 'League of Legends', 'uploads/games/2.webp', '2025-03-12 05:21:06', '2025-03-12 05:21:06'),
(3, 'Fortnite', 'uploads/games/3.webp', '2025-03-12 05:21:06', '2025-03-12 05:21:06'),
(4, 'Counter-Strike 2', 'uploads/games/4.webp', '2025-03-12 05:21:07', '2025-03-12 05:21:07'),
(5, 'Call of Duty: Warzone', 'uploads/games/5.webp', '2025-03-12 05:21:07', '2025-03-12 05:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `game_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`images`)),
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `game_id`, `title`, `description`, `price`, `images`, `feature_image`, `seller_id`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 'Gold', 'Horde Gold', 0.0366, '\"[\\\"uploads\\\\\\/items\\\\\\/1744016118.48032.png\\\"]\"', 'uploads/items/1744016118.48032.png', 23, '2025-04-07 03:55:18', '2025-04-07 03:55:18'),
(5, 1, 1, 'Gold', 'EU Gold Alliance', 0.0655, '\"[\\\"uploads\\\\\\/items\\\\\\/1744016155.86598.png\\\"]\"', 'uploads/items/1744016155.86598.png', 23, '2025-04-07 03:55:55', '2025-04-07 03:55:55'),
(6, 2, 1, 'Warrior level spineshatter Horde 60 Orc male gear 641 mount 60 % 36 gold', 'Offer description\r\nReal name / Fake name : fake\r\nRealm: spineshatter horde\r\nRace: orc male\r\nClass: Warrior\r\nLvl: 60\r\nGear: 641\r\nCountry:Netherlands\r\nGametime:until 19 Apr 2025\r\nmore info: \r\nMount: 60%\r\n36 gold\r\n-First Aid is max skill.', 190, '\"[\\\"uploads\\\\\\/items\\\\\\/1744123592.29192.webp\\\"]\"', 'uploads/items/1744123592.29192.webp', 21, '2025-04-08 09:46:32', '2025-04-08 09:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `item_attributes`
--

CREATE TABLE `item_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_attributes`
--

INSERT INTO `item_attributes` (`id`, `item_id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(9, 4, 1, 'NA', '2025-04-07 03:55:18', '2025-04-07 03:55:18'),
(10, 4, 4, '6-12 Hours', '2025-04-07 03:55:18', '2025-04-07 03:55:18'),
(11, 4, 5, 'No Warranty', '2025-04-07 03:55:18', '2025-04-07 03:55:18'),
(12, 5, 1, 'EU', '2025-04-07 03:55:55', '2025-04-07 03:55:55'),
(13, 5, 4, '1-2 Days', '2025-04-07 03:55:55', '2025-04-07 03:55:55'),
(14, 5, 5, 'No Warranty', '2025-04-07 03:55:55', '2025-04-07 03:55:55'),
(15, 6, 1, 'EU', '2025-04-08 09:46:32', '2025-04-08 09:46:32'),
(16, 6, 2, 'Platinum', '2025-04-08 09:46:32', '2025-04-08 09:46:32'),
(17, 6, 3, '41+', '2025-04-08 09:46:32', '2025-04-08 09:46:32'),
(18, 6, 4, '6-12 Hours', '2025-04-08 09:46:32', '2025-04-08 09:46:32'),
(19, 6, 5, '7 Days', '2025-04-08 09:46:32', '2025-04-08 09:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_03_08_104049_create_jobs_table', 3),
(7, '2025_03_12_092222_create_categories_table', 4),
(8, '2025_03_12_092249_create_games_table', 4),
(9, '2025_03_12_092304_create_attributes_table', 4),
(10, '2025_03_12_092313_create_items_table', 4),
(11, '2025_03_13_090551_add_google_id_to_users_table', 5),
(12, '2025_03_13_101455_add_facebook_id_to_users_table', 6),
(13, '2025_03_18_053428_create_category_game_table', 7),
(14, '2025_03_19_080619_create_item_attributes_table', 8),
(15, '2025_03_08_094011_create_sellers_table', 9),
(16, '2025_04_06_114547_create_attribute_category_table', 10),
(17, '2025_04_06_114551_create_attribute_game_table', 10);

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `selling_option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Individual',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_photo_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_photo_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `user_id`, `selling_option`, `first_name`, `middle_name`, `last_name`, `dob`, `nationality`, `street_address`, `city`, `country`, `postal_code`, `main_photo_1`, `main_photo_2`, `created_at`, `updated_at`) VALUES
(4, 23, 'Individual', 'syed', NULL, 'jalal', '2025-04-08', 'Afghanistan', 'i-9/4, islamabad', 'Islamabad', 'Pakistan', '04483', 'uploads/seller_verification/1743936129.14193.png', 'uploads/seller_verification/1743936129.14311.png', '2025-04-06 05:42:09', '2025-04-06 05:42:09'),
(5, 21, 'Individual', 'Syed', '..', '..', '1996-01-01', 'Afghanistan', '2354', '2354', 'Afghanistan', '253', 'uploads/seller_verification/1744123320.79681.png', 'uploads/seller_verification/1744123320.47577.png', '2025-04-08 09:42:00', '2025-04-08 09:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','customer','vendor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `facebook_id`, `google_id`, `email_verified_at`, `role`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, NULL, '2025-03-01 08:12:20', 'admin', 'inactive', '$2y$12$FnNO5DHxgQzgFwq0bPJ1YORc0TTL14jR7uEazQYpXi/qZA0xhP8iS', '2J71ZvI7BDohZ6rfWhWkgF13bFAQbldIZjMYpZv7rqtMIBJgH0qtHBXgWIVM', NULL, NULL),
(2, 'Vendor', 'vendor@vendor.com', NULL, NULL, '2025-03-08 08:12:26', 'vendor', 'inactive', '$2y$12$iEvEV6oC.6qFv6rUtxopgubOb4.zXnbZvCvFx70G10hipBZIRBmJ6', NULL, NULL, NULL),
(3, 'Customer', 'customer@customer.com', NULL, NULL, '2025-03-01 08:12:30', 'customer', 'inactive', '$2y$12$Q7YJZ6K6t8AWttMZD5OWrO1gBPq74QFSQYmOC5y/YWp/0IrL28iuO', NULL, NULL, NULL),
(21, 'Syed Jalal', 'syedjalal874@gmail.com', NULL, '103367848380512544743', '2025-03-13 06:13:25', 'customer', 'inactive', '$2y$12$No.s6OXKKXHN28fstXcAtu7ftyMkdR2i.zUXMxlDex9VFqTsNkOPy', NULL, '2025-03-13 06:13:25', '2025-03-13 06:13:25'),
(23, 'Syed Jalal Shah', 'syedjalal339@gmail.com', '2068622606951606', NULL, '2025-03-14 05:08:21', 'customer', 'inactive', '$2y$12$Ffi6EK3GhSmEeIwrGxlDgegebCkBUVQFqAoJC/03sP914EMsz.hsW', NULL, '2025-03-14 05:08:21', '2025-03-14 05:08:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_category`
--
ALTER TABLE `attribute_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_category_attribute_id_foreign` (`attribute_id`),
  ADD KEY `attribute_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `attribute_game`
--
ALTER TABLE `attribute_game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_game_attribute_id_foreign` (`attribute_id`),
  ADD KEY `attribute_game_game_id_foreign` (`game_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_game`
--
ALTER TABLE `category_game`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_game_category_id_foreign` (`category_id`),
  ADD KEY `category_game_game_id_foreign` (`game_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`),
  ADD KEY `items_game_id_foreign` (`game_id`),
  ADD KEY `items_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `item_attributes`
--
ALTER TABLE `item_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_attributes_item_id_foreign` (`item_id`),
  ADD KEY `item_attributes_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellers_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attribute_category`
--
ALTER TABLE `attribute_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `attribute_game`
--
ALTER TABLE `attribute_game`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_game`
--
ALTER TABLE `category_game`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_attributes`
--
ALTER TABLE `item_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_category`
--
ALTER TABLE `attribute_category`
  ADD CONSTRAINT `attribute_category_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_game`
--
ALTER TABLE `attribute_game`
  ADD CONSTRAINT `attribute_game_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_game_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_game`
--
ALTER TABLE `category_game`
  ADD CONSTRAINT `category_game_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_game_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_attributes`
--
ALTER TABLE `item_attributes`
  ADD CONSTRAINT `item_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_attributes_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
