-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2018 at 09:38 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tribe`
--
DROP DATABASE IF EXISTS `tribe`;
CREATE DATABASE IF NOT EXISTS `tribe` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tribe`;

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

DROP TABLE IF EXISTS `code`;
CREATE TABLE IF NOT EXISTS `code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `value` varchar(20) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `code`
--

INSERT INTO `code` (`id`, `type_id`, `sequence`, `description`, `name`, `value`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 'Category select', 'Arts', 'Arts', NULL, NULL),
(12, 1, 2, 'Category select', 'Alumni', 'Alumni', NULL, NULL),
(13, 1, 3, 'Category select', 'Culture', 'Culture', NULL, NULL),
(14, 1, 4, 'Category select', 'Nationalities', 'Nationalities', NULL, NULL),
(15, 1, 5, 'Category select', 'Location', 'Location', NULL, NULL),
(16, 1, 6, 'Category select', 'Professions', 'Professions', NULL, NULL),
(17, 1, 7, 'Category select', 'Recreation', 'Recreation', NULL, NULL),
(18, 1, NULL, 'Category select', 'Sports', 'Sports', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_project`
--

DROP TABLE IF EXISTS `member_project`;
CREATE TABLE IF NOT EXISTS `member_project` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_project`
--

INSERT INTO `member_project` (`request_id`, `project_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 'oasisers99@gmail.com', '1', '2017-11-28 22:36:37', NULL),
(2, 7, 'jacqui.storey89@gmail.com', '1', '2017-11-28 22:36:37', NULL),
(3, 8, 'irwin.tobias@whatisnext.com.au', '1', '2017-11-28 22:36:37', NULL),
(4, 9, 'qureshmr@gmail.com', '1', '2017-11-28 22:36:37', NULL),
(5, 10, 'brigittestaples@gmail.com', '1', '2017-11-28 22:36:37', NULL),
(6, 11, 'dpcyc77@gmail.com', '1', '2017-11-28 22:36:37', NULL),
(7, 12, 'admin@rclc.org.au', '1', '2017-11-28 22:36:37', NULL),
(8, 13, 'admin@rclc.org.au', '1', '2017-11-28 22:36:37', NULL),
(9, 14, 'pjasperstorey@outlook.com', '1', '2017-11-28 22:36:37', NULL),
(10, 15, 'sonjanagel56@gmail.com', '1', '2017-11-28 22:36:37', NULL),
(11, 16, 'admin@retiredsurfersfraternity.com', '1', '2017-11-28 22:36:37', NULL),
(12, 17, 'dpcyc77@gmail.com', '1', '2017-11-28 22:36:37', NULL),
(13, 18, 'oasisers99@gmail.com', '1', '2017-11-28 22:44:36', NULL),
(14, 18, 'oasisers99@gmail.com', '1', '2017-12-23 00:15:34', NULL),
(15, 18, 'oasisers99@gmail.com', '1', '2017-12-23 00:15:41', NULL),
(16, 10, 'oasisers99@gmail.com', '1', '2017-12-23 00:51:32', NULL),
(17, 18, 'f.blazevski@hotmail.com', '1', '2018-06-14 20:54:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

DROP TABLE IF EXISTS `member_type`;
CREATE TABLE IF NOT EXISTS `member_type` (
  `member_type` char(1) NOT NULL,
  `type_name` varchar(45) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`member_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sent_from` varchar(45) DEFAULT NULL,
  `sent_to` varchar(45) DEFAULT NULL,
  `message` varchar(45) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sent_from`, `sent_to`, `message`, `status`, `updated_at`, `created_at`) VALUES
(1, 'test@test.com', 'oasisers99@gmail.com', 'hello there', '2', NULL, NULL),
(2, 'oasisers99@gmail.com', 'oasisers99@gmail.com', 'test', '2', NULL, NULL),
(3, 'oasisers99@gmail.com', 'oasisers99@gmail.com', 'Hi oasisers99!', '2', NULL, NULL),
(4, 'oasisers99@gmail.com', 'oasisers99@gmail.com', 'Hi! I\'m testing this message sending function', '2', NULL, NULL),
(5, 'oasisers99@gmail.com', 'oasisers99@gmail.com', 'hello there?', '2', NULL, NULL),
(6, 'oasisers99@gmail.com', 'oasisers99@gmail.com', 'hello there?', '2', NULL, NULL),
(7, 'oasisers99@gmail.com', 'oasisers99@gmail.com', 'test', '2', '2018-01-11 23:56:18', NULL),
(8, 'oasisers99@gmail.com', 'oasisers99@gmail.com', 'aaa', '2', '2018-01-11 23:56:19', NULL),
(9, 'oasisers99@gmail.com', 'oasisers99@gmail.com', 'ggg', '2', '2018-01-11 23:56:20', NULL),
(10, 'oasisers99@gmail.com', 'oasisers99@gmail.com', 'dddd', '2', '2018-01-11 23:56:21', NULL),
(11, 'oasisers99@gmail.com', 'oasisers99@gmail.com', 'gdgsdg', '2', NULL, NULL),
(12, 'f.blazevski@hotmail.com', 'f.blazevski@hotmail.com', 'Random Message Sending', '2', '2018-07-14 14:55:42', '2018-06-17 17:25:31'),
(13, NULL, 'oasisers99@gmail.com', 'Hello There', '2', '2018-07-14 11:08:42', '2018-07-14 11:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `tribe`
--

DROP TABLE IF EXISTS `tribe`;
CREATE TABLE IF NOT EXISTS `tribe` (
  `id` varchar(21) NOT NULL,
  `name` varchar(128) NOT NULL,
  `summary` varchar(512) DEFAULT NULL,
  `description` text,
  `image1` varchar(512) DEFAULT NULL,
  `image2` varchar(512) DEFAULT NULL,
  `image3` varchar(512) DEFAULT NULL,
  `topic1` varchar(45) NOT NULL,
  `topic2` varchar(45) DEFAULT NULL,
  `region` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tribe`
--

INSERT INTO `tribe` (`id`, `name`, `summary`, `description`, `image1`, `image2`, `image3`, `topic1`, `topic2`, `region`, `country`, `created_by`, `updated_at`, `created_at`) VALUES
('20170811598e42864b95b', 'IT Professionals in Adelade', 'We are a group of IT professionals from the IT industry. We gathered with the mission to bring our IT expertise for people.', NULL, NULL, NULL, NULL, 'Technology', 'Technology', 'Adelaide', 'Australia', 'oasisers99@gmail.com', '2017-08-11 23:49:26', '2017-08-11 23:49:26'),
('20170811598e42c8710a1', 'Entrepreneurs Unite!', 'Let\'s use our entrepreneurial and business skills to help the greater good of Melbourne.', NULL, NULL, NULL, NULL, 'Consulting', 'Consulting', 'Melbourne', 'Australia', 'jacqui.storey89@gmail.com', '2017-08-11 23:50:32', '2017-08-11 23:50:32'),
('2017082659a0c707e95d6', 'Facilitators Gone Rogue', 'Facilitators Gone Rogue is a tribe for people that have significant experience in facilitation or have a strong appreciation for facilitation skills. Facilitation is such a valuable skill to have and is transferrable to many settings.', NULL, NULL, NULL, NULL, 'Consulting', 'Consulting', 'Melbourne', 'Australia', 'irwin.tobias@whatisnext.com.au', '2017-08-26 00:55:35', '2017-08-26 00:55:35'),
('2017082659a0c711c8185', 'Facilitators Gone Rogue', 'Facilitators Gone Rogue is a tribe for people that have significant experience in facilitation or have a strong appreciation for facilitation skills. Facilitation is such a valuable skills to have and is transferrable to many settings.', NULL, NULL, NULL, NULL, 'Consulting', 'Consulting', 'Melbourne', 'Australia', 'irwin.tobias@whatisnext.com.au', '2017-08-26 00:55:45', '2017-08-26 00:55:45'),
('2017082659a0c95bcd7b7', 'CEPTians in Australia', 'We are a tribe of alumni from CEPT University in Ahmedabad. Our time at university together has created a unique bond between us alumni. We are also at a time in our lives when we are able to give back to the community, in India and in Australia. Let\'s work together to better our global community.', NULL, NULL, NULL, NULL, 'Education', 'Education', 'Sydney', 'Australia', 'qureshmr@gmail.com', '2017-08-26 01:05:31', '2017-08-26 01:05:31'),
('201711135a0a2545cfbad', 'Green Thumbs', 'The Green Thumbs are a group of experienced home gardeners living in the inner city suburbs of Melbourne.', NULL, NULL, NULL, NULL, 'Recreation', 'Recreation', 'Richmond, Victoria', 'Australia', 'brigittestaples@gmail.com', '2017-11-13 23:05:41', '2017-11-13 23:05:41'),
('201711135a0a2b3e0d9fe', 'Global Citizens', 'The Global Citizens tribe is for people who identify with this term. Together we can bring all new perspectives and ideas from overseas to create interesting projects for our communities!', NULL, NULL, NULL, NULL, 'Culture', 'Culture', 'Adelaide', 'Australia', 'dpcyc77@gmail.com', '2017-11-13 23:31:10', '2017-11-13 23:31:10'),
('201711135a0a2dbacf87b', 'Richmond Community Learning Centre', 'RCLC provides spaces and opportunities for people to connect, contribute and communicate. As a neighborhood house we support a community development approach, by working closely with local people to provide a range of inclusive programs activities and events. Our aim is to create a stronger and more vibrant community.', NULL, NULL, NULL, NULL, 'Culture', 'Culture', 'Richmond, Victoria', 'Australia', 'admin@rclc.org.au', '2017-11-13 23:41:46', '2017-11-13 23:41:46'),
('201711145a0a68c869fe1', 'Med. Men', 'We are a group of men who\'s professional careers have been in the medical industry. We\'ve spent a lot of our lives in helping others and retirement should hold the same kind of satisfaction! With a life time of knowledge, we can achieve great things for the community now that we have the time to explore those opportunities. Join us!', NULL, NULL, NULL, NULL, 'Professions', 'Professions', 'Toowoomba', 'Australia', 'pjasperstorey@outlook.com', '2017-11-14 03:53:44', '2017-11-14 03:53:44'),
('201711145a0a6ad0448f0', 'Avid Readers', 'Avid Readers, the name says it all! We enjoy reading and sharing the love of books with others.', NULL, NULL, NULL, NULL, 'Culture', 'Culture', 'Toowoomba', 'Australia', 'sonjanagel56@gmail.com', '2017-11-14 04:02:24', '2017-11-14 04:02:24'),
('201711145a0a704f969cc', 'Retired Surfers Fraternity', 'From ‘weekend warrior’ surfer to having the luxury of surfing daily is the scenario awaiting the retiree. After many years of work and trying to squeeze in a session or two whenever possible, a new world awaits. The idea of a group of newly retired surfers from Shelly Beach on the Central Coast of NSW Australia to form a fraternity of local retirees', NULL, NULL, NULL, NULL, 'Sports', 'Sports', 'Australia Wide', 'Australia', 'admin@retiredsurfersfraternity.com', '2017-11-14 04:25:51', '2017-11-14 04:25:51'),
('201711165a0e0b0d549aa', 'For the Love of Science', 'We are a group that gather for the Love of Science! In a world of \'alternative facts\' we are a group looking to instil some order back into the community.', NULL, NULL, NULL, NULL, 'Professions', 'Professions', 'Caulfield, Victoria', 'Australia', 'gordanmcphee@gmail.com', '2017-11-16 22:02:53', '2017-11-16 22:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `tribe_code`
--

DROP TABLE IF EXISTS `tribe_code`;
CREATE TABLE IF NOT EXISTS `tribe_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `value` varchar(20) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tribe_join`
--

DROP TABLE IF EXISTS `tribe_join`;
CREATE TABLE IF NOT EXISTS `tribe_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tribe_id` varchar(21) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `message` varchar(1024) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tribe_join`
--

INSERT INTO `tribe_join` (`id`, `tribe_id`, `user_id`, `status`, `message`, `created_at`, `updated_at`) VALUES
(11, '201711145a0a6ad0448f0', 'elaine_shirley_nagel@yahoo.com', 1, NULL, '2017-11-14 04:35:16', '2017-11-14 04:35:16'),
(12, '201711135a0a2b3e0d9fe', 'jasmine.dehne@gmail.com', 1, NULL, '2017-11-16 21:51:50', '2017-11-16 21:51:50'),
(13, '201711145a0a68c869fe1', 'leoread@gmail.com', 1, NULL, '2017-11-16 21:53:00', '2017-11-16 21:53:00'),
(14, '201711145a0a6ad0448f0', 'benkoller@gmail.com', 1, NULL, '2017-11-16 21:54:23', '2017-11-16 21:54:23'),
(15, '201711135a0a2545cfbad', 'louise.smith@gmail.com', 1, NULL, '2017-11-16 21:56:02', '2017-11-16 21:56:02'),
(16, '2017082659a0c95bcd7b7', 'rajesh.iyer@gmail.com', 1, NULL, '2017-11-16 21:57:42', '2017-11-16 21:57:42'),
(17, '201711135a0a2b3e0d9fe', 'umarajendran@gmail.com', 1, NULL, '2017-11-16 21:59:22', '2017-11-16 21:59:22'),
(18, '201711165a0e0b0d549aa', 'tarynboyd@gmail.com', 1, NULL, '2017-11-16 22:03:43', '2017-11-16 22:03:43'),
(19, '2017082659a0c707e95d6', 'krishnahasani@gmail.com', 0, NULL, '2017-11-16 22:06:06', '2017-11-16 22:06:06'),
(20, '20170811598e42864b95b', 'f.blazevski@hotmail.com', 1, NULL, '2018-06-17 13:33:18', '2018-06-17 13:33:18');

-- --------------------------------------------------------

--
-- Table structure for table `tribe_member`
--

DROP TABLE IF EXISTS `tribe_member`;
CREATE TABLE IF NOT EXISTS `tribe_member` (
  `tribe_id` varchar(21) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `active` char(1) DEFAULT 'Y',
  `member_type` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tribe_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tribe_member`
--

INSERT INTO `tribe_member` (`tribe_id`, `user_id`, `active`, `member_type`, `updated_at`, `created_at`) VALUES
('20170811598e42864b95b', 'f.blazevski@hotmail.com', 'Y', '2', '2018-06-17 13:35:51', '2018-06-17 13:35:51'),
('20170811598e42864b95b', 'oasisers99@gmail.com', 'Y', '1,2', '2017-08-11 23:49:26', '2017-08-11 23:49:26'),
('20170811598e42c8710a1', 'jacqui.storey89@gmail.com', 'Y', '1,2', '2017-08-11 23:50:32', '2017-08-11 23:50:32'),
('2017082659a0c707e95d6', 'irwin.tobias@whatisnext.com.au', 'Y', '1,2', '2017-08-26 00:55:35', '2017-08-26 00:55:35'),
('2017082659a0c711c8185', 'irwin.tobias@whatisnext.com.au', 'Y', '1,2', '2017-08-26 00:55:45', '2017-08-26 00:55:45'),
('2017082659a0c95bcd7b7', 'qureshmr@gmail.com', 'Y', '1,2', '2017-08-26 01:05:31', '2017-08-26 01:05:31'),
('2017082659a0c95bcd7b7', 'rajesh.iyer@gmail.com', 'Y', '2', '2017-11-16 21:58:18', '2017-11-16 21:58:18'),
('201711135a0a2545cfbad', 'brigittestaples@gmail.com', 'Y', '1,2', '2017-11-13 23:05:41', '2017-11-13 23:05:41'),
('201711135a0a2545cfbad', 'louise.smith@gmail.com', 'Y', '2', '2017-11-16 21:56:30', '2017-11-16 21:56:30'),
('201711135a0a2b3e0d9fe', 'dpcyc77@gmail.com', 'Y', '1,2', '2017-11-13 23:31:10', '2017-11-13 23:31:10'),
('201711135a0a2b3e0d9fe', 'jasmine.dehne@gmail.com', 'Y', '2', '2017-11-16 21:52:24', '2017-11-16 21:52:24'),
('201711135a0a2b3e0d9fe', 'umarajendran@gmail.com', 'Y', '2', '2017-11-16 21:59:58', '2017-11-16 21:59:58'),
('201711135a0a2dbacf87b', 'admin@rclc.org.au', 'Y', '1,2', '2017-11-13 23:41:46', '2017-11-13 23:41:46'),
('201711145a0a68c869fe1', 'leoread@gmail.com', 'Y', '2', '2017-11-16 21:53:33', '2017-11-16 21:53:33'),
('201711145a0a68c869fe1', 'pjasperstorey@outlook.com', 'Y', '1,2', '2017-11-14 03:53:44', '2017-11-14 03:53:44'),
('201711145a0a6ad0448f0', 'benkoller@gmail.com', 'Y', '2', '2017-11-16 21:54:51', '2017-11-16 21:54:51'),
('201711145a0a6ad0448f0', 'elaine_shirley_nagel@yahoo.com', 'Y', '2', '2017-11-16 21:54:49', '2017-11-16 21:54:49'),
('201711145a0a6ad0448f0', 'sonjanagel56@gmail.com', 'Y', '1,2', '2017-11-14 04:02:24', '2017-11-14 04:02:24'),
('201711145a0a704f969cc', 'admin@retiredsurfersfraternity.com', 'Y', '1,2', '2017-11-14 04:25:51', '2017-11-14 04:25:51'),
('201711165a0e0b0d549aa', 'gordanmcphee@gmail.com', 'Y', '1,2', '2017-11-16 22:02:53', '2017-11-16 22:02:53'),
('201711165a0e0b0d549aa', 'tarynboyd@gmail.com', 'Y', '2', '2017-11-16 22:04:11', '2017-11-16 22:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `tribe_posting`
--

DROP TABLE IF EXISTS `tribe_posting`;
CREATE TABLE IF NOT EXISTS `tribe_posting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tribe_id` varchar(21) NOT NULL,
  `content` text NOT NULL,
  `created_by` varchar(64) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tribe_posting`
--

INSERT INTO `tribe_posting` (`id`, `tribe_id`, `content`, `created_by`, `updated_at`, `created_at`) VALUES
(5, '20170811598e42864b95b', '<h2>What is Lorem Ipsum?</h2>\n\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'oasisers99@gmail.com', '2017-08-28 12:42:59', '2017-08-24 12:46:56'),
(6, '20170811598e42864b95b', '<h2>Where does it come from?</h2>\n\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, end of line.</p>', 'oasisers99@gmail.com', '2017-08-24 13:50:36', '2017-08-24 12:47:08'),
(7, '20170811598e42864b95b', '<h2>Why do we use it?</h2>\n\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n\n<p>&nbsp;</p>\n\n<p>more contents can be found...</p>', 'oasisers99@gmail.com', '2017-08-25 07:18:19', '2017-08-24 12:47:16'),
(9, '20170811598e42864b95b', '<h3>The standard Lorem Ipsum passage, used since the 1500s,</h3>\n\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>', 'oasisers99@gmail.com', '2017-08-28 12:42:48', '2017-08-24 12:47:48'),
(10, '20170811598e42c8710a1', '<h2>New Project - Helping the Men&#39;s Shed</h2>\n\n<p>Looking for 2 or 3 tribe members to work with me on this project. I have written more details in the project description. I&#39;m open for other tribe members to spend as much or as little time as they have on their hands to contribute to this project. I expect that the total time on the project will be spending a few hours each week with the Men&#39;s Shed over a month or so. Let me know your thoughts, I&#39;m really keen to get this project going in the next few weeks. Contact me on the project page.&nbsp;</p>', 'jacqui.storey89@gmail.com', '2017-08-26 00:42:35', '2017-08-26 00:42:35'),
(11, '20170811598e42864b95b', '<h1>Test Post</h1>\n\n<p>This is a body updated</p>', 'f.blazevski@hotmail.com', '2018-09-13 00:33:58', '2018-09-13 00:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `tribe_project`
--

DROP TABLE IF EXISTS `tribe_project`;
CREATE TABLE IF NOT EXISTS `tribe_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `member_no` int(2) NOT NULL,
  `topic` varchar(64) NOT NULL,
  `location` varchar(64) NOT NULL,
  `country` varchar(32) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `tribe_id` varchar(21) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tribe_project`
--

INSERT INTO `tribe_project` (`id`, `title`, `description`, `member_no`, `topic`, `location`, `country`, `created_by`, `tribe_id`, `updated_at`, `created_at`) VALUES
(6, 'Help kids for education', 'We are planning to launch a project that helps kids to better be educated on a new web platform.', 6, 'technology', 'Adelaide', 'Australia', 'oasisers99@gmail.com', '20170811598e42864b95b', '2017-08-25 14:01:44', '2017-08-25 14:01:44'),
(7, 'Commercialisation of the Men\'s Shed Product', 'Monash Men\'s Shed are looking for an ongoing source of income for their community programs. As the Men\'s Shed members have excellent skills in woodwork and other crafts, they are looking to sell one of more of these products on an ongoing basis. Entrepreneurs Unite can help them through this process of commercialising, finding a target market and developing an ongoing production of the products. I need 2 or 3 other members of the tribe to join me to get this going. We will then leave the Men\'s Shed with a feasible strategy, connections to their target market and the know-how to continue on their commercialisation journey. This kind of work has been done before in Men\'s Sheds in Europe where they sell a product to contribute to their ongoing funds. Men\'s Sheds are about reducing social isolation and fostering a sense of purpose for elderly men in the direct community. This is a really worthy project.', 3, 'consulting', 'Monash Men\'s Shed', 'Australia', 'jacqui.storey89@gmail.com', '20170811598e42c8710a1', '2017-08-26 00:40:10', '2017-08-26 00:40:10'),
(8, 'Whole Brain Thinking Workshop', 'After a long career involving facilitation, I want to give back to the community. I\'m excited to share my skills and knowledge with charities and not-for-profits that are interested in learning about whole brain thinking. This is an invaluable skill set as it enables leaders and team members to appreciate each other\'s mind sets. This enables teams to work better together and tailor their communication. I need 1 or 2 members from the tribe to assist me in this workshop. It could turn into a series of workshops. I am more than willing to teach you about whole brain thinking in return for your time assisting me in running this workshop. Happy Days!', 2, 'consulting', 'Melbourne', 'Australia', 'irwin.tobias@whatisnext.com.au', '2017082659a0c707e95d6', '2017-08-26 01:01:46', '2017-08-26 01:01:46'),
(9, 'Supporting a Student', 'We all know the struggles that face our nation. Many people are living in poverty and cannot afford to send their children to school, let alone University. I am so grateful in my life to have had an awesome university experience and to be able to come to Australia. I would like to support another child in a less fortunate position than me. Through our CEPTian network, let\'s find a struggling family to support to help their child go to school. If we all contribute a small amount of money to this family, then it will add up to a big sum that can be very helpful for them. Let\'s discuss who we should support, how much money we should donate and how we should do it.', 10, 'education', 'Australia and India', 'Australia', 'qureshmr@gmail.com', '2017082659a0c95bcd7b7', '2017-08-26 01:18:31', '2017-08-26 01:18:31'),
(10, 'Greening the River St Apartment Block', 'Several members of the Green Thumbs live in an apartment block on River St. We have banded together to help maintain the garden and also add a few of our favourite plants into the mix. We\'re thinking of adding compost bins, worm farms and vegetables in the future, who knows where this project will go! It would be great to have a small dedicated group so we could explore these opportunities together. Also someone with knowledge on composting/worm farming and knowledge on what kinds of local government subsidies there might be for this kind of equipment. would be extremely useful. Looking forward to greening our urban spaces with you!', 10, 'Recreation', 'Richmond, Victoria', 'Australia', 'brigittestaples@gmail.com', '201711135a0a2545cfbad', '2017-11-13 23:14:00', '2017-11-13 23:14:00'),
(11, 'Empowerment for All Women', 'Let\'s get together on a regular basis as women from all different countries, professional backgrounds and sexual orientations. We know some countries are further along their equality journey than others, there\'s a lot of great examples to learn from. I am going to show a short film, video clip or full length movie every month at the Box Factory Community Centre in Adelaide CBD. and I hope my tribe members will also come forward with excellent, empowering suggestions on media we can share to show examples of awesome, female empowerment from all over the globe.', 2, 'Culture', 'Adelaide CBD', 'Australia', 'dpcyc77@gmail.com', '201711135a0a2b3e0d9fe', '2017-11-13 23:38:43', '2017-11-13 23:38:43'),
(12, 'Cheeky Chook Crew', 'Burk Burk Burk!!!\r\n\r\nOur chooks have arrived at Burnley Backyard! Our four new feathery friends have acclimatised to their new environment and now roam the community gardens freely during the day and return to their chook shed at night. They have also laid their first eggs here – how exciting!\r\n\r\nWe have put up detachable netting to protect the raised garden beds. If you are working in the community garden area, or are dropping of scraps to the Aerobin, please be careful not to let the chooks out of the gate.\r\n\r\nWe have been working closely with our chook guru Sophie who leads the Crew. Some examples of Chook Crew duties include making sure there’s fresh water, enough food and some food scraps, cleaning the shed, letting the chooks out to roam in the morning and making sure they are all back in the shed in the evening. Oh…and collecting lovely fresh eggs which the Chook Crew get to keep. \r\n\r\nThere will be daily morning (7AM) and evening (6PM) chook duties to be completed, and this will take no longer than 15 minutes.', 6, 'Recreation', 'Bendigo St, Burnley, Victoria', 'Australia', 'admin@rclc.org.au', '201711135a0a2dbacf87b', '2017-11-13 23:44:24', '2017-11-13 23:44:24'),
(13, 'Backyard Bike Crew', 'We are a group of passionate local volunteers, the Backyard Bike Group. We help people gain knowledge and confidence in maintaining safe and enjoyable bicycles through hands on workshops.\r\n\r\nWe’re looking at adding some new activities to our repertoire, so would be keen to hear from new tribe members.\r\n\r\nWe\'re thinking of hosting a few riding sessions for people who want to get back into riding and for those who are looking for company when riding.\r\n\r\nEvery Second Wednesday we host an event called \'Bike Talk and Oil Gatherings\'\r\n\r\nWe\'d love you to join the crew, the more the merrier!', 2, 'Sports', 'Bendigo St, Burnley, Victoria', 'Australia', 'admin@rclc.org.au', '201711135a0a2dbacf87b', '2017-11-13 23:48:09', '2017-11-13 23:48:09'),
(14, 'Specialist Education Material for Graduates', 'I have noticed through my career that graduates are entering the workforce with little knowledge on radiology practices. I have formed a partnership with a reputed education organisation \r\n develop a number of online education modules to assist with their professional knowledge. To ensure the quality of the material, format and design; I\'m inviting other tribe members and external members to contribute to this project - particularly with online education or graphic design knowledge. If this one proves to be successful we could set our goal on the next important specialist knowledge area. \r\nBest regards, Peter', 3, 'Professions', 'Toowoomba, Queensland', 'Australia', 'pjasperstorey@outlook.com', '201711145a0a68c869fe1', '2017-11-14 03:58:33', '2017-11-14 03:58:33'),
(15, 'Reading to Little Ones - fostering book love', 'We all know the importance of technology BUT let us not forget the joy of reading a book. The smell of a fresh, new book, the feel of the crisp pages, the beautiful illustrations. We are the custodians of book love, the generation before iPads played a part in the lives of our children. \r\n\r\nI thank JK Rowling for saving a generation of children from a bookless life. I believe interesting books with stories that inspire the imagination will keep books in children\'s lives. \r\n\r\nEvery Saturday morning at 10am we meet at Queens Park (at the playground with the red train) to read with children of all ages. Bring your favourite books, snacks, a picnic rug and bring your grandchildren! We exchange books and laughs!', 10, 'Culture', 'Queens Park Toowoomba', 'Australia', 'sonjanagel56@gmail.com', '201711145a0a6ad0448f0', '2017-11-14 04:16:39', '2017-11-14 04:16:39'),
(16, 'Shore Clean Up - Shelley Beach', 'Our beautiful Shelley Beach has had a bit of plastic debris wash up recently. Let\'s get together at 7am on the first Monday of each month to make sure it says beautiful and healthy. Afterwards we can catch some waves and share a morning coffee.', 10, 'Sports', 'Shelley Beach', 'Australia', 'admin@retiredsurfersfraternity.com', '201711145a0a704f969cc', '2017-11-14 04:28:22', '2017-11-14 04:28:22'),
(17, 'Coach Refugee Children in sports and teaching', 'Coach refugee children in two aspects of their learning: Sports and teaching. You\'ll mainly assist in Primary Schools where the children\'s ages range from 5 to 10 years-old and thus sport is part time, but the schools usually have excellent facilities. The combination of coaching and teaching will give you great diversity on the project.\r\n\r\nThe sports are generally coached by season. Different sports have different seasons and the main sports are as follows:\r\n\r\nFebruary to April: Swimming, Tennis, Cricket, Athletics\r\nMay to July: Rugby Union & League, Football (soccer) , Hockey, Netball, Australian football\r\nAugust to October: Football, Netball. AFL\r\nOctober to December: Athletics, Cricket, Cross Country & Football.\r\n\r\nThis program is run by the Budget Volunteering; BVOL.', 2, 'Sports', 'Perth', 'Australia', 'dpcyc77@gmail.com', '201711135a0a2b3e0d9fe', '2017-11-16 01:59:13', '2017-11-16 01:59:13'),
(18, 'Tech Improvement in Adelaide', 'We want to remove inefficiencies by introducing IT techs we can build!', 10, 'Technology', 'Adelaide', 'Australia', 'oasisers99@gmail.com', '20170811598e42864b95b', '2017-11-28 22:44:36', '2017-11-28 22:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(128) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(256) NOT NULL,
  `member_type` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `confirmed` int(11) DEFAULT NULL,
  `remember_token` varchar(256) DEFAULT NULL,
  `suburb` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `password`, `member_type`, `active`, `confirmed`, `remember_token`, `suburb`, `state`, `description`, `updated_at`, `created_at`) VALUES
('Richmond Community Learning Centre', 'admin@rclc.org.au', '$2y$10$4VXmNZDd8uOObq6/lbnx0eJ/WIugPU1rlfALA0lE1JEfuqcKvZ01S', 1, 1, 1, 'OsnxS1kpIViSpnNun3EjCKU6cT965tTghkpgvKkSvo5m89GTd5ndu5Owrrv1', NULL, NULL, NULL, '2017-11-13 23:41:02', '2017-11-13 23:41:02'),
('Craig Houghton', 'admin@retiredsurfersfraternity.com', '$2y$10$L4ZmLdQSmYGdbbhuzehqDe0POtgoKqg82NHL5p9T.YUo1QV//G.tK', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-14 04:22:59', '2017-11-14 04:22:59'),
('Ben Koller', 'benkoller@gmail.com', '$2y$10$AuVjj66utkk3auAxSce8JuVY/xwZxc0IHQ0u.hxbjrF4/qhTkk/3O', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-16 21:54:03', '2017-11-16 21:54:03'),
('Brigitte Staples', 'brigittestaples@gmail.com', '$2y$10$L1dErNYLI76.uGZ5LJvIDuOLMB6vobiUxqe4vcUnVDa6HIuXSwb92', 1, 1, 1, 'cR1laT0cOiVP7UJrLeQZEFDV8dAEvYjRfmxqe6T2lQGQUnEHmcqpCJTIpecn', NULL, NULL, NULL, '2017-11-13 23:02:47', '2017-11-13 23:02:47'),
('Jisang Shin', 'dpcyc77@gmail.com', '$2y$10$YjqkKMEICfiJRPfts2psAuSRBaGuOgg8av1I0iRPVWu5ca1/X.cDy', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-13 23:21:24', '2017-11-13 23:21:24'),
('Elaine Nagel', 'elaine_shirley_nagel@yahoo.com', '$2y$10$SxmhVXpoS/eYg1JrEdOFeeEKz4osmKlezPjUdcKnIQSSfpQ0k8k.K', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-14 04:34:32', '2017-11-14 04:34:32'),
('Filip Blazevski', 'f.blazevski@hotmail.com', '$2y$10$/TW3JT0Jo4iky7PqoLCelOBxcoEA2XwQVGnGc5EsWnbBCom7nfyJG', 1, 1, 1, NULL, 'Melbourne', 'VIC', 'Introduction no need', '2018-06-14 10:53:40', '2018-06-14 10:53:40'),
('Gordan McPhee', 'gordanmcphee@gmail.com', '$2y$10$O6L33lJQowcpC/K5hNVfheiKRXKxmluD.q8m3H5VatQQJBPCtDFia', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-16 22:00:57', '2017-11-16 22:00:57'),
('Irwin', 'irwin.tobias@whatisnext.com.au', '$2y$10$rxz8q4fu6u6MAEa1R2n1Zesw5sH7h3wPNhZZ2lpPw5E/bM0HOZgXq', 1, 1, 1, 'Ycl72vviQa2Y41HZJ2DxVAD9cq8SXt6LDRdGjH0bOV8iWoH6qdt75JnZqPV6', NULL, NULL, NULL, '2017-08-26 00:51:25', '2017-08-26 00:51:25'),
('Jacqui', 'jacqui.storey89@gmail.com', '$2y$10$l1KSIpLX.ZrodcnwA.yX3e.O8q2u6LLmCmuL5wg0FGWuPzp0IMEya', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-13 21:45:29', '2017-11-13 21:45:29'),
('Jacqui', 'jacqui.storey89@gmail.combackup', '$2y$10$DuWWmgb9HgMM97mMK0IP2OiZWxOyzAdcPXxQgoqc0Xk68OLQWCFqi', 1, 1, 1, 'ViKIqRGpFnArNMoJOJmOxPaFRs0hRWXohtbUYIko2Hyn0ik3fIjoYgoOyMln', NULL, NULL, NULL, '2017-08-11 23:47:31', '2017-08-11 23:47:31'),
('Jasmine Dehne', 'jasmine.dehne@gmail.com', '$2y$10$x1Yq1n49W7SNfxC7P6LoNuKKkkc9XVMhcNMn3R60gSJJQiRxO3jBC', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-16 21:51:02', '2017-11-16 21:51:02'),
('Krishna Hasani', 'krishnahasani@gmail.com', '$2y$10$x0Ba3ubeXynB3PutIepCUel5CHjMS0KvqbCaQRktBQ/3IvgJZvXn.', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-16 22:05:40', '2017-11-16 22:05:40'),
('Leo Read', 'leoread@gmail.com', '$2y$10$OkJCiA2erhaTNvy/cLkARuNXhdpnYd2Xx1oqKYX17sqFoDUUGpVQ.', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-16 21:52:49', '2017-11-16 21:52:49'),
('Louise Smith', 'louise.smith@gmail.com', '$2y$10$AnHJugwKdI8iOr5VXI6NCO85wosDDTLOJctIfRqnlRiEhZ/XVQFEO', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-16 21:55:26', '2017-11-16 21:55:26'),
('Peter Song', 'oasisers99@gmail.com', '$2y$10$/TW3JT0Jo4iky7PqoLCelOBxcoEA2XwQVGnGc5EsWnbBCom7nfyJG', 1, 1, 1, NULL, 'asfsdf', 'sdf', 'Hi! I have 10+ years of experience in the IT domain, and I would like to do some cool IT projects. I am looking forward to joining a tribe that has a focus on IT projects!', '2017-08-11 23:48:12', '2017-08-11 23:48:12'),
('Peter Storey', 'pjasperstorey@outlook.com', '$2y$10$T8CrlQZHFjL/hXDdcxcG9.MgAibFA7vW17xz9ktvex5XC2Yxfsvme', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-14 03:50:05', '2017-11-14 03:50:05'),
('Quresh', 'qureshmr@gmail.com', '$2y$10$owgxogjM5IVWUfCJxH8XGuNeRuyygkUdVLoIs5ivBKqNK1PWyOeTq', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-08-26 01:03:12', '2017-08-26 01:03:12'),
('Rajesh Iyer', 'rajesh.iyer@gmail.com', '$2y$10$F2xVjbut6d5l.n3FaIK9HOAYFQ7hqut/3EtoR4eQvWByd5shve9We', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-16 21:57:05', '2017-11-16 21:57:05'),
('Sonja Nagel', 'sonjanagel56@gmail.com', '$2y$10$.T2HcqmaxcM8f.mv1cd1qeqahGFwympb2yR0XgUextf/Sxi1H0I4m', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-14 04:00:03', '2017-11-14 04:00:03'),
('Taryn Boyd', 'tarynboyd@gmail.com', '$2y$10$UVX/SveY7rwrZj0mhOpNwOVVgulUs2rogBpvhfkbz4hreLqFT3A2S', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-16 22:03:34', '2017-11-16 22:03:34'),
('Uma Rajendran', 'umarajendran@gmail.com', '$2y$10$Sq7wldexrWH25Yl6MPg9gO4VukzzM98hNQn3lItTGUe205zmgiGTC', 1, 1, 1, NULL, NULL, NULL, NULL, '2017-11-16 21:59:14', '2017-11-16 21:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_interest`
--

DROP TABLE IF EXISTS `user_interest`;
CREATE TABLE IF NOT EXISTS `user_interest` (
  `user_id` varchar(45) NOT NULL,
  `interest` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_interest`
--

INSERT INTO `user_interest` (`user_id`, `interest`, `created_at`) VALUES
('oasisers99@gmail.com', 'Alumni', '2017-11-28 22:22:21'),
('oasisers99@gmail.com', 'Culture', '2017-11-28 22:22:21'),
('oasisers99@gmail.com', 'Nationalities', '2017-11-28 22:22:21'),
('oasisers99@gmail.com', 'Location', '2017-11-28 22:22:21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
