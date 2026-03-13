-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2026 at 01:52 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `floodguard_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `message` text NOT NULL,
  `rating` int DEFAULT '5',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `predictions`
--

CREATE TABLE `predictions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `rainfall` float NOT NULL,
  `humidity` float NOT NULL,
  `temp_avg` float NOT NULL,
  `temp_min` float NOT NULL,
  `temp_max` float NOT NULL,
  `sunshine` float NOT NULL,
  `wind_max` float NOT NULL,
  `wind_avg` float NOT NULL,
  `prediction_result` tinyint(1) NOT NULL,
  `probability` float NOT NULL,
  `risk_level` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `predictions`
--

INSERT INTO `predictions` (`id`, `user_id`, `rainfall`, `humidity`, `temp_avg`, `temp_min`, `temp_max`, `sunshine`, `wind_max`, `wind_avg`, `prediction_result`, `probability`, `risk_level`, `created_at`) VALUES
(1, 2, 90, 90, 20, 19, 32, 5, 3, 2, 1, 0.8, 'High', '2026-01-27 22:45:02'),
(2, 2, 90, 80, 20, 15, 25, 5, 3, 2, 1, 0.7, 'High', '2026-02-04 03:43:46'),
(3, 2, 90, 80, 20, 15, 25, 5, 3, 2, 1, 0.7, 'High', '2026-02-04 03:43:55'),
(4, 2, 90, 80, 20, 15, 25, 5, 3, 2, 1, 0.7, 'High', '2026-02-04 03:44:02'),
(5, 2, 29, 85, 30, 27, 35, 6, 4, 3, 0, 0.3, 'Low', '2026-03-07 16:08:13'),
(6, 2, 45, 85, 34, 31, 36, 8, 6, 5, 0, 0.35, 'Low', '2026-03-07 16:09:11'),
(7, 2, 65, 85, 45, 31, 45, 8, 6, 5, 0, 0.5, 'Medium', '2026-03-07 16:11:05'),
(8, 2, 87, 78, 30, 29, 49, 7, 7, 5, 0, 0.65, 'Medium', '2026-03-13 13:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `phone`, `created_at`, `last_login`, `is_active`) VALUES
(1, 'admin', 'admin@floodguard.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin FloodGuard', '081234567890', '2026-01-27 11:41:39', NULL, 1),
(2, 'reinhart', 'reinhartrobert23@gmail.com', '$2y$10$i2Z.fKw0yXKKchr271MW1.6A51PgjOL57uGFBUlsboKFj1jPp/rd2', 'Reinhart jens Robert', '0887435084586', '2026-01-27 12:06:09', '2026-03-13 13:07:19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `predictions`
--
ALTER TABLE `predictions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `predictions`
--
ALTER TABLE `predictions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `predictions`
--
ALTER TABLE `predictions`
  ADD CONSTRAINT `predictions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
