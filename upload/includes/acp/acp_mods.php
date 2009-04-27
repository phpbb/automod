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
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package automod
*/
class acp_mods
{
	var $u_action;
	var $parser;
	var $mod_root = '';
	var $mods_dir = '';
	var $edited_root = '';
	var $backup_root = '';

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $cache;
		global $phpbb_root_path, $phpEx;
		global $method, $test_ftp_connection, $test_connection;

		include("{$phpbb_root_path}includes/functions_transfer.$phpEx");
		include("{$phpbb_root_path}includes/editor.$phpEx");
		include("{$phpbb_root_path}includes/functions_mods.$phpEx");
		include("{$phpbb_root_path}includes/mod_parser.$phpEx");

		// start the page
		$user->add_lang(array('install', 'acp/mods'));

		$this->tpl_name = 'acp_mods';
		$this->page_title = 'ACP_CAT_MODS';
		$this->mods_dir = $phpbb_root_path . 'store/mods/';


		// get any url vars
		$action = request_var('action', '');
		$mod_id = request_var('mod_id', 0);
		$mod_url = request_var('mod_url', '');
		$parent = request_var('parent', 0);

		$mod_path = request_var('mod_path', '');

		if ($mod_path)
		{
			$mod_path = urldecode($mod_path);
			$mod_dir = substr($mod_path, 1, strpos($mod_path, '/', 1));

			$this->mod_root = $this->mods_dir . $mod_dir;
			$this->backup_root = $this->mod_root . '_backups/';
		}

		switch ($mode)
		{
			case 'config':
				$ftp_method		= request_var('ftp_method', '');
				if (!$ftp_method || !class_exists($ftp_method))
				{
					$ftp_method = 'ftp';
					$ftp_methods = transfer::methods();

					if (!in_array('ftp', $ftp_methods))
					{
						$ftp_method = $ftp_methods[0];
					}
				}

				if (isset($_POST['submit']) && check_form_key('acp_mods'))
				{
					$ftp_host		= request_var('host', '');
					$ftp_username	= request_var('username', '');
					$ftp_password	= request_var('password', ''); // not stored, used to test connection
					$ftp_root_path	= request_var('root_path', '');
					$ftp_port		= request_var('port', 21);
					$ftp_timeout	= request_var('timeout', 10);
					$write_method	= request_var('write_method', 0);
					$file_perms		= request_var('file_perms', '0644');
					$dir_perms		= request_var('dir_perms', '0755');
					$compress_method	= request_var('compress_method', '');
					$preview_changes	= request_var('preview_changes', 0);


					$error = '';
					if ($write_method == WRITE_DIRECT)
					{
						// the very best method would be to check every file for is_writable
						if (!is_writable("{$phpbb_root_path}common.$phpEx") || !is_writable("{$phpbb_root_path}adm/style/acp_groups.html"))
						{
							$error = 'FILESYSTEM_NOT_WRITABLE';
						}
					}
					else if ($write_method == WRITE_FTP)
					{
						// check the correctness of FTP infos
						$test_ftp_connection = true;
						$test_connection = false;
						test_ftp_connection($ftp_method, $test_ftp_connection, $test_connection);

						if ($test_connection !== true)
						{
							$error = $test_connection;
						}
					}
					else if ($write_method == WRITE_MANUAL)
					{
						// the compress class requires write access to the /store/ dir
						if (!is_writable("{$phpbb_root_path}store/"))
						{
							$error = 'STORE_NOT_WRITABLE';
						}
					}

					if (empty($error))
					{
						set_config('ftp_method',	$ftp_method);
						set_config('ftp_host',		$ftp_host);
						set_config('ftp_username',	$ftp_username);
						set_config('ftp_root_path', $ftp_root_path);
						set_config('ftp_port',		$ftp_port);
						set_config('ftp_timeout',	$ftp_timeout);
						set_config('write_method',	$write_method);
						set_config('compress_method',	$compress_method);
						set_config('preview_changes',	$preview_changes);
						set_config('am_file_perms',		$file_perms);
						set_config('am_dir_perms',		$dir_perms);

						trigger_error($user->lang['MOD_CONFIG_UPDATED'] . adm_back_link($this->u_action));
					}
					else
					{
						$template->assign_var('ERROR', $user->lang[$error]);
					}
				}
				else if (isset($_POST['submit']) && !check_form_key('acp_mods'))
				{
					trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				add_form_key('acp_mods');

				// implicit else
				include("{$phpbb_root_path}includes/functions_compress.$phpEx");
				foreach (compress::methods() as $method)
				{
					$template->assign_block_vars('compress', array(
						'METHOD'	=> $method,
					));
				}

				$requested_data = call_user_func(array($ftp_method, 'data'));
				foreach ($requested_data as $data => $default)
				{
					$default = (!empty($config['ftp_' . $data])) ? $config['ftp_' . $data] : $default;
					$template->assign_block_vars('data', array(
						'DATA'		=> $data,
						'NAME'		=> $user->lang[strtoupper($ftp_method . '_' . $data)],
						'EXPLAIN'	=> $user->lang[strtoupper($ftp_method . '_' . $data) . '_EXPLAIN'],
						'DEFAULT'	=> (!empty($_REQUEST[$data])) ? request_var($data, '') : $default
					));
				}

				$template->assign_vars(array(
					'S_CONFIG'			=> true,
					'U_CONFIG'			=> $this->u_action . '&amp;mode=config',

					'UPLOAD_METHOD'		=> $ftp_method,
					'WRITE_DIRECT'		=> ($config['write_method'] == WRITE_DIRECT) ? ' checked="checked"' : '',
					'WRITE_FTP'			=> ($config['write_method'] == WRITE_FTP) ? ' checked="checked"' : '',
					'WRITE_MANUAL'		=> ($config['write_method'] == WRITE_MANUAL) ? ' checked="checked"' : '',

					'WRITE_METHOD_DIRECT'	=> WRITE_DIRECT,
					'WRITE_METHOD_FTP'		=> WRITE_FTP,
					'WRITE_METHOD_MANUAL'	=> WRITE_MANUAL,

					'COMPRESS_METHOD'		=> $config['compress_method'],
					'DIR_PERMS'				=> $config['am_dir_perms'],
					'FILE_PERMS'			=> $config['am_file_perms'],
					'PREVIEW_CHANGES_YES'	=> ($config['preview_changes']) ? ' checked="checked"' : '',
					'PREVIEW_CHANGES_NO'	=> (!$config['preview_changes']) ? ' checked="checked"' : '',
					'S_HIDE_FTP'			=> ($config['write_method'] == WRITE_FTP) ? false : true,
				));
			break;

			case 'frontend':
				if ($config['write_method'] == WRITE_FTP)
				{
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
					if (!empty($test_ftp_connection) || $action == 'install')
					{
						test_ftp_connection($method, $test_ftp_connection, $test_connection);

						// Make sure the login details are correct before continuing
						if ($test_connection !== true || !empty($test_ftp_connection))
						{
							$action = 'pre_install';
							$test_ftp_connection = true;
						}
					}
				}

				switch ($action)
				{
					case 'pre_install':
						$this->pre_install($mod_path);
					break;

					case 'install':
						$this->install($mod_path, $parent);
					break;

					case 'pre_uninstall':
					case 'uninstall':
						$this->uninstall($action, $mod_id);
					break;

					case 'details':
						$mod_ident = ($mod_id) ? $mod_id : $mod_path;
						$this->list_details($mod_ident);
					break;

					default:
						$template->assign_vars(array(
							'S_FRONTEND'		=> true,
						));

						$this->list_installed();
						$this->list_uninstalled();
					break;
				}

				return;

			break;

		}
	}

