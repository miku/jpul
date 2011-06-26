CREATE INDEX request_request_time ON request(request_time);
CREATE INDEX request_tracking_id ON request(tracking_id);

INSERT INTO schema_version(`migration_code`, `extra_notes`) VALUES (
	'026', 'added two indices');
