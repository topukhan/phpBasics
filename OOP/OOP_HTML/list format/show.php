<?php
include('./vendor/autoload.php');

use player\PlayerCRUD;

$player = new PlayerCRUD;
if (isset($_GET['id'])) {
    $playerData = $player->show($_GET['id']); // Assign the returned player data to $playerData variable
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
    <div>
        <ul>
            <li>
                <span>Name: </span><span><input type="text" value="<?= $playerData->name; ?>" disabled></span>
                <button><a href="index.php">back</a></button>
            </li>

        </ul>
    </div>

</body>

</html>