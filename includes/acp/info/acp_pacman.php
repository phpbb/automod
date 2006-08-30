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
class acp_pacman_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_pacman',
			'title'		=> 'ACP_PACMAN',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'intro'		=> array('title' => 'ACP_PACMAN', 'auth' => 'acl_a_pacman', 'cat' => array('ACP_PACMAN_GENERAL')),
				'manage'	=> array('title' => 'ACP_PACMAN_MANAGE', 'auth' => 'acl_a_pacman', 'cat' => array('ACP_PACMAN_PACKAGES')),
				'browse'	=> array('title' => 'ACP_PACMAN_BROWSE', 'auth' => 'acl_a_pacman', 'cat' => array('ACP_PACMAN_PACKAGES')),
				'upload'	=> array('title' => 'ACP_PACMAN_UPLOAD', 'auth' => 'acl_a_pacman', 'cat' => array('ACP_PACMAN_PACKAGES')),
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