-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 05:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `car_name` varchar(50) NOT NULL,
  `car_details` varchar(120) NOT NULL,
  `current_location` varchar(300) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `name`, `car_name`, `car_details`, `current_location`, `user_id`) VALUES
(1, 'Faiz Islam', 'BMW', 'A black Car', '', 1),
(2, 'test4', 'test4', 'test4 details', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(50) NOT NULL,
  `message` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `trip_id` int(50) NOT NULL,
  `customer_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(50) NOT NULL,
  `token` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `assigned_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `token`, `status`, `user_id`, `assigned_at`) VALUES
(1, 'RAM-GUL-122137', 'Active', 1, '2025-01-30 19:08:31'),
(2, 'BAD-NAD-122561', 'Expired', 1, '2025-01-30 18:08:31'),
(3, 'NAD-MIR-773313', 'Pending', 1, '2025-01-31 18:08:31'),
(4, 'GUL-DHA-245134', 'Expired', 1, '2025-01-28 19:08:31'),
(5, 'MOT-RAM-101002', 'Expired', 1, '2025-01-30 19:08:31'),
(6, 'KHI-FAR-435462', 'Expired', 1, '2025-01-31 10:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` int(11) NOT NULL,
  `pickup_location` varchar(300) NOT NULL,
  `destination` varchar(300) NOT NULL,
  `start_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `notes` varchar(120) DEFAULT NULL,
  `token_id` int(50) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `pickup_location`, `destination`, `start_time`, `end_time`, `status`, `notes`, `token_id`, `user_id`) VALUES
(1, 'Rampura Bazar, Dhaka', 'Gulshan, Dhaka', '2025-01-31 04:25:35', NULL, 'Ongoing', NULL, 1, 1),
(2, 'Nadda Bus Stand, Dhaka', 'Mirpur 11, Dhaka', NULL, NULL, 'Pending', NULL, 3, 1),
(3, 'Gulshan, Dhaka', 'Dhanmondi, Dhaka', '2025-01-27 04:25:35', '2025-01-27 06:00:35', 'Completed', NULL, 4, 1),
(4, 'Badda, Dhaka', 'Nadda, Dhaka', '2025-01-27 10:08:35', '2025-01-27 11:45:35', 'Completed', NULL, 5, 1),
(5, 'Motijheel, Dhaka', 'Rampura, Dhaka', '2025-01-31 03:45:35', '2025-01-31 04:45:35', 'Completed', NULL, 5, 1),
(6, 'Khilgaon, Dhaka', 'Farmgate, Dhaka', '2025-01-31 10:45:35', '2025-01-31 11:45:35', 'Completed', NULL, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(300) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `type`) VALUES
(1, 'test1@gmail.com', '$2y$10$3PLHVPM.1sbukC7Y.tV/lOLBZ.DWvLiwzTLIZ81vAaaRSYO0/WB6O', 'Driver'),
(2, 'test2@gmail.com', '$2y$10$3PLHVPM.1sbukC7Y.tV/lOLBZ.DWvLiwzTLIZ81vAaaRSYO0/WB6O', 'Admin'),
(3, 'test3@gmail.com', '$2y$10$3PLHVPM.1sbukC7Y.tV/lOLBZ.DWvLiwzTLIZ81vAaaRSYO0/WB6O', 'Customer'),
(4, 'test4@gmail.com', '$2y$10$38hWaOy.mWKjLehsXznhsu8N6X7cOsFB4vkmzERDGBiY.GevlJ2q2', 'Driver');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
