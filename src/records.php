
<?php

require_once("config.php");

$sql = "SELECT username, password, file_path, id FROM users ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) { ?>

   <style>
    img{
    width:200px;
    max-width: 600px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    margin-bottom: 20px;
    }
    th, td {
    padding: 15px;
    }
    body {
        background-color: lightcyan;
    }

    </style>
   
   <table style='
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    margin-bottom: 20px;
    max-width: 200px;
    min-width: 200px;
    font-family: "Courier New", Courier, monospace;
    font-size: larger;
    border-style: solid;
    border-radius: 10px;
    '
    class="table table-dark table-striped table-hover"
    >
    <thead>
        <th>Id</th>
        <th>Password</th>
        <th>Username</th>
        <th>Photo</th>
        <th>Operations</th>
    </thead>
    <tbody>
   <?php


    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>". $row["id"] ."</td>";
        echo "<td>". $row["password"] ."</td>";
        echo "<td>" .$row["username"] . "</td>";
        echo '<td>';
        echo "<img src='" . $row["file_path"] . "'>";
        echo "</td>";
        echo "<td>"; ?>
        <table class="table table-secondary table-hover">
            <?php
        echo "<thead>";
        echo "<th>User Name</th>";
        echo "<th>Password</th>"; ?>

        <th colspan="2" style="padding-left: 10%; ">Image</th>
        <?php
        echo "</thead>";
        echo "<tbody>";
        echo "<tr>";
        echo "<td><a href='update_user_name.php?id={$row["id"]}&username={$row["username"]}'>Update User Name</a></td>";
        echo "<td><a href='update_password.php?id={$row["id"]}'>Update Password</a></td>";
        echo "<td><a href='delete_photo.php?id={$row['id']}'>Delete Photo</a></td>";
        echo "<td><a href='update_photo.php?id={$row["id"]}'>Update Photo</a></td>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        echo "</td>";
        echo "</tr>";
    }
        echo "</tbody>
    </table>";
} else {
    echo "0 results";
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
    <title>Records</title>
    <style>
        .error{ color: red;
        }
    </style>
</head>
<body>

</body>
</html>

