
<?php
include('../vendor/autoload.php');
use Player\Crud\Crud;

$player = new Crud();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $player->delete($id);
}

?>
