<?php

define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
require_once(DOCROOT.'framework/bootstrap.php');

\Core\Simply::init();

echo \Core\Debug::time(START_TIME).'<br>';
echo \Core\Debug::memory(START_MEMORY);
