<?php namespace Core;


use Core\interfaces\RouterInterface;

class Route implements RouterInterface
{
    /**
     * @var array $routes
     */
    private static $routes;
    private static $currentURL;
    private static $currentRoutes;
    private static $currentRequestMethod;

    /**
     * @param string $key
     * @param string|array|callable $value
     * @return mixed
     */
    public static function get($key, $value)
    {
        self::$routes["get"][$key] = $value;
    }

    /**
     * @param string $key
     * @param string|array|callable $value
     * @return mixed
     */
    public static function post($key, $value)
    {
        self::$routes["post"][$key] = $value;
    }

    /**
     * @param string $key
     * @param string|array|callable $value
     * @return mixed
     */
    public static function put($key, $value)
    {
        self::$routes["put"][$key] = $value;
    }

    /**
     * @param string $key
     * @param string|array|callable $value
     * @return mixed
     */
    public static function delete($key, $value)
    {
        self::$routes["delete"][$key] = $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function any($key, $value)
    {
        self::get($key, $value);
        self::post($key, $value);
    }

    public static function getRoute()
    {
        self::$currentURL = Factory::make(Url::class)->get();


        require_once APP . "routes.php";

        self::$currentRequestMethod = strtolower($_SERVER['REQUEST_METHOD']);

        if (array_key_exists(self::$currentURL, self::$routes[self::$currentRequestMethod])) {

            if (self::$routes[self::$currentRequestMethod][self::$currentURL] instanceof \Closure) {
                exit(self::$routes[self::$currentRequestMethod][self::$currentURL]->__invoke());
            } else {
                $routeParts = explode("@", self::$routes[self::$currentRequestMethod][self::$currentURL]);

                if (!empty($routeParts[0]))
                    self::$currentRoutes['controller'] = $routeParts[0];
                self::$currentRoutes['method'] = !empty($routeParts[1]) ? $routeParts[1] : "index";

                self::$currentRoutes["parameters"] = null;
                if (!empty($routeParts[2])) {
                    unset($routeParts[0], $routeParts[1]);
                    self::$currentRoutes["parameters"] = array_values($routeParts);
                }
            }
            return self::$currentRoutes;
        }

        Factory::make(Error::class)->methodNotAllowed();

    }

}