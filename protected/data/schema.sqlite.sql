CREATE TABLE degree (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(255) NOT NULL
);

CREATE TABLE job_status (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	status VARCHAR(255) NOT NULL
);

CREATE TABLE job (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,

	-- Job
	title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
	how_to_apply TEXT,
	attachment VARCHAR(255),
	
	-- Company
	company TEXT NOT NULL,
	company_homepage VARCHAR(255),
	
	-- Location
	zipcode VARCHAR(10),
	city VARCHAR(255),
	state VARCHAR(255),
	country VARCHAR(255),
	is_telecommute BOOLEAN,
	is_nation_wide BOOLEAN,

	-- Degree and Categories
	degree_id INTEGER, 
	study VARCHAR(255),
	sector VARCHAR(255),
	
	-- Metadata
	date_added INTEGER NOT NULL,
	expiration_date INTEGER NOT NULL,

	author_id INTEGER NOT NULL,
	reviewer_id INTEGER,
	
	status_id INTEGER NOT NULL
);

CREATE TABLE user
(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	username VARCHAR(128) NOT NULL,
	password VARCHAR(255) NOT NULL,
	salt VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	role VARCHAR(255) NOT NULL,
	profile TEXT
);

INSERT INTO user (username, password, salt, email, role) VALUES ('test', 'dbjGUUwcNHYNU', 'dbe335cb3e9f9a565584d12285e32cc8400b5309', 'martin.czygan@gmail.com', 'something');
INSERT INTO user (username, password, salt, email, role) VALUES ('admin', '93UUzyjNaaV.E', '936147e1d23c1bd9cb982862a1a3ffecb284a457', 'martin.czygan@gmail.com', 'admin');

INSERT INTO job_status (status) VALUES ('Draft');	 -- Needs review
INSERT INTO job_status (status) VALUES ('Public');   -- Public
INSERT INTO job_status (status) VALUES ('Archived'); -- Expired
INSERT INTO job_status (status) VALUES ('Deleted');  -- Deleted

INSERT INTO degree (name) VALUES ('Student');
INSERT INTO degree (name) VALUES ('Bachelor');
INSERT INTO degree (name) VALUES ('Master');
INSERT INTO degree (name) VALUES ('Magister');
INSERT INTO degree (name) VALUES ('Diplom');
INSERT INTO degree (name) VALUES ('PhD');
INSERT INTO degree (name) VALUES ('Post-Doc');

-- Data section

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Web Developer', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230151187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Biologe', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230252287, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Referendar', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230352387, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Assistenz der Geschäftsführung', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230454187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Diktator', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230555187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Chemiker', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230656187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Physiker', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230757187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Informatiker', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230858187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Schauspieler', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Schauspieler am Landestheater des Landes Brandenburg in Neuruppin (T12)', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1232959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Schauspieler am Landestheater des Landes Brandenburg in Neuruppin (T12)', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Landesamt für Forst- und Wasserwirtschaft', 1238959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Wissenschaftlicher Mitarbeiter, befristet', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Universität Leipzig', 1242959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, company_homepage, date_added, expiration_date, author_id, status_id) VALUES 
	('SAP-Consultant', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'SAP', 'http://www.myyn.org', 1239959187, 1230956187, 1, 2);


INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Web Developer', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230151187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Biologe', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230252287, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Referendar', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230352387, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Assistenz der Geschäftsführung', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230454187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Diktator', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230555187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Chemiker', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230656187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Physiker', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230757187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Informatiker', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230858187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Schauspieler', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Schauspieler am Landestheater des Landes Brandenburg in Neuruppin (T12)', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1232959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Schauspieler am Landestheater des Landes Brandenburg in Neuruppin (T12)', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Landesamt für Forst- und Wasserwirtschaft', 1238959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Wissenschaftlicher Mitarbeiter, befristet', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Universität Leipzig', 1242959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, company_homepage, date_added, expiration_date, author_id, status_id) VALUES 
	('SAP-Consultant', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'SAP', 'http://www.myyn.org', 1239959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Web Developer', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230151187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Biologe', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230252287, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Referendar', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230352387, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Assistenz der Geschäftsführung', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230454187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Diktator', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230555187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Chemiker', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230656187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Physiker', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230757187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Informatiker', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230858187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Schauspieler', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1230959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Schauspieler am Landestheater des Landes Brandenburg in Neuruppin (T12)', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Google Inc.', 1232959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Schauspieler am Landestheater des Landes Brandenburg in Neuruppin (T12)', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Landesamt für Forst- und Wasserwirtschaft', 1238959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, date_added, expiration_date, author_id, status_id) VALUES 
	('Wissenschaftlicher Mitarbeiter, befristet', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'Universität Leipzig', 1242959187, 1230956187, 1, 2);

INSERT INTO job (title, description, company, company_homepage, date_added, expiration_date, author_id, status_id) VALUES 
	('SAP-Consultant', 
		'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
		'SAP', 'http://www.myyn.org', 1239959187, 1230956187, 1, 2);

