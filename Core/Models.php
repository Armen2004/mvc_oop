<?php namespace Core;

class Models extends Database
{
    public $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

}