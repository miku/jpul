START TRANSACTION;

-- 
-- Table structure for table `feedback`
-- 

CREATE TABLE IF NOT EXISTS `feedback` (
	`id` int(11) NOT NULL auto_increment,
	
	`text` text default NULL,
	`email` varchar(512) default NULL,
	`date_added` int(11) default NULL,
	`context` varchar(512) default NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'016', 'new table: feedback');

COMMIT;

