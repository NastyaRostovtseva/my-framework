<?php

namespace public_html\application\core;

use public_html\application\core\View;

abstract class Controller
{
    public $route;
    public $view;
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);

    }

}