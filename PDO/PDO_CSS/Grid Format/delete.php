<?php
include_once('dbconnect.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM players WHERE id = $id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    header('location:index.php');
}
?>