<?php

require_once("config.php");

if(isset($_GET["id"])) {
    $id = $_GET['id'];

    
    $sql_select = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        
        $photo_path = $row['file_path'];
        if (file_exists($photo_path)) {
            unlink($photo_path);
        }
        $no_image = "uploads/no-image.jpg";
        $no_image_name = "no-image.jpg";

       
        $sql_delete = "UPDATE users SET file_path = '$no_image', file_name = '$no_image_name' WHERE id = '$id'";

        if ($conn->query($sql_delete) === TRUE) {
            header("location: records.php");
        } else {
            echo "Error deleting photo: " . $conn->error;
        }
    } else {
        echo "Photo not found";
    }
} else {
    echo "Photo ID not provided";
}

$conn->close();

