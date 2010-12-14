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
ALTER TABLE `request` ADD COLUMN `http_referrer` varchar(512) default NULL;
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
