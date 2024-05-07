<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "olang"; 

    
    $conn = new mysqli($servername, $username, $password, $database);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $city = $_POST['city'];
    $location = $_POST['location'];

    
    $targetDir = "uploads/"; // Directory where uploaded files will be stored
    $profilePhoto = basename($_FILES["profilePhoto"]["name"]); // Name of the uploaded file

    
    if (move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $targetDir . $profilePhoto)) {
        echo "The file ". $profilePhoto. " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

   
    $sql = "INSERT INTO learner (firstName, lastName, email, password,photo, city, location, ) 
            VALUES ('$firstName', '$lastName', '$email', '$password','$profilePhoto' ,'$city', '$location', '$profilePhoto')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
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
            
          </nav></div>
        </div >
    

<form id="LSignupForm" action="insertLearner.php" method="post">
 
    <center><h2>Welcome Learner ! </h2></center>
    
    <center><h3>Please fill the follow to sign up </h3></center>
        <br>
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName"  required>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName"  required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"  required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"  required>

    <label for="profilePhoto">Profile Photo (optional):</label>
<input type="file" id="profilePhoto" name="profilePhoto" accept="image/*">

    <label for="city">City:</label>
    <input type="text" id="city" name="city"  required>

    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required>

    <button type="submit" ><a  href="homePageLearner.html">Sign Up </a> </button> 

</form>
<footer class="footer">
            &copy; Olang, 2024
        
        </footer> 
        <script>
    document.getElementById("PSignupForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission
        
        var form = this;
        
        // Other form validation and processing logic...
        
        // Perform AJAX submission
        var xhr = new XMLHttpRequest();
        xhr.open("POST", form.getAttribute("action"), true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    alert(xhr.responseText); // Show success message
                    form.reset(); // Reset the form
                } else {
                    alert("Error occurred while inserting data"); // Show error message
                }
            }
        };
        var formData = new FormData(form);
        xhr.send(formData);
    });
</script>

    <script>
            document.getElementById("signupForm").addEventListener("submit", function(event) {
              event.preventDefault(); // Prevent form submission
              var form = this;
              
              // Validate form fields
              var firstName = form.elements["firstName"].value;
              var lastName = form.elements["lastName"].value;
              var email = form.elements["email"].value;
              var password = form.elements["password"].value;
              var city = form.elements["city"].value;
              var location = form.elements["location"].value;
            
              // Perform basic validation
              if(firstName.trim() === "" || lastName.trim() === "" || email.trim() === "" || password.trim() === "" || city.trim() === "" || location.trim() === "") {
                alert("Please fill in all required fields");
                return;
              }
            
              // If all fields are filled, proceed with form submission via AJAX
              var xhr = new XMLHttpRequest();
              xhr.open("POST", "insert.php", true);
              xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              xhr.onreadystatechange = function() {
                if(xhr.readyState === XMLHttpRequest.DONE) {
                  if(xhr.status === 200) {
                    alert(xhr.responseText); // Show success message
                    form.reset(); // Reset the form
                  } else {
                    alert("Error occurred while inserting data"); // Show error message
                  }
                }
              };
              var formData = new FormData(form);
              xhr.send(formData);
            });
            </script>
</body>
</html>

