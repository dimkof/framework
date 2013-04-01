<?php

class Test {

	public static function event($data = 'событие сработало, но данные не передались')
	{
		# Examples
		#######################################################################################
		// throw new \Core\Exception('This is an uncaught exception'); /* UNCAUGHT EXCEPTION */
		// inexisitingFunction(); /* ERROR */
		// IMAGINARY_CONSTANT; /* NOTICE */
		// include('non_exisiting.file'); /* WARNING */

		try
		{
			throw new \Core\Exception();
			echo $wdata.'<br>';
		}
		catch (\Core\Exception $e)
		{
			echo $e->getMessage();
		}

		// throw new \Core\Exception();
	}
}
