-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2022 at 12:24 AM
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
-- Database: `studentcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `activity_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user`, `type`, `activity`, `ip_address`, `activity_time`) VALUES
(14, '217639094', 'student', 'logged In', '::1', '2022-09-15 22:27:12'),
(15, '217639094', 'student', 'logged In', '::1', '2022-09-15 22:28:44'),
(16, '217639094', 'student', 'logged In', '::1', '2022-09-15 23:59:36'),
(17, '217639094', 'student', 'logged In', '::1', '2022-09-16 00:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(11) NOT NULL,
  `std_nbr` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `std_nbr`, `password`, `date_created`) VALUES
(5, '4566789987', '$2y$10$ISeDJWTT5CsSELcyqE7X0epAelCJIOQXV1ACMZsSLD1r5iOE8SBb.', '2022-09-15 21:20:10'),
(6, '4566789987', '$2y$10$4hUF5xCM45XU/Al9/cXVQeYu1UTPycrLJhlMq3XzjLvGQ/SvdVNv.', '2022-09-15 22:11:14'),
(7, '217639094', '$2y$10$pgj..G6jaDPk93yJ7AUacunBzoH.KJ26XnMM0BPru5uoNQMZTyjFu', '2022-09-15 22:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `login_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `username`, `ip_address`, `login_time`) VALUES
(13, 'glodinzambo@gmail.com', '::1', '2022-09-15 22:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `std_nbr` varchar(50) NOT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number_courses` varchar(255) NOT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `ready_to_graduate` varchar(255) NOT NULL,
  `enrolment_date` date NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `std_nbr`, `surname`, `name`, `gender`, `email`, `number_courses`, `receipt_number`, `ready_to_graduate`, `enrolment_date`, `date_created`) VALUES
(23, '4566789987', 'fathu', 'Yolande', 'Male', 'yola@gmail.com', '40', '34567', 'yes', '2022-09-14', '2022-09-15 22:11:14'),
(24, '217639094', 'Nzambo', 'Glodi', 'Male', 'glodinzambo@gmail.com', '5', '45', 'yes', '2022-08-30', '2022-09-15 22:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `student_activation`
--

CREATE TABLE `student_activation` (
  `id` int(11) NOT NULL,
  `std_nbr` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `activation_date` timestamp NULL DEFAULT NULL,
  `deactivation_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_activation`
--

INSERT INTO `student_activation` (`id`, `std_nbr`, `status`, `email`, `activation_date`, `deactivation_date`) VALUES
(7, '4566789987', 'inactive', 'yola@gmail.com', '2022-09-15 22:11:14', NULL),
(8, '217639094', 'active', 'glodinzambo@gmail.com', '2022-09-15 22:14:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `std_nbr` (`std_nbr`);

--
-- Indexes for table `student_activation`
--
ALTER TABLE `student_activation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student_activation`
--
ALTER TABLE `student_activation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
