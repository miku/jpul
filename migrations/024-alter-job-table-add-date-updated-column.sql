START TRANSACTION;

-- Some uniq obscure key to edit the job
ALTER TABLE `job` ADD COLUMN `date_updated` int(11) default NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'024', 'added date_updated column to job');

COMMIT;


START TRANSACTION;

UPDATE `job` SET date_updated = date_added;

COMMIT;
