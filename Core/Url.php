<?php namespace Core;

class Url
{
    /**
     * @var string $cleanUrl
     */
    private $cleanUrl;

    public function __construct()
    {
        if (strpos($_SERVER['REQUEST_URI'], 'index.php')) {
            $this->cleanUrl = explode('/', filter_var(explode('?', $_SERVER['REQUEST_URI'])[1], FILTER_SANITIZE_URL));
        } else {
            $this->cleanUrl = filter_var(str_replace(explode('/', trim($_SERVER['PHP_SELF'], '/'))[0] . "/", '', ltrim($_SERVER['REQUEST_URI'], '/')), FILTER_SANITIZE_URL);
        }
    }

    /**
     * @return string
     */
    public function get()
    {
        if ($this->cleanUrl)
            return $this->cleanUrl;
        return '/';
    }
}