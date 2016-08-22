<?php namespace Core\traits;

trait Crud
{

    use Query;

    public $class;

    public function createStyle($data)
    {
        return $this->insertStyle($data);
    }

    public function createFile($data)
    {
        return $this->insertFile($data);
    }

    public function read()
    {
        return $this->all();
    }

    public function update()
    {

    }

    public function delete()
    {

    }

}