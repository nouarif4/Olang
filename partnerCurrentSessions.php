<?php
// Include your database connection file
include 'config.php';

// Start session to access session variables
session_start();

// Check if partner is logged in
if (!isset($_SESSION['partner_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: signinPartner.php");
    exit();
}

// Fetch partner ID from session
$partner_id = $_SESSION['partner_id'];

// Query to retrieve current sessions for the logged-in partner with status "running"
$sql = "SELECT s.ID, s.LearnerID, s.dateTime, l.email
        FROM sessions s
        INNER JOIN learners l ON s.learner_id = l.learner_id
        WHERE s.partnerID = $partner_id AND s.status = 'running'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Sessions found, display them
    ?>
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8" />
        <title>Olang</title>
        
        <link rel="stylesheet" href="navbar2.css" />
        <link rel="stylesheet" href="home view profile.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
       
        <link rel="stylesheet" href="navbar.css" />
        <link rel="stylesheet" href="sessionsDesignPreviousAndCurrent.css" />
        
      </head>
      <style>
        viewpartner6{
         width: fit-content;
        }
      </style>
      <body>
        
      <nav class="navbar">
    <div class="logo">
        <img class="olanglogo" src="olanglogo.png" alt="Olang Logo">
        <h3 class="olang">Olang</h3>
    </div>
    <div class="nav-links">
        <h6 class="Home"><a href="homePagePartner (1).html">Home</a></h6>
        <h6 class="About"><a href="partnerRequest.html">requests</a></h6>
        <h6 class="FAQ"><a href="sessionPartner.html">Sessions</a></h6>
        <h6 class="ViewProfile"><a href="viewprofilePartner.html">Profile</a></h6>
        <h6 class="LogOut"><a href="home.html">Log Out</a></h6>
    </div>
</nav>
      <br><br><br><br><br><br><br><br>
      
      <div class="sessions">
        <h1>Current sessions</h1>
      
        <table>
          <?php
          // Loop through each session
          while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <tr>
                <td>
                  <div class="data">
                    <p><strong>Learner Name</strong>: <?php echo $row['learner_id']; ?></p>
                    <p><strong>Date</strong>: <?php echo $row['date']; ?></p>
                    <p><strong>Time</strong>: <?php echo $row['time']; ?></p>
                    <a href="mailto:<?php echo $row['email']; ?>"><button class="viewpartner6 button8">chat now</button></a>
                  </div>
                </td>
              </tr>
              <?php
          }
          ?>
        </table>
      </div>
      
      <footer class="footer">
        &copy; Olang, 2024
      </footer>
      
      </body>
    </html>
    <?php
} else {
    // No sessions found
    echo "No current sessions found for the logged-in partner.";
}

// Close database connection
mysqli_close($conn);
?>
