<?php
// db connection
include('dbconfig.php');
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $stmt = $connection->prepare("SELECT * FROM url WHERE url LIKE :search");
    $stmt->bindValue(':search', '%' . $search . '%');
} else {
    $stmt = $connection->prepare("SELECT * FROM url");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card {
            box-shadow: 10px 16px 36px 4px rgba(123, 120, 120, 0.75) !important;
            -webkit-box-shadow: 10px 16px 36px 4px rgba(123, 120, 120, 0.75) !important;
            -moz-box-shadow: 10px 16px 36px 4px rgba(123, 120, 120, 0.75) !important;
        }

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

        .create {
            height: 40px;
            width: 40px;
            background-color: black;

            border-radius: 100%;
            color: white;
            font-size: 20px;

        }

        .main-div {
            margin: 60px;
        }

        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>

    <div>
        <h1 class="stand">
            URL list

        </h1>



        <div class="main-div card" style="padding: 30px;">
            <nav class="navbar navbar-light ">
                <div>
                    <form class="d-flex" method="GET" action="index.php"> 
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <button class="btn btn-success ms-2"><i class="fa-solid fa-filter"></i></button>

                    </form>
                </div>
                <a href="create.php" class="ms-auto rounded-circle"><button class="create"
                        style="background-color: black ; color: white;"><i class="fa-solid fa-plus"></i></button></a>
            </nav>



            <div style="margin-top: 35px; display: flex; justify-content: start; ">
                <?php
               

                if ($output) {
                    foreach ($output as $row) {
                        ?>
                        <div class="card m-2 p-4">
                            <div class="card-body">
                                <h4>
                                    <?= $row->url; ?>
                                </h4>
                                <div>
                                    <button style="color: #198754; background-color: #198754;" class="btn rounded-circle"><a
                                            href="show.php?id=<?= $row->id ?>" type="button"><i
                                                class="fa-solid fa-eye"></i></a></button>
                                    <button class="btn btn rounded-circle " style="background-color: orange;"><a
                                            href="edit.php?id=<?= $row->id ?>"><i
                                                class="fa-solid fa-pen-to-square"></i></a></button>
                                    <button class="btn rounded-circle " style="background-color: red; color: white;"><a
                                            href="delete.php?id=<?= $row->id ?>"><i class="fa-solid fa-trash"></i></a></button>
                                    <button class="btn rounded-circle" style="background-color: #86b7fe; color: white;"><i
                                            class="fa-solid fa-share"></i></button>
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
                                background-color: rgb(121, 35, 3);" class="btn rounded-circle"><a href="show.html"
                            type="button"><i class="fa-solid fa-file-pdf"></i></a></button>
                    <button class="btn  rounded-circle" style="background-color: rgb(0, 130, 39); color: white;"><i
                            class="fa-solid fa-file-excel"></i></button>
                    <button class="btn rounded-circle" style="background-color: #003af9; color: white;"><i
                            class="fa-solid fa-envelope"></i></button>
                    <button class="btn rounded-circle" style="background-color: rgb(0, 179, 255); color: white;"><a
                            href="create.html"><i class="fa-solid fa-file-word"></i></a></button>
                    <button class="btn rounded-circle" style="background-color: rgb(255, 98, 0); color: white;"><a
                            href="create.html"><i class="fa-solid fa-clock-rotate-left"></i></a></button>


                </div>

            </div>
        </div>





    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>