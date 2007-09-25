#
# $Id$
#

# Table: 'phpbb_mods'
CREATE TABLE phpbb_mods (
	mod_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	mod_active tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
	mod_time int(11) UNSIGNED DEFAULT '0' NOT NULL,
	mod_dependencies text NOT NULL,
	mod_name varchar(255) DEFAULT '' NOT NULL,
	mod_description text NOT NULL,
	mod_version varchar(100) DEFAULT '' NOT NULL,
	mod_author_notes text NOT NULL,
	mod_author_name varchar(255) DEFAULT '' NOT NULL,
	mod_author_email varchar(255) DEFAULT '' NOT NULL,
	mod_author_url varchar(255) DEFAULT '' NOT NULL,
	mod_actions mediumtext NOT NULL
) CHARACTER SET `utf8` COLLATE `utf8_bin`;


