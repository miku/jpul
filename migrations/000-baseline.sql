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
