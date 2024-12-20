-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 09:01 PM
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
-- Table structure for table `affiliatiions`
--

CREATE TABLE `affiliatiions` (
  `id` int(11) NOT NULL,
  `date_of_insertion` datetime NOT NULL DEFAULT current_timestamp(),
  `sponsor_id` int(11) NOT NULL,
  `sponsored_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `date_of_insertion` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `salad_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `time` varchar(5) NOT NULL,
  `status` varchar(10) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `date_of_insertion` date NOT NULL DEFAULT current_timestamp(),
  `offer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_of_expiration` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `date_of_insertion`, `offer_id`, `user_id`, `date_of_expiration`, `status`) VALUES
(1, '2024-12-02', 2, 1, '2025-01-02', 'active');

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
  `adress` varchar(30) NOT NULL,
  `sponsor_id` int(11) DEFAULT NULL,
  `role` varchar(10) NOT NULL,
  `ref` varchar(30) DEFAULT NULL,
  `subscription_id` int(11) NOT NULL,
  `subscription_status` varchar(30) NOT NULL,
  `offer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date_of_insertion`, `first_name`, `last_name`, `email`, `password`, `phone`, `adress`, `sponsor_id`, `role`, `ref`, `subscription_id`, `subscription_status`, `offer_id`) VALUES
(2, '2024-12-13 15:45:45', 'rachad', 'adekambi', 'adekambirachad@gmail.com', '$2y$10$MCwGV3KkV7o.LqxuFWbQhuiKy3Cbw8J6UlsLzIR8FZshBpWkjkcHa', 9622860, '06 bp 2879 cot', NULL, 'user', '87rac98adjkoi98', 1, 'inactive', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliatiions`
--
ALTER TABLE `affiliatiions`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affiliatiions`
--
ALTER TABLE `affiliatiions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salads`
--
ALTER TABLE `salads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
