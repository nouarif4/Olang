<?php
session_start();
include('config.php'); // Import PHP file (Config.php)

// Check if user is logged in
if (!isset($_SESSION["learner_id"])) {
    // Redirect user to login page if not logged in
    header("Location: signinLearner.php");
    exit();
}

// Fetch current sessions of the learner
$learner_id = $_SESSION['learner_id'];
$sql = "SELECT * FROM session WHERE learner_id = ? AND status = 'current'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $learner_id);
$stmt->execute();
$result = $stmt->get_result();

// Close prepared statement
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Olang</title>
    
    <link rel="stylesheet" href="home view profile.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   
    <link rel="stylesheet" href="navbar.css" />
    <link rel="stylesheet" href="sessionsDesignPreviousAndCurrent.css" />
    
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
        <h6 class="FAQ"><a href="generalSessionPageLearner.html">Sessions</a></h6>
        <h6 class="ViewProfile"><a href="viewprofileLearner.html">Profile</a></h6>
        <h6 class="LogOut"><a href="Signout.php">Log Out</a></h6>
    </div>
</nav>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="sessions">
    <h1>Current sessions</h1>
    <table>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td>
                <div class="profile-picture">
                    <img id="profile-image" src="profile.png">
                </div> 
                <div class="data">
                    <p><strong>Partner Name</strong>: <?php echo $row['partner_name']; ?></p>
                    <p><strong>Date</strong>: <?php echo $row['date']; ?></p>
                    <p><strong>Time</strong>: <?php echo $row['time']; ?></p>
                    <a href="viewPartnerdetails.html"><button class="viewpartner6 button8">View Partner</button></a>
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
  
<footer class="footer">
    &copy; Olang, 2024
</footer> 

</body>
</html>
