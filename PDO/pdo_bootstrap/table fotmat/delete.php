<?php
include_once('dbconfig.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM playerinfo WHERE id = $id";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    header('location:index.php');
}
?>