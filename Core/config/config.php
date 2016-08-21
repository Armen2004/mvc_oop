<?php

define('DS', DIRECTORY_SEPARATOR);
define('BASE', dirname(dirname(__DIR__)));
define('APP', 'App' . DS);
define('CORE', 'Core' . DS);
define('BASE_PATH', 'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php', '', $_SERVER['PHP_SELF']));
define('ASSETS_PATH', BASE . '\\assets\\');
define('EXT', '.php');
