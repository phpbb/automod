<?php
/** 
*
* @mod mod_manager
* @version $Id$
* @copyright (c) 2007 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

define('IN_PHPBB', 1);
define('ADMIN_START', 1);
define('NEED_SID', true);

// Include files
$phpbb_root_path = './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
require($phpbb_root_path . 'common.' . $phpEx);
//require($phpbb_root_path . 'includes/functions_admin.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('acp/common', 'acp/mods', 'acp/permissions'));
// End session management

// Did user forget to login? Give 'em a chance to here ...
if ($user->data['user_id'] == ANONYMOUS)
{
	login_box('', $user->lang['LOGIN_ADMIN'], $user->lang['LOGIN_ADMIN_SUCCESS'], true);
}

// Have they authenticated (again) as an admin for this session?
if (!isset($user->data['session_admin']) || !$user->data['session_admin'])
{
	login_box('', $user->lang['LOGIN_ADMIN_CONFIRM'], $user->lang['LOGIN_ADMIN_SUCCESS'], true, false);
}

if ((int) $user->data['user_type'] !== USER_FOUNDER)
{
	die('Founders only!');
}
				
// We define the admin variables now, because the user is now able to use the admin related features...
define('IN_ADMIN', true);
$phpbb_admin_path = './';

// Set custom template for admin area
$template->set_custom_template($phpbb_root_path . 'install', 'install');

$action = request_var('action', '');
$submit = (isset($_POST['submit'])) ? true : false;

$template->set_filenames(array(
	'body' => 'style.html')
);

$template->assign_vars(array(
	'SITENAME'						=> $config['sitename'],
	'PAGE_TITLE'					=> $user->lang['MOD_MANAGER'],

	'SID'				=> $SID,
	'_SID'				=> $_SID,
	'SESSION_ID'		=> $user->session_id,
	'ROOT_PATH'			=> $phpbb_root_path,

	'S_USER_LANG'			=> $user->lang['USER_LANG'],
	'S_USER_BROWSER'		=> (isset($user->data['session_browser'])) ? $user->data['session_browser'] : $user->lang['UNKNOWN_BROWSER'],
	'S_USERNAME'			=> $user->data['username'],
	'S_CONTENT_DIRECTION'	=> $user->lang['DIRECTION'],
	'S_CONTENT_ENCODING'	=> 'UTF-8',

	'T_STYLESHEET_PATH'			=> "{$phpbb_root_path}adm/style/",
));


if (empty($action))
{
	// Make Role select
	$sql = 'SELECT role_id, role_name
		FROM ' . ACL_ROLES_TABLE . "
		WHERE role_type = 'a_'
		ORDER BY role_order ASC";
	$result = $db->sql_query($sql);

	$s_role_options = '';
	while ($row = $db->sql_fetchrow($result))
	{
		$role_name = (!empty($user->lang[$row['role_name']])) ? $user->lang[$row['role_name']] : $row['role_name'];

		$s_role_options .= '<option value="' . $row['role_id'] . '">' . $role_name . '</option>';

	}
	$db->sql_freeresult($result);

	$template->assign_vars(array(
		'S_OVERVIEW'		=> true,
		
		'S_ROLE_OPTIONS'	=> $s_role_options,
		
		'U_ACTION'			=> append_sid("{$phpbb_root_path}install/install_mod.php?action=install"),
	));
}
elseif ($action = 'install')
{
	// check for role id
	$role_id = request_var('role_id', 0);
	if ($role_id == 0)
	{
		die('give a role you bozo! and make this a proper error message while your at it!');
	}
	
	// Get Actions
	$actions = array();
	include_once($phpbb_root_path . 'includes/mod_parser.' . $phpEx);
	$parser = new parser('xml');
	$parser->set_file($phpbb_root_path . 'install/install.xml');
	$actions = $parser->get_actions();
	unset($parser);

	// Setup editing
	include($phpbb_root_path . 'includes/editor.' . $phpEx);
	$editor = new editor($phpbb_root_path);
	
	$mod_phpbb_id = '13371337'; //bleh?
	$edited_root = "install/temp/";
	
	// preform file edits
	if (isset($actions['EDITS']) && !empty($actions['EDITS'])) // this is some beefy looping
	{
		$template->assign_vars(array(
			'S_EDITS'		=> true)
		);
		
		foreach($actions['EDITS'] as $filename => $finds)
		{
			if(!file_exists("{$phpbb_root_path}{$filename}"))
			{
				$template->assign_block_vars('edit_files', array(
					'S_MISSING_FILE' => true,
					
					'FILENAME'	=> $filename)
				);
			}
			else
			{
				$template->assign_block_vars('edit_files', array(
					'FILENAME'	=> $filename
				));
		
				$file_ext = substr(strrchr(__FILE__, '.'), 1);
				
				$editor->open_file($filename);

				$editor->fold_edits($filename, '');

				foreach($finds as $string => $commands)
				{
					$template->assign_block_vars('edit_files.finds', array(
						'FIND_STRING'	=> htmlspecialchars($string)
					));

					foreach($commands as $type => $contents)
					{
						$status = false;
						$contents_orig = $contents;

						switch(strtoupper($type)) // LANG!
						{
							case 'AFTER, ADD':
								$contents = $editor->add_anchor($contents, $file_ext, $mod_phpbb_id);
								$status = $editor->add_string($filename, $string, $contents, 'AFTER');
							break;
							
							case 'BEFORE, ADD':
								$contents = $editor->add_anchor($contents, $file_ext, $mod_phpbb_id);
								$status = $editor->add_string($filename, $string, $contents, 'BEFORE');
							break;

							case 'INCREMENT':
								//$contents = "";
								$status = $editor->inc_string($filename, $string, $contents);
							break;

							case 'REPLACE WITH':
								//$contents = $editor->add_wrap($string, $file_ext, $mod_phpbb_id) . "\n{$contents}";
								$contents = $editor->add_anchor($contents, $file_ext, $mod_phpbb_id);
								$status = $editor->replace_string($filename, $string, $contents);
							break;

							default:
								die("Error, unrecognised command $type"); // ERROR!
							break;
						}
						
						$template->assign_block_vars('edit_files.finds.actions', array(
							'S_SUCCESS'	=> $status,

							'NAME'		=> $type, // LANG!
							'COMMAND'	=> htmlspecialchars($contents_orig),
						));
					}
				}

				$editor->unfold_edits($filename, '');

				$editor->close_file($filename, "{$edited_root}{$filename}");
			}
		}
	}

	// Preform SQL queries
	// TODO: need to add the queries further on down to status display
	if (isset($actions['SQL']) && !empty($actions['SQL']))
	{
		$template->assign_vars(array(
			'S_SQL'		=> true)
		);
	
		foreach($actions['SQL'] as $query)
		{
			$db->sql_query($query); // will show general error on fail

			$template->assign_block_vars('sql_queries', array(
				'S_SUCCESS'	=> true,

				'QUERY'		=> $query,
			));
		}
	}

	// Move edited files back, and delete temp storage folder
	$editor->copy_content($edited_root, '');
	$editor->remove($edited_root);
	
	// Create mod folder
	// TODO: .htaccess file needed?
	//$editor->create_dir('store/mods');

	// Get some Module info
	$sql = 'SELECT MAX(module_id) as "last_m_id", MAX(right_id) as "last_r_id"
		FROM ' . MODULES_TABLE ;
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
		'module_auth'		=> 'acl_a_mods',
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
		'role_id'			=> $role_id,
		'auth_option_id'		=> $auth_option_id,
		'auth_setting'		=> 1,
	);
	
	$sql = 'INSERT INTO ' . ACL_ROLES_DATA_TABLE . ' ' . $db->sql_build_array('INSERT', $roles_data);
	$db->sql_query($sql);
	
	// Reset cache so we can actaully see the lovely new tab in the ACP
	$cache->purge();

	$template->assign_vars(array(
		'S_INSTALL'		=> true,
		
		'U_INDEX'				=> append_sid("{$phpbb_root_path}index.$phpEx"),
	));
}


$template->display('body');

?>