<?php

/**
 * Начало отсчета времени выполнения скрипта
 */
if ( ! defined('START_TIME'))
{
    define('START_TIME', microtime(TRUE));
}

/**
 * Начало отсчета потребляемой памяти скрипта
 */
if ( ! defined('START_MEMORY'))
{
    define('START_MEMORY', memory_get_usage());
}

/**
 * The default extension of resource files. If you change this, all resources
 * must be renamed to use the new extension.
 */
define('EXT', '.php');

/**
 * Set the PHP error reporting level. If you set this in php.ini, you remove this.
 */
error_reporting(E_ALL | E_STRICT);

/**
 * Set timezone
 */
date_default_timezone_set('Europe/Kiev');

/**
 * Set locale
 */
setlocale(LC_ALL, 'ru_RU.utf-8');

/**
 * Include core app
 */
define('SYSPATH', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
require_once(SYSPATH.'Core/Simply'.EXT);

/*
 * Enable Simply Framework auto-loader
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('\Core\Simply', 'auto_load'));

/*
 * Enable Simply Framework auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');
