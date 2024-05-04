<?php
include 'createDatabase.php';

// set the servername,username and password
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MSL";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname,3307);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    photo VARCHAR(255) NOT NULL
)";

if (!mysqli_query($conn, $sql)) {
    echo "Error creating table: " . mysqli_error($conn);
} 

$sql = "CREATE TABLE IF NOT EXISTS volunteer_information (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone_num VARCHAR(255) NOT NULL UNIQUE,
    street_address VARCHAR(255) NOT NULL,
    city_or_town VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    postcode VARCHAR(255) NOT NULL,
    organization VARCHAR(255) NOT NULL,
    organization_type VARCHAR(255) NOT NULL,
    days VARCHAR(255),
    time VARCHAR(255),
    message VARCHAR(255)
)";
if (!mysqli_query($conn, $sql)) {
    echo "Error creating table: " . mysqli_error($conn);
}
?>