<?php
/** 
*
* @package mods_manager
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* MOD Parser class
* Basic wrapper to run individual parser functions
* @package mods_manager
*
* Each parser requires the following functions:
*	~ set_file($path_to_mod_file)
*		~ a means of setting the data to be acted upon
*	~ get_details()
*		~ returns an array of information about the MOD
*	~ get_actions()
*		~ returns an array of the MODs actions
*
*/
class parser
{
	var $parser;

	/**
	* constructor, sets type of parser
	*/
	function parser($ext)
	{
		switch ($ext)
		{
			case 'xml':
			default:
				$this->parser = new parser_xml();
			break;
		}
	}

	function set_file($file)
	{
		$this->parser->set_file($file);
	}

	function get_details()
	{
		return $this->parser->get_details();
	}

	function get_actions()
	{
		return $this->parser->get_actions();
	}
}

/**
* XML parser
* @package mods_manager
*/
class parser_xml
{
	var $data;
	var $file;

	/**
	* set data to read from
	*/
	function set_file($file)
	{
		if (!file_exists($file))
		{
			die('Cannot locate File: ' . $file);
		}

		$this->file = $file;
		$this->data = trim(@file_get_contents($file));
		$this->data = str_replace(array("\r\n", "\r"), array("\n", "\n"), $this->data);
			
		$XML = new xml_array();
		$this->data = $XML->parse($this->data);

		return;
	}

	/**
	* return array of the basic MOD details
	*/
	function get_details()
	{
		if (empty($this->data))
		{
			$this->set_file($this->mod_file);
		}

		$header = array(
			'MOD-VERSION'	=> array(0 => array('children' => array())),
			'INSTALLATION'	=> array(0 => array('children' => array('TARGET-VERSION' => array(0 => array('data' => ''))))),
			'AUTHOR-GROUP'	=> array(0 => array('children' => array('AUTHOR' => array()))),
			'HISTORY'		=> array(0 => array('children' => array('ENTRY' => array()))),
		);

		$header = $this->data[0]['children']['HEADER'][0]['children'];

		// get MOD version information
		$version_info = $header['MOD-VERSION'][0]['children'];
		$version = (isset($version_info['MAJOR'][0]['data'])) ? trim($version_info['MAJOR'][0]['data']) : 0;
		$version .= '.' . ((isset($version_info['MINOR'][0]['data'])) ? trim($version_info['MINOR'][0]['data']) : 0);
		$version .= '.' . ((isset($version_info['REVISION'][0]['data'])) ? trim($version_info['REVISION'][0]['data']) : 0);
		$version .= (isset($version_info['RELEASE'][0]['data'])) ? trim($version_info['RELEASE'][0]['data']) : '';

		// get phpBB version recommendation
		$phpbb_version = isset($header['INSTALLATION'][0]['children']['TARGET-VERSION'][0]['children']) ? $header['INSTALLATION'][0]['children']['TARGET-VERSION'][0]['children'] : array();

		$author_info = $header['AUTHOR-GROUP'][0]['children']['AUTHOR'];

		$author_details = array();
		// this is purposely bugged...for the moment
		for ($i = 0; $i < sizeof($author_info); $i++)
		{
			$author_details[] = array(
				'AUTHOR_NAME'		=> isset($author_info[$i]['children']['USERNAME'][0]['data']) ? trim($author_info[$i]['children']['USERNAME'][0]['data']) : '',
				'AUTHOR_EMAIL'		=> isset($author_info[$i]['children']['EMAIL'][0]['data']) ? trim($author_info[$i]['children']['EMAIL'][0]['data']) : '',
				'AUTHOR_REALNAME'	=> isset($author_info[$i]['children']['REALNAME'][0]['data']) ? trim($author_info[$i]['children']['REALNAME'][0]['data']) : '',
				'AUTHOR_WEBSITE'	=> isset($author_info[$i]['children']['HOMEPAGE'][0]['data']) ? trim($author_info[$i]['children']['HOMEPAGE'][0]['data']) : '',
			);
		}

		// history
		$history_info = !empty($header['HISTORY'][0]['children']['ENTRY']) ? $header['HISTORY'][0]['children']['ENTRY'] : array();

		$mod_history = array();
		for ($i = 0; $i < sizeof($history_info); $i++)
		{
			$changes	= array();
			$entry		= $history_info[$i]['children'];
			$changelog	= $entry['CHANGELOG'][0]['children']['CHANGE'];
			$changelog_version_ary	= $entry['REV-VERSION'][0]['children'];

			for ($j = 0; $j < sizeof($changelog); $j++)
			{
				$changes[] = $changelog[$j]['data'];
			}

			$changelog_version = (isset($changelog_version_ary['MAJOR'][0]['data'])) ? trim($changelog_version_ary['MAJOR'][0]['data']) : 0;
			$changelog_version .= '.' . ((isset($changelog_version_ary['MINOR'][0]['data'])) ? trim($changelog_version_ary['MINOR'][0]['data']) : 0);
			$changelog_version .= '.' . ((isset($changelog_version_ary['REVISION'][0]['data'])) ? trim($changelog_version_ary['REVISION'][0]['data']) : 0);
			$changelog_version .= (isset($changelog_version_ary['RELEASE'][0]['data'])) ? trim($changelog_version_ary['RELEASE'][0]['data']) : '';

			$mod_history[] = array(
				'DATE'		=> $entry['DATE'][0]['data'],
				'VERSION'	=> $changelog_version,
				'CHANGES'	=> $changes,
			);
		}


		// try not to hardcode schema?
		$details = array(
			'MOD_PATH' 		=> $this->file,
			'MOD_NAME'		=> (isset($header['TITLE'][0]['data'])) ? htmlspecialchars(trim($header['TITLE'][0]['data'])) : '',
			'MOD_DESCRIPTION'	=> (isset($header['DESCRIPTION'][0]['data'])) ? htmlspecialchars(trim($header['DESCRIPTION'][0]['data'])) : '',
			'MOD_VERSION'		=> htmlspecialchars(trim($version)),
			'MOD_DEPENDENCIES'	=> (isset($header['TITLE'][0]['data'])) ? htmlspecialchars(trim($header['TITLE'][0]['data'])) : '',

			'AUTHOR_DETAILS'	=> $author_details,
			'AUTHOR_NOTES'		=> (isset($header['AUTHOR-NOTES'][0]['data'])) ? htmlspecialchars(trim($header['AUTHOR-NOTES'][0]['data'])) : '',
			'MOD_HISTORY'		=> $mod_history,
			'PHPBB_VERSION'		=> $phpbb_version,
		);

		return $details;
	}

