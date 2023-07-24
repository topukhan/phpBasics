<?php
include_once('./dbconnect.php');
// Store data into table 
if (isset($_REQUEST["submit"])) {
    $sanitized_special_char = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($sanitized_special_char !== false) {
        $query = "INSERT INTO url(url) VALUES(:url)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':url', $sanitized_special_char);
        $stmt->execute();
        echo "Input filtered";
    } else {
        $error = "Invalid URL";
        echo $error;
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
        Filter Input
    </h2>
    <form method="POST" action="#">
        <label for="URL">URL:</label>
        <input id="URL" name="url" type="text" placeholder="http://ex.com">
        <button type="submit" name="submit">Create</button>
        <button><a href="index.php">back</a></button>
    </form>
</body>

</html>