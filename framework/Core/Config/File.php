<?php

namespace Core\Config;

class File extends \Core\Config {

	/**
	 * Load config group
	 *
	 * @param string $config_group
	 * @return array configs
	 */
	public function load($config_group)
	{
		return $this;
	}

	/**
	 * Get config key
	 *
	 * @param string $config_key
	 * @return mixed
	 */
	public function get($config_key)
	{
		return $config_key;
	}

	/**
	 * Set to config
	 *
	 * @param string $config_key
	 * @param mixed $data
	 * @return boolean
	 */
	public function set($config_key, $data)
	{
		return TRUE;
	}
}
