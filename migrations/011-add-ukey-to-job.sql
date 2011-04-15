START TRANSACTION;

-- Some uniq obscure key to edit the job
ALTER TABLE `job` ADD COLUMN `ukey` varchar(128) default NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'011', 'added ukey column to jobs, for editing and editable drafts');

COMMIT;