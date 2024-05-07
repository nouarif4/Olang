
<?php
$host = "your_host";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Query to retrieve reviews from the database
$query = "SELECT * FROM reviews";
$result = mysqli_query($connection, $query);


if (!$result) {
    die("Database query failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews Page</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="Reviews.css">
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="logo">
          <img class="olanglogo" src="olanglogo.png" alt="Olang Logo">
          <h3 class="olang">Olang</h3>
      </div>
      <div class="nav-links">
          <h6 class="Home"><a href="homePagePartner (1).html">Home</a></h6>
          <h6 class="About"><a href="partnerRequest.html">Requests</a></h6>
          <h6 class="FAQ"><a href="sessionPartner.html">Sessions</a></h6>
          <h6 class="ViewProfile"><a href="viewprofilePartner.html">Profile</a></h6>
          <h6 class="LogOut"><a href="home.html">Log Out</a></h6>
      </div>
    </nav>
  </header>


  <h2>Reviews</h2>
  <div class="main-container">
  
    <div class="members">
      <div class="small-container" id="container-1">
        <div class="team-member">
          <img src="pexels-photo-2057846.jpg" alt="woman women">
          <h5>Hannah Kinney , 97% &#128525</h5>
          <p>Absolutely fantastic English tutor! Patient, passionate. Highly recommend!&hearts; </p>
        </div>
      </div>



      <div class="small-container" id="container-2">
        <div class="team-member">
          <img src="pexels-photo-4098274.jpg" alt="Man women">
          <h5>Sara Baker , 87% &#128512</h5>
          <p>Great English tutor! Effective and enjoyable sessions. </p>
        </div>
      </div>



      <div class="small-container" id="container-3">
        <div class="team-member">
          <img src="pexels-photo-15088506.jpg" alt="Man women">
          <h5>Simon Allan , 99% &#128525</h5>
        
          <p>An excellent English tutor! The sessions were engaging, and the explanations were clear.</p>
        </div>
     </div>



     <div class="small-container" id="container-4">
      <div class="team-member">
        <img src="pexels-photo-4098353.jpeg" alt="Man women">
        <h5>Ryan Bond , 70% &#128528</h5>
    
        <p> The session was okay, but nothing remarkable</p>
      </div>
     </div>

      <div class="small-container" id="container-5">
      <div class="team-member">
         
        <img src="free-photo-of-silhouette-of-a-man-with-curly-hair.jpeg" alt="Man women">
        <h5>Sam Kinney , 93%  &#128513</h5>
      
        <p>High-quality tutoring session, offering valuable insights . However, the cost may be a concern for some.</p>

      </div>
      </div>

     <div class="small-container" id="container-6">
      <div class="team-member">
        <img src="pexels-photo-4098344.jpg" alt="Man women">
        <h5> Wanda Avery , 86% &#128512</h5>
      
        <p>
           The tutor's engaging personality boosts learning and student success.Highly recommend!</p>
      </div>
     </div>



     <div class="small-container" id="container-7">
         <div class="team-member">
           <img src="pexels-photo-4100420.jpg" alt="Man women">
           <h5>Harry bell , 97% &#128525</h5>
         
           <p>The tutor has a fantastic personality, creating a positive environment.&#9733</p>
         </div>
     </div>




     <div class="small-container"id="container-8">
         <div class="team-member">
           <img src="pexels-photo-4100433.jpeg" alt="Man women">
           <h5>Ian Blake , 91% &#128513</h5>
         
           <p>Moderate tutoring experience. The session was passable, but not particularly impressive. Meh</p>
         </div>
     </div>




     <div class="small-container"id="container-9">
         <div class="team-member">
           <img src="pexels-photo-20219126.jpg" alt="Man women">
           <h5>Wendy Austin , 100% &#128525</h5>
         
           <p>Masterpiece Tutoring: Expert, personalized, and strongly endorsed.!</p>
         </div>
     </div>

     <?php
      // Loop through the retrieved reviews and populate the containers
      while ($row = mysqli_fetch_assoc($result)) {
          $comment = $row['comment'];
          $rating = $row['rating'];
          $partnerId = $row['partner_id'];
          $learnerId = $row['learner_id'];
      ?>
      <div class="small-container">
        <div class="team-member">
     
          <h5><?php echo $partnerId; ?>, <?php echo $rating; ?> &#128525</h5>
          <p><?php echo $comment; ?></p>
        </div>
      </div>
      <?php
      }
      ?>

    </div>
  </div>

  <footer>
    <p>&copy; 2024 Olang </p>
  </footer>
</body>
</html>
