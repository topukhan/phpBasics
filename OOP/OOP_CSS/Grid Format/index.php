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
            margin: 0;
        }

        .stand {
            background-color: #198754;
            color: white;
            margin: 0 !important;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px;
            text-align: center;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #198754;
            border-radius: 0.25rem;
            margin: 10px;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1rem 1rem;
        }

        a {
            text-decoration: none;
            color: white;
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

        nav {
            margin-top: 20px;
            display: flex;
        }

        .pagination {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            display: flex;
            padding-left: 0;
            list-style: none;
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

        .page-link {
            padding: 0.375rem 0.75rem;
        }

        .main-div {
            margin: 60px;
        }

        nav {
            margin-top: 20px;
            display: flex;
        }

        .search {
            display: flex;
        }

        .search input {
            margin-right: 3px;
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

        nav:nth-child(1) button {
            margin-left: 3px;
        }

        .btn-outline-success {
            color: #198754;
            border-color: #198754;
        }

        .btn-success {
            color: #fff;
            background-color: #198754;
            border-color: #198754;
        }

        .btn-outline-success:hover {
            color: #fff;
            background-color: #198754;
            border-color: #198754;
        }
    </style>
    <div>
        <h1 class="stand">
            Player list

        </h1>



        <div class="main-div card" style="padding: 30px;">
            <nav>
                <form method="GET" action="index.php">
                    <div class="search">
                        <input class="form-control" name="search" type="search" placeholder="Search"
                            aria-label="Search">

                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>
                </form>

                <div>
                    <button class="btn btn-success">Filter</button>
                </div>
                <div style="margin-left: auto;">
                    <a href="create.php"><button class="btn"
                            style="background-color: #212529; color: white; ">Create</button></a>
                </div>
            </nav>


            <div style="margin-top: 35px; display: flex; justify-content: start; ">
            <div style="display: flex; flex-wrap: wrap;">
                <?php

                if ($output) {
                    foreach ($output as $row) {
                        ?>
                        <div class="card m-2 p-4">
                            <div class="card-body">
                                <h2>
                                    <?= $row->name; ?>
                                </h2>
                                <div><button style="color: #198754; background-color: #198754;" class="btn"><a
                                            href="show.php?id=<?= $row->id ?>">Show</a></button>
                                    <button class="btn" style="background-color: orange;"><a
                                            href="edit.php?id=<?= $row->id ?>">Edit</a></button>
                                    <button class="btn " style="background-color: red; color: white;"><a
                                            href="delete.php?id=<?= $row->id ?>">Delete</a></button>
                                    <button class="btn" style="background-color: #86b7fe; color: white;">Share</button>

                                </div>

                            </div>

                        </div>

                        <?php
                    }
                } else {
                    ?>
                <h4>No record found!</h4>
                <?php
                }
                ?>
            </div>




            </div>
            <div style="display: flex;  padding: 30px;">
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
                            background-color: rgb(121, 35, 3);" class="btn"><a href="show.html"
                            type="button">PDF</a></button> <button class="btn" style="background-color: orange;"><a
                            href="edit.html">Edit</a></button>
                    <button class="btn " style="background-color: rgb(0, 130, 39); color: white;">Excel</button>
                    <button class="btn" style="background-color: #003af9; color: white;">Email</button>
                    <button class="btn" style="background-color: rgb(0, 179, 255); color: white;"><a
                            href="create.html">MS
                            Word</a></button>
                    <button class="btn" style="background-color: rgb(255, 98, 0); color: white;"><a
                            href="create.html">History</a></button>


                </div>


            </div>
        </div>
    </div>






</head>

<body>

</body>

</html>