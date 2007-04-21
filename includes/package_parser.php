<?php
/** 
*
* @package pacman
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* Package Parser class
* Basic wrapper to run individual parser functions
* @package pacman
*/
class parser
{
	var $parser;

	/**
	* Constructor, sets type of parser
	*/
	function parser($ext)
	{
		switch ($ext)
		{
			case 'txt':
			case 'mod':
				$this->parser = new parser_text();
			break;
			
			case 'xml':
				$this->parser = new parser_xml();
			break;
		}
	}
	
	function set_file($file)
	{
		$this->parser->set_file($file);
	}
	
	function get_information()
	{
		return $this->parser->get_information();
	}

	function get_actions()
	{
		return $this->parser->get_actions();
	}
}

/**
* Text parser
* @package pacman
*/
class parser_text
{
	var $data;
	var $file;

	/**
	* Set data to read from
	*/
	function set_file($file)
	{
		if (!file_exists($file))
		{
			die('Cannot locate File: ' . $file);
		}

		$this->file = $file;
		$this->data = trim(@file_get_contents($file));
		$this->data = str_replace(array("\r\n", "\r"), array("\n", "\n"), $this->data );
		list($this->data) = preg_split("@#[- \t]*\n#[- \t]+\[ save/close all files \][- \t]+@i", $this->data);

		return;
	}

	/**
	* Return array of the basic MOD details
	*/
	function get_information()
	{
		$information = array(
			'PATH' => $this->file
		);

		// Get general info
		$matches = array(
			'NAME'			=> "/mod title:(.*?)\n/i",
			'DESCRIPTION'	=> "/mod description:(.*?)\n/i", // more than one line descriptions?
			'PVERSION'		=> "/mod version:(.*?)\n/i",
			'AUTHOR_NAME'	=> "/mod author:(.*?)</i",
			'AUTHOR_EMAIL'	=> "/mod author:[^<]+<(.*?)>/i",
			'AUTHOR_URL'	=> "/mod author:[^<]+<[^>]+>[ ]+\([^)]+\)(.*?)\n/i",
		);

		foreach ($matches as $name => $expression)
		{
			preg_match($expression, $this->data, $m);

			if (!isset($m[1]))
			{
				return false;
			}

			$information[$name] = htmlspecialchars(trim($m[1]));
		}
		
		// Get author notes
		$lines = preg_split('/author notes:/i', $this->data);
		$lines = preg_split("/\n###/",  $lines[1]);
		$lines = explode("\n", $lines[0]);
		
		$notes = '<pre>';
		foreach ($lines as $line)
		{
			$notes .= trim(str_replace('##', '', $line)) . "\n";
		}
		$notes .= '</pre>';
		
		$information['AUTHOR_NOTES'] = $notes;
		
		// Get dependenices 
		$information['DEPENDENCIES'] = array();
		
		return $information;
	}

	/**
	* Reutrns complex array containing all package actions
	*/
	function get_actions()
	{
		global $table_prefix;
	
		$actions = array();

		// Get Copy commands
		$new_files = '';

		preg_match_all("/#[ \t]*\n#[ -]+\[ copy \][- ]+\n#[ \t]*\n([^#]+)/i", $this->data, $m);
		for ($i = 0; $i < count($m[0]); $i++)
		{
			$new_files .= $m[1][$i];
		}

		preg_match_all("/copy (.*?) to (.*?)\n/i", $new_files, $m);
		for ($i = 0; $i < count($m[0]); $i++)
		{
			$from = str_replace('\\', '/', trim($m[1][$i]));
			$actions['NEW_FILES'][$from] = str_replace('\\', '/', trim($m[2][$i]));
		}

		// Get SQL queries
		$sql = '';

		preg_match_all("/#[ \t]*\n#[ -]+\[ sql \][- ]+\n#[ \t]*\n([^#]+)/i", $this->data, $m);
		for ($i = 0; $i < count($m[0]); $i++)
		{
			$sql .= $m[1][$i];
		}
		
		preg_match_all("/(.*?);/i", $sql, $m);
		for ($i = 0; $i < count($m[0]); $i++)
		{
			$actions['SQL'][] = trim(str_replace('phpbb_', $table_prefix, $m[1][$i]));
		}

		// Cover all find actions
		$files = preg_split("/#[ \t]*\n#[- ]+\[ open \][- ]+\n#/i", $this->data);
		array_shift($files);

		foreach ($files as $file_actions)
		{
			$file_actions = trim($file_actions);
			list($filename) = explode("\n", $file_actions);

			$finds = preg_split("/#[ \t]*\n#[- ]+\[ FIND \][- ]+\n#/i", $file_actions);
			array_shift($finds);

			foreach ($finds as $find_contents)
			{
				$find_contents = trim($find_contents) . "\n";

				list($find_string) = explode("\n#", $find_contents);
				$actions['EDITS'][$filename][$find_string] = array();
				$find_contents = preg_replace("/\n#[^\-\n]*/i", "\n", $find_contents);

				preg_match_all("/\n[- \t]+\[(.*?)\][- \t]+/i", $find_contents, $m);
				$commands = preg_split("/\n[- \t]+\[(.*?)\][- \t]+/i", $find_contents);
				for ($i = 0; $i < count($m[1]); $i++)
				{
					$actions['EDITS'][$filename][$find_string] += array(trim($m[1][$i]) => trim($commands[($i+1)]));
				}
			}
		}

		return $actions;
	}
}

