<?php
/** 
*
* acp_pacman [English]
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
	'PACMAN_EXPLAIN'	=> '
		<p>Package Manager is an extension to phpBB that will allow you to customize your board by automatically installing modifications produced within the community. These modifications are bundled into "packages" for ease of use.</p>

		<h2>Managing Installations</h2>
		<p>You can have total control over any packages on your phpBB board, and have the option to uninstall or update a package at any time.</p>

		<h2>Browsing Packages</h2>
		<p>All packages released within the community have been approved by the phpBB team. You can browse all the available packages online, or any stored locally, and from there, you can install any you choose.</p>

		<h2>Uploading a Package</h2>
		<p>If you have your own packages stored locally, or have a URL to a package, you can upload it for installation, but beware!</p>


		<br />

		<p>For further information on Packages and the Package Manager please visit the <a href="http://www.phpbb.com/">phpBB website</a>.</p>
	',
	
	'MANAGE_EXPLAIN'	=> 'Here you can manage any packages that are currently installed on your phpBB board.',
	'BROWSE_EXPLAIN'	=> 'This page allows you to view any packages, both on your server and on the phpBB server, available for installation.',
	'UPLOAD_EXPLAIN'	=> 'This page allows you to upload your own package to your phpBB for local installation.',

	'NAME'	=> 'Name',
	'DESC'	=> 'Description',
	'CAT'	=> 'Category',

	'AUTHOR_NOTES'		=> 'Author Notes',
	'NO_AUTHOR_NOTES'	=> 'No Author Notes.',
	'SQL_STATEMENTS'		=> 'SQL statements',
	'NO_SQL_STATEMENTS'	=> 'No SQL statements to be processed.',
	'NEW_FILES'			=> 'New Files',
	'NO_NEW_FILES'		=> 'No new files to be added.',
	'MODIFICTIONS'		=> 'Modifications',
	'NO_MODIFICATIONS'	=> 'No modifications to be made.',
	'FIND'				=> 'FIND',
	'FINISH'			=> 'Finish',

	'INSTALL'	=> 'Install',
	'FROM_URL'	=> 'From URL',
	'FROM_LOCAL'	=> 'From Local',
	'FROM_PHPBB'	=> 'From phpBB.com',
	'SOURCE'		=> 'Source',
	'TARGET'		=> 'Target',
	'NO_LOCAL'	=> 'No Packages Available Locally.',

	'PACKAGE_UPLOADED'	=> 'Package Uploaded Successfully.',
	'PACKAGE_DELETED'	=> 'Package Deleted Successfully.',
	'PACKAGE_REMOVED'	=> 'Package Removed Successfully.',
	'PACKAGE_INSTALLED'	=> 'Package Installed Successfully!',
	'REMOVE_PACKAGE'		=> 'Removing Package...',
	'REMOVE_PACKAGE_CONFIRM'		=> 'Are you sure you want to Remove this package?',
	'DELETE_PACKAGE'		=> 'Deleting Package...',
	'DELETE_PACKAGE_CONFIRM'		=> 'Are you sure you want to Delete this package?',
	
	'RESULTS'			=> 'Results',
	'RESULTS_EXPLAIN'	=> 'This page allows you to view the processed actions, before completeing the installation. Last chance!',
	
	'PREPARE_INSTALL'			=> 'Preparing to Install',
	'PREPARE_INSTALL_EXPLAIN'	=> 'This page lets you preview all the modifications to be made to your board, before any are carried out.',
));

?>