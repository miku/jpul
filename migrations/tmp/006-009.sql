START TRANSACTION;

ALTER TABLE `job` ADD COLUMN `is_fulltime` tinyint(1) default 0;
ALTER TABLE `job` ADD COLUMN `is_parttime` tinyint(1) default 0;

ALTER TABLE `job` ADD COLUMN `is_internship` tinyint(1) default 0;
ALTER TABLE `job` ADD COLUMN `is_voluntary_service` tinyint(1) default 0;
ALTER TABLE `job` ADD COLUMN `is_regular_job` tinyint(1) default 0;

ALTER TABLE `job` ADD COLUMN `is_scientific_position` tinyint(1) default 0;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'006', 'alter job table; added is_fulltime, is_parttime, is_internship, is_voluntary_service, is_regular_job, is_scientific_position');
	COMMIT;START TRANSACTION;

ALTER TABLE `job` ADD COLUMN `is_working_student_position` tinyint(1) default 0;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'007', 'alter job table; added is_working_student_position');

COMMIT;START TRANSACTION;

ALTER TABLE `job` DROP COLUMN `is_fulltime`;
ALTER TABLE `job` DROP COLUMN `is_parttime`;

ALTER TABLE `job` DROP COLUMN `is_internship`;
ALTER TABLE `job` DROP COLUMN `is_voluntary_service`;
ALTER TABLE `job` DROP COLUMN `is_regular_job`;

ALTER TABLE `job` DROP COLUMN `is_scientific_position`;
ALTER TABLE `job` DROP COLUMN `is_working_student_position`;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'008', 'back to old job table; alter job table; dropped is_fulltime, is_parttime, is_internship, is_voluntary_service, is_regular_job, is_scientific_position, is_working_student_position');
	COMMIT;START TRANSACTION;

-- Degrees (were in a separate table; we use a big messy Job table instead)

ALTER TABLE `job` ADD COLUMN `degree_student` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_bachelor` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_master` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_ma` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_diploma` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_phd` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `degree_postdoc` tinyint(1) default NULL;

-- TODO: Is this a good idea?
-- probably encode all degree flags in one, e.g.
-- Student = 1
-- Bachelor = 2
-- Master = 4
-- MA = 8
-- Diploma = 16
-- PHD = 32
-- postdoc = 64

-- If we search for:
-- bachelors and masters = 6
-- master and ma = 12
-- etc.
ALTER TABLE `job` ADD COLUMN `degree_encoded` int(11);

-- Typ of Job

-- Dictionary:
-- fulltime = Vollzeit
-- parttime = Teilzeit
-- internship = Praktikum
-- working student = Werkstundent
-- thesis = Abschlussarbeit

ALTER TABLE `job` ADD COLUMN `is_fulltime` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_parttime` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_internship` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_working_student` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_thesis` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_scholarship` tinyint(1) default NULL;

-- Work environment

-- Dictionary:
-- scientific postition = wissenschaftliche Stelle
-- regular job = alle anderen

ALTER TABLE `job` ADD COLUMN `is_regular_job` tinyint(1) default NULL;
ALTER TABLE `job` ADD COLUMN `is_scientific_position` tinyint(1) default NULL;


-- Meta information about the publisher

ALTER TABLE `job` ADD COLUMN `publisher_name` VARCHAR(128);
ALTER TABLE `job` ADD COLUMN `publisher_phone` VARCHAR(128);
ALTER TABLE `job` ADD COLUMN `publisher_email` VARCHAR(128);

-- Meta information for us, since we will have two versions of jobs on the site
-- concurrently ...

ALTER TABLE `job` ADD COLUMN `job_version` VARCHAR(16);

-- Tag all existing jobs with version "1"
UPDATE `job` SET job_version = '1';

-- Carry over degrees, if applicable ...
UPDATE `job` SET degree_student = 1 WHERE degree_id = 1;
UPDATE `job` SET degree_bachelor = 1 WHERE degree_id = 2;
UPDATE `job` SET degree_master = 1 WHERE degree_id = 3;
UPDATE `job` SET degree_ma = 1 WHERE degree_id = 4;
UPDATE `job` SET degree_diploma = 1 WHERE degree_id = 5;
UPDATE `job` SET degree_phd = 1 WHERE degree_id = 6;
UPDATE `job` SET degree_postdoc = 1 WHERE degree_id = 7;

-- all other jobs are universally matching ...
UPDATE `job` SET 
	degree_student = 1, 
	degree_bachelor = 1,
	degree_master = 1,
	degree_ma = 1,
	degree_master = 1,
	degree_diploma = 1,
	degree_phd = 1,
	degree_postdoc = 1 WHERE degree_id IS NULL;

-- Try to categorize current jobs based on title ...

UPDATE `job` SET is_internship = 1 WHERE title LIKE '%Praktik%';
UPDATE `job` SET is_thesis = 1 WHERE title LIKE '%Abschlu%';
UPDATE `job` SET is_working_student = 1 WHERE title LIKE '%Werkstud%';
UPDATE `job` SET is_scholarship = 1 WHERE title LIKE '%Stipen%';

-- All other jobs seem to be regular
UPDATE `job` SET is_fulltime = 1 
	WHERE title NOT LIKE '%Abschlu%' 
	AND title NOT LIKE '%Praktik%' 
	AND title NOT LIKE '%Werkstud%'
	AND title NOT LIKE '%Stipen%';

UPDATE `job` SET is_scientific_position = 1 WHERE title LIKE '%Wissensch%' and title LIKE '%Mitarbeiter%';
UPDATE `job` SET is_regular_job = 1 WHERE is_scientific_position IS NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'009', 'alter job table; readded a few flags on Job table');

COMMIT;