<?php namespace App\Controllers;

use Core\Factory;
use App\Models\Users;

class UserController extends BaseController
{
    public $data;

    public function index()
    {
        $users = Factory::make(Users::class)->getAll();
        echo "<pre>";
        print_r($users);
        die;
        $data = 'User/index';
        $this->view->template('welcome', compact('data'));
    }

    public function create()
    {
        $data = 'User/create';
        $this->view->template('welcome', compact('data'));
    }

}