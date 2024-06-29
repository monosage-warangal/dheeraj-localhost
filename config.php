<?php
$host = 'localhost'; // Database host (usually localhost)
$db = 'database'; // Database name
$user = 'hero'; // Database username
$pass = 'hero'; // Database password

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; // Optional: Display a success message
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
