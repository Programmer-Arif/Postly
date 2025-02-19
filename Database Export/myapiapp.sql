-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 07:13 PM
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
-- Database: `myapiapp`
--

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2024_08_22_103909_create_posts_table', 1),
(3, '2024_08_22_104218_create_personal_access_tokens_table', 1);

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(79, 'App\\Models\\User', 1, 'API Token', '5c05e579e4a78022b495289c83ec5c8eca41fb05c2629af6e27a14db0cc08a35', '[\"*\"]', '2024-10-21 11:11:24', NULL, '2024-10-21 11:03:48', '2024-10-21 11:11:24'),
(80, 'App\\Models\\User', 1, 'API Token', '64a49b87b8068f82a52b2e5e8e7be0415dc78639ab09ac01f0a7c335cd96a68b', '[\"*\"]', '2024-12-23 22:55:23', NULL, '2024-12-23 22:54:44', '2024-12-23 22:55:23'),
(81, 'App\\Models\\User', 1, 'API Token', 'baf7b1af9b08e5164e104351c056b24939799298d918c1f5dc0f0aeb73190158', '[\"*\"]', '2024-12-24 02:58:52', NULL, '2024-12-24 02:58:37', '2024-12-24 02:58:52'),
(82, 'App\\Models\\User', 1, 'API Token', 'd5d576bde7ec3182ffbb579ad4b568b7286f2113473a1adb40059d50247a46c6', '[\"*\"]', '2024-12-24 08:34:09', NULL, '2024-12-24 08:34:05', '2024-12-24 08:34:09'),
(83, 'App\\Models\\User', 2, 'API Token', 'b437a3a773076ecf20e957e1bfba6b174831c1e69ef56c46d769621b15123e08', '[\"*\"]', '2025-02-19 08:12:37', NULL, '2025-02-19 08:12:36', '2025-02-19 08:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(19, 'fsedfs', 'fsfsfxdaxda', '1727795477.jpeg', '2024-09-25 09:21:08', '2024-10-01 09:41:17'),
(27, 'Swfwf', 'Dwj Jieq jwi88 9iu9dwdewdddddddddd', '1727795451.jpg', '2024-10-01 09:40:51', '2024-10-01 09:41:03'),
(28, 'gete', 'tetete', '1729528290.jpg', '2024-10-21 11:01:30', '2024-10-21 11:01:30'),
(29, '3w3r', '3wr3wr3w', '1729528368.jpg', '2024-10-21 11:02:49', '2024-10-21 11:02:49'),
(30, '3r3r', '3r3r3r', '1729528810.jpg', '2024-10-21 11:10:10', '2024-10-21 11:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Arif', 'arif@gmail.com', '$2y$12$aNFFJbrENL0Qf5PKgJ1//u2wHT2jKvhJGwjzEFY.JWccpS3qRWir.', '2024-08-22 12:29:52', '2024-08-22 12:29:52'),
(2, 'Raja', 'raja@gmail.com', '$2y$12$wL0MVUURSGiH/sEhpIIhS.BOvEvu6SHQi.X7YAzFhgz9ymhslsZ1a', '2024-09-22 23:08:46', '2024-09-22 23:08:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
