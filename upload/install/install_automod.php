<?php
/**
*
* @package automod
* @version $Id$
* @copyright (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
*
*/


/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_transfer.'.$phpEx);
include($phpbb_root_path . 'includes/functions_mods.'.$phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('install', 'acp/mods'));



if ($user->data['user_type'] != USER_FOUNDER)
{
	trigger_error('NOT_AUTHORISED');
}

$mode = request_var('mode', '');
$sub = request_var('sub', 'intro');
$current_version = '1.0.0-b1';
$page_title = $user->lang['AUTOMOD_INSTALLATION'];

if (isset($config['automod_version']) && $sub == 'intro')
{
	if (version_compare($config['automod_version'], $current_version, '<='))
	{
		trigger_error('AUTOMOD_CANNOT_INSTALL_OLD_VERSION');
	}
}

$template->set_custom_template($phpbb_root_path . 'adm/style', 'admin');

$method = basename(request_var('method', ''));
if (!$method || !class_exists($method))
{
	$method = 'ftp';
	$methods = transfer::methods();

	if (!in_array('ftp', $methods))
	{
		$method = $methods[0];
	}
}

$test_connection = false;
$test_ftp_connection = request_var('test_connection', '');
if (!empty($test_ftp_connection))
{
	test_ftp_connection($method, $test_ftp_connection, $test_connection);

	// Make sure the login details are correct before continuing
	if ($test_connection !== true || !empty($test_ftp_connection))
	{
		$sub = 'intro';
		$test_ftp_connection = true;
	}
}

switch ($sub)
{
	case 'intro':
		$can_proceed = true;

		if (!is_readable($phpbb_root_path . 'index.'.$phpEx))
		{
			$template->assign_vars('ROOT_NOT_READABLE', true);
			$can_proceed = false;
		}
		if (!is_writable($phpbb_root_path . 'store/'))
		{
			$template->assign_var('STORE_NOT_WRITABLE', true);
			$can_proceed = false;
		}

		$u_action = append_sid($phpbb_root_path . 'install/install_automod.'.$phpEx, (($can_proceed) ? '&amp;sub=create_table' : '&amp;sub=intro'));

		$template->assign_vars(array(
			'S_OVERVIEW'		=> true,
			'TITLE'				=> $user->lang['AUTOMOD_INSTALLATION'],
			'BODY'				=> $user->lang['AUTOMOD_INSTALLATION_EXPLAIN'],
			'L_SUBMIT'			=> $user->lang['NEXT_STEP'],
			'U_ACTION'			=> $u_action,
		));

		if (!is_writable($phpbb_root_path))
		{
			$s_hidden_fields = build_hidden_fields(array('method' => $method));

			$page_title = 'SELECT_FTP_SETTINGS';

			if (!class_exists($method))
			{
				trigger_error('Method does not exist.', E_USER_ERROR);
			}

			$requested_data = call_user_func(array($method, 'data'));
			foreach ($requested_data as $data => $default)
			{
				$template->assign_block_vars('data', array(
					'DATA'		=> $data,
					'NAME'		=> $user->lang[strtoupper($method . '_' . $data)],
					'EXPLAIN'	=> $user->lang[strtoupper($method . '_' . $data) . '_EXPLAIN'],
					'DEFAULT'	=> (!empty($_REQUEST[$data])) ? request_var($data, '') : $default
				));
			}

			$template->assign_vars(array(
				'S_CONNECTION_SUCCESS'		=> ($test_ftp_connection && $test_connection === true) ? true : false,
				'S_CONNECTION_FAILED'		=> ($test_ftp_connection && $test_connection !== true) ? true : false,
				'ERROR_MSG'					=> ($test_ftp_connection && $test_connection !== true) ? $user->lang[$test_connection] : '',

				'S_FTP_UPLOAD'		=> true,
				'UPLOAD_METHOD'		=> $method,
				'S_HIDDEN_FIELDS'	=> $s_hidden_fields)
			);
		}
	break;

	case 'create_table':
		add_config($mode, $sub);
		perform_sql($mode, $sub);
		add_modules($mode, $sub);

		// Reset cache so we can actualy see the lovely new tab in the ACP
		$cache->purge();
	break;

	case 'final':
		$template->assign_vars(array(
			'S_FINAL'		=> true,
			'TITLE'			=> $user->lang['STAGE_FINAL'],
			'L_INDEX'		=> $user->lang['INDEX'],
			'L_INSTALLATION_SUCCESSFUL'	=> $user->lang['INSTALLATION_SUCCESSFUL'],
			'U_INDEX'		=> append_sid("{$phpbb_root_path}index.$phpEx"),
			'U_ACP_INDEX'	=> append_sid("{$phpbb_root_path}adm/index.$phpEx"),
		));
	break;
}

$template->set_filenames(array(
	'body'	=> 'install_mod.html',
));

page_header($page_title, false);
page_footer();


function add_config($mode, $sub)
{
	global $current_version, $config;

	$data = get_submitted_data();

	// we should have some config variables from the previous step
	set_config('ftp_method',	$data['method']);
	set_config('ftp_host',		$data['host']);
	set_config('ftp_username',	$data['username']);
	set_config('ftp_root_path', $data['root_path']);
	set_config('ftp_port',		$data['port']);
	set_config('ftp_timeout',	$data['timeout']);
	set_config('write_method',	(!empty($data['method'])) ? WRITE_FTP : WRITE_DIRECT);
	set_config('compress_method', '.tar');
	set_config('automod_version', $current_version);
}

