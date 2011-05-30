START TRANSACTION;

-- 
-- Table structure for table alerts
-- 

CREATE TABLE IF NOT EXISTS `alert` (
	`id` int(11) NOT NULL auto_increment,
	
	`email` varchar(512) default NULL,
	`query` varchar(512) default NULL,
	`date_added` int(11) default NULL,  	
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `queue` (
	`id` int(11) NOT NULL auto_increment,	
	`func` varchar(512) default NULL,
	`args` varchar(512) default NULL,
	`date_added` int(11) default NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `alert_send_log` (
	`id` int(11) NOT NULL auto_increment,	
	`alert_id` int(11) default NULL,
	`job_id` int(11) default NULL,
	`date_sent` int(11) default NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'016', 'new tables for alerts');

COMMIT;

