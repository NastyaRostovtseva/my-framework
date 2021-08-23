<?php

namespace public_html\application\controllers;

use public_html\application\core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $result = $this->model->getNews();
        $vars = [
            'news' => $result,
        ];
        $this->view->render('Главная страница', $vars);
    }

}