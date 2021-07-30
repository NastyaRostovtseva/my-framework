<?php

namespace public_html\application\controllers;

use public_html\application\core\Controller;
use public_html\application\lib\Db;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->view->render('Главная страница');
    }

}