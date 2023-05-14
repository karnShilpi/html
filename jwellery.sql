-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 09:04 AM
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
-- Database: `jwellery`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `c_name` varchar(11) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `homeAddress` varchar(255) DEFAULT NULL,
  `userName` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `deleteFlag` bit(1) NOT NULL,
  `activeFlag` bit(1) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `c_name`, `phone`, `homeAddress`, `userName`, `password`, `photo`, `deleteFlag`, `activeFlag`, `amount`) VALUES
(8, 'test1', 9876543210, 'ABc road,756', '', '', NULL, b'0', b'0', 0),
(9, 'test2', 121231254, '', '', '', NULL, b'0', b'0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `shopAddress` varchar(255) DEFAULT NULL,
  `homeAddress` varchar(255) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `deleteFlag` bit(1) NOT NULL,
  `activeFlag` bit(1) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `name`, `phone`, `shopAddress`, `homeAddress`, `email`, `password`, `photo`, `deleteFlag`, `activeFlag`, `email_verified_at`) VALUES
(1, 'Shilpi', 9876543210, NULL, NULL, 'shilpikarncse94@gmail.com', '123456', NULL, b'0', b'1', '2023-05-13 06:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `phone` int(10) NOT NULL,
  `shopAddress` varchar(255) DEFAULT NULL,
  `homeAddress` varchar(255) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `deleteFlag` bit(1) NOT NULL,
  `activeFlag` bit(1) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `payment_detail`
--

CREATE TABLE `payment_detail` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `month` int(10) NOT NULL,
  `amount` double NOT NULL,
  `date` datetime NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_detail`
--

INSERT INTO `payment_detail` (`id`, `customer_id`, `month`, `amount`, `date`, `payment_mode`, `comment`) VALUES
(1, 8, 1, 1000, '0000-00-00 00:00:00', '11-01-2023', ''),
(2, 8, 2, 1000, '0000-00-00 00:00:00', '11-01-2023', ''),
(3, 8, 3, 1000, '0000-00-00 00:00:00', '11-01-2023', ''),
(4, 8, 4, 1000, '0000-00-00 00:00:00', '11-01-2023', ''),
(5, 8, 5, 1000, '0000-00-00 00:00:00', '11-01-2023', ''),
(6, 8, 6, 0, '0000-00-00 00:00:00', '', ''),
(7, 8, 7, 0, '0000-00-00 00:00:00', '', ''),
(8, 8, 8, 0, '0000-00-00 00:00:00', '', ''),
(9, 8, 9, 0, '0000-00-00 00:00:00', '', ''),
(10, 8, 10, 0, '0000-00-00 00:00:00', '', ''),
(11, 8, 11, 0, '0000-00-00 00:00:00', '', ''),
(12, 8, 12, 0, '0000-00-00 00:00:00', '', ''),
(13, 9, 1, 2000, '0000-00-00 00:00:00', '10-786', ''),
(14, 9, 2, 2000, '0000-00-00 00:00:00', '', ''),
(15, 9, 3, 0, '0000-00-00 00:00:00', '', ''),
(16, 9, 4, 0, '0000-00-00 00:00:00', '', ''),
(17, 9, 5, 0, '0000-00-00 00:00:00', '', ''),
(18, 9, 6, 0, '0000-00-00 00:00:00', '', ''),
(19, 9, 7, 0, '0000-00-00 00:00:00', '', ''),
(20, 9, 8, 0, '0000-00-00 00:00:00', '', ''),
(21, 9, 9, 0, '0000-00-00 00:00:00', '', ''),
(22, 9, 10, 0, '0000-00-00 00:00:00', '', ''),
(23, 9, 11, 0, '0000-00-00 00:00:00', '', ''),
(24, 9, 12, 0, '0000-00-00 00:00:00', '', '');

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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'shilpi', 'shilpikarncse94@gmail.com', NULL, '123456', NULL, NULL, NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'shilpi', 'shilpikarncse94@gmail.com', NULL, '123456', NULL, NULL, NULL),
(2, 'shilpi', 'skarn294@gmail.com', NULL, '$2y$10$1QKaSeI93jDNWOWq1DY3xe2pzCMngemPVB4c8cIBQLJe3AFUFfOGu', NULL, '2023-05-10 06:02:09', '2023-05-10 06:02:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_detail`
--
ALTER TABLE `payment_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_detail`
--
ALTER TABLE `payment_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
