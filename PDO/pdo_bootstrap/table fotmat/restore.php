<?php
session_start();
include_once('./dbconfig.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "select * from players where id = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($record) {
        $query = "update players set is_deleted = FALSE where id = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $_SESSION['message'] = 'Player Restored';
        header("Location: trashList.php");
    }
}
