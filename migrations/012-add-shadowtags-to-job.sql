START TRANSACTION;

-- shadowtags should help lucene to find jobs based on tags ...
ALTER TABLE `job` ADD COLUMN `shadowtags` varchar(1024) default NULL;

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'012', 'added shadowtags column to jobs, for a poor mans lucene synonym search');

UPDATE `job` SET 
	shadowtags = CONCAT_WS(',', shadowtags, 'shk') 
	WHERE title LIKE '%Studentische Hilfskr%' OR
		title LIKE '%Studentische Mitarbeit%' OR
		title LIKE '%Studentische Aushilfskr%' OR	
		title LIKE '%Studentischen Hilfskr%' OR
		title LIKE '%Studentischen Mitarbeit%' OR
		title LIKE '%Studentischen Aushilfskr%';	

UPDATE `job` SET 
	shadowtags = CONCAT_WS(',', shadowtags, 'whk') 
	WHERE title LIKE '%Wissenschaftliche Hilfskr%' OR
		title LIKE '%Wissenschaftliche Mitarbeit%' OR
		title LIKE '%Wissenschaftliche Aushilfskr%' OR
		title LIKE '%Wissenschaftlichen Hilfskr%' OR
		title LIKE '%Wissenschaftlichen Mitarbeit%' OR
		title LIKE '%Wissenschaftlichen Aushilfskr%';	

UPDATE `job` SET 
	shadowtags = CONCAT_WS(',', shadowtags, 'bwl') 
	WHERE title LIKE '%Betriebswirtschaft%' OR
		description LIKE '%Betriebswirtschaft%';

UPDATE `job` SET 
	shadowtags = CONCAT_WS(',', shadowtags, 'vwl') 
	WHERE title LIKE '%Volkswirtschaft%' OR
		description LIKE '%Volkswirtschaft%';

UPDATE `job` SET 
	shadowtags = CONCAT_WS(',', shadowtags, 'kmw') 
	WHERE title LIKE '%Kommunikationswiss%' OR
		title LIKE '%Medienwiss%';

COMMIT;
