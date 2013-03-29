<?php

namespace Core;

class Debug {

	/**
	 * @void string
	 */
	private static $_start_time;

	/**
	 * @void string
	 */
	private static $_start_memory;

	/**
	 * Set start time
	 */
	public static function start_time()
	{
		self::$_start_time = microtime(TRUE);
	}

	/**
	 * Set start memory
	 */
	public static function start_memory()
	{
		self::$_start_memory = memory_get_usage();
	}


	public static function time($start_time = NULL, $round = TRUE, $suffix = ' sec')
	{
		$start_time = ($start_time) ? $start_time : self::$_start_time;

		if ($round)
		{
			$time = round((microtime(TRUE) - $start_time), 3);
		}
		else
		{
			$time = microtime(TRUE) - $start_time;
		}

		return $time.$suffix;
	}


	public static function memory($start_memory = NULL)
	{
		$start_memory = ($start_memory) ? $start_memory : self::$_start_memory;

		return sprintf('%01.3f', (((memory_get_usage() - $start_memory) / 1024) / 1024)) . ' MB';
	}
}
