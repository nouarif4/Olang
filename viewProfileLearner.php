<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$dbpassword = "";
$database = "olang";

// Connect to the database
$conn = mysqli_connect($servername, $username, $dbpassword);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Select the database
$db_selected = mysqli_select_db($conn, $database);
if (!$db_selected) {
    die("Database selection failed: " . mysqli_error($conn));
}

// Function to fetch user data based on email
function getUserData($email) {
    global $conn;
    $query = "SELECT * FROM learner WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    return mysqli_fetch_assoc($result);
}

// Function to update user data
function updateUserData($email, $data) {
    global $conn;
    $query = "UPDATE learner SET first_name = '{$data['first_name']}', last_name = '{$data['last_name']}', city = '{$data['city']}', location = '{$data['location']}' WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Update failed: " . mysqli_error($conn));
    }
}

// Function to delete user account
function deleteUserAccount($email) {
    global $conn;
    $query = "DELETE FROM learner WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Deletion failed: " . mysqli_error($conn));
    }
}

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect user to login page if not logged in
    header("Location: home.html");
    exit();
}

// Fetch user data based on session email
$userData = getUserData($_SESSION['email']);
if (isset($_POST['editProfileImage'])) {
    // Handle profile picture upload
    if ($_FILES['profilePhoto']['error'] === UPLOAD_ERR_OK) {
        $tempFilePath = $_FILES['profilePhoto']['tmp_name'];
        $imageData = file_get_contents($tempFilePath);
        $base64ImageData = base64_encode($imageData);
        // Update the user's profile picture in the database
        $updateQuery = "UPDATE learner SET image = '{$base64ImageData}' WHERE email = '{$_SESSION['email']}'";
        $updateResult = mysqli_query($conn, $updateQuery);
        if (!$updateResult) {
            die("Failed to update profile picture: " . mysqli_error($conn));
        }
        // Reload user data after updating the profile picture
        $userData = getUserData($_SESSION['email']);
    } else {
        die("Error uploading profile picture: " . $_FILES['profilePhoto']['error']);
    }
}
// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorMsg = validateFormData($_POST);
    // Check if the "Edit" button is clicked
    if (isset($_POST['edit'])) {
        // Get form data from $_POST superglobal
        if (empty($errorMsg)){
        $updatedData = array(
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'city' => $_POST['city'],
            'location' => $_POST['location']
        );
        // Update user data in the database
        updateUserData($_SESSION['email'], $updatedData);
        // Refresh user data after update
        $userData = getUserData($_SESSION['email']);
    }}
 
    
    // Check if the "Delete Account" button is clicked
    if (isset($_POST['delete'])) {
        // Delete user account
        deleteUserAccount($_SESSION['email']);
        // Redirect user to logout page or homepage
        $successMsg = "Your account was successfully deleted.";
        header("Location: home.html". urlencode($successMsg));
        exit();
    }
}
function validateFormData($formData) {
    $errorMsg = '';
    
    // Validate first name
    $firstName = $formData['first_name'];
    if (!preg_match("/^[a-zA-Z]+$/", $firstName)) {
        $errorMsgs['first_name']= "First name should contain only letters.<br>";
    }

    // Validate last name
    $lastName = $formData['last_name'];
    if (!preg_match("/^[a-zA-Z]+$/", $lastName)) {
        $errorMsgs['last_name']= "Last name should contain only letters.<br>";
    }

    // Validate password
    $password = $formData['password'];
    if (strlen($password) < 8 || !preg_match("/[^\w\s]/", $password)) {
        $errorMsgs['password'] = "Password should be at least 8 characters long and contain at least one special character.<br>";
    }

    return $errorMsg;
}

// Close database connection
mysqli_close($conn);
?>