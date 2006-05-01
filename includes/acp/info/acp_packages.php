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
class acp_packages_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_packages',
			'title'		=> 'ACP_PACKAGES',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'upload'		=> array('title' => 'ACP_PACKAGES_UPLOAD', 'auth' => ''),
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