#
# $Id$
#

BEGIN TRANSACTION;

# Table: 'phpbb_mods'
CREATE TABLE phpbb_mods (
	mod_id INTEGER PRIMARY KEY NOT NULL ,
	mod_active INTEGER UNSIGNED NOT NULL DEFAULT '0',
	mod_time INTEGER UNSIGNED NOT NULL DEFAULT '0',
	mod_dependencies mediumtext(16777215) NOT NULL DEFAULT '',
	mod_name text(65535) NOT NULL DEFAULT '',
	mod_description text(65535) NOT NULL DEFAULT '',
	mod_version varchar(25) NOT NULL DEFAULT '',
	mod_author_notes text(65535) NOT NULL DEFAULT '',
	mod_author_name text(65535) NOT NULL DEFAULT '',
	mod_author_email text(65535) NOT NULL DEFAULT '',
	mod_author_url text(65535) NOT NULL DEFAULT '',
	mod_actions mediumtext(16777215) NOT NULL DEFAULT '',
	mod_languages text(65535) NOT NULL DEFAULT '',
	mod_template text(65535) NOT NULL DEFAULT '',
	mod_path text(65535) NOT NULL DEFAULT ''
);



COMMIT;