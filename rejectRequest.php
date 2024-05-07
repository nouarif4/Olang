<?php
session_start();
include('config.php');

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "olang"; 


$conn = new mysqli($servername, $username, $password, $database);


if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if(isset($_POST['reject'])){
    $requestID = $_POST['requestID'];

    $query = "UPDATE request SET Status = 'Rejected' WHERE Requestid = '$requestID'";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Request is Rejected!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}
