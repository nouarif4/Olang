<?php
session_start();
include('config.php');

$connection = mysqli_connect(host, username, password, olang);


if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// requestID and status


if(isset($_POST['submit'])){
    $language = $_POST['language'];
    $proficiency = $_POST['level'];
    $schedule = $_POST['dateTime'];
    $duration = $_POST['duration'];
    $status = $_POST['status'];



    $query = "INSERT INTO request (language, level, DateTime, duration, status) VALUES ('$language', '$proficiency', '$schedule', '$duration', '$status')";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Request inserted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}



?>


