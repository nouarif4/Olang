<?php
session_start();
include('config.php');

$connection = mysqli_connect(host, username, password, olang);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if(isset($_POST['edit'])){
    $requestID = $_POST['requestID'];
    $status = $_POST['status'];
    $proficiency = $_POST['level'];
    $schedule = $_POST['dateTime'];
    $duration = $_POST['duration'];
    $language = $_POST['language'];

    $query = "UPDATE request SET (status, level, dateTime, duration, language) VALUES ('$status', '$proficiency', '$$schedule', '$duration', '$language')";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Request updated successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}
