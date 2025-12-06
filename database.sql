-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2025 at 01:08 PM
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
-- Database: `membership_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `plan_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `feature1` text DEFAULT NULL,
  `feature2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `category`, `plan_name`, `price`, `feature1`, `feature2`) VALUES
(1, 'Individuals Plan', 'Basic', 16.00, 'Smart workout plan', 'At-home workouts'),
(2, 'Individuals Plan', 'Standard', 29.00, 'Personalized training', 'Gym access (5 days/week), Group fitness classes'),
(3, 'Individuals Plan', 'Premium', 45.00, '24/7 Gym access', 'Personal trainer, Nutrition guide, Sauna & pool access'),
(4, 'Couples Plan', 'Basic', 30.00, 'Access for two', 'Home workout guide, Weekend gym access'),
(5, 'Couples Plan', 'Standard', 50.00, 'Gym access (6 days/week)', 'Couple training sessions, Group fitness classes'),
(6, 'Couples Plan', 'Premium', 75.00, 'Unlimited gym access', 'Personal trainer, Nutrition plan, Spa & sauna'),
(7, 'Students Plan', 'Basic', 12.00, 'Flexible workout plans', 'Weekend gym access'),
(8, 'Students Plan', 'Standard', 22.00, 'Full-time gym access', 'Fitness classes, Free WiFi & study area'),
(9, 'Students Plan', 'Premium', 35.00, '24/7 gym access', 'Personal training, Exam stress management yoga');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `plan` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `first_name`, `last_name`, `email`, `phone`, `location`, `plan`, `created_at`) VALUES
(1, 'shaza', 'Faizer', 'shazafaizer20@gmail.com', '0777181052', 'Kaduwela', 'basic', '2025-02-01 09:19:17'),
(2, 'shaza', 'Faizer', 'shazafaizer20@gmail.com', '0777181052', 'Kaduwela', 'standard', '2025-02-01 09:28:14'),
(3, 'shaza', 'Faizer', 'shazafaizer20@gmail.com', '0777181052', 'Kaduwela', 'standard', '2025-02-01 09:30:27'),
(4, 'shaza', 'Faizer', 'shazafaizer20@gmail.com', '0777181052', 'Malabe', 'standard', '2025-02-01 09:30:51'),
(5, 'shaza', 'Faizer', 'shazafaizer20@gmail.com', '0777181052', 'Kaduwela', 'basic', '2025-02-02 07:22:58'),
(6, 'Henna', 'Hen', 'hennashaza20@gmail.com', '0777181052', 'Malabe', 'standard', '2025-02-04 09:05:07'),
(7, 'shaza', 'Faizer', 'shazafaizer20@gmail.com', '0777181052', 'Kaduwela', 'basic', '2025-02-04 17:23:35'),
(8, 'shaza', 'Faizer', 'shazafaizer20@gmail.com', '0777181052', 'Malabe', 'basic', '2025-02-07 20:56:20'),
(9, 'shaza', 'Faizer', 'shazafaizer20@gmail.com', '0777181052', 'Kaduwela', 'standard', '2025-02-08 15:29:20'),
(10, 'shaza', 'Faizer', 'hennashaza20@gmail.com', '0777181052', 'Kaduwela', 'standard', '2025-02-28 19:09:15'),
(11, 'Shaza', 'Faizer', 'shazafaizer20@gmail.com', '0741323493', 'Malabe', 'standard', '2025-09-14 11:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact1` varchar(20) NOT NULL,
  `contact2` varchar(20) DEFAULT NULL,
  `cart` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cart`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `first_name`, `last_name`, `address`, `contact1`, `contact2`, `cart`, `created_at`) VALUES
(1, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:47:53'),
(2, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:48:50'),
(3, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:50:52'),
(4, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:51:05'),
(5, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:53:04'),
(6, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:53:42'),
(7, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:54:57'),
(8, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:56:19'),
(9, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:56:37'),
(10, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:57:52'),
(11, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 08:58:04'),
(12, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 09:01:06'),
(13, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1}]', '2025-02-01 09:01:12'),
(14, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Pro Gainer\",\"price\":75,\"image\":\"Pro_Gainer.png\",\"quantity\":1}]', '2025-02-02 07:22:47'),
(15, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Creatine Monohydrate\",\"price\":25,\"image\":\"Creatine_Monohydrate.png\",\"quantity\":2},{\"name\":\"Creatine Ethyl Ester\",\"price\":32,\"image\":\"Creatine_Ethyl_Ester.png\",\"quantity\":1},{\"name\":\"Buffered Creatine\",\"price\":35,\"image\":\"Buffered_Creatine.png\",\"quantity\":1},{\"name\":\"Creatine HCL\",\"price\":30,\"image\":\"Creatine_HCL.png\",\"quantity\":1}]', '2025-02-04 17:26:54'),
(16, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Hemp Protein\",\"price\":50,\"image\":\"Hemp_Protein.png\",\"quantity\":1}]', '2025-02-08 15:35:07'),
(17, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":4}]', '2025-02-28 19:10:36'),
(18, 'shaza', 'Faizer', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Hemp Protein\",\"price\":50,\"image\":\"Hemp_Protein.png\",\"quantity\":1},{\"name\":\"Pea Protein\",\"price\":30,\"image\":\"Pea_Protein.png\",\"quantity\":1},{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1},{\"name\":\"Soy Protein\",\"price\":35,\"image\":\"Soy_Protein.png\",\"quantity\":1}]', '2025-02-28 19:15:15'),
(19, 'shaza', 'Hen', 'dkspwjnc', '044444', '46666666', '[{\"name\":\"Whey Protein\",\"price\":40,\"image\":\"Whey_Protein.png\",\"quantity\":1},{\"name\":\"Hemp Protein\",\"price\":50,\"image\":\"Hemp_Protein.png\",\"quantity\":1},{\"name\":\"Pea Protein\",\"price\":30,\"image\":\"Pea_Protein.png\",\"quantity\":1}]', '2025-04-06 11:02:58'),
(20, 'Shaza', 'Faizer', '38A/7', '0741323493', '0741323493', '[{\"name\":\"Hemp Protein\",\"price\":50,\"image\":\"Hemp_Protein.png\",\"quantity\":1},{\"name\":\"Soy Protein\",\"price\":35,\"image\":\"Soy_Protein.png\",\"quantity\":1},{\"name\":\"Whey Protein\",\"price\":40,\"image\":\"Whey_Protein.png\",\"quantity\":1}]', '2025-09-14 11:33:59'),
(21, 'Shaza', 'Faizer', '38A/7', '0741323493', '111111111111', '[{\"name\":\"Pro Gainer\",\"price\":75,\"image\":\"Pro_Gainer.png\",\"quantity\":1},{\"name\":\"Serious Mass\",\"price\":65,\"image\":\"Serious_Mass.png\",\"quantity\":1}]', '2025-09-14 17:23:44'),
(22, 'Shaza', 'Faizer', '38A/7', '0741323493', '', '[{\"name\":\"Whey Protein\",\"price\":40,\"image\":\"Whey_Protein.png\",\"quantity\":1},{\"name\":\"Casein Protein\",\"price\":45,\"image\":\"Casein_Protein.png\",\"quantity\":1},{\"name\":\"Soy Protein\",\"price\":35,\"image\":\"Soy_Protein.png\",\"quantity\":1}]', '2025-09-14 20:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'Whey Protein', 42.00, 'Whey_Protein.png'),
(2, 'Casein Protein', 45.00, 'Casein_Protein.png'),
(3, 'Soy Protein', 35.00, 'Soy_Protein.png'),
(4, 'Pea Protein', 30.00, 'Pea_Protein.png'),
(5, 'Hemp Protein', 50.00, 'Hemp_Protein.png'),
(6, 'Mass Gainer', 60.00, 'Mass_Gainer.png'),
(7, 'Weight Gainer Blend', 55.00, 'Weight_Gainer_Blend.png'),
(8, 'Super Mass Gainer', 70.00, 'Super_Mass_Gainer.png'),
(9, 'Serious Mass', 65.00, 'Serious_Mass.png'),
(10, 'Pro Gainer', 75.00, 'Pro_Gainer.png'),
(11, 'Creatine Monohydrate', 25.00, 'Creatine_Monohydrate.png'),
(12, 'Creatine HCL', 33.00, 'Creatine_HCL.png'),
(13, 'Buffered Creatine', 35.00, 'Buffered_Creatine.png'),
(14, 'Micronized Creatine', 28.00, 'Micronized_Creatine.png'),
(15, 'Creatine Ethyl Ester', 32.00, 'Creatine_Ethyl_Ester.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` enum('Male','Female','Prefer not to say') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `gender`, `created_at`) VALUES
(1, 'henna', '$2y$10$QYgqI7utbw/Z2ziXeEj7aevaK3Q6cFm4wk6M9klCOFsI2YPER84Q2', 'henaa', 'hennashaza20@gmail.com', '0777181052', 'Female', '2025-01-31 11:36:20'),
(2, 'shaza', '$2y$10$LOPkaGhxi37WL01n8M8E1OTnO7qP4R5L2raCFfJniOkhDVq5PFBru', 'Shaza', 'shazafaizer20@gmail.com', '0741323493', 'Female', '2025-01-31 16:47:36'),
(3, 'sham', '$2y$10$vCxj9CaynpVdJ7t15A9DwuwzIIsz8nbv8.cLE1bW.Ds4prHPnwESO', 'shamha', 'admin@emed.com', '0741323493', 'Male', '2025-08-21 17:30:12'),
(4, 'henshaz', '$2y$10$5cKxTA.qY3HJVLXZ0ym94u6uyTCDmPa2XK6jYdQ6/1X5Xl.G4tomO', 'henna shaza', 'hennashaza20@gmail.com', '0741323493', 'Female', '2025-09-13 14:21:09'),
(5, 'maryam', '$2y$10$orQ9DUtmUQpQ.v.9mEoxtu9Prdgmg.dmjE.0.r29dxy5uZwXtuuCm', 'maryam', 'maryam@gmail.com', '11111111', 'Female', '2025-09-14 13:39:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `username_3` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `classes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
