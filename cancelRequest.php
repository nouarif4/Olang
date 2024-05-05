<?php
session_start();
include('config.php');

$connection = mysqli_connect(host, username, password, olang);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if(isset($_POST['cancel'])){
    $requestID = $_POST['requestID'];

    $query = "UPDATE request SET Status = 'Cancelled' WHERE Requestid = '$requestID'";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Request cancelled successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}
?>