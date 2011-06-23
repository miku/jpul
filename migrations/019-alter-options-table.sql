START TRANSACTION;

ALTER TABLE `options` ADD COLUMN `type` VARCHAR(32) default NULL;
ALTER TABLE `options` ADD COLUMN `help` VARCHAR(1024) default NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'019', 'added type and help columns to options; type should indicate the type of the value, e.g. string or boolean, which is eventually used to render the form; help is just a short description');

COMMIT;

-- Update existing record

START TRANSACTION;

UPDATE `options` SET 
	type = 'string', 
	help = 'Kommaseparierte Liste von E-Mail-Addressen, an die eine Notifikation gesendet werden soll, wenn ein neues Angebot von einem Arbeitgeber eingestellt wurde.' 
	WHERE id = 1;

COMMIT;
