<?php
$con = mysqli_connect("localhost", "root", "", "olang");
$database= mysqli_select_db($con, "olang");

if (!$connection) 
die("Connection failed: ".mysqli_connect_error());

?>