<?php
include('./vendor/autoload.php');

use player\PlayerCRUD;

$player = new PlayerCRUD;

if (isset($_GET['id'])) {
    $playerData = $player->edit($_GET['id']);
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
            <form action="#" method="post">
                <li>
                    <span>Name</span>
                    <input type="text" name="playername" value="<?php echo $playerData->name; ?>">
                    <input type="hidden" name="id" value="<?php echo $playerData->id; ?>">
                    <button type="submit" name="update">Update</button>
                    <button><a href="index.php">cancel</a></button>
                </li>
            </form>

        </ul>
    </div>

</body>

</html>