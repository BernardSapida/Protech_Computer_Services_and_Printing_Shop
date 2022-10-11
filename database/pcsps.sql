-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2022 at 08:00 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcsps`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(6) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `gcash_name` varchar(255) NOT NULL,
  `gcash_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'activated',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `uid`, `image`, `firstname`, `lastname`, `email`, `address`, `contact_number`, `gcash_name`, `gcash_number`, `password`, `type`, `status`, `created_at`) VALUES
(7, '39763364aba5d396', 'default.jpg', 'admin', 'admin', 'admin@gmail.com', 'admin', '09472126029', 'administrator', '09472126029', '$2y$10$wOHgiC6/463wVbdcIf1uRuj0KsaAkmg1ZjaHgi5RVt8BDkVTkgys.', 'admin', 'activated', '2022-09-30 01:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `client_carts`
--

CREATE TABLE `client_carts` (
  `id` int(6) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gcash_name` varchar(255) NOT NULL,
  `gcash_number` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `transaction_number` varchar(255) NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `total` varchar(255) NOT NULL,
  `transaction_status` varchar(255) NOT NULL DEFAULT 'Not paid',
  `item_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `client_concerns`
--

CREATE TABLE `client_concerns` (
  `id` int(6) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deleted_account`
--

CREATE TABLE `deleted_account` (
  `id` int(6) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_carts`
--
ALTER TABLE `client_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_concerns`
--
ALTER TABLE `client_concerns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleted_account`
--
ALTER TABLE `deleted_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `client_carts`
--
ALTER TABLE `client_carts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `client_concerns`
--
ALTER TABLE `client_concerns`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT for table `deleted_account`
--
ALTER TABLE `deleted_account`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
