<?php
include_once('./dbconnect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM url WHERE id = $id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    header('location:index.php');
}
