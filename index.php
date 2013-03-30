<?php

define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
require_once(DOCROOT.'framework/bootstrap.php');

echo \Core\Debug::time().'<br>';
echo \Core\Debug::memory();
echo \Core\Debug::time(START_TIME, 'sec').'<br>';
