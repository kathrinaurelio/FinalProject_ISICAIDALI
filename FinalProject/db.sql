-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2017 at 08:38 PM
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
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `commentID` int(11) NOT NULL,
  `commentAuthor` varchar(250) NOT NULL,
  `commentCont` text NOT NULL,
  `commentDate` datetime DEFAULT NULL,
  `postID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(37, 'tech', '19.jpg', 19),
(38, 'future', '18.jpg', 18),
(39, 'cuba', '17.jpg', 17),
(43, 'Thankyou', '15.jpg', 15),
(44, 'team', '20.jpg', 20);

-- --------------------------------------------------------

--
-- Table structure for table `blog_members`
--

CREATE TABLE `blog_members` (
  `memberID` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_members`
--

INSERT INTO `blog_members` (`memberID`, `username`, `password`, `email`) VALUES
(1, 'Kathrin', '$2y$10$kRGaOmJa/tjxFSz/0RS/PONnloJzsyXx1/dlMu3cjJS95YR09nK6q', 'kathrinaurelio@gmail.com'),
(2, 'Laura', '$2y$10$ls0m/12GSdCUyv25IOT64eFWrHkCSTMcN/ZkkkovzYHZWpDt6OvKO', 'laurajaynegriggs@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `postID` int(11) NOT NULL,
  `postTitle` varchar(255) DEFAULT NULL,
  `postDesc` text NOT NULL,
  `postCont` text NOT NULL,
  `postDate` datetime DEFAULT NULL,
  `memberID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`postID`, `postTitle`, `postDesc`, `postCont`, `postDate`, `memberID`) VALUES
(15, 'We could make it - ', 'The end!', '<p style=\"text-align: center;\"><iframe src=\"https://www.youtube.com/embed/dzvTHhWDjIg?rel=0&amp;controls=0&amp;showinfo=0\" width=\"640\" height=\"360\" frameborder=\"0\" allowfullscreen=\"allowfullscreen\"></iframe></p>', '2017-05-29 11:34:05', 1),
(17, 'Reflection', 'How we felt the project went', '<h3><strong>Issues we encountered:</strong></h3>\r\n<ul>\r\n<li>Biggest issue was losing two team mates as this put us quite behind, we weren\'t aware the team mates were dropping out until quite late on - so we&rsquo;d been waiting on code from them.<br /><br /></li>\r\n<li>But also it meant we each had to double our work load.<br /><br /></li>\r\n<li>A few times when we were both working on the site, we\'d both push/pull at the same time which meant we had to spend time fixing conflicts.</li>\r\n</ul>\r\n<h3><strong>Best moment:</strong></h3>\r\n<p>Getting the first &lsquo;extra&rsquo; functionality working. We both knew we wanted comments and images so it was a relief when we realised we\'d built a site that was more than the absolute basic.<br /><br /></p>\r\n<h3><strong>Worst moment:</strong></h3>\r\n<p>There were a few times in the project where Kathrin and I were trying to get on and were trying to encourage work from our team mates - without wanting to sound like we were nagging.<br /><br /></p>\r\n<h3><strong>What went well: </strong></h3>\r\n<p>We both felt quite deflated when we realised it was just the two of us left on the project, but we actually pulled together really well. And couldn&rsquo;t believe we have a working site that no only works, but actually looks ok too!<br /><br /></p>\r\n<h3><strong>What we learnt:</strong></h3>\r\n<ul>\r\n<li>When you&rsquo;re working in a team you need to take responsibility for own work, but also the greater project. So if other people are preventing the work from going forward, the whole team need to manage that issue. &nbsp;&nbsp;<br /><br /></li>\r\n<li>How much code you can find online.<br /><br /></li>\r\n<li>Definitely a lot of conding skills - learning by doing!</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3><strong>Did we have fun:</strong></h3>\r\n<ul>\r\n<li>Definitely had more fun when we realised we were both dedicated to getting the site finished and to a place we could present.<br /><br /></li>\r\n<li>There were times where it felt like the two of us alone would not have time to get everything done, but it was a great opportunity for a real challenge.<br /><br /></li>\r\n<li>Realising ideas and solving issues was fun. At least afterwards.</li>\r\n</ul>\r\n<p>&nbsp;</p>', '2017-05-30 19:07:18', 2),
(18, 'The future', 'Things we would add, if we had the time', '<h3><strong>Functionality we\'d add if we had more time:</strong></h3>\r\n<ul>\r\n<li>Possibility to tag posts and use those tags to search the posts<br /><br /></li>\r\n<li>Social sharing and connecting to social media feeds<br /><br /></li>\r\n<li>Possibility to log-in or register as a new member right on the index page<br /><br /></li>\r\n<li>Managing user permissions - so different levels of admin (just post, post and manager users etc.)<br /><br /></li>\r\n<li>Subscription pop-ups<br /><br /></li>\r\n<li>Limit number of blog posts shown on index page, using page numbers to see older posts<br /><br /></li>\r\n<li>Check if the user input is sanitized properly<br /><br /></li>\r\n</ul>\r\n<h3><strong>What we&rsquo;d change:</strong></h3>\r\n<ul>\r\n<li>Tidy up the code (css specifically)<br /><br /></li>\r\n<li>Used more css on the back end to make it look nicer, in page editor, image library etc</li>\r\n</ul>', '2017-05-30 19:09:34', 2),
(19, 'The tech', 'How we built our site', '<h3><strong>The technology we used:</strong></h3>\r\n<ul>\r\n<li>Languages:</li>\r\n<ul>\r\n<li>Php</li>\r\n<li>HTML &amp; CSS</li>\r\n<li>MySQL</li>\r\n<li>Bootstrap<br /><br /></li>\r\n</ul>\r\n<li>Other tools</li>\r\n<ul>\r\n<li>Github</li>\r\n<li>Sourcetree</li>\r\n<li>Trello</li>\r\n<li>Slack</li>\r\n</ul>\r\n</ul>\r\n<h3><strong>What the site can do:</strong></h3>\r\n<ul>\r\n<li>The basics:</li>\r\n<ul>\r\n<li>Create post</li>\r\n<li>Edit post</li>\r\n<li>Delete post</li>\r\n<li>Create user</li>\r\n<li>Edit user</li>\r\n<li>Delete user<br /><br /></li>\r\n</ul>\r\n<li>Extras:\r\n<ul>\r\n<li>Ability for guests to comment</li>\r\n<li>Upload and replace images</li>\r\n<li>Responsive css template</li>\r\n</ul>\r\n</li>\r\n</ul>', '2017-05-30 19:10:45', 2),
(20, 'Our roles', 'How we split out the work', '<h3><strong>Splitting out the work:</strong></h3>\r\n<ul>\r\n<li>We started the project on trello - each of us taking on a few pages that were essential for the blog site work. <br />This was our priority from the beginning - to have a working blog. We weren\'t even thinking about the blog subject at this point. That came pretty late in the project for us.<br /><br /></li>\r\n<li>Tried to organise the project like scrum. Started with frontend before the admin pages. Split the work in smaller tasks, which everybody could choose from.</li>\r\n</ul>\r\n<h3><strong>Managing the work: </strong></h3>\r\n<ul>\r\n<li>We both naturally picked areas of the site that we wanted to work on, so this worked quite nicely.<br /><br /></li>\r\n<li>It made sense to group some of the pages&nbsp;so one person would create add user and edit user while the other worked on add post and edit post.<br /><br /></li>\r\n<li>While one of us was working on one area&nbsp;of the project, the other would jump on another area.&nbsp;<br />For example - Kathrin worked on comments while Laura worked on images.&nbsp;<br /><br /></li>\r\n<li>We stayed in constant communication when we were making these changes which was really important. Slack was essential for this.<br /><br /></li>\r\n<li>We connected on Github right from the beginning, so we could share our code with each other and test if it worked.</li>\r\n</ul>\r\n<h3><strong>Stepping into roles:</strong></h3>\r\n<ul>\r\n<li>Kathrin had already started working on the other pages our team mates didn&rsquo;t have the time to complete, so she&nbsp;could test her code. So we very quickly jumped onto Kathrin\'s code when we realised it would just be the two of us.<br /><br /></li>\r\n<li>We decided what functionality was essential to the site, and got on with our own areas. Sharing anything we\'d learnt that could help the other as we went.<br /><br /></li>\r\n<li>Once we had a working site, we each took some of the extra functionality and worked on that.<br /><br /></li>\r\n<li>The final stage was adding the css, and some of the little things - like showing authors name.&nbsp;</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '2017-05-30 19:11:48', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `postID` (`postID`);

--
-- Indexes for table `blog_imgs`
--
ALTER TABLE `blog_imgs`
  ADD PRIMARY KEY (`imgID`),
  ADD KEY `postID` (`postID`);

--
-- Indexes for table `blog_members`
--
ALTER TABLE `blog_members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `memberID` (`memberID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `blog_imgs`
--
ALTER TABLE `blog_imgs`
  MODIFY `imgID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `blog_members`
--
ALTER TABLE `blog_members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `blog_posts` (`postID`);

--
-- Constraints for table `blog_imgs`
--
ALTER TABLE `blog_imgs`
  ADD CONSTRAINT `blog_imgs_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `blog_posts` (`postID`);

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `blog_members` (`memberID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
