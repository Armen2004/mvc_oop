<?php namespace Core;

use Core\traits\Crud;

class Model extends Database
{
    use Crud;

    public $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

}