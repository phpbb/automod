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

global $table_prefix;
define('MODS_TABLE', $table_prefix . 'mods');

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

/**
* Helper function for matching languages
* This is a fairly dumb function because it ignores dialects.  But I have 
* not seen any MODs that specify more than one dialect of the same language
* @param string $user_language - ISO language code of the current user
* @param string $xml_language - ISO language code of the MODX tag
* @return bool Whether or not this is a match
*/
function match_language($user_language, $xml_language)
{
	return strtolower(substr($user_language, 0, 2)) == strtolower(substr($xml_language, 0, 2));
}

/**
* Easy method to grab localisable tags from the XML array
* @param $header - variable holding all relevant tag information
* @param $tagname - tag name to fetch
* @return $output - Localised contents of the tag in question
*/
function localise_tags($header, $tagname)
{
	global $user;

	$output = '';

	if (isset($header[$tagname]) && is_array($header[$tagname]))
	{
		foreach ($header[$tagname] as $i => $void)
		{
			if (!isset($header[$tagname][$i]['attrs']['LANG']))
			{
				// avoid notice...although, if we get here, MODX is invalid.
				continue;
			}

			if (match_language($user->data['user_lang'], $header[$tagname][$i]['attrs']['LANG']))
			{
				$output = isset($header[$tagname][$i]['data']) ? htmlspecialchars(trim($header[$tagname][$i]['data'])) : '';
			}
		}

		// If there was no language match, put something out there
		// This is probably fairly common for non-English users of the MODs Manager
		if (!$output)
		{
			$output = isset($header[$tagname][0]['data']) ? htmlspecialchars(trim($header[$tagname][0]['data'])) : '';
		}
	}

	if (!$output)
	{
		// Should never happen.  If it does, MOD is not valid MODX
		$output = isset($user->lang['UNKNOWN_MOD_' . $tagname]) ? $user->lang['UNKNOWN_MOD_' . $tagname] : 'UNKNOWN_MOD_' .$tagname;
	}

	return $output;
}

?>