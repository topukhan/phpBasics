<?php
include('./vendor/autoload.php');

use player\PlayerCRUD;

$player = new PlayerCRUD;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $player->delete($id);
}

?>