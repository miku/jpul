START TRANSACTION;

ALTER TABLE `options` ADD COLUMN `option_human` VARCHAR(255) default '';

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'021', 'added human readable repr of option key');

COMMIT;


START TRANSACTION;

UPDATE `options` SET 
	option_human = 'E-Mail Benachrichtigungen'
	WHERE id = 1;

UPDATE `options` SET 
	option_human = 'Bestätigungs-E-Mails'
	WHERE id = 2;

COMMIT;