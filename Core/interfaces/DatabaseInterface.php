<?php namespace Core\interfaces;

interface DatabaseInterface
{
    /**
     * @return mixed
     */
    public static function connect();

    /**
     * @return mixed
     */
    public static function disconnect();
}