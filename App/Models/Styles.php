<?php namespace App\Models;

use Core\Model;

class Styles extends Model
{

    public function insertData($data)
    {
        return $this->createStyle($data);
    }

    public function getAll()
    {
        return $this->read();
    }


}