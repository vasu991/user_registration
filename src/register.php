<?php
session_start();

require_once "config.php";

if (isset($_SESSION['username'])) { 
    header("Location: welcome.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $file = $_FILES['fileInput']['name'];

    // Check if the username is already taken
    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = $conn->query($checkUsernameQuery);

    if ($checkResult->num_rows > 0) {
        $error = "Username already taken. Please choose a different one.";
    } else {
        // Insert new user into the database
        $insertQuery = "INSERT INTO `users`(`username`, `password`, `file`) VALUES ('$username','$password', '$file')";

        $fileName = $_FILES['fileInput']['name'];
        $tempName = $_FILES['fileInput']['tmp_name'];
        $folder = "uploads/".$fileName;
        move_uploaded_file($tempName, $folder);

        if ($conn->query($insertQuery) === TRUE) {
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }

    $conn->close();
}
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
    <div class="col-6 mt-5">
            <h1 class="display-6">Register Here</h1>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Upload Your Photo Here:</label>
                        <input type="file" class="form-control" id="fileInput" name="fileInput">
                    </div>

                    <button type="submit" class="btn btn-primary w-100" name="submit">Register</button>
                </form>

                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>

            <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>




    
</body>
</html>
