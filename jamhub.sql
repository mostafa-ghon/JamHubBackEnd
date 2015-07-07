-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2015 at 04:30 PM
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
  `name` varchar(35) NOT NULL,
  `band` tinyint(1) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `band_id` int(11) DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `ancestor_id` int(11) DEFAULT NULL,
  `upload_date` date NOT NULL,
  `instrument` varchar(20) NOT NULL,
  `likes` int(11) DEFAULT '0',
  `rating` double DEFAULT '0',
  `tags` text NOT NULL,
  `img_url` text NOT NULL,
  `track_url` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`track_id`, `name`, `band`, `user_id`, `band_id`, `duration`, `ancestor_id`, `upload_date`, `instrument`, `likes`, `rating`, `tags`, `img_url`, `track_url`) VALUES
(1, 'track', 0, 3, NULL, 24, NULL, '0000-00-00', 'guitar', 0, 0, 'fun test', 'http:/ahourl', 'http:/wahokamanwa7ed'),
(2, 'solotest2', 0, 3, NULL, 24, NULL, '0000-00-00', 'shit', 0, 0, 'lala', 'http:/ahourl', 'http:/wahokamanwa7ed'),
(3, '', 0, NULL, 4, 24, NULL, '0000-00-00', '', 0, 0, '', 'http:/ahourl', 'http:/wahokamanwa7ed');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `first_name`, `last_name`) VALUES
(1, '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
 ADD PRIMARY KEY (`track_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
MODIFY `track_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
