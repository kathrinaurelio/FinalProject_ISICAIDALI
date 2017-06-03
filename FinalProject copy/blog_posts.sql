-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 31, 2017 at 11:23 PM
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
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `postID` int(11) NOT NULL,
  `postTitle` varchar(255) DEFAULT NULL,
  `postDesc` text NOT NULL,
  `postCont` text NOT NULL,
  `postDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`postID`, `postTitle`, `postDesc`, `postCont`, `postDate`) VALUES
(17, 'Reflection', 'A reflection on our group project', '<ul>\r\n<li>issues we encountered:\r\n<ul>\r\n<li>Biggest issue was loosing two team mates as this meant we were behind in our project as we\'d been waiting on other people for content in order to get our pages working.&nbsp;</li>\r\n<li>But also it meant we each had to double our work load.&nbsp;</li>\r\n</ul>\r\n</li>\r\n<li>best moment:\r\n<ul>\r\n<li>getting the first extra functionality working. We both knew we wanted comments and images so it was a relief when we realised we\'d built a site that was more that just the minimun viable product.&nbsp;</li>\r\n</ul>\r\n</li>\r\n<li>worst moment:\r\n<ul>\r\n<li>half way through the project when we couldnt quite guage whether the team had lost interested or just didn\'t have the time.&nbsp;</li>\r\n</ul>\r\n</li>\r\n<li>what went well:&nbsp;\r\n<ul>\r\n<li>Our dedication to see the project through to the end, despite feeling like it would be impossible to present a site that we were proud of.&nbsp;</li>\r\n</ul>\r\n</li>\r\n<li>what didnt go so well:</li>\r\n<li></li>\r\n<li>what did we learn:\r\n<ul>\r\n<li>that you sometimes have to be a pain the bum team mate and just nag the hell out of people to find out where they are with their parts of the project. I think if we\'d been less polite and more annoying our team mates may have been more open about wanting to drop out earlier.&nbsp;</li>\r\n</ul>\r\n</li>\r\n<li>did we have fun:\r\n<ul>\r\n<li>Started off having fun, the middle less so, the end when we were able to just get on knowing we could rely on each other was a great part of the project.&nbsp;</li>\r\n</ul>\r\n</li>\r\n</ul>', '2017-05-30 19:07:18'),
(18, 'The future', 'Things we', '<ul>\r\n<li>Functionality we\'d add if we had more time:</li>\r\n<li>What we would change:\r\n<ul>\r\n<li>txt editor on add-post could be better.</li>\r\n<li></li>\r\n</ul>\r\n</li>\r\n</ul>', '2017-05-30 19:09:34'),
(19, 'The tech', 'What functionality did we use', '<p>The functionality we used on our blog:</p>\r\n<p>The basics:</p>\r\n<ul>\r\n<li>Create post</li>\r\n<li>Edit post</li>\r\n<li>Create user</li>\r\n<li>Edit/delete user&nbsp;</li>\r\n</ul>\r\n<p>Extras:</p>\r\n<ul>\r\n<li>Ability for guests to comment</li>\r\n<li>Upload and replace images&nbsp;</li>\r\n</ul>', '2017-05-30 19:10:45'),
(20, 'The roles', 'How we got on and did our work test', '<ul>\r\n<li>How we split out our work:\r\n<ul>\r\n<li>We started the project off on trello. Each of us taking on a few pages that were essential for the blog site work. This was our priority from the beginning - to have a working blog. We weren\'t even thinking about the blog subject at this point. That actually came pretty late in the project for us.<br /><br /></li>\r\n</ul>\r\n</li>\r\n<li>How we managed work:&nbsp;\r\n<ul>\r\n<li>In some ways, being the two of us made it a lot easier to manage the work as we could step in and help each other where necessary.&nbsp;</li>\r\n<li>While one of us was working on one aspect of the project, the other would jump on another area.&nbsp;</li>\r\n<li>We stayed in constant communication when we were making these changes which was really important.&nbsp;<br /><br /></li>\r\n</ul>\r\n</li>\r\n<li>Did we step into roles:\r\n<ul>\r\n<li>Kathrin had the forsight to start work on the other pages that our team mates didnt have the time to complete, so we very quickly jumped onto Kathrin\'s code when we realised it would just be the two of us.&nbsp;</li>\r\n<li>We both had very practical roles as we needed to get so much done. We made a decision as to what functionality was essential to the site, and get on with our own areas. Sharing anything we\'d learnt that could help the other as we went.&nbsp;</li>\r\n<li>Once we had a working site, one of us focussed more on the css while the other focussed on what else we could add to the site to really make it nice.&nbsp;</li>\r\n</ul>\r\n</li>\r\n</ul>', '2017-05-30 19:11:48'),
(21, 'Our team', 'A little smaller than planned', '<p>We started off as a four-some and ended up just the two of us:</p>\r\n<p>Kathrin and Laura&nbsp;</p>\r\n<p>What we lack in team mates, we\'ve made up in efficiency.</p>\r\n<p>Which is why our blog is about our blog project! Killing two birds with one stone.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '2017-05-30 19:16:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`postID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
