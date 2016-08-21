<?php namespace Core\traits;

trait Crud
{

    use Query;

    public $class;

    public function create($data)
    {
        return $this->insert($data);
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