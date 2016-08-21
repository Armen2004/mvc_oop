<?php namespace Core;

class App
{

    public static function run()
    {
        $routes = Route::getRoute();

        if (!empty($routes['controller'])) {

            $url_controller = $routes['controller'];

            $file = APP . 'Controllers' . DS . $url_controller;

            if (is_file($file . EXT)) {

                $controller = Factory::make($file);
                $method = $routes['method'];

                if (method_exists($controller, $method)) {
                    $controller->$method();
                } else {
                    Factory::make(Error::class)->methodNotFound();
                }

            } else {
                Factory::make(Error::class)->fileNotFound();
            }

        } else {
            echo 'Welcome Page';
        }
    }

}