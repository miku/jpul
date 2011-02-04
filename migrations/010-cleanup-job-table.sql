START TRANSACTION;

DELETE FROM job WHERE id <= 60;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'010', 'cleanup test jobs');

COMMIT;