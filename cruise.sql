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
-- Table structure for table `cru_settings`
--

CREATE TABLE IF NOT EXISTS `cru_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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
