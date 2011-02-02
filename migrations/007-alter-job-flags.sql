START TRANSACTION;

ALTER TABLE `job` ADD COLUMN `is_working_student_position` tinyint(1) default 0;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'007', 'alter job table; added is_working_student_position');

COMMIT;