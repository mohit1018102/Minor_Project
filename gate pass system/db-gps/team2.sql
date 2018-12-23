-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 11, 2018 at 07:25 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` varchar(11) NOT NULL,
  `first` varchar(10) NOT NULL,
  `second` varchar(10) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first`, `second`, `user`, `password`) VALUES
('101', 'Rohit', 'Kapoor', 'Admin', 'admin@123'),
('102', 'Raman', 'Shetty', 'Admin2', 'admin@2');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

DROP TABLE IF EXISTS `visitor`;
CREATE TABLE IF NOT EXISTS `visitor` (
  `name` varchar(100) DEFAULT NULL,
  `number` varchar(11) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `file` varchar(50) DEFAULT NULL,
  `gid` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`name`, `number`, `city`, `address`, `date`, `file`, `gid`) VALUES
('TOM', '9999999999', 'DDN', 'clementttown', '2018-11-11 07:19:07', 'Tom Brady913_rectangle.jpg', '101'),
('ALBUS DUMBALDORE', '1111111111', 'DDN', 'sailok near ITBP CAMP', '2018-11-11 07:19:41', '2018-01-01-16-02-21.jpg', '101'),
('TONY STARK', '9999999999', 'patna', 'sangam pg', '2018-11-11 07:20:12', 'p1.jpg', '101'),
('RAMESH', '1111111122', 'patna', 'clementttown', '2018-11-11 07:20:42', 'user.jpg', '101'),
('FALKON', '222222222', 'DDN', 'clementttown', '2018-11-11 07:21:08', 'view.jpg', '101');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
