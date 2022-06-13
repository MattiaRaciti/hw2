-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 06:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(16) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `username`, `url`, `created_at`, `updated_at`) VALUES
(5, 2, 'prova2', 'https://tse4.mm.bing.net/th?id=OIP.Hr73x_FbWTjl5kdKHJ0fqgHaHa&pid=Api', '2022-06-13 09:56:46', '2022-06-13 09:56:46'),
(6, 2, 'prova2', 'https://tse4.mm.bing.net/th?id=OIP.8h3FKUS1farNs-FLEYMgCQHaE8&pid=Api', '2022-06-13 09:56:47', '2022-06-13 09:56:47'),
(7, 2, 'prova2', 'https://tse4.mm.bing.net/th?id=OIP.LRhbXno2P6nMIysFcw2l_gHaHa&pid=Api', '2022-06-13 09:56:47', '2022-06-13 09:56:47'),
(8, 2, 'prova2', 'https://tse4.mm.bing.net/th?id=OIP.CjkZ0DIBaFGrKsgS37b4OQHaGo&pid=Api', '2022-06-13 09:56:48', '2022-06-13 09:56:48'),
(9, 2, 'prova2', 'https://tse4.mm.bing.net/th?id=OIP.iL7mFk-iS1VmrVozWerhRAHaGL&pid=Api', '2022-06-13 09:56:50', '2022-06-13 09:56:50'),
(10, 3, 'prova3', 'https://tse4.mm.bing.net/th?id=OIP.Z0ESbbllbUWrTxcEfiz0qQHaHa&pid=Api', '2022-06-13 09:57:13', '2022-06-13 09:57:13'),
(24, 1, 'prova', 'https://tse4.mm.bing.net/th?id=OIP.jxZC-6xKXRycgxcOgwpYtgHaE1&pid=Api', '2022-06-13 14:49:20', '2022-06-13 14:49:20'),
(25, 1, 'prova', 'https://tse4.mm.bing.net/th?id=OIP.JyPyU_vLCAt6XyKFpqfNUAHaHa&pid=Api', '2022-06-13 14:49:21', '2022-06-13 14:49:21'),
(26, 1, 'prova', 'https://tse4.mm.bing.net/th?id=OIP.8h3FKUS1farNs-FLEYMgCQHaE8&pid=Api', '2022-06-13 14:49:22', '2022-06-13 14:49:22'),
(27, 1, 'prova', 'https://tse4.mm.bing.net/th?id=OIP.fWErzWmVzSW64PN_UoGCXgHaJF&pid=Api', '2022-06-13 14:49:23', '2022-06-13 14:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `mittente` varchar(16) NOT NULL,
  `destinatario` varchar(16) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `mittente`, `destinatario`, `created_at`, `updated_at`) VALUES
(2, 'prova2', 'prova', '2022-06-13 09:56:59', '2022-06-13 09:56:59'),
(5, 'prova3', 'prova2', '2022-06-13 09:58:02', '2022-06-13 09:58:02'),
(6, 'prova', 'prova3', '2022-06-13 10:51:01', '2022-06-13 10:51:01'),
(7, 'prova6', 'prova', '2022-06-13 11:41:32', '2022-06-13 11:41:32'),
(8, 'prova6', 'prova3', '2022-06-13 11:41:39', '2022-06-13 11:41:39'),
(12, 'prova3', 'prova', '2022-06-13 13:56:09', '2022-06-13 13:56:09'),
(13, 'prova7', 'prova', '2022-06-13 13:57:26', '2022-06-13 13:57:26'),
(16, 'prova', 'prova', '2022-06-13 14:42:12', '2022-06-13 14:42:12'),
(18, 'prova2', 'prova3', '2022-06-13 14:43:12', '2022-06-13 14:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'prova', '$2y$10$iYpFnl2ogX8tdjw4Fy5Ia.eUO2bLDweJafCFHELu.fhANphEDG4kK', '2022-06-13 09:55:57', '2022-06-13 09:55:57'),
(2, 'prova2', '$2y$10$EGyA8g8yjvU3MYi3CGlBbeanbZ4iTvsqdm.is.HP8fM22a4/IPnjC', '2022-06-13 09:56:34', '2022-06-13 09:56:34'),
(3, 'prova3', '$2y$10$wXhrc7l9gsgS9A7AzjmoKekfsfeTIQnomwdSmKQ0dng8o1gHXbG1.', '2022-06-13 09:57:07', '2022-06-13 09:57:07'),
(4, 'prova4', '$2y$10$QMlnGcyVLHI9wMsPNMEQpuVmcRZWivDN0uNdgRXnPdWdqy9x59JdG', '2022-06-13 09:58:41', '2022-06-13 09:58:41'),
(5, 'prova5', '$2y$10$8CDe5l6F0cXfOYl/lmhHbOXYvIU2qNcGYcy4QcsMk1toJ77y0Evsq', '2022-06-13 10:23:04', '2022-06-13 10:23:04'),
(6, 'prova6', '$2y$10$b.k7TWPrNCBvi3mby/cbluS7/qtuQL6Q4hdBUKueXIA/Kq7B5U8UC', '2022-06-13 11:41:15', '2022-06-13 11:41:15'),
(7, 'prova7', '$2y$10$oOwpoCulnkyYuHaBkAHM1uTfgJJajrbql7F2/Wsr8aqcHedJFP1Ii', '2022-06-13 13:57:09', '2022-06-13 13:57:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
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
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
