<?php
include('config.php');

if(isset($_POST['submit'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  // not now
    $city = $_POST['city'];
    $location = $_POST['location'];



    // Insert data into the database
    $query = "INSERT INTO partners (first_name, last_name, email, password, city, location) VALUES ('$firstName', '$lastName', '$email', '$password', '$city', '$location')";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}