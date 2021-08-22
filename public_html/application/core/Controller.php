<?php

namespace public_html\application\core;

use public_html\application\core\View;

abstract class Controller
{
    public $route;
    public $view;
    private $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);

    }

    public function loadModel($name)
    {
        $path = 'public_html/application/models/'.ucfirst($name);
        if(class_exists($path))
        {
            return new $path;
        }

    }

}