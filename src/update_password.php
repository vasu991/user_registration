<?php

require_once("config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];

    
    $sql_select = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_password = $_POST["new_pass"];


            $sql_update = "UPDATE users SET password = '$new_password' WHERE id = '$id'";

            if ($conn->query($sql_update) === TRUE) {
                header("location: records.php");
            } else {
                echo "Error updating password: " . $conn->error;
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
    <title>Update User Name</title>
    <style>
        .error{ color: red;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-6 mt-5">
                <h1 class="display-6 text-center">Enter New Password</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="file" class="form-label">Update Password Here</label>
                            <input type="password" class="form-control" id="new_pass" name="new_pass" required>
                            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
                        </div>

                        <button type="submit" class="btn btn-primary w-100" name="submit">Update</button>
                    </form>

        </div>
    </div>

</body>
</html>