<?php namespace App\Models;

use Core\Model;

class Users extends Model
{

    public function getAll()
    {
        return $this->read();
    }


}