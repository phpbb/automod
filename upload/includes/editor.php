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

define('WRITE_DIRECT', 1);
define('WRITE_FTP', 2);
define('WRITE_MANUAL', 3);


/**
* Editor Class
* Runs through file sequential, ie new finds must come after previous finds
* Handles placing the files after being edited
* @package mods_manager
* @todo: implement some string checkin, way too much can go wild here
*/
class editor
{
	var $file_contents = '';
	var $write_method = 0;
	var $start_index = 0;
	var $transfer;
	var $compress;
	var $install_time = 0;
	var $template_id = 0;

	/**
	* Constructor method
	* Creates transfer and/or compress instances
	*/
	function editor($phpbb_root_path, $pre_install = false)
	{
		global $config, $user;

		$this->install_time = time();

		// to be truly correct, we should scan all files ...
		if ((is_writable($phpbb_root_path) && $config['write_method'] == WRITE_DIRECT) || $pre_install)
		{
			$this->write_method = WRITE_DIRECT;
		}
		// user needs to select ftp or ftp using fsock
		else if (!is_writable($phpbb_root_path) && $config['ftp_method'] || $config['write_method'] == WRITE_FTP)
		{
			$this->write_method = WRITE_FTP;
			if (!class_exists('transfer'))
			{
				global $phpEx;
				include($phpbb_root_path . 'includes/functions_transfer.' . $phpEx);
			}

			$this->transfer = new $config['ftp_method']($config['ftp_host'], $config['ftp_username'], request_var('password', ''), $config['ftp_root_path'], $config['ftp_port'], $config['ftp_timeout']);
			$error = $this->transfer->open_session();

			if (is_string($error))
			{
				// FTP login failed
				trigger_error(sprintf($user->lang['MODS_FTP_FAIL'], $user->lang[$error]), E_USER_ERROR);
			}
		}
		// or zip or tarballs
		else if (!$config['ftp_method'] && $config['compress_method'] || $config['write_method'] == WRITE_MANUAL)
		{
			$this->write_method = WRITE_MANUAL;
			if (!class_exists('compress'))
			{
				global $phpEx;
				include($phpbb_root_path . 'includes/functions_compress.' . $phpEx);
			}

			$class = 'compress_' . $config['compress_method'];

			$this->compress = new $class('w', $phpbb_root_path . 'store/mod_' . $this->install_time . '.' . $config['compress_method']);
		}
		else
		{
			trigger_error('MODS_SETUP_INCOMPLETE', E_USER_ERROR);
		}
	}

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
	*
	* @param string $filename - relative path from phpBB Root to the file to open
	*/
	function open_file($filename)
	{
		global $phpbb_root_path, $db;

		$this->file_contents = $this->normalize(@file($phpbb_root_path . $filename));

		// Check for file contents in the database if this is a template file
		// this will overwrite the @file call if it exists in the DB. 
		if (strpos($filename, 'template/') !== false)
		{
			// grab template name and filename
			preg_match('#styles/([a-z0-9_]+)/template/([a-z0-9_]+.html)#i', $filename, $match);

			$sql = 'SELECT d.template_data, d.template_id 
				FROM ' . STYLES_TEMPLATE_DATA_TABLE . ' d, ' . STYLES_TEMPLATE_TABLE . " t
				WHERE d.template_filename = '" . $db->sql_escape($match[2]) . "'
					AND t.template_id = d.template_id
					AND t.template_name = '" . $db->sql_escape($match[1]) . "'";
			$result = $db->sql_query($sql);

			if ($row = $db->sql_fetchrow($result))
			{
				$this->file_contents = $this->normalize(explode("\n", $row['template_data']));
				$this->template_id = $row['template_id'];
			}
			else
			{
				$this->template_id = 0;
			}
		}


		if (!sizeof($this->file_contents))
		{
			global $user;
			trigger_error(sprintf($user->lang['MOD_OPEN_FILE_FAIL'], "$phpbb_root_path$filename"), E_USER_WARNING);
		}

		$this->start_index = 0;
	}

