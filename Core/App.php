<?php namespace Core;

class App
{
    private $_controller = "HomeController";
    private $_model = "Home";
    private $_view;

    public function __construct()
    {
        //echo "11";
    }

    public static function run()
    {
        $routes = Route::getRoute();
        var_dump($routes);
        die;
        if (!empty($routes['controller'])) {

            $url_controller = $routes['controller'];

            $file = APP . 'controllers' . DIRECTORY_SEPARATOR . $url_controller;

            if (file_exists($file . '.php')) {

                $controller = new $file;
                $url_method = 'index';

                // Checking our controller has this method
                if (!empty($routes['method'])) {
                    $url_method = $routes['method'];
                }

                if (method_exists($controller, $url_method)) {
                    $controller->$url_method();
                } else {

                    Error::CreateError()->no_page();

                }

            } else {
                Error::CreateError()->no_page();
            }

        } else {

            echo 'Welcome Pagee';

        }

    }

}