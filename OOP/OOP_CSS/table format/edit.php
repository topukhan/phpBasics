<?php
include('../vendor/autoload.php');
use player\Grid\Grid;

$player = new Grid;
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
    </style>

</head>

<body>
    <div class="card" style="width: 500px; padding: 30px;">
        <form method="POST" action="#">
            <div style="display: flex;">
                <label style="margin-right: 10px; align-self: center; font-weight: bold;" for="Name">Name:</label>
                <input type="hidden" name="id" value="<?= $playerData->id; ?>">
                <input class="form-control" type="text" name="playername" value="<?= $playerData->name; ?>">
                <button class="btn" name="editinfo" type="submit"
                    style="background-color: orange;margin-left: 10px;">Edit</button>
            </div>
        </form>
    </div>


</body>

</html>