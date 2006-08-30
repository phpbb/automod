<?php
/** 
*
* @package pacman
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

// Constant Defines for actions
define('AFTER',		1);
define('BEFORE',	2);

/**
* Base IO class
* @package pacman
*/
class io
{
	var $root, $store;
	var $data = array();

	/**
	* Set Root
	*/
	function io($root, $store)
	{
		$this->root = $root;
		$this->store = $store;
	}

	/**
	* Return a files content (could be already loaded)
	*/
	function get_content($filename)
	{
		if (isset($this->data[$filename]))
		{
			return $this->data[$filename];
		}
		else
		{
			$this->data[$filename] = $this->load_content($filename);
			return $this->data[$filename];
		}
	}

	/**
	* Actually load a files content
	*/
	function load_content($filename)
	{
		if (!file_exists($this->root . $filename))
		{
			die('Cannot locate File: ' . $this->root . $filename);
		}

		$contents = trim(@file_get_contents($this->root . $filename));
		return $contents;
	}

	/**
	* Write given string to file (rewriting old content)
	*/
	function write_content($filename, $content)
	{
		// handle any uncreated dirs up to file
		$sub_dirs = explode('/', $filename);
		array_pop($sub_dirs);
		$sub_dirs = implode('/', $sub_dirs);
		
		$filename = "{$this->store}/{$filename}";

		if(!is_dir("{$this->store}/{$sub_dirs}/"))
		{
			mkdir("{$this->store}/{$sub_dirs}", 0644); // what perms we want here?
		}

		if (function_exists('file_put_contents'))
		{
			file_put_contents($filename, trim($content));
		}
		else
		{
			if ($fp = @fopen($filename, 'wb'))
			{
				@flock($fp, LOCK_EX);
				@fwrite ($fp, trim($content));
				@flock($fp, LOCK_UN);
				@fclose($fp);

				@umask(0);
				@chmod($filename, 0644);
			}
		}
	}

	/**
	* Copies all files in source sub  directroy of root to target sub directory of store
	* Alternative, if first arg is a file, copies file to target sub dir of store
	* Any files named in $exceptions are excluded
	*/
	function copy_content($src, $to, $exceptions = '')
	{
		if(@is_dir("{$this->root}{$src}"))
		{
			$dp = opendir($this->root . $src);
			while (($file = readdir($dp)) !== false)
			{
				if (($file{0} != '.') && (!in_array($file, $exceptions)))
				{
					if (is_dir("{$this->root}{$src}{$file}"))
					{
						$this->copy_content("{$src}{$file}/", "{$to}{$file}/", $exceptions);
					}
					else
					{
						$new_content = $this->get_content("{$src}{$file}");
						$this->write_content("{$to}{$file}", $new_content);
					}
				}
			}
		}
		else
		{
			$new_content = $this->get_content($src);
			$this->write_content($to, $new_content);
		}

		return;
	}

	/**
	* Unload file content
	*/
	function clear_content($filename)
	{
		unset($this->data[$filename]);
	}
}

/**
* Editor Class, extends IO
* Runs through file sequential, ie new finds must come after previous finds
* SQL and file copying not handled
* @package pacman
* @todo: implement some string checkin, way too much can go wild here
*/
class editor extends io
{
	var $unprocessed, $processed;

	/**
	* Make all line endings the same
	*/
	function normalize($string)
	{
		$string = str_replace(array("\r\n", "\r"), array("\n", "\n"), $string);
		return $string;
	}

	/**
	* Checks if a find is present
	*/
	function check_find($filename, $find)
	{
		if (strstr($this->unprocessed[$filename], trim($find)) === false)
		{
			// Passed?
			if (strstr($this->processed[$filename], trim($find)))
			{
				die('Only find string available has been passed: <br/><pre>' . htmlspecialchars($find) . '</pre>');
			}

			// Error out
			die('Cannot locate find string: <br/><pre>' . htmlspecialchars($find) . '</pre>');
		}
		return true;
	}
	
	/**
	* Open a file with IO, for processing
	*/
	function open_file($filename)
	{
		$this->unprocessed[$filename] = $this->normalize($this->get_content($filename));
		$this->processed[$filename] = '';
	}

	/**
	* Add a string to the file, BEFORE/AFTER the given find string
	* @todo: inline
	*/
	function add_string($filename, $find, $add, $pos)
	{
		$find = $this->normalize($find);
		$this->check_find($filename, $find);

		list($passed_data, $unpassed_data) = explode($find, $this->unprocessed[$filename]);
		$this->processed[$filename] .= $passed_data;
		$this->unprocessed[$filename] = $unpassed_data;

		if ($pos == AFTER)
		{
			$this->unprocessed[$filename] = $find . "\n" . $add . $this->unprocessed[$filename];
		}
		elseif($pos == BEFORE)
		{
			$this->unprocessed[$filename] = $add . "\n" . $find . $this->unprocessed[$filename];
		}
	}

	/**
	* Increment (or preform custom operation) on  the given wildcard
	* Support multiple wildcards {%:1}, {%:2} etc...
	*/
	function inc_string($filename, $find, $operation)
	{
		$find = $this->normalize($find);
		$operation = trim($operation);

		if (strstr($operation, ' '))
		{
			list($token) = explode(' ', $operation);
			$token = str_replace('%:', '', $token);
		}
		else
		{
			$token = str_replace('%:', '', $operation);
		}

		// Complicated find (simplfy out other searches)
		preg_match_all('#%:(\d*?)#', $find, $m);
		if (count($m[0]) > 1)
		{
			$find_segs = explode("{%:$token}", $find);
			
			foreach($find_segs as $find_string)
			{
				$find_string = '#' . preg_replace('#\\\{%\\\:(.*?)\\\}#' , '(.*?)', preg_quote($find_string)) . '#';
				preg_match_all($find_string, $this->unprocessed[$filename], $m);
				$found[] = $m[0][0];
			}
			
			// find is now search string with one widlcard to operate on
			$find = $found[0] . '{%:' . $token . '}' . $found[1];
		}

		// Get the old nuumber
		$num_find = '#' . str_replace('\{%\:' . $token . '\}', '(.*?)', preg_quote($find)) . '#';
		preg_match($num_find, $this->unprocessed[$filename], $m);
		$old_num = $m[1];
		
		if (strstr($operation, '+'))
		{
			list(, $add) = explode('+', $operation);
			$new_num = $old_num + $add;
		}
		elseif (strstr($operation, '-'))
		{
			list(, $sub) = explode('-', $operation);
			$new_num = $old_num - $sub;
		}
		else
		{
			$new_num = $old_num + 1;
		}

		$replace = str_replace("{%:$token}", $new_num, $find);
		$find = '#' . str_replace('\{%\:' . $token . '\}', '(.*?)', preg_quote($find)) . '#';

		// insert back in
		$this->unprocessed[$filename] = preg_replace($find, $replace, $this->unprocessed[$filename]);
	}

	/**
	* Replace a string
	*/
	function replace_string($filename, $find, $replace)
	{
		$find = $this->normalize($find);
		$this->check_find($filename, $find);
		$this->unprocessed[$filename] = str_replace($find, $replace, $this->unprocessed[$filename]);
	}

	/**
	* Write & close file
	*/
	function close_file($filename)
	{
		$this->write_content($filename, $this->processed[$filename] . $this->unprocessed[$filename]);
		$this->clear_content($filename);
		unset($this->processed[$filename]);
		unset($this->unprocessed[$filename]);
	}
}

?>