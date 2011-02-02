START TRANSACTION;

ALTER TABLE `request` ADD COLUMN `tracking_version` int(8) default NULL;

UPDATE `request` SET `tracking_version` = 1 where `tracking_version` = NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES ('004', 'alter request table; added tracking version tag');
COMMIT;