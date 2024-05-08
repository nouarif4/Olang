<!-- currentRequest.html -->
<?php
session_start();
include('config.php');

// Check if user is logged in
if (!isset($_SESSION["learnerID"])) {
  header("Location: signinLearner.php");
  exit();
}

// Fetch current requests of the learner
$learner_id = $_SESSION['learnerID'];
try {
  // Prepare the SQL query
  $stmt = $pdo->prepare("SELECT * FROM your_table_name WHERE learner_id = :learner_id");

  // Bind parameters
  $stmt->bindParam(':learner_id', $learner_id, PDO::PARAM_INT);

  // Execute the query
  $stmt->execute();

} catch(PDOException $e) {
  // Handle errors
  echo "Error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Current Requests</title>
  <link rel="stylesheet" href="request.css">

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
        <h6 class="LogOut"><a href="Signout.php">Log Out</a></h6>
    </div>
</nav>

  <main>
    <h2>Current Requests</h2>
    <div class="container">
      <ul id="request-list">
      <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <li class="-item">
           <p>
                    Request: <?php echo $row['requestID']; ?><br>
                    Language: <?php echo $row['language']; ?><br>
                    Proficiency Level: <?php echo $row['level']; ?><br>
                    Preferred Schedule: <?php echo $row['dateTime']; ?><br>
                    Session duration: <?php echo $row['duration']; ?>
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




