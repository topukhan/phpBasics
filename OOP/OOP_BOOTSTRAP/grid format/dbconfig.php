<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = 'pdocrud';

try {
    $connection = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connection Succcessful";

} catch (PDOException $e) {
    echo "Connection Error!" . $e->getMessage();
}
