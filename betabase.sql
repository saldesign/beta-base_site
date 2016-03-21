-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2016 at 07:41 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `betabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
`area_id` mediumint(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `zipcode` tinyint(4) NOT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `climbs`
--

CREATE TABLE IF NOT EXISTS `climbs` (
`climb_id` mediumint(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `longitude` float(10,6) DEFAULT NULL,
  `latitude` float(10,6) DEFAULT NULL,
  `area_id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `type` varchar(20) NOT NULL,
  `v_grade` tinyint(4) DEFAULT NULL,
  `y_grade` tinyint(4) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`comment_id` mediumint(9) NOT NULL,
  `body` text NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `date` datetime NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `area_id` mediumint(9) NOT NULL,
  `climb_id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
`image_id` mediumint(9) NOT NULL,
  `image` text,
  `description` text NOT NULL,
  `title` varchar(50) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `area_id` mediumint(9) NOT NULL,
  `climb_id` mediumint(9) NOT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
`rating_id` mediumint(9) NOT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `user_id` mediumint(9) NOT NULL,
  `climb_id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` mediumint(9) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(254) NOT NULL,
  `user_pic` text,
  `is_admin` tinyint(1) NOT NULL,
  `bio` text,
  `date_joined` datetime NOT NULL,
  `secret_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
 ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `climbs`
--
ALTER TABLE `climbs`
 ADD PRIMARY KEY (`climb_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
 ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
 ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
MODIFY `area_id` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `climbs`
--
ALTER TABLE `climbs`
MODIFY `climb_id` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `comment_id` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
MODIFY `image_id` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
MODIFY `rating_id` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
