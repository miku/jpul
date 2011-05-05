START TRANSACTION;

ALTER TABLE `outbound` DROP COLUMN `user_agent`;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'015', 'remove dup, user_agent can be found in http_user_agent');

COMMIT;

