<?php
session_start();
include('config.php');
if (!isset($_SESSION['partner_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: signinPartner.php");
    exit();
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
