<?php
/** 
*
* acp_packages [English]
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

// Banning
$lang = array_merge($lang, array(
	'PACKAGES_EXPLAIN'	=> '<p>Here you can manage the available packages on your board. Packages allow you to customize your board by automatically installing modifications produced within the phpBB community. For further information on Packages and the Package Manager please visit the <a href="http://www.phpbb.com/">phpBB website</a>.</p>',
	
	'NAME'			=> 'Name',
	'INFORMATION'	=> 'Information',
	'ACTIONS'		=> 'Actions',
	
	'INSTALLED_PACKAGES'		=> 'Installed Packages',
	'NO_INSTALLED_PACKAGES'		=> 'No installed packages detected',
	'UNINSTALLED_PACKAGES'		=> 'Uninstalled Packages',
	'NO_UNINSTALLED_PACKAGES'	=> 'No uninstalled packages detected',
	
	'PACKAGE_INFORMATION'			=> 'Package Information',
	'PACKAGE_INFORMATION_EXPLAIN'	=> 'Here you can view all known information about the package you selected.',
	
	'PATH'			=> 'Path',
	'VERSION'		=> 'Version',
	'INSTALL_TIME'	=> 'Install time',
	'DESCRIPTION'	=> 'Description',
	
	'AUTHOR_INFORMATION'	=> 'Author Information',
	'AUTHOR_NOTES'			=> 'Author Notes',
	'AUTHOR_NAME'			=> 'Author Name',
	'AUTHOR_EMAIL'			=> 'Author Email',
	'AUTHOR_URL'			=> 'Author URL',
	
	'PRE_INSTALL'			=> 'Preparing to Install',
	'PRE_INSTALL_EXPLAIN'	=> 'Here you can preview all the modifications to be made to your board, before they are carried out. <strong>WARNING!</strong>, once accepted, your phpBB base files will be edited and database alterations may occur. However, if the install is unsuccessful, assuming you can access the package manager, you will be given the option to restore to this point.',

	'UNINSTALL'				=> 'Uninstall',
	'PRE_UNINSTALL'			=> 'Preparing to Uninstall',
	'PRE_UNINSTALL_EXPLAIN'	=> 'Here you can preview all the modifications to be made to your board, in order to uninstall the package. <strong>WARNING!</strong>, once accepted, your phpBB base files will be edited and database alterations may occur. Also, this process uses reversing techniques that may not be 100% accurate. However, if the uninstall is unsuccessful, assuming you can access the package manager, you will be given the option to restore to this point.',

	'NEW_FILES'		=> 'New Files',
	'SQL_QUERIES'	=> 'SQL Queries',
	'SOURCE'		=> 'Source',
	'TARGET'		=> 'Target',
	'FILE_EDITS'	=> 'File edits',
	'FIND'			=> 'Find',

	'INSTALLED'			=> 'Package installed',
	'INSTALLED_EXPLAIN'	=> 'Your package has been installed! Here you can view some of the results from the installation. Please note any errors, and seek support at <a href="http://www.phpbb.com">phpBB.com</a>',
	
	'UNINSTALLED'			=> 'Package uninstalled',
	'UNINSTALLED_EXPLAIN'	=> 'Your package has been uninstalled! Here you can view some of the results from the uninstallation. Please note any errors, and seek support at <a href="http://www.phpbb.com">phpBB.com</a>.',

	'RETURN_PACKAGES'		=> 'Return to the Package Manager',
	'RETURN_RESTORE_POINT'	=> 'Return to the restore point',

	'SUCCESS'		=> 'Success',
	'ERROR'			=> 'Error',
	'STATUS'		=> 'Status',
	
	'FILE_MISSING'	=> 'Cannot locate file',
	'FIND_MISSING'	=> 'Cannot locate find string',
	
	'REMOVING_FILES'	=> 'Files to be removed',
	'UNKNOWN_QUERY_REVERSE' => 'Unknown reverse query',

	'ORIGINAL'	=> 'Original',
	'REVERSE'	=> 'Reverse',
));

?>