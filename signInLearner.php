<?php
session_start();

$connection = mysqli_connect(host, username, password, olang);


if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

   
    $query = "SELECT * FROM learner WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        
        $_SESSION['email'] = $email;

        header("Location: homePageLearner.html");
        exit();
    } else {
       
        $message = "Email or password is incorrect.";
    }
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

    <form method="POST" action="">
        <center><h2>Welcome Learner!</h2></center>
        <center><h3>Please fill in the following to sign in</h3></center>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Sign In</button>
    </form>

    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

    <footer class="footer">
        &copy; Olang, 2024
    </footer>
</body>
</html>
