<?php

namespace public_html\application\lib;

use PDO;

class Db
{
    protected $db;

    public function __construct()
    {
        $config = require 'public_html/application/config/db.php';
         $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);

        if(!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':'.$key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    public function lastInsertId()
    {
         return $this->db->lastInsertId();
    }

    public function insert($table, array $params= []): string
    {
        // $params - ассоциативный массив, в ключе у нас столбец бд, а в значении передаваемый параметр
        $colums = sprintf('(%s)', implode(',', array_keys($params)));
        $masks = sprintf('(:%s)', implode(', :', array_keys($params)));

        $sql = sprintf('INSERT INTO %s %s VALUES %s', $table, $colums, $masks);

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $this->db->LastInsertId();
    }
}