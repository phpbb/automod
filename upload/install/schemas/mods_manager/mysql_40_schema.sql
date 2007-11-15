#
# $Id$
#

# Table: 'phpbb_mods'
CREATE TABLE phpbb_mods (
	mod_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	mod_active tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
	mod_time int(11) UNSIGNED DEFAULT '0' NOT NULL,
	mod_dependencies mediumblob NOT NULL,
	mod_name blob NOT NULL,
	mod_description blob NOT NULL,
	mod_version varbinary(25) DEFAULT '' NOT NULL,
	mod_author_notes blob NOT NULL,
	mod_author_name blob NOT NULL,
	mod_author_email blob NOT NULL,
	mod_author_url blob NOT NULL,
	mod_actions mediumblob NOT NULL,
	mod_languages blob NOT NULL,
	mod_templates blob NOT NULL,
	PRIMARY KEY (mod_id)
);


