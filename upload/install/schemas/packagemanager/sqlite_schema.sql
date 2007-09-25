#
# $Id$
#

BEGIN TRANSACTION;

# Table: 'phpbb_mods'
CREATE TABLE phpbb_mods (
	mod_id INTEGER PRIMARY KEY NOT NULL ,
	mod_active INTEGER UNSIGNED NOT NULL DEFAULT '1',
	mod_time INTEGER UNSIGNED NOT NULL DEFAULT '0',
	mod_dependencies text(65535) NOT NULL DEFAULT '',
	mod_name varchar(255) NOT NULL DEFAULT '',
	mod_description text(65535) NOT NULL DEFAULT '',
	mod_version varchar(100) NOT NULL DEFAULT '',
	mod_author_notes text(65535) NOT NULL DEFAULT '',
	mod_author_name varchar(255) NOT NULL DEFAULT '',
	mod_author_email varchar(255) NOT NULL DEFAULT '',
	mod_author_url varchar(255) NOT NULL DEFAULT '',
	mod_actions mediumtext(16777215) NOT NULL DEFAULT ''
);



COMMIT;