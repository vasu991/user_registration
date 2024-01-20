<?php
session_start();

require_once "config.php";

$username = $_SESSION['username'];

$select_query = "SELECT * FROM users WHERE username ='$username'";
$result = $conn->query($select_query);


if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "<img src='" . $user["file_path"] . "' alt='User Photo' style='max-width: 600px; min-width: 600px'>";
} else {
    echo "Login failed. Invalid username or password.";
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
