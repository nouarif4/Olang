<?php
session_start();

$connection = mysqli_connect(host, username, password, olang);


if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $query = "SELECT * FROM learner WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        
        $_SESSION['email'] = $email;

        header("Location: homePageLearner.html");
        exit();
    } else {
       
        $message = "Email or password is incorrect.";
    }
}
?>