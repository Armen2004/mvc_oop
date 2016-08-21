<?php namespace Core;

use PDO;
use Exception;
use PDOException;
use Core\interfaces\DatabaseInterface;

class Database implements DatabaseInterface
{
    /**
     * @var database
     */
    const DB = "sqlite:testDb.db";
    const DB_NAME = "testDb.db";

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

                if (is_file(self::DB_NAME) && filesize(self::DB_NAME) == 0) {
                    $sql = "CREATE TABLE files( 
                              id INTEGER PRIMARY KEY AUTOINCREMENT, 
                              image_name TEXT, 
                              image_path TEXT
                              )";
                    self::$connect->exec($sql);
                }

            } catch (Exception $e) {
                exit($e->getMessage());
            } catch (PDOException $e) {
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