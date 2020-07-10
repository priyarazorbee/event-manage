-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2020 at 03:18 PM
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
  `image` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `description`, `image`) VALUES
(1, '', '', ''),
(2, '', '', ''),
(3, '', '', ''),
(4, '', '', ''),
(5, '', '', ''),
(6, '', '', ''),
(7, '', '', ''),
(8, '', '', ''),
(9, '', '', 'upload/Desert.jpg'),
(10, '', '', 'upload/Chrysanthemum.jpg'),
(11, '', '', 'upload/Chrysanthemum.jpg'),
(12, 'test', 'test', '1.jpg'),
(13, 'new', 'test', '2.jpg'),
(14, 'new', '2323', 'Desert.jpg');

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
  MODIFY `id` int(120) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
