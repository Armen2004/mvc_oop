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

    protected function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
        return
            ($https ? 'https://' : 'http://').
            (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
                ($https && $_SERVER['SERVER_PORT'] === 443 ||
                $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
            substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }
}