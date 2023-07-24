<?php
include_once('./dbconnect.php');
//first, Show Existing Data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM url WHERE id = $id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $player = $stmt->fetch(PDO::FETCH_ASSOC);
}
//Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $player_url = $_POST['url'];

    $query = "UPDATE url SET url = :new_url WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':new_url', $player_url);
    $stmt->execute();
    header("Location: index.php");
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
    <h2>Filter Input</h2>
    <form action="#" method="post">
        <label for="url">URL:</label>
        <input id="url" name="url" type="text" value="<?php echo $player['url'] ?>">
        <input type="hidden" name="id" value="<?php echo $player['id'] ?>">
        <button type="submit" name="update">Update</button>
        <button><a href="index.php">cancel</a></button>
    </form>
</body>

</html>