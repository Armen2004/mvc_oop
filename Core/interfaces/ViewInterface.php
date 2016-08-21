<?php namespace Core\interfaces;


interface ViewInterface
{

    /**
     * @return mixed
     */
    public function render();

    /**
     * @param $view
     * @param array $params
     * @param bool $layout
     * @return mixed
     */
    public function template($view, array $params = [], $layout = true);

}