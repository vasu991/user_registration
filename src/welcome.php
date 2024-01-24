<?php
session_start();

require_once "config.php";

$username = $_SESSION['username'];
$password  = $_SESSION['password'];

$select_query = "SELECT * FROM users WHERE username ='$username' AND password = '$password'";
$result = $conn->query($select_query);


if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "<img src='" . $user["file_path"] . "' alt='User Photo' style='max-width: 600px; min-width: 600px;  display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    margin-bottom: 20px;
    width: 50%;'>";
} else {
    echo "Login failed. Invalid username or password.";
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn -> close();
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

    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p style="margin: 7px 20px"><a href="logout.php" style="font-size: 20px;">Logout</a></p>

    <p style="margin: 7px 20px; font-size: 20px;"><a href="records.php">Records of all users</a></p>

    </div>
</body>
</html>