	/**
	* Moves files or complete directories
	*
	* @param $from string Can be a file or a directory. Will move either the file or all files within the directory
	* @param $to string Where to move the file(s) to. If not specified then will get moved to the root folder
	* @param $strip Used for FTP only
	*/
	function copy_content($from, $to = '', $strip = '')
	{
		global $phpbb_root_path;

		if (strpos($from, $phpbb_root_path) !== 0)
		{
			$from = $phpbb_root_path . $from;
		}

		if (strpos($to, $phpbb_root_path) !== 0)
		{
			$to = $phpbb_root_path . $to;
		}

		$files = array();
		if (is_dir($from))
		{
			// get all of the files within the directory
			$files = find_files($from, '.*', 5);
		}
		else if (is_file($from))
		{
			$files = array($from);
		}

		if (empty($files))
		{
			return false;
		}

		// is the directory writeable? if so, then we don't have to deal with FTP
		if ($this->write_method == WRITE_DIRECT)
		{
			if (!is_dir(dirname($to)))
			{
				$this->recursive_mkdir(dirname($to));
			}

			foreach ($files as $file)
			{
				if (is_dir($to))
				{
					$dest = str_replace($from, $to, $file);
				}
				else
				{
					$dest = $to;
				}

				if (!@copy($file, $dest))
				{
					return false;
				}
			}
		}
		else if ($this->write_method == WRITE_FTP)
		{
			// ftp
			foreach ($files as $file)
			{
				//$file = str_replace($phpbb_root_path, '', $file);
				if (is_dir($to))
				{
					$to_file = str_replace(array($phpbb_root_path, $strip), '', $file);
				}
				else
				{
					$to_file = str_replace($phpbb_root_path, '', $to);
				}

				$this->transfer->overwrite_file($file, $to_file);
			}
		}
		else
		{
			return NULL;
		}

		return true;
	}

	/**
	* Checks if a find is present
	* Keep in mind partial finds and multi-line finds
	*
	* @param string $find - string to find
	* @return mixed : array with position information if $find is found; false otherwise
	*/
	function find($find)
	{
		$find_success = 0;

		$find = $this->normalize($find);
		$find_ary = explode("\n", $find);

		$total_lines = sizeof($this->file_contents);
		$find_lines = sizeof($find_ary);

		// we process the file sequentially ... so we keep track of indices
		for ($i = $this->start_index; $i < $total_lines; $i++)
		{
			for ($j = 0; $j < $find_lines; $j++)
			{
				if (!$find_ary[$j])
				{
					// line is blank.  Assume we can find a blank line, and continue on
					$find_success += 1;
					continue;
				}

				// if we've reached the EOF, the find failed.
				if (!isset($this->file_contents[$i + $j]))
				{
					return false;
				}

				// using $this->file_contents[$i + $j] to keep the array pointer where I want it
				// if the first line of the find (index 0) is being looked at, $i + $j = $i.
				// if $j is > 0, we look at the next line of the file being inspected
				// hopefully, this is a decent performer.
				if (strpos($this->file_contents[$i + $j], $find_ary[$j]) !== false)
				{
					// we found this part of the find
					$find_success += 1;
				}
				// we might have an increment operator, which requires a regular expression match
				else if (strpos($find_ary[$j], '{%:') !== false)
				{
					$regex = preg_replace('#{%:(\d+)}#', '(\d+)', $find_ary[$j]);

					if (preg_match('#' . $regex . '#is', $this->file_contents[$i + $j]))
					{
						$find_success += 1;
					}
					else
					{
						$find_success = 0;
					}
				}
				else
				{
					// the find failed.  Reset $find_success
					$find_success = 0;

					// skip to next iteration of outer loop, that is, skip to the next line
					break;
				}

				if ($find_success == $find_lines)
				{
					// we found the proper number of lines
					$this->start_index = $i;

					// return our array offsets
					return array(
						'start' => $i,
						'end' => $i + $j,
					);
				}

			}
		}

		// if return has not been previously invoked, the find failed.
		return false;
	}

