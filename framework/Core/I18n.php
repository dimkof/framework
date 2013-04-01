<?php

namespace Core;

class I18n {

	/**
	 * @var string
	 */
	private static $_lang = 'en';

	/**
	 * @var array cache of loaded languages
	 */
	protected static $_cache = array();

	/**
	 * Get and set the target language.
	 *
	 * @param string $lang - new language setting
	 * @return string
	 */
	public static function lang($lang = NULL)
	{
		if ($lang)
		{
			self::$_lang = strtolower(str_replace(array(' ', '_'), '-', $lang));
		}

		return self::$_lang;
	}

	/**
	 * Returns translation of a string. If no translation exists, the original
	 * string will be returned. No parameters are replaced.
	 *
	 *     $hello = \Core\I18n::get('Hello friends, my name is :name');
	 *
	 * @param   string  $string text to translate
	 * @param   string  $lang   target language
	 * @return  string
	 */
	public static function get($string, $lang = NULL)
	{
		if ( ! $lang)
		{
			// Use the global target language
			$lang = self::$_lang;
		}

		// Load the translation table for this language
		$table = self::load($lang);

		// Return the translated string if it exists
		return isset($table[$string]) ? $table[$string] : $string;
	}

	/**
	 * Returns the translation table for a given language.
	 *
	 *     // Get all defined Spanish messages
	 *     $messages = \Core\I18n::load('es-es');
	 *
	 * @param string $lang language to load
	 * @return array
	 */
	public static function load($lang)
	{
		if (isset(self::$_cache[$lang]))
		{
			return self::$_cache[$lang];
		}

		// New translation table
		$table = array();

		// Split the language: language, region, locale, etc
		$parts = explode('-', $lang);

		do
		{
			// Create a path for this set of parts
			$path = implode(DIRECTORY_SEPARATOR, $parts);

			if ($files = Simply::find_file('i18n', $path, NULL, TRUE))
			{
				$t = array();

				foreach ($files as $file)
				{
					// Merge the language strings into the sub table
					$t = array_merge($t, Simply::load($file));
				}

				// Append the sub table, preventing less specific language
				// files from overloading more specific files
				$table += $t;
			}

			// Remove the last part
			array_pop($parts);
		}
		while ($parts);

		// Cache the translation table locally
		return self::$_cache[$lang] = $table;
	}

} // End I18n


if ( ! function_exists('__'))
{
	/**
	 * Translation/internationalization function. The PHP function
	 * [strtr](http://php.net/strtr) is used for replacing parameters.
	 *
	 *    __('Welcome back, :user', array(':user' => $username));
	 *
	 * @uses    I18n::get
	 * @param   string  $string text to translate
	 * @param   array   $values values to replace in the translated text
	 * @param   string  $lang   source language
	 * @return  string
	 */
	function __($string, array $values = NULL, $lang = 'en')
	{
		if ($lang !== I18n::$lang)
		{
			// The message and target languages are different
			// Get the translation for this message
			$string = I18n::get($string);
		}

		return empty($values) ? $string : strtr($string, $values);
	}
}
