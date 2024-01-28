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

    // Check if the username is already taken
    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $checkResult = $conn->query($checkUsernameQuery);

    if ($checkResult->num_rows > 0) {
        $error = "Username already taken. Please choose a different one.";
    } else {

        echo "<pre>";
        print_r($_FILES['file']);
        echo "</pre>";

	$img_name = $_FILES['file']['name'];
	$img_size = $_FILES['file']['size'];
	$tmp_name = $_FILES['file']['tmp_name'];
	$error = $_FILES['file']['error'];

	if ($error === 0) {
                
                    $img_upload_path = 'uploads/'.$img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into Database

                    $sql = "INSERT INTO `users`(`username`, `password`, `file_name`, `file_path`) VALUES ('$username','$password', '$img_name', '$img_upload_path')";
                    if(mysqli_query($conn, $sql)) {
                        header("Location: welcome.php");
                    }
                    else {
                        echo "error adding record";
                    }
 
        } else {
            $em = "unknown error occurred!";
            header("Location: register.php?error=$em");
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
    <title>User Registration With Photo</title>
    <style>
        .error{ color: red;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-6 mt-5">
                <h1 class="display-6 text-center">Register Here</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload Your Photo Here:</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" name="submit">Register</button>
                    </form>

                    <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

</body>
</html>
