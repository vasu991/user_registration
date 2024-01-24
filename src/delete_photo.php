<?php
session_start();

require_once("config.php");

if(isset($_GET["id"])) {
    $photo_id = $_GET['id'];

    
    $sql_select = "SELECT * FROM users WHERE id = $photo_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        
        $photo_path = $row['file_path'];
        if (file_exists($photo_path)) {
            unlink($photo_path);
        }

       
        $sql_delete = "DELETE FROM users WHERE id = '$photo_id'";

        if ($conn->query($sql_delete) === TRUE) {
            echo "record deleted successfully";
        } else {
            echo "Error deleting photo: " . $conn->error;
        }
    } else {
        echo "Photo not found";
    }
} else {
    echo "Photo ID not provided";
}

