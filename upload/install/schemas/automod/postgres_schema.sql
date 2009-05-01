/*

 $Id$

*/

BEGIN;

/*
	Table: 'phpbb_mods'
*/
CREATE SEQUENCE phpbb_mods_seq;

CREATE TABLE phpbb_mods (
	mod_id INT4 DEFAULT nextval('phpbb_mods_seq'),
	mod_active INT2 DEFAULT '0' NOT NULL CHECK (mod_active >= 0),
	mod_time INT4 DEFAULT '0' NOT NULL CHECK (mod_time >= 0),
	mod_dependencies TEXT DEFAULT '' NOT NULL,
	mod_name varchar(100) DEFAULT '' NOT NULL,
	mod_description varchar(4000) DEFAULT '' NOT NULL,
	mod_version varchar(25) DEFAULT '' NOT NULL,
	mod_author_notes varchar(4000) DEFAULT '' NOT NULL,
	mod_author_name varchar(100) DEFAULT '' NOT NULL,
	mod_author_email varchar(100) DEFAULT '' NOT NULL,
	mod_author_url varchar(100) DEFAULT '' NOT NULL,
	mod_actions TEXT DEFAULT '' NOT NULL,
	mod_languages varchar(255) DEFAULT '' NOT NULL,
	mod_template varchar(255) DEFAULT '' NOT NULL,
	mod_path varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (mod_id)
);



COMMIT;