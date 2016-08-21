<?php namespace Core\interfaces;

interface RouterInterface
{
    /**
     * @param string $key
     * @param string|array|callable $value
     * @return mixed
     */
    public static function get($key, $value);

    /**
     * @param string $key
     * @param string|array|callable $value
     * @return mixed
     */
    public static function post($key, $value);

    /**
     * @param string $key
     * @param string|array|callable $value
     * @return mixed
     */
    public static function put($key, $value);

    /**
     * @param string $key
     * @param string|array|callable $value
     * @return mixed
     */
    public static function delete($key, $value);

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function any($key, $value);
}