	/**
	* List all the installed mods
	*/
	function list_installed()
	{
		global $db, $template;

		$sql = 'SELECT mod_id, mod_name
			FROM ' . MODS_TABLE . '
			ORDER BY mod_name ASC';
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('installed', array(
				'MOD_ID'		=> $row['mod_id'],
				'MOD_NAME'		=> $row['mod_name'],

				'U_DETAILS'		=> $this->u_action . '&amp;action=details&amp;mod_id=' . $row['mod_id'],
				'U_UNINSTALL'	=> $this->u_action . '&amp;action=pre_uninstall&amp;mod_id=' . $row['mod_id'])
			);
		}
		$db->sql_freeresult($result);

		return;
	}

	/**
	* List all mods available locally
	*/
	function list_uninstalled()
	{
		global $phpbb_root_path, $db, $template;

		// get available MOD paths
		$available_mods = $this->find_mods($this->mods_dir, 1);

		if (!sizeof($available_mods['main']))
		{
			return;
		}

		// get installed MOD paths
		$installed_paths = array();
		$sql = 'SELECT mod_path
			FROM ' . MODS_TABLE;
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$installed_paths[] = $row['mod_path'];
		}
		$db->sql_freeresult($result);

		// we don't care about any xml files not in the main directory
		$available_mods = array_diff($available_mods['main'], $installed_paths);
		unset($installed_paths);

		// show only available MODs that paths aren't in the DB
		foreach ($available_mods as $file)
		{
			$details = $this->mod_details($file, false);
			$short_path = urlencode(str_replace($this->mods_dir, '', $details['MOD_PATH']));

			$template->assign_block_vars('uninstalled', array(
				'MOD_NAME'	=> $details['MOD_NAME'],
				'MOD_PATH'	=> $short_path,

				'U_INSTALL'	=> $this->u_action . "&amp;action=pre_install&amp;mod_path=$short_path",
				'U_DETAILS'	=> $this->u_action . "&amp;action=details&amp;mod_path=$short_path",
			));
		}

		return;
	}

	/**
	* Lists mod details
	*/
	function list_details($mod_ident)
	{
		global $template;

		$template->assign_vars(array(
			'S_DETAILS'	=> true,
			'U_BACK'	=> $this->u_action,
		));

		$details = $this->mod_details($mod_ident, true);

		if (!empty($details['AUTHOR_DETAILS']))
		{
			foreach ($details['AUTHOR_DETAILS'] as $author_details)
			{
				$template->assign_block_vars('author_list', $author_details);
			}
			unset($details['AUTHOR_DETAILS']);
		}

		if (!empty($details['MOD_HISTORY']))
		{
			$template->assign_var('S_CHANGELOG', true);

			foreach ($details['MOD_HISTORY'] as $mod_version)
			{
				$template->assign_block_vars('changelog', array(
					'VERSION'	=> $mod_version['VERSION'],
					'DATE'		=> $mod_version['DATE'],
				));

				foreach ($mod_version['CHANGES'] as $changes)
				{
					$template->assign_block_vars('changelog.changes', array(
						'CHANGE'	=> $changes,
					));
				}
			}
		}

		unset($details['MOD_HISTORY']);

		$template->assign_vars($details);

		if (!empty($details['AUTHOR_NOTES']))
		{
			$template->assign_var('S_AUTHOR_NOTES', true);
		}
		if (!empty($details['MOD_INSTALL_TIME']))
		{
			$template->assign_var('S_INSTALL_TIME', true);
		}

		return;
	}

	/**
	* Returns array of mod information
	*/
	function mod_details($mod_ident, $find_children = true)
	{
		global $phpbb_root_path, $phpEx, $user, $template, $parent_id;

		if (is_int($mod_ident))
		{
			global $db, $user;

			$mod_id = (int) $mod_ident;

			$sql = 'SELECT *
				FROM ' . MODS_TABLE . "
					WHERE mod_id = $mod_id";
			$result = $db->sql_query($sql);
			if ($row = $db->sql_fetchrow($result))
			{
				// TODO: Yuck, get rid of this.
				$author_details = array();
				$author_details[0] = array(
						'AUTHOR_NAME'		=> $row['mod_author_name'],
						'AUTHOR_EMAIL'		=> $row['mod_author_email'],
						'AUTHOR_WEBSITE'	=> $row['mod_author_url'],
				);

				$details = array(
					'MOD_ID'			=> $row['mod_id'],
					'MOD_PATH'			=> $row['mod_path'],
					'MOD_INSTALL_TIME'	=> $user->format_date($row['mod_time']),
//					'MOD_DEPENDENCIES'	=> unserialize($row['mod_dependencies']), // ?
					'MOD_NAME'			=> htmlspecialchars($row['mod_name']),
					'MOD_DESCRIPTION'	=> nl2br($row['mod_description']),
					'MOD_VERSION'		=> $row['mod_version'],

					'AUTHOR_NOTES'		=> nl2br($row['mod_author_notes']),
					'AUTHOR_DETAILS'	=> $author_details,
				);

				// This is a check for any further XML files to go with this MOD.
				// Obviously, the files must not have been removed for this to work.
				if ($find_children && file_exists($row['mod_path']))
				{
					$parent_id = $mod_id;

					$actions = array();
					$ext = substr(strrchr($row['mod_path'], '.'), 1);
					$this->parser = new parser($ext);
					$this->parser->set_file($row['mod_path']);

					// Find and display the available MODX files
					$children = $this->find_children($row['mod_path']);

					$elements = array('language' => array(), 'template' => array());

					$this->handle_contrib($children);
					$this->handle_language_prompt($children, $elements, 'details');
					$this->handle_template_prompt($children, $elements, 'details');

					// Now offer to install additional templates
					$found_prosilver = false;
					if (isset($children['template']) && sizeof($children['template']))
					{
						// These are the instructions included with the MOD
						foreach ($children['template'] as $template_name)
						{
							if (core_basename($template_name) == 'prosilver')
							{
								$found_prosilver = true;
							}

							$template->assign_block_vars('avail_templates', array(
								'TEMPLATE_NAME'	=> core_basename($template_name),
								'XML_FILE'		=> urlencode(dirname($row['mod_path']) . '/' . $template_name),
							));
						}
					}

					if (!$found_prosilver)
					{
						$template->assign_block_vars('avail_templates', array(
							'TEMPLATE_NAME'	=> 'prosilver',
							'XML_FILE'		=> urlencode($row['mod_path']),
						));
					}

					// now grab the templates that have not already been processed
					$sql = 'SELECT template_id, template_name FROM ' . STYLES_TEMPLATE_TABLE . '
						WHERE ' . $db->sql_in_set('template_name', explode(',', $row['mod_template']), true);
					$result = $db->sql_query($sql);

					while ($row = $db->sql_fetchrow($result))
					{
						$template->assign_block_vars('board_templates', array(
							'TEMPLATE_ID'		=> $row['template_id'],
							'TEMPLATE_NAME'		=> $row['template_name'],
						));
					}

					$s_hidden_fields = build_hidden_fields(array(
						'action'	=> 'install',
						'parent'	=> $row['mod_id'],
					));

					$template->assign_vars(array(
						'S_FORM_ACTION'		=> $this->u_action,
						'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
					));

					add_form_key('acp_mods');
				}
			}
			else
			{
				trigger_error($user->lang['NO_MOD'] . adm_back_link($this->u_action), E_USER_WARNING);
			}
			$db->sql_freeresult($result);
		}
		else
		{
			if (strpos($mod_ident, $this->mods_dir) === false)
			{
				$mod_ident = $this->mods_dir . $mod_ident;
			}

			if (!file_exists($mod_ident))
			{
				$mod_ident = str_replce($this->mod_dir, $this->mod_root, $mod_ident);
			}

			$mod_path = $mod_ident;
			$mod_parent = 0;

			$ext = substr(strrchr($mod_path, '.'), 1);

			$this->parser = new parser($ext);
			$this->parser->set_file($mod_path);

			$details = $this->parser->get_details();

			if ($find_children)
			{
				$actions = array();
				$children = $this->find_children($mod_path);

				$elements = array('language' => array(), 'template' => array());

				$this->handle_contrib($children);
				$this->handle_language_prompt($children, $elements, 'details');
				$this->handle_template_prompt($children, $elements, 'details');
			}
		}

		return $details;
	}

	/**
	* Returns complex array of all mod actions
	*/
	function mod_actions($mod_ident)
	{
		global $phpbb_root_path, $phpEx;

		if (is_int($mod_ident))
		{
			global $db, $user;

			$sql = 'SELECT mod_actions
				FROM ' . MODS_TABLE . "
					WHERE mod_id = $mod_ident";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if ($row)
			{
				return unserialize($row['mod_actions']);
			}
			else
			{
				trigger_error($user->lang['NO_MOD'] . adm_back_link($this->u_action), E_USER_WARNING);
			}
		}
		else
		{
			if (strpos($mod_ident, $this->mods_dir) === false)
			{
				$mod_ident = $this->mods_dir . $mod_ident;
			}

			$this->parser->set_file($mod_ident);
			$actions = $this->parser->get_actions();
		}

		return $actions;

	}

	/**
	* Parses and displays all Edits, Copies, and SQL modifcations
	*/
	function pre_install($mod_path)
	{
		global $phpbb_root_path, $phpEx, $template, $db, $config, $user, $method, $test_ftp_connection, $test_connection;

		// mod_path empty?
		if (empty($mod_path))
		{
			// ERROR
			return false;
		}

		$details = $this->mod_details($mod_path, false);
		$actions = $this->mod_actions($mod_path);

		$elements = array('language' => array(), 'template' => array());

		// check for "child" MODX files and attempt to decide which ones we need
		$children = $this->find_children($mod_path);
		$this->handle_language_prompt($children, $elements, 'pre_install');
		$this->handle_merge('language', $actions, $children, $elements['language']);
		$this->handle_template_prompt($children, $elements, 'pre_install');
		$this->handle_merge('template', $actions, $children, $elements['template']);


		$template->assign_vars(array(
			'S_PRE_INSTALL'	=> true,

			'MOD_PATH'		=> urlencode(str_replace($this->mod_root, '', $mod_path)),

			'U_INSTALL'		=> $this->u_action . '&amp;action=install',
			'U_BACK'		=> $this->u_action,
		));

		$s_hidden_fields = '';
		// get FTP information if we need it
		if ($config['write_method'] == WRITE_FTP)
		{
			handle_ftp_details($method, $test_ftp_connection, $test_connection);
		}

		$s_hidden_fields .= build_hidden_fields(array('dependency_confirm' => !empty($_REQUEST['dependency_confirm'])));
		$template->assign_var('S_HIDDEN_FIELDS', $s_hidden_fields);

		$write_method = 'editor_' . determine_write_method(true);
		$editor = new $write_method();

		// Only display full actions if the user has requested them.
		if (!$config['preview_changes'] || ($editor->write_method == WRITE_FTP && empty($_REQUEST['password'])))
		{
			return;
		}

		$this->process_edits($editor, $actions, $details, false, true, false);

		return;
	}

	/**
	* Preforms all Edits, Copies, and SQL queries
	*/
	function install($mod_path, $parent = 0)
	{
		global $phpbb_root_path, $phpEx, $db, $template, $user, $config, $cache;

		// Are we forcing a template install?
		$dest_template = '';
		if (isset($_POST['template_submit']))
		{
			if (!check_form_key('acp_mods'))
			{
				trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
			}

			$mod_path = request_var('source', '');
			$dest_template = request_var('dest', '');

			preg_match('#^([a-z0-9]+)#i', core_basename($mod_path), $match);
			$src_template = $match[1];
			unset ($match);
		}

		// mod_path empty?
		if (empty($mod_path))
		{
			// ERROR
			return false;
		}

		if (request_var('method', ''))
		{
			set_config('ftp_method',	request_var('method', ''));
		}
		set_config('ftp_host',		request_var('host', ''));
		set_config('ftp_username',	request_var('username', ''));
		set_config('ftp_root_path', request_var('root_path', ''));
		set_config('ftp_port',		request_var('port', 21));
		set_config('ftp_timeout',	request_var('timeout', 10));

		$details = $this->mod_details($mod_path, false);

		$write_method = 'editor_' . determine_write_method(false);
		$editor = new $write_method();

		// get mod install root && make temporary edited folder root
//		$this->mod_root = dirname(str_replace($phpbb_root_path, '', $mod_path)) . '/';
		$this->edited_root = "{$this->mod_root}_edited/";

		$actions = $this->mod_actions($mod_path);

		if ($dest_template)
		{
			foreach ($actions['EDITS'] as $file => $edits)
			{
				if (strpos($file, 'styles/') === false)
				{
					unset($actions['EDITS'][$file]);
				}
				else
				{
					$file_new = str_replace($src_template, $dest_template, $file);
					$actions['EDITS'][$file_new] = $edits;
					unset($actions['EDITS'][$file]);
				}
			}

			foreach ($actions['NEW_FILES'] as $src_file => $dest_file)
			{
				if (strpos($src_file, 'styles/') === false)
				{
					unset($actions['NEW_FILES']);
				}
				else
				{
					$dest_new = str_replace($src_template, $dest_template, $dest_file);
				}
			}
		}

		// only supporting one level of hierarchy here
		if (!$parent)
		{
			// check for "child" MODX files and attempt to decide which ones we need
			$children = $this->find_children($mod_path);

			$elements = array('language' => array(), 'template' => array());

			$this->handle_dependency($children);
			$this->handle_language_prompt($children, $elements, 'install');
			$this->handle_merge('language', $actions, $children, $elements['language']);
			$this->handle_template_prompt($children, $elements, 'install');
			$this->handle_merge('template', $actions, $children, $elements['template']);
		}

		$editor->create_edited_root($this->edited_root);

		// handle all edits here
		$mod_installed = $this->process_edits($editor, $actions, $details, true, true, false);

		// Display Do-It-Yourself Actions...per the MODX spec, these should be displayed last
		if (!empty($actions['DIY_INSTRUCTIONS']))
		{
			$template->assign_var('S_DIY', true);

			foreach ($actions['DIY_INSTRUCTIONS'] as $instruction)
			{
				$template->assign_block_vars('diy_instructions', array(
					'DIY_INSTRUCTION'	=> nl2br(htmlspecialchars($instruction)),
				));
			}
		}

		$force_install = request_var('force', false);

		if ($mod_installed || $force_install)
		{
			// Move edited files back
			$status = $editor->commit_changes($this->edited_root, '');

			if (is_string($status))
			{
				$mod_uninstalled = false;

				$template->assign_block_vars('error', array(
					'ERROR'	=> $status,
				));
			}
		}

		// Finish by sending template data
		$template->assign_vars(array(
			'S_INSTALL'		=> true,

			'U_RETURN'		=> $this->u_action,
		));

		// The editor class provides more pertinent information regarding edits
		// so we store that as the canonical version, used for uninstalling
		$actions['EDITS'] = $editor->mod_actions;
		$editor->clear_actions();

		// if MOD installed successfully, make a record.
		if (($mod_installed || $force_install) && !$parent)
		{
			// Insert database data
			$sql = 'INSERT INTO ' . MODS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
				'mod_time'			=> (int) $editor->install_time,
				// @todo: Are dependencies part of the MODX Spec?
				'mod_dependencies'	=> '', //(string) serialize($details['MOD_DEPENDENCIES']),
				'mod_name'			=> (string) $details['MOD_NAME'],
				'mod_description'	=> (string) $details['MOD_DESCRIPTION'],
				'mod_version'		=> (string) $details['MOD_VERSION'],
				'mod_path'			=> (string) $details['MOD_PATH'],
				'mod_author_notes'	=> (string) $details['AUTHOR_NOTES'],
				'mod_author_name'	=> (string) $details['AUTHOR_DETAILS'][0]['AUTHOR_NAME'],
				'mod_author_email'	=> (string) $details['AUTHOR_DETAILS'][0]['AUTHOR_EMAIL'],
				'mod_author_url'	=> (string) $details['AUTHOR_DETAILS'][0]['AUTHOR_WEBSITE'],
				'mod_actions'		=> (string) serialize($actions),
				'mod_languages'		=> (string) (isset($elements['language']) && sizeof($elements['language'])) ? implode(',', $elements['language']) : '',
				'mod_template'		=> (string) (isset($elements['template']) && sizeof($elements['template'])) ? implode(',', $elements['template']) : '',
			));
			$db->sql_query($sql);

			$cache->purge();

			// Add log
			add_log('admin', 'LOG_MOD_ADD', $details['MOD_NAME']);
		}
		// in this case, we are installing an additional template or language
		else if (($mod_installed || $force_install) && $parent)
		{
			$sql = 'SELECT * FROM ' . MODS_TABLE . " WHERE mod_id = $parent";
			$result = $db->sql_query($sql);

			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if (!$row)
			{
				trigger_error($user->lang['NO_MOD'] . adm_back_link($this->u_action));
			}

			$sql_ary = array();

			$sql_ary['mod_language'] = $row['mod_language'] . ',' . implode(',', $elements['language']);
			$sql_ary['mod_template'] = $row['mod_template'] . ',' . implode(',', $elements['template']);

			if (is_null($sql_ary['mod_language']))
			{
				$sql_ary['mod_language'] = '';
			}

			if (is_null($sql_ary['mod_template']))
			{
				$sql_ary['mod_template'] = '';
			}

			$prior_mod_actions = unserialize($row['mod_actions']);
			$sql_ary['mod_actions'] = serialize(array_merge_recursive($prior_mod_actions, $actions));
			unset($prior_mod_actions);

			$sql = 'UPDATE ' . MODS_TABLE . ' ' . $db->sql_build_array('UPDATE', $sql_ary);
			$db->sql_query($sql);

			add_log('admin', 'LOG_MOD_CHANGE', $row['mod_name']);
		}
		// there was an error we need to tell the user about
		else
		{
			$hidden_ary = array();
			if ($editor->write_method == WRITE_FTP)
			{
				$hidden_ary['method'] = $config['ftp_method'];

				if (empty($config['ftp_method']))
				{
					trigger_error('FTP_METHOD_ERROR');
				}

				$requested_data = call_user_func(array($config['ftp_method'], 'data'));

				foreach ($requested_data as $data => $default)
				{
					if ($data == 'password')
					{
						$config['ftp_password'] = request_var('password', '');
					}
					$default = (!empty($config['ftp_' . $data])) ? $config['ftp_' . $data] : $default;

					$hidden_ary[$data] = $default;
				}
			}

			$template->assign_vars(array(
				'S_ERROR'			=> true,
				'S_HIDDEN_FIELDS'	=> build_hidden_fields($hidden_ary),

				'U_RETRY'	=> $this->u_action . '&amp;action=install&amp;mod_path=' . $mod_path,
			));
		}

		// if we forced the install of the MOD, we need to let the user know their board could be broken
		if ($force_install)
		{
			$template->assign_var('S_FORCE', true);
		}

		if ($mod_installed || $force_install)
		{
			$editor->commit_changes_final('mod_' . $editor->install_time, str_replace(' ', '_', $details['MOD_NAME']));
		}
	}

	/**
	* Uninstall/pre uninstall a mod
	*/
	function uninstall($action, $mod_id)
	{
		global $phpbb_root_path, $phpEx, $db, $template, $config;
		global $method, $test_ftp_connection, $test_connection;

		// mod_id blank?
		if (!$mod_id)
		{
			// ERROR
			return false;
		}

		$execute_edits = ($action == 'pre_uninstall') ? false : true;

		$write_method = 'editor_' . determine_write_method(!$execute_edits);
		$editor = new $write_method();

		// get mod install root && make temporary edited folder root
		$this->edited_root = "{$this->mods_dir}{$this->mod_root}{$mod_id}_uninst/";

		// get FTP information if we need it
		// using $config instead of $editor because write_method is forced to direct
		// when in preview mode
		if ($config['write_method'] == WRITE_FTP)
		{
			handle_ftp_details($method, $test_ftp_connection, $test_connection);
		}

		$editor->create_edited_root($this->edited_root);

		$template->assign_vars(array(
			'S_UNINSTALL'		=> $execute_edits,
			'S_PRE_UNINSTALL'	=> !$execute_edits,

			'MOD_ID'		=> $mod_id,

			'U_UNINSTALL'	=> $this->u_action . '&amp;action=uninstall&amp;mod_id=' . $mod_id,
			'U_RETURN'		=> $this->u_action,
		));

		// grab actions and details
		$details = $this->mod_details($mod_id, false);
		$actions = $this->mod_actions($mod_id);

		// process the actions
		$mod_uninstalled = $this->process_edits($editor, $actions, $details, $execute_edits, true, true);

		if (!$execute_edits)
		{
			return;
		}

		$force_uninstall = request_var('force', false);

		if ($mod_uninstalled || $force_uninstall)
		{
			// Move edited files back
			$status = $editor->commit_changes($this->edited_root, '');

			if (is_string($status))
			{
				$mod_uninstalled = false;

				$template->assign_block_vars('error', array(
					'ERROR'	=> $status,
				));
			}
		}

		if ($force_uninstall)
		{
			$template->assign_var('S_FORCE', true);
		}

		$template->assign_var('S_ERROR', !$mod_uninstalled);

		if ($execute_edits && ($mod_uninstalled || $force_uninstall))
		{
			// Delete from DB
			$sql = 'DELETE FROM ' . MODS_TABLE . '
				WHERE mod_id = ' . $mod_id;
			$db->sql_query($sql);

			// Add log
			add_log('admin', 'LOG_MOD_REMOVE', $details['MOD_NAME']);

			$editor->commit_changes_final('mod_' . $editor->install_time, str_replace(' ', '_', $details['MOD_NAME']));
		}
	}

	/**
	* Returns array of available mod install files in dir (Recursive)
	* @param $dir string - dir to search
	* @param $recurse int - number of levels to recurse
	*/
	function find_mods($dir, $recurse = false)
	{
		if ($recurse === false)
		{
			$mods = array('main' => array(), 'contrib' => array(), 'template' => array(), 'language' => array());
			$recurse = 0;
		}
		else
		{
			static $mods = array('main' => array(), 'contrib' => array(), 'template' => array(), 'language' => array());
		}

		$dp = opendir($dir);
		while (($file = readdir($dp)) !== false)
		{
			if ($file[0] != '.' && strpos("$dir/$file", '_edited') === false)
			{
				// recurse - we don't want anything within the MODX "root" though
				if ($recurse && is_dir("$dir/$file") && strpos("$dir/$file", 'root') === false)
				{
					$mods = array_merge($mods, $this->find_mods("$dir/$file", $recurse - 1));
				}
				// this might be better as an str function, especially being in a loop
				else if (preg_match('#.*install.*xml$#i', $file) || (preg_match('#(contrib|templates|languages)#i', $dir, $match)) || ($recurse === 0 && strpos($file, '.xml') !== false))
				{
					// if this is an "extra" MODX file, make a record of it as such
					// we are assuming the MOD follows MODX packaging standards here
					if (preg_match('#(contrib|templates|languages)#i', $dir, $match))
					{
						// Get rid of the S.  This is a side effect of understanding
						// MODX 1.0.x and 1.2.x.
						$match[1] = rtrim($match[1], 's');

						$mods[$match[1]][] = "$dir/$file";
					}
					else
					{
						$check = end($mods['main']);

						// we take the first file alphabetically with install in the filename
						if (dirname($check) == $dir)
						{
							if (preg_match('#.*install.*xml$#i', $file) && strnatcasecmp(basename($check), $file) < 0)
							{
								$mods['main'][sizeof($mods['main']) - 1] = "$dir/$file";
							}
						}
						else
						{
							if (strpos($file, '.xml') !== false)
							{
								$mods['main'][] = "$dir/$file";
							}
						}
					}
				}
			}
		}
		closedir($dp);

		return $mods;
	}

	function process_edits($editor, $actions, $details, $change = false, $display = true, $reverse = false)
	{
		global $template, $user, $db, $phpbb_root_path, $force_install;

		$mod_installed = true;

		if ($reverse)
		{
			// maybe should allow for potential extensions here
			$actions = parser::reverse_edits($actions);
		}

		$template->assign_vars(array(
			'S_DISPLAY_DETAILS'	=> (bool) $display,
			'S_CHANGE_FILES'	=> (bool) $change,
		));

		if (!empty($details['AUTHOR_NOTES']) && $details['AUTHOR_NOTES'] != $user->lang['UNKNOWN_MOD_AUTHOR-NOTES'])
		{
			$template->assign_vars(array(
				'S_AUTHOR_NOTES'	=> true,

				'AUTHOR_NOTES'		=> nl2br($details['AUTHOR_NOTES']),
			));
		}

		// not all MODs will have edits (!)
		if (isset($actions['EDITS']))
		{
			$template->assign_var('S_EDITS', true);

			foreach ($actions['EDITS'] as $filename => $edits)
			{
				// see if the file to be opened actually exists
				if (!file_exists("$phpbb_root_path$filename"))
				{
					$template->assign_block_vars('edit_files', array(
						'S_MISSING_FILE' => true,
						'FILENAME'	=> $filename,
					));

					$mod_installed = false;

					continue;
				}
				else
				{
					$template->assign_block_vars('edit_files', array(
						'FILENAME'	=> $filename,
					));

					$status = $editor->open_file($filename, $this->backup_root);
					if (is_string($status))
					{
						$template->assign_block_vars('error', array(
							'ERROR'	=> $status,
						));

						$mod_installed = false;
						continue;
					}

					foreach ($edits as $finds)
					{
						$comment = '';
						foreach ($finds as $find => $commands)
						{
							if (isset($finds['comment']) && !$comment && $finds['comment'] != $user->lang['UNKNOWN_MOD_COMMENT'])
							{
								$comment = $finds['comment'];
								unset($finds['comment']);
							}

							if ($find == 'comment')
							{
								continue;
							}

							$template->assign_block_vars('edit_files.finds', array(
								'FIND_STRING'	=> htmlspecialchars($find),
								'COMMENT'		=> htmlspecialchars($comment),
							));

							$offset_ary = $editor->find($find);

							// special case for FINDs with no action associated
							if (is_null($commands))
							{
								continue;
							}

							foreach ($commands as $type => $contents)
							{
								if (!$offset_ary)
								{
									$offset_ary['start'] = $offset_ary['end'] = false;
								}

								$status = false;
								$inline_template_ary = array();
								$contents_orig = $contents;

								switch (strtoupper($type))
								{
									case 'AFTER ADD':
										$status = $editor->add_string($find, $contents, 'AFTER', $offset_ary['start'], $offset_ary['end']);
									break;

									case 'BEFORE ADD':
										$status = $editor->add_string($find, $contents, 'BEFORE', $offset_ary['start'], $offset_ary['end']);
									break;

									case 'INCREMENT':
									case 'OPERATION':
										//$contents = "";
										$status = $editor->inc_string($find, '', $contents);
									break;

									case 'REPLACE WITH':
										$status = $editor->replace_string($find, $contents, $offset_ary['start'], $offset_ary['end']);
									break;

									case 'IN-LINE-EDIT':
										// these aren't quite as straight forward.  Still have multi-level arrays to sort through
										$inline_comment = '';
										foreach ($contents as $inline_find => $inline_commands)
										{
											if ($inline_find == 'inline-comment')
											{
												// This is a special case for tucking comments in the array
												if ($inline_commands != $user->lang['UNKNOWN_MOD_INLINE-COMMENT'])
												{
													$inline_comment = $inline_commands;
												}
												continue;
											}

											foreach ($inline_commands as $inline_action => $inline_contents)
											{
												// inline finds are pretty contancerous, so so them in the loop
												$line = $editor->inline_find($find, $inline_find, $offset_ary['start'], $offset_ary['end']);
												if (!$line)
												{
													// find failed
													$status = false;
													continue 2;
												}

												$inline_contents = $inline_contents[0];
												$contents_orig = $inline_find;

												switch (strtoupper($inline_action))
												{
													case 'IN-LINE-BEFORE-ADD':
														$status = $editor->inline_add($find, $inline_find, $inline_contents, 'BEFORE', $line['array_offset'], $line['string_offset'], $line['find_length']);
													break;

													case 'IN-LINE-AFTER-ADD':
														$status = $editor->inline_add($find, $inline_find, $inline_contents, 'AFTER', $line['array_offset'], $line['string_offset'], $line['find_length']);
													break;

													case 'IN-LINE-REPLACE':
													case 'IN-LINE-REPLACE-WITH':
														$status = $editor->inline_replace($find, $inline_find, $inline_contents, $line['array_offset'], $line['string_offset'], $line['find_length']);
													break;

													case 'IN-LINE-OPERATION':
														$status = $editor->inc_string($find, $inline_find, $inline_contents);
													break;

													default:
														trigger_error("Error, unrecognised command $inline_action"); // ERROR!
													break;
												}

												if ($status)
												{
													$inline_template_ary[] = array(
														'S_SUCCESS'	=> $status,

														'NAME'		=> $user->lang[$inline_action],
														'COMMAND'	=> (is_array($inline_contents)) ? $user->lang['INVALID_MOD_INSTRUCTION'] : htmlspecialchars($inline_contents),
														'COMMENT'	=> $inline_comment,
													);
												}
											}
										}
									break;

									default:
										trigger_error("Error, unrecognised command $type"); // ERROR!
									break;
								}

								$template->assign_block_vars('edit_files.finds.actions', array(
									'S_SUCCESS'	=> $status,

									'NAME'		=> $user->lang[$type],
									'COMMAND'	=> (is_array($contents_orig)) ? $user->lang['INVALID_MOD_INSTRUCTION'] : htmlspecialchars($contents_orig),
								));

								if (!$status)
								{
									$mod_installed = false;
								}

								// these vars must be assigned after the parent block or else things break
								if (sizeof($inline_template_ary))
								{
									foreach ($inline_template_ary as $inline_template)
									{
										$template->assign_block_vars('edit_files.finds.actions.inline', $inline_template);
									}
									$inline_template_ary = array();
								}
							}
						}

						$editor->close_edit();
					}
				}

				if ($change)
				{
					$status = $editor->close_file("{$this->edited_root}$filename");
					if (is_string($status))
					{
						$template->assign_block_vars('error', array(
							'ERROR'	=> $status,
						));

						$mod_installed = false;
					}
				}
			}
		} // end foreach

		// Move included files
		if (isset($actions['NEW_FILES']) && !empty($actions['NEW_FILES']) && $change && ($mod_installed || $force_install))
		{
			$template->assign_var('S_NEW_FILES', true);

			foreach ($actions['NEW_FILES'] as $source => $target)
			{
				$status = $editor->copy_content($this->mod_root . str_replace('*.*', '', $source), str_replace('*.*', '', $target));

				if ($status !== true)
				{
					$mod_installed = false;
				}

				$template->assign_block_vars('new_files', array(
					'S_SUCCESS'			=> ($status === true) ? true : false,
					'S_NO_COPY_ATTEMPT'	=> (is_null($status)) ? true : false,
					'SOURCE'			=> $source,
					'TARGET'			=> $target,
				));
			}
		}

		// Perform SQL queries last -- Queries usually cannot be done a second
		// time, so do them only if the edits were successful.  Still complies
		// with the MODX spec in this location
		if (!empty($actions['SQL']) && ($mod_installed || $force_install || ($display && !$change)))
		{
			$template->assign_var('S_SQL', true);

			parser::parse_sql($actions['SQL']);

			$db->sql_return_on_error(true);

			foreach ($actions['SQL'] as $query)
			{
				if ($change)
				{
					$query_success = $db->sql_query($query);

					if ($query_success)
					{
						$template->assign_block_vars('sql_queries', array(
							'S_SUCCESS'	=> true,
							'QUERY'		=> $query,
						));
					}
					else
					{
						$error = $db->sql_error();

						$template->assign_block_vars('sql_queries', array(
							'S_SUCCESS'	=> false,
							'QUERY'		=> $query,
							'ERROR_MSG'	=> $error['message'],
							'ERROR_CODE'=> $error['code'],
						));

						$mod_installed = false;
					}
				}
				else if ($display)
				{
					$template->assign_block_vars('sql_queries', array(
						'QUERY'	=> $query,
					));
				}
			}

			$db->sql_return_on_error(false);
		}
		else
		{
			$template->assign_var('S_SQL', false);
		}

		return $mod_installed;
	}

	/**
	* Search on the file system for other .xml files that belong to this MOD
	* @param string $mod_path - path to the "main" MODX file, relative to phpBB Root
	*/
	function find_children($mod_path)
	{
		$children = array();

		if ($this->parser->get_modx_version() == 1.2)
		{
			// TODO: eww, yuck ... processing the XML again?
			$details = $this->mod_details($mod_path, false);

			$children = $details['CHILDREN'];

			if (isset($children['template-lang']))
			{
				if (isset($children['template']))
				{
					$children['template'] = array_merge($children['template'], $children['template-lang']);
				}
				else
				{
					$children['template'] = $children['template-lang'];
				}

				unset($children['template-lang']);
			}
		}
		else if ($this->parser->get_modx_version() == 1.0)
		{
			$children = $this->find_mods(dirname($mod_path), 2);
		}

		return $children;
	}

	function handle_dependency(&$children)
	{
		if (isset($children['dependency']) && sizeof($children['dependency']))
		{
			// TODO: check for the chance that the MOD has been installed by AutoMOD
			// previously
			if (confirm_box(true))
			{
				// do nothing
			}
			else if (!isset($_REQUEST['dependency_confirm']))
			{
				global $user, $id, $mode, $action, $mod_path;

				$full_url_list = array();
				$message = '';
				foreach ($children['dependency'] as $dependency)
				{
					//$full_url_list[] = $dependency_url;
					$message .= sprintf($user->lang['DEPENDENCY_INSTRUCTIONS'], $dependency['href'], $dependency['title']) . '<br /><br />';
				}

				confirm_box(false, $message, build_hidden_fields(array(
						'dependency_confirm'	=> true,
						'mode'		=> $mode,
						'action'	=> $action,
						'mod_path'	=> urlencode($mod_path),
				)));
			}
		}
	}

	function handle_contrib(&$children)
	{
		global $template, $parent_id, $phpbb_root_path;

		if (isset($children['contrib']) && sizeof($children['contrib']))
		{
			$template->assign_var('S_CONTRIB_AVAILABLE', true);

			// there are things like upgrades...we don't care unless the MOD has previously been installed.
			foreach ($children['contrib'] as $xml_file)
			{
				// Another hack for supporting both versions of MODX
				$xml_file = (is_array($xml_file)) ? $xml_file['href'] : $xml_file;

				$child_details = $this->mod_details($xml_file, false);

				// don't do the urlencode until after the file is looked up on the
				// filesystem
				$xml_file = urlencode($xml_file);
				$child_details['U_INSTALL'] = $this->u_action . "&amp;action=install&amp;parent=$parent_id&amp;mod_path=$xml_file";

				$template->assign_block_vars('contrib', $child_details);
			}
		}
	}

	function handle_merge($type, &$actions, &$children, $process_files)
	{
		global $phpbb_root_path;

		if (!isset($children[$type]) || !sizeof($process_files))
		{
			return;
		}

		// add the actions to our $actions array...give praise to array_merge_recursive
		foreach ($process_files as $key => $void)
		{
			$children[$type][$key] = (is_array($children[$type][$key])) ? $children[$type][$key]['href'] : $children[$type][$key];

			// Prepend the proper directory structure if it is not already there
			if (isset($children[$type][$key]) && strpos($children[$type][$key], $this->mod_root) !== 0)
			{
				$children[$type][$key] = $this->mod_root . $children[$type][$key];
			}

			$actions_ary = $this->mod_actions($children[$type][$key]);

			if (!isset($actions_ary['NEW_FILES']))
			{
				$actions = array_merge_recursive($actions, $actions_ary);
				continue;
			}

			// perform some cleanup if the MOD author didn't specify the proper root directory
			foreach ($actions_ary['NEW_FILES'] as $source => $destination)
			{
				// if the source file does not exist, and languages/ is not at the beginning
				// this is probably only applicable with MODX 1.0.
				if (!file_exists($this->mod_root . $source) && strpos("{$type}s/", $source) === false)
				{
					// and it does exist if we force a languages/ into the path
					if (file_exists($this->mod_root . "{$type}s/" . $source))
					{
						// change the array key to include languages
						unset($actions_ary['NEW_FILES'][$source]);
						$actions_ary['NEW_FILES']["{$type}s/$source"] = $destination;
					}

					// else we let the error handling do its thing
				}
			}

			$actions = array_merge_recursive($actions, $actions_ary);
		}
	}

	function handle_language_prompt(&$children, &$elements, $action)
	{
		global $db, $template, $parent_id, $phpbb_root_path;

		if (isset($children['language']) && sizeof($children['language']))
		{
			// additional languages are available...find out which ones we may want to apply
			$sql = 'SELECT lang_id, lang_iso FROM ' . LANG_TABLE;
			$result = $db->sql_query($sql);

			$installed_languages = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$installed_languages[$row['lang_id']] = $row['lang_iso'];
			}
			$db->sql_freeresult($result);

			foreach ($children['language'] as $key => $tag)
			{
				// remove useless title from MODX 1.2.0 tags
				$children['language'][$key] = is_array($tag) ? $tag['href'] : $tag;
			}
			$children['language'] = array_unique($children['language']);

			// We _must_ have language xml files that are named "nl.xml" or "en-US.xml" for this to work
			// it appears that the MODX packaging standards call for this anyway
			$available_languages = array_map('core_basename', $children['language']);
			$process_languages = $elements['language'] = array_intersect($available_languages, $installed_languages);

			// $unknown_languages are installed on the board, but not provied for by the MOD
			$unknown_languages = array_diff($available_languages, $installed_languages);

			// there are langauges which are installed, but not provided for by the MOD
			// Inform the user.
			if (sizeof($unknown_languages) && $action == 'details')
			{
				// may wish to rename away from "unknown" for our details mode
				$template->assign_var('S_UNKNOWN_LANGUAGES', true);

				// get full names from the DB
				$sql = 'SELECT lang_english_name, lang_local_name, lang_iso FROM ' . LANG_TABLE . '
					WHERE ' . $db->sql_in_set('lang_iso', $unknown_languages);
				$result = $db->sql_query($sql);

				// alert the user.
				while ($row = $db->sql_fetchrow($result))
				{
					if ($parent_id)
					{
						// first determine which file we want to direct them to
						foreach ($children['language'] as $file)
						{
							if (core_basename($file) == $row['lang_iso'])
							{
								$xml_file = urlencode($file);
								break;
							}
						}
					}

					$template->assign_block_vars('unknown_lang', array(
						'ENGLISH_NAME'	=> $row['lang_english_name'],
						'LOCAL_NAME'	=> $row['lang_local_name'],
						'U_INSTALL'		=> ($parent_id) ? $this->u_action . "&amp;action=install&amp;parent=$parent_id&amp;mod_path=$xml_file" : '',
					));
				}
				$db->sql_freeresult($result);
			}

			return $process_languages;
		}
	}

	function handle_template_prompt(&$children, &$elements, $action)
	{
		global $db, $template, $phpbb_root_path, $parent_id;

		if (isset($children['template']) && sizeof($children['template']))
		{
			// additional styles are available for this MOD
			$sql = 'SELECT template_id, template_name FROM ' . STYLES_TEMPLATE_TABLE;
			$result = $db->sql_query($sql);

			$installed_templates = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$installed_templates[$row['template_id']] = $row['template_name'];
			}
			$db->sql_freeresult($result);

			foreach ($children['template'] as $key => $tag)
			{
				// remove useless title from MODX 1.2.0 tags
				$children['template'][$key] = is_array($tag) ? $tag['href'] : $tag;
			}
			$children['template'] = array_unique($children['template']);

			// We _must_ have language xml files that are named like "subsilver2.xml" for this to work
			$available_templates = array_map('core_basename', $children['template']);

			// $process_templates are those that are installed on the board and provided for by the MOD
			$process_templates = $elements['template'] = array_intersect($available_templates, $installed_templates);
		}
	}
}

?>