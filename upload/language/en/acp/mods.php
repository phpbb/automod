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
	'ADDITIONAL_CHANGES'	=> 'Available Changes',
	'AUTHOR_EMAIL'			=> 'Author Email',
	'AUTHOR_INFORMATION'	=> 'Author Information',
	'AUTHOR_NAME'			=> 'Author Name',
	'AUTHOR_NOTES'			=> 'Author Notes',
	'AUTHOR_URL'			=> 'Author URL',

	'CAT_INSTALL_MODMANAGER'	=> 'MOD Manager',
	'CHANGE_DATE'	=> 'Release Date',
	'CHANGE_VERSION'=> 'Version Number',
	'CHANGES'		=> 'Changes',

	'DIY_INSTRUCTIONS'	=> 'Do It Yourself Instructions',
	'DESCRIPTION'	=> 'Description',
	'DETAILS'		=> 'Details',

	'ERROR'			=> 'Error',

	'FILE_EDITS'		=> 'File edits',	
	'FILE_MISSING'		=> 'Cannot locate file',
	'FILE_TYPE'			=> 'Compressed File Type',
	'FILE_TYPE_EXPLAIN'	=> 'This is only valid with the “Compressed File Download” write method',
	'FIND'				=> 'Find',
	'FIND_MISSING'		=> 'Cannot locate find string',
	'FTP_INFORMATION'	=> 'FTP Information',

	'INSTALL_MOD'		=> 'Install this MOD',
	'INSTALLED'			=> 'MOD installed',
	'INSTALLED_EXPLAIN'	=> 'Your MOD has been installed! Here you can view some of the results from the installation. Please note any errors, and seek support at <a href="http://www.phpbb.com">phpBB.com</a>',
	'INSTALLED_MODS'	=> 'Installed MODs',
	'INSTALLING'		=> 'MOD Manager Installing...',
	'INSTALLATION_SUCCESSFUL'	=> 'MOD Manager Installed successfully! Please remove this <b>install/</b> directory.',
	'INVALID_MOD_INSTRUCTION'	=> 'This MOD has an invalid instruction, or an in-line find operation failed.',

	'MOD_CONFIG'				=> 'MOD Manager Configuration',
	'MOD_DETAILS'				=> 'MOD Details',
	'MOD_DETAILS_EXPLAIN'		=> 'Here you can view all known information about the MOD you selected.',
	'MOD_MANAGER'				=> 'MOD Manager',
	'MOD_NAME'					=> 'MOD Name',
	'MOD_OPEN_FILE_FAIL'		=> 'MODs Manager was unable to open %s.',
	'MODMANAGER_INSTALLATION'	=> 'MOD Manager Installation',
	'MODMANAGER_INSTALLATION_EXPLAIN'	=> 'Welcome to the MOD Manager Installation. The installer will perform the following steps, and you will need the following information... bleh. Please select a role to apply MOD manager access to, then click install to proceed.',

	'MODS_EXPLAIN'				=> '<p>Here you can manage the available MODs on your board. MODs allow you to customize your board by automatically installing modifications produced by the phpBB community. For further information on MODs and the MOD Manager please visit the <a href="http://www.phpbb.com/mods">phpBB website</a>.</p>',
	'MODS_FTP_FAIL'				=> 'MODs Manager was unable to connect to your FTP server.  The error was %s',
	'MODS_SETUP_INCOMPLETE'		=> 'A problem was found with your configuration, and the MODs Manager cannot operate.  This should only occur when settings (e.g.FTP username) have changed, and can be corrected in the MODs Manager configuration page.',

	'NAME'		=> 'Name',
	'NEW_FILES'		=> 'New Files',
	'NO_INSTALLED_MODS'		=> 'No installed MODs detected',
	'NO_UNINSTALLED_MODS'	=> 'No uninstalled MODs detected',	

	'ORIGINAL'	=> 'Original',

	'PATH'					=> 'Path',	
	'PRE_INSTALL'			=> 'Preparing to Install',
	'PRE_INSTALL_EXPLAIN'	=> 'Here you can preview all the modifications to be made to your board, before they are carried out. <strong>WARNING!</strong>, once accepted, your phpBB base files will be edited and database alterations may occur. However, if the install is unsuccessful, assuming you can access the MOD manager, you will be given the option to restore to this point.',
	'PRE_UNINSTALL'			=> 'Preparing to Uninstall',
	'PRE_UNINSTALL_EXPLAIN'	=> 'Here you can preview all the modifications to be made to your board, in order to uninstall the MOD. <strong>WARNING!</strong>, once accepted, your phpBB base files will be edited and database alterations may occur. Also, this process uses reversing techniques that may not be 100% accurate. However, if the uninstall is unsuccessful, assuming you can access the MOD manager, you will be given the option to restore to this point.',

	'REMOVING_FILES'	=> 'Files to be removed',
	'RETURN_MODS'		=> 'Return to the MOD Manager',
	'REVERSE'			=> 'Reverse',


	'SOURCE'		=> 'Source',
	'SQL_QUERIES'	=> 'SQL Queries',
	'STATUS'		=> 'Status',
	'SUCCESS'		=> 'Success',

	'TARGET'		=> 'Target',

	'UNKNOWN_QUERY_REVERSE' => 'Unknown reverse query',
	'UNINSTALL'				=> 'Uninstall',
	'UNINSTALLED'			=> 'MOD uninstalled',
	'UNINSTALLED_MODS'		=> 'Uninstalled MODs',
	'UNINSTALLED_EXPLAIN'	=> 'Your MOD has been uninstalled! Here you can view some of the results from the uninstallation. Please note any errors, and seek support at <a href="http://www.phpbb.com">phpBB.com</a>.',

	'VERSION'		=> 'Version',

	'WRITE_METHOD'			=> 'Write Method',
	'WRITE_METHOD_DIRECT'	=> 'Direct',
	'WRITE_METHOD_EXPLAIN'	=> 'You can set a preferred method to write files.  If the setting you choose cannot be used on your web server, you will be prompted.  The most compatible option is “Compressed File Download”.',
	'WRITE_METHOD_FTP'		=> 'FTP',
	'WRITE_METHOD_MANUAL'	=> 'Compressed File Download',
));

?>