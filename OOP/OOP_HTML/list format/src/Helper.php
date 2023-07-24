<?php

namespace player;

use PDO;
use PDOException;

class Helper
{
    public $pdo;

    public function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=crud", 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
        }
    }
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}
