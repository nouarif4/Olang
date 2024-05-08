<?php
session_start();
include('config.php');

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "olang"; 


$con = new mysqli($servername, $username, $password, $database);


if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// requestID and status


if(isset($_POST['submit'])){
    $status = $_POST['status'];
    $proficiency = $_POST['level'];
    $schedule = $_POST['dateTime'];
    $duration = $_POST['duration'];
    $language = $_POST['language'];

    $query = "INSERT INTO request (status, level, dateTime, duration, language) VALUES ('$Pending', '$proficiency', '$$schedule', '$duration', '$language')";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Request inserted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}



?>

<!-- postRequest.html -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Post Language Learning Request</title>
  <link rel="stylesheet" href="styleSign.css">

</head>
<body>
  
  <nav class="navbar">
    <div class="logo">
        <img class="olanglogo" src="olanglogo.png" alt="Olang Logo">
        <h3 class="olang">Olang</h3>
    </div>
    <div class="nav-links">
        <h6 class="Home"><a href="homePageLearner.html">Home</a></h6>
        <h6 class="About"><a href="learnerRequest.html">requests</a></h6>
        <h6 class="FAQ"><a href="sessionLearner.html">Sessions</a></h6>
        <h6 class="ViewProfile"><a href="viewprofileLearner.html">Profile</a></h6>
        <h6 class="LogOut"><a href="home.html">Log Out</a></h6>
    </div>
</nav>

        <h2>Language Learning Request</h2>
        <form action="postRequest.php" method="post">

     <label>Language:</label>
      <select name="Language">
        <option>Select a Language</option>
        <option>English</option>
        <option>Spanish</option>
        <option>French</option>
        <option>German</option>
        <option>Japanese</option>
      </select>

      <label>Proficiency Level:</label>
      <select name="Proficiency">
        <option value="">Select Proficiency Level</option>
        <option>Beginner</option>
        <option>Intermediate</option>
        <option>Advanced</option>
      </select>

      <label>Preferred Schedule:</label>
      <input type="datetime-local" name="dateTime">


        <label>Session duration:</label>
        <select name="duration">
        <option>Select Session Duration</option>
        <option>30 minutes</option>
        <option >1 hour</option>
        <option>1 hour and 30 minutes</option>
        <option>2 hours</option>
        <option>2 hours and 30 minutes</option>
        <option>3 hours</option>
      </select>

<<<<<< Updated upstream
      <button type="submit" name="learningRequest">Post Request</button>
=======
      <button type="submit" name="">Post Request</button>
>>>>>> Stashed changes

    </form>

  
  <div class="request-actions">
 
  </div>
</div>
<footer class="footer">
  &copy; Olang, 2024

</footer>
</body>


</html>

