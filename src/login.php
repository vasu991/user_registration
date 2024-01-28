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

    // SQL query to check if the user exists
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, set session variable and redirect
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location: welcome.php");
        exit();
    } else {
        $error = "Invalid username or password";
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
    <title>Login</title>
    <style>
        .error{ color: red;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center">
        <div class="col-6  mt-5">

                <h1 class="display-6 text-center">Login Here</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Username</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100" name="login">Log In</button>
                    </form>

                    <?php
                        if (isset($error)) {
                            echo "<p style='color: red;'>$error</p>";
                        }
                    ?>

                    <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>


</body>
</html>
