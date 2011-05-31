START TRANSACTION;

-- 
-- Table structure for table `job_viewcount`
-- 

CREATE TABLE IF NOT EXISTS `job_viewcount` (
	`id` int(11) NOT NULL auto_increment,
	
	`job_id` int(11) default NULL,
	`job_title` varchar(512) default NULL,
	`job_date_added` int(11) default NULL,
	`view_count` int(11) default NULL,
	`date_updated` int(11) default NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'017', 'new caching table: job_viewcount');

COMMIT;
