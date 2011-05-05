START TRANSACTION;

-- 
-- Table structure for table `outbound`
-- 

CREATE TABLE IF NOT EXISTS `outbound` (
	`id` int(11) NOT NULL auto_increment,
	
	`location` varchar(512) default NULL,
	`url` varchar(512) default NULL,
	`text` varchar(512) default NULL,

	`user_agent` varchar(512) default NULL,
	`more_info` varchar(1024) default NULL,
	
	`tracking_id` varchar(512) default NULL,
	`tracking_version` int(8) default NULL,

	`remote_addr` varchar(255) default NULL,
	`remote_host` varchar(512) default NULL,
	`request_time` int(11) default NULL,

	`http_user_agent` varchar(512) default NULL,
	`http_accept` varchar(512) default NULL,
	`http_accept_charset` varchar(512) default NULL,
	`http_accept_encoding` varchar(512) default NULL,
	`http_accept_language` varchar(512) default NULL,
	`http_connection` varchar(512) default NULL,
	`http_host` varchar(512) default NULL,
	`remote_port` varchar(32) default NULL,
  	
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'014', 'new table: outbound for link tracking');

COMMIT;

