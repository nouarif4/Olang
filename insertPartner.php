<?php
// Database connection
$servername = "localhost";
$username = "";
$password = "";
$dbname = "olang";

$conn = new mysqli($servername, $username, $password, $dbname);

//  connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert  data 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phoneNumber = $_POST["phoneNumber"];
    $bio = $_POST["bio"];
    $city = $_POST["city"];

    

    $sql = "INSERT INTO partners (first_name, last_name, age, gender, email, password, phone_number, bio, city)
    VALUES ('$firstName', '$lastName', '$age', '$gender', '$email', '$password', '$phoneNumber', '$bio', '$city')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
