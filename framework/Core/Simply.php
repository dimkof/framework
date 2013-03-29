<?php

/**
 * Simply Framework
 * @copyright  (c) 2012-2013 Simply Framework Team
 * @link https://github.com/simply-framework
 * @autor Dmitry Momot (dmitry@dimkof.com)
 * @link http://dimkof.com
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

namespace Core;

class Simply {

	/**
	 * Release version and codename
	 */
	const VERSION  = '0.0.1';
	const CODENAME = 'init';


	/**
	 * Common environment type constants for consistency and convenience
	 */
	const PRODUCTION  = 10;
	const STAGING     = 20;
	const TESTING     = 30;
	const DEVELOPMENT = 40;

	/**
	 * @void boolean
	 */
	public static $_init = FALSE;

	/**
	 * Initialization framework.
	 * Set Autoload.
	 * Sanitize request valiable.
	 * Disables register_globals and magic_quotes_gpc.
	 *
	 * @return  void
	 */
	public static function init()
	{
		// Enable the Simply exception handling, adds stack traces and error source.
		// set_exception_handler(array('Exception', 'exception_handler'));

		// Enable the Simply error handling, converts all PHP errors to exceptions.
		// set_error_handler(array('Exception', 'error_handler'));

		// Enable the Simply shutdown handler, which catches E_FATAL errors.
		// register_shutdown_function(array('Exception', 'shutdown_handler'));

		if (ini_get('register_globals'))
		{
			// Reverse the effects of register_globals
			self::globals();
		}

		// Sanitize all request variables
		$_GET    = self::sanitize($_GET);
		$_POST   = self::sanitize($_POST);
		$_COOKIE = self::sanitize($_COOKIE);

		self::$_init = TRUE;
	}

	/**
	 * @return  void
	 */
	public static function deinit()
	{
		if (self::$_init)
		{
			// Removed the autoloader
			spl_autoload_unregister(array('\Core\Simply', 'auto_load'));

			// Go back to the previous error handler
			restore_error_handler();

			// Go back to the previous exception handler
			restore_exception_handler();

			// Kohana is no longer initialized
			self::$_init = FALSE;
		}
	}

	/**
	 * Autoload classes
	 *
	 * @retrun boolean
	 */
	public static function auto_load($class_name)
	{
		return Autoload::get_class($class_name);
	}

	/**
	 * Cache
	 *
	 * @return class instance
	 */
	public static function cache($cache_type = 'file')
	{
		return Cache::instance($cache_type);
	}

	/**
	 * Config
	 *
	 * @return class instance
	 */
	public static function config($driver = 'file')
	{
		return Config::instance($driver);
	}

	/**
	 * Cookies
	 *
	 * @return class instance
	 */
	public static function cookie()
	{

	}

	/**
	 * Event
	 *
	 * @return class instance
	 */
	public static function event()
	{

	}

	/**
	 * Searches for a file in the Cascading Filesystem,
	 * and returns the path to the file that has the highest precedence,
	 * so that it can be included.
	 *
	 * @return class instance
	 */
	public static function find_file($dir, $file, $ext = NULL, $array = FALSE)
	{
		return File::find($dir, $file, $ext, $array);
	}

	/**
	 * Reverts the effects of the `register_globals` PHP setting by unsetting
	 * all global varibles except for the default super globals (GPCS, etc),
	 * which is a [potential security hole.][ref-wikibooks]	 *
	 *
	 * [ref-wikibooks]: http://en.wikibooks.org/wiki/PHP_Programming/Register_Globals
	 *
	 * @return  void
	 */
	public static function globals()
	{
		return Security::globals();
	}

	/**
	 * Logs
	 *
	 * @return class instance
	 */
	public static function log()
	{

	}

	/**
	 * Message
	 *
	 * @return class instance
	 */
	public static function message()
	{

	}

	/**
	 * Add new path for search files
	 *
	 * @param string $path
	 * @param boolean $before  if TRUE - will add at the beginning of the array
	 */
	public static function set_path($path, $before = TRUE)
	{
		if ( ! is_array($path) )
		{
			self::registry('paths')->set($path);
		}

	}

	/**
	 * Registry
	 *
	 * @return class instance
	 */
	public static function registry($instance = 'default', $data = array())
	{
		return Registry::instance($instance, $data);
	}

	/**
	 * Request
	 *
	 * @return class instance
	 */
	public static function request()
	{

	}

	/**
	 * Response
	 *
	 * @return class instance
	 */
	public static function response()
	{

	}

	/**
	 * Sanitize data
	 *
	 * @return mixed
	 */
	public static function sanitize($data)
	{
		return Security::sanitize($data);
	}

	/**
	 * Session
	 *
	 * @return class instance
	 */
	public static function session()
	{
		return Session::instance();
	}

	/**
	 * Magic method to get an class instance of the namespace Core
	 *
	 * @return class instance
	 */
	public static function __callStatic($class, $arguments)
	{
		$class = \Helpers\UTF8::ucfirst($class);
		$class = '\\Core\\'.$class;

		if (class_exists($class))
		{
			return new $class($arguments);
		}

		echo 'Class '.$class.' not exists';
    }

	/**
	 * Simply Framework Copyright
	 *
	 * @return string
	 */
	public static function copyright()
	{
		return 'Simply Framework '.self::VERSION.' ('.self::CODENAME.')';
	}
}


/**
 * Set autoload
 */
require_once(SYSPATH.'Core/Autoload'.EXT);
