<?php
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
$query = "SELECT s.language, s.learnerID, s.rating, l.firstName, l.lastName FROM sessions s INNER JOIN learners l ON s.learnerID = l.learnerID WHERE s.partnerID = {$_SESSION['partner_id']} AND s.status = 'completed'";
$result = mysqli_query($connection, $query);

if ($result) {
    // Loop through the fetched sessions data
    while ($row = mysqli_fetch_assoc($result)) {
        $session_language = $row['session_language'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $rating = $row['rating'];

        // Output HTML for session entry
        echo '<div class="data">';
        echo "<p><strong>Session language</strong>: $session_language</p>";
        echo "<p><strong>Learner Name</strong>: $first_name $last_name</p>";
        echo '<p><strong>Rating of Learner:</strong></p>';
        echo '<div class="star-rating" data-rating="' . $rating . '">';
        // Output HTML for stars dynamically based on the rating
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                echo '<span class="star">&#9733;</span>';
            } else {
                echo '<span class="star shaded">&#9733;</span>';
            }
        }
        echo '</div>';
        echo '</div>';
    }
}
?>
