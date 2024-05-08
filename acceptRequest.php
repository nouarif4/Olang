<?php
session_start();
include('config.php');
if (!isset($_SESSION['partner_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: signinPartner.php");
    exit();
}
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "olang"; 


$con = new mysqli($servername, $username, $password, $database);


if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

if(isset($_POST['accept'])){
    $requestID = $_POST['requestID'];

    $query = "UPDATE request SET Status = 'Accepted' WHERE Requestid = '$requestID'";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Request Accepted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}
