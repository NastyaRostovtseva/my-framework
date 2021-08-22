<?php

require 'public_html/application/lib/Dev.php';

use public_html\application\core\Router;

// автозагрузка классов
spl_autoload_register(function($class)
{
    $path = str_replace('\\', '/', $class.'.php');

    if (file_exists($path))
    {
        require $path;
    }
});

session_start();

$router = new Router;
$router->run();
