ALTER TABLE `job` DROP COLUMN `is_fulltime`;
ALTER TABLE `job` DROP COLUMN `is_parttime`;

ALTER TABLE `job` DROP COLUMN `is_internship`;
ALTER TABLE `job` DROP COLUMN `is_voluntary_service`;
ALTER TABLE `job` DROP COLUMN `is_regular_job`;

ALTER TABLE `job` DROP COLUMN `is_scientific_position`;
ALTER TABLE `job` DROP COLUMN `is_working_student_position`;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'008', 'back to old job table; alter job table; dropped is_fulltime, is_parttime, is_internship, is_voluntary_service, is_regular_job, is_scientific_position, is_working_student_position');