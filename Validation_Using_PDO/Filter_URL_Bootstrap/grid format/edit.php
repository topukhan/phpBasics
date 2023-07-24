<?php
include_once('dbconfig.php');

// Display previous data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM url WHERE id = $id";
    $stmt = $connection->prepare($query);
    $stmt->execute();

    $valid_url = $stmt->fetch(PDO::FETCH_OBJ);
}

// Updating data
if (isset($_POST['editinfo'])) {
    $id = $_POST['id'];
    $url = $_POST['url'];

    // Validate url field
    if (empty($url)) {
        echo "URL field cannot be empty.";
    } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
        echo "Invalid url address.";
    } else {
        $query = "UPDATE url SET url = :url WHERE id = :id";
        $stmt = $connection->prepare($query);
        $data = [
            ':id' => $id,
            ':url' => $url,
        ];
        $stmt->execute($data);
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card {
            box-shadow: 10px 16px 36px 4px rgba(123, 120, 120, 0.75) !important;
            -webkit-box-shadow: 10px 16px 36px 4px rgba(123, 120, 120, 0.75) !important;
            -moz-box-shadow: 10px 16px 36px 4px rgba(123, 120, 120, 0.75) !important;
        }
       
        
        a{
            color: white;
            text-decoration: none;
        }
       
        .card-header {
           
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            background-color: #198754;
            color: white;
        }

       
    </style>
    
</head>
<body>

    <div class="card">
        <div class="card-header">
            <h3>URL List Edit</h3>
        </div>
        <div class="card-body">
            <div class="card p-3" style="width: 500px;   ">
                <div class="card-body">
                    <div style="display: flex;">
                    <form method="POST" action="#" style="display: flex;">

                    <label style="margin-right: 10px; align-self: center; font-weight: bold; " for="url">Name:</label>
                    <input type="hidden" name="id" value="<?= $valid_url->id; ?>">
                    <input class="form-control" type="url" name="url" value="<?= $valid_url->url; ?>">   
                    <button class="btn" name="editinfo" type="submit" style="background-color: orange;margin-left: 10px; ">Edit</button>
                    

                </div>
                <button class="btn"  style=" background-color: black; color: white; margin-left: 10px;" ><a href="index.php"  type='button'>Back</a></button>




            </div>

        </div>
    </div>
    
    
    
</body>
</html>