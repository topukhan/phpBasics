<?php
session_start();
include_once('dbconfig.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM players WHERE id = $id";
    $stmt = $connection->prepare($query);
    $stmt->execute(); 
    $_SESSION['message'] = 'Player Deleted Successfully.';
    header('location:index.php');
}
?>