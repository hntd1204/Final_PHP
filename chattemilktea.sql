-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2025 at 09:24 PM
-- Server version: 10.11.11-MariaDB-cll-lve
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thanhdat3_chattemilktea`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `size_large_price` decimal(10,2) NOT NULL,
  `size_small_price` decimal(10,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `size_large_price`, `size_small_price`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Cà phê đen pha phin', 'https://i.imgur.com/TH8sjoy.png', 20000.00, 15000.00, 'Cà phê đen đậm vị pha phin', '2025-02-24 13:51:20', '2025-02-26 12:16:52'),
(4, 'Cà phê sữa pha phin', 'https://i.imgur.com/mzTzTcO.jpeg', 23000.00, 18000.00, '', '2025-02-26 11:44:23', '2025-02-26 12:16:45'),
(5, 'Bạc xĩu', 'https://i.imgur.com/OUxtK9S.png', 18000.00, 23000.00, '', '2025-02-26 11:45:11', '2025-02-26 12:08:26'),
(6, 'Cà phê muối', 'https://i.imgur.com/V5ajC2C.png', 23000.00, 18000.00, '', '2025-02-26 12:14:20', '2025-02-26 12:14:20'),
(7, 'Cà phê viên tiramisu', 'https://i.imgur.com/DUeVZOQ.png', 30000.00, 22000.00, '', '2025-02-26 12:18:59', '2025-02-26 12:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Huỳnh Nguyễn Thành Đạt', 'huynhnguyenthanhdat3@gmail.com', '$2y$10$G7wDEgJ00r85r4BVzNQeXeGBuXKrJhfU7c94RA4znHIfGrHBWFOUW', 'admin');

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
