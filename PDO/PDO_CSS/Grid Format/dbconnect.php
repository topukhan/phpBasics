<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'crud';
    try{
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "connected successfully";
    }
    catch(PDOException $e){
        echo "Connection Failed". $e->getMessage();
    }
?>