	/**
	* returns complex array containing all mod actions
	*/
	function get_actions()
	{
		global $table_prefix;
	
		$actions = array();

		$xml_actions = $this->data[0]['children']['ACTION-GROUP'][0]['children'];

		// sql
		$sql_info = (!empty($xml_actions['SQL'])) ? $xml_actions['SQL'] : array();
		for ($i = 0; $i < sizeof($sql_info); $i++)
		{
			$actions['SQL'][] = (!empty($sql_info[$i]['data'])) ? trim(str_replace('phpbb_', $table_prefix, $sql_info[$i]['data'])) : '';
		}

		// new files
		$new_files_info = (!empty($xml_actions['COPY'])) ? $xml_actions['COPY'] : array();
		for ($i = 0; $i < sizeof($new_files_info); $i++)
		{
			$new_files = $new_files_info[$i]['children']['FILE'];
			for ($j = 0; $j < sizeof($new_files); $j++)
			{
				$from = str_replace('\\', '/', $new_files[$j]['attrs']['FROM']);
				$to = str_replace('\\', '/', $new_files[$j]['attrs']['TO']);
				$actions['NEW_FILES'][$from] = $to;
			}
		}

		// open
		$open_info = (!empty($xml_actions['OPEN'])) ? $xml_actions['OPEN'] : array();
		for ($i = 0; $i < sizeof($open_info); $i++)
		{
			$current_file = str_replace('\\', '/', trim($open_info[$i]['attrs']['SRC']));
			$actions['EDITS'][$current_file] = array();

			$edit_info = (!empty($open_info[$i]['children']['EDIT'])) ? $open_info[$i]['children']['EDIT'] : array();
			// find, after add, before add, replace with
			for ($j = 0; $j < sizeof($edit_info); $j++)
			{
				$action_info = (!empty($edit_info[$j]['children'])) ? $edit_info[$j]['children'] : array();

				// store some array information to help decide what kind of operation we're doing
				if (isset($action_info['ACTION']))
				{
					$action_count = sizeof($action_info['ACTION']);
					$find_count = sizeof($action_info['FIND']);
				}

				// first we try all the possibilities for a FIND/ACTION combo, then look at inline possibilities.

				// straight edit, no inline
				// simple 1:1 relation between find and action
				if (isset($action_info['ACTION']) && $find_count == $action_count)
				{
					$type = str_replace('-', ' ', $action_info['ACTION'][0]['attrs']['TYPE']);
					$actions['EDITS'][$current_file][$j][trim($action_info['FIND'][0]['data'])][$type] = $action_info['ACTION'][0]['data'];
				}
				// there is at least one find simply to advance the array pointer
				else if (isset($action_info['ACTION']) && $find_count > $action_count)
				{
					for ($k = 0; $k < $find_count; $k++)
					{
						// is this anything but the last iteration of the loop?
						if ($k < ($find_count - 1))
						{
							// NULL has special meaning for an action ... no action to be taken; advance pointer 
							$actions['EDITS'][$current_file][$j][trim($action_info['FIND'][$k]['data'])] = NULL;
						}
						else
						{
							// this is the last iteration, assign the find/action combo
							// hopefully, it is safe to assume there is only one action 
							$type = str_replace('-', ' ', $action_info['ACTION'][0]['attrs']['TYPE']);
							$actions['EDITS'][$current_file][$j][trim($action_info['FIND'][$k]['data'])][$type] = $action_info['ACTION'][0]['data'];
						}
					}
				}
				// in this case, there are many actions on one find
				// assumption: $find_count = 1
				else if (isset($action_info['ACTION']) && $action_count > $find_count)
				{
					for ($k = 0; $k < $action_count; $k++)
					{
						$type = str_replace('-', ' ', $action_info['ACTION'][$k]['attrs']['TYPE']);
						$actions['EDITS'][$current_file][$j][trim($action_info['FIND'][0]['data'])][$type] = $action_info['ACTION'][$k]['data'];
					}
				}

				// inline
				if (isset($action_info['INLINE-EDIT']))
				{
					$inline_info = (!empty($action_info['INLINE-EDIT'])) ? $action_info['INLINE-EDIT'] : array();
					for ($k = 0; $k < sizeof($inline_info); $k++)
					{
						$inline_actions = (!empty($inline_info[$k]['children'])) ? $inline_info[$k]['children'] : array();

						$inline_find = $inline_actions['INLINE-FIND'][0]['data'];

						$inline_actions = (!empty($inline_actions['INLINE-ACTION'])) ? $inline_actions['INLINE-ACTION'] : array();
						for ($l = 0; $l < sizeof($inline_actions); $l++)
						{
							$type = str_replace(',', '-', str_replace(' ', '', $inline_actions[$l]['attrs']['TYPE']));

							// trying to reduce the levels of arrays without impairing features
							// need to keep the "full" edit intact.
							$actions['EDITS'][$current_file][$j][trim($action_info['FIND'][0]['data'])]['in-line-edit'][$inline_find]['in-line-' . $type][] = $inline_actions[$l]['data'];
						}
					}
				}
			}
		}

		if (!empty($xml_actions['DIY-INSTRUCTIONS']))
		{
			foreach ($xml_actions['DIY-INSTRUCTIONS'] as $diy_instruction_set)
			{
				$actions['DIY_INSTRUCTIONS'][] = $diy_instruction_set['data'];
			}
		}

		return $actions;
	}
}

