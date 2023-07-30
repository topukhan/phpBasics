<?php
session_start();
include_once('dbconfig.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the row's is_deleted column status
    $query_select = "SELECT is_deleted FROM players WHERE id = $id";
    $stmt_select = $connection->prepare($query_select);
    $stmt_select->execute();
    $result = $stmt_select->fetch(PDO::FETCH_ASSOC);

    // Default redirection URL
    $redirectUrl = 'index.php';

    if ($result && $result['is_deleted'] == 1) {
        $redirectUrl = 'trashList.php';
        $_SESSION['message'] = 'Player Deleted Successfully.';
    } else {
        $query = "DELETE FROM players WHERE id = $id";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $_SESSION['message'] = 'Player Deleted Successfully.';
    }

    header("location: $redirectUrl");
}
?>
