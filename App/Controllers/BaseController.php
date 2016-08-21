<?php namespace App\Controllers;

use Core\Controller;

abstract class BaseController extends Controller
{
    /**
     * @return mixed
     */
    public abstract function index();
}