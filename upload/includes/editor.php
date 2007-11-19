<?php
/** 
*
* @package mods_manager
* @version $Id$
* @copyright (c) 2007 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

// Constant Defines for actions
//define('AFTER',		1);
//define('BEFORE',	2);


/**
* Editor Class
* Runs through file sequential, ie new finds must come after previous finds
* SQL and file copying not handled
* @package mods_manager
* @todo: implement some string checkin, way too much can go wild here
*/
class editor
{
	var $file_contents = '';
	var $unprocessed;
	var $processed;
	var $previous_edits;

	/**
	* Make all line endings the same - UNIX
	*/
	function normalize($string)
	{
		$string = str_replace(array("\r\n", "\r"), "\n", $string);
		return $string;
	}

	/**
	* Open a file with IO, for processing
	*/
	function open_file($filename)
	{
		global $phpbb_root_path;

		$this->file_contents = $this->normalize(@file($phpbb_root_path . $filename));
	}

	function copy_content()
	{
		// let's avoid fatal errors for the moment...better features coming soon
	}

	/**
	* Checks if a find is present
	* Keep in mind partial finds and multi-line finds
	*/
	function find($find)
	{
		$find_success = 0;

		$find = $this->normalize($find);
		$find_ary = explode("\n", $find);

		$total_lines = sizeof($this->file_contents);
		$find_lines = sizeof($find_ary);

		for ($i = 0; $i < $total_lines; $i++)
		{
			for ($j = 0; $j < $find_lines; $j++)
			{
				// using $this->file_contents[$i + $j] to keep the array pointer where I want it
				// if the first line of the find (index 0) is being looked at, $i + $j = $i.
				// if $j is > 0, we look at the next line of the file being inspected
				// hopefully, this is a decent performer.

				if (!$find_ary[$j])
				{
					// line is blank.  Assume we can find a blank line, and continue on
					$find_success += 1;
					continue;
				}

				if (strpos($this->file_contents[$i + $j], $find_ary[$j]) !== false)
				{
					// we found this part of the line
					$find_success += 1;

					if ($find_success == $find_lines)
					{
						// we found the proper number of lines
						// return our array offsets

						return array(
							'start' => $i,
							'end' => $i + $j,
						);
					}
				}
				else
				{
					// the find failed.  Reset $find_success
					$find_success = false;

					// skip to next iteration of outer loop, that is, skip to the next line
					break;
				}

			}
		}

		// if return has not been previously invoked, the find failed.
		return false;
	}

	// this function might need an additional argument $inline_find
	function inline_find($find, $inline_find, $start_offset = false, $end_offset = false)
	{
		$find = $this->normalize($find);

		if ($start_offset === false || $end_offset === false)
		{
			$offsets = $this->find($find);

			if (!$offsets)
			{
				// the find failed, so no further action can occur.
				return false;
			}

			$start_offset = $offsets['start'];
			$end_offset = $offsets['end'];

			unset($offsets);
		}

		// similar method to find().  Just much more limited scope
		for ($i = $start_offset; $i <= $end_offset; $i++)
		{
			$string_offset = strpos($this->file_contents[$i], $inline_find);
			if ($string_offset !== false)
			{
				// if we find something, return the line number, string offset, and find length
				return array(
					'array_offset'	=> $i,
					'string_offset'	=> $string_offset,
					'find_length'	=> strlen($inline_find),
				);
			}
		}

		return false;
	}


	/**
	* Add a string to the file, BEFORE/AFTER the given find string
	* @param string $filename - The file to be altered
	* @param string $add - The string to be added before or after $find
	* @param string $pos - BEFORE or AFTER
	* @param int $start_offset - First line in the FIND
	* @param int $end_offset - Last line in the FIND
	*/
	function add_string($find, $add, $pos, $start_offset = false, $end_offset = false)
	{
		// this seems pretty simple...throughly test
		$add = $this->normalize($add);

		if ($start_offset === false || $end_offset === false)
		{
			$offsets = $this->find($find);

			if (!$offsets)
			{
				// the find failed, so the add cannot occur.
				return false;
			}

			$start_offset = $offsets['start'];
			$end_offset = $offsets['end'];

			unset($offsets);
		}

		// make sure our new lines are correct
		$add = "\n" . $add . "\n";

		if ($pos == 'AFTER')
		{
			$this->file_contents[$end_offset] .= $add;
		}

		if ($pos == 'BEFORE')
		{
			$this->file_contents[$start_offset] = $add . $this->file_contents[$start_offset];
		}
	}

	/**
	* Increment (or perform custom operation) on  the given wildcard
	* Support multiple wildcards {%:1}, {%:2} etc...
	*/
	function inc_string($find, $operation)
	{
		// not currently implemented
	}

	/**
	* Replace a string
	*/
	function replace_string($find, $replace, $start_offset = false, $end_offset = false)
	{
		$replace = $this->normalize($replace);

		if ($start_offset === false || $end_offset === false)
		{
			$offsets = $this->find($find);

			if (!$offsets)
			{
				return false;
			}

			$start_offset = $offsets['start'];
			$end_offset = $offsets['end'];
			unset($offsets);
		}

		for ($i = $start_offset; $i < $end_offset; $i++)
		{
			unset($this->file_contents[$i]);
		}

		$this->file_contents[$start_offset] = $replace;
	}


	function inline_replace($find, $inline_find, $inline_replace, $array_offset = false, $string_offset = false, $length = false)
	{
		if ($string_offset === false || $length === false)
		{
			// look for the inline find
			$inline_offsets = $this->inline_find($find, $inline_find);

			if (!$inline_offsets)
			{
				return false;
			}

			$array_offset = $inline_offsets['array_offset'];
			$string_offset = $inline_offsets['string_offset'];
			$length = $inline_offsets['find_length'];
			unset($inline_offsets);
		}

		$this->file_contents[$array_offset] = substr_replace($this->file_contents[$array_offset], $inline_replace, $string_offset, $length);
	}

	function inline_add($find, $inline_find, $inline_add, $pos, $array_offset = false, $string_offset = false, $length = false)
	{
		if ($string_offset === false || $length === false)
		{
			// look for the inline find
			$inline_offsets = $this->inline_find($find, $inline_find);

			if (!$inline_offsets)
			{
				return false;
			}

			$array_offset = $inline_offsets['array_offset'];
			$string_offset = $inline_offsets['string_offset'];
			$length = $inline_offsets['find_length'];
			unset($inline_offsets);
		}

		if ($string_offset + $length > strlen($this->file_contents[$array_offset]))
		{
			// we have an invalid string offset.  rats.
			return false;
		}

		if ($pos == 'AFTER')
		{
			$this->file_contents[$array_offset] = substr_replace($this->file_contents[$array_offset], $inline_add, $string_offset + $length, 0);
		}
		else if ($pos == 'BEFORE')
		{
			$this->file_contents[$array_offset] = substr_replace($this->file_contents[$array_offset], $inline_add, $string_offset, 0);
		}
	}

	/**
	* Write & close file
	*/
	function close_file($new_filename)
	{
		global $phpbb_root_path;

		// highly temporary.  probably be gone within a week ish
		$fr = @fopen($phpbb_root_path . $new_filename, 'wb');
		@fwrite($fr, implode('', $this->file_contents));
		@fclose($fr);
	}
}

?>