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
	
	function get_details()
	{
		return $this->parser->get_details();
	}

	function get_history()
	{
		return $this->parser->get_history();
	}

	function get_notes()
	{
		return $this->parser->get_notes();
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
	function get_details()
	{
		$details = array(
			'path' => $this->file
		);

		$matches = array(
			'name'			=> "/mod title:(.*?)\n/i",
			'desc'			=> "/mod description:(.*?)\n/i", // more than one line descriptions?
			'version'		=> "/mod version:(.*?)\n/i",
			'author_name'	=> "/mod author:(.*?)</i",
			'author_email'	=> "/mod author:[^<]+<(.*?)>/i",
			'author_url'	=> "/mod author:[^<]+<[^>]+>[ ]+\([^)]+\)(.*?)\n/i",
		);

		foreach ($matches as $name => $expression)
		{
			preg_match($expression, $this->data, $m);

			if (!isset($m[1]))
			{
				return false;
			}

			$details[$name] = trim($m[1]);
		}
		
		return $details;
	}

	/**
	* Return the Author Notes as a string
	*/
	function get_notes()
	{
		$lines = preg_split('/author notes:/i', $this->data);
		$lines = preg_split("/\n###/",  $lines[1]);
		$lines = explode("\n", $lines[0]);
		
		$notes = '<pre>';
		foreach ($lines as $line)
		{
			$notes .= trim(str_replace('##', '', $line)) . "\n";
		}
		$notes .= '</pre>';

		return $notes;
	}

	/**
	* Would only really be used when getting more info
	*/
	function get_history()
	{
	
	}

	/**
	* Reutrns complex array containing all package actions
	*/
	function get_actions()
	{
		$actions = array();

		// Get Copy commands
		$copys = '';

		preg_match_all("/#[ \t]*\n#[ -]+\[ copy \][- ]+\n#[ \t]*\n([^#]+)/i", $this->data, $m);
		for ($i = 0; $i < count($m[0]); $i++)
		{
			$copys .= $m[1][$i];
		}

		preg_match_all("/copy (.*?) to (.*?)\n/i", $this->data, $m);
		for ($i = 0; $i < count($m[0]); $i++)
		{
			$from = str_replace('\\', '/', trim($m[1][$i]));
			$actions['copy'][$from] = str_replace('\\', '/', trim($m[2][$i]));
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
				$actions['edit'][$filename][$find_string] = array();
				$find_contents = preg_replace("/\n#[^\-\n]*/i", "\n", $find_contents);

				preg_match_all("/\n[- \t]+\[(.*?)\][- \t]+/i", $find_contents, $m);
				$commands = preg_split("/\n[- \t]+\[(.*?)\][- \t]+/i", $find_contents);
				for ($i = 0; $i < count($m[1]); $i++)
				{
					$actions['edit'][$filename][$find_string] += array(trim($m[1][$i]) => trim($commands[($i+1)]));
				}
			}
		}

		$actions['sql'] = '';

		return $actions;
	}
}
?>