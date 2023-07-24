<?php
include_once('dbconfig.php');
//display previous data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM playerinfo WHERE id = $id";
    $stmt = $connection->prepare($query);
    $stmt->execute();

    $player = $stmt->fetch(PDO::FETCH_OBJ);
}
//Updating data
if (isset($_POST['editinfo'])) {
    $id = $_POST['id'];
    $playername = $_POST['name'];

    $query = "UPDATE playerinfo SET name = :p_name WHERE id = :id";
    $stmt = $connection->prepare($query);
    $data = [
        ':id' => $id,
        ':p_name' => $playername,
    ];
    $stmt->execute($data);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card {
            margin-bottom: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
            border-width: 0;

            margin-top: 15px;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        a {
            color: white;
            text-decoration: none;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .card-header {
            padding: 0.5rem 1rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            background-color: #198754;
            color: white;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1rem 1rem;
        }
    </style>

</head>

<body>

    <div class="card">
        <div class="card-header">
            <h3>Player List Edit</h3>
        </div>
        <div class="card-body">
            <div class="card p-3" style="width: 500px;   ">
                <div class="card-body">
                    <div style="display: flex;">
                        <form method="POST" action="#" style="display: flex;">

                            <label style="margin-right: 10px; align-self: center; font-weight: bold; " for="Name">Name:</label>
                            <input type="hidden" name="id" value="<?= $player->id; ?>">
                            <input class="form-control" type="text" name="name" value="<?= $player->name; ?>">
                            <button class="btn" name="editinfo" type="submit" style="background-color: orange;margin-left: 10px; ">Edit</button>
                            <button style='color: #198754; background-color: #198754;' class='btn ms-2'><a href="index.php" type='button'>List</a></button>
                    </div>

                </div>



            </div>

        </div>
    </div>



</body>

</html>