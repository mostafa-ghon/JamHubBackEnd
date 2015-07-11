-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2015 at 01:56 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jamhub`
--
CREATE DATABASE IF NOT EXISTS `jamhub` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `jamhub`;

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

DROP TABLE IF EXISTS `tracks`;
CREATE TABLE IF NOT EXISTS `tracks` (
`track_id` int(11) NOT NULL,
  `track_name` varchar(35) NOT NULL,
  `user_name` varchar(18) DEFAULT NULL,
  `band_name` varchar(18) DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `ancestor_id` int(11) DEFAULT NULL,
  `upload_date` date NOT NULL,
  `instrument` varchar(20) NOT NULL,
  `likes` int(11) DEFAULT '0',
  `rating` double DEFAULT '0',
  `tags` text NOT NULL,
  `img_url` text NOT NULL,
  `track_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_name` varchar(18) NOT NULL,
  `password` text NOT NULL,
  `first_name` text,
  `last_name` text,
  `email` text NOT NULL,
  `img_url` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
 ADD PRIMARY KEY (`track_id`), ADD KEY `user_name` (`user_name`,`band_name`), ADD KEY `band_name` (`band_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_name`), ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
MODIFY `track_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tracks`
--
ALTER TABLE `tracks`
ADD CONSTRAINT `tracks_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
