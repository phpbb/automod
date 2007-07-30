<?php
/**
 * @package phpBB3
 * @copyright (c) 2007 eviL3
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpEx = substr(strrchr(__FILE__, '.'), 1);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

// Our SQL queries
$sql_ary = array();

$sql_ary[] = 'ALTER TABLE ' . USERS_TABLE . " ADD user_gender TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0'";

// Information about our MOD
$mod = array(
	'name'	=> 'Genders 0.1.3',
	'url'	=> 'http://phpbbmodders.net/',
);

// Language entries
$user->lang = array_merge($user->lang, array(
	'DB_UPDATE_CONFIRM'		=> 'Please confirm that you want to execute following SQL queries for the %s mod.',
	'DB_UPDATE_QUERY'		=> 'The query was executed successfully.',
	'DB_UPDATE_COMPLETED'	=> 'If you have any problems or the update script gave you an error, you can get support for %1$s at <a href="%2$s">%2$s</a>',
	'DB_UPDATE_DELETE_FILE'	=> 'Make sure you delete this file from your webserver!',
));

// Redirect if the user cancled the confirmation
if (isset($_POST['cancel']))
{
	redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
}

// No guests
if ($user->data['user_id'] == ANONYMOUS)
{
	login_box("{$phpbb_root_path}db_update.$phpEx");
}

// Founder only
if ($user->data['user_type'] != USER_FOUNDER)
{
	redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
}

// Confirm box
if (!confirm_box(true))
{
	confirm_box(false, sprintf($user->lang['DB_UPDATE_CONFIRM'], $mod['name']) . '<br /><br />' . str_replace("\n", '<br />', implode('<br />', $sql_ary)));
}

$sql_rows = '';

// Disable automatic sql errors
$db->sql_return_on_error(true);

// Loop through the sql array and execute queries
foreach ($sql_ary as $i => $sql)
{
	$result = $db->sql_query($sql);
	
	if (!$result)
	{
		$colour = '#FF0000';
		$error = $db->sql_error();
		$msg = $error['message'];
	}
	else
	{
		$colour = '#00AA00';
		$msg = $user->lang['DB_UPDATE_QUERY'];
	}
	$sql_rows .= '<tr><td style="padding:10px;">' . ($i + 1) . ')</td><td><span>' . str_replace("\n", '<br />', $sql) . ';<br /><strong style="color:' . $colour . ';">' . $msg . '</strong></span></td></tr>' . "\n";
}

// Re-enable automatic sql errors
$db->sql_return_on_error(false);

$sql_rows .= '<tr><td colspan="2" style="text-align:center;">' . sprintf($user->lang['DB_UPDATE_COMPLETED'], $mod['name'], $mod['url']) . '<hr /><strong>' . $user->lang['DB_UPDATE_DELETE_FILE'] . '</strong></td></tr>';

$html = '<table cellspacing="3" style="width: 100%;">' . $sql_rows . '</table>';

// Output
trigger_error($html);

?>