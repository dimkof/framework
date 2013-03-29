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
	 * Array paths for autoload
	 *
	 * @void array
	 */
	public static $_paths = array(SYSPATH);

	/**
	 * Initialization framework.
	 * Set Autoload.
	 * Sanitize request valiable.
	 */
	public static function init()
	{
		// Sanitize all request variables
		$_GET    = Security::sanitize($_GET);
		$_POST   = Security::sanitize($_POST);
		$_COOKIE = Security::sanitize($_COOKIE);

		// Enable the Simply exception handling, adds stack traces and error source.
		// set_exception_handler(array('Exception', 'exception_handler'));

		// Enable the Simply error handling, converts all PHP errors to exceptions.
		// set_error_handler(array('Exception', 'error_handler'));

		// Enable the Simply shutdown handler, which catches E_FATAL errors.
		// register_shutdown_function(array('Exception', 'shutdown_handler'));
	}


	public static function auto_load($class_name)
	{
		return Autoload::get_class($class_name);
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
