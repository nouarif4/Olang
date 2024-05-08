<?php
session_start();
include('config.php');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "olang";

// Connect to the database
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch requests from the database
$partnerID = $_SESSION['partnerID'];
$sql = "SELECT * FROM request WHERE partnerID = $partnerID";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Requests</title>
  <link rel="stylesheet" href="navbar.css" />
  <link rel="stylesheet" href="request.css">
  <link rel="stylesheet" href="styleLearner.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <nav class="nav">
    <img class="olanglogo" src="olanglogo.png">
    <h3 class="olang">Olang</h3>
    <div class="navbarCenter">
        <h6 class="Home"><a href="homePagePartner (1).html">Home</a></h6>
        <h6 class="About"><a href="partnerRequest.html">Requests</a></h6>
        <h6 class="FAQ"><a href="sessionPartner.html">Sessions</a></h6>
    </div>
    <ul>
      <li class="profile-dropdown"><a href="#"> <div class="profile-picture10">
        <div class="circular-image10" style="background-image: url('profile.png');"></div></a>
        <ul class="dropdown-menu">
          <br>
          <li><a href="viewprofileLearner.html">EDIT PROFILE</a></li>
          <br>
          <li><a href="Signout.php">SIGN OUT</a></li>
        </ul></li>
    </div>
  </nav>

  <main>
    <h2>Browse Requests</h2>
    <div class="container">
      <ul id="request-list">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <li class="-item">
          <div class="-header"></div>
          <p class="-content">
            <?php echo "Request: " . $row['requestID']; ?><br>
            <?php echo "Language: " . $row['language']; ?><br>
            <?php echo "Proficiency Level: " . $row['level']; ?><br>
            <?php echo "Preferred Schedule: " . $row['dateTime']; ?><br>
            <?php echo "Session duration: " . $row['duration']; ?>
          </p>
          <br>
          <div class="-actions">
          <form action="acceptRequest.php" method="post" class="accept-form">
        <input type="hidden" name="requestID" value="<?php echo $row['requestID']; ?>">
        <button type="submit" class="accept-button">Accept</button>
      </form>
      <form action="rejectRequest.php" method="post" class="reject-form">
        <input type="hidden" name="requestID" value="<?php echo $row['requestID']; ?>">
        <button type="submit" class="reject-button">Reject</button>
      </form>
          </div>
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





<!-- browseRequest.html 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Requests</title>
  <link rel="stylesheet" href="request.css">
  <link rel="stylesheet" href="styleLearner.css">
  <link rel="stylesheet" href="navbar2.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <nav class="nav">
    <img class="olanglogo" src="olanglogo.png">
    <h3 class="olang">Olang</h3>
    <div class="navbarCenter">
        <h6 class="Home"><a href="homePagePartner (1).html">Home</a></h6>
        <h6 class="About"><a href="partnerRequest.html">requests</a></h6>
        <h6 class="FAQ"><a href="sessionPartner.html">Sessions</a></h6>
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
  

  <main>
    <h2>Browse Requests</h2>
    <div class="container">
      <ul id="request-list">
        <li class="-item">
          <div class="-header"></div>
          <p class="-content">Request 1 <br>
            Language: English <br>
            Proficiency Level: Beginner <br>
            Preferred Schedule: 03/01/2024 2:00 PM <br>
            Session duration: 1 hour 
          </p>
          <br>
          <div class="-actions">
            <input type="submit" value="Accept">
            <input type="submit" value="Reject"class="reject-button">
          </div>
        </li>
        <li class="-item">
          <div class="-header"></div>
          <p class="-content">Request 2 <br>
            Language: Japanese <br>
            Proficiency Level: Beginner <br>
            Preferred Schedule: 03/04/2024 4:00 PM <br>
            Session duration: 2 hours 
          </p>
          <br>
          <strong>Accepted</strong>
        </li>

        <li class="-item">
          <div class="-header"></div>
          <p class="-content">Request 3 <br>
            Language: French <br>
            Proficiency Level: Intermediate <br>
            Preferred Schedule: 03/15/2024 10:00 AM <br>
            Session duration: 1 hour 
          </p>
          <br>
          <div class="-actions">
            <input type="submit" value="Accept">
            <input type="submit" value="Reject" class="reject-button">
          </div>
        </li>

        <li class="-item">
          <div class="-header"></div>
          <p class="-content">Request 4 <br>
            Language: Spanish <br>
            Proficiency Level: Beginner <br>
            Preferred Schedule: 03/20/2024 1:00 PM <br>
            Session duration: 2 hours 
          </p>
          <br>
          <div class="-actions">
            <input type="submit" value="Accept">
            <input type="submit" value="Reject"class="reject-button">
          </div>
        </li>
      </ul>
    </div>
  </main>

  <footer class="footer">
    &copy; Olang, 2024
  </footer>
</body>
</html>
