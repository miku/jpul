ALTER TABLE `request` ADD COLUMN `request_uri_wo_qs` varchar(512) default NULL;
ALTER TABLE `request` ADD COLUMN `request_uri_wo_qs_and_hostname` varchar(512) default NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES ('003', 'alter request table; two more columns');
