-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 12:27 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `updel`
--

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `district_id` varchar(20) NOT NULL,
  `route_id` varchar(20) NOT NULL,
  `district` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `district_id`, `route_id`, `district`, `name`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, '3633648qetz9fwl9', '7sf962g5i7d35639', 'Aguata', 'Ejikeme Road', 'godspower', '2020-06-18 20:58:14', '2020-07-01 16:15:48', NULL),
(5, '3633648qetz9fwl9', 'h8yax3192rtnt84f', 'Maitama', 'Ugwunso Obosi is a goal', 'godspower', '2020-06-18 21:17:32', '2020-06-18 23:25:26', NULL),
(7, '68baql91t6v7634h', 'op4ch6461lsgn8t5', 'Ibadan', 'Aboki Lane', 'godspower', '2020-06-19 13:08:43', '2020-06-19 13:08:43', NULL),
(8, 'pusf7x9x2dfq149m', 't3q4928dfn3916wu', 'Ojuelegba', 'Costain', 'godspower', '2020-06-19 14:52:53', '2020-06-19 14:52:53', NULL),
(9, '2dqvg47mf36gfg8c', 't916vwzp657y34pz', 'Surulere', 'Hallo', 'Chinedu', '2020-07-01 16:11:34', '2020-07-01 16:11:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `route_id` (`route_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
