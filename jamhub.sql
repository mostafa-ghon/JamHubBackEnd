-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2015 at 12:04 AM
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
  `name` int(11) NOT NULL,
  `band` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `band_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `ancestor_id` int(11) NOT NULL,
  `upload_date` date NOT NULL,
  `instrument` text NOT NULL,
  `likes` int(11) NOT NULL,
  `rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `user_name` varchar(18) NOT NULL,
  `password` text NOT NULL,
  `first_name` text,
  `last_name` text
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `first_name`, `last_name`) VALUES
(1, 'person1', 'nopassword', 'person', 'test1'),
(2, 'persona2', 'passwordina', 'person', '2test'),
(3, 'niko', '12341234', 'niko', 'kamanwkaman'),
(4, '', '', '', ''),
(5, 'batee5', 'kona', 'bat', 'wez'),
(6, 'khod', '123123', 'no', 'name'),
(9, 'mostafa', '12341234', 'nsn', 'ajaja'),
(11, 'shiko', '1234', 'shsj', 'shshsh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
