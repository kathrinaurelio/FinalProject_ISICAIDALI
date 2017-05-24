-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Mai 2017 um 21:42
-- Server-Version: 10.1.21-MariaDB
-- PHP-Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blog_members`
--

CREATE TABLE `blog_members` (
  `memberID` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `blog_members`
--

INSERT INTO `blog_members` (`memberID`, `username`, `password`, `email`) VALUES
(1, 'Kathrin', '$2y$10$kRGaOmJa/tjxFSz/0RS/PONnloJzsyXx1/dlMu3cjJS95YR09nK6q', 'kathrinaurelio@gmail.com');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blog_posts`
--

CREATE TABLE `blog_posts` (
  `postID` int(11) NOT NULL,
  `postTitle` varchar(255) DEFAULT NULL,
  `postDesc` text NOT NULL,
  `postCont` text NOT NULL,
  `postDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `blog_posts`
--

INSERT INTO `blog_posts` (`postID`, `postTitle`, `postDesc`, `postCont`, `postDate`) VALUES
(1, 'Test', 'Test', 'This is just a test. Does it work?', '2017-05-23 11:47:00'),
(2, 'Another Test', '<p>This is another test</p>', '<p>It would be really <strong>lovely</strong> if we were able to add pictures and videos.</p>\r\n<p>At least we can write in <strong>bold</strong> and <em>italic</em> letters.</p>\r\n<p>Or add lists:</p>\r\n<ul style=\"list-style-type: circle;\">\r\n<li>hello</li>\r\n<li>hello</li>\r\n<li>hello</li>\r\n</ul>', '2017-05-23 22:34:00');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `blog_members`
--
ALTER TABLE `blog_members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indizes für die Tabelle `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`postID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `blog_members`
--
ALTER TABLE `blog_members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
