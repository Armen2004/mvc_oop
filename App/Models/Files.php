<?php namespace App\Models;

use Core\Model;

class Files extends Model
{

    public function insertData($data)
    {
        return $this->createFile($data);
    }

    public function getAll(){
        return $this->read();
    }

}