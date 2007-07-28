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
		$header = $this->data[0]['children']['HEADER'][0]['children'];

		// get version information
		$version_info = $header['MOD-VERSION'][0]['children'];
		$version = ( isset($version_info['MAJOR'][0]['data']) ) ? trim($version_info['MAJOR'][0]['data']) : 0;
		$version .= '.' . (( isset($version_info['MINOR'][0]['data']) ) ? trim($version_info['MINOR'][0]['data']) : 0);
		$version .= '.' . (( isset($version_info['REVISION'][0]['data']) ) ? trim($version_info['REVISION'][0]['data']) : 0);
		$version .= (isset($version_info['RELEASE'][0]['data'])) ? $version_info['RELEASE'][0]['data'] : '';

		// get author information. Just taking first here. Multiple will be implemented later
		$author_info = $header['AUTHOR-GROUP'][0]['children']['AUTHOR'][0]['children'];

		// try not to hardcode schema?
		$details = array(
			'MOD_PATH' 		=> $this->file,
			'MOD_NAME'		=> htmlspecialchars(trim($header['TITLE'][0]['data'])),
			'MOD_DESCRIPTION'	=> htmlspecialchars(trim($header['DESCRIPTION'][0]['data'])),
			'MOD_VERSION'		=> htmlspecialchars(trim($version)),
			'MOD_DEPENDENCIES'	=> htmlspecialchars(trim($header['TITLE'][0]['data'])),
			
			'AUTHOR_NAME'	=> htmlspecialchars(trim($author_info['USERNAME'][0]['data'])),
			'AUTHOR_EMAIL'	=> (isset($author_info['EMAIL'][0]['data'])) ? (htmlspecialchars(trim($author_info['EMAIL'][0]['data']))) : '',
			'AUTHOR_URL'	=> (isset($author_info['HOMEPAGE'][0]['data'])) ? (htmlspecialchars(trim($author_info['HOMEPAGE'][0]['data']))) : '',
			'AUTHOR_NOTES'	=> '<pre>' . htmlspecialchars(trim($header['AUTHOR-NOTES'][0]['data'])) . '</pre>'
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
		$sql_info = ( !empty($xml_actions['SQL']) ) ? $xml_actions['SQL'] : '';
		for($i = 0, $total = sizeof($sql_info); $i < $total; $i++)
		{
			$actions['SQL'][] = ( !empty($sql_info[$i]['data']) ) ? trim(str_replace('phpbb_', $table_prefix, $sql_info[$i]['data'])) : '';
		}

		// new files
		$new_files_info = ( !empty($xml_actions['COPY']) ) ? $xml_actions['COPY'] : array();
		for($i = 0, $total = sizeof($new_files_info); $i < $total; $i++)
		{
			$new_files = $new_files_info[$i]['children']['FILE'];
			for($j = 0, $file_total = sizeof($new_files); $j < $file_total; $j++)
			{
				$from = str_replace('\\', '/', $new_files[$j]['attrs']['FROM']);
				$to = str_replace('\\', '/', $new_files[$j]['attrs']['TO']);
				$actions['NEW_FILES'][$from] = $to;
			}
		}


		// open
		$open_info = ( !empty($xml_actions['OPEN']) ) ? $xml_actions['OPEN'] : array();
		for( $i = 0, $total = sizeof($open_info); $i < $total; $i++ )
		{
			$current_file = str_replace('\\', '/', trim($open_info[$i]['attrs']['SRC']));
			$actions['EDITS'][$current_file] = array();

			$edit_info = ( !empty($open_info[$i]['children']['EDIT']) ) ? $open_info[$i]['children']['EDIT'] : array();
			for($j = 0, $edit_total = sizeof($edit_info); $j < $edit_total; $j++)
			{
				$action_info = ( !empty($edit_info[$j]['children']) ) ? $edit_info[$j]['children'] : array();
	
				// straight edit, no inline
				if(isset($action_info['ACTION']))
				{
					$type = str_replace('-', ', ', $action_info['ACTION'][0]['attrs']['TYPE']);
					$actions['EDITS'][$current_file][trim($action_info['FIND'][0]['data'])] = array($type => trim($action_info['ACTION'][0]['data']));
				}
				// inline
				else
				{
					// BLeh?
				}
			}
		}

		return $actions;
		var_dump($actions);
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

		$XML = str_replace('&lt;', '<![CDATA[&lt;]]>', $XML);
		$XML = str_replace('&gt;', '<![CDATA[&gt;]]>', $XML);

		$this->XML = xml_parse($this->parser, $XML);
		if(!$this->XML)
		{
			die(sprintf("XML error: %s at line %d", xml_error_string(xml_get_error_code($this->parser)), xml_get_current_line_number($this->parser)));
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
		if($tag_data)
		{
			if(isset($this->output[count($this->output)-1]['data']))
			{
				$this->output[count($this->output)-1]['data'] .= $tag_data;
			}
			else
			{
				$this->output[count($this->output)-1]['data'] = $tag_data;
			}
		}
	}

	function tag_closed($parser, $name)
	{
		$this->output[count($this->output)-2]['children'][$name][] = $this->output[count($this->output)-1];
		array_pop($this->output);
	}
}

?>