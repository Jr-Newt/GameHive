-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 05:17 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamehive`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(15) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `gearcat` varchar(15) NOT NULL,
  `gearimage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `gearcat`, `gearimage`) VALUES
(2, 'Keyboard', 'good item', 500, 'Consoles', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `name`, `email`, `password`, `code`, `status`) VALUES
(1, 'Issac Wilson', 'issac25@protonmail.com', '$2y$10$HYnLV73kupoW.nySyAiYMOPVUNxdEWa2bfgvNPgmUsuKK43nZDxE2', 0, 'verified'),
(2, 'Issac Wilson', 'issackureekkattil@gmail.com', '$2y$10$DX6zt6maIBRD0riVvMKJGubFyyxvlJc35cqaGjBK0M951kX5TDunG', 0, 'verified'),
(3, 'admin', '18CS2A4192@kristujayanti', '$2y$10$4PFDJ7eOPF89we4NhtrCDOtiLjxn0xXLbSAgcoKoNOpelGNUdW1M6', 680274, 'notverified'),
(4, 'admin', '18CS2A4192@kristujayanti.com', '$2y$10$LNwhByOJ0Cu.pzZR42QBa.JhIuW5EH/3RKnBbiDlBJh7idhe998MK', 0, 'verified'),
(5, 'admin', 'gamehiveofficial@gmail.com', '$2y$10$CrreVmC5pmUyshErjmtva.v/6QPVd1sFpYVhBj.oGfbjL/JwgLNde', 842100, 'notverified'),
(6, 'admin', 'gamehiveglobal@gmail.com', 'admin', 0, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
