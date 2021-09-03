<?php

namespace public_html\application\models;

use public_html\application\core\Model;
use Imagick;

class Admin extends Model {

    public $error;

    public function loginValidate($post)
    {
        $config = require 'public_html/application/config/admin.php';
        if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
            $this->error = 'Логин или пароль указан неверно';
            return false;
        }
        return true;

    }

    public function postValidate($post, $type)
    {
        $nameLen = iconv_strlen($post['name']);
        $descriptionLen = iconv_strlen($post['description']);
        $textLen = iconv_strlen($post['text']);

        if($nameLen < 3 or $nameLen > 100) {
            $this->error = 'Название должно содержать от 3 до 100 символов';
            return false;
        }
        elseif($descriptionLen < 3 or $descriptionLen > 100) {
            $this->error = 'Описание должно содержать от 3 до 100 символов';
            return false;
        }
        elseif ($textLen < 10 or $textLen > 5000) {
            $this->error = 'Текст должно содержать от 10 до 5000 символов';
            return false;
        }


        if (empty($_FILES['img']['tmp_name']) and $type == 'add') {
            $this->error = 'Изображение не выбрано';
            return false;
        }

        return true;
    }


    public function postUploadImage($path, $id)
    {

        $img = new Imagick($path);
        $img->cropThumbnailImage(1080, 600);
        $img->setImageCompressionQuality(80);
        $dir =  str_replace ('\application\models', '\public\materials\\'.$id.'.jpg' , __DIR__ );

        $img->writeImage($dir);
    }

    public function postDelete($id)
    {
        $params = [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM posts WHERE id = :id', $params);
        unlink('public/materials/'.$id.'.jpg');
    }

    public function isPostExists($id)
    {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
    }

    public function postData($id)
    {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT * FROM posts WHERE id = :id', $params);
    }

    public function postAdd($post, $table)
    {
        $params = [];
        $dataPost = $_POST;
        foreach ($dataPost as $key => $data) {
            $params[$key] = $data;
        }

        return $this->db->insert($table, $params);
    }

    public function postEdit($post, $id)
    {
        $params = [
            'id' => $id,
            'name' => $post['name'],
            'description' => $post['description'],
            'text' => $post['text'],
        ];

        $this->db->query('UPDATE posts SET name = :name, description = :description, text = :text WHERE id = :id', $params);
    }
}