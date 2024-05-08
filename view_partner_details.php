<?php
include'config.php';

// Check if session ID and partner name are submitted
if (isset($_POST["session_id"]) && isset($_POST["partner_name"])) {
    // Retrieve session ID and partner name
    $session_id = $_POST["session_id"];
    $partner_name = $_POST["partner_name"];

    // Fetch partner ID from sessions table using session ID
    $sql_partner_id = "SELECT partnerID FROM session WHERE sessionID = '$session_id'";
    $result_partner_id = mysqli_query($conn, $sql_partner_id);
    $row_partner_id = mysqli_fetch_assoc($result_partner_id);
    $partner_id = $row_partner_id['partnerID'];

    // Fetch partner details from partner table using partner ID
    $sql_partner_details = "SELECT * FROM partner WHERE partnerID = '$partner_id'";
    $result_partner_details = mysqli_query($conn, $sql_partner_details);
    $row_partner_details = mysqli_fetch_assoc($result_partner_details);
    $about = $row_partner_details['bio'];

    // Fetch reviews for the partner from the reviews table
    $sql_reviews = "SELECT * FROM reviews WHERE partnerID = '$partner_id'";
    $result_reviews = mysqli_query($conn, $sql_reviews);
    $profile_picture_blob = $row_partner_details['photo'];
    // Convert blob data to base64 format
    $profile_picture_base64 = base64_encode($profile_picture_blob);
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Partner Details</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="viewPartnerdetails.css">
    <style>
        /* Add the style for the button */
        .start-discussion-button {
            margin-top: 20px;
            background-color: #d66f1b;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-family: 'Quicksand';
            display: flex;
            justify-content: center; /* Centers horizontally */
            align-items: center; /* Centers vertically */
            width: fit-content; /* Makes button width fit its content */
            margin: 0 auto; /* Centers the button horizontally */
        }
        .star {
            color: #FFD700; /* Gold color for star */
        }
        .shaded {
            color: #C0C0C0; /* Shaded color for star */
        }
    </style> 
</head>
<body>

<nav class="navbar">
    <div class="logo">
        <img class="olanglogo" src="olanglogo.png" alt="Olang Logo">
        <h3 class="olang">Olang</h3>
    </div>
    <div class="nav-links">
        <h6 class="Home"><a href="homePageLearner.html">Home</a></h6>
        <h6 class="About"><a href="learnerRequest.html">Requests</a></h6>
        <h6 class="FAQ"><a href="generalSessionPageLearner.html">Sessions</a></h6>
        <h6 class="ViewProfile"><a href="viewprofileLearner.html">Profile</a></h6>
        <h6 class="LogOut"><a href="Signout.php">Log Out</a></h6>
    </div>
</nav>
<br><br><br><br><br><br><br><br><br>

<div class="details-box">
    <h1 class="name"><?php echo $partner_name; ?></h1>
    <br>
    <div class="profile-picture">
        <img id="profile-image" src="data:image/jpeg;base64,<?php echo $profile_picture_base64; ?>" alt="Profile Picture">
    </div> 
    <br><br>
    <a href="mailto:<?php echo $row_partner_details['email']; ?>" class="start-discussion-button">Start Discussion with Partner</a>
    <br><br>
    <div class="partner-details">
        <p><strong>About:</strong><?php echo $about; ?></p>
        <p><strong>Proficiency in English languages:</strong></p>
        <p><strong>Session Price per hour:</strong></p>
        <div>
           
            <?php 
                echo '<p><strong class="ratings">Ratings and Reviews:</strong> ';
                echo '<strong class="average-rating">Average: ';
                echo number_format($average_rating, 1) . '/5 (' . $total_ratings . ' Ratings)</strong></p>';
            ?>
            <table>
                <?php while ($row_review = mysqli_fetch_assoc($result_reviews)): ?>
                    <tr>
                        <td>
                            <div class="rate">
                                <div class="bordered-box">
                                    <div class="star-rating" data-rating="<?php echo $row_review['rate']; ?>">
                                        <?php
                                       
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $row_review['rate']) {
                                                echo '<span class="star">&#9733;</span>'; // Shaded star
                                            } else {
                                                echo '<span class="star shaded">&#9733;</span>'; // Unshaded star
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="bordered-box">
                                    <h3><strong><?php echo $row_review['learner_name']; ?>:</strong></h3>
                                    <p><?php echo $row_review['review_text']; ?></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>
<br><br><br><br>

<footer class="footer">
    &copy; Olang, 2024
</footer>

</body>
</html>
