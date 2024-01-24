
<?php

require_once("config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["img_id"];

    
    $sql_select = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $img_name = $_FILES['file']['name'];
        $img_size = $_FILES['file']['size'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];

        if ($error === 0) {
                    
            $img_upload_path = 'uploads/'.$img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

                        // Insert into Database

            $sql_update = "UPDATE users SET file_path = '$img_upload_path', file_name = '$' WHERE id = '$id'";

            if ($conn->query($sql_update) === TRUE) {
                header("location: records.php");
            } else {
                echo "Error updating photo: " . $conn->error;
            }

    
            } else {
               echo "unkonwn error occured";
            }


        
        } else {
            echo "record not found";
        }
    }





$conn->close();

?>






<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{ color: red;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-6 mt-5">
                <h1 class="display-6 text-center">Choose New Photo</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload Your Photo Here:</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                            <input type="hidden" name="img_id" value="<?php echo $_GET['id'] ?>" />
                        </div>

                        <button type="submit" class="btn btn-primary w-100" name="submit">Register</button>
                    </form>

        </div>
    </div>

</body>
</html>