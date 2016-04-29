-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2016 at 07:53 AM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `chairId` int(11) NOT NULL,
  `secretaryId` int(11) NOT NULL,
  `time` int(255) NOT NULL,
  `room` varchar(150) NOT NULL,
  `agendaDeadline` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `projectId`, `chairId`, `secretaryId`, `time`, `room`, `agendaDeadline`) VALUES
(1, 2, 4, 5, 1461871800, 'E102', 1461870000),
(2, 2, 4, 6, 1462055400, 'F202', 1461978000),
(3, 1, 5, 4, 1462046100, 'A04', 1461978000);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `locked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `locked`) VALUES
(1, 'Projekt 1', 0),
(2, 'Projekt 2', 0),
(3, 'Projekt 3', 0),
(4, 'Projekt 4', 0),
(5, 'Projekt 5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Project Leader'),
(2, 'Project Secretary'),
(3, 'Member'),
(4, 'Super Member');

-- --------------------------------------------------------

--
-- Table structure for table `userhasmeetings`
--

CREATE TABLE `userhasmeetings` (
  `id` int(11) NOT NULL,
  `meetingId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `attendance` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userhasmeetings`
--

INSERT INTO `userhasmeetings` (`id`, `meetingId`, `userId`, `attendance`) VALUES
(1, 1, 4, 'Yes'),
(2, 2, 4, 'Maybe'),
(3, 3, 5, 'Yes'),
(4, 3, 4, 'Yes'),
(5, 3, 9, 'Yes'),
(7, 1, 5, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `userhasprojects`
--

CREATE TABLE `userhasprojects` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userhasprojects`
--

INSERT INTO `userhasprojects` (`id`, `userId`, `projectId`, `roleId`) VALUES
(1, 5, 1, 1),
(2, 4, 1, 2),
(3, 4, 2, 1),
(4, 5, 2, 2),
(5, 6, 3, 1),
(6, 5, 3, 2),
(7, 4, 4, 1),
(8, 6, 4, 2),
(9, 6, 5, 1),
(10, 4, 5, 2),
(11, 6, 2, 3),
(12, 7, 2, 3),
(16, 8, 2, 3),
(17, 7, 4, 4),
(18, 8, 4, 3),
(19, 9, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(2, 'Admin', 'admin', '$2y$12$PPKUUNVMXjVoPmRxFJRkQuxNQs085TEaXh5t/YW8y9iMhyv0kBqbi', 'admin'),
(4, 'Igor Racki', 'igor', '$2y$12$baWgdYIWM6mUJdu3Y8O51OGlmnc1/qVN2JZP5Y.znflE1H6BKb.Xy', 'user'),
(5, 'Michal Smigiel', 'michal', '$2y$12$oCzJefgAbdmYEDH2/jiv.uGisOVT8mGhG1rBVcPLm7jtqOWZvB3MK', 'user'),
(6, 'Lolek', 'lolek', '$2y$12$gFEnXq2RJV0pow3oZmY5xeMDrhGxEf/lZaaWdaEm.b16d8iSAmc4e', 'user'),
(7, 'User 1', 'user1', '$2y$12$w1qbA.mPI8Lx6N4T0LteQOkhRfVrANcM1RrUu5Vf1srSJXRDQJISq', 'user'),
(8, 'User 2', 'user2', '$2y$12$xNq.z/k.gMtur.ZJjFzxGeSZ53qJwM6vxT1jR6eQt.1lzUddOylty', 'user'),
(9, 'User 3', 'user3', '$2y$12$lEWgOIDAg0YLLKZ4vlKh5.zi0t4DHiqh8ki6Bhw4ujMT5bxEeceJq', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userhasmeetings`
--
ALTER TABLE `userhasmeetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userhasprojects`
--
ALTER TABLE `userhasprojects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `userhasmeetings`
--
ALTER TABLE `userhasmeetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `userhasprojects`
--
ALTER TABLE `userhasprojects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