/**
* XML processing
* @package mods_manager
*/
class xml_array
{
	var $output = array();
	var $parser;
	var $XML;

	function parse($XML)
	{
		$this->parser = xml_parser_create();
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, "tag_open", "tag_closed");
		xml_set_character_data_handler($this->parser, "tag_data");

		$this->XML = xml_parse($this->parser, $XML);
		if (!$this->XML)
		{
			die(sprintf("<strong>XML error</strong>: %s at line %d.  View the file in a web browser for a more detailed error message.", 
				xml_error_string(xml_get_error_code($this->parser)), xml_get_current_line_number($this->parser)));
		}

		xml_parser_free($this->parser);

		return $this->output;
	}

	function tag_open($parser, $name, $attrs)
	{
		$tag = array("name" => $name, "attrs" => $attrs);
		array_push($this->output, $tag);
	}

	function tag_data($parser, $tag_data)
	{
		if ($tag_data)
		{
			if (isset($this->output[sizeof($this->output) - 1]['data']))
			{
				$this->output[sizeof($this->output) - 1]['data'] .= $tag_data;
			}
			else
			{
				$this->output[sizeof($this->output) - 1]['data'] = $tag_data;
			}
		}
	}

	function tag_closed($parser, $name)
	{
		$this->output[sizeof($this->output) - 2]['children'][$name][] = $this->output[sizeof($this->output) - 1];
		array_pop($this->output);
	}
}

?>