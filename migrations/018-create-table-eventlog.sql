START TRANSACTION;
--
-- Add generic event log table
-- 

CREATE TABLE IF NOT EXISTS `event_log` (
	`id` int(11) NOT NULL auto_increment,
    `timestamp` int(11) NOT NULL,
    `name` VARCHAR(256) NOT NULL,
    `message` VARCHAR(1024),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES ('018', 'add event_log table');

COMMIT;