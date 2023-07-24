<?php
include_once('dbconnect.php');
//first, Show Existing Data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM players WHERE id = $id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $player = $stmt->fetch(PDO::FETCH_ASSOC);
}
//Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $player_name = $_POST['name'];

    $query = "UPDATE players SET name = :new_name WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':new_name', $player_name);
    $stmt->execute();
    header("Location: index.php");
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
        <div style="display: flex;">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display: inline-flex;">
                <label style="margin-right: 10px; align-self: center; font-weight: bold;" for="Name">Name</label>
                <input type="hidden" name="id" value="<?php echo $player['id'] ?>">
                <input class="form-control" type="text" name="name" value="<?php echo $player['name'] ?>">
                <button class="btn" style="background-color: orange; color: white; margin-left: 10px;" name="update" type="submit">Update</button>
                <button class="btn" style="background-color: black; color: white; margin-left: 5px;"><a href="index.php">Back</a></button>
            </form>
        </div>


    </div>


</body>

</html>