<?php
    $servername = "localhost";
    $user = "root";
    $pass = "";
    $database = "ppw";

    // Create connection

    $conn = mysqli_connect($servername,$user,$pass,$database);

    // Validate connection
    if (!$conn) {
        die("Failed to connect : " . mysqli_connect_error());
    }
?>


