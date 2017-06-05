-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2017 at 11:24 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_imgs`
--

CREATE TABLE `blog_imgs` (
  `imgID` int(10) UNSIGNED NOT NULL,
  `caption` varchar(45) NOT NULL,
  `img` text NOT NULL,
  `postID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_imgs`
--

INSERT INTO `blog_imgs` (`imgID`, `caption`, `img`, `postID`) VALUES
(9, 'Two birds one stone ', '21.gif', 21),
(10, 'screenshot', '19.png', 19),
(12, 'future', '18.jpg', 18),
(14, 'croyde', '20.jpg', 20),
(15, 'cuba', '17.JPG', 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_imgs`
--
ALTER TABLE `blog_imgs`
  ADD PRIMARY KEY (`imgID`),
  ADD KEY `postID` (`postID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_imgs`
--
ALTER TABLE `blog_imgs`
  MODIFY `imgID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_imgs`
--
ALTER TABLE `blog_imgs`
  ADD CONSTRAINT `blog_imgs_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `blog_posts` (`postID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
