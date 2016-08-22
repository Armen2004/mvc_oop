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

    public function insertFile($value)
    {
        $sql = "INSERT INTO {$this->getTable()} ('image_name', 'image_path', 'image_style') VALUES (?, ?, ?)";
        $result = $this->db->prepare($sql);
        $result->execute([$value['image_name'], $value['image_path'], $value['image_style']]);
        return $result;
    }

    public function insertStyle($value)
    {
        $sql = "INSERT INTO {$this->getTable()} ('style_name', 'style_text') VALUES (?, ?)";
        $result = $this->db->prepare($sql);
        $result->execute([$value['style_name'], $value['style_text']]);
        return $result;
    }


}