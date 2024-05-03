<?php
// set the servername,username and password
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
//The mysqli_connect() function attempts to open a connection to the MySQL Server 
//running on host which can be either a host name or an IP address. 
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
//mysqli_query() function performs a query against a database.
$sql = "CREATE DATABASE IF NOT EXISTS MSL";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);
?>