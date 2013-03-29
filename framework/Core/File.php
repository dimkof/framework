<?php

namespace Core;

class File {

	/**
	 * Searches for a file in the Cascading Filesystem,
	 * and returns the path to the file that has the highest precedence,
	 * so that it can be included.
	 *
	 * @param string $dir
	 * @param string $file
	 * @param string $ext
	 *
	 * @return boolean|string filepath
	 */
	public static function find($dir, $file, $ext = NULL, $array = FALSE)
	{
		if ($ext === NULL)
		{
			// Use the default extension
			$ext = EXT;
		}
		elseif ($ext)
		{
			// Prefix the extension with a period
			$ext = ".{$ext}";
		}
		else
		{
			// Use no extension
			$ext = '';
		}

		// Create a partial path of the filename
		$path = $dir.DIRECTORY_SEPARATOR.$file.$ext;

		if ($array)
		{
			// Include paths must be searched in reverse
			$paths = array_reverse(Simply::$_paths);

			// Array of files that have been found
			$found = array();

			foreach ($paths as $dir)
			{
				if (is_file($dir.$path))
				{
					// This path has a file, add it to the list
					$found[] = $dir.$path;
				}
			}
		}
		else
		{
			// The file has not been found yet
			$found = FALSE;

			foreach (self::$_paths as $dir)
			{
				if (is_file($dir.$path))
				{
					// A path has been found
					$found = $dir.$path;

					// Stop searching
					break;
				}
			}
		}

		return $found;
	}
}
