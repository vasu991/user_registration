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
    $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = $conn->query($checkUsernameQuery);

    if ($checkResult->num_rows > 0) {
        $error = "Username already taken. Please choose a different one.";
    } else {
        // Insert new user into the database
        $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Register">
    </form>

    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
