START TRANSACTION;

INSERT INTO options(`option`, `value`, `type`, `help`) VALUES (
	'send-activation-notification-to-publisher', 
	'Ja',
	'boolean',
	'Sollen Arbeitgeber über die Veröffentlichung ihrer Angebote per E-Mail informiert werden?');


INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'020', 'added option content; no schema alterations');

COMMIT;


