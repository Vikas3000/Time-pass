-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2018 at 08:55 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `timepass`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `pid` int(8) NOT NULL AUTO_INCREMENT,
  `post` text NOT NULL,
  `pt` datetime NOT NULL,
  `uid` int(8) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`pid`, `post`, `pt`, `uid`) VALUES
(1, 'ramukaka kaise ho yaar?', '2018-07-23 11:22:04', 2),
(8, 'kaise', '2018-07-23 11:51:03', 2),
(9, 'kaise', '2018-07-23 11:51:03', 2),
(11, 'sgghsgjshjk', '2018-07-23 11:56:39', 2),
(12, 'sgghsgjshjk', '2018-07-23 11:59:33', 2),
(13, 'hemant pagal hai', '2018-07-23 11:59:54', 2),
(14, 'heelloooooo', '2018-07-23 12:01:55', 2),
(15, 'hp wala pagal hai', '2018-07-23 12:19:18', 3),
(16, 'sab gobar hai', '2018-07-23 12:23:58', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `propic` varchar(255) NOT NULL DEFAULT 'images/dp.png',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `mobile`, `email`, `password`, `gender`, `dob`, `propic`) VALUES
(1, 'saurabh  pandey', '7408605857', 'pandeylucky81@gmail.com', '123456789', 'male', '1998-07-17', 'images/dp.png'),
(2, 'Shreetika Kesarwani', '8303781730', 'shree.kesarwani@gmail.com', 'uptika#90', 'female', '1997-07-22', 'uplitems/1532323765images.jpg'),
(3, 'Upasana Pal', '7395858684', 'toupasanapal@gmail.com', 'tooncar', 'female', '1996-06-10', 'uplitems/1532328730jf.jpg'),
(4, 'Shivani Agarwal', '9865848586', 'shivaniandshubham@gmail.c', 'ginni', 'female', '1997-08-03', 'images/dp.png'),
(5, 'Ramukaka', '9858562588', 'ramukaka@gmail.com', '123', 'male', '1998-07-07', 'images/dp.png'),
(6, 'golu lal', '4545454455', 'golulal@gmail.com', '123', 'male', '1998-07-22', 'images/dp.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
