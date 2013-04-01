<?php

namespace Core;

class Exception extends \Exception {

	/**
	 * @var  array  PHP error code => human readable name
	 */
	public static $php_errors = array(
		E_ERROR              => 'Fatal Error',
		E_USER_ERROR         => 'User Error',
		E_PARSE              => 'Parse Error',
		E_WARNING            => 'Warning',
		E_USER_WARNING       => 'User Warning',
		E_STRICT             => 'Strict',
		E_NOTICE             => 'Notice',
		E_RECOVERABLE_ERROR  => 'Recoverable Error',
		E_DEPRECATED         => 'Deprecated',
	);

	/**
	 * @var  string  error rendering view
	 */
	public static $error_view = 'error';

	/**
	 * @var  string  error view content type
	 */
	public static $content_type = 'text/html';

	/**
	 * Creates a new exception.
	 *
	 * @param   string          $message    error message
	 * @param   array           $variables  translation variables
	 * @param   integer|string  $code       the exception code
	 * @param   Exception       $previous   Previous exception
	 * @return  void
	 */
	public function __construct($message = '', $code = 0, Exception $previous = NULL)
	{
		\Core\Event::run('error', array($message, (int) $code, $previous));

		// Pass the message and integer code to the parent
		parent::__construct($message, (int) $code, $previous);

		// Save the unmodified code
		// @link http://bugs.php.net/39615
		$this->code = $code;
	}

	/**
	 * Magic object-to-string method.
	 *
	 *     echo $exception;
	 *
	 * @return  string
	 */
	public function __toString()
	{
		return '';
	}


	public static function exception_handler(\Exception $e)
	{
		echo 'Sorry, something went wrong';
		// var_dump($e);

		var_export(
			"<br>\n msg \t" 		. $e->getMessage() .
			"<br>\n file \t"		. $e->getFile() .
			"<br>\n line \t"		. $e->getLine() .
			"<br>\n trace \t<pre>"   	. $e->getTraceAsString() .
			"</pre><br>\n"
		);
	}

	public static function error_handler($e)
	{
		echo 'Sorry, something went wrong';
		var_dump($e);

		// print_r(
			// "<br>\n msg \t" 		. $e->getMessage() .
			// "<br>\n file \t"		. $e->getFile() .
			// "<br>\n line \t"		. $e->getLine() .
			// "<br>\n trace \t<pre>"   	. $e->getTraceAsString() .
			// "</pre><br>\n"
		// );
	}

	public static function shutdown_handler($e)
	{
		echo 'Sorry, something went wrong';
		var_dump($e);

		// print_r(
			// "<br>\n msg \t" 		. $e->getMessage() .
			// "<br>\n file \t"		. $e->getFile() .
			// "<br>\n line \t"		. $e->getLine() .
			// "<br>\n trace \t<pre>"   	. $e->getTraceAsString() .
			// "</pre><br>\n"
		// );
	}


}
