<?php
/**
*
* @package automod
* @version $Id$
* @copyright (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
*
*
*
*/

if (!defined('IN_INSTALL'))
{
	// Someone has tried to access the file direct. This is not a good idea, so exit
	exit;
}

if (!empty($setmodules))
{
	// If phpBB is not installed we do not include this module
	if (@file_exists($phpbb_root_path . 'config.' . $phpEx) && !@file_exists($phpbb_root_path . 'cache/install_lock'))
	{
		include_once($phpbb_root_path . 'config.' . $phpEx);

		if (!defined('PHPBB_INSTALLED'))
		{
			return;
		}
	}
	else
	{
		return;
	}

	global $language, $lang, $user;
	include($phpbb_root_path . 'language/' . $language . '/acp/mods.' . $phpEx);
	$user->lang = array_merge($user->lang, $lang);

	$module[] = array(
		'module_type'		=> 'install',
		'module_title'		=> 'INSTALL_AUTOMOD',
		'module_filename'	=> substr(basename(__FILE__), 0, -strlen($phpEx)-1),
		'module_order'		=> 30,
		'module_subs'		=> '',
		'module_stages'		=> array('INTRO', 'CREATE_TABLE', 'FINAL'),
		'module_reqs'		=> ''
	);
}

/**
* Installation
* @package install
*/
class install_mod extends module
{
	function install_mod(&$p_master)
	{
		$this->p_master = &$p_master;
	}

	function main($mode, $sub)
	{
		global $template, $phpEx, $phpbb_root_path, $user, $language, $db, $config, $cache, $auth;

		//include($phpbb_root_path . 'language/' . $language . '/acp/permissions.' . $phpEx);

		require("{$phpbb_root_path}config.$phpEx");
		require("{$phpbb_root_path}includes/constants.$phpEx");
		require("{$phpbb_root_path}includes/db/$dbms.$phpEx");
		require("{$phpbb_root_path}includes/functions_convert.$phpEx");
		require("{$phpbb_root_path}includes/functions_mods.$phpEx");
		include_once("{$phpbb_root_path}includes/functions_transfer.$phpEx");

		$db = new $sql_db();
		$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, true);
		unset($dbpasswd);

		$config = array();

		$sql = 'SELECT config_name, config_value
			FROM ' . CONFIG_TABLE;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$config[$row['config_name']] = $row['config_value'];
		}
		$db->sql_freeresult($result);

		// Force template recompile
		$config['load_tplcompile'] = 1;

		// First of all, init the user session
		$user->session_begin();
		$auth->acl($user->data);

		$user->setup(array('install', 'acp/mods'));

		// Set custom template again. ;)
		$template->set_custom_template('../adm/style', 'admin');

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
		if (!empty($test_ftp_connection) || (!is_writeable($phpbb_root_path) && $sub == 'file_edits'))
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
				$template->assign_vars(array(
					'S_OVERVIEW'		=> true,
					'TITLE'				=> $user->lang['AUTOMOD_INSTALLATION'],
					'BODY'				=> $user->lang['AUTOMOD_INSTALLATION_EXPLAIN'],
					'L_SUBMIT'			=> $user->lang['NEXT_STEP'],
					'U_ACTION'			=> $this->p_master->module_url . "?mode=$mode&amp;sub=create_table&amp;language=$language",
				));

				if (!is_writeable($phpbb_root_path))
				{
					$s_hidden_fields = build_hidden_fields(array('method' => $method));

					$this->page_title = 'SELECT_FTP_SETTINGS';

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
				$this->add_config($mode, $sub);
				$this->perform_sql($mode, $sub);
				$this->add_modules($mode, $sub);

				// Reset cache so we can actualy see the lovely new tab in the ACP
				$cache->purge();
			break;

			case 'final':
				$template->assign_vars(array(
					'S_FINAL'		=> true,
					'TITLE'			=> $user->lang['STAGE_FINAL'],
					'L_INDEX'		=> $user->lang['INDEX'],
					'L_INSTALLATION_SUCCESSFUL'	=> $user->lang['INSTALLATION_SUCCESSFUL'],
					'U_INDEX'		=> "{$phpbb_root_path}index.$phpEx",
				));
			break;
		}

		$this->tpl_name = 'install_mod';
	}

	function add_config($mode, $sub)
	{
		global $config;

		$data = $this->get_submitted_data();

		// we should have some config variables from the previous step
		set_config('ftp_method',	$data['method']);
		set_config('ftp_host',		$data['host']);
		set_config('ftp_username',	$data['username']);
		set_config('ftp_root_path', $data['root_path']);
		set_config('ftp_port',		$data['port']);
		set_config('ftp_timeout',	$data['timeout']);
		set_config('write_method',	(!empty($config['ftp_method'])) ? WRITE_FTP : WRITE_DIRECT);
		set_config('compress_method', 'tar');
	}

	function perform_sql($mode, $sub)
	{
		global $template, $phpbb_root_path, $phpEx, $language, $db, $user;

		$this->page_title = $user->lang['STAGE_CREATE_TABLE'];

		$template->assign_vars(array(
			'S_CREATE_TABLES'	=> true,
			'TITLE'				=> $user->lang['STAGE_CREATE_TABLE'],
			'BODY'				=> $user->lang['STAGE_CREATE_TABLE_EXPLAIN'],
			'L_SUBMIT'			=> $user->lang['NEXT_STEP'],
			'U_ACTION'			=> $this->p_master->module_url . "?mode=$mode&amp;sub=final&amp;language=$language",
		));

		$available_dbms = get_available_dbms();

		include($phpbb_root_path . 'config.' . $phpEx);

		// this is borrowed from the main phpBB installer, credit to the core phpBB Developers
		// If mysql is chosen, we need to adjust the schema filename slightly to reflect the correct version. ;)
		if ($dbms == 'mysql')
		{
			if (version_compare($db->mysql_version, '4.1.3', '>='))
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
		$dbms_schema = 'schemas/automod/' . $available_dbms[$dbms]['SCHEMA'] . '_schema.sql';

		// How should we treat this schema?
		$remove_remarks = $available_dbms[$dbms]['COMMENTS'];
		$delimiter = $available_dbms[$dbms]['DELIM'];

		$sql_query = @file_get_contents($dbms_schema);

		$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);

		$remove_remarks($sql_query);

		$sql_query = split_sql_file($sql_query, $delimiter);

		foreach ($sql_query as $sql)
		{
			if (!$db->sql_query($sql))
			{
				$error = $db->sql_error();
				$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
			}
		}
		// end borrow from phpBB core
	}

	function add_modules($mode, $sub)
	{
		global $db, $phpbb_root_path, $phpEx;

		include($phpbb_root_path . 'includes/acp/acp_modules.'.$phpEx);
		$module = new acp_modules();

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
}

?>