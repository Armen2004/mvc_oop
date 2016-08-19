<?php namespace Core;

class Url
{
    /**
     * @var string $cleanUrl
     */
    private $cleanUrl;

    public function __construct()
    {
        $this->cleanUrl = ltrim(rtrim(str_replace("index.php","",strstr($_SERVER["PHP_SELF"],"index.php")),"/"),"/");
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->cleanUrl;
    }
}