<?php
include_once('./dbconnect.php');
// Store data into table 
if (isset($_REQUEST["submit"])) {
    $url = $_REQUEST['url'];
    //validate url with path required
    if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
        $query = "INSERT INTO url(url) VALUES(:url)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':url', $url);
        $stmt->execute();
        header('location:index.php');
    } else {
        $error = "invalid URL or missing path";
        echo $error;
    }
}

if (isset($_REQUEST["sanitize"])) {
    $url = $_REQUEST['url'];
    //validate urlecho "Given URL: " . $url."<br>";
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        if (filter_var($url, FILTER_SANITIZE_URL)) {
            $query = "INSERT INTO url(url) VALUES(:url)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':url', $url);
            $stmt->execute();
            echo "This sanitized email address is considered valid.\n";
        } else {
            echo "This sanitized email address is considered invalid.\n";
        }
    } else {
        echo "This email address is considered invalid. (validation failed)\n";
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
    <h2>
        URL Validation
    </h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="URL">URL:</label>
        <input id="URL" style="width: 500px;" name="url" type="text" placeholder="http://eg.com/path">
        <button type="submit" name="submit">Create</button>
        <button><a href="index.php">back</a></button>
    </form>

    <h2>
        URL Validation with Sanitization
    </h2>
    <form method="POST" action="#">

        <label for="URL">URL:</label>
        <input id="URL" style="width: 500px;" name="url" type="text" placeholder="http://eg.com/path">
        <button type="submit" name="sanitize">Create</button>
        <button><a href="index.php">back</a></button>
    </form>
</body>

</html>