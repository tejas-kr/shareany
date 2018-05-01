-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2018 at 04:19 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shareany`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(20) NOT NULL,
  `post_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `comment_text` longtext NOT NULL,
  `comment_type` enum('on_post','on_comment') NOT NULL DEFAULT 'on_post',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follow_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `follow_user_id` int(20) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follow_id`, `user_id`, `follow_user_id`, `added_on`, `active`) VALUES
(1, 19, 20, '2018-04-08 15:55:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `post_title` varchar(50) NOT NULL,
  `post_content` longtext NOT NULL,
  `post_attach` varchar(160) DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_title`, `post_content`, `post_attach`, `added_on`) VALUES
(1, 19, 'sdfghjk', 'jhkl', '', '2018-04-01 14:44:43'),
(2, 19, 'sdfghjk', 'jhkl', 'Uploading beach-2879929_1280.jpg Failed', '2018-04-01 14:45:04'),
(3, 19, 'sdfghjk', 'jhkl', 'Uploading beach-2879929_1280.jpg Failed', '2018-04-01 14:46:28'),
(4, 19, 'bnm,', 'bnm,', 'Uploading Goku-Wallpaper-hd-for-PC-1.jpg Failed', '2018-04-01 14:46:47'),
(5, 19, 'asdfghj', 'sdfghjkrtyui', 'Uploading mbuntu-4.jpg Failed', '2018-04-01 14:48:09'),
(6, 19, 'asdfghj', 'sdfghjkrtyui', 'Uploading mbuntu-4.jpg Failed', '2018-04-01 14:48:54'),
(7, 19, 'asdfghj', 'sdfghjkrtyui', 'Uploading mbuntu-4.jpg Failed', '2018-04-01 14:50:44'),
(8, 19, 'asdfghj', 'sdfghjkrtyui', 'Uploading mbuntu-4.jpg Failed', '2018-04-01 14:52:00'),
(9, 19, 'asdfghj', 'sdfghjkrtyui', 'Uploading mbuntu-4.jpg Failed', '2018-04-01 14:54:02'),
(10, 19, 'vbnm', 'bnm,', '', '2018-04-02 05:55:12'),
(11, 19, 'cvbnm', 'vbnm,', '15226485544396119Webp.net-compress-image_(1).jpg', '2018-04-02 05:55:54'),
(12, 19, 'new  post', 'new post1', '152282394070560751.santa-doom.jpg', '2018-04-04 06:39:00'),
(13, 19, 'new  post', 'new post1', '152282397034343641.santa-doom.jpg', '2018-04-04 06:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `user_image` varchar(50) NOT NULL DEFAULT 'no_image',
  `user_bio` varchar(130) DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `full_name`, `user_image`, `user_bio`, `added_on`) VALUES
(1, 'toor101', 'shinchan', 'Tejas Jaiswal', 'no_image', NULL, '2018-03-03 10:47:19'),
(3, 'toor102', 'shinchan1', 'Tejas Kumar', 'no_image', NULL, '2018-03-03 11:11:29'),
(18, 'unofficial__tushar', '5f4dcc3b5aa765d61d8327deb882cf99', 'Tushar', 'no_image', NULL, '2018-03-03 12:48:10'),
(19, 'root_user1', '6041d0363da08612bcb0f536e00dba50', 'Tejas', 'no_image', NULL, '2018-03-29 07:05:10'),
(20, 'other_user1', 'df7c905d9ffebe7cda405cf1c82a3add', 'Tushar', 'no_image', NULL, '2018-04-08 10:58:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `follow_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
