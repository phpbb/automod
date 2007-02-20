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
			'VERSION'		=> "/mod version:(.*?)\n/i",
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
?>