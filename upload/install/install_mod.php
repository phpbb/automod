<?php
/** 
*
* @mod mod_manager
* @version $Id$
* @copyright (c) 2007 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_INSTALL'))
{
	// Someone has tried to access the file direct. This is not a good idea, so exit
	exit;
}

if (!empty($setmodules))
{
	global $language, $lang;
	include($phpbb_root_path . 'language/' . $language . '/acp/mods.' . $phpEx);

	$module[] = array(
		'module_type'		=> 'install',
		'module_title'		=> 'INSTALL_MODMANAGER',
		'module_filename'	=> substr(basename(__FILE__), 0, -strlen($phpEx)-1),
		'module_order'		=> 30,
		'module_subs'		=> '',
		'module_stages'		=> array('INTRO', 'FILE_EDITS', 'CREATE_TABLE', 'FINAL'),
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
		global $lang, $template, $language, $phpbb_root_path, $phpEx, $db;

		// $user is not set up at this point
		include($phpbb_root_path . 'language/' . $language . '/acp/mods.' . $phpEx);
		include($phpbb_root_path . 'language/' . $language . '/acp/permissions.' . $phpEx);

		require($phpbb_root_path . 'config.' . $phpEx);
		require($phpbb_root_path . 'includes/constants.' . $phpEx);
		require($phpbb_root_path . 'includes/db/' . $dbms . '.' . $phpEx);
		require($phpbb_root_path . 'includes/functions_convert.' . $phpEx);

		$db = new $sql_db();
		$db->sql_connect($dbhost, $dbuser, $dbpasswd, $dbname, $dbport, false, true);
		unset($dbpasswd);

		switch ($sub)
		{
			case 'intro':
				$template->assign_vars(array(
					'S_OVERVIEW'		=> true,
					'TITLE'				=> $lang['MODMANAGER_INSTALLATION'],
					'BODY'				=> $lang['MODMANAGER_INSTALLATION_EXPLAIN'],
					'L_SUBMIT'			=> $lang['NEXT_STEP'],
					'U_ACTION'			=> $this->p_master->module_url . "?mode=$mode&amp;sub=file_edits&amp;language=$language",
				));
			break;

			/* requirements are not currently in use...I don't expect to bring them back, but just in case
			case 'requirements':
				$this->check_requirements($mode, $sub);
			break;
			*/

			case 'file_edits':
				$this->perform_edits($mode, $sub);
			break;

			/* advanced not currently in use.
			case 'advanced':
				$this->advanced_settings($mode, $sub);
			break;
			*/

			case 'create_table':
				$this->perform_sql($mode, $sub);
			break;

			case 'final':
				$template->assign_vars(array(
					'S_FINAL'		=> true,
					'TITLE'			=> $lang['STAGE_FINAL'],
					'L_INDEX'		=> $lang['INDEX'],
					'L_INSTALLATION_SUCCESSFUL'	=> $lang['INSTALLATION_SUCCESSFUL'],
					'U_INDEX'		=> "{$phpbb_root_path}index.$phpEx",
				));
			break;
		}

		$this->tpl_name = 'install_mod';
	}

	/**
	* Commented out until such a time as there are additional requirements for the Package Manager
	* 	
	function check_requirements($mode, $sub)
	{
		global $lang, $template, $phpbb_root_path, $phpEx, $language, $db;

		$this->page_title = $lang['REQUIREMENTS_TITLE'];

		$template->assign_vars(array(
			'S_REQUIREMENTS'	=> true,
			'TITLE'				=> $lang['REQUIREMENTS_TITLE'],
			'BODY'				=> $lang['REQUIREMENTS_EXPLAIN'],
			'L_SUBMIT'			=> $lang['NEXT_STEP'],
			'U_ACTION'			=> $this->p_master->module_url . "?mode=$mode&amp;sub=file_edits&amp;language=$language",
		));
	}
	*/

	function perform_edits($mode, $sub)
	{
		global $lang, $template, $phpbb_root_path, $phpEx, $language, $db, $config;

		// get the config, we don't want the cached config
		$sql = 'SELECT config_name, config_value
			FROM ' . CONFIG_TABLE;
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result))
		{
			$config[$row['config_name']] = $row['config_value'];
		}
		$db->sql_freeresult($result);

		// we should have some config variables from the previous step
		set_config('ftp_host',		request_var('ftp_host', ''));
		set_config('ftp_username',	request_var('ftp_username', ''));
		set_config('ftp_port',		request_var('ftp_password', ''));

		$this->page_title = $lang['FILE_EDITS'];

		// using some mods manager code in the installation :D
		include("{$phpbb_root_path}includes/editor.$phpEx");

		$editor = new editor($phpbb_root_path);

		$filename = "includes/constants.$phpEx";
		$find = '// Additional tables';
		$add = 'define(\'MODS_TABLE\',				$table_prefix . \'mods\');';

		$editor->open_file("includes/constants.$phpEx");
		$editor->add_string($find, $add, 'AFTER');
		$editor->close_file("includes/constants.$phpEx"); 

		$template->assign_vars(array(
			'S_FILE_EDITS'		=> true,
			//'TITLE'				=> $lang['MODMANAGER_INSTALLATION'],
			//'BODY'				=> $lang['MODMANAGER_INSTALLATION_EXPLAIN'],
			'L_SUBMIT'			=> $lang['NEXT_STEP'],
			'U_ACTION'			=> $this->p_master->module_url . "?mode=$mode&amp;sub=create_table&amp;language=$language",
		));
	}

	/*
	* I see no reason to keep this role selection.
	* 
	function advanced_settings($mode, $sub)
	{
		global $lang, $template, $phpbb_root_path, $phpEx, $language, $db;

		$this->page_title = $lang['STAGE_ADVANCED'];

		// Make Role select
		$sql = 'SELECT role_id, role_name
			FROM ' . ACL_ROLES_TABLE . "
			WHERE role_type = 'a_'
			ORDER BY role_order ASC";
		$result = $db->sql_query($sql);

		$s_role_options = '';
		while ($row = $db->sql_fetchrow($result))
		{
			$role_name = (!empty($lang[$row['role_name']])) ? $lang[$row['role_name']] : $row['role_name'];
			$s_role_options .= '<option value="' . $row['role_id'] . '">' . $role_name . '</option>';
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'S_ADVANCE'			=> true,
			'TITLE'				=> $lang['STAGE_ADVANCED'],
			'BODY'				=> $lang['STAGE_ADVANCED_EXPLAIN'],
			'S_ROLE_OPTIONS'	=> $s_role_options,
			'L_SUBMIT'			=> $lang['NEXT_STEP'],
			'U_ACTION'			=> $this->p_master->module_url . "?mode=$mode&amp;sub=create_table&amp;language=$language",
		));
	}
	*/

	function perform_sql($mode, $sub)
	{
		global $lang, $template, $phpbb_root_path, $phpEx, $language, $db, $cache;

		$this->page_title = $lang['STAGE_CREATE_TABLE'];

		$template->assign_vars(array(
			'S_CREATE_TABLES'	=> true,
			'TITLE'				=> $lang['STAGE_CREATE_TABLE'],
			'BODY'				=> $lang['STAGE_CREATE_TABLE_EXPLAIN'],
			'L_SUBMIT'			=> $lang['NEXT_STEP'],
			'U_ACTION'			=> $this->p_master->module_url . "?mode=$mode&amp;sub=final&amp;language=$language",
		));

		$available_dbms = get_available_dbms();

		include($phpbb_root_path . 'config.'.$phpEx);

		$available_dbms = $available_dbms[$dbms];

		// this is borrowed from the main phpBB installer, credit to the core phpBB Developers

		// Ok we have the db info go ahead and read in the relevant schema
		// and work on building the table
		$dbms_schema = 'schemas/mods_manager/' .  $available_dbms['SCHEMA'] . '_schema.sql';

		// How should we treat this schema?
		$remove_remarks = $available_dbms['COMMENTS'];
		$delimiter = $available_dbms['DELIM'];

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
		
		$sql = 'SELECT module_id FROM ' . MODULES_TABLE . "
			WHERE module_langname = 'ACP_CAT_MODS'";
		$result = $db->sql_query($sql);
		
		if (!$db->sql_fetchrow($result))
		{
			// Get some Module info
			$sql = 'SELECT MAX(module_id) AS last_m_id, MAX(right_id) AS last_r_id
				FROM ' . MODULES_TABLE;
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
	
			// Insert Category Module
			$module_data = array(
				'module_id'			=> ($row['last_m_id'] + 1),
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'module_class'		=> 'acp',
				'parent_id'			=> 0,
				'module_langname'	=> 'ACP_CAT_MODS',
				'left_id'			=> ($row['last_r_id'] + 1),
				'right_id'			=> ($row['last_r_id'] + 6),
			);
	
			$sql = 'INSERT INTO ' . MODULES_TABLE . ' ' . $db->sql_build_array('INSERT', $module_data);
			$db->sql_query($sql);
	
			// Insert Parent Module
			$module_data = array(
				'module_id'			=> ($row['last_m_id'] + 2),
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'module_class'		=> 'acp',
				'parent_id'			=> ($row['last_m_id'] + 1),
				'module_langname'	=> 'ACP_MODS',
				'left_id'			=> ($row['last_r_id'] + 2),
				'right_id'			=> ($row['last_r_id'] + 5),
			);
	
			$sql = 'INSERT INTO ' . MODULES_TABLE . ' ' . $db->sql_build_array('INSERT', $module_data);
			$db->sql_query($sql);
	
			// Frontend Module
			$module_data = array(
				'module_id'			=> ($row['last_m_id'] + 3),
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'module_class'		=> 'acp',
				'parent_id'			=> ($row['last_m_id'] + 2),
				'module_langname'	=> 'ACP_MOD_MANAGEMENT',
				'left_id'			=> ($row['last_r_id'] + 3),
				'right_id'			=> ($row['last_r_id'] + 4),
	
				'module_basename'	=> 'mods',
				'module_mode'		=> 'frontend',
				'module_auth'		=> '',
			);
	
			$sql = 'INSERT INTO ' . MODULES_TABLE . ' ' . $db->sql_build_array('INSERT', $module_data);
			$db->sql_query($sql);
	
			// Insert the auth option
			$auth_data = array(
				'auth_option'		=> 'a_mods',
				'is_global'			=> 1,
				'is_local'			=> 0,
				'founder_only'		=> 0,
			);
	
			$sql = 'INSERT INTO ' . ACL_OPTIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $auth_data);
			$db->sql_query($sql);
	
			$auth_option_id = $db->sql_nextid();
	
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

		// Reset cache so we can actaully see the lovely new tab in the ACP
		$cache->purge();
	}
}

?>