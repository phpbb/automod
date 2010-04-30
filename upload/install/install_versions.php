<?php
/**
*
* @package automod
* @version $Id$
* @copyright (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
*
*/

$versions = array(

	// Version 1.0.0
	'1.0.0-b1'	=> array(
		// add permission settings
		'permission_add' => array(
			array('a_mods', true),
		),

		'module_add'	=> array(
			array('acp', '', $cat_module_data), // root "AutoMOD" module
			array('acp', 'ACP_CAT_MODS', $parent_module_data), // child "AutoMOD" module
			array('acp', 'ACP_MODS', $front_module_data),
			array('acp', 'ACP_MODS', $config_module_data),
		),

		'table_add'		=> array(
			array('phpbb_mods', $schema_data),
		),

		'config_add'	=> array(
	         array('ftp_method', 0),
	         array('ftp_host', ''),
	         array('ftp_username', ''),
	         array('ftp_root_path', ''),
	         array('ftp_port', '21'),
	         array('ftp_timeout', '60'),
	         array('write_method', WRITE_DIRECT),
	         array('compress_method', '.zip'),
		),
	),

	'1.0.0-b2'	=> array(
		'config_add'	=> array(
			array('preview_changes', false),
			array('am_file_perms', '0644'),
			array('am_dir_perms', '0755'),
		),
	),
	'1.0.0-RC1'	=> array(),
	'1.0.0-RC2' => array(),
	'1.0.0-RC3'	=> array(),
	'1.0.0-RC4' => array(),
);

return $versions;

?>
