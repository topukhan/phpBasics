<?php
include_once('../list format/dbconnect.php');
//Show data From database table
if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM players WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $player = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Show</h2>
    <label for="Name">Name:</label>
    <input id="Name" type="text" value="<?= $player['name']?>" disabled>
    <button><a href="index.php">back</a></button>
</body>
</html>