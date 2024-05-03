<?php
// set the servername,username and password
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MSL";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>