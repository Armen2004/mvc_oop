<?php namespace Core\traits;

use PDO;

trait Query
{
    public function getTable()
    {
        return strtolower(str_replace('App\\Models\\', '', get_called_class()));
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->getTable()}";
        $result = $this->db->prepare($sql);

        $result->execute();

        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($value)
    {
        $sql = "INSERT INTO {$this->getTable()} ('image_name', 'image_path') VALUES (?, ?)";
        $result = $this->db->prepare($sql);
        $result->execute([$value['image_name'], $value['image_path']]);
        return $result;
    }


}