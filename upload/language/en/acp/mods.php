<?php
/** 
*
* acp_mods [English]
*
* @package language
* @version $Id$
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE 
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine


$lang = array_merge($lang, array(
	'MOD_MANAGER'			=> 'MOD Manager',
	
	'CAT_INSTALL_MODMANAGER'			=> 'MOD Manager',
	'MODMANAGER_INSTALLATION'			=> 'MOD Manager Installation',
	'MODMANAGER_INSTALLATION_EXPLAIN'	=> 'Welcome to the MOD Manager Installation. The installer will preform the following steps, and you will need the following information... bleh. Please select a role to apply MOD manager access to, then click install to proceed.',
	'INSTALLING'						=> 'MOD Manager Installing...',
	'INSTALLATION_SUCCESSFUL'			=> 'MOD Manager Installed successfully! Please remove this <b>install/</b> directory.',
	
	'MODS_EXPLAIN'	=> '<p>Here you can manage the available MODs on your board. MODs allow you to customize your board by automatically installing modifications produced within the phpBB community. For further information on MODs and the MOD Manager please visit the <a href="http://www.phpbb.com/">phpBB website</a>.</p>',

	'NAME'		=> 'Name',
	'DETAILS'		=> 'Details',
	
	'INSTALLED_MODS'		=> 'Installed MODs',
	'NO_INSTALLED_MODS'		=> 'No installed MODs detected',
	'UNINSTALLED_MODS'		=> 'Uninstalled MODs',
	'NO_UNINSTALLED_MODS'	=> 'No uninstalled MODs detected',
	
	'MOD_DETAILS'			=> 'MOD Details',
	'MOD_DETAILS_EXPLAIN'	=> 'Here you can view all known information about the MOD you selected.',

	'PATH'		=> 'Path',
	'VERSION'		=> 'Version',
	'DESCRIPTION'	=> 'Description',
	
	'AUTHOR_INFORMATION'	=> 'Author Information',
	'AUTHOR_NOTES'			=> 'Author Notes',
	'AUTHOR_NAME'			=> 'Author Name',
	'AUTHOR_EMAIL'			=> 'Author Email',
	'AUTHOR_URL'			=> 'Author URL',
	
	'PRE_INSTALL'			=> 'Preparing to Install',
	'PRE_INSTALL_EXPLAIN'	=> 'Here you can preview all the modifications to be made to your board, before they are carried out. <strong>WARNING!</strong>, once accepted, your phpBB base files will be edited and database alterations may occur. However, if the install is unsuccessful, assuming you can access the MOD manager, you will be given the option to restore to this point.',

	'UNINSTALL'				=> 'Uninstall',
	'PRE_UNINSTALL'			=> 'Preparing to Uninstall',
	'PRE_UNINSTALL_EXPLAIN'	=> 'Here you can preview all the modifications to be made to your board, in order to uninstall the MOD. <strong>WARNING!</strong>, once accepted, your phpBB base files will be edited and database alterations may occur. Also, this process uses reversing techniques that may not be 100% accurate. However, if the uninstall is unsuccessful, assuming you can access the MOD manager, you will be given the option to restore to this point.',

	'NEW_FILES'		=> 'New Files',
	'SQL_QUERIES'	=> 'SQL Queries',
	'SOURCE'		=> 'Source',
	'TARGET'		=> 'Target',
	'FILE_EDITS'	=> 'File edits',
	'FIND'			=> 'Find',

	'INSTALLED'			=> 'MOD installed',
	'INSTALLED_EXPLAIN'	=> 'Your MOD has been installed! Here you can view some of the results from the installation. Please note any errors, and seek support at <a href="http://www.phpbb.com">phpBB.com</a>',
	
	'UNINSTALLED'			=> 'MOD uninstalled',
	'UNINSTALLED_EXPLAIN'	=> 'Your MOD has been uninstalled! Here you can view some of the results from the uninstallation. Please note any errors, and seek support at <a href="http://www.phpbb.com">phpBB.com</a>.',

	'RETURN_MODS'		=> 'Return to the MOD Manager',

	'SUCCESS'		=> 'Success',
	'ERROR'			=> 'Error',
	'STATUS'		=> 'Status',
	
	'FILE_MISSING'	=> 'Cannot locate file',
	'FIND_MISSING'	=> 'Cannot locate find string',
	
	'REMOVING_FILES'	=> 'Files to be removed',
	'UNKNOWN_QUERY_REVERSE' => 'Unknown reverse query',

	'ORIGINAL'	=> 'Original',
	'REVERSE'	=> 'Reverse',

	'DIY_INSTRUCTIONS'	=> 'Do It Yourself Instructions',
));

?>