-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2016 at 04:45 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `betabase`
--
CREATE DATABASE IF NOT EXISTS `betabase` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `betabase`;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `area_id` mediumint(9) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `longitude` float(10,6) NOT NULL,
  `latitude` float(10,6) NOT NULL,
  `zipcode` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`area_id`, `title`, `description`, `date`, `longitude`, `latitude`, `zipcode`, `user_id`, `is_approved`) VALUES
(1, 'Santee Boulders', 'Beyond Victoria the public-houses were doing a lively trade with these arrivals. At all the street corners groups of people were reading papers, talking excitedly, or staring at these unusual Sunday visitors. They seemed to increase as night drew on, until at last the roads, my brother said, were like Epsom High Street on a Derby Day.', '2016-03-26 10:50:50', -117.020111, 32.847099, 92071, 1, 1),
(2, 'Mission Gorge', 'Beyond Victoria the public-houses were doing a lively trade with these arrivals. At all the street corners groups of people were reading papers, talking excitedly, or staring at these unusual Sunday visitors. They seemed to increase as night drew on, until at last the roads, my brother said, were like Epsom High Street on a Derby Day.', '2016-03-26 10:52:58', -117.052795, 32.825733, 92119, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `climbs`
--

DROP TABLE IF EXISTS `climbs`;
CREATE TABLE IF NOT EXISTS `climbs` (
  `climb_id` mediumint(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `area_id` mediumint(9) NOT NULL,
  `type` varchar(20) NOT NULL,
  `v_grade` tinyint(4) DEFAULT NULL,
  `y_grade` tinyint(4) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `climbs`
--

INSERT INTO `climbs` (`climb_id`, `name`, `description`, `date`, `user_id`, `area_id`, `type`, `v_grade`, `y_grade`, `is_approved`) VALUES
(1, 'Suzie''s Wild Ride ', 'The climb starts out down and right from a small cave. Climb past two bolts to a ledge, then transition onto the upper face where the route continues up and right to a rappel station.', '2016-03-26 10:49:30', 1, 2, 'Sport', NULL, 58, 1),
(2, 'Mariah', 'Climb up in to a small cave, then pull the roof out of the cave and into a pod. Pulling the roof is the crux of the route. From the pod the crack widens from thin hands to offwidth.', '2016-03-26 10:49:43', 2, 2, 'TR, Trad', NULL, 59, 1),
(3, 'Lieback Rock Lieback', 'The namesake of Lieback Rock. \n\nLieback up a right facing rail where the rock splits from pink to grey. Get up to a finger pocket undercling. Follow undercling flake around right and then finish up the seam to the top. \n\nClassic. Feels more like an actual trad route than a boulder since it is so long and varied. Some start on the right side of the rail for added difficulty.', '2016-03-26 10:49:53', 1, 1, 'Boulder', 2, NULL, 1),
(4, 'Masochists Crack', 'This is the clean hand crack on the leftmost Beehive boulder.', '2016-03-26 10:50:01', 1, 1, 'Boulder', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
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

DROP TABLE IF EXISTS `images`;
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

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `rating_id` mediumint(9) NOT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `user_id` mediumint(9) NOT NULL,
  `climb_id` mediumint(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `rating`, `user_id`, `climb_id`) VALUES
(1, 3, 1, 1),
(2, 3, 2, 2),
(3, 2, 1, 3),
(4, 3, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `user_pic`, `is_admin`, `bio`, `date_joined`, `secret_key`) VALUES
(1, 'climber01', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'climber01@mail.com', NULL, 1, 'My brother turned down towards Victoria, and met a number of such people. He had a vague idea that he might see something of me.', '2016-03-26 00:00:00', '6bc0339ad9734457b498c9f2b92d58c22639e98c'),
(2, 'climber02', 'password', 'climber02@mail.com', NULL, 1, 'My brother turned down towards Victoria, and met a number of such people. He had a vague idea that he might see something of me.', '2016-03-26 00:00:00', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(3, 'christian', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'saldarriagadesign@gmail.com', NULL, 0, NULL, '0000-00-00 00:00:00', '03d36c56437e2f6e8ef9caabf54c874557c4720c');

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
  MODIFY `area_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `climbs`
--
ALTER TABLE `climbs`
  MODIFY `climb_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
  MODIFY `rating_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
