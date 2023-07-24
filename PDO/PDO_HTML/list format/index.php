<?php
include_once('dbconnect.php');
$displaySearchResults = false; // Flag variable to determine display mode

if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    $stmt = $pdo->prepare("SELECT * FROM players WHERE name LIKE ?");
    $searchQuery = '%' . $searchQuery . '%';
    $stmt->bindParam(1, $searchQuery);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set the flag based on the search result
    if (count($result) > 0) {
        $displaySearchResults = true;
    }
    else{
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
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="query" placeholder="search">
            <button type="submit">Search</button>
        </form><br>

        <button>Filter</button>
        <button><a href="create.php">create</a></button></span>
    </div>
    <div>

        <ul>
            <li>
                <span><input type="checkbox"></span>
                <span>Serial</span>
                <span>name</span>
                <span>Action</span>
            </li>
            <?php
            if ($displaySearchResults) {
                $sl = 1;
                foreach ($result as $player) { ?>
                    <li>
                        <span><input type="checkbox"></span>
                        <span><?php echo $sl++ ?></span>
                        <span><?php echo $player['name'] ?></span>
                        <span>
                            <button><a href="show.php?id=<?php echo $player['id'] ?>" type="button">Show</a></button>
                            <button><a href="edit.php?id=<?php echo $player['id'] ?>">Edit</a></button>
                            <button><a href="delete.php?id=<?php echo $player['id'] ?>" onclick="return confirm('Are you sure you want to delete this player?')">Delete</a></button>
                            <button>Share</button>
                        </span>
                    </li>
                <?php
                }
            } else {
                // Display the regular data when no search results
                $query = "SELECT * FROM players";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $players = $stmt->fetchAll();
                $sl = 1;
                foreach ($players as $player) { ?>
                    <li>
                        <span><input type="checkbox"></span>
                        <span><?php echo $sl++ ?></span>
                        <span><?php echo $player['name'] ?></span>
                        
                        <button><a href="show.php?id=<?php echo $player['id'] ?>" type="button">Show</a></button>
                        <button><a href="edit.php?id=<?php echo $player['id'] ?>">Edit</a></button>
                        <button><a href="delete.php?id=<?php echo $player['id'] ?>" onclick="return confirm('Are you sure you want to delete this player?')">Delete</a></button>
                        <button>Share</button>
                    </li>
            <?php
                }
            }
            ?>


        </ul>
    </div>

    <span>Rover per page</span>
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
            <button>Web View</button>
            <button>History</button>
            <button><a href="">index-html</a></button>

</body>

</html>