<?php
session_start();
include('config.php');
if (!isset($_SESSION['partner_id'])) {
  // Redirect to login page or handle unauthorized access
  header("Location: signinPartner.php");
  exit();
}
// Select the database
$db_selected = mysqli_select_db($conn, $database);
if (!$db_selected) {
    die("Database selection failed: " . mysqli_connect_error());
}

// Function to fetch partner data based on email
function getPartnerData($email) {
    global $conn;
    $query = "SELECT * FROM partner WHERE email = '$email'";
    $result = mysqli_query($conn,$query);
    if (!$result) {
        die("Query failed: " .mysqli_connect_error());
    }
    return mysqli_fetch_assoc($result);
}

// Function to update partner data
function updatePartnerData($email, $data) {
    global $conn;
    $query = "UPDATE partner SET first_name = '{$data['first_name']}', last_name = '{$data['last_name']}', city = '{$data['city']}', location = '{$data['location']}', age = '{$data['age']}', gender = '{$data['gender']}', phone_number = '{$data['phone_number']}', bio = '{$data['bio']}' WHERE email = '$email'";
    $result = mysqli_query($conn,$query);
    if (!$result) {
        die("Update failed: " . mysqli_connect_error());
    }
}

// Function to delete partner account
function deletePartnerAccount($email) {
    global $conn;
    $query = "DELETE FROM partner WHERE email = '$email'";
    $result = mysqli_query($conn,$query);
    if (!$result) {
        die("Deletion failed: " . mysqli_connect_error());
    }
}

// Check if partner is logged in
if (!isset($_SESSION['email'])) {
    // Redirect partner to login page if not logged in
    header("Location: home.html");
    exit();
}

// Fetch partner data based on session email
$partnerData = getPartnerData($_SESSION['email']);
// Handle profile picture upload
if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] === UPLOAD_ERR_OK) {
    $tempFilePath = $_FILES['profilePhoto']['tmp_name'];
    $imageData = file_get_contents($tempFilePath);
    $base64ImageData = base64_encode($imageData);
    // Update the partner's profile picture in the database
    $updateQuery = "UPDATE partner SET image = '{$base64ImageData}' WHERE email = '{$_SESSION['email']}'";
    $updateResult = mysqli_query($conn, $updateQuery);
    if (!$updateResult) {
        die("Failed to update profile picture: " . mysqli_connect_error());
    }
    // Reload partner data after updating the profile picture
    $partnerData = getPartnerData($_SESSION['email']);
} else {
    die("Error uploading profile picture: " . $_FILES['profilePhoto']['error']);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "Edit" button is clicked
    if (isset($_POST['edit'])) {
        // Validate form data
        $errorMsg = validateFormData($_POST);
        if (empty($errorMsg)) {
            // Get form data from $_POST superglobal
            $updatedData = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'city' => $_POST['city'],
                'location' => $_POST['location'],
                'age' => $_POST['age'],
                'gender' => $_POST['gender'],
                'phone_number' => $_POST['phone_number'],
                'bio' => $_POST['bio']
            );
            // Update partner data in the database
            updatePartnerData($_SESSION['email'], $updatedData);
            // Refresh partner data after update
            $partnerData = getPartnerData($_SESSION['email']);
        } else {
            echo "<p>$errorMsg</p>";
        }
    }

    // Check if the "Delete Account" button is clicked
    if (isset($_POST['delete'])) {
        // Delete partner account
        deletePartnerAccount($_SESSION['email']);
        // Redirect partner to logout page or homepage
        $successMsg = "Your account was successfully deleted.";
        header("Location: home.html". urlencode($successMsg));
        exit();
    }
}



// Function to validate form data
function validateFormData($formData) {
    $errorMsg = '';
    
    // Validate first name
    $firstName = $formData['first_name'];
    if (!preg_match("/^[a-zA-Z]+$/", $firstName)) {
        $errorMsg .= "First name should contain only letters.<br>";
    }

    // Validate last name
    $lastName = $formData['last_name'];
    if (!preg_match("/^[a-zA-Z]+$/", $lastName)) {
        $errorMsg .= "Last name should contain only letters.<br>";
    }

    // Validate password
    $password = $formData['password'];
    if (strlen($password) < 8 || !preg_match("/[^\w\s]/", $password)) {
        $errorMsg .= "Password should be at least 8 characters long and contain at least one special character.<br>";
    }

    // Validate phone number
    $phoneNumber = $formData['phone_number'];
    if (!preg_match("/^05[0-9]{8}$/", $phoneNumber)) {
        $errorMsg .= "Phone number should start with '05' and contain 10 digits.<br>";
    }

    return $errorMsg;
}
// Close database connection
mysqli_close($conn);
?>
