<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog";

    // Create MYSQL connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>