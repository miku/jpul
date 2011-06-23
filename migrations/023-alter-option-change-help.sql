START TRANSACTION;

UPDATE `options` SET 
	help = 'Soll eine BCC der Arbeitgeber-Veröffentlichungs-Benachrichtigung-E-Mail an jemanden geschickt werden? Wenn ja, an wen? Falls keine BCC geschickt werden soll, Feld bitte einfach frei lassen. Mehrere E-Mail-Addressen bitte durch Komma trennen.'
	WHERE id = 3;
	
INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'023', 'added option content; no schema alterations');

COMMIT;




