<?php
session_start();
// db connection
include('dbconfig.php');

$sort_column = 'name';
$sort_order = 'ASC';

// Pagination settings
$records_per_page = 4;
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start_from = ($current_page - 1) * $records_per_page;

// Filter/ sort 
if (isset($_GET['sort'])) {
    if ($_GET['sort'] === 'asc') {
        $sort_order = 'ASC';
    } elseif ($_GET['sort'] === 'desc') {
        $sort_order = 'DESC';
    }
}

// SQL query without LIMIT clause to get the total number of records
$total_records_query = isset($_GET['search']) && !empty($_GET['search'])
    ? "SELECT COUNT(*) AS total FROM players WHERE name LIKE :search"
    : "SELECT COUNT(*) AS total FROM players";

$stmt_total = $connection->prepare($total_records_query);

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $stmt_total->bindValue(':search', '%' . $search . '%');
}

$stmt_total->execute();
$total_result = $stmt_total->fetch(PDO::FETCH_ASSOC);
$total_records = $total_result['total'];

// SQL query with LIMIT clause for pagination
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $query = "SELECT * FROM players WHERE name LIKE :search ORDER BY $sort_column $sort_order LIMIT :start_from, :records_per_page";
    $stmt = $connection->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%');
    $stmt->bindValue(':start_from', $start_from, PDO::PARAM_INT);
    $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
} else {
    $query = "SELECT * FROM players ORDER BY $sort_column $sort_order LIMIT :start_from, :records_per_page";
    $stmt = $connection->prepare($query);
    $stmt->bindValue(':start_from', $start_from, PDO::PARAM_INT);
    $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
}

$stmt->execute();
$output = $stmt->fetchAll(PDO::FETCH_OBJ);

// pages need to show all record
$total_pages = ceil($total_records / $records_per_page);
// Serial number (Sl No) calculation
$serial_number = ($current_page - 1) * $records_per_page + 1;

// Multi Delete functionality 
if (isset($_POST['delete'])) {
    if (!empty($_POST['checkedIds'])) {
        // Get the checked ids
        $checkedIds = $_POST['checkedIds'];

        // Prepare the DELETE statement
        $sql = 'DELETE FROM players WHERE id IN (' . implode(',', $checkedIds) . ')';

        // Execute the DELETE statement
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        // If the DELETE statement was successful, redirect to the list of users
        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = 'Selected records deleted successfully.';
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $_SESSION['message'] = 'No records were deleted.';
        }
    } else {
        // Show an alert if no checkboxes are selected
        $_SESSION['message'] = 'Please select at least one record to delete.';
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
    <div>
        <h1 class="text-center bg-success text-white p-2">Player List</h1>
    </div>
    <!-- Message Alert -->
    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
        echo $_SESSION['message'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['message']);
    }
    ?>
    <div class="main-div container">
        <div class="card my-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-success">
                            <tr>
                                <th style="width: 0%;"></th>
                                <th></th>
                                <th>
                                    <!-- search/filter form  -->
                                    <form method="GET" action="" style="display: inline;">
                                        <div class="input-group">
                                            <input class="form-control" type="search" placeholder="Search" name="search" aria-label="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="submit">Search</button>
                                                <a href="./index.php" class="btn btn-primary text-white ms-1">Reset</a>
                                            </div>
                                        </div>
                                        <!-- Ascending and Descending buttons -->
                                        <div class="btn-group mt-2">
                                            <a href="?sort=asc" class="btn btn-success <?= ($sort_order === 'ASC') ? 'active' : ''; ?>">
                                                <i class="fa-solid fa-arrow-down-a-z"></i> Asc
                                            </a>
                                            <a href="?sort=desc" class="btn btn-success <?= ($sort_order === 'DESC') ? 'active' : ''; ?>">
                                                <i class="fa-solid fa-arrow-down-z-a"></i> Desc
                                            </a>
                                        </div>
                                    </form>

                                </th>
                                <th></th>
                            </tr>
                            <tr>
                                <th style="width: 0%;"></th>
                                <th>sl.</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <form action="#" method="post">
                            <tbody>
                                <!-- data table  -->
                                <?php
                                $sl = 1;
                                if ($output) {
                                    foreach ($output as $row) {
                                ?>
                                        <tr>
                                            <td class="p-3 ">
                                                <label for="checkbox_<?php echo $row->id; ?>">
                                                    <input type='checkbox' name="checkedIds[]" value="<?php echo $row->id; ?>" id="checkbox_<?php echo $row->id; ?>">
                                                </label>
                                            </td>
                                            <td><?= $serial_number++; ?></td>
                                            <td><?= $row->name; ?></td>
                                            <td>
                                                <a href="show.php?id=<?= $row->id ?>" class='btn btn-success rounded-circle'>
                                                    <i class='fa-solid fa-eye'></i>
                                                </a>
                                                <a href="edit.php?id=<?= $row->id ?>" class='btn btn-warning rounded-circle'>
                                                    <i class='fa-solid fa-pen-to-square'></i>
                                                </a>
                                                <a href="delete.php?id=<?= $row->id ?>" onclick="return confirm('Are you sure you want to delete this player?')" class='btn btn-danger rounded-circle'>
                                                    <i class='fa-solid fa-trash'></i>
                                                </a>
                                                <a href="#" class='btn btn-primary rounded-circle'>
                                                    <i class='fa-solid fa-share'></i>
                                                </a>
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
                    <button onclick="return confirm('Are you sure you want to delete this player?')" class='btn btn-danger' type="submit" name="delete">
                        <i class='fa-solid fa-trash'></i>
                        <span>Multiple Delete</span>
                    </button>
                    <label class="btn btn-light" for="checkAll">
                        <input type="checkbox" id="checkAll" class="me-2">Check all </label>
                    </form>

                </div>
                <div class="text-center mt-3">
                    <a href="create.php" class="btn btn-success btn-lg"><i class="fa-solid fa-plus"></i></a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- Pagination -->
                            <div class="float-start">
                                <!-- Pagination links -->
                                <ul class="pagination justify-content-start">
                                    <?php
                                    if ($current_page > 1) {
                                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">&laquo;</a></li>';
                                    } else {
                                        echo '<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>';
                                    }

                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $current_page) {
                                            echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                                        } else {
                                            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }

                                    if ($current_page < $total_pages) {
                                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">&raquo;</a></li>';
                                    } else {
                                        echo '<li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- Other buttons -->
                            <div class="d-flex justify-content-end mt-3">
                                <a href="?download_pdf" class="btn btn-success rounded-circle me-2"><i class="fa-solid fa-file-pdf"></i></a>
                                <button class="btn btn-primary rounded-circle me-2"><i class="fa-solid fa-file-excel"></i></button>
                                <button class="btn btn-info rounded-circle me-2"><i class="fa-solid fa-envelope"></i></button>
                                <a href="create.html" class="btn btn-primary rounded-circle me-2"><i class="fa-solid fa-file-word"></i></a>
                                <a href="create.html" class="btn btn-warning rounded-circle"><i class="fa-solid fa-clock-rotate-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Function to handle the "Check All" functionality
            function handleCheckAll() {
                const checkAllCheckbox = document.getElementById('checkAll');
                const checkboxes = document.querySelectorAll('input[name="checkedIds[]"]');
                // Check or uncheck all checkboxes
                checkboxes.forEach(checkbox => {
                    checkbox.checked = checkAllCheckbox.checked;
                });
            }
            // Event listener for the "Check All" checkbox
            const checkAllCheckbox = document.getElementById('checkAll');
            checkAllCheckbox.addEventListener('click', handleCheckAll);
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>