	/**
	* Find a string within a given line
	*
	* @param string $find Complete find - narrows the scope of the inline search
	* @param string $inline_find - the substring to find
	* @param int $start_offset - the line number where $find starts
	* @param int $end_offset - the line number where $find ends
	*
	* @return mixed array on success or false on failure of find
	*/
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
	* @param string $find - Complete find - narrows the scope of the inline search
	* @param string $add - The string to be added before or after $find
	* @param string $pos - BEFORE or AFTER
	* @param int $start_offset - First line in the FIND
	* @param int $end_offset - Last line in the FIND
	*
	* @return bool success or failure of add
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

		return true;
	}

	/**
	* Increment (or perform custom operation) on  the given wildcard
	* Support multiple wildcards {%:1}, {%:2} etc...
	* This method is a variation on the inline find and replace methods
	*
	* @param string $find - Complete find - contains $inline_find
	* @param string $inline_find - contains tokens to be replaced
	* @param string $operation - tokens to do some math
	* @param int $start_offset - First line in the FIND
	* @param int $end_offset - Last line in the FIND
	*
	* @return bool
	*/
	function inc_string($find, $inline_find, $operation, $start_offset = false, $end_offset = false)
	{
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

		// $inline_find is optional
		if (!$inline_find)
		{
			$inline_find = $find;
		}

		// parse the MODX operator
		// let's explain this regex a bit:
		// - literal %: followed by a number.  optional space
		// - plus or minus operator. optional space
		// - number to increment by.  optional
		preg_match('#{%:(\d+)} ?([+-]) ?(\d*)#', $operation, $action);
		// make sure there is actually a number here
		$action[2] = (isset($action[2])) ? $action[2] : '+';
		$action[3] = (isset($action[3])) ? $action[3] : 1;

		$matches = 0;
		// $start_offset _should_ equal $end_offset, but we allow other cases
		for ($i = $start_offset; $i <= $end_offset; $i++)
		{
			$inline_find = preg_replace('#{%:(\d+)}#', '(\d+)', $inline_find);

			if (preg_match('#' . $inline_find . '#is', $this->file_contents[$i], $find_contents))
			{
				// now we can do some math
				// $find_contents[1] is the original number, $action[2] is the operator
				$new_number = eval('return ' . ((int) $find_contents[1]) . $action[2] . ((int) $action[3]) . ';');

				// now we replace
				$new_contents = str_replace($find_contents[1], $new_number, $find_contents[0]);

				$this->file_contents[$i] = str_replace($find_contents[0], $new_contents, $this->file_contents[$i]);

				$matches += 1;
			}
		}

		if (!$matches)
		{
			return false;
		}

		return true;
	}


	/**
	* Replace a string - replaces the entirety of $find with $replace
	*
	* @param string $find - Complete find - contains $inline_find
	* @param string $replace - Will replace $find
	* @param int $start_offset - First line in the FIND
	* @param int $end_offset - Last line in the FIND
	*
	* @return bool
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

		// remove each line
		for ($i = $start_offset; $i <= $end_offset; $i++)
		{
			$this->file_contents[$i] = '';
		}

		$this->file_contents[$start_offset] = rtrim($replace) . "\n";

		return true;
	}

	/*
	* Replace $inline_find with $inline_replace
	* Arguments are very similar to inline_add, below
	*/
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

		return true;
	}

	/**
	* Adds a string inline before or after a given find
	*
	* @param string $find Complete find - narrows the scope of the inline search
	* @param string $inline_find - the string to add before or after
	* @param string $inline_add - added before or after $inline_find
	* @param string $pos - 'BEFORE' or 'AFTER'
	* @param int $array_offset - line number where $inline_find may be found (optional)
	* @param int $string_offset - location within the line where $inline_find begins (optional)
	* @param int $length - essentially strlen($inline_find) (optional)
	*
	* @return bool success or failure of action
	*/
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

		return true;
	}

	/**
	* Write & close file
	*/
	function close_file($new_filename)
	{
		global $phpbb_root_path, $edited_root, $db;

		if (!file_exists($phpbb_root_path . dirname($new_filename)))
		{
			$this->recursive_mkdir($phpbb_root_path . dirname($new_filename), 0777);
		}

		$file_contents = implode('', $this->file_contents);

		if ($this->write_method == WRITE_DIRECT && file_exists($new_filename) && !is_writable($new_filename))
		{
			if (is_object($this->compress))
			{
				// this possibility is not currently ... possible :/
				$this->write_method = WRITE_MANUAL;
			}
			else
			{
				trigger_error('WRITE_DIRECT_FAIL');
			}
		}

		if ($this->template_id)
		{
			// grab filename
			preg_match('#styles/[a-z0-9_]+/template/([a-z0-9_]+.html)#i', $new_filename, $match);

			$sql = 'UPDATE ' . STYLES_TEMPLATE_DATA_TABLE . " 
				SET template_data = '" . $db->sql_escape($file_contents) . "', template_mtime = " . (int) $this->install_time . ' 
				WHERE template_id = ' . (int) $this->template_id . "
					AND template_filename = '" . $db->sql_escape($match[1]) . "'";
			$db->sql_query($sql);

			// if something failed, sql_query will error out
			return true;
		}
		else if ($this->write_method == WRITE_DIRECT)
		{
			// skip FTP, use local file functions
			$fr = @fopen($phpbb_root_path . $new_filename, 'wb');
			@fwrite($fr, $file_contents);
			return @fclose($fr);
		}
		else if ($this->write_method == WRITE_FTP)
		{
			return $this->transfer->write_file($new_filename, $file_contents);
		}
		else if ($this->write_method == WRITE_MANUAL)
		{
			// don't include extra dirs in zip file
			$strip_position = strpos('edited_', $new_filename) + 7; // want the end of the string
			$new_filename = substr($new_filename, $strip_position);

			return $this->compress->add_data($file_contents, $new_filename);
		}
		else
		{
			trigger_error('MODS_SETUP_INCOMPLETE', E_USER_ERROR);
		}
	}

	/**
	* @author Michal Nazarewicz (from the php manual)
	* Creates all non-existant directories in a path
	*/
	function recursive_mkdir($path, $mode = 0777)
	{
		// if files aren't writable, we can't do this...
		if ($this->write_method == WRITE_FTP)
		{
			// ... luckily, the FTP class provides an alternative
			$this->transfer->make_dir($path);
			return;
		}
		else if ($this->write_method == WRITE_MANUAL)
		{
			return;
		}

		$dirs = explode('/', $path);
		$count = sizeof($dirs);
		$path = '.';
		for ($i = 0; $i < $count; $i++)
		{
			$path .= '/' . $dirs[$i];

			if (!is_dir($path))
			{
				@mkdir($path, $mode);
				@chmod($path, $mode);

				if (!is_dir($path))
				{
					return false;
				}
			}
		}
		return true;
	}

}

