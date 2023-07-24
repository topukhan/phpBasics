<?php
include_once('./vendor/autoload.php');
use player\Helper;
use player\PlayerCRUD;

// db connect;
$connect = new Helper;
$connect->connect();

$store = new PlayerCRUD;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $result = $store->store($name);

    if (is_array($result)) {
        foreach ($result as $error) {
            echo $error . "<br>";
        }
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
    <h2>CREATE</h2>
    <div>
        <ul>
            <li>
                <span>Name: </span>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="text" name="name" placeholder="John Doe">
                    <button type="submit" name="submit">create</button>
                    <button><a href="index.php">back</a></button>
                    <br>
                    
                </form>
            </li>
        </ul>
        

    </div>

</body>

</html>