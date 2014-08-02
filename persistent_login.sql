-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2014 at 03:26 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `persistent_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('09e236068b531add1345346743fbc9cc', '192.168.0.101', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0', 1407011029, 'a:4:{s:9:"user_data";s:0:"";s:4:"name";s:4:"test";s:5:"email";s:0:"";s:9:"logged_in";b:1;}'),
('3e7a7a3c8a5ebf4465f964e265b8ba68', '192.168.0.101', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0', 1407011053, 'a:4:{s:9:"user_data";s:0:"";s:4:"name";s:4:"test";s:5:"email";s:0:"";s:9:"logged_in";b:1;}'),
('6dcf11dd4df3e03bc6743f7b16fd3c65', '192.168.0.101', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0', 1407011097, 'a:4:{s:9:"user_data";s:0:"";s:4:"name";s:4:"test";s:5:"email";s:0:"";s:9:"logged_in";b:1;}'),
('e319378349cd0f22e2318cf86ccecb6a', '192.168.0.101', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0', 1407011184, 'a:4:{s:9:"user_data";s:0:"";s:4:"name";s:4:"test";s:5:"email";s:0:"";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `pr_session`
--

CREATE TABLE IF NOT EXISTS `pr_session` (
`idSaved_Session` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pr_session`
--

INSERT INTO `pr_session` (`idSaved_Session`, `idUser`, `hash`) VALUES
(5, 1, '4b75751e170e00f56886726c3f46eecd'),
(6, 4, '05746d34f5c54c33ad771f592955def4');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
`idUser` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`idUser`, `username`, `password`, `email`) VALUES
(1, 'kyle', 'password', 'kyle@someplace.com'),
(2, 'bobjones', '$2y$12$nRmTG.Q3EFDS/.OE95WdUOOrE2gIYzCIgO14V4oD0deZAuQmxEobi', ''),
(3, 'bosdf', '$2y$12$0SKPBd3imuPqGA6rpZD/FOCM2V9q9kFaEzHyy8l7xvYqu4yNKb/cy', ''),
(4, 'test', '$2y$12$uH4eaqcEEwE4JafR6JREvOWXZ4qEXovHJ1A3YPuKhjVtyXXq3sgJe', ''),
(5, 'bobjones99', '$2y$12$e0HhVlWmwc2pTgGnjdvUcuNZIGyHUQ271wlYHJIwWW0Fbko8EbhZO', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `pr_session`
--
ALTER TABLE `pr_session`
 ADD PRIMARY KEY (`idSaved_Session`), ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
 ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pr_session`
--
ALTER TABLE `pr_session`
MODIFY `idSaved_Session` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pr_session`
--
ALTER TABLE `pr_session`
ADD CONSTRAINT `pr_session_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
