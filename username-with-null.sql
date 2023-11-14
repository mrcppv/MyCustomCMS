-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2023 at 03:36 PM
-- Server version: 8.0.34
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `comment` text NOT NULL,
  `news_id` longtext NOT NULL,
  `user_id` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `username`, `comment`, `news_id`, `user_id`) VALUES
(15, '', 'qwdq', '3', '5'),
(21, NULL, 'qwef', '1', '6'),
(22, NULL, 'qwef', '2', '6');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `category` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `content`, `category`) VALUES
(1, 'wafieawoiejf', ''),
(16, 'DAILY NEW DAOISDJIOEJQOIWDJ', 'daily'),
(17, 'EU NEWS ', 'europe'),
(18, 'EU NEWS ', 'europe'),
(12, 'CULTURE', 'culture'),
(13, 'CULTURE', 'culture'),
(14, 'DAILY NEW DAOISDJIOEJQOIWDJ', 'daily'),
(15, 'DAILY NEW DAOISDJIOEJQOIWDJ', 'daily'),
(8, 'SPORTSPOTRTR', 'sport'),
(9, 'WORLDWORLD', 'worldwide'),
(10, 'WORLDWORLD', 'worldwide'),
(11, 'WORLDWORLD', 'worldwide'),
(5, 'this is sport', 'sport'),
(6, 'this is daily news', 'daily'),
(7, 'worldnews', 'worldwide');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `admin`) VALUES
(1, 'root', 'root', 1),
(2, 'admin', 'pass', 1),
(3, 'user3', 'pass', 1),
(4, 'asmin', 'asmin', 2),
(5, 'user5', 'pass', 1),
(6, 'test@test.com', 'test', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
