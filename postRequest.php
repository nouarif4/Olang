<?php
session_start();
include('config.php');

$connection = mysqli_connect(host, username, password, olang);


if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// requestID and status


if(isset($_POST['submit'])){
    $status = $_POST['status'];
    $proficiency = $_POST['level'];
    $schedule = $_POST['dateTime'];
    $duration = $_POST['duration'];
    $language = $_POST['language'];

    $query = "INSERT INTO request (status, level, dateTime, duration, language) VALUES ('$status', '$proficiency', '$$schedule', '$duration', '$language')";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Request inserted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}



?>


