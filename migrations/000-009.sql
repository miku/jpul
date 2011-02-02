-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: wwwdb.uni-leipzig.de:3306
-- Generation Time: Dec 14, 2010 at 11:29 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.2
-- 
-- Database: `jobportal`
-- 


START TRANSACTION;
-- --------------------------------------------------------

-- 
-- Table structure for table `dbsession`
-- 

CREATE TABLE IF NOT EXISTS `dbsession` (
  `id` char(32) NOT NULL,
  `expire` int(11) default NULL,
  `data` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `degree`
-- 

CREATE TABLE IF NOT EXISTS `degree` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `job`
-- 

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `how_to_apply` text,
  `attachment` varchar(255) default NULL,
  `company` varchar(1000) NOT NULL,
  `company_homepage` varchar(255) default NULL,
  `zipcode` varchar(10) default NULL,
  `city` varchar(255) default NULL,
  `state` varchar(255) default NULL,
  `country` varchar(255) default NULL,
  `is_telecommute` tinyint(1) default NULL,
  `is_nation_wide` tinyint(1) default NULL,
  `degree_id` int(11) default NULL,
  `study` varchar(255) default NULL,
  `sector` varchar(255) default NULL,
  `author_id` int(11) NOT NULL,
  `date_added` int(11) NOT NULL,
  `expiration_date` int(11) NOT NULL,
  `reviewer_id` int(11) default NULL,
  `source` varchar(255) default NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=166 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `job_status`
-- 

CREATE TABLE IF NOT EXISTS `job_status` (
  `id` int(11) NOT NULL auto_increment,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `options`
-- 

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL auto_increment,
  `option` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `request`
-- 

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL auto_increment,
  `addr` varchar(255) default NULL,
  `request_time` int(11) default NULL,
  `request_path` varchar(512) default NULL,
  `user_agent` varchar(512) default NULL,
  `more_info` varchar(1024) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7617 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `profile` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;





-- 
-- Dumping data for table `degree`
-- 

INSERT INTO `degree` VALUES (1, 'Student');
INSERT INTO `degree` VALUES (2, 'Bachelor');
INSERT INTO `degree` VALUES (3, 'Master');
INSERT INTO `degree` VALUES (4, 'Magister');
INSERT INTO `degree` VALUES (5, 'Diplom');
INSERT INTO `degree` VALUES (6, 'PhD');
INSERT INTO `degree` VALUES (7, 'Post-Doc');



-- 
-- Dumping data for table `job_status`
-- 

INSERT INTO `job_status` VALUES (1, 'Draft');
INSERT INTO `job_status` VALUES (2, 'Public');
INSERT INTO `job_status` VALUES (3, 'Archived');
INSERT INTO `job_status` VALUES (4, 'Deleted');

-- 
-- Dumping data for table `options`
-- 
INSERT INTO `options` VALUES (1, 'on-draft-notification-email-addresses', '');

-- 
-- Dumping data for table `user`
-- 
INSERT INTO `user` VALUES (1, 'test', 'dbjGUUwcNHYNU', 'dbe335cb3e9f9a565584d12285e32cc8400b5309', 'martin.czygan@gmail.com', 'something', NULL);
INSERT INTO `user` VALUES (2, 'admin', '93444RmLeAihQ', '936147e1d23c1bd9cb982862a1a3ffecb284a457', 'martin.czygan@gmail.com', 'admin', NULL);

COMMIT;-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: wwwdb.uni-leipzig.de:3306
-- Generation Time: Dec 14, 2010 at 11:29 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.2
-- 
-- Database: `jobportal`
-- 

START TRANSACTION;
--
-- Add schema version table
-- Inspired by: http://blog.cherouvim.com/a-table-that-should-exist-in-all-projects-with-a-database/
-- 

CREATE TABLE IF NOT EXISTS `schema_version` (
    `applied_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `migration_code` VARCHAR(256) NOT NULL,
    `extra_notes` VARCHAR(512),
    PRIMARY KEY (`migration_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES ('001', 'add schema_version table');

COMMIT;START TRANSACTION;

-- ======================
-- ======================
-- Original request table
-- ======================
-- ======================

-- -- 
-- -- Table structure for table `request`
-- -- 
-- 
-- CREATE TABLE IF NOT EXISTS `request` (
--   `id` int(11) NOT NULL auto_increment,
--   `addr` varchar(255) default NULL,
--   `request_time` int(11) default NULL,
--   `request_path` varchar(512) default NULL,
--   `user_agent` varchar(512) default NULL,
--   `more_info` varchar(1024) default NULL,
--   PRIMARY KEY  (`id`)
-- ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7617 ;

ALTER TABLE `request` CHANGE `addr` `remote_addr` varchar(255) default NULL;
ALTER TABLE `request` CHANGE `request_path` `request_uri` varchar(512) default NULL;
ALTER TABLE `request` CHANGE `user_agent` `http_user_agent` varchar(512) default NULL;

-- our session tracking id
ALTER TABLE `request` ADD COLUMN `tracking_id` varchar(512) default NULL;

-- mainly $_SERVER
ALTER TABLE `request` ADD COLUMN `request_method` varchar(512) default NULL;
ALTER TABLE `request` ADD COLUMN `http_referer` varchar(512) default NULL;
ALTER TABLE `request` ADD COLUMN `http_accept` varchar(512) default NULL;
ALTER TABLE `request` ADD COLUMN `http_accept_charset` varchar(512) default NULL;
ALTER TABLE `request` ADD COLUMN `http_accept_encoding` varchar(512) default NULL;
ALTER TABLE `request` ADD COLUMN `http_accept_language` varchar(512) default NULL;
ALTER TABLE `request` ADD COLUMN `http_connection` varchar(512) default NULL;
ALTER TABLE `request` ADD COLUMN `http_host` varchar(512) default NULL;
ALTER TABLE `request` ADD COLUMN `remote_port` varchar(32) default NULL;

ALTER TABLE `request` ADD COLUMN `window_height` varchar(64) default NULL;
ALTER TABLE `request` ADD COLUMN `window_width` varchar(64) default NULL;
ALTER TABLE `request` ADD COLUMN `screen_height` varchar(64) default NULL;
ALTER TABLE `request` ADD COLUMN `screen_width` varchar(64) default NULL;
ALTER TABLE `request` ADD COLUMN `screen_colordepth` varchar(64) default NULL;
ALTER TABLE `request` ADD COLUMN `navigator_appversion` varchar(1024) default NULL;

ALTER TABLE `request` ADD COLUMN `bt_browser` varchar(1024) default NULL;
ALTER TABLE `request` ADD COLUMN `bt_version` varchar(1024) default NULL;
ALTER TABLE `request` ADD COLUMN `bt_os` varchar(128) default NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES ('002', 'alter request table');

COMMIT;START TRANSACTION;

ALTER TABLE `request` ADD COLUMN `request_uri_wo_qs` varchar(512) default NULL;
ALTER TABLE `request` ADD COLUMN `request_uri_wo_qs_and_hostname` varchar(512) default NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES ('003', 'alter request table; two more columns');

COMMIT;START TRANSACTION;

ALTER TABLE `request` ADD COLUMN `tracking_version` int(8) default NULL;

UPDATE `request` SET `tracking_version` = 1 where `tracking_version` = NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES ('004', 'alter request table; added tracking version tag');
COMMIT;START TRANSACTION;

ALTER TABLE `request` ADD COLUMN `remote_host` varchar(512) default NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES ('005', 'alter request table; added remote hostname');
COMMIT;START TRANSACTION;

ALTER TABLE `job` ADD COLUMN `is_fulltime` tinyint(1) default 0;
ALTER TABLE `job` ADD COLUMN `is_parttime` tinyint(1) default 0;

ALTER TABLE `job` ADD COLUMN `is_internship` tinyint(1) default 0;
ALTER TABLE `job` ADD COLUMN `is_voluntary_service` tinyint(1) default 0;
ALTER TABLE `job` ADD COLUMN `is_regular_job` tinyint(1) default 0;

ALTER TABLE `job` ADD COLUMN `is_scientific_position` tinyint(1) default 0;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'006', 'alter job table; added is_fulltime, is_parttime, is_internship, is_voluntary_service, is_regular_job, is_scientific_position');
	COMMIT;START TRANSACTION;

ALTER TABLE `job` ADD COLUMN `is_working_student_position` tinyint(1) default 0;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'007', 'alter job table; added is_working_student_position');

COMMIT;START TRANSACTION;

ALTER TABLE `job` DROP COLUMN `is_fulltime`;
ALTER TABLE `job` DROP COLUMN `is_parttime`;

ALTER TABLE `job` DROP COLUMN `is_internship`;
ALTER TABLE `job` DROP COLUMN `is_voluntary_service`;
ALTER TABLE `job` DROP COLUMN `is_regular_job`;

ALTER TABLE `job` DROP COLUMN `is_scientific_position`;
ALTER TABLE `job` DROP COLUMN `is_working_student_position`;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'008', 'back to old job table; alter job table; dropped is_fulltime, is_parttime, is_internship, is_voluntary_service, is_regular_job, is_scientific_position, is_working_student_position');
	COMMIT;START TRANSACTION;

-- Degrees (were in a separate table; we use a big messy Job table instead)

ALTER TABLE `job` ADD COLUMN `degree_student` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_bachelor` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_master` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_ma` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_diploma` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_phd` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_postdoc` tinyint(1) default NULL;

-- TODO: Is this a good idea?
-- probably encode all degree flags in one, e.g.
-- Student = 1
-- Bachelor = 2
-- Master = 4
-- MA = 8
-- Diploma = 16
-- PHD = 32
-- postdoc = 64

-- If we search for:
-- bachelors and masters = 6
-- master and ma = 12
-- etc.
ALTER TABLE `job` ADD COLUMN `degree_encoded` int(11);

-- Typ of Job

-- Dictionary:
-- fulltime = Vollzeit
-- parttime = Teilzeit
-- internship = Praktikum
-- working student = Werkstundent
-- thesis = Abschlussarbeit

ALTER TABLE `job` ADD COLUMN `is_fulltime` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_parttime` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_internship` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_working_student` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_thesis` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_scholarship` tinyint(1) default NULL;

-- Work environment

-- Dictionary:
-- scientific postition = wissenschaftliche Stelle
-- regular job = alle anderen

ALTER TABLE `job` ADD COLUMN `is_regular_job` tinyint(1) default 0;
ALTER TABLE `job` ADD COLUMN `is_scientific_position` tinyint(1) default 0;


-- Meta information about the publisher

ALTER TABLE `job` ADD COLUMN `publisher_name` VARCHAR(128);
ALTER TABLE `job` ADD COLUMN `publisher_phone` VARCHAR(128);
ALTER TABLE `job` ADD COLUMN `publisher_email` VARCHAR(128);

-- Meta information for us, since we will have two versions of jobs on the site
-- concurrently ...

ALTER TABLE `job` ADD COLUMN `job_version` VARCHAR(16);

-- Tag all existing jobs with version "1"
UPDATE `job` SET job_version = '1';

-- Carry over degrees, if applicable ...
UPDATE `job` SET degree_student = 1 WHERE degree_id = 1;
UPDATE `job` SET degree_bachelor = 1 WHERE degree_id = 2;
UPDATE `job` SET degree_master = 1 WHERE degree_id = 3;
UPDATE `job` SET degree_ma = 1 WHERE degree_id = 4;
UPDATE `job` SET degree_diploma = 1 WHERE degree_id = 5;
UPDATE `job` SET degree_phd = 1 WHERE degree_id = 6;
UPDATE `job` SET degree_postdoc = 1 WHERE degree_id = 7;

-- all other jobs are universally matching ...
UPDATE `job` SET 
	degree_student = 1, 
	degree_bachelor = 1,
	degree_master = 1,
	degree_ma = 1,
	degree_master = 1,
	degree_diploma = 1,
	degree_phd = 1,
	degree_postdoc = 1 WHERE degree_id = NULL;

-- Try to categorize current jobs based on title ...

UPDATE `job` SET is_internship = 1 WHERE title LIKE '%Praktik%';
UPDATE `job` SET is_thesis = 1 WHERE title LIKE '%Abschlu%';
UPDATE `job` SET is_working_student = 1 WHERE title LIKE '%Werkstud%';
UPDATE `job` SET is_scholarship = 1 WHERE title LIKE '%Stipen%';

-- All other jobs seem to be regular
UPDATE `job` SET is_fulltime = 1 
	WHERE title NOT LIKE '%Abschlu%' 
	AND title NOT LIKE '%Praktik%' 
	AND title NOT LIKE '%Werkstud%'
	AND title NOT LIKE '%Stipen%';

UPDATE `job` SET is_scientific_position = 1 WHERE title LIKE '%Wissensch%' and title LIKE '%Mitarbeiter%';

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'009', 'alter job table; readded a few flags on Job table');

COMMIT;