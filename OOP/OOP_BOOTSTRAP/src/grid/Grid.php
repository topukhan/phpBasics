<?php

namespace player\Grid;
use player\Grid\Helper;

use PDO;
use PDOException;

class Grid
{
   
    public function index()
    {
        $helper = new Helper; 
        $helper->connect();

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $stmt = $helper->prepare("SELECT * FROM players WHERE name LIKE :search"); // Use $helper object
            $stmt->bindValue(':search', '%' . $search . '%');
        } else {
            $stmt = $helper->prepare("SELECT * FROM players"); // Use $helper object
        }
        $stmt->execute();
        $output = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $output;
    }

    public function store($data)
    {
        $errors = []; // Initialize an empty array to store validation errors

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $data['name'];

            // Validate name field
            if (empty($name)) {
                $errors[] = "Name field cannot be empty.";
            } elseif (strlen($name) > 20) {
                $errors[] = "Name field cannot exceed 20 characters.";
            }

            // Proceed with database insertion if there are no validation errors
            if (empty($errors)) {
                $helper = new Helper; 
                $helper->connect();

                $stmt = $helper->prepare("INSERT INTO players (name) VALUES (:name)");  
                $data = [':name' => $name];

                try {
                    $stmt->execute($data);
                    echo "Player created successfully.";
                } catch (PDOException $e) {
                    echo "Error creating player: " . $e->getMessage();
                }
            } else {
                // Display validation errors
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
            }
        }
    }

    public function show($id)
    {
        $helper = new Helper();
        $helper->connect();

        $query = "SELECT * FROM players WHERE id = :id";
        $stmt = $helper->prepare($query);
        $data=[':id'=>$id];

        
        try {
            $stmt->execute($data);
            $player = $stmt->fetch(PDO::FETCH_OBJ);
            return $player;

            //echo "Player created successfully.";
        } catch (PDOException $e) {
            echo "Error in showing player information!: " . $e->getMessage();
        }

       
    }

    public function edit($id)
        {
            $helper = new Helper();
            $helper->connect();

            $query = "SELECT * FROM players WHERE id = :id";
            $stmt = $helper->prepare($query);
            $stmt->bindValue(':id', $id);

            try {
                $stmt->execute();
                $player = $stmt->fetch(PDO::FETCH_OBJ);
                
                // Validate name field
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $playername = $_POST['playername'];
                    $errors = []; // Initialize an empty array to store validation errors

                    if (empty($playername)) {
                        $errors[] = "Name field cannot be empty.";
                    } elseif (strlen($playername) > 20) {
                        $errors[] = "Name field cannot exceed 20 characters.";
                    }

                    // Proceed with database update if there are no validation errors
                    if (empty($errors)) {
                        $query = "UPDATE players SET name = :p_name WHERE id = :id";
                        $stmt = $helper->prepare($query);
                        $stmt->bindValue(':id', $id);
                        $stmt->bindValue(':p_name', $playername);
                        $stmt->execute();
                        header("Location: index.php");
                    } else {
                        // Display validation errors
                        foreach ($errors as $error) {
                            echo $error . "<br>";
                        }
                    }
                }

                return $player;
            } catch (PDOException $e) {
                echo "Error in showing player information!: " . $e->getMessage();
            }
        }


            
           

    

    public function delete($id)
    {
        $helper = new Helper();
        $helper->connect();

        $query = "DELETE FROM players WHERE id = :id";
        $stmt = $helper->prepare($query);
        $stmt->bindValue(':id', $id);

        try {
            $stmt->execute();
            header("location:./index.php");
            //echo "Player deleted successfully.";
        } catch (PDOException $e) {
            echo "Error deleting player: " . $e->getMessage();
        }
    }

}
?>