<?php namespace Core;

use Core\interfaces\ViewInterface;

class View implements ViewInterface
{

    /**
     * @return mixed
     */
    public function render()
    {
        // TODO: Implement render() method.
    }

    /**
     * @param $view
     * @param array $params
     * @param bool $layout
     * @return mixed
     */
    public function template($view, array $params = [], $layout = true)
    {
        extract($params);

        ob_start();

        $templateView = ob_get_clean();

        if ($layout) {
            require_once APP.'Views/layouts/header.php';
            require_once APP . 'Views/' . $view . EXT;
            require_once APP.'Views/layouts/footer.php';
        } else {
            require_once APP . 'Views/' . $view . EXT;
        }

        return $templateView;
    }
}