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
      <input type="datetime-local" name="Preferred Schedule">


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


<script>
  // Add your JavaScript code here
  // You can use the document object to access elements on the page

  // Example: Change the background color of the body element
  document.body.style.backgroundColor = "lightblue";

  // Example: Add an event listener to the form submit button
  const form = document.querySelector("form");
  const submitButton = document.querySelector("button[type='submit']");
  submitButton.addEventListener("click", function(event) {
    event.preventDefault(); // Prevent form submission

    // Get the selected language and proficiency level
    const languageSelect = document.querySelector("select[name='Language']");
    const proficiencySelect = document.querySelector("select[name='Proficiency']");
    const language = languageSelect.value;
    const proficiency = proficiencySelect.value;

    // Validate the form inputs
    if (language === "" || proficiency === "") {
      alert("Please select a language and proficiency level");
      return;
    }

    // Get the preferred schedule and session duration
    const scheduleInput = document.querySelector("input[type='datetime-local']");
    const durationSelect = document.querySelector("select[name='duration']");
    const schedule = scheduleInput.value;
    const duration = durationSelect.value;

    // Perform any additional processing or validation here

    // Submit the form data to the server
    form.submit();
  });
</script>
