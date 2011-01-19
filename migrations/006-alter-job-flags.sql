ALTER TABLE `job` ADD COLUMN `is_fulltime` tinyint(1) default 0;
ALTER TABLE `job` ADD COLUMN `is_parttime` tinyint(1) default 0;

ALTER TABLE `job` ADD COLUMN `is_internship` tinyint(1) default 0;
ALTER TABLE `job` ADD COLUMN `is_voluntary_service` tinyint(1) default 0;
ALTER TABLE `job` ADD COLUMN `is_regular_job` tinyint(1) default 0;

ALTER TABLE `job` ADD COLUMN `is_scientific_position` tinyint(1) default 0;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'006', 'alter job table; added is_fulltime, is_parttime, is_internship, is_voluntary_service, is_regular_job, is_scientific_position');