START TRANSACTION;

INSERT INTO options(`option`, `value`, `type`, `help`, `option_human`) VALUES (
	'activation-notification-bcc', 
	'',
	'string',
	'Soll eine BCC der Arbeitgeber-Veröffentlichungs-Benachrichtigung-E-Mail an jemanden geschickt werden? Wenn ja, an wen? Falls keine BCC geschickt werden soll, Feld bitte einfach frei lassen.',
	'BCC der Bestätigungs-E-Mail für Arbeitgeber');


INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'022', 'added option content; no schema alterations');

COMMIT;


