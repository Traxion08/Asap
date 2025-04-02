-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 12:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asap`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_register`
--

CREATE TABLE `ambulance_register` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `phonenumber` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `vehiclenumber` varchar(300) NOT NULL,
  `photo` varchar(2500) NOT NULL,
  `password` varchar(300) NOT NULL,
  `status` varchar(30) NOT NULL,
  `latitude` varchar(2500) NOT NULL,
  `longitude` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ambulance_register`
--

INSERT INTO `ambulance_register` (`id`, `name`, `phonenumber`, `email`, `vehiclenumber`, `photo`, `password`, `status`, `latitude`, `longitude`) VALUES
(9, 'abhirami  k r', '6238564436', 'abhiramikr824@gmail.com', 'KL 08 BB 6543', '1000165738.jpg', '098765', '', '10.5219696', '76.2287006'),
(11, 'hari', '6238204568', 'hari@gmail.com', 'KL 08 BB 1234 ', '1000166335.jpg', '121212', 'approve', '10.5219877', '76.2286861'),
(14, 'abhijitht', '9444444444', 'zoro@gmail.com', 'KL 71 AC 0369', '1000166354.jpg', '121212', 'approve', '10.5220175', '76.2287189'),
(15, 'sanjay', '9961614856', 'zoro@gmail.com', 'KL 08 BB 3456', '1000166332.jpg', '121212', '', '10.5220175', '76.2287189'),
(16, 'abhirami ', '9961614856', 'abhiramikr83@gmail.com', 'KL 08 BB 9867', '1000166335.jpg', '123456', '', '10.5220175', '76.2287189'),
(17, 'abhirami ', '9961614856', 'abhiramikr83@gmail.com', 'KL 08 BB 6754', '1000166332.jpg', '123456', 'approve', '10.5220188', '76.2287243');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `mobile` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `age` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `mobile`, `email`, `age`, `password`) VALUES
(31, 'hari', '6238204568', 'hari44144@gmail.co', '20', '121212'),
(32, 'abhirami ', '9961614856', 'abhiramikr83@gmail.com', '19', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `userphonenumber` varchar(300) NOT NULL,
  `drivername` varchar(300) NOT NULL,
  `driverphonenumber` varchar(300) NOT NULL,
  `vehiclenumber` varchar(300) NOT NULL,
  `request_time` varchar(300) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `username`, `userphonenumber`, `drivername`, `driverphonenumber`, `vehiclenumber`, `request_time`, `status`) VALUES
(2, 'abhirami ', '0987654321', 'hari', '6238204568', 'KL 08 BB 1234 ', '2025-02-06 14:48:27', 'Removed'),
(3, 'abhirami ', '0987654321', 'hari', '6238204568', 'KL 08 BB 1234 ', '2025-02-06 15:05:32', ''),
(4, 'abhirami ', '0987654321', 'hari', '6238204568', 'KL 08 BB 1234 ', '2025-02-06 15:09:02', ''),
(5, 'sanjay', '6234568797', 'hari', '6238204568', 'KL 08 BB 1234 ', '2025-02-06 15:31:06', 'Removed');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `userphonenumber` varchar(300) NOT NULL,
  `drivername` varchar(300) NOT NULL,
  `driverphonenumber` varchar(300) NOT NULL,
  `vehiclenumber` varchar(300) NOT NULL,
  `request_time` varchar(300) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `username`, `userphonenumber`, `drivername`, `driverphonenumber`, `vehiclenumber`, `request_time`, `status`) VALUES
(34, 'sanjay', '6234568797', 'hari', '6238204568', 'KL 08 BB 1234 ', '2025-02-06 15:29:07', 'Yes'),
(35, 'sanjay', '6234568797', 'abhirami  k r', '6238564436', 'KL 08 BB 6543', '2025-02-06 15:29:39', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambulance_register`
--
ALTER TABLE `ambulance_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambulance_register`
--
ALTER TABLE `ambulance_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
