<?php

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(dirname(__DIR__)));
define('BASE', basename(BASE_PATH));
define('APP', 'App' . DS);
define('CORE', 'Core' . DS);
define('BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php', '', $_SERVER['PHP_SELF']));
define('ASSETS_PATH', BASE_PATH . DS . 'assets' . DS);
define('EXT', '.php');

define('DB', 'testDb.db');
