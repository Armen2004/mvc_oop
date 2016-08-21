<?php namespace Core;

use Core\interfaces\ControllerInterface;

class Controller implements ControllerInterface
{
    public $view;

    public function __construct()
    {
        $this->view = Factory::make(View::class);
    }

}