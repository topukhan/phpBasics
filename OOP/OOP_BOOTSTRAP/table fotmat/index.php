<?php
include('../vendor/autoload.php');
use player\Grid\Grid;

$player = new Grid;
$output = $player->index(); // Assign the returned value to $output variable
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
    <div style="display: flex; justify-content: center;">
        <a href="create.php"><button class="create" style="background-color: black ; color: white;"><i class="fa-solid fa-plus"></i></button></a>
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
                                    <form method="GET" action="index.php">
                                        <div style="display: flex;">

                                        <input class="form-control " type="search" placeholder="Search" name="search" aria-label="Search">
                                            <div class="btn-group">
                                            <button class="btn btn-outline-success" type="submit">Search</button>

                                            <!-- <button type="submit" style="font-size: 20px;" class="btn btn-sm btn-warning text-white ms-2 ps-3  pe-3 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">

                                                  <span class="visually-hidden">Toggle Dropdown</span>
                                                </button> -->
                                                
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
                                            <button style='color: #198754; background-color: #198754;' class='btn rounded-circle'><a href="show.php?id=<?= $row->id ?>"  type='button'><i class='fa-solid fa-eye'></i></a></button>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>