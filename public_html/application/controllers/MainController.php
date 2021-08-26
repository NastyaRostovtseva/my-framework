<?php

namespace public_html\application\controllers;

use public_html\application\core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->view->render('Главная страница');
    }
    public function aboutAction()
    {
        $this->view->render('Обо мне');
    }
    public function contactAction()
    {
        if (!empty($_POST)){
            $this->view->message('success', 'форма работает');
        }
        $this->view->render('Контакты');
    }
    public function postAction()
    {
        $this->view->render('Пост');
    }

}