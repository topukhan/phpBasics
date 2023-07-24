<?php

namespace Player\Crud;

use PDO;
use PDOException;

class Helper
{
    public $pdo;
    public $user = "root";
    public $password = "";

    public function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=crud", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
        }
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}
