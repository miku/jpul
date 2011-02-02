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

COMMIT;