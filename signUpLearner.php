<!-- signUpLearner.php -->
<!-- <?php
$host = "localhost";
$username = "root";
$password = "";
$database = "olang";
$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
// Function to handle form submission and database insert
function handleFormSubmission($connection)
{
    // Escape user inputs for security
    $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $city = mysqli_real_escape_string($connection, $_POST['city']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);

    // Generate a unique learner ID
    $learnerId = uniqid();

    // Insert learner information into the database
    $query = "INSERT INTO learner (learnerId, firstName, lastName, email, password, city, location) 
              VALUES ('$learnerId', '$firstName', '$lastName', '$email', '$password', '$city', '$location')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Redirect to homePageLearner.html
        header("Location: homePageLearner.html");
        exit();
    } else {
        // Error message
        echo "Error: " . mysqli_error($connection);
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a database connection
    $connection = mysqli_connect($host, $username, $password, $database);

    // Check if the connection was successful
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Handle the form submission
    handleFormSubmission($connection);

    // Close the database connection
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olang</title>
    <link rel="stylesheet" href="styleSign.css">
</head>
<body>
    <div class="top-nav">
        <nav>
            <img class="olanglogo" src="olanglogo.png" />
            <h3 class="olang">Olang</h3>
            <div class="navbarCenter">
             <h6 class="Home"><a href="home.html">Home</a></h6>
             <h6 class="About"><a href="About.html">About</a></h6>
             <h6 class="FAQ"><a href="FAQ.html">FAQ</a></h6>
            </div>
          </nav>
    </div>

    <form id="signupForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <center>
            <h2>Welcome Learner!</h2>
            <h3>Please fill in the following to sign up</h3>
        </center>
        <br>
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <button type="submit">Sign Up</button>
    </form>

    <footer class="footer">
        &copy; Olang, 2024
    </footer>
</body>
</html> -->