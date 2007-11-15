#
# $Id$
#

# Table: 'phpbb_mods'
CREATE TABLE phpbb_mods (
	mod_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	mod_active tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
	mod_time int(11) UNSIGNED DEFAULT '0' NOT NULL,
	mod_dependencies blob NOT NULL,
	mod_name varbinary(255) DEFAULT '' NOT NULL,
	mod_description blob NOT NULL,
	mod_version varbinary(100) DEFAULT '' NOT NULL,
	mod_author_notes blob NOT NULL,
	mod_author_name varbinary(255) DEFAULT '' NOT NULL,
	mod_author_email varbinary(255) DEFAULT '' NOT NULL,
	mod_author_url varbinary(255) DEFAULT '' NOT NULL,
	mod_actions mediumblob NOT NULL,
	mod_languages varbinary(255) DEFAULT '' NOT NULL,
	mod_templates varbinary(255) DEFAULT '' NOT NULL
);


