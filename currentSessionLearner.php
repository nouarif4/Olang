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

// Fetch current sessions of the learner
$learner_id = $_SESSION['learner_id'];
$sql = "SELECT * FROM sessions WHERE learnerID = $learner_id AND status = 'running'";
$result = mysqli_query($conn, $sql);

// Close database connection
mysqli_close($conn);
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
                    <form action="view_partner_details.php" method="post">
                        <input type="hidden" name="partner_name" value="<?php echo $row['partner_name']; ?>">
                        <input type="hidden" name="session_id" value="<?php echo $row['session_id']; ?>">
                        <button type="submit" class="viewpartner6 button8">View Partner</button>
                    </form>
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
