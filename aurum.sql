-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2026 at 05:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aurum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'cotten cheenos', 'categories/7FH9oCBhUS1knc8AH4Em7bVS48uMJsWMCGxLxKgj.jpg', '2026-02-08 01:34:36', '2026-02-08 07:10:41'),
(2, 'Jackets', 'categories/uAKQCOaGWLmnczKgg48GyKsjGNcyQ4Tfwn7P8TK8.jpg', '2026-02-08 01:35:21', '2026-02-08 07:11:08'),
(3, 'jeans', 'categories/YN7EUynQ4Z37JEJNCzWYjE6NEMc1XDO0Mm2Xdio8.jpg', '2026-02-08 07:11:34', '2026-02-08 07:11:34'),
(4, 'shirts', 'categories/yOM8P8ZMQYA43OlzjsFA0lQQ31EM4Skrh9LXMiig.jpg', '2026-02-08 07:12:07', '2026-02-08 07:12:07'),
(5, 'coat', 'categories/kCI50L3p15xQmvEskEcdXMxGWsOBA9vTTVUSjCJN.jpg', '2026-02-08 07:12:38', '2026-02-08 07:12:38'),
(6, 'laptop', 'categories/IRBHtJUxL7sPtZBaBPFCI4aoFx3TVmOhhkRjhhMh.jpg', '2026-02-08 08:22:37', '2026-02-08 08:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `profile_image`, `otp`, `otp_expires_at`, `created_at`, `updated_at`) VALUES
(2, 'waqaer', '00pasban00@gmail.com', '$2y$12$IomYQ0IMxl9H/z2OMU.mdeLtXBPgrF2o4O158VCGlUMu4JS/C01IW', '1770532670_2x0qVL3dAO.jpg', '239889', '2026-02-08 01:39:50', '2026-02-08 01:37:51', '2026-02-08 01:37:51'),
(6, 'Waqar ahmad', '12waqar1234@gmail.com', '$2y$12$XXGAjdH7LKWx4/N/4zoXhO7ctCqqBeeGB9WyLJu7slcTEkghdSnM2', '1774717988_2l1eaAuAYQ.jpg', NULL, NULL, '2026-03-28 12:13:09', '2026-03-28 12:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
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
(5, '2025_03_17_064638_add_otp_fields_to_users_table', 1),
(6, '2025_03_17_065634_add_is_admin_to_users_table', 1),
(7, '2025_03_19_062103_create_customers_table', 1),
(8, '2025_03_27_060610_create_password_resets_table', 1),
(9, '2025_03_28_101102_create_categories_table', 1),
(10, '2025_03_28_101115_create_products_table', 1),
(11, '2019_05_03_000001_create_customer_columns', 2),
(12, '2019_05_03_000002_create_subscriptions_table', 2),
(13, '2019_05_03_000003_create_subscription_items_table', 2),
(14, '2025_06_06_000004_add_meter_id_to_subscription_items_table', 2),
(15, '2025_06_06_000005_add_meter_event_name_to_subscription_items_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('12waqar1234@gmail.com', '$2y$12$inJDDcDgRpxAYGNMjSZEWu8P.Yydq8WbvOAqqBWcPk96Cwlaqqt7e', '2026-02-08 08:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'jacket1', 364.00, 'this sis jacket', 'products/rOycNSNkxe7XkNEbWITBBVeshMrBIPZE4DInaMTA.jpg', 2, '2026-02-08 07:22:13', '2026-02-08 08:23:08'),
(3, 'jacket2', 3445.00, 'this si jacket2', 'products/Tt4TdCwZmAuKAlYngOkrCPFrlI93TlGXIUALcTIm.jpg', 2, '2026-02-08 07:22:40', '2026-02-08 07:22:40'),
(4, 'jacket3', 67766.00, 'this is jacket3', 'products/JxfIMMWRICPhOaWW57Dgp0KYsf42NG7tpQjDAEbq.jpg', 2, '2026-02-08 07:23:10', '2026-02-08 07:23:10'),
(5, 'jacket4', 787.00, 'this is jacket 4', 'products/Ckfq6bO1ryqxvV2EjZJB59zGZc57AxhwZGvj8p7z.jpg', 2, '2026-02-08 07:23:45', '2026-02-08 07:23:45'),
(6, 'jacket6', 5678.00, 'this is jacket 6', 'products/HYuHurAXNk5OxkTUjdYn45ljrLTmJ8yqbRVbriIW.jpg', 2, '2026-02-08 07:24:20', '2026-02-08 07:24:20'),
(7, 'jeans1', 6678.00, 'this is jeans 1', 'products/TMNuocVzdIMDkfsQhdebX5lEfofm72Pdk5e4hxCU.jpg', 3, '2026-02-08 07:24:45', '2026-02-08 07:24:45'),
(8, 'jeans2', 5678.00, 'this si jeans 2', 'products/uv8EY1oA8d3H3hhzuVcJOnHf6xLl8kj69iTkVKJB.jpg', 3, '2026-02-08 07:25:23', '2026-02-08 07:25:23'),
(9, 'jeans3', 234.00, 'this is jeans 3', 'products/tmnYNxZLUrLJZPv3mYDHgWJmWgdDxVD6Ubg49iVu.jpg', 3, '2026-02-08 07:25:52', '2026-02-08 07:25:52'),
(10, 'jeans4', 56789.00, 'this is jeans 4', 'products/DZnHBVEngVfAqZneJpfVz75v5Df2nysAHkeeOX2U.jpg', 3, '2026-02-08 07:26:16', '2026-02-08 07:26:16'),
(11, 'coat1', 890.00, 'this is coat1', 'products/44VgXde86oqmWORId9KPAzvWDV9B7EhE8sbOmdc1.jpg', 5, '2026-02-08 07:26:50', '2026-02-08 07:26:50'),
(12, 'coat2', 5678.00, 'this is coat 2', 'products/WZVgZneDAtsXTMrKlcPFiaB2wQJ4wCjUAWAo66nT.jpg', 5, '2026-02-08 07:27:17', '2026-02-08 07:27:17'),
(13, 'coat 3', 56789.00, 'this is coat 3', 'products/wEEBAraUizppWhFj48bbctQP82UMpO4vW6NY74Km.jpg', 5, '2026-02-08 07:27:51', '2026-02-08 07:27:51'),
(14, 'coat4', 5678.00, 'this is coat4', 'products/3BV2WZsEWzhZZYZyWsvVWIZz94ouvf5Oo8zz32yn.jpg', 5, '2026-02-08 07:28:19', '2026-02-08 07:28:19'),
(15, 'shirt1', 5678.00, 'this is shirt 1', 'products/gxgO8WgX47eaiPp0xwDXQyeaQ8m28M2NhKe36wzJ.jpg', 4, '2026-02-08 07:28:48', '2026-02-08 07:28:48'),
(16, 'shiet2', 456.00, 'this is shirt2', 'products/dI10KhNyMoD45xbbZjkY2uPumkFF0ZQqfKKKUEHA.jpg', 4, '2026-02-08 07:29:28', '2026-02-08 07:29:28'),
(17, 'shirt3', 34567.00, 'this is shiet3', 'products/vxUwpoo1e3zICBukesKla0vB76KjKfQaTnOu7WM6.jpg', 4, '2026-02-08 07:29:58', '2026-02-08 07:29:58'),
(18, 'shirt4', 345678.00, 'this is shirt 4', 'products/GLcFhyh74jJ2OzFHxGHto6cxCMsSF0t7o9JjpWzg.jpg', 4, '2026-02-08 07:30:36', '2026-02-08 07:30:36'),
(19, 'cheno1', 3456.00, 'this si cheeno1', 'products/KP8e7o6ZHRKyvvTnFUtwH4E9Gxs6BedBvO2BBwes.jpg', 1, '2026-02-08 07:32:03', '2026-02-08 07:32:03'),
(20, 'cheno2', 5678.00, 'this is cheno2', 'products/UiHrsBZFuTwU43Q6C6bVBWMu4nrhZI3PMRm5kmly.jpg', 1, '2026-02-08 07:32:24', '2026-02-08 07:32:24'),
(21, 'cheno3', 789.00, 'thuis si cheno3', 'products/4XpIMT0V9iZ6rkFnq0zPHV5GUrcRJXu1WFBUaCx0.jpg', 1, '2026-02-08 07:32:46', '2026-02-08 07:32:46'),
(22, 'cheno4', 345678.00, 'this si cheno 4', 'products/X7hRjqnnjYFjMqLPQRzJvcJuTfGkmcCuHq0enfiH.jpg', 1, '2026-02-08 07:33:15', '2026-02-08 07:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_status` varchar(255) NOT NULL,
  `stripe_price` varchar(255) DEFAULT NULL,
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
  `stripe_id` varchar(255) NOT NULL,
  `stripe_product` varchar(255) NOT NULL,
  `stripe_price` varchar(255) NOT NULL,
  `meter_id` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `meter_event_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp_code` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `stripe_id` varchar(255) DEFAULT NULL,
  `pm_type` varchar(255) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `otp_code`, `otp_expires_at`, `is_admin`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, '$2y$12$nSR/Byz8QDIkEnOq9K6DQeaNoZloCRhBW27XeOW4iW7GeEa39wgeC', NULL, '2026-02-08 01:30:37', '2026-02-08 01:30:37', NULL, NULL, 1, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

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
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscription_items_subscription_id_stripe_price_index` (`subscription_id`,`stripe_price`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
