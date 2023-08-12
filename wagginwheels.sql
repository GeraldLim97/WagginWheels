-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 12:16 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wagginwheels`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `breed` varchar(50) DEFAULT NULL,
  `weight` int(3) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `size` varchar(7) DEFAULT NULL,
  `neutered` tinyint(1) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `fulfilled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `breed`, `weight`, `date`, `time`, `name`, `size`, `neutered`, `userid`, `fulfilled`) VALUES
(1, 'chicken', 21, '2023-06-22', '11:10:00', 'Benji', 'medium', 0, 1, 0),
(2, 'chicken', 22, '2023-06-23', '11:10:00', 'Benji', 'medium', 0, 2, 0),
(3, 'chicken', 22, '2023-06-24', '10:10:00', 'Benji', 'medium', 0, 3, 0),
(4, 'chicken', 22, '2023-06-24', '10:15:00', 'austin', 'medium', 0, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `testimony` text NOT NULL,
  `rating` int(1) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `testimony`, `rating`, `userid`) VALUES
(1, 'I like this website, I love the color scheme.', 5, 0),
(2, 'This website is too yellow', 2, 0),
(5, 'This website is mobile responsive, I love it', 5, 0),
(6, 'I hate how the website\'s color is so monochromatic, pretty neat though', 3, 0),
(7, 'I love waggin\'', 5, 0),
(8, 'I think this concept is pretty cool', 4, 1),
(9, 'I hate this website', 1, 0),
(10, 'I hate this website', 1, 0),
(11, 'hello, i am darius', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` char(60) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `pfp` blob,
  `email` varchar(80) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT '1',
  `deactivate` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `pfp`, `email`, `phone`, `role`, `deactivate`) VALUES
(1, 'darius', '$2y$10$H2IJfUsautcnV/EJ5363yee2dg4ZGWRhyuHMMoKSp6RYc5naX8Aey', 'darius', NULL, 'darius@gmail.com', '922', 1, 0),
(2, 'dw', '$2y$10$K87zvLaHeb17n.ZYRw8i9eiuFz79GVYHgYa26fEiiqGBAsfmhaE/2', 'Dw', NULL, '', '92233622', 1, 0),
(3, 'daris', '$2y$10$NreWLKlrMYEa7ROvWqBKTeCCjW1m52Mb.yC3jqQ3Gde.wlEF4/Nui', 'Dw', NULL, 'dw@gmail.com', '92233622', 1, 0),
(4, 'admin', '$2y$10$9bzuUg4zHMaxkah9lHGut.kVoWNkglHDNvuBkYfQe5xEdVpdXf0xS', 'Admin', NULL, 'admin@gmail.com', '91239123', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
