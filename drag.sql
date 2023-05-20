-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 01:37 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drag`
--

-- --------------------------------------------------------

--
-- Table structure for table `score_board`
--

CREATE TABLE `score_board` (
  `id` int(11) NOT NULL,
  `squad_id` int(11) NOT NULL,
  `score` int(11) DEFAULT 0,
  `orders` int(11) DEFAULT 0,
  `created_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `score_board`
--

INSERT INTO `score_board` (`id`, `squad_id`, `score`, `orders`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(50, 6, 99, 0, '2023-05-20 17:03:54', '', '', ''),
(51, 4, 35, 1, '2023-05-20 17:03:54', '', '', ''),
(52, 1, 90, 2, '2023-05-20 17:03:54', '', '', ''),
(53, 10, 89, 3, '2023-05-20 17:03:54', '', '', ''),
(54, 3, 8, 4, '2023-05-20 17:03:54', '', '', ''),
(55, 7, 75, 5, '2023-05-20 17:03:54', '', '', ''),
(56, 8, 86, 6, '2023-05-20 17:03:54', '', '', ''),
(57, 9, 9, 7, '2023-05-20 17:03:54', '', '', ''),
(58, 2, 99, 8, '2023-05-20 17:03:54', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `squad`
--

CREATE TABLE `squad` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `jersey_no` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `squad`
--

INSERT INTO `squad` (`id`, `name`, `jersey_no`, `type`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Virat Kohli', ' 18', ' Batsman', '2023-05-20 13:56:11', '', '', ''),
(2, 'Rohit Sharma', ' 45', ' Batsman', '2023-05-20 13:56:11', '', '', ''),
(3, 'Jasprit Bumrah', ' 33', ' Fast Bowler', '2023-05-20 13:56:11', '', '', ''),
(4, 'Ravindra Jadeja', ' 8', ' All-rounder', '2023-05-20 13:56:11', '', '', ''),
(5, 'Mohammed Shami', ' 11', ' Fast Bowler', '2023-05-20 13:56:11', '', '', ''),
(6, 'Hardik Pandya', ' 33', ' All-rounder', '2023-05-20 13:56:11', '', '', ''),
(7, 'Rishabh Pant', ' 17', ' Wicketkeeper', '2023-05-20 13:56:11', '', '', ''),
(8, 'Shikhar Dhawan', ' 25', ' Batsman', '2023-05-20 13:56:11', '', '', ''),
(9, 'Bhuvneshwar Kumar', ' 15', ' Fast Bowler', '2023-05-20 13:56:11', '', '', ''),
(10, 'Cheteshwar Pujara', ' 7', ' Batsman', '2023-05-20 13:56:11', '', '', ''),
(11, 'sachin tendulkar', '89', 'Batsman', '2023-05-20 16:06:05', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `score_board`
--
ALTER TABLE `score_board`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `squad`
--
ALTER TABLE `squad`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `score_board`
--
ALTER TABLE `score_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `squad`
--
ALTER TABLE `squad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
