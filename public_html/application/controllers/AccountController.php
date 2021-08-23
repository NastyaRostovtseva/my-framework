<?php

namespace public_html\application\controllers;

use public_html\application\core\Controller;

class AccountController extends Controller
{
    public function  loginAction()
    {
        if (!empty($_POST))
        {
            $this->view->location('SDDSDD');
        }
        $this->view->render('Вход');
    }

    public function registerAction()
    {
        $this->view->render('Регистрация');
    }
}