-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2016 at 12:01 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



--
-- Database: `cruise`
--

-- --------------------------------------------------------

--
-- Table structure for table `cru_admin`
--

CREATE TABLE IF NOT EXISTS `cru_admin` (
`adm_id` int(11) NOT NULL PRIMARY KEY,
  `adm_name` varchar(50) NOT NULL,
  `adm_email` varchar(255) NOT NULL,
  `adm_password` varchar(255) NOT NULL,
  `adm_status` enum('enable','disable','delete') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cru_admin`
--

INSERT IGNORE INTO `cru_admin` (`adm_id`, `adm_name`, `adm_email`, `adm_password`, `adm_status`, `timestamp`, `insertdatetime`, `insertip`, `editdatetime`, `editip`) VALUES
(1, 'admin', 'admin@winspirewebsolution.com', '3b818c957e91dae88baffd38036ac152', 'enable', '2016-08-08 12:14:35', '2016-08-06 00:00:00', '', '2016-08-06 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `cru_email_settings`
--

CREATE TABLE IF NOT EXISTS `cru_email_settings` (
`es_id` int(11) NOT NULL PRIMARY KEY,
  `es_name` varchar(255) NOT NULL,
  `es_value` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cru_email_settings`
--

INSERT IGNORE INTO `cru_email_settings` (`es_id`, `es_name`, `es_value`, `timestamp`) VALUES
(1, 'host name', 'mail.winspirewebsolution.com', '2016-08-08 11:32:02'),
(2, 'outgoing port', '587', '2016-08-08 11:32:18'),
(3, 'username', 'noreply@wwsptech.com', '2016-08-08 11:18:19'),
(4, 'password', 'reply123', '2016-08-08 11:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `cru_email_templates`
--

CREATE TABLE IF NOT EXISTS `cru_email_templates` (
`et_id` int(11) NOT NULL PRIMARY KEY,
  `et_subject` varchar(255) NOT NULL,
  `et_variables` text NOT NULL,
  `et_description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;



--
-- Table structure for table `cru_inquiry`
--

CREATE TABLE IF NOT EXISTS `cru_inquiry` (
`inq_id` int(11) NOT NULL PRIMARY KEY,
  `inq_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `inq_contact` int(11) NOT NULL,
  `inq_email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `inq_comment` text CHARACTER SET utf8 NOT NULL,
  `inq_status` enum('pending','approved','cancel','delete') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cru_pages`
--

CREATE TABLE IF NOT EXISTS `cru_pages` (
`page_id` int(11) NOT NULL PRIMARY KEY,
  `page_title` varchar(255) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_meta_title` varchar(255) NOT NULL,
  `page_meta_keywords` varchar(255) NOT NULL,
  `page_meta_descriptions` varchar(255) NOT NULL,
  `page_description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cru_pages`
--

INSERT IGNORE INTO `cru_pages` (`page_id`, `page_title`, `page_url`, `page_meta_title`, `page_meta_keywords`, `page_meta_descriptions`, `page_description`, `timestamp`) VALUES
(1, 'Login', '', 'CRUISE Login', 'CRUISE Login', 'CRUISE Login', 'CRUISE Login', '2016-08-31 10:58:31'),
(2, 'Dashboard', '', 'CRUISE Dashboard', 'CRUISE Dashboard', 'CRUISE Dashboard', 'CRUISE Dashboard', '2016-08-31 10:58:36'),
(3, 'Contributor', '', 'CRUISE Contributor', 'CRUISE Contributor', 'CRUISE Contributor', 'CRUISE Contributor', '2016-08-31 10:58:40'),
(4, 'Profile', '', 'Manage Profile', 'Manage Profile', 'Manage Profile', '<p>Manage Profile</p>', '2016-09-22 05:27:04');

-- --------------------------------------------------------

--
-- Table structure for table `cru_projects`
--

CREATE TABLE IF NOT EXISTS `cru_projects` (
`prj_id` int(11) NOT NULL PRIMARY KEY,
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
  `editip` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_comment_likes`
--

CREATE TABLE IF NOT EXISTS `cru_project_comment_likes` (
`cmtlk_id` int(11) NOT NULL PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `cmt_id` int(11) NOT NULL,
  `cmtlk_status` enum('enable','disable','delete') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_invites`
--

CREATE TABLE IF NOT EXISTS `cru_project_invites` (
`pri_id` int(11) NOT NULL PRIMARY KEY,
  `prj_id` int(11) NOT NULL,
  `pri_email` varchar(255) NOT NULL,
  `pri_invited_by` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_modules`
--

CREATE TABLE IF NOT EXISTS `cru_project_modules` (
`prm_id` int(11) NOT NULL PRIMARY KEY,
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
  `editip` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_requirements`
--

CREATE TABLE IF NOT EXISTS `cru_project_requirements` (
`prr_id` int(11) NOT NULL PRIMARY KEY,
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
  `editip` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_requirement_comments`
--

CREATE TABLE IF NOT EXISTS `cru_project_requirement_comments` (
`prrc_id` int(11) NOT NULL PRIMARY KEY,
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
  `editip` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_requirement_likes_dislikes`
--

CREATE TABLE IF NOT EXISTS `cru_project_requirement_likes_dislikes` (
`prrld_id` int(11) NOT NULL PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `prr_id` int(11) NOT NULL,
  `prrld_type` enum('like','dislike') NOT NULL,
  `prrld_status` enum('enable','disable','delete') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertdatetime` datetime NOT NULL,
  `insertip` varchar(25) NOT NULL,
  `editdatetime` datetime NOT NULL,
  `editip` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cru_project_users`
--

CREATE TABLE IF NOT EXISTS `cru_project_users` (
`cpu_id` int(11) NOT NULL PRIMARY KEY,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_status` enum('owner','contributor','other','') NOT NULL,
  `is_archive` enum('no','yes') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cru_sem`
--

CREATE TABLE IF NOT EXISTS `cru_sem` (
`semid` int(11) NOT NULL PRIMARY KEY,
  `semfieldname` varchar(50) NOT NULL,
  `semfieldvalue` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `cru_sem`
--

INSERT IGNORE INTO `cru_sem` (`semid`, `semfieldname`, `semfieldvalue`, `status`, `timestamp`) VALUES
(1, 'fb', 'google.com1', 'Enable', '2016-08-10 08:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `cru_seo`
--

CREATE TABLE IF NOT EXISTS `cru_seo` (
`seo_id` int(11) NOT NULL PRIMARY KEY,
  `seo_name` varchar(255) NOT NULL,
  `seo_value` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cru_seo`
--

INSERT IGNORE INTO `cru_seo` (`seo_id`, `seo_name`, `seo_value`, `timestamp`) VALUES
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
`setting_id` int(11) NOT NULL PRIMARY KEY,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cru_settings`
--

INSERT IGNORE INTO `cru_settings` (`setting_id`, `setting_name`, `setting_value`, `timestamp`) VALUES
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
`user_id` int(11) NOT NULL PRIMARY KEY,
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
  `editip` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cru_admin`
--
ALTER TABLE `cru_admin`
MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cru_email_settings`
--
ALTER TABLE `cru_email_settings`
MODIFY `es_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cru_email_templates`
--
ALTER TABLE `cru_email_templates`
MODIFY `et_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cru_inquiry`
--
ALTER TABLE `cru_inquiry`
MODIFY `inq_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cru_pages`
--
ALTER TABLE `cru_pages`
MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cru_projects`
--
ALTER TABLE `cru_projects`
MODIFY `prj_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `cru_project_comment_likes`
--
ALTER TABLE `cru_project_comment_likes`
MODIFY `cmtlk_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `cru_project_invites`
--
ALTER TABLE `cru_project_invites`
MODIFY `pri_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `cru_project_modules`
--
ALTER TABLE `cru_project_modules`
MODIFY `prm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `cru_project_requirements`
--
ALTER TABLE `cru_project_requirements`
MODIFY `prr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `cru_project_requirement_comments`
--
ALTER TABLE `cru_project_requirement_comments`
MODIFY `prrc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `cru_project_requirement_likes_dislikes`
--
ALTER TABLE `cru_project_requirement_likes_dislikes`
MODIFY `prrld_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `cru_project_users`
--
ALTER TABLE `cru_project_users`
MODIFY `cpu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `cru_sem`
--
ALTER TABLE `cru_sem`
MODIFY `semid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cru_seo`
--
ALTER TABLE `cru_seo`
MODIFY `seo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cru_settings`
--
ALTER TABLE `cru_settings`
MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cru_users`
--
ALTER TABLE `cru_users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

