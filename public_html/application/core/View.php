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
        extract($vars);
        $path = 'public_html/application/views/'.$this->path.'.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'public_html/application/views/layouts/'.$this->layout.'.php';

        }
    }

     public function redirect($url)
     {
        header('location: /'.$url);
        exit;
     }

    public static function errorCode($code)
    {
        http_response_code($code);
        $path =  'public_html/application/views/errors/'.$code.'.php';
        if (file_exists($path)) {
           require $path;
        }
        exit;
    }

    public function message($status, $message)
    {
        exit(json_encode(['status' => $status, 'message' => $message],JSON_UNESCAPED_UNICODE));
    }

     public function location($url)
     {
         exit(json_encode(['url' => $url],JSON_UNESCAPED_SLASHES));
     }
}