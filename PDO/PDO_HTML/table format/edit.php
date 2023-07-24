<?php
include_once('../list format/dbconnect.php');
//first, Show Existing Data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM players WHERE id = $id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $player = $stmt->fetch(PDO::FETCH_ASSOC);
}
//Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $player_name = $_POST['name'];

    $query = "UPDATE players SET name = :new_name WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':new_name', $player_name);
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
    <h2>Edit</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="name">Name:</label>
        <input id="name" name="name" type="text" value="<?php echo $player['name']?>">
        <input type="hidden" name="id" value="<?php echo $player['id']?>">
        <button type="submit" name="update">Update</button>
        <button><a href="index.php">cancel</a></button>
    </form>
</body>

</html>