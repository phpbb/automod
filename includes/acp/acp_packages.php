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
class acp_packages
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $cache;
		global $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;


		$user->add_lang('acp/packages');
		$this->tpl_name = 'acp_packages';
		$this->page_title = 'ACP_CAT_PACKAGES';

		$action = request_var('action', '');
		$package_id = request_var('package_id', 0);
		$package_url = request_var('package_url', '');
		$package_path = request_var('package_path', '');

		switch ($mode)
		{
			case 'frontend':

				switch ($action)
				{
					case 'pre_install':
						if(!empty($package_path))
						{
							$this->pre_install($package_path);
						}
						else
						{
							// ERROR, NO PACKAGE PATH SENT
						}
					break;
					
					case 'install':
						if(!empty($package_path))
						{
							$this->install($package_path);
						}
						else
						{
							// ERROR, NO PACKAGE PATH SENT
						}
					break;
					
					case 'pre_uninstall':
						if(!empty($package_id))
						{
							$this->pre_uninstall($package_id);
						}
						else
						{
							// ERROR, NO PACKAGE ID SENT
						}
					break;
					
					case 'uninstall':
						if(!empty($package_id))
						{
							$this->uninstall($package_id);
						}
						else
						{
							// ERROR, NO PACKAGE ID SENT
						}
					break;
					
					case 'information':
						if($package_id)
						{
							$this->list_information($package_id);
						}
						elseif(!empty($package_path))
						{
							$this->list_information($package_path);
						}
						else
						{
							// ERROR, NO PACKAGE IDENT SENT
						}
					break;
					
					default:
						$template->assign_vars(array(
							'S_FRONTEND'		=> true)
						);
						
						$this->list_installed();
						$this->list_uninstalled();
					break;
				}
				
				return;

			break;

		}
	}

	/**
	* List all the installed packages
	*/
	function list_installed()
	{
		global $db, $template;

		$sql = 'SELECT *
			FROM ' . PACKAGE_TABLE . '
				WHERE package_active = 1';
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('installed', array(
				'ID'			=> $row['package_id'],
				'NAME'			=> $row['package_name'],

				'U_INFORMATION'	=> $this->u_action . '&amp;action=information&amp;package_id=' . $row['package_id'],
				'U_UNINSTALL'		=> $this->u_action . '&amp;action=pre_uninstall&amp;package_id=' . $row['package_id'])
			);
		}
		$db->sql_freeresult($result);

		return;
	}

	/**
	* List all packages available locally
	*/
	function list_uninstalled()
	{
		global $phpbb_root_path, $db, $template;

		// Show available packages
		$packages = array();
		$uninstalled = $this->find_packages("{$phpbb_root_path}packages"); // CONFIG PACKAGE PATH?

		// Get installed paths
		$installed_paths = array();
		$sql = 'SELECT package_path
			FROM ' . PACKAGE_TABLE . '
				WHERE package_active = 1';
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$installed_paths[] = $row['package_path'];
		}
		
		foreach($uninstalled as $file)
		{
			$packages[] = $this->package_information($file);
			$last = array_pop($packages);

			if(!($last == false))
			{
				$packages[] = $last;
			}
		}

		foreach($packages as $information)
		{
			if(!in_array($information['PATH'], $installed_paths))
			{
				$template->assign_block_vars('uninstalled', array(
					'NAME'			=> $information['NAME'],
					'PATH'			=> $information['PATH'],
		
					'U_INSTALL'	=> $this->u_action . '&amp;action=pre_install&amp;package_path=' . $information['PATH'],
					'U_INFORMATION'	=> $this->u_action . '&amp;action=information&amp;package_path=' . $information['PATH'],
				));
			}
		}
		
		return;
	}
	
	/**
	* Lists package details
	*/
	function list_information($package_ident)
	{
		global $template;

		$template->assign_vars(array(
			'S_INFORMATION'		=> true,
			'U_BACK'			=> $this->u_action)
		);				
						
		$information = $this->package_information($package_ident);
		$template->assign_vars($information);

		if(!empty($information['AUTHOR_NOTES']))
		{
			$template->assign_var('S_AUTHOR_NOTES', true);
		}
		if(isset($information['INSTALL_TIME']) && !empty($information['INSTALL_TIME']))
		{
			$template->assign_var('S_INSTALL_TIME', true);
		}

		return;
	}
	
	/**
	* Returns array of available package install files in dir
	* Tis recurrsive
	*/
	function find_packages($dir)
	{
		$packages = array();

		$dp = opendir($dir);
		while (($file = readdir($dp)) !== false)
		{
			if ($file{0} != '.')
			{
				if (is_dir("{$dir}/{$file}"))
				{
					$packages = array_merge($packages, $this->find_packages("{$dir}/{$file}"));
				}
				elseif (stristr($file, 'install')) // Very simple, beef up
				{
					$packages[] = "{$dir}/{$file}";
				}
			}
		}

		return $packages;
	}
	
	/**
	* Returns array of package information
	*/
	function package_information($package_ident)
	{
		global $phpbb_root_path, $phpEx;
		
		if(is_int($package_ident))
		{
			global $db;

			$package_id = intval($package_ident);

			$sql = 'SELECT *
				FROM ' . PACKAGE_TABLE . "
					WHERE package_id = $package_id";
			$result = $db->sql_query($sql);
			if ($row = $db->sql_fetchrow($result))
			{
				$information = array(
					'ID'			=> $row['package_id'],
					'INSTALL_TIME'	=> $row['package_time'],
					'DEPENDENCIES'	=> unserialize($row['package_dependencies']),
					'NAME'			=> htmlspecialchars($row['package_name']),
					'DESCRIPTION'	=> htmlspecialchars($row['package_description']),
					'VERSION'		=> $row['package_version'],
					'PATH'			=> $row['package_path'],
					'AUTHOR_NOTES'	=> $row['package_author_notes'],
					'AUTHOR_NAME'	=> $row['package_author_name'],
					'AUTHOR_EMAIL'	=> $row['package_author_email'],
					'AUTHOR_URL'	=> $row['package_author_url']
				);
			}
			else
			{
				// ERROR, MISSING PACKAGE ID
			}
			$db->sql_freeresult($result);
		}
		else
		{
			$package_path = $package_ident; // Secure, Check?
			
			$ext = substr(strrchr($package_path, '.'), 1);

			include_once($phpbb_root_path . 'includes/package_parser.' . $phpEx);
			$parser = new parser($ext);
			$parser->set_file($package_path);

			$information = $parser->get_information();

			unset($parser);
		}
		
		return $information;
	}

	/**
	* Returns complex array of all package actions
	*/
	function package_actions($package_ident)
	{
		global $phpbb_root_path, $phpEx;

		if(is_int($package_ident))
		{
			global $db;
			
			$sql = 'SELECT *
				FROM ' . PACKAGE_TABLE . "
					WHERE package_id = $package_ident";
			$result = $db->sql_query($sql);
			if ($row = $db->sql_fetchrow($result))
			{
				return unserialize($row['package_actions']);
			}
		}
		else
		{
			$package_path = $package_ident;
			$actions = array();
			$ext = substr(strrchr($package_path, '.'), 1);

			include_once($phpbb_root_path . 'includes/package_parser.' . $phpEx);
			$parser = new parser($ext);
			$parser->set_file($package_path);
			
			$actions = $parser->get_actions();

			unset($parser);
		}
		return $actions;
	}
	
	/**
	* Parses and displays all Edits, Copies, and SQL modifcations
	*/
	function pre_install($package_path)
	{
		global $phpbb_root_path, $phpEx, $template;

		$actions = $this->package_actions($package_path);
		$information = $this->package_information($package_path);
		
		include($phpbb_root_path . 'includes/editor.' . $phpEx);
		$editor = new editor($phpbb_root_path);
		
		$package_root = explode('/', str_replace($phpbb_root_path, '', $package_path));
		array_pop($package_root);
		$package_root = implode('/', $package_root) . '/';
		
		$dependenices = $information['DEPENDENCIES'];
						
		$template->assign_vars(array(
			'S_PRE_INSTALL'		=> true,
			
			'PACKAGE_PATH'	=> $package_path,

			'U_INSTALL'		=> $this->u_action . '&amp;action=install&amp;package_path=' . $package_path,
			'U_BACK'			=> $this->u_action)
		);
		
		// Show author notes
		if(!empty($information['AUTHOR_NOTES']))
		{
			$template->assign_vars(array(
				'S_AUTHOR_NOTES'	=> $information['AUTHOR_NOTES'],
				
				'AUTHOR_NOTES'		=> $information['AUTHOR_NOTES'])
			);
		}
		
		// Show new files
		if (isset($actions['NEW_FILES']) && !empty($actions['NEW_FILES']))
		{
			$template->assign_vars(array(
				'S_NEW_FILES'		=> true)
			);

			foreach($actions['NEW_FILES'] as $source => $target)
			{
				if((!file_exists("{$phpbb_root_path}{$package_root}{$source}")) && (!strpos($source, '*.*')))
				{
					$template->assign_block_vars('new_files', array(
						'S_MISSING_FILE' => true,
						
						'SOURCE'		=> $source,
						'TARGET'		=> $target)
					);
				}
				else
				{
					$template->assign_block_vars('new_files', array(
						'SOURCE'		=> $source,
						'TARGET'		=> $target)
					);
				}
			}
		}
		
		// Show SQL
		if (isset($actions['SQL']) && !empty($actions['SQL']))
		{
			$template->assign_vars(array(
				'S_SQL'		=> true)
			);

			foreach($actions['SQL'] as $query)
			{
				$template->assign_block_vars('sql_queries', array(
					'QUERY'		=> $query)
				);
			}
		}
		
		// Show edits
		if(isset($actions['EDITS']) && !empty($actions['EDITS']))
		{
			$template->assign_vars(array(
				'S_EDITS'		=> true)
			);
			
			foreach ($actions['EDITS'] as $file => $finds)
			{
				if(!file_exists("{$phpbb_root_path}{$file}"))
				{
					$template->assign_block_vars('edit_files', array(
						'S_MISSING_FILE' => true,
						
						'FILENAME'	=> $file
					));
				}
				else
				{
					$template->assign_block_vars('edit_files', array(
						'FILENAME'	=> $file
					));
				
					$editor->open_file($file);

					$editor->fold_edits($file, $dependenices);
					
					foreach ($finds as $find => $actions)
					{
						if(!$editor->check_find($file, $find))
						{
							$template->assign_block_vars('edit_files.finds', array(
								'S_MISSING_FIND'	=> true,

								'FIND_STRING'	=> htmlspecialchars($find)
							));
						}
						else
						{
							$template->assign_block_vars('edit_files.finds', array(
								'FIND_STRING'	=> htmlspecialchars($find)
							));
							
							foreach($actions as $name => $command)
							{
								$template->assign_block_vars('edit_files.finds.actions', array(
									'NAME'		=> $name, // LANG!
									'COMMAND'	=> htmlspecialchars($command),
								));
							}
						}
					}
					
					$editor->unfold_edits($file, $dependenices);

					$editor->close_file($file);
				}
			}
		}

		return;
	}

	/**
	* Preforms all Edits, Copies, and SQL queries
	* TODO: this should use a file created from the pre install?
	*/
	function install($package_path)
	{
		global $phpbb_root_path, $phpEx, $db, $template;

		$actions = $this->package_actions($package_path);
		$information = $this->package_information($package_path);
		
		// Insert database data
		$sql = 'INSERT INTO ' . PACKAGE_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'package_time'			=> (int) time(),
			'package_dependencies'	=> (string) serialize($information['DEPENDENCIES']),
			'package_name'			=> (string) $information['NAME'],
			'package_description'	=> (string) $information['DESCRIPTION'],
			'package_version'		=> (string) $information['VERSION'],
			'package_path'			=> (string) $information['PATH'],
			'package_author_notes'	=> (string) $information['AUTHOR_NOTES'],
			'package_author_name'	=> (string) $information['AUTHOR_NAME'],
			'package_author_email'	=> (string) $information['AUTHOR_EMAIL'],
			'package_author_url'	=> (string) $information['AUTHOR_URL'],
			'package_actions'		=> (string) serialize($actions),
		));
		$db->sql_query($sql);
		
		// get package id
		$package_id = $db->sql_nextid();
		
		include($phpbb_root_path . 'includes/editor.' . $phpEx);
		$editor = new editor($phpbb_root_path);
		
		// get package install root && make temporary edited folder root
		$package_root = explode('/', str_replace($phpbb_root_path, '', $package_path));
		array_pop($package_root);
		$package_root = implode('/', $package_root) . '/';
		$edited_root = "{$package_root}_edited/";
		
		// get package dependencies
		// This will be the _PHPBB ID_ for any package that this package requires
		// The fold/unfold edit functions below will ignore any edits preformed by any package with the ID in this array
		$dependenices = $information['DEPENDENCIES'];
		$package_phpbb_id = (!empty($information['PHPBB_ID'])) ? $information['PHPBB_ID'] : $package_id;

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

					$editor->fold_edits($filename, $dependenices);
					
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
									$contents = $editor->add_anchor($contents, $file_ext, $package_phpbb_id);
									$status = $editor->add_string($filename, $string, $contents, 'AFTER');
								break;
								
								case 'BEFORE, ADD':
									$contents = $editor->add_anchor($contents, $file_ext, $package_phpbb_id);
									$status = $editor->add_string($filename, $string, $contents, 'BEFORE');
								break;

								case 'INCREMENT':
									//$contents = "";
									$status = $editor->inc_string($filename, $string, $contents);
								break;

								case 'REPLACE WITH':
									//$contents = $editor->add_wrap($string, $file_ext, $package_phpbb_id) . "\n{$contents}";
									$contents = $editor->add_anchor($contents, $file_ext, $package_phpbb_id);
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

					$editor->unfold_edits($filename, $dependenices);

					$editor->close_file($filename, "{$edited_root}{$filename}");
				
				}
			}
		}

		// Move included files
		if (isset($actions['NEW_FILES']) && !empty($actions['NEW_FILES']))
		{
			$template->assign_vars(array(
				'S_NEW_FILES'		=> true)
			);
	
			foreach($actions['NEW_FILES'] as $source => $target)
			{
				if(!$editor->copy_content($package_root . str_replace('*.*', '', $source), str_replace('*.*', '', $target)))
				{
					$template->assign_block_vars('new_files', array(
						'SOURCE'		=> $source,
						'TARGET'		=> $target)
					);
				}
				else
				{
					$template->assign_block_vars('new_files', array(
						'S_SUCCESS'	=> true,
					
						'SOURCE'		=> $source,
						'TARGET'		=> $target)
					);
				}
			}
		}

		// Preform SQL queries
		if (isset($actions['SQL']) && !empty($actions['SQL']))
		{
			$template->assign_vars(array(
				'S_SQL'		=> true)
			);
		
			foreach($actions['SQL'] as $query)
			{
				if(!$db->sql_query($query)) // more than this please
				{
					$template->assign_block_vars('sql_queries', array(
						'QUERY'		=> $row['package_id'],
					));
				}
				else
				{
					$template->assign_block_vars('sql_queries', array(
						'S_SUCCESS'	=> true,

						'QUERY'		=> $query,
					));
				}
			}
		}

		// Move edited files back, and delete temp stoarge folder
		$editor->copy_content($edited_root, '');
		
		// Add log
		add_log('admin', 'LOG_PACKAGE_ADD', $information['NAME']);
		
		// Finish, by sending template data
		$template->assign_vars(array(
			'S_INSTALL'		=> true,

			'U_RETURN'		=> $this->u_action)
		);
			
	}

	/**
	* Uninstall a package
	*/
	function pre_uninstall($package_id)
	{
		global $phpbb_root_path, $phpEx, $template;
		
		$template->assign_vars(array(
			'S_PRE_UNINSTALL'		=> true,
			
			'PACKAGE_ID'	=> $package_id,

			'U_UNINSTALL'		=> $this->u_action . '&amp;action=uninstall&amp;package_id=' . $package_id,
			'U_BACK'			=> $this->u_action)
		);
		
		$actions = $this->package_actions($package_id);
		$information = $this->package_information($package_id);

		include($phpbb_root_path . 'includes/editor.' . $phpEx);
		$editor = new editor($phpbb_root_path);

		$dependenices = $information['DEPENDENCIES'];

		if(!empty($information['AUTHOR_NOTES']))
		{
			$template->assign_vars(array(
				'S_AUTHOR_NOTES' => true,
				
				'AUTHOR_NOTES' => $information['AUTHOR_NOTES'])
			);
		}

		// Show new files
		if (isset($actions['NEW_FILES']) && !empty($actions['NEW_FILES']))
		{
			$template->assign_vars(array(
				'S_REMOVING_FILES'		=> true)
			);

			foreach($actions['NEW_FILES'] as $source => $target)
			{
				if((!file_exists("{$phpbb_root_path}{$target}")) && (!strpos($source, '*.*')))
				{
					$template->assign_block_vars('removing_files', array(
						'S_MISSING_FILE' => true,

						'FILENAME'		=> $target)
					);
				}
				else
				{
					$template->assign_block_vars('removing_files', array(
						'FILENAME'		=> $target)
					);
				}
			}
		}
		
		// Show SQL
		if (isset($actions['SQL']) && !empty($actions['SQL']))
		{
			$template->assign_vars(array(
				'S_SQL'		=> true)
			);

			foreach($actions['SQL'] as $query)
			{
				$reverse_query = $this->reverse_query($query);
				
				if($reverse_query == $query)
				{
					$template->assign_block_vars('sql_queries', array(
						'S_UNKNOWN_REVERSE' => true,

						'ORIGINAL_QUERY'	=> $query)
					);
				}
				else
				{
					$template->assign_block_vars('sql_queries', array(
						'ORIGINAL_QUERY'	=> $query,
						'REVERSE_QUERY'		=> $reverse_query)
					);
				}
			}
		}

		// Show edits
		if(isset($actions['EDITS']) && !empty($actions['EDITS']))
		{
			$template->assign_vars(array(
				'S_EDITS'		=> true)
			);
			
			$actions['EDITS'] = $this->reverse_edits($actions['EDITS']);

			foreach ($actions['EDITS'] as $file => $finds)
			{
				if(!file_exists("{$phpbb_root_path}{$file}"))
				{
					$template->assign_block_vars('edit_files', array(
						'S_MISSING_FILE' => true,
						
						'FILENAME'	=> $file
					));
				}
				else
				{
					$template->assign_block_vars('edit_files', array(
						'FILENAME'	=> $file
					));
				
					$editor->open_file($file);

					$editor->fold_edits($file, $dependenices);
	
					foreach ($finds as $find => $actions)
					{
						if(!$editor->check_find($file, $find))
						{
							$template->assign_block_vars('edit_files.finds', array(
								'S_MISSING_FIND'	=> true,

								'FIND_STRING'	=> htmlspecialchars($find)
							));
						}
						else
						{
							$template->assign_block_vars('edit_files.finds', array(
								'FIND_STRING'	=> htmlspecialchars($find)
							));
							
							foreach($actions as $name => $command)
							{
								$template->assign_block_vars('edit_files.finds.actions', array(
									'NAME'		=> $name, // LANG!
									'COMMAND'	=> htmlspecialchars($command),
								));
							}
						}
					}
					
					$editor->unfold_edits($file, $dependenices);

					$editor->close_file($file);
				}
			}
		}
	}
		
	/**
	* Uninstall a package
	*/
	function uninstall($package_id)
	{
		global $phpbb_root_path, $phpEx, $db, $template;
		
		$template->assign_vars(array(
			'S_UNINSTALL'		=> true,
			
			'PACKAGE_ID'	=> $package_id,

			'U_RETURN'			=> $this->u_action)
		);

		$actions = $this->package_actions($package_id);
		$information = $this->package_information($package_id);
		
		// Update status (dont delete, keep for restore points)
		$sql = 'UPDATE ' . PACKAGE_TABLE . '
			SET package_active = 0
				WHERE package_id = ' . $package_id;
		$db->sql_query($sql);
						
		// Add log
		add_log('admin', 'LOG_PACKAGE_REMOVE', $information['NAME']);
	}
	
	/**
	* Returns the needed sql query(or array of queries???) to reverse the actions taken by the given query
	*/
	function reverse_query($orig_query)
	{
		$reverse_query = $orig_query;

		return $reverse_query;
	}
	
	/**
	* Returns the edits array, but now filled with edits to reverse the given array
	*/
	function reverse_edits($orig_edits)
	{
		$reverse_edits = array();

		foreach ($orig_edits as $file => $finds)
		{
			foreach ($finds as $find => $actions)
			{
				foreach($actions as $name => $command)// LANG!
				{
					switch($name)
					{
						case 'AFTER, ADD':
						case 'BEFORE, ADD':
							$find = $command;
							$reverse_edits[$file][$find]['REPLACE WITH'] = '';
						break;
						
						case 'REPLACE WITH':
							$new_find = $command;
							$reverse_edits[$file][$new_find]['REPLACE WITH'] = $find;
						break;
					}
				}
			}
		}

		return $reverse_edits;
	}
	
	/**
	* Install a package
	* Makes file edits to processed store, and inserts package info into DB
	*
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

		// Last orders!
		$sql = 'SELECT MAX(package_order) as last_order
			FROM ' . PACKAGE_TABLE;
		$result = $db->sql_query($sql);
		if ($row = $db->sql_fetchrow($result))
		{
			$order = $row['last_order'] + 1;
		}

		// insert database data
		$sql = 'INSERT INTO ' . PACKAGE_TABLE . ' ' . $db->sql_build_array('INSERT', array(
			'package_order'			=> (int) $order,
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
	*
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
	*
	function uninstall_package($package_id)
	{
		global $db, $user;

		$package_id = (int) $package_id;

		// do stuff

		// use package_order to backtrack edits etc...?
		
		// Remove DB entry
		$sql = 'DELETE FROM ' . PACKAGE_TABLE . "
			WHERE package_id = $package_id";
		$db->sql_query($sql);

		trigger_error($user->lang['PACKAGE_REMOVED'] . adm_back_link($this->u_action));

		return;
	}
	
	/**
	* Remove a local package
	*
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
	*
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
	*/
}

?>