<?php
session_start();
include('config.php');
if (!isset($_SESSION["learner_id"])) {
    // Redirect user to login page if not logged in
    header("Location: signinLearner.php");
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

if(isset($_POST['cancel'])){
    $requestID = $_POST['requestID'];

    $query = "UPDATE request SET Status = 'Cancelled' WHERE Requestid = '$requestID'";
    //  $query = "DELETE FROM request WHERE Requestid = '$requestID'";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Request cancelled successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}
