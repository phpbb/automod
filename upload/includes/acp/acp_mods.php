<?php
/**
*
* @package acp
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package acp
*/
class acp_mods
{
	var $u_action;
	var $mod_root = '';
	var $edited_root = '';

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


		// get any url vars
		$action = request_var('action', '');
		$mod_id = request_var('mod_id', 0);
		$mod_url = request_var('mod_url', '');
		$mod_path = request_var('mod_path', '');
		$parent = request_var('parent', 0);

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

				if (isset($_POST['submit']))
				{
					$ftp_host		= request_var('host', '');
					$ftp_username	= request_var('username', '');
					$ftp_password	= request_var('password', ''); // not stored, used to test connection
					$ftp_root_path	= request_var('root_path', '');
					$ftp_port		= request_var('port', 21);
					$ftp_timeout	= request_var('timeout', 10);
					$write_method	= request_var('write_method', 0);
					$compress_method	= request_var('compress_method', '');

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

						trigger_error($user->lang['MOD_CONFIG_UPDATED'] . adm_back_link($this->u_action));
					}
					else
					{
						$template->assign_var('ERROR', $user->lang[$error]);
					}
				}

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

				// implicit else
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

					'COMPRESS_METHOD'	=> $config['compress_method'],
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
						$this->pre_install($mod_path, $method);
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
		$available_mods = $this->find_mods("{$phpbb_root_path}store/mods", 1);

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

			$template->assign_block_vars('uninstalled', array(
				'MOD_NAME'	=> $details['MOD_NAME'],
				'MOD_PATH'	=> $details['MOD_PATH'],

				'U_INSTALL'	=> $this->u_action . '&amp;action=pre_install&amp;mod_path=' . $details['MOD_PATH'],
				'U_DETAILS'	=> $this->u_action . '&amp;action=details&amp;mod_path=' . $details['MOD_PATH'],
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
			'U_BACK'	=> $this->u_action
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
		global $phpbb_root_path, $phpEx, $user;

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
				$details = array(
					'MOD_ID'			=> $row['mod_id'],
					'MOD_PATH'			=> $row['mod_path'],
					'MOD_INSTALL_TIME'	=> $user->format_date($row['mod_time']),
					'MOD_DEPENDENCIES'	=> unserialize($row['mod_dependencies']), // ?
					'MOD_NAME'			=> htmlspecialchars($row['mod_name']),
					'MOD_DESCRIPTION'	=> nl2br($row['mod_description']),
					'MOD_VERSION'		=> $row['mod_version'],

					'AUTHOR_NOTES'	=> nl2br($row['mod_author_notes']),
					'AUTHOR_NAME'	=> $row['mod_author_name'],
					'AUTHOR_EMAIL'	=> $row['mod_author_email'],
					'AUTHOR_URL'	=> $row['mod_author_url']
				);

				if ($find_children)
				{
					$actions = array();
					$this->find_children($row['mod_path'], $actions, 'details', $mod_id);
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
			$mod_path = $mod_ident;

			$ext = substr(strrchr($mod_path, '.'), 1);

			$parser = new parser($ext);
			$parser->set_file($mod_path);

			$details = $parser->get_details();

			if ($find_children)
			{
				$actions = array();
				$this->find_children($mod_path, $actions, 'details');
			}

			unset($parser);
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
			$mod_path = $mod_ident;
			$actions = array();
			$ext = substr(strrchr($mod_path, '.'), 1);

			$parser = new parser($ext);
			$parser->set_file($mod_path);

			$actions = $parser->get_actions();

			unset($parser);
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

		$actions = $this->mod_actions($mod_path);
		$details = $this->mod_details($mod_path, false);

		$this->mod_root = dirname(str_replace($phpbb_root_path, '', $mod_path)) . '/';

		// check for "child" MODX files and attempt to decide which ones we need
		$elements = $this->find_children($mod_path, $actions, 'pre_install');

		$template->assign_vars(array(
			'S_PRE_INSTALL'	=> true,

			'MOD_PATH'		=> $mod_path,

			'U_INSTALL'		=> $this->u_action . '&amp;action=install&amp;mod_path=' . $mod_path,
			'U_BACK'		=> $this->u_action,
		));

		// get FTP information if we need it
		if ($config['write_method'] == WRITE_FTP)
		{
			$s_hidden_fields = build_hidden_fields(array('method' => $method));

			if (!class_exists($method))
			{
				trigger_error('Method does not exist.', E_USER_ERROR);
			}

			$requested_data = call_user_func(array($method, 'data'));
			foreach ($requested_data as $data => $default)
			{
				$default = (!empty($config['ftp_' . $data])) ? $config['ftp_' . $data] : $default;

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
				'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			));
		}

		$editor = new editor($phpbb_root_path, true);

		// Only display full actions if the user has requested them.
		if (!defined('DEBUG') && !isset($_GET['full_details']) || ($editor->write_method == WRITE_FTP && empty($_REQUEST['password'])))
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

		// mod_path empty?
		if (empty($mod_path))
		{
			// ERROR
			return false;
		}

		set_config('ftp_method',	request_var('method', ''));
		set_config('ftp_host',		request_var('host', ''));
		set_config('ftp_username',	request_var('username', ''));
		set_config('ftp_root_path', request_var('root_path', ''));
		set_config('ftp_port',		request_var('port', 21));
		set_config('ftp_timeout',	request_var('timeout', 10));

		$details = $this->mod_details($mod_path, false);
		$editor = new editor($phpbb_root_path);

		// get mod install root && make temporary edited folder root
		$this->mod_root = dirname(str_replace($phpbb_root_path, '', $mod_path)) . '/';
		$this->edited_root = "{$this->mod_root}_edited/";

		$actions = $this->mod_actions($mod_path);
		// only supporting one level of hierarchy here
		if (!$parent)
		{
			// check for "child" MODX files and attempt to decide which ones we need
			$elements = $this->find_children($mod_path, $actions, 'install');
		}

		// see if directory exists
		if (!file_exists($phpbb_root_path . $this->edited_root) && $editor->write_method == WRITE_DIRECT)
		{
			mkdir($phpbb_root_path . $this->edited_root, 0777);
			chmod($phpbb_root_path . $this->edited_root, 0777);
		}

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

		if ($editor->write_method != WRITE_MANUAL && ($mod_installed || $force_install))
		{
			// Move edited files back, and delete temp storage folder
			$status = $editor->copy_content($this->edited_root, '', $this->edited_root);

			if (is_string($status))
			{
				$mod_installed = false;

				$template->assign_block_vars('error', array(
					'ERROR'	=> $status,
				));
			}
		}
		else if ($mod_installed || $force_install)
		{
			// download the compressed file
			$editor->compress->close();
		}

		// Finish by sending template data
		$template->assign_vars(array(
			'S_INSTALL'		=> true,

			'U_RETURN'		=> $this->u_action,
		));

		// if MOD installed successfully, make a record.
		if (($mod_installed || $force_install) && !$parent)
		{
			// Insert database data
			$sql = 'INSERT INTO ' . MODS_TABLE . ' ' . $db->sql_build_array('INSERT', array(
				'mod_time'			=> (int) $editor->install_time,
				// @todo: Are dependencies part of the MODX Spec?
				'mod_dependencies'	=> (string) serialize($details['MOD_DEPENDENCIES']),
				'mod_name'			=> (string) $details['MOD_NAME'],
				'mod_description'	=> (string) $details['MOD_DESCRIPTION'],
				'mod_version'		=> (string) $details['MOD_VERSION'],
				'mod_path'			=> (string) $details['MOD_PATH'],
				'mod_author_notes'	=> (string) $details['AUTHOR_NOTES'],
				'mod_author_name'	=> (string) $details['AUTHOR_DETAILS'][0]['AUTHOR_NAME'],
				'mod_author_email'	=> (string) $details['AUTHOR_DETAILS'][0]['AUTHOR_EMAIL'],
				'mod_author_url'	=> (string) $details['AUTHOR_DETAILS'][0]['AUTHOR_WEBSITE'],
				'mod_actions'		=> (string) serialize($actions),
				'mod_languages'		=> (string) (isset($elements['languages']) && sizeof($elements['languages'])) ? implode(',', $elements['languages']) : '',
				'mod_template'		=> (string) (isset($elements['templates']) && sizeof($elements['templates'])) ? implode(',', $elements['templates']) : '',
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
			// this may be an insufficient match...
			if (strpos('language/', $mod_path) !== false)
			{
				$sql_ary['mod_languages'] = $row['mod_languages'] . ',' . core_basename($mod_path);
			}
			else if (strpos('template/', $mod_path) !== false)
			{
				$sql_ary['mod_template'] = $row['mod_template'] . ',' . core_basename($mod_path);
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

		if ($editor->write_method == WRITE_MANUAL && ($mod_installed || $force_install))
		{
			$editor->compress->download('mod_' . $editor->install_time, str_replace(' ', '_', $details['MOD_NAME']));
			exit;
		}
	}

	/**
	* Uninstall/pre uninstall a mod
	* @TODO: Allow uninstaller to use FTP & so forth
	*/
	function uninstall($action, $mod_id)
	{
		global $phpbb_root_path, $phpEx, $db, $template;

		// mod_id blank?
		if (!$mod_id)
		{
			// ERROR
			return false;
		}

		$editor = new editor($phpbb_root_path);
		$execute_edits = ($action == 'pre_uninstall') ? false : true;

		$template->assign_vars(array(
			'S_UNINSTALL'		=> $execute_edits,
			'S_PRE_UNINSTALL'	=> !$execute_edits,

			'MOD_ID'		=> $mod_id,

			'U_UNINSTALL'	=> $this->u_action . '&amp;action=uninstall&amp;mod_id=' . $mod_id,
			'U_RETURN'		=> $this->u_action,
		));

		// grab actions and details
		$actions = $this->mod_actions($mod_id);
		$details = $this->mod_details($mod_id, false);

		// process the actions
		$mod_uninstalled = $this->process_edits($editor, $actions, $details, $execute_edits, true, true);

		$template->assign_var('S_ERROR', !$mod_uninstalled);

		if ($execute_edits && $mod_uninstalled)
		{
			// Delete from DB
			$sql = 'DELETE FROM ' . MODS_TABLE . '
				WHERE mod_id = ' . $mod_id;
			$db->sql_query($sql);

			// Add log
			add_log('admin', 'LOG_MOD_REMOVE', $details['MOD_NAME']);
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
			$mods = array('main' => array(), 'contrib' => array(), 'templates' => array(), 'languages' => array());
			$recurse = 0;
		}
		else
		{
			static $mods = array('main' => array(), 'contrib' => array(), 'templates' => array(), 'languages' => array());
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
				else if (preg_match('#xml$#i', $file))
				{
					// if this is an "extra" MODX file, make a record of it as such
					// we are assuming the MOD follows MODX packaging standards here
					if (preg_match('#(contrib|templates|languages)#i', $dir, $match))
					{
						$mods[$match[1]][] = "$dir/$file";
					}
					else
					{
						$mods['main'][] = "$dir/$file";
					}
				}
			}
		}
		closedir($dp);

		return $mods;
	}

	function process_edits($editor, $actions, $details, $change = false, $display = true, $reverse = false)
	{
		global $template, $user, $db, $phpbb_root_path;

		$mod_installed = true;

		if ($reverse)
		{
			// maybe should allow for potential extensions here
			$actions = parser::reverse_edits($actions);
		}

		if (!empty($details['AUTHOR_NOTES']))
		{
			$template->assign_vars(array(
				'S_AUTHOR_NOTES'	=> true,

				'AUTHOR_NOTES'		=> nl2br($details['AUTHOR_NOTES']),
			));
		}

		// Move included files
		if (isset($actions['NEW_FILES']) && !empty($actions['NEW_FILES']) && $change)
		{
			$template->assign_var('S_NEW_FILES', true);

			foreach ($actions['NEW_FILES'] as $source => $target)
			{
				$status = $editor->copy_content($this->mod_root . str_replace('*.*', '', $source), str_replace('*.*', '', $target));

				if ($status === false)
				{
					$mod_installed = false;
				}

				$template->assign_block_vars('new_files', array(
					'S_SUCCESS'			=> $status,
					'S_NO_COPY_ATTEMPT'	=> (is_null($status) ? true : false),
					'SOURCE'			=> $source,
					'TARGET'			=> $target,
				));
			}
		}

		// Perform SQL queries
		if (isset($actions['SQL']) && !empty($actions['SQL']))
		{
			$template->assign_var('S_SQL', true);

			parser::parse_sql($actions['SQL']);

			$db->sql_return_on_error(true);

			foreach ($actions['SQL'] as $query)
			{
				if ($change)
				{
					$query_success = $db->sql_query($query);

					$template->assign_block_vars('sql_queries', array(
						'S_SUCCESS'	=> ($query_success) ? true : false,
						'QUERY'		=> $query,
					));

					if (!$query_success)
					{
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

		// not all MODs will have edits (!)
		if (!isset($actions['EDITS']))
		{
			return $mod_installed;
		}

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
			}
			else
			{
				$template->assign_block_vars('edit_files', array(
					'FILENAME'	=> $filename,
				));

				$template->assign_var('S_EDITS', true);

				$status = $editor->open_file($filename);
				if (is_string($status))
				{
					$template->assign_block_vars('error', array(
						'ERROR'	=> $status,
					));
				}

				foreach ($edits as $finds)
				{
					foreach ($finds as $find => $commands)
					{
						$template->assign_block_vars('edit_files.finds', array(
							'FIND_STRING'	=> htmlspecialchars($find),
						));

						// special case for FINDs with no action associated
						if (is_null($commands))
						{
							$editor->find($find);
							continue;
						}

						foreach ($commands as $type => $contents)
						{
							$status = false;
							$inline_template_ary = array();
							$contents_orig = $contents;

							switch (strtoupper($type))
							{
								case 'AFTER ADD':
									$status = $editor->add_string($find, $contents, 'AFTER');
								break;

								case 'BEFORE ADD':
									$status = $editor->add_string($find, $contents, 'BEFORE');
								break;

								case 'INCREMENT':
								case 'OPERATION':
									//$contents = "";
									$status = $editor->inc_string($find, '', $contents);
								break;

								case 'REPLACE WITH':
									$status = $editor->replace_string($find, $contents);
								break;

								case 'IN-LINE-EDIT':
									// these aren't quite as straight forward.  Still have multi-level arrays to sort through
									foreach ($contents as $inline_find => $inline_edit)
									{
										foreach ($inline_edit as $inline_action => $inline_contents)
										{
											// inline finds are pretty contancerous, so so them in the loop
											$line = $editor->inline_find($find, $inline_find);
											if (!$line)
											{
												// find failed
												$status = false;
												continue 2;
											}

											$inline_contents = $inline_contents[0];
											$contents = $contents_orig = $inline_contents;

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
													'NAME'		=> $user->lang[$inline_action],
													'COMMAND'	=> (is_array($inline_find)) ? $user->lang['INVALID_MOD_INSTRUCTION'] : htmlspecialchars($inline_find),
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

		return $mod_installed;
	}

	/**
	* Search on the file system for other .xml files that belong to this MOD
	* This method currently takes three parameters.
	* @param string $mod_path - path to the "main" MODX file, relative to phpBB Root
	* @param array &$actions - the current actions this MOD is using.
	*  -- Run through array_merge_recursive() to produce a final array after all calls to this method
	*  @param string $action - 'pre_install' || 'install' || 'details'
	*  @param int $parent_id - only valid in details mode, provides install link
	*/
	function find_children($mod_path, &$actions, $action, $parent_id = 0)
	{
		global $db, $template, $phpbb_root_path;

		$elements = array();
		$children = $this->find_mods(dirname($mod_path), 2);

		if (sizeof($children['contrib']) && $action == 'details')
		{
			$template->assign_var('S_CONTRIB_AVAILABLE', true);

			// there are things like upgrades...we don't care unless the MOD has previously been installed.
			foreach ($children['contrib'] as $xml_file)
			{
				$child_details = $this->mod_details($xml_file, false);
				$child_details['U_INSTALL'] = $this->u_action . "&amp;action=install&amp;parent=$parent_id&amp;mod_path=$xml_file";

				$template->assign_block_vars('contrib', $child_details);
			}
		}

		if (sizeof($children['languages']))
		{
			// additional languages are available...find out which ones we may want to apply
			// we don't care about english because it is included in the main MODX file
			$sql = 'SELECT lang_id, lang_iso FROM ' . LANG_TABLE . "
				WHERE lang_iso <> 'en'";
			$result = $db->sql_query($sql);

			$installed_languages = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$installed_languages[$row['lang_id']] = $row['lang_iso'];
			}

			// We _must_ have language xml files that are named "nl.xml" or "en-US.xml" for this to work
			// it appears that the MODX packaging standards call for this anyway
			$available_languages = array_map('core_basename', $children['languages']);
			$process_languages = $elements['templates'] = array_intersect($available_languages, $installed_languages);

			// $unknown_languages are installed on the board, but not provied for by the MOD
			$unknown_languages = array_diff($installed_languages, $available_languages);

			// these are langauges which are installed, but not provided for by the MOD
			if (sizeof($unknown_languages) && ($action == 'pre_install' || $action == 'details'))
			{
				// may wish to rename away from "unknown" for our details mode
				$template->assign_var('S_UNKNOWN_LANGUAGES', true);

				// get full names from the DB
				$sql = 'SELECT lang_english_name, lang_local_name FROM ' . LANG_TABLE . '
					WHERE ' . $db->sql_in_set('lang_iso', $unknown_languages);
				$result = $db->sql_query($sql);

				// alert the user.
				while ($row = $db->sql_fetchrow($result))
				{
					$template->assign_block_vars('unknown_lang', array(
						'ENGLISH_NAME'	=> $row['lang_english_name'],
						'LOCAL_NAME'	=> $row['lang_local_name'],
					));
				}
			}

			if (sizeof($process_languages) && ((defined('DEBUG') || isset($_GET['full_details'])) || $action == 'install'))
			{
				// add the actions to our $actions array...give praise to array_merge_recursive
				foreach ($process_languages as $key => $void)
				{
					$actions_ary = $this->mod_actions($children['languages'][$key]);

					if (!isset($actions_ary['NEW_FILES']))
					{
						$actions = array_merge_recursive($actions, $actions_ary);
						continue;
					}

					// perform some cleanup if the MOD author didn't specify the proper root directory
					foreach ($actions_ary['NEW_FILES'] as $source => $destination)
					{
						// if the source file does not exist, and languages/ is not at the beginning
						if (!file_exists($phpbb_root_path . $this->mod_root . $source) && strpos('languages/', $source) === false)
						{
							// and it does exist if we force a languages/ into the path
							if (file_exists($phpbb_root_path . $this->mod_root . 'languages/' . $source))
							{
								// change the array key to include templates/
								unset($actions_ary['NEW_FILES'][$source]);
								$actions_ary['NEW_FILES']['languages/' . $source] = $destination;
							}

							// else we let the error handling do its thing
						}
					}

					$actions = array_merge_recursive($actions, $actions_ary);
				}
			}
		}

		if (sizeof($children['templates']))
		{
			// additional styles are available for this MOD

			$sql = 'SELECT template_id, template_name FROM ' . STYLES_TEMPLATE_TABLE;
			$result = $db->sql_query($sql);

			$installed_templates = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$installed_templates[$row['template_id']] = $row['template_name'];
			}

			// We _must_ have language xml files that are named like "subSilver2.xml" for this to work
			$available_templates = array_map('core_basename', $children['templates']);

			// $process_templates are those that are installed on the board and provided for by the MOD
			$process_templates = $elements['templates'] = array_intersect($available_templates, $installed_templates);

			// $unknown_templates are installed on the board, but not provied for by the MOD
			$unknown_templates = array_diff($available_templates, $installed_templates);

			if (sizeof($unknown_templates) && ($action == 'pre_install' || $action == 'details'))
			{
				// prompt the user
				// consider Nuttzy-like behavior (attempt to apply another xml file to a template)
				$template->assign_var('S_UNKNOWN_TEMPLATES', true);

				foreach ($unknown_templates as $unknown_template)
				{
					$template->assign_block_vars('unknown_templates', array(
						'TEMPLATE_NAME'		=> $unknown_template,
					));
				}
			}

			if (sizeof($process_templates) && ((defined('DEBUG') || isset($_GET['full_details'])) || $action == 'install'))
			{
				// add the template actions to our $actions array...
				foreach ($process_templates as $key => $void)
				{
					$actions_ary = $this->mod_actions($children['templates'][$key]);

					if (!isset($actions_ary['NEW_FILES']))
					{
						$actions = array_merge_recursive($actions, $actions_ary);
						continue;
					}

					// perform some cleanup if the MOD author didn't specify the proper root directory
					foreach ($actions_ary['NEW_FILES'] as $source => $destination)
					{
						// if the source file does not exist, and templates/ is not at the beginning ...
						if (!file_exists($phpbb_root_path . $this->mod_root . $source) && strpos('templates/', $source) === false)
						{
							// and it does exist if we force a templates/ into the path
							if (file_exists($phpbb_root_path . $this->mod_root . 'templates/' . $source))
							{
								// change the array key to include templates/
								unset($actions_ary['NEW_FILES'][$source]);
								$actions_ary['NEW_FILES']['templates/' . $source] = $destination;
							}

							// else we let the error handling do its thing
						}
					}

					$actions = array_merge_recursive($actions, $actions_ary);
				}
			}
		}

		return $elements;
	}
}

?>