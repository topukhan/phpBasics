<?php
// db connection
include('dbconfig.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];

    // Validate url field
    if (empty($url)) {
        echo "url field cannot be empty.";
    } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
        echo "Invalid url address.";
    } else {
        $sanitized_url = filter_var($url, FILTER_SANITIZE_URL);
        $stmt = $connection->prepare("INSERT INTO url (url) VALUES (:url)");
        $data = [':url' => $sanitized_url];

        try {
            $stmt->execute($data);
            echo "URL added successfully.";
        } catch (PDOException $e) {
            echo "Error in adding: " . $e->getMessage();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card {
            box-shadow: 10px 16px 36px 4px rgba(123, 120, 120, 0.75) !important;
            -webkit-box-shadow: 10px 16px 36px 4px rgba(123, 120, 120, 0.75) !important;
            -moz-box-shadow: 10px 16px 36px 4px rgba(123, 120, 120, 0.75) !important;
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
        a{
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
            <h3>URL List Create</h3>
        </div>
        <div class="card-body">
            <div class="card p-3" style="width: 500px;   ">
                <div class="card-body">
                    <form method="POST" action="create.php">
                    <div style="display: flex;">
                        <label style="margin-right: 10px; align-self: center; font-weight: bold; "
                            for="url">Name:</label>
                            <input class="form-control" name="url" type="url" placeholder="Enter URL">  
                             <button class="btn"  style=" background-color: black; color: white; margin-left: 10px;" type="submit">Create</button>

                            </div>
                            <button class="btn"  style=" background-color: black; color: white; margin-left: 10px;" ><a href="index.php"  type='button'>List</a></button>

                        </form>
                    

                </div>

              

            </div>

        </div>
    </div>
    

    
</body>
</html>