function perform_sql($mode, $sub)
{
	global $template, $phpbb_root_path, $phpEx, $language, $db, $user, $dbms, $table_prefix;

	$page_title = $user->lang['STAGE_CREATE_TABLE'];

	$template->assign_vars(array(
		'S_CREATE_TABLES'	=> true,
		'TITLE'				=> $user->lang['CREATE_TABLE'],
		'BODY'				=> $user->lang['CREATE_TABLE_EXPLAIN'],
		'L_SUBMIT'			=> $user->lang['NEXT_STEP'],
		'U_ACTION'			=> append_sid($phpbb_root_path . 'install/install_automod.'.$phpEx, "?sub=final"),
	));

	include($phpbb_root_path . 'includes/functions_install.'.$phpEx);
	$available_dbms = get_available_dbms();

	// this is borrowed from the main phpBB installer, credit to the core phpBB Developers
	// If mysql is chosen, we need to adjust the schema filename slightly to reflect the correct version. ;)
	if ($dbms == 'mysql')
	{
		if (version_compare($db->sql_server_info(true), '4.1.3', '>='))
		{
			$available_dbms[$dbms]['SCHEMA'] .= '_41';
		}
		else
		{
			$available_dbms[$dbms]['SCHEMA'] .= '_40';
		}
	}

	// Ok we have the db info go ahead and read in the relevant schema
	// and work on building the table
	$dbms_schema = $phpbb_root_path . 'install/schemas/automod/' . $available_dbms[$dbms]['SCHEMA'] . '_schema.sql';

	// How should we treat this schema?
	$remove_remarks = $available_dbms[$dbms]['COMMENTS'];
	$delimiter = $available_dbms[$dbms]['DELIM'];

	$sql_query = @file_get_contents($dbms_schema);

	$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);

	$remove_remarks($sql_query);

	$sql_query = split_sql_file($sql_query, $delimiter);

	foreach ($sql_query as $sql)
	{
		$db->sql_query($sql);
	}
	// end borrow from phpBB core
}

function add_modules($mode, $sub)
{
	global $db, $phpbb_root_path, $phpEx;

	if (!class_exists('acp_modules'))
	{
		include($phpbb_root_path . 'includes/acp/acp_modules.'.$phpEx);
		$module = new acp_modules();
	}

	$sql = 'SELECT module_id FROM ' . MODULES_TABLE . "
		WHERE module_langname = 'ACP_CAT_MODS'";
	$result = $db->sql_query($sql);

	if (!$db->sql_fetchrow($result))
	{
		// Insert Category Module
		$cat_module_data = array(
			'module_enabled'	=> 1,
			'module_display'	=> 1,
			'module_class'		=> 'acp',
			'parent_id'			=> 0,
			'module_langname'	=> 'ACP_CAT_MODS',
			'module_auth'		=> 'acl_a_mods',
		);

		$module->update_module_data($cat_module_data, true);

		// Insert Parent Module
		$parent_module_data = array(
			'module_enabled'	=> 1,
			'module_display'	=> 1,
			'module_class'		=> 'acp',
			'parent_id'			=> $cat_module_data['module_id'],
			'module_langname'	=> 'ACP_MODS',
		);

		$module->update_module_data($parent_module_data, true);

		// Frontend Module
		$front_module_data = array(
			'module_enabled'	=> 1,
			'module_display'	=> 1,
			'module_class'		=> 'acp',
			'parent_id'			=> $parent_module_data['module_id'],
			'module_langname'	=> 'ACP_AUTOMOD',

			'module_basename'	=> 'mods',
			'module_mode'		=> 'frontend',
			'module_auth'		=> 'acl_a_mods',
		);

		$module->update_module_data($front_module_data, true);

		// Config Module
		$config_module_data = array(
			'module_enabled'	=> 1,
			'module_display'	=> 1,
			'module_class'		=> 'acp',
			'parent_id'			=> $parent_module_data['module_id'],
			'module_langname'	=> 'ACP_AUTOMOD_CONFIG',

			'module_basename'	=> 'mods',
			'module_mode'		=> 'config',
			'module_auth'		=> 'acl_a_mods',
		);

		$module->update_module_data($config_module_data, true);

		include($phpbb_root_path . 'includes/acp/auth.'.$phpEx);
		$auth_admin = new auth_admin();
		
		// Add permissions
		$auth_admin->acl_add_option(array(
		    'local'      => array(),
		    'global'   => array('a_mods'),
		));

		$sql = 'SELECT auth_option_id FROM ' . ACL_OPTIONS_TABLE . "
			WHERE auth_option = 'a_mods'";
		$result = $db->sql_query($sql);
		$auth_option_id = $db->sql_fetchfield('auth_option_id');
		$db->sql_freeresult($result);

		$sql = 'SELECT role_id FROM ' . ACL_ROLES_TABLE . "
			WHERE role_name = 'ROLE_ADMIN_FULL'";
		$result = $db->sql_query($sql);
		$role_id = (int) $db->sql_fetchfield('role_id');
		$db->sql_freeresult($result);

		// Give the wanted role its option
		$roles_data = array(
			'role_id'			=> $role_id,
			'auth_option_id'	=> $auth_option_id,
			'auth_setting'		=> 1,
		);

		$sql = 'INSERT INTO ' . ACL_ROLES_DATA_TABLE . ' ' . $db->sql_build_array('INSERT', $roles_data);
		$db->sql_query($sql);
	}
}

/**
* Get submitted data
*/
function get_submitted_data()
{
	return array(
		'method'	=> request_var('method', ''),
		'host'		=> request_var('host', ''),
		'username'	=> request_var('username', ''),
		'root_path'	=> request_var('root_path', ''),
		'port'		=> request_var('port', 21),
		'timeout'	=> request_var('timeout', 10),
	);
}

?>