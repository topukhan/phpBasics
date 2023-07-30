<?php
// db connection
include('dbconfig.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $stmt = $connection->prepare("INSERT INTO players (name) VALUES (:name)");
    $data = [':name' => $name];

    try {
        $stmt->execute($data);
        session_start();
        $_SESSION['message'] = 'Player Created Successfully.';
    } catch (PDOException $e) {
        session_start();
        $_SESSION['message'] = $e->getMessage();
    }
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
</head>

<body>
    <div class="card">
        <div class="card-
         bg-success text-white">
            <h3>Player List Create</h3>
        </div>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
            echo $_SESSION['message'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <div class="card-body">
            <div class="card p-3" style="width: 500px;">
                <div class="card-body">
                    <form method="POST" action="create.php">
                        <div class="d-flex">
                            <label class="me-2 align-self-center font-weight-bold" for="Name">Name:</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Name" required>
                            <button class="btn btn-dark ms-2" type="submit">Create</button>
                            <a href="index.php" class="btn btn-success ms-2">List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>