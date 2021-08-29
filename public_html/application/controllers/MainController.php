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
            if (!$this->model->contactValidate($_POST))
            {
                $this->view->message('error', $this->model->error);
            }
            mail($_POST['email'], 'Сообщение из блога', $_POST['name'].'|'.$_POST['email'].'|'.$_POST['text']);
            $this->view->message('success', 'Сообщение отправлено администратору');
        }
        $this->view->render('Контакты');
    }
    public function postAction()
    {
        $this->view->render('Пост');
    }

}