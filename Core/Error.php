<?php namespace Core;

use Core\interfaces\ErrorInterface;

class Error implements ErrorInterface
{

    /**
     * @return mixed
     */
    public function fileNotFound()
    {
        exit("ERROR! File Not Found");
    }

    /**
     * @return mixed
     */
    public function pageNotFound()
    {
        exit("ERROR! Page Not Found");
    }

    /**
     * @return mixed
     */
    public function modelNotFound()
    {
        exit("ERROR! Model Not Found");
    }

    /**
     * @return mixed
     */
    public function methodNotAllowed()
    {
        exit("ERROR! Method Not Allowed");
    }

    /**
     * @return mixed
     */
    public function methodNotFound()
    {
        exit("ERROR! Method Not Found");
    }
}