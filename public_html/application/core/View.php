<?php

namespace public_html\application\core;

 class View
{
    public $layout = 'default';
    public $route;
    public $path;


    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $vars = [])
    {
        if (file_exists('public_html/application/views/'.$this->path.'.php'))
        {
            ob_start();
            require  'public_html/application/views/'.$this->path.'.php';
            $content = ob_get_clean();
            require 'public_html/application/views/layouts/'.$this->layout.'.php';
        } else
        {
            echo 'Вид не найден'.$this->path;
        }

    }

}