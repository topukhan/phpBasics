
<?php
// db connection
include('dbconfig.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM url WHERE id = :id";
    $stmt = $connection->prepare($query);
    $data=[':id'=>$id];
    $stmt->execute($data);
    $valid_url = $stmt->fetch(PDO::FETCH_OBJ);
}
?>


        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Player Details</title>
            <style>
                .card {
                    margin-bottom: 1.25rem;
                    box-shadow: 0 1px 3px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
                    border-width: 0;
                    margin-top: 15px;
                }
                a {
                    color: white;
                    text-decoration: none;
                }
                .card {
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    min-width: 0;
                    word-wrap: break-word;
                    background-color: #fff;
                    background-clip: border-box;
                    border: 1px solid rgba(0, 0, 0, .125);
                    border-radius: 0.25rem;
                }

                .card-header {
                    padding: 0.5rem 1rem;
                    margin-bottom: 0;
                    background-color: rgba(0, 0, 0, .03);
                    border-bottom: 1px solid rgba(0, 0, 0, .125);
                    background-color: #198754;
                    color: white;
                }

                .card-body {
                    flex: 1 1 auto;
                    padding: 1rem 1rem;
                }
            </style>

        </head>

        <body>
            <div class="card">
                <div class="card-header">
                    <h3>URL Details</h3>
                </div>
                <div class="card-body">
                    <div class="card p-3" style="width: 500px;">
                        <div class="card-body">
                            <div style="display: flex;">
                                <label style="margin-right: 10px; align-self: center; font-weight: bold;"
                                    for="url">URl:</label>
                                <p><?= $valid_url->url; ?></p>
                            </div>
                        </div>
                    </div>
                    <button style='color: #198754; background-color: #198754;' class='btn rounded-circle'><a href="index.php"  type='button'>List</a></button>

                </div>
            </div>
        </body>
        </html>

       