/**
* XML parser
* @package pacman
*/
class parser_xml
{
	var $data;
	var $file;

	/**
	* Set data to read from
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

//echo '<pre style="font-size: 14px;">';
//var_dump($this->data);
//echo '</pre>';

		return;
	}

	/**
	* Return array of the basic MOD details
	*/
	function get_information()
	{
		$header = $this->data[0]['children']['HEADER'][0]['children'];

		// Get version information
		$version_info = $header['MOD-VERSION'][0]['children'];
		$version = ( isset($version_info['MAJOR'][0]['data']) ) ? trim($version_info['MAJOR'][0]['data']) : 0;
		$version .= '.' . (( isset($version_info['MINOR'][0]['data']) ) ? trim($version_info['MINOR'][0]['data']) : 0);
		$version .= '.' . (( isset($version_info['REVISION'][0]['data']) ) ? trim($version_info['REVISION'][0]['data']) : 0);
		$version .= (isset($version_info['RELEASE'][0]['data'])) ? $version_info['RELEASE'][0]['data'] : '';

		// Get author information. Just taking first here. Multiple will be implemented later
		$author_info = $header['AUTHOR-GROUP'][0]['children']['AUTHOR'][0]['children'];

		// try not to hardcode schema?
		$information = array(
			'PATH' 			=> $this->file,
			'NAME'			=> htmlspecialchars(trim($header['TITLE'][0]['data'])),
			'DESCRIPTION'	=> htmlspecialchars(trim($header['DESCRIPTION'][0]['data'])),
			'PVERSION'		=> htmlspecialchars(trim($version)),
			'AUTHOR_NAME'	=> htmlspecialchars(trim($author_info['USERNAME'][0]['data'])),
			'AUTHOR_EMAIL'	=> (isset($author_info['EMAIL'][0]['data'])) ? (htmlspecialchars(trim($author_info['EMAIL'][0]['data']))) : '',
			'AUTHOR_URL'	=> (isset($author_info['HOMEPAGE'][0]['data'])) ? (htmlspecialchars(trim($author_info['HOMEPAGE'][0]['data']))) : '',
			'AUTHOR_NOTES'	=> '<pre>' . htmlspecialchars(trim($header['AUTHOR-NOTES'][0]['data'])) . '</pre>',
			'DEPENDENCIES'	=> htmlspecialchars(trim($header['TITLE'][0]['data']))
		);

		return $information;
	}

