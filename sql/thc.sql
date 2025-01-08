-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2024 at 05:02 PM
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
-- Database: `thc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashback`
--

CREATE TABLE `cashback` (
  `id` int(11) NOT NULL,
  `date_of_insertion` datetime NOT NULL DEFAULT current_timestamp(),
  `sponsor_id` int(11) NOT NULL,
  `sponsored_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `sponsored_first_name` varchar(150) NOT NULL,
  `sponsored_last_name` varchar(150) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashback`
--

INSERT INTO `cashback` (`id`, `date_of_insertion`, `sponsor_id`, `sponsored_id`, `offer_id`, `sponsored_first_name`, `sponsored_last_name`, `subscription_id`, `amount`) VALUES
(1, '2024-12-21 19:25:27', 2, 3, 2, 'Ray', 'Liota', 1, 900),
(2, '2024-12-21 19:25:27', 2, 4, 1, 'Marc', 'Doe', 2, 700),
(3, '2024-12-27 19:05:50', 2, 4, 2, 'ray', 'liota', 15, 900),
(4, '2024-12-27 19:18:22', 2, 4, 2, 'ray', 'liota', 16, 900),
(5, '2024-12-27 19:38:27', 2, 6, 3, 'net', 'work', 17, 1500),
(6, '2024-12-28 13:56:49', 2, 11, 3, 'hjkk', 'jjnjkn', 19, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(15) NOT NULL,
  `days` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `name`, `price`, `days`) VALUES
(1, 'starter', 7000, 2),
(2, 'premium', 9000, 3),
(3, 'Gold', 15000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date_of_insertion` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `salad_name` varchar(30) DEFAULT NULL,
  `day` date NOT NULL,
  `time` varchar(5) NOT NULL,
  `status` varchar(10) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date_of_insertion`, `user_id`, `salad_name`, `day`, `time`, `status`, `updated_at`) VALUES
(1, '2024-12-23 11:17:48', 2, 'Pack Tropical', '2024-12-20', '9h', 'Livrée', '2024-12-23 11:19:01'),
(3, '2024-12-23 11:19:04', 2, 'Pack Vitaminé', '2024-12-23', '11h', 'Livrée', '2024-12-23 11:19:55'),
(15, '2024-12-23 11:19:04', 2, 'Pack Tropical', '2024-12-25', '9h', 'A livrer', '2024-12-23 11:19:55'),
(16, '2024-12-23 11:19:04', 2, 'Pack Vitaminé', '2024-12-27', '13h', 'A livrer', '2024-12-23 11:19:55'),
(17, '2024-12-28 14:45:51', 10, '', '2024-12-30', '9h', 'A livrer', '2024-12-28 14:45:51'),
(18, '2024-12-28 14:49:12', 10, '', '2024-12-30', '11h', 'A livrer', '2024-12-28 14:49:12'),
(19, '2024-12-28 15:04:16', 10, '', '2024-12-30', '9h', 'A livrer', '2024-12-28 15:04:16'),
(20, '2024-12-28 15:50:25', 10, 'Pack Tropical', '2024-12-30', '9h', 'A livrer', '2024-12-28 15:50:25'),
(21, '2024-12-28 15:52:12', 10, 'Pack Tropical', '2025-01-01', '17h', 'A livrer', '2024-12-28 15:52:12'),
(22, '2024-12-28 15:53:18', 10, 'Pack Croquant', '2025-01-03', '9h', 'A livrer', '2024-12-28 15:53:18'),
(23, '2024-12-28 15:58:11', 10, 'Pack Vitaminé', '2024-12-30', '13h', 'A livrer', '2024-12-28 15:58:11'),
(24, '2024-12-28 16:39:21', 10, 'Pack Tropical', '2024-12-31', '15h', 'A livrer', '2024-12-28 16:39:21'),
(25, '2024-12-28 16:39:26', 10, 'Pack Tropical', '2024-12-31', '15h', 'A livrer', '2024-12-28 16:39:26'),
(26, '2024-12-28 16:39:38', 10, 'Pack Vitaminé', '2025-01-02', '13h', 'A livrer', '2024-12-28 16:39:38'),
(27, '2024-12-28 16:44:58', 10, 'Pack Tropical', '2024-12-31', '15h', 'A livrer', '2024-12-28 16:44:58'),
(28, '2024-12-28 16:47:30', 10, 'Pack Vitaminé', '2025-01-02', '15h', 'A livrer', '2024-12-28 16:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `salads`
--

CREATE TABLE `salads` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salads`
--

INSERT INTO `salads` (`id`, `name`, `picture`) VALUES
(1, 'Pack Vitaminé', 'public/images/pack1.jpg'),
(2, 'Pack Tropical', 'public/images/pack2.jpg'),
(3, 'Pack Croquant', 'public/images/pack3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorships`
--

CREATE TABLE `sponsorships` (
  `id` int(11) NOT NULL,
  `date_of_insertion` datetime NOT NULL DEFAULT current_timestamp(),
  `sponsor_id` int(11) NOT NULL,
  `sponsored_id` int(11) NOT NULL,
  `sponsor_first_name` varchar(150) NOT NULL,
  `sponsor_last_name` varchar(150) NOT NULL,
  `sponsored_first_name` varchar(150) NOT NULL,
  `sponsored_last_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsorships`
--

INSERT INTO `sponsorships` (`id`, `date_of_insertion`, `sponsor_id`, `sponsored_id`, `sponsor_first_name`, `sponsor_last_name`, `sponsored_first_name`, `sponsored_last_name`) VALUES
(1, '2024-12-22 11:42:26', 2, 4, 'Rachad', 'ADEKAMBI', 'Ray', 'LIOTA'),
(2, '2024-12-27 21:22:00', 2, 9, 'john', 'doe', 'test', 'testt'),
(3, '2024-12-28 13:32:00', 2, 11, '&amp;quot;john&amp;quot;', '&amp;quot;doe&amp;quot;', 'hjkk', 'jjnjkn'),
(4, '2024-12-28 13:35:37', 2, 12, 'john', 'doe', 'jlj', 'jll');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `date_of_insertion` datetime NOT NULL DEFAULT current_timestamp(),
  `offer_id` int(11) NOT NULL,
  `offer_name` varchar(100) NOT NULL,
  `offer_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(150) NOT NULL,
  `user_last_name` varchar(150) NOT NULL,
  `date_of_expiration` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `date_of_insertion`, `offer_id`, `offer_name`, `offer_price`, `user_id`, `user_first_name`, `user_last_name`, `date_of_expiration`, `status`) VALUES
(13, '2024-12-26 15:16:28', 1, 'Starter', 7000, 2, 'john', 'doe', '2025-01-25', 'Active'),
(14, '2024-12-27 18:46:29', 1, 'Starter', 7000, 4, 'ray', 'liota', '2025-01-26', 'Active'),
(15, '2024-12-27 19:05:50', 2, 'Premium', 9000, 4, 'ray', 'liota', '2025-01-26', 'Active'),
(16, '2024-12-27 19:18:22', 2, 'Premium', 9000, 4, 'ray', 'liota', '2025-01-26', 'Active'),
(17, '2024-12-27 19:38:27', 3, 'Gold', 15000, 6, 'net', 'work', '2025-01-26', 'Active'),
(18, '2024-12-28 13:49:19', 1, 'Starter', 7000, 7, 'rayyy', 'yyyyy', '2025-01-27', 'Active'),
(19, '2024-12-28 13:56:49', 3, 'Gold', 15000, 11, 'hjkk', 'jjnjkn', '2025-01-27', 'Active'),
(20, '2024-12-28 14:12:03', 2, 'Premium', 9000, 10, 'jhhkhjkh', 'jhjjjkjk', '2025-01-27', 'Active'),
(21, '2024-12-28 16:34:04', 2, 'Premium', 9000, 10, 'jhhkhjkh', 'jhjjjkjk', '2025-01-27', 'Active'),
(22, '2024-12-28 16:34:50', 1, 'Starter', 7000, 10, 'jhhkhjkh', 'jhjjjkjk', '2025-01-27', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `date_of_insertion` datetime NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phone` int(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `role` varchar(10) NOT NULL,
  `ref` varchar(30) DEFAULT NULL,
  `subscription_id` int(11) NOT NULL,
  `subscription_status` varchar(30) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `wallet` int(11) DEFAULT NULL,
  `monday` varchar(5) DEFAULT NULL,
  `tuesday` varchar(5) DEFAULT NULL,
  `wednesday` varchar(5) DEFAULT NULL,
  `thursday` varchar(5) DEFAULT NULL,
  `friday` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date_of_insertion`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `sponsor_id`, `role`, `ref`, `subscription_id`, `subscription_status`, `offer_id`, `wallet`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`) VALUES
(2, '2024-12-13 15:45:45', 'john', 'doe', 'adekambirachad@gmail.com', '$2y$10$lsE9e2GooRTFt7gH9gwdr.LUYJB5VkFVupLQ4e.kwKMCNEyEsCeVC', 96228860, 'ikro', NULL, 'user', '87rac98adjkoi98', 13, 'Active', 1, 1500, 'no', 'no', 'yes', 'no', 'no'),
(4, '2024-12-21 16:57:11', 'ray', 'liota', 'rayliota90@gmail.com', '$2y$10$H4LTZq4tPybU4AGfc99cm.7M.EaNO/ry9AjPCn3plqKOhcWQAiLou', 8989392, 'op ii nkp', 2, 'user', NULL, 0, 'inactive', 0, 0, NULL, NULL, NULL, NULL, NULL),
(6, '2024-12-22 20:52:59', 'net', 'work', 'xnetwork32@gmail.com', '$2y$10$Pz4gSI0ZTjtFaBHeJPOpmup2Q83S7ehn9oV2TNCpl/nkG6xpR2LtG', 8797089, 'hgkgkjj', 2, 'user', NULL, 0, 'Inactive', 0, 0, NULL, NULL, NULL, NULL, NULL),
(7, '2024-12-28 12:40:55', 'rayyy', 'yyyyy', 'test@test.fr', '$2y$10$7CmaN/g3T787UMgfVjdX0O9e5NDU9r5g5VPeQw4qa4LQpc70scNIy', 9889, '99809``', NULL, 'user', 'thc281349', 18, 'Active', 1, 0, NULL, NULL, NULL, NULL, NULL),
(9, '2024-12-28 13:18:50', 'uhjkhjkh', 'jhjkkjh', 'testw@test.fr', '$2y$10$g5qHNCtdW/aQhtVzce03AuCkV3gd7qi7tvnxwDIoWsK7A0a0pb.uK', 9890809, 'hjkhkjh', NULL, 'user', NULL, 0, 'Inactive', 0, 0, NULL, NULL, NULL, NULL, NULL),
(10, '2024-12-28 13:22:48', 'jhhkhjkh', 'jhjjjkjk', 'test0@test.fr', '$2y$10$El0emrxdejJle3Y2lPRtWuQT.7yJ//HjFZzroYvKzJZG6Gi5OkKFy', 8990, 'jhjhjkhjkh', NULL, 'user', 'thc281634', 22, 'Active', 1, 0, 'yes', 'yes', 'yes', 'yes', 'yes'),
(11, '2024-12-28 13:32:00', 'hjkk', 'jjnjkn', 'test0@gmail.fr', '$2y$10$pk5pLL9UDoXIHYpvMIkQjeSW8Z1q7hSBsFnwo5nKOUnawGjSGcSuC', 99900, 'jkj', 2, 'user', 'thc281356', 19, 'Active', 3, 0, NULL, NULL, NULL, NULL, NULL),
(12, '2024-12-28 13:35:37', 'jlj', 'jll', 'test@test.fr', '$2y$10$3LK1VyS3nR5dVfb8aSDOruzEsKBuS2QDmtU8IIDQ2U.iJDAhIoXiG', 909, 'kjjkl', 2, 'user', NULL, 0, 'Inactive', 0, 0, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashback`
--
ALTER TABLE `cashback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salads`
--
ALTER TABLE `salads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashback`
--
ALTER TABLE `cashback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `salads`
--
ALTER TABLE `salads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sponsorships`
--
ALTER TABLE `sponsorships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
