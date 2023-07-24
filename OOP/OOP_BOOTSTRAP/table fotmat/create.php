
<?php
include('../vendor/autoload.php');
use player\Grid\Grid;


$player = new Grid;
if(isset($_POST['add'])) {
    $player->store($_POST);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h3>Player List Create</h3>
        </div>
        <div class="card-body">
            <div class="card p-3" style="width: 500px;   ">
                <div class="card-body">
                <form method="POST" action="create.php">
                    <div style="display: flex;">
                        <label style="margin-right: 10px; align-self: center; font-weight: bold;" for="Name">Name:</label>
                        <input class="form-control" type="text" name="name" placeholder="Enter Name">
                        <button class="btn" style="background-color: black; color: white; margin-left: 10px;" type="submit" value="add" name="add">Create</button>

                    </div>
                    <button style='color: #198754; background-color: #198754;' class='btn rounded-circle'><a href="index.php"  type='button'>List</a></button>

                </form>

                </div>



            </div>

        </div>
    </div>
    


    
</body>
</html>