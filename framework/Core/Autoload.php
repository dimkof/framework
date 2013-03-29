<?php

namespace Core;

class Autoload {

	/**
	 * Array paths for autoload
	 *
	 * @void array
	 */
	public static $_paths = array(SYSPATH);

	/**
	 * Autoload classes
	 *
	 * @param string $class
	 * @return boolean
	 */
	public static function get_class($class)
	{
		// Transform the class name according to PSR-0
		$class     = ltrim($class, '\\');
		$file      = '';
		$namespace = '';

		if ($last_namespace_position = strripos($class, '\\'))
		{
			$namespace = substr($class, 0, $last_namespace_position);
			$class     = substr($class, $last_namespace_position + 1);
			$file      = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
		}

		$file .= str_replace('_', DIRECTORY_SEPARATOR, $class);

		if ($path = self::find_file($file))
		{
			// Load the class file
			require $path;

			// Class has been found
			return TRUE;
		}

		// Class is not in the filesystem
		return FALSE;
	}

	/**
	 * Find file
	 *
	 * @param string $file
	 * @param string $ext
	 *
	 * @return boolean|string filepath
	 */
	public static function find_file($file, $ext = NULL)
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
		$path = $file.$ext;

		foreach(self::$_paths as $dir)
		{
			if (is_file($dir.$path))
			{
				return $dir.$path;
			}
		}

		return FALSE;
	}
}
