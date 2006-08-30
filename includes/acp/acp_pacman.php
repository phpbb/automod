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
class acp_pacman
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $cache;
		global $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;


		$user->add_lang('acp/pacman');
		$this->tpl_name = 'acp_pacman';
		$this->page_title = 'ACP_PACMAN';

		$action = request_var('action', '');
		$package_id = request_var('package_id', 0);
		$package_url = request_var('package_url', '');
		$package_path = request_var('package_path', '');

		switch ($mode)
		{
			// show intro
			case 'intro':
			
				$template->assign_vars(array(
					'S_INTRO'		=> true)
				);
				
				return;

			break;

			// manage packages
			case 'manage':

				if ($package_id && $action == 'remove')
				{
					// Uninstalling a package
					if (confirm_box(true))
					{
						$this->uninstall_package($package_id);
					}
					else
					{
						confirm_box(false, 'REMOVE_PACKAGE', build_hidden_fields(array(
							'i'				=> $id,
							'mode'			=> $mode,
							'action'		=> $action,
							'package_id'	=> $package_id,
						)));
					}
				}
				elseif ($package_id && $action == 'info')
				{
					// Get installed package info
					$this->show_package_info($package_id);
				}
				else
				{
					// Show all installed packages
					$this->show_installed_packages();
				}

			break;

			// browsing local packages
			case 'browse':
				
				if ($package_path && $action == 'install')
				{
					// The good bit
					$this->pre_install_package($package_path);
				}
				elseif ($package_id && $action == 'finish')
				{
					// Finish install
					$this->finish_install_package($package_id);
				}
				elseif ($package_path && $action == 'check_install')
				{
					// Check package before installing (present to user)
					$this->check_package($package_path);
				}
				elseif ($package_path && $action == 'delete')
				{
					// Deleting a local Package
					if (confirm_box(true))
					{
						$this->remove_package($package_path);
					}
					else
					{
						confirm_box(false, 'DELETE_PACKAGE', build_hidden_fields(array(
							'i'				=> $id,
							'mode'			=> $mode,
							'action'		=> $action,
							'package_path'	=> $package_path,
						)));
					}
				}
				elseif ($package_path && $action == 'info')
				{
					// Get local package info
					$this->show_package_info($package_path);
				}
				else
				{
					// TODO: feed stuff

					// Show available packages
					$this->show_local_packages();
				}

			break;

			// uploading
			case 'upload':
			
				if (isset($_POST['submit']))
				{
					$this->upload_package($package_url);
				}

				$template->assign_vars(array(
					'U_ACTION'		=> $this->u_action,
					'S_UPLOAD'		=> true)
				);

			break;
		}
	}

	/**
	* List all the installed packages
	*/
	function show_installed_packages()
	{
		global $db, $template;

		$template->assign_vars(array(
			'S_MANAGE'		=> true)
		);

		$sql = 'SELECT *
			FROM ' . PACKAGE_TABLE;
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('packages', array(
				'PACKAGE_ID'			=> $row['package_id'],
				'PACKAGE_NAME'			=> $row['package_name'],
				'PACKAGE_DESC'			=> $row['package_desc'],
				'PACKAGE_VERSION'		=> $row['package_version'],
				'PACKAGE_PATH'			=> $row['package_path'],
				'PACKAGE_AUTHOR_NAME'	=> $row['package_author_name'],
				'PACKAGE_AUTHOR_EMAIL'	=> $row['package_author_email'],
				'PACKAGE_AUTHOR_URL'	=> $row['package_author_url'],

				'U_INFO'	=> $this->u_action . '&amp;action=info&amp;package_id=' . $row['package_id'],
				'U_REMOVE'	=> $this->u_action . '&amp;action=remove&amp;package_id=' . $row['package_id'])
			);
		}
		$db->sql_freeresult($result);

		return;
	}

	/**
	* Show all packages available locally
	* @todo: option to select ANy file from local? (overriding find install file function)
	*/
	function show_local_packages()
	{
		global $phpbb_root_path, $template;

		$template->assign_vars(array(
			'S_BROWSE'		=> true)
		);

		// Show available packages
		$packages = array();
		$install_files = $this->find_install_files("{$phpbb_root_path}packages");

		foreach($install_files as $file)
		{
			$packages[] = $this->get_package_details($file);
			$last = array_pop($packages);

			if(!($last == false))
			{
				$packages[] = $last;
			}
		}

		foreach($packages as $row)
		{
			$template->assign_block_vars('local', array(
				'PACKAGE_NAME'			=> $row['name'],
				'PACKAGE_DESC'			=> $row['desc'],
				'PACKAGE_VERSION'		=> $row['version'],
				'PACKAGE_PATH'			=> $row['path'],
				'PACKAGE_AUTHOR_NAME'	=> $row['author_name'],
				'PACKAGE_AUTHOR_EMAIL'	=> (strstr($row['author_email'], '@')) ? $row['author_email']: '',
				'PACKAGE_AUTHOR_URL'	=> (strstr($row['author_url'], '.')) ? $row['author_url']: '',

				'U_INSTALL'	=> $this->u_action . '&amp;action=check_install&amp;package_path=' . $row['path'],
				'U_INFO'	=> $this->u_action . '&amp;action=info&amp;package_path=' . $row['path'],
				'U_DELETE'	=> $this->u_action . '&amp;action=delete&amp;package_path=' . $row['path'])
			);
		}
		
		return;
	}

	/**
	* show installed/local package info in depth
	*/
	function show_package_info($package_id)
	{
		global $template;

		$template->assign_vars(array(
			'S_INFO'	=> true)
		);

		if (is_string($package_id))
		{
		
		}
		else
		{
		
		}

		return;
	}

	/**
	* Upload a package
	* @todo: MORE ERROR HANDLING NEEDED
	* @todo: IF its a zip, UNZIP!
	* @todo: use bloody FTP
	*/
	function upload_package($package_url = '')
	{
		global $phpbb_root_path, $phpEx, $user;

		include($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
		$upload = new fileupload('', array('mod', 'zip', 'txt'));

		if (!empty($package_url))
		{
			$file = $upload->remote_upload($package_url);
			$uploading = true;
		}
		elseif (!empty($_FILES['package_file']['name']))
		{
			$file = $upload->form_upload('package_file');
			$uploading = true;
		}

		if (isset($uploading))
		{
			$file->clean_filename('real', 'install_');
			$file->move_file('packages');
			
			if (sizeof($file->error))
			{
				$file->remove();
				die('Error Uploading.. (Explain errors here, with $file->error)');
			}
		}

		trigger_error($user->lang['PACKAGE_UPLOADED'] . adm_back_link($this->u_action));

		return;
	}

	/**
	* Run though a package pre install
	*/
	function check_package($package_path)
	{
		global $phpbb_root_path, $template;

		$template->assign_vars(array(
			'S_PREPARE_INSTALL'		=> true)
		);

		$actions = $this->get_package_actions($package_path);

		// show copys
		if (isset($actions['copy']))
		{
			foreach($actions['copy'] as $source => $target)
			{
				$template->assign_block_vars('new_files', array(
					'SOURCE'		=> $source,
					'TARGET'		=> $target)
				);
			}
		}

		// show actions
		if (isset($actions['edit']))
		{
			foreach ($actions['edit'] as $file => $finds)
			{
				$template->assign_block_vars('edit_files', array(
					'FILENAME'	=> $file
				));
				
				foreach ($finds as $find => $actions)
				{
					// TODO: check for find string
					if('TEMP, CANNOT FIND STRING IN FILE?')
					{
					
					}

					$template->assign_block_vars('edit_files.finds', array(
						'FIND_STRING'	=> htmlspecialchars($find)
					));
					
					foreach($actions as $name => $command)
					{
						$template->assign_block_vars('edit_files.finds.actions', array(
							'NAME'		=> $name,
							'COMMAND'	=> htmlspecialchars($command),
						));
					}
				}
			}
		}

		$template->assign_vars(array(
			'AUTHOR_NOTES'	=> $this->get_package_notes($package_path),
			'PACKAGE_PATH'	=> $package_path,
			
			'U_INSTALL'		=> $this->u_action . '&amp;action=install&amp;package_path=' . $package_path)
		);

		return;
	}

	/**
	* Install a package
	* Makes file edits to processed store, and inserts package info into DB
	*/
	function pre_install_package($package_path)
	{
		global $db, $phpbb_root_path, $phpEx, $user, $template;

		$actions = $this->get_package_actions($package_path);
		$details = $this->get_package_details($package_path);

		$store = substr(strrchr($package_path, '/'), 1) . '_' . time(); //?
		include($phpbb_root_path . 'includes/editor.' . $phpEx);
		$editor = new editor($phpbb_root_path, "{$phpbb_root_path}packages/processed/$store");

		// preform file edits
		if (isset($actions['edit'])) // this is some beefy looping
		{
			foreach($actions['edit'] as $filename => $finds)
			{
				$editor->open_file($filename);

				foreach($finds as $string => $commands)
				{
					foreach($commands as $type => $contents)
					{
						switch(strtoupper($type)) // preg match different langs
						{
							case 'AFTER, ADD':
								$editor->add_string($filename, $string, $contents, AFTER);
							break;
							
							case 'BEFORE, ADD':
								$editor->add_string($filename, $string, $contents, AFTER);
							break;

							case 'INCREMENT':
								$editor->inc_string($filename, $string, $contents);
							break;

							case 'REPLACE WITH':
								$editor->replace_string($filename, $string, $contents);
							break;

							default:
								die("Error, unrecognised command $type");
							break;
						}
					}
				}

				$editor->close_file($filename);
			}
		}

		// get package install root
		$package_root = explode('/', str_replace($phpbb_root_path, '', $package_path));
		array_pop($package_root);
		$package_root = implode('/', $package_root);

		// move included files
		if (isset($actions['copy']))
		{
			foreach($actions['copy'] as $src => $to)
			{
				$editor->copy_content($package_root . '/' . str_replace('*.*', '', $src), str_replace('*.*', '', $to));
			}
		}

		// insert database data
		$sql = 'INSERT INTO ' . PACKAGE_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'package_name'			=> (string) $details['name'],
			'package_desc'			=> (string) $details['desc'],
			'package_version'		=> (string) $details['version'],
			'package_path'			=> (string) str_replace("{$phpbb_root_path}packages/", '', $package_path), 
			'package_store'			=> (string) str_replace("{$phpbb_root_path}packages/processed/", '', $editor->store), 
			'package_author_name'	=> (string) $details['author_name'],
			'package_author_email'	=> (string) $details['author_email'],
			'package_author_url'	=> (string) $details['author_url'],
		));
		$db->sql_query($sql);

		// get package id
		$package_id = $db->sql_nextid();

		// write log
		$write_log = serialize($actions);
		$io = new io('', $editor->store);
		$io->write_content('actions.log', $write_log);
		unset($io);

		$template->assign_vars(array(
			'U_INSTALL'		=> $this->u_action . '&amp;action=finish&amp;package_id=' . $package_id,
		
			'S_RESULTS'		=> true)
		);

		return;
	}

	/**
	* Finish installing a package
	* Moves processed, and executes SQL
	*/
	function finish_install_package($package_id)
	{
		global $db, $user, $phpbb_root_path, $phpEx;

		// get store
		$sql = 'SELECT package_path, package_store
			FROM ' . PACKAGE_TABLE . "
				WHERE package_id = $package_id";
		$result = $db->sql_query($sql);
		if ($row = $db->sql_fetchrow($result))
		{
			$package_store = $row['package_store'];
			$package_path = $row['package_path'];
		}

		// move files
		include($phpbb_root_path . 'includes/editor.' . $phpEx);
		$io = new io("{$phpbb_root_path}packages/processed/{$package_store}/", "{$phpbb_root_path}");
		
		$io->copy_content('./', './', array('actions.log'));

		unset($io);

		// do SQL

		// use log to show results?

		// tada!
		trigger_error($user->lang['PACKAGE_INSTALLED'] . adm_back_link($this->u_action));

		return;
	}

	/**
	* Uninstall a package
	*/
	function uninstall_package($package_id)
	{
		global $db, $user;

		$package_id = (int) $package_id;

		// do stuff

		
		// Remove DB entry
		$sql = 'DELETE FROM ' . PACKAGE_TABLE . "
			WHERE package_id = $package_id";
		$db->sql_query($sql);

		trigger_error($user->lang['PACKAGE_REMOVED'] . adm_back_link($this->u_action));

		return;
	}
	
	/**
	* Remove a local package
	*/
	function remove_package($package_path)
	{
		global $phpbb_root_path, $user;

		list(, $package_subpath) = explode('packages/', $package_path);

		if(strstr($package_subpath, '/'))
		{
			list($package_root) = explode('/', $package_subpath);
			$this->remove_dir("{$phpbb_root_path}/packages/{$package_root}");
		}
		else
		{
			@unlink($package_path);
		}

		trigger_error($user->lang['PACKAGE_DELETED'] . adm_back_link($this->u_action));

		return;
	}

	/**
	* Removes a directory and any subfiles
	*/
	function remove_dir($dir)
	{
		$dp = opendir($dir);
		while (($file = readdir($dp)) !== false)
		{
			if ($file{0} != '.')
			{
				if (is_dir("{$dir}/{$file}"))
				{
					$this->remove_dir("{$dir}/{$file}");
				}
				else
				{
					@unlink("{$dir}/{$file}");
				}
			}
		}
		@closedir($dp);

		if (!@rmdir($dir))
		{
			return false;
		}

		return true;
	}

	/**
	* Returns array of available install files in dir
	* Tis recurrsive
	*/
	function find_install_files($dir)
	{
		$install_files = array();

		$dp = opendir($dir);
		while (($file = readdir($dp)) !== false)
		{
			if ($file{0} != '.')
			{
				if (is_dir("{$dir}/{$file}"))
				{
					$install_files = array_merge($install_files, $this->find_install_files("{$dir}/{$file}"));
				}
				elseif (stristr($file, 'install')) // Very simple, beef up
				{
					$install_files[] = "{$dir}/{$file}";
				}
			}
		}

		return $install_files;
	}
	
	/**
	* Returns array of install file details
	* @todo: need to streamline/join/combine thse various parser wrappers
	*/
	function get_package_details($package_path)
	{
		global $phpbb_root_path, $phpEx;

		$details = array();
		$ext = substr(strrchr($package_path, '.'), 1);
		
		include_once($phpbb_root_path . 'includes/package_parser.' . $phpEx);
		$parser = new parser($ext);
		$parser->set_file($package_path);
		
		$details = $parser->get_details();

		unset($parser);

		return $details;
	}

	/**
	* Returns array of install file details
	*/
	function get_package_notes($package_path)
	{
		global $phpbb_root_path, $phpEx;

		$ext = substr(strrchr($package_path, '.'), 1);
		
		include_once($phpbb_root_path . 'includes/package_parser.' . $phpEx);
		$parser = new parser($ext);
		$parser->set_file($package_path);
		
		$notes = $parser->get_notes();

		unset($parser);

		return $notes;
	}
	
	/**
	* Returns complex array of all package actions
	*/
	function get_package_actions($package_path)
	{
		global $phpbb_root_path, $phpEx;

		$actions = array();
		$ext = substr(strrchr($package_path, '.'), 1);
		
		include_once($phpbb_root_path . 'includes/package_parser.' . $phpEx);
		$parser = new parser($ext);
		$parser->set_file($package_path);
		
		$actions = $parser->get_actions();

		unset($parser);

		return $actions;
	}

}

?>