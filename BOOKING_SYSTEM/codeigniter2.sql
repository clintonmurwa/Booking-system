-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 11:01 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slot_id` int(11) DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'confirmed',
  `service` varchar(255) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `slot_number` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `slot_id`, `booking_date`, `status`, `service`, `start_time`, `end_time`, `slot_number`, `created_by`) VALUES
(45, 31, 18, '2024-12-09 09:08:29', 'confirmed', 'Service A', '2024-12-06 10:40:00', '2024-12-06 11:40:00', '2', 'pfano'),
(46, 31, 19, '2024-12-09 09:19:50', 'confirmed', 'Service A', '2024-12-10 11:20:00', '2024-12-10 12:20:00', '66', 'pfano');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` int(11) UNSIGNED NOT NULL,
  `slot_number` varchar(50) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `slot_number`, `start_time`, `end_time`, `available`, `created_by`) VALUES
(17, '3', '2024-12-10 11:00:00', '2024-12-10 12:00:00', 0, 'pfano');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `active` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `code`, `active`, `username`, `role`) VALUES
(30, 'cmurwanthi05@gmail.com', '$2y$10$QsB/3ckRE1Gyd59w.A/iZO4xdvGUxlgfKHpJAI2HlpBP6SkjZp9lm', 'VyCQelvYt8un', 1, 'pfano', 'admin'),
(31, 'cmurwanthi05@gmail.com', '$2y$10$hEGXm7MAJSRNNqIwoJ8vQ.VhrGUuBFpJ/6sNZ1R4LdJU7wti7IzWa', '82aCokEMDPr3', 1, 'clinton', 'user'),
(46, 'pfano.murwanthi@sita.co.za', '$2y$10$7ZxTCMONyxwJ.AKeo.YYQ.0OU4e0e5EuPDFxgwpw.tujj8RGphpH.', 'xwaXDNknK7R5', 0, 'admin', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `emergency_contact` varchar(255) NOT NULL,
  `medical_conditions` text DEFAULT NULL,
  `IDno` varchar(20) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` text DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `full_name`, `dob`, `emergency_contact`, `medical_conditions`, `IDno`, `contact_number`, `address`, `nationality`, `occupation`) VALUES
(7, 30, 'Pfano Clinton Murwanthi', '2024-10-28', '0767367620', 'malaria', '0002135500147', '0767367620', '39a rabe street', 'South african', 'software developer'),
(10, 31, 'Pfano Clinton Murwanthi', '2024-11-28', '0767367621', 'malaria ,headche, back pain, diagnosed with syfodylasis', '0002135500147', '0767367620', '39a rabe street', 'South african', 'software developer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bookings_ibfk_2` (`slot_id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
