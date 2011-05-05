START TRANSACTION;

UPDATE `job` SET 
	publisher_name = 'Career Center',
	publisher_phone = '+49 341 97-30030',
	publisher_email = 'careercenter@uni-leipzig.de'
	WHERE publisher_name = 'c' AND
		publisher_phone = 'c' AND
		publisher_email = 'c';

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'013', 'replace c c c with career center contact info in jobs');

COMMIT;
