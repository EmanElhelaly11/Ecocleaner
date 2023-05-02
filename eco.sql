-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 05:35 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eco`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `image_after` varchar(255) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `image_after`, `post_id`, `created_at`) VALUES
(39, '../assets/img/129597560616828256741.jpg', 21, '2023-04-30 03:34:34'),
(40, '../assets/img/137454766216828257275.jpg', 25, '2023-04-30 03:35:27'),
(42, '../assets/img/30174871216829357684.jpg', 29, '2023-05-01 10:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `city`, `image`, `link`, `content`, `created_at`) VALUES
(20, 2, 'Cairo', '../assets/img/1318806237168282555210.jpg', 'https://goo.gl/maps/x31LPjVGBw1KQAMH9', 'Can we clean this?', '2023-04-23 02:10:25'),
(21, 5, 'Giza', '../assets/img/19366215201682346685sdc16463.jpg', 'https://goo.gl/maps/x31LPjVGBw1KQAMH9', 'لقيت المكان ده في الجيزة مين متاح ينزل ننضفه يوم الأربعاء', '2023-04-24 14:31:25'),
(25, 1, 'Dakahlia', '../assets/img/81420436616828253877.jpg', 'https://goo.gl/maps/x31LPjVGBw1KQAMH9', 'Not Cleaned Street,\r\nIt\'s time to take action and make a change! We are calling on all able-bodied volunteers to come together and help clean up this street. By doing so, we can take pride in our community and create a safer, more welcoming environment for all.\r\n', '2023-04-28 16:17:59'),
(29, 8, 'Giza', '../assets/img/17606870851682935540.jpg', 'https://goo.gl/maps/x31LPjVGBw1KQAMH9', 'dfghjkl;', '2023-05-01 10:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Eman Elhelaly', 'emanelhelaly11@gmail.com', '$2y$10$NLGvEau77/48jh6hiL4Fbuj0u6/wgURrBcIByFbiSJz6iUeJg0AXy', '2023-03-26 15:56:18'),
(2, 'Salah Elhelaly', 'salah@gmail.com', '$2y$10$n05bnFvH3dyAmzb.jrdEs.RBLDDbIG5oKchDNKHF5Fs9Xx1fNUeRS', '2023-03-27 19:58:01'),
(5, 'ethar', 'ethar@gmail.com', '$2y$10$TexXQpB.7xr15ULQjZklaOeMXKtNyOrZWxYxuq2R4hTb9hig39S2G', '2023-04-24 14:25:19'),
(8, 'ghada', 'ghada@gmail.com', '$2y$10$cf8TJN7a5jclMD93ZpX1HeSZGkS3hd1ds4XTy6qAwXjfuqlFv9Zau', '2023-05-01 10:04:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_achievement_post` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_users` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievements`
--
ALTER TABLE `achievements`
  ADD CONSTRAINT `fk_achievement_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
