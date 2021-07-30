<?php

namespace public_html\application\controllers;

use public_html\application\core\Controller;
use public_html\application\lib\Db;

class MainController extends Controller
{
    public function indexAction()
    {   var_dump(12);die;
        $this->view->render('Главная страница');
    }

}