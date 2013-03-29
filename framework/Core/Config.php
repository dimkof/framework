<?php

namespace Core;

abstract class Config {

	/**
	 * Load config group
	 *
	 * @param string $config_group
	 * @return array configs
	 */
	abstract public function load($config_group);

	/**
	 * Get config key
	 *
	 * @param string $config_key
	 * @return mixed
	 */
	abstract public function get($config_key);

	/**
	 * Set to config
	 *
	 * @param string $config_key
	 * @param mixed $data
	 * @return boolean
	 */
	abstract public function set($config_key, $data);

    /**
     * @var array class instance
     */
    private static $_instance = array();

    /**
     * @param array $data
     * @return class instance
     */
    public static function instance($instance = 'file')
    {
        if(
            ! array_key_exists($instance, self::$_instance)
            OR ! (self::$_instance[$instance] instanceof self)
        )
        {
			$config_class = \Helpers\UTF8::ucfirst($instance);
			$config_class = 'Core\\Config\\'.$config_class;

            self::$_instance[$instance] = new $config_class;
        }

        return self::$_instance[$instance];
    }
}
