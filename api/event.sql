-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2020 at 03:06 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(120) NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` varchar(120) NOT NULL,
  `action` int(120) NOT NULL,
  `image` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `description`, `action`, `image`) VALUES
(1, 'juy', 'huhu', 1, 'api/upload/2.jpg'),
(2, 'new', '2323', 1, 'api/upload/'),
(3, '', '', 0, ''),
(4, 'hjhj', 'hjhj', 1, 'api/upload/1.jpg'),
(5, '', '', 0, ''),
(6, '', '', 0, ''),
(7, '', '', 0, ''),
(8, '', '', 0, ''),
(9, '', '', 0, 'upload/Desert.jpg'),
(10, '', '', 0, 'upload/Chrysanthemum.jpg'),
(11, '', '', 0, 'upload/Chrysanthemum.jpg'),
(12, 'test', 'test', 0, '1.jpg'),
(13, 'new', 'test', 0, '2.jpg'),
(14, 'new', '2323', 0, 'Desert.jpg'),
(15, 'test', 'test', 0, 'Lighthouse.jpg'),
(16, 'test', 'test', 0, 'Lighthouse.jpg'),
(17, 'test2', 'test2', 1, 'Tulips.jpg'),
(18, 'new2', 'test3', 1, 'Jellyfish.jpg'),
(19, 'new2', 'test5', 2, 'Jellyfish.jpg'),
(20, 'test2', '2323', 2, 'Tulips.jpg'),
(21, 'test2', '2323', 1, 'Penguins.jpg'),
(22, 'new55', '2323uy', 1, 'Hydrangeas.jpg'),
(23, '12', 'r4', 1, 'Tulips.jpg'),
(24, 'hello', 'hello', 1, 'Chrysanthemum.jpg'),
(25, 'new5522', '2323gy', 1, 'Penguins.jpg'),
(26, 'reere', 'ere', 1, 'upload/Koala.jpg'),
(27, 'new5543', 'test2343', 1, 'api/upload/Penguins.jpg'),
(28, 'news', 'newsss', 2, 'api/upload/images.jpg'),
(29, 'test', 'test', 1, 'api/upload/1.jpg'),
(30, 'new', 'test', 1, 'api/upload/11.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `name`) VALUES
(1, 'priya', '12345', 'priya@razorbee.com', ''),
(2, 'test', 'fa3cfb3f1bb823aa9501f88f1f95f732ee6fef2c3a48be7f1d', 'test', ''),
(3, 'test', 'fa3cfb3f1bb823aa9501f88f1f95f732ee6fef2c3a48be7f1d', 'test@razorbee.com', ''),
(4, 'new', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3ca', 'new@razorbee.com', ''),
(5, '', '68487dc295052aa79c530e283ce698b8c6bb1b42ff0944252e', 'priyaece38@gmail.com', ''),
(6, '', '4cc8f4d609b717356701c57a03e737e5ac8fe885da8c7163d3', 'newss@yahoo.com', ''),
(7, '', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3ca', 'wewe@razorbee.com', NULL),
(8, '', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc', 'priyaa@razorbee.com', NULL),
(9, 'wreee', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc', 'wree@razorbee.com', NULL),
(10, 'path', 'a0af9f865bf637e6736817f4ce552e4cdf7b8c36ea75bc254c', 'path@gmail.com', 'path'),
(11, 'priyarr', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12', 'priyarr@razorbee.com', 'priyarr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(120) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
