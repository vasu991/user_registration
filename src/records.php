
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
    border-radius: 10px;
    }
    th, td {
    padding: 15px;
    }
    body {
        background-color: lightcyan;
    }

    </style>
   
   <table border='1' style='
    margin-left: auto;
    margin-right: auto;
    max-width: 200px;
    min-width: 200px;
    font-family: "Courier New", Courier, monospace;
    font-size: larger;
    border-style: solid;
    border-radius: 10px;
    '>
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
        echo "<td>";
        echo "<a href='delete_photo.php?id={$row['id']}'>Delete Photo</a>";
        echo "<br>";
        echo "<br>";
        echo "<a href='update_photo.php?id={$row["id"]}'>Update Photo</a>";
        echo "</td>";
        echo "</tr>";
    }
        echo "</tbody>
    </table>";
} else {
    echo "0 results";
}


$conn->close();

