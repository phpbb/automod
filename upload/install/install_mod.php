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
		'module_stages'		=> array('INTRO', 'REQUIREMENTS', 'FILE_EDITS', 'ADVANCED', 'CREATE_TABLE', 'FINAL'),
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
		
		//include($phpbb_root_path . 'language/' . $language . '/acp/mods.' . $phpEx);
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
					'U_ACTION'			=> $this->p_master->module_url . "?mode=$mode&amp;sub=requirements&amp;language=$language",
				));
			break;
			
			case 'requirements':
				$this->check_requirements($mode, $sub);
			break;
			
			case 'file_edits':
				$this->preform_edits($mode, $sub);
			break;
			
			case 'advanced':
				$this->advanced_settings($mode, $sub);
			break;
			
			case 'create_table':
				$this->perform_sql($mode, $sub);
			break;
			
			case 'final':
				
				$template->assign_vars(array(
					'S_FINAL'	=> true,
					'TITLE'				=> $lang['STAGE_FINAL'],
				));
			break;
		}
		
		$this->tpl_name = 'install_mod';
	}
	
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
	
	function preform_edits($mode, $sub)
	{
		global $lang, $template, $phpbb_root_path, $phpEx, $language, $db;
		
		$this->page_title = $lang['SUB_INTRO'];
		
		$template->assign_vars(array(
			'S_FILE_EDITS'		=> true,
			//'TITLE'				=> $lang['MODMANAGER_INSTALLATION'],
			//'BODY'				=> $lang['MODMANAGER_INSTALLATION_EXPLAIN'],
			'L_SUBMIT'			=> $lang['NEXT_STEP'],
			'U_ACTION'			=> $this->p_master->module_url . "?mode=$mode&amp;sub=advanced&amp;language=$language",
		));
	}
	
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
		
		// create the mods table
		$sql = 'CREATE TABLE `phpbb_mods` (
		  `mod_id` int(8) NOT NULL auto_increment,
		  `mod_active` tinyint(1) NOT NULL default \'1\',
		  `mod_time` int(11) default NULL,
		  `mod_dependencies` varchar(255) NOT NULL,
		  `mod_name` varchar(255) NOT NULL default \'\',
		  `mod_description` text NOT NULL,
		  `mod_version` varchar(100) NOT NULL default \'\',
		  `mod_path` varchar(255) NOT NULL default \'\',
		  `mod_author_notes` text NOT NULL,
		  `mod_author_name` varchar(255) NOT NULL default \'\',
		  `mod_author_email` varchar(255) NOT NULL default \'\',
		  `mod_author_url` varchar(255) NOT NULL default \'\',
		  `mod_actions` text NOT NULL,
		  PRIMARY KEY  (`mod_id`)
		) CHARACTER SET `utf8` COLLATE `utf8_bin`;';
		$db->sql_query($sql);
		
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
			'auth_option_id'	=> '',
			'auth_option'		=> 'a_mods',
			'is_global'			=> 1,
			'is_local'			=> 0,
			'founder_only'		=> 0,
		);
		
		$sql = 'INSERT INTO ' . ACL_OPTIONS_TABLE . ' ' . $db->sql_build_array('INSERT', $auth_data);
		$db->sql_query($sql);
		
		$auth_option_id = $db->sql_nextid();
		
		// Give the wanted role its option
		$roles_data = array(
			'role_id'			=> request_var('role_id', 0),
			'auth_option_id'	=> $auth_option_id,
			'auth_setting'		=> 1,
		);
		
		$sql = 'INSERT INTO ' . ACL_ROLES_DATA_TABLE . ' ' . $db->sql_build_array('INSERT', $roles_data);
		$db->sql_query($sql);
		
		// Reset cache so we can actaully see the lovely new tab in the ACP
		$cache->purge();
	}
}

?>