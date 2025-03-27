-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 09:40 PM
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
-- Database: `dorm`
--

-- --------------------------------------------------------

--
-- Table structure for table `dorms`
--

CREATE TABLE `dorms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `manager_d` varchar(255) NOT NULL DEFAULT 'no',
  `dorm_id` int(11) NOT NULL,
  `available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dorms`
--

INSERT INTO `dorms` (`id`, `name`, `picture`, `location`, `number`, `address`, `created_at`, `manager_d`, `dorm_id`, `available`) VALUES
(23, 'ALFAM', 'uploads/dorm.jpeg', 'salamis', '8998798', 'famagusta,salamis', '2024-12-22 16:13:38', 'yes', 23, 1),
(24, 'CCN', 'uploads/dorm1.jpeg', 'nicosia', '3435435', 'cyprus,iskele', '2024-12-22 16:14:21', 'yes', 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `status` enum('active','canceled') DEFAULT 'active',
  `start_date` date NOT NULL,
  `start_end` date NOT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `student_id`, `status`, `start_date`, `start_end`, `amount`) VALUES
(282, 66, '', '2024-12-22', '2025-01-22', 500),
(283, 66, 'active', '2024-12-22', '2025-01-22', 500);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `room_number` varchar(50) NOT NULL,
  `room_type` enum('single','double','suite') NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` enum('available','occupied','maintenance') NOT NULL DEFAULT 'available',
  `amenities` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `dorm_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `room_number`, `room_type`, `capacity`, `price`, `status`, `amenities`, `description`, `images`, `dorm_id`, `room_id`) VALUES
(44, '10', 'single', 22, 333, 'available', '', 'jnhkjnk,', 'uploads/room4.jpeg', 24, 44),
(45, '22', 'double', 33, 3333, 'available', '', 'erwerewr', 'uploads/room3.jpeg', 24, 45),
(46, '3', 'double', 2, 55, 'occupied', '', 'rtgdrthgrhg', 'uploads/room2.jpeg', 24, 46);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phonenumber` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dorm_name` varchar(255) NOT NULL,
  `dorm_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `phonenumber`, `address`, `dorm_name`, `dorm_id`, `student_id`, `role`) VALUES
(59, 'Somayeh Ahmadi', 'somir', '$2y$10$S.XmcBe99qySGZWODWyONeB0jYZ0y6HflMl8.tQ7w5VKBXgkUdRCa', 0, '', '', 0, 0, 'admin'),
(64, 'manager', 'manager', '$2y$10$XAG/KmdC0UAbfgyo1QlegOTQ8TcCBfH3d0HetzfdMq1.yShx0uKAi', 987587848, 'cyprus,iskele', 'ALFAM', 23, 0, 'manager'),
(65, 'man', 'man', '$2y$10$qYEqFmGS6.4ZoXo2977QiehMi.7OHvnJ1wMp3jc23D87tANDbH6oK', 33333333, 'famagusta', 'CCN', 24, 0, 'manager'),
(66, 'stu', 'stu', '$2y$10$FQAOrf3gnyUyselCKyYGzuaMYOUMTc5W6UWe6QPGRsV185MBbdo7a', 0, '', '', 0, 66, 'student'),
(68, 'stud', 'stud', '$2y$10$C4CBveoJHMrSUJaQF/jRs.Y31heDbCXzgHJBOJoKx26p84ZHl5w1W', 0, '', '', 0, 68, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dorms`
--
ALTER TABLE `dorms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
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
-- AUTO_INCREMENT for table `dorms`
--
ALTER TABLE `dorms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
