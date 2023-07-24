
<?php
include('../vendor/autoload.php');
use player\Grid\Grid;

$player = new Grid();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $player->delete($id);
}

?>
