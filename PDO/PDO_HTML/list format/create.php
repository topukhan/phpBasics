<?php
include_once('dbconnect.php');
// Store data into table 
$errors = []; // Initialize an empty array to store validation errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted name value
    $name = $_POST['name'];

    // Validate the name field
    if (empty($name)) {
        $errors[] = "Name is required.";
    } elseif (strlen($name) < 10) {
        $errors[] = "Name should be at least 10 characters long.";
    } elseif (strlen($name) > 40) {
        $errors[] = "Name should not exceed 40 characters.";
    }


}



if (isset($_REQUEST["submit"]) && empty($errors)) {
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
    <h2>CREATE</h2>
    <div>
        <ul>
            <li>
                <span>Name: </span>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="text" name="name" placeholder="John Doe">
                    <button type="submit" name="submit">create</button>
                    <button><a href="index.php">back</a></button><br>
                    <span style="color:red;">
                        <?php if (!empty($errors)) {
                            foreach ($errors as $error) {
                                echo $error . "<br>";
                            }
                        } ?>
                    </span>
                </form>
            </li>
        </ul>
    </div>

</body>

</html>