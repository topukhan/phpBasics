<?php
include('../vendor/autoload.php');
use player\Grid\Grid;

$player = new Grid;
$output = $player->index();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0 !important;
        }

        h1 {
            background-color: #198754;
            color: white;
            margin: 0 !important;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px;
            text-align: center;
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

        .btn-outline-success:hover {
            color: #fff;
            background-color: #198754;
            border-color: #198754;
        }

        nav {
            margin-top: 20px;
            display: flex;
        }

        .btn-success {
            color: #fff;
            background-color: #198754;
            border-color: #198754;
        }

        button {
            text-transform: capitalize;
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

        .btn-outline-success {
            color: #198754;
            border-color: #198754;
        }

        .form-control:focus {
            color: #212529;
            background-color: #fff;
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25);
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

        .main-div {
            padding: 30px;


        }

        .table-responsive {
            display: block;

            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;

            color: #333;
        }

        .card {
            margin-bottom: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
            border-width: 0;

            margin-top: 15px;
        }

        table thead th {
            vertical-align: middle;
            border-bottom: 1px solid #b7b7b7;
            color: white;
        }

        table th,
        td {
            padding: 0.75rem 1.25rem;
            border: 1px solid #b7b7b7;
            border-collapse: collapse;
            font-weight: 500;
        }

        th {
            text-align: left;
        }

        .pagination {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            display: flex;
            padding-left: 0;
            list-style: none;
        }

        .page-item:first-child .page-link {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }

        .page-link {
            padding: 0.375rem 0.75rem;
        }

        .page-link {
            position: relative;
            display: block;
            color: #198754;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #dee2e6;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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
            font-size: 30px;
            margin-top: 40px;

        }
    </style>

</head>

<body>
    <div>
        <h1>Player list</h1>
        <div style="display: flex; justify-content: center;">
            <a href="create.php"><button class="create" style="background-color: black ; color: white;">+</button></a>
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
            <div class="table-responsive card">
                <table class="table table-bordered">

                    <thead style="background-color: #198754;">
                        <tr>
                            <td>

                            </td>

                            <td>
                                <form method="GET" action="index.php">
                                    <div style="display: flex;">
                                        <input class="form-control" name="search" type="search" placeholder="Search"
                                            aria-label="Search">
                                        <!-- <p style="color: white; margin-left: 10px; ">&#8661;</p> -->
                                        <button class="btn btn-outline-success" type="submit">Search</button>
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
                                    <td><input type="checkbox"></td>
                                    <td>
                                        <?= $row->name; ?>
                                    </td>
                                    <td>
                                        <button style="color: #198754;  background-color: #198754;" class="btn"><a
                                                href="show.php?id=<?= $row->id ?>" type="button">Show</a></button>
                                        <button class="btn" style="background-color: orange;"><a
                                                href="edit.php?id=<?= $row->id ?>">Edit</a></button>
                                        <button class="btn " style="background-color: red; color: white;"><a
                                                href="delete.php?id=<?= $row->id ?>">Delete</a></button>
                                        <button class="btn" style="background-color: #86b7fe; color: white;">Share</button>

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
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>

                <div style="margin-left: auto; margin-top: 20px;">
                    <button style="color: #198754;
                                background-color: rgb(121, 35, 3);" class="btn"><a href="show.html"
                            type="button">PDF</a></button> <button class="btn" style="background-color: orange;"><a
                            href="edit.html">Edit</a></button>
                    <button class="btn " style="background-color: rgb(0, 130, 39); color: white;">Excel</button>
                    <button class="btn" style="background-color: #003af9; color: white;">Email</button>
                    <button class="btn" style="background-color: rgb(0, 179, 255); color: white;"><a
                            href="create.html">MS Word</a></button>
                    <button class="btn" style="background-color: rgb(255, 98, 0); color: white;"><a
                            href="create.html">History</a></button>


                </div>


            </div>
        </div>

    </div>



</body>

</html>