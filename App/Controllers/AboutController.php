<?php namespace App\Controllers;

class AboutController extends BaseController
{

    public function index()
    {
        $data = "About";
        $this->view->template('welcome', compact('data'));
    }
}