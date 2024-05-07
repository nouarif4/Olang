<!-- currentRequest.html -->
<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "olang";

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if user is logged in
if (!isset($_SESSION["ID"])) {
    // Redirect user to login page if not logged in
    header("Location: signinLearner.php");
    exit();
}

// Fetch current requests of the learner
$learner_id = $_SESSION['learner_id'];
$sql = "SELECT * FROM requests WHERE learner_id = $learner_id";
$result = mysqli_query($conn, $sql);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Current Requests</title>
  <link rel="stylesheet" href="request.css">
  <!-- Add your CSS styles here -->
</head>

<body>
nav class="navbar">
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

  <main>
    <h2>Current Requests</h2>
    <div class="container">
      <ul id="request-list">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <li class="-item">
          <div class="-header"></div>
          <p class="-content">
            <?php echo "Request: " . $row['request_id']; ?><br>
            <?php echo "Language: " . $row['language']; ?><br>
            <?php echo "Proficiency Level: " . $row['proficiency_level']; ?><br>
            <?php echo "Preferred Schedule: " . $row['preferred_schedule']; ?><br>
            <?php echo "Session duration: " . $row['session_duration']; ?>
          </p>
          <br>
          <br>
          <br>
          <button class="button"><a href="editRequest.php">Edit</a></button>
          <form action="cancelRequest.php" method="post" class="cancel-form">
            <button type="submit" class="button-cancel">Cancel</button>
          </form>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>
  </main>

  <footer class="footer">
  &copy; Olang, 2024

</footer>

</body>
</html>










<!-- currentRequest.html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Current Requests</title>
  <link rel="stylesheet" href="request.css">
  <!-- <link rel="stylesheet" href="styleLearner.css"> -->
    <!-- <link href="navbar.css" rel="stylesheet"> -->
</head>
<!--
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


  <main>

    <h2>Current Requests</h2>
<div class="container">

  <ul id="request-list">
    <li class="-item">
      <div class="-header">
      </div>
      <p class="-content">Request 1 <br>
        Language: English <br>
        Proficiency Level: Beginner <br>
         Preferred Schedule: 03/01/2024 2:00 PM <br>
         Session duration: 1 hour 
      </p>
      <br>
      <br>
      <br>
      <button class="button"><a href="editRequest.php">Edit</a></button>
      <form action="cancelRequest.php" method="post" class="cancel-form">
        <button type="submit" class="button-cancel">Cancel</button>
      </form>
      <!-- <div class="-actions">
        <a href="editRequest.html" class="button"><span>Edit</span></a>
        <input type="submit" value="Cancel"class="button-cancel">
      </div> -->
      <!--
    </li>
    <li class="-item">
      <div class="-header">
        </div>
        <p class="-content">Request 2 <br>
          Language: Japanese <br>
          Proficiency Level: Beginner <br>
           Preferred Schedule: 03/04/2024 4:00 PM <br>
           Session duration: 2 hours <br>
           <br>
           <br>
          <strong>Your Request is Accepted ! </strong></p>
    </li>
  </ul>
</div>

</main>

<footer class="footer">
  &copy; Olang, 2024

</footer>
</body>
</html>  -->