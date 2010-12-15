ALTER TABLE `request` ADD COLUMN `remote_host` varchar(512) default NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES ('005', 'alter request table; added remote hostname');