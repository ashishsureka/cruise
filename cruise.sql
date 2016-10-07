-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2016 at 11:22 AM
-- Server version: 5.6.22-72.0-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wwsptalg_db16`
--

-- --------------------------------------------------------

--
-- Table structure for table `cru_admin`
--

CREATE TABLE IF NOT EXISTS `cru_admin` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_name` varchar(50) NOT NULL,
  `adm_email` varchar(255) NOT NULL,
  `adm_password` varchar(255) NOT NULL,
  `adm_status` enum('enable','disable','delete') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL,
  PRIMARY KEY (`adm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cru_admin`
--

INSERT INTO `cru_admin` (`adm_id`, `adm_name`, `adm_email`, `adm_password`, `adm_status`, `timestamp`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(1, 'admin', 'admin@winspirewebsolution.com', '3b818c957e91dae88baffd38036ac152', 'enable', '2016-08-08 12:14:35', '2016-08-06 00:00:00', '', '2016-08-06 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `cru_email_settings`
--

CREATE TABLE IF NOT EXISTS `cru_email_settings` (
  `es_id` int(11) NOT NULL AUTO_INCREMENT,
  `es_name` varchar(255) NOT NULL,
  `es_value` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`es_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cru_email_settings`
--

INSERT INTO `cru_email_settings` (`es_id`, `es_name`, `es_value`, `timestamp`) VALUES
(1, 'host name', 'mail.winspirewebsolution.com', '2016-08-08 11:32:02'),
(2, 'outgoing port', '587', '2016-08-08 11:32:18'),
(3, 'username', 'noreply@wwsptech.com', '2016-08-08 11:18:19'),
(4, 'password', 'reply123', '2016-08-08 11:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `cru_email_templates`
--

CREATE TABLE IF NOT EXISTS `cru_email_templates` (
  `et_id` int(11) NOT NULL AUTO_INCREMENT,
  `et_subject` varchar(255) NOT NULL,
  `et_variables` text NOT NULL,
  `et_description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`et_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cru_email_templates`
--

INSERT INTO `cru_email_templates` (`et_id`, `et_subject`, `et_variables`, `et_description`, `timestamp`) VALUES
(1, 'CRUISE Registration Detail', '%emailid% => Registered email id\r\n%password% => User Password\r\n%site_url% => Site URL', '&lt;h1&gt;CRUISE Registration&lt;/h1&gt;\r\n\r\n&lt;h3&gt;You are successfully registered with CRUISE. Your Login details are as below.&lt;/h3&gt;\r\n\r\n&lt;p&gt;Email : %emailid%&lt;/p&gt;\r\n\r\n&lt;p&gt;Password : %password%&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;a href=&quot;%site_url%&quot;&gt;CLICK HERE&lt;/a&gt;&amp;nbsp;&amp;nbsp;To get Log In to CRUISE&lt;/p&gt;\r\n', '2016-08-10 09:24:56'),
(2, 'Invitation For CRUISE Project', '%link% => login link\r\n', '&lt;h1&gt;CRUISE Login&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;a href=&quot;%link%&quot;&gt;CLICK HERE&lt;/a&gt;&amp;nbsp;&amp;nbsp;To get Login / Register to CRUISE&lt;/p&gt;\r\n', '2016-09-07 06:41:59'),
(3, 'CRUISE Activation', '%site_url% => Activation Link', '&lt;h1&gt;CRUISE Activation&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;a href=&quot;%site_url%&quot;&gt;CLICK HERE&lt;/a&gt;&amp;nbsp;&amp;nbsp;to activate your CRUISE account.&lt;/p&gt;\r\n', '2016-09-01 10:28:51'),
(4, 'CRUISE Forgot Password', '%password% => New Password', '&lt;h1&gt;CRUISE Forgot Password&lt;/h1&gt;\r\n\r\n&lt;h3&gt;Your new password is as below.&lt;/h3&gt;\r\n\r\n&lt;p&gt;New Password : %password%&lt;/p&gt;\r\n', '2016-09-03 09:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `cru_inquiry`
--

CREATE TABLE IF NOT EXISTS `cru_inquiry` (
  `inq_id` int(11) NOT NULL AUTO_INCREMENT,
  `inq_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `inq_contact` int(11) NOT NULL,
  `inq_email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `inq_comment` text CHARACTER SET utf8 NOT NULL,
  `inq_status` enum('pending','approved','cancel','delete') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`inq_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cru_inquiry`
--

INSERT INTO `cru_inquiry` (`inq_id`, `inq_name`, `inq_contact`, `inq_email`, `inq_comment`, `inq_status`) VALUES
(1, 'Bob', 123456789, 'bob@gmail.com', 'waw', 'approved'),
(2, 'aniket', 1234567890, 'aniket@winspirewebsolution.com', 'xzczxczxc', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `cru_pages`
--

CREATE TABLE IF NOT EXISTS `cru_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_meta_title` varchar(255) NOT NULL,
  `page_meta_keywords` varchar(255) NOT NULL,
  `page_meta_descriptions` varchar(255) NOT NULL,
  `page_description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cru_pages`
--

INSERT INTO `cru_pages` (`page_id`, `page_title`, `page_url`, `page_meta_title`, `page_meta_keywords`, `page_meta_descriptions`, `page_description`, `timestamp`) VALUES
(1, 'Login', '', 'CRUISE Login', 'CRUISE Login', 'CRUISE Login', 'CRUISE Login', '2016-08-31 10:58:31'),
(2, 'Dashboard', '', 'CRUISE Dashboard', 'CRUISE Dashboard', 'CRUISE Dashboard', 'CRUISE Dashboard', '2016-08-31 10:58:36'),
(3, 'Contributor', '', 'CRUISE Contributor', 'CRUISE Contributor', 'CRUISE Contributor', 'CRUISE Contributor', '2016-08-31 10:58:40'),
(4, 'Profile', '', 'Manage Profile', 'Manage Profile', 'Manage Profile', '<p>Manage Profile</p>', '2016-09-22 10:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `cru_projects`
--

CREATE TABLE IF NOT EXISTS `cru_projects` (
  `prj_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prj_title` varchar(255) NOT NULL,
  `prj_description` text NOT NULL,
  `prj_url` varchar(255) NOT NULL,
  `prj_createdby` enum('user','admin') NOT NULL,
  `prj_status` enum('enable','disable','delete') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL,
  PRIMARY KEY (`prj_id`),
  KEY `user_id` (`user_id`),
  KEY `prj_url` (`prj_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `cru_projects`
--

INSERT INTO `cru_projects` (`prj_id`, `user_id`, `prj_title`, `prj_description`, `prj_url`, `prj_createdby`, `prj_status`, `timestamp`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(1, 17, 'Project2', 'Project Description 2', '', 'admin', 'delete', '2016-08-29 04:58:21', '2016-08-09 00:00:00', '', '2016-08-16 03:00:23', '::1'),
(5, 15, 'cxdf', 'dfgdfg1', '', 'user', 'enable', '2016-09-16 11:46:06', '2016-08-10 09:21:33', '::1', '2016-08-16 02:34:38', '::1'),
(6, 28, 'Project123', 'xcvdvdfgdf123', 'project123', 'admin', 'enable', '2016-09-16 11:46:14', '2016-09-02 08:56:06', '::1', '2016-09-06 00:35:55', '::1'),
(7, 28, 'Project234', 'zxlmsdklvgdklsfmvgkdfmbvgklm234', 'project234', 'admin', 'enable', '2016-09-13 04:57:54', '2016-09-03 04:27:12', '::1', '2016-09-05 08:05:04', '::1'),
(8, 28, 'Project34', 'mdfcnsdjkbvfsdfjkvhjsdbvgb34', 'project34', 'admin', 'enable', '2016-09-13 04:58:05', '2016-09-03 04:27:30', '::1', '2016-09-05 08:07:47', '::1'),
(9, 28, 'New Project', 'jhbfsjbhjbfjhbvfhbfh', '', 'user', 'delete', '2016-09-17 04:10:56', '2016-09-03 07:54:53', '::1', '2016-09-03 07:54:53', '::1'),
(10, 28, 'New Project', 'jhbfsjbhjbfjhbvfhbfh', '', 'user', 'delete', '2016-09-17 04:11:08', '2016-09-03 07:55:10', '::1', '2016-09-03 07:55:10', '::1'),
(11, 28, 'New Project2', 'skjgfnjjvdfhbfdfh', '', 'user', 'delete', '2016-09-17 04:11:20', '2016-09-03 07:59:13', '::1', '2016-09-03 07:59:13', '::1'),
(12, 28, 'Project1', 'asdasdswdxws', '', 'user', 'delete', '2016-09-03 12:53:44', '2016-09-03 08:02:20', '::1', '2016-09-03 08:02:20', '::1'),
(13, 28, 'Project2', 'dfgdfg', '', 'user', 'delete', '2016-09-17 04:11:32', '2016-09-03 08:03:52', '::1', '2016-09-03 08:03:52', '::1'),
(14, 28, 'Project2', 'dfgdfg', '', 'user', 'delete', '2016-09-03 12:49:53', '2016-09-03 08:05:16', '::1', '2016-09-03 08:05:16', '::1'),
(15, 28, 'Project2', 'dfgdfg', '', 'user', 'delete', '2016-09-03 12:48:18', '2016-09-03 08:05:48', '::1', '2016-09-03 08:05:48', '::1'),
(16, 28, 'cxdf', 'dfgdfhb', '', 'user', 'delete', '2016-09-03 12:48:13', '2016-09-03 08:06:49', '::1', '2016-09-03 08:06:49', '::1'),
(17, 28, 'sdfgsd', 'sdfsdf', '', 'user', 'delete', '2016-09-09 10:12:54', '2016-09-03 09:56:20', '::1', '2016-09-03 09:56:20', '::1'),
(18, 28, 'sdfgsd', 'sdfsdf', '', 'user', 'delete', '2016-09-09 10:12:58', '2016-09-03 09:56:42', '::1', '2016-09-03 09:56:42', '::1'),
(19, 28, 'dg', 'dfgd', '', 'user', 'delete', '2016-09-09 10:13:00', '2016-09-05 00:59:32', '::1', '2016-09-05 00:59:32', '::1'),
(20, 28, 'dg', 'dfgd', '', 'user', 'delete', '2016-09-09 10:13:03', '2016-09-05 01:00:05', '::1', '2016-09-05 01:00:05', '::1'),
(21, 28, 'asdas', 'asdasd', '', 'user', 'delete', '2016-09-09 10:13:07', '2016-09-05 01:00:13', '::1', '2016-09-05 01:00:13', '::1'),
(22, 28, 'xcvd', 'sdfgdfvg', '', 'user', 'delete', '2016-09-09 10:13:10', '2016-09-05 01:00:58', '::1', '2016-09-05 01:00:58', '::1'),
(23, 28, 'xcvxc', 'xcvxcv', '', 'user', 'delete', '2016-09-09 10:13:13', '2016-09-05 02:08:45', '::1', '2016-09-05 02:08:45', '::1'),
(24, 28, 'dfgb', 'dfh', '', 'user', 'delete', '2016-09-09 10:13:17', '2016-09-06 01:15:22', '::1', '2016-09-06 01:15:22', '::1'),
(25, 28, 'gfh', 'gfh', '', 'user', 'delete', '2016-09-09 10:13:21', '2016-09-06 01:17:47', '::1', '2016-09-06 01:17:47', '::1'),
(26, 28, 'cvbn', 'gfh', '', 'user', 'delete', '2016-09-09 10:13:24', '2016-09-06 01:22:01', '::1', '2016-09-06 01:22:01', '::1'),
(27, 28, 'sdgfdfg', 'dfgdf', '', 'user', 'delete', '2016-09-09 10:13:28', '2016-09-06 01:37:31', '::1', '2016-09-06 01:37:31', '::1'),
(28, 28, 'dfgh', 'dfhgfh', '', 'user', 'delete', '2016-09-09 10:13:31', '2016-09-06 01:40:07', '::1', '2016-09-06 01:40:07', '::1'),
(29, 28, 'Hello Aniket', 'hello', '', 'admin', 'enable', '2016-09-07 07:23:11', '2016-09-07 03:23:11', '::1', '2016-09-07 03:23:11', '::1'),
(30, 20, 'sdfknsdn', 'dfgdfg', '', 'user', 'enable', '2016-09-09 09:03:58', '2016-09-09 05:03:58', '::1', '2016-09-09 05:03:58', '::1'),
(31, 28, 'Project', 'hbjhbjh', 'project', 'admin', 'enable', '2016-09-09 09:41:44', '2016-09-09 05:41:44', '::1', '2016-09-09 05:41:44', '::1'),
(32, 28, 'Wow Awesom Project', 'NKJBHJBVJh', 'wow-awesom-project', 'admin', 'delete', '2016-09-09 10:12:39', '2016-09-09 05:42:31', '::1', '2016-09-09 05:42:31', '::1'),
(33, 28, 'Project', 'fsdfsdf', 'project-1', 'admin', 'delete', '2016-09-09 10:12:50', '2016-09-09 05:57:34', '::1', '2016-09-09 05:57:34', '::1'),
(34, 28, 'Project', 'dfhfdghgh', 'project-2', 'user', 'enable', '2016-09-09 10:11:03', '2016-09-09 06:11:03', '::1', '2016-09-09 06:11:03', '::1'),
(37, 28, 'dfgfg', 'dfgdf', 'dfgfg', 'user', 'enable', '2016-09-09 13:00:06', '2016-09-09 08:15:02', '::1', '2016-09-09 08:15:02', '::1'),
(38, 38, 'Students Registration System', 'This project is meant to automate the process of students'' registration at the commencement of new semester.  ', 'students-registration-system', 'user', 'enable', '2016-09-26 14:12:35', '2016-09-26 10:12:35', '103.201.140.94', '2016-09-26 10:12:35', '103.201.140.94'),
(39, 38, 'Students Grading System', 'This project is meant to automate the grade-processing system of students, which otherwise is done through excel-sheets.', 'students-grading-system', 'user', 'enable', '2016-09-26 18:24:34', '2016-09-26 14:24:34', '103.201.140.94', '2016-09-26 14:24:34', '103.201.140.94'),
(40, 40, 'qaz', 'project des', 'qaz', 'user', 'enable', '2016-09-27 13:28:02', '2016-09-27 09:28:02', '117.239.226.201', '2016-09-27 09:28:02', '117.239.226.201'),
(41, 40, 'gyugi', 'jhgyihg', 'gyugi', 'user', 'delete', '2016-09-27 13:55:26', '2016-09-27 09:52:04', '117.239.226.201', '2016-09-27 09:52:04', '117.239.226.201'),
(42, 40, 'khgiyhvg', 'mhvgjvuy', 'khgiyhvg', 'user', 'enable', '2016-09-27 13:54:18', '2016-09-27 09:54:18', '117.239.226.201', '2016-09-27 09:54:18', '117.239.226.201'),
(43, 47, 'Course Registration Portal', 'This Portal being developed for the university allows the automation of students registering in a particular semester. Our main aim was to reduce the paper works to a great extent and allowing the admin of the portal to have any information, regarding students and related issues, on the go. The most important thing that our system will be able to check is the physical presence of the student in the university while registering. ', 'course-registration-portal', 'user', 'delete', '2016-09-28 13:56:30', '2016-09-28 09:53:13', '115.249.4.65', '2016-09-28 09:53:13', '115.249.4.65');

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_comment_likes`
--

CREATE TABLE IF NOT EXISTS `cru_project_comment_likes` (
  `cmtlk_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `cmt_id` int(11) NOT NULL,
  `cmtlk_status` enum('enable','disable','delete') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL,
  PRIMARY KEY (`cmtlk_id`),
  KEY `prj_id` (`prj_id`),
  KEY `user_id` (`user_id`),
  KEY `prr_id` (`cmt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cru_project_comment_likes`
--

INSERT INTO `cru_project_comment_likes` (`cmtlk_id`, `user_id`, `prj_id`, `cmt_id`, `cmtlk_status`, `timestamp`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(9, 28, 31, 57, 'enable', '2016-09-16 11:38:30', '2016-09-16 07:38:30', '::1', '2016-09-16 07:38:30', '::1'),
(10, 28, 31, 57, 'enable', '2016-09-16 11:38:32', '2016-09-16 07:38:32', '::1', '2016-09-16 07:38:32', '::1'),
(11, 28, 31, 57, 'enable', '2016-09-16 11:38:34', '2016-09-16 07:38:34', '::1', '2016-09-16 07:38:34', '::1'),
(12, 28, 31, 57, 'enable', '2016-09-16 11:38:35', '2016-09-16 07:38:35', '::1', '2016-09-16 07:38:35', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_invites`
--

CREATE TABLE IF NOT EXISTS `cru_project_invites` (
  `pri_id` int(11) NOT NULL AUTO_INCREMENT,
  `prj_id` int(11) NOT NULL,
  `pri_email` varchar(255) NOT NULL,
  `pri_invited_by` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL,
  PRIMARY KEY (`pri_id`),
  KEY `prj_id` (`prj_id`),
  KEY `pri_invited_by` (`pri_invited_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `cru_project_invites`
--

INSERT INTO `cru_project_invites` (`pri_id`, `prj_id`, `pri_email`, `pri_invited_by`, `timestamp`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(2, 6, 'aniketbhatt031@gmail.com', 28, '2016-09-09 09:12:19', '2016-09-09 05:12:19', '::1', '2016-09-09 05:12:19', '::1'),
(3, 6, 'aniketbhatt03111@gmail.com', 28, '2016-09-09 11:56:32', '2016-09-09 07:56:32', '::1', '2016-09-09 07:56:32', '::1'),
(4, 6, 'aniket@gmail.com', 28, '2016-09-09 11:57:44', '2016-09-09 07:57:44', '::1', '2016-09-09 07:57:44', '::1'),
(6, 37, 'aniketbhatt031@gmail.com', 28, '2016-09-09 12:15:14', '2016-09-09 08:15:14', '::1', '2016-09-09 08:15:14', '::1'),
(7, 9, 'aniket1@gmail.com', 28, '2016-09-09 12:58:03', '2016-09-09 08:58:03', '::1', '2016-09-09 08:58:03', '::1'),
(11, 1, 'aniket@gmail.com', 28, '2016-09-12 10:17:02', '2016-09-12 06:17:02', '::1', '2016-09-12 06:17:02', '::1'),
(19, 6, 'sricha@gmail.com', 28, '2016-09-21 06:45:08', '2016-09-21 02:45:08', '117.239.226.201', '2016-09-21 02:45:08', '117.239.226.201'),
(20, 38, 'hitkul.bmu.14cs@bml.edu.in', 38, '2016-09-26 14:20:14', '2016-09-26 10:20:14', '103.201.140.94', '2016-09-26 10:20:14', '103.201.140.94'),
(21, 38, 'prateek.sen.14cse@bml.edu.in', 38, '2016-09-26 14:28:54', '2016-09-26 10:28:54', '103.201.140.94', '2016-09-26 10:28:54', '103.201.140.94'),
(22, 38, 'prateek.kumar.14cse@bml.edu.in', 38, '2016-09-26 14:29:32', '2016-09-26 10:29:32', '103.201.140.94', '2016-09-26 10:29:32', '103.201.140.94'),
(23, 38, 'gardas.nuthan.14cs@bml.edu.in', 38, '2016-09-26 14:36:49', '2016-09-26 10:36:49', '103.201.140.94', '2016-09-26 10:36:49', '103.201.140.94'),
(24, 38, 'vaibhav.singh.14cse@bml.edu.in', 38, '2016-09-26 14:37:18', '2016-09-26 10:37:18', '103.201.140.94', '2016-09-26 10:37:18', '103.201.140.94'),
(25, 38, 'bhavik.popli.14cs@bml.edu.in', 38, '2016-09-26 14:37:43', '2016-09-26 10:37:43', '103.201.140.94', '2016-09-26 10:37:43', '103.201.140.94'),
(26, 38, 'nishitha.jaya.14cse@bml.edu.in', 38, '2016-09-26 14:38:05', '2016-09-26 10:38:05', '103.201.140.94', '2016-09-26 10:38:05', '103.201.140.94'),
(27, 38, 'nikita.baronia.14cse@bml.edu.in', 38, '2016-09-26 14:38:26', '2016-09-26 10:38:26', '103.201.140.94', '2016-09-26 10:38:26', '103.201.140.94'),
(28, 38, 'sanket.srivastava.14me@bml.edu.in', 38, '2016-09-26 14:38:46', '2016-09-26 10:38:46', '103.201.140.94', '2016-09-26 10:38:46', '103.201.140.94'),
(29, 39, 'anuj.baid.14cs@bml.edu.in', 38, '2016-09-26 18:24:54', '2016-09-26 14:24:54', '103.201.140.94', '2016-09-26 14:24:54', '103.201.140.94'),
(30, 39, 'mayank.gupta.14cs@bml.edu.in', 38, '2016-09-26 18:28:36', '2016-09-26 14:28:36', '103.201.140.94', '2016-09-26 14:28:36', '103.201.140.94'),
(31, 39, 'rohan.pandey.14ece@bml.edu.in', 38, '2016-09-26 18:29:11', '2016-09-26 14:29:11', '103.201.140.94', '2016-09-26 14:29:11', '103.201.140.94'),
(32, 39, 'rohan.sharma.14cse@bml.edu.in', 38, '2016-09-26 18:29:42', '2016-09-26 14:29:42', '103.201.140.94', '2016-09-26 14:29:42', '103.201.140.94'),
(33, 39, 'shashank.yadav.14ece@bml.edu.in', 38, '2016-09-26 18:30:59', '2016-09-26 14:30:59', '103.201.140.94', '2016-09-26 14:30:59', '103.201.140.94'),
(34, 39, 'siddhant.chabbara.14cs@bml.edu.in', 38, '2016-09-26 18:31:32', '2016-09-26 14:31:32', '103.201.140.94', '2016-09-26 14:31:32', '103.201.140.94'),
(35, 39, 'arsh.trikha.14cse@bml.edu.in', 38, '2016-09-26 18:32:05', '2016-09-26 14:32:05', '103.201.140.94', '2016-09-26 14:32:05', '103.201.140.94'),
(36, 39, 'sanjan.rajput.14cse@bml.edu.in', 38, '2016-09-26 18:32:32', '2016-09-26 14:32:32', '103.201.140.94', '2016-09-26 14:32:32', '103.201.140.94'),
(37, 39, 'ranveer.singh.14cse@bml.edu.in', 38, '2016-09-26 18:33:02', '2016-09-26 14:33:02', '103.201.140.94', '2016-09-26 14:33:02', '103.201.140.94'),
(38, 39, 'rishi.jain.14cse@bml.edu.in', 38, '2016-09-26 18:33:37', '2016-09-26 14:33:37', '103.201.140.94', '2016-09-26 14:33:37', '103.201.140.94');

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_modules`
--

CREATE TABLE IF NOT EXISTS `cru_project_modules` (
  `prm_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `prm_title` varchar(255) NOT NULL,
  `prm_description` text NOT NULL,
  `prm_url` varchar(255) NOT NULL,
  `prm_status` enum('enable','disable','delete') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL,
  PRIMARY KEY (`prm_id`),
  KEY `prj_id` (`prj_id`),
  KEY `parent_id` (`parent_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `cru_project_modules`
--

INSERT INTO `cru_project_modules` (`prm_id`, `user_id`, `prj_id`, `parent_id`, `prm_title`, `prm_description`, `prm_url`, `prm_status`, `timestamp`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(8, 15, 1, 0, 'Module 1', 'Module Description 1', 'module-1', 'delete', '2016-09-17 11:03:43', '2016-08-09 00:00:00', '', '2016-08-09 00:00:00', ''),
(9, 28, 6, 0, 'Project Module 12', 'jsbvfjkdfsbvgjkebgjk 12', 'project-module-12', 'enable', '2016-09-17 11:04:09', '2016-09-03 00:00:00', '', '2016-09-06 01:03:10', '::1'),
(10, 28, 7, 0, 'Project Module 234', 'sgfdfgbdegergergegege234', 'project-module-234', 'enable', '2016-09-17 11:04:30', '2016-09-03 00:00:00', '', '2016-09-05 08:05:20', '::1'),
(11, 20, 8, 0, 'Project Module 3', 'sdjifihiudshhguihguiefhgu', 'project-module-3', 'enable', '2016-09-17 11:04:48', '2016-09-03 00:00:00', '', '2016-09-03 00:00:00', ''),
(15, 28, 31, 0, 'Engineering Connection', 'Lorem ipsum dolor sit amet, in mandamus abhorreant his, ea sea veniam vivendum cotidieque. An vis dolores fabellas. Ad per aperiam nonumes habemus. Te modo malis expetendis vis, facete animal inermis ne ius. In iuvaret discere ius, ne ius facilis eligendi intellegebat, et vix placerat definitionem. Esse mundi alienum ex nec, cum simul feugait invenire eu. Vix ne hinc facer.', 'engineering-connection', 'enable', '2016-09-17 11:05:19', '2016-09-12 07:14:11', '::1', '2016-09-15 07:41:41', '::1'),
(27, 28, 31, 0, 'Module 1', 'nskdnskd', 'module-1-1', 'enable', '2016-09-17 11:06:12', '2016-09-15 02:04:14', '::1', '2016-09-15 02:04:14', '::1'),
(28, 28, 6, 0, 'Project Module 45', 'asdas', 'project-module-45', 'enable', '2016-09-21 06:44:27', '2016-09-21 02:44:27', '117.239.226.201', '2016-09-21 02:44:27', '117.239.226.201'),
(29, 40, 40, 0, 'node', 'module1', 'node', 'enable', '2016-09-27 13:30:42', '2016-09-27 09:30:42', '117.239.226.201', '2016-09-27 09:30:42', '117.239.226.201'),
(30, 53, 39, 0, 'Test1', 'bhabh hbxjhbxjhb hjbxjhaxb jhas j', 'test1', 'enable', '2016-09-28 09:16:32', '2016-09-28 05:16:32', '117.239.226.201', '2016-09-28 05:16:32', '117.239.226.201'),
(31, 40, 38, 0, 'module 1', 'descrnfkj', 'module-2', 'enable', '2016-09-29 08:37:11', '2016-09-29 04:37:11', '115.249.4.65', '2016-09-29 04:37:11', '115.249.4.65');

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_requirements`
--

CREATE TABLE IF NOT EXISTS `cru_project_requirements` (
  `prr_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `prr_title` varchar(255) NOT NULL,
  `prr_description` text NOT NULL,
  `prr_type` enum('generic','module') NOT NULL,
  `prr_priority` enum('high','medium','low') NOT NULL,
  `prm_id` int(11) NOT NULL DEFAULT '0',
  `prr_status` enum('enable','disable','delete') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL,
  PRIMARY KEY (`prr_id`),
  KEY `prj_id` (`prj_id`),
  KEY `user_id` (`user_id`),
  KEY `prr_priority` (`prr_priority`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `cru_project_requirements`
--

INSERT INTO `cru_project_requirements` (`prr_id`, `user_id`, `prj_id`, `prr_title`, `prr_description`, `prr_type`, `prr_priority`, `prm_id`, `prr_status`, `timestamp`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(1, 15, 1, 'Project Requirement 1', 'Project Requirement Description 1', 'generic', 'low', 0, 'delete', '2016-08-31 13:11:23', '2016-08-09 00:00:00', '', '2016-08-16 04:49:42', '::1'),
(2, 15, 1, 'Module Requirement 1', 'Module Requirement description 1', 'module', 'high', 8, 'delete', '2016-08-31 13:11:23', '2016-08-09 00:00:00', '', '2016-08-16 04:48:52', '::1'),
(3, 28, 1, 'gbvdfbd', 'gbvdfbd', 'generic', 'high', 0, 'enable', '2016-09-12 09:19:07', '2016-09-12 05:19:07', '::1', '2016-09-12 05:19:07', '::1'),
(4, 28, 1, 'vcc', 'vcc', 'generic', 'medium', 0, 'enable', '2016-09-12 09:19:51', '2016-09-12 05:19:51', '::1', '2016-09-12 05:19:51', '::1'),
(5, 28, 1, 'fdgdfg', 'fdgdfg', 'generic', 'high', 0, 'enable', '2016-09-12 09:27:30', '2016-09-12 05:27:30', '::1', '2016-09-12 05:27:30', '::1'),
(6, 28, 1, 'bnvb', 'bnvb', 'generic', 'medium', 0, 'enable', '2016-09-12 09:28:12', '2016-09-12 05:28:12', '::1', '2016-09-12 05:28:12', '::1'),
(7, 28, 31, 'Engineering Connection', 'Lorem ipsum dolor sit amet, in mandamus abhorreant his, ea sea veniam vivendum cotidieque. An vis dolores fabellas. Ad per aperiam nonumes habemus. Te modo malis expetendis vis, facete animal inermis ne ius. In iuvaret discere ius, ne ius facilis eligendi intellegebat, et vix placerat definitionem. Esse mundi alienum ex nec, cum simul feugait invenire eu. Vix ne hinc facer.', 'generic', 'medium', 0, 'enable', '2016-09-15 10:51:23', '2016-09-12 05:31:17', '::1', '2016-09-15 06:51:23', '::1'),
(8, 28, 31, '1234', '123456', 'generic', 'high', 0, 'enable', '2016-09-15 10:51:41', '2016-09-12 05:32:17', '::1', '2016-09-15 06:51:41', '::1'),
(9, 28, 31, 'xcvxcxc', 'xcvxcxc', 'generic', 'low', 0, 'enable', '2016-09-12 09:33:45', '2016-09-12 05:33:45', '::1', '2016-09-12 05:33:45', '::1'),
(10, 28, 31, 'fdgdfg', 'fdgdfg', 'generic', 'low', 0, 'enable', '2016-09-12 10:26:23', '2016-09-12 06:26:23', '::1', '2016-09-12 06:26:23', '::1'),
(11, 28, 31, 'dfgf', 'dfgf', 'generic', 'medium', 0, 'enable', '2016-09-12 11:14:44', '2016-09-12 07:14:44', '::1', '2016-09-12 07:14:44', '::1'),
(12, 28, 31, 'xcvxc', 'xcvxc', 'generic', 'low', 0, 'enable', '2016-09-12 11:18:52', '2016-09-12 07:18:52', '::1', '2016-09-12 07:18:52', '::1'),
(13, 28, 31, 'fghjfhj', 'fghjfhj', 'generic', 'low', 0, 'enable', '2016-09-12 12:44:13', '2016-09-12 08:44:13', '::1', '2016-09-12 08:44:13', '::1'),
(14, 28, 31, 'ghjghj', 'ghjghj', 'generic', 'high', 0, 'enable', '2016-09-12 12:44:21', '2016-09-12 08:44:21', '::1', '2016-09-12 08:44:21', '::1'),
(15, 28, 31, 'gfhf', 'gfhfgh', 'module', 'high', 16, 'enable', '2016-09-12 12:49:48', '2016-09-12 08:49:48', '::1', '2016-09-12 08:49:48', '::1'),
(16, 28, 31, 'bjvbj', 'hjgh', 'module', 'medium', 16, 'enable', '2016-09-12 13:08:51', '2016-09-12 09:08:51', '::1', '2016-09-12 09:08:51', '::1'),
(17, 28, 31, 'ghjghj', 'ghjghj', 'module', 'low', 16, 'enable', '2016-09-12 13:09:06', '2016-09-12 09:09:06', '::1', '2016-09-12 09:09:06', '::1'),
(18, 28, 31, 'hgjgh', 'ghjghj', 'module', 'medium', 16, 'enable', '2016-09-12 13:09:27', '2016-09-12 09:09:27', '::1', '2016-09-12 09:09:27', '::1'),
(20, 28, 31, 'gdfgg', 'gdfgg', 'generic', 'low', 0, 'enable', '2016-09-13 05:22:40', '2016-09-13 01:22:40', '::1', '2016-09-13 01:22:40', '::1'),
(21, 28, 31, 'gfhfgh', 'gfhfgh', 'module', 'medium', 15, 'enable', '2016-09-15 11:01:06', '2016-09-13 01:31:54', '::1', '2016-09-15 07:01:06', '::1'),
(24, 28, 31, '123456', '123456', 'module', 'low', 15, 'enable', '2016-09-15 10:56:17', '2016-09-13 01:39:44', '::1', '2016-09-15 06:56:17', '::1'),
(25, 28, 31, '123', '123', 'module', 'low', 15, 'enable', '2016-09-15 10:29:29', '2016-09-13 01:39:52', '::1', '2016-09-15 06:29:29', '::1'),
(26, 28, 31, 'dxfgdfgd', 'dfgdfgdf', 'module', 'high', 15, 'enable', '2016-09-15 11:01:34', '2016-09-13 01:40:06', '::1', '2016-09-15 07:01:34', '::1'),
(35, 28, 31, 'dgdfgdfgdf', 'dfgdfgdfdf', 'module', 'low', 24, 'enable', '2016-09-13 06:17:52', '2016-09-13 02:17:52', '::1', '2016-09-13 02:17:52', '::1'),
(36, 28, 31, 'dgdfgdfgdf', 'dfgdfgdfdf', 'module', 'low', 24, 'enable', '2016-09-13 06:18:15', '2016-09-13 02:18:15', '::1', '2016-09-13 02:18:15', '::1'),
(37, 28, 31, 'bfb', 'gfbfg', 'module', 'high', 24, 'enable', '2016-09-13 06:18:31', '2016-09-13 02:18:31', '::1', '2016-09-13 02:18:31', '::1'),
(39, 28, 31, 'xvxcv111122222', 'xcvvx111111222222', 'module', 'high', 15, 'enable', '2016-09-15 10:56:47', '2016-09-14 01:46:18', '::1', '2016-09-15 06:56:47', '::1'),
(40, 28, 31, 'fjhj', 'ghjghj', 'module', 'high', 16, 'enable', '2016-09-14 06:14:46', '2016-09-14 02:14:46', '::1', '2016-09-14 02:14:46', '::1'),
(41, 28, 31, '123', '123', 'module', 'medium', 21, 'enable', '2016-09-15 05:13:51', '2016-09-15 01:13:51', '::1', '2016-09-15 01:13:51', '::1'),
(42, 28, 31, '456', '456', 'module', 'low', 21, 'enable', '2016-09-15 05:16:02', '2016-09-15 01:16:02', '::1', '2016-09-15 01:16:02', '::1'),
(43, 28, 31, '789', '789', 'module', 'medium', 21, 'enable', '2016-09-15 05:16:46', '2016-09-15 01:16:46', '::1', '2016-09-15 01:16:46', '::1'),
(44, 28, 31, 'cvbcvb', 'cvbcvb', 'module', 'medium', 21, 'enable', '2016-09-15 05:17:18', '2016-09-15 01:17:18', '::1', '2016-09-15 01:17:18', '::1'),
(45, 28, 31, '1231111', '12311111', 'module', 'medium', 25, 'enable', '2016-09-15 11:02:45', '2016-09-15 01:51:00', '::1', '2016-09-15 07:02:45', '::1'),
(46, 28, 31, '4454545111111', '4545451111111', 'module', 'high', 26, 'enable', '2016-09-15 11:02:27', '2016-09-15 02:02:30', '::1', '2016-09-15 07:02:27', '::1'),
(47, 28, 31, 'module requirement 1', 'xsdgfdfg1111111', 'module', 'low', 27, 'enable', '2016-09-15 11:02:58', '2016-09-15 02:04:32', '::1', '2016-09-15 07:02:58', '::1'),
(48, 28, 6, 'Forgot Password Feature', 'Forgot Password Feature1', 'generic', 'high', 0, 'enable', '2016-09-28 08:53:11', '2016-09-21 02:42:44', '117.239.226.201', '2016-09-28 04:53:11', '103.226.184.254'),
(49, 28, 6, 'Dashboard', 'Different levels of users should have different dashboard to be displayed.', 'module', 'high', 9, 'enable', '2016-09-21 06:44:01', '2016-09-21 02:44:01', '117.239.226.201', '2016-09-21 02:44:01', '117.239.226.201'),
(50, 38, 6, 'User-id specification', 'User-id specification', 'generic', 'medium', 0, 'enable', '2016-09-26 13:59:27', '2016-09-26 09:59:27', '103.201.140.94', '2016-09-26 09:59:27', '103.201.140.94'),
(51, 38, 6, 'User-id specification', 'Alphanumeric characters should be allowed for user-id but no special charactesr ', 'generic', 'medium', 0, 'enable', '2016-09-26 14:01:31', '2016-09-26 09:59:28', '103.201.140.94', '2016-09-26 10:01:31', '103.201.140.94'),
(53, 53, 39, 'Login ', 'Login ', 'generic', 'high', 0, 'enable', '2016-09-28 09:14:53', '2016-09-28 05:14:53', '117.239.226.201', '2016-09-28 05:14:53', '117.239.226.201'),
(54, 49, 39, 'Registeration', 'Registeration', 'generic', 'high', 0, 'enable', '2016-09-28 11:33:20', '2016-09-28 07:33:20', '117.239.226.201', '2016-09-28 07:33:20', '117.239.226.201'),
(55, 49, 39, 'Input', 'Input', 'generic', 'medium', 0, 'enable', '2016-09-28 11:34:55', '2016-09-28 07:34:55', '117.239.226.201', '2016-09-28 07:34:55', '117.239.226.201'),
(56, 49, 39, 'Forgot Password Module', 'Forgot Password Module', 'generic', 'medium', 0, 'enable', '2016-09-29 12:53:45', '2016-09-29 08:53:45', '117.239.226.201', '2016-09-29 08:53:45', '117.239.226.201'),
(57, 49, 39, 'Dashboard Module', 'Dashboard Module', 'generic', 'high', 0, 'enable', '2016-09-29 12:55:05', '2016-09-29 08:55:05', '115.249.4.65', '2016-09-29 08:55:05', '115.249.4.65'),
(58, 49, 39, 'Grade Generating Module', 'Grade Generating Module', 'generic', 'high', 0, 'enable', '2016-10-01 06:08:06', '2016-10-01 02:08:06', '117.239.226.201', '2016-10-01 02:08:06', '117.239.226.201'),
(59, 49, 39, 'Predictor Module', 'Predictor Module', 'generic', 'medium', 0, 'enable', '2016-10-01 06:08:34', '2016-10-01 02:08:34', '122.15.208.194', '2016-10-01 02:08:34', '122.15.208.194'),
(60, 49, 39, 'Admin Authority Module', 'Admin Authority Module', 'generic', 'high', 0, 'enable', '2016-10-01 06:11:51', '2016-10-01 02:11:51', '115.249.4.65', '2016-10-01 02:11:51', '115.249.4.65'),
(61, 49, 39, 'User Interfaces', 'User Interfaces', 'generic', 'medium', 0, 'enable', '2016-10-01 06:16:22', '2016-10-01 02:16:22', '115.249.4.65', '2016-10-01 02:16:22', '115.249.4.65'),
(62, 49, 39, 'Hardware Interfaces', 'Hardware Interfaces', 'generic', 'low', 0, 'enable', '2016-10-01 06:16:55', '2016-10-01 02:16:55', '122.15.208.194', '2016-10-01 02:16:55', '122.15.208.194'),
(63, 49, 39, 'Software Interfaces', 'Software Interfaces', 'generic', 'medium', 0, 'enable', '2016-10-01 06:17:30', '2016-10-01 02:17:30', '122.15.208.194', '2016-10-01 02:17:30', '122.15.208.194'),
(64, 49, 39, 'Communication Interfaces', 'Communication Interfaces', 'generic', 'medium', 0, 'enable', '2016-10-01 06:17:56', '2016-10-01 02:17:56', '122.15.208.194', '2016-10-01 02:17:56', '122.15.208.194'),
(65, 49, 39, 'Performance', 'Performance', 'generic', 'high', 0, 'enable', '2016-10-01 06:19:30', '2016-10-01 02:19:30', '115.249.4.65', '2016-10-01 02:19:30', '115.249.4.65'),
(66, 49, 39, 'Availability', 'Availability', 'generic', 'medium', 0, 'enable', '2016-10-01 06:21:26', '2016-10-01 02:21:26', '115.249.4.65', '2016-10-01 02:21:26', '115.249.4.65'),
(67, 49, 39, 'Security', 'Security', 'generic', 'high', 0, 'enable', '2016-10-01 06:21:53', '2016-10-01 02:21:53', '115.249.4.65', '2016-10-01 02:21:53', '115.249.4.65'),
(68, 49, 39, 'Maintainability', 'Maintainability', 'generic', 'medium', 0, 'enable', '2016-10-01 06:22:30', '2016-10-01 02:22:30', '117.239.226.201', '2016-10-01 02:22:30', '117.239.226.201'),
(69, 49, 39, 'Usability', 'Usability', 'generic', 'medium', 0, 'enable', '2016-10-01 06:23:10', '2016-10-01 02:23:10', '122.15.208.194', '2016-10-01 02:23:10', '122.15.208.194'),
(70, 49, 39, 'Portability / Compatibility', 'Portability / Compatibility', 'generic', 'medium', 0, 'enable', '2016-10-01 06:23:28', '2016-10-01 02:23:28', '117.239.226.201', '2016-10-01 02:23:28', '117.239.226.201');

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_requirement_comments`
--

CREATE TABLE IF NOT EXISTS `cru_project_requirement_comments` (
  `prrc_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `prr_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `prrc_comment` text NOT NULL,
  `prrc_status` enum('enable','disable','delete') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL,
  PRIMARY KEY (`prrc_id`),
  KEY `prj_id` (`prj_id`),
  KEY `prr_id` (`prr_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `cru_project_requirement_comments`
--

INSERT INTO `cru_project_requirement_comments` (`prrc_id`, `user_id`, `prj_id`, `prr_id`, `parent_id`, `prrc_comment`, `prrc_status`, `timestamp`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(39, 28, 31, 7, 0, '       ', 'enable', '2016-09-15 05:48:18', '2016-09-15 01:48:18', '::1', '2016-09-15 01:48:18', '::1'),
(40, 28, 31, 7, 0, '123', 'enable', '2016-09-15 05:48:23', '2016-09-15 01:48:23', '::1', '2016-09-15 01:48:23', '::1'),
(41, 28, 31, 45, 0, '123444', 'enable', '2016-09-15 06:02:04', '2016-09-15 02:02:04', '::1', '2016-09-15 02:02:04', '::1'),
(42, 28, 31, 46, 0, 'dfdfdfdfdfdfdd', 'enable', '2016-09-15 06:02:47', '2016-09-15 02:02:47', '::1', '2016-09-15 02:02:47', '::1'),
(43, 28, 31, 46, 0, '    ', 'enable', '2016-09-15 06:03:18', '2016-09-15 02:03:18', '::1', '2016-09-15 02:03:18', '::1'),
(44, 28, 31, 47, 0, 'ewweweweww', 'enable', '2016-09-15 06:04:41', '2016-09-15 02:04:41', '::1', '2016-09-15 02:04:41', '::1'),
(45, 28, 31, 45, 0, 'hghgh', 'enable', '2016-09-15 06:24:54', '2016-09-15 02:24:54', '::1', '2016-09-15 02:24:54', '::1'),
(46, 28, 31, 45, 0, 'ghgh', 'enable', '2016-09-15 06:25:00', '2016-09-15 02:25:00', '::1', '2016-09-15 02:25:00', '::1'),
(47, 28, 31, 45, 0, '11111111111', 'enable', '2016-09-15 06:25:07', '2016-09-15 02:25:07', '::1', '2016-09-15 02:25:07', '::1'),
(48, 28, 31, 21, 0, '   ', 'enable', '2016-09-15 07:01:30', '2016-09-15 03:01:30', '::1', '2016-09-15 03:01:30', '::1'),
(49, 28, 31, 24, 0, '123', 'enable', '2016-09-15 11:44:25', '2016-09-15 07:44:25', '::1', '2016-09-15 07:44:25', '::1'),
(54, 28, 31, 7, 0, 'jgfoi', 'enable', '2016-09-16 05:28:38', '2016-09-16 01:28:38', '::1', '2016-09-16 01:28:38', '::1'),
(55, 28, 31, 7, 39, '123', 'enable', '2016-09-16 05:52:02', '2016-09-16 01:52:02', '::1', '2016-09-16 01:52:02', '::1'),
(56, 28, 31, 7, 54, '456', 'enable', '2016-09-16 05:52:32', '2016-09-16 01:52:32', '::1', '2016-09-16 01:52:32', '::1'),
(57, 28, 31, 45, 47, '22222', 'enable', '2016-09-16 11:38:28', '2016-09-16 07:38:28', '::1', '2016-09-16 07:38:28', '::1'),
(58, 28, 31, 7, 0, '12222', 'enable', '2016-09-16 13:50:09', '2016-09-16 09:50:09', '49.213.50.247', '2016-09-16 09:50:09', '49.213.50.247'),
(59, 28, 31, 7, 0, '22222', 'enable', '2016-09-16 13:52:12', '2016-09-16 09:52:12', '49.213.50.247', '2016-09-16 09:52:12', '49.213.50.247'),
(60, 28, 31, 7, 59, '3333', 'enable', '2016-09-16 13:52:26', '2016-09-16 09:52:26', '49.213.50.247', '2016-09-16 09:52:26', '49.213.50.247'),
(61, 38, 6, 48, 0, 'Is it necessary to have security question? Resetting password through mail can be another alternative', 'enable', '2016-09-21 06:51:08', '2016-09-21 02:51:08', '122.15.208.194', '2016-09-21 02:51:08', '122.15.208.194'),
(62, 28, 6, 48, 0, 'Yes, that is also possible! But resetting through mail would involve going back to mail whereas security question would allow continue with the application.', 'enable', '2016-09-21 07:02:19', '2016-09-21 03:02:19', '117.239.226.201', '2016-09-21 03:02:19', '117.239.226.201'),
(64, 53, 39, 53, 0, 'qq', 'enable', '2016-09-28 09:15:52', '2016-09-28 05:15:52', '122.15.208.194', '2016-09-28 05:15:52', '122.15.208.194'),
(65, 49, 39, 53, 0, 'hey I would prefer to give it as medium priority. A this is not that important for a user. And the most straight forward module to creat', 'enable', '2016-09-29 12:52:47', '2016-09-29 08:52:47', '117.239.226.201', '2016-09-29 08:52:47', '117.239.226.201');

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_requirement_likes_dislikes`
--

CREATE TABLE IF NOT EXISTS `cru_project_requirement_likes_dislikes` (
  `prrld_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `prr_id` int(11) NOT NULL,
  `prrld_type` enum('like','dislike') NOT NULL,
  `prrld_status` enum('enable','disable','delete') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL,
  PRIMARY KEY (`prrld_id`),
  KEY `prj_id` (`prj_id`),
  KEY `user_id` (`user_id`),
  KEY `prr_id` (`prr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `cru_project_requirement_likes_dislikes`
--

INSERT INTO `cru_project_requirement_likes_dislikes` (`prrld_id`, `user_id`, `prj_id`, `prr_id`, `prrld_type`, `prrld_status`, `timestamp`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(114, 38, 6, 48, 'like', 'enable', '2016-09-21 06:50:12', '2016-09-21 02:50:12', '117.239.226.201', '2016-09-21 02:50:12', '117.239.226.201'),
(116, 53, 39, 53, 'like', 'enable', '2016-09-28 09:16:09', '2016-09-28 05:16:09', '117.239.226.201', '2016-09-28 05:16:09', '117.239.226.201'),
(117, 49, 39, 53, 'like', 'enable', '2016-09-29 12:51:41', '2016-09-29 08:51:41', '117.239.226.201', '2016-09-29 08:51:41', '117.239.226.201'),
(118, 57, 39, 53, 'like', 'enable', '2016-09-30 19:40:57', '2016-09-30 15:40:57', '115.249.4.65', '2016-09-30 15:40:57', '115.249.4.65');

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_users`
--

CREATE TABLE IF NOT EXISTS `cru_project_users` (
  `cpu_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_status` enum('owner','contributor','other','') NOT NULL,
  `is_archive` enum('no','yes') NOT NULL,
  PRIMARY KEY (`cpu_id`),
  KEY `is_archive` (`is_archive`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `cru_project_users`
--

INSERT INTO `cru_project_users` (`cpu_id`, `project_id`, `user_id`, `user_status`, `is_archive`) VALUES
(2, 5, 15, 'owner', 'no'),
(7, 1, 17, 'owner', 'no'),
(8, 6, 28, 'owner', 'no'),
(9, 7, 28, 'contributor', 'no'),
(10, 8, 28, 'other', 'no'),
(11, 9, 28, 'owner', 'no'),
(12, 10, 28, 'owner', 'no'),
(13, 11, 28, 'owner', 'no'),
(14, 12, 28, 'owner', 'no'),
(15, 13, 28, 'owner', 'no'),
(16, 14, 28, 'owner', 'no'),
(17, 15, 28, 'owner', 'no'),
(18, 16, 28, 'owner', 'no'),
(19, 17, 28, 'owner', 'no'),
(20, 18, 28, 'owner', 'no'),
(21, 19, 28, 'owner', 'no'),
(22, 20, 28, 'owner', 'no'),
(23, 21, 28, 'owner', 'no'),
(24, 22, 28, 'owner', 'no'),
(25, 23, 28, 'owner', 'no'),
(26, 24, 28, 'owner', 'no'),
(27, 25, 28, 'owner', 'no'),
(28, 26, 28, 'owner', 'no'),
(29, 27, 28, 'owner', 'no'),
(30, 28, 28, 'owner', 'no'),
(31, 30, 20, 'owner', 'no'),
(33, 6, 31, 'other', 'no'),
(34, 31, 28, 'owner', 'no'),
(35, 32, 28, 'owner', 'no'),
(36, 33, 28, 'owner', 'no'),
(37, 34, 28, 'owner', 'no'),
(39, 36, 32, 'owner', 'no'),
(40, 35, 32, 'owner', 'no'),
(41, 6, 34, 'other', 'no'),
(42, 6, 35, 'other', 'no'),
(43, 6, 36, 'other', 'no'),
(44, 37, 28, 'owner', 'no'),
(45, 37, 33, 'other', 'no'),
(46, 9, 37, 'other', 'no'),
(47, 0, 35, 'other', 'no'),
(48, 0, 35, 'other', 'no'),
(50, 0, 28, 'other', 'no'),
(54, 31, 33, 'other', 'no'),
(55, 6, 38, 'contributor', 'no'),
(56, 38, 38, 'owner', 'no'),
(57, 38, 39, 'other', 'no'),
(58, 38, 40, 'contributor', 'no'),
(59, 38, 41, 'other', 'no'),
(60, 38, 42, 'other', 'no'),
(61, 38, 43, 'contributor', 'yes'),
(62, 38, 44, 'other', 'no'),
(63, 38, 45, 'contributor', 'no'),
(64, 38, 46, 'other', 'no'),
(66, 39, 38, 'owner', 'no'),
(67, 39, 48, 'other', 'no'),
(68, 39, 49, 'contributor', 'no'),
(69, 39, 50, 'other', 'no'),
(70, 39, 51, 'other', 'no'),
(71, 39, 52, 'other', 'no'),
(72, 39, 53, 'contributor', 'no'),
(73, 39, 54, 'other', 'no'),
(74, 39, 55, 'other', 'no'),
(75, 39, 56, 'other', 'no'),
(76, 39, 57, 'contributor', 'no'),
(77, 40, 40, 'owner', 'yes'),
(78, 41, 40, 'owner', 'no'),
(79, 42, 40, 'owner', 'no'),
(80, 43, 47, 'owner', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `cru_sem`
--

CREATE TABLE IF NOT EXISTS `cru_sem` (
  `semid` int(11) NOT NULL AUTO_INCREMENT,
  `semfieldname` varchar(50) NOT NULL,
  `semfieldvalue` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`semid`),
  KEY `semid` (`semid`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cru_sem`
--

INSERT INTO `cru_sem` (`semid`, `semfieldname`, `semfieldvalue`, `status`, `timestamp`) VALUES
(1, 'fb', 'google.com1', 'Enable', '2016-08-10 08:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `cru_seo`
--

CREATE TABLE IF NOT EXISTS `cru_seo` (
  `seo_id` int(11) NOT NULL AUTO_INCREMENT,
  `seo_name` varchar(255) NOT NULL,
  `seo_value` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`seo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cru_seo`
--

INSERT INTO `cru_seo` (`seo_id`, `seo_name`, `seo_value`, `timestamp`) VALUES
(1, 'Default Meta Title', 'CRUISE', '2016-08-10 05:17:04'),
(2, 'Default Meta Keywords', 'CRUISE', '2016-08-10 05:17:10'),
(3, 'Default Meta Descriptions', 'CRUISE', '2016-08-10 05:17:17'),
(4, 'Google Webmaster Code', 'CRUISE', '2016-08-10 05:17:24'),
(5, 'Google Analytics Code', 'CRUISE', '2016-08-10 05:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `cru_settings`
--

CREATE TABLE IF NOT EXISTS `cru_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cru_settings`
--

INSERT INTO `cru_settings` (`setting_id`, `setting_name`, `setting_value`, `timestamp`) VALUES
(1, 'site name', 'CRUISE', '2016-08-10 08:52:39'),
(2, 'Site URL', 'http://localhost/cruize/', '2016-08-08 10:14:28'),
(3, 'Site Owner', 'cruize Owner Name', '2016-08-08 10:14:38'),
(4, 'Address', 'Cruize Address', '2016-08-08 10:14:48'),
(5, 'E-Mail', 'info@cruize.com', '2016-08-08 10:14:58'),
(6, 'Contact', '+91-1234567890', '2016-08-08 10:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `cru_users`
--

CREATE TABLE IF NOT EXISTS `cru_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first_name` varchar(50) NOT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_profile_image` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_key` varchar(100) NOT NULL,
  `user_status` enum('enable','disable','delete','not-verify','not-registered') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `cru_users`
--

INSERT INTO `cru_users` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_profile_image`, `user_password`, `user_key`, `user_status`, `timestamp`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(15, 'Aniket', 'Bhatt', 'aniket@winspirewebsolution.com', '', '5f343cf0b18607dde57b7feca6ff7eb7', '', 'delete', '2016-08-31 13:11:22', '2016-08-09 01:29:41', '::1', '2016-08-10 05:41:04', '::1'),
(17, 'Aniket2', 'Bhatt', 'aniketbhatt031@gmail.com', '', '161ec18dcef34f854b56c985d6b29b29', '', 'delete', '2016-09-03 09:51:26', '2016-08-16 02:35:36', '::1', '2016-08-16 02:35:36', '::1'),
(18, 'gdfg', '', 'aniket@winspirewebsolution.com', '', 'a6f3f6fd7871341c202719e857e6d494', '', 'delete', '2016-08-26 11:54:42', '2016-08-26 07:35:45', '::1', '2016-08-26 07:35:45', '::1'),
(19, 'Bob', '', 'bob@gmail.com', '', '8468b5e7cb9ff8064461a96f5ad50d77', '', 'enable', '2016-08-26 11:55:15', '2016-08-26 07:55:15', '::1', '2016-08-26 07:55:15', '::1'),
(20, 'Aniket', 'Bhatt', 'aniketbhatt031@gmail.com', '', '202cb962ac59075b964b07152d234b70', '', 'delete', '2016-09-09 09:08:06', '2016-08-31 09:11:42', '::1', '2016-08-31 09:11:42', '::1'),
(28, 'Aniket', 'Bhatt', 'aniket@winspirewebsolution.com', 'Camila_Freitas_128x128.png', '202cb962ac59075b964b07152d234b70', '', 'enable', '2016-09-23 09:02:36', '2016-09-02 08:04:33', '::1', '2016-09-23 05:02:36', '49.213.48.11'),
(29, '', '', 'dhara@winspirewebsolution.com', '', '', '', 'not-registered', '2016-09-07 06:44:49', '2016-09-07 02:44:49', '::1', '2016-09-07 02:44:49', '::1'),
(33, 'Aniket', 'Bhatt', 'aniketbhatt031@gmail.com', '', '202cb962ac59075b964b07152d234b70', '', 'enable', '2016-09-13 04:41:57', '2016-09-09 06:41:20', '::1', '2016-09-09 06:41:20', '::1'),
(34, '', '', 'aniketbhatt03111@gmail.com', '', '', '', 'not-registered', '2016-09-09 11:56:32', '2016-09-09 07:56:32', '::1', '2016-09-09 07:56:32', '::1'),
(35, '', '', 'aniket@gmail.com', '', '', '', 'not-registered', '2016-09-09 11:57:44', '2016-09-09 07:57:44', '::1', '2016-09-09 07:57:44', '::1'),
(36, '', '', 'aniket12@gmail.com', '', '', '', 'not-registered', '2016-09-09 12:13:39', '2016-09-09 08:13:39', '::1', '2016-09-09 08:13:39', '::1'),
(37, '', '', 'aniket1@gmail.com', '', '', '', 'not-registered', '2016-09-09 12:58:03', '2016-09-09 08:58:03', '::1', '2016-09-09 08:58:03', '::1'),
(38, 'R', 'S', 'sricha@gmail.com', '', 'dc2567c48abbf1ab10c5467e27d03c29', '', 'enable', '2016-09-25 18:31:28', '2016-09-21 02:45:08', '117.239.226.201', '2016-09-21 02:46:11', '122.15.208.194'),
(39, '', '', 'hitkul.bmu.14cs@bml.edu.in', '', '', '', 'not-registered', '2016-09-26 14:20:14', '2016-09-26 10:20:14', '103.201.140.94', '2016-09-26 10:20:14', '103.201.140.94'),
(40, 'Pratik', 'Sen', 'prateek.sen.14cse@bml.edu.in', '', 'aa13e6eb7c324344912f635d280d9796', '', 'enable', '2016-09-27 13:50:32', '2016-09-26 10:28:54', '103.201.140.94', '2016-09-27 09:25:19', '117.239.226.201'),
(41, 'Prateek', 'Goel', 'prateek.kumar.14cse@bml.edu.in', '', '6c84cbd30cf9350a990bad2bcc1bec5f', '', 'enable', '2016-09-28 14:03:16', '2016-09-26 10:29:32', '103.201.140.94', '2016-09-28 09:57:58', '122.15.208.194'),
(42, '', '', 'gardas.nuthan.14cs@bml.edu.in', '', '', '', 'not-registered', '2016-09-26 14:36:49', '2016-09-26 10:36:49', '103.201.140.94', '2016-09-26 10:36:49', '103.201.140.94'),
(43, 'Vaibhav', 'Singh', 'vaibhav.singh.14cse@bml.edu.in', '', 'b84bacf0634c63bf81ebfd2b3eb2b3ee', '', 'enable', '2016-09-26 14:40:17', '2016-09-26 10:37:18', '103.201.140.94', '2016-09-26 10:40:08', '117.239.226.201'),
(44, '', '', 'bhavik.popli.14cs@bml.edu.in', '', '', '', 'not-registered', '2016-09-26 14:37:43', '2016-09-26 10:37:43', '103.201.140.94', '2016-09-26 10:37:43', '103.201.140.94'),
(45, 'Nishitha', 'Boddeti', 'nishitha.jaya.14cse@bml.edu.in', '', '60ca575d5b2173374305e209d2510f1b', '', 'enable', '2016-10-01 13:10:38', '2016-09-26 10:38:05', '103.201.140.94', '2016-10-01 09:10:26', '122.15.208.194'),
(46, '', '', 'nikita.baronia.14cse@bml.edu.in', '', '', '', 'not-registered', '2016-09-26 14:38:26', '2016-09-26 10:38:26', '103.201.140.94', '2016-09-26 10:38:26', '103.201.140.94'),
(47, 'Sanket', 'Srivastava', 'sanket.srivastava.14me@bml.edu.in', '', '5bbd316f9b1805d7d7bc54a81ca47e1c', '', 'enable', '2016-09-28 13:40:44', '2016-09-26 10:38:46', '103.201.140.94', '2016-09-28 09:40:30', '115.249.4.65'),
(48, '', '', 'anuj.baid.14cs@bml.edu.in', '', '', '', 'not-registered', '2016-09-26 18:24:54', '2016-09-26 14:24:54', '103.201.140.94', '2016-09-26 14:24:54', '103.201.140.94'),
(49, 'Mayank', 'Gupta', 'mayank.gupta.14cs@bml.edu.in', '', '7b1363a670251100b99cbd185a30a194', '', 'enable', '2016-09-26 18:54:21', '2016-09-26 14:28:36', '103.201.140.94', '2016-09-26 14:54:13', '115.249.4.65'),
(50, '', '', 'rohan.pandey.14ece@bml.edu.in', '', '', '', 'not-registered', '2016-09-26 18:29:11', '2016-09-26 14:29:11', '103.201.140.94', '2016-09-26 14:29:11', '103.201.140.94'),
(51, 'Rohan', 'Sharma', 'rohan.sharma.14cse@bml.edu.in', '', 'd8578edf8458ce06fbc5bb76a58c5ca4', '', 'enable', '2016-09-28 09:07:42', '2016-09-26 14:29:42', '103.201.140.94', '2016-09-28 05:07:14', '117.239.226.201'),
(52, '', '', 'shashank.yadav.14ece@bml.edu.in', '', '', '', 'not-registered', '2016-09-26 18:31:00', '2016-09-26 14:31:00', '103.201.140.94', '2016-09-26 14:31:00', '103.201.140.94'),
(53, 'Siddhant', 'Chhabra', 'siddhant.chabbara.14cs@bml.edu.in', '', '5a1f43fb200826ea40af0000e0382b2b', '', 'enable', '2016-09-28 09:11:30', '2016-09-26 14:31:32', '103.201.140.94', '2016-09-28 05:11:02', '115.249.4.65'),
(54, '', '', 'arsh.trikha.14cse@bml.edu.in', '', '', '', 'not-registered', '2016-09-26 18:32:05', '2016-09-26 14:32:05', '103.201.140.94', '2016-09-26 14:32:05', '103.201.140.94'),
(55, '', '', 'sanjan.rajput.14cse@bml.edu.in', '', '', '', 'not-registered', '2016-09-26 18:32:32', '2016-09-26 14:32:32', '103.201.140.94', '2016-09-26 14:32:32', '103.201.140.94'),
(56, '', '', 'ranveer.singh.14cse@bml.edu.in', '', '', '', 'not-registered', '2016-09-26 18:33:02', '2016-09-26 14:33:02', '103.201.140.94', '2016-09-26 14:33:02', '103.201.140.94'),
(57, 'Rishi', 'Jain', 'rishi.jain.14cse@bml.edu.in', '', 'a56471c5ef742b019c7b267180a5d379', '', 'enable', '2016-09-30 19:38:34', '2016-09-26 14:33:37', '103.201.140.94', '2016-09-30 15:38:22', '115.249.4.65');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cru_projects`
--
ALTER TABLE `cru_projects`
  ADD CONSTRAINT `cru_projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cru_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cru_project_invites`
--
ALTER TABLE `cru_project_invites`
  ADD CONSTRAINT `cru_project_invites_ibfk_1` FOREIGN KEY (`prj_id`) REFERENCES `cru_projects` (`prj_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cru_project_invites_ibfk_2` FOREIGN KEY (`pri_invited_by`) REFERENCES `cru_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cru_project_modules`
--
ALTER TABLE `cru_project_modules`
  ADD CONSTRAINT `cru_project_modules_ibfk_1` FOREIGN KEY (`prj_id`) REFERENCES `cru_projects` (`prj_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cru_project_modules_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `cru_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cru_project_requirements`
--
ALTER TABLE `cru_project_requirements`
  ADD CONSTRAINT `cru_project_requirements_ibfk_1` FOREIGN KEY (`prj_id`) REFERENCES `cru_projects` (`prj_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cru_project_requirements_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `cru_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cru_project_requirement_comments`
--
ALTER TABLE `cru_project_requirement_comments`
  ADD CONSTRAINT `cru_project_requirement_comments_ibfk_1` FOREIGN KEY (`prj_id`) REFERENCES `cru_projects` (`prj_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cru_project_requirement_comments_ibfk_2` FOREIGN KEY (`prr_id`) REFERENCES `cru_project_requirements` (`prr_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cru_project_requirement_comments_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `cru_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cru_project_requirement_likes_dislikes`
--
ALTER TABLE `cru_project_requirement_likes_dislikes`
  ADD CONSTRAINT `cru_project_requirement_likes_dislikes_ibfk_1` FOREIGN KEY (`prj_id`) REFERENCES `cru_projects` (`prj_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cru_project_requirement_likes_dislikes_ibfk_2` FOREIGN KEY (`prr_id`) REFERENCES `cru_project_requirements` (`prr_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cru_project_requirement_likes_dislikes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `cru_users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