/**
* List files matching specified PCRE pattern.
*
* @access public
* @param string Relative or absolute path to the directory to be scanned.
* @param string Search pattern (perl compatible regular expression).
* @param integer Number of subdirectory levels to scan (set to 1 to scan only current).
* @param integer This one is used internally to control recursion level.
* @return array List of all files found matching the specified pattern.
*/
function find_files($directory, $pattern, $max_levels = 3, $_current_level = 1)
{
	if ($_current_level <= 1)
	{
		if (strpos($directory, '\\') !== false)
		{
			$directory = str_replace('\\', '/', $directory);
		}
		if (empty($directory))
		{
			$directory = './';
		}
		else if (substr($directory, -1) != '/')
		{
			$directory .= '/';
		}
	}

	$files = array();
	$subdir = array();
	if (is_dir($directory))
	{
		$handle = @opendir($directory);
		while (($file = @readdir($handle)) !== false)
		{
			if ($file == '.' || $file == '..')
			{
				continue;
			}

			$fullname = $directory . $file;

			if (is_dir($fullname))
			{
				if ($_current_level < $max_levels)
				{
					$subdir = array_merge($subdir, find_files($fullname . '/', $pattern, $max_levels, $_current_level + 1));
				}
			}
			else
			{
				if (preg_match('/^' . $pattern . '$/i', $file))
				{
					$files[] = $fullname;
				}
			}
		}
		@closedir($handle);
		sort($files);
	}

	return array_merge($files, $subdir);
}

?>