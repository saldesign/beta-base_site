-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2016 at 09:20 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`area_id`, `title`, `description`, `date`, `longitude`, `latitude`, `zipcode`, `user_id`, `is_approved`) VALUES
(1, 'Santee Boulders', 'Beyond Victoria the public-houses were doing a lively trade with these arrivals. At all the street corners groups of people were reading papers, talking excitedly, or staring at these unusual Sunday visitors. They seemed to increase as night drew on, until at last the roads, my brother said, were like Epsom High Street on a Derby Day.', '2016-03-26 10:50:50', -117.020111, 32.847099, 92071, 1, 1),
(2, 'Mission Gorge', 'Beyond Victoria the public-houses were doing a lively trade with these arrivals. At all the street corners groups of people were reading papers, talking excitedly, or staring at these unusual Sunday visitors. They seemed to increase as night drew on, until at last the roads, my brother said, were like Epsom High Street on a Derby Day.', '2016-03-26 10:52:58', -117.052795, 32.825733, 92119, 1, 1),
(3, 'Mount Woodson', 'Mount Woodson is a San Diego classic with short climbs on great granite. Woodson is made up of hundreds of boulders of all sizes. This area has been known in the past as a bouldering area. However, there are good top rope and lead climbs as well. Woodson has some great practice aid routes to train on. Woodson has a paved road that you can walk up and access the varies climbs as you walk to the antennas at the top of the mountain. Beware if you do not know where you are going you can end up doing a lot of bushwhacking to get to climbs. ', '2016-03-31 11:28:39', -116.959999, 33.006302, 92065, 3, 1);

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
  `v_grade` varchar(3) DEFAULT NULL,
  `y_grade` varchar(5) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `climbs`
--

INSERT INTO `climbs` (`climb_id`, `name`, `description`, `date`, `user_id`, `area_id`, `type`, `v_grade`, `y_grade`, `is_approved`) VALUES
(1, 'Suzie''s Wild Ride ', 'The climb starts out down and right from a small cave. Climb past two bolts to a ledge, then transition onto the upper face where the route continues up and right to a rappel station.', '2016-03-26 10:49:30', 1, 2, 'Sport', NULL, '5.8', 1),
(2, 'Mariah', 'Climb up in to a small cave, then pull the roof out of the cave and into a pod. Pulling the roof is the crux of the route. From the pod the crack widens from thin hands to offwidth.', '2016-03-26 10:49:43', 2, 2, 'TR, Trad', NULL, '5.9', 1),
(3, 'Lieback Rock Lieback', 'The namesake of Lieback Rock. \n\nLieback up a right facing rail where the rock splits from pink to grey. Get up to a finger pocket undercling. Follow undercling flake around right and then finish up the seam to the top. \n\nClassic. Feels more like an actual trad route than a boulder since it is so long and varied. Some start on the right side of the rail for added difficulty.', '2016-03-26 10:49:53', 1, 1, 'Boulder', 'v2', NULL, 1),
(4, 'Masochists Crack', 'This is the clean hand crack on the leftmost Beehive boulder.', '2016-03-26 10:50:01', 3, 1, 'Boulder', 'v0', NULL, 1),
(5, 'Suzie''s Mantle', 'On the overhanging southeast face of Suzie''s Boulder, locate several good holds at the lip just out of reach. Jump up and grab onto your favorite of these holds, and mantle. Surprisingly physical and difficult for a one move V0+!!', '2016-03-31 09:02:33', 1, 1, 'Boulder', 'v1', NULL, 1),
(25, 'Baby Robbins', 'Baby Robbins is located on the south face of JAWS, directly opposite of Jaws. Thin hands off the deck determines the grade of this climb.', '2016-03-31 11:30:50', 3, 3, 'Boulder', 'v1', NULL, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `body`, `user_id`, `date`, `is_approved`, `area_id`, `climb_id`) VALUES
(13, 'suzie', 3, '2016-04-04 10:49:35', 1, 0, 5),
(14, 'zu', 3, '2016-04-04 10:50:15', 1, 0, 5),
(15, 'adf', 0, '2016-04-05 08:24:56', 1, 0, 25),
(16, 'asdfgg', 0, '2016-04-05 08:25:45', 1, 0, 5),
(17, 'asdf', 3, '2016-04-05 08:32:06', 1, 0, 25),
(18, 'area santee', 3, '2016-04-05 08:35:15', 1, 1, 0),
(19, 'baby rob', 3, '2016-04-05 08:35:31', 1, 0, 25);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
`image_id` mediumint(9) NOT NULL,
  `image` text,
  `user_id` mediumint(9) NOT NULL,
  `area_id` mediumint(9) DEFAULT NULL,
  `climb_id` mediumint(9) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image`, `user_id`, `area_id`, `climb_id`, `is_approved`) VALUES
(5, 'a2551c81350ea8f75a8080b6417e0bbe9301c2b1', 3, 1, NULL, 1),
(6, 'b912686ccae4d13a14fff18b8d7a23cbc89a7b5a', 3, 1, NULL, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `rating`, `user_id`, `climb_id`) VALUES
(1, 3, 1, 1),
(2, 3, 2, 2),
(3, 2, 1, 3),
(4, 3, 1, 4),
(5, 3, 3, 5),
(11, 4, 3, 25),
(12, 4, 3, 26);

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
(1, 'climber01', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'climber01@mail.com', NULL, 1, 'My brother turned down towards Victoria, and met a number of such people. He had a vague idea that he might see something of me.', '2016-03-26 00:00:00', 'f0b2aa986346b957f82575fecfff8a9040091bfa'),
(3, 'christian', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'saldarriagadesign@gmail.com', NULL, 1, NULL, '0000-00-00 00:00:00', '4762e3098e96bce4b312da7d2a00039ad993b98b');

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
MODIFY `area_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `climbs`
--
ALTER TABLE `climbs`
MODIFY `climb_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `comment_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
MODIFY `image_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
MODIFY `rating_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
