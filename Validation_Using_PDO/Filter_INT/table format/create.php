<?php
include_once('./dbconnect.php');
// Store data into table 
if (isset($_REQUEST["submit"])) {
    $age = $_REQUEST['age'];
    if (filter_var($age, FILTER_VALIDATE_INT)) {
        $query = "INSERT INTO players_age(age) VALUES(:age)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':age', $age);
        $stmt->execute();
        header('location:index.php');
    } else {
        $error = "invalid INT type";
        echo $error;
    }
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
        <label for="Age">Age:</label>
        <input id="Age" name="age" type="text" placeholder="eg.23">
        <button type="submit" name="submit">Create</button>
        <button><a href="index.php">back</a></button>
    </form>
</body>

</html>