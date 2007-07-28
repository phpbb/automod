<?php
/** 
*
* @package acp
* @version $Id$
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_mods_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_mods',
			'title'		=> 'ACP_CAT_MODS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'frontend'		=> array('title' => 'ACP_MOD_MANAGEMENT', 'auth' => 'acl_a_mods', 'cat' => array('ACP_MODS_GENERAL')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>