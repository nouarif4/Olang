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

if (isset($_POST['edit'])) {
    $requestID = $_POST['requestID'];
    $status = $_POST['status'];
    $proficiency = $_POST['level'];
    $schedule = $_POST['dateTime'];
    $duration = $_POST['duration'];
    $language = $_POST['language'];

    $query = "UPDATE request SET status = 'Pending', level = '$proficiency', dateTime = '$schedule', duration = '$duration', language = '$language' WHERE requestID = $requestID";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Request updated successfully!";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Fetch previous request data from the database
$requestID = $_GET['requestID'];
$query = "SELECT * FROM request WHERE requestID = $requestID";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Language Learning Request</title>
    <link rel="stylesheet" href="userHomepage.css">

    <link rel="stylesheet" href="navbar2.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

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

                <li><a href="Signout.php">SIGN OUT</a></li>
            </ul></li>

        </div></nav>
<br>

<div class="form-container">
    <h1>Language Learning Request</h1>
    <form action="editRequest.php" method="post">

        <label>Language:</label>
        <select name="language">
            <option>Select a Language</option>
            <option <?php if ($row['language'] == 'English') echo 'selected'; ?>>English</option>
            <option <?php if ($row['language'] == 'Spanish') echo 'selected'; ?>>Spanish</option>
            <option <?php if ($row['language'] == 'French') echo 'selected'; ?>>French</option>
            <option <?php if ($row['language'] == 'German') echo 'selected'; ?>>German</option>
            <option <?php if ($row['language'] == 'Japanese') echo 'selected'; ?>>Japanese</option>
        </select>

        <label>Proficiency Level:</label>
        <select name="level">
            <option value="">Select Proficiency Level</option>
            <option <?php if ($row['level'] == 'Beginner') echo 'selected'; ?>>Beginner</option>
            <option <?php if ($row['level'] == 'Intermediate') echo 'selected'; ?>>Intermediate</option>
            <option <?php if ($row['level'] == 'Advanced') echo 'selected'; ?>>Advanced</option>
        </select>

        <label>Preferred Schedule:</label>
        <input type="datetime-local" name="dateTime" value="<?= $row['dateTime'] ?>">

        <label>Session duration:</label>
        <select name="duration">
            <option>Select Session Duration</option>
            <option <?php if ($row['duration'] == '30 minutes') echo 'selected'; ?>>30 minutes</option>
            <option <?php if ($row['duration'] == '1 hour') echo 'selected'; ?>>1 hour</option>
            <option <?php if ($row['duration'] == '1 hour and 30 minutes') echo'selected'; ?>>1 hour and 30 minutes</option>
            <option <?php if ($row['duration'] == '2 hours') echo 'selected'; ?>>2 hours</option>
            <option <?php if ($row['duration'] == '2 hours and 30 minutes') echo 'selected'; ?>>2 hours and 30 minutes</option>
            <option <?php if ($row['duration'] == '3 hours') echo 'selected'; ?>>3 hours</option>
        </select>

        <input type="hidden" name="requestID" value="<?= $requestID ?>">
        <input type="submit" name="edit" value="Save Changes">

    </form>

</div>
</div>
<footer class="footer">
    &copy; Olang, 2024

</footer>
</body>


</html>
