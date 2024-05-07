<?php
include 'config.php';


// Check if learner is logged in and retrieve learnerID
session_start();
if (!isset($_SESSION['learner_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: signinLearner.php");
    exit();
}

$learner_id = $_SESSION['learner_id'];

// Fetch previous sessions for the learner with status completed
$query = "SELECT s.language, s.partnerID, s.sessionID, s.status, p.firstName, p.lastName 
          FROM session s 
          INNER JOIN partner p ON s.partnerID = p.partnerID 
          WHERE s.learnerID = $learner_id AND s.status = 'completed'";

$result = mysqli_query($connection, $query);

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
    <link rel="stylesheet" href="style.css"> <!-- Add this line to include the star rating system CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
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
        <h6 class="LogOut"><a href="home.html">Log Out</a></h6>
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
    <h1>Previous sessions</h1>

    <table>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td>
                <div class="data">
                    <p><strong>Session language</strong>: <?php echo $row['language']; ?></p>
                    <p><strong>Partner Name</strong>: <?php echo $row['firstName'] . ' ' . $row['lastName']; ?></p>
                    <p><strong>Rating</strong>: </p>
                    <form action="submit_review.php" method="post">
                    <input type="hidden" name="partnerID" value="<?php echo $row['partnerID']; ?>">
    <input type="hidden" name="sessionID" value="<?php echo $row['sessionID']; ?>">
    <input type="hidden" name="rate" id="rate-count" value="0">
    
     <div class="star-widget">
    <input type="radio" name="rate" id="rate-5">
    <label for="rate-5" class="fas fa-star"></label>
    <input type="radio" name="rate" id="rate-4">
    <label for="rate-4" class="fas fa-star"></label>
    <input type="radio" name="rate" id="rate-3">
    <label for="rate-3" class="fas fa-star"></label>
    <input type="radio" name="rate" id="rate-2">
    <label for="rate-2" class="fas fa-star"></label>
    <input type="radio" name="rate" id="rate-1">
    <label for="rate-1" class="fas fa-star"></label></div>
    
     
        <div class="textarea">
          <textarea cols="30" placeholder="Describe your experience.."></textarea>
        </div>
        <div class="btn">
          <button type="submit">submit</button>
        </div>
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

<script>
const btn = document.querySelector("button");
const post = document.querySelector(".post");
const widget = document.querySelector(".star-widget");
const editBtn = document.querySelector(".edit");

btn.onclick = () => {
  widget.style.display = "none";
  post.style.display = "block";
  
  editBtn.onclick = () => {
    widget.style.display = "block";
    post.style.display = "none";
  }

  const selectedStars = document.querySelectorAll(".star-widget input:checked").length;
    console.log("Selected stars: ", selectedStars);

    // Update the hidden input field value with the count of selected stars
    document.getElementById("rate-count").value = selectedStars;

    return false;
}

</script>

</body>
</html>
