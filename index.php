<?php

if (!extension_loaded('sqlite3')) {
    exit("Please Enable 'sqlite3' extension from php.ini");
}

require_once "init.php";
require_once "Core/config/config.php";

//remove old database and create new one
//if (is_file(DB)) {
//    unlink(DB);
//    \Core\Database::connect();
//}

\Core\App::run();