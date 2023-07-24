<?php
include_once('./dbconnect.php');
$displaySearchResults = false; // Flag variable to determine display mode

if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    $stmt = $pdo->prepare("SELECT * FROM url WHERE url LIKE ?");
    $searchQuery = '%' . $searchQuery . '%';
    $stmt->bindParam(1, $searchQuery);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set the flag based on the search result
    if (count($result) > 0) {
        $displaySearchResults = true;
    } else {
        echo "no result found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <h2>Player Lists</h2>
        <button>Filter</button>
        <button><a href="create.php">create</a></button>
    </div>
    <br>



    <table border="2">
        <tr>
            <td>

            </td>
            <td>

            </td>
            <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <td>
                    <input type="text" name="query" placeholder="search">
                </td>
                <td>
                    <button type="submit">Search</button>
                </td>
            </form>

        </tr>

        <tr>

            <th><input type="checkbox"></th>
            <th>Serial</th>
            <th>URL</th>
            <th>Action</th>
        </tr>

        <?php
        if ($displaySearchResults) {
            $sl = 1;
            foreach ($result as $player) { ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td><?php echo $sl++ ?></td>
                    <td><?php echo $player['url'] ?></td>
                    <td>
                        <button><a href="show.php?id=<?php echo $player['id'] ?>" type="button">Show</a></button>
                        <button><a href="edit.php?id=<?php echo $player['id'] ?>">Edit</a></button>
                        <button><a href="delete.php?id=<?php echo $player['id'] ?>" onclick="return confirm('Are you sure you want to delete this player?')">Delete</a></button>
                        <button>Share</button>
                    </td>
                </tr>
            <?php
            }
        } else {
            $query = "SELECT * FROM url";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $players = $stmt->fetchAll();
            $sl = 1;
            foreach ($players as $player) { ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td><?php echo $sl++ ?></td>
                    <td><?php echo $player['url'] ?></td>
                    <td><button><a href="show.php?id=<?php echo $player['id'] ?>" type="button">Show</a></button>
                        <button><a href="edit.php?id=<?php echo $player['id'] ?>">Edit</a></button>
                        <button><a href="delete.php?id=<?php echo $player['id'] ?>" onclick="return confirm('Are you sure you want to delete this player?')">Delete</a></button>
                        <button>Share</button>

                    </td>
                </tr>
        <?php
            }
        }
        ?>

    </table>
    <br>
    <span>Rover per purl</span>
    <select>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
    </select>
    <button>
        << /button>
            <button>1</button>
            <button>2</button>
            <button>3</button>
            <button>></button>
            <button>PDF</button>
            <button>Excel</button>
            <button>Email</button>
            <button>MS Word</button>
            <button>History</button>
            <button>Print</button>

</body>

</html>