	/**
	* Reutrns complex array containing all package actions
	*/
	function get_actions()
	{
		global $table_prefix;
	
		$actions = array();

		/*
		// Get Copy commands
		$new_files = '';

		preg_match_all("/#[ \t]*\n#[ -]+\[ copy \][- ]+\n#[ \t]*\n([^#]+)/i", $this->data, $m);
		for ($i = 0; $i < count($m[0]); $i++)
		{
			$new_files .= $m[1][$i];
		}

		preg_match_all("/copy (.*?) to (.*?)\n/i", $new_files, $m);
		for ($i = 0; $i < count($m[0]); $i++)
		{
			$from = str_replace('\\', '/', trim($m[1][$i]));
			$actions['NEW_FILES'][$from] = str_replace('\\', '/', trim($m[2][$i]));
		}

		// Get SQL queries
		$sql = '';

		preg_match_all("/#[ \t]*\n#[ -]+\[ sql \][- ]+\n#[ \t]*\n([^#]+)/i", $this->data, $m);
		for ($i = 0; $i < count($m[0]); $i++)
		{
			$sql .= $m[1][$i];
		}
		
		preg_match_all("/(.*?);/i", $sql, $m);
		for ($i = 0; $i < count($m[0]); $i++)
		{
			$actions['SQL'][] = trim(str_replace('phpbb_', $table_prefix, $m[1][$i]));
		}

		// Cover all find actions
		$files = preg_split("/#[ \t]*\n#[- ]+\[ open \][- ]+\n#/i", $this->data);
		array_shift($files);

		foreach ($files as $file_actions)
		{
			$file_actions = trim($file_actions);
			list($filename) = explode("\n", $file_actions);

			$finds = preg_split("/#[ \t]*\n#[- ]+\[ FIND \][- ]+\n#/i", $file_actions);
			array_shift($finds);

			foreach ($finds as $find_contents)
			{
				$find_contents = trim($find_contents) . "\n";

				list($find_string) = explode("\n#", $find_contents);
				$actions['EDITS'][$filename][$find_string] = array(); */
			//	$find_contents = preg_replace("/\n#[^\-\n]*/i", "\n", $find_contents);

			/*	preg_match_all("/\n[- \t]+\[(.*?)\][- \t]+/i", $find_contents, $m);
				$commands = preg_split("/\n[- \t]+\[(.*?)\][- \t]+/i", $find_contents);
				for ($i = 0; $i < count($m[1]); $i++)
				{
					$actions['EDITS'][$filename][$find_string] += array(trim($m[1][$i]) => trim($commands[($i+1)]));
				}
			}
		}
		*/
		
		$xml_actions = $this->data[0]['children']['ACTION-GROUP'][0]['children'];

		// sql
		$sql_info = ( !empty($xml_actions['SQL']) ) ? $xml_actions['SQL'] : '';
		for($i = 0, $total = sizeof($sql_info); $i < $total; $i++)
		{
			$actions['SQL'][] = ( !empty($sql_info[$i]['data']) ) ? trim(str_replace('phpbb_', $table_prefix, $sql_info[$i]['data'])) : '';
		}

		// New files
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
				
				// Straight Edit, No Inline
				if(isset($action_info['ACTION']))
				{
					$actions['EDITS'][$current_file][$action_info['FIND'][0]['data']] = $action_info['ACTION'][0]['attrs']['TYPE'];
				}
				// Inline
				else
				{
					// BLeh?
				}

				/*
				$actions = ( !empty($action_info['ACTION']) ) ? $action_info['ACTION'] : array();
				for($k = 0, $action_total = sizeof($actions); $k < $action_total; $k++)
				{
					$this->actions['open'][$current_file]['edit'][$j]['action'][] = array(
						'line'	=> 0,
						'type'	=> str_replace(',', '-', str_replace(' ', '', $actions[$k]['attrs']['TYPE'])),
						'code'	=> $actions[$k]['data']
					);
				}*/

				/*
				$inline_info = ( !empty($action_info['INLINE-EDIT']) ) ? $action_info['INLINE-EDIT'] : array();
				for($k = 0, $inline_total = sizeof($inline_info); $k < $inline_total; $k++)
				{
					$inline_actions =  ( !empty($inline_info[$k]['children']) ) ? $inline_info[$k]['children'] : array();

					$this->actions['open'][$current_file]['edit'][$j]['in-line-edit'][$k]['in-line-find'] = $inline_actions['INLINE-FIND'][0]['data'];

					$actions = ( !empty($inline_actions['INLINE-ACTION']) ) ? $inline_actions['INLINE-ACTION'] : array();
					for($x = 0, $actions_total = sizeof($actions); $x < $actions_total; $x++)
					{
						$type = str_replace(',', '-', str_replace(' ', '', $actions[$x]['attrs']['TYPE']));
						$this->actions['open'][$current_file]['edit'][$j]['in-line-edit'][$k]['in-line-action'][] = array(
							'line'	=> 0,
							'type'	=> (( $type != 'increment' ) ? 'in-line-' : '') . $type ,
							'code'	=> $actions[$x]['data']
						);
					}
				}
				*/
			}
		}

		return $actions;
	}
}

/**
* XML processing
* @package pacman
*/
class xml_array
{
	var $output = array();
	var $parser;
	var $XML;

	function parse($XML)
	{
		$this->parser = xml_parser_create();
		xml_set_object($this->parser,$this);
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
		if(trim($tag_data))
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