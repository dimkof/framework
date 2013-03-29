<?php

namespace DB;

abstract class Database {

	/**
	 * @void class instance
	 */
	private static $_connect = NULL;

	/**
	 * @void array connect config
	 */
	private static $_config = NULL;

    /**
     * @param string $config
     * @return class instance PDO
     */
    public static function connect($config_group = 'database', $config_key = 'default')
    {
        if(
            ! array_key_exists($config_group, self::$_connect)
            OR ! (self::$_connect[$config_group] instanceof self)
        )
        {
			// Load configuration for connect
			$config = \Core\Simply::config()
					->load($config_group)
					->get($config_key);

            self::$_connect[$config_group] = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        }

        return self::$_connect[$config_group];
    }
}
