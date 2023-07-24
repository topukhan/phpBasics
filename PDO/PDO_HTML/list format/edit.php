<?php
include_once('dbconnect.php');

$errors = []; // Initialize an empty array to store validation errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted name value
    $name = htmlspecialchars($_POST['name']);

    // Validate the name field
    if (empty($name)) {
        $errors[] = "Name is required.";
    } elseif (strlen($name) < 10) {
        $errors[] = "Name should be at least 10 characters long.";
    } elseif (strlen($name) > 40) {
        $errors[] = "Name should not exceed 40 characters.";
    }

}
//first, Show Existing Data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM players WHERE id = $id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $player = $stmt->fetch(PDO::FETCH_ASSOC);
}
//Update data
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $player_name = htmlspecialchars($_POST['name']);

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
    <div>
        <ul>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <li>
                    <span>Name</span><span>
                        <input type="text" name="name" value="<?php echo $player['name'] ?>"></span>
                    <input type="hidden" name="id" value="<?php echo $player['id'] ?>">
                    <button type="submit" name="submit">Update</button>
                    <button><a href="index.php">cancel</a></button><br>
                    <span style="color:red;">
                    <?php if (!empty($errors)) {
                            foreach ($errors as $error) {
                                echo $error . "<br>";
                            }
                        } ?>
                    </span>
                </li>
            </form>
        </ul>
    </div>

</body>

</html>
