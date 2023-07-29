<?php
// db connection
include('dbconfig.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM players WHERE id = :id";
    $stmt = $connection->prepare($query);
    $data = [':id' => $id];
    $stmt->execute($data);
    $player = $stmt->fetch(PDO::FETCH_OBJ);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3>Player Details</h3>
        </div>
        <div class="card-body">
            <div class="card p-3" style="width: 500px;">
                <div class="card-body">
                    <div class="d-flex">
                        <label class="me-2 align-self-center font-weight-bold" for="Name"><strong>Name:</strong></label>
                        <span><?= $player->name; ?></span>
                    </div>
                </div>
            </div>
            <a href="index.php" class="btn btn-success mt-2">List</a>
        </div>
    </div>
</body>

</html>
