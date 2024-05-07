<?php
$servername = "localhost"; // Change this to your database server name if different
$username = "username"; // Change this to your database username
$password = "password"; // Change this to your database password
$dbname = "your_database"; // Change this to your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
