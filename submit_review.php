<?php
include 'config.php'; // Corrected the include statement

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $learnerID = $_SESSION['learner_id']; // Assuming learner ID is stored in session
    $partnerID = $_POST['partnerID'];
    $sessionID = $_POST['sessionID'];
    $rate = $_POST['rate']; // Assuming this will be the count of selected radio buttons
    $reviewText = $_POST['review']; // Text entered in the textarea

    // Insert data into reviews table
    $query = "INSERT INTO reviews (learnerID, partnerID, rate, reviewtext, sessionID) 
              VALUES ('$learnerID', '$partnerID', '$sessionID', '$rate', '$reviewText')";

    if (mysqli_query($connection, $query)) {
        echo "Review submitted successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }

    // Close connection
    mysqli_close($connection);
} else {
    echo "Form data not submitted.";
}
?>
