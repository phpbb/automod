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
//define('AFTER',		1);
//define('BEFORE',	2);

/**
* Base IO class
* @package pacman
* @todo: implement an error handler
*/
class io
{
	var $root;
	var $data = array();

	/**
	* Set Root
	*/
	function io($root)
	{
		$this->root = $root;
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

		if(!is_dir("{$this->root}{$sub_dirs}/"))
		{
			mkdir("{$this->root}{$sub_dirs}", 0644); // what perms we want here?
		}

		if (function_exists('file_put_contents'))
		{
			file_put_contents("{$this->root}{$filename}", trim($content));
		}
		else
		{
			if ($fp = @fopen("{$this->root}{$filename}", 'wb'))
			{
				@flock($fp, LOCK_EX);
				@fwrite ($fp, trim($content));
				@flock($fp, LOCK_UN);
				@fclose($fp);

				@umask(0);
				@chmod("{$this->root}{$filename}", 0644);
			}
		}
	}

	/**
	* Copies all files in source sub  directroy of root to target sub directory of store
	* Alternative, if first arg is a file, copies file to target sub dir of store
	* Any files named in $exceptions are excluded
	*/
	function copy_content($src, $to, $exceptions = array())
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

		return true; // need to put false erroring in write_content etc....
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
	var $previous_edits;

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
		if (strpos($this->unprocessed[$filename], trim($find)) === false)
		{
			// Error out
			//echo('<br/>Cannot locate find string: <br/><pre>' . htmlspecialchars($find) . '</pre><br/>');
			// and return false
			return false;
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

//	/**
//	* Wraps the string in the appriopriate commenting out
//	*/
//	function add_wrap($string, $file_ext, $id)
//	{
//		global $phpEx;
//		
//		$command_id = mt_rand();
//	
//		switch($file_ext)
//		{
//			case $phpEx;
//			case 'js':
//			case 'css':
//				$string = str_replace('*/', '*\/', $string);
//				$string = "/*{{$id}:{$command_id}\n{$string}\n{$id}:{$command_id}}*/";
//			break;
//
//			case 'html':
//			case 'htm':
//				$string = str_replace('-->', '--/>', $string);
//				$string = "<!--{{$id}:{$command_id}\n{$string}\n{$id}:{$command_id}}-->";
//			break;
//			
//			case 'cfg':
//				$string = "{{$id}:{$command_id}\n{$string}\n{$id}:{$command_id}}";
//				$lines = explode("\n", $string);
//				$string = "#\n" . implode("\n#", $lines);
//			break;
//		}
//		
//		return $string;
//	}

	/**
	* Wraps the string in the appropriate anchor
	* Could be a little better me thinks, than just having a stab, due to the file extension
	*/
	function add_anchor($string, $file_ext, $id)
	{
		global $phpEx;
		
		$command_id = mt_rand();
	
		switch($file_ext)
		{
			case $phpEx;
			case 'js':
				$string = "//>{$id}:{$command_id}\n{$string}\n//<{$id}:{$command_id}";
			break;
			
			case 'html':
			case 'htm':
				$string = "<!-->{$id}:{$command_id}-->\n{$string}\n<!--<{$id}:{$command_id}-->";
			break;
			
			case 'css':
				$string = "/*>{$id}:{$command_id}*/\n{$string}\n/*<{$id}:{$command_id}*/";
			break;
			
			case 'cfg':
				$string = "#>{$id}:{$command_id}\n{$string}\n#<{$id}:{$command_id}";
			break;
		}
		
		return $string;
	}
	
	/**
	* Cut and store all previous package edits in file, unless preformed by a package with an ID in the exceptions array
	*/
	function fold_edits($filename, $exceptions)
	{
		if(empty($exceptions))
		{
		
		}
		
		return;
	}

	/**
	* Inserted stored previous package edits back into file
	*/
	function unfold_edits($filename, $exceptions)
	{
		if(empty($exceptions))
		{
		
		}
		
		return;
	}

	/**
	* Add a string to the file, BEFORE/AFTER the given find string
	* @todo: inline
	*/
	function add_string($filename, $find, $add, $pos)
	{
		$find = trim($this->normalize($find));
		if(!$this->check_find($filename, $find))
		{
			return false;
		}

		$data = explode($find, ' ' . $this->unprocessed[$filename] . ' ');

		$this->processed[$filename] .= $data[0];

		array_shift($data);
		$this->unprocessed[$filename] = implode($find, $data);
		
		if ($pos == 'AFTER')
		{
			$this->unprocessed[$filename] = trim($find) . "\n" . trim($add) . "\n" . trim($this->unprocessed[$filename]);
		}
		elseif($pos == 'BEFORE')
		{
			$this->unprocessed[$filename] = trim($add) . "\n" . trim($find) . trim($this->unprocessed[$filename]);
		}
		
		return true;
	}

	/**
	* Increment (or preform custom operation) on  the given wildcard
	* Support multiple wildcards {%:1}, {%:2} etc...
	*/
	function inc_string($filename, $find, $operation)
	{
		$find = trim($this->normalize($find));
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
	
		return true;
	}

	/**
	* Replace a string
	*/
	function replace_string($filename, $find, $replace)
	{
		$find = trim($this->normalize($find));
		
		if(!$this->check_find($filename, $find))
		{
			return false;
		}

		$this->unprocessed[$filename] = str_replace($find, $replace, $this->unprocessed[$filename]);
	
		return true;
	}

	/**
	* Write & close file
	*/
	function close_file($filename, $new_filename = '')
	{
		if(!empty($new_filename))
		{
			$this->write_content($new_filename, $this->processed[$filename] . $this->unprocessed[$filename]);
		}
		else
		{
			$this->write_content($filename, $this->processed[$filename] . $this->unprocessed[$filename]);
		}

		$this->clear_content($filename);
		unset($this->processed[$filename]);
		unset($this->unprocessed[$filename]);
	}
}

?>