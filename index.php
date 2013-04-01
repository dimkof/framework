<?php

define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
require_once(DOCROOT.'framework/bootstrap.php');

echo \Core\Debug::time(START_TIME).'<br>';
echo \Core\Debug::memory(START_MEMORY).'<br>';
echo \Core\Debug::time(START_TIME, 'sec').'<br>';
