<?php namespace Core;

use PDO;
use Core\interfaces\DatabaseInterface;

class Database implements DatabaseInterface
{
    /**
     * @var database
     */
    const DB = "sqlite:testDb.sqlite";

    /**
     * @var null
     */
    public static $connect = null;

    /**
     * @return mixed
     */
    public static function connect()
    {
        if (null === static::$connect) {
            try {
                self::$connect = new PDO(self::DB);
                self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Exception $e) {
                exit($e->getMessage());
            }
        }

        return static::$connect;
    }

    /**
     * @return mixed
     */
    public static function disconnect()
    {
        unset(self::$connect);
    }
}