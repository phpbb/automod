<?php
/**
*
* @package mod_manager
* @version $Id: functions_admin.php,v 1.254 2007/11/17 12:14:27 acydburn Exp $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

function test_ftp_connection($method, &$test_ftp_connection, &$test_connection)
{
	global $phpbb_root_path, $phpEx;
	
	$transfer = new $method(request_var('host', ''), request_var('username', ''), request_var('password', ''), request_var('root_path', ''), request_var('port', ''), request_var('timeout', ''));
	
	$test_connection = $transfer->open_session();

	// Make sure that the directory is correct by checking for the existence of common.php
	if ($test_connection === true)
	{
		// Check for common.php file
		if (!$transfer->file_exists($phpbb_root_path, 'common.' . $phpEx))
		{
			$test_connection = 'ERR_WRONG_PATH_TO_PHPBB';
		}
	}

	$transfer->close_session();

	// Make sure the login details are correct before continuing
	if ($test_connection !== true)
	{
		$test_ftp_connection = true;
	}
	
	return;
}

/**
* Helper function
* Runs basename() on $path, then trims the extension from it
* @param string $path - path to be basenamed
*/
function core_basename($path)
{
	$path = basename($path);
	return substr($path, 0, strrpos($path, '.'));
}

?>