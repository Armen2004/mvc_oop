<?php

if (!function_exists('autoload')) {
    function autoload($class)
    {
        if (is_file($class . ".php")) {
            require_once $class . ".php";
        } else {
            exit("Class {$class} not found");
        }
    }

    spl_autoload_register('autoload');
}