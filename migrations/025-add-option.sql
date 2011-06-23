START TRANSACTION;

INSERT INTO options(`option`, `value`, `type`, `help`, `option_human`) VALUES (
	'on-feedback-notification-email-addresses', 
	'',
	'string',
	'E-Mail Addresse oder Addressen (kommasepariert), an die eine Nachricht gesendet werden soll, wenn jemand ein Feedback zum Jobportal hinterläßt.',
	'Feedback-Benachrichtigungen');


INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'025', 'added option content; no schema alterations');

COMMIT;


