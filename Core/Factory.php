<?php namespace Core;

use ReflectionClass;

class Factory
{
    /**
     * @var array $createdObjects
     */
    private static $createdObjects;

    /**
     * @param $className
     * @param array ...$args
     * @return object
     */
    public static function make($className, ...$args)
    {
        $refClass = new ReflectionClass($className);

        return count($args) ? $refClass->newInstanceArgs($args) : $refClass->newInstance();
    }
}