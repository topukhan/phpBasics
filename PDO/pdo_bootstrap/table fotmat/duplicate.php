<?php
session_start();
include_once('./dbconfig.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "select * from players where id = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    $name = $record['name'];

    $insertQuery = "insert into players (name) values(:name)";
    $stmt = $connection->prepare($insertQuery);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    $_SESSION['message'] = "Player Duplicated Successfully";
    header("location:index.php");
}