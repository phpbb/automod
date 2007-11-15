<?php
/** 
*
* @package mods_manager
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

class editor
{
	var $file_contents = array();
	var $current_line = 0;
	var $find_start = 0;
	var $find_end = 0;
	
	/**
	* Make all line endings Unix line endings (\n)
	*/
	function normalize($string)
	{
		$string = str_replace(array("\r\n", "\r"), "\n", $string);
		return $string;
	}
	
	/**
	* Opens a file and gets it ready to process
	*/
	function open($filename)
	{
		$this->file_contents = explode("\n", $this->normalize(@file_get_contents($filename)));
	}
	
	/**
	* Finds a string within the file
	*
	* Strings can be partial lines
	* Whitespace before and after the string doesn't matter
	* Strings can be multiple lines long
	*/
	function find($find)
	{
		$temp_find = explode("\n", $this->normalize($find));
		$find = array();
		for($i = 0, $total = sizeof($temp_find); $i < $total; $i++)
		{
			$temp_find[$i] = trim($temp_find[$i]);
			// weed out empty lines
			if (!empty($temp_find[$i]))
			{
				$find[] = trim($temp_find[$i]);
			}
		}
		$find_total = sizeof($find);

		$cur_find = $start_line = 0;
		$cur_line = $this->current_line;
		
		for($total = sizeof($this->file_contents); $cur_line < $total; $cur_line++)
		{
			// skip empty lines
			$current_line = trim($this->file_contents[$cur_line]);

			if (empty($current_line))
			{
				continue;
			}
			
			$search_pattern = preg_replace('#\\\\\\{%\\\\\\:(\\d+)\\\\\\}#','(\\d+|\\{%\\:$1\\})', preg_quote($find[$cur_find], '#'));
			
			if (preg_match("#{$search_pattern}#", $current_line))
			{
				if ($cur_find == 0)
				{
					$start_line = $cur_line;
				}
				$cur_find++;
			}
			else if ($cur_find > 0)
			{
				// reset the find
				$cur_find = $start_line = 0;
			}
			
			if ($cur_find >= $find_total)
			{
				$this->find_start = $start_line;
				$this->find_end = $cur_line;
				$this->current_line = ++$cur_line;
				return true;
			}
		}
		
		// didn't find the line in the file
		return false;
	}
}

$edit = new editor();
$edit->open('./constants.php');
$edit->find('	define(\'NOTIFY_IM\', 1);

define(\'NOTIFY_BOTH\', 2);		');

echo '<pre>';
var_dump($edit);
echo '</pre>';

$edit->find('// Categories - Attachments');

echo '<pre>';
var_dump($edit);
echo '</pre>';

?>