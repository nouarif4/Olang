
<!-- config.php -->
<?php
$host = 'localhost';
$dbname = 'olang';
$username = 'olang';
$password = 'Olang@123123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected to the database successfully!';
} catch (PDOException $e) {
    echo 'Error connecting to the database: ' . $e->getMessage();
}?>