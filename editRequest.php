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

    $query = "UPDATE request SET (status, level, dateTime, duration, language) VALUES ('Pending', '$proficiency', '$$schedule', '$duration', '$language')";
    $result = mysqli_query($con, $query);

    if($result){
        echo "Request updated successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Language Learning Request</title>
  <link rel="stylesheet" href="userHomepage.css">

  <link rel="stylesheet" href="navbar2.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
</head> <body>
  
<nav class="nav">
  <img class="olanglogo" src="olanglogo.png">
  <h3 class="olang">Olang</h3>
  <div class="navbarCenter">
      <h6 class="Home"><a href="learnerHomepage.html">Home</a></h6>
      <h6 class="About"><a href="learnerRequest.html">requests</a></h6>
      <h6 class="FAQ"><a href="sessionLearner.html">Sessions</a></h6>
  </div>
  <ul>
    <li class="profile-dropdown"><a href="#"> <div class="profile-picture10">
      <div class="circular-image10" style="background-image: url('profile.png');"></div></a>
      <ul class="dropdown-menu">
        <br>
        <li><a href="viewprofileLearner.html">EDIT PROFILE</a></li>
        <br>
        
        <li><a href="#">SIGN OUT</a></li>
      </ul></li>
 
  </div></nav>
  <br>

<div class="form-container">
  <h1>Language Learning Request</h1>
  <form action="editRequest.php" method="post">

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
    <input type="datetime-local">


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

    <input type="submit" value="Save Changes">

  </form>

</div>
</div>
<footer class="footer">
  &copy; Olang, 2024

</footer>
</body>


</html>

