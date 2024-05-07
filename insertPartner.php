<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "olang";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $profilePhoto = $_FILES["profilePhoto"]["name"];
    $phoneNumber = $_POST["phoneNumber"];
    $bio = $_POST["bio"];
    $city = $_POST["city"];

    // Prepare the SQL query
    $sql = "INSERT INTO `partner`(`firstName`, `lastName`, `email`, `password`, `photo`, `city`, `age`, `gender`, `bio`, `phone`) VALUES (?,?,?,?,?,?,?,?,?,?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ssssssissss", $firstName, $lastName, $email, $password, $profilePhoto, $city, $age, $gender, $bio, $phoneNumber);

        // Execute the query
        if ($stmt->execute()) {
            echo "New partner record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styleSign.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olang</title>
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

    <form id="PSignupForm" action="insertPartner.php" method="POST">
        <center><h2>Welcome Partner ! </h2></center>
        <center><h3>Please fill the follow to sign up </h3></center>
        <br>
        <label for="firstName">First Name *</label>
        <input type="text" id="firstName" name="firstName" required><br>

        <label for="lastName">Last Name *</label>
        <input type="text" id="lastName" name="lastName" required><br>
        <label for="age">Age *</label>
        <select name="age" id="age" required>
            <option value="">Select Age</option>
        </select>
        <script>
            var ageDropdown = document.getElementById("age");
            function AgeDropdown() {
                ageDropdown.innerHTML = "";
                var defaultOption = document.createElement("option");
                defaultOption.text = "Select Age";
                defaultOption.value = "";
                ageDropdown.add(defaultOption);
                for (var i = 18; i <= 100; i++) {
                    var option = document.createElement("option");
                    option.text = i;
                    option.value = i;
                    ageDropdown.add(option);
                }
            }
            AgeDropdown();
        </script>
        
        <br>
<br>
<label for="gender">Gender *</label>
<div id="gender">
    <label for="male">Male:</label>
    <input name="gender" id="male" type="radio" value="Male" required>
    <label for="female">Female:</label>
    <input name="gender" id="female" type="radio" value="Female" required>
    <label for="ratherNot">Rather not to tell:</label>
    <input name="gender" id="ratherNot" type="radio" value="Rather not to tell" checked required>
</div>


        <label for="email">Email *</label>
        <input type="email" id="email" name="email" required><br>

        <label for="profilePhoto">Profile Photo</label>
        <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*"><br>

        <label for="password">Password *</label>
        <input type="password" id="password" name="password" required><br>

        <label for="phoneNumber">Phone Number *</label>
        <input type="text" id="phoneNumber" name="phoneNumber" required><br>

        <label for="bio">Short bio *<br>(languages spoken, cultural knowledge):<br></label>
        <textarea name="bio" rows="4" cols="40" id="bio" maxlength="150">Enter short bio</textarea><br>

        <label for="city">City *</label>
        <input type="text" id="city" name="city" required><br>

        <button type="submit"> <a href="homePagePartner.html" id="submitbtn"disabled >Sign Up </a> </button>
    </form>

    <footer class="footer">
        &copy; Olang, 2024
    </footer>

   

<script>
    document.getElementById("PSignupForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission
        
        var form = this;
        
        // AJAX 
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo $_SERVER['PHP_SELF'];?>", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    alert(xhr.responseText); // Show success message
                    form.reset(); // Reset the form
                } else {
                    alert("Error: " + xhr.statusText); // Show error message
                }
            }
        };
        var formData = new FormData(form);
        xhr.send(formData);
    });
</script>
    
</body>
</html>


