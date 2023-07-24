<?php
// db connection
include('dbconfig.php');

$sort_column = 'name';
$sort_order = 'ASC';

if (isset($_GET['sort'])) {
    if ($_GET['sort'] === 'asc') {
        $sort_order = 'ASC';
    } elseif ($_GET['sort'] === 'desc') {
        $sort_order = 'DESC';
    }
}
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $stmt = $connection->prepare("SELECT * FROM playerinfo WHERE name LIKE :search");
    $stmt->bindValue(':search', '%' . $search . '%');
} else {
    $stmt = $connection->prepare("SELECT * FROM playerinfo ORDER BY $sort_column $sort_order");
}
$stmt->execute();
$output = $stmt->fetchAll(PDO::FETCH_OBJ);

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
<style>
    nav {
        margin-top: 20px;
        display: flex;
    }

    .main-div {
        padding: 30px;
    }

    .search {
        display: flex;
    }

    .search input {
        margin-right: 3px;
    }

    nav:nth-child(1) button {
        margin-left: 3px;

    }

    th {
        color: white;
    }

    a {
        color: white;
        text-decoration: none;
    }

    .create {
        height: 40px;
        width: 40px;
        background-color: black;
        margin-left: auto;
        margin-right: auto;
        border-radius: 100%;
        color: white;
        font-size: 20px;
        margin-top: 40px;
    }
</style>

<body>
    <div>
        <h1 class="text-center bg-success text-white p-2">Player List</h1>
    </div>

    <div class="main-div">
        <!-- <header>
            <nav>
                <div class="search">
                    <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
                <div>
                    <button class="btn btn-success">Filter</button>
                </div>
            </nav>
        </header> -->
        <div class="card mt-4">
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table table-bordered">
                        <thead style="background-color: #198754;">
                            <tr>
                                <td>

                                </td>

                                <td>
                                    <form method="GET" action="#" style="display: inline;">
                                        <div style="display: flex;">

                                            <input class="form-control " type="search" placeholder="Search" name="search" aria-label="Search">
                                            <div class="btn-group ml-4">
                                                <button class="btn btn-dark mx-1" type="submit">Search</button>
                                                <button class="btn btn-primary text-white"><a href="./index.php">Reset</a></button>
                                            </div>
                                            <div class="btn-group ms-1">
                                                <button type="submit" name="sort" value="asc" class="btn btn-success btn-outline-light"><i class="fa-solid fa-arrow-down-a-z"></i></button>
                                                <button type="submit" name="sort" value="desc" class="btn btn-success btn-outline-light"><i class="fa-solid fa-arrow-down-z-a"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td></td>

                            </tr>
                            <tr>
                                <th style="width: 0%;"><input type="checkbox"></th>
                                <th>Name</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $stmt = $connection->prepare("SELECT * FROM playerinfo");
                            // $stmt->execute();
                            // $output = $stmt->fetchAll(PDO::FETCH_OBJ);

                            if ($output) {
                                foreach ($output as $row) {
                            ?>
                                    <tr>
                                        <td><input type='checkbox'></td>
                                        <td><?= $row->name; ?></td>
                                        <td>
                                            <button style='color: #198754; background-color: #198754;' class='btn rounded-circle'><a href="show.php?id=<?= $row->id ?>" type='button'><i class='fa-solid fa-eye'></i></a></button>
                                            <button class='btn btn rounded-circle' style='background-color: orange;'><a href="edit.php?id=<?= $row->id ?>"><i class='fa-solid fa-pen-to-square'></i></a></button>
                                            <button class='btn rounded-circle' style='background-color: red; color: white;'><a href="delete.php?id=<?= $row->id ?>"><i class='fa-solid fa-trash'></i></a></button>
                                            <button class='btn rounded-circle' style='background-color: #86b7fe; color: white;'><i class='fa-solid fa-share'></i></button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="3">No Record Found</td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>


                    </table>
                </div>
                <div style="display: flex; justify-content: center;">
                    <a href="create.php"><button class="create" style="background-color: black ; color: white;"><i class="fa-solid fa-plus"></i></button></a>
                </div>


                <div style="display: flex;">
                    <div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                    </div>

                    <div style="margin-left: auto; margin-top: 20px;">
                        <button style="color: #198754;
                                    background-color: rgb(121, 35, 3);" class="btn rounded-circle"><a href="show.html" type="button"><i class="fa-solid fa-file-pdf"></i></a></button>
                        <button class="btn  rounded-circle" style="background-color: rgb(0, 130, 39); color: white;"><i class="fa-solid fa-file-excel"></i></button>
                        <button class="btn rounded-circle" style="background-color: #003af9; color: white;"><i class="fa-solid fa-envelope"></i></button>
                        <button class="btn rounded-circle" style="background-color: rgb(0, 179, 255); color: white;"><a href="create.html"><i class="fa-solid fa-file-word"></i></a></button>
                        <button class="btn rounded-circle" style="background-color: rgb(255, 98, 0); color: white;"><a href="create.html"><i class="fa-solid fa-clock-rotate-left"></i></a></button>


                    </div>


                </div>


            </div>
        </div>

    </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>