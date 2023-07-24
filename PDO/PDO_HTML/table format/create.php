<?php
include_once('../list format/dbconnect.php');
// Store data into table 
if (isset($_REQUEST["submit"])) {
    $name = $_REQUEST['name'];
    $query = "INSERT INTO players(name) VALUES(:name)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    echo "user added";
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
    <h2>
        Create
    </h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="Name">Name:</label>
        <input id="Name" name="name" type="text" placeholder="John Doe">
        <button type="submit" name="submit">Create</button>
        <button><a href="index.php">back</a></button>
    </form>
</body>

</html>